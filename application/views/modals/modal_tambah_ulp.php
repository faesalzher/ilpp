<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Laporan</h3>

  <form id="form-tambah-ulp" method="POST">
    <div class="form-group">
        <label>Bulan</label>
        <input class="form-control" type="month" name="bulan" id="bulan" required>
    </div>
    <div class="form-group">
        <label>Pelaksana</label>
        <input class="form-control" type="text" name="pelaksana" id="pelaksana" required>
    </div>
    <div class="form-group">
        <label>Nomor Kontrak</label>
        <textarea class="form-control" type="text" name="kontrak" id="kontrak" required></textarea>
    </div>
    <div class="form-group">
        <label>Pekerjaan</label>
        <textarea class="form-control" type="text" name="pekerjaan" id="pekerjaan" required></textarea>
    </div>
    <div class="form-group">
        <label>Nilai Kontrak</label>
      <input class="form-control" type="number" name="nilai_kontrak" id="nilai_kontrak" required>
    </div>
    <div class="form-group">
        <label>Metode Pengadaan</label>
        <textarea class="form-control" type="text" name="metode" id="metode" required></textarea>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>
