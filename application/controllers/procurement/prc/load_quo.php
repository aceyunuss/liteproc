<?php

$data['head'] = $this->Procurement_m->getPrcVendor($id)->row_array();

$data['item'] = $this->Procurement_m->getPrcVndItem("", $id)->result_array();

echo json_encode($data);
