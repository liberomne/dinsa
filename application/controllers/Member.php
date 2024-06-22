<?php
class Member extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // cek_login_pelanggan1();
        $this->load->model("M_Pelanggan");
        $this->load->model("M_Keranjang");
        $this->load->model("M_Pembayaran");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->_login();
        $id_pelanggan = $this->session->userdata('id_pelanggan');

        if ($id_pelanggan) {
            $notif_keranjang = $this->M_Keranjang->get_notif_keranjang($id_pelanggan);
            // Data ini bisa digunakan dalam view jika dibutuhkan
            $this->data['notif_keranjang'] = $notif_keranjang;
        } else {
            // Jika id_user tidak ada, tangani sesuai kebutuhan
            $this->data['notif_keranjang'] = 0;
        }

        $data['judul'] = 'Dinsa Laundry | Home';
        $data['pelanggan'] = $this->M_Pelanggan->cekData(['email' => $this->session->userdata('email')])->row_array();
        $profil = $this->getProfilLaundry();
        $data['pembayaran'] = $this->M_Pembayaran->getPembayaran();
        // $data['gambar_menu'] = $this->Gambarmenu_model->getAllGambar();
        $data['nama_laundry'] = $profil['nama_laundry'];
        $data['deskripsi'] = $profil['deskripsi'];
        $data['alamat'] = $profil['alamat'];
        $data['email'] = $profil['email'];
        $data['nomor_telepon'] = $profil['nomor_telepon'];
        $data['link_maps'] = $profil['link_maps'];
        $data['gambar'] = $profil['gambar'];
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
            $arr['gambar'] = $profil['gambar'];
        }
        return $arr;
    }
    private function _login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $pelanggan = $this->M_Pelanggan->cekData(['email' => $email])->row_array();

        //jika usernya ada
        if ($pelanggan) {
            //cek password
            if (password_verify($password, $pelanggan['password'])) {
                $data = [
                    'email' => $pelanggan['email'],
                    'id_pelanggan' => $pelanggan['id_pelanggan'],
                    'nama' => $pelanggan['nama']
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat datang!</strong> Anda berhasil masuk sebagai pelanggan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('home');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Maaf!</strong> Password salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('home');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf!</strong> Email tidak terdaftar!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            redirect('home');
        }
    }


    public function daftar()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
            'required' => 'Nama belum diisi.'
        ]);
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[pelanggan.email]', [
            'valid_email' => 'Bukan dalam format email.',
            'required' => 'Email belum diisi.',
            'is_unique' => 'Email sudah terdaftar.'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak sesuai.',
            'required' => 'Kolom password harus diisi.',
            'min_length' => 'Password minimal 3 karakter.'
        ]);
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]', [
            'matches' => 'Password tidak sesuai.',
            'required' => 'Kolom password harus diisi.'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Maaf!</strong> Cek email dan password yang didaftarkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>');
            // Jika validasi gagal, tampilkan kembali modal pendaftaran dengan pesan kesalahan
            $data['judul'] = 'Dinsa Laundry | Home';
            $data['pelanggan'] = $this->M_Pelanggan->cekData(['email' => $this->session->userdata('email')])->row_array();
            $profil = $this->getProfilLaundry();
            $data['pembayaran'] = $this->M_Pembayaran->getPembayaran();
            // $data['gambar_menu'] = $this->Gambarmenu_model->getAllGambar();
            $data['nama_laundry'] = $profil['nama_laundry'];
            $data['deskripsi'] = $profil['deskripsi'];
            $data['alamat'] = $profil['alamat'];
            $data['email'] = $profil['email'];
            $data['nomor_telepon'] = $profil['nomor_telepon'];
            $data['link_maps'] = $profil['link_maps'];
            $data['gambar'] = $profil['gambar'];
            $data['pelanggan'] = 'pengunjung';
            $this->load->view('frontend/header', $data);
            // $this->load->view('frontend/modal_daftar');
            $this->load->view('frontend/modal');
            $this->load->view('frontend/home/home', $data);
            $this->load->view('frontend/footer', $data);
        } else {
            // Jika validasi berhasil, simpan data ke database dan tampilkan pesan sukses
            // Proses pendaftaran disini
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                // 'alamat'        => $this->input->post('alamat', true),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'tanggal_input' => time()
            ];
            $this->M_Pelanggan->simpanData($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Akun pelanggan berhasil dibuat!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect(base_url());
        }
    }

    public function myProfil()
    {
        $pelanggan = $this->M_Pelanggan->cekData(['email' => $this->session->userdata('email')])->row_array();
        foreach ($pelanggan as $a) {
            $data = [
                'image' => $pelanggan['image'],
                'pelanggan' => $pelanggan['nama'],
                'email' => $pelanggan['email'],
                'tanggal_input' => $pelanggan['tanggal_input'],
            ];
        }
        $data['judul'] = 'Profil Saya | Dinsa Laundry';
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $profil = $this->getProfilLaundry();
        // $data['gambar_menu'] = $this->Gambarmenu_model->getAllGambar();
        $data['nama_laundry'] = $profil['nama_laundry'];
        $data['deskripsi'] = $profil['deskripsi'];
        $data['alamat'] = $profil['alamat'];
        $data['email'] = $profil['email'];
        $data['nomor_telepon'] = $profil['nomor_telepon'];
        $data['link_maps'] = $profil['link_maps'];
        $this->load->view('frontend/header1', $data);
        $this->load->view('frontend/modal');
        $this->load->view('frontend/member/index', $data);
        $this->load->view('frontend/footer', $data);
    }

    public function ubahProfil()
    {
        $data['judul'] = 'Ubah Profil | Dinsa Laundry';
        $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak Boleh Kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Profil Saya';
            $pelanggan = $this->M_Pelanggan->cekData(['email' => $this->session->userdata('email')])->row_array();
            foreach ($pelanggan as $a) {
                $data = [
                    'image' => $pelanggan['image'],
                    'pelanggan' => $pelanggan['nama'],
                    'email' => $pelanggan['email'],
                    'tanggal_input' => $pelanggan['tanggal_input'],
                ];
            }
            $profil = $this->getProfilLaundry();
            // $data['gambar_menu'] = $this->Gambarmenu_model->getAllGambar();
            $data['nama_laundry'] = $profil['nama_laundry'];
            $data['deskripsi'] = $profil['deskripsi'];
            $data['alamat'] = $profil['alamat'];
            $data['email'] = $profil['email'];
            $data['nomor_telepon'] = $profil['nomor_telepon'];
            $data['link_maps'] = $profil['link_maps'];
            $data['judul'] = 'Ubah Profil | Dinsa Laundry';
            $data['pelanggan'] = $this->db->get_where('pelanggan', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('frontend/header1', $data);
            $this->load->view('frontend/modal');
            $this->load->view('frontend/member/ubah-profil', $data);
            $this->load->view('frontend/footer', $data);
        } else {
            $nama = $this->input->post('nama', true);
            $email = $this->input->post('email', true);
            //jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/img/profil/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3000';
                $config['max_width'] = '1024';
                $config['max_height'] = '1000';
                $config['file_name'] = 'pro' . time();
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $gambar_lama = $data['pelanggan']['image'];
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profil_pelanggan/' . $gambar_lama);
                    }
                    $gambar_baru = $this->upload->data('file_name');
                    $this->db->set('image', $gambar_baru);
                } else {
                }
            }
            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('pelanggan');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> Profil berhasil diubah!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('member/myprofil');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message btn-close" role="alert">Anda telah keluar.</div>');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Terima kasih!</strong> Anda berhasil keluar.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');

        redirect('home');
    }
}
