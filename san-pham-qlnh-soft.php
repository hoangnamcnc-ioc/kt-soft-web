<?php
require_once __DIR__ . '/inc_download.php';

$pageTitle = 'QLNH-SOFT — Phần mềm quản lý nhà hàng, quán ăn | KT-SOFT';
$pageDesc = 'QLNH-SOFT là phần mềm quản lý nhà hàng, quán ăn: sơ đồ bàn theo khu và phòng VIP, đặt bàn có tiền cọc, ra món theo lượt, màn hình bếp và bar, kho nguyên liệu, khách quen, nhiều chi nhánh. Cài trên máy Windows.';
require_once __DIR__ . '/inc_header.php';

$luotTai = doc_luot_tai('qlnh-soft');
$danhGia = doc_danh_gia('qlnh-soft');
$daDanhGia = !empty($_COOKIE['danhgia_qlnh-soft']);
?>

<section class="hero" style="padding-bottom:0;">
  <div class="container">
    <span class="eyebrow" style="background:var(--qlnh-bg);color:var(--qlnh);">🍽️ QLNH-SOFT · Cài trên máy Windows</span>
    <h1>Phần mềm quản lý nhà hàng, quán ăn — bàn, phòng VIP, bếp và kho trong một màn hình</h1>
    <p class="lead">
      Sơ đồ bàn theo khu (trong nhà, sân vườn, phòng VIP), đặt bàn có tiền cọc, gọi món và ra món theo lượt,
      màn hình bếp và bar, kho nguyên liệu có hạn dùng, chăm sóc khách quen. Dùng được cho một nhà hàng
      hoặc cả chuỗi nhiều chi nhánh.
    </p>
    <div class="cta-row">
      <a href="download.php?p=qlnh-soft" class="btn">⬇️ Tải về dùng miễn phí</a>
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
          <input type="hidden" name="p" value="qlnh-soft">
          <input type="hidden" name="back" value="san-pham-qlnh-soft.php">
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
        <span class="tag" style="--card-accent: var(--qlnh); --card-bg: var(--qlnh-bg);">Bàn, phòng &amp; ra món</span>
        <h2>Từ đặt bàn đến lúc khách thanh toán, mọi bước đều rõ ràng</h2>
        <p class="desc">
          Mỗi khu có phí phục vụ, phí phòng và mức chi tối thiểu riêng. Món được gọi theo lượt
          (khai vị, món chính, tráng miệng) để bếp ra món đúng lúc khách sẵn sàng.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlnh);">
          <li>Sơ đồ bàn theo khu; chuyển, gộp bàn, tách bill; cảnh báo khi số khách vượt sức chứa</li>
          <li>Đặt bàn có tiền cọc: cọc tự trừ vào hoá đơn khi khách nhận bàn, hoàn cọc có phiếu chi</li>
          <li>Phòng VIP: phí phòng cố định, mức chi tối thiểu tự thu bù phần chênh</li>
          <li>Set / combo giá trọn gói; khách quét QR tự gọi món</li>
          <li>Màn hình bếp và quầy bar theo lượt; xoá món đã gửi bếp thì bếp nhận thông báo "DỪNG LÀM"</li>
        </ul>
      </div>
      <div class="mock" style="--card-bg: var(--qlnh-bg); --card-accent: var(--qlnh);">
        <div class="mock-title">Phòng VIP 2 · đang phục vụ</div>
        <div class="mock-row"><span>Set lẩu hải sản (6 người)</span><b>1.890.000đ</b></div>
        <div class="mock-row"><span>Phí phòng + phục vụ 10%</span><b>350.000đ</b></div>
        <div class="mock-row"><span>Tiền cọc đã trừ</span><b>-500.000đ</b></div>
        <div class="mock-row"><span>Trạng thái</span><span class="badge">Chờ gọi món chính</span></div>
      </div>
    </div>
  </div>
</section>

<section class="product-detail reverse">
  <div class="container">
    <div class="grid">
      <div class="mock" style="--card-bg: var(--qlnh-bg); --card-accent: var(--qlnh);">
        <div class="mock-title">Việc cần làm hôm nay</div>
        <div class="mock-row"><span>Nguyên liệu gần hết hạn</span><span class="badge">Tôm sú · Sò điệp</span></div>
        <div class="mock-row"><span>Dự báo cuối tuần</span><b>~120 khách</b></div>
        <div class="mock-row"><span>Khách quen lâu chưa ghé</span><b>8 người</b></div>
      </div>
      <div>
        <span class="tag" style="--card-accent: var(--qlnh); --card-bg: var(--qlnh-bg);">Kho, khách quen &amp; thông minh</span>
        <h2>Kiểm soát thất thoát, nhớ khẩu vị khách, biết trước để chuẩn bị</h2>
        <p class="desc">
          Kho trừ theo công thức và tỷ lệ thành phẩm, theo dõi lô và hạn dùng. Phần mềm tự tổng hợp
          từ dữ liệu có sẵn để nhắc việc, gợi ý đặt hàng và cảnh báo bất thường.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlnh);">
          <li>Lô &amp; hạn dùng, hủy hàng có lý do, đơn đặt hàng nhà cung cấp, kiểm kê luân phiên, báo cáo thất thoát</li>
          <li>Khách quen: dị ứng, kiêng, món yêu thích, sinh nhật — hiện ở bàn và phiếu bếp (chỉ lưu khi khách đồng ý)</li>
          <li>Dự báo ngày, dự báo tiêu thụ nguyên liệu, gợi ý món gọi kèm, phân tích thực đơn và giờ cao điểm</li>
          <li>Mở ca/đóng ca đối chiếu tiền mặt, chấm công, lương theo giờ; phân quyền chủ / quản lý / thu ngân / bếp</li>
          <li>Sao lưu và khôi phục ngay trong phần mềm; dữ liệu lưu trên máy của bạn</li>
        </ul>
        <div class="cta-row">
          <a href="download.php?p=qlnh-soft" class="btn">⬇️ Tải về dùng miễn phí</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" style="border-top:1px solid #eee;">
  <div class="container">
    <h2 style="margin-bottom:6px;">Lịch sử cập nhật</h2>
    <p class="desc" style="margin-top:0;margin-bottom:24px;">
      Cài bản mới đè lên bản cũ (không cần gỡ cài đặt) — dữ liệu của bạn được giữ nguyên.
      Xem <a href="#huong-dan-cai-dat">hướng dẫn cài đặt và cập nhật</a> bên dưới.
    </p>
    <div class="changelog-item" style="border-left:3px solid var(--qlnh, #be123c); padding-left:16px; margin-bottom:22px;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.0.0 <span style="font-size:12px;font-weight:700;color:var(--qlnh);background:var(--qlnh-bg);padding:2px 8px;border-radius:10px;vertical-align:middle;">Mới nhất</span></h3>
        <span class="muted" style="font-size:13px;">26/10/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Bản đầu tiên</p>
      <ul class="feature-list" style="--card-accent: var(--qlnh);">
        <li>Quản lý bàn, phòng VIP, đặt bàn có cọc, ra món theo lượt, màn hình bếp và bar</li>
        <li>Kho nguyên liệu có lô &amp; hạn dùng, hủy hàng, đặt hàng nhà cung cấp</li>
        <li>Khách quen và sở thích, chốt ca, nhân sự, các gợi ý và cảnh báo thông minh</li>
      </ul>
    </div>
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
    <ol class="feature-list" style="--card-accent: var(--qlnh); list-style:decimal; padding-left:20px;">
      <li>Tải bộ cài bằng nút bên dưới và chạy file <code>QLNH-SOFT-Setup.exe</code>.</li>
      <li>Đọc và chọn <b>Tôi đồng ý</b> ở trang Thỏa thuận sử dụng, bấm Cài đặt.</li>
      <li>Mở phần mềm từ biểu tượng QLNH-SOFT vừa cài, thiết lập cửa hàng và tạo tài khoản chủ nhà hàng ở lần đầu.</li>
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
        <li>Nếu phần mềm diệt virus chặn: cho phép/ngoại lệ với file <code>QLNH-SOFT-Setup.exe</code> rồi chạy lại.</li>
      </ol>
      <p style="margin:8px 0 0; font-size:13px; color:#666;">
        Chỉ tải bộ cài từ trang kt-soft.vn này. Nếu muốn kiểm tra thêm, có thể gửi file lên virustotal.com để quét trước khi cài.
      </p>
    </div>
    <div class="cta-row">
      <a href="download.php?p=qlnh-soft" class="btn">⬇️ Tải bản 1.0.0 mới nhất</a>
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
        <h2>Nhà hàng của bạn có phù hợp với QLNH-SOFT?</h2>
        <p>Phù hợp nhà hàng, quán ăn từ một đến nhiều chi nhánh. Quán cà phê, trà sữa nên xem QLCF-SOFT; cửa hàng bán lẻ nên xem QLBH-SOFT hoặc QLBH-CLOUD.</p>
      </div>
      <a href="download.php?p=qlnh-soft" class="btn">⬇️ Tải về dùng miễn phí</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
