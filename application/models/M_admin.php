<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
	public function update($data, $id_pengguna) {
		$this->db->where("id_pengguna", $id_pengguna);
		$this->db->update("pengguna", $data);

		return $this->db->affected_rows();
	}

	public function select($id_pengguna = '') {
		if ($id_pengguna != '') {
			$this->db->where('id_pengguna', $id_pengguna);
		}

		$data = $this->db->get('pengguna');

		return $data->row();
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */
