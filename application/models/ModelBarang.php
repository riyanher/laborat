<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelBarang extends CI_Model
{
    //manajemen barang
    public function getBarang()
    {
        return $this->db->get('barang');
    }

    public function updateKurangStok($kode_barang, $jml_pinjam)
    {
        $where = ['kode_barang' => $kode_barang];
        $getStok = $this->db->get_where('barang', $where)->row()->stok;
        $jumlahStok = (int) $getStok - (int) $jml_pinjam;

        $this->db->update('barang', ['stok' => $jumlahStok], $where);
    }
    public function updateTambahStok($kode_barang, $jml_pinjam)
    {
        $where = ['kode_barang' => $kode_barang];
        $getStok = $this->db->get_where('barang', $where)->row()->stok;
        $jumlahStok = (int) $getStok + (int) $jml_pinjam;

        $this->db->update('barang', ['stok' => $jumlahStok], $where);
    }

    public function barangWhere($where)
    {
        return $this->db->get_where('barang', $where);
    }

    public function simpanBarang($data = null)
    {
        $this->db->insert('barang',$data);
    }

    public function updateBarang($data = null, $where = null)
    {
        $this->db->update('barang', $data, $where);
    }

    public function hapusBarang($where = null)
    {
        $this->db->delete('barang', $where);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if(!empty($where) && count($where) > 0){
            $this->db->where($where);
        }
        $this->db->from('barang');
        return $this->db->get()->row($field);
    }
    
    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }

    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }

    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }

    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }

    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }

    //join
    public function joinKategoriBuku($where)
    {
        $this->db->select('buku.id_kategori,kategori.kategori');
        $this->db->from('buku');
        $this->db->join('kategori','kategori.id = buku.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }
}