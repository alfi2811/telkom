<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mail');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mt-2" role="alert"> Harap Login Terlebih Dahulu </div> ');
            redirect('auth');
        } else {
            if (time() - $this->session->userdata('last_login') > 120) {
                $this->session->unset_userdata('last_login');
                $this->session->set_flashdata('message', '<div class="alert alert-danger mt-2" role="alert"> Waktu Anda Habis Harap Login Kembali </div> ');
                redirect('auth');
            } else {
                $this->session->last_login = time();
            }
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['user'] = $this->mail->onlineUser();
        $data['countDis'] = $this->db->count_all('disposisi');
        $data['userTotal'] = $this->db->count_all('admin');
        $data['sMasuk'] = $this->db->count_all('suratMasuk');
        $data['sKeluar'] = $this->db->count_all('suratkeluar');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }
    public function profile()
    {
        $data['title'] = "Profile User";
        $data['user'] = $this->mail->onlineUser();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function disposisi()
    {
        $data['title'] = "Disposisi";
        $data['user'] = $this->mail->onlineUser();
        $data['disposisi'] = $this->mail->getDisposisi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/disposisi/disposisi', $data);
        $this->load->view('templates/footer');
    }

    public function tambahDisposisi()
    {
        $this->form_validation->set_rules('nama_dis', 'the Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Disposisi";
            $data['user'] = $this->mail->onlineUser();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/disposisi/tambahDisposisi', $data);
            $this->load->view('templates/footer');
        } else {
            $this->mail->tambahDisposisi();
            $this->session->set_flashdata('disposisi', '<div class="alert alert-success" role="alert"> Data Disposisi ditambahkan </div> ');
            redirect('user/disposisi');
        }
    }

    public function hapusDisposisi($id)
    {
        $this->db->delete('disposisi', ['id_dis' => $id]);
        $this->session->set_flashdata('disposisi', '<div class="alert alert-danger" role="alert"> Data Disposisi Telah Dihapus </div> ');
        redirect('user/disposisi');
    }
    public function ubahDisposisi($id)
    {
        $this->form_validation->set_rules('nama_dis', 'the Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Ubah Disposisi";
            $data['user'] = $this->mail->onlineUser();
            $data['disp'] = $this->mail->getDispById($id);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/disposisi/ubahDisposisi', $data);
            $this->load->view('templates/footer');
        } else {
            $b = $id;
            $this->mail->ubahDisposisi($b);
            $this->session->set_flashdata('disposisi', '<div class="alert alert-success" role="alert"> Data Disposisi telah diubah </div> ');
            redirect('user/disposisi');
        }
    }
    public function suratMasuk()
    {
        $data['title'] = "Surat Masuk";
        $data['user'] = $this->mail->onlineUser();
        $data['sm'] = $this->mail->getSrtMasuk();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/suratMasuk/suratMasuk', $data);
        $this->load->view('templates/footer');
    }
    public function suratKeluar()
    {
        $data['title'] = "Surat Keluar";
        $data['user'] = $this->mail->onlineUser();
        $data['sm'] = $this->mail->getSrtKeluar();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/suratKeluar/suratKeluar', $data);
        $this->load->view('templates/footer');
    }

    public function others()
    {
        $data['title'] = "Others";
        $data['user'] = $this->mail->onlineUser();
        $data['others'] = $this->mail->getOthers();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/others/others', $data);
        $this->load->view('templates/footer');
    }

    private function _cekSuratMasuk()
    {
        $this->form_validation->set_rules('no_msk', 'Number', 'required|trim');
        $this->form_validation->set_rules('tgl_msk', 'Date', 'required|trim');
        $this->form_validation->set_rules('pengirim', 'Sender', 'required|trim');
        $this->form_validation->set_rules('perihal', 'Name', 'required|trim');
        $this->form_validation->set_rules('isi_dis', 'Fill ', 'required|trim');
        // $this->form_validation->set_rules('filePdf', 'Filewww', 'required');
    }
    private function _cekSuratKeluar()
    {
        $this->form_validation->set_rules('no_sk', 'the Number', 'required|trim');
        $this->form_validation->set_rules('tgl_sk', 'the Date', 'required|trim');
        $this->form_validation->set_rules('pengirim', 'the Sender', 'required|trim');
        $this->form_validation->set_rules('perihal', 'the Name', 'required|trim');
        $this->form_validation->set_rules('isi_dis', 'Fill ', 'required|trim');
        // $this->form_validation->set_rules('file', 'the Name', 'required|trim');
    }
    private function _cekOthers()
    {
        $this->form_validation->set_rules('no_ot', 'the Number', 'required|trim');
        $this->form_validation->set_rules('tgl_ot', 'the Date', 'required|trim');
        $this->form_validation->set_rules('pengirim', 'the Sender', 'required|trim');
        $this->form_validation->set_rules('tujuan', 'the Sender', 'required|trim');
        $this->form_validation->set_rules('perihal', 'the Name', 'required|trim');
        $this->form_validation->set_rules('nominal', 'the Sender', 'required|trim');
    }
    public function tambahSuratMasuk()
    {
        $this->_cekSuratMasuk();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Surat Masuk";
            $data['user'] = $this->mail->onlineUser();
            $data['disp'] = $this->mail->getDisposisi();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/suratMasuk/tambahSrtMasuk', $data);
            $this->load->view('templates/footer');
        } else {

            $this->mail->tambahSuratMasuk();
            $this->session->set_flashdata('sMasuk', '<div class="alert alert-success" role="alert"> Surat Masuk ditambahkan </div> ');
            redirect('user/suratMasuk');
            // }
        }
    }

    public function tambahSuratKeluar()
    {
        $this->_cekSuratKeluar();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Surat Keluar";
            $data['user'] = $this->mail->onlineUser();
            $data['disp'] = $this->mail->getDisposisi();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/suratKeluar/tambahSrtKeluar', $data);
            $this->load->view('templates/footer');
        } else {

            $this->mail->tambahSuratKeluar();
            $this->session->set_flashdata('sKeluar', '<div class="alert alert-success" role="alert"> Surat Keluar ditambahkan </div> ');
            redirect('user/suratKeluar');
        }
    }
    public function tambahOthers()
    {
        $this->_cekOthers();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Surat Keluar";
            $data['user'] = $this->mail->onlineUser();
            $data['disp'] = $this->mail->getDisposisi();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/others/tambahOthers', $data);
            $this->load->view('templates/footer');
        } else {

            $this->mail->tambahOthers();
            $this->session->set_flashdata('others', '<div class="alert alert-success" role="alert"> Others ditambahkan </div> ');
            redirect('user/others');
        }
    }

    private function _surat()
    {
        $data['user'] = $this->mail->onlineUser();
        $data['disp'] = $this->mail->getDisposisi();
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
    }
    public function ubahSuratMasuk($id)
    {
        $this->_cekSuratMasuk();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Ubah Surat Masuk";
            $data['sm'] = $this->mail->getMasukById($id);
            $this->load->view('templates/header', $data);
            $this->_surat();
            $this->load->view('user/suratMasuk/ubahSrtMasuk', $data);
            $this->load->view('templates/footer');
        } else {
            $b = $id;
            $this->mail->ubahSuratMasuk($b);
            $this->session->set_flashdata('sMasuk', '<div class="alert alert-success mb-2" role="alert"> Surat Masuk telah diubah </div> ');
            redirect('user/suratMasuk');
        }
    }
    public function ubahSuratKeluar($id)
    {
        $this->_cekSuratKeluar();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Ubah Surat Keluar";
            $data['sm'] = $this->mail->getKeluarById($id);
            $this->load->view('templates/header', $data);
            $this->_surat();
            $this->load->view('user/suratKeluar/ubahSrtKeluar', $data);
            $this->load->view('templates/footer');
        } else {
            $b = $id;
            $this->mail->ubahSuratKeluar($b);
            $this->session->set_flashdata('sKeluar', '<div class="alert alert-success mt-2" role="alert"> Surat Keluar telah diubah </div> ');
            redirect('user/suratKeluar');
        }
    }
    public function ubahOthers($id)
    {
        $this->_cekOthers();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Ubah Others";
            $data['sm'] = $this->mail->getOthersById($id);
            $this->load->view('templates/header', $data);
            $this->_surat();
            $this->load->view('user/others/ubahOthers', $data);
            $this->load->view('templates/footer');
        } else {
            $b = $id;
            $this->mail->ubahOthers($b);
            $this->session->set_flashdata('others', '<div class="alert alert-success mt-2" role="alert"> Others telah diubah </div> ');
            redirect('user/others');
        }
    }
    public function detailSuratMasuk($id)
    {
        $data['title'] = "Detail Surat Masuk";
        $data['sm'] = $this->mail->getMasukById($id);
        $this->load->view('templates/header', $data);
        $this->_surat();
        $this->load->view('user/suratMasuk/detailSrtMasuk', $data);
        $this->load->view('templates/footer');
    }
    public function detailSuratKeluar($id)
    {
        $data['title'] = "Detail Surat Masuk";
        // $data['sk'] = $this->mail->getSKbyId($id);
        $data['sk'] = $this->mail->getKeluarById($id);
        $this->load->view('templates/header', $data);
        $this->_surat();
        $this->load->view('user/suratKeluar/detailSrtKeluar', $data);
        $this->load->view('templates/footer');
    }
    public function detailOthers($id)
    {
        $data['title'] = "Detail Others";
        $data['sm'] = $this->mail->getOthersById($id);
        $this->load->view('templates/header', $data);
        $this->_surat();
        $this->load->view('user/others/detailOthers', $data);
        $this->load->view('templates/footer');
    }
    private function _deleteimage($id)
    {
        if ($id != "default.jpg") {
            $filename = explode(".", $id)[0];
            return array_map('unlink', glob(FCPATH . "./assets/img/$filename.*"));
        }
    }
    public function hapusSuratMasuk($id)
    {
        $data = $this->mail->getMasukById($id);
        $foto = $data['file_sm'];
        $this->_deleteimage($foto);
        $this->db->delete('suratMasuk', ['id_sm' => $id]);
        $this->session->set_flashdata('sMasuk', '<div class="alert alert-danger" role="alert"> Surat Masuk Telah Dihapus </div> ');
        redirect('user/suratMasuk');
    }
    public function hapusSuratKeluar($id)
    {
        $data = $this->mail->getKeluarById($id);
        $foto = $data['file_sk'];
        $this->_deleteimage($foto);
        $this->db->delete('suratkeluar', ['id_sk' => $id]);
        $this->session->set_flashdata('sKeluar', '<div class="alert alert-danger" role="alert"> Surat Keluar Telah Dihapus </div> ');
        redirect('user/suratKeluar');
    }
    public function hapusOthers($id)
    {
        $data = $this->mail->getOthersById($id);
        $foto = $data['file_ot'];
        $this->_deleteimage($foto);
        $this->db->delete('others', ['id_ot' => $id]);
        $this->session->set_flashdata('others', '<div class="alert alert-danger" role="alert"> Others Telah Dihapus </div> ');
        redirect('user/others');
    }
    public function reportMasuk()
    {
        $this->form_validation->set_rules('tgl_dari', 'Date', 'required|trim');
        $this->form_validation->set_rules('tgl_ke', 'Date', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Report Surat Masuk";
            $this->load->view('templates/header', $data);
            $this->_surat();
            $this->load->view('user/report/reportMasuk', $data);
            $this->load->view('templates/footer');
            $this->session->unset_userdata('sme');
        } else {
            $tgl_dari = htmlspecialchars($this->input->post('tgl_dari', true));
            $tgl_sampai = htmlspecialchars($this->input->post('tgl_ke', true));
            $dispo = htmlspecialchars($this->input->post('dis_id', true));
            $data = array(
                'tgl_dari' => date('Y-m-d', strtotime($tgl_dari)),
                'tgl_sampai' => date('Y-m-d', strtotime($tgl_sampai)),
                'dispo' => $dispo
            );
            $data['title'] = "Report Surat Masuk";
            $data['reportM'] = $this->mail->getReportM($tgl_dari, $tgl_sampai, $dispo);
            $this->session->set_userdata('sme');
            $this->load->view('templates/header', $data);
            $this->_surat();
            $this->load->view('user/report/reportMasuk', $data);
            $this->load->view('templates/footer');
        }
    }


    public function reportKeluar()
    {
        $this->form_validation->set_rules('tgl_dari', 'Date', 'required|trim');
        $this->form_validation->set_rules('tgl_ke', 'Date', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Report Surat Masuk";
            $this->load->view('templates/header', $data);
            $this->_surat();
            $this->load->view('user/report/reportKeluar', $data);
            $this->load->view('templates/footer');
        } else {
            $tgl_dari = htmlspecialchars($this->input->post('tgl_dari', true));
            $tgl_sampai = htmlspecialchars($this->input->post('tgl_ke', true));
            $dispo = htmlspecialchars($this->input->post('dis_id', true));
            $data = array(
                'tgl_dari' => date('Y-m-d', strtotime($tgl_dari)),
                'tgl_sampai' => date('Y-m-d', strtotime($tgl_sampai)),
                'dispo' => $dispo
            );
            $data['title'] = "Report Surat Masuk";
            $data['reportM'] = $this->mail->getReportK($tgl_dari, $tgl_sampai, $dispo);
            $this->load->view('templates/header', $data);
            $this->_surat();
            $this->load->view('user/report/reportKeluar', $data);
            $this->load->view('templates/footer');
        }
    }
    public function excelSM($tgl_dari, $tgl_sampai, $dispo)
    {
        $tgl_sampai = date('Y/m/d', strtotime($tgl_sampai));
        $tgl_dari = date('Y/m/d', strtotime($tgl_dari));
        $output = "";
        $reportM = $this->mail->getReportM($tgl_dari, $tgl_sampai, $dispo);
        $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getProperties()->setCreator('Andoyo - Java Web Media')
            ->setLastModifiedBy('Admin')
            ->setTitle('Report Surat')
            ->setSubject('Report Surat Masuk')
            ->setKeywords('office 2007 php')
            ->setCategory('File');

        // Add some data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'Tanggal dan Jam')
            ->setCellValue('C1', 'Nomor Surat')
            ->setCellValue('D1', 'Pengirim')
            ->setCellValue('E1', 'Perihal')
            ->setCellValue('F1', 'Disposisi');

        // Miscellaneous glyphs, UTF-8
        $no = 1;
        $i = 2;
        foreach ($reportM as $m) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no++)
                ->setCellValue('B' . $i, date('d F Y', strtotime($m['tgl_sm'])))
                ->setCellValue('C' . $i, $m['no_sm'])
                ->setCellValue('D' . $i, $m['pengirim_sm'])
                ->setCellValue('E' . $i, $m['perihal'])
                ->setCellValue('F' . $i, $m['nama_dis']);
            $i++;
        }


        $filename = 'Report_Masuk'; // set filename for excel file to be exported

        $this->_excelUpload($filename, $spreadsheet);
    }
    public function excelSk($tgl_dari, $tgl_sampai, $dispo)
    {
        $tgl_sampai = date('Y/m/d', strtotime($tgl_sampai));
        $tgl_dari = date('Y/m/d', strtotime($tgl_dari));
        $output = "";
        $reportM = $this->mail->getReportK($tgl_dari, $tgl_sampai, $dispo);
        $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();

        $spreadsheet->getProperties()->setCreator('Andoyo - Java Web Media')
            ->setLastModifiedBy('Admin')
            ->setTitle('Report Surat')
            ->setSubject('Report Surat Masuk')
            ->setKeywords('office 2007 php')
            ->setCategory('File');

        // Add some data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'Tanggal dan Jam')
            ->setCellValue('C1', 'Nomor Surat')
            ->setCellValue('D1', 'Pengirim')
            ->setCellValue('E1', 'Perihal')
            ->setCellValue('F1', 'Disposisi');

        // Miscellaneous glyphs, UTF-8
        $no = 1;
        $i = 2;
        foreach ($reportM as $m) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, $no++)
                ->setCellValue('B' . $i, date('d F Y', strtotime($m['tgl_sk'])))
                ->setCellValue('C' . $i, $m['no_sk'])
                ->setCellValue('D' . $i, $m['pengirim_sk'])
                ->setCellValue('E' . $i, $m['perihal'])
                ->setCellValue('F' . $i, $m['nama_dis']);
            $i++;
        }


        $filename = 'Report_Keluar'; // set filename for excel file to be exported
        $this->_excelUpload($filename, $spreadsheet);
    }
    private function _excelUpload($filename, $spreadsheet)
    {
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output'); // download file 
    }
}
