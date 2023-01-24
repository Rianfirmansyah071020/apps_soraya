<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TAMBAH DATA USER
                            <small>Isi form di bawah ini, untuk menambahkan user lain.</small>
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
                        <h2 class="card-inside-title">Data User</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-top: 20px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('nama', $input->nama, [
                                            'class' => 'form-control',
                                            'id' => 'nama_admin',
                                            'autofocus' => true
                                        ]);
                                        ?>
                                        <label class="form-label">Nama</label>
                                        <?= form_error('nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float" style="margin-top: 5px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('username', $input->username, [
                                            'class' => 'form-control',
                                            'id' => 'username',
                                            'autofocus' => true
                                        ]);
                                        ?>
                                        <label class="form-label">Username</label>
                                        <?= form_error('username'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float" style="margin-top: 5px;">
                                    <div class="form-line">
                                        <?=
                                        form_password('password', '', [
                                            'class' => 'form-control',
                                            'id' => 'password',
                                            'autofocus' => true
                                        ]);
                                        ?>
                                        <label class="form-label">Password</label>
                                        <?= form_error('password'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <h2 class="card-inside-title">Status Akun</h2>
                                <div class="demo-radio-button">

                                    <input name="is_active" type="radio" id="radio_12" class="radio-col-blue" value="1" <?= $input->is_active == 1 ? "checked" : "" ?> />
                                    <label for="radio_12">Active</label>
                                    <input name="is_active" type="radio" id="radio_8" class="radio-col-pink" value="0" <?= $input->is_active == 0 ? "checked" : "" ?> />
                                    <label for="radio_8">Not Active</label>
                                </div>
                            </div>
                            <div class="col-sm-6" style="margin-top: 20px;">
                                <h2 class="card-inside-title">Akun ini sebagai</h2>
                                <select class="form-control show-tick" name="role">
                                    <option>-- Pilih Role--</option>
                                    <option value="admin" <?= $input->role == "admin" ? "selected" : "" ?>>Admin</option>
                                    <option value="admin_operator">Admin Operator</option>
                                    <option value="admin_gunting">Admin Gunting</option>
                                    <option value="admin_distribusi">Admin Distribusi</option>
                                    <option value="admin_store">Admin Store Pekerjaan</option>
                                    <option value="admin_finance">Admin Finance</option>
                                </select>
                                <?= form_error('role'); ?>
                            </div>
                            <div class="col-sm-12" style="margin-top: 20px;">
                                <input type="hidden" name="image" value="<?= $input->image ?>" id="image_admin">
                                <h2 class="card-inside-title">Upload Profile Picture</h2>
                                <div id="my-dropzone" class="dropzone">
                                </div>
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