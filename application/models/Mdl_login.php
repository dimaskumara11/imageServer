<?php
class Mdl_login extends CI_Model
{
    function __construct()
    {
        $this->table = array(
            'user' => 'tbl_user',
        );
    }

    function cekLogin($params)
    {
        $where = array(
            'username' => $params['username'],
            'password' => md5($params['password']),
        );
        try {
            $res = $this->db->where($where)->get($this->table['user'])->row();
            return $res;
        } catch (Exception $e) {
            return FALSE;
        }
    }
}