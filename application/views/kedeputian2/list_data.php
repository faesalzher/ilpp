<?php
  $no = 1;
  foreach ($dataKedeputian2 as $kedeputian2) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kedeputian2->bentuk_pelayanan; ?></td>
      <td><?php echo $kedeputian2->isi_pelayanan; ?></td>
      <td><?php echo $kedeputian2->pelaksanaan_pelayanan; ?></td>
      <td><?php echo $kedeputian2->keterangan; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKedeputian2" data-id="<?php echo $kedeputian2->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataKedeputian2" data-id="<?php echo $kedeputian2->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
