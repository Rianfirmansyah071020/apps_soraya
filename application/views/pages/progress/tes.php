<div class="row clearfix">
    <div class="col-sm-4" style="margin-top: 20px;">
        <h2 class="card-inside-title">Pilih Jenis Pekerjaan</h2>
        <?= form_dropdown('id_jenis_pekerjaan', getDropdownList('jenis_pekerjaan', ['id', 'nama_pekerjaan']), '', ['class' => 'form-control show-tick']); ?>
    </div>
    <div class="col-sm-4" style="margin-top: 20px;">
        <h2 class="card-inside-title">Pilih Jenis Bantal</h2>
        <?= form_dropdown('id_jenis_bantal', getDropdownList('jenis_bantal', ['id', 'nama_jenis_bantal']), '', ['class' => 'form-control show-tick']); ?>
    </div>
    <div class="col-sm-12">
        <button class="btn btn-primary btn-lg waves-effect" style="float: right;" type="submit">SUBMIT</button>
    </div>
</div>