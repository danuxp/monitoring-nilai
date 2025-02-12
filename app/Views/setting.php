<div class="row">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>


                <form action="<?= base_url('setting/save'); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" class="form-control" value="<?= empty($data['id']) ? '' : $data['id']; ?>" name="id">
                    <div class="form-group">
                        <label for="sekolah">Nama Sekolah</label>
                        <input type="text" class="form-control <?= validation_show_error('nama') ? 'is-invalid' : ''; ?>" id="sekolah" placeholder="Nama Sekolah" name="nama" value="<?= empty($data['nama']) ? '' : $data['nama']; ?>">
                        <small class="text-danger">
                            <?= validation_show_error('nama'); ?>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="slogan">Slogan</label>
                        <input type="text" class="form-control <?= validation_show_error('slogan') ? 'is-invalid' : ''; ?>" id="slogan" placeholder="Slogan Sekolah" name="slogan" value="<?= empty($data['slogan']) ? '' : $data['slogan']; ?>">
                        <small class="text-danger">
                            <?= validation_show_error('slogan'); ?>
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control <?= validation_show_error('logo') ? 'is-invalid' : ''; ?>" id="logo" name="logo">
                        <small class="text-danger">
                            <?= validation_show_error('logo'); ?>
                        </small>
                        <div class="img mt-3">
                            <?php
                            if (!empty($data['logo'])) {
                                echo '<img src="' . base_url() . 'img/' . $data['logo'] . '" width="300">';
                            }
                            ?>
                        </div>
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
                    <input type="hidden" class="form-control" name="id_user" value="<?= $user['id']; ?>">

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