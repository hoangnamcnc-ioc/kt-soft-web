<?php
session_start();

const ADMIN_USERNAME = 'admin';
// Mat khau that duoc gui rieng cho chu he thong qua chat, KHONG luu dang plain text o day.
const ADMIN_PASSWORD_HASH = '$2y$10$Nrjgh.1Bm4WgmpGSHgj2redtZ8EA9ksf7F5/CwYaGrGC6WJKUd4ku';

const DATA_FILE = __DIR__ . '/../data/lien_he.json';

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function admin_dang_nhap(): bool
{
    return !empty($_SESSION['admin_logged_in']);
}

function admin_yeu_cau_dang_nhap(): void
{
    if (!admin_dang_nhap()) {
        header('Location: login.php');
        exit;
    }
}

function admin_redirect(string $to): void
{
    header('Location: ' . $to);
    exit;
}

function admin_csrf_token(): string
{
    if (empty($_SESSION['admin_csrf'])) {
        $_SESSION['admin_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['admin_csrf'];
}

function admin_check_csrf(): void
{
    if (!hash_equals($_SESSION['admin_csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(403);
        exit('Phiên làm việc không hợp lệ, vui lòng tải lại trang và thử lại.');
    }
}

/** Đọc toàn bộ danh sách liên hệ (mảng, mới nhất trước), khoá file khi đọc để tránh đọc dở khi đang ghi. */
function lien_he_doc_tat_ca(): array
{
    if (!is_file(DATA_FILE)) {
        return [];
    }
    $fp = fopen(DATA_FILE, 'r');
    if (!$fp) {
        return [];
    }
    flock($fp, LOCK_SH);
    $content = stream_get_contents($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
    $data = json_decode($content, true);
    return is_array($data) ? $data : [];
}

/** Ghi đè toàn bộ danh sách liên hệ (dùng sau khi thêm/sửa/xoá 1 dòng). */
function lien_he_ghi_tat_ca(array $items): void
{
    $fp = fopen(DATA_FILE, 'c');
    if (!$fp) {
        return;
    }
    flock($fp, LOCK_EX);
    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, json_encode($items, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    flock($fp, LOCK_UN);
    fclose($fp);
}

/** Thêm 1 liên hệ mới (gọi từ lien-he.php ở trang public), tự sinh id tăng dần. */
function lien_he_them(array $fields): void
{
    $items = lien_he_doc_tat_ca();
    $maxId = 0;
    foreach ($items as $it) {
        $maxId = max($maxId, (int) ($it['id'] ?? 0));
    }
    $fields['id'] = $maxId + 1;
    $fields['da_doc'] = false;
    $items[] = $fields;
    lien_he_ghi_tat_ca($items);
}
