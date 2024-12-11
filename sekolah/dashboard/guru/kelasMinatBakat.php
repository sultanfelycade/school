<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: ../../login.php");
    exit;
}

$nama_guru = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Kelas Minat dan Bakat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>
  <!-- Navbar -->
  <header id="header" class="bg-primary text-white py-3">
    <?php include '../../layout/header.php'; ?>
  </header>

  <!-- Main Content -->
  <div class="container mt-4">
    <h2 class="text-center mb-4">Buat Kelas Minat dan Bakat</h2>

    <!-- Form Buat Kelas -->
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <form action="proses_buat_kelas.php" method="POST">
          <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="jadwal" class="form-label">Jadwal</label>
            <input type="text" class="form-control" id="jadwal" name="jadwal" placeholder="Contoh: Senin, 10:00 - 12:00" required>
          </div>
          <button type="submit" class="btn btn-primary">Buat Kelas</button>
        </form>
      </div>
    </div>

    <!-- Tabel Kelas yang Sudah Dibuat -->
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">Kelas yang Sudah Dibuat</div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Nama Kelas</th>
              <th>Deskripsi</th>
              <th>Jadwal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM kelas_minat ORDER BY id_kelas DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_kelas'] . "</td>";
                    echo "<td>" . $row['nama_kelas'] . "</td>";
                    echo "<td>" . $row['deskripsi'] . "</td>";
                    echo "<td>" . $row['jadwal'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_kelas.php?id=" . $row['id_kelas'] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                    echo "<a href='hapus_kelas.php?id=" . $row['id_kelas'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus kelas ini?\");'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Belum ada kelas yang dibuat.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
