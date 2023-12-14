<?php
     class Auth extends CI_Controller{
         public function __construct(){
            parent::__construct();
      
            // $this->load->model('Site_model', 'dbcon');
            $this->load->model('Universal_model','unicon');
            // $this->load->library('form_validation');
            // $this->load->helper('form');
            //$this->load->model('QrController','qrcon');
            $this->load->model('FunctionAndProcedure_model','profunccon');
         }

         public function login(){

            header('Content-Type: application/json');
            
            $this->form_validation->set_rules('username', 'username', 'required');
            $this->form_validation->set_rules('user_password', 'password', 'required');
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
                }else{

                $username = $this->input->post('username');
                $pass = $this->input->post('user_password');

                $outMsg = $this->profunccon->userSigninCredential(['username'=>$username]);
                if($outMsg['MSG'] == 'Y'){
                    if($pass == $this->encryption->decrypt($outMsg['PASSWORD_IN'])){
                        $this->config->set_item('sess_user_id', $outMsg['ID_IN']);
                        $sessionData = array(
                                                "userId" =>$outMsg['ID_IN'],
                                                "login" =>true
                                            );
                        $this->session->set_userdata($sessionData);
                        $err = 'false';
                   
                        $mainUrl = base_url('dashboard');
                   
                        
                        $omsg = "<script>window.location.replace('{$mainUrl}');</script>";
                        $omsg .= 'success';
                    }else{
                        $err = 'true';
                        $omsg = 'Password invalid';
                    }
                }else{
                    $err = 'true';
                    $omsg = 'Username and Password invalid';
                }

                echo json_encode(array("multi"=>"false","err"=>$err,"msg"=>$omsg));
            }
        }

        public function empLoopInsert(){
            $Dets = $this->unicon->CoreQuery("SELECT * FROM EMPLOYEE",'result');
            
            foreach ($Dets as $Det) {
                $passRand = rand(10000,99999);
                $dataSignUpArr = array(
                                        "USERNAME_P" =>$Det->EMP_CODE,
                                        "EMAIL_P" =>$Det->EMP_E_MAIL1,
                                        "NAME_P" =>$Det->EMP_NAME1,
                                        "PHONE_P" =>$Det->EMP_PHONE1,
                                        "PASSWORD_P" =>$this->encryption->encrypt($passRand),
                                        "USER_TYPE_P" =>'USER',
                                );

                $TY = $this->profunccon->userSignUp($dataSignUpArr);
                if($TY['MSG'] == 'Y'){
                    $this->unicon->CoreQuery("UPDATE EMPLOYEE SET EMP_NOTES = '$passRand' WHERE EMP_ID = '{$Det->EMP_ID}' ");
                }else{
                    $this->unicon->CoreQuery("UPDATE EMPLOYEE SET EMP_NOTES = '{$TY['MSG']}' WHERE EMP_ID = '{$Det->EMP_ID}' ");
                }
            }
        }
    }