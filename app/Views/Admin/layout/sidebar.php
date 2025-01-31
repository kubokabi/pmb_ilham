<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Admin/dashboard'); ?>" class="brand-link">
        <img src="<?= base_url('dist/img/AdminLTELogo.png'); ?>" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin PMB</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= session()->get('nama') ?? 'Administrator'; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('Admin/dashboard'); ?>"
                        class="nav-link <?= (current_url() === base_url('Admin/dashboard')) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Informasi -->
                <li class="nav-item">
                    <a href="<?= base_url('Admin/informasi'); ?>"
                        class="nav-link <?= (current_url() === base_url('Admin/informasi')) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-info-circle"></i>
                        <p>Informasi</p>
                    </a>
                </li>

                <!-- Data Fakultas -->
                <li class="nav-item">
                    <a href="<?= base_url('Admin/data-fakultas'); ?>"
                        class="nav-link <?= (current_url() === base_url('Admin/data-fakultas')) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Data Fakultas</p>
                    </a>
                </li>
                <?php

                use App\Models\FakultasModel;

                // Buat instance model
                $fakultasModel = new FakultasModel();

                // Ambil semua data fakultas
                $fakultas = $fakultasModel->findAll();
                ?>

                <!-- Data Program Studi -->
                <li class="nav-item <?= (strpos(current_url(), 'Admin/data-prodi') !== false) ? 'menu-open' : ''; ?>">
                    <a href="#"
                        class="nav-link <?= (strpos(current_url(), 'Admin/data-prodi') !== false) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            Data Prodi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach ($fakultas as $fak): ?>
                            <li class="nav-item">
                                <a href="<?= base_url('Admin/data-prodi/' . $fak['id_fakultas']); ?>"
                                    class="nav-link <?= (current_url() === base_url('Admin/data-prodi/' . $fak['id_fakultas'])) ? 'active' : ''; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= mb_strimwidth($fak['nama_fakultas'], 0, 23, '...'); ?></p>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- Data Pendaftaran -->
                <li class="nav-item">
                    <a href="<?= base_url('Admin/data-pendaftaran'); ?>"
                        class="nav-link <?= (current_url() === base_url('Admin/data-pendaftaran')) ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data Pendaftaran</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>