<body>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800"><?= $judul ?>
        </h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="post" action="<?= base_url() ?>pembayaran/update" enctype="multipart/form-data">
                    <!-- enctype berfungsi agar bisa menangani upload file atau upload gambar -->

                    <div class="form-group">
                        <input type="text" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran'] ?>" class="form-control" hidden>
                    </div>

                    <div class="form-group">
                        <label>Nama Bank/Nama Dompet Digital</label>
                        <input type="text" name="nama_merchant" value="<?= $pembayaran['nama_merchant'] ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Pembayaran</label>
                        <input type="number" name="nomor_pembayaran" value="<?= $pembayaran['nomor_pembayaran'] ?>"class="form-control" required oninvalid="this.setCustomValidity('Harus Diisi dengan Angka!')" oninput="setCustomValidity('')">
                    </div>

                    <div class="form-group">
                        <label>Atas Nama</label>
                        <input type="text" name="atas_nama" value="<?= $pembayaran['atas_nama'] ?>" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" multiple accept="image/*" name="gambar" class="form-control">
                        <img src="<?= base_url() ?>assets/img/pembayaran/<?= $pembayaran['gambar'] ?>" alt="" width="200" required>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="<?= base_url() ?>pembayaran" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>