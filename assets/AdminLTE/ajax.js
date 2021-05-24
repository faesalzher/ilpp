   $(document).ready(function () {

    daftar_notadinasmasuk();
    
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })


   function daftar_notadinasmasuk(){
    $.ajax({
      type  : 'ajax',
      url   : '<?php echo site_url('notadinasmasuk/pengadaan_dan_perlengkapan_data')?>',
      async : false,
      dataType : 'json',
      success : function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<tr>'+
          '<td>'+data[i].tanggal_direkap+'</td>'+
          '<td>'+data[i].no_nodin+'</td>'+
          '<td>'+data[i].pengirim_asal+'</td>'+
          '<td>'+data[i].perihal+'</td>'+
          '<td style="text-align:right;">'+

          '</td>'+
          '</tr>';
        }
        $('#show_data').html(html);
      }

    });
  }
