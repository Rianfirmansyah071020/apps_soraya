<div class="modal-header">
    <div class="row">
        <div class="col-xs-6">
            <h2><?= $progress->id; ?></h2>

        </div>
        <div class="col-xs-6">
            <a href="<?= base_url("distribusi/loadCetak/$progress->id") ?>" class="btn btn-danger waves-effect" target="_blank" style="float: right; margin-top:20px;"><i class="material-icons">picture_as_pdf</i>&nbsp;&nbsp;<span style="margin-bottom: 30px;">Cetak</span></a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">

            <h5>Nama Motif : <?= $progress->motif; ?></h5>
        </div>
        <div class="col-xs-6">

            <h5 style="float: right;">Tanggal Perencanaan : <?= date_format(new DateTime($progress->tanggal), "d/m/Y"); ?></h5>
        </div>
    </div>

</div>
<div class="modal-body">
    <div class="table-detail-dist">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jenis Pekerjaan</th>
                        <th>ID Mitra</th>
                        <th>Nama Mitra</th>
                        <th>Jumlah Set</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php $no = 1;
                    foreach ($content as $row) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $row->nama_mitrawork; ?></td>
                            <td><?= $row->id_mitra; ?></td>
                            <td><?= $row->nama; ?></td>
                            <td><?= $row->jumlah_set; ?></td>
                            <td><?= date_format(new DateTime($row->created_at), 'd/m/Y H:i'); ?></td>
                            <td><button class="btn btn-danger" id="btnHapusDistribusi" data-id="<?= $row->id_distribusi; ?>" data-idprogress="<?= $row->id_progress; ?>">Hapus</button></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
</div>