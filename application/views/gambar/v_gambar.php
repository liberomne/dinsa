<div class="container-fluid">

    <?php
    if (!empty($this->session->flashdata('info'))) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> <?= $this->session->flashdata('info') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php }
    ?>

    <div class="row">
        <div class="col-md-12">
            <a href="<?= base_url() ?>gambar/tambah" class="btn btn-primary mb-3">Tambah Gambar Laundry</a>
        </div>
    </div>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        <?= $judul; ?>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <?= $judul; ?>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Gambar Laundry</th>
                            <!-- <th>Keterangan</th> -->
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($gambar as $row) { ?>
                            <!--gambar adalah nama tabel pada database  -->
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <a href="<?= base_url() ?>assets/img/gambar/<?= $row->gambar_laundry; ?>"
                                        target="_blank">
                                        <img src="<?= base_url() ?>assets/img/gambar/<?= $row->gambar_laundry; ?>" alt=""
                                            width="60">
                                    </a>
                                </td>
                                <!-- <td><?= $row->keterangan; ?></td> -->
                                <td>
                                    <a href="<?= base_url() ?>gambar/edit/<?= $row->id_gambar; ?>"
                                        class="btn btn-success btn-sm">Ubah</a>
                                    <a href="<?= base_url() ?>gambar/delete/<?= $row->id_gambar; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin mau menghapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>