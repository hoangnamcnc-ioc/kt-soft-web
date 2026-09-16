<?php
require_once __DIR__ . '/config.php';

$token = $_GET['token'] ?? $_POST['token'] ?? '';
$userId = kiem_tra_token_dat_lai($token);
$error = null;
$success = false;

if ($userId && $_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_check_csrf();
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if (strlen($password) < 6) {
        $error = 'Mật khẩu mới phải có ít nhất 6 ký tự.';
    } elseif ($password !== $password2) {
        $error = 'Xác nhận mật khẩu không khớp.';
    } else {
        $users = nguoi_dung_doc_tat_ca();
        foreach ($users as $i => $u) {
            if ((int) $u['id'] === $userId) {
                $users[$i]['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
            }
        }
        nguoi_dung_ghi_tat_ca($users);
        danh_dau_token_da_dung($token, $userId);
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Đặt lại mật khẩu — KT-SOFT Admin</title>
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
  h1 { font-family: 'Be Vietnam Pro', sans-serif; font-size: 18px; margin: 0 0 8px; color: #0f172a; }
  p.sub { font-size: 13.5px; color: #64748b; line-height: 1.6; margin: 0 0 20px; }
  label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #334155; }
  input { width: 100%; border: 1.5px solid #cbd5e1; border-radius: 8px; padding: 10px 13px; font-size: 14px; font-family: inherit; margin-bottom: 16px; }
  button { width: 100%; background: #1d4ed8; color: #fff; border: none; border-radius: 8px; padding: 12px; font-size: 14.5px; font-weight: 600; cursor: pointer; }
  button:hover { background: #1e3a8a; }
  .alert-error { background: #fee2e2; border: 1px solid #fecaca; color: #dc2626; padding: 12px 16px; border-radius: 8px; font-size: 13.5px; margin-bottom: 18px; }
  .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; padding: 12px 16px; border-radius: 8px; font-size: 13.5px; margin-bottom: 18px; }
  .back-link { display: block; text-align: center; margin-top: 16px; font-size: 13px; color: #64748b; text-decoration: none; }
</style>
</head>
<body>
  <div class="box">
    <h1>Đặt lại mật khẩu</h1>
    <?php if (!$userId): ?>
      <div class="alert-error">Link đặt lại mật khẩu không hợp lệ hoặc đã hết hạn (chỉ có hiệu lực trong 1 giờ). Vui lòng yêu cầu lại.</div>
      <a href="forgot-password.php" class="back-link">Yêu cầu link mới →</a>
    <?php elseif ($success): ?>
      <div class="alert-success">Đã đặt lại mật khẩu thành công. Bạn có thể đăng nhập bằng mật khẩu mới.</div>
      <a href="login.php" class="back-link">Đăng nhập ngay →</a>
    <?php else: ?>
      <p class="sub">Nhập mật khẩu mới cho tài khoản của bạn.</p>
      <?php if ($error): ?><div class="alert-error"><?= e($error) ?></div><?php endif; ?>
      <form method="post">
        <input type="hidden" name="csrf" value="<?= e(admin_csrf_token()) ?>">
        <input type="hidden" name="token" value="<?= e($token) ?>">
        <label>Mật khẩu mới</label>
        <input type="password" name="password" required minlength="6" placeholder="Tối thiểu 6 ký tự">
        <label>Nhập lại mật khẩu mới</label>
        <input type="password" name="password2" required minlength="6">
        <button type="submit">Đặt lại mật khẩu</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
