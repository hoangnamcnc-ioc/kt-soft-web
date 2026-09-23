<?php
require_once __DIR__ . '/inc_download.php';

$pageTitle = 'QLBH-SOFT — Phần mềm bán hàng tạp hóa, siêu thị mini | KT-SOFT';
$pageDesc = 'QLBH-SOFT là phần mềm quản lý bán hàng dành cho tạp hóa, siêu thị mini, chạy trực tiếp trên máy tính Windows, không cần Internet.';
require_once __DIR__ . '/inc_header.php';

$luotTai = doc_luot_tai('qlbh-soft');
$danhGia = doc_danh_gia('qlbh-soft');
$daDanhGia = !empty($_COOKIE['danhgia_qlbh-soft']);
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
      <a href="download.php?p=qlbh-soft" class="btn">⬇️ Tải về dùng miễn phí</a>
      <a href="lien-he.php" class="btn btn-ghost">Yêu cầu tư vấn</a>
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
          <input type="hidden" name="p" value="qlbh-soft">
          <input type="hidden" name="back" value="san-pham-qlbh-soft.php">
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
          <a href="download.php?p=qlbh-soft" class="btn">⬇️ Tải về dùng miễn phí</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" style="border-top:1px solid #eee;">
  <div class="container">
    <h2 style="margin-bottom:6px;">Lịch sử cập nhật</h2>
    <p class="desc" style="margin-top:0;margin-bottom:24px;">
      Cài bản mới đè lên bản cũ (không cần gỡ cài đặt) — toàn bộ dữ liệu bán hàng, khách hàng,
      hàng hóa của bạn được giữ nguyên. Xem <a href="#huong-dan-cap-nhat">hướng dẫn cập nhật an toàn</a> bên dưới.
    </p>

    <div class="changelog-item" style="border-left:3px solid var(--qlbhsoft, #2563eb); padding-left:16px; margin-bottom:22px;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.1.0</h3>
        <span class="muted" style="font-size:13px;">23/09/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Quét mã vạch ở tất cả màn hình kho (nhập hàng, xuất kho, trả hàng, bán online) — trước đây chỉ có ở màn Bán hàng</li>
        <li>Quên mật khẩu tự đặt lại qua email, không cần liên hệ hỗ trợ</li>
        <li>Điểm tích lũy cho khách hàng: tự cộng điểm, đổi điểm trừ tiền, nhóm khách hàng (VIP/Bán lẻ...), hạn mức nợ cảnh báo</li>
        <li>Thêm hình thức thanh toán Quét QR / Quẹt thẻ (tách riêng khỏi Chuyển khoản để đối soát dễ hơn)</li>
        <li>Nhập/xuất Excel (.xlsx) cho tất cả các danh sách: hàng hóa, khách hàng, nhà cung cấp, tồn kho, sổ quỹ, đơn hàng, nhập hàng, bảng lương, và toàn bộ báo cáo</li>
        <li>Tiền khách đưa / tiền thối lại ngay tại màn Bán hàng, kèm nút bấm nhanh các mệnh giá tiền</li>
        <li>Báo cáo cuối ngày kiểu kiểm két: so tiền phải có với tiền đếm thực tế trong két</li>
        <li>Tìm hàng hóa/khách hàng không cần gõ dấu tiếng Việt</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Vá lỗi &amp; nâng cao độ tin cậy</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Sửa lỗi đơn bán trước 7 giờ sáng bị tính nhầm sang doanh thu ngày hôm trước</li>
        <li>Sửa lỗi chức năng Trả hàng bán không hoạt động</li>
        <li>Sửa lỗi cột "Thành tiền" không cập nhật khi đổi số lượng trong giỏ hàng</li>
        <li>Tăng độ an toàn dữ liệu: tự gộp dữ liệu về file chính định kỳ + sao lưu tự động mỗi ngày</li>
        <li>Chặn bán âm kho khi có nhiều giao dịch cùng lúc; các lỗi bảo mật khác đã được rà soát và vá</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.0.0</h3>
        <span class="muted" style="font-size:13px;">Phát hành lần đầu</span>
      </div>
      <p class="desc" style="margin:8px 0 0;">
        Bán hàng tại quầy, quản lý hàng hóa/tồn kho, khách hàng &amp; công nợ, nhập hàng từ nhà
        cung cấp, sổ quỹ thu chi, nhân viên &amp; bảng lương, sao lưu dữ liệu, ước tính thuế hộ
        kinh doanh.
      </p>
    </div>
  </div>
</section>

<section class="section" id="huong-dan-cap-nhat" style="border-top:1px solid #eee; background:#f8fafc;">
  <div class="container">
    <h2 style="margin-bottom:6px;">Cách cập nhật lên bản mới nhất — không mất dữ liệu</h2>
    <p class="desc" style="margin-top:0;">
      Dữ liệu của bạn (đơn hàng, khách hàng, hàng hóa...) nằm trong thư mục <code>data</code>,
      hoàn toàn tách biệt với chương trình. Cài đè bản mới sẽ <b>không đụng đến thư mục này</b>.
    </p>
    <ol class="feature-list" style="--card-accent: var(--qlbhsoft); list-style:decimal; padding-left:20px;">
      <li>Tải bản cài mới nhất bằng nút bên dưới.</li>
      <li>Chạy file <code>QLBH-SOFT-Setup.exe</code> vừa tải — <b>không cần gỡ bản cũ trước</b>. Nếu phần mềm đang mở, trình cài đặt sẽ tự đóng lại giúp bạn.</li>
      <li>Bộ cài nhận ra bạn đã cài trước đó và tự động cài đè lên đúng vị trí cũ — chỉ thay chương trình, giữ nguyên toàn bộ dữ liệu.</li>
      <li>Mở lại phần mềm, đăng nhập như bình thường — dữ liệu, tài khoản, mật khẩu đều giữ nguyên.</li>
    </ol>
    <p class="desc">
      Cẩn thận hơn thì trước khi cập nhật, vào <b>Quản lý → Tổng quan → Sao lưu dữ liệu</b>, bấm
      <b>Tải xuống</b> để có thêm 1 bản sao lưu tay, phòng trường hợp máy tính gặp sự cố khi đang cài.
    </p>
    <div class="cta-row">
      <a href="download.php?p=qlbh-soft" class="btn">⬇️ Tải bản 1.1.0 mới nhất</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="cta-band">
      <div>
        <h2>Cửa hàng của bạn có phù hợp với QLBH-SOFT?</h2>
        <p>Phù hợp nhất với 1 cửa hàng, 1 máy tính bán hàng. Nếu cần quản lý nhiều chi nhánh, tham khảo thêm QLBH-CLOUD.</p>
      </div>
      <a href="download.php?p=qlbh-soft" class="btn">⬇️ Tải về dùng miễn phí</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
