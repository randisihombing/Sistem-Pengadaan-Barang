<?php
class Laporan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['barang_m', 'pesanan_m', 'sph_m', 'surat_jln_m']);
    }

    public function transaksi()
    {
        $this->load->view('laporan/transaksi');
    }

    public function cetak_transaksi()
    {
        $data = array(
            'pesanan' => $this->surat_jln_m->get_pesanan()->row(),
            'pesanan_detail' => $this->surat_jln_m->get_pesanan_detail()->result(),
            'pesanan_approve' => $this->pesanan_m->get_pesanan_approve()->result(),
            'sum' => $this->pesanan_m->get_sum()
        );
        $this->load->view('laporan/cetak_laporan_transaksi', $data);
    }

    public function stock()
    {
        $data['barang'] = $this->barang_m->get();
        $this->load->view('laporan/stock', $data);
    }

    public function cetak_stock()
    {
        $this->load->view('laporan/cetak_laporan_stock');
    }

    public function sph()
    {
        $data['sph'] = $this->sph_m->get_sph();
        $this->load->view('laporan/sph', $data);
    }

    public function cetak_sph()
    {
        $this->load->view('laporan/cetak_laporan_sph');
    }
}
