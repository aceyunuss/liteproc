<?php

$post = $this->input->post();

$eval_id = $post['eval_id'];

$update_e = [
  'eval_name' => $post['name'],
  'updated_date'  => date('Y-m-d H:i:s')
];

$this->db->trans_begin();

$this->Procurement_m->updateEval($eval_id, $update_e);

foreach ($post['cr_name'] as $key => $value) {
  $upd_c['ec_name']   = $post['cr_name'][$key];
  $upd_c['ec_weight'] = $post['cr_weight'][$key];
  $upd_c['ec_type']   = $post['cr_type'][$key];
  $upd_c['eval_id']   = $eval_id;

  $ec_id = !empty($post['ec_id'][$key]) ?  $post['ec_id'][$key] : "";

  $act = $this->Procurement_m->replaceEvalCr($ec_id, $upd_c);

  if ($act) {
    $del[] = $act;
  }
}

$this->Procurement_m->deleteIfNotExistEvalCr($eval_id, $del);


if ($this->db->trans_status() !== FALSE) {
  $this->db->trans_commit();
  $this->setMessage("Success edit data");
} else {
  $this->db->trans_rollback();
  $this->setMessage("Failed edit data");
}

redirect('procurement/edit_eval/' . $eval_id);
