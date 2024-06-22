<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-person-booth"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dinsa <br> Laundry</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Looping Menu-->
    <div class="sidebar-heading">
        Beranda
    </div>
    <li class="nav-item active">
        <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('admin'); ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dasbor</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('user'); ?>">
            <i class="fas fa-fw fa-id-card"></i>
            <span>Profil Saya</span></a>
    </li>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mt-3">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <!-- Nav Item - Dashboard -->
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('profil_laundry'); ?>">
            <i class="fas fa-store"></i>
            <span>Profil Laundry</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('baju'); ?>">
            <i class="fas fa-fw fa-tshirt"></i>
            <span>Jenis Laundry</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('pembayaran'); ?>">
            <i class="fas fa-fw fa-wallet"></i>
            <span>Metode Pembayaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mt-3">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <!-- Nav Item - Dashboard -->
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('riwayat'); ?>">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Riwayat Transaksi</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('krisar'); ?>">
            <i class="fas fa-fw fa-comments"></i>
            <span>Kritik dan Saran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mt-3">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <!-- Nav Item - Dashboard -->
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('laporan'); ?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Laporan Transaksi</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('krisar/cetak'); ?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Laporan Kritik dan Saran</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider mt-3">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar --   > 
        
        