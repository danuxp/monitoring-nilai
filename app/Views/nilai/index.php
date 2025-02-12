<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>
                <div class="w-50 mx-auto">
                    <div class="form-group">
                        <label for="guru">Pilih Guru</label>
                        <select class="form-control js-example-basic-single" name="guru" id="guru" required>
                            <option value="" readonly selected>Pilih Guru</option>
                            <?php
                            foreach ($guru as $row) {
                                echo "<option value='{$row['id']}'>{$row['nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="data"></div>
<?= $this->section('js'); ?>
<script>
    $('#guru').on('change', function(e) {
        e.preventDefault()
        let id_guru = $(this).val()
        $.ajax({
            method: "POST",
            url: "<?= base_url('nilai/get_data') ?>",
            data: {
                id_guru
            },
            success: function(res) {
                $('#data').html(res)
                // console.log(res, id_guru)
            }
        })

    })
</script>
<?= $this->endSection(); ?>