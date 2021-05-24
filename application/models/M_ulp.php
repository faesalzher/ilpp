<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ulp extends CI_Model {
	public function select_by_month($vbulan,$vtahun){
 		 $this->db->select('*');
 		 $this->db->from('laporan_pelayanan_publik');
 		 $this->db->where('month(tanggal)',$vbulan);
 		 $this->db->where('year(tanggal)',$vtahun);

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM laporan_pelayanan_publik WHERE id_laporan_pelayanan = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function insert($data) {
		$tanggal = $data['bulan'];
		$date  = strtotime($tanggal);
		$bulan = date('m',$date);
		$tahun  = date('Y',$date);
		$datefix = $tahun.'-'.$bulan.'-'.'01';
		$sql = "INSERT INTO laporan_pelayanan_publik VALUES('','" .$data['pelaksana'] ."','" .$data['kontrak'] ."','" .$data['pekerjaan'] ."','" .$data['nilai_kontrak'] ."','" .$datefix."','" .$data['metode'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function update($data) {
		$tanggal = $data['ubah_bulan'];
		$date  = strtotime($tanggal);
		$bulan = date('m',$date);
		$tahun  = date('Y',$date);
		$datefix = $tahun.'-'.$bulan.'-'.'01';

		$sql = "UPDATE laporan_pelayanan_publik SET tanggal='" .$datefix."', pelaksana='" .$data['ubah_pelaksana'] ."', kontrak='" .$data['ubah_kontrak'] ."', pekerjaan='" .$data['ubah_pekerjaan'] ."', nilai_kontrak='" .$data['ubah_nilai_kontrak'] ."', metode='" .$data['ubah_metode'] ."' WHERE id_laporan_pelayanan='" .$data['ubah_id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM laporan_pelayanan_publik WHERE id_laporan_pelayanan='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function total_rows() {
		$vtanggal = new \DateTime('now');
		$vbulan = $vtanggal->format('m');
		$vtahun = $vtanggal->format('Y');
		$this->db->select('*');
		$this->db->from('laporan_pelayanan_publik');
		$this->db->where('month(tanggal)',$vbulan);
		$this->db->where('year(tanggal)',$vtahun);
		$data = $this->db->get();

		return $data->num_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
