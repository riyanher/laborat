<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- row ux-->
  <div class="row owl-carousel" id="owl">
    <!-- jumlah anggota -->
    <div class="item col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2 bg-white">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Jumlah Anggota</div>
              <div class="h2 mb-0 font-weight-bold text-primary"><?= $this->ModelUser->getUser()->num_rows(); ?></div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('user/anggota'); ?>"><i class="fas fa-users fa-3x text-primary"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Stok barang -->
    <div class="item col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2 bg-white">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Barang Terdaftar</div>
              <div class="h2 mb-0 font-weight-bold text-primary">
                <?= $this->ModelBarang->getBarang()->num_rows(); ?>
              </div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('barang'); ?>"><i class="fas fa-box fa-3x text-primary"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- barang dipinjam -->
    <div class="item col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2 bg-white">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Barang Dipinjam</div>
              <div class="h2 mb-0 font-weight-bold text-primary">
                <?php
                $where = ['dipinjam != 0'];
                $totaldipinjam = $this->ModelBarang->total('dipinjam', $where);
                echo $totaldipinjam;
                ?>
              </div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('pinjam/datapinjam'); ?>"><i class="fas fa-user-tag fa-3x text-primary"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- banyak transaksi -->
    <div class="item col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2 bg-white">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-primary text-uppercase mb-1">Peminjaman Hari ini</div>
              <div class="h2 mb-0 font-weight-bold text-primary">
                <?php
                $where = date('Y-m-d');
                $totaltransaksi = $this->ModelPinjam->banyakPeminjaman($where);
                echo $totaltransaksi;
                ?>
              </div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('pinjam/datapinjam'); ?>"><i class="fas fa-shopping-cart fa-3x text-primary"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  <!-- end row ux-->
  
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- row table-->
  <div class="row">
    <div class="table-responsive table-bordered col-sm-5 ml-auto mr-auto mt-2">
      <div class="page-header">
        <span class="fas fa-users text-primary mt-2 "> Data User</span>
        <a class="text-primary" href="<?php echo base_url('user/data_user'); ?>"><i class="fas fa-search mt-2 float-right"> Tampilkan</i></a>
      </div>
      <table class="table mt-3">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Anggota</th>
            <th>Email</th>
            <th>Aktif</th>
            <th>Member Sejak</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($anggota as $a) { ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $a['nama']; ?></td>
              <td><?= $a['email']; ?></td>
              <td><?= $a['is_active']; ?></td>
              <td><?= date('Y', $a['tanggal_input']); ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


    <div class="table-responsive table-bordered col-sm-5 ml-auto mr-auto mt-2">
      <div class="page-header">
        <span class="fas fa-book text-primary mt-2"> Data Barang</span>
        <a href="<?= base_url('barang'); ?>"><i class="fas fa-search text-primary mt-2 float-right"> Tampilkan</i></a>
      </div>
      <div class="table-responsive">
        <table class="table mt-3" id="table-datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Merek</th>
              <th>Stok</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($barang as $b) { ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $b['kode_barang']; ?></td>
                <td><?= $b['nama_barang']; ?></td>
                <td><?= $b['merek']; ?></td>
                <td><?= $b['stok']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>


  </div>
  <!-- end of row table-->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->