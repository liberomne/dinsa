<?php

class Baju extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        cek_login_admin();
        $this->load->model('M_Baju');
        $this->load->library('session');
    }
    public function index()
    {
        $isi['judul'] = 'Daftar Jenis Laundry';
        $isi['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $isi['baju'] = $this->M_Baju->getBaju();
        $this->load->view('templates/header', $isi);
        $this->load->view('templates/sidebar', $isi);
        $this->load->view('templates/topbar', $isi);
        $this->load->view('baju/v_baju', $isi);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $isi['judul'] = 'Form Tambah Jenis Laundry';
        $isi['kode_katalog'] = $this->M_Baju->generate_kode_baju();
        $isi['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $isi);
        $this->load->view('templates/sidebar', $isi);
        $this->load->view('templates/topbar', $isi);
        $this->load->view('baju/t_baju', $isi);
        $this->load->view('templates/footer1');
    }

    public function simpan()
    {
        // konfigurasi untuk upload gambar
        $config['upload_path'] = 'assets/img/baju';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $this->load->library('upload', $config);
        $this->upload->do_upload('gambar');
        $file_name = $this->upload->data();

        // Mendapatkan id_admin dari sesi
        $admin = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $id_admin = $admin['id_admin'];

        $data = array(
            'kode_katalog' => $this->input->post('kode_katalog'),
            'id_admin' => $id_admin,
            'jenis_katalog' => $this->input->post('jenis_katalog'),
            'detail_katalog' => $this->input->post('detail_katalog'),
            'harga_satuan' => $this->input->post('harga_satuan'),
            'gambar' => $file_name['file_name']
        );

        $query = $this->db->insert('katalog', $data);
        if ($query = true) {
            $this->session->set_flashdata('info', 'Data berhasil disimpan!');
            redirect('baju');
        }
    }

    public function edit($kode_katalog)
    {
        $isi['judul'] = 'Form Ubah Jenis Laundry';
        $isi['baju'] = $this->M_Baju->edit_baju($kode_katalog);
        $isi['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $isi);
        $this->load->view('templates/sidebar', $isi);
        $this->load->view('templates/topbar', $isi);
        $this->load->view('baju/e_baju', $isi);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $kode_katalog = $this->input->post('kode_katalog');
        // konfigurasi untuk upload gambar
        $config['upload_path'] = 'assets/img/baju';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);

        // Mendapatkan id_admin dari sesi
        $admin = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $id_admin = $admin['id_admin'];

        if (!empty($_FILES['gambar']['name'])) {
            $this->upload->do_upload('gambar');
            $upload = $this->upload->data();
            $gambar = $upload['file_name'];

            $data = array(
                'kode_katalog' => $this->input->post('kode_katalog'),
                'id_admin' => $id_admin,
                'jenis_katalog' => $this->input->post('jenis_katalog'),
                'detail_katalog' => $this->input->post('detail_katalog'),
                'harga_satuan' => $this->input->post('harga_satuan'),
                'gambar' => $gambar
            );

            $_id = $this->db->get_where('katalog', ['kode_katalog' => $kode_katalog])->row();
            // berfungsi untuk menghapus gambar yang digunakan sebelum diupdate
            $query = $this->M_Baju->update($data, $kode_katalog);
            if ($query = true) {
                $this->session->set_flashdata('info', 'Data berhasil diperbarui!');
                unlink('assets/img/baju/' . $_id->gambar);
                // berfungsi untuk menghapus gambar yang digunakan sebelum diup
                redirect('baju', 'refresh');
            }
        } else {
            $data = array(
                'kode_katalog' => $this->input->post('kode_katalog'),
                'id_admin' => $id_admin,
                'jenis_katalog' => $this->input->post('jenis_katalog'),
                'detail_katalog' => $this->input->post('detail_katalog'),
                'harga_satuan' => $this->input->post('harga_satuan')
            );
            $query = $this->M_Baju->update($data, $kode_katalog);
            if ($query = true) {
                $this->session->set_flashdata('info', 'Data berhasil diperbarui!');
                redirect('baju', 'refresh');
            }
        }
    }

    public function delete($kode_katalog)
    {
        $_id = $this->db->get_where('katalog', ['kode_katalog' => $kode_katalog])->row();
        $query = $this->db->delete('katalog', ['kode_katalog' => $kode_katalog]);
        if ($query = true) {
            unlink('assets/img/baju/' . $_id->gambar);
            $this->session->set_flashdata('info', 'Data berhasil dihapus!');
            redirect('baju', 'refresh'); // baju di sini adalah Controller
        }
    }
}
