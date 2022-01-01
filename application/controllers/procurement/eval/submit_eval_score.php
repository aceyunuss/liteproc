<?php

$post = $this->input->post();

$this->db->trans_begin();

foreach ($post['sname'] as $key => $value) {
  $upd['eci_name']   = $post['sname'][$key];
  $upd['eci_val']    = $post['sscore'][$key];
  $upd['ec_id']      = $post['ecc'];

  $eci_id = !empty($post['sid'][$key]) ?  $post['sid'][$key] : "";

  $act = $this->Procurement_m->replaceEvalCrSc($eci_id, $upd);

  if ($act) {
    $del[] = $act;
  }
}

$this->Procurement_m->deleteIfNotExistEvalCrSc($post['ecc'], $del);

if ($this->db->trans_status() !== FALSE) {
  $this->db->trans_commit();
  $res = ['status' => "success"];
} else {
  $this->db->trans_rollback();
  $res = ['status' => "failed"];
}

echo json_encode($res);
