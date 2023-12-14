<?php
class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sessionCheck();
        $this->load->model('Universal_model', 'unicon');
    }

    /*================== CREATE ROLE GROUP =================*/
    public function roleGrp(){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        header('Content-Type: application/json');

        $updateGrpRole = $this->input->post('update_group_role_db');

        $this->form_validation->set_rules('RG_BUS_UNIT', 'Business unit', 'required');
        if (!$updateGrpRole) {
 
            $this->form_validation->set_rules('RG_NAME', 'group role', 'required|unique_code_db[ROLE_GROUP.RG_NAME.Role group Name already used, Please choose a different one]');

        }
        $this->form_validation->set_rules('RG_ASSIGN', 'Select option', 'required');
        // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            if ($updateGrpRole) {
               $this->unicon->CoreQuery("DELETE FROM ROLE_GROUP WHERE RG_NAME = '".$this->input->post('RG_NAME')."'");
            }
            
            $data = [
                "RG_BUS_UNIT"=>$this->input->post('RG_BUS_UNIT'),
                "RG_NAME"=>$this->input->post('RG_NAME'),
                "RG_ASSIGN"=>$this->input->post('RG_ASSIGN'),
                "RG_CRE_DATE"=>$curDateTime,
                "RG_CRE_BY"=>$userCon->USERNAME,
            ];
            if($this->unicon->insertUniversal('ROLE_GROUP',$data)){
            
            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
          
            
            }else{

            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

            }
        }
    }
    /*================== USER ROLE ASSIGN =================*/
    
    
    public function userRoleAssign(){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        header('Content-Type: application/json');
            $asnRole = $this->input->post('role_assign_code_db');
            $empCode = $this->input->post('emp_code_db');
            $batch = rand(10000,99999);
            $empCodeArrF = [];
            foreach ($asnRole as $key => $value) {
                # code...
                if($value){

                    $data = [
                        "RAU_BATCH_CODE"=>$batch,
                        "RAU_EMP_CODE"=>$empCode[$key],
                        "RAU_ROLE_CODE"=>$value,
                        "RAU_CRE_DATE"=>$curDateTime,
                        "RAU_CRE_BY"=>$userCon->USERNAME,
                    ];
                    $this->unicon->CoreQuery("DELETE FROM ROLE_ASSIGN_USER WHERE RAU_EMP_CODE = '{$data['RAU_EMP_CODE']}' ORDER BY RAU_ID");
                    $res = $this->unicon->insertUniversal('ROLE_ASSIGN_USER',$data);
                }else{
                    $res = false;
                    $empCodeArr[] = $empCode[$key];
                }
            }
            
            if($res){
               
            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
          
            
            }else{

            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"There are no roles assigned to these employees.  ".implode(",",$empCodeArr)));

            }
        
    }

    /*================== ROLE GROUP LIST VIEW =================*/
    
    public function roleGrpListJson(){
        // $itemCode = $this->input->post('item_code');

        $filterdata = array(
            "column_order" => array(NULL,'RG_BUS_UNIT','RG_NAME',NULL,'RG_STATUS','RG_CRE_BY',NULL),
            "column_search" => array('RG_BUS_UNIT','RG_NAME','RG_STATUS','RG_CRE_BY'),
            "order" => array('RG_ID' => 'DESC')
        );

        $sqlQueryTemp = array(

            "SELECT"=>'*',
            "FROM"=>'ROLE_GROUP',

            "JOIN_1_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                "JOIN_1_TABLE_NAME"=>'TRAIT_CATEGORY',
                "JOIN_1_TABLE_CONN"=>'TRAIT_CATEGORY.TC_CODE=ITEM_TRAITS.ITM_TRAIT_CAT_CODE',

            "JOIN_2_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                "JOIN_2_TABLE_NAME"=>'TRAIT_SUB_CATEGORY',
                "JOIN_2_TABLE_CONN"=>'TRAIT_SUB_CATEGORY.TRAIT_CAT_ID=ITEM_TRAITS.ITM_TRAIT_CAT_CODE AND TRAIT_SUB_CATEGORY.TRAIT_SUB_CAT_CODE=ITEM_TRAITS.ITM_TRAIT_CODE',
            
            "WHERE_1_CONTROL"=>FALSE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                "WHERE_1_COL_NAME"=>'ITEM_TRAITS.ITM_CODE',
                "WHERE_1_DATA"=>'',
        );
        

        
        
        $sqlQuery = datatableSqlData($sqlQueryTemp);

        $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

        $data = array();
        $no = $this->input->post('start');
        foreach ($memData as $rowdata) {
            $no++; $row = array();
            // $itemCodeEncrpt = dataEncypt($rowdata->I_CODE,'encrypt');
            // $itemCodeBak = dataEncyptManual($rowdata->I_CODE, 'encrypt');
            $row[] = $no.".";
        
            $row[] = $rowdata->RG_BUS_UNIT;
            $row[] = $rowdata->RG_NAME;
            $row[] = "<button data-rgasign='{$rowdata->RG_ASSIGN}' data-id='{$rowdata->RG_NAME}' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='#standard_model' onClick='viewRoleDet(this)'>View list</button>";
            $row[] = $rowdata->RG_STATUS;
            $row[] = $rowdata->RG_CRE_BY;
            $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                        <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                            <a href='#' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                        </li>
                    </ul>";
            $data[] = $row;
        }
        $output = array(
            "draw" => empty($this->input->post('draw')) ? 'none' : $this->input->post('draw'),
            "recordsTotal" => $this->datatableCon->countAll($sqlQuery),
            "recordsFiltered" => $this->datatableCon->countFiltered($_POST,$sqlQuery),
            "data" => $data
        );
        //output to json format
        header('Content-Type: application/json');
        echo json_encode($output);
    }

    /*================== USER ROLE ASSIGN LIST VIEW =================*/
    
    public function userAssignListJson(){
        // $itemCode = $this->input->post('item_code');

        $filterdata = array(
            "column_order" => array(NULL,'RAU_BATCH_CODE','RAU_EMP_CODE','RAU_ROLE_CODE','RAU_STATUS','RAU_CRE_BY',NULL),
            "column_search" => array('RAU_BATCH_CODE','RAU_EMP_CODE','RAU_ROLE_CODE','RAU_STATUS','RAU_CRE_BY','EMP_NAME1'),
            "order" => array('RAU_ID' => 'DESC')
        );

        $sqlQueryTemp = array(

            "SELECT"=>'*',
            "FROM"=>'ROLE_ASSIGN_USER',

            "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                "JOIN_1_TABLE_NAME"=>'EMPLOYEE',
                "JOIN_1_TABLE_CONN"=>'EMPLOYEE.EMP_CODE=ROLE_ASSIGN_USER.RAU_EMP_CODE',

            "JOIN_2_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                "JOIN_2_TABLE_NAME"=>'USERS',
                "JOIN_2_TABLE_CONN"=>'USERS.USERNAME = ROLE_ASSIGN_USER.RAU_CRE_BY',
            
            "WHERE_1_CONTROL"=>FALSE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                "WHERE_1_COL_NAME"=>'ITEM_TRAITS.ITM_CODE',
                "WHERE_1_DATA"=>'',
        );
        
        $sqlQuery = datatableSqlData($sqlQueryTemp);

        $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

        $data = array();
        $no = $this->input->post('start');
        foreach ($memData as $rowdata) {
            $no++; $row = array();
            // $itemCodeEncrpt = dataEncypt($rowdata->I_CODE,'encrypt');
            // $itemCodeBak = dataEncyptManual($rowdata->I_CODE, 'encrypt');
            $row[] = $no.".";
            $row[] = $rowdata->RAU_BATCH_CODE;
            $row[] = "{$rowdata->RAU_EMP_CODE}-{$rowdata->EMP_NAME1}";
            $row[] = "<button data-id='{$rowdata->RAU_ROLE_CODE}' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='#standard_model' onClick='viewRoleDet(this)'>{$rowdata->RAU_ROLE_CODE}</button>";
            $row[] = $rowdata->RAU_STATUS;
            $row[] = "{$rowdata->USERNAME}-{$rowdata->NAME}";
            $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                        <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                            <a href='#' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                        </li>
                    </ul>";
            $data[] = $row;
        }
        $output = array(
            "draw" => empty($this->input->post('draw')) ? 'none' : $this->input->post('draw'),
            "recordsTotal" => $this->datatableCon->countAll($sqlQuery),
            "recordsFiltered" => $this->datatableCon->countFiltered($_POST,$sqlQuery),
            "data" => $data
        );
        //output to json format
        header('Content-Type: application/json');
        echo json_encode($output);
    }
    
}