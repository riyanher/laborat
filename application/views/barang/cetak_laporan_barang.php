<!DOCTYPE html> 
<html> 
<head> 
 <title></title> 
</head> 
<body> 
 <style type="text/css"> 
 .table-data{ 
   width: 100%; 
   border-collapse: collapse; 
  } 
 
  .table-data tr th, 
  .table-data tr td{ 
   border:1px solid black; 
   font-size: 11pt; 
   font-family:Verdana; 
   padding: 10px 10px 10px 10px; 
  } 
  h3{ 
    font-family:Verdana; 
  } 
 </style> 
 
 <h3><center>Laporan Data Barang Laboratorium Elektronika</center></h3> 
 <br/> 
 <table class="table-data"> 
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
 
<script type="text/javascript"> 
 window.print(); 
</script> 
 
</body> 
</html> 