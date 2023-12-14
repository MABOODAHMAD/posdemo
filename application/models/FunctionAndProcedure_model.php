<?php 

   Class FunctionAndProcedure_model extends CI_model{

       public function __Construct(){
            $this->load->database();
            $this->load->model('Universal_model','unicon');
       }
    public function insertSaleOrderItems($data)
        {
            $stored_procedure = "CALL SALE_ORDER_ITEM_INSERT(?,?,?,?,?,?,?,?,?,?,?,?,?,?,@MSG)";
            $query = $this->db->query($stored_procedure,$data);
            if($query){
                mysqli_next_result( $this->db->conn_id );
                return $query->row_array();
            }else{
                $errorData = $this->db->error();
                $userCon = sessionUserData();
                $errDataArr = array(
                        "ELF_ERROR_CODE" =>$errorData['code'],
                        "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                        "ELF_WEB_CONT" =>current_url(),
                        "ELF_CRE_DATE" =>dateTime(),
                        "ELF_CRE_BY" => $userCon->USERNAME,
                      );
                $this->unicon->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
                return false;
            }
        }
        
    public function insertSaleOrder($data)
        {
            $stored_procedure = "CALL SALE_ORDER_INSERT(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@MSG)";
            $query = $this->db->query($stored_procedure,$data);
            if($query){
                mysqli_next_result( $this->db->conn_id );
                return $query->row_array();
            }else{
                $errorData = $this->db->error();
                $userCon = sessionUserData();
                $errDataArr = array(
                        "ELF_ERROR_CODE" =>$errorData['code'],
                        "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                        "ELF_WEB_CONT" =>current_url(),
                        "ELF_CRE_DATE" =>dateTime(),
                        "ELF_CRE_BY" => $userCon->USERNAME,
                      );
                $this->unicon->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
                return false;
            }
        }
    
    public function insertUserDetails($data)
    {
        $stored_procedure = "CALL USER_ACCOUNT_DETAILS_ADD(?,?,?,?,?,?,?,?,?,?,?,@MSG)";
        $query = $this->db->query($stored_procedure,$data);
        if($query){
            mysqli_next_result( $this->db->conn_id );
            return $query->row_array();
        }else{
            $errorData = $this->db->error();
            $userCon = sessionUserData();
            $errDataArr = array(
                    "ELF_ERROR_CODE" =>$errorData['code'],
                    "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                    "ELF_WEB_CONT" =>current_url(),
                    "ELF_CRE_DATE" =>dateTime(),
                    "ELF_CRE_BY" => $userCon->USERNAME,
                  );
            $this->unicon->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
            return false;
        }
    }

    public function ResetPassword($data)
    {
        $stored_procedure = "CALL PASSWORD_RESET(?,?,?,?,?,@MSG)";
        $query = $this->db->query($stored_procedure,$data);
        if($query){
            mysqli_next_result( $this->db->conn_id );
            return $query->row_array();
        }else{
            $errorData = $this->db->error();
            $userCon = sessionUserData();
            $errDataArr = array(
                    "ELF_ERROR_CODE" =>$errorData['code'],
                    "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                    "ELF_WEB_CONT" =>current_url(),
                    "ELF_CRE_DATE" =>dateTime(),
                    "ELF_CRE_BY" => $userCon->USERNAME,
                  );
            $this->unicon->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
            return false;
        }
    }

    public function userSigninCredential($data)
    {
        $stored_procedure = "CALL SIGNIN_USER(?,@MSG)";
        $query = $this->db->query($stored_procedure,$data);
        if($query){
            mysqli_next_result( $this->db->conn_id );
            return $query->row_array();
        }else{
            $errorData = $this->db->error();
            $userCon = sessionUserData();
            $errDataArr = array(
                    "ELF_ERROR_CODE" =>$errorData['code'],
                    "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                    "ELF_WEB_CONT" =>current_url(),
                    "ELF_CRE_DATE" =>dateTime(),
                    "ELF_CRE_BY" => $userCon->USERNAME,
                  );
            $this->unicon->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
            return false;
        }
    }

    public function userSignUp($data)
    {
        $stored_procedure = "CALL SIGNIN_ADD(?,?,?,?,?,?,@MSG)";
        $query = $this->db->query($stored_procedure,$data);
        if($query){
            mysqli_next_result( $this->db->conn_id );
            return $query->row_array();
        }else{
            $errorData = $this->db->error();
            $userCon = sessionUserData();
            $errDataArr = array(
                    "ELF_ERROR_CODE" =>$errorData['code'],
                    "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                    "ELF_WEB_CONT" =>current_url(),
                    "ELF_CRE_DATE" =>dateTime(),
                    "ELF_CRE_BY" => $userCon->USERNAME,
                  );
            $this->unicon->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
            return false;
        }
    }

    public function userProfileUp($data)
    {
        $stored_procedure = "CALL USER_PROFILE_UPDATE(?,?,?,?,?,@MSG)";
        $query = $this->db->query($stored_procedure,$data);
        if($query){
            mysqli_next_result( $this->db->conn_id );
            return $query->row_array();
        }else{
            $errorData = $this->db->error();
            $userCon = sessionUserData();
            $errDataArr = array(
                    "ELF_ERROR_CODE" =>$errorData['code'],
                    "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                    "ELF_WEB_CONT" =>current_url(),
                    "ELF_CRE_DATE" =>dateTime(),
                    "ELF_CRE_BY" => $userCon->USERNAME,
                  );
            $this->unicon->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
            return false;
        }
    }

    public function poHeaderCre($data){
        $stored_procedure = "CALL PO_HEADER_CRE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,@MSG)";
        $query = $this->db->query($stored_procedure,$data);
        if($query){
            mysqli_next_result( $this->db->conn_id );
            return $query->row_array();
        }else{
            $errorData = $this->db->error();
            $userCon = sessionUserData();
            $errDataArr = array(
                    "ELF_ERROR_CODE" =>$errorData['code'],
                    "ELF_ERROR_CODE_DESC" =>$errorData['message'],
                    "ELF_WEB_CONT" =>current_url(),
                    "ELF_CRE_DATE" =>dateTime(),
                    "ELF_CRE_BY" => $userCon->USERNAME,
                  );
            $this->unicon->insertUniversal("ERROR_LOG_FRONTEND",$errDataArr);
            return false;
        }
    }
    
}

