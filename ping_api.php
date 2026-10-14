<?php
// Tin hieu an danh tu phan mem QLBH-SOFT / QLCF-SOFT: ma cai dat ngau nhien + phien ban + he dieu hanh.
// KHONG luu dia chi IP, ten cua hang hay bat ky du lieu kinh doanh nao. Xem thong ke trong trang quan tri.
// Truong 'sp' (san pham) la tuy chon: 'qlcf-soft' ghi vao file rieng; vang mat = QLBH-SOFT (ban cu khong gui truong nay).
const INSTALLS_FILES = [
    'qlbh-soft' => __DIR__ . '/data/installs.json',
    'qlcf-soft' => __DIR__ . '/data/installs_qlcf.json',
];

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    echo '{"ok":false}';
    exit;
}

$raw = file_get_contents('php://input', false, null, 0, 1024);
$d = json_decode($raw === false ? '' : $raw, true);
$id = is_array($d) ? (string) ($d['id'] ?? '') : '';
$v = is_array($d) ? (string) ($d['v'] ?? '') : '';
$os = is_array($d) ? (string) ($d['os'] ?? '') : '';
$sp = is_array($d) ? (string) ($d['sp'] ?? 'qlbh-soft') : 'qlbh-soft';

if (!isset(INSTALLS_FILES[$sp]) || !preg_match('/^[a-f0-9]{32}$/', $id) || !preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}$/', $v) || !in_array($os, ['win32', 'darwin', 'linux'], true)) {
    http_response_code(400);
    echo '{"ok":false}';
    exit;
}

$fp = @fopen(INSTALLS_FILES[$sp], 'c+');
if (!$fp) {
    http_response_code(500);
    echo '{"ok":false}';
    exit;
}
flock($fp, LOCK_EX);
$cur = json_decode((string) stream_get_contents($fp), true);
if (!is_array($cur)) {
    $cur = [];
}
$homNay = date('Y-m-d');
if (isset($cur[$id])) {
    $cur[$id]['l'] = $homNay;
    $cur[$id]['v'] = $v;
    $cur[$id]['o'] = $os;
} elseif (count($cur) < 50000) {
    $cur[$id] = ['f' => $homNay, 'l' => $homNay, 'v' => $v, 'o' => $os];
}
ftruncate($fp, 0);
rewind($fp);
fwrite($fp, json_encode($cur));
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);
echo '{"ok":true}';
