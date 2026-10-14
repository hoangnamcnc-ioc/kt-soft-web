<?php
require_once __DIR__ . '/admin/config.php';

$pageTitle = 'Liên hệ tư vấn | KT-SOFT';
$pageDesc = 'Liên hệ KT-SOFT để được tư vấn phần mềm quản lý bán hàng, kế toán hoặc công việc phù hợp với cửa hàng, doanh nghiệp của bạn.';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim((string) ($_POST['name'] ?? ''));
    $phone = trim((string) ($_POST['phone'] ?? ''));
    $product = trim((string) ($_POST['product'] ?? ''));
    $message = trim((string) ($_POST['message'] ?? ''));
    $ip = (string) ($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
    $digits = preg_replace('/\D+/', '', $phone);

    if (trim((string) ($_POST['website'] ?? '')) !== '') {
        // Honeypot: bot tu dien o an -> bao thanh cong gia, khong luu gi.
        $success = true;
    } elseif ($name === '' || $phone === '') {
        $error = 'Vui lòng nhập tên và số điện thoại để chúng tôi liên hệ lại.';
    } elseif (strlen($digits) < 8 || strlen($digits) > 15 || preg_match('/[^0-9+\s().-]/', $phone)) {
        $error = 'Số điện thoại chưa đúng, vui lòng kiểm tra lại.';
    } elseif (mb_strlen($name) > 100 || mb_strlen($message) > 2000) {
        $error = 'Nội dung quá dài, vui lòng rút gọn lại.';
    } elseif (lien_he_qua_gioi_han($ip)) {
        $error = 'Bạn gửi hơi nhiều, vui lòng thử lại sau ít phút hoặc gọi/email trực tiếp.';
    } else {
        $items = lien_he_doc_tat_ca();
        if (count($items) >= 5000) {
            $error = 'Hệ thống đang bận, vui lòng liên hệ trực tiếp qua email/điện thoại.';
        } else {
            $entry = [
                'time' => date('c'),
                'name' => $name,
                'phone' => $phone,
                'product' => mb_substr($product, 0, 60),
                'message' => $message,
            ];
            lien_he_them($entry);
            sendMail('hoangnamcnc@gmail.com', 'Khách để lại liên hệ trên kt-soft.vn: ' . $name,
                "Họ tên: $name
Điện thoại: $phone
Sản phẩm: {$entry['product']}
Ghi chú: $message
Thời gian: {$entry['time']}
");
            $success = true;
        }
    }
}

require_once __DIR__ . '/inc_header.php';
?>

<section class="hero" style="padding-bottom:0;">
  <div class="container">
    <span class="eyebrow">Liên hệ</span>
    <h1>Cho chúng tôi biết bạn cần gì</h1>
    <p class="lead">Để lại thông tin, KT-SOFT sẽ liên hệ tư vấn sản phẩm phù hợp trong thời gian sớm nhất.</p>
  </div>
</section>

<section class="section" style="padding-top:32px;">
  <div class="container">
    <div class="contact-grid">
      <div class="contact-card">
        <h3>Gửi thông tin liên hệ</h3>
        <p class="muted" style="font-size:14px;">Điền form dưới đây, hoặc liên hệ trực tiếp qua email/điện thoại bên cạnh.</p>

        <?php if ($success): ?>
          <div class="alert alert-success" style="margin-top:18px;">
            Cảm ơn bạn! KT-SOFT đã nhận được thông tin và sẽ liên hệ lại sớm nhất.
          </div>
        <?php else: ?>
          <?php if ($error): ?><div class="alert alert-error" style="margin-top:18px;"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
          <form method="post" style="margin-top:18px;">
            <div style="position:absolute;left:-9999px;" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
            <div class="form-field">
              <label>Họ tên *</label>
              <input type="text" name="name" required maxlength="100" value="<?= htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="form-field">
              <label>Số điện thoại *</label>
              <input type="tel" name="phone" required value="<?= htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
            </div>
            <div class="form-field">
              <label>Bạn quan tâm sản phẩm nào?</label>
              <select name="product">
                <option value="QLBH-CLOUD">QLBH-CLOUD — Quản lý bán hàng đa chi nhánh</option>
                <option value="QLBH-SOFT">QLBH-SOFT — Bán hàng tạp hóa</option>
                <option value="QLCF-SOFT">QLCF-SOFT — Quán cà phê, trà sữa</option>
                <option value="QLCV">QLCV — Quản lý công việc</option>
                <option value="Kế toán">KT-SOFT Kế toán</option>
                <option value="Chưa rõ">Chưa chắc, cần tư vấn thêm</option>
              </select>
            </div>
            <div class="form-field">
              <label>Ghi chú (quy mô cửa hàng, nhu cầu cụ thể...)</label>
              <textarea name="message" maxlength="2000"><?= htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
            <p class="muted" style="font-size:12.5px;margin:0 0 12px;">Bằng việc gửi, bạn đồng ý để KT-SOFT dùng thông tin này để liên hệ tư vấn. Xem <a href="quyen-rieng-tu.php">Chính sách quyền riêng tư</a>.</p>
            <button type="submit" class="btn">Gửi thông tin</button>
          </form>
        <?php endif; ?>
      </div>

      <div class="contact-card">
        <h3>Thông tin liên hệ trực tiếp</h3>
        <ul class="contact-list">
          <li>
            <span class="icon">✉️</span>
            <div><b>Email</b><br><a href="mailto:hoangnamcnc@gmail.com">hoangnamcnc@gmail.com</a></div>
          </li>
          <li>
            <span class="icon">☁️</span>
            <div><b>QLBH-CLOUD</b><br><a href="https://app.kt-soft.vn" target="_blank" rel="noopener">app.kt-soft.vn</a></div>
          </li>
          <li>
            <span class="icon">🧾</span>
            <div><b>Kế toán</b><br><a href="https://hocketoanthue.vn/phan-mem" target="_blank" rel="noopener">hocketoanthue.vn</a></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
