<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_informasiWeb extends CI_Model
{
    public function select_by_month($vbulan, $vtahun)
    {
        $this->db->select('*');
        $this->db->from('laporan_informasi_web');
        $this->db->where('month(tanggal)', $vbulan);
        $this->db->where('year(tanggal)', $vtahun);

        $data = $this->db->get();

        return $data->result();
    }

    public function select_by_id($id)
    {
        $sql = "SELECT * FROM laporan_informasi_web WHERE id_laporan_infoweb = '{$id}'";

        $data = $this->db->query($sql);

        return $data->row();
    }

    public function insert($data)
    {
        $sql = "INSERT INTO laporan_informasi_web VALUES('','" .$data['tanggal'] ."','" .$data['substansi'] ."')";

        $this->db->query($sql);

        return $this->db->affected_rows();
    }


    public function update($data)
    {
        $sql = "UPDATE laporan_informasi_web SET tanggal='" .$data['ubah_tanggal'] ."', substansi='" .$data['ubah_substansi'] ."'WHERE id_laporan_infoweb='" .$data['ubah_id'] ."'";

        $this->db->query($sql);

        return $this->db->affected_rows();
    }


    public function delete($id)
    {
        $sql = "DELETE FROM laporan_informasi_web WHERE id_laporan_infoweb='" .$id ."'";

        $this->db->query($sql);

        return $this->db->affected_rows();
    }

    public function total_rows()
    {
        $vtanggal = new \DateTime('now');
        $vbulan = $vtanggal->format('m');
        $vtahun = $vtanggal->format('Y');
        $this->db->select('*');
        $this->db->from('laporan_informasi_web');
        $this->db->where('month(tanggal)', $vbulan);
        $this->db->where('year(tanggal)', $vtahun);
        $data = $this->db->get();

        return $data->num_rows();
    }
}

/* End of file M_kota.php */
/* Location: ./application/models/M_kota.php */
