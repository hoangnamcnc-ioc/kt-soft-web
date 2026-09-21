<?php
require_once __DIR__ . '/admin/qlbh_db.php';

$pageTitle = 'Trạng thái hệ thống | KT-SOFT';
$pageDesc = 'Trạng thái hoạt động hiện tại của các dịch vụ KT-SOFT: website kt-soft.vn và phần mềm QLBH-CLOUD.';

// Kiem tra song song, chi doc - khong ghi gi vao he thong. Do thoi gian ket noi DB de biet QLBH-
// CLOUD co dang phan hoi binh thuong khong (khong the "ping" HTTP tu server toi chinh no de tranh
// vong lap/timeout khi ca 2 domain dung chung 1 may chu).
$t0 = microtime(true);
$qlbhPdo = qlbh_db();
$qlbhOk = $qlbhPdo !== null;
$qlbhMs = (int) round((microtime(true) - $t0) * 1000);

require_once __DIR__ . '/inc_header.php';
?>

<section class="hero" style="padding-bottom:0;">
  <div class="container">
    <span class="eyebrow">🟢 Trạng thái hệ thống</span>
    <h1>Tình trạng hoạt động các dịch vụ KT-SOFT</h1>
    <p class="lead">Trang này hiển thị trạng thái kiểm tra trực tiếp tại thời điểm bạn tải trang — không phải lịch sử uptime.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div style="display:flex;flex-direction:column;gap:14px;max-width:640px;">

      <div class="card" style="padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
        <div>
          <b>kt-soft.vn</b>
          <p class="muted" style="margin:4px 0 0;font-size:13.5px;">Website chính, trang admin quản trị</p>
        </div>
        <span style="background:#d1fae5;color:#065f46;padding:5px 14px;border-radius:999px;font-size:13px;font-weight:700;white-space:nowrap;">✅ Hoạt động</span>
      </div>

      <div class="card" style="padding:20px 24px;display:flex;align-items:center;justify-content:space-between;">
        <div>
          <b>QLBH-CLOUD</b> <span class="muted" style="font-size:12.5px;">(app.kt-soft.vn)</span>
          <p class="muted" style="margin:4px 0 0;font-size:13.5px;">
            <?= $qlbhOk ? "Cơ sở dữ liệu phản hồi trong {$qlbhMs}ms" : 'Không thể kết nối tới cơ sở dữ liệu' ?>
          </p>
        </div>
        <?php if ($qlbhOk): ?>
          <span style="background:#d1fae5;color:#065f46;padding:5px 14px;border-radius:999px;font-size:13px;font-weight:700;white-space:nowrap;">✅ Hoạt động</span>
        <?php else: ?>
          <span style="background:#fee2e2;color:#b91c1c;padding:5px 14px;border-radius:999px;font-size:13px;font-weight:700;white-space:nowrap;">❌ Gián đoạn</span>
        <?php endif; ?>
      </div>

    </div>

    <p class="muted" style="margin-top:24px;font-size:13px;max-width:640px;">
      Nếu bạn gặp sự cố dù trang này báo "Hoạt động", vui lòng liên hệ trực tiếp: ĐT/Zalo
      <b>0945289666</b> hoặc email <b>hoangnamcnc@gmail.com</b> — có thể là sự cố mạng cục bộ
      hoặc trình duyệt của bạn.
    </p>
  </div>
</section>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
