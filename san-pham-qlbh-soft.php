<?php
$pageTitle = 'QLBH-SOFT — Phần mềm bán hàng tạp hóa, siêu thị mini | KT-SOFT';
$pageDesc = 'QLBH-SOFT là phần mềm quản lý bán hàng dành cho tạp hóa, siêu thị mini, chạy trực tiếp trên máy tính Windows, không cần Internet.';
require_once __DIR__ . '/inc_header.php';
?>

<section class="hero" style="padding-bottom:0;">
  <div class="container">
    <span class="eyebrow" style="background:var(--qlbhsoft-bg);color:var(--qlbhsoft);">💻 QLBH-SOFT · Chạy local trên Windows</span>
    <h1>Phần mềm bán hàng tạp hóa, siêu thị mini — không cần mạng vẫn chạy</h1>
    <p class="lead">
      Cài một lần trên máy tính bán hàng, dùng ngay không phụ thuộc Internet. Được thiết kế riêng
      cho quầy tạp hóa và siêu thị mini: bán nhanh, dễ dùng, không rườm rà.
    </p>
    <div class="cta-row">
      <a href="lien-he.php" class="btn">Yêu cầu bản cài đặt</a>
      <a href="index.php#san-pham" class="btn btn-ghost">Xem các sản phẩm khác</a>
    </div>
  </div>
</section>

<section class="product-detail" style="border-top:none;">
  <div class="container">
    <div class="grid">
      <div>
        <span class="tag" style="--card-accent: var(--qlbhsoft); --card-bg: var(--qlbhsoft-bg);">Bán hàng nhanh</span>
        <h2>Quét mã vạch, tính tiền, in hóa đơn — trong vài giây</h2>
        <p class="desc">
          Giao diện bán hàng tối giản, tối ưu cho tốc độ tại quầy. Không cần thao tác nhiều bước,
          phù hợp với nhân viên bán hàng không rành công nghệ.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
          <li>Bán hàng bằng máy quét mã vạch hoặc tìm nhanh theo tên</li>
          <li>Tính tiền, in hóa đơn/phiếu tính tiền tại quầy</li>
          <li>Quản lý tồn kho, cảnh báo hàng sắp hết</li>
          <li>Ghi nợ và thu nợ cho khách quen</li>
        </ul>
      </div>
      <div class="mock" style="--card-bg: var(--qlbhsoft-bg); --card-accent: var(--qlbhsoft);">
        <div class="mock-title">Bán hàng tại quầy</div>
        <div class="mock-row"><span>Mì Hảo Hảo tôm chua cay</span><b>3.500đ × 2</b></div>
        <div class="mock-row"><span>Nước suối Lavie 500ml</span><b>5.000đ × 1</b></div>
        <div class="mock-row"><span>Tổng cộng</span><b>12.000đ</b></div>
        <div class="mock-row"><span>Trạng thái</span><span class="badge">Đã thanh toán</span></div>
      </div>
    </div>
  </div>
</section>

<section class="product-detail reverse">
  <div class="container">
    <div class="grid">
      <div class="mock" style="--card-bg: var(--qlbhsoft-bg); --card-accent: var(--qlbhsoft);">
        <div class="mock-title">Ước tính thuế hộ kinh doanh</div>
        <div class="mock-row"><span>Doanh thu năm</span><b>820.000.000đ</b></div>
        <div class="mock-row"><span>Ngưỡng miễn thuế</span><b>1.000.000.000đ</b></div>
        <div class="mock-row"><span>Trạng thái</span><span class="badge">Dưới ngưỡng — miễn thuế</span></div>
      </div>
      <div>
        <span class="tag" style="--card-accent: var(--qlbhsoft); --card-bg: var(--qlbhsoft-bg);">Sổ sách &amp; Thuế</span>
        <h2>Biết ngay mình có phải nộp thuế hay không</h2>
        <p class="desc">
          Tự động tính doanh thu theo năm và so với ngưỡng miễn thuế hộ kinh doanh hiện hành, kèm sổ
          doanh thu theo đúng mẫu quy định — không cần cộng tay cuối tháng.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
          <li>Ước tính thuế GTGT/TNCN theo ngưỡng và tỷ lệ hiện hành</li>
          <li>Sổ doanh thu bán hàng, dịch vụ theo mẫu quy định</li>
          <li>Sao lưu dữ liệu 1-click, không sợ mất dữ liệu khi đổi máy</li>
          <li>Toàn bộ dữ liệu lưu trên máy của bạn, không phụ thuộc bên thứ ba</li>
        </ul>
        <div class="cta-row">
          <a href="lien-he.php" class="btn">Liên hệ nhận bản cài đặt →</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="cta-band">
      <div>
        <h2>Cửa hàng của bạn có phù hợp với QLBH-SOFT?</h2>
        <p>Phù hợp nhất với 1 cửa hàng, 1 máy tính bán hàng. Nếu cần quản lý nhiều chi nhánh, tham khảo thêm QLBH2.</p>
      </div>
      <a href="lien-he.php" class="btn">Liên hệ tư vấn →</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
