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
    $data['pg_title'] = "Add Commodity";

    $data['group_lv1'] = $this->Commodity_m->getGroupCom("", 1)->result_array();

    $this->template('commodity/add_commodity_v', $data);
  }


  public function get_sub_group()
  {
    $parent = $this->input->get('code');
    $this->db->where(['group_parent' => $parent]);
    $sub = $this->Commodity_m->getGroupCom()->result_array();

    echo json_encode($sub);
  }


  public function submit_add()
  {

    $post = $this->input->post();

    $insert = [
      'com_code'      => $this->Commodity_m->generateCode($post['sub_cat']),
      'type'          => $post['type'],
      'group_code'    => $post['sub_cat'],
      'name'          => $post['name'],
      'uom'           => $post['uom'],
      'spec'          => $post['spec'],
      'others'        => $post['others'],
      'created_date'  => date('Y-m-d H:i:s'),
      'updated_date'  => date('Y-m-d H:i:s')
    ];

    if ($post['type'] == "G") {
      $insert['brand_name']  = $post['brand_name'];
      $insert['brand_model'] = $post['brand_model'];
      $insert['colour']      = $post['colour'];
      $insert['dimension']   = (int)$post['long'] . "," . (int)$post['width'] . "," . (int)$post['height'];
    }

    $this->db->trans_begin();

    $this->Commodity_m->insertCommodity($insert);

    if ($this->db->trans_status() !== FALSE) {
      $this->db->trans_commit();
      $this->setMessage("Success add commodity");
      redirect('commodity');
    } else {
      $this->db->trans_rollback();
      $this->setMessage("Failed add commodity");
    }
  }


  public function get_data_commodity()
  {

    $get = $this->input->get();

    $id = (isset($get['id']) && !empty($get['id'])) ? $get['id'] : "";
    $order = (isset($get['order']) && !empty($get['order'])) ? $get['order'] : "";
    $limit = (isset($get['limit']) && !empty($get['limit'])) ? $get['limit'] : 10;
    $search = (isset($get['search']) && !empty($get['search'])) ? $this->db->escape_like_str(strtolower($get['search'])) : "";
    $offset = (isset($get['offset']) && !empty($get['offset'])) ? $get['offset'] : 0;
    $field_order = (isset($get['sort']) && !empty($get['sort'])) ? $get['sort'] : "com_code";


    if (!empty($search)) {
      $this->db->group_start();
      $this->db->like("com_code", $search);
      $this->db->or_like("commodity.group_code", $search);
      $this->db->or_like("LOWER(type)", $search);
      $this->db->or_like("LOWER(name)", $search);
      $this->db->or_like("LOWER(group_name)", $search);
      $this->db->or_like("updated_date", $search);
      $this->db->group_end();
    }

    $this->db->select('com_code');
    $data['total'] = $this->Commodity_m->getCommodity()->num_rows();

    if (!empty($search)) {
      $this->db->group_start();
      $this->db->like("com_code", $search);
      $this->db->or_like("commodity.group_code", $search);
      $this->db->or_like("LOWER(type)", $search);
      $this->db->or_like("LOWER(name)", $search);
      $this->db->or_like("LOWER(group_name)", $search);
      $this->db->or_like("updated_date", $search);
      $this->db->group_end();
    }

    if (!empty($order)) {
      $this->db->order_by($field_order, $order);
    }

    if (!empty($limit)) {
      $this->db->limit($limit, $offset);
    }

    $rows = $this->Commodity_m->getCommodity()->result_array();

    $data['rows'] = $rows;

    echo json_encode($data);
  }


  public function detail($code)
  {

    $check = $this->Commodity_m->getCommodity($code)->row_array();

    if (empty($check)) {

      $this->setMessage("Commodity not found");
      redirect('commodity');
    } else {
      $data['pg_title'] = "Detail Commodity";
      $data['group_lv1'] = $check;

      $this->template('commodity/detail_commodity_v', $data);
    }
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

      $this->Commodity_m->insertGroupBatch($insert);

      if ($this->db->trans_status() !== FALSE) {
        $this->db->trans_commit();
      } else {
        $this->db->trans_rollback();
      }
    }
  }
}
