<?= $this->include('template/head'); ?>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <?= $this->include('template/navbar'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <?php
            if (session('role') == 1) {
                echo $this->include('template/sidebar');
            } else if (session('role') == 2) {
                echo $this->include('template/sidebar_guru');
            } else {
                echo $this->include('template/sidebar_siswa');
            }
            ?>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?= $pagecontent; ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <?= $this->include('template/footer'); ?>

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <?= $this->include('template/scriptjs'); ?>

    <!-- Custom js for this page-->
    <?= $this->renderSection('js'); ?>

    <!-- End custom js for this page-->
</body>

</html>