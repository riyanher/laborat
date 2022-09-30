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
 
 <h3><center>Nota Peminjaman Barang Lab Elektro</center></h3> 
 <br/> 
 <table class="table-data"> 
  <thead> 
   <tr> 
    <th>No</th>
    <th>No Pinjam</th> 
    <th>Nama Peminjam</th> 
    <th>Kode Barang</th>
    <th>Jumlah Pinjam</th> 
    <th>Tanggal Pinjam</th> 
    <th>Tanggal Kembali</th> 
    <th>Denda/hari</th>  
   </tr> 
  </thead> 
  <tbody> 
   <?php 
   $no = 1;    foreach($temp as $t){ 
   ?> 
   <tr> 
     <th scope="row"><?= $no++; ?></th> 
     <td><?= $t['no_pinjam']; ?></td> 
     <td><?= $t['nama_peminjam']; ?></td> 
     <td><?= $t['kode_barang']; ?></td>  
     <td><?= $t['jml_pinjam']; ?></td> 
     <td><?= $t['tgl_pinjam']; ?></td> 
     <td><?= $t['tgl_kembali']; ?></td> 
     <td><?= $t['denda']; ?></td>  
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