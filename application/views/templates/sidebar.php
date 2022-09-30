        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-flask"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Lab Elektro</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

           

            <!-- Looping Menu-->
                <div class="sidebar-heading">
                    Home
                </div>
                    <li class="nav-item active">
                        <!-- Nav Item - Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link pb-0" href="<?= base_url('admin'); ?>">
                                <i class="fa fa-fw fa-tachometer-alt"></i>
                                <span>Dashboard</span></a>
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
                        
                        <li class="nav-item">
                            <a class="nav-link pb-0" href="<?= base_url('barang'); ?>">
                                <i class="fa fa-fw fa-box"></i>
                                <span>Data Barang</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pb-0" href="<?= base_url('user/anggota'); ?>">
                                <i class="fa fa-fw fa-users"></i>
                                <span>Data Anggota</span></a>
                        </li>
                    </li>
                <!-- Divider -->
                <hr class="sidebar-divider mt-3">

                <!-- Heading -->
                <div class="sidebar-heading">Transaksi</div>
                    <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link pb-0" href="<?= base_url('pinjam'); ?>">
                            <i class="fa fa-fw fa-cart-plus"></i>
                            <span>Peminjaman</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-0" href="<?= base_url('pinjam/datapinjam'); ?>">
                            <i class="fa fa-fw fa-shopping-cart"></i>
                            <span>Data Peminjaman</span></a>
                    </li>
                </li>

                 <!-- Divider -->
                 <hr class="sidebar-divider mt-3">

                <!-- Heading -->
                <div class="sidebar-heading">Laporan</div>
                    <!-- Nav Item - Dashboard -->
                <li class="nav-item active">
                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link pb-0" href="<?= base_url('laporan/laporanbarang'); ?>">
                            <i class="fa fa-fw fa-clipboard-list"></i>
                            <span>Laporan Data Barang</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pb-0" href="<?= base_url('laporan/laporanpeminjaman'); ?>">
                            <i class="fa fa-fw fa-clipboard-list"></i>
                            <span>Laporan Data Peminjaman</span></a>
                    </li>

                <!-- Divider -->
                <hr class="sidebar-divider mt-3">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none mt-3 d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar --   > 
        
        