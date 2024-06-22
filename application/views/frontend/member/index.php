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

// Periksa tanggal_input timestamp Unix apa bukan
if (is_numeric($pelanggan['tanggal_input'])) {
    // Ubah timestamp Unix ke DateTime
    $tanggalInput = new DateTime();
    $tanggalInput->setTimestamp($pelanggan['tanggal_input']);
} else {
    // Buat objek DateTime dari string tanggal
    $tanggalInput = new DateTime($pelanggan['tanggal_input']);
}

$hari = $tanggalInput->format('d');
$bulan = $bulanIndonesia[(int) $tanggalInput->format('m')];
$tahun = $tanggalInput->format('Y');

// Ubah ke format tanggal Indonesia
$tanggalFormatted = $hari . ' ' . $bulan . ' ' . $tahun;
?>

<!-- DataTales Example -->
<div class="container mt-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <img src="<?= base_url('assets/img/profil/') . $pelanggan['image']; ?>" alt="<?= $pelanggan['nama']; ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9 p-2">
                    <h5 class="card-title"><?= $pelanggan['nama']; ?></h5>
                    <p class="card-text"><?= $pelanggan['email']; ?></p>
                    <p class="card-text">Daftar sejak <?= $tanggalFormatted; ?></p>
                    <a href="<?= base_url('member/ubahProfil/'); ?>" class="btn btn-primary">Ubah Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>