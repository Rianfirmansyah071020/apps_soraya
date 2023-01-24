<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Pekerjaan</th>
                <th>ID Mitra</th>
                <th>Nama Mitra</th>
                <th>Jumlah Set</th>
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
                    <td><?= $row->nama_satuan; ?></td>
                    <td><button class="btn btn-danger" id="btnHapusDistribusi" data-id="<?= $row->id_distribusi; ?>">Hapus</button></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>