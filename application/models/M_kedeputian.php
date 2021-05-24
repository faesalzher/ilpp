<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kedeputian extends CI_Model {
	public function select_by_month($vbulan,$vtahun,$deputi){
 		 $this->db->select('*');
 		 $this->db->from('laporan_kedeputian');
 		 $this->db->where('month(tanggal)',$vbulan);
 		 $this->db->where('year(tanggal)',$vtahun);
		 $this->db->where('id_pengguna',$deputi);

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM laporan_kedeputian WHERE id_laporan_deputi = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_pegawai($id) {
		$sql = " SELECT pegawai.id AS id, pegawai.nama AS pegawai, pegawai.telp AS telp, kota.nama AS kota, kelamin.nama AS kelamin, posisi.nama AS posisi FROM pegawai, kota, kelamin, posisi WHERE pegawai.id_kelamin = kelamin.id AND pegawai.id_posisi = posisi.id AND pegawai.id_kota = kota.id AND pegawai.id_kota={$id}";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function insert($data) {
	$tanggal = $data['bulan'];
	$date  = strtotime($tanggal);
	$bulan = date('m',$date);
	$tahun  = date('Y',$date);
	$datefix = $tahun.'-'.$bulan.'-'.'01';
		$sql = "INSERT INTO laporan_kedeputian VALUES('','" .$data['bentuk_pelayanan'] ."','" .$data['isi_pelayanan'] ."','" .$data['pelaksanaan_pelayanan'] ."','" .$data['keterangan'] ."','" .$data['id_pengguna'] ."','".$datefix."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function update($data) {
		$tanggal = $data['ubah_bulan'];
		$date  = strtotime($tanggal);
		$bulan = date('m',$date);
		$tahun  = date('Y',$date);
		$datefix = $tahun.'-'.$bulan.'-'.'01';
		$sql = "UPDATE laporan_kedeputian SET tanggal='".$datefix."', bentuk_pelayanan='" .$data['ubah_bentuk_pelayanan'] ."', isi_pelayanan='" .$data['ubah_isi_pelayanan'] ."', pelaksanaan_pelayanan='" .$data['ubah_pelaksanaan_pelayanan'] ."', keterangan='" .$data['ubah_keterangan'] ."' WHERE id_laporan_deputi='" .$data['ubah_id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM laporan_kedeputian WHERE id_laporan_deputi='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function total_rows() {
		$vtanggal = new \DateTime('now');
		$vbulan = $vtanggal->format('m');
		$vtahun = $vtanggal->format('Y');
		$this->db->select('*');
		$this->db->from('laporan_kedeputian');
		$this->db->where('month(tanggal)',$vbulan);
		$this->db->where('year(tanggal)',$vtahun);
		$data = $this->db->get();

		return $data->num_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
