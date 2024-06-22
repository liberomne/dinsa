<?php

defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login_admin();
    }
    public function index()
    {
        $data['judul'] = 'Profil Saya';
        $data['admin'] = $this->M_Admin->cekData(['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function ubahProfil()
    {
        $data['judul'] = 'Ubah Profil';
        $data['admin'] = $this->M_Admin->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules(
            'nama',
            'Nama Lengkap',
            'required|trim', [
                'required' => 'Nama tidak Boleh Kosong'
        ]);

        //Form validasi
        if ($this->form_validation->run() == false) 
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/ubah-profile', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama', true);
            $email = $this->input->post('email', true);

            //jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            //Cek kalau image exist
            if ($upload_image) 
            {
                //Eksekusi script
                $config['upload_path'] = './assets/img/profil/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3000';
                $config['max_width'] = '3000';
                $config['max_height'] = '3000';
                $config['file_name'] = 'pro' . time();
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) 
                {
                    $gambar_lama = $data['admin']['image'];

                    if ($gambar_lama != 'default.jpg') { unlink(FCPATH . 'assets/img/profil/' .$gambar_lama); }

                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else { 
                    
                }
            }

            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('admin');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> Profil berhasil diubah!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('user');
        }
    }
}