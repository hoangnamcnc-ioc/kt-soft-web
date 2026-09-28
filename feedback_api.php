<?php
/**
 * API cong khai nhan phan hoi (bao loi/gop y) TU CA 3 SAN PHAM:
 *   - QLBH-CLOUD (app.kt-soft.vn): goi qua fetch() tu trinh duyet nguoi dung dang dung app.
 *   - QLBH-SOFT va KT-SOFT (desktop, chay offline binh thuong): goi SERVER-TO-SERVER qua
 *     internet khi may co mang - khong qua trinh duyet nen KHONG bi CORS chi phoi, chi API
 *     nay (goi tu QLBH-CLOUD) moi can header CORS.
 *
 * Luu tap trung 1 noi DUY NHAT (feedback.json) thay vi moi san pham tu luu rieng, de xem duoc
 * toan canh phan hoi tu ca he sinh thai o 1 trang quan tri (admin/feedback.php) - dong thoi gui
 * email ngay de biet lien tuc, khong phai vao admin moi thay.
 *
 * KHONG yeu cau dang nhap (nguoi dung/khach hang dang dung san pham, khong co tai khoan quan
 * tri kt-soft.vn) - an toan vi chi GHI THEM 1 dong phan hoi, khong doc/sua du lieu gi khac. Chan
 * spam bang gioi han so lan/IP/gio (feedback_qua_gioi_han()) + 1 truong honeypot an cho bot.
 */
require_once __DIR__ . '/admin/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *'); // API cong khai, khong dinh kem cookie/thong tin nhay cam
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Chỉ chấp nhận POST']);
    exit;
}

// Chap nhan ca JSON body (fetch tu trinh duyet/Node/Python thuong dung) lan
// application/x-www-form-urlencoded (du phong cho client don gian hon).
$input = $_POST;
if (empty($input)) {
    $raw = file_get_contents('php://input');
    $decoded = json_decode($raw, true);
    if (is_array($decoded)) {
        $input = $decoded;
    }
}

// Honeypot: truong an nay khong hien voi nguoi that, chi bot tu dong dien form moi dien vao.
// Van tra ve "thanh cong" gia (khong bao loi ro rang cho bot biet no bi phat hien).
if (trim((string) ($input['website'] ?? '')) !== '') {
    echo json_encode(['ok' => true]);
    exit;
}

$ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
$ip = trim(explode(',', $ip)[0]);
if (feedback_qua_gioi_han($ip)) {
    http_response_code(429);
    echo json_encode(['ok' => false, 'error' => 'Bạn gửi hơi nhiều, vui lòng thử lại sau ít phút.']);
    exit;
}

$sanPhamHople = ['QLBH-CLOUD', 'QLBH-SOFT', 'KT-SOFT'];
$sanPham = trim((string) ($input['san_pham'] ?? ''));
$loaiHople = ['bao_loi', 'gop_y', 'khac'];
$loai = trim((string) ($input['loai'] ?? 'khac'));
$noiDung = trim((string) ($input['noi_dung'] ?? ''));

if (!in_array($sanPham, $sanPhamHople, true)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Thiếu hoặc sai tên sản phẩm']);
    exit;
}
if (!in_array($loai, $loaiHople, true)) {
    $loai = 'khac';
}
if ($noiDung === '' || mb_strlen($noiDung) < 5) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Vui lòng nhập nội dung phản hồi (tối thiểu 5 ký tự)']);
    exit;
}
if (mb_strlen($noiDung) > 3000) {
    $noiDung = mb_substr($noiDung, 0, 3000);
}

$id = feedback_them([
    'time' => date('c'),
    'san_pham' => $sanPham,
    'loai' => $loai,
    'noi_dung' => $noiDung,
    'phien_ban' => mb_substr(trim((string) ($input['phien_ban'] ?? '')), 0, 50) ?: null,
    'nguoi_gui' => mb_substr(trim((string) ($input['nguoi_gui'] ?? '')), 0, 100) ?: null,
    'lien_he' => mb_substr(trim((string) ($input['lien_he'] ?? '')), 0, 150) ?: null,
    'may_tinh' => mb_substr(trim((string) ($input['may_tinh'] ?? '')), 0, 200) ?: null,
    'ip' => $ip,
]);

$loaiNhan = ['bao_loi' => 'Báo lỗi', 'gop_y' => 'Góp ý', 'khac' => 'Khác'][$loai];
$subject = "[$sanPham] $loaiNhan mới #$id";
$body = "Sản phẩm: $sanPham\n"
    . "Loại: $loaiNhan\n"
    . (!empty($input['phien_ban']) ? 'Phiên bản: ' . $input['phien_ban'] . "\n" : '')
    . (!empty($input['nguoi_gui']) ? 'Người gửi: ' . $input['nguoi_gui'] . "\n" : '')
    . (!empty($input['lien_he']) ? 'Liên hệ lại qua: ' . $input['lien_he'] . "\n" : '')
    . (!empty($input['may_tinh']) ? 'Máy tính: ' . $input['may_tinh'] . "\n" : '')
    . "\nNội dung:\n$noiDung\n\n"
    . "Xem tại: https://kt-soft.vn/admin/feedback.php\n";
sendMail('hoangnamcnc@gmail.com', $subject, $body);

echo json_encode(['ok' => true, 'id' => $id]);
