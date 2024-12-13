<?php
include "../../koneksi.php";
session_start();


if (!isset($_SESSION['role'])||$_SESSION['role']!="guru") {
  header("Location: ../../index.php");
  exit;
}


$nama_guru = $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atur Struktur Kelas</title>
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
    <h2 class="text-center mb-4">Atur Struktur Kelas</h2>

    <!-- Form Tambah Struktur Kelas -->
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <form action="proses_tambah_struktur.php" method="POST">
          <div class="mb-3">
            <label for="nama_siswa" class="form-label">Nama Siswa</label>
            <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
          </div>
          <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
          </div>
          <button type="submit" class="btn btn-primary">Tambah Struktur</button>
        </form>
      </div>
    </div>

    <!-- Tabel Struktur Kelas -->
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">Struktur Kelas</div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Nama Siswa</th>
              <th>Jabatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM struktur_kelas ORDER BY id_struktur DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_struktur'] . "</td>";
                    echo "<td>" . $row['nama_siswa'] . "</td>";
                    echo "<td>" . $row['jabatan'] . "</td>";
                    echo "<td>";
                    echo "<a href='edit_struktur.php?id=" . $row['id_struktur'] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                    echo "<a href='hapus_struktur.php?id=" . $row['id_struktur'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>Belum ada data struktur kelas.</td></tr>";
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
