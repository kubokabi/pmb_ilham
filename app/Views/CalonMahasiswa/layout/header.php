<header id="header" class="header sticky-top">

    <!-- <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div> -->
    <!-- End Top Bar -->

    <div class="branding d-flex align-items-cente">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <h1 class="sitename">Universitas Bina Insan <span class="text-primary">Lubuklinggau</span></h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <?php if (session()->get('role') === 'calon'): ?>
                        <!-- Menu untuk user yang sudah login -->
                        <li>
                            <a href="#" class="active">Home</a>
                        </li>
                        <li>
                            <a href="#" onclick="confirmLogout(event)" class="<?= (current_url() === base_url('logout')) ? 'active' : ''; ?>">Logout</a>
                        </li>
                        <script>
                            function confirmLogout(event) {
                                event.preventDefault(); // Cegah tautan langsung dijalankan
                                Swal.fire({
                                    title: 'Anda yakin ingin logout?',
                                    text: "Anda akan keluar dari sesi ini.",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, logout',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect ke URL logout
                                        window.location.href = "<?= base_url('logout'); ?>";
                                    }
                                });
                            }
                        </script>
                    <?php else: ?>
                        <!-- Menu untuk user yang belum login -->
                        <li>
                            <a href="<?= base_url('/'); ?>" class="<?= (current_url() === base_url('/')) ? 'active' : ''; ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?= base_url('/'); ?>#info" class="<?= (current_url() === base_url('/') . '#info') ? 'active' : ''; ?>">Info PMB</a>
                        </li>
                        <li>
                            <a href="<?= base_url('login'); ?>" class="<?= (current_url() === base_url('login')) ? 'active' : ''; ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>

    </div>

</header>