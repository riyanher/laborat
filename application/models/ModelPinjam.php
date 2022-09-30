<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed'); 
 
class ModelPinjam extends CI_Model 
{ 
    public function getPinjam()
    {
        return $this->db->get('pinjam');
    }

    public function kode_pinjam() {
        $sql = ("SELECT MAX(MID(no_pinjam,8,2)) AS kode_pinjam 
                 FROM pinjam 
                 WHERE MID(no_pinjam,2,6) = DATE_FORMAT(CURDATE(), '%y%m%d')");
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->kode_pinjam) + 1;
            $no = sprintf("%'.02d", $n);
        } else {
            $no = "01";
        }
        $no_pinjam = "P".date('ymd').$no;
        return $no_pinjam;
    }

    public function simpanPinjam($data) 
    {
        $this->db->insert('pinjam', $data);
    }

    public function updateTambahDipinjam($kode_barang, $jml_pinjam)
    {
        $where = ['kode_barang' => $kode_barang];
        $getDipinjam = $this->db->get_where('barang', $where)->row()->dipinjam;
        $jumlahDipinjam = (int) $getDipinjam + (int) $jml_pinjam;

        $this->db->update('barang', ['dipinjam' => $jumlahDipinjam], $where);
    }
    public function updateKurangDipinjam($kode_barang, $jml_pinjam)
    {
        $where = ['kode_barang' => $kode_barang];
        $getDipinjam = $this->db->get_where('barang', $where)->row()->dipinjam;
        $jumlahDipinjam = (int) $getDipinjam - (int) $jml_pinjam;

        $this->db->update('barang', ['dipinjam' => $jumlahDipinjam], $where);
    }

    public function simpanDetail($data)
    {
        $this->db->insert('detail_pinjam', $data);
    }
    
    public function joinData() 
    { 
        $this->db->select('*'); 
        $this->db->from('pinjam'); 
        $this->db->join('detail_pinjam', 'detail_pinjam.no_pinjam=pinjam.no_pinjam', 'Right'); 
         
        return $this->db->get()->result_array();  
    }

    public function kosongkanData($table)
    {
        return $this->db->truncate($table);
    }

    public function simpanTemp($data)
    {
        $this->db->insert('temp', $data);
    }

    public function getTemp()
    {
        return $this->db->get('temp');
    }

    public function jumlahPinjam($field, $where)
    {
        $this->db->select($field);
        
        $this->db->where('no_pinjam', $where);
        
        $this->db->from('pinjam');
        return $this->db->get()->row($field);
    }

    public function tglPengembalian($field, $where)
    {
        $this->db->select($field);
        
        $this->db->where('no_pinjam', $where);
        
        $this->db->from('pinjam');
        return $this->db->get()->row($field);
    }
    
    public function ambilCellDetailPinjam($field, $where)
    {
        $this->db->select($field);
        
        $this->db->where('no_pinjam', $where);
        
        $this->db->from('detail_pinjam');
        return $this->db->get()->row($field);
    }

    public function joinDataPeminjaman() 
    { 
        $this->db->select('*'); 
        $this->db->from('pinjam'); 
        $this->db->join('detail_pinjam', 'detail_pinjam.no_pinjam=pinjam.no_pinjam', 'Left');
        $this->db->join('barang', 'barang.kode_barang=pinjam.kode_barang', 'Left');
        $this->db->order_by('pinjam.no_pinjam', 'ASC'); 
         
        return $this->db->get()->result_array();  
    }

    public function banyakPeminjaman($where)
    {
        $this->db->select('no_pinjam');
        $this->db->where('tgl_pinjam', $where);
        $this->db->from('pinjam');
        return $this->db->get()->num_rows();
    }
    

}