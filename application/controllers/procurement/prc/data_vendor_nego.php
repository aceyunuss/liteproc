<?php

$get = $this->input->get();

$id = (isset($get['id']) && !empty($get['id'])) ? $get['id'] : "";
$order = (isset($get['order']) && !empty($get['order'])) ? $get['order'] : "";
$limit = (isset($get['limit']) && !empty($get['limit'])) ? $get['limit'] : 10;
$search = (isset($get['search']) && !empty($get['search'])) ? $this->db->escape_like_str(strtolower($get['search'])) : "";
$offset = (isset($get['offset']) && !empty($get['offset'])) ? $get['offset'] : 0;
$field_order = (isset($get['sort']) && !empty($get['sort'])) ? $get['sort'] : "";

$prc_number = str_replace(".", "/", $this->uri->segment(3));

$this->db->select('distinct SUBSTRING( pri_code, 1, 5 ) as code');
$itm = $this->Procurement_m->getPrcItem("", $prc_number)->result_array();

foreach ($itm as $v) {
  $code[] = $v['code'];
}


if (!empty($search)) {
  $this->db->group_start();
  $this->db->like("LOWER(vendor_name)", $search);
  $this->db->or_like("LOWER(class)", $search);
  $this->db->group_end();
}

$this->db->select('vendor_id')->where('bid_number !=', NULL);
$data['total'] = $this->Procurement_m->getPrcVendor("", $prc_number)->num_rows();

if (!empty($search)) {
  $this->db->group_start();
  $this->db->like("LOWER(vendor_name)", $search);
  $this->db->or_like("LOWER(class)", $search);
  $this->db->group_end();
}

if (!empty($order)) {
  $this->db->order_by($field_order, $order);
}

if (!empty($limit)) {
  $this->db->limit($limit, $offset);
}

$this->db->select('vendor_id, vendor_name, class, bid_number, prv_id, prv_nego')->where('bid_number !=', NULL);
$rows = $this->Procurement_m->getPrcVendor("", $prc_number)->result_array();

foreach ($rows as $key => $value) {
  $rows[$key]['checkbox'] = in_array($value['prv_nego'], [1, 2]) ? true : false;
}

$data['rows'] = $rows;

echo json_encode($data);
