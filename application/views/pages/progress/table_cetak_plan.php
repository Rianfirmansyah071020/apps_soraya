<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=hasil.xlsx");
?>

<table class="table table-bordered" style="width: 50%;">
    <thead>
        <tr>
            <th rowspan="2" style="vertical-align: middle; width: 80px;">No</th>
            <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
            <th colspan="<?= $jumlahBantal; ?>" class="text-center">
                Jenis Bantal
            </th>
        </tr>
        <tr>
            <?php foreach ($jenis_bantal as $row) : ?>
                <th><?= $row->nama_jenis_bantal; ?></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        <?php foreach ($perencanaan as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row->nama_pekerjaan; ?></td>
                <?php foreach ($jenis_bantal as $row2) : ?>
                    <?php  ?>
                    <td>
                        <?php if ($row2->id == $row->id_jenis_bantal) {
                            echo $row->qty;
                        }
                        ?>
                    </td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td>
                <h4><b>Total :</b></h4>
            </td>
            <?php foreach ($jenis_bantal as $row) : ?>
                <td><?php echo array_sum(array_column($total['bt' . $row->id], 'qty')) != 0 ? array_sum(array_column($total['bt' . $row->id], 'qty')) : '-'  ?></td>
            <?php endforeach ?>
        </tr>
    </tfoot>
</table>
<table class="table table-bordered" style="width: 50%;">
    <thead>
        <tr>
            <th rowspan="2" style="vertical-align: middle; width: 80px;">No</th>
            <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
            <th colspan="<?= $jumlahBantal; ?>" class="text-center">
                REALISASI
            </th>
        </tr>
        <tr>
            <?php foreach ($jenis_bantal as $row) : ?>
                <th><?= $row->nama_jenis_bantal; ?></th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        <?php foreach ($perencanaan as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row->nama_pekerjaan; ?></td>
                <?php foreach ($jenis_bantal as $row) :  ?>
                    <td></td>
                <?php endforeach ?>
            </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td>
                <h4><b>Total :</b></h4>
            </td>
            <?php foreach ($jenis_bantal as $row) :  ?>
                <td></td>
            <?php endforeach ?>
        </tr>
    </tfoot>
</table>