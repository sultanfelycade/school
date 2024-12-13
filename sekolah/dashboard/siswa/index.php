<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
  header("Location: ../../index.php");
  exit;
}

// Fungsi untuk mengambil pengumuman terbaru
function getPengumumanTerbaru() {
    global $conn;
    $result = mysqli_query($conn, "SELECT deskripsi FROM informasi ORDER BY tanggal_publikasi DESC LIMIT 1");
    $data = mysqli_fetch_assoc($result);
    return $data['deskripsi'] ?? "Tidak ada pengumuman terbaru.";
}

$nama_siswa = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
    <h2 class="text-2xl font-bold text-center mb-6">Dashboard Siswa</h2>

    <!-- Informasi Umum Siswa -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
      <h3 class="text-lg font-semibold">Selamat Datang, <?php echo $nama_siswa; ?>!</h3>
      <p class="text-gray-600 mt-4">Ini adalah dashboard untuk siswa yang memungkinkan Anda untuk melihat pengumuman terbaru, materi, jadwal pelajaran, dan tugas.</p>
    </div>

    <!-- Pengumuman -->
    <div class="bg-white shadow-md rounded-lg p-6">
      <h3 class="text-lg font-semibold">Pengumuman Terbaru</h3>
      <p class="text-gray-600 mt-4"><?php echo getPengumumanTerbaru(); ?></p>
    </div>
  </div>
</body>
</html>
