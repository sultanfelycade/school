<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['role'])||$_SESSION['role']!="guru") {
  header("Location: ../../index.php");
  exit;
}

// Fungsi untuk mengambil jadwal mengajar
function getJadwalMengajar() {
    global $conn;
    $query = "SELECT * FROM jadwal ORDER BY hari, jam_mulai";
    return mysqli_query($conn, $query);
}

$nama_guru = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Jadwal Mengajar</title>
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
    <h2 class="text-2xl font-bold text-center mb-6">Input Jadwal Mengajar</h2>

    <!-- Tombol Tambah Jadwal -->
    <div class="flex justify-end mb-4">
      <a href="tambah_jadwal.php" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Tambah Jadwal</a>
    </div>

    <!-- Tabel Jadwal Mengajar -->
    <div class="bg-white shadow-md rounded-lg p-6">
      <table class="table-auto w-full text-left border-collapse border border-gray-300">
        <thead>
          <tr>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">ID</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Hari</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Jam Mulai</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Jam Selesai</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Mata Pelajaran</th>
            <th class="px-4 py-2 border border-gray-300 bg-blue-100">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // $jadwal = getJadwalMengajar();
          // if (mysqli_num_rows($jadwal) > 0) {
          //     while ($row = mysqli_fetch_assoc($jadwal)) {
          //         echo "<tr>";
          //         echo "<td class='px-4 py-2 border border-gray-300'>" . $row['id_jadwal'] . "</td>";
          //         echo "<td class='px-4 py-2 border border-gray-300'>" . $row['hari'] . "</td>";
          //         echo "<td class='px-4 py-2 border border-gray-300'>" . $row['jam_mulai'] . "</td>";
          //         echo "<td class='px-4 py-2 border border-gray-300'>" . $row['jam_selesai'] . "</td>";
          //         echo "<td class='px-4 py-2 border border-gray-300'>" . $row['mata_pelajaran'] . "</td>";
          //         echo "<td class='px-4 py-2 border border-gray-300'>";
          //         echo "<a href='edit_jadwal.php?id=" . $row['id_jadwal'] . "' class='text-blue-600 hover:underline'>Edit</a> | ";
          //         echo "<a href='hapus_jadwal.php?id=" . $row['id_jadwal'] . "' class='text-red-600 hover:underline' onclick='return confirm(\"Apakah Anda yakin ingin menghapus jadwal ini?\");'>Hapus</a>";
          //         echo "</td>";
          //         echo "</tr>";
          //     }
          // } else {
          //     echo "<tr><td colspan='6' class='px-4 py-2 text-center text-gray-500'>Belum ada jadwal yang tersedia.</td></tr>";
          // }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
