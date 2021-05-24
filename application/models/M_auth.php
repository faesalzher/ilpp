<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
	public function login($user, $pass) {
		$data = $this->db->join('akses', 'akses.id_akses = pengguna.id_akses')
				->where('username', $user)
				->where('password', md5($pass))
				->get('pengguna');

		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}
}

/* End of file M_auth.php */
/* Location: ./application/models/M_auth.php */
