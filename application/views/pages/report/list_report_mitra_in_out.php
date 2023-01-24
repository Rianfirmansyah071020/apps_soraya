<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="text-transform: uppercase;">
                    DATA MITRA IN
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover myDatTab">
                        <thead>
                            <tr>
                                <th>No Mitra</th>
                                <th>Nama</th>
                                <th>Tgl Lahir</th>
                                <th>Tgl Mulai Kerja</th>
                                <th>Durasi Kerja</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Tempat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mitra_in as $row) : ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= tgl_indo($row['tgl_lahir']); ?></td>
                                    <td><?= tgl_indo($row['tgl_mulai_kerja']); ?></td>
                                    <?php
                                    $waktuAwal = new DateTime($row['tgl_mulai_kerja'] . " 00:00:00");
                                    $waktuSekarang = new DateTime();
                                    $diff = date_diff($waktuAwal, $waktuSekarang);

                                    if ($diff->m == 0 && $diff->y == 0) {
                                        $durasi = 'Kurang dari sebulan';
                                    } else if ($diff->y > 0) {
                                        $durasi = $diff->y . ' tahun ' . $diff->m . ' bulan';
                                    } else {
                                        $durasi = $diff->m . ' bulan';
                                    }
                                    ?>
                                    <td><?= $durasi; ?></td>
                                    <td><?= $row['nohp']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td><?= ucfirst($row['jenis_kelamin']); ?></td>
                                    <td><?= ucfirst($row['tempat']); ?></td>
                                    <td><?php
                                        if ($row['status_nikah'] == "belum_nikah") {
                                            echo 'Belum Nikah';
                                        } else if ($row['status_nikah'] == "janda") {
                                            echo 'Janda';
                                        } else if ($row['status_nikah'] == "duda") {
                                            echo 'Duda';
                                        } else {
                                            echo 'Nikah';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 style="text-transform: uppercase;">
                    DATA MITRA OUT
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover myDatTab">
                        <thead>
                            <tr>
                                <th>No Mitra</th>
                                <th>Nama</th>
                                <th>Tgl Lahir</th>
                                <th>Tgl Mulai Kerja</th>
                                <th>Durasi Kerja</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Tgl Dikeluarkan</th>
                                <th>Tempat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mitra_out as $row) : ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= tgl_indo($row['tgl_lahir']); ?></td>
                                    <td><?= tgl_indo($row['tgl_mulai_kerja']); ?></td>
                                    <?php
                                    $waktuAwal = new DateTime($row['tgl_mulai_kerja'] . " 00:00:00");
                                    $waktuSekarang = new DateTime();
                                    $diff = date_diff($waktuAwal, $waktuSekarang);
                                    if ($diff->m == 0 && $diff->y == 0) {
                                        $durasi = 'Kurang dari sebulan';
                                    } else if ($diff->y > 0) {
                                        $durasi = $diff->y . ' tahun ' . $diff->m . ' bulan';
                                    } else {
                                        $durasi = $diff->m . ' bulan';
                                    }
                                    ?>
                                    <td><?= $durasi; ?></td>
                                    <td><?= $row['nohp']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td><?= ucfirst($row['jenis_kelamin']); ?></td>
                                    <?php
                                    $tgl_keluar = date_format(new DateTime($row['tgl_mitra_out']), "Y-m-d");
                                    ?>
                                    <td><?= tgl_indo($tgl_keluar); ?></td>
                                    <td><?= ucfirst($row['tempat']); ?></td>
                                    <td><?php
                                        if ($row['status_nikah'] == "belum_nikah") {
                                            echo 'Belum Nikah';
                                        } else if ($row['status_nikah'] == "janda") {
                                            echo 'Janda';
                                        } else if ($row['status_nikah'] == "duda") {
                                            echo 'Duda';
                                        } else {
                                            echo 'Nikah';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>