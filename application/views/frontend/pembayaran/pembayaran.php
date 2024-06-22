<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="btn btn-sm btn-success">
                <?php
                $grand_total = 0;
                if ($keranjang = $this->cart->contents())
                {
                    foreach ($keranjang as $item)
                    {
                        $grand_total = $grand_total + $item['subtotal'];
                    }

                    echo "<h5>Total Laundry Anda: Rp." .number_format($grand_total,0,',','.');
                } ?>
            </div><br><br>

            <h3>Data Pengiriman</h3>

            <form method="post" action="<?php echo base_url() ?> katalog/proses_pesanan">
        
            <div class="form-group">
                <label>Kode Transaksi</label>
                <input type="text" name="kode_transaksi" placeholder="Masukkan Kode Transaksi">
            </div>

            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="kode_transaksi" placeholder="Masukkan Kode Transaksi">
            </div>

            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" name="kode_transaksi" placeholder="Masukkan Kode Transaksi">
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="kode_transaksi" placeholder="Masukkan Kode Transaksi">
            </div>

            <div class="form-group">
                <label>Tanggal Transaksi</label>
                <input type="text" name="kode_transaksi" placeholder="Masukkan Kode Transaksi">
            </div>

        </form>
        </div>


        <div class="col-md-2"></div>
    </div>
</div>