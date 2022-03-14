<?php

class stock_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('stock');
        if ($id != null) {
            $this->db->where('stock_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_alldata($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $result = $this->db->get()->result();
        return $result;
    }

    public function cari($table, $barang_id)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('barang_id', $barang_id);
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_stock_in()
    {
        $this->db->select('stock.stock_id, barang.kode_barang as kode_nama, barang.nama as barang_nama, qty, gambar, stock.created_date, keterangan, barang.barang_id');
        $this->db->from('stock');
        $this->db->join('barang', 'stock.barang_id = barang.barang_id');
        $this->db->where('tipe', 'masuk');
        $this->db->order_by('stock_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_stock_out()
    {
        $this->db->select('stock.stock_id, barang.kode_barang as kode_nama, barang.nama as barang_nama, qty, stock.created_date, keterangan, barang.barang_id');
        $this->db->from('stock');
        $this->db->join('barang', 'stock.barang_id = barang.barang_id');
        $this->db->where('tipe', 'keluar');
        $this->db->order_by('stock_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id  = $data['barang_id'];
        $sql = "UPDATE barang SET stock = stock + '$qty' WHERE barang_id = '$id'";
        $this->db->query($sql);
    }

    public function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id  = $data['barang_id'];
        $sql = "UPDATE barang SET stock = stock - '$qty' WHERE barang_id = '$id'";
        $this->db->query($sql);
    }
}
