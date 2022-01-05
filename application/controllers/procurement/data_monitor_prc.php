<?php

$get = $this->input->get();

$id = (isset($get['id']) && !empty($get['id'])) ? $get['id'] : "";
$order = (isset($get['order']) && !empty($get['order'])) ? $get['order'] : "";
$limit = (isset($get['limit']) && !empty($get['limit'])) ? $get['limit'] : 10;
$search = (isset($get['search']) && !empty($get['search'])) ? $this->db->escape_like_str(strtolower($get['search'])) : "";
$offset = (isset($get['offset']) && !empty($get['offset'])) ? $get['offset'] : 0;
$field_order = (isset($get['sort']) && !empty($get['sort'])) ? $get['sort'] : "number";


if (!empty($search)) {
  $this->db->group_start();
  $this->db->like("LOWER(prc_number)", $search);
  $this->db->or_like("LOWER(proc_name)", $search);
  $this->db->or_like("LOWER(user_name)", $search);
  $this->db->or_like("LOWER(div_name)", $search);
  $this->db->or_like("LOWER(pname)", $search);
  $this->db->group_end();
}

$this->db->select('prc_number');
$data['total'] = $this->Procurement_m->getPrcHead()->num_rows();

if (!empty($search)) {
  $this->db->group_start();
  $this->db->like("LOWER(prc_number)", $search);
  $this->db->or_like("LOWER(proc_name)", $search);
  $this->db->or_like("LOWER(user_name)", $search);
  $this->db->or_like("LOWER(div_name)", $search);
  $this->db->or_like("LOWER(pname)", $search);
  $this->db->group_end();
}

if (!empty($order)) {
  $this->db->order_by($field_order, $order);
}

if (!empty($limit)) {
  $this->db->limit($limit, $offset);
}

$rows = $this->Procurement_m->getPrcHead()->result_array();

foreach ($rows as $key => $value) {
  $rows[$key]['pn'] = str_replace("/", ".", $value['prc_number']);
}

$data['rows'] = $rows;

echo json_encode($data);
