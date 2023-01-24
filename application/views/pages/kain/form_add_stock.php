<div class="col-xs-4" style="margin-top: 20px;">
    <h2 class="card-inside-title" style="font-size: 14px;">Kode Kain</h2>
    <div class="form-group">
        <div class="form-line">
            <input type="text" class="form-control" id="id_kain_<?= $get_kain->id;  ?>" name="id[]" value="<?= $get_kain->id; ?>" readonly />
        </div>
    </div>
</div>
<div class="col-xs-4" style="margin-top: 20px;">
    <h2 class="card-inside-title" style="font-size: 14px;">Nama Kain</h2>
    <div class="form-group">
        <div class="form-line">
            <input type="text" class="form-control" id="nama_kain" name="nama[]" value="<?= $get_kain->nama; ?>" readonly />
        </div>
    </div>
</div>

<div class="col-xs-4" style="margin-top: 20px;">
    <h2 class="card-inside-title" style="font-size: 14px;">Stok</h2>
    <div class="form-group">
        <div class="form-line">
            <input type="number" class="form-control" id="stok_kain" name="stok[]" required />
        </div>
    </div>
</div>