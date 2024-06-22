<section class="page-section section">
    <section id="event-list" class="event-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-5 text-center">
                    <h2 class="section-heading text-uppercase">Katalog <?= $nama_laundry; ?></h2>
                    <h3 class="section-subheading text-muted">Selamat Datang di Toko Laundry Kami!</h3>
                </div>
            </div>

            <div class="row">
                <?php
                foreach ($baju as $b) { ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card">
                            <img src="<?= base_url() ?>assets/img/baju/<?= $b->gambar; ?>" style="object-fit:cover; height:300px; width:100%;">
                            <div class="card-body">
                                <center>
                                    <h5 class="card-title"><?= $b->jenis_katalog; ?></h5>
                                    <h6 class="card-title"><?= "Rp" . number_format($b->harga_satuan, 0, '.', '.') . "/pcs"; ?></h6>
                                    <p class="card-text"><?= $b->detail_katalog; ?></p>
                                    <?php echo anchor('keranjang/pesan/' . $b->kode_katalog, '<div class="btn btn-sm btn-primary"><i class="fas fa-shopping-basket"></i></div>') ?>
                                </center>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
</section>