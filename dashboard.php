<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>داشبورد رایمون</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Vazirmatn', sans-serif;
    }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex">

<!-- Sidebar -->
<aside class="w-64 bg-gradient-to-b from-white to-blue-50 shadow-lg flex flex-col p-6 space-y-6">
  <div class="text-2xl font-extrabold text-blue-600 text-center mb-8">Raimon CRM</div>
  <nav class="flex-1">
    <ul class="space-y-4">
      <li>
        <a href="dashboard.php?page=register" class="flex items-center p-3 rounded-lg hover:bg-blue-100 transition font-semibold text-gray-700 hover:text-blue-700">
          <i class="fas fa-user-plus mr-3 text-green-500"></i>
          <span> ثبت نام کارمند</span>
        </a>
      </li>
      <li>
        <a href="dashboard.php?page=users" class="flex items-center p-3 rounded-lg hover:bg-blue-100 transition font-semibold text-gray-700 hover:text-blue-700">
          <i class="fas fa-users mr-3 text-purple-500"></i>
          <span> لیست کاربران</span>
        </a>
      </li>
      <li>
        <a href="dashboard.php?page=reports" class="flex items-center p-3 rounded-lg hover:bg-blue-100 transition font-semibold text-gray-700 hover:text-blue-700">
          <i class="fas fa-chart-line mr-3 text-orange-400"></i>
          <span> گزارشات</span>
        </a>
      </li>
    </ul>
  </nav>
  <div>
    <a href="logout.php" class="flex items-center p-3 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition font-semibold">
      <i class="fas fa-sign-out-alt mr-3"></i>
      <span> خروج</span>
    </a>
  </div>
</aside>
<!-- End Sidebar -->

<!-- Main Content -->
<main class="flex-1 p-8">
  <div class="bg-white p-8 rounded-2xl shadow-md min-h-[600px]">
    <?php
    $page = $_GET['page'] ?? 'home';

    $allowed_pages = ['register', 'users', 'reports', 'edit_user', 'delete_user', 'confirm_user'];

    if (in_array($page, $allowed_pages) && file_exists("pages/{$page}.php")) {
        include "pages/{$page}.php";
    } else {
        echo "<h2 class='text-2xl font-bold text-center text-gray-400'>به داشبورد مدیریت رایمون خوش آمدید.</h2>";
    }
    ?>
  </div>
</main>
<!-- End Main Content -->

</body>
</html>
