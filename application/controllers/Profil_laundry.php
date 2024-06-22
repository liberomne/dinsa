<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profil_laundry extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_admin();
        $this->load->model('M_Profil_Laundry');
    }

    public function index()
    {
        $data['judul'] = 'Profil Laundry';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['profil_laundry'] = $this->M_Profil_Laundry->getProfilLaundry();
        $data['pembayaran'] = $this->M_Profil_Laundry->getPembayaran();
        // $data['gambar'] = $this->M_Profil_Laundry->getGambar();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('profil_laundry/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['judul'] = 'Form Ubah Profil Laundry';
        $data['profil_laundry'] = $this->M_Profil_Laundry->editProfilLaundry($id);
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('profil_laundry/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        // $id_admin = $this->input->post('id_admin');
        // $nama_laundry = $this->input->post('nama_laundry');
        // $deskripsi = $this->input->post('deskripsi');
        // $nomor_telepon = $this->input->post('nomor_telepon');
        // $email = $this->input->post('email');
        // $alamat = $this->input->post('alamat');
        // $link_maps = $this->input->post('link_maps');
        // $gambar = $this->input->post('gambar');

        // konfigurasi untuk upload gambar
        $config['upload_path'] = 'assets/img/gambar';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $this->load->library('upload', $config);
        // $this->upload->do_upload('gambar');
        // $file_name = $this->upload->data();

        if (!empty($_FILES['gambar']['name'])) {
            $this->upload->do_upload('gambar');
            $upload = $this->upload->data();
            $gambar = $upload['file_name'];

            $data = array(
                'id' => $this->input->post('id'),
                'id_admin' => $this->input->post('id_admin'),
                'nama_laundry' => $this->input->post('nama_laundry'),
                'deskripsi' => $this->input->post('deskripsi'),
                'nomor_telepon' => $this->input->post('nomor_telepon'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
                'link_maps' => $this->input->post('link_maps'),
                'gambar' => $gambar,
            );

            $_id = $this->db->get_where('profil_laundry', ['id' => $id])->row();
            $query = $this->M_Profil_Laundry->update($data, $id);
            if ($query = true) {
                $this->session->set_flashdata('info', 'Data berhasil diperbarui!');
                unlink('assets/img/gambar/' . $_id->gambar);
                redirect('profil_laundry', 'refresh');
            }
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'nama_laundry' => $this->input->post('nama_laundry'),
                'deskripsi' => $this->input->post('deskripsi'),
                'nomor_telepon' => $this->input->post('nomor_telepon'),
                'email' => $this->input->post('email'),
                'alamat' => $this->input->post('alamat'),
                'link_maps' => $this->input->post('link_maps')
            );
            $query = $this->M_Profil_Laundry->update($data, $id);
            if ($query = true) {
                $this->session->set_flashdata('info', 'Data berhasil diperbarui!');
                redirect('profil_laundry', 'refresh');
            }
        }
    }
}
