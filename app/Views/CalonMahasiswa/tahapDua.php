<?= $this->extend('CalonMahasiswa/layout/main') ?>

<?= $this->section('title') ?>
Tahap 2 - PMB Universitas Bina Insan
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
        <div class="card-body">
            <form id="confirmForm" action="<?= base_url('CalonMahasiswa/updateTahapDua'); ?>" method="POST">
                <?= csrf_field(); ?>
                <h5 class="mb-4">Pilih Fakultas</h5>
                <div class="form-group mb-3">
                    <select class="form-control" id="id_fakultas" name="id_fakultas" required>
                        <option value="" disabled selected>Pilih Fakultas</option>
                        <?php foreach ($fakultas as $f): ?>
                            <option value="<?= $f['id_fakultas']; ?>"><?= $f['nama_fakultas']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <h5 class="mb-4">Pilih Program Studi</h5>
                <div class="form-group mb-3">
                    <select class="form-control" id="id_prodi" name="id_prodi" required>
                        <option value="" disabled selected>Pilih Program Studi</option>
                        <?php foreach ($prodiGrouped as $idFakultas => $prodis): ?>
                            <?php foreach ($prodis as $p): ?>
                                <option value="<?= $p['id_prodi']; ?>" data-fakultas="<?= $p['id_fakultas']; ?>" style="display: none;">
                                    <?= $p['nama_prodi']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </select>
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
</section>

<script>
    // Saat Fakultas dipilih
    document.getElementById('id_fakultas').addEventListener('change', function() {
        const fakultasId = this.value;
        const prodiDropdown = document.getElementById('id_prodi');

        // Tampilkan opsi Prodi yang sesuai dengan Fakultas
        Array.from(prodiDropdown.options).forEach(option => {
            if (option.dataset.fakultas === fakultasId) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });

        // Reset pilihan Prodi
        prodiDropdown.value = '';
    });
</script>

<!-- End Section -->

<?= $this->endSection() ?>