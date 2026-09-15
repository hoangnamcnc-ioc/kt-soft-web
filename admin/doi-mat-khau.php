<?php
require_once __DIR__ . '/config.php';
admin_yeu_cau_dang_nhap();

$currentUser = admin_hien_tai();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_check_csrf();
    $matKhauCu = $_POST['mat_khau_cu'] ?? '';
    $matKhauMoi = $_POST['mat_khau_moi'] ?? '';
    $matKhauMoiLai = $_POST['mat_khau_moi_lai'] ?? '';

    if (!password_verify($matKhauCu, $currentUser['password_hash'])) {
        $error = 'Mật khẩu hiện tại không đúng.';
    } elseif (strlen($matKhauMoi) < 6) {
        $error = 'Mật khẩu mới phải có ít nhất 6 ký tự.';
    } elseif ($matKhauMoi !== $matKhauMoiLai) {
        $error = 'Xác nhận mật khẩu mới không khớp.';
    } else {
        $users = nguoi_dung_doc_tat_ca();
        foreach ($users as $i => $u) {
            if ((int) $u['id'] === (int) $currentUser['id']) {
                $users[$i]['password_hash'] = password_hash($matKhauMoi, PASSWORD_DEFAULT);
            }
        }
        nguoi_dung_ghi_tat_ca($users);
        $success = 'Đã đổi mật khẩu thành công.';
    }
}

$adminTitle = 'Đổi mật khẩu';
require __DIR__ . '/includes/layout-head.php';
?>

<?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
<?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>

<div class="card">
  <div class="card-header"><h3>🔒 Đổi mật khẩu đăng nhập</h3></div>
  <form method="post" style="padding:20px;max-width:420px;">
    <input type="hidden" name="csrf" value="<?= e(admin_csrf_token()) ?>">
    <div style="margin-bottom:14px;">
      <label style="display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:#334155;">Mật khẩu hiện tại *</label>
      <input type="password" name="mat_khau_cu" required style="width:100%;border:1.5px solid #cbd5e1;border-radius:8px;padding:10px 13px;font-size:14px;box-sizing:border-box;">
    </div>
    <div style="margin-bottom:14px;">
      <label style="display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:#334155;">Mật khẩu mới *</label>
      <input type="password" name="mat_khau_moi" required minlength="6" placeholder="Tối thiểu 6 ký tự" style="width:100%;border:1.5px solid #cbd5e1;border-radius:8px;padding:10px 13px;font-size:14px;box-sizing:border-box;">
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:#334155;">Nhập lại mật khẩu mới *</label>
      <input type="password" name="mat_khau_moi_lai" required minlength="6" style="width:100%;border:1.5px solid #cbd5e1;border-radius:8px;padding:10px 13px;font-size:14px;box-sizing:border-box;">
    </div>
    <button type="submit" class="btn">Đổi mật khẩu</button>
  </form>
</div>

<?php require __DIR__ . '/includes/layout-foot.php'; ?>
