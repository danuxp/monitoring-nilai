<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?= $title; ?></h4>
                <div class="row">
                    <?php
                    foreach ($data as $key => $row) {
                    ?>
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item active" aria-current="true"><?= $key; ?></li>
                                <?php
                                $no = 1;
                                foreach ($row as $item) {
                                    $jamke = $item['jam_ke'] ? 'Jam ke ' . $item['jam_ke'] . ' : ' . get_jamke($item['jam_ke']) : '';
                                    $mapel = $no . '. ' . $item['nama_mapel'] . ' / ' . $item['nama_kelas'] . ' (' . $jamke . ')';
                                    echo "<li class='list-group-item'>{$mapel}</li>";
                                    $no++;
                                }
                                ?>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>