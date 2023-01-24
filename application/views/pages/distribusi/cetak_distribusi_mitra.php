<html>

<head>
    <title>Faktur Pembayaran</title>
    <style>
        #tabel {
            font-size: 18px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }

        .row-data td {
            padding-left: 5px;
        }

        @page {
            size: landscape;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:13pt;'>
    <center>
        <table style='width:1140px; font-size:13pt; font-family:calibri; border-collapse: collapse; border-bottom: 1px solid #000;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top; padding-bottom: 10px;'>
                <span style='font-size:16pt'><b>PT. SORAYA BERJAYA INDONESIA</b>
                </span></br>
                Jln. Palangkaraya No.7, Nanggalo, Kota Padang, Sumatera Barat
            </td>
        </table>
        <table style='width:1140px; font-size:13pt; margin-top: 15px; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                Nama Mitra : <strong><?= $getMitra->nama; ?></strong></br>
                Alamat : <?= $getMitra->alamat ?>
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                No Mitra : <?= $getMitra->id ?></br>
                No HP : <?= $getMitra->nohp ?>
            </td>
        </table>
        <table cellspacing='0' style='width:1140px; font-size:13pt; font-family:calibri; margin-top: 15px;  border-collapse: collapse;' border='1'>

            <tr align='center'>
                <td width='13%'>Tanggal Distribusi</td>
                <td width='7%'>No DO</td>
                <td width='15%'>Motif</td>
                <td width='15%'>Pekerjaan</td>
                <td width='5%'>Jumlah Distribusi</td>
                <td width='7%'>Status</td>
            </tr>
            <?php foreach ($content as $row) : ?>
                <tr class="row-data">
                    <td><?= date_format(new DateTime($row->tanggal_distribusi), 'd/m/Y H:i'); ?></td>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->motif; ?></td>
                    <td><?= $row->nama_mitrawork; ?></td>
                    <td><?= $row->jumlah_set; ?></td>
                    <td><b><?= strtoupper($row->status_pekerjaan); ?></b></td>
                </tr>
            <?php endforeach ?>
        </table>

    </center>
</body>

</html>