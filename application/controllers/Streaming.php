<?php
class Streaming extends Ci_Controller

{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->load->view("radio_v");
  }
}
