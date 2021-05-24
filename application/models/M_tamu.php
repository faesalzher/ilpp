<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tamu extends CI_Model {
	public function select_by_month($vbulan,$vtahun){
 		 $this->db->select('*');
 		 $this->db->from('buku_tamu');
 		 $this->db->where('month(tanggal)',$vbulan);
 		 $this->db->where('year(tanggal)',$vtahun);

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM buku_tamu WHERE id_tamu = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function insert($data) {
		$sql = "INSERT INTO buku_tamu VALUES('','" .$data['tanggal'] ."','" .$data['keperluan'] ."','" .$data['kontak'] ."','" .$data['nama'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE buku_tamu SET tanggal='" .$data['ubah_tanggal'] ."', nama='" .$data['ubah_nama'] ."', keperluan='" .$data['ubah_keperluan'] ."', kontak='" .$data['ubah_kontak'] ."' WHERE id_tamu='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM buku_tamu WHERE id_tamu='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function total_rows() {
		$vtanggal = new \DateTime('now');
		$vbulan = $vtanggal->format('m');
		$vtahun = $vtanggal->format('Y');
		$this->db->select('*');
		$this->db->from('buku_tamu');
		$this->db->where('month(tanggal)',$vbulan);
		$this->db->where('year(tanggal)',$vtahun);
		$data = $this->db->get();

		return $data->num_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
