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

class Admin extends AUTH_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kedeputian');
        $this->load->model('M_tamu');
        $this->load->model('M_informasi');
        $this->load->model('M_informasiWeb');
        $this->load->model('M_kegiatan');
        $this->load->model('M_ulp');
    }

    public function index()
    {
        if ($this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;
            $data['page'] 		= "Admin";
            $data['judul'] 		= "Dashboard Admin";
            $data['deskripsi'] 	= "Control Panel";
            $data['jml_kedeputian'] 	= $this->M_kedeputian->total_rows();
            $data['jml_tamu'] 	= $this->M_tamu->total_rows();
            $data['jml_informasi'] 	= $this->M_informasi->total_rows();
            $data['jml_informasiWeb'] 	= $this->M_informasiWeb->total_rows();
            $data['jml_kegiatan'] 	= $this->M_kegiatan->total_rows();
            $data['jml_ulp'] 	=$this->M_ulp->total_rows();
            $this->template->views('admin/home', $data);
        } else {
            redirect('error_akses');
        }
    }

    public function PilihDeputi()
    {
        if ($this->userdata->level == "7") {
            $data['userdata'] 	= $this->userdata;
            $data['page'] 		= "Laporan Kedeputian";
            $data['judul'] 		= "Pilih Kedeputian";
            $data['deskripsi'] 	= "Control Panel";
            $this->template->views('admin/pilihDeputi', $data);
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

                $dataInformasi= mysqli_query($connection, "SELECT * FROM laporan_informasi  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."'  ");
                $dataInformasiWeb= mysqli_query($connection, "SELECT * FROM laporan_informasi_web  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."'  ");
                $dataPengadaan= mysqli_query($connection, "SELECT * FROM laporan_pelayanan_publik  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."'  ");
                $dataKegiatan= mysqli_query($connection, "SELECT * FROM laporan_rapat  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."'  ");
                $dataDeputi1= mysqli_query($connection, "SELECT * FROM laporan_kedeputian  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."' AND id_pengguna = '2' ");
                $dataDeputi2= mysqli_query($connection, "SELECT * FROM laporan_kedeputian  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."' AND id_pengguna = '3' ");
                $dataDeputi3= mysqli_query($connection, "SELECT * FROM laporan_kedeputian  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."' AND id_pengguna = '4' ");
                $dataDeputi4= mysqli_query($connection, "SELECT * FROM laporan_kedeputian  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."' AND id_pengguna = '5' ");
                $dataDeputi5= mysqli_query($connection, "SELECT * FROM laporan_kedeputian  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."' AND id_pengguna = '6' ");
                $dataDeputi6= mysqli_query($connection, "SELECT * FROM laporan_kedeputian  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."' AND id_pengguna = '7' ");
                $dataDeputi7= mysqli_query($connection, "SELECT * FROM laporan_kedeputian  WHERE YEAR(tanggal) = '".$vtahun."' AND MONTH(tanggal) = '".$vbulan."' AND id_pengguna = '8' ");
            //loop the dataTamu

            //DATA PERMINTAAN INFO
            $contentStartRow = 30;
            $currentContentRow = 30;
            $no = 0;
            while ($itemInfo=mysqli_fetch_array($dataInformasi)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemInfo['bentuk_pelayanan'])
                ->setCellValue('D'.$currentContentRow, $itemInfo['isi_pelayanan'])
                ->setCellValue('E'.$currentContentRow, $itemInfo['pelaksanaan_pelayanan'])
                ->setCellValue('F'.$currentContentRow, $itemInfo['keterangan']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);


            //DATA PERMINTAAN INFO WEB
            $contentStartRow = $currentContentRow+5;
            $currentContentRow = $currentContentRow+5;
            $no = 0;
            while ($itemWeb=mysqli_fetch_array($dataInformasiWeb)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemWeb['tanggal'])
                ->setCellValue('D'.$currentContentRow, $itemWeb['substansi']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);


            //DATA kegiatan rapat
            $contentStartRow = $currentContentRow+4;
            $currentContentRow = $currentContentRow+4;
            $no = 0;
            while ($itemRapat=mysqli_fetch_array($dataKegiatan)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemRapat['tanggal'])
                ->setCellValue('D'.$currentContentRow, $itemRapat['kegiatan'])
                ->setCellValue('E'.$currentContentRow, $itemRapat['tempat'])
                ->setCellValue('F'.$currentContentRow, $itemRapat['pimpinan']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);

            //DATA ULP
            $contentStartRow = $currentContentRow+4;
            $currentContentRow = $currentContentRow+4;
            $no = 0;
            while ($itemUlp=mysqli_fetch_array($dataPengadaan)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemUlp['pelaksana'])
                ->setCellValue('D'.$currentContentRow, $itemUlp['kontrak'])
                ->setCellValue('E'.$currentContentRow, $itemUlp['pekerjaan'])
                ->setCellValue('F'.$currentContentRow, $itemUlp['nilai_kontrak'])
                ->setCellValue('G'.$currentContentRow, $itemUlp['metode']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);

            //DATA Deputi 1
            $contentStartRow = $currentContentRow+5;
            $currentContentRow = $currentContentRow+5;
            $no = 0;
            while ($itemDeputi1=mysqli_fetch_array($dataDeputi1)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemDeputi1['bentuk_pelayanan'])
                ->setCellValue('D'.$currentContentRow, $itemDeputi1['isi_pelayanan'])
                ->setCellValue('E'.$currentContentRow, $itemDeputi1['pelaksanaan_pelayanan'])
                ->setCellValue('F'.$currentContentRow, $itemDeputi1['keterangan']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);

            //DATA Deputi 2
            $contentStartRow = $currentContentRow+1;
            $currentContentRow = $currentContentRow+1;
            $no = 0;
            while ($itemDeputi2=mysqli_fetch_array($dataDeputi2)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemDeputi2['bentuk_pelayanan'])
                ->setCellValue('D'.$currentContentRow, $itemDeputi2['isi_pelayanan'])
                ->setCellValue('E'.$currentContentRow, $itemDeputi2['pelaksanaan_pelayanan'])
                ->setCellValue('F'.$currentContentRow, $itemDeputi2['keterangan']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);

            //DATA Deputi 3
            $contentStartRow = $currentContentRow+1;
            $currentContentRow = $currentContentRow+1;
            $no = 0;
            while ($itemDeputi3=mysqli_fetch_array($dataDeputi3)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemDeputi3['bentuk_pelayanan'])
                ->setCellValue('D'.$currentContentRow, $itemDeputi3['isi_pelayanan'])
                ->setCellValue('E'.$currentContentRow, $itemDeputi3['pelaksanaan_pelayanan'])
                ->setCellValue('F'.$currentContentRow, $itemDeputi3['keterangan']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);

            //DATA Deputi 4
            $contentStartRow = $currentContentRow+1;
            $currentContentRow = $currentContentRow+1;
            $no = 0;
            while ($itemDeputi4=mysqli_fetch_array($dataDeputi4)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemDeputi4['bentuk_pelayanan'])
                ->setCellValue('D'.$currentContentRow, $itemDeputi4['isi_pelayanan'])
                ->setCellValue('E'.$currentContentRow, $itemDeputi4['pelaksanaan_pelayanan'])
                ->setCellValue('F'.$currentContentRow, $itemDeputi4['keterangan']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);

            //DATA Deputi 5
            $contentStartRow = $currentContentRow+1;
            $currentContentRow = $currentContentRow+1;
            $no = 0;
            while ($itemDeputi5=mysqli_fetch_array($dataDeputi5)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemDeputi5['bentuk_pelayanan'])
                ->setCellValue('D'.$currentContentRow, $itemDeputi5['isi_pelayanan'])
                ->setCellValue('E'.$currentContentRow, $itemDeputi5['pelaksanaan_pelayanan'])
                ->setCellValue('F'.$currentContentRow, $itemDeputi5['keterangan']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);

            //DATA Deputi 6
            $contentStartRow = $currentContentRow+1;
            $currentContentRow = $currentContentRow+1;
            $no = 0;
            while ($itemDeputi6=mysqli_fetch_array($dataDeputi6)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemDeputi6['bentuk_pelayanan'])
                ->setCellValue('D'.$currentContentRow, $itemDeputi6['isi_pelayanan'])
                ->setCellValue('E'.$currentContentRow, $itemDeputi6['pelaksanaan_pelayanan'])
                ->setCellValue('F'.$currentContentRow, $itemDeputi6['keterangan']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);

            //DATA Deputi 7
            $contentStartRow = $currentContentRow+1;
            $currentContentRow = $currentContentRow+1;
            $no = 0;
            while ($itemDeputi7=mysqli_fetch_array($dataDeputi7)) {
                // insert a row after current row (before current row + 1)
                $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1, 1);

                //fill the cell with data
                $spreadsheet->getActiveSheet()
                ->setCellValue('B'.$currentContentRow, ++$no)
                ->setCellValue('C'.$currentContentRow, $itemDeputi7['bentuk_pelayanan'])
                ->setCellValue('D'.$currentContentRow, $itemDeputi7['isi_pelayanan'])
                ->setCellValue('E'.$currentContentRow, $itemDeputi7['pelaksanaan_pelayanan'])
                ->setCellValue('F'.$currentContentRow, $itemDeputi7['keterangan']);

                //incremen the current row number
                $currentContentRow++;
            }

            //remove last empty rows
            $spreadsheet->getActiveSheet()->removeRow($currentContentRow, 1);


            //set the header first, so the result will be treated as an xlsx file.
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            //make it an attachment so we can define filename
            $filename = "Laporan Pelayanan Publik ".$vbulan."-".$vtahun.".xlsx";
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
