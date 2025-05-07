<?php
require_once __DIR__ . '/../db/conn.php';

// دریافت ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'شناسه نامعتبر']);
    exit;
}

$id = intval($_GET['id']);

// واکشی اطلاعات کاربر
$stmt = $pdo->prepare("SELECT id, first_name, last_name, email, phone FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode($user);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'کاربر پیدا نشد']);
}
