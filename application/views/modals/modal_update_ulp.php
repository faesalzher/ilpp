<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Update Data Laporan</h3>

  <?php $tanggal = $dataUlp->tanggal;
        $date  = strtotime($tanggal);
      		$bulan = date('m',$date);
      		$tahun  = date('Y',$date);
          $vbulan = $tahun.'-'.$bulan;
  ?>

  <form id="form-update-ulp" method="POST">
    <input type="hidden" name="ubah_id" value="<?php echo $dataUlp->id_laporan_pelayanan; ?>">
    <div class="form-group">
        <label>Bulan</label>
        <input class="form-control" type="month" name="ubah_bulan" id="ubah_bulan" value="<?php echo $vbulan; ?>" required>
    </div>
    <div class="form-group">
        <label>Pelaksana</label>
        <input class="form-control" type="text" name="ubah_pelaksana" id="ubah_pelaksana" value="<?php echo $dataUlp->pelaksana; ?>" required>
    </div>
    <div class="form-group">
        <label>Nomor Kontrak</label>
        <textarea class="form-control" type="text" name="ubah_kontrak" id="ubah_kontrak" required><?php echo $dataUlp->kontrak; ?></textarea>
    </div>
    <div class="form-group">
        <label>Pekerjaan</label>
        <textarea class="form-control" type="text" name="ubah_pekerjaan" id="ubah_pekerjaan" required><?php echo $dataUlp->pekerjaan; ?></textarea>
    </div>
    <div class="form-group">
        <label>Nilai Kontrak</label>
        <input class="form-control" type="number" name="ubah_nilai_kontrak" id="ubah_nilai_kontrak" value="<?php echo $dataUlp->nilai_kontrak; ?>" required>
    </div>
    <div class="form-group">
        <label>Metode Pengadaan</label>
        <textarea class="form-control" type="text" name="ubah_metode" id="ubah_metode" required><?php echo $dataUlp->metode; ?></textarea>
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Update Data</button>
      </div>
    </div>
  </form>
</div>
