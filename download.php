<?php
require_once __DIR__ . '/inc_download.php';

$key = $_GET['p'] ?? '';
if (!isset(DOWNLOAD_MAP[$key])) {
    http_response_code(404);
    exit('Không tìm thấy file cần tải.');
}

// Chi dem luot tai that: bo qua HEAD (bot/kiem tra lien ket) de so lieu khong bi tinh du.
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET') {
    $loai = phan_loai_luot_tai($key);
    ghi_nhat_ky_tai($key, $loai);
    if ($loai === 'that') {
        tang_luot_tai($key); // robot / tai lai trong 1 gio khong cong vao luot tai
    }
}
header('Location: ' . DOWNLOAD_MAP[$key]['file']);
exit;
