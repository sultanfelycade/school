<?php
include '../../koneksi.php';

session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != "siswa") {
  header("Location: ../../index.php");
  exit;
}

// Ambil mata pelajaran
$query = "SELECT * FROM mata_pelajaran";
$result = mysqli_query($conn, $query);
$mataPelajaran = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Ambil forum
$query = "SELECT f.*, s.nama_lengkap FROM forum f JOIN siswa s ON f.dibuat_oleh = s.id_siswa";
$result = mysqli_query($conn, $query);
$forums = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Diskusi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Flexbox layout untuk memastikan sidebar dan konten utama tidak saling tertimpa */
        .main-container {
            display: flex;
            margin-left: 250px; /* Atur lebar sidebar */
        }

        #sidebar {
            flex: 0 0 250px; /* Sidebar dengan lebar tetap */
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
            height: 100vh;
            z-index: 1050; /* Sidebar tetap di atas konten */
        }

        .content {
            flex: 1;
            padding: 20px;
            margin-top: 20px; /* Memberikan jarak antara header dan konten */
        }

        /* Agar body tidak tumpang tindih dengan sidebar */
        body {
            overflow-x: hidden;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .main-container {
                margin-left: 0; /* Menghilangkan margin untuk layar kecil */
            }

            #sidebar {
                position: static;
                height: auto;
                width: 100%;
            }

            .content {
                margin-left: 0;
            }
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

    <div class="main-container">
        <div class="content">
            <h1 class="text-center mb-4">Forum Diskusi</h1>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h2>Buat Forum Baru</h2>
                </div>
                <div class="card-body">
                    <form action="buat_forum.php" method="POST">
                        <div class="mb-3">
                            <label for="mata_pelajaran_id" class="form-label">Mata Pelajaran:</label>
                            <select name="mata_pelajaran_id" class="form-select" required>
                                <?php foreach ($mataPelajaran as $mp): ?>
                                    <option value="<?= $mp['id_mata_pelajaran'] ?>"><?= $mp['nama_pelajaran'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul:</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi:</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Buat Forum</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h2>Daftar Forum</h2>
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($forums as $forum): ?>
                        <li class="list-group-item">
                            <h3 class="mb-1"><?= htmlspecialchars($forum['judul']) ?> <small class="text-muted">(oleh <?= htmlspecialchars($forum['nama_lengkap']) ?>)</small></h3>
                            <p><?= htmlspecialchars($forum['deskripsi']) ?></p>
                            <a href="komentar.php?id=<?= $forum['id_forum'] ?>" class="btn btn-sm btn-info">Komentar</a>
                            <form action="hapus_forum.php" method="POST" style="display:inline;">
                                <input type="hidden" name="forum_id" value="<?= $forum['id_forum'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Hapus Forum</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
