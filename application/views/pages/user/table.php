<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
        <thead>
            <tr>
                <th style="width: 20px;"></th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Is Active</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($content as $row) : ?>
                <tr>
                    <td>
                        <input type="checkbox" id="md_checkbox<?= $i ?>" class="filled-in chk-col-cyan check-item" name="id[]" value="<?= $row->id; ?>" />
                        <label for="md_checkbox<?= $i ?>"></label>
                    </td>
                    <td><?= $row->nama; ?></td>
                    <td><?= $row->username; ?></td>
                    <td><?= $row->role; ?></td>
                    <td><?= $row->is_active == 1 ? 'Active' : 'Not Active'; ?></td>
                    <td>
                        <div class="text-center">
                            <a href="<?= base_url("user/edit/$row->id"); ?>" class="btn btn-info waves-effect">Edit</a>
                            <a class="btn btn-danger waves-effect" onclick="hapus()">Hapus</a>
                        </div>
                    </td>
                </tr>
            <?php
                $i++;
            endforeach ?>
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
                window.location.href = "<?= base_url("user/delete/$row->id"); ?>"
            } else {
                swal.fire("Batal", "Data batal dihapus", "error");
            }
        });
    }
</script>