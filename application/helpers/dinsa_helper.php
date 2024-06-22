<?php
function cek_login_admin()
{

    $ci = get_instance();
    $ci->load->model('M_Admin');

    if (!$ci->session->userdata('email')) {
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Akses ditolak!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('home');
    } else {
        $email = $ci->session->userdata('email');
        $is_admin = $ci->M_Admin->is_admin($email);

        if (!$is_admin) {
            $ci->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Akses tidak diizinkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('home');
        }
    }
}

function cek_login_pelanggan()
{
    $ci = get_instance();
    $ci->load->model('M_Pelanggan');
    $ci->load->model('M_Admin'); // Load model admin untuk memeriksa login admin

    $email = $ci->session->userdata('email');

    // Jika tidak ada sesi login (tidak ada admin atau pelanggan yang login), halaman bisa diakses
    if (empty($email)) {
        return;
    }

    $is_pelanggan = $ci->M_Pelanggan->is_pelanggan($email);
    $is_admin = $ci->M_Admin->is_admin($email); // Memeriksa apakah email adalah admin

    // Jika pengguna login tetapi bukan pelanggan, atau jika pengguna adalah admin, akses ditolak
    if (!$is_pelanggan || $is_admin) {
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Akses tidak diizinkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('admin'); // Redirect ke halaman autentifikasi jika akses tidak diizinkan
    }
}

function cek_login_pelanggan1()
{
    $ci = get_instance();
    $ci->load->model('M_Pelanggan');
    $email = $ci->session->userdata('email');

    // Cek apakah pengguna sudah login
    if (empty($email)) {
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Anda harus login terlebih dahulu!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('home');
        return;
    }

    // Cek apakah pengguna adalah pelanggan
    $is_pelanggan = $ci->M_Pelanggan->is_pelanggan($email);

    if (!$is_pelanggan) {
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Akses tidak diizinkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('admin');
    }
}
