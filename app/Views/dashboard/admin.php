<div class="row">
    <div class="col-md-12">
        <h4 class="card-title fw-bold">Selamat Datang, <?= session('nama'); ?></h4>
        <br>
        <div class="row mb-3">
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p class="text-muted">Data Siswa</p>
                        <div class="d-flex justify-content-between align-items-center mb-2 text-primary">
                            <h3 class="mb-">Jumlah Siwa</h3>
                            <h3 class="mb-"><?= $jumlah_siswa; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p class="text-muted">Data Guru</p>
                        <div class="d-flex justify-content-between align-items-center mb-2 text-success">
                            <h3 class=" mb-">Jumlah Guru</h3>
                            <h3 class="mb-"><?= $jumlah_guru; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between text-info">
                        <p class="text-muted">Data Jadwal</p>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3 class="mb-">Jumlah Jadwal</h3>
                            <h3 class="mb-"><?= $jumlah_jadwal; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="table-responsive pt-3">
                        <h4 class="card-title ps-3">Data Siswa</h4>
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nis</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_siswa as $row) {
                                ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nis']; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['jenis_kelamin']; ?></td>
                                        <td><?= $row['kelas']; ?></td>
                                    </tr>

                                <?php } ?>
                                <tr>
                                    <td colspan="5">
                                        <a href="<?= base_url('siswa'); ?>">Lihat selengkapnya..</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="table-responsive pt-3">
                        <h4 class="card-title ps-3">Data Guru</h4>
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No Hp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_guru as $row) {
                                ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama']; ?></td>
                                        <td><?= $row['jenis_kelamin']; ?></td>
                                        <td><?= $row['no_hp']; ?></td>
                                    </tr>

                                <?php } ?>
                                <tr>
                                    <td colspan="4">
                                        <a href="<?= base_url('guru'); ?>">Lihat selengkapnya..</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive pt-3">
                        <h4 class="card-title ps-3">Data Jadwal</h4>
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Hari</th>
                                    <th>Jam Ke</th>
                                    <th>Guru</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_jadwal as $row) {
                                    $jamke = $row['jam_ke'] ? 'Jam ke ' . $row['jam_ke'] . ' : ' . get_jamke($row['jam_ke']) : '';

                                ?>

                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_mapel']; ?></td>
                                        <td><?= $row['nama_kelas']; ?></td>
                                        <td><?= $row['hari']; ?></td>
                                        <td><?= $jamke; ?></td>
                                        <td><?= $row['nama']; ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="4">
                                        <a href="<?= base_url('jadwal'); ?>">Lihat selengkapnya..</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->section('js'); ?>
<script>
    // $('#example').DataTable()
</script>

<?= $this->endSection(); ?>