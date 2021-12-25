<?php
class Settings extends Core_Controller
{

  public function __construct()
  {
    parent::__construct();

    if (is_null($this->session->userdata('user_ses'))) {
      redirect('home');
    }
    $this->load->model('Settings_m');
  }


  public function index()
  {
    $data['pg_title'] = "Settings";
    $data['settings'] = $this->Settings_m->getSettings();
    $this->db->order_by('bg_id', 'desc');
    $data['bg'] = $this->Settings_m->getBg()->result_array();

    $this->template('settings_v', $data);
  }


  public function update_settings()
  {
    $post = $this->input->post();
    $http = 500;

    $cat = ($post['type'] == "name" || $post['type'] == 'title') ? "text" : "file";
    $data = $cat == "text" ? $post['inp'] : $_FILES['inp']['name'];

    if (!empty($data)) {

      if ($cat == "file") {
        $this->session->set_userdata("dir_upload", $post['type']);
        $upload = $this->ups("inp");
        $post['inp'] = $upload;
      }

      $this->db->trans_begin();

      if ($post['type'] == "background") {
        $inp['filename']  = $post['inp'];
        $inp['is_active'] = 1;

        $this->Settings_m->insertBg($inp);
      } else {
        $this->Settings_m->replaceSettings($post['type'], $post['inp']);
      }

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
        $http = 200;
      } else {
        $this->db->trans_rollback();
      }
    }

    $this->output->set_status_header($http);
  }


  public function delete_background()
  {

    $post = $this->input->post();
    $http = 500;

    if (!empty($post)) {

      $this->db->trans_begin();

      $this->Settings_m->deleteBg($post['bg_id']);

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
        $http = 200;
      } else {
        $this->db->trans_rollback();
      }
    }

    $this->output->set_status_header($http);
  }


  public function activation()
  {

    $post = $this->input->post();
    $http = 500;

    if (!empty($post)) {

      $bg_id = explode(",", $post['bg_id']);
      // $to = $post['status'] == 1 ? 0 : 1;

      $this->db->trans_begin();

      $this->db->where_in('bg_id', $bg_id);
      $this->Settings_m->updateBg("", ['is_active' => $post['status']]);

      // $this->db->where_not_in('bg_id', $bg_id);
      // $this->Settings_m->updateBg("", ['is_active' => $to]);

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
        $http = 200;
      } else {
        $this->db->trans_rollback();
      }
    }

    $this->output->set_status_header($http);
  }
}
