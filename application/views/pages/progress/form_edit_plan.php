<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h1><?= $id; ?></h1>
                        <h2>
                            EDIT PERENCANAAN
                            <small>Isi form di bawah ini, untuk mengubah data perencanaan.</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <?= form_open_multipart('progress/update_plan/' . $id, ['method' => 'POST']); ?>
                        <div class="row">
                            <div class="col-xs-3">
                                <h2 class="card-inside-title">Penggunting</h2>
                                <input type="hidden" name="idProgress" value="<?= isset($getPenggunting->id_progress) ? $getPenggunting->id_progress : ""  ?>">
                                <?php if (isset($getPenggunting->id_progress)) : ?>
                                    <select class="form-control show-tick" data-live-search="true" name="id_mitra">
                                        <option></option>
                                        <?php foreach ($getMitra as $row3) : ?>
                                            <option value="<?= $row3->id; ?>" <?= $row3->id == $getPenggunting->id_mitra ? "selected" : "" ?>><?= $row3->id; ?>&nbsp;-&nbsp;<?= $row3->nama; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                <?php endif ?>
                            </div>
                        </div>
                        <?= isset($id) ? '<input type="hidden" name="id" value="' . $id . '" id="idProgress">' : ''; ?>
                        <div class="row clearfix">
                            <?php foreach ($getPerencanaan as $row) : ?>
                                <input type="hidden" name="id_perencanaan[]" value="<?= $row->id_perencanaan; ?>">
                                <input type="hidden" name="id_progress[]" value="<?= $row->id_progress; ?>">
                                <div class="col-xs-3" style="margin-top: 20px;">
                                    <h2 class="card-inside-title"> Jenis Pekerjaan</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?= form_dropdown('id_jenis_pekerjaan[]', getDropdownList('jenis_pekerjaan', ['id', 'nama_pekerjaan']), $row->id_jenis_pekerjaan, ['class' => 'form-control']); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3" style="margin-top: 20px;">
                                    <h2 class="card-inside-title"> Jenis Bantal</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?= form_dropdown('id_jenis_bantal[]', getDropdownList('jenis_bantal', ['id', 'nama_jenis_bantal']), $row->id_jenis_bantal, ['class' => 'form-control']); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3" style="margin-top: 20px;">
                                    <h2 class="card-inside-title">Jumlah Store Pekerjaan</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="qty[]" value="<?= $row->qty ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3" style="margin-top: 20px;">
                                    <h2 class="card-inside-title">Satuan</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control show-tick" name="id_satuan[]" required>
                                                <option value="">-- Pilih Satuan --</option>
                                                <?php foreach ($getSatuan as $satuan) : ?>
                                                    <option value="<?= $satuan->id; ?>" <?= $satuan->id == $row->id_satuan ? "selected" : "" ?>><?= $satuan->nama_satuan; ?></option>
                                                <?php endforeach; ?>
                                            </select>
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