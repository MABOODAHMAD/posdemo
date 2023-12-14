<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zatca{

    protected $CI;

    public function __construct() {
            // reference to the CodeIgniter super object
        $this->CI =& get_instance();
        $this->CI->load->model('Universal_model','unicon');
    }

    private function binary2hexa($value){
        $len_hex =   $this->lentodechex($value);
          return  $len_hex.bin2hex($value);
      }
      private function lentodechex($len){
          $length = strlen($len);
          $dechexc = dechex($length);
          $count_hex_len = strlen($dechexc);
           if ($count_hex_len==1) 
              {
                  return '0'.$dechexc;
              }
              else if($count_hex_len==2)
               {
                  return $dechexc;
              }
      }

      public function qrDataGen($data = array()){
          $get = (object)$data;
          $com = $this->binary2hexa($get->com_name);
          $vat_no = $this->binary2hexa($get->vat_no);
          $datetime = $this->binary2hexa($get->datetime);
          $tot = $this->binary2hexa($get->gettot);
          $vat_t = $this->binary2hexa($get->vat);
          

          $str = ('01'.$com.'02'.$vat_no.'03'.$datetime.'04'.$tot.'05'.$vat_t);

          $bin = hex2bin($str);

          $qr = base64_encode($bin);
          
          
          return $qr;
      }
      
      public function qrCodeGenerate($data){
        $qr_image= rand().'.png';
        $params['data'] = $this->qrDataGen($data);
        $params['level'] = 'H';
        $params['size'] = 3;
        $params['savename'] =FCPATH."uploads/qr_image/".$qr_image;
        if($this->CI->ciqrcode->generate($params)){
            return base_url("uploads/qr_image/$qr_image");
        }else{
            return base_url("uploads/qr_image/$qr_image");
        }
    }

    public function test($rt){
        return $rt;
    }
}