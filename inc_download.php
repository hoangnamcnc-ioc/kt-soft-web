<?php
require_once __DIR__ . '/admin/config.php'; // dung chung doc_json_file()/ghi_json_file()

/** Khai báo các file cài đặt cho phép tải - dùng key ngắn gọn trong URL, tránh lộ đường dẫn thật. */
const DOWNLOAD_MAP = [
    'qlbh-soft' => [
        'file' => 'downloads/QLBH-SOFT-Setup.exe',
        'ten' => 'QLBH-SOFT-Setup.exe',
    ],
    'qlcf-soft' => [
        'file' => 'downloads/QLCF-SOFT-Setup.exe',
        'ten' => 'QLCF-SOFT-Setup.exe',
    ],
    'qlnh-soft' => [
        'file' => 'downloads/QLNH-SOFT-Setup.exe',
        'ten' => 'QLNH-SOFT-Setup.exe',
    ],
    'qlcv' => [
        'file' => 'downloads/QLCV-Setup.exe',
        'ten' => 'QLCV-Setup.exe',
    ],
    'ke-toan' => [
        'file' => 'downloads/KT-SOFT-Setup.exe',
        'ten' => 'KT-SOFT-Setup.exe',
    ],
];

const LUOT_TAI_FILE = __DIR__ . '/data/luot_tai.json';
const DANH_GIA_FILE = __DIR__ . '/data/danh_gia.json';

const NHAT_KY_TAI_FILE = __DIR__ . '/data/luot_tai.log';
const TAI_GAN_DAY_FILE = __DIR__ . '/data/tai_gan_day.json';

/**
 * Phân loại 1 lượt GET tải file: 'bot' (robot, quét virus, xem trước liên kết, công cụ dòng lệnh),
 * 'trung' (cùng thiết bị tải lại trong 1 giờ) hoặc 'that'. Chỉ lưu mã băm ngắn hạn (xóa sau 1 giờ),
 * không lưu địa chỉ IP.
 */
function phan_loai_luot_tai(string $key): string
{
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    if ($ua === '' || preg_match('/bot|crawl|spider|slurp|curl|wget|python|go-http|java|okhttp|libwww|headless|virustotal|scan|preview|facebookexternalhit|ahrefs|semrush|mj12|monitor|uptime|check/i', $ua)) {
        return 'bot';
    }
    try {
        $ma = substr(hash('sha256', ($_SERVER['REMOTE_ADDR'] ?? '') . '|' . $ua . '|' . $key . '|' . date('Y-m-d')), 0, 16);
        $now = time();
        $data = doc_json_file(TAI_GAN_DAY_FILE);
        foreach ($data as $k => $t) {
            if ($now - (int) $t > 3600) {
                unset($data[$k]);
            }
        }
        $trung = isset($data[$ma]);
        $data[$ma] = $now;
        ghi_json_file(TAI_GAN_DAY_FILE, $data);
        return $trung ? 'trung' : 'that';
    } catch (\Throwable $e) {
        return 'that';
    }
}

/** Ghi 1 dòng nhật ký tải (ngày, sản phẩm, loại) để xem thống kê theo ngày. Lỗi ghi không làm hỏng việc tải. */
function ghi_nhat_ky_tai(string $key, string $loai): void
{
    @file_put_contents(NHAT_KY_TAI_FILE, date('Y-m-d') . "\t" . $key . "\t" . $loai . "\n", FILE_APPEND | LOCK_EX);
}

/** Đếm lượt tải trong N ngày qua theo loại: ['that' => .., 'bot' => .., 'trung' => ..]. */
function thong_ke_tai(string $key, int $soNgay): array
{
    $kq = ['that' => 0, 'bot' => 0, 'trung' => 0];
    if (!is_file(NHAT_KY_TAI_FILE)) {
        return $kq;
    }
    $tu = date('Y-m-d', strtotime('-' . ($soNgay - 1) . ' days'));
    foreach (file(NHAT_KY_TAI_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [] as $dong) {
        $c = explode("\t", $dong);
        if (count($c) === 3 && $c[1] === $key && $c[0] >= $tu && isset($kq[$c[2]])) {
            $kq[$c[2]]++;
        }
    }
    return $kq;
}

/** Tăng đếm lượt tải cho 1 sản phẩm (dùng chung doc_json_file/ghi_json_file từ admin/config.php). */
function tang_luot_tai(string $key): void
{
    $data = doc_json_file(LUOT_TAI_FILE);
    $data[$key] = (int) ($data[$key] ?? 0) + 1;
    ghi_json_file(LUOT_TAI_FILE, $data);
}

function doc_luot_tai(string $key): int
{
    $data = doc_json_file(LUOT_TAI_FILE);
    return (int) ($data[$key] ?? 0);
}

/** Ghi 1 lượt đánh giá sao (1-5) ẩn danh cho 1 sản phẩm. */
function ghi_danh_gia(string $key, int $diem): void
{
    $data = doc_json_file(DANH_GIA_FILE);
    $tong = (float) ($data[$key]['tong_diem'] ?? 0) + $diem;
    $soLuot = (int) ($data[$key]['so_luot'] ?? 0) + 1;
    $data[$key] = ['tong_diem' => $tong, 'so_luot' => $soLuot];
    ghi_json_file(DANH_GIA_FILE, $data);
}

/** Đọc điểm trung bình + số lượt đánh giá của 1 sản phẩm. */
function doc_danh_gia(string $key): array
{
    $data = doc_json_file(DANH_GIA_FILE);
    $soLuot = (int) ($data[$key]['so_luot'] ?? 0);
    $tong = (float) ($data[$key]['tong_diem'] ?? 0);
    return [
        'trung_binh' => $soLuot > 0 ? round($tong / $soLuot, 1) : 0,
        'so_luot' => $soLuot,
    ];
}
