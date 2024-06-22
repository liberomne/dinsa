<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Tampilkan pesan flashdata -->
    <?php if ($this->session->flashdata('pesan')) : ?>
        <div class="alert alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    <!-- Tambahkan CSS langsung di sini -->
    <style>
        .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
        }

        .card-body>div:first-child {
            flex: 1;
        }

        .card-body .col-auto {
            display: flex;
            align-items: center;
        }

        .card-body a {
            display: flex;
            align-items: center;
        }

        .text-md {
            font-size: 1rem;
        }

        .h1 {
            font-size: 2rem;
            margin-top: 2.5rem;
        }

        .text-uppercase {
            height: 3rem;
            /* Menetapkan tinggi tetap untuk teks */
        }

        .h1 {
            height: 2.5rem;
            /* Menetapkan tinggi tetap untuk teks */
        }

        .fa-3x {
            font-size: 3rem;
            height: 3rem;
            line-height: 3rem;
            /* Menetapkan tinggi tetap untuk ikon */
            margin-bottom: 1rem;
        }
    </style>

    <!-- row ux-->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-white">
                <div class="card-body">
                    <div>
                        <div class="text-md font-weight-bold text-black text-uppercase mb-1">Jumlah Jenis Laundry</div>
                        <div class="h1 mb-0 font-weight-bold text-black"><?= $total_jenis; ?></div>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('baju'); ?>"><i class="fas fa-tshirt fa-3x text-primary"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-white">
                <div class="card-body">
                    <div>
                        <div class="text-md font-weight-bold text-black text-uppercase mb-1">Jumlah Metode Pembayaran</div>
                        <div class="h1 mb-0 font-weight-bold text-black"><?= $total_metode_pembayaran; ?></div>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('pembayaran'); ?>"><i class="fas fa-wallet fa-3x text-primary"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-white">
                <div class="card-body">
                    <div>
                        <div class="text-md font-weight-bold text-black text-uppercase mb-1">Jumlah Transaksi</div>
                        <div class="h1 mb-0 font-weight-bold text-black"><?= $total_transaksi; ?></div>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('riwayat'); ?>"><i class="fas fa-folder-open fa-3x text-primary"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 bg-white">
                <div class="card-body">
                    <div>
                        <div class="text-md font-weight-bold text-black text-uppercase mb-1">Jumlah Kritik dan Saran</div>
                        <div class="h1 mb-0 font-weight-bold text-black"><?= $total_krisar; ?></div>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('krisar'); ?>"><i class="fas fa-comments fa-3x text-primary"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->