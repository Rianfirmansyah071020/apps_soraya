<div class="row">
    <div class="col-lg-4">
        <?php
        $count_list_progress = count($list_progress);
        ?>
        <a href="<?= base_url("progress/exportMultiplePreview?count=$count_list_progress&") . http_build_query($list_progress) ?>" class="btn btn-success btn-filter waves-effect"><i class="material-icons mr-2">description</i>Export Multiple to Excel</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover myTable dataTable">
        <thead>
            <tr>
                <th>No DO</th>
                <th>Motif</th>
                <th>Tanggal</th>
                <th>Preoder</th>
                <!--<th>Preorder Detail</th>-->
                <!--<th>Estimasi</th>-->
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($content as $row) : ?>
                <?php if (checkRencana($row->id) > 0) : ?>
                    <tr style="<?= checkRealisasi($row->id) > 0 ? "background-color: #313131; color: #fff;" : "" ?>">
                        <td><?= $row->id; ?></td>
                        <td><?= $row->motif; ?></td>
                        <td><?= date_format(new DateTime($row->tanggal), "d/m/Y"); ?></td>
                        <td>
                            <?php
                            if ($row->is_preorder == 1) {
                                echo '<span class="label bg-green">Preorder</span>';
                            } else {
                                echo '';
                            }
                            ?>
                        </td>
                        
                        <!-- <td><?= date_format(new DateTime($row->tanggal), "H:i"); ?>&nbsp;WIB</td> -->
                        <td>
                            <div class="text-center">
                                <a href="<?= base_url("progress/add_realisasi/$row->id"); ?>" class="btn btn-info waves-effect">Tambah Realisasi</a>
                                <?php if (checkRealisasi($row->id) > 0) : ?>
                                    <a href="<?= base_url("progress/preview/$row->id"); ?>" class="btn btn-primary waves-effect">View</a>
                                    <a href="<?= base_url("progress/edit_realisasi/$row->id"); ?>" class="btn btn-warning waves-effect">Edit Realisasi</a>
                                    <a href="<?= base_url("progress/exportPreview/$row->id") ?>" class="btn btn-success waves-effect"><i class="material-icons mr-2">description</i>Export to Excel</a>
                                <?php endif ?>
                            </div>
                        </td>
                    </tr>
                <?php endif ?>
            <?php endforeach ?>
        </tbody>
    </table>
    <span style="margin-left: 20px;">Ket :</span>
    <div style="margin-left: 20px; margin-top: 15px; margin-bottom: 15px;">
        <span style="border: 3px solid #313131; width:10px; height:10px; background-color: #313131; color: #313131;">___</span>
        <span style="margin-left: 10px;">Rencana Sudah ditambahkan.</span>
    </div>
</div>