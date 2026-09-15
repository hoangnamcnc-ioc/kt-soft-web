<?php
session_start();

const DATA_FILE = __DIR__ . '/../data/lien_he.json';
const USERS_FILE = __DIR__ . '/../data/admin_users.json';
const LOGIN_ATTEMPTS_FILE = __DIR__ . '/../data/login_attempts.json';
const DANG_NHAP_TOI_DA = 5;
const DANG_NHAP_KHOA_GIAY = 300;

function dang_nhap_ip(): string
{
    return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
}

/**
 * Khoa dang nhap sai qua nhieu lan THEO IP, luu vao file (khong chi session) - luu trong session
 * de ke tan cong tu xoa cookie roi thu lai vo han lan, mat het tac dung chong brute-force.
 */
function dang_nhap_dang_bi_khoa(): int
{
    $data = doc_json_file(LOGIN_ATTEMPTS_FILE);
    $ip = dang_nhap_ip();
    $khoaDen = (int) ($data[$ip]['khoa_den'] ?? 0);
    return $khoaDen > time() ? $khoaDen - time() : 0;
}

function dang_nhap_ghi_that_bai(): int
{
    $data = doc_json_file(LOGIN_ATTEMPTS_FILE);
    $ip = dang_nhap_ip();
    $soLan = (int) ($data[$ip]['so_lan'] ?? 0) + 1;
    if ($soLan >= DANG_NHAP_TOI_DA) {
        $data[$ip] = ['so_lan' => 0, 'khoa_den' => time() + DANG_NHAP_KHOA_GIAY];
    } else {
        $data[$ip] = ['so_lan' => $soLan, 'khoa_den' => 0];
    }
    ghi_json_file(LOGIN_ATTEMPTS_FILE, $data);
    return DANG_NHAP_TOI_DA - $soLan;
}

function dang_nhap_reset_that_bai(): void
{
    $data = doc_json_file(LOGIN_ATTEMPTS_FILE);
    unset($data[dang_nhap_ip()]);
    ghi_json_file(LOGIN_ATTEMPTS_FILE, $data);
}

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
    // Kiem tra ca ban ghi nguoi dung con ton tai that (khong chi co flag session) - tranh truong
    // hop 1 tai khoan bi xoa nhung phien dang nhap cu van tiep tuc dung duoc cho toi khi tu dang xuat.
    if (!admin_dang_nhap() || admin_hien_tai() === null) {
        $_SESSION = [];
        session_destroy();
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

/**
 * Đọc toàn bộ tài khoản quản trị.
 *
 * KHÔNG tự tạo lại tài khoản với mật khẩu cố định nếu file bị mất - làm vậy sẽ nhúng 1 "cửa sau"
 * vĩnh viễn vào source code (repo này là repo PUBLIC trên GitHub). Nếu file dữ liệu thực sự mất,
 * phải tạo tài khoản mới thủ công qua 1 script tạm (đúng quy trình fix_*.php), không phải tự động
 * phục hồi 1 mật khẩu đã biết trước.
 */
function nguoi_dung_doc_tat_ca(): array
{
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
