<?php
class user_m extends CI_Model
{

    public function cek_user($username)
    {
        $cek_user = $this->db->query("SELECT * FROM user WHERE username = '$username'");
        return json_encode($cek_user->num_rows());
    }

    public function get_alldata($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $result = $this->db->get()->result();
        return $result;
    }

    public function cari($table, $username)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('username', $username);
        $result = $this->db->get()->result();
        return $result;
    }
}
