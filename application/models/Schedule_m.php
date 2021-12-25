<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_m extends CI_Model
{

  public function __construct()
  {

    parent::__construct();
  }


  public function insertBg($data)
  {
    $this->db->insert("background", $data);

    return $this->db->affected_rows();
  }


  public function getBg($id = "")
  {
    if (!empty($id)) {
      $this->db->where('id', $id);
    }

    return $this->db->get("background");
  }


  public function deleteBg($id)
  {
    $this->db->where('bg_id', $id)->delete("background");

    return $this->db->affected_rows();
  }


  public function updateBg($id = "", $data)
  {
    if (!empty($id)) {
      $this->db->where('bg_id', $id);
    }

    $this->db->update("background", $data);

    return $this->db->affected_rows();
  }
}
