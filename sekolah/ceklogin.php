<?php 
session_start(); // Mulai session
include 'koneksi.php';

// Periksa apakah user sudah login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    // Query untuk memeriksa username dan password
    $query1 = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $query2 = "SELECT * FROM guru WHERE username = '$username' AND password = '$password'";
    $query3 = "SELECT * FROM siswa WHERE username = '$username' AND password = '$password'";
    $result1 = mysqli_query($conn, $query1);
    $result2 = mysqli_query($conn, $query2);
    $result3 = mysqli_query($conn, $query3);

    // Periksa apakah query berhasil
    if ($result1 && mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $_SESSION['nama'] = $row['nama_lengkap'];
        $_SESSION['role'] = "admin";
        header("Location: dashboard/admin/index.php");
        exit;
    } else if ($result2 && mysqli_num_rows($result2) > 0) {
        $row = mysqli_fetch_assoc($result2);
        $_SESSION['nama'] = $row['nama_lengkap'];
        $_SESSION['role'] = "guru";
        header("Location: dashboard/guru/index.php");
        exit;
    } else if ($result3 && mysqli_num_rows($result3) > 0) {
        $row = mysqli_fetch_assoc($result3);
        $_SESSION['nama'] = $row['nama_lengkap'];
        $_SESSION['role'] = "siswa";
        header("Location: dashboard/siswa/index.php");
        exit;
    } else {
        echo "<script>alert('Login gagal! Username atau password salah.'); window.location.href = 'index.php';</script>";
    }
} else {
    // Jika form belum diisi, arahkan ke login.php
    header("Location: index.php");
    exit;
}
?>
