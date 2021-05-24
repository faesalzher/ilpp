<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Laporan</h3>

  <form id="form-update-kegiatan" method="POST">
    <input type="hidden" name="ubah_id" value="<?php echo $dataKegiatan->id_laporan_rapat; ?>">
    <div class="form-group">
        <label>Tanggal</label>
        <input class="form-control" type="date" name="ubah_tanggal" id="ubah_tanggal" value="<?php echo $dataKegiatan->tanggal; ?>" required>
    </div>
    <div class="form-group">
        <label>Kegiatan</label>
        <input class="form-control" type="text" name="ubah_kegiatan" id="ubah_kegiatan" value="<?php echo $dataKegiatan->kegiatan; ?>" required>
    </div>
    <div class="form-group">
        <label>Tempat</label>
        <input class="form-control" type="text" name="ubah_tempat" id="ubah_tempat" value="<?php echo $dataKegiatan->tempat; ?>" required>
    </div>
    <div class="form-group">
        <label>Pimpinan</label>
        <input class="form-control" type="text" name="ubah_pimpinan" id="ubah_pimpinan" value="<?php echo $dataKegiatan->pimpinan; ?>" required>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
