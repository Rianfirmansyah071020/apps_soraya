<div class="modal-header">
  <div class="row">
    <div class="col-xs-4">
      <h2><?= $progress->id; ?></h2>
    </div>
    <div class="col-xs-8">
      <?php if (checkStore($progress->id) > 0) : ?>
        <a href="<?= base_url("store/loadCetak?id=$progress->id") ?>" class="btn btn-danger waves-effect" style="float: right; margin-top:20px; margin-left: 10px;" target="_blank"><span style="margin-bottom: 30px;"><i class="material-icons">picture_as_pdf</i>&nbsp;&nbsp;Cetak</span></a>
        <a href="<?= base_url("store/edit_store_pekerjaan/$progress->id"); ?>" class="btn btn-warning waves-effect" style="float: right; margin-top:20px; margin-left: 10px;"><i class="material-icons">input</i>&nbsp;&nbsp;<span style="margin-bottom: 30px;">Edit Store Pekerjaan</span></a>
      <?php endif ?>
      <a href="<?= base_url("store/store_pekerjaan/$progress->id"); ?>" class="btn btn-info waves-effect" style="float: right; margin-top:20px;"><i class="material-icons">input</i>&nbsp;&nbsp;<span style="margin-bottom: 30px;">Store Pekerjaan</span></a>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <h5>Nama Motif : <?= $progress->motif; ?></h5>
    </div>
    <div class="col-xs-6">
      <h5 style="float: right;">Tanggal Perencanaan : <?= date_format(new DateTime($progress->tanggal), "d/m/Y"); ?></h5>
    </div>
  </div>
</div>
<div class="modal-body">
  <?php if ($content) : ?>
    <h5>Pekerjaan Yang Telah Disetor</h5>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Jenis Pekerjaan</th>
            <th>ID Mitra</th>
            <th>Nama Mitra</th>
            <th>Jumlah Set</th>
            <th>Jumlah Store</th>
            <th>Sisa Set</th>
            <th>Status Pekerjaan</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($content as $row) : ?>
            <tr>
              <th scope="row"><?= $no++; ?></th>
              <td><?= $row->nama_mitrawork; ?></td>
              <td><?= $row->id_mitra; ?></td>
              <td><?= $row->nama; ?></td>
              <td><?= $row->jumlah_set; ?></td>
              <td><?= isset($row->jumlah_store) ? $row->jumlah_store : '-'; ?></td>
              <td><?= ($row->jumlah_set - $row->jumlah_store) == 0 ? '-' : $row->jumlah_set - $row->jumlah_store ?></td>
              <td><?php
                  if ($row->status_pekerjaan == 'dikerjakan') { ?>
                  <span class="badge bg-pink" style="text-transform: capitalize;"><?= $row->status_pekerjaan; ?></span>
                <?php } else if ($row->status_pekerjaan == 'selesai') { ?>

                  <span class="badge bg-teal" style="text-transform: capitalize;"><?= $row->status_pekerjaan; ?></span>
                <?php } else { ?>
                  <span class="badge bg-orange" style="text-transform: capitalize;"><?= $row->status_pekerjaan; ?></span>
                <?php } ?>
              </td>
              <td><?= date_format(new DateTime($row->created_at), 'd/m/Y H:i'); ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    <br>
    <h5 class="text-danger">Pekerjaan Yang Belum Disetor</h5>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Jenis Pekerjaan</th>
            <th>ID Mitra</th>
            <th>Nama Mitra</th>
            <th>Jumlah Set</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($belum_setor as $row) :
          ?>
            <tr>
              <th scope="row"><?= $no++; ?></th>
              <td><?= $row->nama_mitrawork; ?></td>
              <td><?= $row->id_mitra; ?></td>
              <td><?= $row->nama; ?></td>
              <td><?= $row->jumlah_set; ?></td>
              <td><?= date_format(new DateTime($row->created_at), 'd/m/Y H:i'); ?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  <?php else : ?>
    <div class="text-center">
      <i class="material-icons" style="font-size: 120px;">face</i>
      <p>Belum ada pekerjaan mitra yang di store.</p>
    </div>
  <?php endif ?>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal">CLOSE</button>
</div>