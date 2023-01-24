<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover myTable dataTable">
        <thead>
            <tr>
                <th>No DO</th>
                <th>Motif</th>
                <th>Tanggal</th>
                <th>Preoder</th>
                <th>Preorder Detail</th>
                <th>Estimasi</th>
                <th class="text-center">Action</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($content as $row) : ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->motif; ?></td>
                    <td><?= date_format(new DateTime($row->tanggal), "d/m/Y"); ?></td>
                    <td>
                        <?php
                        if ($row->is_preorder == 1) {
                            echo '<span class="label bg-green">Preorder</span>';
                        } else {
                            echo '';
                        }
                        ?>
                    </td>
                    <td>
                        <?php

                        if ($row->id_toko != null && $row->keterangan == null) {
                            echo $row->nama_toko;
                        } else if ($row->id_toko != null && $row->keterangan != null) {
                            echo $row->nama_toko . ' <br> ' . 'Ket: ' . $row->keterangan;
                        } else if ($row->id_toko == null && $row->keterangan != null) {
                            echo 'Ket: ' . $row->keterangan;
                        } else {
                            echo '';
                        }
                        ?>
                    </td>
                    <td><?= $row->estimasi; ?></td>
                    <!-- <td><?= date_format(new DateTime($row->tanggal), "H:i"); ?>&nbsp;WIB</td> -->
                    <td>
                        <div class="text-center">
                            <a href="<?= base_url("progress/add_plan/$row->id"); ?>" class="btn btn-info waves-effect">Tambah Perencanaan</a>
                            <?php if (checkRencana($row->id) > 0) : ?>
                                <!-- <a href="<?= base_url("progress/edit_plan/$row->id"); ?>" class="btn btn-success waves-effect">Ubah Perencanaan</a> -->
                                <a href="<?= base_url("progress/loadCetak/$row->id"); ?>" target="_blank" class="btn btn-danger waves-effect">Cetak</a>
                                <!-- <a href="<?= base_url("progress/excel/$row->id"); ?>" target="_blank" class="btn btn-danger waves-effect">tes excel</a> -->
                                <a href="<?= base_url("progress/edit_plan/$row->id"); ?>" class="btn btn-warning waves-effect">Edit Perencanaan</a>
                                <a href="<?= base_url("progress/show_delete/$row->id"); ?>" class="btn btn-danger waves-effect">Hapus Perencanaan</a>
                            <?php endif ?>
                        </div>
                    </td>
                    <th style="text-align: right;">
                        <ul class="header-dropdown m-r--5" style="list-style: none;">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons md-18" style="color: #999999;">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right" style="padding-left: 0px !important;">
                                    <li><a href="<?= base_url("progress/edit/$row->id"); ?>" style="color: #03A9F4;"><i class="material-icons md-18">create</i>Edit Progress</a></li>
                                    <li><a href="<?= base_url("progress/delete/$row->id"); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" style="color: #f4433c;"><i class="material-icons md-18">delete</i>Delete Progress</a></li>
                                </ul>
                            </li>
                        </ul>
                    </th>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>