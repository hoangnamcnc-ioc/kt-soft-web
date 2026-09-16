<?php
require_once __DIR__ . '/config.php';
admin_yeu_cau_dang_nhap();

$error = '';
$success = '';
$currentUser = admin_hien_tai();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_check_csrf();
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $username = trim($_POST['username'] ?? '');
        $name = trim($_POST['name'] ?? '');
        $email = trim(strtolower($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        if ($username === '' || $name === '' || $email === '' || strlen($password) < 6) {
            $error = 'Vui lòng nhập đủ Tên đăng nhập, Họ tên, Email và Mật khẩu (tối thiểu 6 ký tự). Email là bắt buộc để dùng chức năng "Quên mật khẩu" sau này.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Email không hợp lệ.';
        } elseif (nguoi_dung_tim_theo_username($username)) {
            $error = 'Tên đăng nhập này đã tồn tại, vui lòng chọn tên khác.';
        } else {
            $users = nguoi_dung_doc_tat_ca();
            $maxId = 0;
            foreach ($users as $u) {
                $maxId = max($maxId, (int) $u['id']);
            }
            $users[] = [
                'id' => $maxId + 1,
                'username' => $username,
                'name' => $name,
                'email' => $email ?: null,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
                'created_at' => date('c'),
            ];
            nguoi_dung_ghi_tat_ca($users);
            $success = 'Đã tạo tài khoản quản trị mới.';
        }
    } elseif ($action === 'update_email') {
        $email = trim(strtolower($_POST['email'] ?? ''));
        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Email không hợp lệ.';
        } else {
            $users = nguoi_dung_doc_tat_ca();
            foreach ($users as $i => $u) {
                if ((int) $u['id'] === (int) $currentUser['id']) {
                    $users[$i]['email'] = $email ?: null;
                }
            }
            nguoi_dung_ghi_tat_ca($users);
            $currentUser = admin_hien_tai();
            $success = 'Đã cập nhật email khôi phục.';
        }
    } elseif ($action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);
        if ($id === (int) $currentUser['id']) {
            $error = 'Không thể tự xóa chính tài khoản đang đăng nhập.';
        } else {
            $users = array_values(array_filter(nguoi_dung_doc_tat_ca(), fn($u) => (int) $u['id'] !== $id));
            if (!$users) {
                $error = 'Không thể xóa - hệ thống cần ít nhất 1 tài khoản quản trị.';
            } else {
                nguoi_dung_ghi_tat_ca($users);
                $success = 'Đã xóa tài khoản.';
            }
        }
    }
}

$users = nguoi_dung_doc_tat_ca();
$adminTitle = 'Người dùng quản trị';
require __DIR__ . '/includes/layout-head.php';
?>

<?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
<?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>

<div class="card">
  <div class="card-header"><h3>➕ Tạo tài khoản quản trị mới</h3></div>
  <form method="post" style="padding:20px;max-width:480px;">
    <input type="hidden" name="csrf" value="<?= e(admin_csrf_token()) ?>">
    <input type="hidden" name="action" value="add">
    <div style="margin-bottom:14px;">
      <label style="display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:#334155;">Tên đăng nhập *</label>
      <input type="text" name="username" required style="width:100%;border:1.5px solid #cbd5e1;border-radius:8px;padding:10px 13px;font-size:14px;box-sizing:border-box;">
    </div>
    <div style="margin-bottom:14px;">
      <label style="display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:#334155;">Họ tên *</label>
      <input type="text" name="name" required style="width:100%;border:1.5px solid #cbd5e1;border-radius:8px;padding:10px 13px;font-size:14px;box-sizing:border-box;">
    </div>
    <div style="margin-bottom:14px;">
      <label style="display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:#334155;">Email khôi phục *</label>
      <input type="email" name="email" required style="width:100%;border:1.5px solid #cbd5e1;border-radius:8px;padding:10px 13px;font-size:14px;box-sizing:border-box;">
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:#334155;">Mật khẩu *</label>
      <input type="password" name="password" required minlength="6" placeholder="Tối thiểu 6 ký tự" style="width:100%;border:1.5px solid #cbd5e1;border-radius:8px;padding:10px 13px;font-size:14px;box-sizing:border-box;">
    </div>
    <button type="submit" class="btn">Tạo tài khoản</button>
  </form>
</div>

<div class="card">
  <div class="card-header"><h3>✉️ Email khôi phục của tôi</h3></div>
  <form method="post" style="padding:20px;max-width:480px;">
    <input type="hidden" name="csrf" value="<?= e(admin_csrf_token()) ?>">
    <input type="hidden" name="action" value="update_email">
    <p class="muted" style="margin:0 0 12px;font-size:13px;">Dùng để nhận link đặt lại mật khẩu khi bấm "Quên mật khẩu" ở trang đăng nhập.</p>
    <div style="display:flex;gap:8px;">
      <input type="email" name="email" value="<?= e($currentUser['email'] ?? '') ?>" placeholder="email@vidu.com" style="flex:1;border:1.5px solid #cbd5e1;border-radius:8px;padding:10px 13px;font-size:14px;box-sizing:border-box;">
      <button type="submit" class="btn">Lưu</button>
    </div>
  </form>
</div>

<div class="card">
  <div class="card-header"><h3>👥 Danh sách tài khoản (<?= count($users) ?>)</h3></div>
  <table class="data-table">
    <thead><tr><th>Tên đăng nhập</th><th>Họ tên</th><th>Email</th><th>Ngày tạo</th><th></th></tr></thead>
    <tbody>
      <?php foreach ($users as $u): ?>
        <tr>
          <td><b><?= e($u['username']) ?></b><?php if ((int) $u['id'] === (int) $currentUser['id']): ?> <span class="pill-read">Đang đăng nhập</span><?php endif; ?></td>
          <td><?= e($u['name']) ?></td>
          <td class="muted"><?= e($u['email'] ?? '—') ?></td>
          <td style="color:#64748b;font-size:13px;"><?= e(!empty($u['created_at']) ? date('d/m/Y', strtotime($u['created_at'])) : '—') ?></td>
          <td>
            <?php if ((int) $u['id'] !== (int) $currentUser['id']): ?>
              <form method="post" onsubmit="return confirm('Xóa tài khoản này?');">
                <input type="hidden" name="csrf" value="<?= e(admin_csrf_token()) ?>">
                <input type="hidden" name="id" value="<?= (int) $u['id'] ?>">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn-delete">Xóa</button>
              </form>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/includes/layout-foot.php'; ?>
