<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ثبت نام کارمند جدید</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css" />
  <style>
    body, input, button, label, a, select {
      font-family: 'Vazirmatn', sans-serif;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
<div class="w-full max-w-4xl p-10 space-y-8 bg-white rounded-2xl shadow-lg">
  <h2 class="text-3xl font-bold text-center text-blue-700 mb-8">ثبت نام کارمند جدید</h2>

  <?php if (isset($_GET['error'])): ?>
    <div class="p-3 text-sm text-red-600 bg-red-100 rounded">
      <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
  <?php endif; ?>
  <?php if (isset($_GET['success'])): ?>
    <div class="p-3 text-sm text-green-600 bg-green-100 rounded">
      <?php echo htmlspecialchars($_GET['success']); ?>
    </div>
  <?php endif; ?>

  <form class="space-y-6" method="POST" action="register_check.php" enctype="multipart/form-data" onsubmit="return validatePassword();">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label for="first_name" class="block mb-1 text-sm font-medium">نام</label>
        <input type="text" id="first_name" name="first_name" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label for="last_name" class="block mb-1 text-sm font-medium">نام خانوادگی</label>
        <input type="text" id="last_name" name="last_name" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label for="username" class="block mb-1 text-sm font-medium">نام کاربری</label>
        <input type="text" id="username" name="username" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label for="email" class="block mb-1 text-sm font-medium">ایمیل</label>
        <input type="email" id="email" name="email" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label for="phone" class="block mb-1 text-sm font-medium">شماره تماس</label>
        <input type="text" id="phone" name="phone" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label for="birthday" class="block mb-1 text-sm font-medium">تاریخ تولد (شمسی)</label>
        <input type="text" id="birthday" name="birthday" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>

      <div>
        <label for="marital_status" class="block mb-1 text-sm font-medium">وضعیت تاهل</label>
        <select id="marital_status" name="marital_status" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
          <option value="مجرد">مجرد</option>
          <option value="متاهل">متاهل</option>
        </select>
      </div>
      <div>
        <label for="role" class="block mb-1 text-sm font-medium">نقش کاربر</label>
        <select id="role" name="role" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
          <option value="کاربر">کاربر عادی</option>
          <option value="مدیر">مدیر سیستم</option>
          <option value="پشتیبانی">پشتیبانی</option>
        </select>
      </div>

      <div>
        <label for="password" class="block mb-1 text-sm font-medium">رمز عبور</label>
        <input type="password" id="password" name="password" required oninput="checkPasswordStrength()" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
        <div class="flex items-center gap-x-3 whitespace-nowrap mt-2">
          <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden" role="progressbar" aria-valuemin="0" aria-valuemax="100">
            <div id="progress-bar" class="flex flex-col justify-center rounded-full overflow-hidden bg-gray-400 text-xs text-white text-center whitespace-nowrap transition duration-500" style="width: 0%"></div>
          </div>
          <div class="w-10 text-end">
            <span id="progress-text" class="text-sm text-gray-800">0%</span>
          </div>
        </div>
      </div>

      <div>
        <label for="profile_image" class="block mb-1 text-sm font-medium">آپلود عکس پروفایل</label>
        <input type="file" id="profile_image" name="profile_image" accept="image/*" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>

    </div>

    <div class="pt-6">
      <button type="submit" class="w-full py-3 text-white bg-green-600 rounded-md hover:bg-green-700 text-lg font-semibold transition">ثبت نام</button>
    </div>
  </form>
</div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
  <script>
    $('#birthday').persianDatepicker({
      format: 'YYYY/MM/DD',
      autoClose: true
    });

    function checkPasswordStrength() {
      const password = document.getElementById('password').value;
      const progressBar = document.getElementById('progress-bar');
      const progressText = document.getElementById('progress-text');
      
      let strength = 0;

      if (password.length >= 8) strength += 1;
      if (/[a-zA-Z]/.test(password)) strength += 1;
      if (/[0-9]/.test(password)) strength += 1;
      if (/[^a-zA-Z0-9]/.test(password)) strength += 1;

      let width = 0;
      let color = 'bg-gray-400';
      let percentage = 0;

      switch (strength) {
          case 0:
              width = 0;
              color = 'bg-gray-400';
              percentage = 0;
              break;
          case 1:
              width = 25;
              color = 'bg-red-500';
              percentage = 25;
              break;
          case 2:
              width = 50;
              color = 'bg-yellow-400';
              percentage = 50;
              break;
          case 3:
              width = 75;
              color = 'bg-blue-500';
              percentage = 75;
              break;
          case 4:
              width = 100;
              color = 'bg-teal-500';
              percentage = 100;
              break;
      }

      progressBar.style.width = width + '%';
      progressText.textContent = percentage + '%';
      progressBar.className = 'flex flex-col justify-center rounded-full overflow-hidden text-xs text-white text-center whitespace-nowrap transition duration-500';
      progressBar.classList.add(color);
    }

    function validatePassword() {
      const password = document.getElementById('password').value;
      if (password.length < 8 || !/[a-zA-Z]/.test(password) || !/[0-9]/.test(password) || !/[^a-zA-Z0-9]/.test(password)) {
          alert('رمز عبور باید حداقل ۸ کاراکتر و شامل حرف، عدد و علامت خاص باشد.');
          return false;
      }
      return true;
    }
  </script>
</body>
</html>
