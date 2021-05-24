<?php
set_time_limit(1000);
defined('BASEPATH') or exit('No direct script access allowed');

//call the autoload
require 'vendor/autoload.php';
//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Kedeputian extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kedeputian');
    }

    public function index()
    {
        if ($this->userdata->level == "2") {
            $data['userdata'] 	= $this->userdata;
            $data['page'] 		= "Laporan Kedeputian";
            $data['judul'] 		= "Bidang Pelayanan Fungsional Kedeputian";
            $data['deskripsi'] 	= "Input Laporan";

            $data['modal_tambah_kedeputian'] = show_my_modal('modals/modal_tambah_kedeputian', 'tambah-kedeputian', $data);

            $this->template->views('kedeputian/home', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function tampil()
    {
        if ($this->userdata->level == "2") {
            if (isset($_POST['vtanggal']) && ! empty($_POST['vtanggal'])) {
                $vtanggal=$this->input->post('vtanggal');
                $date  = strtotime($vtanggal);
                $vbulan = date('m', $date);
                $vtahun  = date('Y', $date);
            } else {
                $vtanggal = new \DateTime('now');
                $vbulan = $vtanggal->format('m');
                $vtahun = $vtanggal->format('Y');
            }
            $deputi = $this->userdata->id_pengguna;
            $data['dataKedeputian']=$this->M_kedeputian->select_by_month($vbulan, $vtahun, $deputi);
            $this->load->view('kedeputian/list_data', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function prosesTambah()
    {
        if ($this->userdata->level == "2") {
            $this->form_validation->set_rules('id_pengguna', 'Id_pengguna', 'trim|required');
            $this->form_validation->set_rules('bulan', 'Bulan', 'trim|required');
            $this->form_validation->set_rules('bentuk_pelayanan', 'Bentuk Pelayanan', 'trim|required');
            $this->form_validation->set_rules('isi_pelayanan', 'Isi Pelayanan', 'trim|required');
            $this->form_validation->set_rules('pelaksanaan_pelayanan', 'Pelaksanaan Pelayanan', 'trim|required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

            $data 	= $this->input->post();
            if ($this->form_validation->run() == true) {
                $result = $this->M_kedeputian->insert($data);

                if ($result > 0) {
                    $out['status'] = '';
                    $out['msg'] = show_succ_msg('Data Laporan Berhasil ditambahkan', '20px');
                } else {
                    $out['status'] = '';
                    $out['msg'] = show_err_msg('Data Laporan Gagal ditambahkan', '20px');
                }
            } else {
                $out['status'] = 'form';
                $out['msg'] = show_err_msg(validation_errors());
            }

            echo json_encode($out);
        } else {
            redirect('error_akses');
        }
    }

    public function update()
    {
        if ($this->userdata->level == "2") {
            $data['userdata'] 	= $this->userdata;
            $id 				= trim($_POST['id']);
            $data['dataKedeputian'] 	= $this->M_kedeputian->select_by_id($id);

            echo show_my_modal('modals/modal_update_kedeputian', 'update-kedeputian', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function prosesUpdate()
    {
        if ($this->userdata->level == "2") {
            $this->form_validation->set_rules('ubah_id', 'Id', 'trim|required');
            $this->form_validation->set_rules('ubah_bulan', 'Bulan', 'trim|required');
            $this->form_validation->set_rules('ubah_bentuk_pelayanan', 'Bentuk Pelayanan', 'trim|required');
            $this->form_validation->set_rules('ubah_isi_pelayanan', 'Isi Pelayanan', 'trim|required');
            $this->form_validation->set_rules('ubah_pelaksanaan_pelayanan', 'Pelaksanaan Pelayanan', 'trim|required');
            $this->form_validation->set_rules('ubah_keterangan', 'Keterangan', 'trim|required');

            $data 	= $this->input->post();
            if ($this->form_validation->run() == true) {
                $result = $this->M_kedeputian->update($data);

                if ($result > 0) {
                    $out['status'] = '';
                    $out['msg'] = show_succ_msg('Data Laporan Berhasil ditambahkan', '20px');
                } else {
                    $out['status'] = '';
                    $out['msg'] = show_err_msg('Data Laporan Gagal ditambahkan', '20px');
                }
            } else {
                $out['status'] = 'form';
                $out['msg'] = show_err_msg(validation_errors());
            }
            echo json_encode($out);
        } else {
            redirect('error_akses');
        }
    }

    public function delete()
    {
        if ($this->userdata->level == "2") {
            $id = $_POST['id'];
            $result = $this->M_kedeputian->delete($id);
        } else {
            redirect('error_akses');
        }
    }

    public function export()
    {
        if ($this->userdata->level == "2") {
          //load template
          //load from xlsx template
          $reader = IOFactory::createReader('Xlsx');
          $spreadsheet = $reader->load("template.xlsx");

          //Add the content
          //data from database
          $connection = mysqli_connect('localhost', 'root', '', 'db_ilpp');
          if (!$connection) {
              exit("database connection error");
          }

          if (isset($_POST['vtanggal']) && ! empty($_POST['vtanggal'])) {
              $vtanggal=$this->input->post('vtanggal');
              $date  = strtotime($vtanggal);
              $vbulan = date('m', $date);
              $vtahun  = date('Y', $date);
          } else {
              $vtanggal = new \DateTime('now');
              $vbulan = $vtanggal->format('m');
              $vtahun = $vtanggal->format('Y');
          }
          $deputi = $this->userdata->id_pengguna;
          $data=  mysqli_query($connection, "SELECT * FROM laporan_kedeputian  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."' AND id_pengguna = '.$deputi.' ");
          //loop the dataTamu

          if($deputi == 2){
            $contentStartRow = 52;
            $currentContentRow = 52;
          }elseif ($deputi == 3) {
            $contentStartRow = 54;
            $currentContentRow = 54;
          }elseif ($deputi == 4) {
            $contentStartRow = 56;
            $currentContentRow = 56;
          }elseif ($deputi == 5) {
            $contentStartRow = 58;
            $currentContentRow = 58;
          }elseif ($deputi == 6) {
            $contentStartRow = 60;
            $currentContentRow = 60;
          }elseif ($deputi == 7) {
            $contentStartRow = 62;
            $currentContentRow = 62;
          }elseif ($deputi == 8) {
            $contentStartRow = 64;
            $currentContentRow = 64;
          }

          $no = 0;
          while ($item=mysqli_fetch_array($data)) {
              // insert a row after current row (before current row + 1)
              $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

              //fill the cell with data
              $spreadsheet->getActiveSheet()
              ->setCellValue('B'.$currentContentRow, ++$no)
              ->setCellValue('C'.$currentContentRow, $item['bentuk_pelayanan'])
              ->setCellValue('D'.$currentContentRow, $item['isi_pelayanan'])
              ->setCellValue('E'.$currentContentRow, $item['pelaksanaan_pelayanan'])
              ->setCellValue('F'.$currentContentRow, $item['keterangan']);

              //incremen the current row number
              $currentContentRow++;
          }

          //remove last empty rows
          $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);

          //set the header first, so the result will be treated as an xlsx file.
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

          //make it an attachment so we can define filename
          $deputiNama = $this->userdata->nama_pengguna;
          $filename = "Laporan Pelayanan Publik ".$deputiNama." ".$vbulan."-".$vtahun.".xlsx";
          header('Content-Disposition: attachment;filename='.$filename.'');

          //create IOFactory object
          $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
          ob_end_clean();
          //save into php output
          $writer->save('php://output');
      } else {
          redirect('error_akses');
    }
}
}

/* End of file Kota.php */
/* Location: ./application/controllers/Kota.php */
