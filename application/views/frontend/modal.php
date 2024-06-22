<!-- login modal -->
<div class="modal fade" tabindex="-1" id="loginModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Masuk Sebagai Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('member'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group row mt-1 mb-4">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Email" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- login modal -->


<!-- modal_daftar.php -->
<div class="modal fade" tabindex="-1" id="daftarModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('member/daftar'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')" required>
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')" required>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')" required>
                        <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password" oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')" required>
                        <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</div>