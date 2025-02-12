<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
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
                                $tugas = $value['tugas'] == null ? '' : $value['tugas'];
                                $uts = $value['uts'] == null ? '' : $value['uts'];
                                $uas = $value['uas'] == null ? '' : $value['uas'];

                                $nilai_akhir = ($tugas && $uts && $uas) != '' ? nilai_akhir($tugas, $uts, $uas) : '';
                                $nilai_abjad = $nilai_akhir != '' ? range_nilai($nilai_akhir) : '';
                                $predikat = $nilai_akhir != '' ? predikat_nilai($nilai_akhir)['predikat_bagde'] : '';
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['nama_mapel']; ?></td>
                                    <td class="text-center"><?= $tugas; ?></td>
                                    <td class="text-center"><?= $uts; ?></td>
                                    <td class="text-center"><?= $uas; ?></td>
                                    <td class="text-center"><?= $nilai_akhir; ?></td>
                                    <td><?= $nilai_abjad; ?></td>
                                    <td><?= $predikat; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>