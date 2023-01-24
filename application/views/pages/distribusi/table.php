<div class="table-responsive">
    <div class=" ">
        <strong>Perhatian!</strong> Mitra yang tidak aktif tidak ditampilkan di halaman Edit Pembagian Tugas, <br> akan tetapi tetap ditampilkan pada menu view.
    </div>

    <br>
    <table class="table table-bordered table-striped table-hover myTable dataTable">
        <thead>
            <tr>
                <th>No DO</th>
                <th>Motif</th>
                <th>Tanggal</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($content as $row) : ?>
                <?php if (checkRencana($row->id) > 0 && checkRealisasi($row->id) > 0) : ?>

                    <tr>
                        <td><?= $row->id; ?></td>
                        <td><?= $row->motif; ?></td>
                        <td><?= date_format(new DateTime($row->tanggal), "d/m/Y"); ?></td>
                        <!-- <td><?= date_format(new DateTime($row->tanggal), "H:i"); ?>&nbsp;WIB</td> -->
                        <td>
                            <div class="text-center">
                                <?php if (checkRealisasi($row->id) > 0) : ?>
                                    <a href="<?= base_url("distribusi/add_work/$row->id"); ?>" class="btn btn-info waves-effect">Tambah Pembagian Tugas</a>
                                <?php else : ?>
                                    <span class="col-deep-orange"><strong>Harap Tambahkan Realisasi Terlebih Dahulu!</strong></span>
                                <?php endif ?>
                                <?php if (checkDistribusi($row->id) > 0) : ?>
                                    <a href="#" class="btn btn-success waves-effect view" data-id="<?= $row->id; ?>">View</a>
                                    <a href="<?= base_url("distribusi/edit_distribusi/$row->id") ?>" class="btn btn-warning waves-effect" data-id="<?= $row->id; ?>">Edit Pembagian Tugas</a>
                                <?php endif ?>

                            </div>
                        </td>
                    </tr>
                <?php endif ?>
            <?php endforeach ?>
        </tbody>
    </table>
</div>