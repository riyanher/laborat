<?php 
header("Content-type: application/vnd-ms-excel"); 
header("Content-Disposition: Attachment; filename=$title.xls"); 
header("Pragma: no-cache"); 
header("Expires:0");  
?> 
 
 <h3><center>Laporan Data Barang Laboratorium Elektronika</center></h3> 
 <br/> 
 <table border="1"> 
  <thead> 
   <tr> 
    <th>No</th> 
    <th>Kode Barang</th> 
    <th>Nama Barang</th> 
    <th>Merek</th>  
    <th>Tanggal Masuk</th>    
    <th>Stok</th> 
   </tr> 
  </thead> 
  <tbody> 
   <?php 
   $no = 1; 
   foreach($barang as $b){ 
   ?> 
   <tr> 
     <th scope="row"><?= $no++; ?></th> 
     <td><?= $b['kode_barang']; ?></td> 
     <td><?= $b['nama_barang']; ?></td> 
     <td><?= $b['merek']; ?></td> 
     <td><?= date('d F Y', $b['tgl_masuk']); ?></td> 
     <td><?= $b['stok']; ?></td> 
   </tr> 
   <?php 
  } 
  ?> 
 </tbody> 
</table> 