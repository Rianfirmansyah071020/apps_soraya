<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h1><?= $id; ?></h1>
                        <h2>
                            TAMBAH REALISASI PERENCANAAN GUNTING
                            <small>Isi form di bawah ini, untuk menambahkan realisasi perencanaan gunting.</small>
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
                        <?= form_open_multipart('progress/insert_realisasi/' . $id, ['method' => 'POST']); ?>
                        <?= isset($id) ? '<input type="hidden" name="id" value="' . $id . '" id="idProgress">' : ''; ?>
                        <div class="row clearfix">
                            <?php foreach ($getPerencanaan as $row) : ?>
                                <?php if ($row->jumlah_realisasi == "") : ?>
                                    <input type="hidden" name="id_perencanaan[]" value="<?= $row->id_perencanaan; ?>">
                                    <input type="hidden" name="id_progress[]" value="<?= $row->id_progress; ?>">
                                    <div class="col-xs-3" style="margin-top: 20px;">
                                        <h2 class="card-inside-title"> Jenis Pekerjaan</h2>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="hidden" class="form-control" value="<?= $row->id_jenis_pekerjaan; ?>" />
                                                <input type="text" class="form-control" value="<?= $row->nama_pekerjaan ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3" style="margin-top: 20px;">
                                        <h2 class="card-inside-title"> Jenis Bantal</h2>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="hidden" class="form-control" value="<?= $row->id_jenis_bantal ?>" />
                                                <input type="text" class="form-control" value="<?= $row->nama_jenis_bantal ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3" style="margin-top: 20px;">
                                        <h2 class="card-inside-title">Kuantitas Rencana</h2>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="hidden" class="form-control" value="<?= $row->kuantitas_rencana ?>" name="kuantitas_rencana[]" required />
                                                <input type="text" class="form-control" value="<?= $row->kuantitas_rencana ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3" style="margin-top: 20px;">
                                        <h2 class="card-inside-title">Kuantitas Realisasi</h2>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" class="form-control" value="" name="qty[]" required />
                                            </div>
                                        </div>
                                    </div>
                                <?php endif ?>
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