<?php
$this->load->model('Commodity_m');

$hist = $this->Procurement_m->getReqHist($hist_id)->row_array();

$pid = $hist['pid'];

$req_number = $hist['number'];

$data['req_head'] = $this->Procurement_m->getReqHead($req_number)->row_array();

$data['req_item'] = $this->Procurement_m->getReqItem("", $req_number)->result_array();

$data['req_hist'] = $this->Procurement_m->getReqHist("", $req_number)->result_array();

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


$data['usr'] = $this->Users_m->getUsers($usrdata['user_id'])->row_array();

$this->template('procurement/req/req_flow_v', $data);