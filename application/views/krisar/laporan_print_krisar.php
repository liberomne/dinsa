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
                <td width="1050">
                    <h3><?= $pl->nama_laundry; ?></h3>
                </td>
                <td>
                    <h3>Laporan Kritik dan Saran</h3>
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
        <center>Data Kritik dan Saran</center>
    </h3>
    <br />
    <table class="table-data">
        <thead>
            <tr>
                <th>No. </th>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>Tanggal</th>
                <th>Kritik dan Saran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($krisar as $ks) :
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
                }
            ?>
                <tr>
                    <td>
                        <center><?php echo $no++ ?></center>
                    </td>
                    <td>
                        <?php echo $ks->nama_pelanggan ?>
                    </td>
                    <td>
                        <?php echo $ks->email ?>
                    </td>
                    <td>
                        <center><?php echo $tanggalFormatted ?></center>
                    </td>
                    <td>
                        <?php echo $ks->kritik_saran ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>