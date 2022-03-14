<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->output->set_header("HTTP/1.0 200 OK");
        $this->output->set_header("HTTP/1.1 200 OK");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->load->model('user_m');
        set_time_limit(0);
        ini_set('memory_limit', '20000M');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['data'] = $this->user_m->get_alldata('user');
        $this->load->view('user/user_data', $data);
    }

    public function tambah()
    {
        $this->load->view('user/user_tambah');
    }

    public function proses()
    {
        $nama          = $_POST['nama'];
        $telp          = $_POST['no_telp'];
        $username      = $_POST['username'];
        $password      = $_POST['password'];
        $level         = $_POST['level'];
        $alamat        = $_POST['alamat'];
        $tgl_true      = date("Y-m-d H:i:s");

        $user_login = $this->session->userdata("username");

        $nama          = ltrim(rtrim($nama));
        $telp          = ltrim(rtrim($telp));
        $username   = ltrim(rtrim($username));
        $password   = ltrim(rtrim($password));
        $level         = ltrim(rtrim($level));
        $alamat     = ltrim(rtrim($alamat));

        //disini cek nama kosong atau tidak
        if ($nama == "") {
            echo "errnama";
            exit();
        }

        //disini cek no telpon kosong atau tidak	
        if ($telp == "") {
            echo "errtelp";
            exit();
        }

        //disini cek username kosong atau tidak
        if ($username == "") {
            echo "erruser";
            exit();
        }

        //disini cek username sudah digunakan atau belum
        $cek_user = $this->user_m->cek_user($username);
        if ($cek_user > 0) {
            echo "userudad";
            exit();
        }

        //disini cek password kosong atau belum
        $password = sha1($password);
        if ($password == "") {
            echo "errpass";
            exit();
        }


        //disini cek jabatan kosong atau tidak	
        if ($level == "") {
            echo "errlevel";
            exit();
        }

        //disini cek alamat kosong atau tidak	
        if ($alamat == "") {
            echo "erralamat";
            exit();
        }

        $this->db->query("INSERT INTO user SET
                            username      = '$username',
                            password      = '$password',
                            nama          = '$nama',
                            telp          = '$telp',
                            alamat        = '$alamat',
                            role    	  = '$level',
                            created_by    = '$user_login',
                            created_date  = '$tgl_true',
                            modified_by   = '$user_login',
                            modified_date = '$tgl_true'");

        // insert_log("Tambah User | Nama User : $nama_user | Nama : $nama | Level : evel_user| alamat: alamat| Status : $status", $user_login);

        echo "OK\t";
    }

    public function cari()
    {
        $username  = $_POST['username'];
        $data = $this->user_m->cari('user', $username);

        echo json_encode($data);
    }

    public function update()
    {
        $nama          = $_POST['nama'];
        $telp          = $_POST['no_telp'];
        $username      = $_POST['username'];
        $password      = $_POST['password'];
        $level         = $_POST['level'];
        $alamat        = $_POST['alamat'];
        $tgl_true      = date("Y-m-d H:i:s");

        $user_login = $this->session->userdata("username");

        $nama          = ltrim(rtrim($nama));
        $telp          = ltrim(rtrim($telp));
        $username      = ltrim(rtrim($username));
        $password      = ltrim(rtrim($password));
        $level         = ltrim(rtrim($level));
        $alamat        = ltrim(rtrim($alamat));

        //disini cek nama kosong atau tidak
        if ($nama == "") {
            echo "errnama";
            exit();
        }

        //disini cek alamat kosong atau tidak  
        if ($alamat == "") {
            echo "erralamat";
            exit();
        }

        //disini cek no telpon kosong atau tidak  
        if ($telp == "") {
            echo "errtelp";
            exit();
        }


        if ($password == "") {
            $this->db->query("UPDATE user SET
                                username       = '$username',
                                nama           = '$nama',
                                telp           = '$telp',
                                role           = '$level',
                                alamat         = '$alamat',
                                modified_by    = '$user_login',
                                modified_date  = '$tgl_true'
                                WHERE username = '$username'");

            // $this->db->query("INSERT INTO log SET
            //                 keterangan = 'Update User | Nama User : $nama_user | Nama : $nama | Level : evel_user| alamat: alamat| Status : $status',
            //                 created_by = '',
            //                 created_date = '$tgl_true'");
        } else {
            $password = sha1($password);
            $this->db->query("UPDATE user SET
                                username      = '$username',
                                nama          = '$nama',
                                password      = '$password',
                                role         = '$level',
                                alamat        = '$alamat',
                                modified_by   = '',
                                modified_date = '$tgl_true'
                                WHERE username = '$username'");

            // $this->db->query("INSERT INTO log SET
            //                 keterangan = 'Update User | Nama User : $nama_user | Nama : $nama | Level : evel_user| alamat: alamat| Status : $status',
            //                 created_by = '',
            //                 created_date = '$tgl_true'");
        }

        echo "OK\t";
    }

    public function delete()
    {
        $username  = $_POST['username'];
        $tgl_true   = date("Y-m-d H:i:s");

        $this->db->query("DELETE FROM user WHERE username = '$username'");
        // $this->db->query("INSERT INTO log SET
        //                     keterangan = 'Hapus  User | username : $nama_user',
        //                     created_by = '',
        //                     created_date = '$tgl_true'");

        echo "OK\t";
    }
}
