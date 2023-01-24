<div class="col-xs-5" id="id_mitra_<?= $mitra->id; ?>" style="margin-top: 20px;">
    <h2 class="card-inside-title" style="font-size: 14px;">Id Mitra</h2>
    <div class="form-group">
        <div class="form-line">
            <input type="text" class="form-control" id="id_mitra_<?= $mitra->id;  ?>" name="id_mitra[]" value="<?= $mitra->id; ?>" readonly />
        </div>
    </div>
</div>
<div class="col-xs-5" id="nama_mitra_<?= $mitra->id; ?>" style="margin-top: 20px;">
    <h2 class="card-inside-title" style="font-size: 14px;">Nama Mitra</h2>
    <div class="form-group">
        <div class="form-line">
            <input type="text" class="form-control" id="nama_kain" name="nama[]" value="<?= $mitra->nama; ?>" readonly />
        </div>
    </div>
</div>
<div class="col-xs-2" id="del_<?= $mitra->id; ?>" style="margin-top: 20px;">
    <div class="text-right">
        <button type="button" class="btn btn-danger waves-effect delete_selected_mitra_generate_id_card" data-id="<?= $mitra->id; ?>"><i class="material-icons">close</i></button>
    </div>
</div>