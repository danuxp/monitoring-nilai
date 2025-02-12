<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('mapel/save'); ?>" method="post">
                    <input type="hidden" id="id_mapel" name="id">
                    <div class="form-group">
                        <label for="kelas">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" id="mapel" placeholder="Nama Mapel" name="mapel" required>
                    </div>

                    <div class="form-group" id="cek_status">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary" onclick="btn_tambah()"><i class="typcn typcn-plus"></i> Tambah</button>
        <div class="card mt-3 ">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mata Pelajaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $row) {
                                $status = $row['status'] == 1 ? '<span class="badge bg-success"><i class="typcn typcn-tick"></i></span>' : '<span class="badge bg-danger"><i class="typcn typcn-times"></i></span>';
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nama_mapel']; ?></td>
                                    <td>
                                        <?= $status; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="btn_edit(this)" id="<?= $row['id']; ?>" data-nama="<?= $row['nama_mapel']; ?>" data-status="<?= $row['status']; ?>"><i class="typcn typcn-pencil"></i></button>

                                        <button class="btn btn-danger btn-sm" onclick="btn_hapus(this)" id="<?= $row['id']; ?>" data-nama="<?= $row['nama_mapel']; ?>"><i class="typcn typcn-trash"></i></button>
                                    </td>
                                </tr>

                            <?php }; ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->section('js'); ?>
<script>
    function btn_tambah() {
        $('#exampleModal').modal('show');
        $('#mapel').val('')
        $('#cek_status').text('')
        $('#id_mapel').val('')
    }

    function btn_edit(event) {
        let id = $(event).attr('id')
        let nama = $(event).data('nama')
        let status = $(event).data('status')
        let cek_status = status == 1 ? 'checked' : '';

        let html_status = `
            <p class="mb-2">Status Aktif</p>
            <label class="toggle-switch toggle-switch-success">
                <input type="checkbox" ${cek_status} name="status" id="status" value="1">
                <span class="toggle-slider round"></span>
            </label>
        `;
        $('#id_mapel').val(id)
        $('#mapel').val(nama)
        $('#cek_status').html(html_status)

        $('#exampleModal').modal('show')
    }

    function btn_hapus(event) {
        let nama = $(event).data('nama')
        let id = $(event).attr('id')

        Swal.fire({
            title: 'Apakah anda yakin?',
            html: `Ingin menghapus data kelas <strong>${nama}</strong>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                        url: "<?= base_url('mapel/hapus'); ?>",
                        type: 'POST',
                        data: {
                            id
                        }
                    })
                    .done(function(res) {
                        swal.fire(res.title, res.text, res.type).then(() => {
                            location.reload();
                        });
                    })
                    .fail(function() {
                        swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    });
            }

        })


    }
</script>
<?= $this->endSection(); ?>