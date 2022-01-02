<?php
$this->load->model('Commodity_m');

$hist = $this->Procurement_m->getPrcHist($hist_id)->row_array();

$pid = $hist['pid'];

$prc_number = $hist['number'];

$this->session->set_userdata("rere", $prc_number);

$data['prc_head'] = $this->Procurement_m->getPrcHead($prc_number)->row_array();

$data['prc_item'] = $this->Procurement_m->getPrcItem("", $prc_number)->result_array();

$data['hist'] = $this->Procurement_m->getPrcHist("", $prc_number)->result_array();

$data['pg_title'] = $this->Procurement_m->getProcessFlow($pid)->row()->pid_name;

$data['com'] = $this->Commodity_m->getCommodity()->result_array();

$data['pid'] = $pid;

$data['hist_id'] = $hist_id;

$data['cid_content'] = $this->Procurement_m->getContentFlow($pid);

$usrdata = $this->session->userdata('user_ses');

$data['method'] = [
  1 => 'Penunjukan langsung',
  2 => 'Pemilihan langsung',
  3 => 'Tender'
];

$data['eval_template'] = $this->Procurement_m->getEval()->result_array();

$data['usr'] = $this->Users_m->getUsers($usrdata['user_id'])->row_array();

$data['dir'] = "prc";

$this->session->unset_userdata("selection_vendor");

$this->template('procurement/prc/prc_flow_v', $data);
