<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Procurement_m extends CI_Model
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


  public function getContentFlow($pid)
  {
    return $this->db
      ->order_by("seq", "asc")
      ->get_where("content_flow", ['pid' => $pid])
      ->result_array();
  }


  public function generateReq()
  {
    $last = $this->db
      ->select("count(req_number) + 1 as last")
      ->get("req_header")
      ->row()->last;

    $code = "REQ/" . date('Ym') . "/" . str_repeat(0, 4 - strlen($last)) . $last;

    return $code;
  }


  public function nextReq($req_number, $pid, $role)
  {
    $ins = [
      'rqh_role'    => $role,
      'rqh_pid'     => $pid,
      'req_number'  => $req_number
    ];

    $this->db->insert("req_history", $ins);

    return $this->db->affected_rows();
  }


  public function insertReqHeader($data)
  {
    $this->db->insert("req_header", $data);

    return $this->db->affected_rows();
  }


  public function insertReqHist($data)
  {
    $this->db->insert("req_history", $data);

    return $this->db->affected_rows();
  }


  public function insertReqItem($data)
  {
    $this->db->insert_batch("req_item", $data);

    return $this->db->affected_rows();
  }

  public function updateReqHeader($req_number, $data)
  {
    $this->db
      ->where("req_number", $req_number)
      ->update("req_header", $data);

    return $this->db->affected_rows();
  }


  public function getTodo()
  {
    return $this->db->get("v_todo");
  }
}
