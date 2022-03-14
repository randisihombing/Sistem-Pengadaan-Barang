<?php

class surat_jalan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->load->model('surat_jln_m');
        set_time_limit(0);
        ini_set('memory_limit', '20000M');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function tambah_surat_jalan()
    {
        $this->load->view('surat_jalan/surat_jalan_tambah');
    }

    public function store()
    {
        $no_psn     = $_POST['no_psn'];
        $no_srt_jln = $_POST['no_srt_jln'];
        $tgl_true   = date("Y-m-d H:i:s");

        $user_login = $this->session->userdata("username");

        $no_psn         = ltrim(rtrim($no_psn));
        $no_srt_jln     = ltrim(rtrim($no_srt_jln));


        //disini cek dulu kode surat_jalan kosong atau tidak
        if ($no_psn == "") {
            echo "errpes\t";
            exit();
        }

        if ($no_srt_jln == "") {
            echo "errsrt\t";
            exit();
        }

        //disini cek surat_jalan sudah ada atau belum
        $cek_srt_jln = $this->surat_jln_m->cek_surat_jalan($no_srt_jln);
        if ($cek_srt_jln > 0) {
            echo "srtada\t";
            exit();
        }

        //disini cek no pesanan di surat jalan sudah ada atau belum
        $cek_no_psn = $this->surat_jln_m->cek_no_psn($no_psn);
        if ($cek_no_psn > 0) {
            echo "pesada\t";
            exit();
        }

        $this->db->query("INSERT INTO surat_jalan SET
        				    no_surat_jln = '$no_srt_jln',
        				    pesanan_id   = '$no_psn',
                            created_by = '$user_login',
                            created_date = '$tgl_true'");

        echo "OK\t";
    }

    public function kelola_surat_jalan()
    {
        $data['data'] = $this->surat_jln_m->get_alldata();
        $this->load->view('surat_jalan/kelola_surat_jalan', $data);
    }

    public function cari()
    {
        $no_surat_jln = $_POST['no_surat_jln'];

        $data = $this->surat_jln_m->cari('surat_jalan', $no_surat_jln);

        echo json_encode($data);
    }

    public function update()
    {

        $no_psn     = $_POST['no_psn'];
        $no_surat_jln = $_POST['no_surat_jln'];
        $tgl_true   = date("Y-m-d H:i:s");

        $user_login = $this->session->userdata("username");

        $no_psn         = ltrim(rtrim($no_psn));
        $no_surat_jln     = ltrim(rtrim($no_surat_jln));

        //disini cek surat_jalan kosong
        if ($no_surat_jln == "") {
            echo "errsrt\t";
            exit();
        }

        //disini cek surat_jalan sudah ada atau belum
        $cek_srt_jln = $this->surat_jln_m->cek_surat_jalan($no_surat_jln);
        if ($cek_srt_jln > 0) {
            echo "srtada\t";
            exit();
        }

        $this->db->query("UPDATE surat_jalan SET
                                    no_surat_jln = '$no_surat_jln',
                                    pesanan_id   = '$no_psn',
                                    modified_by = '$user_login',
                                    modified_date = '$tgl_true'
                                    WHERE pesanan_id = '$no_psn'");
        echo "OK\t";
    }

    public function cetak($no_psn)
    {
        $data = array(
            'pesanan' => $this->surat_jln_m->get_pesanan($no_psn)->row(),
            'pesanan_detail' => $this->surat_jln_m->get_pesanan_detail($no_psn)->result()
        );
        $this->load->view('surat_jalan/cetak_surat_jalan', $data);
    }

    public function delete()
    {
        $no_surat_jln = $_POST['no_surat_jln'];
        $this->db->query("DELETE FROM surat_jalan WHERE no_surat_jln = '$no_surat_jln'");
        echo "OK\t";
    }
}
