<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>
                <p class="text-primary">Form ini untuk menambahkan data siswa serta user login password sesuai nis</p>


                <form action="<?= base_url($url_to); ?>" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_user" value="<?= empty($data['id_user']) ? '' : $data['id_user']; ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nis">Nis</label>
                                <input type="text" class="form-control <?= validation_show_error('nis') ? 'is-invalid' : ''; ?>" id="nis" placeholder="NIS (Nomor Induk SIswa)" name="nis" value="<?= empty($data['nis']) ? old('nis') : $data['nis']; ?>">
                                <small class="text-danger">
                                    <?= validation_show_error('nis'); ?>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : ''; ?>" id="nama" placeholder="Nama Lengkap" name="nama" value="<?= empty($data['nama']) ? old('nama') : $data['nama']; ?>">
                                <small class="text-danger">
                                    <?= validation_show_error('nama'); ?>
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" class="form-control <?= validation_show_error('jk') ? 'is-invalid' : ''; ?>" id="jk">
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="L" <?= !empty($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'L' ? 'selected' : old('jk'); ?>>Laki-Laki</option>
                                    <option value="P" <?= !empty($data['jenis_kelamin']) && $data['jenis_kelamin'] == 'P' ? 'selected' : old('jk'); ?>>Perempuan</option>
                                </select>
                                <small class="text-danger">
                                    <?= validation_show_error('jk'); ?>
                                </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jk">Agama</label>
                                <select name="agama" class="form-control <?= validation_show_error('agama') ? 'is-invalid' : ''; ?>" id="agama">
                                    <option value="" disabled selected>Pilih</option>
                                    <?php
                                    foreach ($agama as $row) {
                                        $selected = !empty($data['agama']) && $data['agama'] == $row ? 'selected' : old('agama');
                                        echo '<option value="' . $row . '" ' . $selected . '>' . $row . '</option>';
                                    }
                                    ?>
                                </select>
                                <small class="text-danger">
                                    <?= validation_show_error('jk'); ?>
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tempat">Tempat</label>
                                <input type="text" class="form-control <?= validation_show_error('tempat') ? 'is-invalid' : ''; ?>" id="tempat" placeholder="Tempat Lahir" name="tempat" value="<?= empty($data['tempat']) ? old('tempat') : $data['tempat']; ?>">
                                <small class="text-danger">
                                    <?= validation_show_error('tempat'); ?>
                                </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nis">Tanggal Lahir</label>
                                <input type="date" class="form-control <?= validation_show_error('tgl_lahir') ? 'is-invalid' : ''; ?>" id="nis" placeholder="NIS (Nomor Induk SIswa)" name="tgl_lahir" value="<?= empty($data['tgl_lahir']) ? old('tgl_lahir') : $data['tgl_lahir']; ?>">
                                <small class="text-danger">
                                    <?= validation_show_error('tgl_lahir'); ?>
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ayah">Nama Ayah</label>
                                <input type="text" class="form-control <?= validation_show_error('ayah') ? 'is-invalid' : ''; ?>" id="ayah" placeholder="Nama Ayah" name="ayah" value="<?= empty($data['nama_ayah']) ? old('ayah') : $data['nama_ayah']; ?>">
                                <small class="text-danger">
                                    <?= validation_show_error('ayah'); ?>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ibu">Nama Ibu</label>
                                <input type="text" class="form-control <?= validation_show_error('ibu') ? 'is-invalid' : ''; ?>" id="ibu" placeholder="Nama Ibu" name="ibu" value="<?= empty($data['nama_ibu']) ? old('ibu') : $data['nama_ibu']; ?>">
                                <small class="text-danger">
                                    <?= validation_show_error('ibu'); ?>
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control <?= validation_show_error('alamat') ? 'is-invalid' : ''; ?>" id="alamat" placeholder="Alamat Lengkap" name="alamat" value="<?= empty($data['alamat']) ? old('alamat') : $data['alamat']; ?>">
                                <small class="text-danger">
                                    <?= validation_show_error('alamat'); ?>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_hp">No Hp</label>
                                <input type="text" class="form-control <?= validation_show_error('no_hp') ? 'is-invalid' : ''; ?>" id="no_hp" placeholder="No Hp" name="no_hp" value="<?= empty($data['no_hp']) ? old('no_hp') : $data['no_hp']; ?>">
                                <small class="text-danger">
                                    <?= validation_show_error('no_hp'); ?>
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control <?= validation_show_error('email') ? 'is-invalid' : ''; ?>" id="email" placeholder="Email" name="email" value="<?= empty($data['email']) ? old('email') : $data['email']; ?>">
                                <small class="text-danger">
                                    <?= validation_show_error('email'); ?>
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Kelas</label>
                                <select class="js-example-basic-single w-100 form-control" name="kelas">
                                    <option value="" selected disabled>Pilih</option>
                                    <?php
                                    foreach ($kelas as $row) {
                                        $nama_kls = $row['nama_kelas'];
                                        $selected = !empty($data['kelas']) && $data['kelas'] == $nama_kls ? 'selected' : '';
                                        echo '<option value="' . $nama_kls . '" ' . $selected . '>' . $nama_kls . '</option>';
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?= base_url('siswa'); ?>" class="btn btn-secondary">Batal</a>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->section('js'); ?>
<script>

</script>
<?= $this->endSection(); ?>