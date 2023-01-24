<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TAMBAH DATA MITRA
                            <small>Isi form di bawah ini, untuk menambahkan mitra.</small>
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
                        <?= form_open($form_action, ['method' => 'POST']); ?>
                        <?= isset($input->id) && $input->id != '' ? form_hidden('id', $input->id) : form_hidden('id', 'MTR-' . rand(pow(10, 3 - 1), pow(10, 3) - 1) . date('ymdHis')); ?>
                        <h2 class="card-inside-title">Data Mitra</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-top: 20px;">
                                    <div class="form-line focused">
                                        <?=
                                        form_input('nama', $input->nama, [
                                            'class' => 'form-control',
                                            'id' => 'nama',
                                            'autofocus' => true
                                        ]);
                                        ?>
                                        <label class="form-label">Nama</label>
                                    </div>
                                    <?= form_error('nama'); ?>
                                </div>
                                <div class="form-group form-float" style="margin-top: 30px;">
                                    <div class="form-line">
                                        <?= form_input([
                                            'type' => 'number',
                                            'name' => 'nohp',
                                            'id'   => 'nohp',
                                            'value' => $input->nohp,
                                            'class' => 'form-control',
                                        ]); ?>
                                        <label class="form-label">No HP</label>
                                    </div>
                                    <?= form_error('nohp'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line tgl_lahir" id="bs_datepicker_container">
                                        <?php
                                        $conv_tgl_lahir = date_format(new DateTime($input->tgl_lahir . "00:00:00"), "m/d/Y");
                                        $conv_tgl_mulai_kerja = date_format(new DateTime($input->tgl_mulai_kerja . "00:00:00"), "m/d/Y");
                                        ?>
                                        <?=
                                        form_input('', $conv_tgl_lahir, [
                                            'class' => 'form-control valTglLahir',
                                            'id' => 'tgllahir',
                                            'autocomplete' => 'off'
                                        ]);
                                        ?>
                                        <label class="form-label">Tanggal Lahir</label>

                                    </div>
                                    <?= form_error('tgl_lahir'); ?>
                                    <input type="hidden" name="tgl_lahir" value="<?= $input->tgl_lahir; ?>" id="tglLahir">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="form-line tgl_kerja" id="bs_datepicker_container">
                                        <?=
                                        form_input('', $conv_tgl_mulai_kerja, [
                                            'class' => 'form-control valTglKerja',
                                            'id' => 'tglkerja',
                                            'autocomplete' => 'off'
                                        ]);
                                        ?>
                                        <label class="form-label">Tanggal Mulai Kerja</label>
                                    </div>
                                    <?= form_error('tgl_mulai_kerja'); ?>
                                </div>
                                <input type="hidden" name="tgl_mulai_kerja" value="<?= $input->tgl_mulai_kerja; ?>" id="tglKerja">
                            </div>
                            <div class="col-sm-12">
                                <h2 class="card-inside-title">Jenis Kelamin</h2>
                                <div class="demo-radio-button">

                                    <input name="jenis_kelamin" type="radio" id="radio_12" class="radio-col-blue" value="laki-laki" <?= $input->jenis_kelamin == "laki-laki" ? "checked" : "" ?> />
                                    <label for="radio_12">Laki-laki</label>
                                    <input name="jenis_kelamin" type="radio" id="radio_8" class="radio-col-pink" value="perempuan" <?= $input->jenis_kelamin == "perempuan" ? "checked" : "" ?> />
                                    <label for="radio_8">Perempuan</label>
                                </div>
                            </div>
                            <div class="col-sm-12" style="margin-top: 30px;">
                                <h2 class="card-inside-title">Alamat</h2>
                                <div class="form-group">
                                    <div class="form-line">

                                        <?= form_textarea(['name' => 'alamat', 'value' => $input->alamat, 'rows' => 4, ' id' => '', 'class' => 'form-control no-resize', 'id' => 'description', 'placeholder' => 'Isikan Alamat Lengkap Mitra...']) ?>
                                    </div>
                                    <?= form_error('alamat'); ?>
                                </div>
                            </div>
                            <div class="col-sm-6" style="margin-top: 20px;">
                                <h2 class="card-inside-title">Tempat Kerja Mitra</h2>
                                <select class="form-control show-tick" name="tempat">
                                    <option value="">-- Pilih Tempat--</option>
                                    <option value="pabrik" <?= $input->tempat == 'pabrik' ? 'selected' : '' ?>>Pabrik</option>
                                    <option value="rumah" <?= $input->tempat == 'rumah' ? 'selected' : '' ?>>Rumah</option>

                                </select>
                                <?= form_error('tempat'); ?>
                            </div>
                            <div class="col-sm-6" style="margin-top: 20px;">
                                <h2 class="card-inside-title">Status</h2>
                                <select class="form-control show-tick" name="status_nikah" searchable="Search here..">
                                    <option value="">-- Pilih Status--</option>
                                    <option value="belum_nikah" <?= $input->status_nikah == 'belum_nikah' ? 'selected' : '' ?>>Belum Menikah</option>
                                    <option value="nikah" <?= $input->status_nikah == 'nikah' ? 'selected' : '' ?>>Nikah</option>
                                    <option value="janda" <?= $input->status_nikah == 'janda' ? 'selected' : '' ?>>Janda</option>
                                    <option value="duda" <?= $input->status_nikah == 'duda' ? 'selected' : '' ?>>Duda</option>
                                </select>
                                <?= form_error('status_nikah'); ?>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-lg waves-effect" style="float: right;" type="submit">SUBMIT</button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>