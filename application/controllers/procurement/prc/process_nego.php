<?php
$this->load->model('Commodity_m');

$pv = $this->Procurement_m->getPrcVendor($id)->row_array();

$data['prv_id'] = $id;

$prc_number = $pv['prc_number'];

$data['head'] = $this->Procurement_m->getPrcVndHead($id)->row_array();

$data['item'] = $this->Procurement_m->getPrcVndItem("", $id)->result_array();

$data['pg_title'] = "Negotiation";

$usrdata = $this->session->userdata('user_ses');

$data['method'] = [
  1 => 'Penunjukan langsung',
  2 => 'Pemilihan langsung',
  3 => 'Tender'
];

$data['eval_template'] = $this->Procurement_m->getEval()->result_array();

$data['usr'] = $this->Users_m->getUsers($usrdata['user_id'])->row_array();

$data['dir'] = "prc";

if ($this->db->trans_status() !== FALSE) {
  $this->db->trans_commit();
} else {
  $this->db->trans_rollback();
}

$this->template('procurement/prc/nego_v', $data);

