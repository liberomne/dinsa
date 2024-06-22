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
?>

<div class="container-fluid">

    <?= $this->session->flashdata('info'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) { ?>

                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('info'); ?>

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">
                <?= $judul; ?>
            </h1>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <?= $judul; ?>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <a href="<?= base_url() ?>laporan/tanggal" class="btn btn-primary">Pilih Tanggal</a>
                        </div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>
                                        <center>No.</center>
                                    </th>
                                    <th>
                                        <center>Tanggal Masuk</center>
                                    </th>
                                    <th>
                                        <center>Kode Transaksi</center>
                                    </th>
                                    <th>
                                        <center>Nama</center>
                                    </th>
                                    <th>
                                        <center>Jenis laundry</center>
                                    </th>
                                    <th>
                                        <center>Harga (Rp)</center>
                                    </th>
                                    <th>
                                        <center>Jumlah</center>
                                    </th>
                                    <th>
                                        <center>Subtotal (Rp)</center>
                                    </th>
                                    <th>
                                        <center>Total Bayar</center>
                                    </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($transaksi as $tr) :
                                    if ($tr['status'] == 'Selesai') {
                                        // Pastiin ada "tgl_masuk" di $transaksi
                                        if (isset($tr['tgl_masuk'])) {
                                            // Ubah tanggal ke format Indonesia
                                            $tanggalMasuk = new DateTime($tr['tgl_masuk']);
                                            $hari = $tanggalMasuk->format('d');
                                            $bulan = $bulanIndonesia[(int) $tanggalMasuk->format('m')];
                                            $tahun = $tanggalMasuk->format('Y');
                                            $tanggalMasukFormatted = $hari . ' ' . $bulan . ' ' . $tahun;
                                        } else {
                                            $tanggalMasukFormatted = '-';
                                        } ?>
                                        <tr>
                                            <td>
                                                <center><?= $no++; ?></center>

                                            </td>
                                            <td>
                                                <center><?= $tanggalMasukFormatted; ?></center>
                                            </td>
                                            <td>
                                                <center><?= $tr['kode_transaksi']; ?></center>
                                            </td>
                                            <td><?= $tr['nama']; ?></td>
                                            <td><?= $tr['jenis_katalog']; ?></td>
                                            <td>
                                                <center><?= $tr['harga_satuan']; ?></center>
                                            </td>
                                            <td>
                                                <center><?= $tr['jumlah']; ?></center>
                                            </td>
                                            <td>
                                                <center><?= $tr['subtotal']; ?></center>
                                            </td>
                                            <td>
                                                <center><?= "Rp" . number_format($tr['total_bayar'], 0, ',', '.'); ?></center>
                                            </td>
                                        </tr>
                                <?php }
                                endforeach; ?>
                            </tbody>
                        </table> <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>