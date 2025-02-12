<div class="row">
    <div class="col-md-12">
        <div class="card mt-3 ">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>
                <p class="card-description"><?= $param['nama_mapel'] . ' / ' . 'Kelas ' . $param['nama_kelas']; ?></p>

                <form action="<?= base_url('nilai/save'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" value="<?= $param['mapel_id']; ?>" name="mapel_id">
                    <input type="hidden" value="<?= $param['kelas_id']; ?>" name="kelas_id">
                    <input type="hidden" value="<?= $param['tahun_id']; ?>" name="tahun_id">
                    <input type="hidden" value="<?= $param['nama_kelas']; ?>" name="kelas">
                    <input type="hidden" value="<?= $param['id_guru']; ?>" name="id_guru">
                    <input type="hidden" value="<?= $aksi; ?>" name="aksi">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Nilai Tugas</th>
                                    <th>Nilai UTS</th>
                                    <th>Nilai UAS</th>
                                    <th>Nilai Akhir</th>
                                    <th>Nilai Abjad</th>
                                    <th>Predikat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data as $value) {
                                    $siswa = $value['nis'] . '<br><strong>' . $value['nama'] . '</strong>';
                                    $id_siswa = isset($value['siswa_id']) ? $value['siswa_id'] : $value['id'];
                                    $tugas = isset($value['tugas']) ? $value['tugas'] : '';
                                    $uts = isset($value['uts']) ? $value['uts'] : '';
                                    $uas = isset($value['uas']) ? $value['uas'] : '';
                                    $nilai_akhir = ($tugas && $uts && $uas) != '' ? nilai_akhir($tugas, $uts, $uas) : '';
                                    $nilai_abjad = $nilai_akhir != '' ? range_nilai($nilai_akhir) : '';
                                    $predikat = $nilai_akhir != '' ? predikat_nilai($nilai_akhir)['predikat_bagde'] : '';
                                    // $id_nilai = isset($value[''])
                                ?>
                                    <tr>
                                        <td>
                                            <?= $no++ ?>
                                            <input type="hidden" value="<?= $value['id']; ?>" name="id[<?= $id_siswa ?>]">
                                        </td>
                                        <td><?= $siswa; ?></td>
                                        <td>
                                            <input type="number" min="1" max="100" class="form-control" name="tugas[<?= $id_siswa ?>]" value="<?= $tugas; ?>">
                                        </td>
                                        <td>
                                            <input type="number" min="1" max="100" class="form-control" name="uts[<?= $id_siswa ?>]" value="<?= $uts; ?>">
                                        </td>
                                        <td>
                                            <input type="number" min="1" max="100" class="form-control" name="uas[<?= $id_siswa ?>]" value="<?= $uas; ?>">
                                        </td>
                                        <td><?= $nilai_akhir; ?></td>
                                        <td><?= $nilai_abjad; ?></td>
                                        <td><?= $predikat; ?></td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                        <a href="<?= base_url('nilai'); ?>" class="btn btn-secondary mt-3">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>