<?php
$vtanggal = new \DateTime('last day of this month');
$vbulan = $vtanggal->format('F');
$vtahun = $vtanggal->format('Y');
?>

<div class="row">
  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $jml_informasi; ?></h3>

        <p>Jumlah Laporan Bulan <?php echo $vbulan.' '.$vtahun?></p>
        <p>Bidang PPID - Permintaan Informasi</p>

      </div>
      <div class="icon">
        <i class="ion ion-ios-paper-outline"></i>
      </div>
      <a href="<?php echo base_url('PpidInformasi') ?>" class="small-box-footer">Lihat laporan <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $jml_informasiWeb; ?></h3>

        <p>Jumlah Laporan Bulan <?php echo $vbulan.' '.$vtahun?></p>
        <p>Bidang PPID - Permintaan Informasi Melalui Web</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-paper-outline"></i>
      </div>
      <a href="<?php echo base_url('PpidInformasiWeb') ?>" class="small-box-footer">Lihat laporan <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $jml_kegiatan; ?></h3>

        <p>Jumlah Laporan Bulan <?php echo $vbulan.' '.$vtahun?></p>
        <p>Bidang PPID - Kegiatan Rapat Kemenko Polhukam</p>

      </div>
      <div class="icon">
        <i class="ion ion-ios-paper-outline"></i>
      </div>
      <a href="<?php echo base_url('PpidKegiatan') ?>" class="small-box-footer">Lihat laporan <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo $jml_ulp; ?></h3>

        <p>Jumlah Laporan Bulan <?php echo $vbulan.' '.$vtahun?></p>
        <p>Bidang ULP</p>

      </div>
      <div class="icon">
        <i class="ion ion-ios-paper-outline"></i>
      </div>
      <a href="<?php echo base_url('Ulp') ?>" class="small-box-footer">Lihat laporan <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo $jml_kedeputian; ?></h3>

        <p>Jumlah Laporan Bulan <?php echo $vbulan.' '.$vtahun?></p>
        <p>Bidang Pelayanan Fungsional Kedeputian</p>

      </div>
      <div class="icon">
        <i class="ion ion-ios-paper-outline"></i>
      </div>
      <a href="<?php echo base_url('Admin/PilihDeputi') ?>" class="small-box-footer">Lihat laporan <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h3><?php echo $jml_tamu; ?></h3>

        <p>Jumlah Tamu</p>
        <p>Bulan <?php echo $vbulan.' '.$vtahun?><p>

      </div>
      <div class="icon">
        <i class="ion ion-ios-contact-outline"></i>
      </div>
      <a href="<?php echo base_url('Bukutamu/data_tamu') ?>" class="small-box-footer">Lihat laporan <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-red">
      <div class="inner">
        <h1>Unduh Laporan</h1>
      </div>
      <div class="icon">
        <i class="ion ion-ios-paper"></i>
      </div>
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#export-data"><i class="glyphicon glyphicon-floppy-save"></i></button>
    </div>
  </div>
</div>

<?php
  $data['judul'] = 'Pelayanan Publik';
  $data['url'] = 'Admin/export';
  echo show_my_modal('modals/modal_exportAdmin', 'export-data', $data);
?>
