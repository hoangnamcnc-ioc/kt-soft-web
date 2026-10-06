<?php
require_once __DIR__ . '/inc_download.php';

$pageTitle = 'KT-SOFT Kế toán — Phần mềm kế toán theo Thông tư 133/2016/TT-BTC';
$pageDesc = 'Phần mềm kế toán desktop cho hộ kinh doanh và doanh nghiệp nhỏ, theo đúng Thông tư 133/2016/TT-BTC. Có hóa đơn điện tử, tải hóa đơn từ Tổng cục Thuế, báo cáo tài chính.';
require_once __DIR__ . '/inc_header.php';

$luotTai = doc_luot_tai('ke-toan');
$danhGia = doc_danh_gia('ke-toan');
$daDanhGia = !empty($_COOKIE['danhgia_ke-toan']);
?>

<section class="hero" style="padding-bottom:0;">
  <div class="container">
    <span class="eyebrow" style="background:var(--ketoan-bg);color:var(--ketoan);">🧾 KT-SOFT Kế toán · Theo Thông tư 133/2016/TT-BTC</span>
    <h1>Phần mềm kế toán cho hộ kinh doanh và doanh nghiệp nhỏ</h1>
    <p class="lead">
      Sổ sách, hóa đơn điện tử, kê khai đúng chuẩn Thông tư 133/2016/TT-BTC — chạy trên máy tính cá nhân,
      không cần thuê kế toán dịch vụ cho những nghiệp vụ cơ bản hàng ngày.
    </p>
    <div class="cta-row">
      <a href="download.php?p=ke-toan" class="btn" style="background:var(--ketoan);">⬇️ Tải về dùng miễn phí</a>
      <a href="https://hocketoanthue.vn/phan-mem" class="btn btn-ghost" target="_blank" rel="noopener">Xem tại hocketoanthue.vn →</a>
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
          <input type="hidden" name="p" value="ke-toan">
          <input type="hidden" name="back" value="san-pham-ke-toan.php">
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
        <span class="tag" style="--card-accent: var(--ketoan); --card-bg: var(--ketoan-bg);">Sổ sách &amp; Hóa đơn</span>
        <h2>Ghi sổ đúng chuẩn, không cần thuộc lòng nghiệp vụ kế toán</h2>
        <p class="desc">
          Phần mềm hướng dẫn từng bước theo đúng biểu mẫu Thông tư 133/2016/TT-BTC, phù hợp với
          hộ kinh doanh và doanh nghiệp nhỏ tự làm sổ sách mà không cần thuê ngoài.
        </p>
        <ul class="feature-list" style="--card-accent: var(--ketoan);">
          <li>Sổ sách kế toán theo đúng mẫu Thông tư 133/2016/TT-BTC</li>
          <li>Quản lý hóa đơn đầu vào/đầu ra, bảng kê theo kỳ</li>
          <li>Tải hóa đơn điện tử (mua vào &amp; bán ra) trực tiếp từ Tổng cục Thuế, tự đối chiếu với sổ sách</li>
          <li>Phát hành hóa đơn điện tử qua Viettel S-Invoice ngay trong phần mềm</li>
          <li>Hỗ trợ lập tờ khai thuế GTGT, TNCN, TNDN theo mẫu mới nhất</li>
          <li>Xuất báo cáo, bảng kê dạng Excel/XML để nộp cơ quan thuế</li>
        </ul>
        <div class="cta-row">
          <a href="download.php?p=ke-toan" class="btn" style="background:var(--ketoan);">⬇️ Tải về dùng miễn phí</a>
        </div>
      </div>
      <div class="mock" style="--card-bg: var(--ketoan-bg); --card-accent: var(--ketoan);">
        <div class="mock-title">Bảng kê hóa đơn đầu vào</div>
        <div class="mock-row"><span>Kỳ kê khai</span><b>Tháng 7/2026</b></div>
        <div class="mock-row"><span>Số hóa đơn đã ghi nhận</span><b>42 hóa đơn</b></div>
        <div class="mock-row"><span>Trạng thái tờ khai</span><span class="badge">Sẵn sàng xuất</span></div>
      </div>
    </div>
  </div>
</section>

<section class="product-detail reverse">
  <div class="container">
    <div class="grid">
      <div class="mock" style="--card-bg: var(--ketoan-bg); --card-accent: var(--ketoan);">
        <div class="mock-title">Kiểm tra trước khi khóa sổ</div>
        <div class="mock-row"><span>Khấu trừ thuế GTGT</span><span class="badge">Đã bù trừ</span></div>
        <div class="mock-row"><span>Khấu hao TSCĐ tháng 7</span><span class="badge">Đã hạch toán</span></div>
        <div class="mock-row"><span>Tạm tính thuế TNDN</span><b>16.000.000đ</b></div>
      </div>
      <div>
        <span class="tag" style="--card-accent: var(--ketoan); --card-bg: var(--ketoan-bg);">Báo cáo tài chính</span>
        <h2>Bảng kiểm trước khi kết chuyển, không sợ bỏ sót</h2>
        <p class="desc">
          Trước khi khóa sổ cuối kỳ, phần mềm tự rà soát và cảnh báo nếu còn thiếu bút toán khấu hao,
          phân bổ công cụ dụng cụ, lương, khấu trừ thuế GTGT hoặc tạm tính thuế TNDN.
        </p>
        <ul class="feature-list" style="--card-accent: var(--ketoan);">
          <li>Tự động bù trừ thuế GTGT đầu vào/đầu ra, tạm tính và hạch toán thuế TNDN</li>
          <li>Bảng cân đối kế toán, kết quả kinh doanh theo đúng mẫu Thông tư 133</li>
          <li>Công cụ ước tính thuế TNCN/GTGT hộ kinh doanh theo Luật 109/2025</li>
          <li>Mật khẩu người dùng được mã hóa, toàn bộ dữ liệu lưu trên máy của bạn</li>
        </ul>
        <div class="cta-row">
          <a href="download.php?p=ke-toan" class="btn" style="background:var(--ketoan);">⬇️ Tải về dùng miễn phí</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" style="border-top:1px solid #eee;">
  <div class="container">
    <h2 style="margin-bottom:6px;">Lịch sử cập nhật</h2>
    <p class="desc" style="margin-top:0;margin-bottom:24px;">
      Cài bản mới đè lên bản cũ (không cần gỡ cài đặt) — toàn bộ dữ liệu sổ sách, chứng từ, hóa đơn
      của bạn được giữ nguyên. Xem <a href="#huong-dan-cap-nhat">hướng dẫn cập nhật an toàn</a> bên dưới.
    </p>

    <div class="changelog-item" style="border-left:3px solid var(--ketoan, #d97706); padding-left:16px; margin-bottom:22px;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.8</h3>
        <span class="muted" style="font-size:13px;">06/10/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Vá lỗi</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Bảng cân đối kế toán luôn cân đối ở mọi thời điểm: lãi/lỗ chưa kết chuyển được tính vào vốn chủ sở hữu (trước đây chưa khóa sổ thì bị báo lệch đúng bằng số lãi/lỗ kỳ đó)</li>
        <li>Rà soát dữ liệu phát hiện thêm hóa đơn nhập trùng khi bị gắn nhầm nhà cung cấp (cùng số hóa đơn, cùng số tiền nhưng khác nhà cung cấp/ký hiệu)</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.7</h3>
        <span class="muted" style="font-size:13px;">06/10/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Nút <b>"Sửa phiếu nhập cũ từ file XML"</b> ở màn hình Đối chiếu hóa đơn điện tử: tự sửa ký hiệu hóa đơn và nhà cung cấp của các phiếu đã lập sai bằng bản cũ, không đụng số tiền hay kho</li>
        <li>Màn hình Kết chuyển có danh sách <b>"Việc cần làm cuối kỳ"</b> (khấu hao, phân bổ CCDC, lương, rà soát dữ liệu, khấu trừ GTGT, tạm tính TNDN, kết chuyển, khóa sổ) - việc nào đã làm/chưa làm, làm ở đâu</li>
        <li>Rà soát dữ liệu mở rộng: phát hiện phiếu nhập thiếu nhà cung cấp/số hóa đơn, ký hiệu hóa đơn đáng ngờ, hóa đơn bị nhập trùng, công nợ sai chiều</li>
        <li>Tự sao lưu nguyên file dữ liệu mỗi khi nâng cấp lên phiên bản mới, trước khi cập nhật cấu trúc dữ liệu</li>
        <li>Thêm hướng dẫn tải hóa đơn từ Tổng cục Thuế từng bước trong phần Hướng dẫn sử dụng</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Cải thiện</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Mọi bút toán mới đều được làm tròn về đồng nguyên, số sổ khớp hóa đơn, không tích lũy sai số lẻ</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.6</h3>
        <span class="muted" style="font-size:13px;">05/10/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Cải thiện</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Phiếu nhập mua từ hóa đơn điện tử: giá vốn nhập kho tính bằng thành tiền chia số lượng nên giá trị tồn kho khớp tuyệt đối với sổ cái, còn cột "Đơn giá" vẫn hiển thị đúng như trên hóa đơn gốc (lưu riêng, không bị làm tròn ảnh hưởng đến kho)</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.5</h3>
        <span class="muted" style="font-size:13px;">05/10/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Vá lỗi &amp; cải thiện</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Nhập phiếu nhập mua từ file XML hóa đơn điện tử tải về từ Tổng cục Thuế: phiếu ghi đúng từng con số như hóa đơn gốc — thành tiền từng dòng, thuế GTGT theo từng thuế suất và tổng thanh toán — không còn lệch vài đồng đến vài chục đồng khi đối chiếu</li>
        <li>Ô "Đơn giá" trong phiếu nhập mua, hóa đơn bán hàng và các phiếu trả hàng cho nhập số lẻ (tối đa 4 chữ số thập phân) như trên hóa đơn, không còn bị làm tròn về đồng</li>
        <li>Xem chi tiết phiếu nhập mua có thêm các dòng Cộng tiền hàng, Thuế GTGT và Tổng cộng ở cuối</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.4</h3>
        <span class="muted" style="font-size:13px;">05/10/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Cải thiện giao diện</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Dòng đang được chọn trong các bảng luôn tô màu cam đậm, chữ đậm, dễ nhìn — kể cả sau khi bấm sang nút khác (trước đây chuyển sang xám nhạt rất khó thấy)</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.3</h3>
        <span class="muted" style="font-size:13px;">05/10/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Cải thiện giao diện</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Tất cả các bảng trong phần mềm tự động giãn cột vừa nội dung và lấp đầy chiều ngang màn hình, không còn phải kéo chỉnh từng cột bằng tay</li>
        <li>Chữ dài tự xuống dòng thay vì bị che hoặc phải cuộn ngang; vẫn kéo chỉnh tay được, và bảng nào bạn đã tự chỉnh thì phần mềm giữ nguyên</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.2</h3>
        <span class="muted" style="font-size:13px;">05/10/2026</span>
        <span class="badge" style="background:#fee2e2;color:#991b1b;">Khuyến nghị cập nhật</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Vá lỗi quan trọng</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Sửa lỗi nhập hóa đơn điện tử (XML) đọc nhầm <b>ký hiệu hóa đơn</b> thành mẫu số ("1" thay vì "C26TKK"), khiến phiếu nhập mua lưu sai ký hiệu và chức năng Đối chiếu hóa đơn điện tử luôn báo "CHƯA NHẬP"</li>
        <li>Sửa lỗi nhập hàng loạt nhiều hóa đơn của các người bán khác nhau: từ hóa đơn thứ 2 trở đi bị gán nhầm nhà cung cấp của hóa đơn trước. Nếu bạn đã nhập hàng loạt bằng bản cũ, nên xóa các phiếu nhập mua đó và nhập lại bằng bản này</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.1</h3>
        <span class="muted" style="font-size:13px;">30/09/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Vá lỗi</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Sửa lỗi "Đối chiếu hóa đơn điện tử" báo TẤT CẢ hóa đơn là "CHƯA NHẬP" dù đã lập đúng Phiếu nhập mua: số hóa đơn trong file XML gốc đệm đủ 8 chữ số (ví dụ "12357" ghi thành "00012357") nhưng file Excel/màn hình tra cứu của GDT lại hiển thị không đệm số 0, khiến so sánh bị lệch</li>
        <li>Sửa cảnh báo trùng hóa đơn khi nhập không nhận ra hóa đơn đã có sẵn nếu số hóa đơn đệm số 0 khác nhau giữa 2 lần nhập</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.2.0</h3>
        <span class="muted" style="font-size:13px;">30/09/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Gửi email đối chiếu công nợ cuối kỳ/cuối năm cho khách hàng và nhà cung cấp ngay trong phần mềm — chỉ cần khai báo email trong Danh mục đối tượng công nợ</li>
        <li>In hàng loạt nhiều Phiếu thu/Phiếu chi cùng lúc, không phải in từng phiếu một</li>
        <li>Bù trừ công nợ: cho phép chọn thủ công cặp khách hàng/nhà cung cấp khi không tự động khớp được mã số thuế</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Cải thiện</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Ẩn menu "Hệ thống báo cáo HKD và DNSSN" khi đơn vị là Doanh nghiệp thông thường (không áp dụng)</li>
        <li>Viết lại hoàn toàn cách tải hóa đơn từ Tổng cục Thuế: bạn tự tra cứu trên chính trình duyệt (đúng như thao tác quen thuộc), phần mềm chỉ gom kết quả và tự động bấm tải từng hóa đơn - khắc phục dứt điểm lỗi bị chặn/tải nhầm file trước đây</li>
        <li>Áp trần đóng BHXH/BHYT/BHTN theo lương cơ sở/lương tối thiểu vùng khi tính bảng lương</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.1.5</h3>
        <span class="muted" style="font-size:13px;">29/09/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Cải thiện</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Tải hóa đơn từ Tổng cục Thuế: tự động chờ và thử lại khi bị chặn tạm thời (lỗi "Hệ thống phát hiện hành vi không hợp lệ"), kèm hướng dẫn xử lý rõ hơn nếu vẫn không tải được</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.1.4</h3>
        <span class="muted" style="font-size:13px;">28/09/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Vá lỗi quan trọng</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Sửa lỗi kết chuyển cuối kỳ tính sai khi có "Giảm giá hàng bán" hoặc "Hàng bán bị trả lại": trước đây khoản giảm trừ bị cộng nhầm vào doanh thu thay vì trừ đi, làm lợi nhuận ghi sổ sau khi khóa sổ bị sai lệch. Nếu bạn đã khóa sổ kỳ có dùng 1 trong 2 chức năng này bằng bản cũ hơn, vào <b>Khóa sổ → Bỏ khóa sổ</b> kỳ đó, xóa phiếu kết chuyển đã lập, cập nhật lên bản này rồi khóa sổ lại</li>
        <li>Sửa lỗi giảm giá hàng mua luôn ghi vào tài khoản Hàng hóa (156) bất kể mặt hàng thực tế là nguyên vật liệu hay công cụ dụng cụ</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Gửi góp ý / báo lỗi ngay trong phần mềm (menu Hệ thống), gửi thẳng về bộ phận hỗ trợ kèm ảnh chụp màn hình nếu cần</li>
        <li>Bỏ đóng gói riêng trình duyệt Chromium (giảm dung lượng bộ cài từ ~200MB xuống còn ~55MB) - dùng Chrome/Edge có sẵn trên máy để tải hóa đơn từ Tổng cục Thuế, đồng thời sửa lỗi trang trắng do bị nhận nhầm là bot</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.1.2</h3>
        <span class="muted" style="font-size:13px;">26/09/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Vá lỗi</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Sửa lỗi bù trừ công nợ khi 1 đối tác vừa là khách hàng vừa là nhà cung cấp (cùng mã số thuế): trước đây công nợ phải trả bên nhà cung cấp không giảm đúng sau khi bù trừ</li>
        <li>Sửa lỗi số phiếu báo giá / đơn mua hàng tự động sinh bị trùng nhau</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.1.1</h3>
        <span class="muted" style="font-size:13px;">26/09/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Màn hình rà soát hóa đơn sau khi tải từ Tổng cục Thuế: xem danh sách (đối tác, MST, số tiền, đã có/chưa có trong sổ sách), tích chọn hóa đơn cần cập nhật trước khi ghi sổ</li>
        <li>Tùy chọn tải kèm bản thể hiện PDF của hóa đơn để xem/in, mở nhanh PDF hoặc XML từng hóa đơn</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Vá lỗi</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Sửa lỗi "HTTP 403 – Hệ thống phát hiện hành vi không hợp lệ" khi tải hóa đơn từ hoadondientu.gdt.gov.vn</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; margin-bottom:22px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.1.0</h3>
        <span class="muted" style="font-size:13px;">23/09/2026</span>
      </div>
      <p style="font-weight:600; margin:8px 0 4px;">Tính năng mới</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Tải hóa đơn điện tử bán ra từ Tổng cục Thuế (giống chức năng tải hóa đơn mua vào đã có), tự đối chiếu với hóa đơn đã lập trong phần mềm</li>
        <li>Đồng bộ hóa đơn bán ra: bỏ qua hóa đơn đã có (kèm cảnh báo), tự lập phiếu cho hóa đơn cũ chưa có trong sổ sách</li>
        <li>Ghi nhớ tài khoản đăng nhập tra cứu hóa đơn Tổng cục Thuế — lần sau chỉ cần nhập mã captcha</li>
        <li>Phát hành hóa đơn điện tử qua Viettel S-Invoice ngay trong màn hình hóa đơn bán hàng</li>
        <li>Cảnh báo hóa đơn trùng cho phép mở ngay phiếu đã có để đối chiếu chi tiết (nhà cung cấp, mã số thuế, số hóa đơn, hàng hóa...)</li>
        <li>Bảng kiểm trước khi kết chuyển cuối kỳ: cảnh báo thiếu khấu hao, phân bổ CCDC, lương, khấu trừ thuế GTGT, tạm tính thuế TNDN</li>
        <li>Tự động bù trừ thuế GTGT đầu vào/đầu ra và tạm tính, hạch toán thuế TNDN cuối kỳ</li>
        <li>Công cụ ước tính thuế TNCN/GTGT cho hộ kinh doanh theo Luật 109/2025</li>
        <li>Thêm nút thu nhỏ, phóng lớn cho tất cả các màn hình; thống nhất định dạng ngày dd/mm/yyyy</li>
        <li>Mã hóa mật khẩu lưu trên máy (DPAPI); hiển thị số phiên bản đang dùng</li>
      </ul>
      <p style="font-weight:600; margin:12px 0 4px;">Vá lỗi &amp; nâng cao độ tin cậy</p>
      <ul class="feature-list" style="--card-accent: var(--ketoan);">
        <li>Sửa lỗi Bảng cân đối kế toán không cân khi có khấu hao TSCĐ</li>
        <li>Sửa lỗi Kết quả kinh doanh ra 0 sau khi kết chuyển cuối kỳ</li>
        <li>Sửa lỗi bù trừ công nợ phải thu/phải trả sai khi cấn trừ theo đối tác</li>
        <li>Sửa lỗi bỏ sót bút toán ghi thẳng vào tài khoản cha khi kết chuyển</li>
        <li>Cập nhật thuế TNCN theo Luật 109/2025 (biểu thuế, mức giảm trừ mới)</li>
        <li>Sửa lỗi danh sách phiếu không hiển thị ngay sau khi lưu, phải thoát vào lại mới thấy</li>
      </ul>
    </div>

    <div class="changelog-item" style="border-left:3px solid #cbd5e1; padding-left:16px; opacity:0.85;">
      <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
        <h3 style="margin:0;">Phiên bản 1.0.0</h3>
        <span class="muted" style="font-size:13px;">Phát hành lần đầu</span>
      </div>
      <p class="desc" style="margin:8px 0 0;">
        Sổ sách kế toán theo Thông tư 133/2016/TT-BTC, quản lý hóa đơn đầu vào/đầu ra, tải hóa đơn
        mua vào từ Tổng cục Thuế, bảng cân đối kế toán và kết quả kinh doanh, khấu hao TSCĐ, tiền
        lương, sao lưu dữ liệu.
      </p>
    </div>
  </div>
</section>

<section class="section" id="huong-dan-cap-nhat" style="border-top:1px solid #eee; background:#f8fafc;">
  <div class="container">
    <h2 style="margin-bottom:6px;">Cách cập nhật lên bản mới nhất — không mất dữ liệu</h2>
    <p class="desc" style="margin-top:0;">
      Dữ liệu của bạn (sổ sách, chứng từ, hóa đơn...) nằm tách biệt với chương trình. Cài đè bản
      mới sẽ <b>không đụng đến dữ liệu này</b>.
    </p>
    <ol class="feature-list" style="--card-accent: var(--ketoan); list-style:decimal; padding-left:20px;">
      <li>Tải bản cài mới nhất bằng nút bên dưới.</li>
      <li>Chạy file <code>KT-SOFT-Setup.exe</code> vừa tải — <b>không cần gỡ bản cũ trước</b>. Nếu phần mềm đang mở, trình cài đặt sẽ tự đóng lại giúp bạn.</li>
      <li>Bộ cài nhận ra bạn đã cài trước đó và tự động cài đè lên đúng vị trí cũ — chỉ thay chương trình, giữ nguyên toàn bộ dữ liệu.</li>
      <li>Mở lại phần mềm, đăng nhập như bình thường — dữ liệu, tài khoản, mật khẩu đều giữ nguyên.</li>
    </ol>
    <p class="desc">
      Cẩn thận hơn thì trước khi cập nhật, vào chức năng <b>Sao lưu dữ liệu</b> trong phần mềm để
      có thêm 1 bản sao lưu tay, phòng trường hợp máy tính gặp sự cố khi đang cài.
    </p>
    <div class="cta-row">
      <a href="download.php?p=ke-toan" class="btn" style="background:var(--ketoan);">⬇️ Tải bản 1.2.8 mới nhất</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="cta-band">
      <div>
        <h2>Muốn xem chi tiết tính năng và bảng giá?</h2>
        <p>Trang riêng hocketoanthue.vn có đầy đủ tài liệu, mẫu tờ khai và hướng dẫn sử dụng.</p>
      </div>
      <a href="https://hocketoanthue.vn/phan-mem" class="btn" target="_blank" rel="noopener">Truy cập hocketoanthue.vn →</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
