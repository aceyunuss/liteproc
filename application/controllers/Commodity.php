<?php
class Commodity extends Core_Controller
{

  public function __construct()
  {
    parent::__construct();

    if (is_null($this->session->userdata('user_ses'))) {
      redirect('home');
    }
    $this->load->model('Commodity_m');
  }


  public function index()
  {
    $data['pg_title'] = "Commodity";

    $this->template('commodity/commodity_v', $data);
  }


  public function add()
  {
    
  }


  public function sync()
  {
    $com = $this->getPDC("ComGroup/findAll");
    $insert = [];

    if ($com != "error") {
      foreach ($com as $val) {
        $insert[] = [
          'group_code'    => $val['groupCode'],
          'group_name'    => $val['groupName'],
          'group_parent'  => $val['comGroupParent']
        ];
      }

      $this->db->trans_begin();

      $this->db->truncate("commodity_group");

      $this->db->insert_batch("commodity_group", $insert);

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
      } else {
        $this->db->trans_rollback();
      }
    }
  }


}
