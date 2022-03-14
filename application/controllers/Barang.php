<?php

class Barang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->load->model('barang_m');
        set_time_limit(0);
        ini_set('memory_limit', '20000M');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function tambah_barang()
    {
        $this->load->view('barang/barang_tambah');
    }

    public function store()
    {
        $kode_brg       = $_POST['kode_brg'];
        $kode_kat       = $_POST['kode_kat'];
        $nama           = $_POST['nama'];
        $harga          = $_POST['harga'];
        $stock            = $_POST['stock'];
        $tgl_true       = date("Y-m-d H:i:s");

        $user_login     = $this->session->userdata("username");

        $kode_brg       = ltrim(rtrim($kode_brg));
        $kode_kat       = ltrim(rtrim($kode_kat));
        $nama           = ltrim(rtrim($nama));
        $harga          = ltrim(rtrim($harga));
        $stock          = ltrim(rtrim($stock));

        //disini cek dulu kode barang kosong atau tidak
        if ($kode_brg == "") {
            echo "errbrg\t";
            exit();
        }

        //disini cek dulu kode kategori kosong atau tidak
        if ($kode_kat == "") {
            echo "errkat\t";
            exit();
        }

        //disini cek kode barang sudah ada atau belum
        $cek_kat = $this->barang_m->cek_kode_brg($kode_brg);
        if ($cek_kat > 0) {
            echo "brgada\t";
            exit();
        }

        //disini cek nama barang kosong atau tidak
        if ($nama == "") {
            echo "errnama\t";
            exit();
        }

        //disini cek nama barang sudah ada atau belum
        $cek_nama = $this->barang_m->cek_nama_barang($nama);
        if ($cek_nama > 0) {
            echo "namaada\t";
            exit();
        }

        //disini cek harga barang kosong atau tidak
        if ($harga == "") {
            echo "errhrg\t";
            exit();
        }

        //disini cek quantity barang kosong atau tidak
        if ($stock == "") {
            echo "errstock\t";
            exit();
        }

        $this->db->query("INSERT INTO barang SET
                            kode_barang  = '$kode_brg',
        				    kode_kat     = '$kode_kat',
        				    nama         = '$nama',
                            harga        = '$harga',
                            stock          = '$stock',
                            created_by   = '$user_login',
                            created_date = '$tgl_true'");

        echo "OK\t";
    }

    public function kelola_barang()
    {
        $data['data'] = $this->barang_m->get_alldata('barang');
        $this->load->view('barang/kelola_barang', $data);
    }

    public function cari()
    {
        $kode_brg = $_POST['kode_brg'];
        $data = $this->barang_m->cari('barang', $kode_brg);
        echo json_encode($data);
    }

    public function update()
    {
        $kode_brg       = $_POST['kode_brg'];
        $kode_kat       = $_POST['kode_kat'];
        $nama           = $_POST['nama'];
        $harga          = $_POST['harga'];
        $stock            = $_POST['stock'];
        $tgl_true       = date("Y-m-d H:i:s");

        $user_login     = $this->session->userdata("username");

        $kode_brg       = ltrim(rtrim($kode_brg));
        $kode_kat       = ltrim(rtrim($kode_kat));
        $nama           = ltrim(rtrim($nama));
        $harga          = ltrim(rtrim($harga));
        $stock            = ltrim(rtrim($stock));

        //disini cek kode  barang kosong atau tidak
        if ($kode_brg == "") {
            echo "errkode\t";
            exit();
        }

        //disini cek kode  kategori kosong atau tidak
        if ($kode_kat == "") {
            echo "errkat\t";
            exit();
        }

        //disini cek nama barang  kosong atau tidak
        if ($nama == "") {
            echo "errnama\t";
            exit();
        }

        //disini cek nama barang  sudah ada atau belum
        $cek_nama = $this->barang_m->cek_nama_brg('barang', $kode_brg, $nama);
        if ($cek_nama > 0) {
            echo "namaada\t";
            exit();
        }

        //disini cek harga barang  kosong atau tidak
        if ($harga == "") {
            echo "errhrg\t";
            exit();
        }

        //disini cek quantity barang  kosong atau tidak
        if ($stock == "") {
            echo "errstock\t";
            exit();
        }

        $this->db->query("UPDATE barang SET
                                    kode_barang     = '$kode_brg',
                                    kode_kat        = '$kode_kat',
                                    nama            = '$nama',
                                    harga           = '$harga',
                                    stock             = '$stock',
                                    modified_by     = '$user_login',
                                    modified_date   = '$tgl_true'
                                    WHERE kode_barang  = '$kode_brg'");
        echo "OK\t";
    }

    public function delete()
    {
        $kode_brg = $_POST['kode_brg'];
        $this->db->query("DELETE FROM barang WHERE kode_barang = '$kode_brg'");
        echo "OK\t";
    }
}
