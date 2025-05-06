<?php
require_once __DIR__ . '/../db/conn.php';

// تنظیمات خطا
ini_set('display_errors', 1);
error_reporting(E_ALL);

// گرفتن id از URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: dashboard.php?page=users');
    exit;
}

$id = intval($_GET['id']);

// واکشی اطلاعات کاربر
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: dashboard.php?page=users');
    exit;
}

// اگر فرم ارسال شده بود
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $birthday = trim($_POST['birthday']);
    $marital_status = trim($_POST['marital_status']);
    $role = trim($_POST['role']);

    $newImageName = $user['profile_image']; // پیش فرض

    // اگر فایل جدید آپلود شده باشد
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $tempFile = $_FILES['profile_image']['tmp_name'];
        $fileName = 'user_' . uniqid() . '.' . pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        $destination = $uploadDir . $fileName;

        if (move_uploaded_file($tempFile, $destination)) {
            // اگر عکس قبلی وجود داشت، حذف کن
            if (!empty($user['profile_image'])) {
                $oldImagePath = $uploadDir . $user['profile_image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $newImageName = $fileName;
        }
    }

    // آپدیت اطلاعات کاربر
    $stmt = $pdo->prepare("UPDATE users SET first_name=?, last_name=?, email=?, phone=?, birthday=?, marital_status=?, role=?, profile_image=?, updated_at=NOW() WHERE id=?");
    $stmt->execute([$first_name, $last_name, $email, $phone, $birthday, $marital_status, $role, $newImageName, $id]);

    header('Location: dashboard.php?page=users');
    exit;
}
?>

<h2 class="text-2xl font-bold mb-6 text-blue-700">ویرایش کاربر</h2>

<div class="bg-white p-6 rounded-lg shadow-md">
  <form method="POST" enctype="multipart/form-data" class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block mb-1 text-sm font-medium">نام</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label class="block mb-1 text-sm font-medium">نام خانوادگی</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label class="block mb-1 text-sm font-medium">ایمیل</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label class="block mb-1 text-sm font-medium">شماره تماس</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label class="block mb-1 text-sm font-medium">تاریخ تولد (شمسی)</label>
        <input type="text" name="birthday" value="<?php echo htmlspecialchars($user['birthday']); ?>" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
      </div>
      <div>
        <label class="block mb-1 text-sm font-medium">وضعیت تاهل</label>
        <select name="marital_status" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
          <option value="مجرد" <?php echo $user['marital_status'] == 'مجرد' ? 'selected' : ''; ?>>مجرد</option>
          <option value="متاهل" <?php echo $user['marital_status'] == 'متاهل' ? 'selected' : ''; ?>>متاهل</option>
        </select>
      </div>
      <div>
        <label class="block mb-1 text-sm font-medium">نقش کاربر</label>
        <select name="role" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
          <option value="کاربر" <?php echo $user['role'] == 'کاربر' ? 'selected' : ''; ?>>کاربر عادی</option>
          <option value="مدیر" <?php echo $user['role'] == 'مدیر' ? 'selected' : ''; ?>>مدیر سیستم</option>
          <option value="پشتیبانی" <?php echo $user['role'] == 'پشتیبانی' ? 'selected' : ''; ?>>پشتیبانی</option>
        </select>
      </div>
      <div>
        <label class="block mb-1 text-sm font-medium">تغییر عکس پروفایل</label>
        <input type="file" name="profile_image" accept="image/*" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
        <?php if (!empty($user['profile_image'])): ?>
          <img src="../uploads/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile" class="w-20 h-20 mt-2 rounded-full object-cover border">
        <?php endif; ?>
      </div>
    </div>

    <div class="pt-6">
      <button type="submit" class="w-full py-3 text-white bg-green-600 rounded-md hover:bg-green-700 text-lg font-semibold transition">ذخیره تغییرات</button>
    </div>
  </form>
</div>
