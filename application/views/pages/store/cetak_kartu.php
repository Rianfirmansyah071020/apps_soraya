<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laporan</title>
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

        @page {
            size: landscape;
        }
    </style>
</head>

<body>
    <img src="<?= base_url(); ?>/assets/img/logo_soraya2.png" style="position: absolute; width: 120px; height: auto; margin-left: 20px;">
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
    </div>
    <p class=" text-center" style="margin-top: 90px;">
                <span style="font-size: 24px;">KARTU ORDER KAIN BAL</span>
                <br />
                <table style="width: 100%; margin-bottom: 5px;">
                    <tr>
                        <td>Hari / Tgl : <?= date_format(new DateTime($tanggal_progress->tanggal), "D, d M Y"); ?></td>
                        <td>Motif Kain : <?= $tanggal_progress->motif; ?></td>
                    </tr>
                </table>
                </p>
                <div class="row">
                    <div class="col-md-12 d-flex">
                        <table class="table table-bordered" style="width: 50%;">
                            <thead>
                                <tr>
                                    <th rowspan="2" style="vertical-align: middle; width: 80px;">No</th>
                                    <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
                                    <th colspan="<?= $jumlah_bantal; ?>" class="text-center">
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
                                    <th colspan="<?= $jumlah_bantal; ?>" class="text-center">
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
                                        <?php foreach ($jenis_bantal as $row2) : ?>
                                            <?php  ?>
                                            <td>
                                                <?php if ($row2->id == $row->id_jenis_bantal) {
                                                    echo $row->jumlah_realisasi;
                                                } else {
                                                    echo '-';
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
                                        <td><?php echo array_sum(array_column($total_perencanaan['realisasi' . $row->id], 'qty')) != 0 ? array_sum(array_column($total_perencanaan['realisasi' . $row->id], 'qty')) : '-'  ?></td>
                                    <?php endforeach ?>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <h5 class="mt-4">Pekerjaan yang telah disetor.</h5>
                <table class="table table-bordered" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Pekerjaan</th>
                            <th>ID Mitra</th>
                            <th>Nama Mitra</th>
                            <th>Jumlah Set</th>
                            <th>Jumlah Store</th>
                            <th>Sisa Set</th>
                            <th>Status Pekerjaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($distribusi as $row) : ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $row->nama_mitrawork; ?></td>
                                <td><?= $row->id_mitra; ?></td>
                                <td><?= $row->nama; ?></td>
                                <td><?= $row->jumlah_set; ?></td>
                                <td><?= isset($row->jumlah_store) ? $row->jumlah_store : '-'; ?></td>
                                <td><?= ($row->jumlah_set - $row->jumlah_store) == 0 ? '-' : $row->jumlah_set - $row->jumlah_store ?></td>
                                <td><?php
                                    if ($row->status_pekerjaan == 'dikerjakan') { ?>
                                        <span class="" style="text-transform: capitalize;"><?= $row->status_pekerjaan; ?></span>
                                    <?php } else if ($row->status_pekerjaan == 'selesai') { ?>

                                        <span class="" style="text-transform: capitalize;"><?= $row->status_pekerjaan; ?></span>
                                    <?php } else { ?>
                                        <span class="" style="text-transform: capitalize;"><?= $row->status_pekerjaan; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <h5 class="mt-4 text-danger">Pekerjaan yang belum disetor.</h5>
                <table class="table table-bordered" style="margin-top: 20px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis Pekerjaan</th>
                            <th>ID Mitra</th>
                            <th>Nama Mitra</th>
                            <th>Jumlah Set</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($belum_setor as $row) :
                        ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $row->nama_mitrawork; ?></td>
                                <td><?= $row->id_mitra; ?></td>
                                <td><?= $row->nama; ?></td>
                                <td><?= $row->jumlah_set; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
</body>
<script type="text/javascript">
    // window.onload = function() {
    //     window.print();
    // }
</script>

</html>