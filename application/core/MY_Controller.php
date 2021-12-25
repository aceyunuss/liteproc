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


  public function dop($folder = "", $subfolder = "", $file = "")
  {
    $pth = str_replace("system\\", "", BASEPATH) . "uploads/" . $folder . "/" . $subfolder . "/" . $file;

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


  public function getPDC($endpont)
  {
    $token = $this->getToken();

    if (isset($token['resultData'])) {

      $access = [
        "accessKey" => $token['resultData']['accessKey'],
        "accessToken" => $token['resultData']['accessToken']
      ];

      $data = $this->dio_curl($endpont, json_encode($access));
      $ret  = $data['resultData'];
    } else {
      $ret = "error";
    }

    return $ret;
  }
}
