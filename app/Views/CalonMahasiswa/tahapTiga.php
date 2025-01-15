<?= $this->extend('CalonMahasiswa/layout/main') ?>

<?= $this->section('title') ?>
Tahap 3 - PMB Universitas Bina Insan
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
                        class="<?= (current_url() === base_url('CalonMahasiswa/empat')) ? 'font-tebal-banget text-dark' : 'text-muted'; ?>">
                        Resume
                    </a>
                </li>
            </ol>
        </nav>
    </div>
</div>

<!-- End Page Title -->

<!--  Section -->
<section class="container">
    <div class="card shadow" style="border:none">
        <div class="card-body d-flex flex-column flex-lg-row align-items-center">
            <!-- Preview Pas Foto -->
            <div class="text-center mb-4 mb-lg-0">
                <img id="previewImage" src="https://via.placeholder.com/150" alt="Preview Pas Foto" class="rounded" style="width: 300px; height: 400px; object-fit: cover; border: 1px solid #ccc;">
            </div>

            <!-- Form Upload -->
            <div class="flex-grow-1 ms-lg-4">
                <form id="confirmForm" action="<?= base_url('CalonMahasiswa/updateTahapTiga'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group mb-3">
                        <label for="pas_foto" class="form-label">Pas photo 3 x 4 (Ukuran Max. 500Kb Dengan Format .jpg)</label>
                        <input type="file" class="form-control" id="pas_foto" name="foto" accept="image/jpeg" required onchange="previewFile()">
                    </div>
                    <div class="form-group mb-3">
                        <label for="berkas" class="form-label">Berkas syarat pendaftaran dalam 1 file (Ukuran Max. 2Mb Dengan Format .pdf)</label>
                        <input type="file" class="form-control" id="berkas" name="berkas" accept="application/pdf" required>
                    </div>
                    <button type="button" id="confirm-submit" class="btn btn-primary w-100 mt-3">Simpan dan Lanjutkan</button>
                    <script>
                        document.getElementById('confirm-submit').addEventListener('click', function(event) {
                            Swal.fire({
                                title: 'Konfirmasi Simpan',
                                text: 'Apakah Anda yakin data sudah benar? Anda tidak dapat kembali untuk mengubah data setelah ini.',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Ya, Lanjutkan',
                                cancelButtonText: 'Periksa Kembali',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Submit form jika user mengkonfirmasi
                                    document.getElementById('confirmForm').submit();
                                } else {
                                    // Batal, tidak melakukan apa-apa
                                    event.preventDefault();
                                }
                            });
                        });
                    </script>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    // Pratinjau Pas Foto
    function previewFile() {
        const file = document.getElementById('pas_foto').files[0];
        const preview = document.getElementById('previewImage');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>

<!-- End Section -->

<?= $this->endSection() ?>