<?php
class Users extends Core_Controller
{

  public function __construct()
  {
    parent::__construct();

    if (is_null($this->session->userdata('user_ses'))) {
      redirect('home');
    }
    $this->load->model(['Users_m', 'Division_m']);
  }


  public function index()
  {
    $data['pg_title'] = "Users";

    $this->template('users/users_v', $data);
  }


  public function add()
  {
    $data['pg_title'] = "Add User";

    $data['role'] = $this->Users_m->getRole()->result_array();
    $data['div'] = $this->Division_m->getDivision()->result_array();

    $this->template('users/add_user_v', $data);
  }


  public function detail($user_id)
  {

    $check = $this->Users_m->getUsers($user_id)->row_array();

    if (empty($check)) {

      $this->setMessage("User not found");
      redirect('users');
    } else {
      $data['pg_title'] = "Detail User";
      $data['usr'] = $check;

      $this->template('users/detail_user_v', $data);
    }
  }

  public function submit_add()
  {

    $post = $this->input->post();
    $this->db->where(['npp' => $post['npp']]);
    $check = $this->Users_m->getUsers()->num_rows();

    if ($check > 0) {
      $this->setMessage("Failed add users. NPP has already used");
      redirect('users');
    } else {
      $insert = [
        'fullname'      => $post['name'],
        'npp'           => $post['npp'],
        'role_name'     => $post['role'],
        'div_id'        => $post['div'],
        'phone'         => $post['phone'],
        'email'         => $post['email'],
        'password'      => sha1($post['password']),
        'status'        => "Active",
        'created_date'  => date('Y-m-d H:i:s'),
        'updated_date'  => date('Y-m-d H:i:s')
      ];

      $this->db->trans_begin();

      $this->Users_m->insertUsers($insert);

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
        $this->setMessage("Success add users");
        redirect('users');
      } else {
        $this->db->trans_rollback();
        $this->setMessage("Failed add users");
      }
    }
  }


  public function get_data_users()
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
      $this->db->like("LOWER(fullname)", $search);
      $this->db->or_like("LOWER(div_name)", $search);
      $this->db->or_like("LOWER(role_name)", $search);
      $this->db->or_like("updated_date", $search);
      $this->db->group_end();
    }

    $this->db->select('user_id');
    $data['total'] = $this->Users_m->getUsers()->num_rows();

    if (!empty($search)) {
      $this->db->group_start();
      $this->db->like("LOWER(fullname)", $search);
      $this->db->or_like("LOWER(div_name)", $search);
      $this->db->or_like("LOWER(role_name)", $search);
      $this->db->or_like("updated_date", $search);
      $this->db->group_end();
    }

    if (!empty($order)) {
      $this->db->order_by($field_order, $order);
    }

    if (!empty($limit)) {
      $this->db->limit($limit, $offset);
    }

    $rows = $this->Users_m->getUsers()->result_array();

    $data['rows'] = $rows;

    echo json_encode($data);
  }



  public function ch_status($code)
  {

    $check = $this->Users_m->getUsers($code)->row_array();

    if (empty($check)) {

      $this->setMessage("Users not found");
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

      $this->Users_m->updateUsers($code, $update);

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
        $this->setMessage("Success $msg users");
        redirect('users');
      } else {
        $this->db->trans_rollback();
        $this->setMessage("Failed $msg users");
      }
    }

    redirect('users');
  }



  public function edit($code)
  {

    $check = $this->Users_m->getUsers($code)->row_array();

    if (empty($check)) {

      $this->setMessage("Users not found");
      redirect('users');
    } else {

      $data['pg_title'] = "Edit Users";
      $data['usr'] = $check;

      $data['role'] = $this->Users_m->getRole()->result_array();
      $data['div'] = $this->Division_m->getDivision()->result_array();

      $this->template('users/edit_user_v', $data);
    }
  }



  public function submit_edit()
  {

    $post = $this->input->post();

    $this->db->where(['npp' => $post['npp'], 'user_id !=' => $post['user_id']]);
    $check = $this->Users_m->getUsers()->num_rows();

    if ($check > 0) {
      $this->setMessage("Failed edit users. NPP has already used");
      redirect('users');
    } else {

      $update = [
        'fullname'      => $post['name'],
        'npp'           => $post['npp'],
        'role_name'     => $post['role'],
        'div_id'        => $post['div'],
        'phone'         => $post['phone'],
        'email'         => $post['email'],
        'updated_date'  => date('Y-m-d H:i:s')
      ];

      if (!empty($post['password'])) {
        $update['password'] = sha1($post['password']);
      }

      $this->db->trans_begin();

      $this->Users_m->updateUsers($post['user_id'], $update);

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
        $this->setMessage("Success edit users");
        redirect('users');
      } else {
        $this->db->trans_rollback();
        $this->setMessage("Failed edit users");
      }
    }
  }
}
