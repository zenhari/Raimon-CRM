<?php
session_start();
require_once 'db/conn.php'; // اتصال به دیتابیس

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $birthday = trim($_POST['birthday']);
    $marital_status = trim($_POST['marital_status']);
    $role = trim($_POST['role']);
    $password = $_POST['password'];

    // اعتبارسنجی اولیه
    if (empty($username) || empty($email) || empty($phone) || empty($birthday) || empty($marital_status) || empty($role) || empty($password)) {
        header('Location: register.php?error=' . urlencode('لطفا همه فیلدها را پر کنید.'));
        exit;
    }

    // بررسی اینکه یوزرنیم یا ایمیل تکراری نباشد
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
        header('Location: register.php?error=' . urlencode('نام کاربری یا ایمیل قبلا ثبت شده است.'));
        exit;
    }

    // رمز عبور هش شده
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // مدیریت آپلود عکس
    $profile_image = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($_FILES['profile_image']['type'], $allowed_types)) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
            $profile_image_name = uniqid('user_') . '.' . $extension;
            $upload_path = $upload_dir . $profile_image_name;

            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path)) {
                $profile_image = $profile_image_name;
            } else {
                header('Location: register.php?error=' . urlencode('مشکل در آپلود تصویر.'));
                exit;
            }
        } else {
            header('Location: register.php?error=' . urlencode('فقط فرمت JPG و PNG قابل قبول است.'));
            exit;
        }
    }

    // ثبت کاربر در دیتابیس
    $stmt = $pdo->prepare("INSERT INTO users (username, first_name, last_name, email, phone, birthday, marital_status, role, password, profile_image, created_at)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->execute([$username, $first_name, $last_name, $email, $phone, $birthday, $marital_status, $role, $hashed_password, $profile_image]);

    header('Location: register.php?success=' . urlencode('ثبت نام با موفقیت انجام شد.'));
    exit;
} else {
    header('Location: register.php');
    exit;
}
?>
