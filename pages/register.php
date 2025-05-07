<div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 mx-auto lg:mr-64">
  <!-- Card -->
  <div class="bg-white rounded-xl shadow-xs p-4 sm:p-7 dark:bg-neutral-800">
    <div class="mb-8">
      <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
        <i class="fas fa-user-plus text-blue-500 mr-2"></i>ثبت نام کارمند جدید
      </h2>
      <p class="text-sm text-gray-600 dark:text-neutral-400">لطفاً اطلاعات کارمند جدید را وارد کنید.</p>
    </div>

    <?php if (isset($_GET['error'])): ?>
      <div class="p-3 text-sm text-red-600 bg-red-100 rounded mb-4">
        <i class="fas fa-exclamation-circle mr-2"></i><?php echo htmlspecialchars($_GET['error']); ?>
      </div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
      <div class="p-3 text-sm text-green-600 bg-green-100 rounded mb-4">
        <i class="fas fa-check-circle mr-2"></i><?php echo htmlspecialchars($_GET['success']); ?>
      </div>
    <?php endif; ?>

    <form class="space-y-6" method="POST" action="register_check.php" enctype="multipart/form-data" onsubmit="return validatePassword();">
      <!-- Grid -->
      <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
        <!-- Profile Image -->
        <div class="sm:col-span-3">
          <label for="profile_image" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
            <i class="fas fa-camera text-blue-500 mr-2"></i>عکس پروفایل
          </label>
        </div>
        <div class="sm:col-span-9">
          <div class="flex items-center gap-5">
            <div class="flex gap-x-2">
              <input type="file" id="profile_image" name="profile_image" accept="image/*" class="py-2 px-3 block w-full border border-gray-300 shadow-sm rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            </div>
          </div>
        </div>
        <!-- End Profile Image -->

        <!-- First Name -->
        <div class="sm:col-span-3">
          <label for="first_name" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
            <i class="fas fa-user text-blue-500 mr-2"></i>نام
          </label>
        </div>
        <div class="sm:col-span-9">
          <input type="text" id="first_name" name="first_name" required class="py-2 px-3 block w-full border border-gray-300 shadow-sm rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>
        <!-- End First Name -->

        <!-- Last Name -->
        <div class="sm:col-span-3">
          <label for="last_name" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
            <i class="fas fa-user text-blue-500 mr-2"></i>نام خانوادگی
          </label>
        </div>
        <div class="sm:col-span-9">
          <input type="text" id="last_name" name="last_name" required class="py-2 px-3 block w-full border border-gray-300 shadow-sm rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>
        <!-- End Last Name -->

        <!-- Username -->
        <div class="sm:col-span-3">
          <label for="username" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
            <i class="fas fa-user-tag text-blue-500 mr-2"></i>نام کاربری
          </label>
        </div>
        <div class="sm:col-span-9">
          <input type="text" id="username" name="username" required class="py-2 px-3 block w-full border border-gray-300 shadow-sm rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>
        <!-- End Username -->

        <!-- Email -->
        <div class="sm:col-span-3">
          <label for="email" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
            <i class="fas fa-envelope text-blue-500 mr-2"></i>ایمیل
          </label>
        </div>
        <div class="sm:col-span-9">
          <input type="email" id="email" name="email" required class="py-2 px-3 block w-full border border-gray-300 shadow-sm rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>
        <!-- End Email -->

        <!-- Phone -->
        <div class="sm:col-span-3">
          <label for="phone" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
            <i class="fas fa-phone text-blue-500 mr-2"></i>شماره تماس
          </label>
        </div>
        <div class="sm:col-span-9">
          <input type="text" id="phone" name="phone" required class="py-2 px-3 block w-full border border-gray-300 shadow-sm rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>
        <!-- End Phone -->

        <!-- Birthday -->
        <div class="sm:col-span-3">
          <label for="birthday" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>تاریخ تولد (شمسی)
          </label>
        </div>
        <div class="sm:col-span-9">
          <input type="text" id="birthday" name="birthday" required class="py-2 px-3 block w-full border border-gray-300 shadow-sm rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>
        <!-- End Birthday -->

        <!-- Marital Status -->
        <div class="sm:col-span-3">
          <label for="marital_status" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
            <i class="fas fa-ring text-blue-500 mr-2"></i>وضعیت تاهل
          </label>
        </div>
        <div class="sm:col-span-9">
          <select id="marital_status" name="marital_status" required class="py-2 px-3 block w-full border border-gray-300 shadow-sm rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <option value="مجرد">مجرد</option>
            <option value="متاهل">متاهل</option>
          </select>
        </div>
        <!-- End Marital Status -->

        <!-- Role -->
        <div class="sm:col-span-3">
          <label for="role" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
            <i class="fas fa-user-shield text-blue-500 mr-2"></i>نقش کاربر
          </label>
        </div>
        <div class="sm:col-span-9">
          <select id="role" name="role" required class="py-2 px-3 block w-full border border-gray-300 shadow-sm rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <option value="کاربر">کاربر عادی</option>
            <option value="مدیر">مدیر سیستم</option>
            <option value="پشتیبانی">پشتیبانی</option>
          </select>
        </div>
        <!-- End Role -->

        <!-- Password -->
        <div class="sm:col-span-3">
          <label for="password" class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
            <i class="fas fa-lock text-blue-500 mr-2"></i>رمز عبور
          </label>
        </div>
        <div class="sm:col-span-9">
          <input type="password" id="password" name="password" required oninput="checkPasswordStrength()" class="py-2 px-3 block w-full border border-gray-300 shadow-sm rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-600 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
          <div class="flex items-center gap-x-3 whitespace-nowrap mt-2">
            <div class="flex w-full h-2 bg-gray-200 rounded-full overflow-hidden" role="progressbar" aria-valuemin="0" aria-valuemax="100">
              <div id="progress-bar" class="flex flex-col justify-center rounded-full overflow-hidden bg-gray-400 text-xs text-white text-center whitespace-nowrap transition duration-500" style="width: 0%"></div>
            </div>
            <div class="w-10 text-end">
              <span id="progress-text" class="text-sm text-gray-800">0%</span>
            </div>
          </div>
        </div>
        <!-- End Password -->
      </div>
      <!-- End Grid -->

      <div class="mt-5 flex justify-end gap-x-2">
        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
          <i class="fas fa-check-circle"></i>ثبت نام
        </button>
      </div>
    </form>
  </div>
  <!-- End Card -->
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
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