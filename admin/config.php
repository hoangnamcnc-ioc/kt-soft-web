<?php
session_start();

const DATA_FILE = __DIR__ . '/../data/lien_he.json';
const USERS_FILE = __DIR__ . '/../data/admin_users.json';

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

function admin_hien_tai(): ?array
{
    if (empty($_SESSION['admin_user_id'])) {
        return null;
    }
    foreach (nguoi_dung_doc_tat_ca() as $u) {
        if ((int) $u['id'] === (int) $_SESSION['admin_user_id']) {
            return $u;
        }
    }
    return null;
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

/** Đọc 1 file JSON dạng mảng, khoá đọc để tránh đọc dở khi đang ghi. */
function doc_json_file(string $path): array
{
    if (!is_file($path)) {
        return [];
    }
    $fp = fopen($path, 'r');
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

/** Ghi đè toàn bộ 1 file JSON dạng mảng. */
function ghi_json_file(string $path, array $items): void
{
    $fp = fopen($path, 'c');
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

/** Đọc toàn bộ danh sách liên hệ (mảng, mới nhất trước), khoá file khi đọc để tránh đọc dở khi đang ghi. */
function lien_he_doc_tat_ca(): array
{
    return doc_json_file(DATA_FILE);
}

/** Ghi đè toàn bộ danh sách liên hệ (dùng sau khi thêm/sửa/xoá 1 dòng). */
function lien_he_ghi_tat_ca(array $items): void
{
    ghi_json_file(DATA_FILE, $items);
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

/** Đọc toàn bộ tài khoản quản trị. Tự seed 1 tài khoản admin/admin nếu file chưa tồn tại (lần đầu deploy). */
function nguoi_dung_doc_tat_ca(): array
{
    if (!is_file(USERS_FILE)) {
        // Giu nguyen hash cua mat khau da cap cho chu he thong luc tao admin lan dau
        // (wiFuZmMlH1fCN8) de khong lam mat quyen truy cap khi file nguoi dung duoc tao lan dau.
        $seed = [[
            'id' => 1,
            'username' => 'admin',
            'name' => 'Quản trị viên',
            'password_hash' => '$2y$10$Nrjgh.1Bm4WgmpGSHgj2redtZ8EA9ksf7F5/CwYaGrGC6WJKUd4ku',
            'created_at' => date('c'),
        ]];
        ghi_json_file(USERS_FILE, $seed);
        return $seed;
    }
    return doc_json_file(USERS_FILE);
}

function nguoi_dung_ghi_tat_ca(array $items): void
{
    ghi_json_file(USERS_FILE, $items);
}

function nguoi_dung_tim_theo_username(string $username): ?array
{
    foreach (nguoi_dung_doc_tat_ca() as $u) {
        if (strcasecmp($u['username'], $username) === 0) {
            return $u;
        }
    }
    return null;
}
