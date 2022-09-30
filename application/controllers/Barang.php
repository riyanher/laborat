<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
    }

    //manajemen Buku
    public function index()
    {
        $data['judul'] = 'Data Barang';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->ModelBarang->getBarang()->result_array();


        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|min_length[4]|is_unique[barang.kode_barang]', [
            'required' => 'Kode Barang harus diisi',
            'min_length' => 'Kode Barang terlalu pendek',
            'is_unique' => 'Kode Barang sudah dipakai'
        ]);
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', [
            'required' => 'Nama barang harus diisi',
        ]);
        $this->form_validation->set_rules('merek', 'Merek', 'required|min_length[3]', [
            'required' => 'Merek harus diisi',
            'min_length' => 'Merek terlalu pendek'
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'item-img' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }

            $data = [
                'kode_barang' => $this->input->post('kode_barang', true),
                'nama_barang' => $this->input->post('nama_barang', true),
                'merek' => $this->input->post('merek', true),
                'tgl_masuk' => time(),
                'stok' => $this->input->post('stok', true),
                'dipinjam' => 0,
                'image' => $gambar
            ];

            $this->ModelBarang->simpanBarang($data);
            redirect('barang');
        }
    }

    public function hapusBarang()
    {
        $where = ['kode_barang' => $this->uri->segment(3)];
        $this->ModelBarang->hapusBarang($where);
        redirect('barang');
    }

    public function ubahBarang()
    {
        $data['judul'] = 'Ubah Data Barang';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['barang'] = $this->ModelBarang->barangWhere(['kode_barang' => $this->uri->segment(3)])->result_array();
        

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|min_length[3]', [
            'required' => 'Nama Barang harus diisi',
            'min_length' => 'Nama Barang terlalu pendek'
        ]);
        $this->form_validation->set_rules('merek', 'Merek Barang', 'required|min_length[3]', [
            'required' => 'Merek barang harus diisi',
            'min_length' => 'Merek barang terlalu pendek'
        ]);
        
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric', [
            'required' => 'Stok harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'item-img' . time();

        //memuat atau memanggil library upload
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('barang/ubah_barang', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }

            $data = [
                'nama_barang' => $this->input->post('nama_barang', true),
                'merek' => $this->input->post('merek', true),
                'stok' => $this->input->post('stok', true),
                'image' => $gambar
            ];

            $this->ModelBarang->updateBarang($data, ['kode_barang' => $this->input->post('kode_barang')]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data barang berhasil diubah</div>');
            redirect('barang');
        }
    }

    
}
