<div class="modal-header">
    <div class="row">
        <div class="col-xs-6">
            <h4><?= $id_mitra; ?></h4>
        </div>
    </div>
</div>
<div class="modal-body">
    <div class="row clearfix">
        <form action="<?= base_url("mitra/moveToMitraOut/$id_mitra"); ?>" method="POST">
            <div class="col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?= $mitra->nama; ?> <small style="text-transform: capitalize;"><?= $mitra->jenis_kelamin; ?></small>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <table class="table table-striped">
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td>:</td>
                                        <td><?= $mitra->tgl_lahir; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No HP</td>
                                        <td>:</td>
                                        <td><?= $mitra->nohp; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td><?= $mitra->alamat; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td style="text-transform: capitalize;">
                                            <?php
                                            if ($mitra->status_nikah == "belum_nikah") {
                                                $status = explode("_", $mitra->status_nikah);
                                                echo $status[0] . " " . $status[1];
                                            } else {
                                                echo $mitra->status_nikah;
                                            }

                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <table class="table table-striped">
                                    <tr style="text-transform: capitalize;">
                                        <td>Tempat</td>
                                        <td>:</td>
                                        <td><?= $mitra->tempat; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Mulai Kerja</td>
                                        <td>:</td>
                                        <td><?= $mitra->tgl_mulai_kerja; ?></td>
                                    </tr>
                                    <?php
                                    $waktuAwal = new DateTime($mitra->tgl_mulai_kerja . " 00:00:00");
                                    $waktuSekarang = new DateTime();
                                    $diff = date_diff($waktuAwal, $waktuSekarang);

                                    if ($diff->m == 0) {
                                        $durasi = 'Kurang dari sebulan';
                                    } else {
                                        $durasi = $diff->m . ' bulan';
                                    }
                                    ?>
                                    <tr>
                                        <td>Durasi Kerja</td>
                                        <td>:</td>
                                        <td><?= $durasi; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Alasan Dikeluarkan Mitra</h5>
                <select class="form-control show-tick" id="select_alasan" name="status_out" required>
                    <option value="">-- Please select --</option>
                    <option value="Blacklist">Blacklist</option>
                    <option value="PHK">PHK</option>
                    <option value="Lainnya">Lainnya...</option>
                </select>
                <div class="form-group" style="margin-top: 30px;" id="alasan-lainnya">
                    <div class="form-line">
                        <textarea rows="4" class="form-control no-resize" placeholder="Isikan Alasan Lainnya..." name="keterangan"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-danger waves-effect" style="float: right;">KELUARKAN</button>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">TUTUP</button>
</div>