<!-- ======= Contact Us Section ======= -->
<section class="page-section section">
    <section id="contact-us" class="contact-us">
        <div class="container">
            <div class="col-lg-12">
                <h3>Kritik & Saran</h3>
                <p>Kritik dan Saran yang anda berikan akan sangat berguna untuk peningkatan kualitas dari usaha kami.</p>
                <form action="<?= base_url("krisar/tambah") ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="nama_pelanggan" class="form-control <?php echo form_error('nama_pelanggan') ? 'is-invalid' : '' ?>" value="<?= $pelanggan['nama']; ?>" id="nama_pelanggan" placeholder="Nama Anda" required readonly>
                            <div class="validate">
                                <?php echo form_error('nama_pelanggan') ?>
                            </div>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control <?php echo form_error('email') ? 'is-invalid' : '' ?>" value="<?= $pelanggan['email']; ?>" name="email" id="email" placeholder="Email" required readonly>
                            <div class="validate">
                                <?php echo form_error('email') ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control  <?php echo form_error('kritik_saran') ? 'is-invalid' : '' ?>" name="kritik_saran" rows="8" placeholder="Kritik & Saran" required oninvalid="this.setCustomValidity('Wajib Diisi')" oninput="setCustomValidity('')"></textarea>
                        <div class="validate">
                            <?php echo form_error('krisar') ?>
                        </div>
                    </div>
                    <br>
                    <div class="text-center"><button class="btn btn-primary" type="submit">Kirim Kritik & Saran</button>
                    </div>
                </form>
            </div>
    </section>
</section>