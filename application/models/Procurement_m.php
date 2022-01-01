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


  public function generatePrc()
  {
    $last = $this->db
      ->select("count(prc_number) + 1 as last")
      ->get("prc_header")
      ->row()->last;

    $code = "PRC/" . date('Ym') . "/" . str_repeat(0, 4 - strlen($last)) . $last;

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


  public function getReqHist($id = "", $req_number = "")
  {
    if (!empty($id)) {
      $this->db->where(['rqh_id' => $id]);
    }

    if (!empty($req_number)) {
      $this->db->where(['req_number' => $req_number]);
    }

    $this->db->select("rqh_id as hist_id, rqh_name as name, rqh_role as role, rqh_comment as comment, rqh_attachment as att, rqh_pid as pid, rqh_date as date, req_number as number, pid_name as process");

    $this->db->join("process_flow", "pid=rqh_pid", "left");

    return $this->db->get("req_history");
  }


  public function getProcessFlow($id)
  {
    if (!empty($id)) {
      $this->db->where(['pid' => $id]);
    }
    return $this->db->get("process_flow");
  }


  public function getReqHead($req_number)
  {
    if (!empty($req_number)) {
      $this->db->where(['req_number' => $req_number]);
    }
    return $this->db->get("req_header");
  }


  public function getReqItem($rqi_id = "", $req_number = "")
  {
    if (!empty($rqi_id)) {
      $this->db->where(['rqi_id' => $rqi_id]);
    }
    if (!empty($req_number)) {
      $this->db->where(['req_number' => $req_number]);
    }
    return $this->db->get("req_item");
  }


  public function insertEval($data)
  {
    $this->db->insert('eval', $data);

    return $this->db->affected_rows();
  }


  public function insertEvalCr($data)
  {
    $this->db->insert_batch('eval_criteria', $data);

    return $this->db->affected_rows();
  }


  public function getEval($id = "")
  {
    if (!empty($id)) {
      $this->db->where(['eval_id' => $id]);
    }
    return $this->db->get("eval");
  }


  public function getEvalCr($id = "", $eval_id = "")
  {
    if (!empty($id)) {
      $this->db->where(['ec_id' => $id]);
    }
    if (!empty($eval_id)) {
      $this->db->where(['eval_id' => $eval_id]);
    }
    return $this->db->get("eval_criteria");
  }


  public function updateEval($id, $data)
  {
    $this->db->where(['eval_id' => $id])->update("eval", $data);

    return $this->db->affected_rows();
  }


  public function updateEvalCr($id, $data)
  {
    $this->db->where(['ec_id' => $id])->update("eval_criteria", $data);

    return $this->db->affected_rows();
  }


  public function replaceEvalCr($id, $data)
  {
    if (!empty($data)) {

      if (!empty($id)) {

        $check = $this->getEvalCr($id)->row_array();

        if (!empty($check)) {

          $last_id = $check['ec_id'];
          unset($data['ec_id']);
          $this->updateEvalCr($last_id, $data);
        } else {

          $this->db->insert("eval_criteria", $data);
          $last_id = $this->db->insert_id();
        }
      } else {

        $this->db->insert("eval_criteria", $data);
        $last_id = $this->db->insert_id();
      }

      return $last_id;
    }
  }


  public function deleteIfNotExistEvalCr($id, $deleted)
  {
    if (!empty($id) && !empty($deleted)) {
      $this->db
        ->where_not_in("ec_id", $deleted)
        ->where("eval_id", $id)
        ->delete("eval_criteria");

      return $this->db->affected_rows();
    }
  }


  public function getEvalCrSc($eci_id = "", $ec_id = "")
  {
    if (!empty($ec_id)) {
      $this->db->where(['ec_id' => $ec_id]);
    }
    if (!empty($eci_id)) {
      $this->db->where(['eci_id' => $eci_id]);
    }
    return $this->db->get("eval_criteria_idx");
  }


  public function updateEvalCrSc($id, $data)
  {
    $this->db->where(['eci_id' => $id])->update("eval_criteria_idx", $data);

    return $this->db->affected_rows();
  }


  public function replaceEvalCrSc($id, $data)
  {
    if (!empty($data)) {

      if (!empty($id)) {

        $check = $this->getEvalCrSc($id)->row_array();

        if (!empty($check)) {

          $last_id = $check['eci_id'];
          unset($data['eci_id']);
          $this->updateEvalCrSc($last_id, $data);
        } else {

          $this->db->insert("eval_criteria_idx", $data);
          $last_id = $this->db->insert_id();
        }
      } else {

        $this->db->insert("eval_criteria_idx", $data);
        $last_id = $this->db->insert_id();
      }

      return $last_id;
    }
  }


  public function deleteIfNotExistEvalCrSc($id, $deleted)
  {
    if (!empty($id) && !empty($deleted)) {
      $this->db
        ->where_not_in("eci_id", $deleted)
        ->where("ec_id", $id)
        ->delete("eval_criteria_idx");

      return $this->db->affected_rows();
    }
  }


  public function updateReqItem($id, $data)
  {
    $this->db->where(['rqi_id' => $id])->update("req_item", $data);

    return $this->db->affected_rows();
  }

  public function updateReqHist($id, $data)
  {
    $this->db->where(['rqh_id' => $id])->update("req_history", $data);

    return $this->db->affected_rows();
  }


  public function completeReq($req_number, $last_usr, $last_role)
  {
    $head = $this->getReqHead($req_number)->row_array();
    $item = $this->getReqItem("", $req_number)->result_array();

    $head['prc_number'] = $this->generatePrc();
    $head['created_date'] = date('Y:m:d H:i:s');

    $this->db->insert('prc_header', $head);

    foreach ($item as $v) {
      $ins_item[] = [
        'rqi_id'        => $v['rqi_id'],
        'pri_code'      => $v['rqi_code'],
        'pri_desc'      => $v['rqi_desc'],
        'pri_free_desc' => $v['rqi_free_desc'],
        'pri_qty'       => $v['rqi_qty'],
        'pri_price'     => $v['rqi_price'],
        'pri_uom'       => $v['rqi_uom'],
        'prc_number'    => $head['prc_number'],
      ];
    }

    $this->db->insert_batch("prc_item", $ins_item);

    $hist = [
      'rqh_name' => $last_usr,
      'rqh_role' => $last_role,
      'rqh_date'  => date('Y-m-d H:i:s')
    ];

    $this->db->where(['rqh_pid' => 91, 'req_number' => $req_number])->update("req_history", $hist);


    $next_hist = [
      'prh_role'        => 'PIC PROCUREMENT',
      'prh_pid'         => 21,
      'prc_number'      => $head['prc_number'],
    ];

    $this->db->insert('prc_history', $next_hist);
  }


  public function rejectReq($req_number, $last_usr, $last_role)
  {

    $hist = [
      'rqh_name' => $last_usr,
      'rqh_role' => $last_role,
      'rqh_date'  => date('Y-m-d H:i:s')
    ];

    $this->db
      ->where(['rqh_pid' => 81, 'req_number' => $req_number])
      ->update("req_history", $hist);
  }
}
