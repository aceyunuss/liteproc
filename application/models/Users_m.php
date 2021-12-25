<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends CI_Model
{

  public function __construct()
  {

    parent::__construct();
  }


  public function getUser($id = "")
  {
    if (!empty($id)) {
      $this->db->where('id', $id);
    }
    return $this->db->get("users");
  }


  public function checkLogin($username, $password)
  {
    return $this->db->where(['username' => $username, 'password' => sha1($password)])->get("users")->row_array();
  }
}
