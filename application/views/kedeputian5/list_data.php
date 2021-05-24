<?php
  $no = 1;
  foreach ($dataKedeputian5 as $kedeputian5) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kedeputian5->bentuk_pelayanan; ?></td>
      <td><?php echo $kedeputian5->isi_pelayanan; ?></td>
      <td><?php echo $kedeputian5->pelaksanaan_pelayanan; ?></td>
      <td><?php echo $kedeputian5->keterangan; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKedeputian5" data-id="<?php echo $kedeputian5->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataKedeputian5" data-id="<?php echo $kedeputian5->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
