<section class="content">
    <div class="container-fluid">
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            TAMBAH DATA PEMBELIAN BARANG BARU
                            <small>Isi form di bawah ini, untuk menambahkan data pembelian barang baru.</small>
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
                        <h2 class="card-inside-title">Data Pembelian Barang Baru</h2>
                        <?php
                        if (isset($input->id)) {
                            echo form_hidden('id', $input->id);
                            echo form_input(['name' => 'kd_barang', 'type' => 'hidden', 'value' => $input->kd_barang]);
                        } else {
                            $kd_barang = 'BRG-' . rand(pow(10, 3 - 1), pow(10, 3) - 1) . date('YmdHis');
                            echo form_input(['name' => 'kd_barang', 'type' => 'hidden', 'value' => $kd_barang]);
                        }
                        ?>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('nama', $input->nama, [
                                            'class' => 'form-control',
                                            'id' => 'namaBarang',
                                        ]);
                                        ?>
                                        <label class="form-label">Nama Barang</label>
                                        <?= form_error('nama'); ?>
                                    </div>
                                </div>
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('jumlah', $input->jumlah, [
                                            'class' => 'form-control',
                                            'id' => 'jumlah',
                                        ]);
                                        ?>
                                        <label class="form-label">Jumlah Barang</label>
                                        <?= form_error('jumlah'); ?>
                                    </div>
                                </div>
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?= form_input('harga', $input->harga, [
                                            'class' => 'form-control',
                                            'id' => 'harga'
                                        ]); ?>
                                        <label class="form-label">Harga</label>
                                        <?= form_error('harga'); ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            // jika tambah data, maka created_at diisi dengan tanggal sekarang, jika edit data, maka created_at tidak bisa diubah
                            if (isset($input->id)) {
                                echo form_input(['name' => 'created_at', 'type' => 'hidden', 'value' => $input->created_at]);
                                echo form_input(['name' => 'updated_at', 'type' => 'hidden', 'value' => date('Y-m-d H:i:s')]);
                            } else {
                                echo form_input(['name' => 'created_at', 'type' => 'hidden', 'value' => date('Y-m-d H:i:s')]);
                                echo form_input(['name' => 'updated_at', 'type' => 'hidden', 'value' => date('Y-m-d H:i:s')]);
                            }
                            // echo form_input(['name' => 'created_at', 'type' => 'hidden', 'value' => date('Y-m-d H:i:s')]);
                            // echo form_input(['name' => 'updated_at', 'type' => 'hidden', 'value' => date('Y-m-d H:i:s')]);
                            ?>
                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-lg waves-effect" style="float: right;" type="submit">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Input -->
    </div>
</section>