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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">

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
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <center>No. </center>
                                </th>
                                <th>
                                    <center>Kode <br> Transaksi</center>
                                </th>
                                <th>
                                    <center>Nama</center>
                                </th>
                                <th>
                                    <center>No. Telp</center>
                                </th>
                                <th>
                                    <center>Alamat</center>
                                </th>
                                <th>
                                    <center>Tanggal <br> Masuk</center>
                                </th>
                                <th>
                                    <center>Tanggal <br> Ambil</center>
                                </th>
                                <th>
                                    <center>Total</center>
                                </th>
                                <th>
                                    <center>Bukti <br> Pembayaran</center>
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
                            <?php
                            $no = 1;
                            foreach ($transaksi as $tr): 
                            // Pastiin "tgl_masuk" ada di $transaksi
                            if (isset($tr['tgl_masuk'])) {
                                // Ubah tanggal ke format Indonesia
                                $tanggalMasuk = new DateTime($tr['tgl_masuk']);
                                $hari = $tanggalMasuk->format('d');
                                $bulan = $bulanIndonesia[(int) $tanggalMasuk->format('m')];
                                $tahun = $tanggalMasuk->format('Y');
                                $tanggalMasukFormatted = $hari . ' ' . $bulan . ' ' . $tahun;
                            } else {
                                $tanggalMasukFormatted = '-';
                            }
                            
                            // Pastiin "tgl_masuk" ada di $transaksi
                            if ($tr['tgl_ambil'] != '0000-00-00') {
                                // Ubah tanggal ke format Indonesia
                                $tanggalAmbil = new DateTime($tr['tgl_ambil']);
                                $hari = $tanggalAmbil->format('d');
                                $bulan = $bulanIndonesia[(int) $tanggalAmbil->format('m')];
                                $tahun = $tanggalAmbil->format('Y');
                                $tanggalAmbilFormatted = $hari . ' ' . $bulan . ' ' . $tahun;
                            } else {
                                $tanggalAmbilFormatted = '-';
                            }
                            ?>
                                <tr>
                                    <td>
                                        <center><?= $no++; ?></center>
                                    </td>
                                    <td><?= $tr['kode_transaksi']; ?></td>
                                    <td><?= $tr['nama']; ?></td>
                                    <td><center><?= $tr['no_hp']; ?></center></td>
                                    <td><?= $tr['alamat']; ?></td>
                                    <td>
                                        <center><?= $tanggalMasukFormatted; ?></center>
                                    </td>
                                    <td>
                                        <center><?= $tanggalAmbilFormatted; ?></center>
                                    </td>
                                    <td>
                                        <center><?= 'Rp' . number_format($tr['total_bayar'], 0, ',', '.'); ?></center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?= base_url(); ?>assets/img/riwayat/<?= $tr['bukti']; ?>"
                                                target="_blank">
                                                <img src="<?= base_url(); ?>assets/img/riwayat/<?= $tr['bukti']; ?>"
                                                    width="60" alt="">
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <?php
                                            if ($tr['status'] == "Baru") { ?>
                                                <select name="status" class="badge badge-primary status">
                                                    <option value="<?= $tr['kode_transaksi'] ?>Baru" selected>Baru</option>
                                                    <option value="<?= $tr['kode_transaksi'] ?>Ditolak">Ditolak</option>
                                                    <option value="<?= $tr['kode_transaksi'] ?>Penjemputan">Penjemputan</option>
                                                    <option value="<?= $tr['kode_transaksi'] ?>Sedang Dicuci">Sedang Dicuci
                                                    </option>
                                                    <option value="<?= $tr['kode_transaksi'] ?>Pengiriman">Pengiriman</option>
                                                    <option value="<?= $tr['kode_transaksi'] ?>Selesai">Selesai</option>
                                                </select>
                                            <?php } else if ($tr['status'] == "Ditolak") { ?>
                                                    <select name="status" class="badge badge-danger status">
                                                        <option value="<?= $tr['kode_transaksi'] ?>Baru">Baru</option>
                                                        <option value="<?= $tr['kode_transaksi'] ?>Ditolak" selected>Ditolak
                                                        </option>
                                                        <option value="<?= $tr['kode_transaksi'] ?>Penjemputan">Penjemputan</option>
                                                        <option value="<?= $tr['kode_transaksi'] ?>Sedang Dicuci">Sedang Dicuci
                                                        </option>
                                                        <option value="<?= $tr['kode_transaksi'] ?>Pengiriman">Pengiriman</option>
                                                        <option value="<?= $tr['kode_transaksi'] ?>Selesai">Selesai</option>
                                                    </select>
                                            <?php } else if ($tr['status'] == "Penjemputan") { ?>
                                                        <select name="status" class="badge badge-primary status">
                                                            <option value="<?= $tr['kode_transaksi'] ?>Baru">Baru</option>
                                                            <option value="<?= $tr['kode_transaksi'] ?>Ditolak">Ditolak</option>
                                                            <option value="<?= $tr['kode_transaksi'] ?>Penjemputan" selected>Penjemputan
                                                            </option>
                                                            <option value="<?= $tr['kode_transaksi'] ?>Sedang Dicuci">Sedang Dicuci
                                                            </option>
                                                            <option value="<?= $tr['kode_transaksi'] ?>Pengiriman">Pengiriman</option>
                                                            <option value="<?= $tr['kode_transaksi'] ?>Selesai">Selesai</option>
                                                        </select>
                                            <?php } else if ($tr['status'] == "Sedang Dicuci") { ?>
                                                            <select name="status" class="badge badge-primary status">
                                                                <option value="<?= $tr['kode_transaksi'] ?>Baru">Baru</option>
                                                                <option value="<?= $tr['kode_transaksi'] ?>Ditolak">Ditolak</option>
                                                                <option value="<?= $tr['kode_transaksi'] ?>Penjemputan">Penjemputan</option>
                                                                <option value="<?= $tr['kode_transaksi'] ?>Sedang Dicuci" selected>Sedang
                                                                    Dicuci
                                                                </option>
                                                                <option value="<?= $tr['kode_transaksi'] ?>Pengiriman">Pengiriman</option>
                                                                <option value="<?= $tr['kode_transaksi'] ?>Selesai">Selesai</option>
                                                            </select>
                                            <?php } else if ($tr['status'] == "Pengiriman") { ?>
                                                                <select name="status" class="badge badge-primary status">
                                                                    <option value="<?= $tr['kode_transaksi'] ?>Baru">Baru</option>
                                                                    <option value="<?= $tr['kode_transaksi'] ?>Ditolak">Ditolak</option>
                                                                    <option value="<?= $tr['kode_transaksi'] ?>Penjemputan">Penjemputan</option>
                                                                    <option value="<?= $tr['kode_transaksi'] ?>Sedang Dicuci">Sedang Dicuci
                                                                    </option>
                                                                    <option value="<?= $tr['kode_transaksi'] ?>Pengiriman" selected>Pengiriman
                                                                    </option>
                                                                    <option value="<?= $tr['kode_transaksi'] ?>Selesai">Selesai</option>
                                                                </select>
                                            <?php } else { ?>
                                                                <button class="btn btn-success btn-sm dropdown-toggle">Selesai</button>
                                            <?php }

                                            ?>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <a href="<?php echo base_url('riwayat/detail/' . $tr['kode_transaksi']) ?>">
                                                <div class="btn btn-circle btn-primary"><i class="fas fa-file-alt"></i></div>
                                            </a>
                                            <a href="<?php echo base_url('riwayat/hapus/' . $tr['kode_transaksi']) ?>"
                                                onclick="return confirm('Yakin ingin hapus?');">
                                                <div class="btn btn-circle btn-danger"><i class="fas fa-trash"></i></div>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        $('.status').change(function () {
            var status = $(this).val();
            var kt = status.substr(0, 14);
            var stt = status.substr(14, 20);

            $.ajax({
                url: "<?= base_url() ?>riwayat/update_status",
                method: "post",
                data: { kt: kt, stt: stt }
            });

            location.reload();

        });
    </script>
</body>

</html>