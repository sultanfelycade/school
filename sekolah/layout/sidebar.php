<!-- sidebar.php -->
<div id="mySidebar" class="fixed top-0 left-0 w-64 h-full bg-gray-800 text-white transform -translate-x-full transition-transform duration-300">
    <button class="absolute top-4 right-4 text-2xl" onclick="closeNav()">&times;</button>
    <nav class="mt-10">
        <?php
        if (isset($_SESSION['role'])) {
            // Jika role adalah admin
            if ($_SESSION['role'] == 'admin') {
                echo '<a href="../../dashboard/admin/index.php" class="block py-2.5 px-4 hover:bg-gray-700">Dashboard</a>';
                echo '<a href="../../dashboard/admin/kelolaDataSiswa.html" class="block py-2.5 px-4 hover:bg-gray-700">Kelola Data Siswa</a>';
                echo '<a href="../../dashboard/admin/kelolaDataGuru/index.php" class="block py-2.5 px-4 hover:bg-gray-700">Kelola Data Guru</a>';
                echo '<a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Input Bank Soal</a>';
                echo '<a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Input Informasi/Pengumuman</a>';
                echo '<a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Input Kurikulum</a>';
                echo '<a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Input Profil Sekolah</a>';
                echo '<a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Input Struktural Sekolah</a>';
                echo '<a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Kelola Login Pengguna</a>';
                echo '<a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Edit Profil Admin</a>';
                echo '<a href="#" class="block py-2.5 px-4 hover:bg-gray-700">About Us</a>';
            }
            // Jika role adalah guru
            elseif ($_SESSION['role'] == 'guru') {
                echo '<a href="../../dashboard/guru/index.php" class="block py-2.5 px-4 hover:bg-gray-700">Dashboard</a>';
                echo '<a href="../../dashboard/guru/Jadwal_Mengajar.php" class="block py-2.5 px-4 hover:bg-gray-700">Jadwal Mengajar</a>';
                echo '<a href="../../dashboard/guru/Laporan.php" class="block py-2.5 px-4 hover:bg-gray-700">Laporan kerusakan/kekurangan fasilitas</a>';
                echo '<a href="../../dashboard/guru/materi_belajar.php" class="block py-2.5 px-4 hover:bg-gray-700">Materi belajar</a>';
                // echo '<a href="../../dashboard/" class="block py-2.5 px-4 hover:bg-gray-700">Struktural Kelas</a>';
                echo '<a href="../../dashboard/KelasMinatBakat.php" class="block py-2.5 px-4 hover:bg-gray-700">Kelas Minat Bakat</a>';
                echo '<a href="../../dashboard/guru/input_nilai.php" class="block py-2.5 px-4 hover:bg-gray-700">Input nilai</a>';
                echo '<a href="../../dashboard/guru/input_absen.php" class="block py-2.5 px-4 hover:bg-gray-700">Absensi</a>';
                echo '<a href="../../dashboard/" class="block py-2.5 px-4 hover:bg-gray-700">Tugas</a>';
                echo '<a href="../../dashboard/" class="block py-2.5 px-4 hover:bg-gray-700">Pelanggaran Siswa</a>';
                echo '<a href="../../dashboard/guru/input_str.php" class="block py-2.5 px-4 hover:bg-gray-700">Buat Struktural Kelas</a>';
            }
            elseif ($_SESSION['role'] == 'siswa') {
              echo '<a href="../../dashboard/siswa/index.php" class="block py-2.5 px-4 hover:bg-gray-700">Dashboard</a>';
              echo '<a href="../../dashboard/siswa/cetak_raport.php" class="block py-2.5 px-4 hover:bg-gray-700">Cetak Raport</a>';
              echo '<a href="../../dashboard/siswa/forum.php" class="block py-2.5 px-4 hover:bg-gray-700">Forum Diskusi</a>';
              echo '<a href="../../dashboard/siswa/bank_soal.php" class="block py-2.5 px-4 hover:bg-gray-700">Bank Soal</a>';
              echo '<a href="../../dashboard/siswa/transkrip_nilai.php" class="block py-2.5 px-4 hover:bg-gray-700">Transkrip Nilai</a>';
              echo '<a href="../../dashboard/siswa/jadwal_pelajaran.php" class="block py-2.5 px-4 hover:bg-gray-700">Jadwal Pelajaran</a>';
              echo '<a href="../../dashboard/siswa/Ektrakulikuler.php" class="block py-2.5 px-4 hover:bg-gray-700">Ektrakulikuler</a>';
              echo '<a href="../../dashboard/siswa/evaluasi.php" class="block py-2.5 px-4 hover:bg-gray-700">Evaluasi Guru</a>';
              echo '<a href="../../dashboard/siswa/Tugas.php" class="block py-2.5 px-4 hover:bg-gray-700">Tugas</a>';
              echo '<a href="../../dashboard/siswa/Konseling.php" class="block py-2.5 px-4 hover:bg-gray-700">Konseling</a>';
          }
        } else {
            echo '<a href="#" class="block py-2.5 px-4 hover:bg-gray-700">Login</a>';
        }
        ?>
        <a href="../../loguot.php" onclick="return confirm('Apakah Anda yakin ingin logout?')" class="block py-2.5 px-4 hover:bg-gray-700 text-red-500">Logout</a>
    </nav>
</div>

<script>
  function openNav() {
    document.getElementById("mySidebar").classList.remove("-translate-x-full");
    document.getElementById("mySidebar").classList.add("translate-x-0");
    document.getElementById("mainContent").classList.add("ml-64");
    document.getElementById("header").classList.add("ml-64");
  }

  function closeNav() {
    document.getElementById("mySidebar").classList.remove("translate-x-0");
    document.getElementById("mySidebar").classList.add("-translate-x-full");
    document.getElementById("mainContent").classList.remove("ml-64");
    document.getElementById("header").classList.remove("ml-64");
  }
</script>