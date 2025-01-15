<?= $this->extend('CalonMahasiswa/layout/main') ?>

<?= $this->section('title') ?>
Login - PMB Universitas Bina Insan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Login</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="current">Login</li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Login Section -->
<section id="login" class="login section">
    <div class="container text-center mb-4" data-aos="fade-up">
        <h2 class="text-primary fw-bold">Halaman Login</h2>
        <p>Aplikasi Pendaftaran Mahasiswa Baru - Universitas Bina Insan</p>
    </div>

    <div class="container">
        <div class="row align-items-start">
            <!-- Image Section -->
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="<?= base_url('Bizland/assets/img/about.jpg'); ?>" alt="Login Illustration"
                    class="img-fluid rounded shadow">
            </div>
            <!-- End Image Section -->

            <!-- Form Section -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card p-4 shadow" style="border:none">
                    <form action="<?= base_url('autentikasi'); ?>" method="POST">
                        <!-- Email Input -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Masukkan email Anda" required>
                        </div>
                        <!-- Password Input -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan password Anda" required>
                        </div>
                        <!-- Login Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                        <!-- Register Link -->
                        <div class="text-center mt-3">
                            <p>Belum punya akun? <a href="<?= base_url('register'); ?>">Daftar Sekarang</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Form Section -->
        </div>
    </div>
</section>
<!-- End Login Section -->

<!-- Script for Toggle Password Visibility -->
<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordField = document.getElementById('password');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Toggle icon
    this.classList.toggle('bi-eye');
    this.classList.toggle('bi-eye-slash');
});
</script>
<?= $this->endSection() ?>