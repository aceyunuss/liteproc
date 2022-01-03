<?php

$post = $this->input->post();

$prv_id = $post['prv_id'];

$prc_v = [
  'prv_nego'  => 2
];

$this->Procurement_m->updatePrcVnd($prv_id, $prc_v);


foreach ($post['nprice'] as $k => $v) {
  $vp['pvi_nprice'] = $post['nprice'][$k];

  $this->Procurement_m->updatePrcVndItem($k, $vp);
}


if ($this->db->trans_status() !== FALSE) {
  $this->db->trans_commit();
  $this->setMessage("Success process data");
  $red = "home";
} else {
  $this->db->trans_rollback();
  $this->setMessage("Failed process data");
  $red = 'procurement/nego/' . $prv_id;
}

redirect($red);
