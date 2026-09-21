<?php
require_once __DIR__ . '/config.php';

if (admin_dang_nhap()) {
    admin_redirect('index.php');
}

$sent = false;
$rateLimited = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_check_csrf();
    $username = trim($_POST['username'] ?? '');

    if (dang_nhap_dang_bi_khoa() > 0) {
        // Dung chung co che khoa IP voi trang dang nhap - tranh spam gui email/do token qua
        // trang nay (chi co it tai khoan admin, nguong 5 lan/300 giay khong anh huong su dung
        // that vi rat hiem khi can bam "quen mat khau" nhieu lan lien tuc).
        $rateLimited = true;
    } elseif ($username !== '') {
        dang_nhap_ghi_that_bai();
        $user = nguoi_dung_tim_theo_username($username);
        if ($user && !empty($user['email'])) {
            $token = tao_token_dat_lai((int) $user['id']);
            $resetLink = 'https://' . $_SERVER['HTTP_HOST'] . '/admin/reset-password.php?token=' . $token;
            $subject = 'KT-SOFT Admin - Yeu cau dat lai mat khau';
            $body = "Xin chao {$user['name']},\n\n"
                . "Co yeu cau dat lai mat khau cho tai khoan quan tri \"{$user['username']}\".\n"
                . "Bam vao link duoi day de dat mat khau moi (hieu luc 1 gio):\n\n$resetLink\n\n"
                . "Neu ban khong yeu cau, vui long bo qua email nay.\n";
            sendMail($user['email'], $subject, $body);
        }
        // Luon hien thong bao giong nhau du tai khoan co ton tai/co email hay khong, tranh lo
        // thong tin ten dang nhap nao dang ton tai trong he thong.
        $sent = true;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Quên mật khẩu — KT-SOFT Admin</title>
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
  input:focus { outline: none; border-color: #1d4ed8; }
  button { width: 100%; background: #1d4ed8; color: #fff; border: none; border-radius: 8px; padding: 12px; font-size: 14.5px; font-weight: 600; cursor: pointer; }
  button:hover { background: #1e3a8a; }
  .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; padding: 12px 16px; border-radius: 8px; font-size: 13.5px; margin-bottom: 18px; line-height: 1.6; }
  .back-link { display: block; text-align: center; margin-top: 16px; font-size: 13px; color: #64748b; text-decoration: none; }
</style>
</head>
<body>
  <div class="box">
    <h1>Quên mật khẩu</h1>
    <?php if ($rateLimited): ?>
      <div class="alert-success" style="background:#fef2f2;border-color:#fecaca;color:#b91c1c;">
        Bạn đã yêu cầu quá nhiều lần. Vui lòng thử lại sau ít phút.
      </div>
      <a href="login.php" class="back-link">← Quay lại đăng nhập</a>
    <?php elseif ($sent): ?>
      <div class="alert-success">
        Nếu tài khoản này tồn tại và đã cấu hình email khôi phục, chúng tôi đã gửi link đặt lại
        mật khẩu (hiệu lực 1 giờ). Nếu không nhận được, kiểm tra hộp thư Spam hoặc đăng nhập bằng
        tài khoản khác để vào <b>Người dùng → Email khôi phục của tôi</b> cấu hình trước.
      </div>
      <a href="login.php" class="back-link">← Quay lại đăng nhập</a>
    <?php else: ?>
      <p class="sub">Nhập tên đăng nhập, chúng tôi sẽ gửi link đặt lại mật khẩu tới email khôi phục đã cấu hình cho tài khoản đó.</p>
      <form method="post">
        <input type="hidden" name="csrf" value="<?= e(admin_csrf_token()) ?>">
        <label>Tên đăng nhập</label>
        <input type="text" name="username" required autofocus>
        <button type="submit">Gửi link đặt lại mật khẩu</button>
      </form>
      <a href="login.php" class="back-link">← Quay lại đăng nhập</a>
    <?php endif; ?>
  </div>
</body>
</html>
