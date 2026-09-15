<?php
require_once __DIR__ . '/inc_download.php';

$key = $_POST['p'] ?? '';
$diem = (int) ($_POST['diem'] ?? 0);
$back = $_POST['back'] ?? 'index.php';
// Chi cho redirect noi bo, tranh open-redirect qua tham so back.
if (!preg_match('~^[a-z0-9_-]+\.php(#[a-z0-9-]+)?$~i', $back)) {
    $back = 'index.php';
}

if (isset(DOWNLOAD_MAP[$key]) && $diem >= 1 && $diem <= 5 && empty($_COOKIE['danhgia_' . $key])) {
    ghi_danh_gia($key, $diem);
    setcookie('danhgia_' . $key, '1', time() + 3600 * 24 * 365, '/');
}

header('Location: ' . $back . (str_contains($back, '#') ? '' : '?danhgia=1'));
exit;
