<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
    protected $CI;

    public function __construct() {
        parent::__construct();
            // reference to the CodeIgniter super object
        $this->CI =& get_instance();
        $this->CI->load->model('Universal_model','unicon');
    }

    public function alpha_space($userDefinePara,$FixedPara=null) {

        if (! preg_match('/^([a-z -])+$/i', $userDefinePara)) {
            $this->CI->form_validation->set_message('alpha_space', 'The field may only contain alpha characters & White spaces');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function unique_code_db($userDefinePara,$FixedPara=null) {

        $get_para = explode('.',$FixedPara);

        $this->CI->form_validation->set_message('unique_code_db',$get_para[2]);
        return $this->CI->unicon->CoreQuery("SELECT {$get_para[1]} FROM {$get_para[0]} WHERE {$get_para[1]}='$userDefinePara'",'num_rows')>0 ? false : true;
        
        // if (! preg_match('/^([a-z ])+$/i', $userDefinePara)) {
        //     $this->CI->form_validation->set_message('alpha_space', 'The field may only contain alpha characters & White spaces');
        //     return FALSE;
        // } else {
        //     return TRUE;
        // }
    }

    public function unique_code_dual_db($userDefinePara,$FixedPara=null) {

        $get_para = explode('.',$FixedPara);
        $this->CI->form_validation->set_message('unique_code_dual_db',$get_para[4]);
        return $this->CI->unicon->CoreQuery("SELECT {$get_para[2]} FROM {$get_para[1]} WHERE {$get_para[2]}='$userDefinePara' AND {$get_para[3]}='{$get_para[0]}'",'num_rows')>0 ? false : true;
        
        // if (! preg_match('/^([a-z ])+$/i', $userDefinePara)) {
        //     $this->CI->form_validation->set_message('alpha_space', 'The field may only contain alpha characters & White spaces');
        //     return FALSE;
        // } else {
        //     return TRUE;
        // }
    }
}