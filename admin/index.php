<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../inc_track.php';
require_once __DIR__ . '/../inc_download.php';
require_once __DIR__ . '/qlbh_db.php';
admin_yeu_cau_dang_nhap();

$khachHang = qlbh_thong_ke_khach_hang();

// Ten hien thi rieng cho tung san pham (key khop voi DOWNLOAD_MAP trong inc_download.php).
// Dung 1 mang + vong lap thay vi chep code cho tung san pham - them san pham moi vao
// DOWNLOAD_MAP la dashboard tu hien them, khong phai sua file nay.
$tenSanPhamTai = [
    'qlbh-soft' => 'QLBH-SOFT',
    'qlcf-soft' => 'QLCF-SOFT',
    'qlcv' => 'QLCV',
    'ke-toan' => 'KT-SOFT (Kế toán)',
];
$thongKeTai = [];
foreach (DOWNLOAD_MAP as $key => $info) {
    $thongKeTai[$key] = [
        'ten' => $tenSanPhamTai[$key] ?? $info['ten'],
        'luot_tai' => doc_luot_tai($key),
        'danh_gia' => doc_danh_gia($key),
    ];
}

$items = lien_he_doc_tat_ca();
$tongSo = count($items);
$chuaDoc = count(array_filter($items, fn($it) => empty($it['da_doc'])));
usort($items, fn($a, $b) => strcmp($b['time'] ?? '', $a['time'] ?? ''));
$moiNhat = array_slice($items, 0, 5);
$thongKeXem = doc_thong_ke_luot_xem();

// May QLBH-SOFT / QLCF-SOFT dang dung (tin hieu an danh gui ve ping_api.php; moi san pham 1 file rieng)
$tuNgay = function (int $soNgay): string { return date('Y-m-d', strtotime('-' . ($soNgay - 1) . ' days')); };
$thongKeCaiDat = function (string $file, string $phienBanMoi) use ($tuNgay): array {
    $cais = doc_json_file($file);
    $kq = ['tong' => count($cais), 'dang_dung_7' => 0, 'dang_dung_30' => 0, 'moi_7' => 0, 'phien_ban' => [], 'ban_moi' => 0, 'ban_cu' => 0, 'moi_nhat' => $phienBanMoi];
    foreach ($cais as $c) {
        $l = (string) ($c['l'] ?? '');
        $f = (string) ($c['f'] ?? '');
        if ($l >= $tuNgay(7)) { $kq['dang_dung_7']++; }
        if ($l >= $tuNgay(30)) {
            $kq['dang_dung_30']++;
            $pb = (string) ($c['v'] ?? '?');
            $kq['phien_ban'][$pb] = ($kq['phien_ban'][$pb] ?? 0) + 1;
            // May dang dung (30 ngay) da len ban moi nhat chua?
            if ($phienBanMoi !== '' && version_compare($pb, $phienBanMoi, '>=')) { $kq['ban_moi']++; } elseif ($phienBanMoi !== '') { $kq['ban_cu']++; }
        }
        if ($f >= $tuNgay(7)) { $kq['moi_7']++; }
    }
    uksort($kq['phien_ban'], fn($x, $y) => version_compare($y, $x));
    return $kq;
};
$docPhienBanMoi = function (string $file): string {
    $d = json_decode((string) @file_get_contents($file), true);
    return is_array($d) ? (string) ($d['version'] ?? '') : '';
};
$caiDat = $thongKeCaiDat(__DIR__ . '/../data/installs.json', $docPhienBanMoi(__DIR__ . '/../qlbh-soft-version.json'));
$caiDatCf = $thongKeCaiDat(__DIR__ . '/../data/installs_qlcf.json', $docPhienBanMoi(__DIR__ . '/../qlcf-soft-version.json'));

$adminTitle = 'Dashboard';
require __DIR__ . '/includes/layout-head.php';
?>

<div class="stat-grid">
  <div class="stat-card"><div class="icon">📨</div><div class="num"><?= $tongSo ?></div><div class="label">Tổng số liên hệ đã nhận</div></div>
  <div class="stat-card"><div class="icon">🔴</div><div class="num" style="color:#dc2626;"><?= $chuaDoc ?></div><div class="label">Liên hệ chưa đọc</div></div>
  <div class="stat-card"><div class="icon">🌐</div><div class="num">4</div><div class="label">Sản phẩm đang giới thiệu</div></div>
</div>

<?php foreach ([['QLBH-SOFT', $caiDat], ['QLCF-SOFT', $caiDatCf]] as [$tenSp, $cd]): ?>
<div class="card">
  <div class="card-header"><h3>💻 Máy đang dùng <?= e($tenSp) ?></h3></div>
  <div style="padding:20px;">
    <div class="mini-grid-4">
      <div><div class="num"><?= (int) $cd['dang_dung_7'] ?></div><div class="label">Đang dùng (7 ngày)</div></div>
      <div><div class="num"><?= (int) $cd['dang_dung_30'] ?></div><div class="label">Đang dùng (30 ngày)</div></div>
      <div><div class="num"><?= (int) $cd['moi_7'] ?></div><div class="label">Cài mới (7 ngày)</div></div>
      <div><div class="num"><?= (int) $cd['tong'] ?></div><div class="label">Tổng số máy từng gửi tín hiệu</div></div>
    </div>
    <?php if ($cd['moi_nhat'] !== '' && $cd['dang_dung_30'] > 0): ?>
      <p style="margin:14px 0 6px;font-weight:600;">Cập nhật lên bản mới nhất (v<?= e($cd['moi_nhat']) ?>)</p>
      <p style="margin:0;"><span style="color:#059669;font-weight:700;"><?= (int) $cd['ban_moi'] ?> máy đã cập nhật</span> · <span style="color:<?= $cd['ban_cu'] > 0 ? '#d97706' : '#64748b' ?>;font-weight:700;"><?= (int) $cd['ban_cu'] ?> máy còn chạy bản cũ</span> (cần nhắc cập nhật)</p>
    <?php endif; ?>
    <?php if ($cd['phien_ban']): ?>
      <p style="margin:14px 0 6px;font-weight:600;">Phiên bản đang chạy (30 ngày qua)</p>
      <table class="data-table"><tbody>
        <?php foreach ($cd['phien_ban'] as $pb => $so): ?>
          <tr><td>v<?= e($pb) ?></td><td style="text-align:right;font-weight:700;"><?= (int) $so ?> máy</td></tr>
        <?php endforeach; ?>
      </tbody></table>
    <?php endif; ?>
    <p style="color:#64748b;font-size:12.5px;margin:12px 0 0;">Số liệu ẩn danh: mỗi máy gửi tối đa 1 lần/ngày mã cài đặt ngẫu nhiên và số phiên bản; không có tên cửa hàng hay dữ liệu bán hàng. Máy tắt tính năng này hoặc không có mạng sẽ không được tính.</p>
  </div>
</div>
<?php endforeach; ?>

<div class="card">
  <div class="card-header"><h3>☁️ Khách hàng QLBH-CLOUD</h3></div>
  <div style="padding:20px;">
    <?php if ($khachHang === null): ?>
      <p style="color:#64748b;font-size:13.5px;margin:0;">Không kết nối được tới dữ liệu QLBH-CLOUD lúc này.</p>
    <?php else: ?>
      <div class="mini-grid-4">
        <div class="mini-stat">
          <div class="num"><?= (int) $khachHang['tong'] ?></div>
          <div class="label">Tổng đã đăng ký</div>
        </div>
        <div class="mini-stat">
          <div class="num" style="color:#d97706;"><?= (int) $khachHang['dung_thu'] ?></div>
          <div class="label">Đang dùng thử</div>
        </div>
        <div class="mini-stat">
          <div class="num" style="color:#059669;"><?= (int) $khachHang['tra_phi'] ?></div>
          <div class="label">Đã trả phí</div>
        </div>
        <div class="mini-stat">
          <div class="num"><?= (int) $khachHang['hoat_dong_7_ngay'] ?></div>
          <div class="label">Hoạt động 7 ngày qua</div>
        </div>
      </div>
      <?php if ($khachHang['moi_nhat']): ?>
        <div style="font-size:13px;font-weight:700;color:#475569;margin-bottom:10px;text-transform:uppercase;letter-spacing:.04em;">Đăng ký gần nhất</div>
        <table class="data-table">
          <tbody>
            <?php foreach ($khachHang['moi_nhat'] as $t): ?>
              <tr>
                <td><?= e($t['name']) ?></td>
                <td><?= $t['plan'] === 'PAID' ? '<span class="pill-read" style="background:#d1fae5;color:#065f46;">Trả phí</span>' : '<span class="pill-unread">Dùng thử</span>' ?></td>
                <td style="text-align:right;color:#64748b;font-size:13px;"><?= date('d/m/Y', strtotime($t['created_at'])) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<div class="card">
  <div class="card-header"><h3>📊 Lượt truy cập website</h3></div>
  <div style="padding:20px;">
    <div class="mini-grid-3">
      <div class="mini-stat">
        <div class="num"><?= (int) $thongKeXem['hom_nay'] ?></div>
        <div class="label">Hôm nay</div>
      </div>
      <div class="mini-stat">
        <div class="num"><?= (int) $thongKeXem['bay_ngay'] ?></div>
        <div class="label">7 ngày qua</div>
      </div>
      <div class="mini-stat">
        <div class="num"><?= (int) $thongKeXem['ba_muoi_ngay'] ?></div>
        <div class="label">30 ngày qua</div>
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
  <div class="card-header"><h3>💻 Tải về &amp; đánh giá phần mềm</h3></div>
  <div style="padding:20px;">
    <table class="data-table">
      <thead><tr><th>Phần mềm</th><th style="text-align:right;">Lượt tải</th><th style="text-align:right;">Đánh giá</th></tr></thead>
      <tbody>
        <?php foreach ($thongKeTai as $tk): ?>
          <tr>
            <td><?= e($tk['ten']) ?></td>
            <td style="text-align:right;font-weight:700;color:#1d4ed8;">⬇️ <?= (int) $tk['luot_tai'] ?></td>
            <td style="text-align:right;color:#d97706;font-weight:700;">
              <?= $tk['danh_gia']['so_luot'] > 0
                    ? $tk['danh_gia']['trung_binh'] . '/5 ⭐ <span style="color:#64748b;font-weight:400;">(' . $tk['danh_gia']['so_luot'] . ')</span>'
                    : '<span style="color:#94a3b8;font-weight:400;">— chưa có đánh giá</span>' ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
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
