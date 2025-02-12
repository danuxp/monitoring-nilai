<div class="table-responsive">
    <table id="datatable-siswa" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($siswa as $row) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama_siswa']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="btn_edit(this)" id="<?= $row['id']; ?>" data-email="<?= $row['email']; ?>"><i class="typcn typcn-pencil"></i></button>

                        <!-- <button class="btn btn-info btn-sm" onclick="btn_edit(this)" id="<?= $row['id']; ?>" data-email="<?= $row['email']; ?>"><i class="typcn typcn-lock-open-outline"></i></button> -->

                        <button class="btn btn-danger btn-sm" onclick="btn_hapus(this)" id="<?= $row['id']; ?>" data-email="<?= $row['email']; ?>"><i class="typcn typcn-trash"></i></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>