<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h1><?= $id; ?></h1>
                        <h2>
                            TAMBAH STORE KERJA MITRA
                            <small>Isi form di bawah ini, untuk menambahkan store pekerjaan mitra.</small>
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
                        <?= form_open_multipart('store/update_store/', ['method' => 'POST']); ?>
                        <?= isset($id) ? '<input type="hidden" name="id" value="' . $id . '" id="idProgress">' : ''; ?>
                        <div class="row clearfix">
                            <?php foreach ($getDistribusi as $row) : ?>
                                <input type="hidden" name="id_distribusi[]" value="<?= $row->id_distribusi; ?>">
                                <input type="hidden" name="id_store[]" value="<?= $row->id_store; ?>">
                                <input type="hidden" name="id_progress[]" value="<?= $row->id_progress; ?>">
                                <input type="hidden" name="status_pekerjaan[]" value="<?= $row->status_pekerjaan; ?>">
                                <div class="col-xs-3" style="margin-top: 20px;">
                                    <h2 class="card-inside-title"> Jenis Pekerjaan</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row->nama_mitrawork ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3" style="margin-top: 20px;">
                                    <h2 class="card-inside-title"> Nama Mitra</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row->nama ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3" style="margin-top: 20px;">
                                    <h2 class="card-inside-title">Jumlah Set Pekerjaan</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="<?= $row->jumlah_set ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3" style="margin-top: 20px;">
                                    <h2 class="card-inside-title">Jumlah Store Pekerjaan</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="hidden" class="form-control" name="jumlah_set[]" value="<?= $row->jumlah_set ?>" />
                                            <input type="text" class="form-control" name="jumlah_store[]" value="<?= $row->jumlah_store ?>" required />
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