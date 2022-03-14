<?php

class kategori_m extends CI_Model
{

    public function cek_kode_kategori($kode_kat)
    {
        $chek_code = $this->db->query("SELECT * FROM kategori WHERE kode_kat ='$kode_kat'");
        return json_encode($chek_code->num_rows());
    }

    public function cek_nama_barang($nama)
    {
        $chek_code = $this->db->query("SELECT * FROM kategori WHERE nama ='$nama'");
        return json_encode($chek_code->num_rows());
    }

    public function cek_nama_kode_kategori($kode_kat, $nama)
    {
        $chek_code = $this->db->query("SELECT * FROM kategori WHERE nama ='$nama' and kode_kat != '$kode_kat'");
        return json_encode($chek_code->num_rows());
    }

    public function cek_kode_kategori_barang($kode_kat)
    {
        $chek_code = $this->db->query("SELECT * FROM kategori WHERE kode_kat != '$kode_kat'");
        return json_encode($chek_code->num_rows());
    }

    public function cek_kategori($table, $kode_kat)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('kode_kat', $kode_kat);
        $result = $this->db->get();
        return json_encode($result->num_rows());
    }

    public function get_alldata($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $result = $this->db->get()->result();
        return $result;
    }

    public function cari($table, $kode_kat)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('kode_kat', $kode_kat);
        $result = $this->db->get()->result();
        return $result;
    }
}
