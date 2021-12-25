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


  public function insertGroupBatch($insert)
  {
    $this->db->truncate("commodity_group");
    $this->db->insert_batch("commodity_group", $insert);

    return $this->db->affected_rows();
  }


  public function getGroupCom($code = "", $level = "")
  {
    if (!empty($code)) {
      $this->db->where(['group_code' => $code]);
    }
    if (!empty($level)) {
      if ($level == 1) {
        $this->db->where(['length(group_code)' => 2]);
      } else {
        $this->db->where(['length(group_code)' => 5]);
      }
    }
    return $this->db->get("commodity_group");
  }


  public function generateCode($group_code)
  {
    $last = $this->db
      ->select("count(com_code) + 1 as last")
      ->where(['group_code' => $group_code])
      ->get("commodity")
      ->row()->last;

    $code = $group_code . "." . str_repeat(0, 4 - strlen($last)) . $last;

    return $code;
  }


  public function insertCommodity($insert)
  {
    $this->db->insert("commodity", $insert);

    return $this->db->affected_rows();
  }


  public function getBg($id = "")
  {
    if (!empty($id)) {
      $this->db->where('id', $id);
    }

    return $this->db->get("background");
  }


  public function getCommodity($code = "")
  {
    if (!empty($code)) {
      $this->db->where('com_code', $code);
    }
    $this->db->join("commodity_group", "commodity_group.group_code=commodity.group_code", "left");

    return $this->db->get("commodity");
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
