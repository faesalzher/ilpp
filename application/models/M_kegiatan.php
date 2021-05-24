
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kegiatan extends CI_Model {
	public function select_by_month($vbulan,$vtahun){
 		 $this->db->select('*');
 		 $this->db->from('laporan_rapat');
 		 $this->db->where('month(tanggal)',$vbulan);
 		 $this->db->where('year(tanggal)',$vtahun);

		$data = $this->db->get();

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM laporan_rapat WHERE id_laporan_rapat = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function insert($data) {
		$sql = "INSERT INTO laporan_rapat VALUES('','" .$data['tanggal'] ."','" .$data['kegiatan'] ."','" .$data['tempat'] ."','" .$data['pimpinan'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function update($data) {
		$sql = "UPDATE laporan_rapat SET tanggal='" .$data['ubah_tanggal'] ."', kegiatan='" .$data['ubah_kegiatan'] ."', tempat='" .$data['ubah_tempat'] ."', pimpinan ='" .$data['ubah_pimpinan'] ."' WHERE id_laporan_rapat='" .$data['ubah_id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM laporan_rapat WHERE id_laporan_rapat='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function total_rows() {
		$vtanggal = new \DateTime('now');
		$vbulan = $vtanggal->format('m');
		$vtahun = $vtanggal->format('Y');
		$this->db->select('*');
		$this->db->from('laporan_rapat');
		$this->db->where('month(tanggal)',$vbulan);
		$this->db->where('year(tanggal)',$vtahun);
		$data = $this->db->get();

		return $data->num_rows();
	}
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
