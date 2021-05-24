<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<?php
$vtanggal = new \DateTime('last day of this month');
$vbulan = $vtanggal->format('m');
$vtahun = $vtanggal->format('Y');
$hari = $vtanggal->format('d');
$vhari = ($hari - 4);
?>

<a><font color="red"><b>*Batas akhir input laporan pada tanggal <?php echo $vhari.'-'.$vbulan.'-'.$vtahun?></b></font></a>

<div class="box">
  <div class="box-header">
    <div class="form-group">
     <div class="pull-right input-group col-md-1">
        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
        <input type="month" id="vtanggal" class="form-control">
        <span class="input-group-btn">
        <button class="btn btn-success tampilBulan" type="button"><i class="fa fa-search fa-fw"></i> Tampilkan Laporan Bulan</button>
        </span>
     </div>
  </div>
  <div class="col-md-2">
      <button class="form-control btn btn-primary" data-toggle="modal" data-target="#tambah-ulp"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Data</button>
  </div>
    <div class="col-md-2">
      <button class="form-control btn btn-default" data-toggle="modal" data-target="#export-data"><i class="glyphicon glyphicon-floppy-save"></i> Export Data Excel</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Pelaksana</th>
          <th>Nomor Kontrak</th>
          <th>Pekerjaan</th>
          <th>Nilai Kontrak</th>
          <th>Metode Pengadaan</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="data-ulp">

      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_tambah_ulp;?>

<div id="tempat-modal"></div>

<?php
  $data['judul'] = 'Laporan';
  $data['url'] = 'Ulp/export';
  echo show_my_modal('modals/modal_exportUlp', 'export-data', $data);
?>
