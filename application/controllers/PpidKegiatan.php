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

class PpidKegiatan extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kegiatan');
    }

    public function index()
    {
        if ($this->userdata->level == "5" || $this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;
            $data['page'] 		= "Laporan Bidang PPID";
            $data['judul'] 		= "Bidang PPID Kegiatan Kemenko Polhukam";
            $data['deskripsi'] 	= "Input Laporan";

            $data['modal_tambah_kegiatan'] = show_my_modal('modals/modal_tambah_kegiatan', 'tambah-kegiatan', $data);

            $this->template->views('ppidKegiatan/home', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function tampil()
    {
        if ($this->userdata->level == "5" || $this->userdata->level == "7") {
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
            $data['dataKegiatan']=$this->M_kegiatan->select_by_month($vbulan, $vtahun);
            $this->load->view('ppidKegiatan/list_data', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function prosesTambah()
    {
        if ($this->userdata->level == "5" || $this->userdata->level == "7") {
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|date|required');
            $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'trim|required');
            $this->form_validation->set_rules('tempat', 'Tempat', 'trim|required');
            $this->form_validation->set_rules('pimpinan', 'Pimpinan', 'trim|required');

            $data 	= $this->input->post();
            if ($this->form_validation->run() == true) {
                $result = $this->M_kegiatan->insert($data);

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
        if ($this->userdata->level == "5" || $this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;
            $id 				= trim($_POST['id']);
            $data['dataKegiatan'] 	= $this->M_kegiatan->select_by_id($id);

            echo show_my_modal('modals/modal_update_kegiatan', 'update-kegiatan', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function prosesUpdate()
    {
        if ($this->userdata->level == "5" || $this->userdata->level == "7") {
            $this->form_validation->set_rules('ubah_tanggal', 'Tanggal', 'trim|date|required');
            $this->form_validation->set_rules('ubah_kegiatan', 'Kegiatan', 'trim|required');
            $this->form_validation->set_rules('ubah_tempat', 'Tempat', 'trim|required');
            $this->form_validation->set_rules('ubah_pimpinan', 'Pimpinan', 'trim|required');

            $data 	= $this->input->post();
            if ($this->form_validation->run() == true) {
                $result = $this->M_kegiatan->update($data);

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
        if ($this->userdata->level == "5" || $this->userdata->level == "7") {
            $id = $_POST['id'];
            $result = $this->M_kegiatan->delete($id);
        } else {
            redirect('error_akses');
        }
    }


    public function export()
    {
      if ($this->userdata->level == "5" || $this->userdata->level == "7") {
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
        $data= mysqli_query($connection, "SELECT * FROM laporan_rapat WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."'  ");
        //loop the dataTamu
        $contentStartRow = 41;
        $currentContentRow = 41;
        $no = 0;
        while ($item=mysqli_fetch_array($data)) {
            // insert a row after current row (before current row + 1)
            $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

            //fill the cell with data
            $spreadsheet->getActiveSheet()
            ->setCellValue('B'.$currentContentRow, ++$no)
            ->setCellValue('C'.$currentContentRow, $item['tanggal'])
            ->setCellValue('D'.$currentContentRow, $item['kegiatan'])
            ->setCellValue('E'.$currentContentRow, $item['tempat'])
            ->setCellValue('F'.$currentContentRow, $item['pimpinan']);

            //incremen the current row number
            $currentContentRow++;
        }

        //remove last empty rows
        $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);


        //set the header first, so the result will be treated as an xlsx file.
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        //make it an attachment so we can define filename
        $filename = "Laporan Pelayanan Publik PPID Kegiatan Rapat ".$vbulan."-".$vtahun.".xlsx";
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
