<?php
  $no = 1;
  foreach ($dataUlp as $ulp) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $ulp->pelaksana; ?></td>
      <td><?php echo $ulp->kontrak; ?></td>
      <td><?php echo $ulp->pekerjaan; ?></td>
      <td><?php echo $ulp->nilai_kontrak; ?></td>
      <td><?php echo $ulp->metode; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataUlp" data-id="<?php echo $ulp->id_laporan_pelayanan; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataUlp" data-id="<?php echo $ulp->id_laporan_pelayanan; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
