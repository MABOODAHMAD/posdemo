<?php
     class Item extends CI_Controller{
         public function __construct(){
            parent::__construct();
      
            // $this->load->model('Site_model', 'dbcon');
            // $this->load->model('Universal_model','unicon');
            // $this->load->library('form_validation');
            // $this->load->helper('form');
            //$this->load->model('QrController','qrcon');
         }

         public function add(){

            header('Content-Type: application/json');

            $this->form_validation->set_rules('productname', 'Menu Name', 'required');
            $this->form_validation->set_rules('manufacturername', 'Parent Menu Name', 'required');
            $this->form_validation->set_rules('manufacturerbrand', 'Select option', 'required');
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $cName = $this->input->post('cName');
                $pName = $this->input->post('child1');
                $data = [
                    "NAME"=>$cName,
                    "SLUG"=>$this->spaceToDash($cName),
                    "SUB_MENU_REF_ID"=>$pName
                ];
                if($this->unicon->insertUniversal('UNDER_SUB_MENU_MASTER',$data)){
                
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
              
                
                }else{

                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }
        }

    }