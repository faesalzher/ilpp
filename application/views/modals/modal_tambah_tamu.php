<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Tambah Data Tamu</h3>

  <form id="form-tambah-tamu" method="POST">
    <div class="form-group">
        <label>Tanggal</label>
        <input class="form-control" type="date" name="tanggal" id="tanggal" required>
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input class="form-control" type="text" name="nama" id="nama" required>
    </div>
    <div class="form-group">
        <label>Keperluan</label>
        <input class="form-control" type="text" name="keperluan" id="keperluan" required>
    </div>
    <div class="form-group">
        <label>Kontak</label>
        <input class="form-control" type="text" name="kontak" id="kontak" required>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Tambah Data</button>
      </div>
    </div>
  </form>
</div>
