<?php
// Definisikan array bulan dalam bahasa Indonesia
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
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        <?= $judul; ?>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <?= $judul; ?>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="<?= base_url() ?>krisar/laporan_krisar_print/"
                    class="btn btn-primary mb-3"><i class="fas fa-print"></i></a>
                <a href="<?= base_url() ?>krisar/laporan_krisar_pdf/"
                    class="btn btn-danger mb-3"><i class="far fa-file-pdf"></i></a>
                <a href="<?= base_url() ?>krisar/laporan_krisar_excel/"
                    class="btn btn-success mb-3"><i class="far fa-file-excel"></i></a>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                <center>No.</center>
                            </th>
                            <th>
                                <center>Nama Pelanggan</center>
                            </th>
                            <th>
                                <center>Email</center>
                            </th>
                            <th>
                                <center>Tanggal</center>
                            </th>
                            <th>
                                <center>Kritik/Saran</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($krisar as $ks) {
                            // Periksa apakah kunci "tgl_masuk" ada di dalam array $tr
                            if (isset($ks->tanggal)) {
                                // Konversi tanggal ke format Indonesia
                                $tanggalInput = new DateTime($ks->tanggal);
                                $hari = $tanggalInput->format('d');
                                $bulan = $bulanIndonesia[(int) $tanggalInput->format('m')];
                                $tahun = $tanggalInput->format('Y');
                                $tanggalFormatted = $hari . ' ' . $bulan . ' ' . $tahun;
                            } else {
                                $tanggalFormatted = '-';
                            } ?>
                            <tr>
                                <td>
                                    <center><?= $no++; ?></center>
                                </td>
                                <td><?= $ks->nama_pelanggan; ?></td>
                                <td><?= $ks->email; ?></td>
                                <td>
                                    <center><?= $tanggalFormatted; ?></center>
                                </td>
                                <td><?= $ks->kritik_saran; ?></td>
                            </tr>
                        <?php }


                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>