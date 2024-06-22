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

<!-- Tentang Laundry -->
<section class="page-section">
    <div class="container">
        <div class="col-lg-12">
            <h3>Cek Pemesanan Laundry</h3>
        </div>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-5">
                    <thead>
                        <tr>
                            <th>
                                <center>No.</center>
                            </th>
                            <th>
                                <center>Kode Transaksi</center>
                            </th>
                            <th>
                                <center>Nama Pelanggan</center>
                            </th>
                            <th>
                                <center>Tanggal Transaksi</center>
                            </th>
                            <th>
                                <center>Total</center>
                            </th>
                            <th>
                                <center>Bukti Pembayaran</center>
                            </th>
                            <th>
                                <center>Status</center>
                            </th>
                            <th>
                                <center>Opsi</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($transaksi)) : ?>
                            <tr>
                                <td colspan="8" class="text-white bg-secondary">
                                    <center>Belum ada transaksi</center>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php
                            $no = 1;
                            foreach ($transaksi as $tr) :
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
                                        <center><?= $tr['kode_transaksi']; ?></center>
                                    </td>
                                    <td>
                                        <center><?= $tr['nama']; ?></center>
                                    </td>
                                    <td>
                                        <center><?= $tanggalMasukFormatted; ?></center>
                                    </td>
                                    <td>
                                        <center><?= 'Rp' . number_format($tr['total_bayar'], 0, ',', '.'); ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?= base_url(); ?>assets/img/riwayat/<?= $tr['bukti']; ?>" target="_blank">
                                                <img src="<?= base_url(); ?>assets/img/riwayat/<?= $tr['bukti']; ?>" width="60" alt="">
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center><?= $tr['status']; ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?= base_url(); ?>riwayat/laporan_detail_print/<?= $tr['kode_transaksi']; ?>" class="btn btn-primary mb-3"><i class="fas fa-print"></i></a>
                                            <a href="<?= base_url() ?>riwayat/laporan_detail_pdf/<?= $tr['kode_transaksi']; ?>" class="btn btn-danger mb-3"><i class="far fa-file-pdf"></i></a>
                                            <a href="<?= base_url() ?>riwayat/laporan_detail_excel/<?= $tr['kode_transaksi']; ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i></a>
                                        </center>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container">
            <p>*Alasan status ditolak: Bukti pembayaran tidak valid/Pemesanan sudah mencapai batas maksimal. <br>
                *Terkait masalah pembayaran hubungi CS: 08123456789.
            </p>
        </div>
    </div>
</section>