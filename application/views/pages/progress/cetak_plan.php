<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kartu Order Bal <?= $id_progress; ?> </title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .line-title {
            border: 0;
            border-style: inset;
            border-top: 1px solid #000;
        }

        #tfoot {
            border: none !important;
        }

        h4 {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <img src="<?= base_url(); ?>assets/img/logo_soraya2.png" style="position: absolute; width: 120px; height: auto; margin-left: 20px;">
    <table style="width: 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 1.6; font-weight: bold;">
                    PT. SORAYA BERJAYA INDONESIA
                    <br>PABRIK SORAYA BEDSHEET <br>
                    <span style="font-weight: 400">Jalan Palangkaraya No.7, Nanggalo, Kota Padang </span>
                </span>
            </td>
        </tr>
    </table>
    <hr class="line-title">
    <div class="float-right">
        <h1 style="font-size: 60px; font-family: Arial, Helvetica, sans-serif;"><span style="font-size: 13px; font-family: Arial, Helvetica, sans-serif;"">No DO: </span>&nbsp;<?= $id_progress; ?></h1>
        <?php if (isset($penggunting->nama)) :  ?>
            <p>Penggunting : <strong><?= $penggunting->nama; ?></strong></p>
        <?php endif ?>
    </div>
    <div class=" text-center" style="margin-top: 90px;">
                <table style="width: 100%;">
                    <tr>
                        <td align="center">
                            <span style="line-height: 1.6; font-weight: 300; font-size: 26px;">
                                KARTU ORDER KAIN BAL
                            </span>
                        </td>
                    </tr>
                </table>
                <table style="width: 100%; margin-bottom: 5px; margin-top: 30px;">
                    <tr>
                        <td>Tanggal Pembuatan Progress : <?= date_format(new DateTime($tanggal_progress->tanggal), "D, d M Y"); ?></td>
                        <td>Motif Kain : <?= $tanggal_progress->motif; ?></td>
                        <td>Ditambahkan oleh : <?= $nama_admin->nama_admin == '' ? '-' : $nama_admin->nama_admin ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Rencana Progress : <?= date_format(new DateTime($tanggal_progress->tanggal_rencana), "D, d M Y"); ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex">
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
        </div>
    </div>
</body>
<script type="text/javascript">
    window.onload = function() {
        window.print();
    }
</script>

</html>