<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header" style="display: flex; justify-content: space-between;">
                <h2 style="text-transform: uppercase;">
                    Data Mitra
                </h2>
                <button type="button" class="btn btn-danger btn-lg waves-effect" id="btnCetakDistribusiMitra">CETAK <img src="<?= base_url("assets/img/load.gif") ?>" alt="load-icon" style="width: 18px; display: none;" id="loadIcon"></button>
            </div>
            <div class="body">
                <div id="frames">

                </div>
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
                                    <td><?= ucwords($getMitra->jenis_kelamin); ?></td>
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
                                    <?php
                                    $get_status_nikah = str_replace("_", " ", $getMitra->status_nikah);

                                    ?>
                                    <td><?= ucwords($get_status_nikah); ?></td>
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
                                    <td><?= ucwords($getMitra->tempat); ?></td>
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

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2 style="text-transform: uppercase;">
                    Result
                </h2>
            </div>

            <div class="body">
                <div class="table-detail-dist">
                    <div class="table-responsive">
                        <table class="table myDatTab">
                            <thead>
                                <tr>
                                    <th>No DO</th>
                                    <th>Motif</th>
                                    <th>Tanggal Distribusi</th>
                                    <th>Pekerjaan</th>
                                    <th>Jumlah Distribusi</th>
                                    <th>Status</th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php $no = 1;
                                foreach ($content as $row) : ?>
                                    <tr>

                                        <td><?= $row->id; ?></td>
                                        <td><?= $row->motif; ?></td>
                                        <td><?= date_format(new DateTime($row->tanggal_distribusi), 'd/m/Y H:i'); ?></td>
                                        <td><?= $row->nama_mitrawork; ?></td>
                                        <td><?= $row->jumlah_set; ?></td>
                                        <td>
                                            <?php
                                            if ($row->status_pekerjaan == 'dikerjakan') { ?>
                                                <span class="badge bg-pink" style="text-transform: capitalize;"><?= $row->status_pekerjaan; ?></span>
                                            <?php } else if ($row->status_pekerjaan == 'selesai') { ?>

                                                <span class="badge bg-teal" style="text-transform: capitalize;"><?= $row->status_pekerjaan; ?></span>
                                            <?php } else { ?>
                                                <span class="badge bg-orange" style="text-transform: capitalize;"><?= $row->status_pekerjaan; ?></span>
                                            <?php } ?>
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
</div>