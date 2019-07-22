<?php

class mail extends CI_model
{
    public function onlineUser()
    {
        return $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
    }
    public function getDisposisi()
    {
        $this->db->select('*');
        $this->db->from('disposisi');
        return $this->db->get()->result_array();
    }
    public function tambahDisposisi()
    {
        $data = [
            'nama_dis' => htmlspecialchars($this->input->post('nama_dis', true)),
        ];
        $this->db->insert('disposisi', $data);
    }
    public function getDispById($id)
    {
        return $this->db->get_where('disposisi', ['id_dis' => $id])->row_array();
    }
    public function ubahDisposisi($id)
    {
        $data = [
            'nama_dis' => htmlspecialchars($this->input->post('nama_dis', true)),
        ];
        $this->db->where('id_dis', $id);
        $this->db->update('disposisi', $data);
    }
    public function getSrtMasuk()
    {
        $this->db->select('*');
        $this->db->from('suratMasuk');
        $this->db->join('disposisi', 'disposisi.id_dis=suratMasuk.dis_id');
        return $this->db->get()->result_array();
    }
    private function _uploadImage()
    {
        // $config['upload_path']          = '../../../Users/OWNER/Dropbox';
        $config['upload_path']          = './assets/img';
        $config['allowed_types']        = 'gif|jpg|png|pdf';
        $config['file_name']            = $_FILES['filePdf']['name'];
        $config['overwrite']            = true;
        $config['max_size']             = 10024;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('filePdf')) {
            echo 'Upload Gagal';
        } else {
            return $this->upload->data('file_name');
        }
        return "default.jpg";
    }
    public function tambahSuratMasuk()
    {
        $data = [
            'no_sm' => htmlspecialchars($this->input->post('no_msk', true)),
            'tgl_sm' => htmlspecialchars($this->input->post('tgl_msk', true)),
            'pengirim_sm' => htmlspecialchars($this->input->post('pengirim', true)),
            'perihal' => htmlspecialchars($this->input->post('perihal', true)),
            'dis_id' => htmlspecialchars($this->input->post('dis_id', true)),
            'isi_dis' => htmlspecialchars($this->input->post('isi_dis', true)),
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
            'nominal' => htmlspecialchars($this->input->post('nominal', true)),
            'file_sm' => $this->_uploadImage()
        ];
        $this->db->insert('suratMasuk', $data);
    }
    public function getMasukById($id)
    {
        return $this->db->get_where('suratmasuk', ['id_sm' => $id])->row_array();
    }
    public function getKeluarById($id)
    {
        return $this->db->get_where('suratkeluar', ['id_sk' => $id])->row_array();
    }
    public function getOthersById($id)
    {
        return $this->db->get_where('others', ['id_ot' => $id])->row_array();
    }
    public function ubahSuratMasuk($id)
    {
        if (!empty($_FILES["filePdf"]["name"])) {
            $file = $this->_uploadImage();
        } else {
            $file = $this->input->post('old_image', true);
        }

        $data = [
            'no_sm' => htmlspecialchars($this->input->post('no_msk', true)),
            'tgl_sm' => htmlspecialchars($this->input->post('tgl_msk', true)),
            'pengirim_sm' => htmlspecialchars($this->input->post('pengirim', true)),
            'perihal' => htmlspecialchars($this->input->post('perihal', true)),
            'dis_id' => htmlspecialchars($this->input->post('dis_id', true)),
            'isi_dis' => htmlspecialchars($this->input->post('isi_dis', true)),
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
            'nominal' => htmlspecialchars($this->input->post('nominal', true)),
            'file_sm' => $file
        ];

        $this->db->where('id_sm', $id);
        $this->db->update('suratmasuk', $data);
    }
    public function getSrtKeluar()
    {
        $this->db->select('*');
        $this->db->from('suratkeluar');
        $this->db->join('disposisi', 'disposisi.id_dis=suratkeluar.dis_id');
        return $this->db->get()->result_array();
    }
    public function tambahSuratKeluar()
    {
        $data = [
            'no_sk' => htmlspecialchars($this->input->post('no_sk', true)),
            'tgl_sk' => htmlspecialchars($this->input->post('tgl_sk', true)),
            'pengirim_sk' => htmlspecialchars($this->input->post('pengirim', true)),
            'perihal' => htmlspecialchars($this->input->post('perihal', true)),
            'dis_id' => htmlspecialchars($this->input->post('dis_id', true)),
            'isi_dis' => htmlspecialchars($this->input->post('isi_dis', true)),
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
            'nominal' => htmlspecialchars($this->input->post('nominal', true)),
            'file_sk' => $this->_uploadImage()
        ];
        $this->db->insert('suratkeluar', $data);
    }
    public function ubahSuratKeluar($id)
    {
        if (!empty($_FILES["filePdf"]["name"])) {
            $file = $this->_uploadImage();
        } else {
            $file = $this->input->post('old_image', true);
        }

        $data = [
            'no_sk' => htmlspecialchars($this->input->post('no_sk', true)),
            'tgl_sk' => htmlspecialchars($this->input->post('tgl_sk', true)),
            'pengirim_sk' => htmlspecialchars($this->input->post('pengirim', true)),
            'perihal' => htmlspecialchars($this->input->post('perihal', true)),
            'dis_id' => htmlspecialchars($this->input->post('dis_id', true)),
            'isi_dis' => htmlspecialchars($this->input->post('isi_dis', true)),
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
            'nominal' => htmlspecialchars($this->input->post('nominal', true)),
            'file_sk' => $file
        ];

        $this->db->where('id_sk', $id);
        $this->db->update('suratkeluar', $data);
    }
    public function getOthers()
    {
        $this->db->select('*');
        $this->db->from('others');
        $this->db->join('disposisi', 'disposisi.id_dis=others.dis_id');
        return $this->db->get()->result_array();
    }

    public function tambahOthers()
    {
        $data = [
            'no_ot' => htmlspecialchars($this->input->post('no_ot', true)),
            'tgl_ot' => htmlspecialchars($this->input->post('tgl_ot', true)),
            'pengirim_ot' => htmlspecialchars($this->input->post('pengirim', true)),
            'tujuan' => htmlspecialchars($this->input->post('tujuan', true)),
            'perihal' => htmlspecialchars($this->input->post('perihal', true)),
            'nominal' => htmlspecialchars($this->input->post('nominal', true)),
            'dis_id' => htmlspecialchars($this->input->post('dis_id', true)),
            'isi_dis' => htmlspecialchars($this->input->post('isi_dis', true)),
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
            'file_ot' => $this->_uploadImage()
        ];
        $this->db->insert('others', $data);
    }
    public function ubahOthers($id)
    {
        if (!empty($_FILES["filePdf"]["name"])) {
            $file = $this->_uploadImage();
        } else {
            $file = $this->input->post('old_image', true);
        }

        $data = [
            'no_ot' => htmlspecialchars($this->input->post('no_ot', true)),
            'tgl_ot' => htmlspecialchars($this->input->post('tgl_ot', true)),
            'pengirim_ot' => htmlspecialchars($this->input->post('pengirim', true)),
            'tujuan' => htmlspecialchars($this->input->post('tujuan', true)),
            'perihal' => htmlspecialchars($this->input->post('perihal', true)),
            'nominal' => htmlspecialchars($this->input->post('nominal', true)),
            'dis_id' => htmlspecialchars($this->input->post('dis_id', true)),
            'isi_dis' => htmlspecialchars($this->input->post('isi_dis', true)),
            'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
            'file_ot' => $file
        ];

        $this->db->where('id_ot', $id);
        $this->db->update('others', $data);
    }
    public function getReportM($tgl_dari, $tgl_sampai, $dispo)
    {
        $tgl_dari = $tgl_dari;
        $tgl_sampai = $tgl_sampai;
        $dispo = $dispo;
        $this->db->select('*');
        $this->db->from('suratMasuk');
        $this->db->join('disposisi', 'disposisi.id_dis=suratmasuk.dis_id');
        $this->db->where('tgl_sm >=', $tgl_dari);
        $this->db->where('tgl_sm <=', $tgl_sampai);
        if ($dispo != "nl") {
            $this->db->where('dis_id', $dispo);
        }
        $this->db->order_by('tgl_sm', 'DESC');
        return $this->db->get()->result_array();
    }
    public function getReportK($tgl_dari, $tgl_sampai, $dispo)
    {
        $tgl_dari = $tgl_dari;
        $tgl_sampai = $tgl_sampai;
        $dispo = $dispo;
        $this->db->select('*');
        $this->db->from('suratkeluar');
        $this->db->join('disposisi', 'disposisi.id_dis=suratkeluar.dis_id');
        $this->db->where('tgl_sk >=', $tgl_dari);
        $this->db->where('tgl_sk <=', $tgl_sampai);
        if ($dispo != "nl") {
            $this->db->where('dis_id', $dispo);
        }
        $this->db->order_by('tgl_sk', 'DESC');
        return $this->db->get()->result_array();
    }
    public function getListUser()
    {
        $this->db->select('*');
        $this->db->from('admin');
        return $this->db->get()->result_array();
    }
    public function tambahUser()
    {
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'image' => 'default.jpg',
            'password' => $this->input->post('password1', true),
            'role' => $this->input->post('role', true),
            'date_created' => time()
        ];

        $this->db->insert('admin', $data);
    }
    public function ubahUser($id)
    {
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'username' => htmlspecialchars($this->input->post('username', true)),
            'image' => 'default.jpg',
            'password' => $this->input->post('password1', true),
            'role' => $this->input->post('role', true),
            'date_created' => $this->input->post('date_created', true),
        ];
        $this->db->where('id', $id);
        $this->db->update('admin', $data);
    }
    public function getInstansi()
    {
        $this->db->select('*');
        $this->db->from('instansi');
        $this->db->where('id_ins', "1");
        return $this->db->get()->row_array();
    }
    public function ubahInstansi()
    {
        $data = [
            'kabKota' => htmlspecialchars($this->input->post('kab', true)),
            'telp' => htmlspecialchars($this->input->post('telp', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'kepala' => htmlspecialchars($this->input->post('kepala', true)),
            'nip' => htmlspecialchars($this->input->post('nip', true)),
        ];

        $this->db->where('id_ins', "1");
        $this->db->update('instansi', $data);
    }
    // public function getSMbyId($id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('suratMasuk');
    //     $this->db->where('id_sm', $id);
    //     return $this->db->get()->row_array();
    // }
    // public function getSKbyId($id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('suratkeluar');
    //     $this->db->where('id_sk', $id);
    //     return $this->db->get()->row_array();
    // }
}
