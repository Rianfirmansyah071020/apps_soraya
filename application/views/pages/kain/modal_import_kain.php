<div class="modal-header">
    <h4 class="modal-title">Import Data Excel</h4>
</div>
<div class="modal-body">
    <form method="POST" action="<?= base_url("kain/import"); ?>" enctype="multipart/form-data" id="formImport">
        <div class="form-group">
            <label for="import_kain">Pilih File Excel</label>
            <input type="file" class="form-control-file" name="upload_file" id="import_kain">
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
    <button type="button" class="btn btn-primary waves-effect btnSubmitImportKain">SUBMIT</button>
</div>