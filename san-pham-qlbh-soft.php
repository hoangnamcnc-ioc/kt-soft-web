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
        <h3 style="margin:0;">Phiên bản 1.9.4</h3>
        <span class="muted" style="font-size:13px;">21/10/2026</span>
      </div>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><span><b>Chép bản tin sáng</b> chỉ một lần bấm để dán vào Zalo gửi cho chủ quán hoặc nhân viên (doanh thu, lãi, mục tiêu, việc nên làm)</span></li>
        <li><span><b>Tăng cường bảo mật</b>: chống nhúng trang vào khung lạ, chống đoán kiểu tệp, ẩn thông tin máy chủ</span></li>
      </ul>
    </div>

    <details id="phien-ban-cu" style="margin:6px 0 22px;">
      <summary style="cursor:pointer;font-weight:600;color:var(--qlbhsoft, #2563eb);">Xem các phiên bản cũ hơn (27)</summary>
      <div style="margin-top:16px;">

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.9.3</strong> <span class="muted" style="font-size:13px;">20/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Trợ lý thông minh hơn cho chủ quán và thu ngân</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><span><b>Hỏi đáp nhanh bằng tiếng Việt</b> ngay trong ô Ctrl+K: "doanh thu hôm nay", "hàng nào sắp hết", "ai đang nợ nhiều nhất", "tồn kho coca"... chạy hoàn toàn trên máy bạn, không gửi dữ liệu ra ngoài</span></li>
        <li><span><b>Soát cuối ngày</b>: ca chưa đóng, lệch tiền két, đơn hủy, hàng hết hạn, sao lưu hôm nay... một danh sách ✔/⚠/✖, bấm vào là tới nơi xử lý</span></li>
        <li><span><b>Nhắc chi định kỳ</b> (điện, thuê mặt bằng, lương, thuế phí) kèm số tiền hay chi, lập sẵn phiếu chi một lần bấm</span></li>
        <li><span><b>So sánh giá nhà cung cấp</b> cho cùng một mặt hàng, ước tính số tiền tiết kiệm mỗi tháng; <b>lãi theo nhóm hàng và nhà cung cấp</b></span></li>
        <li><span><b>Trợ lý thiết lập</b>: tiến độ các bước để dùng phần mềm hiệu quả (giá vốn, mã vạch, VietQR, hạn sử dụng, mục tiêu...)</span></li>
        <li><span><b>Mua lại đơn trước</b> của khách quen chỉ một lần bấm, và <b>cảnh báo đơn trùng</b> khi giỏ hàng giống hệt đơn vừa bán</span></li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Sửa lỗi</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><span>Phiếu nhập để trống đơn giá không còn bị tính ngầm là 0đ làm sai giá vốn bình quân (nhập 0 vẫn được nếu là hàng tặng)</span></li>
        <li><span>Thanh nhắc mở/đóng cửa gọn lại trên màn hình điện thoại, không che hàng hóa</span></li>
      </ul>
      </div>
    </details>

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.9.2</strong> <span class="muted" style="font-size:13px;">19/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Dễ dùng hơn, bớt nhập tay</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><span><b>Tìm nhanh bằng Ctrl+K</b>: gõ để tìm hàng hóa, khách (tên hoặc số điện thoại), mã đơn, nhà cung cấp hoặc tên chức năng, chọn là mở đúng màn hình</span></li>
        <li><span><b>Tạo phiếu nhập từ gợi ý</b>: một lần bấm là điền sẵn nhà cung cấp và các mặt hàng cần nhập theo dự báo, chỉ cần chỉnh giá theo báo giá thực tế</span></li>
        <li><span><b>Gợi ý giá bán khi giá vốn tăng</b>: nhập hàng làm tỷ lệ lãi giảm thì phần mềm đề xuất giá bán mới để giữ nguyên tỷ lệ lãi cũ, đồng ý là cập nhật luôn</span></li>
        <li><span><b>Mục tiêu doanh thu tháng</b>: đặt mục tiêu, theo dõi tiến độ, dự kiến cuối tháng và số tiền cần bán mỗi ngày còn lại</span></li>
        <li><span><b>Tóm tắt bằng lời</b> cho 7 ngày qua hoặc tháng này (doanh thu, lãi, hàng nổi bật, điểm cần lưu ý), chép nhanh để gửi Zalo hoặc in</span></li>
        <li><span><b>Chất lượng dữ liệu</b>: phát hiện hàng thiếu giá, giá bán thấp hơn giá vốn, trùng mã vạch hoặc trùng tên, tồn âm; đề xuất mức tồn tối thiểu theo tốc độ bán và áp dụng hàng loạt</span></li>
        <li><span><b>Gợi ý khi thêm hàng mới</b>: gõ tên là gợi ý nhóm, nhà cung cấp, đơn vị tính từ hàng giống nhau; cảnh báo nếu trùng tên</span></li>
        <li><span>Danh sách hàng hóa hiện thêm số ngày tồn kho còn đủ bán, cảnh báo hàng sắp hết hoặc tồn dư</span></li>
      </ul>
      </div>
    </details>

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.9.1</strong> <span class="muted" style="font-size:13px;">16/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Phần mềm thông minh hơn</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><span><b>Bản tin sáng</b>: tóm tắt hôm qua (doanh thu, lãi gộp, so với tuần trước), điểm sức khỏe cửa hàng và danh sách việc nên làm hôm nay, bấm vào là tới đúng chỗ xử lý</span></li>
        <li><span><b>Gợi ý nhập hàng thông minh</b>: dự báo theo thứ trong tuần và xu hướng bán, nhóm theo nhà cung cấp, kèm danh sách tồn dư không nên nhập thêm</span></li>
        <li><span><b>Cảnh báo chủ động</b>: doanh thu sụt bất thường, hàng bán dưới giá vốn, hàng bán giảm hoặc tăng mạnh, hàng sắp hết trong vài ngày</span></li>
        <li><span><b>Phân tích thông minh</b>: dòng tiền 14 ngày, phân tích ABC, giờ cao điểm và gợi ý xếp ca, bất thường sâu (hủy đơn giờ lạ, hao hụt lặp lại, lệch két nhiều lần), khách quen sắp bỏ, nhắc nợ theo mức ưu tiên kèm tin nhắn mẫu, combo gợi ý, mô phỏng đổi giá</span></li>
        <li><span><b>Máy bán hàng</b>: gợi ý hàng khách hay mua kèm, hiện món hay mua và công nợ của khách quen, báo khi nhập số lượng bất thường, hàng bán chạy theo khung giờ, mục "Việc cần làm"</span></li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Bảo mật &amp; độ tin cậy</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><span><b>Siết phân quyền</b>: thủ kho không còn xem được đơn hàng, danh sách khách, công nợ, doanh thu, không thu nợ hay kiểm két được</span></li>
        <li><span><b>Cách đóng gói mới</b>: dùng trình chạy Node.js gốc có chữ ký số của OpenJS Foundation thay vì chèn mã vào file chạy, giúp giảm tình trạng phần mềm diệt virus báo nhầm. Cài đè lên bản cũ vẫn giữ nguyên toàn bộ dữ liệu</span></li>
        <li><span>Sửa lỗi danh sách "Hoạt động gần đây" ở màn hình Quản lý không hiển thị</span></li>
      </ul>
      </div>
    </details>

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.9.0</strong> <span class="muted" style="font-size:13px;">15/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Hạn dùng &amp; hư hỏng</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><span><b>Bán theo hạn dùng gần nhất trước (FEFO)</b>: hàng đã nhập hạn sử dụng được trừ theo lô, số lượng từng lô chính xác</span></li>
        <li><span><b>Hàng hết hạn bị cách ly</b>: máy bán hàng không bán được hàng đã quá hạn; màn <b>"Hàng cần xử lý"</b> liệt kê lô đã/sắp hết hạn (7/14/30 ngày) kèm giá vốn, giá xả gợi ý, nút hủy hoặc trả nhà cung cấp</span></li>
        <li><span><b>Cận hạn theo nhóm hàng</b>: mỗi nhóm có ngưỡng riêng (sữa chua vài ngày, đồ hộp vài tháng); hàng cận hạn <b>tự giảm giá</b> ở máy bán hàng, nhập lô có hạn quá ngắn sẽ được cảnh báo ngay</span></li>
        <li><span>Mặt hàng có thể bật <b>"Quản lý hạn sử dụng"</b> để bắt buộc nhập HSD khi nhập hàng</span></li>
        <li><span><b>Xuất hủy phân loại</b> (hết hạn, hư hỏng, vỡ, mất...), tính thiệt hại theo giá vốn; kiểm kho thiếu tự ghi hao hụt; <b>báo cáo Tổn thất hàng hóa</b> theo loại, mặt hàng, tháng</span></li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Tiền bạc &amp; kiểm soát</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><span><b>Phân loại thu/chi</b> (thuê mặt bằng, điện nước, lương, marketing...) và khoản <b>"chủ rút tiền dùng cá nhân"</b> tách riêng khỏi chi phí; báo cáo <b>Lãi lỗ</b> có chi phí, tổn thất hàng và lãi ròng</span></li>
        <li><span><b>Giá vốn bình quân</b> tự cập nhật khi nhập hàng (có thể tắt); cảnh báo khi nhà cung cấp tăng giá, báo cáo biến động giá nhập</span></li>
        <li><span><b>Hạn trả nhà cung cấp</b> và bảng dòng tiền: phải trả đến hạn 7/30 ngày so với tiền đang có</span></li>
        <li><span><b>Cảnh báo bất thường theo nhân viên</b>: giảm giá, hủy đơn, trả hàng, lệch két, hủy hàng nhiều hơn bình thường</span></li>
        <li><span>Máy bán hàng có <b>loa báo đã nhận tiền</b> (kèm đọc số tiền) khi chuyển khoản được xác nhận</span></li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Quy trình cửa hàng</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><span><b>Danh sách mở cửa / đóng cửa</b> hằng ngày (tùy chỉnh được): nhân viên tick từng việc, việc chưa làm phải ghi lý do; có nhật ký ai làm lúc nào, nhắc khi quên và báo ngày bỏ sót</span></li>
        <li><span><b>Biên bản bàn giao ca</b> in ra để người giao và người nhận ký: doanh thu theo cách thanh toán, tiền két dự kiến/thực đếm, hàng hủy, hàng hết hạn, hàng sắp hết</span></li>
        <li><span><b>Kiểm hàng dễ mất mỗi ngày</b> (thuốc lá, rượu bia, sữa bột...) và nhắc <b>sắp hết trên kệ</b> kèm số lượng nên bổ sung</span></li>
        <li><span><b>Đánh giá nhà cung cấp</b>: tỷ lệ trả lại, giao trễ so với ngày hẹn, hàng hỏng/hết hạn, số lần tăng giá, xếp loại A/B/C; phân nhóm ngành cho nhà cung cấp</span></li>
        <li><span><b>Quà tặng và túi nilon tự trừ kho</b>, tính vào chi phí; túi nilon đặt định mức theo đơn, có báo cáo vật tư tiêu hao</span></li>
        <li><span><b>Mã cân điện tử</b> (EAN-13 từ cân tem): quét tem là máy bán hàng tự thêm đúng hàng và đúng khối lượng/số tiền</span></li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Kho &amp; khách hàng</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><span><b>Báo cáo hàng chậm bán &amp; vốn bị chôn</b> kèm gợi ý xả hàng</span></li>
        <li><span><b>Kiểm kho theo nhóm hàng</b> và lịch kiểm hằng tuần, nhắc ở Tổng quan</span></li>
        <li><span><b>Quà tặng theo mốc</b>: tặng quà khi hóa đơn đạt mức, đổi quà bằng điểm tích lũy; máy bán hàng tự nhắc và ghi vào hóa đơn</span></li>
      </ul>
      </div>
    </details>

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.8.4</strong> <span class="muted" style="font-size:13px;">14/10/2026</span></summary>
      <div class="changelog-body">
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Sửa lỗi: hàng bán theo cân/đo lẻ (vd 0,35 kg) không còn ra số tiền lẻ đồng; tiền được làm tròn đến đồng ở từng dòng hàng, khớp giữa hóa đơn, sổ quỹ và báo cáo</li>
        <li>Chặn dữ liệu nhập không hợp lệ (số âm, chữ thay số, số lượng nhập bằng 0, giá bán âm) bằng thông báo rõ ràng thay vì báo lỗi hệ thống</li>
        <li>Sửa lỗi hiển thị ảnh sản phẩm trên trang khách quét mã QR chọn hàng</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.8.3</strong> <span class="muted" style="font-size:13px;">14/10/2026</span></summary>
      <div class="changelog-body">
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Sửa lỗi: sau khi xóa dữ liệu mẫu, giỏ hàng/hóa đơn đang giữ và mã đơn cũ trên máy bán hàng, điện thoại khách không còn bị lẫn sang dữ liệu mới</li>
        <li>Sửa lỗi: ảnh sản phẩm hiển thị đúng trên trang khách quét mã QR chọn hàng</li>
        <li>Hiển thị đúng tên người mở ca trong báo cáo cuối ngày; hoàn thiện nội dung quyền riêng tư</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.8.2</strong> <span class="muted" style="font-size:13px;">13/10/2026</span></summary>
      <div class="changelog-body">
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><b>Sơ đồ chức năng</b> là trang đầu tiên hiện ra ngay sau khi đăng nhập (quản lý, thủ kho, kế toán), thêm các ô mới: khách quét QR, khóa sổ, hàng sắp hết, phiếu chờ chi, công nợ quá hạn</li>
        <li>Bổ sung <b>Điều khoản sử dụng, Quyền riêng tư và Giấy phép mã nguồn mở</b>: hiển thị khi cài đặt, trong phần mềm (Cài đặt) và tại kt-soft.vn</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.8.1</strong> <span class="muted" style="font-size:13px;">13/10/2026</span></summary>
      <div class="changelog-body">
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Màn hình đăng nhập tự đưa đúng màn hình theo vai trò: thu ngân vào Bán hàng, thủ kho và kế toán vào Quản lý, không còn báo lỗi "không có quyền" khi bấm nhầm nút hoặc gõ Enter</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.8.0</strong> <span class="muted" style="font-size:13px;">13/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><b>Khách quét mã QR để tự chọn hàng</b> bằng điện thoại (qua Wi-Fi của quán): xem hàng, chọn món, gửi đơn cho quầy; thu ngân kiểm tra, chốt thành hóa đơn và thu tiền. Khách theo dõi được trạng thái đơn, chủ quán in mã QR dán ở quầy; máy bán hàng có âm báo khi có đơn mới</li>
        <li>Tách tab <b>Cài đặt</b> khỏi màn Tổng quan: Tổng quan gọn, chỉ còn doanh thu, cảnh báo, nợ quá hạn</li>
        <li><b>Khóa sổ kế toán</b>: sau khi chốt kỳ, không ai hủy được đơn bán/phiếu nhập của kỳ đã khóa</li>
        <li><b>Phiếu nhập chờ chi tiền</b>: thủ kho nhận hàng, kế toán/quản lý bấm chi tiền sau (ghi sổ quỹ hoặc sổ ngân hàng)</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Kiểm soát &amp; an toàn</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Thu ngân chỉ được giảm giá tối đa một tỷ lệ cài đặt (mặc định 10%); vượt mức cần quản lý nhập mật khẩu duyệt, mọi lần giảm giá đều ghi nhật ký</li>
        <li>Đóng ca lệch tiền quá ngưỡng bắt buộc ghi lý do và được ghi nhật ký</li>
        <li>Thủ kho không chi tiền mặt từ quỹ và không xem được doanh thu</li>
        <li>Vá lỗi bảo mật: thiết bị lạ trong mạng Wi-Fi không còn tải được các trang nội bộ bằng đường dẫn đặc biệt</li>
        <li>Mở đơn khách chọn vào giỏ báo rõ món nào hết hàng/giảm số lượng; chặn hai thu ngân chốt trùng một đơn</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.7.4</strong> <span class="muted" style="font-size:13px;">12/10/2026</span></summary>
      <div class="changelog-body">
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li><b>Dữ liệu mẫu 1 tuần bán hàng</b>: khi tạo cửa hàng mới có thể chọn nạp sẵn hàng hóa, khách hàng, nhân viên, nhập hàng, hóa đơn, sổ quỹ, sổ ngân hàng, công nợ của một tạp hóa nhỏ để xem thử các màn hình và báo cáo</li>
        <li>Quen rồi thì bấm <b>Xóa dữ liệu mẫu &amp; bắt đầu thực tế</b> ở màn hình Tổng quan: xóa sạch dữ liệu kinh doanh, giữ lại thông tin cửa hàng và tài khoản quản lý; phần mềm tự sao lưu trước khi xóa và yêu cầu nhập lại mật khẩu</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.7.3</strong> <span class="muted" style="font-size:13px;">12/10/2026</span></summary>
      <div class="changelog-body">
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Trang mới <b>Sơ đồ chức năng</b> trong màn hình Quản lý: gom toàn bộ chức năng theo luồng làm việc 4 bước (thiết lập → cung ứng &amp; kho → bán hàng &amp; chăm sóc khách → hậu kiểm &amp; báo cáo), bấm vào ô để mở đúng chức năng; mỗi vai trò chỉ thấy phần mình được dùng</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.7.2</strong> <span class="muted" style="font-size:13px;">12/10/2026</span></summary>
      <div class="changelog-body">
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Thêm hướng dẫn xử lý cảnh báo của Windows SmartScreen / phần mềm diệt virus ngay trong mục Phiên bản phần mềm</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.7.1</strong> <span class="muted" style="font-size:13px;">12/10/2026</span></summary>
      <div class="changelog-body">
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Nhiều kho hoàn thiện hơn: cảnh báo sắp hết hàng, gợi ý đặt hàng, sổ quỹ tiền mặt, ca bán hàng và hạn sử dụng đều tính riêng theo từng kho (có lựa chọn xem tất cả kho)</li>
        <li>Sổ chi tiết vật tư, hàng hóa xem được riêng từng kho, tính cả hàng chuyển kho</li>
        <li>Kiểm kho và xuất kho thao tác đúng trên tồn của kho đang chọn</li>
        <li>Sổ chi tiết tiền (S2e) gộp cả tiền mặt và tiền gửi ngân hàng</li>
        <li>Hủy đơn, trả hàng, hủy đặt hàng đã trả bằng chuyển khoản/QR: phần mềm hỏi "đã chuyển khoản hoàn tiền cho khách chưa?" rồi mới ghi khoản chi vào sổ ngân hàng, không tự ghi nữa</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.7.0</strong> <span class="muted" style="font-size:13px;">08/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Hạn thanh toán công nợ: đặt số ngày được nợ cho từng khách, phần mềm tính tuổi nợ (0-30, 31-60, 61-90, trên 90 ngày), cảnh báo khách quá hạn ở Tổng quan và màn Nhắc nợ</li>
        <li>Bảng kê công nợ theo khách (sao kê có số dư đầu kỳ, phát sinh, số dư cuối kỳ) để in gửi khách</li>
        <li>Sổ tiền gửi ngân hàng: nhiều tài khoản, tự ghi thu/chi khi bán hàng, thu nợ, cọc, trả hàng, nhập hàng bằng chuyển khoản / QR / quẹt thẻ; nộp tiền mặt vào ngân hàng và rút về quỹ</li>
        <li>Báo cáo xem được chứng từ gốc: bấm vào một dòng báo cáo để mở danh sách đơn hàng / phiếu nhập tạo nên con số đó</li>
        <li>Báo cáo theo nhân viên phụ trách khách hàng (doanh thu, công nợ, nợ quá hạn)</li>
        <li>Nhiều kho / cửa hàng trong một dữ liệu: tồn kho riêng từng kho, chọn kho đang bán, gán kho cố định cho nhân viên, chuyển hàng giữa các kho</li>
        <li>Kiểm tra bản mới ngay trong phần mềm: có bản mới sẽ hiện thông báo kèm nút tải về</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Lưu ý</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Sổ tiền gửi ngân hàng bắt đầu ghi từ khi cài bản này; lịch sử cũ không tự đưa vào — nhập số dư đầu tại mục Tài khoản để khớp số dư thật</li>
        <li>Khi dùng nhiều kho, sổ quỹ tiền mặt, ca bán hàng và lô hạn sử dụng vẫn dùng chung cho tất cả kho</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.6.1</strong> <span class="muted" style="font-size:13px;">08/10/2026</span></summary>
      <div class="changelog-body">
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Quét mã vạch bằng camera ở thêm nữa các ô nhập mã vạch: form Thêm/Sửa sản phẩm, Tạo hàng mới khi nhập hàng, In tem và ô tìm trong Hàng hóa</li>
        <li>Màn Kiểm kho có ô quét mã vạch để nhảy tới đúng dòng cần đếm</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.6.0</strong> <span class="muted" style="font-size:13px;">08/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Phân quyền thêm 2 vai trò <b>Thủ kho</b> và <b>Kế toán</b>: mỗi người chỉ thấy và dùng đúng phần việc của mình</li>
        <li>Đặt hàng trước có đặt cọc: lưu giỏ hàng thành đơn đặt hàng, khi khách đến nhận chỉ thu phần còn lại, tự đối trừ tiền cọc, hoàn hoặc giữ cọc khi hủy</li>
        <li>Quản lý giao hàng: đối tác giao hàng, vận đơn theo dõi trạng thái, tiền thu hộ (COD) và đối soát với đối tác</li>
        <li>Công nợ nhà cung cấp: ghi nhận phần còn nợ khi nhập hàng, trả tiền dần cho nhà cung cấp</li>
        <li>Hủy đơn bán và hủy phiếu nhập (nhập nhầm): tự hoàn lại tồn kho, công nợ, tiền mặt và điểm tích lũy</li>
        <li>Thu ngân thu nợ khách ngay tại quầy, tự ghi phiếu thu tiền mặt vào sổ quỹ</li>
        <li>Nhân viên tự chấm công Vào ca / Ra ca ngay trên màn hình Bán hàng</li>
        <li>Báo cáo mới: Kênh bán hàng, Đặt hàng; bảng giá gửi khách qua Zalo (có giá theo nhóm sỉ/lẻ)</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">An toàn &amp; kiểm soát</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Thu ngân trả hàng phải có quản lý duyệt bằng tài khoản quản lý</li>
        <li>Thu ngân không còn tự đổi được hạn mức nợ, nhóm giá hay xóa khách hàng, và không xem được giá vốn</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.5.3</strong> <span class="muted" style="font-size:13px;">07/10/2026</span></summary>
      <div class="changelog-body">
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Bộ nhận dạng thương hiệu KT mới: biểu tượng trên file chạy, bộ cài đặt, tab trình duyệt và màn hình đăng nhập — đồng nhất với KT-SOFT và hocketoanthue.vn</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1;  padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.5.2 <span style="font-size:12px;font-weight:700;color:#dc2626;background:#fee2e2;padding:2px 8px;border-radius:10px;vertical-align:middle;">Bản vá bảo mật</span></strong> <span class="muted" style="font-size:13px;">06/10/2026</span></summary>
      <div class="changelog-body">
      <p class="desc" style="margin:8px 0 6px;">Khuyến nghị mọi khách hàng cập nhật. Bản này tăng độ an toàn của phần mềm:</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Cập nhật các thư viện nền tảng lên phiên bản đã vá lỗi bảo mật</li>
        <li>Hàng tính theo cái/gói/lon chỉ bán được số lượng nguyên (hàng tính theo kg, lít, mét vẫn bán được số lẻ như 0,5)</li>
        <li>Khóa đăng nhập sau nhiều lần sai chỉ áp dụng cho thiết bị đang nhập sai, người lạ trong Wi-Fi không thể làm chủ quán bị khóa tài khoản</li>
      </ul>
      <p class="desc" style="margin:6px 0 0;">Lưu ý: tính năng gửi email (đặt lại mật khẩu, báo cáo tự động) cần máy có kết nối Internet.</p>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.5.1</strong> <span class="muted" style="font-size:13px;">05/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Cải thiện</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Phiếu nhập hàng: hàng chưa có trong danh mục thì tạo nhanh ngay trong phiếu (nút "Tạo hàng mới"), tạo xong tự chọn vào phiếu, không phải thoát ra màn Hàng hóa rồi quay lại</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.5.0</strong> <span class="muted" style="font-size:13px;">05/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Thiết bị truy cập qua Wi-Fi/LAN phải được quản lý duyệt: điện thoại/máy tính bảng lạ vào địa chỉ phần mềm sẽ bị giữ ở trang "Chờ quản lý duyệt", quản lý duyệt/từ chối/thu hồi ngay trong Tổng quan; sau khi duyệt, nhân viên vẫn phải đăng nhập bằng tài khoản riêng. Máy chính luôn vào được</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.4.0</strong> <span class="muted" style="font-size:13px;">30/09/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Quét mã vạch bằng camera (điện thoại/webcam) ở màn Bán hàng và các ô quét trong Quản lý — không cần mua máy quét mã vạch</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.3.0</strong> <span class="muted" style="font-size:13px;">30/09/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>In tem giá/mã vạch cho sản phẩm — in trực tiếp trên giấy A4 hoặc giấy decal tem, không cần máy in tem riêng</li>
        <li>Mở ca/đóng ca bán hàng — kiểm tiền mặt đầu ca và cuối ca, tự tính chênh lệch</li>
        <li>Nhận thanh toán VietQR ngay tại quầy, tự động xác nhận đã chuyển khoản qua SePay (không cần thu ngân tự bấm xác nhận)</li>
        <li>Khôi phục dữ liệu từ file backup khác (USB, máy khác) ngay trong phần mềm</li>
        <li>Mã PIN ngắn (4-6 số) để khóa/mở nhanh màn hình bán hàng, không cần gõ mật khẩu đầy đủ mỗi lần</li>
        <li>Trả hàng: gõ một phần là hiện gợi ý đơn hàng, không cần nhớ chính xác cả mã đơn</li>
        <li>Kích hoạt lại sản phẩm đã ngừng kinh doanh ngay trong danh sách</li>
        <li>Lưu lại lịch sử kiểm két tiền mặt cuối ngày để tra cứu lại sau này</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Vá lỗi &amp; nâng cao độ tin cậy</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Chống trừ kho 2 lần khi mạng chập chờn lúc thanh toán</li>
        <li>Giữ lại hóa đơn đang bán dở nếu lỡ tắt trình duyệt, không mất giỏ hàng</li>
        <li>Sửa giá hàng loạt: xác nhận trước khi lưu, hiện rõ số dòng thực sự thay đổi</li>
        <li>Bắt buộc nhập lý do khi xuất hủy hàng; hiện số lượng sản phẩm liên quan khi chặn xóa danh mục/nhà cung cấp/vị trí</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.2.1</strong> <span class="muted" style="font-size:13px;">27/09/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Nút "Góp ý / Báo lỗi" ngay trong phần mềm (màn Quản lý và màn Bán hàng) — gửi thẳng cho nhà phát triển, không cần tự cấu hình email hay liên hệ ở đâu khác</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.2.0</strong> <span class="muted" style="font-size:13px;">25/09/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Bán hàng theo đơn vị quy đổi: khai báo Thùng/Lốc/... quy đổi ra đơn vị lẻ, chọn ngay đơn vị lúc bán tại màn Bán hàng, tồn kho và báo cáo vẫn tự động quy đổi chính xác về đơn vị cơ bản</li>
        <li>Giá bán riêng theo nhóm khách hàng (Sỉ/Lẻ/VIP...): thiết lập bảng giá riêng cho từng nhóm, đơn hàng tự áp dụng đúng giá theo nhóm của khách</li>
        <li>Gợi ý đặt hàng lại: tự tính theo tốc độ bán 30 ngày gần nhất, đề xuất số lượng cần nhập thêm, xuất được ra Excel để gửi nhà cung cấp</li>
        <li>Nhắc nợ khách hàng qua Zalo: danh sách khách đang nợ sắp theo nợ cao nhất, soạn sẵn nội dung nhắc nợ để sao chép/gửi qua Zalo</li>
        <li>Truy cập qua Wi-Fi/LAN kèm mã QR: mở thêm quầy thu ngân bằng điện thoại/máy tính bảng khác trong quán, không cần cài lại phần mềm</li>
        <li>Chọn khổ giấy in hóa đơn 58mm hoặc 80mm cho đúng loại máy in nhiệt đang dùng</li>
        <li>Tự động gửi báo cáo cuối ngày qua email cho tài khoản Quản lý vào giờ đã hẹn</li>
        <li>Sao lưu dữ liệu tự động chép thêm 1 bản sang thư mục khác (ví dụ thư mục Google Drive/OneDrive đã đồng bộ sẵn) — tự động có thêm 1 bản trên mây</li>
      </ul>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.1.1 <span style="font-size:12px;font-weight:700;color:#dc2626;background:#fee2e2;padding:2px 8px;border-radius:10px;vertical-align:middle;">Vá khẩn cấp</span></strong> <span class="muted" style="font-size:13px;">25/09/2026</span></summary>
      <div class="changelog-body">
      <p class="desc" style="margin:8px 0 10px;">
        Khuyến nghị <b>mọi khách hàng đang dùng bản 1.1.0 cập nhật ngay</b>. Bản này vá 3 lỗi
        nghiêm trọng: (1) một số trường hợp truy cập bất thường có thể làm phần mềm tự tắt
        đột ngột giữa lúc bán hàng, (2) nhập file Excel thiếu cột giá/tồn kho có thể vô tình
        xóa mất giá bán và tồn kho của các mặt hàng trùng mã, (3) trả hàng cho đơn có giảm
        giá tính sai số tiền hoàn/công nợ. Đã kiểm chứng lại toàn bộ trên bản cài đặt thật
        trước khi phát hành.
      </p>
      </div>
    </details>

<details class="changelog-item" style="border-left:3px solid var(--qlbhsoft, #2563eb); padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 1.1.0</strong> <span class="muted" style="font-size:13px;">23/09/2026</span></summary>
      <div class="changelog-body">
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
    </details>

<details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px;">
      <summary><strong>Phiên bản 1.0.0</strong> <span class="muted" style="font-size:13px;">Phát hành lần đầu</span></summary>
      <div class="changelog-body">
      <p class="desc" style="margin:8px 0 0;">
        Bán hàng tại quầy, quản lý hàng hóa/tồn kho, khách hàng &amp; công nợ, nhập hàng từ nhà
        cung cấp, sổ quỹ thu chi, nhân viên &amp; bảng lương, sao lưu dữ liệu, ước tính thuế hộ
        kinh doanh.
      </p>
      </div>
    </details>
      </div>
    </details>
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
    <div style="border:1px solid #fcd34d; background:#fffbeb; border-radius:10px; padding:14px 16px; margin:14px 0;">
      <b>Windows hoặc trình duyệt cảnh báo khi tải/cài đặt?</b>
      <p style="margin:6px 0 0;">
        Đây là phần mềm bán hàng nhỏ, chưa có chứng chỉ ký số của nhà phát hành nên Windows
        SmartScreen có thể hiện "Windows protected your PC" hoặc "Unknown publisher". Đây là cảnh báo
        thông thường với phần mềm chưa ký số, không phải do file bị lỗi. Bạn làm như sau:
      </p>
      <ol style="margin:8px 0 0; padding-left:20px;">
        <li>Trình duyệt (Chrome/Edge) hỏi giữ file: bấm <b>Giữ lại</b> (Keep).</li>
        <li>Windows hiện hộp xanh "Windows protected your PC": bấm <b>More info</b> (Thông tin thêm), rồi bấm <b>Run anyway</b> (Vẫn chạy).</li>
        <li>Nếu phần mềm diệt virus chặn: chọn cho phép/ngoại lệ với file <code>QLBH-SOFT-Setup.exe</code> rồi chạy lại.</li>
      </ol>
      <p style="margin:8px 0 0; font-size:13px; color:#666;">
        Chỉ tải bộ cài từ trang kt-soft.vn này. Nếu bạn muốn kiểm tra thêm, có thể gửi file lên
        virustotal.com để quét trước khi cài.
      </p>
    </div>
    <div class="cta-row">
      <a href="download.php?p=qlbh-soft" class="btn">⬇️ Tải bản 1.9.4 mới nhất</a>
      <p class="muted" style="font-size:12px;margin-top:10px;word-break:break-all;">Mã kiểm tra SHA-256 của bộ cài 1.9.4: <code>5eb7027cff91c0ae2751ba5afcba0c2b1c2a4d25a83870ee850c8938d64af9a4</code><br>
      Nếu Windows Defender báo nhầm (phần mềm chưa ký số nên đôi khi bị đánh dấu "Trojan:Win32/Wacatac" do máy học đoán), bạn có thể đối chiếu mã trên để yên tâm file đúng của KT-SOFT.</p>
    </div>
  </div>
</section>

<section class="section" style="padding-top:0;">
  <div class="container">
    <p class="muted" style="font-size:12.5px;margin:0;">
      <b>Quyền riêng tư:</b> dữ liệu bán hàng nằm hoàn toàn trên máy của bạn. Phần mềm chỉ gửi về kt-soft.vn một tín hiệu ẩn danh (mã cài đặt ngẫu nhiên và số phiên bản, tối đa 1 lần/ngày) để chúng tôi biết số máy đang dùng; bạn có thể tắt tại Cài đặt → Phiên bản phần mềm. Xem <a href="dieu-khoan.php">Điều khoản sử dụng</a> và <a href="quyen-rieng-tu.php">Chính sách quyền riêng tư</a>.
    </p>
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
