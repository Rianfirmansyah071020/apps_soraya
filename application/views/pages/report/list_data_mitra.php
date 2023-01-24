<div class="row">
    <div class="col-sm-6 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <td>Nama Lengkap</td>
                    <td>:</td>
                    <td><?= $getMitra->nama; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= $getMitra->jenis_kelamin ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td><?= $getMitra->tgl_lahir ?></td>
                </tr>
                <tr>
                    <td>No HP</td>
                    <td>:</td>
                    <td><?= $getMitra->nohp ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $getMitra->alamat ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td><?= $getMitra->status_nikah ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-6 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <td>No Mitra</td>
                    <td>:</td>
                    <td><?= $getMitra->id ?></td>
                </tr>
                <tr>
                    <td>Tempat</td>
                    <td>:</td>
                    <td><?= $getMitra->tempat ?></td>
                </tr>
                <tr>
                    <td>Tanggal Mulai Kerja</td>
                    <td>:</td>
                    <td><?= $getMitra->tgl_mulai_kerja ?></td>
                </tr>
                <tr>
                    <?php
                    $waktuAwal = new DateTime($getMitra->tgl_mulai_kerja . " 00:00:00");
                    $waktuSekarang = new DateTime();
                    $diff = date_diff($waktuAwal, $waktuSekarang);

                    if ($diff->m == 0) {
                        $durasi = 'Kurang dari sebulan';
                    } else {
                        $durasi = $diff->m . ' bulan';
                    }
                    ?>
                    <td>Durasi Kerja</td>
                    <td>:</td>
                    <td><?= $durasi ?></td>
                </tr>
                <tr>
                    <td>Status Mitra</td>
                    <td>:</td>
                    <td>
                        <?php
                        if ($getMitra->is_active == 1) {
                            echo '<span class="badge bg-success" style="background-color: #00a65a;">Aktif</span>';
                        } else {
                            echo '<span class="badge bg-danger" style="background-color: #dd4b39;">Tidak Aktif</span>';
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>