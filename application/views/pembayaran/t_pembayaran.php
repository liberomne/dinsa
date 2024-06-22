<body>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800"><?= $judul ?>
        </h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="post" action="<?= base_url() ?>pembayaran/simpan" enctype="multipart/form-data">
                    <!-- enctype berfungsi agar bisa menangani upload file atau upload gambar -->

                    <div class="form-group">
                    <input type="text" name="nama_merchant" class="form-control" placeholder="Masukkan Nama Merchant" required oninvalid="this.setCustomValidity('Wajib Diisi!')" oninput="setCustomValidity('')">
                    </div>
                    <!-- <div class="form-group">
                        <input type="text" name="nomor_pembayaran" value="<?= $nomor_pembayaran; ?>" class="form-control">
                    </div> -->
                    <div class="form-group">
                    <input type="number" name="nomor_pembayaran" class="form-control" placeholder="Masukkan Nomor Pembayaran" required oninvalid="this.setCustomValidity('Harus Diisi dengan Angka!')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                    <input type="text" name="atas_nama" class="form-control" placeholder="Masukkan Atas Nama" required oninvalid="this.setCustomValidity('Wajib Diisi!')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                    <input type="file" multiple accept="image/*" name="gambar" class="form-control" placeholder="Masukkan Gambar" required oninvalid="this.setCustomValidity('Wajib Diisi!')" oninput="setCustomValidity('')">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url() ?>pembayaran" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

