<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_login_admin();
        // cek_user_admin();
        $this->load->model('M_Riwayat');
        $this->load->model('M_Laporan');
        $this->load->model('M_Keranjang');
        $this->load->model('M_Profil_Laundry');
        if (in_array($this->router->fetch_method(), ['index', 'update_status', 'detail', 'hapus'])) {
            cek_login_admin();
        }
    }
    public function index()
    {
        $data['judul'] = 'Data Riwayat Transaksi';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['data'] = $this->M_Riwayat->getAllDataRiwayat();
        $data['transaksi'] = $this->db->get_where('transaksi')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('riwayat/v_riwayat', $data);
        $this->load->view('templates/footer');
    }

    public function update_status()
    {
        $kode_transaksi = $this->input->post('kt');
        $status = $this->input->post('stt');
        date_default_timezone_set('Asia/Jakarta');
        $tgl_ambil = date('Y-m-d');
        // $status_bayar = 'Lunas';

        if ($status == "Baru" or $status == "Ditolak" or $status == "Penjemputan" or $status == "Sedang Dicuci" or $status == "Pengiriman") {
            $this->M_Riwayat->update_status($kode_transaksi, $status);
        } else {
            $this->M_Riwayat->update_status1($kode_transaksi, $status, $tgl_ambil);
        }
    }

    public function detail($kode_transaksi)
    {
        $data['judul'] = 'Detail Riwayat Transaksi';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['transaksi'] = $this->M_Riwayat->detail_transaksi($kode_transaksi);
        $data['keranjang'] = $this->M_Riwayat->detail_keranjang($kode_transaksi);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('riwayat/d_riwayat', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($kode_transaksi)
    {
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->delete('transaksi');

        redirect('riwayat');
    }

    public function laporan_detail_print($kode_transaksi)
    {
        $data['profil_laundry'] = $this->M_Profil_Laundry->getProfilLaundry();
        $data['transaksi'] = $this->M_Riwayat->detail_transaksi($kode_transaksi);
        $data['keranjang'] = $this->M_Riwayat->detail_keranjang($kode_transaksi);
        $pelanggan = $this->M_Pelanggan->cekData(['email' => $this->session->userdata('email')])->row_array();
        $namaPelanggan = isset($pelanggan['nama']) ? $pelanggan['nama'] : '';
        $data['judul'] = 'Laporan Detail Pesanan ' . $namaPelanggan;

        $this->load->view('riwayat/laporan_print_detail', $data);
    }
    
    public function laporan_detail_pdf($kode_transaksi)
    {
        $data['profil_laundry'] = $this->M_Profil_Laundry->getProfilLaundry();
        $data['transaksi'] = $this->M_Riwayat->detail_transaksi($kode_transaksi);
        $data['keranjang'] = $this->M_Riwayat->detail_keranjang($kode_transaksi);
        $pelanggan = $this->M_Pelanggan->cekData(['email' => $this->session->userdata('email')])->row_array();
        $namaPelanggan = isset($pelanggan['nama']) ? $pelanggan['nama'] : '';
        $data['judul'] = 'Laporan Detail Pesanan ' . $namaPelanggan;
        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/dinsa/application/third_party/dompdf/autoload.inc.php";

        $dompdf = new Dompdf\Dompdf();
        $this->load->view('riwayat/laporan_pdf_detail', $data);
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream(
            "$kode_transaksi",
            array(
                'Attachment' => 0
            )
        );
    }

    public function laporan_detail_excel($kode_transaksi)
    {
        $data = array(
            'title' => 'Laporan Detail Pesanan',
            'profil_laundry' => $this->M_Profil_Laundry->getProfilLaundry(),
            'transaksi' => $this->M_Riwayat->detail_transaksi($kode_transaksi),
            'keranjang' => $this->M_Riwayat->detail_keranjang($kode_transaksi)
        );
        $this->load->view('riwayat/laporan_excel_detail', $data);
    }
}
