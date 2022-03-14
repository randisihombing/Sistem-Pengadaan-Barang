<?php

class sph_m extends CI_Model
{
    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(no_pesanan,9,4)) AS invoice_no 
                FROM sph 
                WHERE MID(no_pesanan,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "LM" . date('ymd') . $no;
        return $invoice;
    }

    public function get_cart($params = null)
    {
        $this->db->select('*, barang.nama as barang_nama, keranjang.harga as keranjang_harga ');
        $this->db->from('keranjang');
        $this->db->join('barang', 'keranjang.barang_id = barang.barang_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $query = $this->db->query("SELECT MAX(cart_id) AS cart_no FROM keranjang");
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = "1";
        }

        $user_login = $this->session->userdata("username");
        $params = array(
            'cart_id' => $car_no,
            'barang_id' => $post['barang_id'],
            'harga' => $post['harga'],
            'qty' => $post['qty'],
            'created_by' => $user_login
        );
        $this->db->insert('keranjang', $params);
    }

    public function update_cart_qty($post)
    {
        $sql = "UPDATE keranjang SET harga = '$post[harga]',
                qty = qty + '$post[qty]'
                WHERE barang_id = '$post[barang_id]'";
        $this->db->query($sql);
    }

    public function del_cart($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('keranjang');
    }

    public function input_sph($post)
    {
        $tgl_true      = date("Y-m-d H:i:s");
        $user_login = $this->session->userdata("username");

        $params = array(
            'no_pesanan' => $this->invoice_no(),
            'no_surat' => $post['no_surat'],
            'alamat_cust' => $post['alamat'],
            'jabatan_cust' => $post['jabatan'],
            'nm_cust' => $post['penerima'],
            'surat_cust' => $post['surat_cust'],
            'tanggal_surat' => $post['tgl_surat'],
            'created_by' => $user_login,
            'created_date' => $tgl_true
        );
        $this->db->insert('sph', $params);
        return $this->db->insert_id();
    }

    public function sph_detail($params)
    {
        $this->db->insert_batch('sph_detail', $params);
    }

    public function get_sph($id = null)
    {
        $this->db->select('*, sph.created_by as sph_created');
        $this->db->from('sph');
        if ($id != null) {
            $this->db->where('sph_id', $id);
        }
        $this->db->order_by('tanggal_surat', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_sph_detail($sph_id = null)
    {
        $this->db->from('sph_detail');
        $this->db->join('barang', 'sph_detail.barang_id = barang.barang_id');
        if ($sph_id != null) {
            $this->db->where('sph_detail.sph_id', $sph_id);
        }
        $query = $this->db->get();
        return $query;
    }
}
