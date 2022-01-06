<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Core_Controller extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
  }


  public function template($view = "", $data = [])
  {

    $dita['content'] = $view;
    $dita['site_title'] = "Manage Site Almuwasholah - " . $data['pg_title'];
    $dita['sel_menu'] = $this->uri->segment(1);
    $pass = array_merge($dita, $data);

    $this->load->view('template_v', $pass);
  }

  public function ups($input)
  {
    $loc = $this->session->userdata("dir_upload");

    $loc = str_replace("_", "/", $loc);
    $root = str_replace("application", "", APPPATH);
    $dir = $root . "/uploads/" . $loc;
    $dir = str_replace(array("\\", "//"), "/", $dir);

    // print_r($dir);

    $temn = $_FILES[$input]['tmp_name'];

    if (!file_exists($dir)) {
      mkdir($dir, 0777, true);
    }

    $config['upload_path'] = $dir;
    $config['allowed_types'] = 'jpg|gif|png|doc|docx|xls|xlsx|ppt|pptx|pdf|jpeg|zip|rar|tgz|7zip|tar';
    $config['max_size']     = 10240;
    // $config['max_widht'] 	= 1000;
    // $config['max_height']  	= 1000;
    // $config['file_name'] 		= round(microtime(true)*1000);

    $this->upload->initialize($config);

    if (!$this->upload->do_upload($input)) {
      return $this->upload->display_errors('', '');
    }

    return $this->upload->data('file_name');
  }


  public function dop($folder = "", $file = "")
  {
    $pth = str_replace("system\\", "", BASEPATH) . "uploads/" . $folder . "/" . $file;

    if (file_exists($pth)) {
      $this->load->helper('download');
      force_download($pth, NULL);
      exit;
    } else {
      echo "<script>alert(\"File not found.\"); window.history.go(-1);</script>";
    }
  }

  public function setMessage($message)
  {
    if (!empty($message)) {
      if (is_array($message)) {
        $message = implode("<br/>", $message);
      }
      $this->session->set_userdata("message", $message);
    }
  }


  private function dio_curl($endpont, $postfield)
  {

    $curl = curl_init();
    $url = $this->db->get_where('master', ['key' => 'api_pdc'])->row()->val;

    curl_setopt($curl, CURLOPT_URL, $url . $endpont);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); //delete when certificate is done     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $postfield);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Accept: application/json']);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      $data =  "cURL Error #:" . $err;
    } else {
      $data = json_decode($response, true);
    }

    return $data;
  }


  private function getToken()
  {
    $id = $this->db->get_where('master', ['key' => 'buyer_id'])->row()->val;
    $domain = $this->db->get_where('master', ['key' => 'buyer_domain'])->row()->val;

    $tokenurl   = "security/token";
    $tokenfield = "{  \n   \"buyerId\": \"" . $id . "\",  \n   \"domain\": \"" . $domain . "\",  \n   \"type\": 0  \n }";

    $token = $this->dio_curl($tokenurl, $tokenfield);

    return $token;
  }


  public function getPDC($endpoint)
  {
    $token = $this->getToken();

    if (isset($token['resultData'])) {

      $access = [
        "accessKey" => $token['resultData']['accessKey'],
        "accessToken" => $token['resultData']['accessToken']
      ];

      $data = $this->dio_curl($endpoint, json_encode($access));
      $ret  = $data['resultData'];
    } else {
      $ret = "error";
    }

    return $ret;
  }




  public function selection($selector)
  {

    $get = $this->input->get();

    $filter_add = array();
    $filter_del = array();

    $selection = $this->data[$selector];

    foreach ($get as $key => $value) {
      if ($value == 1) {
        $filter_add[] = $key;
      } else {
        $filter_del[] = $key;
      }
    }

    foreach ($filter_add as $key => $value) {
      if (!empty($selection)) {
        if (!in_array($value, $selection)) {
          $selection[] = $value;
        }
      } else {
        $selection[] = $value;
      }
    }

    if (!empty($filter_del) && is_array($selection)) {
      $selection = array_intersect($selection, $filter_del);
    }

    if (empty($get)) {
      $selection = array();
    } else {
    }

    $selection = @array_unique($selection);

    $this->session->set_userdata($selector, $selection);
  }


  public function calculate_topsis($prc_number)
  {
    ##y
    ## src https://tugasakhir.id/contoh-perhitungan-spk-metode-topsis/
    ##y

    $dat = $this->db
      ->select("prv_id, prv_vnd_id")
      ->get_where("prc_vendor", ['prc_number' => $prc_number, 'eval_status' => 1])
      ->result_array();

    if (empty($dat)) {
      return [];
    }
    
    foreach ($dat as $vc) {
      $prv[] = $vc['prv_id'];
    }

    foreach ($dat as $key => $value) {
      $eval = $this->db
        ->select("ec_id, prv_id, eci_val")
        ->get_where('prc_vendor_eval', ['prv_id' => $value['prv_id']])
        ->result_array();

      foreach ($eval as $ky => $val) {
        $normalisasi[$value['prv_vnd_id']][$val['ec_id']] = $val['eci_val'];

        $nt[$val['ec_id']] = $this->db
          ->select("sum((eci_val*eci_val)) as nt")
          ->where_in('prv_id', $prv)
          ->get_where("prc_vendor_eval", ['ec_id' => $val['ec_id']])
          ->row()->nt;

        $wg[$val['ec_id']] = $this->db
          ->distinct()
          ->select("ec_weight as wg")
          ->where_in('prv_id', $prv)
          ->get_where("prc_vendor_eval", ['ec_id' => $val['ec_id']])
          ->row()->wg;

        $tp[$val['ec_id']] = $this->db
          ->distinct()
          ->select("ec_type as tp")
          ->where_in('prv_id', $prv)
          ->get_where("prc_vendor_eval", ['ec_id' => $val['ec_id']])
          ->row()->tp;
      }
    }

    foreach ($normalisasi as $key => $value) {
      foreach ($value as $k => $v) {
        $red_normal[$key][$k] = $v / sqrt($nt[$k]);
      }
    }

    foreach ($red_normal as $key => $value) {
      foreach ($value as $k => $v) {
        $bob_normal[$key][$k] = $v * $wg[$k];
      }
    }

    foreach ($bob_normal as $key => $value) {
      foreach ($value as $k => $v) {
        $fil[$k][] = $v;
      }
    }

    foreach ($fil as $key => $value) {
      $positive[$key] = $tp[$key] == "Cost" ? min($value) : max($value);
      $negative[$key] = $tp[$key] == "Cost" ? max($value) : min($value);
    }

    foreach ($bob_normal as $key => $value) {
      $tdp = $tdn = 0;
      foreach ($value as $k => $v) {
        $dp = ($v - $positive[$k]) * ($v - $positive[$k]);
        $dn = ($v - $negative[$k]) * ($v - $negative[$k]);

        $tdp += $dp;
        $tdn += $dn;
      }

      $tot[$key]['vnd'] = $key;
      $tot[$key]['positive'] = sqrt($tdp);
      $tot[$key]['negative'] = sqrt($tdn);
      $tot[$key]['preference'] = (sqrt($tdp) + sqrt($tdn)) == 0 ? 1 : (sqrt($tdn) / (sqrt($tdp) + sqrt($tdn)));
    }

    return $tot;
  }
}
