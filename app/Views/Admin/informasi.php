<?php $this->extend( 'Admin/layout/main' );
?>

<?php $this->section( 'title' );
?>
Informasi - Universitas Bina Insan
<?php $this->endSection();
?>

<?php $this->section( 'content' );
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="fw-bolder">Informasi Pendaftaran Mahasiswa Baru</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tabel Informasi Pendaftaran Mahasiswa Baru</h3>
                    </div>
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
                        $bulan = date_format($tanggalObj, 'n'); // Angka bulan tanpa leading zero (1-12)
                        $tahun = date_format($tanggalObj, 'Y');

                        return $hari . ' ' . $bulanIndonesia[$bulan] . ' ' . $tahun;
                    }
                    ?>


                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Pembukaan Pendaftaran</th>
                                    <th>Tanggal Penutupan Pendaftaran</th>
                                    <th>Tanggal Pengumuman Lulus Administrasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($informasi as $key => $info) : ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= formatTanggalIndonesia($info['tgl_buka']); ?></td>
                                    <td><?= formatTanggalIndonesia($info['tgl_tutup']); ?></td>
                                    <td><?= formatTanggalIndonesia($info['tgl_pengumuman']); ?></td>
                                    <td>
                                        <button class="btn btn-outline-success btn-sm edit-btn"
                                            data-id="<?= $info['id_informasi']; ?>"
                                            data-tgl_buka="<?= $info['tgl_buka']; ?>"
                                            data-tgl_tutup="<?= $info['tgl_tutup']; ?>"
                                            data-tgl_pengumuman="<?= $info['tgl_pengumuman']; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Edit -->
                  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Informasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('Admin/updateInformasi'); ?>" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_informasi" id="id_informasi">
                                        <div class="mb-3">
                                            <label for="tgl_buka" class="form-label">Tanggal Pembukaan</label>
                                            <input type="date" class="form-control" id="tgl_buka" name="tgl_buka" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_tutup" class="form-label">Tanggal Penutupan</label>
                                            <input type="date" class="form-control" id="tgl_tutup" name="tgl_tutup" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl_pengumuman" class="form-label">Tanggal Pengumuman</label>
                                            <input type="date" class="form-control" id="tgl_pengumuman" name="tgl_pengumuman" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                    document.querySelectorAll('.edit-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const id = this.getAttribute('data-id');
                            const tgl_buka = this.getAttribute('data-tgl_buka');
                            const tgl_tutup = this.getAttribute('data-tgl_tutup');
                            const tgl_pengumuman = this.getAttribute('data-tgl_pengumuman');

                            document.getElementById('id_informasi').value = id;
                            document.getElementById('tgl_buka').value = tgl_buka;
                            document.getElementById('tgl_tutup').value = tgl_tutup;
                            document.getElementById('tgl_pengumuman').value = tgl_pengumuman;

                            const modal = new bootstrap.Modal(document.getElementById('editModal'));
                            modal.show();
                        });
                    });
                    </script>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<?php $this->endSection();
?>