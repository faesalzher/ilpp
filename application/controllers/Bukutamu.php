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

class Bukutamu extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tamu');
    }

    public function index()
    {
        if ($this->userdata->level == "1" || $this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;
            $data['page'] 		= "Buku Tamu";
            $data['judul'] 		= "Buku Tamu";
            $data['deskripsi'] 	= "Input Data Tamu";

            $this->template->views('bukutamu/home', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function data_tamu()
    {
        if ($this->userdata->level == "1" || $this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;

            $data['page'] 		= "Data Tamu";
            $data['judul'] 		= "Data Tamu";
            $data['deskripsi'] 	= "Manage Data Tamu";

            $data['modal_tambah_tamu'] = show_my_modal('modals/modal_tambah_tamu', 'tambah-tamu', $data);

            $this->template->views('bukutamu/viewBukuTamu', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function tampil()
    {
        if ($this->userdata->level == "1" || $this->userdata->level == "7") {
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
            $data['dataTamu']=$this->M_tamu->select_by_month($vbulan, $vtahun);
            $this->load->view('bukutamu/list_data', $data);
        } else {
            redirect('error_akses');
        }
    }


    public function prosesTambah()
    {
        if ($this->userdata->level == "1" || $this->userdata->level == "7") {
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|date|required');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('keperluan', 'Keperluan', 'trim|required');
            $this->form_validation->set_rules('kontak', 'Kontak', 'trim|required');

            $data 	= $this->input->post();
            if ($this->form_validation->run() == true) {
                $result = $this->M_tamu->insert($data);

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
        if ($this->userdata->level == "1" || $this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;
            $id 				= trim($_POST['id']);
            $data['dataTamu'] 	= $this->M_tamu->select_by_id($id);

            echo show_my_modal('modals/modal_update_tamu', 'update-tamu', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function prosesUpdate()
    {
        if ($this->userdata->level == "1" || $this->userdata->level == "7") {
            $this->form_validation->set_rules('ubah_tanggal', 'Tanggal', 'trim|date|required');
            $this->form_validation->set_rules('ubah_nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('ubah_keperluan', 'Keperluan', 'trim|required');
            $this->form_validation->set_rules('ubah_kontak', 'Kontak', 'trim|required');

            $data 	= $this->input->post();
            if ($this->form_validation->run() == true) {
                $result = $this->M_tamu->update($data);

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
        if ($this->userdata->level == "1" || $this->userdata->level == "7") {
            $id = $_POST['id'];
            $result = $this->M_tamu->delete($id);
        } else {
            redirect('error_akses');
        }
    }

    public function export()
    {
        if ($this->userdata->level == "1" || $this->userdata->level == "7") {
            //load template
            //load from xlsx template
            $reader = IOFactory::createReader('Xlsx');
            $spreadsheet = $reader->load("templateTamu.xlsx");

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
            $data= mysqli_query($connection, "SELECT * FROM buku_tamu  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."'  ");
            //loop the dataTamu
            $contentStartRow = 2;
            $currentContentRow = 2;
            $no = 0;
            while ($item=mysqli_fetch_array($data)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('A'.$currentContentRow, ++$no)
                ->setCellValue('B'.$currentContentRow, $item['tanggal'])
                ->setCellValue('C'.$currentContentRow, $item['nama'])
                ->setCellValue('D'.$currentContentRow, $item['keperluan'])
                ->setCellValue('E'.$currentContentRow, $item['kontak']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);


            //set the header first, so the result will be treated as an xlsx file.
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            //make it an attachment so we can define filename
            $filename = "Laporan Buku Tamu ".$vbulan."-".$vtahun.".xlsx";
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
