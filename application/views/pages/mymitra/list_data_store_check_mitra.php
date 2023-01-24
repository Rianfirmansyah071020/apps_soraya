<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>No DO</th>
                <th>Tanggal Penyerahan</th>
                <th>Jenis Pekerjaan</th>
                <th>Jumlah Set</th>
                <th>Jumlah Store</th>
                <th>Sisa Set</th>
                <th>Status Pekerjaan</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach ($content as $row) : ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->tanggal_store; ?></td>
                    <td><?= $row->nama_mitrawork; ?></td>
                    <td><?= $row->jumlah_set; ?></td>
                    <td>
                        <?php $percent = getPersentase($row->jumlah_store, $row->jumlah_set); ?>
                        <?php if ($percent < 100) : ?>
                            <span style="margin-top: -20px;"><?= $row->jumlah_store; ?></span>
                            <i class="material-icons md-18 m-l-10" style="color: #F44336;">arrow_downward</i>
                            <span style="color: #F44336;">(<?= $percent ?>%)</span>
                        <?php else : ?>
                            <span style="margin-top: -20px;"><?= $row->jumlah_store; ?></span>
                            <i class="material-icons md-18 m-l-10" style="color: #4CAF50;">done</i>
                            <span style="color: #4CAF50;">(<?= $percent ?>%)</span>
                        <?php endif ?>

                    </td>
                    <td>
                        <?php $sisa = $row->jumlah_set - $row->jumlah_store ?>
                        <?= $sisa; ?>
                        <?php if ($sisa != 0) : ?>
                            <i class="material-icons md-18 m-l-10" style="color: #F44336;">clear</i>
                        <?php endif ?>
                    </td>
                    <td><?= $row->status_pekerjaan; ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php $tes = $countSelesai; ?>