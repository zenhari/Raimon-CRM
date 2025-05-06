<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سیستم مدیریت مشتری رایمون</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn&display=swap" rel="stylesheet">
    <style>
        body, input, button, label, a {
            font-family: 'Vazirmatn', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-center">ورود به سیستم</h2>

        <?php if (isset($_GET['error'])): ?>
            <div class="p-3 text-sm text-red-600 bg-red-100 rounded">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form class="space-y-5" method="POST" action="login_check.php">
            <div>
                <label for="username" class="block mb-1 text-sm font-medium">نام کاربری</label>
                <input type="text" id="username" name="username" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label for="password" class="block mb-1 text-sm font-medium">رمز عبور</label>
                <input type="password" id="password" name="password" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                    <span class="ml-2 text-sm">مرا به خاطر بسپار</span>
                </label>
                <a href="#" class="text-sm text-blue-600 hover:underline">رمز عبور را فراموش کرده اید؟</a>
            </div>

            <button type="submit" class="w-full py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">ورود</button>
        </form>
    </div>
</body>
</html>