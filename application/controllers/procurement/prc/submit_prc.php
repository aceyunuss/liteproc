<?php

$post = $this->input->post();

$pid = $post['pid'];

$hist_id = $post['hist_id'];

$comment_att = "";

$hist = $update_header = [];

$ses_usr = $this->session->userdata('user_ses');
$user = $this->Users_m->getUsers($ses_usr['user_id'])->row_array();

if (!empty($_FILES['comment_att']['name'])) {
  $this->session->set_userdata("dir_upload", "prc");
  $upload = $this->ups("comment_att");
  $comment_att = $upload;
}

$this->db->trans_begin();

$hist = $this->Procurement_m->getPrcHist($hist_id)->row_array();
$prc_number = $hist['number'];

if ($pid == 21) {

  $vnd = (isset($this->data['selection_vendor'])) ? $this->data['selection_vendor'] : 0;

  foreach ($vnd as $k => $v) {

    $ins_vnd[] = [
      'prc_number'  => $prc_number,
      'prv_vnd_id'  => $v,
      'prv_process' => "Bidding"
    ];
  }

  $this->Procurement_m->insertPrcVnd($ins_vnd);

  $next_role  = "PIC PROCUREMENT";
  $next_pid   = 22;
} else if ($pid == 22) {

  $next_role  = "PIC PROCUREMENT";
  $next_pid   = 23;
} else if ($pid == 23) {

  $vn = (isset($this->data['selection_vendor_nego'])) ? $this->data['selection_vendor_nego'] : 0;

  if (isset($post['complete_nego']) && $post['complete_nego'] == 1) {

    $this->db->where(['prc_number' => $prc_number, 'prv_vnd_id' => $post['winner']])->update("prc_vendor", ['is_winner' => 1]);
    $next_role  = "FINANCE";
    $next_pid   = 24;
  } else {
    $next_role  = "PIC PROCUREMENT";
    $next_pid   = 23;
  }

  foreach ($vn as $value) {
    $this->db->where(['prc_number' => $prc_number, 'prv_vnd_id' => $value])->update('prc_vendor', ['prv_nego' => 1, 'prv_process' => "Negotiation"]);
  }
} else if ($pid = 24) {

  $next_role  = "FINANCE";
  $next_pid   = 92;
}

$curr = [
  'prh_comment'     => $post['comment'],
  'prh_attachment'  => $comment_att,
  'prh_date'        => date('Y:m:d H:i:s'),
  'prh_name'        => $user['fullname']
];

$this->Procurement_m->updatePrcHist($hist_id, $curr);

$this->Procurement_m->nextPrc($prc_number, $next_pid, $next_role);

$update_header['pid'] = $next_pid;

if (!empty($update_header)) {
  $this->Procurement_m->updatePrcHeader($prc_number, $update_header);
}

if ($next_pid == 92) {
  $this->Procurement_m->completePrc($prc_number, $user['fullname'], $user['role_name']);
}


if ($this->db->trans_status() !== FALSE) {
  $this->db->trans_commit();
  $this->setMessage("Success process data");
  $red = "home";
} else {
  $this->db->trans_rollback();
  $this->setMessage("Failed process data");
  $red = $pid == 11 ? 'procurement/create' : 'procurement/todo/' . $hist_id;
}

redirect($red);
