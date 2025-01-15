<?= $this->extend('Admin/layout/main'); ?>

<?= $this->section('title'); ?>
Data Prodi - <?= $fakultas['nama_fakultas']; ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <h1 class="fw-bolder">Data Prodi <?= $fakultas['nama_fakultas']; ?></h1>
    </div>
</section>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabel Data Prodi <?= $fakultas['nama_fakultas']; ?></h3>
            <button class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#addProdiModal"> <i class="fas fa-plus"></i></button>
        </div>
        <div class="card-body">
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Prodi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prodi as $key => $item): ?>
                        <tr>
                            <td><?= $key + 1; ?></td>
                            <td><?= $item['nama_prodi']; ?></td>
                            <td>
                                <button class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#editProdiModal<?= $item['id_prodi']; ?>"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete(this)" data-url="<?= base_url('Admin/data-prodi/delete/' . $item['id_prodi']); ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <script>
                                    function confirmDelete(button) {
                                        const url = button.getAttribute('data-url'); // Ambil URL dari data-url tombol
                                        Swal.fire({
                                            title: 'Apakah Anda yakin?',
                                            text: "Data prodi akan dihapus dan tidak bisa dikembalikan!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Ya, hapus!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Buat formulir dinamis untuk mengirim POST
                                                const form = document.createElement('form');
                                                form.method = 'POST';
                                                form.action = url;

                                                // Tambahkan CSRF jika diperlukan
                                                <?php if (csrf_token()): ?>
                                                    const csrfField = document.createElement('input');
                                                    csrfField.type = 'hidden';
                                                    csrfField.name = '<?= csrf_token(); ?>';
                                                    csrfField.value = '<?= csrf_hash(); ?>';
                                                    form.appendChild(csrfField);
                                                <?php endif; ?>

                                                document.body.appendChild(form);
                                                form.submit(); // Kirim form
                                            }
                                        });
                                    }
                                </script>

                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editProdiModal<?= $item['id_prodi']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="<?= base_url('Admin/data-prodi/update/' . $item['id_prodi']); ?>" method="post">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Prodi</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id_fakultas" value="<?= $fakultas['id_fakultas']; ?>">
                                            <div class="form-group">
                                                <label for="nama_prodi">Nama Prodi</label>
                                                <input type="text" name="nama_prodi" class="form-control" value="<?= $item['nama_prodi']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Add Modal -->
<div class="modal fade" id="addProdiModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('Admin/data-prodi/create'); ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Prodi</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_fakultas" value="<?= $fakultas['id_fakultas']; ?>">
                    <div class="form-group">
                        <label for="nama_prodi">Nama Prodi</label>
                        <input type="text" name="nama_prodi" class="form-control" placeholder="Masukkan nama prodi" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>