<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Commodity_m extends CI_Model
{

  public function __construct()
  {

    parent::__construct();
  }


  public function replaceCommodity($type, $value)
  {
    $check = $this->db->get("commodity")->num_rows();

    if ($check > 0) {
      $this->db->update("commodity", [$type => $value]);
    } else {
      $this->db->insert("commodity", [$type => $value]);
    }

    return $this->db->affected_rows();
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


  public function getCommodity()
  {
    return $this->db->get("commodity")->row_array();
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
