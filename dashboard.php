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
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@preline/preline@2.3.0/dist/preline.min.js"></script>
  <style>
    body {
      font-family: 'Vazirmatn', sans-serif;
    }
    .icon-purple {
      color: #61207f;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Navbar -->
<nav class="bg-white shadow-md dark:bg-neutral-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <!-- Logo -->
      <div class="flex items-center">
        <a class="flex-none font-semibold text-xl text-black dark:text-white" href="#" aria-label="Brand">Raimon CRM</a>
      </div>

      <!-- Desktop Menu -->
      <div class="hidden lg:flex lg:items-center lg:space-x-4">
        <a class="flex items-center gap-x-2 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200" href="dashboard.php?page=register">
          <i class="fas fa-user-plus icon-purple"></i>ثبت نام کارمند
        </a>
        <a class="flex items-center gap-x-2 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200" href="dashboard.php?page=users">
          <i class="fas fa-users icon-purple"></i>لیست کاربران
        </a>
        <a class="flex items-center gap-x-2 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200" href="dashboard.php?page=reports">
          <i class="fas fa-chart-line icon-purple"></i>گزارشات
        </a>
        <a class="flex items-center gap-x-2 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200" href="logout.php">
          <i class="fas fa-sign-out-alt icon-purple"></i>خروج
        </a>
      </div>

      <!-- Mobile Menu Button -->
      <div class="lg:hidden flex items-center">
        <button type="button" class="p-2 text-gray-600 hover:text-gray-800 dark:text-neutral-400 dark:hover:text-neutral-200 focus:outline-none" aria-controls="hs-navbar-collapsible" aria-expanded="false" data-hs-collapse="#hs-navbar-collapsible" aria-label="Toggle navigation">
          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="hs-navbar-collapsible" class="hs-collapse hidden overflow-hidden transition-all duration-300 lg:hidden">
    <div class="flex flex-col gap-y-2 p-4 bg-white dark:bg-neutral-800">
      <a class="flex items-center gap-x-2 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200" href="dashboard.php?page=register">
        <i class="fas fa-user-plus icon-purple"></i>ثبت نام کارمند
      </a>
      <a class="flex items-center gap-x-2 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200" href="dashboard.php?page=users">
        <i class="fas fa-users icon-purple"></i>لیست کاربران
      </a>
      <a class="flex items-center gap-x-2 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200" href="dashboard.php?page=reports">
        <i class="fas fa-chart-line icon-purple"></i>گزارشات
      </a>
      <a class="flex items-center gap-x-2 py-2 px-3 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200" href="logout.php">
        <i class="fas fa-sign-out-alt icon-purple"></i>خروج
      </a>
    </div>
  </div>
</nav>
<!-- End Navbar -->

<!-- Main Content -->
<main class="pt-20 p-8">
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