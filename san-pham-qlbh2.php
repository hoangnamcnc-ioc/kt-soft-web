<?php
$pageTitle = 'QLBH-CLOUD — Phần mềm quản lý bán hàng đa chi nhánh | KT-SOFT';
$pageDesc = 'QLBH-CLOUD là phần mềm quản lý bán hàng chạy trên trình duyệt: POS, kho, khách hàng, khuyến mại, bảo hành, sổ quỹ và ước tính thuế hộ kinh doanh, quản lý được nhiều chi nhánh.';
require_once __DIR__ . '/inc_header.php';
?>

<section class="hero" style="padding-bottom:0;">
  <div class="container">
    <span class="eyebrow" style="background:var(--qlbh2-bg);color:var(--qlbh2);">☁️ QLBH-CLOUD · Đang vận hành tại app.kt-soft.vn</span>
    <h1>Quản lý bán hàng đa chi nhánh, gọn trong 1 trình duyệt</h1>
    <p class="lead">
      Bán hàng tại quầy, theo dõi tồn kho từng chi nhánh, chăm sóc khách hàng thân thiết và quản lý
      dòng tiền — tất cả trong một phần mềm chạy trực tiếp trên web, không cần cài đặt.
    </p>
    <div class="cta-row">
      <a href="https://app.kt-soft.vn/dang-ky.php" class="btn" target="_blank" rel="noopener">Dùng thử ngay →</a>
      <a href="lien-he.php" class="btn btn-ghost">Yêu cầu tư vấn</a>
    </div>
  </div>
</section>

<section class="product-detail" style="border-top:none;">
  <div class="container">
    <div class="grid">
      <div>
        <span class="tag" style="--card-accent: var(--qlbh2); --card-bg: var(--qlbh2-bg);">Bán hàng &amp; Kho</span>
        <h2>Bán nhanh tại quầy, tồn kho luôn đúng theo từng chi nhánh</h2>
        <p class="desc">
          Màn hình bán hàng (POS) tối ưu cho thao tác nhanh, tự trừ kho ngay khi hoàn tất đơn.
          Mỗi chi nhánh có tồn kho riêng, nhân viên thu ngân chỉ thấy đúng số liệu chi nhánh mình.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlbh2);">
          <li>Bán hàng POS, tìm sản phẩm theo tên/SKU/mã vạch</li>
          <li>Quản lý kho theo từng chi nhánh, cảnh báo dưới định mức</li>
          <li>Kiểm hàng, chuyển hàng giữa các chi nhánh có xác nhận 2 chiều</li>
          <li>Nhập hàng, quản lý nhà cung cấp và công nợ phải trả</li>
          <li>Đơn giao hàng riêng ngoài quầy, sao chép đơn nhanh, biểu phí tự động theo khu vực</li>
        </ul>
      </div>
      <div class="mock" style="--card-bg: var(--qlbh2-bg); --card-accent: var(--qlbh2);">
        <div class="mock-title">Tổng quan · Chi nhánh Quận 1</div>
        <div class="mock-row"><span>Doanh thu hôm nay</span><b>12.450.000đ</b></div>
        <div class="mock-row"><span>Đơn hàng mới</span><b>18</b></div>
        <div class="mock-row"><span>Chờ đóng gói</span><span class="badge">4 đơn</span></div>
        <div class="mock-row"><span>Sản phẩm dưới định mức</span><span class="badge">3 SP</span></div>
      </div>
    </div>
  </div>
</section>

<section class="product-detail reverse">
  <div class="container">
    <div class="grid">
      <div class="mock" style="--card-bg: var(--qlbh2-bg); --card-accent: var(--qlbh2);">
        <div class="mock-title">Khách hàng thân thiết</div>
        <div class="mock-row"><span>Nguyễn Thị Lan</span><span class="badge">Hạng Vàng</span></div>
        <div class="mock-row"><span>Điểm tích lũy</span><b>1.240 điểm</b></div>
        <div class="mock-row"><span>Công nợ hiện tại</span><b>350.000đ</b></div>
      </div>
      <div>
        <span class="tag" style="--card-accent: var(--qlbh2); --card-bg: var(--qlbh2-bg);">Khách hàng &amp; Marketing</span>
        <h2>Giữ chân khách quen bằng chương trình tích điểm thật</h2>
        <p class="desc">
          Phân nhóm khách hàng, tích điểm đổi quà, chạy khuyến mại và mã giảm giá theo từng dịp —
          đồng thời theo dõi công nợ khách hàng ngay trên từng đơn.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlbh2);">
          <li>Khách hàng thân thiết theo hạng, quà tặng đổi điểm</li>
          <li>Khuyến mại, mã giảm giá, chiến dịch marketing theo đợt</li>
          <li>Đặt hàng online công khai, không cần khách đăng nhập</li>
          <li>Phiếu bảo hành tự tạo theo từng sản phẩm khi hoàn tất đơn</li>
          <li>Theo dõi mọi yêu cầu bảo hành, cấu hình kênh gửi marketing (SMS/Email)</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="product-detail">
  <div class="container">
    <div class="grid">
      <div>
        <span class="tag" style="--card-accent: var(--qlbh2); --card-bg: var(--qlbh2-bg);">Tài chính &amp; Bảo mật</span>
        <h2>Sổ quỹ khớp thật, ước tính thuế theo đúng luật hiện hành</h2>
        <p class="desc">
          Mọi khoản thu chi (bán hàng, thu nợ, trả nợ nhà cung cấp) tự động vào sổ quỹ — không cần
          nhập tay 2 lần. Ước tính thuế hộ kinh doanh theo ngưỡng và tỷ lệ hiện hành.
        </p>
        <ul class="feature-list" style="--card-accent: var(--qlbh2);">
          <li>Sổ quỹ tự động khớp với dòng tiền bán hàng thực tế</li>
          <li>Ước tính thuế GTGT/TNCN hộ kinh doanh, sổ doanh thu S1a/S2a-HKD</li>
          <li>Phân quyền theo vai trò và chi nhánh, khóa màn hình khi rời máy</li>
          <li>Sao lưu dữ liệu 1-click, tự động giữ 20 bản gần nhất</li>
        </ul>
        <div class="cta-row">
          <a href="https://app.kt-soft.vn/dang-ky.php" class="btn" target="_blank" rel="noopener">Trải nghiệm QLBH-CLOUD →</a>
        </div>
      </div>
      <div class="mock" style="--card-bg: var(--qlbh2-bg); --card-accent: var(--qlbh2);">
        <div class="mock-title">Ước tính thuế hộ kinh doanh</div>
        <div class="mock-row"><span>Doanh thu năm</span><b>1.500.000.000đ</b></div>
        <div class="mock-row"><span>Thuế GTGT ước tính (1%)</span><b>15.000.000đ</b></div>
        <div class="mock-row"><span>Thuế TNCN ước tính (0,5%)</span><b>2.500.000đ</b></div>
      </div>
    </div>
  </div>
</section>

<section class="section" style="border-top:1px solid #eee;">
  <div class="container">
    <h2 style="margin-bottom:6px;">Lịch sử cập nhật</h2>
    <p class="desc" style="margin-top:0;margin-bottom:24px;">
      QLBH-CLOUD chạy hoàn toàn trên trình duyệt (SaaS) — mọi bản cập nhật được áp dụng tự động
      ngay trên app.kt-soft.vn, bạn không cần cài đặt hay làm gì thêm.
    </p>

    <div class="changelog-item" style="border-left:3px solid var(--qlbh2); padding-left:16px; margin-bottom:22px;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Cập nhật 23/09/2026</h3>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--qlbh2);">
        <li>Tạo đơn giao hàng riêng (không cần đứng tại quầy) — dùng cho đơn đặt qua điện thoại, mạng xã hội</li>
        <li>Sao chép đơn hàng cũ chỉ 1 cú nhấp — khách đặt lại y hệt lần trước rất nhanh</li>
        <li>Xuất file Excel danh sách đơn hàng, đúng theo bộ lọc đang xem trên màn hình</li>
        <li>Chọn nhân viên bán hàng khác khi thu ngân bận — đúng người, đúng hoa hồng, đúng bảng lương</li>
        <li>Biểu phí giao hàng theo khu vực, tự động điền khi nhập địa chỉ giao hàng</li>
        <li>Tổng quan vận chuyển: đếm vận đơn theo từng trạng thái, biết ngay đang tồn ở khâu nào</li>
        <li>Cấu hình kênh marketing (tên người gửi, brandname SMS, chân trang tin nhắn)</li>
        <li>Danh sách yêu cầu bảo hành — theo dõi tất cả yêu cầu ở một chỗ, không cần mở từng phiếu</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Vá lỗi &amp; nâng cao độ tin cậy</p>
      <ul class="feature-list" style="--card-accent: var(--qlbh2);">
        <li>Nút Thanh toán luôn hiển thị sẵn trên màn hình bán hàng, không phải cuộn trang mỗi lần tính tiền — cả trên máy tính lẫn điện thoại</li>
        <li>Tăng cường cách ly dữ liệu giữa các cửa hàng dùng chung hệ thống, rà soát và vá nhiều lỗ hổng bảo mật</li>
        <li>Form thêm sản phẩm: đưa "Tên sản phẩm" lên ô đầu tiên, dễ nhập hơn cho người mới</li>
        <li>Các trang danh sách còn trống (chưa có sản phẩm, đơn hàng...) chỉ rõ bước tiếp theo cần làm</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Trước đó</h3>
      </div>
      <p class="desc" style="margin:8px 0 0;">
        Ra mắt bản dùng thử tự đăng ký (miễn phí 12 tháng), mỗi cửa hàng có dữ liệu tách biệt hoàn
        toàn dù dùng chung hệ thống. Bán hàng tại quầy, quản lý kho đa chi nhánh, khách hàng &amp;
        công nợ, nhập hàng &amp; nhà cung cấp, khuyến mại &amp; tích điểm, sổ quỹ, ước tính thuế hộ
        kinh doanh, sao lưu dữ liệu tự động.
      </p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="cta-band">
      <div>
        <h2>Sẵn sàng dùng thử QLBH-CLOUD?</h2>
        <p>Truy cập trực tiếp, không cần cài đặt — hoặc liên hệ để được tư vấn cấu hình chi nhánh phù hợp.</p>
      </div>
      <a href="https://app.kt-soft.vn/dang-ky.php" class="btn" target="_blank" rel="noopener">Đăng ký dùng thử →</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
