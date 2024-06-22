<!-- DataTales Example -->
<div class="container mt-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <?php echo form_open_multipart('user/ubahprofil'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label" id="email">Email</label>
                <div class="col-sm-10">
                    <input type="text" value="<?= $admin['id_admin']; ?>" name="id" hidden="hidden">
                    <input type="text" class="form-control" value="<?= $admin['email']; ?>" readonly="" name="email">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label" id="nama">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" value="<?= $admin['nama']; ?>" required
									oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Foto Profil</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profil/') . $admin['image']; ?>" alt="<?= $admin['nama']; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-9">
                            <div class="custom-file">
                                <input type="file" multiple accept="image/*" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="fileInput" id="fileInputLabel">Pilih Foto</label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="<?= base_url('user'); ?>" class="btn btn-danger">Batal</a>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function() {
        var fileName = this.files[0].name;
        var label = document.querySelector('.custom-file-label');
        label.textContent = fileName;
    });
</script>