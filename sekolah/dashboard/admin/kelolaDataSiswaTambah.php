<?php
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: ../../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil inputan dan membersihkan data untuk mencegah SQL injection
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nisn = mysqli_real_escape_string($conn, $_POST['nisn']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $kontak_orang_tua = mysqli_real_escape_string($conn, $_POST['kontak_orang_tua']);

    // Query untuk memasukkan data
    $query = "INSERT INTO siswa (nama, nisn, alamat, tanggal_lahir, jenis_kelamin, kelas, kontak_orang_tua) 
            VALUES ('$nama', '$nisn', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$kelas', '$kontak_orang_tua')";

    // Eksekusi query
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Jika berhasil, redirect ke halaman kelolaDataSiswa.php
        header("Location: kelolaDataSiswa.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>alert('Gagal menambahkan data siswa!'); window.location.href = 'kelolaDataSiswaTambah.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- sidebar -->
    <?php include '../../layout/sidebar.php'; ?>

    <!-- Navbar -->
    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <button class="text-3xl" onclick="openNav()">&#9776;</button>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto mt-8 px-4">
        <h2 class="text-2xl font-bold text-center mb-6">Form Tambah Data Siswa</h2>

        <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama">Nama Siswa</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama" name="nama" type="text" placeholder="Nama Siswa" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nisn">NISN</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nisn" name="nisn" type="text" placeholder="NISN" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">Alamat</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="alamat" name="alamat" type="text" placeholder="Alamat" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="kontak_orang_tua">Kontak Orang Tua</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kontak_orang_tua" name="kontak_orang_tua" type="text" placeholder="Kontak Orang Tua" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tanggal_lahir">Tanggal Lahir</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tanggal_lahir" name="tanggal_lahir" type="date" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="jenis_kelamin">Jenis Kelamin</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="kelas">Kelas</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="kelas" name="kelas" required>
                    <option value="kelas 1">Kelas 1</option>
                    <option value="kelas 2">Kelas 2</option>
                    <option value="kelas 3">Kelas 3</option>
                </select>
            </div>
            
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Simpan</button>
            </div>
        </form>
    </div>

</body>
</html>
