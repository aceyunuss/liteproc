<?php

$post = $this->input->post();

$pid = $post['pid'];

$hist_id = $post['hist_id'];

$comment_att = "";

$hist = $update_header = [];

$ses_usr = $this->session->userdata('user_ses');
$user = $this->Users_m->getUsers($ses_usr['user_id'])->row_array();

if (!empty($_FILES['comment_att']['name'])) {
  $this->session->set_userdata("dir_upload", "req");
  $upload = $this->ups("comment_att");
  $comment_att = $upload;
}

$this->db->trans_begin();

if ($pid != 11) {
  $hist = $this->Procurement_m->getReqHist($hist_id)->row_array();
  $req_number = $hist['number'];
}

if ($pid == 11) {

  $req_number = $this->Procurement_m->generateReq();

  $insert_head = [
    'req_number'    => $req_number,
    'user_id'       => $user['user_id'],
    'user_name'     => $user['fullname'],
    'div_id'        => $user['div_id'],
    'div_name'      => $user['div_name'],
    'proc_name'     => $post['proc_name'],
    'proc_desc'     => $post['proc_desc'],
    'date_needed'   => $post['needed'],
    'created_date'  => date('Y-m-d H:i:s'),
    'pid'           => $pid
  ];

  foreach ($post['itm_name'] as $key => $value) {
    $insert_item[$key]['rqi_free_desc'] = $post['itm_name'][$key];
    $insert_item[$key]['rqi_qty']       = $post['itm_qty'][$key];
    $insert_item[$key]['req_number']    = $req_number;
  }

  $insert_hist = [
    'rqh_role'        => $user['role_name'],
    'rqh_name'        => $user['fullname'],
    'rqh_comment'     => $post['comment'],
    'rqh_attachment'  => $comment_att,
    'rqh_date'        => date('Y-m-d H:i:s'),
    'rqh_pid'         => $pid,
    'req_number'      => $req_number,
  ];

  $this->Procurement_m->insertReqHeader($insert_head);

  $this->Procurement_m->insertReqHist($insert_hist);

  $this->Procurement_m->insertReqItem($insert_item);

  $next_role  = "PIC PROCUREMENT";
  $next_pid   = 12;

  $update_header['pid'] = $next_pid;
} else if ($pid == 12) {

  foreach ($post['com_code'] as $k => $v) {

    $item = [
      'rqi_code'    => $post['com_code'][$k],
      'rqi_desc'    => $post['com_name'][$k],
      'rqi_price'   => $post['price'][$k],
      'rqi_uom'     => $post['uom'][$k]
    ];

    $this->Procurement_m->updateReqItem($post['rqi'][$k], $item);
  }

  $update_header = [
    'bid_open'  => $post['opening'],
    'bid_close' => $post['closing'],
    'method'    => $post['method'],
    'eval_id'   => $post['eval']
  ];

  $next_role  = "DIV HEAD";
  $next_pid   = 13;
} else if ($pid == 13) {

  if ($post['status'] == "y") {

    if ($user['role_name'] == "DIV HEAD") {

      $next_role  = "FINANCE";
      $next_pid   = 13;
    } else {

      $next_role  = $user['role_name'];
      $next_pid   = 91;
    }
  } else {

    $next_role  = $user['role_name'];
    $next_pid   = 81;
  }
}

$curr = [
  'rqh_comment'     => $post['comment'],
  'rqh_attachment'  => $comment_att,
  'rqh_date'        => date('Y:m:d H:i:s'),
  'rqh_name'        => $user['fullname']
];

$this->Procurement_m->updateReqHist($hist_id, $curr);

$this->Procurement_m->nextReq($req_number, $next_pid, $next_role);

if (!empty($update_header)) {
  $this->Procurement_m->updateReqHeader($req_number, $update_header);
}

if ($next_pid == 91) {
  $this->Procurement_m->completeReq($req_number, $user['fullname'], $user['role_name']);
}

if ($next_pid == 81) {
  $this->Procurement_m->rejectReq($req_number, $user['fullname'], $user['role_name']);
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
