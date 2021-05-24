<?php
  $no = 1;
  foreach ($dataKedeputian3 as $kedeputian3) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kedeputian3->bentuk_pelayanan; ?></td>
      <td><?php echo $kedeputian3->isi_pelayanan; ?></td>
      <td><?php echo $kedeputian3->pelaksanaan_pelayanan; ?></td>
      <td><?php echo $kedeputian3->keterangan; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKedeputian3" data-id="<?php echo $kedeputian3->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataKedeputian3" data-id="<?php echo $kedeputian3->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
