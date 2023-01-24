<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TAMBAH DATA JENIS PEKERJAAN REALISASI BARU
                            <small>Isi form di bawah ini, untuk menambahkan jenis pekerjaan realisasi baru.</small>
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
                        <?= form_open_multipart($form_action, ['method' => 'POST']); ?>
                        <!-- <?= isset($input->id) ? form_hidden('id', $input->id) : form_hidden('id', 'MTR-' . rand(pow(10, 3 - 1), pow(10, 3) - 1) . date('YmdHis')); ?> -->
                        <h2 class="card-inside-title">Data Jenis Pekerjaan Realisasi</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('nama_pekerjaan', $input->nama_pekerjaan, [
                                            'class' => 'form-control',
                                            'id' => 'jenisPekerjaanRealisasi',
                                        ]);

                                        ?>
                                        <label class="form-label">Nama Jenis Pekerjaan</label>
                                        <?= form_error('nama_pekerjaan'); ?>
                                    </div>
                                </div>
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('keterangan', $input->keterangan, [
                                            'class' => 'form-control',
                                            'id' => 'ketJenisPekerjaanRealisasi',
                                        ]);

                                        ?>
                                        <label class="form-label">Keterangan</label>
                                    </div>
                                </div>
                            </div>
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