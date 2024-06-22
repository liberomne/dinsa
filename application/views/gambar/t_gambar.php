<body>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800"><?= $judul ?>
        </h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="post" action="<?= base_url() ?>gambar/simpan" enctype="multipart/form-data">
                    <!-- enctype berfungsi agar bisa menangani upload file atau upload gambar -->

                    <div class="form-group">
                        <input type="file" multiple accept="image/*" name="gambar_laundry" class="form-control" required>
                    </div>

                    <!-- <div class="form-group">
                        <input type="text" name="keterangan" class="form-control" required>
                    </div> -->

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= base_url() ?>gambar" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>