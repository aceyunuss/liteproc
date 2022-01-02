<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_m extends CI_Model
{

  public function __construct()
  {

    parent::__construct();
  }


  public function checkLogin($email, $password)
  {
    return $this->db->select("vendor_id as user_id, vendor_name as fullname, 'VENDOR' as role_name")->where(['login_id' => $email, 'password' => sha1($password)])->get("vendor")->row_array();
  }


  public function getVendor($vendor_id = "")
  {
    if (!empty($vendor_id)) {
      $this->db->where('vendor_id', $vendor_id);
    }

    return $this->db->get("vendor");
  }


  public function updateVendor($vendor_id, $data)
  {
    $this->db->where('vendor_id', $vendor_id);

    $this->db->update("vendor", $data);

    return $this->db->affected_rows();
  }


  public function deleteProduct($vendor_id)
  {
    if (!empty($vendor_id)) {
      $this->db->where('vendor_id', $vendor_id);
    }

    $this->db->delete("vendor_product");

    return $this->db->affected_rows();
  }


  public function insertProduct($product)
  {
    $this->db->insert_batch('vendor_product', $product);

    return $this->db->affected_rows();
  }


  public function insertVendor($data)
  {
    $this->db->insert('vendor', $data);

    return $this->db->affected_rows();
  }


  public function getProduct($vendor_id = "", $product_id = "")
  {
    if (!empty($product_id)) {
      $this->db->where('produc$product_id', $product_id);
    }
    if (!empty($vendor_id)) {
      $this->db->where('vendor_id', $vendor_id);
    }

    return $this->db->get("vendor_product");
  }
}
