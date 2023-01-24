<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h1><?= $id; ?></h1>
                        <h2>
                            Hapus PERENCANAAN
                            <small>Pilih perencanaan yang ingin dihapus.</small>
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

                        <?= form_open_multipart('progress/delete_plan/' . $id, ['method' => 'POST']); ?>
                        <div class="row clearfix">
                            <?php $i = 0;
                            foreach ($getPerencanaan as $row) : ?>
                                <input type="hidden" name="id_perencanaan[]" value="<?= $row->id_perencanaan; ?>">
                                <input type="hidden" name="id_progress[]" value="<?= $row->id_progress; ?>">
                                <div class="col-xs-1" style="margin-top: 55px;">
                                    <input type="checkbox" id="md_checkbox<?= $i ?>" class="filled-in chk-col-cyan check-item" name="id[]" value="<?= $row->id_perencanaan; ?>" />
                                    <label for="md_checkbox<?= $i ?>"></label>
                                </div>
                                <div class="col-xs-4" style="margin-top: 20px;">
                                    <h2 class="card-inside-title"> Jenis Pekerjaan</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?= form_dropdown('id_jenis_pekerjaan[]', getDropdownList('jenis_pekerjaan', ['id', 'nama_pekerjaan']), $row->id_jenis_pekerjaan, ['class' => 'form-control', 'disabled' => 'true']); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4" style="margin-top: 20px;">
                                    <h2 class="card-inside-title"> Jenis Bantal</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?= form_dropdown('id_jenis_bantal[]', getDropdownList('jenis_bantal', ['id', 'nama_jenis_bantal']), $row->id_jenis_bantal, ['class' => 'form-control', 'disabled' => 'true']); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3" style="margin-top: 20px;">
                                    <h2 class="card-inside-title">Jumlah Store Pekerjaan</h2>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="qty[]" value="<?= $row->qty ?>" disabled />
                                        </div>
                                    </div>
                                </div>
                            <?php $i++;
                            endforeach ?>
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