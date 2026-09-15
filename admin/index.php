<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../inc_track.php';
admin_yeu_cau_dang_nhap();

$items = lien_he_doc_tat_ca();
$tongSo = count($items);
$chuaDoc = count(array_filter($items, fn($it) => empty($it['da_doc'])));
usort($items, fn($a, $b) => strcmp($b['time'] ?? '', $a['time'] ?? ''));
$moiNhat = array_slice($items, 0, 5);
$thongKeXem = doc_thong_ke_luot_xem();

$adminTitle = 'Dashboard';
require __DIR__ . '/includes/layout-head.php';
?>

<div class="stat-grid">
  <div class="stat-card"><div class="icon">📨</div><div class="num"><?= $tongSo ?></div><div class="label">Tổng số liên hệ đã nhận</div></div>
  <div class="stat-card"><div class="icon">🔴</div><div class="num" style="color:#dc2626;"><?= $chuaDoc ?></div><div class="label">Liên hệ chưa đọc</div></div>
  <div class="stat-card"><div class="icon">🌐</div><div class="num">4</div><div class="label">Sản phẩm đang giới thiệu</div></div>
</div>

<div class="card">
  <div class="card-header"><h3>📊 Lượt truy cập website</h3></div>
  <div style="padding:20px;">
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px;">
      <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
        <div style="font-size:26px;font-weight:800;color:#1d4ed8;"><?= (int) $thongKeXem['hom_nay'] ?></div>
        <div style="font-size:13px;color:#64748b;">Hôm nay</div>
      </div>
      <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
        <div style="font-size:26px;font-weight:800;color:#1d4ed8;"><?= (int) $thongKeXem['bay_ngay'] ?></div>
        <div style="font-size:13px;color:#64748b;">7 ngày qua</div>
      </div>
      <div style="text-align:center;padding:16px;background:#f8fafc;border-radius:10px;">
        <div style="font-size:26px;font-weight:800;color:#1d4ed8;"><?= (int) $thongKeXem['ba_muoi_ngay'] ?></div>
        <div style="font-size:13px;color:#64748b;">30 ngày qua</div>
      </div>
    </div>
    <?php if ($thongKeXem['top_trang']): ?>
      <div style="font-size:13px;font-weight:700;color:#475569;margin-bottom:10px;text-transform:uppercase;letter-spacing:.04em;">Trang xem nhiều nhất (7 ngày qua)</div>
      <table class="data-table">
        <tbody>
          <?php foreach ($thongKeXem['top_trang'] as $t): ?>
            <tr>
              <td style="font-family:monospace;font-size:13px;"><?= e($t['trang']) ?></td>
              <td style="text-align:right;font-weight:700;color:#1d4ed8;width:90px;"><?= (int) $t['so_luot'] ?> lượt</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p style="color:#64748b;font-size:13.5px;margin:0;">Chưa có dữ liệu lượt xem.</p>
    <?php endif; ?>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3>📨 Liên hệ mới nhất</h3>
    <a href="lien-he.php" class="btn-edit">Xem tất cả</a>
  </div>
  <table class="data-table">
    <thead><tr><th>Họ tên</th><th>SĐT</th><th>Sản phẩm quan tâm</th><th>Thời gian</th><th></th></tr></thead>
    <tbody>
      <?php if (!$moiNhat): ?>
        <tr><td colspan="5" style="color:#64748b;text-align:center;padding:24px;">Chưa có liên hệ nào.</td></tr>
      <?php endif; ?>
      <?php foreach ($moiNhat as $it): ?>
        <tr>
          <td><?= e($it['name'] ?? '') ?> <?php if (empty($it['da_doc'])): ?><span class="pill-unread">Mới</span><?php endif; ?></td>
          <td><?= e($it['phone'] ?? '') ?></td>
          <td><?= e($it['product'] ?: '—') ?></td>
          <td style="color:#64748b;font-size:13px;"><?= e(!empty($it['time']) ? date('d/m/Y H:i', strtotime($it['time'])) : '') ?></td>
          <td><a href="lien-he.php" class="btn-edit">Xem</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/includes/layout-foot.php'; ?>
