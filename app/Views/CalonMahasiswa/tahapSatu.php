<?= $this->extend('CalonMahasiswa/layout/main') ?>

<?= $this->section('title') ?>
Tahap 1 - PMB Universitas Bina Insan
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
            <form id="confirmForm" action="<?= base_url('CalonMahasiswa/saveTahapSatu'); ?>" method="POST">
                <?= csrf_field(); ?>
                <h5 class="mb-4">Data Diri Peserta</h5>
                <!-- Nama Peserta -->
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" placeholder="Nama Lengkap" required>
                </div>
                <!-- Tempat Lahir -->
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" required>
                </div>
                <!-- Tanggal Lahir -->
                <div class="form-group mb-3">
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <!-- Jenis Kelamin -->
                <div class="form-group mb-3">
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="" disabled selected>Jenis Kelamin</option>
                        <option value="Laki-Laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <!-- Agama -->
                <!-- Agama -->
                <div class="form-group mb-3">
                    <select class="form-control" id="agama" name="agama" required>
                        <option value="" disabled selected>Pilih Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>
                <!-- No HP -->
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. Handphone" required>
                </div>
                <!-- Alamat Peserta -->
                <div class="form-group mb-3">
                    <textarea class="form-control" id="alamat_peserta" name="alamat_peserta" rows="3" placeholder="Alamat Lengkap" required></textarea>
                </div>
                <h5 class="mt-4 mb-4">Data Orang Tua</h5>
                <!-- Nama Orang Tua -->
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="nama_orangtua" name="nama_orangtua" placeholder="Nama Orang Tua/Wali" required>
                </div>
                <!-- Pekerjaan Orang Tua -->
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="pekerjaan_orangtua" name="pekerjaan_orangtua" placeholder="Pekerjaan Orang Tua/Wali" required>
                </div>
                <h5 class="mt-4 mb-4">Data Sekolah</h5>
                <!-- Nama Sekolah -->
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" placeholder="Nama Sekolah Asal" required>
                </div>
                <!-- Tahun Lulus -->
                <div class="form-group mb-3">
                    <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" placeholder="Tahun Lulus" required>
                </div>
                <!-- Alamat Sekolah -->
                <div class="form-group mb-3">
                    <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah" rows="3" placeholder="Alamat Sekolah" required></textarea>
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
<!-- End Section -->

<?= $this->endSection() ?>