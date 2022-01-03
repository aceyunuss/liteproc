<?php

$data['pg_title'] = "Create Procurement Request";

$data['pid'] = 11;

$data['hist_id'] = "";

$data['cid_content'] = $this->Procurement_m->getContentFlow($data['pid']);

$usrdata = $this->session->userdata('user_ses');

$data['usr'] = $this->Users_m->getUsers($usrdata['user_id'])->row_array();

$data['hist'] = [];

$data['dir'] = "req";

$data['act'] = ["", "Submit"];

$data['shno'] = "none";

$this->template('procurement/req/req_flow_v', $data);
