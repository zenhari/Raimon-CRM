<?php
if (!$user) {
    file_put_contents('../log.txt', "[".date('Y-m-d H:i:s')."] کاربر پیدا نشد برای ID={$id}\n", FILE_APPEND);
    header('Location: dashboard.php?page=users');
    exit;
}
?>