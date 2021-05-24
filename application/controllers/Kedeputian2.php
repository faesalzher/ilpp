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

class Kedeputian2 extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kedeputian');
    }

    public function index()
    {
        if ($this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;
            $data['page'] 		= "Laporan Kedeputian";
            $data['judul'] 		= "Bidang Pelayanan Fungsional Kedeputian II";
            $data['deskripsi'] 	= "Input Laporan";

            $data['modal_tambah_kedeputian2'] = show_my_modal('modals/modal_tambah_kedeputian2', 'tambah-kedeputian2', $data);

            $this->template->views('kedeputian2/home', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function tampil()
    {
        if ($this->userdata->level == "7") {
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
            $deputi = 3;
            $data['dataKedeputian2']=$this->M_kedeputian->select_by_month($vbulan, $vtahun, $deputi);
            $this->load->view('kedeputian2/list_data', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function prosesTambah()
    {
        if ($this->userdata->level == "7") {
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
        if ($this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;
            $id 				= trim($_POST['id']);
            $data['dataKedeputian2'] 	= $this->M_kedeputian->select_by_id($id);

            echo show_my_modal('modals/modal_update_kedeputian2', 'update-kedeputian2', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function prosesUpdate()
    {
        if ($this->userdata->level == "7") {
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
        if ($this->userdata->level == "7") {
            $id = $_POST['id'];
            $result = $this->M_kedeputian->delete($id);
        } else {
            redirect('error_akses');
        }
    }

    public function export()
    {
        if ($this->userdata->level == "7") {
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

          $data=  mysqli_query($connection, "SELECT * FROM laporan_kedeputian  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."' AND id_pengguna = '3' ");
          //loop the dataTamu


            $contentStartRow = 54;
            $currentContentRow = 54;

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
          $filename = "Laporan Pelayanan Publik Kedeputian II ".$vbulan."-".$vtahun.".xlsx";
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
