<?php
$this->load->model('Commodity_m');

$prc_number = str_replace(".", "/", $prc_number);

$data['prc_head'] = $this->Procurement_m->getPrcHead($prc_number)->row_array();

$data['prc_item'] = $this->Procurement_m->getPrcItem("", $prc_number)->result_array();

$data['hist'] = $this->Procurement_m->getPrcHist("", $prc_number)->result_array();

$data['pg_title'] = $this->Procurement_m->getProcessFlow($data['prc_head']['pid'])->row()->pid_name;

$data['com'] = $this->Commodity_m->getCommodity()->result_array();

$data['cid_content'] = $this->Procurement_m->getContentFlow($data['prc_head']['pid']);

$usrdata = $this->session->userdata('user_ses');

$data['eval_template'] = $this->Procurement_m->getEval()->result_array();

$data['usr'] = $this->Users_m->getUsers($usrdata['user_id'])->row_array();

$data['dir'] = "prc";

$this->db->join("(select eval_id as id, eval_name from eval) eval", "eval.id=eval_criteria.eval_id");
$eval = $this->Procurement_m->getEvalCr("", $data['prc_head']['eval_id'])->result_array();

foreach ($eval as $k => $v) {
  $eval[$k]['sc'] = $this->Procurement_m->getEvalCrSc('', $v['ec_id'])->result_array();
}

$data['eval'] = $eval;

$this->db->where('eval_status', 1);
$vnd = $this->Procurement_m->getPrcVendor("", $prc_number)->result_array();

$topsis = $this->calculate_topsis($prc_number);

foreach ($vnd as $key => $value) {
  $vnd[$key]['score'] = $topsis[$value['vendor_id']]['preference'];
}
$data['vnd_list'] = $vnd;

$this->db->where('is_winner', 1);
$data['win'] = $this->Procurement_m->getPrcVendor("", $prc_number)->row_array()['vendor_name'];


$this->template('procurement/detail_prc_v', $data);
