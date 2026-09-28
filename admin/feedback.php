<?php
require_once __DIR__ . '/config.php';
admin_yeu_cau_dang_nhap();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_check_csrf();
    $id = (int) ($_POST['id'] ?? 0);
    $action = $_POST['action'] ?? '';
    $items = feedback_doc_tat_ca();
    foreach ($items as $i => $it) {
        if ((int) ($it['id'] ?? 0) === $id) {
            if ($action === 'toggle_done') {
                $items[$i]['da_xu_ly'] = empty($it['da_xu_ly']);
            } elseif ($action === 'delete') {
                unset($items[$i]);
            }
            break;
        }
    }
    feedback_ghi_tat_ca(array_values($items));
    admin_redirect('feedback.php');
}

$items = feedback_doc_tat_ca();
usort($items, fn($a, $b) => strcmp($b['time'] ?? '', $a['time'] ?? ''));

// Loc theo san pham/loai/trang thai qua tham so URL - danh sach chung ca 3 san pham co the dai
// dan theo thoi gian, can loc nhanh de tim dung viec can xu ly.
$locSanPham = $_GET['san_pham'] ?? '';
$locLoai = $_GET['loai'] ?? '';
$locTrangThai = $_GET['trang_thai'] ?? '';
if ($locSanPham !== '') {
    $items = array_values(array_filter($items, fn($it) => ($it['san_pham'] ?? '') === $locSanPham));
}
if ($locLoai !== '') {
    $items = array_values(array_filter($items, fn($it) => ($it['loai'] ?? '') === $locLoai));
}
if ($locTrangThai === 'chua_xu_ly') {
    $items = array_values(array_filter($items, fn($it) => empty($it['da_xu_ly'])));
} elseif ($locTrangThai === 'da_xu_ly') {
    $items = array_values(array_filter($items, fn($it) => !empty($it['da_xu_ly'])));
}

$loaiNhan = ['bao_loi' => 'Báo lỗi', 'gop_y' => 'Góp ý', 'khac' => 'Khác'];
$soChuaXuLy = count(array_filter(feedback_doc_tat_ca(), fn($it) => empty($it['da_xu_ly'])));

$adminTitle = 'Phản hồi từ người dùng';
require __DIR__ . '/includes/layout-head.php';
?>

<div class="card">
  <div class="card-header">
    <h3>💬 Phản hồi từ người dùng (<?= count($items) ?><?= $soChuaXuLy > 0 ? ', ' . $soChuaXuLy . ' chưa xử lý' : '' ?>)</h3>
  </div>
  <form method="get" style="display:flex;gap:10px;flex-wrap:wrap;padding:14px 20px;border-bottom:1px solid #eee;">
    <select name="san_pham" onchange="this.form.submit()">
      <option value="">Tất cả sản phẩm</option>
      <?php foreach (['QLBH-CLOUD', 'QLBH-SOFT', 'KT-SOFT'] as $sp): ?>
        <option value="<?= e($sp) ?>" <?= $locSanPham === $sp ? 'selected' : '' ?>><?= e($sp) ?></option>
      <?php endforeach; ?>
    </select>
    <select name="loai" onchange="this.form.submit()">
      <option value="">Tất cả loại</option>
      <?php foreach ($loaiNhan as $k => $v): ?>
        <option value="<?= e($k) ?>" <?= $locLoai === $k ? 'selected' : '' ?>><?= e($v) ?></option>
      <?php endforeach; ?>
    </select>
    <select name="trang_thai" onchange="this.form.submit()">
      <option value="">Tất cả trạng thái</option>
      <option value="chua_xu_ly" <?= $locTrangThai === 'chua_xu_ly' ? 'selected' : '' ?>>Chưa xử lý</option>
      <option value="da_xu_ly" <?= $locTrangThai === 'da_xu_ly' ? 'selected' : '' ?>>Đã xử lý</option>
    </select>
  </form>
  <table class="data-table">
    <thead><tr><th>Trạng thái</th><th>Sản phẩm</th><th>Loại</th><th>Nội dung</th><th>Người gửi</th><th>Thời gian</th><th></th></tr></thead>
    <tbody>
      <?php if (!$items): ?>
        <tr><td colspan="7" style="color:#64748b;text-align:center;padding:24px;">Chưa có phản hồi nào.</td></tr>
      <?php endif; ?>
      <?php foreach ($items as $it): ?>
        <tr>
          <td><?php if (empty($it['da_xu_ly'])): ?><span class="pill-unread">Chưa xử lý</span><?php else: ?><span class="pill-read">Đã xử lý</span><?php endif; ?></td>
          <td><b><?= e($it['san_pham'] ?? '') ?></b><?php if (!empty($it['phien_ban'])): ?><div style="color:#94a3b8;font-size:12px;">v<?= e($it['phien_ban']) ?></div><?php endif; ?></td>
          <td><?= e($loaiNhan[$it['loai'] ?? ''] ?? ($it['loai'] ?? '')) ?></td>
          <td style="max-width:340px;color:#475569;white-space:pre-wrap;"><?= e($it['noi_dung'] ?? '') ?>
            <?php if (!empty($it['may_tinh'])): ?><div style="color:#94a3b8;font-size:12px;margin-top:4px;"><?= e($it['may_tinh']) ?></div><?php endif; ?>
          </td>
          <td>
            <?= e($it['nguoi_gui'] ?: '—') ?>
            <?php if (!empty($it['lien_he'])): ?><div style="color:#64748b;font-size:12px;"><?= e($it['lien_he']) ?></div><?php endif; ?>
          </td>
          <td style="color:#64748b;font-size:13px;white-space:nowrap;"><?= e(!empty($it['time']) ? date('d/m/Y H:i', strtotime($it['time'])) : '') ?></td>
          <td class="action-btns" style="white-space:nowrap;">
            <form method="post">
              <input type="hidden" name="csrf" value="<?= e(admin_csrf_token()) ?>">
              <input type="hidden" name="id" value="<?= (int) ($it['id'] ?? 0) ?>">
              <input type="hidden" name="action" value="toggle_done">
              <button type="submit" class="btn-edit"><?= empty($it['da_xu_ly']) ? 'Đánh dấu đã xử lý' : 'Đánh dấu chưa xử lý' ?></button>
            </form>
            <form method="post" onsubmit="return confirm('Xóa phản hồi này?');">
              <input type="hidden" name="csrf" value="<?= e(admin_csrf_token()) ?>">
              <input type="hidden" name="id" value="<?= (int) ($it['id'] ?? 0) ?>">
              <input type="hidden" name="action" value="delete">
              <button type="submit" class="btn-delete">Xóa</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/includes/layout-foot.php'; ?>
