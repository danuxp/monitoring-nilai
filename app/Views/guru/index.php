<div class="row">
    <div class="col-md-12">

        <a href="<?= base_url('guru/form'); ?>" class="btn btn-primary"><i class="typcn typcn-plus"></i> Tambah</a>
        <div class="card mt-3 ">
            <div class="card-body">
                <h4 class="card-title">Data Guru</h4>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nis</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>No Hp</th>
                                <th>Agama</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $row) {
                                $status = $row['status'] == 'A' ? '<span class="badge badge-success badge-pill">Aktif</span>' : '<span class="badge badge-danger badge-pill">Tidak Aktif</span>';
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['jenis_kelamin']; ?></td>
                                    <td><?= $row['tempat'] . ', ' . $row['tgl_lahir']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td><?= $row['no_hp']; ?></td>
                                    <td><?= $row['agama']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $status; ?></td>
                                    <td>
                                        <a href="<?= base_url('guru/form/' . $row['id']); ?>" class="btn btn-primary btn-sm"><i class="typcn typcn-pencil"></i></a>

                                        <button class="btn btn-danger btn-sm" onclick="btn_hapus(this)" id="<?= $row['id']; ?>" data-nama="<?= $row['nama']; ?>"><i class="typcn typcn-trash"></i></button>
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
    function btn_hapus(event) {
        let nama = $(event).data('nama')
        let id = $(event).attr('id')
        console.log(id);


        Swal.fire({
            title: 'Apakah anda yakin?',
            html: `Ingin menghapus data <strong>${nama}</strong>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                        url: "<?= base_url('guru/hapus'); ?>",
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