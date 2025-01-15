<?= $this->extend('Admin/layout/main'); ?>

<?= $this->section('title'); ?>
Data Fakultas
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="fw-bolder">Data Fakultas</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tabel Data Fakultas</h3>
                        <button type="button" class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#fakultasModal">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Fakultas</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fakultas as $key => $row): ?>
                                    <tr>
                                        <td><?= $key + 1; ?></td>
                                        <td><?= $row['nama_fakultas']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal"
                                                data-target="#fakultasModal"
                                                data-id_fakultas="<?= $row['id_fakultas']; ?>"
                                                data-nama_fakultas="<?= $row['nama_fakultas']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <form action="<?= base_url('Admin/deleteFakultas/') . $row['id_fakultas']; ?>" method="POST" style="display: inline;">
                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="confirmDelete(this)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Tambah/Edit -->
                    <div class="modal fade" id="fakultasModal" tabindex="-1" aria-labelledby="fakultasModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="fakultasModalLabel">Fakultas</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('Admin/saveFakultas'); ?>" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" id="id_fakultas" name="id_fakultas">
                                        <div class="form-group">
                                            <label for="nama_fakultas">Nama Fakultas</label>
                                            <input type="text" id="nama_fakultas" name="nama_fakultas" class="form-control" placeholder="Masukan nama fakultas.." required>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="submit" class="button-aksi btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section> 
<script>
    // Isi data modal untuk edit
    $('#fakultasModal').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget); // Button yang men-trigger modal
        const id = button.data('id_fakultas');
        const nama = button.data('nama_fakultas'); 

        const modal = $(this);
        if (id) {
            modal.find('#id_fakultas').val(id);
            modal.find('#nama_fakultas').val(nama);
            modal.find('.modal-title').text('Edit Fakultas');
            modal.find('.button-aksi').text('Update');
        } else {
            modal.find('#id_fakultas').val('');
            modal.find('#nama_fakultas').val('');
            modal.find('.modal-title').text('Tambah Fakultas');
            modal.find('.button-aksi').text('Simpan');
        }
    });


    // Konfirmasi Hapus
    function confirmDelete(button) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = $(button).closest('form');
                form.submit(); // Submit form jika dikonfirmasi
            }
        });
    }
</script>
<?= $this->endSection(); ?>