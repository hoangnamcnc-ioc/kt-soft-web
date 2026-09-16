<?php
require_once __DIR__ . '/qlbh_db_config.php';

/**
 * Ket noi CHI DOC den database cua QLBH-CLOUD (dung chung 1 server MySQL vi cung 1 goi hosting).
 * Tra ve null neu khong ket noi duoc - khong de loi ket noi lam vo dashboard cua kt-soft.vn.
 */
function qlbh_db(): ?PDO
{
    static $pdo = null;
    static $tried = false;
    if ($tried) {
        return $pdo;
    }
    $tried = true;
    try {
        $dsn = 'mysql:host=' . QLBH_DB_HOST . ';dbname=' . QLBH_DB_NAME . ';charset=utf8mb4';
        $pdo = new PDO($dsn, QLBH_DB_USER, QLBH_DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT => 3,
        ]);
    } catch (Throwable $e) {
        $pdo = null;
    }
    return $pdo;
}

/** Thong ke nhanh so luong khach hang da dang ky tren QLBH-CLOUD, chi doc, khong ghi. */
function qlbh_thong_ke_khach_hang(): ?array
{
    $pdo = qlbh_db();
    if (!$pdo) {
        return null;
    }
    try {
        // Tru tenant #1 (KT-SOFT chu so huu) khoi moi thong ke - khong tinh chinh minh la
        // "khach hang da dang ky".
        $tong = (int) $pdo->query("SELECT COUNT(*) FROM tenants WHERE id != 1")->fetchColumn();
        $dungThu = (int) $pdo->query("SELECT COUNT(*) FROM tenants WHERE plan = 'TRIAL' AND id != 1")->fetchColumn();
        $traPhi = (int) $pdo->query("SELECT COUNT(*) FROM tenants WHERE plan = 'PAID' AND id != 1")->fetchColumn();
        $hoatDong7Ngay = (int) $pdo->query(
            "SELECT COUNT(DISTINCT tenant_id) FROM activity_logs WHERE created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) AND tenant_id != 1"
        )->fetchColumn();
        $moiNhat = $pdo->query(
            "SELECT name, plan, created_at FROM tenants WHERE id != 1 ORDER BY created_at DESC LIMIT 5"
        )->fetchAll();
        return [
            'tong' => $tong,
            'dung_thu' => $dungThu,
            'tra_phi' => $traPhi,
            'hoat_dong_7_ngay' => $hoatDong7Ngay,
            'moi_nhat' => $moiNhat,
        ];
    } catch (Throwable $e) {
        return null;
    }
}
