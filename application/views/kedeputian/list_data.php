<?php
  $no = 1;
  foreach ($dataKedeputian as $kedeputian) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kedeputian->bentuk_pelayanan; ?></td>
      <td><?php echo $kedeputian->isi_pelayanan; ?></td>
      <td><?php echo $kedeputian->pelaksanaan_pelayanan; ?></td>
      <td><?php echo $kedeputian->keterangan; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKedeputian" data-id="<?php echo $kedeputian->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataKedeputian" data-id="<?php echo $kedeputian->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
