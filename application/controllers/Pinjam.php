<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pinjam extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }
    
    public function index() {
        $data['judul'] = 'Peminjaman';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['tgl_pinjam'] = date('Y-m-d');
        $data['no_pinjam'] = $this->ModelPinjam->kode_pinjam();
        $data['barang'] = $this->ModelBarang->getBarang()->result_array();
        
        $this->form_validation->set_rules('nama_peminjam', 'Nama Peminjam', 'required|min_length[3]', [
            'required' => 'Nama Peminjam harus diisi',
            'min_length' => 'Nama Peminjam terlalu pendek'
        ]);
        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required', [
            'required' => 'Kode Barang harus diisi',
        ]);
        $this->form_validation->set_rules('jml_pinjam', 'Jumlah pinjam', 'required', [
            'required' => 'Jumlah Pinjam harus diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pinjam/form-pinjam', $data);
            $this->load->view('templates/footer');
        } else {
            $datapinjam = [
                'no_pinjam' => $this->input->post('no_pinjam', true),
                'tgl_pinjam' => $this->input->post('tgl_pinjam', true),
                'nama_peminjam' => $this->input->post('nama_peminjam', true),
                'kode_barang' => $this->input->post('kode_barang', true),
                'jml_pinjam' => $this->input->post('jml_pinjam', true),   
                'tgl_kembali' => date('Y-m-d'),
                'tgl_pengembalian' => '0000-00-00',
                'status' => 'Pinjam',
                'total_denda' => 0
            ];
            $datadetail = [
                'no_pinjam' => $this->input->post('no_pinjam', true),
                'kode_barang' => $this->input->post('kode_barang', true),
                'denda' => $this->input->post('denda', true) * $this->input->post('jml_pinjam', true)
            ];
            $datatemp = [
                'no_pinjam' => $this->input->post('no_pinjam', true),
                'tgl_pinjam' => $this->input->post('tgl_pinjam', true),
                'nama_peminjam' => $this->input->post('nama_peminjam', true),
                'kode_barang' => $this->input->post('kode_barang', true),
                'jml_pinjam' => $this->input->post('jml_pinjam', true),   
                'tgl_kembali' => date('Y-m-d'),
                'denda' => $this->input->post('denda', true) * $this->input->post('jml_pinjam', true)
            ];

            $this->ModelPinjam->simpanPinjam($datapinjam);
            $this->ModelPinjam->simpanDetail($datadetail);

            $this->ModelPinjam->kosongkanData('temp');
            $this->ModelPinjam->simpanTemp($datatemp);

            //update nilai stok barang dan barang yang dipinjam
            $this->ModelPinjam->updateTambahDipinjam($datapinjam['kode_barang'], $datapinjam['jml_pinjam']);
            $this->ModelBarang->updateKurangStok($datapinjam['kode_barang'], $datapinjam['jml_pinjam']);
            

            
            //$this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert">Transaksi Peminjaman Sukses</div>'); 
            redirect('pinjam/cetakPinjam');

        }
    }

    public function cetakPinjam()
    {
        
        $data['temp'] = $this->ModelPinjam->getTemp()->result_array();
     
        $this->load->view('pinjam/print-pinjam',$data);
    }

    public function dataPinjam()
    {
        $data['judul'] = "Data Peminjaman"; 
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['pinjam'] = $this->ModelPinjam->getPinjam()->result_array();
        $data['pinjam'] = $this->ModelPinjam->joinData(); 
 
        $this->load->view('templates/header', $data);   
        $this->load->view('templates/sidebar', $data); 
        $this->load->view('templates/topbar', $data); 
        $this->load->view('pinjam/data-pinjam', $data); 
        $this->load->view('templates/footer');
    }

    public function ubahStatus()
    {
        $kode_barang = $this->uri->segment(3); 
        $no_pinjam = $this->uri->segment(4); 
        $where = ['kode_barang' => $this->uri->segment(3),];
        $jumlah = $this->ModelPinjam->jumlahPinjam('jml_pinjam', $no_pinjam);
        $jml_pinjam = (int)$jumlah;
        
        $tgl = date('Y-m-d'); 
        $status = 'Kembali'; 
        
        //update status menjadi kembali pada saat buku dikembalikan 
        $this->db->query("UPDATE pinjam, detail_pinjam SET pinjam.status='$status', pinjam.tgl_pengembalian='$tgl' WHERE detail_pinjam.kode_barang='$kode_barang' AND pinjam.no_pinjam='$no_pinjam'"); 
       
        //mencari selisih waktu pengembalian
        $tgl_pengembalian = $this->ModelPinjam->tglPengembalian('tgl_pengembalian', $no_pinjam);
        $tgl1 = new DateTime($tgl_pengembalian);
        $tgl_kembali = $this->ModelPinjam->tglPengembalian('tgl_kembali', $no_pinjam);
        $tgl2 = new DateTime($tgl_kembali);
        $selisih = (int)$tgl2->diff($tgl1)->format("%a");

        //menghitung total denda pada tabel pinjam
        $denda = (int)$this->ModelPinjam->ambilCellDetailPinjam('denda', $no_pinjam);
        $total_denda = $selisih * $denda;

        //update total denda pada tabel peminjaman
        $this->db->query("UPDATE pinjam SET pinjam.total_denda='$total_denda' WHERE pinjam.no_pinjam='$no_pinjam'");
        
        // //update stok dan dipinjam pada tabel buku 
        // //$this->db->query("UPDATE buku, detail_pinjam SET buku.dipinjam=buku.dipinjam-1, buku.stok=buku.stok+1 WHERE buku.id=detail_pinjam.id_buku"); 
        $this->ModelPinjam->updateKurangDipinjam($kode_barang, $jml_pinjam);
        $this->ModelBarang->updateTambahStok($kode_barang, $jml_pinjam);

        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-success" role="alert">Barang sudah dikembalikan</div>'); 
        redirect('pinjam/dataPinjam');
    }

}