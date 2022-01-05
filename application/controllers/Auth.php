<?php
class Auth extends Core_Controller
{

  public function __construct()
  {
    parent::__construct();
  }


  public function index()
  {
    if (!is_null($this->session->userdata('user_ses'))) {

      $data['pg_title'] = "Dashboard";

      if ($this->session->userdata('user_ses')['role'] == "VENDOR") {
        $this->template('vnd_dashboard_v', $data);
      } else {
        $this->template('dashboard_v', $data);
      }
    } else {
      $this->load->view("login_v");
    }
  }


  public function logout()
  {
    $this->session->sess_destroy('user_ses');
    redirect('auth');
  }


  public function login()
  {
    $em = $this->security->xss_clean($this->input->post('email'));
    $pw = $this->security->xss_clean($this->input->post('password'));
    $rl = $this->security->xss_clean($this->input->post('role'));

    if (!empty($em) && !empty($pw)) {

      $this->load->model(['Users_m', 'Vendor_m']);

      if ($rl == "i") {
        $log = $this->Users_m->checkLogin($em, $pw, $rl);
      } else {
        $log = $this->Vendor_m->checkLogin($em, $pw, $rl);
      }


      if (!empty($log)) {

        $data_session = [
          'user_id' => $log['user_id'],
          'name'    => $log['fullname'],
          'role'    => $log['role_name']
        ];
        $this->session->set_userdata('user_ses', $data_session);

        redirect(site_url('home'));
      } else {
        // $this->setMessage("User not found");
      }
    } else {
      // $this->setMessage("Fill email and password");
    }
    redirect(site_url('home'));
  }
}
