<?= $this->extend('Admin/layout/main'); ?>

<?= $this->section('title'); ?>
Data Pendaftaran Mahasiswa Baru
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <h1 class="fw-bolder">Data Pendaftaran Mahasiswa Baru</h1>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabel Data Pendaftaran Mahasiswa Baru</h3>
        </div>
        <div class="card-body">
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Pendaftaran</th>
                        <th>Nama Peserta</th>
                        <th>Prodi</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Status Pendaftaran</th>
                        <th>Status Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
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
                    $bulan = date_format($tanggalObj, 'n');
                    $tahun = date_format($tanggalObj, 'Y');

                    return $hari . ' ' . $bulanIndonesia[$bulan] . ' ' . $tahun;
                }
                ?>
                <tbody>
                    <?php if (empty($pendaftarans)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data pendaftaran</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pendaftarans as $key => $pendaftaran): ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $pendaftaran['nomor_pendaftaran']; ?></td>
                                <td><?= $pendaftaran['nama_peserta']; ?></td>
                                <td><?= $pendaftaran['nama_prodi']; ?></td>
                                <td><?= formatTanggalIndonesia($pendaftaran['tanggal_pendaftaran']); ?></td>
                                <td>
                                    <?php if ($pendaftaran['status_pendaftaran'] === 'pending'): ?>
                                        <span class="badge bg-dark">Menunggu Persetujuan</span>
                                    <?php elseif ($pendaftaran['status_pendaftaran'] === 'approved'): ?>
                                        <span class="badge bg-success">Disetujui</span>
                                    <?php elseif ($pendaftaran['status_pendaftaran'] === 'rejected'): ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Tidak Diketahui</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($pendaftaran['status_verifikasi'] === 'unverified'): ?>
                                        <span class="badge bg-dark">Belum Diverifikasi</span>
                                    <?php elseif ($pendaftaran['status_verifikasi'] === 'verified'): ?>
                                        <span class="badge bg-success">Diverifikasi</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Tidak Diketahui</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#detailModal"
                                        data-id="<?= $pendaftaran['id']; ?>"
                                        data-nomor=" <?= $pendaftaran['nomor_pendaftaran']; ?>"
                                        data-nama="<?= $pendaftaran['nama_peserta']; ?>"
                                        data-foto="<?= base_url('uploads/' . $pendaftaran['foto']); ?>"
                                        data-berkas="<?= base_url('uploads/' . $pendaftaran['berkas']); ?>"
                                        data-tempat="<?= $pendaftaran['tempat_lahir']; ?>"
                                        data-tanggal="<?= formatTanggalIndonesia($pendaftaran['tanggal_lahir']); ?>"
                                        data-jenis="<?= ucfirst($pendaftaran['jenis_kelamin']); ?>"
                                        data-agama="<?= $pendaftaran['agama']; ?>"
                                        data-hp="<?= $pendaftaran['no_hp']; ?>"
                                        data-alamat="<?= $pendaftaran['alamat_peserta']; ?>"
                                        data-sekolah="<?= $pendaftaran['nama_sekolah']; ?>"
                                        data-tahun="<?= $pendaftaran['tahun_lulus']; ?>"
                                        data-sekolahalamat="<?= $pendaftaran['alamat_sekolah']; ?>"
                                        data-fakultas="<?= $pendaftaran['nama_fakultas']; ?>"
                                        data-prodi="<?= $pendaftaran['nama_prodi']; ?>"
                                        data-verifikasi="<?= $pendaftaran['status_verifikasi']; ?>"
                                        data-pendaftaran="<?= $pendaftaran['status_pendaftaran']; ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Modal Detail -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Nomor Pendaftaran: <span id="modal-nomor"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img id="modal-foto" src="" alt="Foto Peserta" class="img-fluid rounded mb-3">
                        <a id="modal-berkas" href="#" target="_blank" class="btn btn-primary mt-2">Lihat Berkas</a>
                    </div>
                    <div class="col-md-8">
                        <ul class="nav nav-tabs" id="detailTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="biodata-tab" data-toggle="tab" href="#biodata" role="tab" aria-controls="biodata" aria-selected="true">Biodata</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sekolah-tab" data-toggle="tab" href="#sekolah" role="tab" aria-controls="sekolah" aria-selected="false">Data Sekolah</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="fakultas-tab" data-toggle="tab" href="#fakultas" role="tab" aria-controls="fakultas" aria-selected="false">Fakultas/Prodi</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <!-- Tab Biodata -->
                            <div class="tab-pane fade show active" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nama</th>
                                        <td id="modal-nama"></td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td id="modal-tempat"></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td id="modal-tanggal"></td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td id="modal-jenis"></td>
                                    </tr>
                                    <tr>
                                        <th>Agama</th>
                                        <td id="modal-agama"></td>
                                    </tr>
                                    <tr>
                                        <th>No. Handphone</th>
                                        <td id="modal-hp"></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td id="modal-alamat"></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Tab Data Sekolah -->
                            <div class="tab-pane fade" id="sekolah" role="tabpanel" aria-labelledby="sekolah-tab">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Nama Sekolah</th>
                                        <td id="modal-sekolah"></td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Lulus</th>
                                        <td id="modal-tahun"></td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Sekolah</th>
                                        <td id="modal-sekolahalamat"></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- Tab Fakultas/Prodi -->
                            <div class="tab-pane fade" id="fakultas" role="tabpanel" aria-labelledby="fakultas-tab">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Fakultas</th>
                                        <td id="modal-fakultas"></td>
                                    </tr>
                                    <tr>
                                        <th>Program Studi</th>
                                        <td id="modal-prodi"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form id="updateStatusForm" action="<?= base_url('Admin/updatePendaftaranStatus'); ?>" method="POST" class="w-100">
                    <?= csrf_field(); ?>
                    <!-- Input untuk menyimpan ID Pendaftaran -->
                    <input type="hidden" id="id_pendaftaran" name="id_pendaftaran">

                    <!-- Dropdown Status Verifikasi dan Pendaftaran -->
                    <div class="row w-100">
                        <div class="col-12 mb-3">
                            <label for="status_verifikasi">Status Verifikasi</label>
                            <select class="form-control" id="status_verifikasi" name="status_verifikasi" required>
                                <option value="unverified">Belum Diverifikasi</option>
                                <option value="verified">Diverifikasi</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="status_pendaftaran">Status Pendaftaran</label>
                            <select class="form-control" id="status_pendaftaran" name="status_pendaftaran" required>
                                <option value="pending">Menunggu Persetujuan</option>
                                <option value="approved">Disetujui</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </div>
                        <div class="col-12 text-end">
                            <!-- Tombol Update -->
                            <button type="submit" class="btn btn-success">Update Data</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    // Isi data modal dengan atribut dari tombol
    $('#detailModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget); // Tombol yang memicu modal
        const modal = $(this);

        // Isi data biodata
        modal.find('#id_pendaftaran').val(button.data('id'));
        modal.find('#modal-nomor').text(button.data('nomor'));
        modal.find('#modal-nama').text(button.data('nama'));
        modal.find('#modal-tempat').text(button.data('tempat'));
        modal.find('#modal-tanggal').text(button.data('tanggal'));
        modal.find('#modal-jenis').text(button.data('jenis'));
        modal.find('#modal-agama').text(button.data('agama'));
        modal.find('#modal-hp').text(button.data('hp'));
        modal.find('#modal-alamat').text(button.data('alamat'));

        // Isi data sekolah
        modal.find('#modal-sekolah').text(button.data('sekolah'));
        modal.find('#modal-tahun').text(button.data('tahun'));
        modal.find('#modal-sekolahalamat').text(button.data('sekolahalamat'));

        // Isi data fakultas/prodi
        modal.find('#modal-fakultas').text(button.data('fakultas'));
        modal.find('#modal-prodi').text(button.data('prodi'));

        // Isi data foto dan berkas
        modal.find('#modal-foto').attr('src', button.data('foto'));
        modal.find('#modal-berkas').attr('href', button.data('berkas'));

        // Set status verifikasi dan pendaftaran
        modal.find('#status_verifikasi').val(button.data('verifikasi'));
        modal.find('#status_pendaftaran').val(button.data('pendaftaran'));
    });
</script>

<?= $this->endSection(); ?>