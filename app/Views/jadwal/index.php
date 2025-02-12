<div class="row">
    <div class="col-md-12">
        <a href="<?= base_url('jadwal/form'); ?>" class="btn btn-primary"><i class="typcn typcn-plus"></i> Tambah</a>
        <div class="card mt-3 ">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Guru</th>
                                <th>Mata Pelajaran</th>
                                <th>Kelas</th>
                                <th>Hari</th>
                                <th>Jam Ke</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $key => $row) {
                                $jamke = $row['jam_ke'] ? $row['jam_ke'] . ' : ' . get_jamke($row['jam_ke']) : '';

                            ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['nama_mapel']; ?></td>
                                    <td><?= $row['nama_kelas']; ?></td>
                                    <td><?= $row['hari']; ?></td>
                                    <td><?= $jamke; ?></td>
                                    <td>
                                        <a href="<?= base_url('jadwal/form/' . $row['id']); ?>" class="btn btn-primary btn-sm"><i class="typcn typcn-pencil"></i></a>

                                        <button onclick="btn_hapus(this)" id="<?= $row['id']; ?>" data-nama="<?= $row['nama']; ?>" data-mapel="<?= $row['nama_mapel']; ?>" data-kelas="<?= $row['nama_kelas']; ?>" class="btn btn-danger btn-sm"><i class="typcn typcn-trash"></i></button>
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
    function btn_hapus(event) {
        let nama = $(event).data('nama')
        let mapel = $(event).data('mapel')
        let kelas = $(event).data('kelas')
        let id = $(event).attr('id')

        Swal.fire({
            title: 'Apakah anda yakin?',
            html: `Ingin menghapus data jadwal <strong>${nama + '<br>' + mapel + '<br>' + kelas}</strong>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                        url: "<?= base_url('jadwal/hapus'); ?>",
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