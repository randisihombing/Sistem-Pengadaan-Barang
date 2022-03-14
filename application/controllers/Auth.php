<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth_m');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function proses()
    {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if ($username != "" && $password != "") {
            $user = $this->db->query("SELECT * FROM user")->result();
            if (count($user) == 0) {
                $password = sha1("admin");
                $this->db->query("INSERT INTO user SET
									username = 'admin',
									password = '$password',
									nama = 'admin',
									telp = '-',
									alamat = '-',
									role = 'admin'");
            }

            $query = $this->auth_m->login($username, $password);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $cek_login = array(
                    'username' => $row->username,
                    'nama' => $row->nama,
                    'role' => $row->role
                );
                $this->session->set_userdata($cek_login);

                echo "OK";
            } else {
                echo "GAGAL";
            }
        } else {
            echo "Username Atau Password Harus Diisi";
        }
    }

    public function logout()
    {
        $cek_login = array('username', 'role');
        $this->session->unset_userdata($cek_login);
        redirect('auth');
    }
}
