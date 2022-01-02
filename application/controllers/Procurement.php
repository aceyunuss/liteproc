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


    $selection = array("selection_vendor");

    foreach ($selection as $key => $value) {
      $this->data[$value] = $this->session->userdata($value);
    }
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


  public function get_todo()
  {
    include('procurement/data_todo.php');
  }


  public function process_req($hist_id)
  {
    include('procurement/req/process_req.php');
  }

  public function eval_template()
  {
    include('procurement/eval/eval.php');
  }


  public function add_eval()
  {
    include('procurement/eval/add_eval.php');
  }


  public function submit_add_eval()
  {
    include('procurement/eval/submit_add_eval.php');
  }


  public function get_data_eval()
  {
    include('procurement/eval/data_eval.php');
  }


  public function edit_eval($id)
  {
    include('procurement/eval/edit_eval.php');
  }


  public function submit_edit_eval()
  {
    include('procurement/eval/submit_edit_eval.php');
  }


  public function load_score()
  {
    include('procurement/eval/load_score.php');
  }


  public function submit_eval_score()
  {
    include('procurement/eval/submit_eval_score.php');
  }


  public function process_prc($hist_id)
  {
    include('procurement/prc/process_prc.php');
  }


  public function get_vendor()
  {
    include('procurement/prc/data_vendor.php');
  }


  public function submit_prc()
  {
    include('procurement/prc/submit_prc.php');
  }


  public function get_selected_vendor()
  {
    include('procurement/prc/data_selected_vendor.php');
  }


  public function get_todo_vnd()
  {
    include('procurement/data_todo_vendor.php');
  }


  public function bid($id)
  {
    include('procurement/prc/process_bid.php');
  }


  public function submit_bid()
  {
    include('procurement/prc/submit_bid.php');
  }


  public function load_quo($id)
  {
    include('procurement/prc/load_quo.php');
  }


  public function submit_prc_eval()
  {
    include('procurement/prc/submit_prc_eval.php');
  }
}
