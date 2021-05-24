<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Laporan</h3>

  <form id="form-update-informasiWeb" method="POST">
    <input type="hidden" name="ubah_id" value="<?php echo $dataInformasiWeb->id_laporan_infoweb; ?>">
    <div class="form-group">
        <label>Tanggal</label>
        <input class="form-control" type="date" name="ubah_tanggal" id="ubah_tanggal" value="<?php echo $dataInformasiWeb->tanggal; ?>" required>
    </div>
    <div class="form-group">
        <label>Substansi</label>
        <textarea class="form-control" type="text" name="ubah_substansi" id="ubah_substansi" required><?php echo $dataInformasiWeb->substansi; ?></textarea>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
