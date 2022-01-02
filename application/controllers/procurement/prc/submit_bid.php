<?php

$post = $this->input->post();

$prv_id = $post['prv_id'];

$comment_att = "";

$ses_usr = $this->session->userdata('user_ses');
$user = $this->Users_m->getUsers($ses_usr['user_id'])->row_array();

if (!empty($_FILES['comment_att']['name'])) {
  $this->session->set_userdata("dir_upload", "prc");
  $upload = $this->ups("comment_att");
  $comment_att = $upload;
}

$prc_v = [
  'bid_number'  => $post['bid_number'],
  'prv_notes'   => $post['notes'],
  'prv_date'    => date('Y-m-d H:i:s'),
  'prv_att'     => $comment_att
];

$this->Procurement_m->updatePrcVnd($prv_id, $prc_v);


foreach ($post['qprice'] as $k => $v) {
  $vp['pvi_qprice'] = $post['qprice'][$k];

  $this->Procurement_m->updatePrcVndItem($k, $vp);
}


if ($this->db->trans_status() !== FALSE) {
  $this->db->trans_commit();
  $this->setMessage("Success process data");
  $red = "home";
} else {
  $this->db->trans_rollback();
  $this->setMessage("Failed process data");
  $red = 'procurement/bid/' . $prv_id;
}

redirect($red);
