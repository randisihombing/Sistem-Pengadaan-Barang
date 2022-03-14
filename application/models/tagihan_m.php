<?php

class tagihan_m extends CI_Model
{

    public function cek_tagihan($no_tagihan)
    {
        $chek_code = $this->db->query("SELECT * FROM tagihan WHERE no_tagihan ='$no_tagihan'");
        return json_encode($chek_code->num_rows());
    }

    public function cek_no_psn($no_psn)
    {
        $chek_code = $this->db->query("SELECT * FROM tagihan WHERE pesanan_id ='$no_psn'");
        return json_encode($chek_code->num_rows());
    }

    public function get_alldata()
    {
        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->join('pesanan', 'tagihan.pesanan_id = pesanan.pesanan_id');
        $result = $this->db->get()->result();
        return $result;
    }


    public function cari($table, $no_tagihan)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('no_tagihan', $no_tagihan);
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_pesanan($id = null)
    {
        $this->db->select('* , tagihan.created_by as tagihan_created');
        $this->db->from('tagihan');
        $this->db->join('pesanan', 'tagihan.pesanan_id = pesanan.pesanan_id');
        $this->db->join('pesanan_detail', 'pesanan.pesanan_id = pesanan_detail.pesanan_id');
        $this->db->join('barang', 'pesanan_detail.barang_id = barang.barang_id');
        if ($id != null) {
            $this->db->where('tagihan.pesanan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pesanan_detail($tagihan_id = null)
    {
        $this->db->from('pesanan_detail');
        $this->db->join('barang', 'pesanan_detail.barang_id = barang.barang_id');
        if ($tagihan_id != null) {
            $this->db->where('pesanan_detail.pesanan_id', $tagihan_id);
        }
        $query = $this->db->get();
        return $query;
    }
}
