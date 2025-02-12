<!-- Modal Tambah -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tahun Ajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tahunajaran/save'); ?>" method="post">
                    <?= csrf_field(); ?>

                    <div class="form-group">
                        <label for="kelas">Tahun</label>
                        <input type="text" class="form-control" placeholder="Tahun" name="tahun" value="<?= date('Y'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Tahun Ajaran</label>
                        <input type="text" class="form-control" placeholder="Tahun Ajaran" name="tahun_id" value="<?= $tahun_id; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="end_date" required>
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


<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Tahun Ajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('tahunajaran/edit'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="id_tahun" name="id">
                    <div class="form-group">
                        <label for="kelas">Tahun</label>
                        <input type="text" class="form-control" id="tahun" placeholder="Tahun" name="tahun" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="tahun_id" placeholder="Tahun Ajaran" name="tahun_id" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Status</label>
                        <label class="toggle-switch toggle-switch-success">
                            <input type="checkbox" name="status" id="status">
                            <span class="toggle-slider round"></span>
                        </label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="typcn typcn-plus"></i> Tambah</button>
        <div class="card mt-3 ">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Tahun Ajaran</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $row) {
                                $status = $row['status'] == 1 ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>';
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['tahun'] ?></td>
                                    <td><?= $row['tahun_id'] ?></td>
                                    <td><?= $row['start_date'] ?></td>
                                    <td><?= $row['end_date'] ?></td>
                                    <td><?= $status ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="btn_edit(this)" id="<?= $row['id']; ?>"><i class="typcn typcn-pencil"></i></button>

                                        <button class="btn btn-danger btn-sm" onclick="btn_hapus('<?= $row['id']; ?>')"><i class="typcn typcn-trash"></i></button>
                                    </td>
                                </tr>

                            <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->section('js'); ?>
<script>
    $('#status').change(function() {
        if ($(this).is(':checked')) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    });

    function btn_edit(event) {
        let id = $(event).attr('id')

        $.ajax({
            method: "POST",
            url: "<?= base_url('tahunajaran/get_ajax') ?>",
            data: {
                id
            },
            success: function(res) {
                $('#tahun').val(res.tahun)
                $('#tahun_id').val(res.tahun_id)
                $('#start_date').val(res.start_date)
                $('#end_date').val(res.end_date)
                $('#id_tahun').val(res.id)
                if (res.status == 1) {
                    $('#status').prop('checked', true).val(1);
                } else {
                    $('#status').prop('checked', false).val(0);
                }
                $('#editModal').modal('show');
            }
        })
    }

    function btn_hapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Ingin menghapus data tersebut',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                        url: "<?= base_url('tahunajaran/hapus'); ?>",
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