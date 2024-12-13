<?php
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
    <title>Input Struktural Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
      <!-- Sidebar -->
  <?php include '../../layout/sidebar.php'; ?>
  <!-- Navbar -->
  <header id="header" class="bg-blue-600 text-white py-4 transition-all duration-300">
    <?php include '../../layout/header.php' ?>
  </header>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Input Struktural Kelas</h1>

        <div class="mb-3">
            <label for="kelas" class="form-label">Pilih Kelas:</label>
            <select id="kelas" class="form-select" onchange="toggleTable()">
                <option value="">-- Pilih Kelas --</option>
                <option value="7A">7A</option>
                <option value="7B">7B</option>
                <option value="8A">8A</option>
                <option value="8B">8B</option>
                <option value="9A">9A</option>
                <option value="9B">9B</option>
            </select>
        </div>

        <table id="siswaTable" class="table table-bordered hidden">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Mata Pelajaran</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Contoh data siswa, ini bisa diganti dengan data dinamis jika diperlukan -->
                <tr>
                    <td>1</td>
                    <td>12345</td>
                    <td>Ali Ahmad</td>
                    <td>Matematika</td>
                    <td><input type="text" class="form-control" name="jabatan1" placeholder="Masukkan jabatan..."></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>12346</td>
                    <td>Siti Nur</td>
                    <td>Bahasa Indonesia</td>
                    <td><input type="text" class="form-control" name="jabatan2" placeholder="Masukkan jabatan..."></td>
                </tr>
                <!-- Tambahkan lebih banyak baris data jika diperlukan -->
            </tbody>
        </table>

        <div class="text-center">
            <button class="btn btn-primary" onclick="submitData()">Simpan Data</button>
        </div>
    </div>

    <script>
        function toggleTable() {
            const kelas = document.getElementById('kelas').value;
            const table = document.getElementById('siswaTable');
            if (kelas) {
                table.classList.remove('hidden');
            } else {
                table.classList.add('hidden');
            }
        }

        function submitData() {
            alert('Data berhasil disimpan!');
        }
    </script>
</body>
</html>