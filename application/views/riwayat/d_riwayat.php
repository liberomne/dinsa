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
                    <div class="btn btn-sm btn-success">Kode Transaksi: <?php echo $transaksi->kode_transaksi ?></div>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <a href="<?= base_url() ?>riwayat/laporan_detail_print/<?= $transaksi->kode_transaksi ?>"
                        class="btn btn-primary mb-3"><i class="fas fa-print"></i></a>
                    <a href="<?= base_url() ?>riwayat/laporan_detail_pdf/<?= $transaksi->kode_transaksi ?>"
                        class="btn btn-danger mb-3"><i class="far fa-file-pdf"></i></a>
                    <a href="<?= base_url() ?>riwayat/laporan_detail_excel/<?= $transaksi->kode_transaksi ?>"
                        class="btn btn-success mb-3"><i class="far fa-file-excel"></i></a>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <center>No.</center>
                                </th>
                                <th>
                                    <center>Jenis Laundry</center>
                                </th>
                                <th>
                                    <center>Harga</center>
                                </th>
                                <th>
                                    <center>Jumlah</center>
                                </th>
                                <th>
                                    <center>Subtotal</center>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($keranjang as $k):
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
                        </tbody>

                        <tr>
                            <td colspan="6" align="center">Total Bayar:
                                <?php echo "Rp" . number_format($transaksi->total_bayar, 0, ',', '.') ?>
                            </td>
                        </tr>
                    </table><br>

                    <div class="form-group">
                        <a href="<?= base_url() ?>riwayat" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>