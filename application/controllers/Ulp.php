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

class Ulp extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_ulp');
    }

    public function index()
    {
        if ($this->userdata->level == "6" || $this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;
            $data['page'] 		= "Laporan ULP";
            $data['judul'] 		= "Bidang ULP";
            $data['deskripsi'] 	= "Input Laporan";

            $data['modal_tambah_ulp'] = show_my_modal('modals/modal_tambah_ulp', 'tambah-ulp', $data);

            $this->template->views('ulp/home', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function tampil()
    {
        if ($this->userdata->level == "6" || $this->userdata->level == "7") {
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
            $data['dataUlp']=$this->M_ulp->select_by_month($vbulan, $vtahun);
            $this->load->view('ulp/list_data', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function prosesTambah()
    {
        if ($this->userdata->level == "6" || $this->userdata->level == "7") {
            $this->form_validation->set_rules('bulan', 'Bulan', 'trim|required');
            $this->form_validation->set_rules('pelaksana', 'Pelaksana', 'trim|required');
            $this->form_validation->set_rules('kontrak', 'Kontrak', 'trim|required');
            $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required');
            $this->form_validation->set_rules('nilai_kontrak', 'Nilai Kontrak', 'trim|required');
            $this->form_validation->set_rules('metode', 'Metode Pengadaan', 'trim|required');

            $data 	= $this->input->post();
            if ($this->form_validation->run() == true) {
                $result = $this->M_ulp->insert($data);

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
        if ($this->userdata->level == "6" || $this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;
            $id 				= trim($_POST['id']);
            $data['dataUlp'] 	= $this->M_ulp->select_by_id($id);

            echo show_my_modal('modals/modal_update_ulp', 'update-ulp', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function prosesUpdate()
    {
        if ($this->userdata->level == "6" || $this->userdata->level == "7") {
            $this->form_validation->set_rules('ubah_bulan', 'Bulan', 'trim|required');
            $this->form_validation->set_rules('ubah_pelaksana', 'Pelaksana', 'trim|required');
            $this->form_validation->set_rules('ubah_kontrak', 'Kontrak', 'trim|required');
            $this->form_validation->set_rules('ubah_pekerjaan', 'Pekerjaan', 'trim|required');
            $this->form_validation->set_rules('ubah_nilai_kontrak', 'Nilai Kontrak', 'trim|required');
            $this->form_validation->set_rules('ubah_metode', 'Metode Pengadaan', 'trim|required');

            $data 	= $this->input->post();
            if ($this->form_validation->run() == true) {
                $result = $this->M_ulp->update($data);

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
        if ($this->userdata->level == "6" || $this->userdata->level == "7") {
            $id = $_POST['id'];
            $result = $this->M_ulp->delete($id);

            if ($result > 0) {
                echo show_succ_msg('Data Tamu Berhasil dihapus', '20px');
            } else {
                echo show_err_msg('Data Tamu Gagal dihapus', '20px');
            }
        } else {
            redirect('error_akses');
        }
    }

    public function export()
    {
        if ($this->userdata->level == "6" || $this->userdata->level == "7") {
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
          $data= mysqli_query($connection, "SELECT * FROM laporan_pelayanan_publik  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."'  ");
          //loop the dataTamu
          $contentStartRow = 46;
          $currentContentRow = 46;
          $no = 0;
          while ($item=mysqli_fetch_array($data)) {
              // insert a row after current row (before current row + 1)
              $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

              //fill the cell with data
              $spreadsheet->getActiveSheet()
              ->setCellValue('B'.$currentContentRow, ++$no)
              ->setCellValue('C'.$currentContentRow, $item['pelaksana'])
              ->setCellValue('D'.$currentContentRow, $item['kontrak'])
              ->setCellValue('E'.$currentContentRow, $item['pekerjaan'])
              ->setCellValue('F'.$currentContentRow, $item['nilai_kontrak'])
              ->setCellValue('G'.$currentContentRow, $item['metode']);

              //incremen the current row number
              $currentContentRow++;
          }

          //remove last empty rows
          $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);

          //set the header first, so the result will be treated as an xlsx file.
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

          //make it an attachment so we can define filename
          $filename = "Laporan Pelayanan Publik ULP ".$vbulan."-".$vtahun.".xlsx";
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
