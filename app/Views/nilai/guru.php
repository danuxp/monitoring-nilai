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
                                <th>Kelas</th>
                                <th>Jam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            // var_dump($id_guru);
                            foreach ($data as $value) {
                                $jamke = $value['jam_ke'] ? 'Jam ke ' . $value['jam_ke'] . ' : ' . get_jamke($value['jam_ke']) : '';
                                $mapel_id = $value['mapel_id'];
                                $nama_mapel = $value['nama_mapel'];
                                $kelas_id = $value['kelas_id'];
                                $nama_kelas = $value['nama_kelas'];
                                $tahun_id = $value['tahun_ajaran_id'];
                                $param = [
                                    "mapel_id" => $mapel_id,
                                    "nama_mapel" => $nama_mapel,
                                    "kelas_id" => $kelas_id,
                                    "nama_kelas" => $nama_kelas,
                                    "tahun_id" => $tahun_id,
                                    "id_guru" => $id_guru
                                ];
                                // $p = base64_encode(json_encode($param));
                                $p = enkripsi(json_encode($param));

                                $check = $mnilai->get_check_data($kelas_id, $nama_kelas, $mapel_id, $id_guru);
                                // var_dump(enkripsi(json_encode($param)));
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $value['nama_mapel']; ?></td>
                                    <td><?= $value['nama_kelas']; ?></td>
                                    <td><?= $jamke; ?></td>
                                    <td>
                                        <a href="<?= base_url('nilai/form/' . $p); ?>" class="btn btn-sm btn-primary"><i class="typcn typcn-pencil"></i></a>
                                        <?php
                                        if ($check['aksi'] == 0) {
                                            echo '';
                                        } else {
                                            echo '<a href="' . base_url('nilai/export_excell/' . $p) . '" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i></a>';
                                        }
                                        ?>
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