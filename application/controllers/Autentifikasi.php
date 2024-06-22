<?php
class Autentifikasi extends CI_Controller
{
    public function index()
    {
        //jika statusnya sudah login, maka tidak bisa mengakses halaman login alias dikembalikan ke tampilan user
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        $this->form_validation->set_rules(
            'email',
            'Alamat Email',
            'required|trim|valid_email',
            [
                'required' => 'Kolom email harus diisi.',
                'valid_email' => 'Email tidak benar.'
            ]
        );

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            [
                'required' => 'Kolom password harus diisi.'
            ]
        );

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Dinsa Laundry | Masuk';
            $data['admin'] = '';

            //kata 'login' merupakan nilai dari variabel judul dalam array $data dikirimkan ke view aute_header
            $this->load->view('templates/aute_header', $data);
            $this->load->view('autentifikasi/login');
            $this->load->view('templates/aute_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {

        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $admin = $this->M_Admin->cekData(['email' => $email])->row_array();
        $admin['image'] == 'default.jpg';

        //jika usernya ada
        if ($admin) {
            //cek password
            if (password_verify($password, $admin['password'])) {
                $data = [
                    'email' => $admin['email'],
                    'id_admin' => $admin['id_admin']
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamat datang!</strong> Anda berhasil masuk sebagai admin!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('admin');

            } else {
                $this->session->set_flashdata('email_value', $email);
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Password salah</div>');
                redirect('autentifikasi');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Email tidak terdaftar</div>');
            redirect('autentifikasi');
        }
    }

    public function keluar()
    {
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Anda telah keluar!</div>');
        redirect('autentifikasi');
    }
    public function blok()
    {
        $this->load->view('autentifikasi/blok');
    }
    public function gagal()
    {
        $this->load->view('autentifikasi/gagal');
    }

    public function registrasi()
    {
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        //membuat rule untuk inputan nama agar tidak boleh kosong
        //dengan membuat pesan error dengan
        //bahasa sendiri yaitu 'Nama Belum diisi'
        $this->form_validation->set_rules(
            'nama',
            'Nama Lengkap',
            'required',
            [
                'required' => 'Kolom nama harus diisi.'
            ]
        );
        //membuat rule untuk inputan email agar tidak boleh kosong,
        //tidak ada spasi, format email harus valid
        //dan email belum pernah dipakai sama user lain dengan
        //membuat pesan error dengan bahasa sendiri
        ////yaitu jika format email tidak benar maka pesannya 'Email
        //Tidak Benar!!'. jika email belum diisi,
        //maka pesannya adalah 'Email Belum diisi', dan jika email
        //yang diinput sudah dipakai user lain,
        //maka pesannya 'Email Sudah dipakai'
        $this->form_validation->set_rules(
            'email',
            'Alamat Email',
            'required|trim|valid_email|is_unique[admin.email]',
            [
                'valid_email' => 'Email yang anda masukkan bukan dalam format email.',
                'required' => 'Kolom email harus di isi.',
                'is_unique' => 'Email sudah terdaftar, silahkan gunakan email lain.'
            ]
        );
        //membuat rule untuk inputan password agar tidak boleh
        //kosong, tidak ada spasi, tidak boleh kurang dari
        //dari 3 digit, dan password harus sama dengan repeat
        //password dengan membuat pesan error dengan
        //bahasa sendiri yaitu jika password dan repeat password
        //tidak diinput sama, maka pesannya
        //'Password Tidak Sama'. jika password diisi kurang dari 3
        //digit, maka pesannya adalah
        //'Password Terlalu Pendek'.
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'matches' => 'Password tidak sesuai.',
                'required' => 'Kolom password harus diisi.',
                'min_length' => 'Password minimal 3 karakter.'
            ]
        );
        $this->form_validation->set_rules(
            'password2',
            'RepeatPassword',
            'required|trim|matches[password1]',
            [
                'matches' => 'Password tidak sesuai.',
                'required' => 'Kolom ulangi password harus diisi.',
                'min_length' => 'Password terlalu sedikit, minimal 3 karakter.'
            ]
        );
        //jika jida disubmit kemudian validasi form diatas tidak
        //berjalan, maka akan tetap berada di
        //tampilan registrasi. tapi jika disubmit kemudian validasi
        //form diatas berjalan, maka data yang
        //diinput akan disimpan ke dalam tabel user
        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Dinsa Laundry | Daftar';
            $this->load->view('templates/aute_header', $data);
            $this->load->view('autentifikasi/registrasi');
            $this->load->view('templates/aute_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'tanggal_input' => time()
            ];
            $this->M_Admin->simpanData($data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Berhasil mendaftarkan akun, silahkan masuk ke akun anda.</div>');
            redirect('autentifikasi');
        }
    }
}
