<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Krisar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek_login_admin();
        $this->load->model("M_Keranjang");
        $this->load->model('M_Krisar');
        $this->load->model('M_Profil_Laundry');
        if (in_array($this->router->fetch_method(), ['index', 'cetak', 'laporan_krisar_print', 'laporan_krisar_pdf', 'laporan_krisar_excel'])) {
            cek_login_admin();
        }
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
        // Misalnya id_user diambil dari session

        // ini ada notif keranjang soalnya krisar frontend butuh notif keranjang di topbar

        $id_pelanggan = $this->session->userdata('id_pelanggan');

        if ($id_pelanggan) {
            $notif_keranjang = $this->M_Keranjang->get_notif_keranjang($id_pelanggan);
            // Data ini bisa digunakan dalam view jika dibutuhkan
            $this->data['notif_keranjang'] = $notif_keranjang;
        } else {
            // Jika id_user tidak ada, tangani sesuai kebutuhan
            $this->data['notif_keranjang'] = 0;
        }


        $data['judul'] = 'Data Kritik dan Saran';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['krisar'] = $this->M_Krisar->getAllDataKrisar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('krisar/v_krisar', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Kritik & Saran | Dinsa Laundry';
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $profil = $this->getProfilLaundry();


        $this->form_validation->set_rules('nama_pelanggan', 'nama_pelanggan', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('kritik_saran', 'kritik_saran', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['nama_laundry'] = $profil['nama_laundry'];
            $data['deskripsi'] = $profil['deskripsi'];
            $data['alamat'] = $profil['alamat'];
            $data['email'] = $profil['email'];
            $data['nomor_telepon'] = $profil['nomor_telepon'];
            $data['link_maps'] = $profil['link_maps'];

            $this->load->view('frontend/header1', $data);
            $this->load->view('frontend/modal');
            $this->load->view('frontend/krisar/krisar', $data);
            $this->load->view('frontend/footer', $data);
        } else {
            $this->M_Krisar->save();
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat!</strong> Anda Berhasil Mengirim Kritik dan Saran!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('krisar/tambah');
        }
    }

    public function hapus($id_saran)
    {
        $_id = $this->db->get_where('krisar', ['id_saran' => $id_saran])->row();
        $query = $this->db->delete('krisar', ['id_saran' => $id_saran]);
        if ($query = true) {
            $this->session->set_flashdata('info', 'Data berhasil dihapus!');
            redirect('krisar', 'refresh'); // krisar di sini adalah Controller

        }
    }

    public function cetak()
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


        $data['judul'] = 'Laporan Kritik dan Saran';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['krisar'] = $this->M_Krisar->getAllDataKrisar();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('krisar/laporan_krisar', $data);
        $this->load->view('templates/footer');
    }

    public function laporan_krisar_print()
    {
        $data['profil_laundry'] = $this->M_Profil_Laundry->getProfilLaundry();
        $data['krisar'] = $this->M_Krisar->getAllDataKrisar();
        $data['judul'] = 'Laporan Kritik dan Saran';

        $this->load->view('krisar/laporan_print_krisar', $data);
    }
    public function laporan_krisar_pdf()
    {
        $data['profil_laundry'] = $this->M_Profil_Laundry->getProfilLaundry();
        $data['krisar'] = $this->M_Krisar->getAllDataKrisar();
        $data['judul'] = 'Laporan Kritik dan Saran';

        $sroot = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/dinsa/application/third_party/dompdf/autoload.inc.php";

        $dompdf = new Dompdf\Dompdf();
        $this->load->view('krisar/laporan_pdf_krisar', $data);
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $dompdf->set_paper($paper_size, $orientation);
        //Convert to PDF
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream(
            "Laporan Kritik dan Saran",
            array(
                'Attachment' => 0
            )
        );
    }

    public function laporan_krisar_excel()
    {
        $data = array(
            'title' => 'Laporan Kritik dan Saran',
            'profil_laundry' => $this->M_Profil_Laundry->getProfilLaundry(),
            'krisar' => $this->M_Krisar->getAllDataKrisar()
        );
        $this->load->view('krisar/laporan_excel_krisar', $data);
    }
}
