<div class="container-fluid">

    <?php if (!empty($this->session->flashdata('info'))) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> <?= $this->session->flashdata('info') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $judul; ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $judul; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= base_url() ?>baju/tambah" class="btn btn-primary mb-3">Tambah Jenis Laundry</a>
                    </div>
                </div>
                <table class="table table-bordered table-sm w-100" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Jenis Laundry</th>
                            <th>Jenis Laundry</th>
                            <th>Detail Jenis Laundry</th>
                            <th>Harga Satuan</th>
                            <th>Gambar</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($baju as $row) { ?>
                            <tr>
                                <td>
                                    <center><?= $no++; ?></center>
                                </td>
                                <td>
                                    <center><?= $row->kode_katalog; ?></center>
                                </td>
                                <td><?= $row->jenis_katalog; ?></td>
                                <td><?= $row->detail_katalog; ?></td>
                                <td>
                                    <center><?= "Rp" . number_format($row->harga_satuan, 0, '.', '.'); ?></center>
                                </td>
                                <td>
                                    <a href="<?= base_url() ?>assets/img/baju/<?= $row->gambar; ?>" target="_blank">
                                        <img class="img-fluid" src="<?= base_url() ?>assets/img/baju/<?= $row->gambar; ?>" alt="" width="100">
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url() ?>baju/edit/<?= $row->kode_katalog; ?>" class="btn btn-success btn-circle"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="<?= base_url() ?>baju/delete/<?= $row->kode_katalog; ?>" class="btn btn-danger btn-circle" onclick="return confirm('Yakin ingin hapus?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>