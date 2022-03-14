<?php
class Pesanan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->load->model(['pesanan_m', 'barang_m']);
        set_time_limit(0);
        ini_set('memory_limit', '20000M');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function tambah_pesanan()
    {
        $barang = $this->barang_m->get_alldata('barang');
        $cart = $this->pesanan_m->get_cart();
        $data = array(
            'barang' => $barang,
            'keranjang_pesanan' => $cart,
            'no_pesanan' => $this->pesanan_m->invoice_no(),
        );
        $this->load->view('pesanan/pesanan_tambah', $data);
    }

    public function proses()
    {
        $data = $this->input->post(null, TRUE);

        if (isset($_POST['add_cart'])) {

            $barang = $this->input->post('barang_id');

            $check_cart = $this->pesanan_m->get_cart(['keranjang_pesanan.barang_id' => $barang])->num_rows();
            if ($check_cart > 0) {
                $this->pesanan_m->update_cart_qty($data);
            } else {
                $this->pesanan_m->add_cart($data);
            }

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }

        if (isset($_POST['proses_pesanan'])) {
            $pesanan = $this->pesanan_m->input_pesanan($data);
            $cart = $this->pesanan_m->get_cart()->result();
            $row = [];
            foreach ($cart as $c => $value) {
                array_push($row, array(
                    'pesanan_id' => $pesanan,
                    'barang_id' => $value->barang_id,
                    'harga' => $value->harga,
                    'qty' => $value->qty,
                    'total' => $value->total,
                    'status' => 'PROSES'
                ));
            }
            $this->pesanan_m->pesanan_detail($row);
            $this->pesanan_m->del_cart(['created_by' => $this->session->userdata('username')]);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }

    public function cart_del()
    {
        if (isset($_POST['batal_pesanan'])) {
            $this->pesanan_m->del_cart(['created_by' => $this->session->userdata('username')]);
        } else {
            $keranjang_id = $this->input->post('keranjang_id');
            $this->pesanan_m->del_cart(['keranjang_id' => $keranjang_id]);
        }

        if ($this->db->affected_rows() > 0) {
            $params = array("success" => true);
        } else {
            $params = array("success" => false);
        }
        echo json_encode($params);
    }

    public function keranjang()
    {
        $keranjang = $this->pesanan_m->get_cart();
        $data['keranjang_pesanan'] = $keranjang;
        $this->load->view('pesanan/keranjang_pesanan', $data);
    }

    public function kelola_pesanan()
    {
        $data = array(
            'pesanan' => $this->pesanan_m->get_pesanan()->row(),
            'pesanan_detail' => $this->pesanan_m->get_pesanan_detail()->result(),
            'pesanan_approve' => $this->pesanan_m->get_pesanan_approve()->result()
        );
        $this->load->view('pesanan/kelola_pesanan', $data);
    }


    public function approve()
    {
        $data = array(
            'pesanan' => $this->pesanan_m->get_pesanan()->row(),
            'pesanan_detail' => $this->pesanan_m->get_pesanan_detail()->result(),
            'approve' => $this->pesanan_m->get_approve()->result()
        );

        $this->load->view('pesanan/approve_pesanan', $data);
    }

    public function proses_approve()
    {
        $pesanan_id = $this->input->post('pesanan_id');

        $this->pesanan_m->proses_approve($pesanan_id);

        redirect('Pesanan/approve?status=OK', 'refresh');
    }
}
