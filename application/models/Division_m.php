<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Division_m extends CI_Model
{

  public function __construct()
  {

    parent::__construct();
  }


  public function getDivision($div_id = "")
  {
    if (!empty($div_id)) {
      $this->db->where('div_id', $div_id);
    }

    return $this->db->get("division");
  }


  public function updateDivision($div_id, $data)
  {
    $this->db->where('div_id', $div_id);

    $this->db->update("division", $data);

    return $this->db->affected_rows();
  }


  public function insertDivision($data)
  {
    $this->db->insert('division', $data);

    return $this->db->affected_rows();
  }
}
