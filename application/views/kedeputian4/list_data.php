<?php
  $no = 1;
  foreach ($dataKedeputian4 as $kedeputian4) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kedeputian4->bentuk_pelayanan; ?></td>
      <td><?php echo $kedeputian4->isi_pelayanan; ?></td>
      <td><?php echo $kedeputian4->pelaksanaan_pelayanan; ?></td>
      <td><?php echo $kedeputian4->keterangan; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKedeputian4" data-id="<?php echo $kedeputian4->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataKedeputian4" data-id="<?php echo $kedeputian4->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
