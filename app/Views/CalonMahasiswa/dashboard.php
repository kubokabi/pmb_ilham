<?= $this->extend('CalonMahasiswa/layout/main') ?>

<?= $this->section('title') ?>
Dashboard- PMB Universitas Bina Insan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!--  Section -->
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
    <div class="text-center mb-4" data-aos="fade-up">
        <h2 class="fw-bold">Nomor Pendaftaran <span class="text-primary "><?= $pendaftaran['nomor_pendaftaran']; ?></span></h2>
        <p class="text-muted">Pendaftaran berhasil dilakukan pada tanggal - <?= formatTanggalIndonesia($pendaftaran['tanggal_pendaftaran']); ?></p>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <!-- Foto di Kiri -->
                <div class="col-md-4 text-center">
                    <img src="<?= base_url('uploads/' . $pendaftaran['foto']); ?>" alt="Pas Foto" class="img-fluid rounded mb-3">
                    <span class="d-block fw-bold">Preview Berkas Pendaftaran</span>
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
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th style="width: 30%;">Biodata</th>
                                        <th style="width: 65%;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-light">
                                        <td>1</td>
                                        <td>Nama</td>
                                        <td><?= $pendaftaran['nama_peserta']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Tempat Lahir</td>
                                        <td><?= $pendaftaran['tempat_lahir']; ?></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td>3</td>
                                        <td>Tanggal Lahir</td>
                                        <td><?= formatTanggalIndonesia($pendaftaran['tanggal_lahir']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Jenis Kelamin</td>
                                        <td><?= $pendaftaran['jenis_kelamin']; ?></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td>5</td>
                                        <td>Agama</td>
                                        <td><?= $pendaftaran['agama']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>No. Handphone</td>
                                        <td><?= $pendaftaran['no_hp']; ?></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td>7</td>
                                        <td>Alamat</td>
                                        <td><?= $pendaftaran['alamat_peserta']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tab Data Orang Tua -->
                        <div class="tab-pane fade" id="orangtua" role="tabpanel" aria-labelledby="orangtua-tab">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data Orang Tua</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-light">
                                        <td>1</td>
                                        <td>Nama Orang Tua/Wali</td>
                                        <td><?= $pendaftaran['nama_orangtua']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Pekerjaan Orang Tua</td>
                                        <td><?= $pendaftaran['pekerjaan_orangtua']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tab Data Sekolah -->
                        <div class="tab-pane fade" id="sekolah" role="tabpanel" aria-labelledby="sekolah-tab">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Data Sekolah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-light">
                                        <td>1</td>
                                        <td>Nama Sekolah</td>
                                        <td><?= $pendaftaran['nama_sekolah']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Tahun Lulus</td>
                                        <td><?= $pendaftaran['tahun_lulus']; ?></td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td>3</td>
                                        <td>Alamat Sekolah</td>
                                        <td><?= $pendaftaran['alamat_sekolah']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tab Fakultas/Prodi -->
                        <div class="tab-pane fade" id="fakultas" role="tabpanel" aria-labelledby="fakultas-tab">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fakultas/Prodi</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-light">
                                        <td>1</td>
                                        <td>Fakultas</td>
                                        <td><?= $pendaftaran['nama_fakultas']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Program Studi</td>
                                        <td><?= $pendaftaran['nama_prodi']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="text-start mt-4">
                        <!-- Status Pendaftaran -->
                        <?php if ($pendaftaran['status_pendaftaran'] === 'pending'): ?>
                            <span class="badge bg-dark">Status Pendaftaran: Menunggu Persetujuan</span>
                        <?php elseif ($pendaftaran['status_pendaftaran'] === 'approved'): ?>
                            <span class="badge bg-success">Status Pendaftaran: Disetujui</span>
                        <?php elseif ($pendaftaran['status_pendaftaran'] === 'rejected'): ?>
                            <span class="badge bg-danger">Status Pendaftaran: Ditolak</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Status Pendaftaran: Tidak Diketahui</span>
                        <?php endif; ?>
                        <br>
                        <!-- Status Verifikasi -->
                        <?php if ($pendaftaran['status_verifikasi'] === 'unverified'): ?>
                            <span class="badge bg-dark">Status Verifikasi: Belum Diverifikasi</span>
                        <?php elseif ($pendaftaran['status_verifikasi'] === 'verified'): ?>
                            <span class="badge bg-success">Status Verifikasi: Diverifikasi</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Status Verifikasi: Tidak Diketahui</span>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Section -->

<?= $this->endSection() ?>