<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
  header("Location: ../../index.php");
  exit;
}

$nama = $_SESSION['nama'];
$query = "SELECT * FROM siswa WHERE nama_lengkap = '$nama'";
$result = mysqli_query($conn, $query);

// Ambil data siswa
$row = mysqli_fetch_assoc($result);
$siswa_id = $row['id_siswa'];
$kelas_id = $row['kelas_id']; // Menyimpan kelas_id siswa



// Query untuk mengambil semua mata pelajaran dan nilai siswa
$query = "
    SELECT siswa.nama_lengkap, siswa.nis, mata_pelajaran.nama_pelajaran, nilai.semester, nilai.nilai
    FROM nilai
    JOIN siswa ON siswa.id_siswa = nilai.siswa_id
    JOIN mata_pelajaran ON mata_pelajaran.id_mata_pelajaran = nilai.mata_pelajaran_id
    WHERE nilai.siswa_id = $siswa_id
    ORDER BY nilai.semester, mata_pelajaran.nama_pelajaran
";

$result = mysqli_query($conn, $query);
$nilai_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transkrip Nilai</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .btn-print {
                display: none;
            }
        }

        .content-wrapper {
            display: flex;
            gap: 20px; /* Jarak antara sidebar dan konten */
        }

        .sidebar {
            flex: 0 0 250px; /* Lebar sidebar tetap 250px */
            
            padding: 20px;
        }

        .content {
            flex: 1; /* Konten utama mengambil sisa lebar */
        }

        /* Menambahkan margin untuk card agar tidak terlalu mepet */
        .card {
            margin-top: 20px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>

  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content Wrapper -->
  <div class="container my-5 content-wrapper">
    <!-- Sidebar Section -->
    <div class="sidebar">
      <!-- Sidebar Content (can be menu or info) -->
      <?php include '../../layout/sidebar.php'; ?>
    </div>

    <!-- Main Content Section -->
    <div class="content">
        <div class="card shadow-lg">
            <div class="card-body">
                <h2 class="text-center text-2xl font-bold mb-4">Transkrip Nilai</h2>
                
                <!-- Student Details -->
                <div class="mb-4">
                    <p><strong>Nama:</strong> <?= $row['nama_lengkap'] ?></p>
                    <p><strong>NIS:</strong> <?= $row['nis'] ?></p>
                </div>
                
                <!-- Table of Grades -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Semester</th>
                            <th>Mata Pelajaran</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nilai_data as $nilai): ?>
                            <tr>
                                <td><?= $nilai['semester'] ?></td>
                                <td><?= $nilai['nama_pelajaran'] ?></td>
                                <td><?= $nilai['nilai'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Print Button -->
                <div class="text-center btn-print">
                    <button onclick="window.print()" class="btn btn-primary">Print Transkrip</button>
                </div>
            </div>
        </div>
    </div>
  </div>

    <!-- Optional: Bootstrap JS for enhanced features like modals (if needed) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
