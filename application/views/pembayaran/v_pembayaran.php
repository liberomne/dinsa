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
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= base_url() ?>pembayaran/tambah" class="btn btn-primary mb-3">Tambah Metode Pembayaran</a>
                    </div>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                <center>No.</center>
                            </th>
                            <th>
                                <center>Nama Bank/Dompet Digital</center>
                            </th>
                            <th>
                                <center>Nomor Rekening/Nomor Telepon</center>
                            </th>
                            <th>
                                <center>Atas Nama</center>
                            </th>
                            <th>
                                <center>Gambar</center>
                            </th>
                            <th>
                                <center>Opsi</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($pembayaran as $row) { ?>
                            <!--pembayaran adalah nama tabel pada database  -->
                            <tr>
                                <td>
                                    <center><?= $no++; ?></center>
                                </td>
                                <td><?= $row->nama_merchant; ?></td>
                                <td>
                                    <center><?= $row->nomor_pembayaran; ?></center>
                                </td>
                                <td><?= $row->atas_nama; ?></td>
                                <td>
                                    <center>
                                        <a href="<?= base_url(); ?>assets/img/pembayaran/<?= $row->gambar; ?>" target="_blank">
                                            <img src="<?= base_url(); ?>assets/img/pembayaran/<?= $row->gambar; ?>" width="60" alt="">
                                        </a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="<?= base_url() ?>pembayaran/edit/<?= $row->id_pembayaran; ?>" class="btn btn-success btn-circle"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="<?= base_url() ?>pembayaran/delete/<?= $row->id_pembayaran; ?>" class="btn btn-danger btn-circle" onclick="return confirm('Yakin ingin hapus?')"><i class="fas fa-trash"></i></a>
                                    </center>
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