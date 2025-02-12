<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title . ' Tahun Ajaran ' . $tahun['tahun_id']; ?></h4>

                <form action="<?= base_url('jadwal/save'); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="text" name="id" value="<?= empty($data['id']) ? '' : $data['id']; ?>">

                    <div class="row w-100">
                        <div class="col-md-6 mx-auto">
                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran </label>
                                <select class="form-control js-example-basic-single" name="mapel" id="mapel" required>
                                    <option value="" disabled selected>Pilih Mata Pelajaran</option>
                                    <?php
                                    foreach ($mapel as $key => $value) {
                                        $selected = !empty($data['mapel_id']) && $data['mapel_id'] == $value['id'] ? 'selected' : '';
                                        echo "<option value='$value[id]' $selected>$value[nama_mapel]</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kelas">Kelas </label>
                                <select class="form-control js-example-basic-single" name="kelas" id="kelas" required>
                                    <option value="" disabled selected>Pilih Kelas</option>
                                    <?php
                                    foreach ($kelas as $key => $value) {
                                        $selected = !empty($data['kelas_id']) && $data['kelas_id'] == $value['id'] ? 'selected' : '';

                                        echo "<option value='$value[id]' $selected>$value[nama_kelas]</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="guru">Guru </label>
                                <select class="form-control js-example-basic-single" name="guru" id="guru" required>
                                    <option value="" disabled selected>Pilih Guru</option>
                                    <?php
                                    foreach ($guru as $key => $value) {
                                        $selected = !empty($data['guru_id']) && $data['guru_id'] == $value['id'] ? 'selected' : '';

                                        echo "<option value='$value[id]' $selected>$value[nama]</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="guru">Hari </label>
                                <select class="form-control" name="hari" id="hari" required>
                                    <option value="" disabled selected>Pilih Hari</option>
                                    <?php
                                    foreach ($hari as $value) {
                                        $selected = !empty($data['hari']) && $data['hari'] == $value ? 'selected' : '';
                                        echo "<option value='$value' $selected>$value</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="guru">Jam Ke </label>
                                <select class="form-control" name="jamke" id="jamke" required>
                                    <option value="" disabled selected>Jam ke</option>
                                    <?php
                                    foreach ($jam_ke as $value) {

                                        $istirahat = isset($value['istirahat']) ? "Istirahat" : "Salat & Istirahat";
                                        $val_jam = isset($value['jam']) ? 'Jam Ke : ' . $value['jam'] : $istirahat;
                                        $val_opt = $val_jam . ' (' . $value['waktu'] . ')';
                                        $disabled = isset($value['jam']) ? '' : 'disabled';
                                        $valjam = isset($value['jam']) ? $value['jam'] : '';

                                        $selected = isset($data['jam_ke']) && $data['jam_ke'] == $valjam ? 'selected' : '';

                                        echo "<option value='$valjam' $disabled $selected>$val_opt</option>";
                                        // $selected = !empty($data['guru_id']) && $data['guru_id'] == $value['id'] ? 'selected' : '';
                                    }
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary"><?= empty($data['id']) ? 'Simpan' : 'Update'; ?></button>
                            <a href="<?= base_url('jadwal'); ?>" class="btn btn-secondary">Batal</a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>