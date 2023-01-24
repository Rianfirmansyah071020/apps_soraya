<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover myTable dataTable">
        <thead>
            <tr>
                <th>Kode Kain</th>
                <th>Jenis</th>
                <th>Vendor</th>
                <th>Nama Kain</th>
                <th>Stok</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>
                <tr>
                    <td><?= $row->id; ?></td>
                    <td><?= $row->jenis; ?></td>
                    <td><?= $row->vendor == "" ? "-" : $row->vendor; ?></td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->stok; ?></td>
                    <td>
                        <div class="text-center">
                            <a href="<?= base_url("kain/edit/$row->id"); ?>" class="btn btn-info waves-effect">Edit</a>
                            <a href="<?= base_url("kain/delete/$row->id"); ?>" class="btn btn-danger waves-effect" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>

                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>