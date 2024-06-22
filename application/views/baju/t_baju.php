<body>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800"><?= $judul ?>
        </h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="post" action="<?= base_url() ?>baju/simpan" enctype="multipart/form-data">
                    <!-- enctype berfungsi agar bisa menangani upload file atau upload gambar -->

                    <div class="form-group">
                        <input type="text" name="kode_katalog" value="<?= $kode_katalog; ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" name="jenis_katalog" class="form-control" placeholder="Masukkan Jenis Laundry" required oninvalid="this.setCustomValidity('Wajib Diisi!')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <textarea name="detail_katalog" cols="30" rows="6" class="form-control" placeholder="Masukkan Detail Laundry" required oninvalid="this.setCustomValidity('Wajib Diisi!')" oninput="setCustomValidity('')"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="number" name="harga_satuan" class="form-control" placeholder="Masukkan Harga Satuan(Rp)" required oninvalid="this.setCustomValidity('Harus Diisi dengan Angka!')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="file" multiple accept="image/*" name="gambar" class="form-control" required oninvalid="this.setCustomValidity('Wajib Diisi!')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url() ?>baju" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>