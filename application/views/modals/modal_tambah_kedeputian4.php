<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Laporan</h3>

  <form id="form-tambah-kedeputian4" method="POST">
    <input type="hidden" name="id_pengguna" value="<?php echo 5; ?>">
    <div class="form-group">
        <label>Bulan</label>
        <input class="form-control" type="month" name="bulan" id="bulan" required>
    </div>
    <div class="form-group">
        <label>Bentuk Pelayanan</label>
        <textarea class="form-control" type="text" name="bentuk_pelayanan" id="bentuk_pelayanan" required></textarea>
    </div>
    <div class="form-group">
        <label>Isi Pelayanan</label>
        <textarea class="form-control" type="text" name="isi_pelayanan" id="isi_pelayanan" required></textarea>
    </div>
    <div class="form-group">
        <label>Pelaksanaan Pelayanan</label>
        <textarea class="form-control" type="text" name="pelaksanaan_pelayanan" id="pelaksanaan_pelayanan" required></textarea>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <textarea class="form-control" type="text" name="keterangan" id="keterangan" required></textarea>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>
