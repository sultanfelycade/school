<?php
require_once "../../koneksi.php";
require_once "../../layout/header.php";

$query = "SELECT * FROM kelas";
$result = mysqli_query($conn, $query);
$kelas = mysqli_fetch_assoc($result);


session_start();
if (!isset($_SESSION['role'])||$_SESSION['role']!="guru") {
    header("Location: ../../index.php");
    exit;
  }

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Kerusakan Fasilitas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* * {
        border: 1px solid black;
    } */

    body {
        background-color: RGB(245, 245, 245);
    }
    .laporan {
        margin-right: 10px;
        border-radius: 5px;
        background-color: white;
        padding: 20px;
    }
    .form {
        border-radius: 5px;
        background-color: white;
        padding: 20px;
    }
    .container {
        margin-top: 45px;
        margin-bottom: 65px;
        display: flex;
        justify-content: center;
        gap: 14px;
    }


  </style>
</head>
<body>
    <div class="container">
        <!-- Tabel Data Riwayat Laporan -->
        <div class="col-md-8 laporan">
            <h3>Laporan</h3>
            <hr>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Deskripsi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr>
                        <th scope="row">1</th>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Formulir Tambah Laporan -->
        <div class="col-md-4 form">
            <h3>Tambah Laporan</h3>
            <hr>
            <form>
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select class="form-select" id="kelas">
                        <option selected>-- Pilih kelas --</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select class="form-select" id="jenis">
                        <option selected>-- Pilih Kekurangan/Kerusakan --</option>
                        <option value="Meja">Kerusakan</option>
                        <option value="Kursi">Kekurangan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" rows="3" placeholder="Masukkan deskripsi kerusakan"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
            </form>
        </div>
    </div>

  <?php require_once "../../layout/footer.php" ?>
</body>
</html>