<?php
require_once 'db/conn.php';
?>

<h2 class="text-2xl font-bold mb-6 text-blue-700">لیست کاربران</h2>

<!-- فرم جستجو -->
<div class="mb-6">
  <form method="GET" action="dashboard.php" class="flex flex-col md:flex-row gap-4 items-center">
    <input type="hidden" name="page" value="users">
    <input type="text" name="search" placeholder="جستجو..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>"
      class="w-full md:w-1/2 px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400 text-sm font-light">
    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
      جستجو
    </button>
  </form>
</div>
<!-- پایان فرم جستجو -->

<!-- جدول کاربران -->
<div id="user-table" class="overflow-x-auto rounded-lg shadow-md">
  <?php include __DIR__ . '/partials/user_table.php'; ?>
</div>

<!-- مودال ویرایش کاربر -->
<div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
    <h3 class="text-lg font-bold mb-4 text-center text-blue-600">ویرایش کاربر</h3>
    <form id="editUserForm" class="space-y-4">
      <input type="hidden" name="id" id="edit-id">

      <div>
        <label class="text-sm font-semibold">نام</label>
        <input type="text" id="edit-first-name" name="first_name" class="w-full mt-1 px-3 py-2 border rounded focus:ring-2 focus:ring-blue-400 text-sm">
      </div>
      <div>
        <label class="text-sm font-semibold">نام خانوادگی</label>
        <input type="text" id="edit-last-name" name="last_name" class="w-full mt-1 px-3 py-2 border rounded focus:ring-2 focus:ring-blue-400 text-sm">
      </div>
      <div>
        <label class="text-sm font-semibold">ایمیل</label>
        <input type="email" id="edit-email" name="email" class="w-full mt-1 px-3 py-2 border rounded focus:ring-2 focus:ring-blue-400 text-sm">
      </div>
      <div>
        <label class="text-sm font-semibold">شماره تماس</label>
        <input type="text" id="edit-phone" name="phone" class="w-full mt-1 px-3 py-2 border rounded focus:ring-2 focus:ring-blue-400 text-sm">
      </div>

      <div class="flex justify-between pt-4">
        <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">انصراف</button>
        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">ذخیره</button>
      </div>
    </form>
  </div>
</div>

<!-- مودال تایید حذف -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white w-full max-w-sm p-6 rounded-lg shadow-lg text-center">
    <h3 class="text-lg font-bold text-red-600 mb-4">آیا مطمئن هستید؟</h3>
    <div class="flex justify-center gap-4 pt-4">
      <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">خیر</button>
      <button type="button" id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">بله، حذف شود</button>
    </div>
  </div>
</div>

<!-- Toast نوتیفیکیشن -->
<div id="toast" class="hidden fixed bottom-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg animate-bounce"></div>

<!-- اسکریپت Ajax و مدیریت مودال -->
<script>
// متغیرها
let deleteUserId = null;

// باز کردن مودال ویرایش
function openEditModal(id) {
  fetch('ajax/get_user.php?id=' + id)
    .then(res => res.json())
    .then(user => {
      document.getElementById('edit-id').value = user.id;
      document.getElementById('edit-first-name').value = user.first_name;
      document.getElementById('edit-last-name').value = user.last_name;
      document.getElementById('edit-email').value = user.email;
      document.getElementById('edit-phone').value = user.phone;
      document.getElementById('editModal').classList.remove('hidden');
    });
}

// بستن مودال ویرایش
function closeEditModal() {
  document.getElementById('editModal').classList.add('hidden');
}

// ثبت ویرایش کاربر
document.getElementById('editUserForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch('ajax/update_user.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    closeEditModal();
    showToast('کاربر با موفقیت ویرایش شد.');
    reloadTable();
  });
});

// باز کردن مودال حذف
function openDeleteModal(id) {
  deleteUserId = id;
  document.getElementById('deleteModal').classList.remove('hidden');
}

// بستن مودال حذف
function closeDeleteModal() {
  document.getElementById('deleteModal').classList.add('hidden');
}

// تایید حذف کاربر
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
  fetch('ajax/delete_user.php?id=' + deleteUserId)
    .then(res => res.text())
    .then(data => {
      closeDeleteModal();
      showToast('کاربر با موفقیت حذف شد.');
      reloadTable();
    });
});

// ری لود جدول کاربران
function reloadTable() {
  fetch('pages/partials/user_table.php')
    .then(res => res.text())
    .then(html => {
      document.getElementById('user-table').innerHTML = html;
    });
}

// Toast نوتیفیکیشن
function showToast(message) {
  const toast = document.getElementById('toast');
  toast.innerText = message;
  toast.classList.remove('hidden');
  setTimeout(() => {
    toast.classList.add('hidden');
  }, 3000);
}
</script>
