<?php
class Division extends Core_Controller
{

  public function __construct()
  {
    parent::__construct();

    if (is_null($this->session->userdata('user_ses'))) {
      redirect('home');
    }
    $this->load->model('Division_m');
  }


  public function index()
  {
    $data['pg_title'] = "Division";

    $this->template('division/division_v', $data);
  }


  public function add()
  {
    $data['pg_title'] = "Add Division";

    $this->template('division/add_division_v', $data);
  }


  public function submit_add()
  {

    $post = $this->input->post();
    $this->db->where(['div_code' => $post['code']]);
    $check = $this->Division_m->getDivision()->num_rows();

    if ($check > 0) {
      $this->setMessage("Failed add division. Division code has already used");
      redirect('division');
    } else {
      $insert = [
        'div_name'      => $post['name'],
        'div_code'      => $post['code'],
        'status'        => "Active",
        'created_date'  => date('Y-m-d H:i:s'),
        'updated_date'  => date('Y-m-d H:i:s')
      ];

      $this->db->trans_begin();

      $this->Division_m->insertDivision($insert);

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
        $this->setMessage("Success add division");
        redirect('division');
      } else {
        $this->db->trans_rollback();
        $this->setMessage("Failed add division");
      }
    }
  }


  public function get_data_division()
  {

    $get = $this->input->get();

    $id = (isset($get['id']) && !empty($get['id'])) ? $get['id'] : "";
    $order = (isset($get['order']) && !empty($get['order'])) ? $get['order'] : "";
    $limit = (isset($get['limit']) && !empty($get['limit'])) ? $get['limit'] : 10;
    $search = (isset($get['search']) && !empty($get['search'])) ? $this->db->escape_like_str(strtolower($get['search'])) : "";
    $offset = (isset($get['offset']) && !empty($get['offset'])) ? $get['offset'] : 0;
    $field_order = (isset($get['sort']) && !empty($get['sort'])) ? $get['sort'] : "updated_date";


    if (!empty($search)) {
      $this->db->group_start();
      $this->db->like("LOWER(div_code)", $search);
      $this->db->or_like("LOWER(div_name)", $search);
      $this->db->or_like("updated_date", $search);
      $this->db->group_end();
    }

    $this->db->select('div_id');
    $data['total'] = $this->Division_m->getDivision()->num_rows();

    if (!empty($search)) {
      $this->db->group_start();
      $this->db->like("LOWER(div_code)", $search);
      $this->db->or_like("LOWER(div_name)", $search);
      $this->db->or_like("updated_date", $search);
      $this->db->group_end();
    }

    if (!empty($order)) {
      $this->db->order_by($field_order, $order);
    }

    if (!empty($limit)) {
      $this->db->limit($limit, $offset);
    }

    $rows = $this->Division_m->getDivision()->result_array();

    $data['rows'] = $rows;

    echo json_encode($data);
  }



  public function ch_status($code)
  {

    $check = $this->Division_m->getDivision($code)->row_array();

    if (empty($check)) {

      $this->setMessage("Division not found");
    } else {

      if ($check['status'] == "Active") {
        $msg = "Deactivate";
        $update['status'] = "Deactive";
      } else {
        $msg = "Activate";
        $update['status'] = "Active";
      }

      $update['updated_date'] = date("Y-m-d H:i:s");

      $this->db->trans_begin();

      $this->Division_m->updateDivision($code, $update);

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
        $this->setMessage("Success $msg division");
        redirect('division');
      } else {
        $this->db->trans_rollback();
        $this->setMessage("Failed $msg division");
      }
    }

    redirect('division');
  }



  public function edit($code)
  {

    $check = $this->Division_m->getDivision($code)->row_array();

    if (empty($check)) {

      $this->setMessage("Division not found");
      redirect('division');
    } else {

      $data['pg_title'] = "Edit Division";
      $data['div'] = $check;

      $this->template('division/edit_division_v', $data);
    }
  }



  public function submit_edit()
  {

    $post = $this->input->post();

    $this->db->where(['div_code' => $post['code'], 'div_id !=' => $post['div_id']]);
    $check = $this->Division_m->getDivision()->num_rows();

    if ($check > 0) {
      $this->setMessage("Failed edit division. Division code has already used");
      redirect('division');
    } else {

      $update = [
        'div_name'  => $post['name'],
        'div_code'  => $post['code'],
        'updated_date'  => date('Y-m-d H:i:s')
      ];

      $this->db->trans_begin();

      $this->Division_m->updateDivision($post['div_id'], $update);

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
        $this->setMessage("Success edit division");
        redirect('division');
      } else {
        $this->db->trans_rollback();
        $this->setMessage("Failed edit division");
      }
    }
  }
}
