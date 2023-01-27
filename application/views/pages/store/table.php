<?php
?>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover myTable dataTable">
        <thead>
            <tr>
                <th>No DO</th>
                <th>Motif</th>
                <th>Tanggal</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($content as $row) : ?>
            <?php if (checkDistribusi($row->id) > 0) : ?>
            <tr
                style="<?= checkDistribusi($row->id) == checkStatusSelesaiDistribusi($row->id) && checkDistribusi($row->id) != 0 ? "background-color: #313131; color: #fff;" : "" ?>">
                <td><?= $row->id; ?></td>
                <td><?= $row->motif; ?></td>
                <td><?= date_format(new DateTime($row->tanggal), "d/m/Y"); ?></td>
                <!-- <td><?= date_format(new DateTime($row->tanggal), "H:i"); ?>&nbsp;WIB</td> -->
                <td>
                    <div class="text-center">
                        <?php if (checkDistribusi($row->id) > 0) : ?>
                        <a href="#" class="btn btn-success waves-effect view_store" data-id="<?= $row->id; ?>">View</a>
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
        <span
            style="border: 3px solid #313131; width:10px; height:10px; background-color: #313131; color: #313131;">___</span>
        <span style="margin-left: 10px;">Progress Yang Telah Selesai.</span>
    </div>
</div>