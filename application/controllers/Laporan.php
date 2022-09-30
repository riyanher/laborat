<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    //seputar laporan data barang
    public function laporanBarang()
    {
        $data['judul'] = 'Laporan Data Barang';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['barang'] = $this->ModelBarang->getBarang()->result_array();

        $this->load->view('templates/header', $data); 
        $this->load->view('templates/sidebar', $data); 
        $this->load->view('templates/topbar', $data); 
        $this->load->view('barang/laporan_barang', $data); 
        $this->load->view('templates/footer');
    }

    public function laporan_barang_cetak()
    {
        $data['barang'] = $this->ModelBarang->getBarang()->result_array();
        
        $this->load->view('barang/cetak_laporan_barang', $data);
    } 

    public function laporan_barang_pdf()
    {
        $data['barang'] = $this->ModelBarang->getBarang()->result_array();
        
        $sroot      = $_SERVER['DOCUMENT_ROOT']; 
        include $sroot."/pustaka-booking/application/third_party/dompdf/autoload.inc.php"; 
        $dompdf = new Dompdf\Dompdf();

        $this->load->view('barang/pdf_laporan_barang', $data);

        $paper_size  = 'A4'; // ukuran kertas 
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape 
        $html = $this->output->get_output(); 
     
        $dompdf->set_paper($paper_size, $orientation); 
        //Convert to PDF 
        $dompdf->load_html($html); 
        $dompdf->render(); 
        $dompdf->stream("laporan_data_barang.pdf", array('Attachment' => 0)); 
        // nama file pdf yang di hasilkan
    }

    public function laporan_barang_excel(){
      $data=array(
        'title'=>'Laporan Data Barang Laboratorium Elektronika',
        'barang'=>$this->ModelBarang->getbarang()->result_array());
        $this->load->view('barang/excel_laporan_barang', $data);
    }

    //seputar laporan data peminjaman
    public function laporanpeminjaman() {
        $data['judul'] = 'Laporan Data Peminjaman'; 
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array(); 
        $data['laporan'] =$this->ModelPinjam->joinDataPeminjaman(); 
       
        $this->load->view('templates/header', $data); 
        $this->load->view('templates/sidebar', $data); 
        $this->load->view('templates/topbar', $data); 
        $this->load->view('pinjam/laporan-pinjam', $data); 
        $this->load->view('templates/footer');
      }
  
    public function laporan_peminjaman_cetak()
    { 
        $data['laporan'] =$this->ModelPinjam->joinDataPeminjaman();
       
        $this->load->view('pinjam/cetak_laporan_peminjaman',$data); 
     }
  
    public function laporan_peminjaman_pdf()
    { 
        $data['laporan'] =$this->ModelPinjam->joinDataPeminjaman();
       
        // script untuk dompdf php versi 7.1.0 keatas 
        $sroot      = $_SERVER['DOCUMENT_ROOT']; 
        include $sroot."/pustaka-booking/application/third_party/dompdf/autoload.inc.php"; 
        $dompdf = new Dompdf\Dompdf(); 
       
        $this->load->view('pinjam/pdf_laporan_peminjaman', $data); 
       
        $paper_size  = 'A4'; // ukuran kertas 
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape 
        $html = $this->output->get_output(); 
       
        $dompdf->set_paper($paper_size, $orientation); 
          // Convert to PDF 
        $dompdf->load_html($html); 
        $dompdf->render(); 
        $dompdf->stream("laporan data peminjaman lab elektro.pdf", array('Attachment' => 0)); 
          // nama file pdf yang di hasilkan 
    }
  
    public function laporan_peminjaman_excel()
    { 
        $data=array( 
          'title'=>'Laporan Data Peminjaman Barang Laboratorium Elektronika', 
          'laporan'=>$this->ModelPinjam->joinDataPeminjaman()
        );

        $this->load->view('pinjam/excel_laporan_peminjaman',$data); 
    }
}