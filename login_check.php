<?php
session_start();
require_once 'db/conn.php'; // اتصال به دیتابیس از پوشه db

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header('Location: dashboard.php');
        exit;
    } else {
        header('Location: index.php?error=' . urlencode('نام کاربری یا رمز عبور اشتباه است'));
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>
