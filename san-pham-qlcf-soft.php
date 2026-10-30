<?php
require_once __DIR__ . '/inc_download.php';

$pageTitle = 'QLCF-SOFT — Phần mềm quản lý quán cà phê, trà sữa | KT-SOFT';
$pageDesc = 'QLCF-SOFT là phần mềm quản lý quán cà phê, trà sữa: bán hàng bấm ly theo size/đường/đá/topping, in tem ly, kho nguyên liệu và công thức pha chế, chốt ca, chấm công, nhiều chi nhánh. Cài trên máy Windows.';
require_once __DIR__ . '/inc_header.php';

$luotTai = doc_luot_tai('qlcf-soft');
$danhGia = doc_danh_gia('qlcf-soft');
$daDanhGia = !empty($_COOKIE['danhgia_qlcf-soft']);
?>

<section class="hero" style="padding-bottom:0;">
  <div class="container">
    <span class="eyebrow" style="background:var(--qlcf-bg);color:var(--qlcf);">☕ QLCF-SOFT · Cài trên máy Windows</span>
    <h1>Phần mềm quản lý quán cà phê, trà sữa — bấm ly nhanh, trừ kho tự động</h1>
    <p class="lead">
      Thu ngân chọn món, size, đường, đá, topping chỉ bằng vài lần bấm; hệ thống tính tiền, in tem ly,
      tự trừ nguyên liệu theo công thức pha chế và chốt ca đối chiếu tiền mặt. Dùng được cho một quán
      hoặc cả chuỗi nhiều chi nhánh.
    </p>
    <div class="cta-row">
      <a href="download.php?p=qlcf-soft" class="btn">⬇️ Tải về dùng miễn phí</a>
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
          <input type="hidden" name="p" value="qlcf-soft">
          <input type="hidden" name="back" value="san-pham-qlcf-soft.php">
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
        <span class="tag" style="--card-accent: var(--qlcf); --card-bg: var(--qlcf-bg);">Bán hàng bấm ly</span>
        <h2>Chọn món, size, đường, đá, topping — tính tiền và in tem trong vài giây</h2>
        <p class="desc">
          Màn hình bán hàng dành riêng cho quán nước: mỗi ly là một lần chọn bằng nút bấm lớn, tiền
          tính ngay theo thời gian thực. Nhân viên mới học cách dùng trong vài phút.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlcf);">
          <li>Chọn món/size/đường/đá/topping bằng nút bấm, tính tiền real-time</li>
          <li>In tem dán ly theo số ly (1/3, 2/3, 3/3), màn hình pha chế cho quầy bar</li>
          <li>Quản lý khu vực – bàn, bàn đặt trước; giá theo ca/khu vực; voucher khuyến mãi</li>
          <li>Mã QR chuyển khoản (VietQR) đúng số tiền ngay trên màn hình bán hàng</li>
        </ul>
      </div>
      <div class="mock" style="--card-bg: var(--qlcf-bg); --card-accent: var(--qlcf);">
        <div class="mock-title">Đơn đang bán · Bàn 5</div>
        <div class="mock-row"><span>Trà sữa trân châu (L, 50% đường, ít đá)</span><b>45.000đ × 1</b></div>
        <div class="mock-row"><span>Cà phê sữa đá (M)</span><b>29.000đ × 2</b></div>
        <div class="mock-row"><span>Tổng cộng</span><b>103.000đ</b></div>
        <div class="mock-row"><span>Trạng thái</span><span class="badge">Đã in 3 tem</span></div>
      </div>
    </div>
  </div>
</section>

<section class="product-detail reverse">
  <div class="container">
    <div class="grid">
      <div class="mock" style="--card-bg: var(--qlcf-bg); --card-accent: var(--qlcf);">
        <div class="mock-title">Giá vốn & lợi nhuận theo món</div>
        <div class="mock-row"><span>Trà sữa trân châu</span><b>Lãi 62%</b></div>
        <div class="mock-row"><span>Cà phê sữa đá</span><b>Lãi 68%</b></div>
        <div class="mock-row"><span>Sắp hết nguyên liệu</span><span class="badge">Sữa đặc · Trân châu</span></div>
      </div>
      <div>
        <span class="tag" style="--card-accent: var(--qlcf); --card-bg: var(--qlcf-bg);">Kho, ca &amp; nhân sự</span>
        <h2>Biết quán lãi bao nhiêu trên từng ly, nguyên liệu nào sắp hết</h2>
        <p class="desc">
          Khai báo công thức pha chế một lần, mỗi ly bán ra hệ thống tự trừ kho nguyên liệu và tính
          giá vốn. Cuối ca đối chiếu tiền kiểm đếm với số hệ thống, cuối tháng có sẵn bảng lương theo giờ làm.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlcf);">
          <li>Kho nguyên liệu, nhập hàng, cảnh báo sắp hết; công thức nền + định lượng thêm theo size/topping</li>
          <li>Mở ca/đóng ca bắt buộc, đối chiếu tiền mặt, doanh thu theo hình thức thanh toán</li>
          <li>Báo cáo doanh thu, món bán chạy, giá vốn/lợi nhuận; so sánh các chi nhánh; sổ quỹ thu chi</li>
          <li>Chấm công theo ca, lương theo giờ từng nhân viên; phân quyền chủ quán / quản lý / thu ngân</li>
          <li>Sao lưu và khôi phục dữ liệu ngay trong phần mềm; dữ liệu lưu trên máy của bạn</li>
        </ul>
        <div class="cta-row">
          <a href="download.php?p=qlcf-soft" class="btn">⬇️ Tải về dùng miễn phí</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" style="border-top:1px solid #eee;">
  <div class="container">
    <h2 style="margin-bottom:6px;">Lịch sử cập nhật</h2>
    <p class="desc" style="margin-top:0;margin-bottom:24px;">
      Cài bản mới đè lên bản cũ (không cần gỡ cài đặt) — dữ liệu bán hàng, thực đơn, kho của bạn được giữ nguyên.
      Xem <a href="#huong-dan-cai-dat">hướng dẫn cài đặt và cập nhật</a> bên dưới.
    </p>

    <div class="changelog-item" style="border-left:3px solid var(--qlcf, #9a3412); padding-left:16px; margin-bottom:22px;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 0.4.3 <span style="font-size:12px;font-weight:700;color:var(--qlcf);background:var(--qlcf-bg);padding:2px 8px;border-radius:10px;vertical-align:middle;">Mới nhất</span></h3>
        <span class="muted" style="font-size:13px;">29/10/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Nhập liệu nhanh hơn, có phiếu xuất kho, menu gọn hơn</p>
      <ul class="feature-list" style="--card-accent: var(--qlcf);">
        <li>Nhập nhanh ngay tại chỗ: thêm nhà cung cấp mới và nguyên liệu mới ngay trong phiếu nhập (kể cả nhập từ Excel), thêm nguyên liệu khi soạn công thức, tự đặt danh mục ở sổ quỹ, thêm nhanh món ở màn bán hàng</li>
        <li>Phiếu xuất kho mới: xuất hủy, dùng nội bộ, trả hàng nhà cung cấp; trừ kho ngay, không cho xuất quá tồn, bắt buộc ghi lý do</li>
        <li>Nhà cung cấp bắt buộc có tên, mã số thuế, địa chỉ; phiếu nhập bắt buộc chọn nhà cung cấp; nhà cung cấp cũ thiếu thông tin được nhắc bổ sung</li>
        <li>Thêm món mới xong có liên kết mở thẳng màn soạn công thức; chỉnh kho tay bắt buộc ghi lý do (nhập hàng dùng phiếu nhập, hỏng / dùng nội bộ dùng phiếu xuất)</li>
        <li>Trang Công nợ phải thu / phải trả gom khách còn nợ và nhà cung cấp quán còn nợ vào một chỗ</li>
        <li>Menu gọn hơn: gom nhóm Nhân sự &amp; ca làm, Giá &amp; khuyến mãi, Trợ giúp; có dải tab chuyển nhanh giữa các trang cùng nhóm</li>
      </ul>
    </div>

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 0.4.2</strong> <span class="muted" style="font-size:13px;">26/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Hỗ trợ ngay lúc đang bán và nhắc việc thông minh hơn</p>
      <ul class="feature-list" style="--card-accent: var(--qlcf);">
        <li>POS báo số ly còn làm được theo tồn nguyên liệu ("Còn ~N ly", "Hết nguyên liệu") và cảnh báo khi chọn món sắp hết</li>
        <li>Gợi ý bán kèm khi khách gọi món: các món khách thường gọi cùng, tính từ đơn 4 tuần gần nhất</li>
        <li>Đóng ca: kết quả hiện trong khung riêng, kèm gợi ý nguyên nhân khi két lệch (trùng đúng một đơn, một khoản thu hoặc chi trong ca)</li>
        <li>Khi nguyên liệu tăng giá nhập: nêu rõ món nào đã mỏng lãi và nên bán giá bao nhiêu để đạt biên khoảng 60%</li>
        <li>Tổng quan báo giờ cao điểm hôm nay / ngày mai có thể thiếu người khi lịch làm việc chưa đủ ca</li>
      </ul>
      </div>
    </details>

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 0.4.1</strong> <span class="muted" style="font-size:13px;">21/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Chăm sóc khách quen, nhắc sao lưu và bộ cài đáng tin hơn</p>
      <ul class="feature-list" style="--card-accent: var(--qlcf);">
        <li>Chăm sóc khách quen: lời nhắn soạn sẵn (chép dán vào Zalo) cho khách sắp sinh nhật và khách lâu không ghé; tạo voucher sinh nhật dùng 1 lần kèm lời chúc</li>
        <li>Trợ lý thiết lập nhắc sao lưu ra ngoài máy (USB / Google Drive) khi chưa chọn nơi sao lưu hoặc quá vài ngày chưa có bản mới</li>
        <li>Bộ cài hiển thị đầy đủ nhà phát hành và phiên bản (KT-SOFT); bỏ các tệp chạy ẩn dễ bị phần mềm diệt virus nghi ngờ nhầm; "Dừng QLCF-SOFT" an toàn hơn, không đụng ứng dụng khác</li>
      </ul>
    
      </div>
    </details>

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 0.4.0</strong> <span class="muted" style="font-size:13px;">20/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Khách gọi món dễ hơn và trợ lý hỗ trợ người dùng</p>
      <ul class="feature-list" style="--card-accent: var(--qlcf);">
        <li>Mã QR tự nối WiFi: nhập WiFi dành cho khách một lần, thẻ bàn in 2 bước — quét ① để tự nối WiFi (khỏi gõ mật khẩu), quét ② để xem thực đơn và gọi món</li>
        <li>Trợ lý thiết lập trên Tổng quan: chỉ ra chỗ còn thiếu (món chưa có công thức, nguyên liệu chưa có giá vốn, chưa kiểm kê, quên đóng ca...) kèm thanh tiến độ và liên kết để sửa</li>
        <li>Soạn nháp ghi chú bàn giao tự động khi đóng ca: sắp hết hàng, lô cận date, bàn chưa thanh toán, yêu cầu của khách chưa xử lý</li>
        <li>Giá bán gợi ý cho món biên lãi còn mỏng (để đạt biên khoảng 60%)</li>
        <li>Chọn khách quen ngay khi mở bàn: tem pha chế có cảnh báo dị ứng; file Excel nhập nguyên liệu có cột tỷ lệ thành phẩm</li>
      </ul>
      </div>
    </details>

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 0.3.0</strong> <span class="muted" style="font-size:13px;">19/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Thông minh hơn: gợi ý, phân tích, chăm sóc khách quen</p>
      <ul class="feature-list" style="--card-accent: var(--qlcf);">
        <li>Khách quen: ghi dị ứng / kiêng, sở thích, sinh nhật; khi bán, nhập SĐT là hiện món hay gọi (tự tính từ lịch sử mua) và nút "Gọi lại như lần trước"; dị ứng được in lên tem pha chế</li>
        <li>Tổng quan nhắc khách sắp sinh nhật và khách quen lâu không ghé để chăm sóc</li>
        <li>Phân tích thông minh: so với mọi tuần cùng thứ, dự báo doanh thu hôm nay và ngày mai, giờ cao điểm, doanh thu theo thứ, hiệu quả từng món (ngôi sao, bán chạy lãi thấp, lãi cao bán chậm...), món hay mua cùng nhau, so sánh các chi nhánh</li>
        <li>Gợi ý thông minh ngay ở Tổng quan; cảnh báo giá nhập tăng, món lâu không bán được, nhân viên giảm giá cao bất thường</li>
        <li>Gợi ý đặt hàng theo tốc độ dùng thật: nguyên liệu dùng nhanh được nhắc sớm kèm số ngày còn đủ dùng</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Kho chặt chẽ hơn</p>
      <ul class="feature-list" style="--card-accent: var(--qlcf);">
        <li>Tỷ lệ thành phẩm sau sơ chế (vd cam vắt còn 60%): công thức ghi lượng thành phẩm, kho tự trừ đúng lượng nguyên, giá vốn món chính xác hơn</li>
        <li>Kiểm tra chất lượng khi nhận hàng: tick "Không đạt" kèm lý do — hàng trả lại không nhập kho, không tính tiền; báo cáo tỷ lệ trả lại theo nhà cung cấp</li>
        <li>Nhắc "mua rồi mà chưa nhập phiếu": khoản chi quỹ mua nguyên liệu chưa có phiếu nhập khớp, hoặc nguyên liệu đang tồn âm</li>
        <li>File Excel nhập nguyên liệu có thêm cột tỷ lệ thành phẩm</li>
      </ul>
    
      </div>
    </details>

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 0.2.0</strong> <span class="muted" style="font-size:13px;">15/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Vận hành chuẩn cho quán</p>
      <ul class="feature-list" style="--card-accent: var(--qlcf);">
        <li>Bàn giao ca: ghi chú lúc đóng ca, ca sau mở POS thấy ngay ghi chú "Bàn giao từ ca trước"</li>
        <li>Đối soát kho: so nhập, tiêu hao lý thuyết theo công thức và kiểm kê để ra số hao hụt (kèm giá trị), cảnh báo khi hao hụt cao</li>
        <li>Hạn sử dụng nguyên liệu: nhập HSD ở từng dòng phiếu nhập, cảnh báo hàng cũ sắp hết hạn hoặc quá hạn (theo FIFO) ở trang Nhập hàng và Tổng quan</li>
        <li>Việc đầu ca / cuối ca (checklist): mẫu mặc định theo quy trình quán cà phê, chủ quán và quản lý sửa danh sách, xem lịch sử 14 ngày ai làm bao nhiêu %</li>
        <li>Lịch làm việc theo tuần, sao chép từ tuần trước, chặn ca trùng giờ; nhân viên xin đổi ca (trước giờ bắt đầu ít nhất 24 giờ), quản lý duyệt hoặc từ chối</li>
        <li>Thưởng / phạt kèm lý do trong bảng lương theo kỳ; thực nhận = lương giờ làm + thưởng − phạt</li>
        <li>Gợi ý đặt hàng: nguyên liệu chạm ngưỡng tối thiểu kèm số lượng gợi ý, chi phí ước tính, thêm thẳng vào phiếu nhập hoặc sao chép gửi nhà cung cấp</li>
        <li>Dữ liệu mẫu 1 tuần có đủ các mục trên để xem thử</li>
      </ul>
      </div>
    </details>

    <details class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px;">
      <summary><strong>Phiên bản 0.1.0</strong> <span class="muted" style="font-size:13px;">14/10/2026</span></summary>
      <div class="changelog-body">
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng</p>
      <ul class="feature-list" style="--card-accent: var(--qlcf);">
        <li>Bán hàng bấm ly (size/đường/đá/topping), in tem ly theo số ly, màn hình pha chế, quản lý khu vực – bàn và bàn đặt trước</li>
        <li>Thực đơn, giá theo ca/khu vực, voucher; mã QR chuyển khoản VietQR</li>
        <li>Kho nguyên liệu, nhập hàng, công thức pha chế, tự trừ kho khi bán, cảnh báo sắp hết, báo cáo giá vốn/lợi nhuận theo món</li>
        <li>Mở/đóng ca đối chiếu tiền mặt, sổ quỹ, báo cáo bán hàng và biểu đồ doanh thu</li>
        <li>Chấm công theo ca, bảng lương theo giờ, nhiều chi nhánh, phân quyền chủ quán / quản lý / thu ngân</li>
        <li>Điều khoản sử dụng hiển thị khi cài đặt, giấy phép thư viện bên thứ ba, sao lưu và khôi phục dữ liệu</li>
      </ul>
      </div>
    </details>
  </div>
</section>

<section class="section" id="huong-dan-cai-dat" style="border-top:1px solid #eee; background:#f8fafc;">
  <div class="container">
    <h2 style="margin-bottom:6px;">Cài đặt và cập nhật — không mất dữ liệu</h2>
    <p class="desc" style="margin-top:0;">
      Phần mềm cài vào thư mục riêng của người dùng Windows (không cần quyền quản trị). Dữ liệu của bạn
      nằm trong thư mục <code>data</code> bên trong thư mục cài, tách biệt với chương trình: cài đè bản mới
      <b>không đụng đến thư mục này</b>.
    </p>
    <ol class="feature-list" style="--card-accent: var(--qlcf); list-style:decimal; padding-left:20px;">
      <li>Tải bộ cài bằng nút bên dưới và chạy file <code>QLCF-SOFT-Setup.exe</code>.</li>
      <li>Đọc và chọn <b>Tôi đồng ý</b> ở trang Thỏa thuận sử dụng, bấm Cài đặt.</li>
      <li>Mở phần mềm từ biểu tượng QLCF-SOFT vừa cài, thiết lập cửa hàng và tạo tài khoản chủ quán ở lần đầu.</li>
      <li>Cập nhật bản mới: chạy bộ cài mới, không cần gỡ bản cũ; dữ liệu, tài khoản, mật khẩu đều giữ nguyên. Cẩn thận hơn, vào mục <b>Hệ thống &amp; sao lưu</b> tải một bản sao lưu trước khi cập nhật.</li>
    </ol>
    <div style="border:1px solid #fcd34d; background:#fffbeb; border-radius:10px; padding:14px 16px; margin:14px 0;">
      <b>Windows hoặc trình duyệt cảnh báo khi tải/cài đặt?</b>
      <p style="margin:6px 0 0;">
        Phần mềm chưa có chứng chỉ ký số của nhà phát hành nên Windows SmartScreen có thể hiện "Windows protected your PC"
        hoặc "Unknown publisher". Đây là cảnh báo thông thường với phần mềm chưa ký số, không phải do file bị lỗi. Bạn làm như sau:
      </p>
      <ol style="margin:8px 0 0; padding-left:20px;">
        <li>Trình duyệt (Chrome/Edge) hỏi giữ file: bấm <b>Giữ lại</b> (Keep).</li>
        <li>Windows hiện hộp xanh "Windows protected your PC": bấm <b>More info</b> (Thông tin thêm), rồi bấm <b>Run anyway</b> (Vẫn chạy).</li>
        <li>Không thấy nút "More info": bấm chuột phải vào file → Properties → tích <b>Unblock</b> → OK, rồi mở lại.</li>
        <li>Nếu phần mềm diệt virus chặn: cho phép/ngoại lệ với file <code>QLCF-SOFT-Setup.exe</code> rồi chạy lại.</li>
      </ol>
      <p style="margin:8px 0 0; font-size:13px; color:#666;">
        Chỉ tải bộ cài từ trang kt-soft.vn này. Nếu muốn kiểm tra thêm, có thể gửi file lên virustotal.com để quét trước khi cài.
      </p>
    </div>
    <div class="cta-row">
      <a href="download.php?p=qlcf-soft" class="btn">⬇️ Tải bản 0.4.3 mới nhất</a>
    </div>
  </div>
</section>

<section class="section" style="padding-top:0;">
  <div class="container">
    <p class="muted" style="font-size:12.5px;margin:0;">
      <b>Quyền riêng tư:</b> dữ liệu bán hàng nằm hoàn toàn trên máy của bạn. Phần mềm chỉ gửi về kt-soft.vn một tín hiệu ẩn danh (mã cài đặt ngẫu nhiên và số phiên bản, tối đa 1 lần/ngày) để chúng tôi biết số máy đang dùng; bạn có thể tắt tại Hệ thống &amp; sao lưu. Phiếu in ghi "Phiếu thanh toán" — không thay thế hóa đơn giá trị gia tăng. Xem <a href="dieu-khoan.php">Điều khoản sử dụng</a> và <a href="quyen-rieng-tu.php">Chính sách quyền riêng tư</a>.
    </p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="cta-band">
      <div>
        <h2>Quán của bạn có phù hợp với QLCF-SOFT?</h2>
        <p>Phù hợp quán cà phê, trà sữa, quán nước từ một đến nhiều chi nhánh. Quán bán lẻ tạp hóa, siêu thị mini nên xem thêm QLBH-SOFT hoặc QLBH-CLOUD.</p>
      </div>
      <a href="download.php?p=qlcf-soft" class="btn">⬇️ Tải về dùng miễn phí</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
