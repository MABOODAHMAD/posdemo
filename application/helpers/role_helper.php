<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('dashRole'))
{
    function dashRole($data = array()){
        $CI =get_instance();
        $CI->load->library('session');
        $sessionData = $CI->session->userdata();
        $CI->load->model('universal_model');

        $sesData = sessionUserData();
            if($sesData->USER_TYPE == 'USER'){
                if (isset($data['role_check'])) {
                  
                    if($CI->universal_model->CoreQuery("SELECT * FROM MODULE_AND_FUNCTION WHERE MAF_NAME = '{$data['role_check']}' AND MAF_STATUS ='Y'","num_rows") == 1){
                        $where = "AND RG_ASSIGN LIKE '%{$data['role_check']}%'";
                    }else{
                        // redirect(base_url("module_maintenance"),'refresh');
                    }
                }else{
                    $where = null;
                }
                
                
                $dataF = assignRoleBreak(["role_val"=>isset($data['role_check'])?$data['role_check']:null]);

                // $data = $CI->universal_model->CoreQuery("SELECT * FROM ROLE_ASSIGN_USER,ROLE_GROUP 
                //                                 WHERE RG_NAME = RAU_ROLE_CODE AND RAU_EMP_CODE = '{$sesData->USERNAME}'
                //                                 AND RAU_STATUS = 'Y' AND RG_STATUS = 'Y' $where","row");
                if($dataF['user_role_assign']){
                    $data = $dataF['role_check_p'];
                }else{
                    if($where){
                        $data = false;
                    }else{
                        $data = 'Role_Assign';
                        redirect(base_url("not_found"),'refresh');
                    }
                }
                // $where = isset($data['where'])?$data['where']:null;
                // $data =  $CI->universal_model->CoreQuery("SELECT * FROM CUSTOMER $where","{$data['dataType']}");
            }
            
        return $data;
    }
}

if(!function_exists('assignRoleBreak'))
{
    function assignRoleBreak($dataP = array()){
        $CI =get_instance();
        $sesData = sessionUserData();
        $CI->load->model('universal_model');
        $data = $CI->universal_model->CoreQuery("SELECT * FROM ROLE_ASSIGN_USER,ROLE_GROUP 
                                                WHERE RG_NAME = RAU_ROLE_CODE AND RAU_EMP_CODE = '{$sesData->USERNAME}'
                                                AND RAU_STATUS = 'Y' AND RG_STATUS = 'Y'","row");
        $dataR = false;
        $userRoleAssign = false;
        $whseAssign = false;
        if($data){
            $userRoleAssign = true;
            $dataF = explode(",",$data->RG_ASSIGN);
            
            if(isset($dataP['role_val'])){
                foreach($dataF as $get){
                    if($get == $dataP['role_val']){
                        $dataR = true;
                    }
                }
            }
            

            $whseAssign = $CI->universal_model->CoreQuery("SELECT * FROM SALES_PERSON,SALES_MAN_ASSIGN_WHSE 
                                                    WHERE SLSP_CODE = SMSW_SLSP_CODE AND SLSP_EMPLOYEE_CODE = '{$sesData->USERNAME}'","result");
            
        }
        return array("user_role_assign"=>$userRoleAssign,"role_check_p"=>$dataR,"whse_assign"=>$whseAssign);
    }
}

