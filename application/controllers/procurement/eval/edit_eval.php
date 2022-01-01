<?php

$data['pg_title'] = "Edit Evaluation Template";

$data['eval'] = $this->Procurement_m->getEval($id)->row_array();

$data['crit'] = $this->Procurement_m->getEvalCr("", $id)->result_array();

$this->template('procurement/eval/edit_eval_v', $data);
