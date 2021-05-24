<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Laporan</h3>

  <?php $tanggal = $dataKedeputian7->tanggal;
        $date  = strtotime($tanggal);
      		$bulan = date('m',$date);
      		$tahun  = date('Y',$date);
          $vbulan = $tahun.'-'.$bulan;
  ?>

  <form id="form-update-kedeputian7" method="POST">
    <input type="hidden" name="ubah_id" value="<?php echo $dataKedeputian7->id_laporan_deputi; ?>">
    <div class="form-group">
        <label>Bulan</label>
        <input class="form-control" type="month" name="ubah_bulan" id="ubah_bulan" value="<?php echo $vbulan; ?>" required>
    </div>
    <div class="form-group">
        <label>Bentuk Pelayanan</label>
        <textarea class="form-control" type="text" name="ubah_bentuk_pelayanan" id="ubah_bentuk_pelayanan" required><?php echo $dataKedeputian7->bentuk_pelayanan; ?></textarea>
    </div>
    <div class="form-group">
        <label>Isi Pelayanan</label>
        <textarea class="form-control" type="text" name="ubah_isi_pelayanan" id="ubah_isi_pelayanan" required><?php echo $dataKedeputian7->isi_pelayanan; ?></textarea>
    </div>
    <div class="form-group">
        <label>Pelaksanaan Pelayanan</label>
        <textarea class="form-control" type="text" name="ubah_pelaksanaan_pelayanan" id="ubah_pelaksanaan_pelayanan" required><?php echo $dataKedeputian7->pelaksanaan_pelayanan; ?></textarea>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <textarea class="form-control" type="text" name="ubah_keterangan" id="ubah_keterangan" required><?php echo $dataKedeputian7->keterangan; ?></textarea>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
