<?php

class pesanan_m extends CI_Model
{
    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(no_psn,9,4)) AS invoice_no 
                FROM pesanan 
                WHERE MID(no_psn,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "PS" . date('ymd') . $no;
        return $invoice;
    }

    public function get_cart($params = null)
    {
        $this->db->select('*, barang.nama as barang_nama, keranjang_pesanan.harga as keranjang_harga ');
        $this->db->from('keranjang_pesanan');
        $this->db->join('barang', 'keranjang_pesanan.barang_id = barang.barang_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $query = $this->db->query("SELECT MAX(keranjang_id) AS keranjang_no FROM keranjang_pesanan");
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->keranjang_no) + 1;
        } else {
            $car_no = "1";
        }

        $user_login = $this->session->userdata("username");
        $params = array(
            'keranjang_id' => $car_no,
            'barang_id' => $post['barang_id'],
            'harga' => $post['harga'],
            'qty' => $post['qty'],
            'total' => ($post['harga'] * $post['qty']),
            'created_by' => $user_login
        );
        $this->db->insert('keranjang_pesanan', $params);
    }

    public function update_cart_qty($post)
    {
        $sql = "UPDATE keranjang_pesanan SET harga = '$post[harga]',
                qty = qty + '$post[qty]',
                total = '$post[harga]' * qty
                WHERE barang_id = '$post[barang_id]'";
        $this->db->query($sql);
    }

    public function del_cart($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('keranjang_pesanan');
    }

    public function input_pesanan($post)
    {
        $tgl_true      = date("Y-m-d H:i:s");
        $user_login = $this->session->userdata("username");

        $params = array(
            'no_psn' => $this->invoice_no(),
            'no_surat' => $post['no_surat'],
            'alamat_psn' => $post['alamat'],
            'nama_psn' => $post['penerima'],
            'ppn' => $post['ppn'],
            'total_harga' => $post['subtotal'],
            'total_akhir' => $post['grandtotal'],
            'tgl_psn' => $post['tgl_surat'],
            'created_by' => $user_login,
            'created_date' => $tgl_true
        );
        $this->db->insert('pesanan', $params);
        return $this->db->insert_id();
    }

    public function pesanan_detail($params)
    {
        $this->db->insert_batch('pesanan_detail', $params);
    }

    public function get_pesanan($id = null)
    {
        $this->db->select('*, pesanan.created_date as pesanan_created');
        $this->db->from('pesanan');
        if ($id != null) {
            $this->db->where('pesanan_id', $id);
        }
        $this->db->order_by('tgl_psn', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_pesanan_detail($pesanan_id = null)
    {
        $this->db->from('pesanan_detail');
        $this->db->join('barang', 'pesanan_detail.barang_id = barang.barang_id');
        if ($pesanan_id != null) {
            $this->db->where('pesanan_detail.pesanan_id', $pesanan_id);
        }
        $this->db->where('status = "PROSES"');
        $query = $this->db->get();
        return $query;
    }

    public function get_pesanan_approve($pesanan_id = null)
    {
        $this->db->from('pesanan_detail');
        $this->db->join('barang', 'pesanan_detail.barang_id = barang.barang_id');
        $this->db->join('pesanan', 'pesanan.pesanan_id=pesanan_detail.pesanan_id');
        if ($pesanan_id != null) {
            $this->db->where('pesanan_detail.pesanan_id', $pesanan_id);
        }

        $this->db->order_by('tgl_psn', 'desc');

        $query = $this->db->get();
        return $query;
    }

    public function get_approve($pesanan_id = null)
    {

        $this->db->from('pesanan_detail');
        $this->db->join('barang', 'pesanan_detail.barang_id = barang.barang_id');
        $this->db->join('pesanan', 'pesanan.pesanan_id = pesanan_detail.pesanan_id');
        if ($pesanan_id != null) {
            $this->db->where('pesanan_detail.pesanan_id', $pesanan_id);
        }
        $this->db->where('status = "PROSES"');
        $query = $this->db->get();
        return $query;
    }

    public function get_sum()
    {
        $sql = "SELECT sum(total_harga) as total_harga FROM pesanan";
        $result = $this->db->query($sql);
        return $result->row()->total_harga;
    }

    public function proses_approve($pesanan_id)
    {
        $data = array('status' => "approve");

        $this->db->where('pesanan_id', $pesanan_id);

        return $this->db->update('pesanan_detail', $data);
    }
}
