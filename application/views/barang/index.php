<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <?php if(validation_errors()){?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors();?>
                </div>
            <?php }?>
            <?= $this->session->flashdata('pesan'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#bukuBaruModal"><i class="fas fa-plus-square"></i> Barang Baru</a>
            <div class="table-responsive">
            <table id="example" class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Merek</th>
                        <th scope="col">Tanggal Masuk</th>
                        <th scope="col">Stok</t>
                        <th scope="col">Dipinjam</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $a = 1;
                        foreach ($barang as $b) { ?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td><?= $b['kode_barang']; ?></td>
                        <td><?= $b['nama_barang']; ?></td>
                        <td><?= $b['merek']; ?></td>
                        <td><?= date('d F Y', $b['tgl_masuk']); ?></td>
                        <td><?= $b['stok']; ?></td>
                        <td><?= $b['dipinjam']; ?></td>
                        <td>
                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('assets/img/upload/') . $b['image'];?>" class="img-fluid img-thumbnail" alt="..." style="width:80px;height:80px;">
                            </picture>
                        </td>
                        <td>
                            <a href="<?= base_url('barang/ubahBarang/').$b['kode_barang'];?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                            <a href="<?= base_url('barang/hapusBarang/').$b['kode_barang'];?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul.' '.$b['nama_barang'];?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Tambah buku baru-->
<div class="modal fade" id="bukuBaruModal" tabindex="-1" role="dialog" aria-labelledby="bukuBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bukuBaruModalLabel">Tambah Barang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('barang'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="kode_barang" name="kode_barang" placeholder="Masukkan kode barang">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="merek" name="merek" placeholder="Masukkan merk barang">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="stok" name="stok" placeholder="Masukkan nominal stok">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Mneu -->