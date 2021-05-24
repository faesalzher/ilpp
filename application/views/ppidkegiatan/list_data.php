<?php
  $no = 1;
  foreach ($dataKegiatan as $kegiatan) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $kegiatan->tanggal; ?></td>
      <td><?php echo $kegiatan->kegiatan; ?></td>
      <td><?php echo $kegiatan->tempat; ?></td>
      <td><?php echo $kegiatan->pimpinan; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataKegiatan" data-id="<?php echo $kegiatan->id_laporan_rapat; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataKegiatan" data-id="<?php echo $kegiatan->id_laporan_rapat; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
