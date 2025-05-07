<?php
require_once __DIR__ . '/../db/conn.php';

// بررسی اطلاعات ارسال شده
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['id'])) {
    http_response_code(400);
    echo 'درخواست نامعتبر';
    exit;
}

$id = intval($_POST['id']);
$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);

// آپدیت اطلاعات
$stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?, updated_at = NOW() WHERE id = ?");
$result = $stmt->execute([$first_name, $last_name, $email, $phone, $id]);

if ($result) {
    echo 'success';
} else {
    http_response_code(500);
    echo 'خطا در ذخیره اطلاعات';
}
