<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="row">
  <div class="col-md-3">
  </div>
  <div class="col-md-6">
    <div class="box box-success">
      <div class="box-header with-border">

        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
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
      <!-- /.box-body -->

    </div>
  </div>
