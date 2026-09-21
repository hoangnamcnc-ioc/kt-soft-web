<?php
// Cau hinh SMTP cho kt-soft.vn - Sao chep thanh smtp_config.php roi dien thong tin that.
// Dien SMTP_USER = dia chi Gmail, SMTP_PASS = "Mat khau ung dung" (App Password 16 ky tu)
// lay tai https://myaccount.google.com/apppasswords - KHONG phai mat khau Gmail thuong.
// Bat buoc cong 465 (SSL): cong 587 bi chan tu may chu nay.
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 465);
define('SMTP_USER', '');
define('SMTP_PASS', '');
define('SMTP_FROM', '');
define('SMTP_FROM_NAME', 'KT-SOFT');
define('SMTP_MESSAGE_ID_DOMAIN', 'kt-soft.vn');
define('SMTP_TIMEOUT', 8);
