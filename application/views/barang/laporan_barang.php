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
         <a href="<?= base_url('laporan/laporan_barang_cetak'); ?>" target="_blank" class="btn btn-primary mb-3"><i class="fas fa-print"></i> Print</a> 
         <a href="<?= base_url('laporan/laporan_barang_pdf'); ?>" class="btn btn-warning mb-3"><i class="far fa-file-pdf"></i> Download Pdf</a> 
         <a href="<?= base_url('laporan/laporan_barang_excel'); ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i> Export ke Excel</a> 
         <div class="table-responsive">
         <table id="example" class="table table-hover"> 
             <thead> 
                 <tr> 
                     <th scope="col">#</th> 
                     <th scope="col">Kode Barang</th> 
                     <th scope="col">Nama Barang</th> 
                     <th scope="col">Merek</th> 
                     <th scope="col">Tanggal Masuk</th> 
                     <th scope="col">Stok</> 
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
<!-- End of main content -->