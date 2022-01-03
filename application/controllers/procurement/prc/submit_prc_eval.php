<?php

$post = $this->input->post();

$this->db->trans_begin();

foreach ($post['go'] as $key => $value) {
  $cr = $this->Procurement_m->getEvalCr($value['id'])->row_array();
  $sc = $this->Procurement_m->getEvalCrSc($value['vl'])->row_array();

  $this->db->select('min(eci_val) as min');
  $min = $this->Procurement_m->getEvalCrSc("", $value['id'])->row()->min;

  $this->db->select('max(eci_val) as max');
  $max = $this->Procurement_m->getEvalCrSc("", $value['id'])->row()->max;

  $ins = [
    'ec_id'     => $cr['ec_id'],
    'ec_name'   => $cr['ec_name'],
    'ec_type'   => $cr['ec_type'],
    'ec_min'    => $min,
    'ec_max'    => $max,
    'ec_weight' => $cr['ec_weight'],
    'eci_id'    => $sc['eci_id'],
    'eci_val'   => $sc['eci_val'],
    'eci_name'  => $sc['eci_name'],
    'prv_id'    => $post['prvs'],
  ];

  $this->db->insert("prc_vendor_eval", $ins);
}


$this->db->where(['prv_id' => $post['prvs']])->update("prc_vendor", ['eval_status' => 1]);

if ($this->db->trans_status() !== FALSE) {
  $this->db->trans_commit();
  $ret = ['status' => 'success'];
} else {
  $this->db->trans_rollback();
  $ret = ['status' => 'failed'];
}

echo json_encode($ret);
