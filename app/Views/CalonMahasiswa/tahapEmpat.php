<?= $this->extend('CalonMahasiswa/layout/main') ?>

<?= $this->section('title') ?>
Tahap 4 - PMB Universitas Bina Insan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    .breadcrumb-item a {
        text-decoration: none;
        /* Hilangkan garis bawah link */
    }

    .font-tebal-banget {
        font-weight: bolder;
    }

    .breadcrumb-item a:hover {
        font-weight: bolder;
        /* Tambahkan garis bawah saat hover */
    }

    .breadcrumb-item a.text-muted:hover {
        color: #6c757d;
        /* Warna abu-abu tetap saat hover jika tidak aktif */
    }
</style>
<!-- Page Title -->
<div class="page-title py-3 bg-light">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Title -->
        <h1 class="mb-0">Biodata Peserta</h1>

        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('CalonMahasiswa/tahapsatu'); ?>"
                        class="<?= (current_url() === base_url('CalonMahasiswa/tahapsatu')) ? 'font-tebal-banget text-dark' : 'text-muted'; ?>">
                        Biodata
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('CalonMahasiswa/tahapdua'); ?>"
                        class="<?= (current_url() === base_url('CalonMahasiswa/tahapdua')) ? 'font-tebal-banget text-dark' : 'text-muted'; ?>">
                        Prodi
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('CalonMahasiswa/tahaptiga'); ?>"
                        class="<?= (current_url() === base_url('CalonMahasiswa/tahaptiga')) ? 'font-tebal-banget text-dark' : 'text-muted'; ?>">
                        Berkas
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('CalonMahasiswa/tahapempat'); ?>"
                        class="<?= (current_url() === base_url('CalonMahasiswa/tahapempat')) ? 'font-tebal-banget text-dark' : 'text-muted'; ?>">
                        Resume
                    </a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<!-- End Page Title -->
<?php
function formatTanggalIndonesia($tanggal)
{
    $bulanIndonesia = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    ];

    $tanggalObj = date_create($tanggal);
    $hari = date_format($tanggalObj, 'd');
    $bulan = date_format($tanggalObj, 'n'); // Angka bulan tanpa leading zero (1-12)
    $tahun = date_format($tanggalObj, 'Y');

    return $hari . ' ' . $bulanIndonesia[$bulan] . ' ' . $tahun;
}
?>
<!--  Section -->
<section class="container">
    <div class="card shadow">
        <div class="card-header bg-light text-center">
            <h4 class="mb-0">Nomor Pendaftaran <span class="text-primary"><?= $pendaftaran['nomor_pendaftaran']; ?></span></h4>
            <small class="text-muted">Pendaftaran berhasil dilakukan pada tanggal - <?= formatTanggalIndonesia($pendaftaran['tanggal_pendaftaran']); ?></small>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Foto di Kiri -->
                <div class="col-md-4 text-center">
                    <img src="<?= base_url('uploads/' . $pendaftaran['foto']); ?>" alt="Pas Foto" class="img-fluid rounded mb-3">
                    <span>View Berkas Pendaftaran</span>
                </div>

                <!-- Konten di Kanan -->
                <div class="col-md-8">
                    <!-- Tab Menu -->
                    <ul class="nav nav-tabs mb-4" id="pendaftaranTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="biodata-tab" data-bs-toggle="tab" href="#biodata" role="tab" aria-controls="biodata" aria-selected="true">
                                Data Biodata
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="orangtua-tab" data-bs-toggle="tab" href="#orangtua" role="tab" aria-controls="orangtua" aria-selected="false">
                                Data Orang Tua
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="sekolah-tab" data-bs-toggle="tab" href="#sekolah" role="tab" aria-controls="sekolah" aria-selected="false">
                                Data Sekolah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="fakultas-tab" data-bs-toggle="tab" href="#fakultas" role="tab" aria-controls="fakultas" aria-selected="false">
                                Fakultas/Prodi
                            </a>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="pendaftaranTabsContent">
                        <!-- Tab Biodata -->
                        <div class="tab-pane fade show active" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nama</th>
                                        <td><?= $pendaftaran['nama_peserta']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td><?= $pendaftaran['tempat_lahir']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td><?= $pendaftaran['tanggal_lahir']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td><?= $pendaftaran['jenis_kelamin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td><?= $pendaftaran['agama']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>No. Handphone</th>
                                        <td><?= $pendaftaran['no_hp']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td><?= $pendaftaran['alamat_peserta']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tab Data Orang Tua -->
                        <div class="tab-pane fade" id="orangtua" role="tabpanel" aria-labelledby="orangtua-tab">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nama Orang Tua/Wali</th>
                                        <td><?= $pendaftaran['nama_orangtua']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan Orang Tua</th>
                                        <td><?= $pendaftaran['pekerjaan_orangtua']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tab Data Sekolah -->
                        <div class="tab-pane fade" id="sekolah" role="tabpanel" aria-labelledby="sekolah-tab">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nama Sekolah</th>
                                        <td><?= $pendaftaran['nama_sekolah']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Lulus</th>
                                        <td><?= $pendaftaran['tahun_lulus']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Sekolah</th>
                                        <td><?= $pendaftaran['alamat_sekolah']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tab Fakultas/Prodi -->
                        <div class="tab-pane fade" id="fakultas" role="tabpanel" aria-labelledby="fakultas-tab">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Fakultas</th>
                                        <td><?= $pendaftaran['nama_fakultas']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td><?= $pendaftaran['nama_prodi']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Finalisasi -->
                    <div class="text-start mt-4">
                        <form id="finalisasiForm" action="<?= base_url('CalonMahasiswa/updateTahapEmpat'); ?>" method="POST">
                            <button type="button" id="finalisasiButton" class="btn btn-primary">Finalisasi Pendaftaran</button>
                        </form>

                        <script>
                            document.getElementById('finalisasiButton').addEventListener('click', function() {
                                Swal.fire({
                                    title: 'Yakin untuk Finalisasi?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, Finalisasi',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById('finalisasiForm').submit();
                                    }
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Section -->

<?= $this->endSection() ?>