<?php 
session_start(); // Mulai session
include 'koneksi.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM pengguna WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // Periksa apakah query berhasil
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);

        // Simpan nama ke session
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['role'] = $row['role'];

        // Redirect berdasarkan role
        if ($row['role'] == 'guru') {
            header("Location: dashboard/guru/index.php");
        } else if ($row['role'] == 'murid') {
            header("Location: dashboard/siswa/index.php");
        } else if ($row['role'] == 'admin') {
            header("Location: dashboard/admin/index.php");
        }
        exit; // Pastikan menghentikan eksekusi setelah redirect
    } else {
        echo "<script>alert('Login gagal! Username atau password salah.'); window.location.href = 'login.php';</script>";
    }
} else {
    // Jika form belum diisi, arahkan ke login.php
    header("Location: login.php");
    exit;
}
?>
