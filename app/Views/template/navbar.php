<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <!-- <a class="navbar-brand brand-logo" href="../../index.html"><img src="../../../assets/images/logo.svg" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../../assets/images/logo-mini.svg" alt="logo" /></a> -->
            <img class="navbar-brand brand-logo" src="<?= base_url() . '/img' . '/' . get_setting()['img']; ?>" alt="" width="60">
            <h5 class="text-white" id="logo-text"><?= get_setting()['nama']; ?></h5>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="typcn typcn-th-menu"></span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav me-lg-2">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <!-- <img src="../../../assets/images/faces/face5.jpg" alt="profile" /> -->
                    <span class="nav-profile-name">Assalamualaikum, <?= session('nama'); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item">
                        <i class="typcn typcn-cog-outline text-primary"></i>
                        Settings
                    </a>
                    <a class="dropdown-item">
                        <i class="typcn typcn-eject text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
            <!-- <li class="nav-item nav-user-status dropdown">
                <p class="mb-0">Last login was 23 hours ago.</p>
            </li> -->
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-date dropdown">
                <a class="nav-link d-flex justify-content-center align-items-center" href="javascript:;">
                    <h6 class="date mb-0"><?= tanggal_indo(date('Y-m-d')); ?></h6>
                    <i class="typcn typcn-calendar"></i>
                </a>
            </li>

            <li class="nav-item dropdown me-0">
                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                    <i class="typcn typcn-cog-outline mx-0"></i>
                    <!-- <span class="count"></span> -->
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <p class="mb-0 fw-normal float-start dropdown-header">Info</p>

                    <a href="<?= base_url('setting'); ?>" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-warning">
                                <i class="typcn typcn-cog-outline mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject fw-normal">Settings</h6>

                        </div>
                    </a>
                    <a href="<?= base_url('login/logout'); ?>" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-info">
                                <i class="typcn typcn-power mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject fw-normal">Logout</h6>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>