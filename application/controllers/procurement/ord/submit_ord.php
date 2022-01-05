<?php

$post = $this->input->post();

$pid = $post['pid'];

$hist_id = $post['hist_id'];

$comment_att = "";

$hist = $update_header = [];

$ses_usr = $this->session->userdata('user_ses');
$user = $this->Users_m->getUsers($ses_usr['user_id'])->row_array();

if (!empty($_FILES['comment_att']['name'])) {
  $this->session->set_userdata("dir_upload", "ord");
  $upload = $this->ups("comment_att");
  $comment_att = $upload;
}

$this->db->trans_begin();

$hist = $this->Procurement_m->getOrdHist($hist_id)->row_array();
$ord_number = $hist['number'];

$ord_head = $this->Procurement_m->getOrdHead($ord_number)->row_array();

if ($pid == 31) {

  $update_header['address'] = $post['address'];
  $update_header['order_date'] = $post['order_date'];

  $next_role  = "FINANCE";
  $next_pid   = 32;
} else if ($pid == 32) {

  if (!empty($_FILES['pay_att']['name'])) {
    $this->session->set_userdata("dir_upload", "ord");
    $upload = $this->ups("pay_att");
    $update_header['pay_att'] = $upload;
  }

  $next_role  = "VENDOR";
  $next_pid   = $ord_head['proc_type'] == "Service" ? 33 : 34;
} else if (in_array($pid, [33, 34])) {

  if (!empty($_FILES['vnd_att']['name'])) {
    $this->session->set_userdata("dir_upload", "ord");
    $upload = $this->ups("vnd_att");
    $update_header['vnd_att'] = $upload;
  }

  $update_header['vnd_notes'] = $post['vnd_notes'];

  $next_role  = "PIC PROCUREMENT";
  $next_pid   = 35;
} else if ($pid == 35) {

  $next_role  = "PIC PROCUREMENT";
  $next_pid   = 93;
}

if ($ses_usr['role'] == "VENDOR") {
  $user['fullname'] = $ses_usr['name'];
  $user['role_name'] = $ses_usr['role'];
}

$curr = [
  'orh_comment'     => $post['comment'],
  'orh_attachment'  => $comment_att,
  'orh_date'        => date('Y:m:d H:i:s'),
  'orh_name'        => $user['fullname']
];

$this->Procurement_m->updateOrdHist($hist_id, $curr);

$this->Procurement_m->nextOrd($ord_number, $next_pid, $next_role);

$update_header['pid'] = $next_pid;

if (!empty($update_header)) {
  $this->Procurement_m->updateOrdHeader($prc_number, $update_header);
}

if ($next_pid == 93) {
  $this->Procurement_m->completeOrd($ord_number, $user['fullname'], $user['role_name']);
}

if ($this->db->trans_status() !== FALSE) {
  $this->db->trans_commit();
  $this->setMessage("Success process data");
  $red = "home";
} else {
  $this->db->trans_rollback();
  $this->setMessage("Failed process data");
  $red = 'procurement/process_ord/' . $hist_id;
}

redirect($red);
