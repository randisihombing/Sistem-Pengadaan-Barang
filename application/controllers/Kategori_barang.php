<?php

class Kategori_barang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->load->model('kategori_m');
        set_time_limit(0);
        ini_set('memory_limit', '20000M');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function tambah_kategori()
    {
        $this->load->view('kategori/kategori_tambah');
    }

    public function store()
    {
        $kode_kat = $_POST['kode_kat'];
        $nama       = $_POST['nama'];
        $tgl_true   = date("Y-m-d H:i:s");

        $user_login = $this->session->userdata("username");

        $kode_kat = ltrim(rtrim($kode_kat));
        $nama       = ltrim(rtrim($nama));


        //disini cek dulu kode kategori kosong atau tidak
        if ($kode_kat == "") {
            echo "errkat\t";
            exit();
        }

        //disini cek kode kategori sudah ada atau belum
        $cek_kat = $this->kategori_m->cek_kode_kategori($kode_kat);
        if ($cek_kat > 0) {
            echo "katada\t";
            exit();
        }

        //disini cek nama barang kosong atau tidak
        if ($nama == "") {
            echo "errnama\t";
            exit();
        }

        //disini cek nama barang sudah ada atau belum
        $cek_nama = $this->kategori_m->cek_nama_barang($nama);
        if ($cek_nama > 0) {
            echo "namaada\t";
            exit();
        }

        $this->db->query("INSERT INTO kategori SET
        				    kode_kat = '$kode_kat',
        				    nama   = '$nama',
                            created_by = '$user_login',
                            created_date = '$tgl_true'");

        echo "OK\t";
    }

    public function kelola_kategori()
    {
        $data['data'] = $this->kategori_m->get_alldata('kategori');
        $this->load->view('kategori/kelola_kategori', $data);
    }

    public function cari()
    {
        $kode_kat = $_POST['kode_kat'];

        $data = $this->kategori_m->cari('kategori', $kode_kat);

        echo json_encode($data);
    }

    public function update()
    {

        $kode_kat            = $_POST['kode_kat'];
        $nama                = $_POST['nama'];
        $tgl_true            = date("Y-m-d H:i:s");

        $user_login = $this->session->userdata("username");

        $kode_kat            = ltrim(rtrim($kode_kat));
        $nama                = ltrim(rtrim($nama));

        //disini cek kode  kategori barang kosong atau tidak
        if ($kode_kat == "") {
            echo "errkode\t";
            exit();
        }

        //disini cek nama kategori barang kosong atau tidak
        if ($nama == "") {
            echo "errnama\t";
            exit();
        }

        //disini cek nama kategori barang sudah ada atau belum
        $cek_nama = $this->kategori_m->cek_nama_kode_kategori('kategori', $kode_kat, $nama);
        if ($cek_nama > 0) {
            echo "namaada\t";
            exit();
        }

        $this->db->query("UPDATE kategori SET
                                    kode_kat = '$kode_kat',
                                    nama = '$nama',
                                    modified_by = '$user_login',
                                    modified_date = '$tgl_true'
                                    WHERE kode_kat = '$kode_kat'");
        echo "OK\t";
    }

    public function delete()
    {
        $kode_kat = $_POST['kode_kat'];

        $data = $this->kategori_m->cek_kategori('barang', $kode_kat);

        if ($data > 0) {
            echo "Kode kategori Sudah Digunakan di Data Barang\t";
            exit();
        }

        $this->db->query("DELETE FROM kategori WHERE kode_kat = '$kode_kat'");
        echo "OK\t";
    }
}
