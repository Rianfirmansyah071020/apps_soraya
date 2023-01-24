<?php
$get_no_od = substr($id, 4);
?>
<section class="content">
    <div class="container-fluid">
        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h1><?= $id; ?></h1>
                        <h2>
                            TAMBAH DATA PROGRESS BARU
                            <small>Isi form di bawah ini, untuk menambahkan progress baru.</small>
                        </h2>
                    </div>
                    <div class="body">
                        <?= form_open_multipart($form_action, ['method' => 'POST']); ?>
                        <!-- <?= isset($input->id) ? form_hidden('id', $input->id) : form_hidden('id', 'MTR-' . rand(pow(10, 3 - 1), pow(10, 3) - 1) . date('YmdHis')); ?> -->
                        <h2 class="card-inside-title">Data Progress</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group form-float" style="margin-top: 30px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('id', $id, [
                                            'class' => 'form-control',
                                            'id' => 'id_progress',
                                            'disabled' => true
                                        ]);
                                        ?>
                                        <label class="form-label">No OD</label>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?= $input->id; ?>" id="noOd">
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                        form_input('motif', $input->motif, [
                                            'class' => 'form-control',
                                            'id' => 'motif',
                                        ]);
                                        ?>
                                        <label class="form-label">Nama Motif Kain</label>
                                        <?= form_error('motif'); ?>
                                    </div>
                                    <?php
                                    $date = new DateTime();
                                    if ($date->format('l') == 'Saturday') {
                                        $date->modify('+2 day');
                                        $tanggal_rencana = $date->format('Y-m-d');
                                    } else {
                                        $date->modify('+1 day');
                                        $tanggal_rencana = $date->format('Y-m-d');
                                    }
                                    ?>
                                    <input type="hidden" name="tanggal_rencana" value="<?= $tanggal_rencana; ?>">
                                </div>
                                <!-- create card with background red -->
                                <div class="card bg-orange">
                                    <div class="header">
                                        <h2> Form tambahan untuk preorder
                                            <small>
                                                <p>Isi form ini jika orderan ini merupakan preorder</p>
                                            </small>
                                        </h2>
                                    </div>
                                </div>
                                <div class="form-group form-float" style="margin-top: 30px;">
                                    <div class="form-line">
                                        <?=
                                        form_dropdown('id_toko', getDropdownList('toko', ['id', 'nama_toko']), $input->id_toko, ['class' => 'form-control show-tick', 'id' => 'id_toko']);
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group form-float" style="margin-top: 50px;">
                                    <div class="form-line">
                                        <?=
                                        form_textarea('keterangan', $input->keterangan, [
                                            'class' => 'form-control',
                                            'id' => 'keterangan',
                                        ]);
                                        ?>
                                        <label class="form-label">keterangan</label>
                                        <?= form_error('keterangan'); ?>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line ">
                                        <input type="date" name="estimasi" id="estimasi" class="form-control" value="<?= $input->estimasi; ?>" placeholder="Tanggal Estimasi">
                                    </div>
                                    <?= form_error('estimasi'); ?>
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
        <!-- #END# Input -->
    </div>
</section>