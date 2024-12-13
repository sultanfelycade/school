<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['role'])||$_SESSION['role']!="admin") {
    header("Location: ../../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>
  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php' ?>
  </header>

  <!-- Main Content -->
  <div id="mainContent" class="container mx-auto mt-8 px-4 transition-all duration-300">
    <h2 class="text-2xl font-bold text-center mb-6">Dashboard Admin - Informasi</h2>

    <!-- Informasi Umum Admin -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
      <h3 class="text-lg font-semibold">Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h3>
      <p class="text-gray-600 mt-4">Ini adalah dashboard untuk admin yang memungkinkan Anda untuk mengelola berbagai aspek sistem, termasuk data siswa, guru, pengumuman, dan lebih banyak lagi.</p>

      <h3 class="text-lg font-semibold mt-6">Ringkasan Pengelolaan Sistem</h3>
      <p class="text-gray-600 mt-4">Sebagai admin, Anda memiliki akses penuh untuk mengelola data sekolah, termasuk:</p>
      <ul class="list-disc pl-6 mt-4 text-gray-600">
        <li>Menambah, mengedit, dan menghapus data siswa dan guru.</li>
        <li>Mengelola pengumuman dan informasi penting di sekolah.</li>
        <li>Mengatur jadwal, pelanggaran, dan evaluasi guru.</li>
        <li>Memantau status dan perkembangan berbagai kegiatan administrasi sekolah.</li>
      </ul>
    </div>

    <!-- Statistik -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
      <h3 class="text-lg font-semibold">Statistik Terbaru</h3>
      <p class="text-gray-600 mt-4">Berikut adalah beberapa statistik penting yang bisa membantu Anda dalam memantau kegiatan di sistem:</p>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
        <div class="bg-blue-100 p-4 rounded-lg shadow-md text-center">
          <h4 class="text-xl font-semibold text-blue-700">Jumlah Siswa</h4>
          <p class="text-3xl font-bold text-gray-800"><?php echo getJumlahSiswa(); ?></p>
        </div>
        
        <div class="bg-green-100 p-4 rounded-lg shadow-md text-center">
          <h4 class="text-xl font-semibold text-green-700">Jumlah Guru</h4>
          <p class="text-3xl font-bold text-gray-800"><?php echo getJumlahGuru(); ?></p>
        </div>

        <div class="bg-yellow-100 p-4 rounded-lg shadow-md text-center">
          <h4 class="text-xl font-semibold text-yellow-700">Pengumuman Terbaru</h4>
          <p class="text-xl text-gray-800"><?php echo getPengumumanTerbaru(); ?></p>
        </div>
      </div>
    </div>

    <!-- Informasi Tambahan -->
    <div class="bg-white shadow-md rounded-lg p-6">
      <h3 class="text-lg font-semibold">Informasi Tambahan</h3>
      <p class="text-gray-600 mt-4">Berikut adalah beberapa informasi tambahan yang dapat membantu Anda dalam menjalankan tugas administrasi:</p>
      <ul class="list-disc pl-6 mt-4 text-gray-600">
        <li>Pastikan untuk selalu memeriksa pembaruan data siswa dan guru setiap minggu.</li>
        <li>Pengumuman terkait ujian dan kegiatan lainnya dapat diakses melalui menu Pengumuman.</li>
        <li>Untuk laporan evaluasi dan pelanggaran siswa, Anda bisa mengaksesnya langsung di dashboard.</li>
      </ul>
    </div>
  </div>

  <script>
    function openNav() {
      document.getElementById("mySidebar").classList.remove("-translate-x-full");
      document.getElementById("mySidebar").classList.add("translate-x-0");
      document.getElementById("mainContent").classList.add("ml-64");
      document.getElementById("header").classList.add("ml-64");
    }

    function closeNav() {
      document.getElementById("mySidebar").classList.remove("translate-x-0");
      document.getElementById("mySidebar").classList.add("-translate-x-full");
      document.getElementById("mainContent").classList.remove("ml-64");
      document.getElementById("header").classList.remove("ml-64");
    }

    document.getElementById('navbarDropdown').addEventListener('click', function() {
      document.getElementById('dropdownMenu').classList.toggle('hidden');
    });
  </script>
</body>
</html>

<?php
// Fungsi untuk mengambil jumlah siswa dari database
function getJumlahSiswa() {
    global $conn;
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa");
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

// Fungsi untuk mengambil jumlah guru dari database
function getJumlahGuru() {
    global $conn;
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM guru");
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

// Fungsi untuk mengambil pengumuman terbaru
function getPengumumanTerbaru() {
    global $conn;
    $result = mysqli_query($conn, "SELECT deskripsi FROM informasi ORDER BY tanggal_publikasi DESC LIMIT 1");
    $data = mysqli_fetch_assoc($result);
    return $data['pengumuman'] ?? "Tidak ada pengumuman terbaru.";
}
?>
