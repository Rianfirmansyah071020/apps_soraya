<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 style="text-transform: uppercase;">
                            <?= $title_detail; ?>
                        </h2>
                        <span style="font-size: 12px; color: #b1b1b1; margin-top: 10px;">detail dari progress
                            <?= $id; ?></span> <br>
                        <br>
                        <a href="<?= base_url("progress/realisasi"); ?>" class="btn btn-info waves-effect">Kembali</a>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">
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
                    <div class="body" data-id="<?= $this->session->flashdata('id_insert'); ?>">
                        <?php $this->load->view('layouts/_alert'); ?>
                        <h1 style="text-align: right;"><span style="font-size: 11px;">No DO
                                :&nbsp;&nbsp;</span><?= $id; ?></h1>
                        <div class="row bg-custom">
                            <div style="margin-top: 20px;"></div>
                            <div class="col-xs-3">
                                <p>Hari / Tgl : <?= date_format(new DateTime($data_progress->tanggal), "D / d M Y"); ?>
                                </p>
                            </div>
                            <div class="col-xs-3">
                                <p>Tgl Realisasi :
                                    <?= date_format(new DateTime($data_progress->tanggal_rencana), "D / d M Y"); ?></p>
                            </div>
                            <div class="col-xs-3">
                                <p>Motif Kain : <?= $data_progress->motif; ?></p>
                            </div>
                            <div class="col-xs-3">
                                <p>Ditambahkan oleh : <?= $nama_admin->nama_admin; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 30px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle; width: 80px;">No</th>
                                                <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
                                                <th colspan="<?= $jumlah_bantal; ?>" class="text-center">
                                                    Jenis Bantal
                                                </th>
                                            </tr>
                                            <tr>
                                                <?php foreach ($jenis_bantal as $row) : ?>
                                                <th><?= $row->nama_jenis_bantal; ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($content as $row) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row->nama_pekerjaan; ?></td>
                                                <?php foreach ($jenis_bantal as $row2) : ?>
                                                <?php  ?>
                                                <td>
                                                    <?php if ($row2->id == $row->id_jenis_bantal) {
                                                                echo $row->qty;
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                </td>
                                                <?php endforeach ?>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <h4><b>Total</b></h4>
                                                </td>
                                                <?php foreach ($jenis_bantal as $row) : ?>
                                                <td><?php echo array_sum(array_column($total['bt' . $row->id], 'qty')) != 0 ? array_sum(array_column($total['bt' . $row->id], 'qty')) : '-'  ?>
                                                </td>
                                                <?php endforeach ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top: 30px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle; width: 80px;">No</th>
                                                <th rowspan="2" style="vertical-align: middle;">Ukuran</th>
                                                <th colspan="<?= $jumlah_bantal; ?>" class="text-center">
                                                    REALISASI
                                                </th>
                                            </tr>
                                            <tr>
                                                <?php foreach ($jenis_bantal as $row) : ?>
                                                <th><?= $row->nama_jenis_bantal; ?></th>
                                                <?php endforeach ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1 ?>
                                            <?php foreach ($content as $row) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row->nama_pekerjaan; ?></td>
                                                <?php foreach ($jenis_bantal as $row2) : ?>
                                                <?php  ?>
                                                <td>
                                                    <?php if ($row2->id == $row->id_jenis_bantal) {
                                                                echo $row->jumlah_realisasi;
                                                            } else if ($row->jumlah_realisasi == "") {
                                                                echo '';
                                                            } else {
                                                                echo '';
                                                            }
                                                            ?>
                                                </td>
                                                <?php endforeach ?>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <h4><b>Total</b></h4>
                                                </td>
                                                <?php foreach ($jenis_bantal as $row) : ?>
                                                <td><?php echo array_sum(array_column($total_perencanaan['realisasi' . $row->id], 'qty')) != 0 ? array_sum(array_column($total_perencanaan['realisasi' . $row->id], 'qty')) : '-'  ?>
                                                </td>
                                                <?php endforeach ?>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php //$this->load->view('pages/progress/table_realisasi'); 
                        ?>

                        <div class="body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <?php $no = 1; ?>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">ID Mitra</th>
                                                <th class="text-center">Nama Mitra</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($mitra as $row) { ?>
                                            <tr>
                                                <td class="text-center"><?= $no; ?></td>
                                                <td><?= $row->id_mitra; ?></td>
                                                <td><?= $row->nama_mitra; ?></td>
                                            </tr>
                                            <?php $no++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>