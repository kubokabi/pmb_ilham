<?= $this->extend('CalonMahasiswa/layout/main') ?>

<?= $this->section('title') ?>
Pendaftaran - PMB Universitas Bina Insan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Page Title -->
<div class="page-title" data-aos="fade">
    <div class="container d-lg-flex justify-content-between align-items-center">
        <h1 class="mb-2 mb-lg-0">Pendaftaran</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="<?= base_url('/'); ?>">Home</a></li>
                <li class="current">Pendaftaran</li>
            </ol>
        </nav>
    </div>
</div>
<!-- End Page Title -->

<!-- Registration Section -->
<section id="registration" class="registration section">
    <div class="container">
        <div class="row align-items-start">
            <!-- Image Section -->
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <img src="<?= base_url('Bizland/assets/img/about.jpg'); ?>" alt="Registration Illustration" class="img-fluid rounded shadow">
            </div>
            <!-- End Image Section -->

            <!-- Form Section -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card shadow-sm p-4">
                    <h3 class="text-center mb-4">Daftar Akun Anda</h3>
                    <form action="<?= base_url('auth/register'); ?>" method="POST">
                        <!-- Name Input -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required>
                        </div>
                        <!-- Email Input -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
                        </div>
                        <!-- Password Input -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-eye-slash toggle-password" id="togglePassword1"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
                        </div>
                        <!-- Confirm Password Input -->
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white">
                                <i class="bi bi-eye-slash toggle-password" id="togglePassword2"></i>
                            </span>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password Anda" required>
                        </div>
                        <!-- Register Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                        <!-- Login Link -->
                        <div class="text-center mt-3">
                            <p>Sudah punya akun? <a href="<?= base_url('login'); ?>">Silahkan Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Form Section -->
        </div>
    </div>
</section>
<!-- End Registration Section -->

<!-- Script for Toggle Password Visibility -->
<script>
    // Toggle visibility for password
    document.getElementById('togglePassword1').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle icon
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    document.getElementById('togglePassword2').addEventListener('click', function() {
        const confirmPasswordField = document.getElementById('confirm_password');
        const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordField.setAttribute('type', type);

        // Toggle icon
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
</script>
<?= $this->endSection() ?>