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
  $this->db->like("LOWER(number)", $search);
  $this->db->or_like("LOWER(name)", $search);
  $this->db->or_like("LOWER(pid_name)", $search);
  $this->db->or_like("LOWER(role)", $search);
  $this->db->or_like("created_date", $search);
  $this->db->group_end();
}

$rl = $this->session->userdata('user_ses')['role'];

$this->db->select('hist_id')->where('role', $rl);
$data['total'] = $this->Procurement_m->getTodo()->num_rows();

if (!empty($search)) {
  $this->db->group_start();
  $this->db->like("LOWER(number)", $search);
  $this->db->or_like("LOWER(name)", $search);
  $this->db->or_like("LOWER(pid_name)", $search);
  $this->db->or_like("LOWER(role)", $search);
  $this->db->or_like("created_date", $search);
  $this->db->group_end();
}

if (!empty($order)) {
  $this->db->order_by($field_order, $order);
}

if (!empty($limit)) {
  $this->db->limit($limit, $offset);
}

$this->db->where('role', $rl);
$rows = $this->Procurement_m->getTodo()->result_array();

$data['rows'] = $rows;

echo json_encode($data);
