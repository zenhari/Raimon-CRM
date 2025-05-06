<?php
// فعال‌سازی لاگ کامل
ini_set('display_errors', 0); 
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../log.txt'); 
error_reporting(E_ALL);

function writeLog($message) {
    $logFile = __DIR__ . '/../log.txt';
    $date = date('Y-m-d H:i:s');
    $msg = "[{$date}] {$message}\n";
    file_put_contents($logFile, $msg, FILE_APPEND);
}

writeLog("شروع حذف کاربر...");

require_once 'db/conn.php';
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    writeLog("شناسه نامعتبر یا ارسال نشده: " . var_export($_GET, true));
    header('Location: dashboard.php?page=users');
    exit;
}

$id = intval($_GET['id']);
writeLog("شناسه دریافتی: {$id}");

try {
    // واکشی اطلاعات کاربر
    $stmt = $pdo->prepare("SELECT profile_image FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        writeLog("کاربر پیدا نشد برای id={$id}");
        throw new Exception("کاربر پیدا نشد.");
    }

    if (!empty($user['profile_image'])) {
        writeLog("مسیر فایل برای حذف: {$imagePath}");

        $imagePath = realpath(__DIR__ . '/../uploads/' . $user['profile_image']);

        if ($imagePath && file_exists($imagePath)) {
            if (unlink($imagePath)) {
                writeLog("فایل عکس حذف شد: {$imagePath}");
            } else {
                writeLog("خطا در حذف فایل: {$imagePath}");
                throw new Exception("خطا در حذف فایل.");
            }
        } else {
            writeLog("فایل عکس وجود ندارد یا مسیر نادرست است: {$imagePath}");
        }
    } else {
        writeLog("هیچ عکس پروفایلی برای کاربر ثبت نشده است.");
    }

    // حذف کاربر
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);

    if ($stmt->rowCount() == 0) {
        writeLog("هیچ رکوردی حذف نشد برای id={$id}");
        throw new Exception("رکوردی حذف نشد.");
    }

    writeLog("حذف موفقیت‌آمیز کاربر id={$id}");
    header('Location: dashboard.php?page=users');
    exit;

} catch (Throwable $e) {
    writeLog("خطا هنگام حذف: " . $e->getMessage());
    header('Location: dashboard.php?page=users&error=خطا در حذف کاربر');
    exit;
}
?>
