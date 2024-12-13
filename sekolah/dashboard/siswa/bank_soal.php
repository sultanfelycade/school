<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Bank Soal dan Ujian Siswa</title>
</head>
<body class="bg-gray-100">

    <div class="container mt-5">
        <h1 class="text-center text-2xl font-bold">Bank Soal dan Ujian</h1>

        <!-- Daftar Soal -->
        <div class="mt-4">
            <h2 class="text-xl">Daftar Soal</h2>
            <div class="row mt-4">
                <?php
                // Koneksi ke database
                include "../../koneksi.php";
                session_start();
                
                if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
                  header("Location: ../../index.php");
                  exit;
                }

                // Ambil data soal dari bank_soal
                $result_soal = $conn->query("SELECT * FROM bank_soal");

                while ($soal = $result_soal->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>Soal ID: {$soal['id_soal']}</h5>
                                    <p class='card-text'>{$soal['soal']}</p>
                                    <a href='kerjakan_soal.php?id={$soal['id_soal']}' class='btn btn-primary'>Kerjakan Soal</a>
                                </div>
                            </div>
                          </div>";
                }
                ?>
            </div>
        </div>

        <!-- Daftar Ujian -->
        <div class="mt-4">
            <h2 class="text-xl">Daftar Ujian</h2>
            <div class="row mt-4">
                <?php
                // Ambil data ujian dari tabel ujian
                $result_ujian = $conn->query("SELECT * FROM ujian");

                while ($ujian = $result_ujian->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$ujian['nama_ujian']}</h5>
                                    <p class='card-text'>Tanggal: " . date('d-m-Y', strtotime($ujian['tanggal'])) . "</p>
                                    <p class='card-text'>Durasi: {$ujian['durasi']} menit</p>
                                    <a href='kerjakan_ujian.php?id={$ujian['id_ujian']}' class='btn btn-primary'>Kerjakan Ujian</a>
                                </div>
                            </div>
                          </div>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>