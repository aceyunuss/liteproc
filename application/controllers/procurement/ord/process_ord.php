<?php
$this->load->model('Commodity_m');

$hist = $this->Procurement_m->getOrdHist($hist_id)->row_array();

$pid = $hist['pid'];

$ord_number = $hist['number'];

$data['ord_head'] = $this->Procurement_m->getOrdHead($ord_number)->row_array();

$data['ord_item'] = $this->Procurement_m->getOrdItem("", $ord_number)->result_array();

$data['hist'] = $this->Procurement_m->getOrdHist("", $ord_number)->result_array();

$data['pg_title'] = $this->Procurement_m->getProcessFlow($pid)->row()->pid_name;

$data['pid'] = $pid;

$data['hist_id'] = $hist_id;

$data['cid_content'] = $this->Procurement_m->getContentFlow($pid);

$usrdata = $this->session->userdata('user_ses');

$typ = $data['ord_head']['proc_type'] == "Service" ? 33 : 34;

$data['shp'] = $this->Procurement_m->getProcessFlow($typ)->row()->pid_name;

$data['dir'] = "ord";

$data['act'] = $pid == 35 ? "Accept" : "Submit";

$data['pa'] = $pid == 32;

$this->template('procurement/ord/ord_flow_v', $data);
