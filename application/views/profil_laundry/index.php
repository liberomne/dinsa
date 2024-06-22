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
            <dl class="row">
                <?php foreach ($profil_laundry as $row) { ?>
                    <dt class="col-sm-3">Nama Laundry</dt>
                    <dd class="col-sm-9">: <?= $row->nama_laundry; ?></dd>

                    <dt class="col-sm-3">Deskripsi</dt>
                    <dd class="col-sm-9">: <?= $row->deskripsi; ?></dd>
                    </dd>

                    <dt class="col-sm-3 text-truncate">Nomor Telepon</dt>
                    <dd class="col-sm-9">: <?= $row->nomor_telepon; ?></dd>

                    <dt class="col-sm-3 text-truncate">Email</dt>
                    <dd class="col-sm-9">: <?= $row->email; ?></dd>

                    <dt class="col-sm-3">Alamat</dt>
                    <dd class="col-sm-9">: <?= $row->alamat; ?></dd>

                    <dt class="col-sm-3 text-truncate">Maps</dt>
                    <dd class="col-sm-9">
                        <?php if ($row->link_maps !== "") { ?>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="<?= $row->link_maps; ?>" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        <?php } else { ?>
                            <h3>Anda belum menambahkan maps</h3>
                        <?php } ?>
                    </dd>

                    <dt class="col-sm-3 text-truncate">Metode Pembayaran :</dt>
                    <dd class="col-sm-9">
                        <div class="row">
                            <?php foreach ($pembayaran as $byr) { ?>
                                <div class="col-md-6">
                                    <li><?= $byr->nama_merchant; ?> - <?= $byr->nomor_pembayaran; ?> (a/n: <?= $byr->atas_nama; ?>)</li>
                                </div>
                            <?php } ?>
                        </div>
                    </dd>

                    <dt class="col-sm-3">Gambar :</dt>
                    <dd class="col-sm-9">
                        <a href="<?= base_url(); ?>assets/img/gambar/<?= $row->gambar; ?>" target="_blank">
                            <img class="img-fluid" src="<?= base_url(); ?>assets/img/gambar/<?= $row->gambar; ?>" alt="">
                        </a>
                    </dd>
                <?php } ?>
            </dl>

            <a href="<?= base_url() ?>profil_laundry/edit/<?= $row->id; ?>" class="btn btn-primary mt-3">Ubah Profil Laundry</a>
        </div>
    </div>
</div>
