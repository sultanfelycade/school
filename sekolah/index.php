<?php
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == "admin") {
        header("Location: dashboard/admin/index.php");
        exit;
    } else if ($_SESSION['role'] == "guru") {
        header("Location: dashboard/guru/index.php");
        exit;
    } else if ($_SESSION['role'] == "siswa") {
        header("Location: dashboard/siswa/index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Login Here</h1>
        <form action="ceklogin.php" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-600">Username:</label>
                <input type="text" id="username" name="username" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your username">
                <p class="text-xs text-gray-400 mt-1">* Username bisa di isi nama</p>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Password:</label>
                <input type="password" id="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your password">
            </div>
            <button type="submit" class="w-full bg-green-700 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50">Login</button>
        </form>
        <p class="mt-4 text-center text-sm text-gray-500">Forgot Password? <a href="#" class="text-green-500 hover:text-green-800">Click Here</a></p>
    </div>
</body>
</html>
