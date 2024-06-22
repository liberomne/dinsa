<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      cek_login_admin();
      $this->load->model('M_Baju');
   }

   public function index()
   {
      $data['judul'] = 'Dasbor';
      $data['admin'] = $this->M_Admin->cekData(['email' => $this->session->userdata('email')])->row_array();
      $data['anggota'] = $this->M_Admin->getUserLimit()->result_array();

      $data['total_jenis'] = $this->M_Baju->total_jenis();
      $data['total_metode_pembayaran'] = $this->M_Baju->total_metode_pembayaran();
      $data['total_transaksi'] = $this->M_Baju->total_transaksi();
      $data['total_krisar'] = $this->M_Baju->total_krisar();
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('admin/index', $data);
      $this->load->view('templates/footer');
   }

   public function getProfilLaundry()
   {
      $getProfil = $this->db->query("SELECT * FROM profil_laundry");
      foreach ($getProfil->result_array() as $profil) {
         $arr['nama_laundry'] = $profil['nama_laundry'];
         $arr['deskripsi'] = $profil['deskripsi'];
         $arr['alamat'] = $profil['alamat'];
         $arr['nomor_telepon'] = $profil['nomor_telepon'];
         $arr['link_maps'] = $profil['link_maps'];
         $arr['email'] = $profil['email'];
         $arr['gambar'] = $profil['gambar'];
      }
      return $arr;
   }

}