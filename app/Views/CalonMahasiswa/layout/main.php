<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>

    <!-- Favicons -->
    <link href="<?= base_url('Bizland/assets/img/favicon.png') ?>" rel="icon">
    <link href="<?= base_url('Bizland/assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('Bizland/assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('Bizland/assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('Bizland/assets/vendor/aos/aos.css') ?>" rel="stylesheet">
    <link href="<?= base_url('Bizland/assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('Bizland/assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('Bizland/assets/css/main.css') ?>" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <?= $this->include('CalonMahasiswa/layout/header') ?>

    <!-- Main Content -->
    <main class="main">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <?= $this->include('CalonMahasiswa/layout/footer') ?>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('Bizland/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('Bizland/assets/vendor/php-email-form/validate.js') ?>"></script>
    <script src="<?= base_url('Bizland/assets/vendor/aos/aos.js') ?>"></script>
    <script src="<?= base_url('Bizland/assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>
    <script src="<?= base_url('Bizland/assets/vendor/waypoints/noframework.waypoints.js') ?>"></script>
    <script src="<?= base_url('Bizland/assets/vendor/purecounter/purecounter_vanilla.js') ?>"></script>
    <script src="<?= base_url('Bizland/assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>
    <script src="<?= base_url('Bizland/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('Bizland/assets/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>

    <!-- Main JS File -->
    <script src="<?= base_url('Bizland/assets/js/main.js') ?>"></script>
</body>

</html>