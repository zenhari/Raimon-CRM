<?php
require_once __DIR__ . '/../db/conn.php';

// دریافت ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo 'شناسه نامعتبر';
    exit;
}

$id = intval($_GET['id']);

// حذف عکس کاربر اول
$stmt = $pdo->prepare("SELECT profile_image FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && !empty($user['profile_image'])) {
    $imagePath = __DIR__ . '/../uploads/' . $user['profile_image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

// حذف رکورد کاربر
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$result = $stmt->execute([$id]);

if ($result) {
    echo 'success';
} else {
    http_response_code(500);
    echo 'خطا در حذف کاربر';
}
