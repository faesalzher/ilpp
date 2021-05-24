<?php
  $no = 1;
  foreach ($dataKedeputian7 as $kedeputian7) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kedeputian7->bentuk_pelayanan; ?></td>
      <td><?php echo $kedeputian7->isi_pelayanan; ?></td>
      <td><?php echo $kedeputian7->pelaksanaan_pelayanan; ?></td>
      <td><?php echo $kedeputian7->keterangan; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKedeputian7" data-id="<?php echo $kedeputian7->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataKedeputian7" data-id="<?php echo $kedeputian7->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
