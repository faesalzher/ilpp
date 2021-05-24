?php
  $no = 1;
  foreach ($dataTamu as $tamu) {
      ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $tamu->tanggal; ?></td>
      <td><?php echo $tamu->nama; ?></td>
      <td><?php echo $tamu->keperluan; ?></td>
      <td><?php echo $tamu->kontak; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataTamu" data-id="<?php echo $tamu->id_tamu; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataTamu" data-id="<?php echo $tamu->id_tamu; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
          <button class="btn btn-info detail-dataTamu" data-id="<?php echo $tamu->id_tamu; ?>"><i class="glyphicon glyphicon-info-sign"></i> Detail</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
