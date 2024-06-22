<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_admin();
        $this->load->model('M_Pembayaran');
    }

    public function index()
    {
        $data['judul'] = 'Metode Pembayaran';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['pembayaran'] = $this->M_Pembayaran->getPembayaran();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pembayaran/v_pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $isi['judul'] = 'Form Tambah Metode Pembayaran';
        $isi['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $isi);
        $this->load->view('templates/sidebar', $isi);
        $this->load->view('templates/topbar', $isi);
        $this->load->view('pembayaran/t_pembayaran', $isi);
        $this->load->view('templates/footer1');
    }

    public function simpan()
    {
        // konfigurasi untuk upload gambar
        $config['upload_path'] = 'assets/img/pembayaran';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar');
        $file_name = $this->upload->data();

        $data = array(
            'id_pembayaran' => $this->input->post('id_pembayaran'),
            'nama_merchant' => $this->input->post('nama_merchant'),
            'nomor_pembayaran' => $this->input->post('nomor_pembayaran'),
            'atas_nama' => $this->input->post('atas_nama'),
            'gambar' => $file_name['file_name']
        );

        $query = $this->db->insert('pembayaran', $data);
        if ($query = true) {
            $this->session->set_flashdata('info', 'Data berhasil disimpan!');
            redirect('pembayaran');
        }
    }

    public function edit($id_pembayaran)
    {
        $isi['judul'] = 'Form Edit Metode Pembayaran';
        $isi['pembayaran'] = $this->M_Pembayaran->edit_pembayaran($id_pembayaran);
        $isi['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $isi);
        $this->load->view('templates/sidebar', $isi);
        $this->load->view('templates/topbar', $isi);
        $this->load->view('pembayaran/e_pembayaran', $isi);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id_pembayaran = $this->input->post('id_pembayaran');
        // konfigurasi untuk upload gambar
        $config['upload_path'] = 'assets/img/pembayaran';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);

        if (!empty($_FILES['gambar']['name'])) {
            $this->upload->do_upload('gambar');
            $upload = $this->upload->data();
            $gambar = $upload['file_name'];

            $data = array(
                'id_pembayaran' => $this->input->post('id_pembayaran'),
                'nama_merchant' => $this->input->post('nama_merchant'),
                'nomor_pembayaran' => $this->input->post('nomor_pembayaran'),
                'atas_nama' => $this->input->post('atas_nama'),
                'gambar' => $gambar,
            );

            $_id = $this->db->get_where('pembayaran', ['id_pembayaran' => $id_pembayaran])->row();
            // berfungsi untuk menghapus gambar yang digunakan sebelum diupdate
            $query = $this->M_Pembayaran->update($data, $id_pembayaran);
            if ($query = true) {
                $this->session->set_flashdata('info', 'Data berhasil diperbarui!');
                unlink('assets/img/pembayaran/' . $_id->gambar);
                // berfungsi untuk menghapus gambar yang digunakan sebelum diup
                redirect('pembayaran', 'refresh');
            }
        } else {
            $data = array(
                'id_pembayaran' => $this->input->post('id_pembayaran'),
                'nama_merchant' => $this->input->post('nama_merchant'),
                'nomor_pembayaran' => $this->input->post('nomor_pembayaran'),
                'atas_nama' => $this->input->post('atas_nama')
            );
            $query = $this->M_Pembayaran->update($data, $id_pembayaran);
            if ($query = true) {
                $this->session->set_flashdata('info', 'Data berhasil diperbarui!');
                redirect('pembayaran', 'refresh');
            }
        }
    }

    public function delete($id_pembayaran)
    {
        $query = $this->db->delete('pembayaran', ['id_pembayaran' => $id_pembayaran]);
        if ($query = true) {
            $this->session->set_flashdata('info', 'Data berhasil dihapus!');
            redirect('pembayaran', 'refresh'); // pembayaran di sini adalah Controller
        }
    }
}