<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -15px;
        }

        .col-lg-12,
        .col-lg-6,
        .col-md-6 {
            padding: 15px;
            box-sizing: border-box;
        }

        .col-lg-12 {
            width: 100%;
        }

        .col-lg-6 {
            width: 50%;
        }

        @media (max-width: 768px) {
            .col-lg-6 {
                width: 100%;
            }
        }

        .text-center {
            text-align: center;
        }

        .section-heading {
            font-size: 2em;
            margin-bottom: 20px;
        }

        .section-subheading {
            font-size: 1.2em;
            color: #6c757d;
            margin-bottom: 40px;
        }

        .content img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .content p {
            text-align: justify;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li i {
            margin-right: 5px;
        }
    </style>
</head>

<body>

    <!-- Tentang Laundry -->
    <section class="page-section section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Tentang <?= $nama_laundry; ?></h2>
                </div>
            </div>
            <div class="row content">
                <div class="col-lg-6">
                    <p><?= $deskripsi; ?></p>
                </div>
                <div class="col-lg-6">
                    <img src="<?= base_url(); ?>assets/img/gambar/<?= $gambar; ?>" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Laundry -->
    <section class="bg-light page-section section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Informasi <?= $nama_laundry; ?></h2>
                    <h3 class="section-subheading text-muted">Selamat Datang di Toko Laundry Kami!</h3>
                </div>
            </div>
            <div class="row content">
                <div class="col-lg-6">
                    <?php if ($link_maps !== "") { ?>
                        <iframe src="<?= $link_maps; ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <?php } else { ?>
                        <h3><?= $nama_laundry; ?> belum menambahkan google maps</h3>
                    <?php } ?>
                </div>
                <div class="col-lg-6">
                    <p>Informasi Mengenai <?= $nama_laundry; ?></p>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Alamat: <?= $alamat; ?></li>
                        <li><i class="fas fa-phone-alt"></i> No Telepon: <?= $nomor_telepon; ?></li>
                        <li><i class="fas fa-envelope"></i> Email: <?= $email; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Metode Pembayaran</h2>
                </div>
            </div>
            <br>
            <div class="row d-flex justify-content-center text-center">
                <?php foreach ($pembayaran as $byr) { ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="<?= base_url(); ?>assets/img/pembayaran/<?= $byr->gambar; ?>" target="_blank">
                            <img src="<?= base_url(); ?>assets/img/pembayaran/<?= $byr->gambar; ?>" width="50" alt="">
                        </a>
                        <h6 class="title">a/n: <?= $byr->atas_nama; ?></h6>
                        <p class="description"><?= $byr->nomor_pembayaran; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

</body>

</html>