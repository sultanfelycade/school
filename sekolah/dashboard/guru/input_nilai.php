<?php
session_start();
if (!isset($_SESSION['role'])||$_SESSION['role']!="guru") {
    header("Location: ../../index.php");
    exit;
  }
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Guru SMP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .container-input {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .table-input-nilai {
            max-height: 500px;
            overflow-y: auto;
        }
        .table-input-nilai thead {
            position: sticky;
            top: 0;
            background-color: #f1f3f5;
            z-index: 10;
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container-input">
                    <h3 class="text-center mb-4">Input Nilai Siswa SMP</h3>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Pilih Kelas</label>
                            <select id="kelasSelect" class="form-select">
                                <option value="">Pilih Kelas</option>
                                <option value="7A">Kelas 7A</option>
                                <option value="7B">Kelas 7B</option>
                                <option value="8A">Kelas 8A</option>
                                <option value="8B">Kelas 8B</option>
                                <option value="9A">Kelas 9A</option>
                                <option value="9B">Kelas 9B</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mata Pelajaran</label>
                            <select id="mapelSelect" class="form-select" disabled>
                                <option value="">Pilih Mata Pelajaran</option>
                                <option value="matematika">Matematika</option>
                                <option value="ipa">IPA</option>
                                <option value="bahasa_indonesia">Bahasa Indonesia</option>
                                <option value="bahasa_inggris">Bahasa Inggris</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jenis Penilaian</label>
                            <select id="jenisNilaiSelect" class="form-select" disabled>
                                <option value="">Pilih Jenis Penilaian</option>
                                <option value="tugas">Tugas</option>
                                <option value="ulangan_harian">Ulangan Harian</option>
                                <option value="uts">UTS</option>
                                <option value="uas">UAS</option>
                            </select>
                        </div>
                    </div>

                    <div id="tugasContainer" style="display:none;" class="mb-3">
                        <label class="form-label">Pilih Tugas</label>
                        <select id="tugasSelect" class="form-select">
                            <option value="">Pilih Tugas</option>
                        </select>
                    </div>

                    <div id="inputNilaiContainer" style="display:none;">
                        <div class="table-responsive table-input-nilai">
                            <table class="table table-bordered table-hover" id="tabelNilai">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody id="daftarSiswa">
                                    <!-- Siswa akan dimuat di sini -->
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-3">
                            <button id="simpanNilaiBtn" class="btn btn-primary btn-lg">
                                Simpan Nilai
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data siswa dummy
        const dataSiswa = {
            '7A': [
                {nis: '21001', nama: 'Ahmad Rifqi'},
                {nis: '21002', nama: 'Bella Setiawati'},
                {nis: '21003', nama: 'Citra Amelia'}
            ],
            '7B': [
                {nis: '21004', nama: 'Doni Prasetyo'},
                {nis: '21005', nama: 'Eva Kurniawati'},
                {nis: '21006', nama: 'Fani Handayani'}
            ],
        };

        // Data tugas dummy berdasarkan mata pelajaran
        const dataTugas = {
            'matematika': [
                'Tugas Persamaan Linear',
                'Tugas Geometri',
                'Tugas Aljabar'
            ],
            'ipa': [
                'Tugas Ekosistem',
                'Tugas Struktur Sel',
                'Tugas Energi dan Usaha'
            ],
            'bahasa_indonesia': [
                'Tugas Menulis Puisi',
                'Tugas Membuat Cerpen',
                'Tugas Analisis Teks'
            ],
            'bahasa_inggris': [
                'Tugas Percakapan',
                'Tugas Menulis Essay',
                'Tugas Vocabulary'
            ]
        };

        const kelasSelect = document.getElementById('kelasSelect');
        const mapelSelect = document.getElementById('mapelSelect');
        const jenisNilaiSelect = document.getElementById('jenisNilaiSelect');
        const tugasContainer = document.getElementById('tugasContainer');
        const tugasSelect = document.getElementById('tugasSelect');
        const inputNilaiContainer = document.getElementById('inputNilaiContainer');
        const daftarSiswa = document.getElementById('daftarSiswa');
        const simpanNilaiBtn = document.getElementById('simpanNilaiBtn');

        // Aktifkan pilihan mata pelajaran saat kelas dipilih
        kelasSelect.addEventListener('change', function() {
            mapelSelect.disabled = !this.value;
            mapelSelect.value = '';
            resetForm();
        });

        // Aktifkan pilihan jenis penilaian saat mata pelajaran dipilih
        mapelSelect.addEventListener('change', function() {
            jenisNilaiSelect.disabled = !this.value;
            jenisNilaiSelect.value = '';
            resetForm();
        });

        // Tampilkan dropdown tugas atau input nilai
        jenisNilaiSelect.addEventListener('change', function() {
            resetForm();
            
            if (this.value === 'tugas') {
                // Populate dropdown tugas
                const mapel = mapelSelect.value;
                tugasSelect.innerHTML = '<option value="">Pilih Tugas</option>';
                dataTugas[mapel].forEach(tugas => {
                    const option = document.createElement('option');
                    option.value = tugas;
                    option.textContent = tugas;
                    tugasSelect.appendChild(option);
                });
                
                tugasContainer.style.display = 'block';
                inputNilaiContainer.style.display = 'none';
            } else {
                tugasContainer.style.display = 'none';
                tampilkanSiswa();
            }
        });

        // Tampilkan input nilai saat tugas dipilih
        tugasSelect.addEventListener('change', function() {
            if (this.value) {
                tampilkanSiswa();
            }
        });

        function resetForm() {
            tugasContainer.style.display = 'none';
            inputNilaiContainer.style.display = 'none';
            daftarSiswa.innerHTML = '';
        }

        function tampilkanSiswa() {
            const kelas = kelasSelect.value;
            const siswa = dataSiswa[kelas];
            
            daftarSiswa.innerHTML = '';
            
            siswa.forEach((s, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${s.nis}</td>
                    <td>${s.nama}</td>
                    <td>
                        <input type="number" 
                               class="form-control form-control-sm" 
                               min="0" 
                               max="100" 
                               data-nis="${s.nis}">
                    </td>
                `;
                daftarSiswa.appendChild(tr);
            });

            inputNilaiContainer.style.display = 'block';
        }

        simpanNilaiBtn.addEventListener('click', function() {
            const kelas = kelasSelect.value;
            const mapel = mapelSelect.value;
            const jenisNilai = jenisNilaiSelect.value;
            const tugas = jenisNilai === 'tugas' ? tugasSelect.value : null;

            const nilaiSiswa = [];
            const rows = daftarSiswa.querySelectorAll('tr');

            rows.forEach(row => {
                const nis = row.querySelector('input').getAttribute('data-nis');
                const nama = row.querySelector('td:nth-child(3)').textContent;
                const nilai = row.querySelector('input').value;

                nilaiSiswa.push({
                    nis, 
                    nama, 
                    nilai
                });
            });

            const dataInput = {
                kelas,
                mapel,
                jenisNilai,
                tugas,
                nilaiSiswa
            };

            console.log('Data yang akan disimpan:', dataInput);
            alert('Data nilai berhasil disimpan!');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>