<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Laporan</h3>

  <form id="form-tambah-informasiWeb" method="POST">
    <div class="form-group">
        <label>Tanggal</label>
        <input class="form-control" type="date" name="tanggal" id="tanggal" required>
    </div>
    <div class="form-group">
        <label>Substansi</label>
        <textarea class="form-control" type="text" name="substansi" id="substansi" required></textarea>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>
