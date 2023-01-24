<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h1><?= $id; ?></h1>
                        <h2>
                            EDIT PEMBAGIAN KERJA MITRA
                            <small>Isi form di bawah ini, untuk mengubah pembagian kerja mitra.</small>
                        </h2>
                        <br>
                        <div class=" ">
                            <strong>Perhatian!</strong> Nama mitra yang tidak muncul disebabkan karena mitra tersebut sudah tidak aktif.
                        </div>

                    </div>
                    <div class="body">

                        <?= form_open_multipart('distribusi/update_work', ['method' => 'POST']); ?>
                        <?= isset($id) ? '<input type="hidden" name="id" value="' . $id . '" id="idProgress">' : ''; ?>

                        <div class="row clearfix">
                            <?php foreach ($getDist as $row) : ?>
                                <input type="hidden" name="id_progress[]" value="<?= $id; ?>">
                                <input type="hidden" name="id_distribusi[]" value="<?= $row->id; ?>">
                                <div class="col-xs-4" style="margin-top: 20px;">
                                    <h2 class="card-inside-title"> Jenis Pekerjaan</h2>
                                    <select class="form-control" data-live-search="true" name="id_mitrawork[]">
                                        <option></option>
                                        <?php foreach ($getJenisPekerjaan as $row2) : ?>
                                            <option value="<?= $row2->id; ?>" <?= $row2->id == $row->id_mitrawork ? "selected" : ""  ?>><?= $row2->nama_mitrawork; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-xs-4" style="margin-top: 20px;">
                                    <h2 class="card-inside-title">Mitra</h2>
                                    <select class="form-control show-tick" data-live-search="true" name="id_mitra[]">
                                        <option></option>
                                        <?php foreach ($getMitra as $row3) : ?>
                                            <option value="<?= $row3->id; ?>" <?= $row3->id == $row->id_mitra ? "selected" : "" ?>><?= $row3->nama; ?></option>
                                        <?php endforeach ?>

                                    </select>

                                </div>
                                <div class="col-xs-4" style="margin-top: 20px;">
                                    <h2 class="card-inside-title">Jumlah Set</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="jumlah_set[]" value="<?= $row->jumlah_set ?>" required />
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach ?>
                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-lg waves-effect" style="float: right;" type="submit">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>