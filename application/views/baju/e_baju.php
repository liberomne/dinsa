<body>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800"><?= $judul ?>
        </h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="post" action="<?= base_url() ?>baju/update" enctype="multipart/form-data">
                    <!-- enctype berfungsi agar bisa menangani upload file atau upload gambar -->

                    <div class="form-group">
                        <label>Kode Jenis Laundry</label>
                        <input type="text" name="kode_katalog" value="<?= $baju['kode_katalog'] ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                    <label>Jenis Laundry</label>
                        <input type="text" name="jenis_katalog" value="<?= $baju['jenis_katalog'] ?>" class="form-control" placeholder="Masukkan Jenis Laundry" required>
                    </div>
                    <div class="form-group">
                    <label>Detail Laundry</label>
                        <textarea name="detail_katalog" cols="30" rows="6" class="form-control" placeholder="Masukkan Deskripsi Laundry"> <?= $baju['detail_katalog'] ?></textarea>
                    </div>
                    <div class="form-group">
                    <label>Harga Laundry</label>
                        <input type="number" name="harga_satuan" value="<?= $baju['harga_satuan'] ?>"class="form-control" placeholder="Masukkan Harga Laundry" required oninvalid="this.setCustomValidity('Harus Diisi dengan Angka!')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                    <label>Gambar Laundry</label>
                        <input type="file" multiple accept="image/*" name="gambar" class="form-control">
                        <img src="<?= base_url() ?>assets/img/baju/<?= $baju['gambar'] ?>" alt="" width="200"> <br>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="<?= base_url() ?>baju" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>