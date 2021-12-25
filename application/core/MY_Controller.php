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

  /*
  private function goCurl($api_endpoint = "", $api_body = [], $api_header = "")
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, APISITE . $api_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $api_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($api_body));

    $result = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if (curl_errno($ch)) {
      $result = "{\"status\": \"Error Curl " . curl_error($ch) . "\"}";
    }

    curl_close($ch);

    $result_arr = json_decode($result, true);
    $result_arr['code'] = $http_status;

    return $result_arr;
  }


  private function getToken()
  {

    $bd = [
      'private_key' => APIKEY,
      'client'      => APICLIENT
    ];

    $hd = [
      "Content-Type: application/json",
      "cache-control: no-cache",
    ];

    $token = $this->goCurl("/auth/get_token", $bd, $hd);

    $token_key = $this->aes->redmoon($token['token']);

    if ($token['code'] == 200) {

      $date = new DateTime();
      $date->add(new DateInterval('PT' . $token['expired_in'] . 'S'));
      $token_exp =  $date->format('Y-m-d H:i:s');

      $ses = ['token_key' => $token_key, 'token_exp' => $token_exp];
      $this->session->set_userdata($ses);
    }

    return $token;
  }


  public function goPost($endpoint = "", $body = [])
  {

    $token_time = isset($this->session->userdata['token_exp']) ? new DateTime($this->session->userdata['token_exp']) : new DateTime('now');
    $now = new DateTime('now');
    
    echo '<pre>';
    var_dump($this->session);

    if (!isset($this->session->userdata['token_key']) || (isset($this->session->userdata['token_key']) && $now >= $token_time)) {
      $gettoken = $this->getToken();
    }

    echo '<pre>';
    var_dump($this->session);
    die();

    if ($gettoken['code'] == 200) {

      $header = [
        "Content-Type: application/json",
        "cache-control: no-cache",
        "Authorization: Bearer " . $gettoken['token'],
      ];

      $ret = $this->goCurl($endpoint, $body, $header);
    } else {

      $ret = [
        'code'    => 505,
        'status'  => "Failed",
        'message' => "Failed get token"
      ];
    }

    return json_encode($ret);
  }
  */


  public function setMessage($message)
  {
    if (!empty($message)) {
      if (is_array($message)) {
        $message = implode("<br/>", $message);
      }
      $this->session->set_userdata("message", $message);
    }
  }
}
