<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->userdata->level == "1") {
            redirect('Bukutamu');
        } elseif ($this->userdata->level == "2") {
            redirect('Kedeputian');
        } elseif ($this->userdata->level == "3") {
            redirect('PpidInformasi');
        } elseif ($this->userdata->level == "4") {
            redirect('PpidInformasiWeb');
        } elseif ($this->userdata->level == "5") {
            redirect('PpidKegiatan');
        } elseif ($this->userdata->level == "6") {
            redirect('Ulp');
        } elseif ($this->userdata->level == "7") {
            redirect('Admin');
        }
    }
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
