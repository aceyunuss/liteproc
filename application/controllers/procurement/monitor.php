<?php

$data['status'] = $this->db->get("process_flow")->result_array();

$data['pg_title'] = "Monitor";

$this->template('procurement/monitor_v', $data);
