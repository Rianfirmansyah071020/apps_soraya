<div class="modal-header">

    <h4 class="modal-title">Lihat Tugas Mitra</h4>
</div>
<div class="modal-body">

    <form method="GET" action="<?= base_url("distribusi/lihatTugasMitra"); ?>" enctype="multipart/form-data" id="formGenerateIdCard">
        <h2 class="card-inside-title" style="font-size: 16px;">Pilih Mitra</h2>
        <select id="data_mitra" class="form-control show-tick select2">
            <option></option>
            <?php foreach ($mitra as $row) : ?>
                <option value="<?= $row->id; ?>"><?= $row->id ?>&nbsp;-&nbsp;<?= $row->nama; ?></option>
            <?php endforeach ?>
        </select>


    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
    <button type="button" class="btn btn-primary waves-effect btnSubmitLihatTugasMitra">LIHAT</button>
</div>