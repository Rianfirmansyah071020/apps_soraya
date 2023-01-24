<?php if ($nav_title != 'mitra_out') : ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th>No Mitra</th>
                    <th>Nama</th>
                    <th>Tgl Lahir</th>
                    <th>Tgl Mulai Kerja</th>
                    <th>Durasi Kerja</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat</th>
                    <th>Status</th>
                    <?php if ($this->session->userdata('role') == 'admin') : ?>
                        <th>Action</th>
                    <?php endif ?>
                    <?php if ($this->session->userdata('role') == 'admin') : ?>
                        <th></th>
                    <?php endif ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($content as $row) : ?>
                    <tr>
                        <td><?= $row->id; ?></td>
                        <td><?= $row->nama; ?></td>
                        <td><?= tgl_indo($row->tgl_lahir); ?></td>
                        <td><?= tgl_indo($row->tgl_mulai_kerja); ?></td>
                        <?php
                        $waktuAwal = new DateTime($row->tgl_mulai_kerja . " 00:00:00");
                        $waktuSekarang = new DateTime();
                        $diff = date_diff($waktuAwal, $waktuSekarang);

                        if ($diff->m == 0 && $diff->y == 0) {
                            $durasi = 'Kurang dari sebulan';
                        } else if ($diff->y > 0) {
                            $durasi = $diff->y . ' tahun ' . $diff->m . ' bulan';
                        } else {
                            $durasi = $diff->m . ' bulan';
                        }
                        ?>

                        <td><?= $durasi; ?></td>
                        <td><?= $row->nohp; ?></td>
                        <td><?= $row->alamat; ?></td>
                        <td><?= ucfirst($row->jenis_kelamin); ?></td>
                        <td><?= ucfirst($row->tempat); ?></td>
                        <td><?php
                            if ($row->status_nikah == "belum_nikah") {
                                echo 'Belum Nikah';
                            } else if ($row->status_nikah == "janda") {
                                echo 'Janda';
                            } else if ($row->status_nikah == "duda") {
                                echo 'Duda';
                            } else {
                                echo 'Nikah';
                            }

                            ?></td>
                        <?php if ($this->session->userdata('role') == 'admin') : ?>
                            <td>
                                <?php if ($nav_title != 'mitra_out') : ?>
                                    <a href="<?= base_url("mitra/moveToMitraOut/$row->id") ?>" class="btn btn-danger" id="btn_out" data-id="<?= $row->id; ?>">Keluarkan</a>
                                <?php else : ?>
                                    <a href="<?= base_url("mitra/moveToMitra/$row->id") ?>" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin memasukkan kembali mitra ini?')">Masukkan</a>
                                <?php endif ?>
                            </td>
                        <?php endif ?>
                        <?php if ($this->session->userdata('role') == 'admin') : ?>
                            <th style="text-align: right;">
                                <?php if ($nav_title == 'mitra') : ?>
                                    <ul class="header-dropdown m-r--5" style="list-style: none;">
                                        <li class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons md-18" style="color: #999999;">more_vert</i>
                                            </a>
                                            <ul class="dropdown-menu pull-right" style="padding-left: 0px !important;">
                                                <li><a href="#" style="color: #009688;" id="btnAddPhoto" class="btnAddPhoto" data-idmitra="<?= $row->id; ?>" data-image="<?= isset($row->image) ? $row->image : "tidak_ada" ?>"><i class="material-icons md-18">add_a_photo</i>Tambah Foto</a></li>
                                                <li><a href="<?= base_url("mitra/generateIdCardDetail/$row->id"); ?>" style="color: #ff9800;" target="_blank"><i class="material-icons md-18">assignment_ind</i>Generate ID Card</a></li>
                                                <li><a href="<?= base_url("mitra/edit/$row->id"); ?>" style="color: #03A9F4;"><i class="material-icons md-18">create</i>Edit</a></li>
                                                <li><a href="<?= base_url("mitra/delete/$row->id"); ?>" style="color: #F44336;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="material-icons md-18">delete</i>Delete</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                <?php endif ?>
                            </th>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
                <tr>
                    <th>No Mitra</th>
                    <th>Nama</th>
                    <th>Tgl Mulai Kerja</th>
                    <th>Durasi Kerja</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Tgl Dikeluarkan</th>
                    <th>Alasan Keluar</th>
                    <?php if ($this->session->userdata('role') == 'admin') : ?>
                        <th>Action</th>
                    <?php endif ?>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($content as $row) : ?>
                    <tr>
                        <td><?= $row->id; ?></td>
                        <td><?= $row->nama; ?></td>

                        <td><?= tgl_indo($row->tgl_mulai_kerja); ?></td>
                        <?php
                        $waktuAwal = new DateTime($row->tgl_mulai_kerja . " 00:00:00");
                        $waktuSekarang = new DateTime();
                        $diff = date_diff($waktuAwal, $waktuSekarang);

                        if ($diff->m == 0) {
                            $durasi = 'Kurang dari sebulan';
                        } else {
                            $durasi = $diff->m . ' bulan';
                        }
                        ?>

                        <td><?= $durasi; ?></td>
                        <td><?= $row->nohp; ?></td>
                        <td><?= $row->alamat; ?></td>
                        <td><?= ucfirst($row->jenis_kelamin); ?></td>
                        <?php

                        $tgl_keluar = date_format(new DateTime($row->tgl_mitra_out), "Y-m-d");
                        ?>
                        <td><?= tgl_indo($tgl_keluar); ?></td>
                        <td>
                            <?php if ($row->status === "Lainnya") { ?>
                                <?php echo $row->keterangan; ?>
                            <?php  } else { ?>
                                <?php echo $row->status; ?>
                            <?php } ?>
                        </td>
                        <?php if ($this->session->userdata('role') == 'admin') : ?>
                            <td>
                                <?php if ($nav_title != 'mitra_out') : ?>
                                    <a href="<?= base_url("mitra/moveToMitraOut/$row->id") ?>" class="btn btn-danger" id="btn_out" data-id="<?= $row->id; ?>">Keluarkan</a>
                                <?php else : ?>
                                    <a href="<?= base_url("mitra/moveToMitra/$row->id") ?>" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin memasukkan kembali mitra ini?')">Masukkan</a>
                                <?php endif ?>
                            </td>
                        <?php endif ?>
                        <td style="text-align: right;">
                            <?php if ($nav_title == 'mitra') : ?>
                                <ul class="header-dropdown m-r--5" style="list-style: none;">

                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons md-18" style="color: #999999;">more_vert</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="<?= base_url("mitra/edit/$row->id"); ?>" style="color: #03A9F4;"><i class="material-icons md-18">create</i>Edit</a></li>
                                            <li><a href="javascript:void(0);" style="color: #F44336;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="material-icons md-18">delete</i>Delete</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php endif ?>
<div id="wadah_modal_to_mitra_out">
</div>