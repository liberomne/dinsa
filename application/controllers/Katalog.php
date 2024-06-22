<?php

class Katalog extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_pelanggan();
        $this->load->model("M_Katalog");
        $this->load->model("M_Keranjang");
        $this->load->model("M_Home");
        $this->load->model("M_Pelanggan");
    }

    public function getProfilLaundry()
    {
        $getProfil = $this->db->query("SELECT * FROM profil_laundry");
        foreach ($getProfil->result_array() as $profil) {
            $arr['nama_laundry'] = $profil['nama_laundry'];
            $arr['deskripsi'] = $profil['deskripsi'];
            $arr['alamat'] = $profil['alamat'];
            $arr['email'] = $profil['email'];
            $arr['nomor_telepon'] = $profil['nomor_telepon'];
            $arr['link_maps'] = $profil['link_maps'];
        }
        return $arr;
    }

    public function index()
    {
        // $data = $this->data;

        // Misalnya id_user diambil dari session
        $id_pelanggan = $this->session->userdata('id_pelanggan');

        if ($id_pelanggan) {
            $notif_keranjang = $this->M_Keranjang->get_notif_keranjang($id_pelanggan);
            // Data ini bisa digunakan dalam view jika dibutuhkan
            $this->data['notif_keranjang'] = $notif_keranjang;
        } else {
            // Jika id_user tidak ada, tangani sesuai kebutuhan
            $this->data['notif_keranjang'] = 0;
        }

        
        $data['judul'] = 'Katalog | Dinsa Laundry';
        $data['pelanggan'] = $this->M_Pelanggan->cekData(['email' => $this->session->userdata('email')])->row_array();
        $profil = $this->getProfilLaundry();
        $data['baju'] = $this->M_Katalog->getBaju();
        $data['nama_laundry'] = $profil['nama_laundry'];
        $data['deskripsi'] = $profil['deskripsi'];
        $data['alamat'] = $profil['alamat'];
        $data['email'] = $profil['email'];
        $data['nomor_telepon'] = $profil['nomor_telepon'];
        $data['link_maps'] = $profil['link_maps'];

        //jika sudah login dan jika belum login
        if ($this->session->userdata('email')) {
            $pelanggan = $this->M_Pelanggan->cekData(['email' => $this->session->userdata('email')])->row_array();
            $data['pelanggan'] = $pelanggan['nama'];
            $this->load->view('frontend/header', $data);
            $this->load->view('frontend/modal');
            $this->load->view('frontend/katalog/katalog', $data);
            $this->load->view('frontend/footer', $data);

        } else {
            $data['judul'] = 'Katalog | Dinsa Laundry';
            $profil = $this->getProfilLaundry();
            $data['nama_laundry'] = $profil['nama_laundry'];
            $data['deskripsi'] = $profil['deskripsi'];
            $data['alamat'] = $profil['alamat'];
            $data['email'] = $profil['email'];
            $data['nomor_telepon'] = $profil['nomor_telepon'];
            $data['link_maps'] = $profil['link_maps'];
            $data['pelanggan'] = 'pengunjung';
            $this->load->view('frontend/header', $data);
            $this->load->view('frontend/modal');
            $this->load->view('frontend/katalog/katalog', $data);
            $this->load->view('frontend/footer', $data);
        }
    }
}