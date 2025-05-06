<?php
require_once 'db/conn.php';

// آماده سازی فیلترها
$search = $_GET['search'] ?? '';

// کوئری اصلی
$query = "SELECT id, first_name, last_name, username, email, phone, birthday, marital_status, role FROM users WHERE 1";

// اگر جستجو داشتیم
if (!empty($search)) {
    $query .= " AND (first_name LIKE :search OR last_name LIKE :search OR email LIKE :search OR phone LIKE :search)";
}

$query .= " ORDER BY id DESC";

$stmt = $pdo->prepare($query);

if (!empty($search)) {
    $stmt->bindValue(':search', '%' . $search . '%');
}

$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="text-2xl font-bold mb-6 text-blue-700">لیست کاربران</h2>

<!-- فرم جستجو -->
<div class="mb-6">
  <form method="GET" action="dashboard.php" class="flex flex-col md:flex-row gap-4 items-center">
    <input type="hidden" name="page" value="users">
    <input type="text" name="search" placeholder="جستجوی نام، نام خانوادگی، ایمیل یا شماره تماس" value="<?php echo htmlspecialchars($search); ?>"
      class="w-full md:w-1/2 px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 font-light text-gray-700" style="font-weight:300;">
    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
      جستجو
    </button>
  </form>
</div>
<!-- پایان فرم جستجو -->

<div class="overflow-x-auto rounded-lg shadow-md">
  <table class="min-w-full bg-white">
    <thead class="bg-blue-600 text-white font-normal" style="font-weight:400;">
      <tr>
        <th class="py-3 px-4 text-right">#</th>
        <th class="py-3 px-4 text-right">نام</th>
        <th class="py-3 px-4 text-right">نام خانوادگی</th>
        <th class="py-3 px-4 text-right">نام کاربری</th>
        <th class="py-3 px-4 text-right">ایمیل</th>
        <th class="py-3 px-4 text-right">شماره تماس</th>
        <th class="py-3 px-4 text-right">تاریخ تولد</th>
        <th class="py-3 px-4 text-right">تاهل</th>
        <th class="py-3 px-4 text-right">نقش</th>
        <th class="py-3 px-4 text-right">مدیریت</th>
      </tr>
    </thead>
    <tbody class="text-gray-700">
      <?php if (count($users) > 0): ?>
        <?php foreach ($users as $index => $user): ?>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-3 px-4"><?php echo $index + 1; ?></td>
            <td class="py-3 px-4"><?php echo htmlspecialchars($user['first_name']); ?></td>
            <td class="py-3 px-4"><?php echo htmlspecialchars($user['last_name']); ?></td>
            <td class="py-3 px-4"><?php echo htmlspecialchars($user['username']); ?></td>
            <td class="py-3 px-4"><?php echo htmlspecialchars($user['email']); ?></td>
            <td class="py-3 px-4"><?php echo htmlspecialchars($user['phone']); ?></td>
            <td class="py-3 px-4"><?php echo htmlspecialchars($user['birthday']); ?></td>
            <td class="py-3 px-4"><?php echo htmlspecialchars($user['marital_status']); ?></td>
            <td class="py-3 px-4"><?php echo htmlspecialchars($user['role']); ?></td>
            <td class="py-3 px-4 flex items-center gap-2">
              <!-- دکمه ها -->
              <a href="dashboard.php?page=edit_user&id=<?php echo $user['id']; ?>" class="text-blue-600 hover:text-blue-800 text-sm" title="ویرایش">
                <i class="fas fa-edit"></i>
              </a>
              <a href="dashboard.php?page=delete_user&id=<?php echo $user['id']; ?>" onclick="return confirm('آیا از حذف این کاربر مطمئن هستید؟');" class="text-red-600 hover:text-red-800 text-sm" title="حذف">
                <i class="fas fa-trash-alt"></i>
              </a>
              <a href="dashboard.php?page=confirm_user&id=<?php echo $user['id']; ?>" class="text-green-600 hover:text-green-800 text-sm" title="تثبیت کاربر">
                <i class="fas fa-check-circle"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="10" class="text-center py-6 text-gray-500">کاربری پیدا نشد.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
