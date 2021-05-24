<?php
defined('BASEPATH') or exit('No direct script access allowed');

class error_akses extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
      $this->load->view('error');
}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
