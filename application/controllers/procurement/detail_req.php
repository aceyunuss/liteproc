<?php
$this->load->model('Commodity_m');

$req_number = str_replace(".", "/", $req_number);

$data['req_head'] = $this->Procurement_m->getReqHead($req_number)->row_array();

$data['req_item'] = $this->Procurement_m->getReqItem("", $req_number)->result_array();

$data['hist'] = $this->Procurement_m->getReqHist("", $req_number)->result_array();

$data['pg_title'] = $this->Procurement_m->getProcessFlow($data['req_head']['pid'])->row()->pid_name;

$data['com'] = $this->Commodity_m->getCommodity()->result_array();

$data['cid_content'] = $this->Procurement_m->getContentFlow($data['req_head']['pid']);

$usrdata = $this->session->userdata('user_ses');

$data['eval_template'] = $this->Procurement_m->getEval()->result_array();

$data['usr'] = $this->Users_m->getUsers($usrdata['user_id'])->row_array();

$data['dir'] = "req";

$this->template('procurement/detail_req_v', $data);
