<?php
require_once __DIR__ . '/inc_download.php';

$key = $_GET['p'] ?? '';
if (!isset(DOWNLOAD_MAP[$key])) {
    http_response_code(404);
    exit('Không tìm thấy file cần tải.');
}

// Chi dem luot tai that: bo qua HEAD (bot/kiem tra lien ket) de so lieu khong bi tinh du.
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'GET') {
    tang_luot_tai($key);
}
header('Location: ' . DOWNLOAD_MAP[$key]['file']);
exit;
