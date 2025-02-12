<div class="row">
    <div class="col-md-12">
        <h4 class="card-title fw-bold">Selamat Datang, <?= session('nama'); ?></h4>
        <br>
        <div class="row mb-3">
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p class="text-muted">Data Jadwal</p>
                        <div class="d-flex justify-content-between align-items-center mb-2 text-primary">
                            <h3 class="mb-">Jumlah Jadwal</h3>
                            <h3 class="mb-"><?= $jumlah_jadwal; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <p class="text-muted">Data Nilai</p>
                        <div class="d-flex justify-content-between align-items-center mb-2 text-success">
                            <h3 class=" mb-">Mapel Sudah Nilai</h3>
                            <h3 class="mb-"><?= $sudah_nilai; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between text-danger">
                        <p class="text-muted">Data Nilai</p>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3 class="mb-">Mapel Belum Nilai</h3>
                            <h3 class="mb-"><?= $belum_nilai; ?></h3>
                        </div>
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
                                    <th>Mapel</th>
                                    <th>Kelas</th>
                                    <th>Jam Ke</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($jadwal as $row) {
                                    $jamke = $row['jam_ke'] ? 'Jam ke ' . $row['jam_ke'] . ' : ' . get_jamke($row['jam_ke']) : '';

                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nama_mapel']; ?></td>
                                        <td><?= $row['nama_kelas']; ?></td>
                                        <td><?= $jamke; ?></td>
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