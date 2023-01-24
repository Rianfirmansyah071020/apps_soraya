<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover myTable dataTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Jenis Bantal</th>
                <th>Keterangan</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($content as $row) : ?>

                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->nama_jenis_bantal; ?></td>
                    <td><?= $row->ket == "" ? "-" : $row->ket; ?></td>
                    <td>
                        <div class="text-center">
                            <a href="<?= base_url("bantal/edit/$row->id"); ?>" class="btn btn-info waves-effect">Edit</a>
                            <a class="btn btn-danger waves-effect" onclick="hapus()">Hapus</a>

                        </div>
                    </td>
                </tr>

            <?php endforeach ?>
        </tbody>
    </table>
</div>

<script>
    function hapus() {
        swal.fire({
            title: "Apakah anda yakin?",
            text: "Setelah dihapus, Anda tidak dapat mengembalikan data ini!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            // add href 
            icon: "warning",
            text: "Data akan dihapus!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= base_url("bantal/delete/$row->id"); ?>"
            } else {
                swal.fire("Batal", "Data batal dihapus", "error");
            }
        });
    }
</script>