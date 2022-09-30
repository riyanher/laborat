<!-- Begin Page Content --> 
<div class="container-fluid"> 
 
    <?= $this->session->flashdata('pesan'); ?> 
    <div class="row"> 
        <div class="col-lg-12"> 
            <?php if(validation_errors()){?> 
                <div class="alert alert-danger" role="alert"> 
                <?= validation_errors();?> 
                </div> 
            <?php }?> 
            <?= $this->session->flashdata('pesan'); ?> 
            <a href="<?= base_url('laporan/laporan_peminjaman_cetak');?>" target="_blank" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print</a> 
            <a href="<?= base_url('laporan/laporan_peminjaman_pdf'); ?>" class="btn btn-warning mb-3"><i class="far fa-file-pdf"></i> Download Pdf</a> 
            <a href="<?= base_url('laporan/laporan_peminjaman_excel'); ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i> Export ke Excel</a> 
            <div class="table-responsive">
            <table id="example" class="table table-hover" > 
                <thead> 
                    <tr> 
                        <th scope="col">#</th> 
                        <th scope="col">Nama Peminjam</th> 
                        <th scope="col">Nama Barang</th> 
                        <th scope="col">Jumlah Pinjam</th> 
                        <th scope="col">Tanggal Pinjam</th>                         
                        <th scope="col">Tanggal Kembali</th> 
                        <th scope="col">Tanggal Pengembalian</th> 
                        <th scope="col">Total Denda</th> 
                        <th scope="col">Status</th> 
                    </tr> 
                </thead> 
                <tbody> 
 
                    <?php 
                        $a = 1; 
                        foreach ($laporan as $l) { ?> 
                    <tr> 
                        <th scope="row"><?= $a++; ?></th> 
                        <td><?= $l['nama_peminjam']; ?></td> 
                        <td><?= $l['nama_barang']; ?></td> 
                        <td><?= $l['jml_pinjam']; ?></td> 
                        <td><?= $l['tgl_pinjam']; ?></td> 
                        <td><?= $l['tgl_kembali']; ?></td> 
                        <td><?= $l['tgl_pengembalian']; ?></td> 
                        <td><?= $l['total_denda']; ?></td> 
                        <td><?= $l['status']; ?></td> 
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