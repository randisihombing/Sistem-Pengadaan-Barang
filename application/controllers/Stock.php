<?php

class Stock extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->load->model(['stock_m', 'barang_m']);
        set_time_limit(0);
        ini_set('memory_limit', '20000M');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function tambah_stock_in()
    {
        $this->load->view('stock_in/stock_in_tambah');
    }

    public function store()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar')) {

            $data = array('upload_data' => $this->upload->data());
            $gambar = $data['upload_data']['file_name'];
        }


        $barang_id      = $_POST['barang_id'];
        $type           = 'Masuk';
        $keterangan     = $_POST['keterangan'];
        $stock          = $_POST['qty'];
        $tgl_true       = date("Y-m-d H:i:s");

        $user_login     = $this->session->userdata("username");

        $barang_id      = ltrim(rtrim($barang_id));
        $type           = ltrim(rtrim($type));
        $keterangan     = ltrim(rtrim($keterangan));
        $stock          = ltrim(rtrim($stock));

        //disini cek harga barang kosong atau tidak
        if ($keterangan == "") {
            echo "errket\t";
            exit();
        }

        //disini cek quantity barang kosong atau tidak
        if ($stock == "") {
            echo "errqty\t";
            exit();
        }
        $this->db->query("INSERT INTO stock SET
                            barang_id    = '$barang_id',
                            tipe         = '$type',
                            keterangan   = '$keterangan',
                            qty          = '$stock',
                            gambar       = '$gambar',
                            created_by   = '$user_login',
                            created_date = '$tgl_true'");
        $this->db->query("UPDATE barang SET stock = stock + '$stock' WHERE barang_id = '$barang_id'");
        echo "OK\t";
    }

    public function kelola_stock_in()
    {
        $data['data'] = $this->stock_m->get_stock_in()->result();
        $this->load->view('stock_in/kelola_stock_in', $data);
    }

    public function tambah_stock_out()
    {
        $this->load->view('stock_out/stock_out_tambah');
    }

    public function store_out()
    {
        $barang_id      = $_POST['barang_id'];
        $type           = 'Keluar';
        $keterangan     = $_POST['keterangan'];
        $stock          = $_POST['qty'];
        $tgl_true       = date("Y-m-d H:i:s");

        $user_login     = $this->session->userdata("username");

        $barang_id      = ltrim(rtrim($barang_id));
        $type           = ltrim(rtrim($type));
        $keterangan     = ltrim(rtrim($keterangan));
        $stock          = ltrim(rtrim($stock));

        //disini cek harga barang kosong atau tidak
        if ($keterangan == "") {
            echo "errket\t";
            exit();
        }

        //disini cek quantity barang kosong atau tidak
        if ($stock == "") {
            echo "errqty\t";
            exit();
        }
        $this->db->query("INSERT INTO stock SET
                            barang_id    = '$barang_id',
                            tipe         = '$type',
                            keterangan   = '$keterangan',
                            qty          = '$stock',
                            created_by   = '$user_login',
                            created_date = '$tgl_true'");
        $this->db->query("UPDATE barang SET stock = stock - '$stock' WHERE barang_id = '$barang_id'");
        echo "OK\t";
    }

    public function kelola_stock_out()
    {
        $data['data'] = $this->stock_m->get_stock_out()->result();
        $this->load->view('stock_out/kelola_stock_out', $data);
    }

    public function cari()
    {
        $kode_brg = $_POST['kode_brg'];
        $data = $this->barang_m->cari('barang', $kode_brg);
        echo json_encode($data);
    }

    public function in_hapus()
    {
        $stock_id = $_POST['stock'];
        $barang_id = $_POST['barang'];
        $qty = $this->stock_m->get($stock_id)->row()->qty;
        $data = ['qty' => $qty, 'barang_id' => $barang_id];
        $this->stock_m->update_stock_out($data);
        $this->db->query("DELETE FROM stock WHERE stock_id = '$stock_id'");
        echo "OK\t";
    }

    public function out_hapus()
    {
        $stock_id = $_POST['stock'];
        $barang_id = $_POST['barang'];
        $qty = $this->stock_m->get($stock_id)->row()->qty;
        $data = ['qty' => $qty, 'barang_id' => $barang_id];
        $this->stock_m->update_stock_in($data);
        $this->db->query("DELETE FROM stock WHERE stock_id = '$stock_id'");
        echo "OK\t";
    }
}