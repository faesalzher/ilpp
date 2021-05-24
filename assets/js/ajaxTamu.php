<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false
		});

	window.onload = function() {
		tampilTamu();
		tampilKedeputian();
		tampilInformasi();
		tampilInformasiWeb();
		tampilKegiatan();
		tampilUlp();

		tampilKedeputian1();
		tampilKedeputian2();
		tampilKedeputian3();
		tampilKedeputian4();
		tampilKedeputian5();
		tampilKedeputian6();
		tampilKedeputian7();
		<?php
            if ($this->session->flashdata('msg') != '') {
                echo "effect_msg();";
            }
        ?>
	}

	function refresh() {
		MyTable = $('#list-data').dataTable();
	}

	//tamu
	function tampilTamu() {
		$.get('<?php echo base_url('Bukutamu/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-tamu').html(data);
			refresh();
		});
	}

	var id_tamu;

	$(document).on("click", ".hapus-dataTamu", function() {
		id_tamu = $(this).attr("data-id");
		var id = id_tamu;

		Swal.fire({
		  title: 'Apakah anda yakin?',
		  text: "Data tidak bisa dikembalikan setelah dihapus!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
		  if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('Bukutamu/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilTamu()

				})
		    Swal.fire(
		      'Terhapus!',
		      'Data telah terhapus.',
		      'success'
		    )
		  }
		})
	})

	$(document).on("click", ".update-dataTamu", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Bukutamu/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-tamu').modal('show');
		})
	})

	$('#form-tambah-tamu').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Bukutamu/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilTamu();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-tamu").reset();
				$('#tambah-tamu').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-tamu', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Bukutamu/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilTamu();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-tamu").reset();
				$('#update-tamu').modal('hide');
				Swal.fire({
				  type: 'success',
				  title: 'Data berhasil di update',
				  showConfirmButton: false,
				  timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Bukutamu/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-tamu').html(data);
			refresh();
		})
	})

	$('#tambah-tamu').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-tamu').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//kedeputian
	function tampilKedeputian() {
		$.get('<?php echo base_url('Kedeputian/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian').html(data);
			refresh();
		});
	}

	var id_laporan_deputi;

	$(document).on("click", ".hapus-dataKedeputian", function() {
		id_laporan_deputi = $(this).attr("data-id");
		var id = id_laporan_deputi;

		Swal.fire({
		  title: 'Apakah anda Yakin?',
		  text: "Data tidak bisa dikembalikan setelah dihapus!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
		  if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('Kedeputian/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilKedeputian()

				})
		    Swal.fire(
		      'Terhapus!',
		      'Data telah terhapus.',
		      'success'
		    )
		  }
		})
	})

	$(document).on("click", ".update-dataKedeputian", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kedeputian').modal('show');
		})
	})

	$(document).on("click", ".detail-dataKedeputian", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('kedeputian/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-Kedeputian').modal('show');
		})
	})

	$('#form-tambah-kedeputian').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kedeputian").reset();
				$('#tambah-kedeputian').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kedeputian', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kedeputian").reset();
				$('#update-kedeputian').modal('hide');
				Swal.fire({
				  type: 'success',
				  title: 'Data berhasil di update',
				  showConfirmButton: false,
				  timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian').html(data);
			refresh();
		})
	})

	$('#tambah-kedeputian').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-kedeputian').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//ppid informasi
	function tampilInformasi() {
		$.get('<?php echo base_url('PpidInformasi/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-informasi').html(data);
			refresh();
		});
	}

	var id_laporan_info;

	$(document).on("click", ".hapus-dataInformasi", function() {
		id_laporan_info = $(this).attr("data-id");
		var id = id_laporan_info;

		Swal.fire({
		  title: 'Apakah anda Yakin?',
		  text: "Data tidak bisa dikembalikan setelah dihapus!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
		  if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('PpidInformasi/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilInformasi()

				})
		    Swal.fire(
		      'Terhapus!',
		      'Data telah terhapus.',
		      'success'
		    )
		  }
		})
	})

	$(document).on("click", ".update-dataInformasi", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('PpidInformasi/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-informasi').modal('show');
		})
	})

	$('#form-tambah-informasi').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('PpidInformasi/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilInformasi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-informasi").reset();
				$('#tambah-informasi').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-informasi', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('PpidInformasi/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

		tampilInformasi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-informasi").reset();
				$('#update-informasi').modal('hide');
				Swal.fire({
				  type: 'success',
				  title: 'Data berhasil di update',
				  showConfirmButton: false,
				  timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('PpidInformasi/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-informasi').html(data);
			refresh();
		})
	})

	$('#tambah-informasi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-informasi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//ppid informasi web
	function tampilInformasiWeb() {
		$.get('<?php echo base_url('PpidInformasiWeb/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-informasiWeb').html(data);
			refresh();
		});
	}

	var id_laporan_infoweb;

	$(document).on("click", ".hapus-dataInformasiWeb", function() {
		id_laporan_infoweb = $(this).attr("data-id");
		var id = id_laporan_infoweb;

		Swal.fire({
			title: 'Apakah anda Yakin?',
			text: "Data tidak bisa dikembalikan setelah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('PpidInformasiWeb/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilInformasiWeb()

				})
				Swal.fire(
					'Terhapus!',
					'Data telah terhapus.',
					'success'
				)
			}
		})
	})

	$(document).on("click", ".update-dataInformasiWeb", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('PpidInformasiWeb/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-informasiWeb').modal('show');
		})
	})

	$('#form-tambah-informasiWeb').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('PpidInformasiWeb/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilInformasiWeb();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-informasiWeb").reset();
				$('#tambah-informasiWeb').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-informasiWeb', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('PpidInformasiWeb/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

		tampilInformasiWeb();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-informasiWeb").reset();
				$('#update-informasiWeb').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data berhasil di update',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('PpidInformasiWeb/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-informasiWeb').html(data);
			refresh();
		})
	})

	$('#tambah-informasiWeb').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	$('#update-informasiWeb').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	//ppid kegiatan
	function tampilKegiatan() {
		$.get('<?php echo base_url('PpidKegiatan/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kegiatan').html(data);
			refresh();
		});
	}

	var id_laporan_rapat;

	$(document).on("click", ".hapus-dataKegiatan", function() {
		id_laporan_rapat = $(this).attr("data-id");
		var id = id_laporan_rapat;

		Swal.fire({
			title: 'Apakah anda Yakin?',
			text: "Data tidak bisa dikembalikan setelah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('PpidKegiatan/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilKegiatan()

				})
				Swal.fire(
					'Terhapus!',
					'Data telah terhapus.',
					'success'
				)
			}
		})
	})

	$(document).on("click", ".update-dataKegiatan", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('PpidKegiatan/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kegiatan').modal('show');
		})
	})

	$('#form-tambah-kegiatan').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('PpidKegiatan/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

		tampilKegiatan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kegiatan").reset();
				$('#tambah-kegiatan').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kegiatan', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('PpidKegiatan/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

		tampilKegiatan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kegiatan").reset();
				$('#update-kegiatan').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data berhasil di update',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('PpidKegiatan/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-kegiatan').html(data);
			refresh();
		})
	})

	$('#tambah-kegiatan').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	$('#update-kegiatan').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	//ulp
	function tampilUlp() {
		$.get('<?php echo base_url('Ulp/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-ulp').html(data);
			refresh();
		});
	}

	var id_laporan_pelayanan;

	$(document).on("click", ".hapus-dataUlp", function() {
		id_laporan_pelayanan = $(this).attr("data-id");
		var id = id_laporan_pelayanan;

		Swal.fire({
			title: 'Apakah anda Yakin?',
			text: "Data tidak bisa dikembalikan setelah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('Ulp/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilUlp()

				})
				Swal.fire(
					'Terhapus!',
					'Data telah terhapus.',
					'success'
				)
			}
		})
	})

	$(document).on("click", ".update-dataUlp", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Ulp/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-ulp').modal('show');
		})
	})

	$('#form-tambah-ulp').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Ulp/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

		tampilUlp();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-ulp").reset();
				$('#tambah-ulp').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-ulp', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Ulp/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

		tampilUlp();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-ulp").reset();
				$('#update-ulp').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data berhasil di update',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Ulp/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-ulp').html(data);
			refresh();
		})
	})

	$('#tambah-ulp').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	$('#update-ulp').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	//kedeputian 1
	function tampilKedeputian1() {
		$.get('<?php echo base_url('Kedeputian1/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian1').html(data);
			refresh();
		});
	}

	var id_laporan_deputi;

	$(document).on("click", ".hapus-dataKedeputian1", function() {
		id_laporan_deputi = $(this).attr("data-id");
		var id = id_laporan_deputi;

		Swal.fire({
		  title: 'Apakah anda Yakin?',
		  text: "Data tidak bisa dikembalikan setelah dihapus!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
		  if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('Kedeputian1/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilKedeputian1()

				})
		    Swal.fire(
		      'Terhapus!',
		      'Data telah terhapus.',
		      'success'
		    )
		  }
		})
	})

	$(document).on("click", ".update-dataKedeputian1", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian1/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kedeputian1').modal('show');
		})
	})

	$('#form-tambah-kedeputian1').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian1/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian1();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kedeputian1").reset();
				$('#tambah-kedeputian1').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kedeputian1', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian1/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian1();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kedeputian1").reset();
				$('#update-kedeputian1').modal('hide');
				Swal.fire({
				  type: 'success',
				  title: 'Data berhasil di update',
				  showConfirmButton: false,
				  timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian1/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian1').html(data);
			refresh();
		})
	})

	$('#tambah-kedeputian1').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-kedeputian1').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	//akhir kedeputian 1

	//kedeputian 2
	function tampilKedeputian2() {
		$.get('<?php echo base_url('Kedeputian2/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian2').html(data);
			refresh();
		});
	}

	var id_laporan_deputi;

	$(document).on("click", ".hapus-dataKedeputian2", function() {
		id_laporan_deputi = $(this).attr("data-id");
		var id = id_laporan_deputi;

		Swal.fire({
			title: 'Apakah anda Yakin?',
			text: "Data tidak bisa dikembalikan setelah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('Kedeputian2/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilKedeputian2()

				})
				Swal.fire(
					'Terhapus!',
					'Data telah terhapus.',
					'success'
				)
			}
		})
	})

	$(document).on("click", ".update-dataKedeputian2", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian2/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kedeputian2').modal('show');
		})
	})

	$('#form-tambah-kedeputian2').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian2/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian2();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kedeputian2").reset();
				$('#tambah-kedeputian2').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kedeputian2', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian2/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian2();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kedeputian2").reset();
				$('#update-kedeputian2').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data berhasil di update',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian2/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian2').html(data);
			refresh();
		})
	})

	$('#tambah-kedeputian2').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	$('#update-kedeputian2').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})
	//akhir kedeputian 2

	//kedeputian 3
	function tampilKedeputian3() {
		$.get('<?php echo base_url('Kedeputian3/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian3').html(data);
			refresh();
		});
	}

	var id_laporan_deputi;

	$(document).on("click", ".hapus-dataKedeputian3", function() {
		id_laporan_deputi = $(this).attr("data-id");
		var id = id_laporan_deputi;

		Swal.fire({
			title: 'Apakah anda Yakin?',
			text: "Data tidak bisa dikembalikan setelah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('Kedeputian3/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilKedeputian3()

				})
				Swal.fire(
					'Terhapus!',
					'Data telah terhapus.',
					'success'
				)
			}
		})
	})

	$(document).on("click", ".update-dataKedeputian3", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian3/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kedeputian3').modal('show');
		})
	})

	$('#form-tambah-kedeputian3').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian3/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian3();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kedeputian3").reset();
				$('#tambah-kedeputian3').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kedeputian3', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian3/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian3();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kedeputian3").reset();
				$('#update-kedeputian3').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data berhasil di update',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian3/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian3').html(data);
			refresh();
		})
	})

	$('#tambah-kedeputian3').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	$('#update-kedeputian3').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})
	//akhir kedeputian 3

	//kedeputian 4
	function tampilKedeputian4() {
		$.get('<?php echo base_url('Kedeputian4/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian4').html(data);
			refresh();
		});
	}

	var id_laporan_deputi;

	$(document).on("click", ".hapus-dataKedeputian4", function() {
		id_laporan_deputi = $(this).attr("data-id");
		var id = id_laporan_deputi;

		Swal.fire({
			title: 'Apakah anda Yakin?',
			text: "Data tidak bisa dikembalikan setelah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('Kedeputian4/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilKedeputian4()

				})
				Swal.fire(
					'Terhapus!',
					'Data telah terhapus.',
					'success'
				)
			}
		})
	})

	$(document).on("click", ".update-dataKedeputian4", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian4/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kedeputian4').modal('show');
		})
	})

	$('#form-tambah-kedeputian4').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian4/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian4();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kedeputian4").reset();
				$('#tambah-kedeputian4').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kedeputian4', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian4/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian4();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kedeputian4").reset();
				$('#update-kedeputian4').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data berhasil di update',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian4/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian4').html(data);
			refresh();
		})
	})

	$('#tambah-kedeputian4').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	$('#update-kedeputian4').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})
	//akhir kedeputian 4

	//kedeputian 5
	function tampilKedeputian5() {
		$.get('<?php echo base_url('Kedeputian5/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian5').html(data);
			refresh();
		});
	}

	var id_laporan_deputi;

	$(document).on("click", ".hapus-dataKedeputian5", function() {
		id_laporan_deputi = $(this).attr("data-id");
		var id = id_laporan_deputi;

		Swal.fire({
			title: 'Apakah anda Yakin?',
			text: "Data tidak bisa dikembalikan setelah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('Kedeputian5/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilKedeputian5()

				})
				Swal.fire(
					'Terhapus!',
					'Data telah terhapus.',
					'success'
				)
			}
		})
	})

	$(document).on("click", ".update-dataKedeputian5", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian5/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kedeputian5').modal('show');
		})
	})

	$('#form-tambah-kedeputian5').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian5/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian5();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kedeputian5").reset();
				$('#tambah-kedeputian5').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kedeputian5', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian5/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian5();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kedeputian5").reset();
				$('#update-kedeputian5').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data berhasil di update',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian5/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian5').html(data);
			refresh();
		})
	})

	$('#tambah-kedeputian5').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	$('#update-kedeputian5').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})
	//akhir kedeputian 5

	//kedeputian 6
	function tampilKedeputian6() {
		$.get('<?php echo base_url('Kedeputian6/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian6').html(data);
			refresh();
		});
	}

	var id_laporan_deputi;

	$(document).on("click", ".hapus-dataKedeputian6", function() {
		id_laporan_deputi = $(this).attr("data-id");
		var id = id_laporan_deputi;

		Swal.fire({
			title: 'Apakah anda Yakin?',
			text: "Data tidak bisa dikembalikan setelah dihapus!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					method: "POST",
					url: "<?php echo base_url('Kedeputian6/delete'); ?>",
					data: "id=" +id
				})
				.done(function(data) {
					$('#konfirmasiHapus').modal('hide');
					tampilKedeputian6()

				})
				Swal.fire(
					'Terhapus!',
					'Data telah terhapus.',
					'success'
				)
			}
		})
	})

	$(document).on("click", ".update-dataKedeputian6", function() {
		var id = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian6/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kedeputian6').modal('show');
		})
	})

	$('#form-tambah-kedeputian6').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian6/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian6();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kedeputian6").reset();
				$('#tambah-kedeputian6').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data sudah tersimpan',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kedeputian6', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kedeputian6/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKedeputian6();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kedeputian6").reset();
				$('#update-kedeputian6').modal('hide');
				Swal.fire({
					type: 'success',
					title: 'Data berhasil di update',
					showConfirmButton: false,
					timer: 1500
				})
			}
		})

		e.preventDefault();
	});

	$(document).on("click", ".tampilBulan", function() {
		var vtanggal = $('#vtanggal').val();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kedeputian6/tampil'); ?>",
			data: "vtanggal=" +vtanggal
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-kedeputian6').html(data);
			refresh();
		})
	})

	$('#tambah-kedeputian6').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})

	$('#update-kedeputian6').on('hidden.bs.modal', function () {
		$('.form-msg').html('');
	})
	//akhir kedeputian 6

		//kedeputian 7
		function tampilKedeputian7() {
			$.get('<?php echo base_url('Kedeputian7/tampil'); ?>', function(data) {
				MyTable.fnDestroy();
				$('#data-kedeputian7').html(data);
				refresh();
			});
		}

		var id_laporan_deputi;

		$(document).on("click", ".hapus-dataKedeputian7", function() {
			id_laporan_deputi = $(this).attr("data-id");
			var id = id_laporan_deputi;

			Swal.fire({
				title: 'Apakah anda Yakin?',
				text: "Data tidak bisa dikembalikan setelah dihapus!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, hapus!'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						method: "POST",
						url: "<?php echo base_url('Kedeputian7/delete'); ?>",
						data: "id=" +id
					})
					.done(function(data) {
						$('#konfirmasiHapus').modal('hide');
						tampilKedeputian7()

					})
					Swal.fire(
						'Terhapus!',
						'Data telah terhapus.',
						'success'
					)
				}
			})
		})

		$(document).on("click", ".update-dataKedeputian7", function() {
			var id = $(this).attr("data-id");

			$.ajax({
				method: "POST",
				url: "<?php echo base_url('Kedeputian7/update'); ?>",
				data: "id=" +id
			})
			.done(function(data) {
				$('#tempat-modal').html(data);
				$('#update-kedeputian7').modal('show');
			})
		})

		$('#form-tambah-kedeputian7').submit(function(e) {
			var data = $(this).serialize();

			$.ajax({
				method: 'POST',
				url: '<?php echo base_url('Kedeputian7/prosesTambah'); ?>',
				data: data
			})
			.done(function(data) {
				var out = jQuery.parseJSON(data);

				tampilKedeputian7();
				if (out.status == 'form') {
					$('.form-msg').html(out.msg);
					effect_msg_form();
				} else {
					document.getElementById("form-tambah-kedeputian7").reset();
					$('#tambah-kedeputian7').modal('hide');
					Swal.fire({
						type: 'success',
						title: 'Data sudah tersimpan',
						showConfirmButton: false,
						timer: 1500
					})
				}
			})

			e.preventDefault();
		});

		$(document).on('submit', '#form-update-kedeputian7', function(e){
			var data = $(this).serialize();

			$.ajax({
				method: 'POST',
				url: '<?php echo base_url('Kedeputian7/prosesUpdate'); ?>',
				data: data
			})
			.done(function(data) {
				var out = jQuery.parseJSON(data);

				tampilKedeputian7();
				if (out.status == 'form') {
					$('.form-msg').html(out.msg);
					effect_msg_form();
				} else {
					document.getElementById("form-update-kedeputian7").reset();
					$('#update-kedeputian7').modal('hide');
					Swal.fire({
						type: 'success',
						title: 'Data berhasil di update',
						showConfirmButton: false,
						timer: 1500
					})
				}
			})

			e.preventDefault();
		});

		$(document).on("click", ".tampilBulan", function() {
			var vtanggal = $('#vtanggal').val();

			$.ajax({
				method: "POST",
				url: "<?php echo base_url('Kedeputian7/tampil'); ?>",
				data: "vtanggal=" +vtanggal
			})
			.done(function(data) {
				MyTable.fnDestroy();
				$('#data-kedeputian7').html(data);
				refresh();
			})
		})

		$('#tambah-kedeputian7').on('hidden.bs.modal', function () {
			$('.form-msg').html('');
		})

		$('#update-kedeputian7').on('hidden.bs.modal', function () {
			$('.form-msg').html('');
		})
		//akhir kedeputian 7

</script>
