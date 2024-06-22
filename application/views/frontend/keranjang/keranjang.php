<?php
setlocale(LC_TIME, 'id_ID');
date_default_timezone_set('Asia/Jakarta');

$tgl_masuk = date('Y-m-d');
$id_pelanggan = $this->session->userdata('id_pelanggan');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding-bottom: 20px;
        }

        .section-heading {
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
        }

        .section-subheading {
            font-size: 1.2em;
            color: #6c757d;
            margin-bottom: 40px;
        }

        .btn-basket {
            font-size: 1em;
            color: #fff;
            background-color: #007bff;
            border: none;
            padding: 8px 16px;
        }

        #buktiPreview {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
            display: none;
            border: 1px solid #ddd;
            padding: 5px;
        }
    </style>
</head>

<body>
    <section class="page-section section">
        <section id="contact-us" class="contact-us">
            <div class="container">
                <div class="col-lg-12 mt-0">
                    <h4>Keranjang Laundry</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Jenis Laundry</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Sub-Total</th>
                                <th>Opsi</th>
                            </tr>

                            <?php $no = 1; ?>
                            <?php foreach ($keranjang as $k) : ?>
                                <?php if ($k['id_pelanggan'] == $id_pelanggan) : ?>
                                    <tr>
                                        <td>
                                            <center><?= $no++; ?></center>
                                        </td>
                                        <td><?= $k['jenis_katalog']; ?></td>
                                        <td>
                                            <center><?= 'Rp' . number_format($k['harga_satuan'], 0, ',', '.'); ?></center>
                                        </td>
                                        <td>
                                            <div class="qty text-center">
                                                <a href="<?= base_url('keranjang/kurang/') . $k['id_keranjang']; ?>" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-minus"></i>
                                                </a>
                                                <span class="mx-2"><?= $k['jumlah']; ?></span>
                                                <a href="<?= base_url('keranjang/tambah/') . $k['id_keranjang']; ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <center><?= 'Rp' . number_format($k['subtotal'], 0, ',', '.'); ?></center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="<?= base_url('keranjang/hapus/') . $k['id_keranjang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?');"><i class="fas fa-trash"></i></a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <tr class="text-center">
                                <td colspan="6">
                                    <?php echo "Total Pesanan Laundry: Rp" . number_format($total_bayar, 0, ',', '.') ?>
                                </td>
                            </tr>

                        </table>
                    </div>
                    <div align="right">
                        <a href="<?php echo base_url('katalog/') ?>">
                            <div class="btn btn-sm btn-success">Lanjutkan Pesanan</div>
                        </a>
                        <a href="<?php echo base_url('keranjang/hapus_keranjang') ?>" onclick="return confirm('Yakin ingin hapus semua keranjang?');">
                            <div class="btn btn-sm btn-danger">Hapus Semua Keranjang</div>
                        </a>
                    </div>
                    <br>
                </div><br><br>
            </div>

            <div class="container">
                <div class="col-lg-12">
                    <h3>Data Pengiriman</h3>
                    <p>Isi formulir untuk pengiriman laundry. <br>
                    Klik <b> 'Hapus Keranjang' </b>jika ingin batalkan pesanan/hapus data pengiriman.</p>
                    <br>
                    <form id="pengirimanForm" action="<?= base_url("keranjang/bayar/") . $kode_transaksi ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Kode Transaksi</label>
                                <div class="form-group">
                                    <input type="text" name="kode_transaksi" id="kode_transaksi" value="<?= $kode_transaksi; ?>" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="">Nama</label>
                                <div class="form-group">
                                    <input type="text" name="nama" class="form-control" value="<?= $pelanggan; ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="">Tanggal Masuk</label>
                                <div class="form-group">
                                    <input type="text" name="tgl_masuk" class="form-control" value="<?= $tgl_masuk; ?>" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="">No. Telepon</label>
                                <div class="form-group">
                                    <input type="number" name="no_hp" id="no_hp" class="form-control" placeholder="Isi Nomor Telepon Anda" required oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')">
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="">Metode Pembayaran</label>
                                <div class="form-group">
                                    <select name="id_pembayaran" id="id_pembayaran" class="form-control <?php echo form_error('id_pembayaran') ? 'is-invalid' : '' ?>" required oninvalid="this.setCustomValidity('Wajib Pilih Metode Pembayaran')" oninput="setCustomValidity('')">
                                        <option value="" selected>Pilih Metode Pembayaran</option>
                                        <?php
                                        foreach ($pembayaran as $byr) { ?>
                                            <option value="<?= $byr->id_pembayaran ?>">
                                                <?= $byr->nama_merchant; ?> - <?= $byr->nomor_pembayaran; ?> (a/n :
                                                <?= $byr->atas_nama; ?>)
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label for="">Bukti Pembayaran</label>
                                <div class="form-group">
                                    <input type="file" multiple accept="image/*" name="bukti" id="bukti" class="form-control <?php echo form_error('bukti') ?>" placeholder="Isi Nomor Telepon Anda" required oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')">
                                    <small>*Proses laundry maksimal 3 hari.</small>
                                    <img id="buktiPreview" src="" alt="Pratinjau Bukti Pembayaran">
                                </div>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="">Alamat</label>
                                <div class="form-group">
                                    <textarea name="alamat" id="alamat" class="form-control" rows="5" placeholder="Masukkan Alamat" required oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 form-group" hidden>
                                <label for="">Status</label>
                                <div class="form-group">
                                    <input type="text" name="status" value="Baru" class="form-control" placeholder="Isi Status" required oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')">
                                </div>
                            </div>

                        </div>
                        <div class="text-center">
                            <button id="submitButton" class="btn btn-primary" type="submit">Pesan Laundry</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kodeTransaksi = document.getElementById('kode_transaksi').value;
            const idPelanggan = <?= json_encode($id_pelanggan); ?>;
            const savedKodeTransaksi = localStorage.getItem('kode_transaksi');
            const savedIdPelanggan = localStorage.getItem('id_pelanggan');

            if (savedKodeTransaksi !== kodeTransaksi || savedIdPelanggan !== idPelanggan) {
                localStorage.removeItem('no_hp');
                localStorage.removeItem('id_pembayaran');
                localStorage.removeItem('alamat');
                localStorage.setItem('kode_transaksi', kodeTransaksi);
                localStorage.setItem('id_pelanggan', idPelanggan);
            } else {
                document.getElementById('no_hp').value = localStorage.getItem('no_hp');
                document.getElementById('id_pembayaran').value = localStorage.getItem('id_pembayaran');
                document.getElementById('alamat').value = localStorage.getItem('alamat');
            }

            document.getElementById('no_hp').addEventListener('input', function() {
                localStorage.setItem('no_hp', this.value);
            });

            document.getElementById('id_pembayaran').addEventListener('change', function() {
                localStorage.setItem('id_pembayaran', this.value);
            });

            document.getElementById('alamat').addEventListener('input', function() {
                localStorage.setItem('alamat', this.value);
            });

            document.getElementById('pengirimanForm').addEventListener('submit', function() {
                localStorage.removeItem('no_hp');
                localStorage.removeItem('id_pembayaran');
                localStorage.removeItem('alamat');
            });

            document.getElementById('bukti').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('buktiPreview').src = e.target.result;
                        document.getElementById('buktiPreview').style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            document.getElementById('submitButton').addEventListener('click', function(event) {
                var form = document.getElementById('pengirimanForm');

                if (form.checkValidity()) {
                    var confirmation = confirm("Pemesanan tidak bisa dibatalkan. Klik Ok jika sudah yakin dengan data pemesanan");
                    if (!confirmation) {
                        event.preventDefault();
                    }
                } else {
                    form.reportValidity();
                    event.preventDefault();
                }
            });

            document.querySelector('[href="<?php echo base_url("keranjang/hapus_keranjang") ?>"]').addEventListener('click', function() {
                localStorage.removeItem('no_hp');
                localStorage.removeItem('id_pembayaran');
                localStorage.removeItem('alamat');
            });
        });

        function hapusKeranjang(event) {
            localStorage.removeItem('no_hp');
            localStorage.removeItem('id_pembayaran');
            localStorage.removeItem('alamat');
        }
    </script>
</body>

</html>