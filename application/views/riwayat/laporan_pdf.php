<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <style>
        td {
            font-size: 12px;
            font-family: sans-serif;
        }

        h3 {
            font-size: 16px;
        }

        hr {
            border: 0;
            border-top: 2px solid #113b9c;
        }

        .tabel {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th {
            font-family: sans-serif;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <table>
        <tr>
            <td width="400">
                <h3><?= $profil_laundry['nama_laundry']; ?></h3>
            </td>
        </tr>

        <tr>
            <td>Alamat : <?= $profil_laundry['alamat']; ?></td>
        </tr>

        <tr>
            <td>Telp : <?= $profil_laundry['nomor_telepon']; ?></td>
        </tr>

        <tr>
            <td>Email : <?= $profil_laundry['email']; ?></td>
        </tr>
    </table>

    <hr><br>

    <table>
        <tr>
            <td width="80">Pelanggan:</td>
            <td width="250"><?= $transaksi['nama']; ?></td>

            <td width="80">Kode Transaksi:</td>
            <td><?= $transaksi['kode_transaksi']; ?></td>
        </tr>

        <tr>
            <td width="80"></td>
            <td width="250"><?= $transaksi['alamat']; ?></td>

            <td width="80">Tanggal Masuk:</td>
            <td><?= $transaksi['tgl_masuk']; ?></td>
        </tr>

        <tr>
            <td width="80"></td>
            <td width="250"><?= $transaksi['no_hp']; ?></td>

            <?php
            if ($transaksi['tgl_ambil'] != 0) { ?>
                <td width="80">Tanggal Ambil:</td>
                <td><?= $transaksi['tgl_ambil']; ?></td>
            <?php } else { ?>
                <td width="80">Tanggal Ambil:</td>
                <td style="color: red;">-</td>
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
            foreach ($keranjang as $k):
                ?>
                <tr>
                    <td>
                        <?php echo $no++ ?>
                    </td>
                    <td>
                        <?php echo $k->jenis_katalog ?>
                    </td>
                    <td>
                        <?php echo $k->harga_satuan ?>
                    </td>
                    <td>
                        <?php echo $k->jumlah ?>
                    </td>
                    <td>
                        <?php echo "Rp" . number_format($k->subtotal, 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="center">Total Bayar:
                        <?php echo "Rp" . number_format($k->total_bayar, 0, ',', '.') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <!-- <table width="500" class="tabel">
        <tr>
            <th class="tabel">Paket Laundry</th>
            <th class="tabel">Berat /kg</th>
            <th class="tabel">Harga</th>
            <th class="tabel">Sub Total</th>
        </tr>

        <tr>
            <td class="tabel"><?= $transaksi['nama_paket']; ?></td>
            <td class="tabel"><?= $transaksi['berat']; ?></td>
            <td class="tabel"><?= "Rp" . number_format($transaksi['harga_paket'], 0, '.', '.'); ?></td>
            <td class="tabel"><?= "Rp" . number_format($transaksi['grand_total'], 0, '.', '.'); ?></td>
        </tr>

        <tr>
            <td class="tabel" colspan="3" style="text-align: right; font-weight: bold; font-size: 14px;">Grand Total</td>
            <td class="tabel" style="font-weight: bold; font-size: 14px;"><?= "Rp" . number_format($transaksi['grand_total'], 0, '.', '.'); ?></td>

        </tr>
    </table> -->
</body>

</html>