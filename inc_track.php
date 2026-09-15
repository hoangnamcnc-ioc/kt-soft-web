<?php
const LUOT_XEM_FILE = __DIR__ . '/data/luot_xem.log';

/** Ghi 1 lượt xem trang (bỏ qua bot/crawler) - dùng cho thống kê trong admin. Không để lỗi làm hỏng trang. */
function ghi_luot_xem(): void
{
    try {
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
        if ($ua === '' || preg_match('/bot|crawl|spider|curl|wget|python|facebookexternalhit|slurp|ahrefs|semrush|mj12/i', $ua)) {
            return;
        }
        $trang = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $line = date('Y-m-d') . "\t" . $trang . "\n";
        @file_put_contents(LUOT_XEM_FILE, $line, FILE_APPEND | LOCK_EX);
    } catch (\Throwable $e) {
        // bỏ qua, thống kê không quan trọng bằng việc trang vẫn chạy được
    }
}

/** Đọc file log và tính thống kê lượt xem hôm nay/7 ngày/30 ngày + top trang xem nhiều (7 ngày qua). */
function doc_thong_ke_luot_xem(): array
{
    $result = ['hom_nay' => 0, 'bay_ngay' => 0, 'ba_muoi_ngay' => 0, 'top_trang' => []];
    if (!is_file(LUOT_XEM_FILE)) {
        return $result;
    }
    $homNay = date('Y-m-d');
    $tu7Ngay = date('Y-m-d', strtotime('-6 days'));
    $tu30Ngay = date('Y-m-d', strtotime('-29 days'));
    $demTheoTrang7Ngay = [];

    $fp = fopen(LUOT_XEM_FILE, 'r');
    if (!$fp) {
        return $result;
    }
    flock($fp, LOCK_SH);
    while (($line = fgets($fp)) !== false) {
        [$ngay, $trang] = array_pad(explode("\t", trim($line), 2), 2, '');
        if ($ngay === '' || $trang === '') {
            continue;
        }
        if ($ngay === $homNay) {
            $result['hom_nay']++;
        }
        if ($ngay >= $tu7Ngay) {
            $result['bay_ngay']++;
            $demTheoTrang7Ngay[$trang] = ($demTheoTrang7Ngay[$trang] ?? 0) + 1;
        }
        if ($ngay >= $tu30Ngay) {
            $result['ba_muoi_ngay']++;
        }
    }
    flock($fp, LOCK_UN);
    fclose($fp);

    arsort($demTheoTrang7Ngay);
    foreach (array_slice($demTheoTrang7Ngay, 0, 5, true) as $trang => $soLuot) {
        $result['top_trang'][] = ['trang' => $trang, 'so_luot' => $soLuot];
    }
    return $result;
}
