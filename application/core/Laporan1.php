<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login_admin();
        cek_user_admin();
        $this->load->model('M_Laporan');
        $this->load->model('M_Riwayat');
        $this->load->model('M_Profil_Laundry');
    }

    public function index()
    {
        $data['judul'] = 'Laporan Data Transaksi';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['transaksi'] = $this->M_Laporan->getTransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/v_laporan', $data);
        $this->load->view('templates/footer');
    }

    public function tanggal()
    {
        $data['judul'] = 'Laporan Data Transaksi';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/f_laporan', $data);
        $this->load->view('templates/footer');
    }

    public function cetak()
    {
        $tgl_masuk = $this->input->post('tgl_masuk');
        $tgl_ambil = $this->input->post('tgl_ambil');
        $action = $this->input->post('action');

        // Set session buat tanggal
        $this->session->set_userdata('tgl_masuk', $tgl_masuk);
        $this->session->set_userdata('tgl_ambil', $tgl_ambil);

        // Ambil data profil dan transaksi
        $data['profil_laundry'] = $this->M_Profil_Laundry->getProfilLaundry();
        if ($tgl_masuk && $tgl_ambil) {
            $data['transaksi'] = $this->M_Laporan->filter_laporan($tgl_masuk, $tgl_ambil);
        } else {
            $data['transaksi'] = [];
        }

        // Pesan kalo gaada data transaksi
        if (empty($data['transaksi'])) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Tidak ada transaksi  pada interval tanggal yang dipilih! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button></div>');
            redirect('laporan/tanggal');
        }

        // Action dari opsi cetak yang dipilih
        if ($action == 'print') {
            $this->load->view('laporan/laporan_print', $data);
        } elseif ($action == 'pdf') {
            $sroot = $_SERVER['DOCUMENT_ROOT'];
            include $sroot . "/dinsa/application/third_party/dompdf/autoload.inc.php";
            $dompdf = new Dompdf\Dompdf();

            $html = $this->load->view('laporan/laporan_pdf', $data, true);

            $dompdf->set_paper('A4', 'landscape');
            $dompdf->load_html($html);
            $dompdf->render();

            $dompdf->stream("Laporan Transaksi Tanggal $tgl_masuk - Tanggal $tgl_ambil.pdf", array('Attachment' => 0));
        } elseif ($action == 'excel') {
            $data = array(
                'title' => 'Laporan Detail Pesanan',
                'profil_laundry' => $this->M_Profil_Laundry->getProfilLaundry(),
                'transaksi' => $this->M_Laporan->filter_laporan($tgl_masuk, $tgl_ambil)
            );
            $this->load->view('laporan/laporan_excel', $data);
        }
    }
}