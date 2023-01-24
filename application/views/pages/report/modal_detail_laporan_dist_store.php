<div class="modal-header">
</div>
<div class="modal-body">
    <div class="table-detail-dist">
        <div class="table-responsive">
            <table class="table myDatTab">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Progress</th>
                        <th>Pekerjaan</th>
                        <th>Jumlah Store</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($detail as $row) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $row->id_progress; ?></td>
                            <td><?= $row->nama_mitrawork; ?></td>
                            <td><?= $row->jumlah_store; ?></td>
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