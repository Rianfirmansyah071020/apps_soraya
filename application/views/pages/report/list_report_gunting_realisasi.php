<?php
$convFrom = explode("/", $fromDate);
$convTo   = explode("/", $toDate);

$FromDate = $convFrom[2] . "-" . $convFrom[0] . "-" . $convFrom[1];
$ToDate = $convTo[2] . "-" . $convTo[0] . "-" . $convTo[1];
?>
<div class="text-center">
    <h3>Laporan Gunting & Realisasi Pekerjaan Mitra</h3>
    <h5>Dari <?= date_format(new DateTime($FromDate . "00:00:00"), "d M Y"); ?> s/d <?= date_format(new DateTime($ToDate . "00:00:00"), "d M Y"); ?></h5>
</div>
<div class="table-responsive" style="margin-top: 30px;">
    <input type="hidden" value="<?= $FromDate; ?>" id="fromDateLaporanDistStore">
    <input type="hidden" value="<?= $ToDate; ?>" id="toDateLaporanDistStore">
    <table class="table table-bordered table-striped table-hover myDatTab">
        <thead>
            <tr>
                <th>No DO</th>
                <th>Motif</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($content as $row) : ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->motif; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>