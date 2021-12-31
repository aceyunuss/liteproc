<?php
class Procurement extends Core_Controller
{

  public function __construct()
  {
    parent::__construct();

    if (is_null($this->session->userdata('user_ses'))) {
      redirect('home');
    }
    $this->load->model(['Procurement_m', 'Users_m']);
  }


  public function index()
  {
    // $data['pg_title'] = "Procurement";

    // $this->template('commodity/commodity_v', $data);
  }

  public function create()
  {
    include('procurement/req/create.php');
  }

  public function submit_req()
  {
    include('procurement/req/submit_req.php');
  }
}
