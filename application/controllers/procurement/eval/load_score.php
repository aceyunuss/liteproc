<?php

$cr = $this->uri->segment(3);

$ecc = $this->Procurement_m->getEvalCrSc("", $cr)->result_array();

echo json_encode($ecc);