<?= $this->extend('CalonMahasiswa/layout/main') ?>

<?= $this->section('title') ?>
PMB - Universitas Bina Insan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section id="hero" class="hero section light-background">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12 d-flex flex-column justify-content-center text-start" data-aos="zoom-out">
                <h1>PMB <span>Universitas Bina Insan Lubuklinggau</span></h1>
                <p>Aplikasi Pendaftaran Mahasiswa Baru - Memudahkan Anda untuk Bergabung</p>
                <div class="d-flex justify-content-start">
                    <a href="<?= base_url('register'); ?>" class="btn-get-started">DAFTAR SEKARANG</a>
                </div>
            </div>
        </div>
    </div>
</section>
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
<!-- End Hero Section -->
<section id="info" class="featured-services section">
    <div class="container">
        <div class="row gy-4">
            <?php

            use App\Models\InformasiModel;
            use App\Models\FakultasModel;
            use App\Models\ProdiModel;

            // Panggil model Informasi
            $informasiModel = new InformasiModel();
            $informasi = $informasiModel->first(); // Ambil satu baris data informasi (diasumsikan hanya satu)

            // Panggil model Fakultas
            $fakultasModel = new FakultasModel();
            $fakultas = $fakultasModel->findAll(); // Ambil semua fakultas

            // Panggil model Prodi
            $prodiModel = new ProdiModel();
            $prodi = $prodiModel->findAll(); // Ambil semua program studi
            ?>

            <div class="row">
                <!-- Card 1 -->
                <div class="col-lg-6 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative shadow-sm p-4 rounded text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-calendar-event calendar-icon"></i>
                        </div>
                        <h4 class="text-center"><a href="#" class="stretched-link">Jadwal Pendaftaran</a></h4>
                        <ul class="text-start mt-3">
                            <li><strong>Tanggal Buka:</strong> <?=formatTanggalIndonesia($informasi['tgl_buka']); ?></li>
                            <li><strong>Tanggal Tutup:</strong> <?= formatTanggalIndonesia($informasi['tgl_tutup']); ?></li>
                            <li><strong>Pengumuman:</strong> <?= formatTanggalIndonesia($informasi['tgl_pengumuman']); ?></li>
                        </ul>
                    </div>
                </div>
                <!-- End Card 1 -->

                <!-- Card 2 -->
                <div class="col-lg-6 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item position-relative shadow-sm p-4 rounded text-center">
                        <div class="icon mb-3">
                            <i class="bi bi-info-circle calendar-icon"></i>
                        </div>
                        <h4 class="text-center"><a href="#" class="stretched-link">Informasi Program Studi</a></h4>
                        <ul class="text-start mt-3">
                            <?php foreach ($fakultas as $f): ?>
                                <li>
                                    <strong><?= $f['nama_fakultas']; ?>:</strong>
                                    <?php
                                    // Ambil program studi berdasarkan id_fakultas
                                    $prodiList = array_filter($prodi, fn($p) => $p['id_fakultas'] === $f['id_fakultas']);
                                    $prodiNames = array_column($prodiList, 'nama_prodi');
                                    echo implode(', ', $prodiNames);
                                    ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- End Card 2 -->
            </div>

        </div>
    </div>
</section>

<!-- /Featured Services Section -->

<!-- /Featured Services Section -->

<!-- About Section -->
<section id="about" class="about section light-background">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Tentang PMB</h2>
            <p>Proses pendaftaran yang mudah, cepat, dan efisien</p>
        </div>
        <div class="row gy-3">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <img src="<?= base_url('Bizland/assets/img/about.jpg') ?>" alt="Tentang PMB" class="img-fluid">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <div class="about-content">
                    <p>
                        Universitas Bina Insan menawarkan program pendaftaran mahasiswa baru dengan sistem online
                        yang modern. Kami menyediakan berbagai program studi unggulan dengan tenaga pengajar
                        profesional untuk mendukung karier Anda di masa depan.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Proses pendaftaran online yang mudah</li>
                        <li><i class="bi bi-check-circle"></i> Program studi berkualitas</li>
                        <li><i class="bi bi-check-circle"></i> Tenaga pengajar profesional</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End About Section -->

<!-- Layanan Kami Section -->
<section id="services" class="services section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Layanan Kami</h2>
            <p>Mendukung kebutuhan Anda dalam pendaftaran mahasiswa baru</p>
        </div>
        <div class="row gy-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-item position-relative">
                    <div class="icon"><i class="bi bi-person-bounding-box"></i></div>
                    <h3>Konsultasi Pendaftaran</h3>
                    <p>Kami menyediakan layanan konsultasi bagi calon mahasiswa yang membutuhkan bantuan dalam proses
                        pendaftaran.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-item position-relative">
                    <div class="icon"><i class="bi bi-book"></i></div>
                    <h3>Program Studi Lengkap</h3>
                    <p>Berbagai program studi yang disesuaikan dengan minat dan kebutuhan Anda.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-item position-relative">
                    <div class="icon"><i class="bi bi-card-checklist"></i></div>
                    <h3>Proses Verifikasi Cepat</h3>
                    <p>Proses verifikasi dokumen yang efisien untuk memudahkan pendaftaran.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Layanan Kami Section -->

<!-- FAQ Section -->
<section id="faq" class="faq section light-background">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>FAQ</h2>
            <p>Pertanyaan yang Sering Diajukan</p>
        </div>
        <div class="row gy-3">
            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                <div class="faq-item">
                    <h4>Bagaimana cara mendaftar?</h4>
                    <p>Kunjungi halaman pendaftaran kami dan isi formulir yang tersedia.</p>
                </div>
                <div class="faq-item">
                    <h4>Apakah pendaftaran dapat dilakukan secara online?</h4>
                    <p>Ya, pendaftaran dapat dilakukan secara online melalui website resmi Universitas Bina Insan.</p>
                </div>
                <div class="faq-item">
                    <h4>Berapa biaya pendaftaran?</h4>
                    <p>Informasi biaya pendaftaran dapat dilihat pada halaman informasi pendaftaran.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End FAQ Section -->

<?= $this->endSection() ?>