<?php  
include "../../koneksi.php";
session_start();

$nama = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Siswa</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Navbar -->
  <header class="bg-green-600 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
      <h1 class="text-xl font-bold">Dashboard Siswa</h1>
      <a href="../../loguot.php" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Logout</a>
    </div>
  </header>

  <!-- Welcome Message -->
  <section class="container mx-auto mt-8 px-4">
    <h2 class="text-2xl font-bold text-center mb-6">Selamat Datang di Halaman Siswa</h2>
  </section>

  <!-- Card Grid -->
  <section class="container mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Card Items -->
    <a href="#" class="block bg-white shadow-md rounded-lg p-6 hover:bg-green-50">
      <h3 class="text-lg font-semibold text-green-600">Cetak Rapot</h3>
      <p class="text-gray-600 mt-2">Cetak rapot hasil belajar siswa.</p>
    </a>
    <a href="#" class="block bg-white shadow-md rounded-lg p-6 hover:bg-green-50">
      <h3 class="text-lg font-semibold text-green-600">Forum Diskusi</h3>
      <p class="text-gray-600 mt-2">Bergabung dalam forum diskusi antar siswa.</p>
    </a>
    <a href="#" class="block bg-white shadow-md rounded-lg p-6 hover:bg-green-50">
      <h3 class="text-lg font-semibold text-green-600">Bank Soal</h3>
      <p class="text-gray-600 mt-2">Akses bank soal untuk latihan ujian.</p>
    </a>
    <a href="#" class="block bg-white shadow-md rounded-lg p-6 hover:bg-green-50">
      <h3 class="text-lg font-semibold text-green-600">Halaman Informasi/Pengumuman</h3>
      <p class="text-gray-600 mt-2">Lihat informasi dan pengumuman terbaru.</p>
    </a>
    <a href="#" class="block bg-white shadow-md rounded-lg p-6 hover:bg-green-50">
      <h3 class="text-lg font-semibold text-green-600">Transkip Nilai</h3>
      <p class="text-gray-600 mt-2">Lihat transkip nilai Anda.</p>
    </a>
    <a href="#" class="block bg-white shadow-md rounded-lg p-6 hover:bg-green-50">
      <h3 class="text-lg font-semibold text-green-600">Cetak Jadwal</h3>
      <p class="text-gray-600 mt-2">Cetak jadwal pelajaran dan kegiatan.</p>
    </a>
    <a href="#" class="block bg-white shadow-md rounded-lg p-6 hover:bg-green-50">
      <h3 class="text-lg font-semibold text-green-600">Gabung Kelas Minat dan Bakat</h3>
      <p class="text-gray-600 mt-2">Gabung dalam kelas minat dan bakat.</p>
    </a>
    <a href="#" class="block bg-white shadow-md rounded-lg p-6 hover:bg-green-50">
      <h3 class="text-lg font-semibold text-green-600">Evaluasi Guru</h3>
      <p class="text-gray-600 mt-2">Berikan evaluasi terhadap guru.</p>
    </a>
    <a href="#" class="block bg-white shadow-md rounded-lg p-6 hover:bg-green-50">
      <h3 class="text-lg font-semibold text-green-600">Halaman Tugas</h3>
      <p class="text-gray-600 mt-2">Lihat dan kelola tugas yang diberikan.</p>
    </a>
    <a href="#" class="block bg-white shadow-md rounded-lg p-6 hover:bg-green-50">
      <h3 class="text-lg font-semibold text-green-600">Konseling</h3>
      <p class="text-gray-600 mt-2">Akses layanan konseling untuk siswa.</p>
    </a>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center py-4 mt-12">
    <p>&copy; 2024 Dashboard Siswa. All rights reserved.</p>
  </footer>

</body>
</html>
