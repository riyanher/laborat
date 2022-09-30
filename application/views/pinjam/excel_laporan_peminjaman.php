<?php 
header("Content-type: application/vnd-ms-excel"); 
header("Content-Disposition: Attachment; filename=$title.xls"); 
header("Pragma: no-cache"); 
header("Expires:0"); ?> 
 
 <h3><center>Laporan Data Peminjaman Barang Laboratorium Elektronika</center></h3> 
 <br/> 
 <table border="1"> 
  <thead> 
   <tr> 
    <th>No</th> 
    <th>Nama Peminjam</th> 
    <th>Nama Barang</th>
    <th>Jumlah Pinjam</th> 
    <th>Tanggal Pinjam</th> 
    <th>Tanggal Kembali</th> 
    <th>Tanggal Pengembalian</th> 
    <th>Total Denda</th> 
    <th>Status</th> 
   </tr> 
  </thead> 
  <tbody> 
   <?php 
   $no = 1;    foreach($laporan as $l){ 
   ?> 
   <tr> 
     <th scope="row"><?= $no++; ?></th> 
     <td><?= $l['nama_peminjam']; ?></td> 
        <td><?= $l['nama_barang']; ?></td> 
        <td><?= $l['jml_pinjam']; ?></td> 
        <td><?= $l['tgl_pinjam']; ?></td> 
        <td><?= $l['tgl_kembali']; ?></td> 
        <td><?= $l['tgl_pengembalian']; ?></td> 
        <td><?= $l['total_denda']; ?></td> 
        <td><?= $l['status']; ?></td> 
   </tr> 
   <?php 
  } 
  ?> 
 </tbody> 
</table> 