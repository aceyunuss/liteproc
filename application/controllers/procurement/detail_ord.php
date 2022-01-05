<?php
$this->load->model('Commodity_m');

$ord_number = str_replace(".", "/", $ord_number);

$data['ord_head'] = $this->Procurement_m->getOrdHead($ord_number)->row_array();

$data['ord_item'] = $this->Procurement_m->getOrdItem("", $ord_number)->result_array();

$data['hist'] = $this->Procurement_m->getOrdHist("", $ord_number)->result_array();

$data['pg_title'] = $this->Procurement_m->getProcessFlow($data['ord_head']['pid'])->row()->pid_name;

$data['cid_content'] = $this->Procurement_m->getContentFlow($data['ord_head']['pid']);

$usrdata = $this->session->userdata('user_ses');

$typ = $data['ord_head']['proc_type'] == "Service" ? 33 : 34;

$data['shp'] = $this->Procurement_m->getProcessFlow($typ)->row()->pid_name;

$data['dir'] = "ord";

$data['pa'] = false;

$this->template('procurement/detail_ord_v', $data);
