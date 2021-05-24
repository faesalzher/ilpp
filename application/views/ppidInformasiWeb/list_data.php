<?php
  $no = 1;
  foreach ($dataInformasiWeb as $informasi) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $informasi->tanggal; ?></td>
      <td><?php echo $informasi->substansi; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataInformasiWeb" data-id="<?php echo $informasi->id_laporan_infoweb; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataInformasiWeb" data-id="<?php echo $informasi->id_laporan_infoweb; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
