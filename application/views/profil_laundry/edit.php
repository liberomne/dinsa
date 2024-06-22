<body>
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800"><?= $judul ?>
        </h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form method="post" action="<?= base_url() ?>profil_laundry/update" enctype="multipart/form-data">
                    <!-- enctype berfungsi agar bisa menangani upload file atau upload gambar -->

                    <div class="form-group">
                        <input type="text" name="id" value="<?= $profil_laundry['id'] ?>" class="form-control" hidden>
                    </div>

                    <div class="form-group">
                        <label>Nama Laundry</label>
                        <input type="text" name="nama_laundry" value="<?= $profil_laundry['nama_laundry'] ?>"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Laundry</label>
                        <textarea type="text" name="deskripsi" rows="5" class="form-control"
                            required><?= $profil_laundry['deskripsi'] ?> </textarea>
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="number" name="nomor_telepon" value="<?= $profil_laundry['nomor_telepon'] ?>"
                            class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="<?= $profil_laundry['email'] ?>" class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea type="text" name="alamat" rows="3" class="form-control"
                            required><?= $profil_laundry['alamat'] ?> </textarea>
                    </div>

                    <div class="form-group">
                        <label>Link Maps</label>
                        <textarea type="text" rows="5" class="form-control" name="link_maps"
                            required><?= $profil_laundry['link_maps'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" multiple accept="image/*" name="gambar" class="form-control">
                        <img src="<?= base_url() ?>assets/img/gambar/<?= $profil_laundry['gambar'] ?>" alt=""
                            width="200" required>
                            <br>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="<?= base_url('profil_laundry') ?>" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>