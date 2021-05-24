<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_informasi extends CI_Model {
	public function select_by_month($vbulan,$vtahun){
 		 $this->db->select('*');
 		 $this->db->from('laporan_informasi');
 		 $this->db->where('month(tanggal)',$vbulan);
 		 $this->db->where('year(tanggal)',$vtahun);

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM laporan_informasi WHERE id_laporan_info = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function insert($data) {
	$tanggal = $data['bulan'];
	$date  = strtotime($tanggal);
	$bulan = date('m',$date);
	$tahun  = date('Y',$date);
	$datefix = $tahun.'-'.$bulan.'-'.'01';
		$sql = "INSERT INTO laporan_informasi VALUES('','" .$data['bentuk_pelayanan'] ."','" .$data['isi_pelayanan'] ."','" .$data['pelaksanaan_pelayanan'] ."','" .$data['keterangan'] ."','".$datefix."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}


	public function update($data) {
		$tanggal = $data['ubah_bulan'];
		$date  = strtotime($tanggal);
		$bulan = date('m',$date);
		$tahun  = date('Y',$date);
		$datefix = $tahun.'-'.$bulan.'-'.'01';
		$sql = "UPDATE laporan_informasi SET tanggal='".$datefix."', bentuk_pelayanan='" .$data['ubah_bentuk_pelayanan'] ."', isi_pelayanan='" .$data['ubah_isi_pelayanan'] ."', pelaksanaan_pelayanan='" .$data['ubah_pelaksanaan_pelayanan'] ."', keterangan='" .$data['ubah_keterangan'] ."' WHERE id_laporan_info='" .$data['ubah_id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM laporan_informasi WHERE id_laporan_info='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function total_rows() {
		$vtanggal = new \DateTime('now');
		$vbulan = $vtanggal->format('m');
		$vtahun = $vtanggal->format('Y');
		$this->db->select('*');
		$this->db->from('laporan_informasi');
		$this->db->where('month(tanggal)',$vbulan);
		$this->db->where('year(tanggal)',$vtahun);
		$data = $this->db->get();

		return $data->num_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
