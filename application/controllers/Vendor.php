<?php
class Vendor extends Core_Controller
{

  public function __construct()
  {
    parent::__construct();

    if (is_null($this->session->userdata('user_ses'))) {
      redirect('home');
    }
    $this->load->model('Vendor_m');
  }


  public function index()
  {
    $data['pg_title'] = "Vendor";

    $this->template('vendor/vendor_v', $data);
  }


  public function get_data_vendor()
  {

    $get = $this->input->get();

    $id = (isset($get['id']) && !empty($get['id'])) ? $get['id'] : "";
    $order = (isset($get['order']) && !empty($get['order'])) ? $get['order'] : "";
    $limit = (isset($get['limit']) && !empty($get['limit'])) ? $get['limit'] : 10;
    $search = (isset($get['search']) && !empty($get['search'])) ? $this->db->escape_like_str(strtolower($get['search'])) : "";
    $offset = (isset($get['offset']) && !empty($get['offset'])) ? $get['offset'] : 0;
    $field_order = (isset($get['sort']) && !empty($get['sort'])) ? $get['sort'] : "vendor_name";


    if (!empty($search)) {
      $this->db->group_start();
      $this->db->like("com_code", $search);
      $this->db->or_like("vendor.group_code", $search);
      $this->db->or_like("LOWER(type)", $search);
      $this->db->or_like("LOWER(name)", $search);
      $this->db->or_like("LOWER(group_name)", $search);
      $this->db->or_like("updated_date", $search);
      $this->db->group_end();
    }

    $this->db->select('com_code');
    $data['total'] = $this->Vendor_m->getVendor()->num_rows();

    if (!empty($search)) {
      $this->db->group_start();
      $this->db->like("com_code", $search);
      $this->db->or_like("vendor.group_code", $search);
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

    $rows = $this->Vendor_m->getVendor()->result_array();

    $data['rows'] = $rows;

    echo json_encode($data);
  }


  public function detail($code)
  {
    $check = $this->Vendor_m->getVendor($code)->row_array();

    if (empty($check)) {

      $this->setMessage("Vendor not found");
      redirect('vendor');
    } else {
      $data['pg_title'] = "Detail Vendor";
      $data['com'] = $check;

      $this->template('vendor/detail_vendor_v', $data);
    }
  }



  public function sync($vendor_id = "")
  {
    $vndparam = !empty($vendor_id) ? "&vendorId=" . $vendor_id : "";

    $buyer_id = $this->db->get_where('master', ['key' => 'buyer_id'])->row()->val;

    $dataHeader = $this->getPDC("BuyerProduct/findByBuyerOrVendor?buyerId=" . $buyer_id . $vndparam);

    if ($dataHeader != "error") {

      $this->db->trans_begin();

      foreach ($dataHeader as $k => $v) {

        if ($v["finClass"] == '1') {
          $klasifikasi = 'K';
        } else if ($v["finClass"] == '2') {
          $klasifikasi = 'M';
        } else if ($v["finClass"] == '3') {
          $klasifikasi = 'B';
        } else {
          if (strtolower($v["siupType"]) == 'kecil') {
            $klasifikasi = 'K';
          } else if (strtolower($v["siupType"]) == 'menengah') {
            $klasifikasi = 'M';
          } else if (strtolower($v["siupType"]) == 'besar') {
            $klasifikasi = 'B';
          } else {
            $klasifikasi = 'U';
          }
        }

        $this->db->select('vendor_id');
        $check = $this->Vendor_m->getVendor($v['vendorId'])->row_array();

        if (!empty($check)) {

          $dataUpdate = array(
            'vendor_name'               => strtoupper($v["vendorName"]),
            'email_address'             => $v["emailAddress"] . "x",
            'npwp_pkp'                  => strtoupper($v["npwpPkp"]),
            'creation_date'             => $v["creationDate"],
            'modified_date'             => $v['modifiedDate'],
            'fin_class'                 => $klasifikasi,
            'address_street'            => str_replace("'", "", $v["addressStreet"]),
            'address_domisili_exp_date' => $v['addressDomisiliExpDate'],
            'login_id'                  => $v["emailAddress"],
            'password'                  => $v["password"],
            'prefix'                    => $v["prefix"],
            'prefix_other'              => $v["prefixOther"],
            'suffix'                    => $v["suffix"],
            'suffix_other'              => $v["suffixOther"],
            'addres_prop'               => $v["addresProp"],
            'address_postcode'          => $v["addressPostcode"],
            'address_country'           => $v["addressCountry"],
            'address_phone_no'          => $v["addressPhoneNo"],
            'address_website'           => $v["addressWebsite"],
            'address_domisili_no'       => $v["addressDomisiliNo"],
            'address_domisili_date'     => $v['addressDomisiliDate'],
            'contact_name'              => $v["contactName"],
            'contact_pos'               => $v["contactPos"],
            'contact_phone_no'          => $v["contactPhoneNo"],
            'contact_email'             => $v["contactEmail"],
            'npwp_no'                   => $v["npwpNo"],
            'npwp_address'              => $v["npwpAddress"],
            'npwp_city'                 => $v["npwpCity"],
            'npwp_prop'                 => $v["npwpProp"],
            'npwp_postcode'             => $v["npwpPostcode"],
            'npwp_pkp_no'               => $v["npwpPkpNo"],
            'vendor_type'               => $v["vendorType"],
            'siup_iujk_type'            => $v["siupIujkType"],
            'siup_issued_by'            => $v["siupIssuedBy"],
            'siup_no'                   => $v["siupNo"],
            'siup_type'                 => $v["siupType"],
            'siup_from'                 => $v['siupFrom'],
            'siup_to'                   => $v["siupTo"],
            'tdp_issued_by'             => $v["tdpIssuedBy"],
            'tdp_no'                    => $v["tdpNo"],
            'tdp_from'                  => $v["tdpFrom"],
            'tdp_to'                    => $v["tdpTo"],
            'imp_issued_by'             => $v["impIssuedBy"],
            'imp_from'                  => $v["impFrom"],
            'imp_to'                    => $v["impTo"],
            'att_org'                   => $v["attOrg"],
            'fin_akta_mdl_dsr_curr'     => $v["finAktaMdlDsrCurr"],
            'fin_akta_mdl_dsr'          => $v["finAktaMdlDsr"],
            'fin_akta_mdl_str_curr'     => $v["finAktaMdlStrCurr"],
            'fin_akta_mdl_str'          => $v["finAktaMdlStr"],
            'fin_asset_mdl_dsr_cur'     => $v["finAssetMdlDsrCur"],
            'fin_asset_mdl_dsr'         => $v["finAssetMdlDsr"],
            'fin_rpt_currency'          => $v["finRptCurrency"],
            'fin_rpt_year'              => $v["finRptYear"],
            'fin_rpt_type'              => $v["finRptType"],
            'fin_rpt_asset_value'       => $v["finRptAssetValue"],
            'fin_rpt_hutang'            => $v["finRptHutang"],
            'fin_rpt_revenue'           => $v["finRptRevenue"],
            'fin_rpt_netincome'         => $v["finRptNetincome"],
            'smk_no'                    => $v["smkNo"],
            'smk_date'                  => $v["smkDate"],
            'smk_expired'               => $v["smkExpired"],
            'expiredfrom'               => $v["expiredfrom"],
            'expiredto'                 => $v["expiredto"],
            'expiredby'                 => $v["expiredby"],
            'modified_by'               => $v["modifiedBy"],
            'next_page'                 => $v["nextPage"],
            'reg_sessionid'             => $v["regSessionid"],
            'nib_no'                    => $v["nibNo"],
            'nib_from'                  => $v["nibFrom"],
            'nib_to'                    => $v["nibTo"],
            'sppkp_date'                => $v["sppkpDate"],
            'last_sync'                 => date("Y-m-d H:i:s")
          );

          $result = $this->Vendor_m->updateVendor($v['vendorId'], $dataUpdate);

          // update item vendor

          $this->Vendor_m->deleteProduct($v['vendorId']);

          $dataItem = [];
          $no = 0;
          foreach ($v["product"] as $p => $v2) {
            $dataItem[$no]['vendor_id']            = $v["vendorId"];
            $dataItem[$no]['product_id']           = $v2['productId'];
            $dataItem[$no]['product_name']         = $v2['productName'];
            $dataItem[$no]['product_code']         = $v2['productCode'];
            $dataItem[$no]['product_description']  = $v2['productDescription'];
            $dataItem[$no]['brand']                = $v2['brand'];
            $dataItem[$no]['source']               = $v2['source'];
            $dataItem[$no]['type']                 = $v2['type'];
            $no++;
          }

          $this->Vendor_m->insertProduct($dataItem);
        } else {

          $dataInsert = array(
            'vendor_id'                 => $v["vendorId"],
            'vendor_name'               => strtoupper($v["vendorName"]),
            'email_address'             => $v["emailAddress"] . "x",
            'npwp_pkp'                  => strtoupper($v["npwpPkp"]),
            'creation_date'             => $v["creationDate"],
            'modified_date'             => $v['modifiedDate'],
            'fin_class'                 => $klasifikasi,
            'address_street'            => str_replace("'", "", $v["addressStreet"]),
            'address_domisili_exp_date' => $v['addressDomisiliExpDate'],
            'login_id'                  => $v["emailAddress"],
            'password'                  => $v["password"],
            'prefix'                    => $v["prefix"],
            'prefix_other'              => $v["prefixOther"],
            'suffix'                    => $v["suffix"],
            'suffix_other'              => $v["suffixOther"],
            'addres_prop'               => $v["addresProp"],
            'address_postcode'          => $v["addressPostcode"],
            'address_country'           => $v["addressCountry"],
            'address_phone_no'          => $v["addressPhoneNo"],
            'address_website'           => $v["addressWebsite"],
            'address_domisili_no'       => $v["addressDomisiliNo"],
            'address_domisili_date'     => $v['addressDomisiliDate'],
            'contact_name'              => $v["contactName"],
            'contact_pos'               => $v["contactPos"],
            'contact_phone_no'          => $v["contactPhoneNo"],
            'contact_email'             => $v["contactEmail"],
            'npwp_no'                   => $v["npwpNo"],
            'npwp_address'              => $v["npwpAddress"],
            'npwp_city'                 => $v["npwpCity"],
            'npwp_prop'                 => $v["npwpProp"],
            'npwp_postcode'             => $v["npwpPostcode"],
            'npwp_pkp_no'               => $v["npwpPkpNo"],
            'vendor_type'               => $v["vendorType"],
            'siup_iujk_type'            => $v["siupIujkType"],
            'siup_issued_by'            => $v["siupIssuedBy"],
            'siup_no'                   => $v["siupNo"],
            'siup_type'                 => $v["siupType"],
            'siup_from'                 => $v['siupFrom'],
            'siup_to'                   => $v["siupTo"],
            'tdp_issued_by'             => $v["tdpIssuedBy"],
            'tdp_no'                    => $v["tdpNo"],
            'tdp_from'                  => $v["tdpFrom"],
            'tdp_to'                    => $v["tdpTo"],
            'imp_issued_by'             => $v["impIssuedBy"],
            'imp_from'                  => $v["impFrom"],
            'imp_to'                    => $v["impTo"],
            'att_org'                   => $v["attOrg"],
            'fin_akta_mdl_dsr_curr'     => $v["finAktaMdlDsrCurr"],
            'fin_akta_mdl_dsr'          => $v["finAktaMdlDsr"],
            'fin_akta_mdl_str_curr'     => $v["finAktaMdlStrCurr"],
            'fin_akta_mdl_str'          => $v["finAktaMdlStr"],
            'fin_asset_mdl_dsr_cur'     => $v["finAssetMdlDsrCur"],
            'fin_asset_mdl_dsr'         => $v["finAssetMdlDsr"],
            'fin_rpt_currency'          => $v["finRptCurrency"],
            'fin_rpt_year'              => $v["finRptYear"],
            'fin_rpt_type'              => $v["finRptType"],
            'fin_rpt_asset_value'       => $v["finRptAssetValue"],
            'fin_rpt_hutang'            => $v["finRptHutang"],
            'fin_rpt_revenue'           => $v["finRptRevenue"],
            'fin_rpt_netincome'         => $v["finRptNetincome"],
            'smk_no'                    => $v["smkNo"],
            'smk_date'                  => $v["smkDate"],
            'smk_expired'               => $v["smkExpired"],
            'expiredfrom'               => $v["expiredfrom"],
            'expiredto'                 => $v["expiredto"],
            'expiredby'                 => $v["expiredby"],
            'modified_by'               => $v["modifiedBy"],
            'next_page'                 => $v["nextPage"],
            'reg_sessionid'             => $v["regSessionid"],
            'nib_no'                    => $v["nibNo"],
            'nib_from'                  => $v["nibFrom"],
            'nib_to'                    => $v["nibTo"],
            'sppkp_date'                => $v["sppkpDate"],
            'last_sync'                 => date("Y-m-d H:i:s")

          );

          $result = $this->Vendor_m->insertVendor($dataInsert);

          $dataItem = [];
          $no = 0;
          foreach ($v["product"] as $p => $v2) {
            $dataItem[$no]['vendor_id']            = $v["vendorId"];
            $dataItem[$no]['product_id']           = $v2['productId'];
            $dataItem[$no]['product_name']         = $v2['productName'];
            $dataItem[$no]['product_code']         = $v2['productCode'];
            $dataItem[$no]['product_description']  = $v2['productDescription'];
            $dataItem[$no]['brand']                = $v2['brand'];
            $dataItem[$no]['source']               = $v2['source'];
            $dataItem[$no]['type']                 = $v2['type'];
            $no++;
          }

          $this->Vendor_m->insertProduct($dataItem);
        }
      }

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        return 0;
      } else {
        $this->db->trans_commit();
        return 1;
      }
    } else {

      return 0;
    }
  }
}
