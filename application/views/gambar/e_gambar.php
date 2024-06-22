<body>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800"><?= $judul ?>
        </h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="post" action="<?= base_url() ?>gambar/update" enctype="multipart/form-data">
                    <!-- enctype berfungsi agar bisa menangani upload file atau upload gambar -->

                    <div class="form-group" hidden>
                        <input type="text" name="id_gambar" value="<?= $gambar['id_gambar']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <input type="file" multiple accept="image/*" name="gambar_laundry" class="form-control">
                        <img src="<?= base_url() ?>assets/img/gambar/<?= $gambar['gambar_laundry']; ?>" alt=""
                            width="200">
                        <small class="text-danger">Format gambar (jpg | png); Ukuran gambar 1440px x 500px</small> <br>
                    </div>

                    <!-- <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" value="<?= $gambar['keterangan']; ?>" class="form-control">
                    </div> -->
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="<?= base_url() ?>gambar" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>