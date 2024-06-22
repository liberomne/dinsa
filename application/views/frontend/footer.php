<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .footer {
        position: absolute;
        width: 100%;
        padding: 15px 0;
        /* Sesuaikan dengan warna teks footer */
    }
</style>

<body>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <center>
                <span class="copyright"> Copyright &copy; <?= $nama_laundry; ?> </span>
            </center>
        </div>
    </footer>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('member/logout'); ?>">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="<?= base_url('assets/frontend/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/frontend/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?= base_url('assets/frontend/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="<?= base_url('assets/frontend/'); ?>js/jqBootstrapValidation.js"></script>
    <script src="<?= base_url('assets/frontend/'); ?>js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?= base_url('assets/frontend/'); ?>js/agency.min.js"></script>

</body>

</html>