<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings_m extends CI_Model
{

  public function __construct()
  {

    parent::__construct();
  }


  public function replaceSettings($type, $value)
  {
    $check = $this->db->get("settings")->num_rows();

    if ($check > 0) {
      $this->db->update("settings", [$type => $value]);
    } else {
      $this->db->insert("settings", [$type => $value]);
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


  public function getSettings()
  {
    return $this->db->get("settings")->row_array();
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
