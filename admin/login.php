<?php
require_once __DIR__ . '/config.php';

if (admin_dang_nhap()) {
    admin_redirect('index.php');
}

$giayConKhoa = dang_nhap_dang_bi_khoa();
$loi = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($giayConKhoa > 0) {
        $conLai = ceil($giayConKhoa / 60);
        $loi = "Địa chỉ IP này đã nhập sai quá nhiều lần. Vui lòng thử lại sau khoảng $conLai phút.";
    } else {
        $username = trim($_POST['username'] ?? '');
        $pass = $_POST['password'] ?? '';
        $found = nguoi_dung_tim_theo_username($username);
        if ($found && password_verify($pass, $found['password_hash'])) {
            dang_nhap_reset_that_bai();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_user_id'] = $found['id'];
            session_regenerate_id(true);
            admin_redirect('index.php');
        }
        $conLaiLan = dang_nhap_ghi_that_bai();
        if ($conLaiLan <= 0) {
            $loi = 'Địa chỉ IP này đã nhập sai quá nhiều lần, tạm khóa 5 phút.';
        } else {
            $loi = "Tên đăng nhập hoặc mật khẩu không đúng. (Còn $conLaiLan lần thử)";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Đăng nhập quản trị — KT-SOFT</title>
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  * { box-sizing: border-box; }
  body {
    margin: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center;
    font-family: 'Inter', -apple-system, Segoe UI, Roboto, sans-serif;
    background: radial-gradient(900px 500px at 15% 0%, #143a6b, transparent 60%), linear-gradient(180deg, #060d24, #0f2557 70%, #060d24);
    padding: 24px;
  }
  .box { background: #fff; border-radius: 16px; padding: 40px; width: 100%; max-width: 400px; box-shadow: 0 20px 50px rgba(0,0,0,.35); }
  .logo { text-align: center; margin-bottom: 24px; }
  .logo .ico { width: 52px; height: 52px; border-radius: 14px; margin: 0 auto 12px; background: linear-gradient(135deg, #2dd4bf, #1d4ed8); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 800; font-family: 'Be Vietnam Pro', sans-serif; font-size: 18px; }
  .logo h1 { font-family: 'Be Vietnam Pro', sans-serif; font-size: 18px; margin: 0; color: #0f172a; }
  .logo p { font-size: 13px; color: #64748b; margin: 4px 0 0; }
  .error-msg { background: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px; font-size: 13.5px; margin-bottom: 18px; }
  .field { margin-bottom: 14px; }
  label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #334155; }
  input { width: 100%; border: 1.5px solid #cbd5e1; border-radius: 8px; padding: 10px 13px; font-size: 14px; font-family: inherit; }
  input:focus { outline: none; border-color: #1d4ed8; }
  button { width: 100%; background: #1d4ed8; color: #fff; border: none; border-radius: 8px; padding: 12px; font-size: 14.5px; font-weight: 600; cursor: pointer; margin-top: 6px; }
  button:hover { background: #1e3a8a; }
</style>
</head>
<body>
  <div class="box">
    <div class="logo">
      <div class="ico">KT</div>
      <h1>Quản trị website</h1>
      <p>KT-SOFT</p>
    </div>
    <?php if ($loi): ?><div class="error-msg">⚠️ <?= e($loi) ?></div><?php endif; ?>
    <form method="post">
      <div class="field">
        <label>Tên đăng nhập</label>
        <input type="text" name="username" required autofocus value="<?= e($_POST['username'] ?? '') ?>">
      </div>
      <div class="field">
        <label>Mật khẩu</label>
        <input type="password" name="password" required>
      </div>
      <button type="submit">Đăng nhập</button>
    </form>
  </div>
</body>
</html>
