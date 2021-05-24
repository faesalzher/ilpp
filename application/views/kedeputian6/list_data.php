<?php
  $no = 1;
  foreach ($dataKedeputian6 as $kedeputian6) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kedeputian6->bentuk_pelayanan; ?></td>
      <td><?php echo $kedeputian6->isi_pelayanan; ?></td>
      <td><?php echo $kedeputian6->pelaksanaan_pelayanan; ?></td>
      <td><?php echo $kedeputian6->keterangan; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKedeputian6" data-id="<?php echo $kedeputian6->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataKedeputian6" data-id="<?php echo $kedeputian6->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
