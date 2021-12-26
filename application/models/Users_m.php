<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_m extends CI_Model
{

  public function __construct()
  {

    parent::__construct();
  }


  public function getUsers($user_id = "")
  {
    if (!empty($user_id)) {
      $this->db->where('user_id', $user_id);
    }

    $this->db->join('(select div_id, div_code, div_name from division) division', 'division.div_id=users.div_id', 'left');
    return $this->db->get("users");
  }


  public function checkLogin($email, $password)
  {
    return $this->db->where(['email' => $email, 'password' => sha1($password)])->get("users")->row_array();
  }


  public function updateUsers($user_id, $data)
  {
    $this->db->where('user_id', $user_id);

    $this->db->update("users", $data);

    return $this->db->affected_rows();
  }


  public function insertUsers($data)
  {
    $this->db->insert('users', $data);

    return $this->db->affected_rows();
  }


  public function getRole()
  {
    return $this->db->get("role");
  }
}
