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

<!DOCTYPE html>
<html>

<head>
    <title><?= $judul; ?></title>
    <link rel="icon" href="<?= base_url('assets/img/logo/icondinsa.jpg') ?>">
</head>

<body>
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            font-family: Verdana;
            padding: 10px 10px 10px 10px;
        }

        h3 {
            font-family: Verdana;
        }
    </style>

    <table>
        <?php
        foreach ($profil_laundry as $pl) {
        ?>
            <tr>
                <td width="1150">
                    <h3><?= $pl->nama_laundry; ?></h3>
                </td>
                <td>
                    <h3>Detail Pesanan</h3>
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

    <table>

        <tr>
            <td width="500">Nama</td>
            <td width="5000">: <?= $transaksi->nama; ?></td>

            <td width="500">Kode Transaksi</td>
            <td width="1000">: <?= $transaksi->kode_transaksi; ?></td>
        </tr>

        <tr>
            <td width="80">No. Telp</td>
            <td width="1000">: <?= $transaksi->no_hp; ?></td>

            <?php

            if (!empty($transaksi->tgl_masuk)) {
                // Ubah ke format tanggal Indonesia
                $tanggalMasuk = new DateTime($transaksi->tgl_masuk);

                $hari = $tanggalMasuk->format('d');
                $bulan = $bulanIndonesia[(int) $tanggalMasuk->format('m')];
                $tahun = $tanggalMasuk->format('Y');

                // Gabungin format tanggal Indonesia
                $tanggalFormatted = $hari . ' ' . $bulan . ' ' . $tahun;
            ?>

                <td width="80">Tanggal Masuk</td>
                <td width="500">: <?= $tanggalFormatted; ?></td>
            <?php } else { ?>
                <td width="500">: -</td>
            <?php }
            ?>
        </tr>

        <tr>
            <td width="80">Alamat</td>
            <td width="1000">: <?= $transaksi->alamat; ?></td>

            <?php

            if ($transaksi->tgl_ambil != "0000-00-00" && $transaksi->tgl_ambil != 0) {
                // Ubah ke format tanggal Indonesia
                $tanggalAmbil = new DateTime($transaksi->tgl_ambil);

                $hari = $tanggalAmbil->format('d');
                $bulan = $bulanIndonesia[(int) $tanggalAmbil->format('m')];
                $tahun = $tanggalAmbil->format('Y');

                // Gabungin format tanggal Indonesia
                $tanggalFormatted = $hari . ' ' . $bulan . ' ' . $tahun;
            ?>

                <td width="80">Tanggal Ambil</td>
                <td>: <?= $tanggalFormatted; ?></td>
            <?php } else { ?>
                <td width="80">Tanggal Ambil</td>
                <td>: -</td>
            <?php }
            ?>
        </tr>
    </table>

    <br>

    <h3>
        <center>Laporan Data Pesanan</center>
    </h3>
    <br />
    <table class="table-data">
        <thead>
            <tr>
                <th>No. </th>
                <th>Jenis Laundry</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($keranjang as $k) :
            ?>
                <tr>
                    <td>
                        <center><?php echo $no++ ?></center>
                    </td>
                    <td>
                        <?php echo $k->jenis_katalog ?>
                    </td>
                    <td>
                        <center><?php echo "Rp" . number_format($k->harga_satuan, 0, ',', '.') ?></center>
                    </td>
                    <td>
                        <center><?php echo $k->jumlah ?></center>
                    </td>
                    <td>
                        <center><?php echo "Rp" . number_format($k->subtotal, 0, ',', '.') ?></center>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="5" align="center">Total Bayar:
                    <?php echo "Rp" . number_format($transaksi->total_bayar, 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>