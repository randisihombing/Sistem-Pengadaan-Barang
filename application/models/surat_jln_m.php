<?php

class surat_jln_m extends CI_Model
{

    public function cek_surat_jalan($no_srt_jln)
    {
        $chek_code = $this->db->query("SELECT * FROM surat_jalan WHERE no_surat_jln ='$no_srt_jln'");
        return json_encode($chek_code->num_rows());
    }

    public function cek_no_psn($no_psn)
    {
        $chek_code = $this->db->query("SELECT * FROM surat_jalan WHERE pesanan_id ='$no_psn'");
        return json_encode($chek_code->num_rows());
    }

    public function get_alldata()
    {
        $this->db->select('*');
        $this->db->from('surat_jalan');
        $this->db->join('pesanan', 'surat_jalan.pesanan_id = pesanan.pesanan_id');
        $result = $this->db->get()->result();
        return $result;
    }

    public function cari($table, $no_srt_jln)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('no_surat_jln', $no_srt_jln);
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_pesanan($id = null)
    {
        $this->db->select('*, surat_jalan.created_by as surat_jalan_created');
        $this->db->from('surat_jalan');
        $this->db->join('pesanan', 'surat_jalan.pesanan_id = pesanan.pesanan_id');
        $this->db->join('pesanan_detail', 'pesanan.pesanan_id = pesanan_detail.pesanan_id');
        $this->db->join('barang', 'pesanan_detail.barang_id = barang.barang_id');
        if ($id != null) {
            $this->db->where('surat_jalan.pesanan_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_pesanan_detail($surat_jalan_id = null)
    {
        $this->db->from('pesanan_detail');
        $this->db->join('barang', 'pesanan_detail.barang_id = barang.barang_id');
        if ($surat_jalan_id != null) {
            $this->db->where('pesanan_detail.pesanan_id', $surat_jalan_id);
        }
        $query = $this->db->get();
        return $query;
    }
}
