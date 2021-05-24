<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Tamu</h3>

  <form id="form-update-tamu" method="POST">
    <input type="hidden" name="id" value="<?php echo $dataTamu->id_tamu; ?>">
    <div class="form-group">
        <label>Tanggal</label>
        <input class="form-control" type="date" name="ubah_tanggal" id="ubah_tanggal"  value="<?php echo $dataTamu->tanggal; ?>" required>
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input class="form-control" type="text" name="ubah_nama" id="ubah_nama"  value="<?php echo $dataTamu->nama; ?>" required>
    </div>
    <div class="form-group">
        <label>Keperluan</label>
        <input class="form-control" type="text" name="ubah_keperluan" id="ubah_keperluan"  value="<?php echo $dataTamu->keperluan; ?>" required>
    </div>
    <div class="form-group">
        <label>Kontak</label>
        <input class="form-control" type="text" name="ubah_kontak" id="ubah_kontak"  value="<?php echo $dataTamu->kontak; ?>" required>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
