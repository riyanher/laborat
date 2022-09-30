<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-6">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            <?php foreach ($barang as $b) { ?>
                <form action="<?= base_url('barang/ubahBarang'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="kode_barang" id="kode_barang" value="<?php echo $b['kode_barang']; ?>">
                        <input type="text" class="form-control form-control-user" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang" value="<?= $b['nama_barang']; ?>">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="merek" name="merek" placeholder="Masukkan Merek Barang" value="<?= $b['merek']; ?>">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok" value="<?= $b['stok']; ?>">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($b['image'])) { ?>

                            <input type="hidden" name="old_pict" id="old_pict" value="<?= $b['image']; ?>">

                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('assets/img/upload/') . $b['image']; ?>" class="img-fluid img-thumbnail" alt="..." >
                            </picture>

                        <?php } ?>

                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <input type="button" class="form-control form-control-user btn btn-dark col-lg-3 mt-3" value="Kembali" onclick="window.history.go(-1)">
                        <input type="submit" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Ubah">
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
</div>