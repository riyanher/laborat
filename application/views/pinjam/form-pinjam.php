<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <?php if (validation_errors()) { ?>
                <div class="alert alert-danger alert-message" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php } ?>
            <?= $this->session->flashdata('pesan'); ?>
            
                <form action="<?= base_url('pinjam') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">No Pinjam</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_pinjam" name="no_pinjam" value="<?= $no_pinjam; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Nama Peminjam</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-user" id="nama_peminjam" name="nama_peminjam" placeholder="Masukkan Nama Peminjam" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Kode barang</label>
                        <div class="col-sm-8">
                        <select id="kode_barang" name="kode_barang" class="form-control form-control-user select">
                            <option value="">Masukkan Kode Barang</option>
                            <?php
                            foreach ($barang as $b) { ?>
                                <option value="<?= $b['kode_barang'];?>" data-max="<?= $b['stok']; ?>"><?= $b['kode_barang'];?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Jumlah Pinjam</label>
                        <div class="col-sm-8">
                        <input type="number" class="form-control form-control-user" id="jml_pinjam" name="jml_pinjam" min="1" max="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Denda/item/hari</label>
                        <div class="col-sm-8">
                        <input type="number" class="form-control form-control-user" id="denda" name="denda" value="5000" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Tanggal Pinjam</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control form-control-user" id="tgl_pinjam" name="tgl_pinjam" placeholder="Masukkan Nama Barang" value="<?= $tgl_pinjam; ?>" readonly>
                        </div>
                    </div>
                    
                    
                    <div class="form-group position-relative end-0">
                        <input type="submit" class="form-control form-control-user btn btn-primary col-lg-3 mt-3" value="Proses">
                    </div>
                </form>
            
        </div>
    </div>
</div>