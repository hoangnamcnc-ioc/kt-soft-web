<?php
require_once __DIR__ . '/config.php';
admin_yeu_cau_dang_nhap();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    admin_check_csrf();
    $id = (int) ($_POST['id'] ?? 0);
    $action = $_POST['action'] ?? '';
    $items = lien_he_doc_tat_ca();
    foreach ($items as $i => $it) {
        if ((int) ($it['id'] ?? 0) === $id) {
            if ($action === 'toggle_read') {
                $items[$i]['da_doc'] = empty($it['da_doc']);
            } elseif ($action === 'delete') {
                unset($items[$i]);
            }
            break;
        }
    }
    lien_he_ghi_tat_ca(array_values($items));
    admin_redirect('lien-he.php');
}

$items = lien_he_doc_tat_ca();
usort($items, fn($a, $b) => strcmp($b['time'] ?? '', $a['time'] ?? ''));

$adminTitle = 'Form liên hệ';
require __DIR__ . '/includes/layout-head.php';
?>

<div class="card">
  <div class="card-header">
    <h3>📨 Toàn bộ liên hệ đã nhận (<?= count($items) ?>)</h3>
  </div>
  <table class="data-table">
    <thead><tr><th>Trạng thái</th><th>Họ tên</th><th>SĐT</th><th>Sản phẩm quan tâm</th><th>Ghi chú</th><th>Thời gian</th><th></th></tr></thead>
    <tbody>
      <?php if (!$items): ?>
        <tr><td colspan="7" style="color:#64748b;text-align:center;padding:24px;">Chưa có liên hệ nào.</td></tr>
      <?php endif; ?>
      <?php foreach ($items as $it): ?>
        <tr>
          <td><?php if (empty($it['da_doc'])): ?><span class="pill-unread">Chưa đọc</span><?php else: ?><span class="pill-read">Đã đọc</span><?php endif; ?></td>
          <td><b><?= e($it['name'] ?? '') ?></b></td>
          <td><?= e($it['phone'] ?? '') ?></td>
          <td><?= e($it['product'] ?: '—') ?></td>
          <td style="max-width:260px;color:#475569;"><?= e($it['message'] ?: '—') ?></td>
          <td style="color:#64748b;font-size:13px;white-space:nowrap;"><?= e(!empty($it['time']) ? date('d/m/Y H:i', strtotime($it['time'])) : '') ?></td>
          <td class="action-btns" style="white-space:nowrap;">
            <form method="post">
              <input type="hidden" name="csrf" value="<?= e(admin_csrf_token()) ?>">
              <input type="hidden" name="id" value="<?= (int) ($it['id'] ?? 0) ?>">
              <input type="hidden" name="action" value="toggle_read">
              <button type="submit" class="btn-edit"><?= empty($it['da_doc']) ? 'Đánh dấu đã đọc' : 'Đánh dấu chưa đọc' ?></button>
            </form>
            <form method="post" onsubmit="return confirm('Xóa liên hệ này?');">
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
