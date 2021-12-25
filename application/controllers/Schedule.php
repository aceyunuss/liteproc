<?php
class Schedule extends Core_Controller
{

  public function __construct()
  {
    parent::__construct();

    if (is_null($this->session->userdata('user_ses'))) {
      redirect('home');
    }
    $this->load->model('Schedule_m');
  }


  public function index()
  {
    $data['settings'] = [];//$this->Settings_m->getSettings();
    $data['pg_title'] = "Schedule";

    // $this->db->order_by('bg_id', 'desc');
    // $data['bg'] = $this->Settings_m->getBg()->result_array();

    $this->template('schedule_v', $data);
  }
}
