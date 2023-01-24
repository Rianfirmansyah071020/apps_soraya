<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            <?php if ($activity == 'add') : ?>
                                TAMBAH DATA KAIN BARU
                                <small>Isi form di bawah ini, untuk menambahkan data kain baru.</small>
                            <?php else : ?>
                                EDIT DATA KAIN
                                <small>Isi form di bawah ini, untuk mengubah data kain.</small>
                            <?php endif ?>
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
                        <h2 class="card-inside-title">Data Kain Baru</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <input type="hidden" name="id" value="<?= $kode; ?>">
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('jenis', $input->jenis, [
                                            'class' => 'form-control',
                                            'id' => 'jenisKain',
                                        ]);
                                        ?>
                                        <label class="form-label">Jenis Kain</label>
                                    </div>
                                </div>
                                <?= form_error('jenis'); ?>
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('vendor', $input->vendor, [
                                            'class' => 'form-control',
                                            'id' => 'vendorKain',
                                        ]);
                                        ?>
                                        <label class="form-label">Vendor</label>
                                    </div>
                                </div>
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('nama', $input->nama, [
                                            'class' => 'form-control',
                                            'id' => 'namaMotifKain',
                                        ]);
                                        ?>
                                        <label class="form-label">Nama Motif</label>
                                    </div>
                                </div>
                                <?= form_error('nama'); ?>
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