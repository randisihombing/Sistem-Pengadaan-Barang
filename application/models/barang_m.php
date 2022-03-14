<?php

class barang_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('barang');
        if ($id != null) {
            $this->db->where('barang_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function cek_kode_brg($kode_brg)
    {
        $chek_code = $this->db->query("SELECT * FROM barang WHERE kode_barang ='$kode_brg'");
        return json_encode($chek_code->num_rows());
    }

    public function cek_nama_barang($nama)
    {
        $chek_code = $this->db->query("SELECT * FROM barang WHERE nama ='$nama'");
        return json_encode($chek_code->num_rows());
    }

    public function get_alldata($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $result = $this->db->get()->result();
        return $result;
    }

    public function cari($table, $kode_brg)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('kode_barang', $kode_brg);
        $result = $this->db->get()->result();
        return $result;
    }

    public function cek_nama_brg($nama, $kode_brg)
    {
        $chek_code = $this->db->query("SELECT * FROM barang WHERE nama ='$nama' AND kode_barang != '$kode_brg'");
        return json_encode($chek_code->num_rows());
    }
}
