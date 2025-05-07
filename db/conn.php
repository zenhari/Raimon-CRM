<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=raimon_crm;charset=utf8mb4', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('خطا در اتصال به دیتابیس: ' . $e->getMessage());
}
?>
