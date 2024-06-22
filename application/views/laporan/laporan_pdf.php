<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
    <link rel="icon" href="<?= base_url('assets/img/logo/icondinsa.jpg') ?>" type="image/jpeg">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo/icondinsa.jpg') ?>" type="image/x-icon">
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            padding: 10px 10px 10px 10px;
        }
    </style>
</head>

<body>
    <table>
        <?php
        foreach ($profil_laundry as $pl) {
            ?>
            <tr>
                <td width="650">
                    <h3><?= $pl->nama_laundry; ?></h3>
                </td>

            </tr>

            <tr>
                <td><?= $pl->alamat; ?></td>
            </tr>

            <tr>
                <td><?= $pl->nomor_telepon; ?></td>
            </tr>

            <tr>
                <td><?= $pl->email; ?></td>
            </tr>

            <?php
        }
        ?>
    </table>

    <hr><br>

    <h3>
        <center>Laporan Transaksi</center>
    </h3>

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

    // memformat tanggal ke format Indonesia
    function formatTanggalIndonesia($tanggal, $bulanIndonesia)
    {
        if (!empty($tanggal) && $tanggal != "0000-00-00") {
            // Buat objek DateTime dari tanggal
            $date = new DateTime($tanggal);

            $hari = $date->format('d');
            $bulan = $bulanIndonesia[(int) $date->format('m')];
            $tahun = $date->format('Y');

            // Gabungin format tanggal Indonesia
            return $hari . ' ' . $bulan . ' ' . $tahun;
        } else {
            return '-';
        }
    }

    // Ambil tanggal dari session data
    $tgl_masuk = $this->session->userdata('tgl_masuk');
    $tgl_ambil = $this->session->userdata('tgl_ambil');

    // Format tanggal ke bahasa Indonesia
    $tgl_masuk_formatted = formatTanggalIndonesia($tgl_masuk, $bulanIndonesia);
    $tgl_ambil_formatted = formatTanggalIndonesia($tgl_ambil, $bulanIndonesia);
    ?>

    <h4>
        <center>Dari Tanggal
            <?= $tgl_masuk_formatted; ?> sampai Tanggal
            <?= $tgl_ambil_formatted; ?>
        </center>
    </h4>

    <br><br>

    <table class="table-data">
        <thead>
            <tr>
                <th>No. </th>
                <th>Tanggal Masuk</th>
                <th>Kode Transaksi</th>
                <th>Nama</th>
                <th>Jenis laundry</th>
                <th>Harga (Rp)</th>
                <th>Jumlah</th>
                <th>Subtotal (Rp)</th>
                <th>Total Bayar</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $no = 1;
            foreach ($transaksi as $tr) {
                // Inisialisasi variabel $tanggalFormatted setiap kali loop berjalan
                $tanggalFormatted = '-';

                if (!empty($tr->tgl_masuk)) {
                    // Konversi ke format tanggal Indonesia
                    $tanggalMasuk = new DateTime($tr->tgl_masuk);

                    // Ambil komponen tanggal, bulan, dan tahun
                    $hari = $tanggalMasuk->format('d');
                    $bulan = $bulanIndonesia[(int) $tanggalMasuk->format('m')];
                    $tahun = $tanggalMasuk->format('Y');

                    // Gabungkan ke format tanggal Indonesia
                    $tanggalFormatted = $hari . ' ' . $bulan . ' ' . $tahun;
                }
                ?>

                <tr>
                    <td>
                        <center><?= $no++; ?></center>
                    </td>
                    <td>
                        <center><?= $tanggalFormatted; ?></center>
                    </td>
                    <td>
                        <center><?= $tr->kode_transaksi; ?></center>
                    </td>
                    <td><?= $tr->nama; ?></td>
                    <td><?= $tr->jenis_katalog; ?></td>
                    <td>
                        <center><?= $tr->harga_satuan; ?></center>
                    </td>
                    <td>
                        <center><?= $tr->jumlah; ?></center>
                    </td>
                    <td>
                        <center><?= $tr->subtotal; ?></center>
                    </td>
                    <td>
                        <center><?= 'Rp' . number_format($tr->total_bayar, 0, ',', '.'); ?></center>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>