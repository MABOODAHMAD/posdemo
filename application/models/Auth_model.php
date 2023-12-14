<?php 

   Class Auth_model extends CI_model{

       public function __Construct(){

        if(!$this->session->userdata('login')){
            redirect(base_url('auth/index'), 'refresh');
          }

       }
   }