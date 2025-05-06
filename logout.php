<?php
session_start();

// همه سشن‌ها را پاک کن
$_SESSION = [];

// سشن را کاملاً از بین ببر
session_destroy();

// هدایت به صفحه ورود
header('Location: index.php');
exit;
?>
