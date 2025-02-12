<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>

                <form action="<?= base_url('setting/save_setting_siswa'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" name="id_siswa" value="<?= $data['id']; ?>">
                    <input type="hidden" class="form-control" name="id_user" value="<?= $data['id_user']; ?>">
                    <div class="form-group">
                        <label for="nis">Nis</label>
                        <input type="text" class="form-control" id="nis" name="nis" value="<?= empty($data['nis']) ? '' : $data['nis']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= empty($data['nama']) ? '' : $data['nama']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" class="form-control" id="jk">
                            <option value="" disabled selected>Pilih</option>
                            <option value="L" <?= !empty($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="P" <?= !empty($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jk">Agama</label>
                        <select name="agama" class="form-control" id="agama">
                            <option value="" disabled selected>Pilih</option>
                            <?php
                            foreach ($agama as $row) {
                                $selected = !empty($data['agama']) && $data['agama'] == $row ? 'selected' : '';
                                echo '<option value="' . $row . '" ' . $selected . '>' . $row . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <input type="text" class="form-control" id="tempat" name="tempat" value="<?= empty($data['tempat']) ? '' : $data['tempat']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= !empty($data['tgl_lahir']) ?  $data['tgl_lahir'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= !empty($data['alamat']) ? $data['alamat'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No Hp</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= !empty($data['no_hp']) ? $data['no_hp'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="ayah">Nama Ayah</label>
                        <input type="text" class="form-control" id="ayah" name="ayah" value="<?= empty($data['nama_ayah']) ? old('ayah') : $data['nama_ayah']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="ibu">Nama Ibu</label>
                        <input type="text" class="form-control" id="ibu" name="ibu" value="<?= empty($data['nama_ibu']) ? old('ibu') : $data['nama_ibu']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= !empty($data['email']) ? $data['email'] : ''; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Reset Password</h4>
                <form action="<?= base_url('setting/reset_password'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" name="id_user" value="<?= $data['id_user']; ?>">

                    <div class="form-group">
                        <label for="password_old">Password Saat Ini</label>
                        <input type="password" class="form-control" id="password_old" name="password_old">
                    </div>

                    <div class="form-group">
                        <label for="password_new">Password Baru</label>
                        <input type="password" class="form-control <?= validation_show_error('password_new') ? 'is-invalid' : ''; ?>" id="password_new" name="password_new">
                        <small class="text-danger">
                            <?= validation_show_error('password_new'); ?>
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>