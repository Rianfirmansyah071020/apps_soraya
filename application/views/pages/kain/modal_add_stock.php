<div class="modal-header">
    <h4 class="modal-title">Tambah Stok Kain</h4>
</div>
<div class="modal-body">
    <form method="POST" action="<?= base_url("kain/add_stock"); ?>" enctype="multipart/form-data" id="formAddStock">
        <h2 class="card-inside-title" style="font-size: 16px;">Pilih Kain</h2>
        <select id="data_kain" class="form-control show-tick select2">
            <option></option>
            <?php foreach ($kain as $row) : ?>
                <option value="<?= $row->id; ?>"><?= $row->id ?>&nbsp;-&nbsp;<?= $row->nama; ?></option>
            <?php endforeach ?>
        </select>
        <div class="row stock-form-space">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
    <button type="button" class="btn btn-primary waves-effect btnSubmitAddStock">SUBMIT</button>
</div>