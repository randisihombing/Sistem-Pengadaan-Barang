<?php

class tagihan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->load->model('tagihan_m');
        set_time_limit(0);
        ini_set('memory_limit', '20000M');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function tambah_tagihan()
    {
        $this->load->view('tagihan/tagihan_tambah');
    }

    public function store()
    {
        $no_psn     = $_POST['no_psn'];
        $no_tagihan = $_POST['no_tagihan'];
        $tgl_true   = date("Y-m-d H:i:s");

        $user_login = $this->session->userdata("username");

        $no_psn         = ltrim(rtrim($no_psn));
        $no_tagihan     = ltrim(rtrim($no_tagihan));


        //disini cek dulu no pesanan kosong atau tidak
        if ($no_psn == "") {
            echo "errpes\t";
            exit();
        }

        //disini cek dulu no tagihan kosong atau tidak
        if ($no_tagihan == "") {
            echo "errtag\t";
            exit();
        }

        //disini cek tagihan sudah ada atau belum
        $cek_tagihan = $this->tagihan_m->cek_tagihan($no_tagihan);
        if ($cek_tagihan > 0) {
            echo "tagada\t";
            exit();
        }

        //disini cek no pesanan di surat jalan sudah ada atau belum
        $cek_no_psn = $this->tagihan_m->cek_no_psn($no_psn);
        if ($cek_no_psn > 0) {
            echo "pesada\t";
            exit();
        }

        $this->db->query("INSERT INTO tagihan SET
                            pesanan_id   = '$no_psn',
        				    no_tagihan = '$no_tagihan',
                            created_by = '$user_login',
                            created_date = '$tgl_true'");

        echo "OK\t";
    }

    public function kelola_tagihan()
    {
        $data['data'] = $this->tagihan_m->get_alldata('tagihan');
        $this->load->view('tagihan/kelola_tagihan', $data);
    }

    public function cari()
    {
        $no_tagihan = $_POST['no_tagihan'];

        $data = $this->tagihan_m->cari('tagihan', $no_tagihan);

        echo json_encode($data);
    }

    public function update()
    {

        $no_psn     = $_POST['no_psn'];
        $no_tagihan = $_POST['no_tagihan'];
        $tgl_true   = date("Y-m-d H:i:s");

        $user_login = $this->session->userdata("username");

        $no_psn         = ltrim(rtrim($no_psn));
        $no_tagihan     = ltrim(rtrim($no_tagihan));

        //disini cek tagihan kosong
        if ($no_tagihan == "") {
            echo "errtag\t";
            exit();
        }

        //disini cek surat_jalan sudah ada atau belum
        $cek_tagihan = $this->tagihan_m->cek_tagihan($no_tagihan);
        if ($cek_tagihan > 0) {
            echo "tagada\t";
            exit();
        }

        $this->db->query("UPDATE tagihan SET
                                    no_tagihan = '$no_tagihan',
                                    pesanan_id   = '$no_psn',
                                    modified_by = '$user_login',
                                    modified_date = '$tgl_true'
                                    WHERE pesanan_id = '$no_psn'");
        echo "OK\t";
    }

    public function cetak($id)
    {
        $data = array(
            'pesanan' => $this->tagihan_m->get_pesanan($id)->row(),
            'pesanan_detail' => $this->tagihan_m->get_pesanan_detail($id)->result()
        );
        $this->load->view('tagihan/cetak_tagihan', $data);
    }

    public function delete()
    {
        $no_tagihan = $_POST['no_tagihan'];
        $this->db->query("DELETE FROM tagihan WHERE no_tagihan = '$no_tagihan'");
        echo "OK\t";
    }
}
