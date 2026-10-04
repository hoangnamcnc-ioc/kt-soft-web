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
        <h3 style="margin:0;">Phiên bản 1.5.0</h3>
        <span class="muted" style="font-size:13px;">05/10/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Thiết bị truy cập qua Wi-Fi/LAN phải được quản lý duyệt: điện thoại/máy tính bảng lạ vào địa chỉ phần mềm sẽ bị giữ ở trang "Chờ quản lý duyệt", quản lý duyệt/từ chối/thu hồi ngay trong Tổng quan; sau khi duyệt, nhân viên vẫn phải đăng nhập bằng tài khoản riêng. Máy chính luôn vào được</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.4.0</h3>
        <span class="muted" style="font-size:13px;">30/09/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Quét mã vạch bằng camera (điện thoại/webcam) ở màn Bán hàng và các ô quét trong Quản lý — không cần mua máy quét mã vạch</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.3.0</h3>
        <span class="muted" style="font-size:13px;">30/09/2026</span>
      </div>
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

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.1</h3>
        <span class="muted" style="font-size:13px;">27/09/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbhsoft);">
        <li>Nút "Góp ý / Báo lỗi" ngay trong phần mềm (màn Quản lý và màn Bán hàng) — gửi thẳng cho nhà phát triển, không cần tự cấu hình email hay liên hệ ở đâu khác</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.0</h3>
        <span class="muted" style="font-size:13px;">25/09/2026</span>
      </div>
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

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.1.1 <span style="font-size:12px;font-weight:700;color:#dc2626;background:#fee2e2;padding:2px 8px;border-radius:10px;vertical-align:middle;">Vá khẩn cấp</span></h3>
        <span class="muted" style="font-size:13px;">25/09/2026</span>
      </div>
      <p class="desc" style="margin:8px 0 10px;">
        Khuyến nghị <b>mọi khách hàng đang dùng bản 1.1.0 cập nhật ngay</b>. Bản này vá 3 lỗi
        nghiêm trọng: (1) một số trường hợp truy cập bất thường có thể làm phần mềm tự tắt
        đột ngột giữa lúc bán hàng, (2) nhập file Excel thiếu cột giá/tồn kho có thể vô tình
        xóa mất giá bán và tồn kho của các mặt hàng trùng mã, (3) trả hàng cho đơn có giảm
        giá tính sai số tiền hoàn/công nợ. Đã kiểm chứng lại toàn bộ trên bản cài đặt thật
        trước khi phát hành.
      </p>
    </div>

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
      <a href="download.php?p=qlbh-soft" class="btn">⬇️ Tải bản 1.5.0 mới nhất</a>
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
