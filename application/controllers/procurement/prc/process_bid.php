<?php
$this->load->model('Commodity_m');

$pv = $this->Procurement_m->getPrcVendor($id)->row_array();

$data['prv_id'] = $id;

$prc_number = $pv['prc_number'];

$data['head'] = $this->Procurement_m->getPrcVndHead($id)->row_array();

$item = $this->Procurement_m->getPrcVndItem("", $id)->result_array();

$this->db->trans_begin();

$ins = [];

if (empty($item)) {
  $ri = $this->Procurement_m->getPrcItem("", $prc_number)->result_array();

  foreach ($ri as $v) {
    $ins[] = [
      'pri_id'        => $v['pri_id'],
      'pri_code'      => $v['pri_code'],
      'pvi_desc'      => $v['pri_desc'],
      'pvi_free_desc' => $v['pri_free_desc'],
      'pvi_qty'       => $v['pri_qty'],
      'pvi_price'     => $v['pri_price'],
      'pvi_uom'       => $v['pri_uom'],
      'prc_number'    => $v['prc_number'],
      'prv_id'        => $id
    ];
  }

  $this->Procurement_m->insertPrcVndItem($ins);
}

$data['item'] = $this->Procurement_m->getPrcVndItem("", $id)->result_array();

$data['pg_title'] = "Bidding";

$usrdata = $this->session->userdata('user_ses');

$data['method'] = [
  1 => 'Penunjukan langsung',
  2 => 'Pemilihan langsung',
  3 => 'Tender'
];

$data['eval_template'] = $this->Procurement_m->getEval()->result_array();

$data['usr'] = $this->Users_m->getUsers($usrdata['user_id'])->row_array();

$data['dir'] = "bid";

if ($this->db->trans_status() !== FALSE) {
  $this->db->trans_commit();
} else {
  $this->db->trans_rollback();
}

$this->template('procurement/prc/bid_v', $data);

if (empty($item)) {
  $this->db->where('prv_id', 0)->delete("prc_vendor_item");
}
