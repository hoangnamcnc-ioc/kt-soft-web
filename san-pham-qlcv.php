<?php
require_once __DIR__ . '/inc_download.php';

$pageTitle = 'QLCV — Phần mềm quản lý công việc theo phòng ban | KT-SOFT';
$pageDesc = 'QLCV giúp đội nhóm giao việc, theo dõi tiến độ, chấm điểm KPI theo phòng ban và xếp lịch trực — chạy local hoặc trên máy chủ nội bộ.';
require_once __DIR__ . '/inc_header.php';

$luotTai = doc_luot_tai('qlcv');
$danhGia = doc_danh_gia('qlcv');
$daDanhGia = !empty($_COOKIE['danhgia_qlcv']);
?>

<section class="hero" style="padding-bottom:0;">
  <div class="container">
    <span class="eyebrow" style="background:var(--qlcv-bg);color:var(--qlcv);">📋 QLCV · Quản lý công việc nội bộ</span>
    <h1>Giao việc rõ ràng, đánh giá công bằng bằng điểm KPI</h1>
    <p class="lead">
      Một nơi duy nhất để Trưởng phòng giao việc, nhân viên báo cáo tiến độ, và Ban Giám đốc theo
      dõi hiệu suất từng phòng ban — không cần trao đổi qua nhiều nhóm chat rời rạc.
    </p>
    <div class="cta-row">
      <a href="download.php?p=qlcv" class="btn" style="background:var(--qlcv);">⬇️ Tải về dùng thử</a>
      <a href="lien-he.php" class="btn btn-ghost">Yêu cầu triển khai</a>
    </div>

    <div class="rating-block">
      <div class="download-count">⬇️ <b><?= number_format($luotTai, 0, ',', '.') ?></b> lượt tải</div>
      <div class="rating-summary">
        <span class="stars"><?= str_repeat('★', (int) round($danhGia['trung_binh'])) . str_repeat('☆', 5 - (int) round($danhGia['trung_binh'])) ?></span>
        <?php if ($danhGia['so_luot'] > 0): ?>
          <span><?= $danhGia['trung_binh'] ?>/5</span>
          <span class="muted">(<?= $danhGia['so_luot'] ?> đánh giá)</span>
        <?php else: ?>
          <span class="muted">Chưa có đánh giá</span>
        <?php endif; ?>
      </div>
      <?php if (isset($_GET['danhgia'])): ?>
        <span class="rated-thanks">Cảm ơn bạn đã đánh giá!</span>
      <?php elseif (!$daDanhGia): ?>
        <form method="post" action="danh-gia.php" class="rate-form">
          <input type="hidden" name="p" value="qlcv">
          <input type="hidden" name="back" value="san-pham-qlcv.php">
          <span class="rate-label">Bạn thấy phần mềm thế nào?</span>
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <button type="submit" name="diem" value="<?= $i ?>" title="<?= $i ?> sao"><?= str_repeat('★', $i) ?></button>
          <?php endfor; ?>
        </form>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="product-detail" style="border-top:none;">
  <div class="container">
    <div class="grid">
      <div>
        <span class="tag" style="--card-accent: var(--qlcv); --card-bg: var(--qlcv-bg);">Giao việc &amp; Theo dõi</span>
        <h2>Việc được giao, có người nhận, có thời hạn — không thất lạc</h2>
        <p class="desc">
          Trưởng/Phó phòng giao việc cho nhân viên trong phòng, hoặc nhân viên tự tạo việc và xin
          duyệt. Mọi nhiệm vụ đều có trạng thái rõ ràng, dễ theo dõi ai đang làm gì.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlcv);">
          <li>Giao việc theo phòng ban, phân quyền theo vai trò (Trưởng phòng, Nhân viên, Ban Giám đốc)</li>
          <li>Nhân viên tự tạo nhiệm vụ khác, chờ trưởng/phó phòng duyệt</li>
          <li>Từ chối nhiệm vụ bắt buộc phải nêu lý do, lưu lại làm bằng chứng</li>
          <li>Đính kèm tài liệu trực tiếp vào từng công việc</li>
        </ul>
      </div>
      <div class="mock" style="--card-bg: var(--qlcv-bg); --card-accent: var(--qlcv);">
        <div class="mock-title">Nhiệm vụ phòng Kinh doanh</div>
        <div class="mock-row"><span>Báo cáo doanh số tuần</span><span class="badge">Đang làm</span></div>
        <div class="mock-row"><span>Gọi lại khách hàng VIP</span><span class="badge">Chờ duyệt</span></div>
        <div class="mock-row"><span>Cập nhật bảng giá mới</span><span class="badge">Hoàn thành</span></div>
      </div>
    </div>
  </div>
</section>

<section class="product-detail reverse">
  <div class="container">
    <div class="grid">
      <div class="mock" style="--card-bg: var(--qlcv-bg); --card-accent: var(--qlcv);">
        <div class="mock-title">KPI theo phòng ban — Tháng này</div>
        <div class="mock-row"><span>Phòng Kinh doanh</span><b>92 điểm</b></div>
        <div class="mock-row"><span>Phòng Kế toán</span><b>88 điểm</b></div>
        <div class="mock-row"><span>Xu hướng 3 tháng</span><span class="badge">Tăng dần</span></div>
      </div>
      <div>
        <span class="tag" style="--card-accent: var(--qlcv); --card-bg: var(--qlcv-bg);">KPI &amp; Lịch trực</span>
        <h2>Đánh giá hiệu suất bằng số liệu, không cảm tính</h2>
        <p class="desc">
          Điểm số tính công bằng theo khối lượng và tiến độ hoàn thành việc, có biểu đồ xu hướng
          theo thời gian để nhìn ra ai đang cải thiện, ai đang chững lại.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlcv);">
          <li>Chấm điểm KPI tự động theo tiến độ hoàn thành công việc</li>
          <li>Trang xu hướng KPI theo tuần/tháng cho từng phòng ban</li>
          <li>Lịch trực tự động, nhận diện ngày lễ, nhập từ file Word/PDF có sẵn</li>
          <li>Chạy hoàn toàn trên máy chủ nội bộ, dữ liệu không rời khỏi công ty</li>
        </ul>
        <div class="cta-row">
          <a href="lien-he.php" class="btn" style="background:var(--qlcv);">Liên hệ triển khai cho đội nhóm →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="cta-band">
      <div>
        <h2>Đội nhóm của bạn đang quản lý công việc qua đâu?</h2>
        <p>Nếu vẫn là chat nhóm và bảng Excel rời rạc, QLCV giúp gom mọi thứ về một nơi có phân quyền rõ ràng.</p>
      </div>
      <a href="lien-he.php" class="btn">Liên hệ tư vấn →</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
