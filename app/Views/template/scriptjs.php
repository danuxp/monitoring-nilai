<script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
<script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
<script src="<?= base_url() ?>assets/js/template.js"></script>
<script src="<?= base_url() ?>assets/js/settings.js"></script>
<script src="<?= base_url() ?>assets/js/todolist.js"></script>

<script src="<?= base_url() ?>assets/vendors/select2/select2.min.js"></script>

<script src="<?= base_url() ?>assets/vendors/sweetalert2/sweetalert2.min.js"></script>

<script src="<?= base_url() ?>assets/vendors/datatables/dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables/dataTables.bootstrap5.js"></script>

<?php
if (session()->getFlashdata('text')) { ?>
    <script>
        Swal.fire({
            title: "<?= session()->getFlashdata('title') ?>",
            text: "<?= session()->getFlashdata('text') ?>",
            icon: "<?= session()->getFlashdata('icon') ?>"
        });
    </script>
<?php }; ?>

<script>
    $('#datatable').DataTable()
    $('.js-example-basic-single').select2()
</script>
<!-- endinject -->