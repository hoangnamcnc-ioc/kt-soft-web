<?php
/**
 * API gui email thay mat QLBH-SOFT (desktop) - de file .exe KHONG phai chua mat khau SMTP.
 * Mat khau chi nam o admin/smtp_config.php tren server nay.
 *
 * Chi nhan 2 mau co dinh (otp, bao_cao); noi dung do server tu dung tu cac truong da kiem tra,
 * KHONG nhan HTML/van ban tu do - tranh bi lam dung de gui thu rac mao danh kt-soft.vn.
 * Gioi han tan suat theo IP va theo nguoi nhan (chan viec bom OTP vao hop thu cua nguoi khac).
 */
require_once __DIR__ . '/admin/config.php';
require_once __DIR__ . '/admin/inc_mail.php';

header('Content-Type: application/json; charset=utf-8');

function mail_api_loi(int $code, string $msg): void
{
    http_response_code($code);
    echo json_encode(['ok' => false, 'error' => $msg]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    mail_api_loi(405, 'Chỉ chấp nhận POST');
}

$input = json_decode((string) file_get_contents('php://input'), true);
if (!is_array($input)) {
    mail_api_loi(400, 'Dữ liệu không hợp lệ');
}

/** Tra ve true neu da vuot gioi han; neu chua thi ghi nhan them 1 lan. */
function mail_api_qua_gioi_han(string $khoa, int $toiDa, int $cuaSoGiay): bool
{
    $file = __DIR__ . '/data/mail_rate.json';
    $data = doc_json_file($file);
    $now = time();
    foreach ($data as $k => $times) {
        $data[$k] = array_values(array_filter((array) $times, fn($t) => $now - (int) $t < 86400));
        if (!$data[$k]) {
            unset($data[$k]);
        }
    }
    $trongCuaSo = array_filter($data[$khoa] ?? [], fn($t) => $now - (int) $t < $cuaSoGiay);
    if (count($trongCuaSo) >= $toiDa) {
        ghi_json_file($file, $data);
        return true;
    }
    $data[$khoa][] = $now;
    ghi_json_file($file, $data);
    return false;
}

$ip = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0')[0]);
if (mail_api_qua_gioi_han('ip:' . $ip, 30, 3600)) {
    mail_api_loi(429, 'Gửi quá nhiều, thử lại sau.');
}

$loai = (string) ($input['loai'] ?? '');
$email = trim((string) ($input['email'] ?? ''));
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) {
    mail_api_loi(400, 'Email không hợp lệ');
}
$tenCuaHang = mb_substr(trim((string) ($input['ten_cua_hang'] ?? '')), 0, 100);
$khoaNguoiNhan = sha1(strtolower($email));

if ($loai === 'otp') {
    $otp = (string) ($input['otp'] ?? '');
    $tenDangNhap = mb_substr(trim((string) ($input['ten_dang_nhap'] ?? '')), 0, 50);
    if (!preg_match('/^\d{6}$/', $otp)) {
        mail_api_loi(400, 'Mã OTP không hợp lệ');
    }
    if (mail_api_qua_gioi_han('otp:' . $khoaNguoiNhan, 5, 3600)) {
        mail_api_loi(429, 'Đã gửi quá nhiều mã tới email này, thử lại sau.');
    }
    $subject = 'Mã đặt lại mật khẩu QLBH-SOFT: ' . $otp;
    $body = "Mã đặt lại mật khẩu QLBH-SOFT" . ($tenCuaHang !== '' ? " ($tenCuaHang)" : '') . "\n\n"
        . "Tài khoản: $tenDangNhap\n"
        . "Mã xác nhận (hết hạn sau 15 phút): $otp\n\n"
        . "Nếu bạn không yêu cầu đặt lại mật khẩu, hãy bỏ qua email này.\n";
} elseif ($loai === 'bao_cao') {
    if (mail_api_qua_gioi_han('bc:' . $khoaNguoiNhan, 3, 86400)) {
        mail_api_loi(429, 'Đã gửi đủ số báo cáo cho email này hôm nay.');
    }
    $ngay = preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) ($input['ngay'] ?? '')) ? $input['ngay'] : date('Y-m-d');
    $tien = fn($v) => number_format((float) $v, 0, ',', '.') . 'đ';
    $subject = "Báo cáo cuối ngày $ngay — Doanh thu " . $tien($input['doanh_thu'] ?? 0);
    $body = "Báo cáo cuối ngày $ngay" . ($tenCuaHang !== '' ? " — $tenCuaHang" : '') . "\n\n"
        . 'Doanh thu: ' . $tien($input['doanh_thu'] ?? 0) . "\n"
        . 'Số hóa đơn: ' . (int) ($input['so_don'] ?? 0) . "\n"
        . 'Trả hàng: ' . $tien($input['tra_hang'] ?? 0) . ' (' . (int) ($input['so_phieu_tra'] ?? 0) . " phiếu)\n\n"
        . "Theo hình thức thanh toán:\n";
    foreach (array_slice((array) ($input['theo_phuong_thuc'] ?? []), 0, 10) as $dong) {
        $body .= '  - ' . mb_substr((string) ($dong['ten'] ?? ''), 0, 40) . ': ' . $tien($dong['so_tien'] ?? 0) . "\n";
    }
    $body .= "\nKiểm két tiền mặt:\n"
        . '  Thu tiền mặt: ' . $tien($input['tien_thu'] ?? 0) . "\n"
        . '  Chi tiền mặt: ' . $tien($input['tien_chi'] ?? 0) . "\n"
        . '  Tiền mặt phải có trong két: ' . $tien($input['tien_mat_phai_co'] ?? 0) . "\n\n"
        . "Email tự động từ QLBH-SOFT, không cần trả lời.\n";
    // Tuy chon: toi da 8 diem can xem do phan mem tinh (chi van ban thuan, cat do dai, bo ky tu dieu khien)
    $luuY = [];
    foreach (array_slice((array) ($input['luu_y'] ?? []), 0, 8) as $y) {
        $y = trim(preg_replace('/[\x00-\x1F\x7F]+/u', ' ', (string) $y));
        if ($y !== '') {
            $luuY[] = mb_substr($y, 0, 160);
        }
    }
    if ($luuY) {
        $body = str_replace("Email tự động từ QLBH-SOFT, không cần trả lời.\n", "Điểm cần xem:\n  - " . implode("\n  - ", $luuY) . "\n\nEmail tự động từ QLBH-SOFT, không cần trả lời.\n", $body);
    }
} else {
    mail_api_loi(400, 'Loại email không hỗ trợ');
}

if (!sendMail($email, $subject, $body)) {
    mail_api_loi(502, 'Không gửi được email');
}
echo json_encode(['ok' => true]);
