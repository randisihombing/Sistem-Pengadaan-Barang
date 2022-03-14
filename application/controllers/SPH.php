<?php
class SPH extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->load->model(['sph_m', 'barang_m']);
        set_time_limit(0);
        ini_set('memory_limit', '20000M');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function tambah_sph()
    {
        $barang = $this->barang_m->get_alldata('barang');
        $cart = $this->sph_m->get_cart();
        $data = array(
            'barang' => $barang,
            'keranjang' => $cart,
            'no_pesanan' => $this->sph_m->invoice_no(),
        );
        $this->load->view('sph/sph_tambah', $data);
    }

    public function proses()
    {
        $data = $this->input->post(null, TRUE);

        if (isset($_POST['add_cart'])) {

            $barang = $this->input->post('barang_id');

            $check_cart = $this->sph_m->get_cart(['keranjang.barang_id' => $barang])->num_rows();
            if ($check_cart > 0) {
                $this->sph_m->update_cart_qty($data);
            } else {
                $this->sph_m->add_cart($data);
            }

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }

        if (isset($_POST['proses_sph'])) {
            $sph = $this->sph_m->input_sph($data);
            $cart = $this->sph_m->get_cart()->result();
            $row = [];
            foreach ($cart as $c => $value) {
                array_push($row, array(
                    'sph_id' => $sph,
                    'barang_id' => $value->barang_id,
                    'harga' => $value->harga,
                    'qty' => $value->qty,
                ));
            }
            $this->sph_m->sph_detail($row);
            $this->sph_m->del_cart(['created_by' => $this->session->userdata('username')]);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true, "sph_id" => $sph);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }

    public function cart_del()
    {
        if (isset($_POST['batal_sph'])) {
            $this->sph_m->del_cart(['created_by' => $this->session->userdata('username')]);
        } else {
            $cart_id = $this->input->post('cart_id');
            $this->sph_m->del_cart(['cart_id' => $cart_id]);
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
        $keranjang = $this->sph_m->get_cart();
        $data['keranjang'] = $keranjang;
        $this->load->view('sph/keranjang_data', $data);
    }

    public function cetak($id)
    {
        $data = array(
            'sph' => $this->sph_m->get_sph($id)->row(),
            'sph_detail' => $this->sph_m->get_sph_detail($id)->result()
        );
        $this->load->view('sph/cetak_sph', $data);
    }

    public function kelola_sph()
    {
        $data['row'] = $this->sph_m->get_sph();
        $this->load->view('sph/kelola_sph', $data);
    }

    public function sph_produk($sph_id = null)
    {
        $detail = $this->sph_m->get_sph_detail($sph_id)->result();
        echo json_encode($detail);
    }

    public function delete()
    {
        $no_pesanan = $_POST['no_pesanan'];

        $this->db->query("DELETE FROM sph WHERE no_pesanan = '$no_pesanan'");
        echo "OK\t";
    }
}
