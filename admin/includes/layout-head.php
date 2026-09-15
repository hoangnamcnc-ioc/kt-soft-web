<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title><?= e($adminTitle ?? 'Admin') ?> — KT-SOFT</title>
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --primary: #1d4ed8; --primary-dark: #1e3a8a; --primary-light: #eff6ff; --teal: #0d9488;
    --gray-50: #f8fafc; --gray-100: #f1f5f9; --gray-200: #e2e8f0; --gray-300: #cbd5e1;
    --gray-500: #64748b; --gray-600: #475569; --gray-700: #334155; --gray-900: #0f172a;
    --danger: #dc2626; --radius: 8px; --radius-lg: 12px;
    --font: 'Inter', -apple-system, Segoe UI, Roboto, sans-serif;
  }
  * { box-sizing: border-box; }
  body { margin: 0; font-family: var(--font); background: var(--gray-100); color: var(--gray-900); }
  h1, h2, h3 { font-family: 'Be Vietnam Pro', var(--font); margin: 0; }
  a { color: var(--primary); text-decoration: none; }
  .admin-wrap { display: flex; min-height: 100vh; }

  .admin-sidebar { width: 240px; background: #0b1120; color: #fff; flex-shrink: 0; display: flex; flex-direction: column; }
  .admin-sidebar .brand { padding: 20px; border-bottom: 1px solid rgba(255,255,255,.08); display: flex; align-items: center; gap: 10px; }
  .admin-sidebar .brand .ico { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #2dd4bf, var(--primary)); display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 14px; flex-shrink: 0; }
  .admin-sidebar .brand-name { font-size: 13px; font-weight: 700; }
  .admin-sidebar .brand-sub { font-size: 11px; color: rgba(255,255,255,.45); }
  .admin-nav { padding: 12px 0; flex: 1; }
  .admin-nav .nav-section { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: rgba(255,255,255,.35); padding: 16px 20px 6px; }
  .admin-nav a { display: flex; align-items: center; gap: 10px; padding: 9px 20px; color: rgba(255,255,255,.72); font-size: 14px; }
  .admin-nav a:hover { background: rgba(255,255,255,.06); color: #fff; }
  .admin-nav a.active { background: var(--primary); color: #fff; }
  .admin-nav .ico { width: 20px; text-align: center; font-size: 15px; }
  .badge-count { margin-left: auto; background: var(--danger); color: #fff; font-size: 11px; font-weight: 700; padding: 1px 7px; border-radius: 999px; }
  .admin-nav .foot-links { margin-top: 12px; border-top: 1px solid rgba(255,255,255,.08); padding-top: 8px; }

  .admin-main { flex: 1; display: flex; flex-direction: column; min-width: 0; }
  .admin-topbar { background: #fff; border-bottom: 1px solid var(--gray-200); padding: 14px 24px; display: flex; align-items: center; justify-content: space-between; }
  .admin-topbar h1 { font-size: 18px; font-weight: 700; }
  .admin-content { padding: 24px; flex: 1; }

  .stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 24px; }
  .stat-card { background: #fff; border-radius: var(--radius-lg); padding: 20px; border: 1px solid var(--gray-200); }
  .stat-card .num { font-size: 28px; font-weight: 800; color: var(--primary); }
  .stat-card .label { font-size: 13px; color: var(--gray-500); margin-top: 4px; }
  .stat-card .icon { font-size: 22px; margin-bottom: 10px; }

  .card { background: #fff; border-radius: var(--radius-lg); border: 1px solid var(--gray-200); margin-bottom: 24px; }
  .card-header { padding: 16px 20px; border-bottom: 1px solid var(--gray-200); display: flex; align-items: center; justify-content: space-between; }
  .card-header h3 { font-size: 15px; font-weight: 700; }

  table.data-table { width: 100%; border-collapse: collapse; font-size: 14px; }
  table.data-table th { background: var(--gray-50); padding: 11px 16px; text-align: left; font-weight: 600; color: var(--gray-600); font-size: 12px; text-transform: uppercase; letter-spacing: .04em; }
  table.data-table td { padding: 12px 16px; border-top: 1px solid var(--gray-100); vertical-align: middle; }
  table.data-table tr:hover td { background: var(--gray-50); }
  .btn { display: inline-flex; align-items: center; gap: 6px; background: var(--primary); color: #fff; border: none; padding: 9px 16px; border-radius: var(--radius); font-size: 13.5px; font-weight: 600; cursor: pointer; }
  .btn:hover { background: var(--primary-dark); }
  .btn-sm { padding: 5px 12px; font-size: 13px; }
  .btn-edit { background: var(--primary-light); color: var(--primary); border: none; padding: 5px 12px; border-radius: 6px; font-size: 13px; cursor: pointer; }
  .btn-edit:hover { background: var(--primary); color: #fff; }
  .btn-delete { background: #fee2e2; color: var(--danger); border: none; padding: 5px 12px; border-radius: 6px; font-size: 13px; cursor: pointer; }
  .btn-delete:hover { background: var(--danger); color: #fff; }
  .action-btns { display: flex; gap: 6px; }
  .pill-unread { background: #fef3c7; color: #92400e; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
  .pill-read { background: var(--gray-100); color: var(--gray-500); padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
  .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 20px; font-size: 14px; }
  .alert-success { background: #d1fae5; color: #065f46; }
  .alert-error { background: #fee2e2; color: var(--danger); }
</style>
</head>
<body>
<div class="admin-wrap">
  <aside class="admin-sidebar">
    <div class="brand">
      <div class="ico">KT</div>
      <div><div class="brand-name">KT-SOFT Admin</div><div class="brand-sub">Quản trị website</div></div>
    </div>
    <?php $curFile = basename($_SERVER['SCRIPT_NAME']); $chuaDoc = count(array_filter(lien_he_doc_tat_ca(), fn($it) => empty($it['da_doc']))); ?>
    <nav class="admin-nav">
      <div class="nav-section">Tổng quan</div>
      <a href="index.php" class="<?= $curFile === 'index.php' ? 'active' : '' ?>"><span class="ico">📊</span> Dashboard</a>

      <div class="nav-section">Khách hàng</div>
      <a href="lien-he.php" class="<?= $curFile === 'lien-he.php' ? 'active' : '' ?>">
        <span class="ico">📨</span> Form liên hệ
        <?php if ($chuaDoc > 0): ?><span class="badge-count"><?= $chuaDoc ?></span><?php endif; ?>
      </a>

      <div class="nav-section">Hệ thống</div>
      <a href="nguoi-dung.php" class="<?= $curFile === 'nguoi-dung.php' ? 'active' : '' ?>"><span class="ico">👥</span> Người dùng</a>
      <a href="doi-mat-khau.php" class="<?= $curFile === 'doi-mat-khau.php' ? 'active' : '' ?>"><span class="ico">🔒</span> Đổi mật khẩu</a>

      <div class="foot-links">
        <a href="../index.php" target="_blank"><span class="ico">🌐</span> Xem trang web</a>
        <a href="logout.php"><span class="ico">🚪</span> Đăng xuất</a>
      </div>
    </nav>
  </aside>
  <div class="admin-main">
    <div class="admin-topbar">
      <h1><?= e($adminTitle ?? 'Dashboard') ?></h1>
      <div><?= $topbarActions ?? '' ?></div>
    </div>
    <div class="admin-content">
