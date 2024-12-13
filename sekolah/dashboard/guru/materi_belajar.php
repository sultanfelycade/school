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
  <title>Upload Materi Belajar</title>
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
    <h2 class="text-center mb-4">Upload Materi Belajar</h2>

    <!-- Form Upload Materi -->
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <form action="proses_upload_materi.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="judul_materi" class="form-label">Judul Materi</label>
            <input type="text" class="form-control" id="judul_materi" name="judul_materi" required>
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
          </div>
          <div class="mb-3">
            <label for="link_yt" class="form-label">Link YouTube</label>
            <input type="url" class="form-control" id="link_yt" name="link_yt" placeholder="https://youtube.com/example" required>
          </div>
          <div class="mb-3">
            <label for="file_pdf" class="form-label">File PDF</label>
            <input type="file" class="form-control" id="file_pdf" name="file_pdf" accept="application/pdf" required>
          </div>
          <button type="submit" class="btn btn-primary">Upload Materi</button>
        </form>
      </div>
    </div>

    <!-- Tabel Materi yang Sudah Diunggah -->
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">Materi yang Sudah Diunggah</div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Judul Materi</th>
              <th>Deskripsi</th>
              <th>Link YouTube</th>
              <th>File PDF</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM materi_belajar ORDER BY id_materi DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id_materi'] . "</td>";
                    echo "<td>" . $row['judul_materi'] . "</td>";
                    echo "<td>" . $row['deskripsi'] . "</td>";
                    echo "<td><a href='" . $row['link_yt'] . "' target='_blank'>Tonton Video</a></td>";
                    echo "<td><a href='../../uploads/pdf/" . $row['file_pdf'] . "' target='_blank'>Unduh PDF</a></td>";
                    echo "<td>";
                    echo "<a href='edit_materi.php?id=" . $row['id_materi'] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                    echo "<a href='hapus_materi.php?id=" . $row['id_materi'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus materi ini?\");'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Belum ada materi yang diunggah.</td></tr>";
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
