<?php

class Keranjang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login_pelanggan1();
        $this->load->model("M_Keranjang");
        $this->load->model("M_Katalog");
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

        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $data['judul'] = 'Keranjang Anda | Dinsa Laundry';
        $data['pelanggan'] = $this->M_Pelanggan->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['keranjang'] = $this->M_Keranjang->getKeranjangByIdUser($id_pelanggan);

        $profil = $this->getProfilLaundry();
        $data['pembayaran'] = $this->db->get('pembayaran')->result();
        $data['baju'] = $this->M_Katalog->getBaju();
        $data['nama_laundry'] = $profil['nama_laundry'];
        $data['deskripsi'] = $profil['deskripsi'];
        $data['alamat'] = $profil['alamat'];
        $data['email'] = $profil['email'];
        $data['nomor_telepon'] = $profil['nomor_telepon'];
        $data['link_maps'] = $profil['link_maps'];


        $this->db->select('keranjang.*, katalog.*');
        $this->db->from('keranjang');
        $this->db->join('katalog', 'katalog.kode_katalog = keranjang.kode_katalog');
        $this->db->where('keranjang.lunas', 0);


        $data['keranjang'] = $this->db->get()->result_array();

        $totalBayar = 0;
        foreach ($data['keranjang'] as $keranjang) {
            if ($keranjang['id_pelanggan'] == $this->session->userdata('id_pelanggan')) {
                $totalBayar += $keranjang['subtotal'];
            }
            $data['total_bayar'] = $totalBayar;
        }


        if ($data['keranjang']) {
            $data['kode_transaksi'] = $data['keranjang'][0]['kode_transaksi'];
        }

        // Cek apakah keranjang pengguna sudah terisi atau tidak
        $keranjang = $this->M_Keranjang->getKeranjangByIdUser($id_pelanggan);

        if (empty($keranjang)) {
            // Jika kosong, arahkan pengguna ke halaman katalog atau beranda
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Silahkan masukkan barang ke keranjang terlebih dahulu!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('katalog'); // Ubah 'katalog' dengan halaman yang sesuai
            return; // Hentikan eksekusi method

        }

        //jika sudah login dan jika belum login
        if ($this->session->userdata('email')) {
            $pelanggan = $this->M_Pelanggan->cekData(['email' => $this->session->userdata('email')])->row_array();
            $data['pelanggan'] = $pelanggan['nama'];
            $this->load->view('frontend/header', $data);
            $this->load->view('frontend/modal');
            $this->load->view('frontend/keranjang/keranjang', $data);
            $this->load->view('frontend/footer', $data);

        } else {
            $data['judul'] = 'Keranjang Anda | Dinsa Laundry';
            $profil = $this->getProfilLaundry();
            // $data['gambar_menu'] = $this->Gambarmenu_model->getAllGambar();
            $data['nama_laundry'] = $profil['nama_laundry'];
            $data['deskripsi'] = $profil['deskripsi'];
            $data['alamat'] = $profil['alamat'];
            $data['email'] = $profil['email'];
            $data['nomor_telepon'] = $profil['nomor_telepon'];
            $data['link_maps'] = $profil['link_maps'];
            $data['pelanggan'] = 'pengunjung';
            $this->load->view('frontend/header', $data);
            $this->load->view('frontend/modal');
            $this->load->view('frontend/keranjang/keranjang', $data);
            $this->load->view('frontend/footer', $data);
        }
    }

    public function pesan($kode_katalog)
    {
        $katalog = $this->db->get_where('katalog', ['kode_katalog' => $kode_katalog])->row_array();
        $harga_satuan = $katalog['harga_satuan'];
        $jenis_katalog = $katalog['jenis_katalog'];

        $this->db->order_by('kode_transaksi', 'DESC');
        $this->db->limit(1);
        $keranjang = $this->db->get_where('keranjang', ['lunas' => 1])->row_array();
        $kode_transaksi = $keranjang['kode_transaksi'];

        $keranjangSudahAda = $this->db->get_where('keranjang', ['kode_katalog' => $kode_katalog, 'lunas' => 0])->row_array();

        $kode_katalogSudahAda = $keranjangSudahAda['kode_katalog'];


        // Periksa apakah ada transaksi yang belum lunas untuk pengguna saat ini
        $id_pelanggan = $this->session->userdata('id_pelanggan');

        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('lunas', 0);
        $this->db->order_by('kode_transaksi', 'DESC');
        $existing_transaction = $this->db->get('keranjang')->row();

        if ($existing_transaction) {
            // Jika ada transaksi yang belum lunas, gunakan kode transaksinya
            $kode_transaksi = $existing_transaction->kode_transaksi;
        } else {
            // Jika tidak ada, buat kode transaksi baru dengan format TRYYYYMMDDNNNN
            $date_part = date('Ymd'); // Mendapatkan tanggal saat ini dengan format YYYYMMDD

            // Ambil kode transaksi terakhir untuk hari ini
            $this->db->like('kode_transaksi', 'TR' . $date_part, 'after');
            $this->db->select_max('kode_transaksi');
            $query = $this->db->get('keranjang');
            $last_kode_transaksi = $query->row()->kode_transaksi;

            if ($last_kode_transaksi) {
                // Pisahkan bagian numerik dan tambahkan 1
                $last_number = (int) substr($last_kode_transaksi, 10); // Ambil bagian NNNN
                $new_number = $last_number + 1;
            } else {
                // Jika belum ada kode transaksi untuk hari ini, mulai dengan 1
                $new_number = 1;
            }

            // Gabungkan kembali dengan prefix 'TR' dan pastikan 4 digit dengan str_pad
            $kode_transaksi = 'TR' . $date_part . str_pad($new_number, 4, '0', STR_PAD_LEFT);
        }

        if ($kode_katalog == $kode_katalogSudahAda) {
            $data = [
                'kode_transaksi' => $keranjangSudahAda['kode_transaksi'],
                'kode_katalog' => $keranjangSudahAda['kode_katalog'],
                'jenis_katalog' => $keranjangSudahAda['jenis_katalog'],
                'id_pelanggan' => $keranjangSudahAda['id_pelanggan'],
                'nama' => $keranjangSudahAda['nama'],
                'tgl_masuk' => $keranjangSudahAda['tgl_masuk'],
                'jumlah' => $keranjangSudahAda['jumlah'] + 1,
                'subtotal' => $keranjangSudahAda['subtotal'] + $harga_satuan,
                'lunas' => 0
            ];

            $this->db->where('kode_katalog', $kode_katalog);
            $this->db->where('lunas', 0);
            $this->db->update('keranjang', $data);
        } else {
            $data = [
                'kode_transaksi' => $kode_transaksi,
                'kode_katalog' => $kode_katalog,
                'jenis_katalog' => $jenis_katalog,
                'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                'nama' => $this->session->userdata('nama'),
                'tgl_masuk' => date('Y-m-d'),
                'jumlah' => 1,
                'subtotal' => $harga_satuan,
                'lunas' => 0
            ];

            $this->db->insert('keranjang', $data);
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Barang berhasil masuk keranjang!</strong> Silahkan periksa jumlah barang sesuai yang anda butuhkan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

        redirect('katalog');
    }

    public function hapus($id_keranjang)
    {
        $this->db->where('id_keranjang', $id_keranjang);
        $this->db->delete('keranjang');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Barang berhasil dihapus!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        redirect('keranjang');
    }

    public function hapus_keranjang()
    {
        // Ambil id pengguna yang sedang login
        $id_pelanggan = $this->session->userdata('id_pelanggan');

        // Hapus semua pesanan keranjang yang dimiliki oleh pengguna yang sedang login
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->delete('keranjang');

        // Redirect kembali ke halaman keranjang setelah menghapus
        redirect('keranjang');
    }


    public function tambah($id_keranjang)
    {
        $this->db->select('keranjang.*, katalog.*');
        $this->db->from('keranjang');
        $this->db->join('katalog', 'katalog.kode_katalog = keranjang.kode_katalog');

        $this->db->where('id_keranjang', $id_keranjang);
        $keranjang = $this->db->get()->row_array();

        $data = [
            'jumlah' => $keranjang['jumlah'] + 1,
            'subtotal' => $keranjang['subtotal'] + $keranjang['harga_satuan']
        ];

        $this->db->where('id_keranjang', $id_keranjang);
        $this->db->update('keranjang', $data);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Barang berhasil ditambah!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        redirect('keranjang');
    }

    public function kurang($id_keranjang)
    {
        $this->db->select('keranjang.*, katalog.*');
        $this->db->from('keranjang');
        $this->db->join('katalog', 'katalog.kode_katalog = keranjang.kode_katalog');

        $this->db->where('id_keranjang', $id_keranjang);
        $keranjang = $this->db->get()->row_array();

        // Cek apakah jumlahnya sudah 1
        if ($keranjang['jumlah'] > 1) {
            $data = [
                'jumlah' => $keranjang['jumlah'] - 1,
                'subtotal' => $keranjang['subtotal'] - $keranjang['harga_satuan'],
            ];

            $this->db->where('id_keranjang', $id_keranjang);
            $this->db->update('keranjang', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Barang berhasil dikurang!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

        } else {
            // Pesan jika jumlah sudah 1
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Jumlah barang tidak bisa kurang dari 1!</strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>');
        }
        redirect('keranjang');
    }

    public function bayar($kode_transaksi)
    {

        $kode_transaksi = $this->input->post('kode_transaksi'); // Dapatkan kode transaksi dari input form
        // Dapatkan data yang diperlukan untuk pembayaran

        $id_pelanggan = $this->session->userdata('id_pelanggan');
        $nama = $this->input->post('nama');
        $tgl_masuk = $this->input->post('tgl_masuk');
        $tgl_ambil = '';
        $no_hp = $this->input->post('no_hp');
        $id_pembayaran = $this->input->post('id_pembayaran');
        $bukti = $_FILES['bukti']['name'];
        $alamat = $this->input->post('alamat');
        $status = $this->input->post('status');

        // konfigurasi untuk upload gambar
        $config['upload_path'] = 'assets/img/riwayat';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $this->load->library('upload', $config);
        $this->upload->do_upload('bukti');
        $file_name = $this->upload->data();

        $keranjang = $this->db->get_where('keranjang', ['kode_transaksi' => $kode_transaksi])->result_array();
        $totalBayar = 0;
        foreach ($keranjang as $p) {
            $totalBayar += $p['subtotal'];
        }

        $data = [
            'kode_transaksi' => $kode_transaksi,
            'id_pelanggan' => $this->session->userdata('id_pelanggan'),
            'nama' => $nama,
            'tgl_masuk' => $tgl_masuk,
            'tgl_ambil' => '',
            'no_hp' => $no_hp,
            'id_pembayaran' => $id_pembayaran,
            'bukti' => $file_name['file_name'],
            'alamat' => $alamat,
            'total_bayar' => $totalBayar,
            'status' => $status,
        ];

        $this->db->insert('transaksi', $data);

        $this->db->set('lunas', 1);
        $this->db->set('no_hp', $no_hp);
        $this->db->set('bukti', $bukti);
        $this->db->set('alamat', $alamat);
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('keranjang');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> 
                    <strong>Selamat!</strong> Pesanan anda sedang diproses. Silahkan cek pemesanan!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        redirect('cek_pemesanan');
    }
}