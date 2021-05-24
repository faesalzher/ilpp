<?php
  $no = 1;
  foreach ($dataInformasi as $informasi) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $informasi->bentuk_pelayanan; ?></td>
      <td><?php echo $informasi->isi_pelayanan; ?></td>
      <td><?php echo $informasi->pelaksanaan_pelayanan; ?></td>
      <td><?php echo $informasi->keterangan; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataInformasi" data-id="<?php echo $informasi->id_laporan_info; ?>"><i class="glyphicon glyphicon-repeat"></i> Update</button>
          <button class="btn btn-danger hapus-dataInformasi" data-id="<?php echo $informasi->id_laporan_info; ?>"><i class="glyphicon glyphicon-remove-sign"></i> Delete</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>
