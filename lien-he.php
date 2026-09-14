<?php
$pageTitle = 'Liên hệ tư vấn | KT-SOFT';
$pageDesc = 'Liên hệ KT-SOFT để được tư vấn phần mềm quản lý bán hàng, kế toán hoặc công việc phù hợp với cửa hàng, doanh nghiệp của bạn.';

$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $product = trim($_POST['product'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $phone === '') {
        $error = 'Vui lòng nhập tên và số điện thoại để chúng tôi liên hệ lại.';
    } else {
        $line = json_encode([
            'time' => date('c'),
            'name' => $name,
            'phone' => $phone,
            'product' => $product,
            'message' => $message,
        ], JSON_UNESCAPED_UNICODE);
        @file_put_contents(__DIR__ . '/lien_he_log.jsonl', $line . "\n", FILE_APPEND | LOCK_EX);
        $success = true;
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
            <div class="form-field">
              <label>Họ tên *</label>
              <input type="text" name="name" required value="<?= htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
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
                <option value="QLCV">QLCV — Quản lý công việc</option>
                <option value="Kế toán">KT-SOFT Kế toán</option>
                <option value="Chưa rõ">Chưa chắc, cần tư vấn thêm</option>
              </select>
            </div>
            <div class="form-field">
              <label>Ghi chú (quy mô cửa hàng, nhu cầu cụ thể...)</label>
              <textarea name="message"><?= htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
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
            <div><b>Kế toán</b><br><a href="https://hocketoanthue.vn" target="_blank" rel="noopener">hocketoanthue.vn</a></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
