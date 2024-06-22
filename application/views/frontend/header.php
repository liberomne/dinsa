<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $judul; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/frontend/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?= base_url('assets/frontend/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/frontend/'); ?>css/agency.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/logo/icondinsa.jpg') ?>">

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="<?= base_url('home/') ?>"><img src="<?= base_url('assets/img/logo/dinsalogo.png') ?>" width="250px"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ml-auto">

                    <?php if ($judul == 'Dinsa Laundry | Home') : ?>
                        <li class="nav-item active">
                            <a class="nav-link mr-3" href="<?= base_url('home/'); ?>"><b>Beranda</b></a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link mr-3" href="<?= base_url('home/'); ?>">Beranda</a>
                        </li>
                    <?php endif; ?>

                    <?php if ($judul == 'Katalog | Dinsa Laundry') : ?>
                        <li class="nav-item">
                            <a class="nav-link active mr-3" href="<?= base_url('katalog/'); ?>"><b>Katalog</b></a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link mr-3" href="<?= base_url('katalog/'); ?>">Katalog</a>
                        </li>
                    <?php endif; ?>

                    <?php
                    if (!empty($this->session->userdata('email'))) { ?>
                        <?php if ($judul == 'Keranjang Anda | Dinsa Laundry') : ?>
                            <li class="nav-item">
                                <a class="nav-link active mr-3" href="<?= base_url('keranjang/'); ?>"><b><i class="fas fa-shopping-basket"></i> <?= $this->data['notif_keranjang']; ?></b></a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link mr-3" href="<?= base_url('keranjang/'); ?>"><i class="fas fa-shopping-basket"></i> <?= $this->data['notif_keranjang']; ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if ($judul == 'Cek Pemesanan | Dinsa Laundry') : ?>
                            <li class="nav-item">
                                <a class="nav-link active mr-3" href="<?= base_url('cek_pemesanan/'); ?>"><b>Cek Pemesanan</b></a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link mr-3" href="<?= base_url('cek_pemesanan/'); ?>">Cek Pemesanan</a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if ($judul == 'Kritik & Saran | Dinsa Laundry') : ?>
                            <li class="nav-item">
                                <a class="nav-link active mr-3" href="<?= base_url('krisar/tambah/'); ?>"><b>Kritik & Saran</b></a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link mr-3" href="<?= base_url('krisar/tambah/'); ?>">Kritik & Saran</a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item dropdown">
                            <a class="btn btn-secondary dropdown-toggle mt-2" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $pelanggan; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="<?= base_url('member/myProfil'); ?>">Profil Saya</a>
                                <a class="dropdown-item" href="<?= base_url('member/logout'); ?>" data-toggle="modal" data-target="#logoutModal">Keluar</a>
                            </div>
                        </li>


                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="btn btn-secondary dropdown-toggle mt-2" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Pengunjung
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" data-toggle="modal" data-target="#loginModal" href="#">Masuk</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#daftarModal" href="#">Daftar</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>


        </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
        <div class="container">
            <div class="intro-text">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="intro-lead-in">Pesan Online di Dinsa Laundry!</div>
                <div class="intro-heading text-uppercase">Cuci Bersih Tanpa Batas!</div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="<?= base_url('katalog/'); ?>">Pesan
                    Laundry</a>
            </div>
        </div>
    </header>