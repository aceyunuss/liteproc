<?php

$post = $this->input->post();

$insert_e = [
  'eval_name' => $post['name'],
  'created_date'  => date('Y-m-d H:i:s'),
  'updated_date'  => date('Y-m-d H:i:s')
];

$this->db->trans_begin();

$this->Procurement_m->insertEval($insert_e);
$eval_id = $this->db->insert_id();

foreach ($post['cr_name'] as $key => $value) {
  $insert_c[$key]['ec_name'] = $post['cr_name'][$key];
  $insert_c[$key]['ec_weight'] = $post['cr_weight'][$key];
  $insert_c[$key]['ec_type'] = $post['cr_type'][$key];
  $insert_c[$key]['eval_id'] = $eval_id;
}

$this->Procurement_m->insertEvalCr($insert_c);

if ($this->db->trans_status() !== FALSE) {
  $this->db->trans_commit();
  $this->setMessage("Success add data");
  redirect('procurement/edit_eval/' . $eval_id);
} else {
  $this->db->trans_rollback();
  $this->setMessage("Failed add data");
  redirect('procurement/add_eval');
}
