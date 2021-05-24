<?php
  $no = 1;
  foreach ($dataKedeputian1 as $kedeputian1) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kedeputian1->bentuk_pelayanan; ?></td>
      <td><?php echo $kedeputian1->isi_pelayanan; ?></td>
      <td><?php echo $kedeputian1->pelaksanaan_pelayanan; ?></td>
      <td><?php echo $kedeputian1->keterangan; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKedeputian1" data-id="<?php echo $kedeputian1->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataKedeputian1" data-id="<?php echo $kedeputian1->id_laporan_deputi; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
