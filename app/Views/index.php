<?= $this->extend('CalonMahasiswa/layout/main') ?>

<?= $this->section('title') ?>
PMB - Universitas Bina Insan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section id="hero" class="hero section light-background">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-12 d-flex flex-column justify-content-center text-center" data-aos="zoom-out">
                <h1>PMB <span>Universitas Bina Insan Lubuklinggau</span></h1>
                <p>Aplikasi Pendaftaran Mahasiswa Baru - Memudahkan Anda untuk Bergabung</p>
                <div class="d-flex justify-content-center">
                    <a href="<?= base_url('register'); ?>" class="btn-get-started">DAFTAR SEKARANG</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Hero Section -->
<section id="info" class="featured-services section">
    <div class="container">
        <div class="row gy-4">
            <!-- Card 1 -->
            <div class="col-lg-6 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <div class="service-item position-relative shadow-sm p-4 rounded text-center">
                    <div class="icon mb-3">
                        <i class="bi bi-calendar-event calendar-icon"></i>
                    </div>
                    <h4 class="text-center"><a href="#" class="stretched-link">Jadwal Pendaftaran</a></h4>
                    <ul class="text-start mt-3">
                        <li><strong>Tanggal Buka:</strong> 1 Januari 2025</li>
                        <li><strong>Tanggal Tutup:</strong> 31 Maret 2025</li>
                        <li><strong>Pengumuman:</strong> 10 April 2025</li>
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
                        <li><strong>Fakultas Ekonomi:</strong> Manajemen, Akuntansi</li>
                        <li><strong>Fakultas Teknik:</strong> Teknik Informatika, Teknik Sipil</li>
                        <li><strong>Fakultas Hukum:</strong> Ilmu Hukum</li>
                    </ul>
                </div>
            </div>
            <!-- End Card 2 -->
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