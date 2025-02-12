<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formKelas" method="post">
                    <input type="hidden" id="id_kelas">
                    <div class="form-group">
                        <label for="kelas">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username">
                    </div>

                    <div class="form-group">
                        <label for="kelas">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Masukkan Email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="kelas">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password">
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
        <button type="button" class="btn btn-primary" onclick="btn_tambah()"><i class="typcn typcn-plus"></i> Tambah User Admin</button>
        <div class="card mt-3 ">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="true">Admin</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="siswa-tab" data-bs-toggle="tab" data-bs-target="#siswa" type="button" role="tab" aria-controls="siswa" aria-selected="false">Siswa</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="guru-tab" data-bs-toggle="tab" data-bs-target="#guru" type="button" role="tab" aria-controls="guru" aria-selected="false">Guru</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                        <?= $this->include('users/tbl_admin'); ?>
                    </div>
                    <div class="tab-pane fade" id="siswa" role="tabpanel" aria-labelledby="siswa-tab">
                        <?= $this->include('users/tbl_siswa'); ?>
                    </div>
                    <div class="tab-pane fade" id="guru" role="tabpanel" aria-labelledby="guru-tab">
                        <?= $this->include('users/tbl_guru'); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->section('js'); ?>
<script>
    $('#datatable-siswa').DataTable()
    $('#datatable-guru').DataTable()

    function btn_tambah() {
        $('#exampleModal').modal('show');
        // $('#kelas').val('')
        // $('#id_kelas').val('')
        // $('#cek_status').text('')
    }
</script>
<?= $this->endSection(); ?>