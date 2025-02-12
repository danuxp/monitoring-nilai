<?= $this->include('template/head'); ?>

<body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light  py-5 px-4 px-sm-5">
                            <div class="text-center">

                                <div class="brand-logo">
                                    <img src="<?= base_url() . '/img' . '/' . get_setting()['img']; ?>" alt="logo">
                                </div>
                                <h4><?= get_setting()['nama']; ?></h4>
                                <p><?= get_setting()['slogan']; ?></p>
                                <h6 class="fw-light mt-4">Silahkan login.</h6>
                            </div>

                            <br>

                            <?php
                            if (session('pesan')) {
                            ?>

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Peringatan!</strong> <?= session('pesan'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>

                            <?php } ?>

                            <form method="post" action="<?= base_url('login/validasi'); ?>">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg <?= validation_show_error('username') ? 'is-invalid' : ''; ?>" placeholder="Email / Username / NIS" name="username" value="<?= old('username'); ?>">
                                    <small class="text-danger">
                                        <?= validation_show_error('username'); ?>
                                    </small>
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg <?= validation_show_error('password') ? 'is-invalid' : ''; ?>" id="exampleInputPassword1" placeholder="Password" name="password">
                                    <small class="text-danger">
                                        <?= validation_show_error('password'); ?>
                                    </small>
                                </div>

                                <div class="mt-3 d-grid gap-2">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">SIGN IN</button>
                                </div>

                                <!-- <div class="text-center mt-4 fw-light">
                                    Don't have an account? <a href="register.html" class="text-primary">Create</a>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>

    </div>

    <?= $this->include('template/scriptjs'); ?>

</body>

</html>