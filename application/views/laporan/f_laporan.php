<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<div class="container-fluid">
    <h3 class="mb-2 text-gray-800">
        <?= $judul; ?>
    </h3>



    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('laporan/cetak') ?>" method="post" class="form-user">
                <?php if ($this->session->flashdata('pesan')): ?>
                    <?= $this->session->flashdata('pesan'); ?>
                <?php endif; ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-4">
                        <input type="date" name="tgl_masuk" class="form-control" required
                            oninvalid="this.setCustomValidity('Wajib Diisi!')" oninput="setCustomValidity('')">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-4">
                        <input type="date" name="tgl_ambil" class="form-control" required
                            oninvalid="this.setCustomValidity('Wajib Diisi!')" oninput="setCustomValidity('')">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-4">
                        <button type="submit" name="action" value="print" class="btn btn-primary mb-3"><i
                                class="fas fa-print"></i></button>
                        <button type="submit" name="action" value="pdf" class="btn btn-danger mb-3"><i
                                class="far fa-file-pdf"></i></button>
                        <button type="submit" name="action" value="excel" class="btn btn-success mb-3"><i
                                class="far fa-file-excel"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="form-group">
        <a href="<?= base_url() ?>laporan" class="btn btn-secondary">Kembali</a>
    </div>
</div>
</body>

</html>