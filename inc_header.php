<?php
$currentPage = basename($_SERVER['SCRIPT_NAME']);
$pageTitle = $pageTitle ?? 'KT-SOFT — Phần mềm quản lý cho cửa hàng và doanh nghiệp nhỏ';
$pageDesc = $pageDesc ?? 'KT-SOFT phát triển phần mềm quản lý bán hàng, kế toán và công việc cho cửa hàng, hộ kinh doanh và doanh nghiệp nhỏ tại Việt Nam.';
?><!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
<meta name="description" content="<?= htmlspecialchars($pageDesc, ENT_QUOTES, 'UTF-8') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<header class="site-header">
  <div class="container bar">
    <a href="index.php" class="brand">
      <span class="logo-mark">KT</span>
      <span>KT-SOFT</span>
    </a>
    <nav class="nav">
      <a href="index.php#san-pham">Sản phẩm</a>
      <a href="san-pham-qlbh2.php">QLBH2</a>
      <a href="san-pham-qlbh-soft.php">QLBH-SOFT</a>
      <a href="san-pham-qlcv.php">QLCV</a>
      <a href="san-pham-ke-toan.php">Kế toán</a>
      <a href="lien-he.php">Liên hệ</a>
    </nav>
    <a href="https://app.kt-soft.vn" class="btn btn-sm" target="_blank" rel="noopener">Dùng thử QLBH2</a>
  </div>
</header>
