<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mail');
        $online = $this->mail->onlineUser();
        if (!$this->session->userdata('username')) {

            $this->session->set_flashdata('message', '<div class="alert alert-danger mt-2" role="alert"> Harap Login Terlebih Dahulu </div> ');
            redirect('auth');
        } else if ($online['role'] == "User") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger mt-2" role="alert"> Anda Tidak Memiliki Akses ke Menu Tersebut </div> ');
            redirect('user');
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
        $data['title'] = "Dashboard Admin";
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
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
    public function instansi()
    {
        $data['title'] = "Instansi";
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['instansi'] = $this->mail->getInstansi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/instansi', $data);
        $this->load->view('templates/footer');
    }
    public function ubahInstansi()
    {
        $this->form_validation->set_rules('kab', 'Kabupaten', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('email', 'the Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('kepala', 'Kepala ', 'required|trim');
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Instansi";
            $data['user'] = $this->mail->onlineUser();
            $data['instansi'] = $this->mail->getInstansi();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/ubahInstansi', $data);
            $this->load->view('templates/footer');
        } else {

            $this->mail->ubahInstansi();
            $this->session->set_flashdata('instansi', '<div class="alert alert-success mt-2" role="alert"> Data Instansi diubah </div> ');
            redirect('admin/instansi');
        }
    }
    public function user()
    {
        $data['title'] = "Daftar User";
        $data['user'] = $this->mail->onlineUser();
        $data['userData'] = $this->mail->getListUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/userList/userData', $data);
        $this->load->view('templates/footer');
    }
    public function tambahUser()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[admin.username]', [
            'is_unique' => 'This email has already registered'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'min_length' => 'Password too short!',
            'matches' => 'Password not match!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Disposisi";
            $data['user'] = $this->mail->onlineUser();
            $data['akses'] = [
                'Admin',
                'User'
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/userList/tambahUser', $data);
            $this->load->view('templates/footer');
        } else {
            $this->mail->tambahUser();
            $this->session->set_flashdata('userMes', '<div class="alert alert-success mx-2" role="alert"> User Telah Ditambahkan </div> ');
            redirect('admin/user');
        }
    }
    public function ubahUser($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'min_length' => 'Password too short!',
            'matches' => 'Password not match!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Disposisi";
            $data['user'] = $this->mail->onlineUser();
            $data['userId'] = $this->db->get_where('admin', ['id' => $id])->row_array();
            $data['akses'] = [
                'Admin',
                'User'
            ];
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/userList/ubahUser', $data);
            $this->load->view('templates/footer');
        } else {
            $this->mail->ubahUser($id);
            $this->session->set_flashdata('userMes', '<div class="alert alert-success mx-2" role="alert"> User Telah Diubah </div> ');
            redirect('admin/user');
        }
    }
    public function hapusUser($id)
    {
        $this->db->delete('admin', ['id' => $id]);
        $this->session->set_flashdata('userMes', '<div class="alert alert-danger" role="alert"> User Telah Dihapus </div> ');
        redirect('admin/user');
    }
}
