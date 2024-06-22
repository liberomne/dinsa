<?php
// bulan dalam bahasa Indonesia
$bulanIndonesia = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
];

// Periksa apakah tanggal_input adalah timestamp Unix
if (is_numeric($admin['tanggal_input'])) {
    // Ubah timestamp Unix ke DateTime
    $tanggalInput = new DateTime();
    $tanggalInput->setTimestamp($admin['tanggal_input']);
} else {
    // Buat objek DateTime dari string tanggal
    $tanggalInput = new DateTime($admin['tanggal_input']);
}

$hari = $tanggalInput->format('d');
$bulan = $bulanIndonesia[(int) $tanggalInput->format('m')];
$tahun = $tanggalInput->format('Y');

// Gabungin format tanggal Indonesia
$tanggalFormatted = $hari . ' ' . $bulan . ' ' . $tahun;
?>

<!-- DataTales Example -->
<div class="container mt-3">
    <div class="col-lg-4 justify-content-x">
        <?= $this->session->flashdata('pesan'); ?>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <img src="<?= base_url('assets/img/profil/') . $admin['image']; ?>" alt="<?= $admin['nama']; ?>"
                        class="img-thumbnail">
                </div>
                <div class="col-sm-9 p-2">
                    <h5 class="card-title"><?= $admin['nama']; ?></h5>
                    <p class="card-text"><?= $admin['email']; ?></p>
                    <p class="card-text">Daftar sejak <?= $tanggalFormatted; ?></p>
                    <a href="<?= base_url('user/ubahprofil/'); ?>" class="btn btn-primary">Ubah Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>