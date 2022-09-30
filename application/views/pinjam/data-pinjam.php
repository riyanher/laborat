<div class="container"> 
    <?= $this->session->flashdata('pesan'); ?>         
             
                    <div class="table-responsive"> 
                        <table class="table table-bordered table-striped table-hover" id="example"> 
                            <thead>
                                <tr> 
                                    <th>No Pinjam</th> 
                                    <th>Tanggal Pinjam</th> 
                                    <th>Nama Peminjam</th> 
                                    <th>Kode Barang</th>
                                    <th>Jumlah Pinjam</th> 
                                    <th>Tanggal Kembali</th> 
                                    <th>Tanggal Pengembalian</th> 
                                    <th>Terlambat</th> 
                                    <th>Denda/Hari</th> 
                                    <th>Status</th> 
                                    <th>Total Denda</th> 
                                    <th>Pilihan</th> 
                                </tr>
                            </thead>
                            <tbody> 
                            <?php 
                            foreach ($pinjam as $p) { 
                            ?> 
                                <tr> 
                                    <td><?= $p['no_pinjam']; ?></td> 
                                    <td><?= $p['tgl_pinjam']; ?></td> 
                                    <td><?= $p['nama_peminjam']; ?></td> 
                                    <td><?= $p['kode_barang']; ?></td>
                                    <td><?= $p['jml_pinjam'] ?></td>  
                                    <td><?= $p['tgl_kembali']; ?></td> 
                                    <td> 
                                        <?= date('Y-m-d'); ?> 
                                        <input type="hidden" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y-m-d'); ?>"> 
                                    </td> 
                                    <td> 
                                        <?php 
                                        $tgl1 = new DateTime($p['tgl_kembali']); 
                                        $tgl2 = new DateTime();
                                        if(date('Y-m-d')>$p['tgl_kembali']) { 
                                            $selisih = $tgl2->diff($tgl1)->format("%a");
                                        } else { 
                                            $selisih = 0; 
                                        } 
                                        echo $selisih; 
                                        ?> Hari 
                                    </td> 
                                    <td><?= $p['denda']; ?></td> 
 
                                    <?php if ($p['status'] == "Pinjam") { 
                                        $status = "warning"; 
                                    } else { 
                                        $status = "secondary"; 
                                    } ?> 
                                    <td><i class="btn btn-outline-<?= $status; ?> btn-sm"><?= $p['status']; ?></i></td> 
 
                                    <?php 
                                    if ($selisih < 0) { 
                                        $total_denda = $p['denda'] * 0; 
                                    } else { 
                                        $total_denda = $p['denda'] * $selisih; 
                                    } 
                                    ?> 
 
                                    <td><?= $total_denda; ?> 
                                        <input type="hidden" name="total_denda" id="total_denda" value="<?= $total_denda; ?>"> 
                                    </td> 
                                    <td nowrap> 
                                        <?php if ($p['status'] == "Kembali") { ?> 
                                            <i class="btn btn-sm btn-outline-secondary"><i class="fas fa-fw fa-edit"></i>Ubah Status</i> 
                                        <?php } else { ?> 
                                            <a class="btn btn-sm btn-outline-info" href="<?= base_url('pinjam/ubahStatus/' . $p['kode_barang'] . '/' . $p['no_pinjam']); ?>"><i class="fas fa-fw fa-edit"></i>Ubah Status</a>  
                                        <?php } ?> 
                                    </td> 
                                </tr> 
                            <?php 
                            } ?>
                            </tbody> 
                        </table> 
                    </div> 
</div>