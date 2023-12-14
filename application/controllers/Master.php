<?php
     class Master extends CI_Controller{
         public function __construct(){
            parent::__construct();
      
            // $this->load->model('Site_model', 'dbcon');
            $this->load->model('Universal_model','unicon');
            // $this->load->library('form_validation');
            // $this->load->helper('form');
            //$this->load->model('QrController','qrcon');
            $this->load->model('FunctionAndProcedure_model','profunccon');
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

        // Country

        public function countryAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $contryId = $this->input->post('CONTRY_CODE');
            $countryCodeUp = $this->input->post('country_code_db');
              
            if($contryId && !$countryCodeUp){
                $this->form_validation->set_rules('CONTRY_CODE', 'unique code', 'unique_code_db[COUNTRIES.CNTRY_CODE.Country Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('contry_name', 'Country Name', 'required|alpha_space');
            $this->form_validation->set_rules('contry_abbra', 'Country Abbraviation', 'required');
            $this->form_validation->set_rules('currcy_id', 'Select currency', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            "CNTRY_CODE"=>empty($contryId)?insertUniqueCode('CONTRY_CODE'):$contryId,
                            "CNTRY_NAME"=>$this->input->post('contry_name'),
                            "CNTRY_ABBRV"=>$this->input->post('contry_abbra'),
                            "CNTRY_CURRENCY"=>$this->input->post('currcy_id'),
                            "CNTRY_CRE_BY"=>$userCon->USERNAME,
                        );
                        
                $tableName = "COUNTRIES";
                
                if($countryCodeUp){
                        if($this->unicon->updateArrayUniversal($tableName,$data,"CNTRY_CODE = '$countryCodeUp'")>0){
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                        }else{
                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                        }
                }else{
                    $data['CNTRY_CODE'] = empty($contryId)?insertUniqueCode('CNTRY_CODE'):$contryId;
                            if($this->unicon->insertUniversal($tableName,$data)){
                                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                            }else{
                                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                            }
                }
            }
        }

        public function countryListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'CNTRY_CODE','CNTRY_NAME','CNTRY_ABBRV','CNTRY_CURRENCY',NULL),
                "column_search" => array('CNTRY_CODE','CNTRY_NAME','CNTRY_ABBRV','CNTRY_CURRENCY'),
                "order" => array('CT.CNTRY_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'COUNTRIES AS CT',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'CURRENCY as CR',
                    "JOIN_1_TABLE_CONN"=>'CR.CUR_CODE=CT.CNTRY_CURRENCY',
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $ttype = $this->input->post('saletype')=="invoice"?'saleinvoice':'saleorder';
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $CuntyCode = dataEncyptbase64($rowdata->CNTRY_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->CNTRY_CODE;
                $row[] = $rowdata->CNTRY_NAME;
                $row[] = $rowdata->CNTRY_ABBRV;
                $row[] = $rowdata->CUR_NAME;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            
                             <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('CountryList?tokenid=').$CuntyCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                            
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // State

        public function stateAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $stateId = $this->input->post('ST_CODE');
            $StateCodeUp = $this->input->post('state_code_db');
            if($stateId && !$StateCodeUp){
                $this->form_validation->set_rules('ST_CODE', 'unique code', 'unique_code_db[STATES.ST_CODE.State Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('ST_NAME', 'State Name', 'required|alpha_space');
            $this->form_validation->set_rules('ST_NAME_AR', 'State name arabic', 'required');
            $this->form_validation->set_rules('ST_ABBRV', 'State Abbraviation', 'required');
            $this->form_validation->set_rules('ST_CONTRY_ID', 'Select currency', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            "ST_CODE"=>empty($stateId)?insertUniqueCode('ST_CODE'):$stateId,
                            "ST_NAME"=>$this->input->post('ST_NAME'),
                            "ST_NAME_AR"=>$this->input->post('ST_NAME_AR'),
                            "ST_DESC"=>$this->input->post('ST_DESC'),
                            "ST_ABBRV"=>$this->input->post('ST_ABBRV'),
                            "ST_CNTRY_ID"=>$this->input->post('ST_CONTRY_ID'),
                            "ST_CRE_BY"=>$userCon->USERNAME,
                        );
                        
                        $tableName = "STATES";
                
                        if($StateCodeUp){
                              if($this->unicon->updateArrayUniversal($tableName,$data,"ST_CODE = '$StateCodeUp'")>0){
                                  echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                              }else{
                                  echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                              }
                        }else{
                            $data['ST_CODE'] = empty($stateId)?insertUniqueCode('ST_CODE'):$stateId;
                                  if($this->unicon->insertUniversal($tableName,$data)){
                                      echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                                  }else{
                                      echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                                  }
                        }
            }
        }

        public function stateListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'ST_CODE'.'ST_NAME','ST_ABBRV','ST_CNTRY_ID',NULL),
                "column_search" => array('ST_CODE'.'ST_NAME','ST_ABBRV','ST_CNTRY_ID'),
                "order" => array('ST_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'STATES AS S',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'COUNTRIES as CT',
                    "JOIN_1_TABLE_CONN"=>'CT.CNTRY_CODE=S.ST_CNTRY_ID',
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $ttype = $this->input->post('saletype')=="invoice"?'saleinvoice':'saleorder';

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $StateCode = dataEncyptbase64($rowdata->ST_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->ST_CODE;
                $row[] = $rowdata->ST_NAME;
                $row[] = $rowdata->ST_ABBRV;
                $row[] = $rowdata->CNTRY_NAME;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('stateList?tokenid=').$StateCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // City

        public function cityAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $cityCode = $this->input->post('CITY_CODE');
            $CityCodeUp = $this->input->post('City_code_db');
            if($cityCode && !$CityCodeUp){
                $this->form_validation->set_rules('CITY_CODE', 'unique code', 'unique_code_db[CITIES.CTY_CODE.City Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('CTY_NAME', 'Country Name', 'required');
            $this->form_validation->set_rules('ST_CODE', 'Select state', 'required');
            $this->form_validation->set_rules('CITY_NAME_AR', 'Country Abbraviation', 'required');
            $this->form_validation->set_rules('CTY_ABBRV', 'Select currency', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            //"CTY_CODE"=>empty($cityCode)?insertUniqueCode('CITY_CODE'):$cityCode,
                            "CTY_NAME"=>$this->input->post('CTY_NAME'),
                            "CTY_NAME_AR"=>$this->input->post('CITY_NAME_AR'),
                            "CTY_ABBRV"=>$this->input->post('CTY_ABBRV'),
                            "CTY_STATE_CODE"=>$this->input->post('ST_CODE'),
                            "CTY_DESC"=>empty($this->input->post('CTY_DESC'))?'N/A':$this->input->post('CTY_DESC'),
                            "CTY_CRE_BY"=>$userCon->USERNAME,
                        );
                $tableName = "CITIES";
        
                if($CityCodeUp){
                    
                        if($this->unicon->updateArrayUniversal($tableName,$data,"CTY_CODE = '$CityCodeUp'")>0){
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                        }else{
                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                        }
                }else{
                    
                    $data['CTY_CODE'] = empty($cityCode)?insertUniqueCode('CTY_CODE'):$cityCode;
                            if($this->unicon->insertUniversal($tableName,$data)){
                                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                            }else{
                                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                            }
                }
            }
        }

        public function cityListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'CTY_CODE'.'CTY_NAME','CTY_NAME_AR','CTY_ABBRV','CTY_DESC',NULL),
                "column_search" => array('CTY_CODE'.'CTY_NAME','CTY_NAME_AR','CTY_ABBRV','CTY_DESC'),
                "order" => array('CTY_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'CITIES AS CTY',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'STATES as ST',
                    "JOIN_1_TABLE_CONN"=>'ST.ST_CODE=CTY.CTY_STATE_CODE',
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $CityCode = dataEncyptbase64($rowdata->CTY_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->CTY_CODE;
                $row[] = $rowdata->CTY_NAME;
                $row[] = $rowdata->CTY_ABBRV;
                $row[] = $rowdata->ST_NAME;
                $row[] = $rowdata->CTY_DESC;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('CityList?tokenid=').$CityCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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
        
        
        
        // Generate Password

        public function PassAdd(){
           
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            
            $this->form_validation->set_rules('type', 'Password Type', 'required');
            $this->form_validation->set_rules('qty', 'Enter QTY', 'required|numeric');
            $this->form_validation->set_rules('MDP_BUS_UNIT', 'Business unit', 'required');
            $typepass =  explode("-",$this->input->post('type'));
            
            if ($typepass[1] == 'DISCOUNT') {
                $this->form_validation->set_rules('MDP_GEN_DISC', 'discount', 'required|numeric|max_length[2]');
            }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $qtypass =  $this->input->post('qty');
                //print_r($qtypass);
                
                for ($i=0; $i <$qtypass ; $i++) { 
                    $temp_order_id = random_strings(12,'N');
                    //print_r($temp_order_id);
                     $data = array(
                            "MDP_USER"=>$typepass[0],
                            "MDP_PWD"=>$temp_order_id,
                            "MDP_BUS_UNIT"=>$this->input->post('MDP_BUS_UNIT'),
                            "MDP_GEN_DISC"=>$this->input->post('MDP_GEN_DISC'),
                            "MDP_TYPE"=>$typepass[1],
                            "MDP_SEQ" => insertUniqueCode('MDP_SEQ'),
                            "MDP_CRE_DATE" => dateTime(),
                            "MDP_CRE_BY" =>$userCon->USERNAME,
                        );
                       $passins =  $this->unicon->insertUniversal('GENERATE_PASS',$data);
                }
                
                if($passins){
                
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
              
                
                }else{

                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }
        }

        public function passListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'MDP_SEQ','MDP_USER','MDP_PWD','MDP_TYPE','MDP_GEN_DISC',NULL),
                "column_search" => array('MDP_SEQ','MDP_USER','MDP_PWD','MDP_TYPE','MDP_GEN_DISC'),
                "order" => array('MDP_ID' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'GENERATE_PASS',

                "JOIN_1_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'STATES as ST',
                    "JOIN_1_TABLE_CONN"=>'ST.ST_CODE=CTY.CTY_STATE_CODE',
                    
                "WHERE_1_CONTROL"=>FALSE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "WHERE_1_COL_NAME"=>'MDP_STATUS',
                    "WHERE_1_DATA"=>'0',
                
                "CORE_WHERE_1_CONTROL"=>TRUE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    // "CORE_WHERE_1_DATA"=>"MDP_STATUS='0' AND MDP_ORDER_CLS='C' ",
                    "CORE_WHERE_1_DATA"=>"MDP_STATUS='0'",
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $row[] = $no.".";
                $row[] = $rowdata->MDP_SEQ;
                $row[] = $rowdata->MDP_USER;
                $row[] = $rowdata->MDP_PWD;
                if($rowdata->MDP_TYPE== 'CREDIT')
                {
                    $CLS ='<span class="badge badge-soft-danger me-1"><i class="bx bx-trending-down align-bottom me-1"></i> Credit</span>';
                    
                }
                elseif($rowdata->MDP_TYPE== 'DISCOUNT')
                {
                    $CLS ='<span class="badge badge-soft-success me-1"><i class="bx bx-trending-up align-bottom me-1"></i> Discount</span>';
                    
                }else {
                    $CLS ='<span class="badge badge-soft-primary me-1"><i class="bx bx-trending-up align-bottom me-1"></i>Sale Return</span>';
                }
                $row[] = $CLS;
                $row[] = $rowdata->MDP_NOTE;
                $row[] = $rowdata->MDP_GEN_DISC;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='#' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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
        
        public function passusedListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'CTY_CODE'.'CTY_NAME','CTY_NAME_AR','CTY_ABBRV','CTY_DESC',NULL),
                "column_search" => array('CTY_CODE'.'CTY_NAME','CTY_NAME_AR','CTY_ABBRV','CTY_DESC'),
                "order" => array('MDP_ID' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'GeneratePass',

                "JOIN_1_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'STATES as ST',
                    "JOIN_1_TABLE_CONN"=>'ST.ST_CODE=CTY.CTY_STATE_CODE',
                    
                "WHERE_1_CONTROL"=>TRUE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "WHERE_1_COL_NAME"=>'MDP_STATUS',
                    "WHERE_1_DATA"=>'1',
               
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $ttype = $this->input->post('saletype')=="invoice"?'saleinvoice':'saleorder';
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $row[] = $no.".";
                $row[] = $rowdata->MDP_SEQ;
                $row[] = $rowdata->MDP_USER;
                $row[] = $rowdata->MDP_PWD;
                $row[] = $rowdata->MDP_ORDER_PFX;
                $row[] = $rowdata->MDP_ORDER_CLS;
                $row[] = $rowdata->MDP_ORDER_SFX;
                $row[] = $rowdata->MDP_ORDER_NO;
                $row[] = $rowdata->MDP_ORDER_DISC_PCT;
               if($rowdata->MDP_TYPE== 'Credit')
                {
                    $CLS ='<span class="badge badge-soft-danger me-1"><i class="bx bx-trending-down align-bottom me-1"></i> Credit</span>';
                    
                }
                else
                {
                    $CLS ='<span class="badge badge-soft-success me-1"><i class="bx bx-trending-up align-bottom me-1"></i> Discount</span>';
                    
                }
                $row[] = $CLS;
                $row[] = $rowdata->MDP_CRE_DATE;
                $row[] = $rowdata->MDP_USE_DATE;
                
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='#' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // Currency

        public function currencyAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $curId = $this->input->post('CUR_ID');
            $currCodeUp = $this->input->post('curr_code_db');
            if($curId && !$currCodeUp){
                $this->form_validation->set_rules('CUR_ID', 'unique code', 'unique_code_db[CURRENCY.CUR_CODE.Currency Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('CUR_NAME', 'Currency Name', 'required');
            $this->form_validation->set_rules('CUR_NAME_AR', 'Currency Arabic', 'required');
            $this->form_validation->set_rules('CUR_ABBRV', 'Currency abbraviation', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "CUR_CODE"=>empty($curId)?insertUniqueCode('CUR_ID'):$curId,
                            "CUR_NAME"=>$this->input->post('CUR_NAME'),
                            "CUR_NAME_AR"=>$this->input->post('CUR_NAME_AR'),
                            "CUR_ABBRV"=>$this->input->post('CUR_ABBRV'),
                            "CUR_NOTES"=>empty($this->input->post('CUR_NOTES'))?'N/A':$this->input->post('CUR_NOTES'),
                            "CUR_CRE_BY"=>$userCon->USERNAME,
                        );

                if($currCodeUp){
                        if($this->unicon->updateArrayUniversal("CURRENCY",$data,"CUR_CODE = '$currCodeUp'")>0){
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                        }else{
                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                        }
                }else{
                    $data['CUR_CODE'] = empty($curId)?insertUniqueCode('CUR_ID'):$curId;

                    if($this->unicon->insertUniversal('CURRENCY',$data)){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
            }
        }

        public function currencyListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'CUR_CODE'.'CUR_NAME','CUR_ABBRV','CUR_NOTES',NULL),
                "column_search" => array('CUR_CODE'.'CUR_NAME','CUR_ABBRV','CUR_NOTES'),
                "order" => array('CUR_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'CURRENCY'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $ttype = $this->input->post('saletype')=="invoice"?'saleinvoice':'saleorder';
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $currCode = dataEncyptbase64($rowdata->CUR_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->CUR_CODE;
                $row[] = $rowdata->CUR_NAME;
                $row[] = $rowdata->CUR_ABBRV;
                $row[] = $rowdata->CUR_NOTES;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('CurrencyList?tokenid=').$currCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // Trait Category

        public function traitCategoryAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $traitCatId = $this->input->post('TC_CODE');
            $traitCodeUp = $this->input->post('trait_cat_code_db');
            if($traitCatId  && !$traitCodeUp){
                $this->form_validation->set_rules('TC_CODE', 'unique code', 'unique_code_db[TRAIT_CATEGORY.TC_CODE.Trait Category Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('TC_DESC', 'trait category description', 'required');
            $this->form_validation->set_rules('TC_BUS_UNIT', 'Business unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            "TC_CODE"=>empty($traitCatId)?insertUniqueCode('TC_CODE'):$traitCatId,
                            "TC_DESC"=>$this->input->post('TC_DESC'),
                            "TC_BUS_UNIT"=>$this->input->post('TC_BUS_UNIT'),
                            "TC_CRE_BY"=>$userCon->USERNAME,
                        );
                if($traitCodeUp){
                    if($this->unicon->updateArrayUniversal("TRAIT_CATEGORY",$data,"TC_CODE = '$traitCodeUp'")>0){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
            }else{
                $data['TC_CODE'] = empty($traitCatId)?insertUniqueCode('TC_CODE'):$traitCatId;

                if($this->unicon->insertUniversal('TRAIT_CATEGORY',$data)){
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                }else{
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                }
            }


            }
        }

        public function traitCategoryListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'TC_CODE'.'TC_DESC',NULL),
                "column_search" => array('TC_CODE'.'TC_DESC'),
                "order" => array('TC_CRE_DATE' => 'DESC')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'TRAIT_CATEGORY'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $ttype = $this->input->post('saletype')=="invoice"?'saleinvoice':'saleorder';
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $traitCatCode = dataEncyptbase64($rowdata->TC_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->TC_CODE;
                $row[] = $rowdata->TC_DESC;
                // $row[] = $rowdata->CUR_ABBRV;
                // $row[] = $rowdata->CUR_NOTES;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('TraiteCategoryList?tokenid=').$traitCatCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

         // Trait Sub Category

        public function traitSubCategoryAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $traitSubCatCode = $this->input->post('TRAIT_SUB_CAT_CODE');
            $traitCatIdWher = $this->input->post('TRAIT_CAT_ID');
            $traitCodeUp = $this->input->post('trait_code_db');
            if($traitSubCatCode  && !$traitCodeUp){
                $this->form_validation->set_rules('TRAIT_SUB_CAT_CODE', 'unique code', "unique_code_dual_db[{$traitCatIdWher}.TRAIT_SUB_CATEGORY.TRAIT_SUB_CAT_CODE.TRAIT_CAT_ID.Trait Code already used, Please choose a different one]");
            }
            $this->form_validation->set_rules('TRAIT_DESC', 'trait Name description', 'required');
            $this->form_validation->set_rules('TRAIT_CAT_ID', 'Select trait category', 'required');

            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            "TRAIT_SUB_CAT_CODE"=>empty($traitSubCatCode)?insertUniqueCode('TRAIT_SUB_CAT_CODE'):$traitSubCatCode,
                            "TRAIT_DESC"=>$this->input->post('TRAIT_DESC'),
                            "TRAIT_CAT_ID"=>$this->input->post('TRAIT_CAT_ID'),
                            "NOTE"=>empty($this->input->post('NOTE'))?'N/A':$this->input->post('NOTE'),
                            "TSC_CRE_BY"=>$userCon->USERNAME,
                        );
               
                
                        if($traitCodeUp){
                            if($this->unicon->updateArrayUniversal("TRAIT_SUB_CATEGORY",$data,"TRAIT_SUB_CAT_CODE = '$traitCodeUp'")>0){
                                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                            }else{
                                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                            }
                    }else{
                        $data['TRAIT_SUB_CAT_CODE'] = empty($traitSubCatCode)?insertUniqueCode('TRAIT_SUB_CAT_CODE'):$traitSubCatCode;
        
                        if($this->unicon->insertUniversal('TRAIT_SUB_CATEGORY',$data)){
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                        }else{
                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                        }
                    }
                    
            }
        }

        public function traitSubCategoryListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'TRAIT_SUB_CAT_CODE'.'TRAIT_DESC','TRAIT_CAT_ID','NOTE',NULL),
                "column_search" => array('TRAIT_SUB_CAT_CODE'.'TRAIT_DESC','TRAIT_CAT_ID','NOTE'),
                "order" => array('TSC_CRE_DATE' => 'DESC')
            );
            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'TRAIT_SUB_CATEGORY AS TSC',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'TRAIT_CATEGORY as TC',
                    "JOIN_1_TABLE_CONN"=>'TC.TC_CODE=TSC.TRAIT_CAT_ID',
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $ttype = $this->input->post('saletype')=="invoice"?'saleinvoice':'saleorder';
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $traitCode = dataEncyptbase64($rowdata->TRAIT_SUB_CAT_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->TRAIT_SUB_CAT_CODE;
                $row[] = $rowdata->TRAIT_DESC;
                $row[] = $rowdata->TC_DESC;
                $row[] = $rowdata->NOTE;
                // $row[] = $rowdata->CUR_ABBRV;
                // $row[] = $rowdata->CUR_NOTES;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                        <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                          <a href='".base_url('TraitesList?tokenid=').$traitCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                         </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // Item class

        public function itemClassAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $iitemClasCode = $this->input->post('ITEM_CLASS_CODE');
            $iitemClasCat = $this->input->post('IC_ITEM_CAT');
            $itemClassCodeUp = $this->input->post('item_class_code_db');

            if($iitemClasCode && !$itemClassCodeUp){
                $this->form_validation->set_rules('ITEM_CLASS_CODE', 'unique code',"unique_code_dual_db[{$iitemClasCat}.ITEM_CLASSES.IC_CODE.IC_ITEM_CAT.item class Code already used, Please choose a different one]");
            }
            $this->form_validation->set_rules('ITEM_CLASS_NAME', 'Item class Name', 'required');
            $this->form_validation->set_rules('IC_ITEM_CAT', 'item class category', 'required');
            $this->form_validation->set_rules('IC_BUS_UNIT', 'Business unit', 'required');
            $this->form_validation->set_rules('IC_UOM_STOCK', 'UOM', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "IC_CODE"=>empty($iitemClasCode)?insertUniqueCode('IC_CODE'):$iitemClasCode,
                            "IC_DESC"=>$this->input->post('ITEM_CLASS_NAME'),
                            "IC_ITEM_CAT"=>$this->input->post('IC_ITEM_CAT'),
                            "IC_BUS_UNIT"=>$this->input->post('IC_BUS_UNIT'),
                            "IC_UOM_STOCK"=>$this->input->post('IC_UOM_STOCK'),
                            "IC_NOTES"=>empty($this->input->post('ITEM_CLASS_NOTE'))?'N/A':$this->input->post('ITEM_CLASS_NOTE'),
                            "IC_CRE_BY"=>$userCon->USERNAME,
                        );

            if($itemClassCodeUp){
                        if($this->unicon->updateArrayUniversal("ITEM_CLASSES",$data,"IC_CODE = '$itemClassCodeUp'")>0){
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Update Successfully"));
                        }else{
                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                        }
                }else{
                    $data['IC_CODE'] = empty($iitemClasCode)?insertUniqueCode('IC_CODE'):$iitemClasCode;

                    if($this->unicon->insertUniversal('ITEM_CLASSES',$data)){
                    
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                
                    
                    }else{

                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                    }
                }
            }
        }

        public function itemClassListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'IC_CODE','IC_DESC','ICAT_DESC','UOM_DESC','IC_NOTES',NULL),
                "column_search" => array('IC_CODE','IC_DESC','ICAT_DESC','UOM_DESC','IC_NOTES'),
                "order" => array('IC_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'ITEM_CLASSES',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'ITEM_CATEGORY',
                    "JOIN_1_TABLE_CONN"=>'ITEM_CATEGORY.ICAT_CODE=ITEM_CLASSES.IC_ITEM_CAT',

                "JOIN_2_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_2_TABLE_NAME"=>'UNIT_OF_MEASUREMENT',
                    "JOIN_2_TABLE_CONN"=>'UNIT_OF_MEASUREMENT.UOM_CODE=ITEM_CLASSES.IC_UOM_STOCK',
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $ttype = $this->input->post('saletype')=="invoice"?'saleinvoice':'saleorder';
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $itemClassCode = dataEncyptbase64($rowdata->IC_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->IC_CODE;
                $row[] = $rowdata->IC_DESC;
                $row[] = $rowdata->ICAT_DESC;
                $row[] = $rowdata->UOM_DESC;
                $row[] = $rowdata->IC_NOTES;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('ItemClassList?tokenid=').$itemClassCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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


        // Ship Via

        public function ShipviaAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $iitemCatCode = $this->input->post('SHIPV_CODE');
            $shipViaCodeUp = $this->input->post('ship_via_list_db');
            if($iitemCatCode && !$shipViaCodeUp){
                $this->form_validation->set_rules('SHIPV_CODE', 'unique code', 'unique_code_db[SHIP_VIA.SHIPV_CODE.Ship Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('SHIPV_DESC', 'Ship Via description Name', 'required');
            // $this->form_validation->set_rules('IC_NAME_AR', 'item category name arabic', 'required');
            $this->form_validation->set_rules('SHIPV_BUS_UNIT', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "SHIPV_CODE"=>empty($iitemCatCode)?insertUniqueCode('SHIPV_CODE'):$iitemCatCode,
                            "SHIPV_BUS_UNIT"=>$this->input->post('SHIPV_BUS_UNIT'),
                            "SHIPV_DESC"=>empty($this->input->post('SHIPV_DESC'))?'N/A':$this->input->post('SHIPV_DESC'),
                            "SHIPV_CRE_BY"=>$userCon->USERNAME,
                        );

                
                if($shipViaCodeUp){
                    if($this->unicon->updateArrayUniversal("SHIP_VIA",$data,"SHIPV_CODE = '$shipViaCodeUp'")>0){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Update Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }else{
                    $data['SHIPV_CODE'] = empty($iitemCatCode)?insertUniqueCode('SHIPV_CODE'):$iitemCatCode;
                    if($this->unicon->insertUniversal('SHIP_VIA',$data)){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
                
            }
        }

        public function ShipviaListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'SHIPV_CODE','SHIPV_DESC',NULL),
                "column_search" => array('SHIPV_CODE','SHIPV_DESC'),
                "order" => array('SHIPV_CRE_DATE' => 'desc')
            );
            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'SHIP_VIA'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $ttype = $this->input->post('saletype')=="invoice"?'saleinvoice':'saleorder';
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $codeEncode = dataEncyptbase64($rowdata->SHIPV_CODE,'encrypt');
                $row[] = $no.".";
                $row[] = $rowdata->SHIPV_CODE;
                $row[] = $rowdata->SHIPV_DESC;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('ShipList?tokenid=').$codeEncode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
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

         // Ship Via



        // Item Category

        public function itemCategoryAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $iitemCatCode = $this->input->post('IC_CODE');
            $itemCatCodeUp = $this->input->post('item_cat_code_db');

            if($iitemCatCode && !$itemCatCodeUp){
                $this->form_validation->set_rules('IC_CODE', 'unique code', 'unique_code_db[ITEM_CATEGORY.ICAT_CODE.item category Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('IC_DESC', 'Item description Name', 'required');
            // $this->form_validation->set_rules('IC_NAME_AR', 'item category name arabic', 'required');
            $this->form_validation->set_rules('ICAT_BUS_UNIT', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "ICAT_CODE"=>empty($iitemCatCode)?insertUniqueCode('ICAT_CODE'):$iitemCatCode,
                            // "ICAT_NAME"=>$this->input->post('IC_NAME'),
                            // "ICAT_NAME_AR"=>$this->input->post('IC_NAME_AR'),
                            "ICAT_BUS_UNIT"=>$this->input->post('ICAT_BUS_UNIT'),
                            "ICAT_DESC"=>empty($this->input->post('IC_DESC'))?'N/A':$this->input->post('IC_DESC'),
                            "ICAT_CRE_BY"=>$userCon->USERNAME,
                        );

                if($itemCatCodeUp){
                        if($this->unicon->updateArrayUniversal("ITEM_CATEGORY",$data,"ICAT_CODE = '$itemCatCodeUp'")>0){
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Update Successfully"));
                        }else{
                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                        }
                }else{
                    $data['ICAT_CODE'] = empty($iitemCatCode)?insertUniqueCode('ICAT_CODE'):$iitemCatCode;

                    if($this->unicon->insertUniversal('ITEM_CATEGORY',$data)){
                    
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                
                    
                    }else{

                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                    }
                }
            }
        }

        public function itemCategoryListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'ICAT_CODE','ICAT_DESC',NULL),
                "column_search" => array('ICAT_CODE','ICAT_DESC'),
                "order" => array('ICAT_CRE_DATE' => 'desc')
            );
            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'ITEM_CATEGORY'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $ttype = $this->input->post('saletype')=="invoice"?'saleinvoice':'saleorder';
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $itemCatCode = dataEncyptbase64($rowdata->ICAT_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->ICAT_CODE;
                // $row[] = $rowdata->ICAT_NAME;
                $row[] = $rowdata->ICAT_DESC;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('ItemCategoryList?tokenid=').$itemCatCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

         // Item Category

         public function uomAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $iitemCatCode = $this->input->post('UOM_CODE');
            $uomCodeUp = $this->input->post('uom_code_db');
            if($iitemCatCode && !$uomCodeUp){
                $this->form_validation->set_rules('UOM_CODE', 'unique code', 'unique_code_db[UNIT_OF_MEASUREMENT.UOM_CODE.UOM Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('UOM_DESC', 'UOM description', 'required');
            $this->form_validation->set_rules('UOM_BUS_UNIT', 'Business unit', 'required');
            $this->form_validation->set_rules('UOM_PHY_ATTR', 'physical attributes', 'required');
            $this->form_validation->set_rules('UOM_ABBRV', 'UOM abbrivation', 'required');
            // $this->form_validation->set_rules('ICAT_BUS_UNIT', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "UOM_CODE"=>empty($iitemCatCode)?insertUniqueCode('UOM_CODE'):$iitemCatCode,
                            "UOM_BUS_UNIT"=>$this->input->post('UOM_BUS_UNIT'),
                            "UOM_ABBRV"=>$this->input->post('UOM_ABBRV'),
                            "UOM_PHY_ATTR"=>$this->input->post('UOM_PHY_ATTR'),
                            "UOM_DESC"=>$this->input->post('UOM_DESC'),
                            "UOM_NOTE"=>empty($this->input->post('UOM_NOTE'))?'N/A':$this->input->post('UOM_NOTE'),
                            "UOM_CRE_BY"=>$userCon->USERNAME,
                        );
         
                if($uomCodeUp){
                        if($this->unicon->updateArrayUniversal("UNIT_OF_MEASUREMENT",$data,"UOM_CODE = '$uomCodeUp'")>0){
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Update Successfully"));
                        }else{
                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                        }
                }else{
                    $data['UOM_CODE'] = empty($iitemCatCode)?insertUniqueCode('UOM_CODE'):$iitemCatCode;

                    if($this->unicon->insertUniversal('UNIT_OF_MEASUREMENT',$data)){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
            }
        }

        public function uomListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'UOM_DESC','UOM_ABBRV','UOM_NOTE',NULL),
                "column_search" => array('UOM_DESC','UOM_ABBRV','UOM_NOTE'),
                "order" => array('UOM_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'UNIT_OF_MEASUREMENT'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $currCode = dataEncyptbase64($rowdata->UOM_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->UOM_BUS_UNIT;
                $row[] = $rowdata->UOM_CODE;
                $row[] = $rowdata->UOM_DESC;
                $row[] = $rowdata->UOM_PHY_ATTR;
                $row[] = $rowdata->UOM_ABBRV;
                $row[] = $rowdata->UOM_NOTE;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('UOMList?tokenid=').$currCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // Free on Board FOB

        public function fobAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $iitemCatCode = $this->input->post('FOB_CODE');
            $fobCodeUp = $this->input->post('fob_list_db');
            if($iitemCatCode && !$fobCodeUp){
                $this->form_validation->set_rules('FOB_CODE', 'unique code', 'unique_code_db[FOBS.FOB_CODE.Fob Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('FOB_DESC', 'fob description', 'required');
            $this->form_validation->set_rules('FOB_BUS_UNIT', 'Business unit', 'required');
            // $this->form_validation->set_rules('ICAT_BUS_UNIT', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "FOB_CODE"=>empty($iitemCatCode)?insertUniqueCode('FOB_CODE'):$iitemCatCode,
                            // "ICAT_NAME"=>$this->input->post('IC_NAME'),
                            "FOB_BUS_UNIT"=>$this->input->post('FOB_BUS_UNIT'),
                            "FOB_DESC"=>$this->input->post('FOB_DESC'),
                            "FOB_NOTES"=>empty($this->input->post('FOB_NOTES'))?'N/A':$this->input->post('FOB_NOTES'),
                            "FOB_CRE_BY"=>$userCon->USERNAME,
                        );

                if($fobCodeUp){
                    if($this->unicon->updateArrayUniversal("FOBS",$data,"FOB_CODE = '$fobCodeUp'")>0){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Update Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }else{
                    $data['FOB_CODE'] = empty($iitemCatCode)?insertUniqueCode('FOB_CODE'):$iitemCatCode;
                    if($this->unicon->insertUniversal('FOBS',$data)){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                      
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }

                }
                
            }
        }

        public function fobListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'FOB_BUS_UNIT','FOB_CODE','FOB_DESC','FOB_NOTES',NULL),
                "column_search" => array('FOB_BUS_UNIT','FOB_CODE','FOB_DESC','FOB_NOTES'),
                "order" => array('FOB_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'FOBS'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $codeEncode = dataEncyptbase64($rowdata->FOB_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->FOB_BUS_UNIT;
                $row[] = $rowdata->FOB_CODE;
                $row[] = $rowdata->FOB_DESC;
                $row[] = $rowdata->FOB_NOTES;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('FOBList?tokenid=').$codeEncode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // Freight

        public function freightAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $iitemCatCode = $this->input->post('FRT_CODE');
            $freightCodeUp = $this->input->post('fright_list_db');
            if($iitemCatCode && !$freightCodeUp){
                $this->form_validation->set_rules('FRT_CODE', 'unique code', 'unique_code_db[FREIGHTS.FRT_CODE.freight Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('FRT_DESC', 'Freight description', 'required');
            $this->form_validation->set_rules('FRT_BUS_UNIT', 'Business unit', 'required');
            // $this->form_validation->set_rules('ICAT_BUS_UNIT', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "FRT_CODE"=>empty($iitemCatCode)?insertUniqueCode('FRT_CODE'):$iitemCatCode,
                            // "ICAT_NAME"=>$this->input->post('IC_NAME'),
                            "FRT_BUS_UNIT"=>$this->input->post('FRT_BUS_UNIT'),
                            "FRT_DESC"=>$this->input->post('FRT_DESC'),
                            "FRT_NOTES"=>empty($this->input->post('FRT_NOTES'))?'N/A':$this->input->post('FRT_NOTES'),
                            "FRT_CRE_BY"=>$userCon->USERNAME,
                        );

                if($freightCodeUp){
                        if($this->unicon->updateArrayUniversal("FREIGHTS",$data,"FRT_CODE = '$freightCodeUp'")>0){
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Update Successfully"));
                        }else{
                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                        }
                }else{
                    $data['FRT_CODE'] = empty($iitemCatCode)?insertUniqueCode('FRT_CODE'):$iitemCatCode;
                    if($this->unicon->insertUniversal('FREIGHTS',$data)){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
            }
        }

        public function freightListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'FRT_BUS_UNIT','FRT_CODE','FRT_DESC','FRT_NOTES',NULL),
                "column_search" => array('FRT_BUS_UNIT','FRT_CODE','FRT_DESC','FRT_NOTES'),
                "order" => array('FRT_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'FREIGHTS'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $FrightList = dataEncyptbase64($rowdata->FRT_CODE,'encrypt');
                $row[] = $no.".";
                $row[] = $rowdata->FRT_BUS_UNIT;
                $row[] = $rowdata->FRT_CODE;
                $row[] = $rowdata->FRT_DESC;
                $row[] = $rowdata->FRT_NOTES;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                           

                        <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                            <a href='".base_url('FreightList?tokenid=').$FrightList."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                       </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // Terms

        public function termAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $iitemCatCode = $this->input->post('TERM_CODE');
            $termCodeUp = $this->input->post('term_list_db');
            if($iitemCatCode && !$termCodeUp){
                $this->form_validation->set_rules('TERM_CODE', 'unique code', 'unique_code_db[TERMS.TERM_CODE.Term Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('TERM_DESC', 'term description', 'required');
            $this->form_validation->set_rules('TERM_BUS_UNIT', 'Business unit', 'required');
            $this->form_validation->set_rules('TERM_DUE_DAYS', 'Due Days', 'required');

            // $this->form_validation->set_rules('ICAT_BUS_UNIT', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "TERM_CODE"=>empty($iitemCatCode)?insertUniqueCode('TERM_CODE'):$iitemCatCode,
                            "TERM_BUS_UNIT"=>$this->input->post('TERM_BUS_UNIT'),
                            "TERM_DESC"=>$this->input->post('TERM_DESC'),

                            "TERM_DUE_DAYS"=>empty($this->input->post('TERM_DUE_DAYS'))?NULL:$this->input->post('TERM_DUE_DAYS'),
                            "TERM_DISC_DAYS"=>empty($this->input->post('TERM_DISC_DAYS'))?NULL:$this->input->post('TERM_DISC_DAYS'),
                            "TERM_FROM_EOM"=>empty($this->input->post('TERM_FROM_EOM'))?'N':$this->input->post('TERM_FROM_EOM'),
                            "TERM_DISC_PCT"=>empty($this->input->post('TERM_DISC_PCT'))?NULL:$this->input->post('TERM_DISC_PCT'),

                            "TERM_NOTES"=>empty($this->input->post('TERM_NOTES'))?'N/A':$this->input->post('TERM_NOTES'),
                            "TERM_CRE_BY"=>$userCon->USERNAME,
                        );

                if($termCodeUp){
                    if($this->unicon->updateArrayUniversal("TERMS",$data,"TERM_CODE = '$termCodeUp'")>0){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Update Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }else{
                    $data['TERM_CODE'] = empty($iitemCatCode)?insertUniqueCode('TERM_CODE'):$iitemCatCode;
                    if($this->unicon->insertUniversal('TERMS',$data)){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
                
            }
        }

        public function termListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'TERM_BUS_UNIT','TERM_CODE','TERM_DESC','TERM_DUE_DAYS','TERM_DISC_DAYS','TERM_FROM_EOM','TERM_DISC_PCT','TERM_NOTES',NULL),
                "column_search" => array('TERM_BUS_UNIT','TERM_CODE','TERM_DESC','TERM_DUE_DAYS','TERM_DISC_DAYS','TERM_FROM_EOM','TERM_DISC_PCT','TERM_NOTES'),
                "order" => array('TERM_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'TERMS'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $codeEncode = dataEncyptbase64($rowdata->TERM_CODE,'encrypt');
                $row[] = $no.".";

                $row[] = $rowdata->TERM_BUS_UNIT;
                $row[] = $rowdata->TERM_CODE;
                $row[] = $rowdata->TERM_DESC;
                $row[] = $rowdata->TERM_DUE_DAYS;
                $row[] = $rowdata->TERM_DISC_DAYS;
                $row[] = $rowdata->TERM_FROM_EOM;
                $row[] = $rowdata->TERM_DISC_PCT;
                $row[] = $rowdata->TERM_NOTES;

                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('TermsList?tokenid=').$codeEncode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // PO-PREFIXES
        public function poPrefixesAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $iitemCatCode = $this->input->post('POP_ORDER_PFX');
            $poPrefixCodeUp = $this->input->post('po_prefix_db');
            if($iitemCatCode && !$poPrefixCodeUp){
                $this->form_validation->set_rules('POP_ORDER_PFX', 'unique code', 'unique_code_db[PO_PREFIXES.POP_ORDER_PFX.Po prefixes Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('POP_DESC', 'Po prefixes description', 'required');
            $this->form_validation->set_rules('POP_BUS_UNIT', 'Business unit', 'required');
            $this->form_validation->set_rules('POP_NEXT_NUMBER', 'next number', 'required|numeric');

            // $this->form_validation->set_rules('ICAT_BUS_UNIT', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "POP_ORDER_PFX"=>empty($iitemCatCode)?insertUniqueCode('POP_ORDER_PFX'):$iitemCatCode,
                            "POP_BUS_UNIT"=>$this->input->post('POP_BUS_UNIT'),
                            "POP_DESC"=>$this->input->post('POP_DESC'),

                            "POP_ORDER_CLS"=>empty($this->input->post('POP_ORDER_CLS'))?NULL:$this->input->post('POP_ORDER_CLS'),
                            "POP_NEXT_NUMBER"=>empty($this->input->post('POP_NEXT_NUMBER'))?NULL:$this->input->post('POP_NEXT_NUMBER'),
                            "POP_UPD_INV"=>empty($this->input->post('POP_UPD_INV'))?'N':$this->input->post('POP_UPD_INV'),
                            "POP_PRINT_ORDER"=>empty($this->input->post('POP_PRINT_ORDER'))?'N':$this->input->post('POP_PRINT_ORDER'),
                            "POP_DOCUMENT_TYPE"=>empty($this->input->post('POP_DOCUMENT_TYPE'))?'PO':$this->input->post('POP_DOCUMENT_TYPE'),

                            "POP_NOTES"=>empty($this->input->post('POP_NOTES'))?'N/A':$this->input->post('POP_NOTES'),
                            "POP_CRE_BY"=>$userCon->USERNAME,
                        );

                if($poPrefixCodeUp){
                    if($this->unicon->updateArrayUniversal("PO_PREFIXES",$data,"POP_ORDER_PFX = '$poPrefixCodeUp'")>0){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Update Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }else{
                    $data['POP_ORDER_PFX'] = empty($iitemCatCode)?insertUniqueCode('POP_ORDER_PFX'):$iitemCatCode;
                    if($this->unicon->insertUniversal('PO_PREFIXES',$data)){
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
            }
        }

        public function poPrefixesListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'POP_BUS_UNIT','POP_ORDER_PFX','POP_DESC','POP_ORDER_CLS','POP_NEXT_NUMBER','POP_UPD_INV','POP_PRINT_ORDER','POP_DOCUMENT_TYPE','POP_NOTES',NULL),
                "column_search" => array('POP_BUS_UNIT','POP_ORDER_PFX','POP_DESC','POP_ORDER_CLS','POP_NEXT_NUMBER','POP_UPD_INV','POP_PRINT_ORDER','POP_DOCUMENT_TYPE','POP_NOTES'),
                "order" => array('POP_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'PO_PREFIXES'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $codeEncode = dataEncyptbase64($rowdata->POP_ORDER_PFX,'encrypt');
                $row[] = $no.".";
                $row[] = $rowdata->POP_BUS_UNIT;
                $row[] = $rowdata->POP_ORDER_PFX;
                $row[] = $rowdata->POP_DESC;
                $row[] = $rowdata->POP_ORDER_CLS;
                $row[] = $rowdata->POP_NEXT_NUMBER;
                $row[] = $rowdata->POP_UPD_INV;
                $row[] = $rowdata->POP_PRINT_ORDER;
                $row[] = $rowdata->POP_DOCUMENT_TYPE;
                $row[] = $rowdata->POP_NOTES;

                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('POPrefixesList?tokenid=').$codeEncode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // BUSINESS-UNIT
        public function busUnitAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $busUnitCode = $this->input->post('BU_CODE');
            $busCodeUp = $this->input->post('bus_code_db');
            if($busUnitCode  && !$busCodeUp){
                $this->form_validation->set_rules('BU_CODE', 'unique code', 'unique_code_db[BUS_UNIT.BU_CODE.Business unit Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('BU_NAME1', 'Bus unit Name(EN)', 'required|alpha_space');
            $this->form_validation->set_rules('BU_NAME2', 'Bus unit Name(AR)', 'required');
            $this->form_validation->set_rules('BU_STR_ADDR1', 'Address', 'required');
            $this->form_validation->set_rules('BU_CITY', 'city', 'required');
            $this->form_validation->set_rules('BU_STATE', 'sate', 'required');
            $this->form_validation->set_rules('BU_COUNTRY', 'country', 'required');
            $this->form_validation->set_rules('BU_POSTAL_CODE', 'postal code', 'required|numeric');

            // $this->form_validation->set_rules('ICAT_BUS_UNIT', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            "BU_CODE"=>empty($busUnitCode)?insertUniqueCode('BU_CODE'):$busUnitCode,

                            "BU_NAME1"=>$this->input->post('BU_NAME1'),
                            "BU_NAME2"=>$this->input->post('BU_NAME2'),
                            "BU_STR_ADDR1"=>$this->input->post('BU_STR_ADDR1'),
                            "BU_CITY"=>$this->input->post('BU_CITY'),
                            "BU_STATE"=>$this->input->post('BU_STATE'),
                            "BU_COUNTRY"=>$this->input->post('BU_COUNTRY'),
                            "BU_POSTAL_CODE"=>$this->input->post('BU_POSTAL_CODE'),


                            "BU_STR_ADDR2"=>empty($this->input->post('BU_STR_ADDR2'))?NULL:$this->input->post('BU_STR_ADDR2'),
                            "BU_STR_ADDR3"=>empty($this->input->post('BU_STR_ADDR3'))?NULL:$this->input->post('BU_STR_ADDR3'),
                            "BU_PHONE1"=>empty($this->input->post('BU_PHONE1'))?NULL:$this->input->post('BU_PHONE1'),
                            "BU_PHONE2"=>empty($this->input->post('BU_PHONE2'))?NULL:$this->input->post('BU_PHONE2'),
                            "BU_FAX1"=>empty($this->input->post('BU_FAX1'))?NULL:$this->input->post('BU_FAX1'),
                            "BU_FAX2"=>empty($this->input->post('BU_FAX2'))?NULL:$this->input->post('BU_FAX2'),
                            "BU_E_MAIL1"=>empty($this->input->post('BU_E_MAIL1'))?NULL:$this->input->post('BU_E_MAIL1'),
                            "BU_E_MAIL2"=>empty($this->input->post('BU_E_MAIL2'))?NULL:$this->input->post('BU_E_MAIL2'),
                            "BU_FEDERAL_ID"=>empty($this->input->post('BU_FEDERAL_ID'))?NULL:$this->input->post('BU_FEDERAL_ID'),
                            "BU_NUMBER_OF_PERIODS"=>empty($this->input->post('BU_NUMBER_OF_PERIODS'))?NULL:$this->input->post('BU_NUMBER_OF_PERIODS'),
                            "BU_NOTES"=>empty($this->input->post('BU_NOTES'))?'N/A':$this->input->post('BU_NOTES'),
                            "BU_CRE_BY"=>$userCon->USERNAME,
                        );
                
                $tableName = "BUS_UNIT";
                
          if($busCodeUp){
                if($this->unicon->updateArrayUniversal($tableName,$data,"BU_CODE = '$busCodeUp'")>0){
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                }else{
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                }
          }else{
              $data['BU_CODE'] = empty($busUnitCode)?insertUniqueCode('BU_CODE'):$busUnitCode;
                    if($this->unicon->insertUniversal($tableName,$data)){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
          }
                 
            }
        }

        public function businessListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'BU_CODE','BU_NAME1','BU_NAME2','BU_STR_ADDR1','BU_STR_ADDR2','BU_STR_ADDR3','CNTRY_NAME','ST_NAME','CTY_NAME','BU_POSTAL_CODE','BU_PHONE1','BU_PHONE2','BU_FAX1','BU_FAX2','BU_E_MAIL1','BU_E_MAIL2','BU_FEDERAL_ID','BU_NUMBER_OF_PERIODS',NULL),
                "column_search" => array('BU_CODE','BU_NAME1','BU_NAME2','BU_STR_ADDR1','BU_STR_ADDR2','BU_STR_ADDR3','CNTRY_NAME','ST_NAME','CTY_NAME','BU_POSTAL_CODE','BU_PHONE1','BU_PHONE2','BU_FAX1','BU_FAX2','BU_E_MAIL1','BU_E_MAIL2','BU_FEDERAL_ID','BU_NUMBER_OF_PERIODS'),
                "order" => array('BU_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'BUS_UNIT',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'COUNTRIES',
                    "JOIN_1_TABLE_CONN"=>'COUNTRIES.CNTRY_CODE = BUS_UNIT.BU_COUNTRY',

                "JOIN_2_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_2_TABLE_NAME"=>'STATES',
                    "JOIN_2_TABLE_CONN"=>'STATES.ST_CODE = BUS_UNIT.BU_STATE',

                "JOIN_3_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_3_TABLE_NAME"=>'CITIES',
                    "JOIN_3_TABLE_CONN"=>'CITIES.CTY_CODE=BUS_UNIT.BU_CITY',

                "JOIN_4_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_4_TABLE_NAME"=>'CLEARANCE_PO_ID',
                    "JOIN_4_TABLE_CONN"=>'CLEARANCE_PO_ID.CPO_TEMP_CL_ID=PO_HEADER.POH_TEMP_ORDER_ID',
                
                "JOIN_5_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_5_TABLE_NAME"=>'CLEARANCE_ID',
                    "JOIN_5_TABLE_CONN"=>'CLEARANCE_ID.INV_CL_NO = CLEARANCE_PO_ID.CPO_CL_NO',
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $row[] = $no.".";
                $busCode = dataEncyptbase64($rowdata->BU_CODE,'encrypt');
                $row[] = $rowdata->BU_CODE;
                $row[] = $rowdata->BU_NAME1;
                $row[] = $rowdata->BU_NAME2;
                $row[] = $rowdata->BU_STR_ADDR1;
                $row[] = $rowdata->BU_STR_ADDR2;
                $row[] = $rowdata->BU_STR_ADDR3;
                $row[] = $rowdata->CNTRY_NAME;
                $row[] = $rowdata->ST_NAME;
                $row[] = $rowdata->CTY_NAME;
                $row[] = $rowdata->BU_POSTAL_CODE;
                $row[] = $rowdata->BU_PHONE1;
                $row[] = $rowdata->BU_PHONE2;
                $row[] = $rowdata->BU_FAX1;
                $row[] = $rowdata->BU_FAX2;
                $row[] = $rowdata->BU_E_MAIL1;
                $row[] = $rowdata->BU_E_MAIL2;
                $row[] = $rowdata->BU_FEDERAL_ID;
                $row[] = $rowdata->BU_NUMBER_OF_PERIODS;

                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            
                            
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('BusinessUnitAdd?tokenid=').$busCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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



        // WHAREHOUSE
        public function whseAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $busUnitCode = $this->input->post('WHSE_CODE');
            $whseCodeUp = $this->input->post('whse_code_db');
            if($busUnitCode && !$whseCodeUp){
                $this->form_validation->set_rules('WHSE_CODE', 'unique code', 'unique_code_db[WHAREHOUSE.WHSE_CODE.Wharehouse Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('WHSE_BUS_UNIT', 'business unit', 'required');
            $this->form_validation->set_rules('WHSE_DESC', 'decription', 'required');
            $this->form_validation->set_rules('WHSE_STR_ADDR1', 'Address', 'required');
            $this->form_validation->set_rules('WHSE_CITY', 'city', 'required');
            $this->form_validation->set_rules('WHSE_STATE', 'sate', 'required');
            $this->form_validation->set_rules('WHSE_COUNTRY', 'country', 'required');
            $this->form_validation->set_rules('WHSE_POSTAL_CODE', 'postal code', 'required');
            $this->form_validation->set_rules('WHSE_LOCATION_TYPE', 'location type', 'required');
            $this->form_validation->set_rules('WHSE_ORDER_COUNT', 'Sale Order Count', 'required|numeric');
            $this->form_validation->set_rules('WHSE_INVOICE_COUNT', 'Sale Invoice Count', 'required|numeric');
            $this->form_validation->set_rules('WHSE_RET_ORDER_COUNT', 'Sale Return Order Count', 'required|numeric');
            $this->form_validation->set_rules('WHSE_RET_INVOICE_COUNT', 'Sale Retuen Invoice Count', 'required|numeric');
            $this->form_validation->set_rules('WHSE_CREDIT_MEMO_COUNT', 'Credit Memo Count', 'required|numeric');
            $this->form_validation->set_rules('WHSE_DEBIT_MEMO_COUNT', 'Debit Memo Count', 'required|numeric');
            $this->form_validation->set_rules('WHSE_PAYMENT_COUNT', 'Payment Count', 'required|numeric');

            // $this->form_validation->set_rules('ICAT_WHAREHOUSE', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "WHSE_CODE"=>empty($busUnitCode)?insertUniqueCode('WHSE_CODE'):$busUnitCode,

                            "WHSE_BUS_UNIT"=>$this->input->post('WHSE_BUS_UNIT'),
                            "WHSE_DESC"=>$this->input->post('WHSE_DESC'),
                            "WHSE_STR_ADDR1"=>$this->input->post('WHSE_STR_ADDR1'),
                            "WHSE_CITY"=>$this->input->post('WHSE_CITY'),
                            "WHSE_STATE"=>$this->input->post('WHSE_STATE'),
                            "WHSE_COUNTRY"=>$this->input->post('WHSE_COUNTRY'),
                            "WHSE_LOCATION_TYPE"=>$this->input->post('WHSE_LOCATION_TYPE'),
                            "WHSE_POSTAL_CODE"=>$this->input->post('WHSE_POSTAL_CODE'),
                            "WHSE_STR_ADDR2"=>empty($this->input->post('WHSE_STR_ADDR2'))?NULL:$this->input->post('WHSE_STR_ADDR2'),
                            "WHSE_STR_ADDR3"=>empty($this->input->post('WHSE_STR_ADDR3'))?NULL:$this->input->post('WHSE_STR_ADDR3'),
                            "WHSE_PHONE1"=>empty($this->input->post('WHSE_PHONE1'))?NULL:$this->input->post('WHSE_PHONE1'),
                            "WHSE_PHONE2"=>empty($this->input->post('WHSE_PHONE2'))?NULL:$this->input->post('WHSE_PHONE2'),
                            "WHSE_FAX1"=>empty($this->input->post('WHSE_FAX1'))?NULL:$this->input->post('WHSE_FAX1'),
                            "WHSE_FAX2"=>empty($this->input->post('WHSE_FAX2'))?NULL:$this->input->post('WHSE_FAX2'),
                            "WHSE_E_MAIL1"=>empty($this->input->post('WHSE_E_MAIL1'))?NULL:$this->input->post('WHSE_E_MAIL1'),
                            "WHSE_E_MAIL2"=>empty($this->input->post('WHSE_E_MAIL2'))?NULL:$this->input->post('WHSE_E_MAIL2'),
                            "WHSE_EDI1"=>empty($this->input->post('WHSE_EDI1'))?NULL:$this->input->post('WHSE_EDI1'),
                            "WHSE_EDI2"=>empty($this->input->post('WHSE_EDI2'))?NULL:$this->input->post('WHSE_EDI2'),
                            "WHSE_ERP_PLANNING"=>empty($this->input->post('WHSE_ERP_PLANNING'))?'N':$this->input->post('WHSE_ERP_PLANNING'),
                            "WHSE_MRP_REGEN"=>empty($this->input->post('WHSE_MRP_REGEN'))?'N':$this->input->post('WHSE_MRP_REGEN'),
                            "WHSE_DISTRIBUTION"=>empty($this->input->post('WHSE_DISTRIBUTION'))?'N':$this->input->post('WHSE_DISTRIBUTION'),
                            "WHSE_TIME_ATTEND"=>empty($this->input->post('WHSE_TIME_ATTEND'))?'N':$this->input->post('WHSE_TIME_ATTEND'),
                            "WHSE_NOTES"=>empty($this->input->post('WHSE_NOTES'))?'N/A':$this->input->post('WHSE_NOTES'),
                            "WHSE_ORDER_COUNT"=>$this->input->post('WHSE_ORDER_COUNT'),
                            "WHSE_INVOICE_COUNT"=>$this->input->post('WHSE_INVOICE_COUNT'),
                            "WHSE_RET_ORDER_COUNT"=>$this->input->post('WHSE_RET_ORDER_COUNT'),
                            "WHSE_RET_INVOICE_COUNT"=>$this->input->post('WHSE_RET_INVOICE_COUNT'),
                            "WHSE_CREDIT_MEMO_COUNT"=>$this->input->post('WHSE_CREDIT_MEMO_COUNT'),
                            "WHSE_DEBIT_MEMO_COUNT"=>$this->input->post('WHSE_DEBIT_MEMO_COUNT'),
                            "WHSE_PAYMENT_COUNT"=>$this->input->post('WHSE_PAYMENT_COUNT'),
                            "WHSE_CRE_BY"=>$userCon->USERNAME,
                        );
                $tableName = "WHAREHOUSE";
                if($whseCodeUp){
                    
                    if($this->unicon->updateArrayUniversal($tableName,$data,"WHSE_CODE = '$whseCodeUp'")>0){

                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data update Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"Update some field"));
                    }
                }else{
                    $data['WHSE_CODE'] = empty($busUnitCode)?insertUniqueCode('WHSE_CODE'):$busUnitCode;
                    if($this->unicon->insertUniversal($tableName,$data)){
                    
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                
                    
                    }else{

                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                    }
                }
            }
        }

        public function wharehouseListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'WHSE_BUS_UNIT','WHSE_CODE','WHSE_DESC','WHSE_STR_ADDR1','WHSE_STR_ADDR2','WHSE_STR_ADDR3','CNTRY_NAME','ST_NAME','CTY_NAME','WHSE_POSTAL_CODE','WHSE_PHONE1','WHSE_PHONE2','WHSE_FAX1','WHSE_FAX2','WHSE_E_MAIL1','WHSE_E_MAIL2','WHSE_EDI1','WHSE_EDI2','WHSE_ERP_PLANNING','WHSE_MRP_REGEN','WHSE_DISTRIBUTION','WHSE_TIME_ATTEND',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
                "column_search" => array('WHSE_BUS_UNIT','WHSE_CODE','WHSE_DESC','WHSE_STR_ADDR1','WHSE_STR_ADDR2','WHSE_STR_ADDR3','CNTRY_NAME','ST_NAME','CTY_NAME','WHSE_POSTAL_CODE','WHSE_PHONE1','WHSE_PHONE2','WHSE_FAX1','WHSE_FAX2','WHSE_E_MAIL1','WHSE_E_MAIL2','WHSE_EDI1','WHSE_EDI2','WHSE_ERP_PLANNING','WHSE_MRP_REGEN','WHSE_DISTRIBUTION','WHSE_TIME_ATTEND'),
                "order" => array('WHSE_CRE_DATE' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'WHAREHOUSE',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'COUNTRIES',
                    "JOIN_1_TABLE_CONN"=>'COUNTRIES.CNTRY_CODE = WHAREHOUSE.WHSE_COUNTRY',

                "JOIN_2_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_2_TABLE_NAME"=>'STATES',
                    "JOIN_2_TABLE_CONN"=>'STATES.ST_CODE = WHAREHOUSE.WHSE_STATE',

                "JOIN_3_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_3_TABLE_NAME"=>'CITIES',
                    "JOIN_3_TABLE_CONN"=>'CITIES.CTY_CODE=WHAREHOUSE.WHSE_CITY',

                "JOIN_4_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_4_TABLE_NAME"=>'CLEARANCE_PO_ID',
                    "JOIN_4_TABLE_CONN"=>'CLEARANCE_PO_ID.CPO_TEMP_CL_ID=PO_HEADER.POH_TEMP_ORDER_ID',
                
                "JOIN_5_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_5_TABLE_NAME"=>'CLEARANCE_ID',
                    "JOIN_5_TABLE_CONN"=>'CLEARANCE_ID.INV_CL_NO = CLEARANCE_PO_ID.CPO_CL_NO',
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $row[] = $no.".";
                $whseCode = dataEncyptbase64($rowdata->WHSE_CODE,'encrypt');
                $row[] = $rowdata->WHSE_BUS_UNIT;
                $row[] = $rowdata->WHSE_CODE;
                $row[] = $rowdata->WHSE_DESC;
                $row[] = $rowdata->WHSE_STR_ADDR1;
                $row[] = $rowdata->WHSE_STR_ADDR2;
                $row[] = $rowdata->WHSE_STR_ADDR3;
                $row[] = $rowdata->CNTRY_NAME;
                $row[] = $rowdata->ST_NAME;
                $row[] = $rowdata->CTY_NAME;
                $row[] = $rowdata->WHSE_POSTAL_CODE;
                $row[] = $rowdata->WHSE_PHONE1;
                $row[] = $rowdata->WHSE_PHONE2;
                $row[] = $rowdata->WHSE_FAX1;
                $row[] = $rowdata->WHSE_FAX2;
                $row[] = $rowdata->WHSE_E_MAIL1;
                $row[] = $rowdata->WHSE_E_MAIL2;
                $row[] = $rowdata->WHSE_EDI1;
                $row[] = $rowdata->WHSE_EDI2;
                $row[] = $rowdata->WHSE_ERP_PLANNING;
                $row[] = $rowdata->WHSE_MRP_REGEN;
                $row[] = $rowdata->WHSE_DISTRIBUTION;
                $row[] = $rowdata->WHSE_TIME_ATTEND;
                $row[] = $rowdata->WHSE_ORDER_COUNT;
                $row[] = $rowdata->WHSE_INVOICE_COUNT;
                $row[] = $rowdata->WHSE_RET_ORDER_COUNT;
                $row[] = $rowdata->WHSE_RET_INVOICE_COUNT;
                $row[] = $rowdata->WHSE_CREDIT_MEMO_COUNT;
                $row[] = $rowdata->WHSE_DEBIT_MEMO_COUNT;
                $row[] = $rowdata->WHSE_PAYMENT_COUNT;

                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('WarehouseAdd?tokenid=').$whseCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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
        
        // EXCHANGE CURRENCY
        public function extCurAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            
            $this->form_validation->set_rules('EXCHR_CURRENCY', 'Exchange currency', 'required');
            $this->form_validation->set_rules('EXCHR_START_DATE', 'Start date', 'required');
            $this->form_validation->set_rules('EXCHR_BUY_RATE', 'Address', 'required');
            $this->form_validation->set_rules('EXCHR_SELL_RATE', 'city', 'required');

            // $this->form_validation->set_rules('ICAT_WHAREHOUSE', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            "EXCHR_CURRENCY"=>$this->input->post('EXCHR_CURRENCY'),
                            "EXCHR_START_DATE"=>$this->input->post('EXCHR_START_DATE'),
                            "EXCHR_BUY_RATE"=>$this->input->post('EXCHR_BUY_RATE'),
                            "EXCHR_SELL_RATE"=>$this->input->post('EXCHR_SELL_RATE'),
                            "EXCHR_NOTES"=>empty($this->input->post('EXCHR_NOTES'))?'N/A':$this->input->post('EXCHR_NOTES'),
                            "EXCHR_CRE_BY"=>$userCon->USERNAME,
                        );
                if($this->unicon->insertUniversal('CURRENCY_EXCHANGE_RATE',$data)){
                
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
              
                
                }else{

                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }
        }

        public function extCurListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'EXCHR_CURRENCY','EXCHR_START_DATE','EXCHR_BUY_RATE','EXCHR_SELL_RATE','EXCHR_NOTES',NULL),
                "column_search" => array('EXCHR_CURRENCY','EXCHR_START_DATE','EXCHR_BUY_RATE','EXCHR_SELL_RATE','EXCHR_NOTES'),
                "order" => array('EXCHR_ID' => 'DESC')
            );
            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'CURRENCY_EXCHANGE_RATE'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $row[] = $no.".";
                $row[] = $rowdata->EXCHR_ID;
                $row[] = $rowdata->EXCHR_START_DATE;
                $row[] = $rowdata->EXCHR_CURRENCY;
                $row[] = $rowdata->EXCHR_BUY_RATE;
                $row[] = $rowdata->EXCHR_SELL_RATE;
                $row[] = $rowdata->EXCHR_NOTES;

                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='#' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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


        // PAYMENT METHODS
        public function payMethAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $PaylistCodeUp = $this->input->post('Paylist_db');
            $busUnitCode = $this->input->post('PM_CODE');
            if($busUnitCode && !$PaylistCodeUp){
                $this->form_validation->set_rules('PM_CODE', 'unique code', 'unique_code_db[PAY_METHODS.PM_CODE.Payment method Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('PM_DESC', 'Pay description', 'required');
            $this->form_validation->set_rules('PM_DED_PRCNT', 'deduction %', 'required|numeric');
            // $this->form_validation->set_rules('PM_ACCT_LVL1_DED', 'Address', 'required');
            // $this->form_validation->set_rules('PM_ACCT_LVL2_DED', 'city', 'required');

            // $this->form_validation->set_rules('ICAT_WHAREHOUSE', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            //"PM_CODE"=>empty($busUnitCode)?insertUniqueCode('PM_CODE'):$busUnitCode,
                            "PM_DESC"=>$this->input->post('PM_DESC'),
                            "PM_DED_PRCNT"=>$this->input->post('PM_DED_PRCNT'),
                            "PM_ACCT_LVL1_DED"=>$this->input->post('PM_ACCT_LVL1_DED'),
                            "PM_ACCT_LVL2_DED"=>$this->input->post('PM_ACCT_LVL2_DED'),
                            "PM_AR_POST"=>empty($this->input->post('PM_AR_POST'))?'N':$this->input->post('PM_AR_POST'),
                            "PM_PRINT"=>empty($this->input->post('PM_PRINT'))?'N':$this->input->post('PM_PRINT'),
                            "PM_NOTES"=>empty($this->input->post('PM_NOTES'))?'N/A':$this->input->post('PM_NOTES'),
                            "PM_CRE_BY"=>$userCon->USERNAME,
                        );
                $tableName = "PAY_METHODS";
                if($PaylistCodeUp){
                    if($this->unicon->updateArrayUniversal($tableName,$data,"PM_CODE = '$PaylistCodeUp'")>0){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data update Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"Update some field"));
                    }
                }else{
                    $data['PM_CODE'] = empty($busUnitCode)?insertUniqueCode('PM_CODE'):$busUnitCode;
                    if($this->unicon->insertUniversal($tableName,$data)){
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }


            }
        }

        public function payMethListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'PM_CODE','PM_DESC','PM_DED_PRCNT','PM_ACCT_LVL1_DED','PM_ACCT_LVL2_DED','PM_AR_POST','PM_PRINT',NULL),
                "column_search" => array('PM_CODE','PM_DESC','PM_DED_PRCNT','PM_ACCT_LVL1_DED','PM_ACCT_LVL2_DED','PM_AR_POST','PM_PRINT'),
                "order" => array('PM_CRE_DATE' => 'DESC')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'PAY_METHODS'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);
           
            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $Paylist = dataEncyptbase64($rowdata->PM_CODE,'encrypt');
                $row[] = $no.".";
                $row[] = $rowdata->PM_CODE;
                $row[] = $rowdata->PM_DESC;
                $row[] = $rowdata->PM_DED_PRCNT;
                $row[] = $rowdata->PM_ACCT_LVL1_DED;
                $row[] = $rowdata->PM_ACCT_LVL2_DED;
                $row[] = $rowdata->PM_AR_POST;
                $row[] = $rowdata->PM_PRINT;

                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                 <a href='".base_url('PaymentMethodList?tokenid=').$Paylist."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // PO CHARGE
        public function poChargeAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $poChargeId = $this->input->post('po_charge_list_db');
            $busUnitCode = $this->input->post('CHRG_TYPE');
            if($busUnitCode && !$poChargeId){
                $this->form_validation->set_rules('CHRG_TYPE', 'unique code', 'unique_code_db[PO_CHARGES.CHRG_TYPE.Po charge Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('CHRG_DESC', 'po charge description', 'required');
            // $this->form_validation->set_rules('PM_ACCT_LVL1_DED', 'Address', 'required');
            // $this->form_validation->set_rules('PM_ACCT_LVL2_DED', 'city', 'required');

            // $this->form_validation->set_rules('ICAT_WHAREHOUSE', 'Business Unit', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            // "CHRG_TYPE"=>empty($busUnitCode)?insertUniqueCode('CHRG_TYPE'):$busUnitCode,
                            "CHRG_DESC"=>$this->input->post('CHRG_DESC'),

                            "CHRG_ACCT_LVL1"=>empty($this->input->post('CHRG_ACCT_LVL1'))?'N':$this->input->post('CHRG_ACCT_LVL1'),
                            "CHRG_ACCT_LVL2"=>empty($this->input->post('CHRG_ACCT_LVL2'))?'N':$this->input->post('CHRG_ACCT_LVL2'),
                            "CHRG_NOTES"=>empty($this->input->post('CHRG_NOTES'))?'N/A':$this->input->post('CHRG_NOTES'),
                            "CHRG_CRE_BY"=>$userCon->USERNAME,
                        );
                if($poChargeId){
                    if($this->unicon->updateArrayUniversal('PO_CHARGES',$data,"CHRG_TYPE = '$poChargeId'")>0){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data update Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"Update some field"));
                    }
                }else{
                    $data["CHRG_TYPE"] = empty($busUnitCode)?insertUniqueCode('CHRG_TYPE'):$busUnitCode;
                    if($this->unicon->insertUniversal('PO_CHARGES',$data)){ 
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
                
            }
        }

        public function poChargeListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'CHRG_TYPE','CHRG_DESC','CHRG_ACCT_LVL1','CHRG_ACCT_LVL2','CHRG_NOTES',NULL),
                "column_search" => array('CHRG_TYPE','CHRG_DESC','CHRG_ACCT_LVL1','CHRG_ACCT_LVL2','CHRG_NOTES'),
                "order" => array('PO_CHRG_ID' => 'DESC')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'PO_CHARGES'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $poId = dataEncyptbase64($rowdata->CHRG_TYPE,'encrypt');
                $row[] = $no.".";
                $row[] = $rowdata->CHRG_TYPE;
                $row[] = $rowdata->CHRG_DESC;
                $row[] = $rowdata->CHRG_ACCT_LVL1;
                $row[] = $rowdata->CHRG_ACCT_LVL2;
                $row[] = $rowdata->CHRG_NOTES;

                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('POChargesList?tokenid=').$poId."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // FIENCEIAL YEAR PERIODS
        public function finsalYearPeriodAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            
          
            $this->form_validation->set_rules('FP_YEAR', 'financial year', 'required');
            $this->form_validation->set_rules('FP_PERIOD', 'financial periods', 'required');
            $this->form_validation->set_rules('FP_BUS_UNIT', 'Business unit', 'required');

            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            "FP_YEAR"=>$this->input->post('FP_YEAR'),
                            "FP_BUS_UNIT"=>$this->input->post('FP_BUS_UNIT'),
                            "FP_PERIOD"=>$this->input->post('FP_PERIOD'),
                            "FP_START_DATE"=>$this->input->post('FP_START_DATE'),
                            "FP_END_DATE"=>$this->input->post('FP_END_DATE'),
                      
                            "FP_NOTES"=>empty($this->input->post('FP_NOTES'))?'N/A':$this->input->post('FP_NOTES'),
                            "FP_CRE_BY"=>$userCon->USERNAME,
                        );

                $fiscalPeriodCodeUp = $this->input->post('fiscal_period_db');
                  
                if($fiscalPeriodCodeUp){
                    if($this->unicon->updateArrayUniversal("FISCAL_PERIODS",$data,"FP_ID = '$fiscalPeriodCodeUp'")>0){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Update Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }else{
                    if($this->unicon->insertUniversal('FISCAL_PERIODS',$data)){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
                
            }
        }

        public function finsalYearPeriodListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'FP_BUS_UNIT','FP_YEAR','FP_PERIOD','FP_START_DATE','FP_END_DATE','FP_NOTES',NULL),
                "column_search" => array('FP_BUS_UNIT','FP_YEAR','FP_PERIOD','FP_START_DATE','FP_END_DATE','FP_NOTES'),
                "order" => array('FP_ID' => 'DESC')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'FISCAL_PERIODS'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $codeEncode = dataEncyptbase64($rowdata->FP_ID,'encrypt');
                $row[] = $no.".";
                $row[] = $rowdata->FP_BUS_UNIT;
                $row[] = $rowdata->FP_YEAR;
                $row[] = $rowdata->FP_PERIOD;
                $row[] = $rowdata->FP_START_DATE;
                $row[] = $rowdata->FP_END_DATE;
                $row[] = $rowdata->FP_NOTES;

                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('FiscalPeriodsList?tokenid=').$codeEncode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // FIENCEIAL YEAR
        public function finsalYearAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            
          
            $this->form_validation->set_rules('FY_BUS_UNIT', 'business Unit', 'required');
            $this->form_validation->set_rules('FY_YEAR', 'financial year', 'required|max_length[4]|min_length[4]');
            
            
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            "FY_BUS_UNIT"=>$this->input->post('FY_BUS_UNIT'),
                            "FY_YEAR"=>$this->input->post('FY_YEAR'),

                            "FY_PSEUDO_YEAREND"=>empty($this->input->post('FY_PSEUDO_YEAREND'))?'N':$this->input->post('FY_PSEUDO_YEAREND'),
                            "FY_CRE_GL_ACCT_BUCKETS"=>empty($this->input->post('FY_CRE_GL_ACCT_BUCKETS'))?'N':$this->input->post('FY_CRE_GL_ACCT_BUCKETS'),
                            "FY_EOY_APM"=>empty($this->input->post('FY_EOY_APM'))?'N':$this->input->post('FY_EOY_APM'),
                            "FY_EOY_ARM"=>empty($this->input->post('FY_EOY_ARM'))?'N':$this->input->post('FY_EOY_ARM'),
                            "FY_EOY_GLM"=>empty($this->input->post('FY_EOY_GLM'))?'N':$this->input->post('FY_EOY_GLM'),
                            "FY_EOY_ICM"=>empty($this->input->post('FY_EOY_ICM'))?'N':$this->input->post('FY_EOY_ICM'),
                            "FY_EOY_POM"=>empty($this->input->post('FY_EOY_POM'))?'N':$this->input->post('FY_EOY_POM'),
                            "FY_EOY_SFM"=>empty($this->input->post('FY_EOY_SFM'))?'N':$this->input->post('FY_EOY_SFM'),
                            "FY_EOY_SOM"=>empty($this->input->post('FY_EOY_SOM'))?'N':$this->input->post('FY_EOY_SOM'),
                      
                            "FY_NOTES"=>empty($this->input->post('FY_NOTES'))?'N/A':$this->input->post('FY_NOTES'),
                            "FY_CRE_BY"=>$userCon->USERNAME,
                        );
                if($this->unicon->insertUniversal('FISCAL_YEARS',$data)){
                
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
              
                
                }else{

                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }
        }

        public function finsalYearListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'FY_BUS_UNIT','FY_YEAR','FY_PSEUDO_YEAREND','FY_CRE_GL_ACCT_BUCKETS','FY_EOY_APM','FY_EOY_ARM','FY_EOY_GLM','FY_EOY_ICM','FY_EOY_POM','FY_EOY_SFM','FY_EOY_SOM','FY_NOTES',NULL),
                "column_search" => array('FY_BUS_UNIT','FY_YEAR','FY_PSEUDO_YEAREND','FY_CRE_GL_ACCT_BUCKETS','FY_EOY_APM','FY_EOY_ARM','FY_EOY_GLM','FY_EOY_ICM','FY_EOY_POM','FY_EOY_SFM','FY_EOY_SOM','FY_NOTES'),
                "order" => array('FY_CRE_DATE' => 'DESC')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'FISCAL_YEARS'
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
            
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $row[] = $no.".";
                $row[] = $rowdata->FY_BUS_UNIT;
                $row[] = $rowdata->FY_YEAR;
                $row[] = $rowdata->FY_PSEUDO_YEAREND;
                $row[] = $rowdata->FY_CRE_GL_ACCT_BUCKETS;
                $row[] = $rowdata->FY_EOY_APM;
                $row[] = $rowdata->FY_EOY_ARM;
                $row[] = $rowdata->FY_EOY_GLM;
                $row[] = $rowdata->FY_EOY_ICM;
                $row[] = $rowdata->FY_EOY_POM;
                $row[] = $rowdata->FY_EOY_SFM;
                $row[] = $rowdata->FY_EOY_SOM;
                $row[] = $rowdata->FY_NOTES;

                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='#' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        // GL PREFIXES
        public function glPrefixesUpdate(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            
          
            $this->form_validation->set_rules('GLP_BUS_UNIT', 'business Unit', 'required');
            $this->form_validation->set_rules('GLP_JOURNAL_CLS', 'GL Clear', 'required');
            $this->form_validation->set_rules('GLP_DESC', 'GL discription', 'required');
            $this->form_validation->set_rules('GLP_NEXT_NUMBER', 'next number', 'required|numeric');
            
            
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            "GLP_BUS_UNIT"=>$this->input->post('GLP_BUS_UNIT'),
                            "GLP_JOURNAL_PFX"=>$this->input->post('GLP_JOURNAL_PFX'),
                            "GLP_JOURNAL_CLS"=>$this->input->post('GLP_JOURNAL_CLS'),
                            "GLP_DESC"=>$this->input->post('GLP_DESC'),
                            "GLP_NEXT_NUMBER"=>$this->input->post('GLP_NEXT_NUMBER'),

                            "GLP_ONLINE_JOURNALS"=>empty($this->input->post('GLP_ONLINE_JOURNALS'))?'N':$this->input->post('GLP_ONLINE_JOURNALS'),
                            "GLP_PRINT_PROOF"=>empty($this->input->post('GLP_PRINT_PROOF'))?'N':$this->input->post('GLP_PRINT_PROOF'),
                            "GLP_AP"=>empty($this->input->post('GLP_AP'))?'N':$this->input->post('GLP_AP'),
                            "GLP_AR"=>empty($this->input->post('GLP_AR'))?'N':$this->input->post('GLP_AR'),
                            "GLP_INV"=>empty($this->input->post('GLP_INV'))?'N':$this->input->post('GLP_INV'),
                            "GLP_SF"=>empty($this->input->post('GLP_SF'))?'N':$this->input->post('GLP_SF'),
                            "GLP_SO"=>empty($this->input->post('GLP_SO'))?'N':$this->input->post('GLP_SO'),
                            "GLP_PO"=>empty($this->input->post('GLP_PO'))?'N':$this->input->post('GLP_PO'),
                      
                            "GLP_NOTES"=>empty($this->input->post('GLP_NOTES'))?'N/A':$this->input->post('GLP_NOTES'),
                            "GLP_CRE_BY"=>$userCon->USERNAME,
                        );
                     
                if($this->unicon->updateArrayUniversal('GL_PREFIXES',$data,"GLP_JOURNAL_PFX = '{$this->input->post('GL_PREFIX_DB')}'")){
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
              
                
                }else{

                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }
        }

        /*================================ SYSTEM SETTING ==============================*/
        
        public function systemSettingUpdate(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            
          
            $this->form_validation->set_rules('SS_TRN', 'TRN No', 'required');
            $this->form_validation->set_rules('SS_TIME_ZONE', 'time Zone', 'required');
            $this->form_validation->set_rules('SS_CURRENCY', 'currency', 'required');
            $this->form_validation->set_rules('SS_BUS_UNIT', 'Business Unit', 'required');
            
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(

                                "SS_TRN"=>$this->input->post('SS_TRN'),
                                "SS_TIME_ZONE"=>$this->input->post('SS_TIME_ZONE'),
                                "SS_CURRENCY"=>$this->input->post('SS_CURRENCY'),
                                "SS_VAT"=>$this->input->post('SS_VAT'),
                                "SS_BUS_UNIT"=>$this->input->post('SS_BUS_UNIT'),
                                
                                "SS_CRE_BY"=>$userCon->USERNAME,
                                "SS_CRE_DATE"=>dateTime(),
                            );
                     
                if($this->unicon->updateArrayUniversal('SYSTEM_SETTING',$data,"SS_ID = '{$this->input->post('system_id_db')}'")){
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                }else{
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                }
            }
        }

        /*================================ SALESMAN ASSIGN ==============================*/
        
        public function salemanAsignCreate(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
           
            $this->form_validation->set_rules('SLSP_EMPLOYEE_CODE', 'Employee detail', 'required');
            $this->form_validation->set_rules('SLSP_SALES_AREA', 'sales area', 'required');
            $this->form_validation->set_rules('SLSP_BUS_UNIT', 'Business unit', 'required');
            $this->form_validation->set_rules('WHSE_BUS_UNIT_ASSIGN', 'Business unit', 'required');

            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $whseCodes = $this->input->post('WHSE_CODE');
            
                if ($whseCodes) {
                    # code...

                    $data = array(
                        "SLSP_CODE" => insertUniqueCode('SLSP_CODE'),
                        "SLSP_BUS_UNIT" => $this->input->post('SLSP_BUS_UNIT'),
                        "SLSP_EMPLOYEE_CODE" => $this->input->post('SLSP_EMPLOYEE_CODE'),
                        "SLSP_SALES_AREA" => $this->input->post('SLSP_SALES_AREA'),
                        "SLSP_NOTES" => empty($this->input->post('SLSP_NOTES')) ? null : $this->input->post('SLSP_NOTES'),
                        "SLSP_CRE_BY" => $userCon->USERNAME,
                    );
                    $this->unicon->CoreQuery("DELETE sp,smsw from SALES_PERSON sp,SALES_MAN_ASSIGN_WHSE smsw WHERE sp.SLSP_CODE = smsw.SMSW_SLSP_CODE AND sp.SLSP_EMPLOYEE_CODE = '{$data['SLSP_EMPLOYEE_CODE']}'");

                    if ($this->unicon->insertUniversal('SALES_PERSON', $data)) {

                        foreach ($whseCodes as $whseCode) {
                            $dataCode = array(
                                "SMSW_SLSP_CODE " => $data['SLSP_CODE'],
                                "SMSW_BUS_UNIT" => $this->input->post('WHSE_BUS_UNIT_ASSIGN'),
                                "SMSW_WHSE_CODE" => $whseCode,
                                "SMSW_CRE_BY" => $userCon->USERNAME,
                            );
                            $this->unicon->insertUniversal('SALES_MAN_ASSIGN_WHSE', $dataCode);
                        }
                        $url = "<script>location.reload();</script>";
                        echo json_encode(array("multi" => "false", "err" => "false", "msg" => "Data Inserted Successfully".$url));

                    } else {

                        echo json_encode(array("multi" => "false", "err" => "true", "msg" => "something went wrong"));

                    }
                }else{
                    echo json_encode(array("multi" => "false", "err" => "true", "msg" => "Select at least one warehouse"));
                }
            }
        }

        /*================================ EMPLOYEE CREATE ==============================*/
        public function empCreate(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
        $empCodefn = $this->input->post('EMP_CODE');
            $discPer = $this->input->post('EMP_DISC_PER');
            $empCodeUp = $this->input->post('emp_code_db');

        if($empCodefn && !$empCodeUp){
                $this->form_validation->set_rules('EMP_CODE', 'unique code', 'unique_code_db[EMPLOYEE.EMP_CODE.Employee Code already used, Please choose a different one]');
            }
            if ($discPer) {
                $this->form_validation->set_rules('EMP_DISC_PER', 'discount percentage', 'required|max_length[2]|numeric');
            }
            $this->form_validation->set_rules('EMP_NAME1', 'Employee Name', 'required');
            // $this->form_validation->set_rules('IC_NAME_AR', 'item category name arabic', 'required');
            $this->form_validation->set_rules('EMP_CAT_ID', 'select employee category', 'required');
            $this->form_validation->set_rules('EMP_BUS_UNIT', 'Select Business Unit', 'required');
            $this->form_validation->set_rules('EMP_COUNTRY_ID', 'Select country', 'required');
            $this->form_validation->set_rules('EMP_STATE', 'Select state', 'required');
            $this->form_validation->set_rules('EMP_CITY_ID', 'Select city', 'required');
            $this->form_validation->set_rules('EMP_EDI2', 'password', 'required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                
                $data = array(
                        // "EMP_CODE"=>empty($empCodefn)?insertUniqueCode('EMP_CODE'):$empCodefn,
                            "EMP_BUS_UNIT"=>$this->input->post('EMP_BUS_UNIT'),
                            "EMP_CAT_ID"=>$this->input->post('EMP_CAT_ID'),
                            "EMP_COUNTRY_ID"=>$this->input->post('EMP_COUNTRY_ID'),
                            "EMP_STATE"=>$this->input->post('EMP_STATE'),
                            "EMP_CITY_ID"=>$this->input->post('EMP_CITY_ID'),
                            "EMP_NAME1"=>empty($this->input->post('EMP_NAME1'))?null:$this->input->post('EMP_NAME1'),
                            "EMP_NAME2"=>empty($this->input->post('EMP_NAME2'))?null:$this->input->post('EMP_NAME2'),
                            "EMP_SSN"=>empty($this->input->post('EMP_SSN'))?null:$this->input->post('EMP_SSN'),
                            "EMP_STR_ADDR1"=>empty($this->input->post('EMP_STR_ADDR1'))?null:$this->input->post('EMP_STR_ADDR1'),
                            "EMP_STR_ADDR2"=>empty($this->input->post('EMP_STR_ADDR2'))?null:$this->input->post('EMP_STR_ADDR2'),
                            "EMP_STR_ADDR3"=>empty($this->input->post('EMP_STR_ADDR3'))?null:$this->input->post('EMP_STR_ADDR3'),
                            "EMP_POSTAL_CODE_ID"=>empty($this->input->post('EMP_POSTAL_CODE_ID'))?null:$this->input->post('EMP_POSTAL_CODE_ID'),
                            "EMP_FAX1"=>empty($this->input->post('EMP_FAX1'))?null:$this->input->post('EMP_FAX1'),
                            "EMP_FAX2"=>empty($this->input->post('EMP_FAX2'))?null:$this->input->post('EMP_FAX2'),
                            "EMP_PHONE1"=>empty($this->input->post('EMP_PHONE1'))?null:$this->input->post('EMP_PHONE1'),
                            "EMP_PHONE2"=>empty($this->input->post('EMP_PHONE2'))?null:$this->input->post('EMP_PHONE2'),
                            "EMP_E_MAIL1"=>empty($this->input->post('EMP_E_MAIL1'))?null:$this->input->post('EMP_E_MAIL1'),
                            "EMP_E_MAIL2"=>empty($this->input->post('EMP_E_MAIL2'))?null:$this->input->post('EMP_E_MAIL2'),
                            "EMP_EDI1"=>empty($this->input->post('EMP_EDI1'))?null:$this->input->post('EMP_EDI1'),
                            "EMP_EDI2"=>empty($this->input->post('EMP_EDI2'))?null:$this->input->post('EMP_EDI2'),
                            "EMP_DISC_PER"=>empty($this->input->post('EMP_DISC_PER'))?null:$this->input->post('EMP_DISC_PER'),
                            "EMP_CRE_BY"=>$userCon->USERNAME,
                        );
                if($empCodeUp){
                    if($this->unicon->updateArrayUniversal('EMPLOYEE',$data,"EMP_CODE = '$empCodeUp'")>0){
                        $dataSignUpArr = array(
                            "USERNAME_P" =>$empCodeUp,
                            "EMAIL_P" =>$data['EMP_E_MAIL1'],
                            "NAME_P" =>$data['EMP_NAME1'],
                            "PHONE_P" =>$data['EMP_PHONE1'],
                            "PASSWORD_P" =>$this->encryption->encrypt($data['EMP_EDI2'])
                        );
                        $this->profunccon->userProfileUp($dataSignUpArr);
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Updated Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }else{
                    $data["EMP_CODE"] = empty($empCodefn)?insertUniqueCode('EMP_CODE'):$empCodefn;
                    if($this->unicon->insertUniversal('EMPLOYEE',$data)){
                        $dataSignUpArr = array(
                                "USERNAME_P" =>$data['EMP_CODE'],
                                "EMAIL_P" =>$data['EMP_E_MAIL1'],
                                "NAME_P" =>$data['EMP_NAME1'],
                                "PHONE_P" =>$data['EMP_PHONE1'],
                                "PASSWORD_P" =>$this->encryption->encrypt($data['EMP_EDI2']),
                                "USER_TYPE_P" =>'USER',
                        );
                        $this->profunccon->userSignUp($dataSignUpArr);
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
            }
        }
        

        // BANKS DETAILS

        public function bankDelUpdate(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            
          
            $this->form_validation->set_rules('BANK_BUS_UNIT', 'business Unit', 'required');
            $this->form_validation->set_rules('BANK_NAME1', 'Bank name(En)', 'required');
            $this->form_validation->set_rules('BANK_NAME2', 'Bank name(Ar)', 'required');
            $this->form_validation->set_rules('BANK_COUNTRY_ID', 'Country', 'required');
            $this->form_validation->set_rules('BANK_STATE_ID', 'State', 'required');
            $this->form_validation->set_rules('BANK_CITY_ID', 'City', 'required');
            $this->form_validation->set_rules('BANK_ACCOUNT', 'Account number', 'required');
            if($this->input->post('BANK_CONTACT')){
                $this->form_validation->set_rules('BANK_CONTACT', 'contact', 'required|numeric');
            }
            if($this->input->post('BANK_NEXT_CHK_NUMBER')){
                $this->form_validation->set_rules('BANK_NEXT_CHK_NUMBER', 'nect check number', 'required|numeric');
            }

            
            
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $data = array(
                            "BANK_BUS_UNIT"=>$this->input->post('BANK_BUS_UNIT'),
                            "BANK_NAME1"=>$this->input->post('BANK_NAME1'),
                            "BANK_NAME2"=>$this->input->post('BANK_NAME2'),
                            "BANK_ACCOUNT"=>$this->input->post('BANK_ACCOUNT'),

                            "BANK_CONTACT"=>empty($this->input->post('BANK_CONTACT'))?NULL:$this->input->post('BANK_CONTACT'),
                            "BANK_ALLOW_PRE_NUM_CHKS"=>empty($this->input->post('BANK_ALLOW_PRE_NUM_CHKS'))?'N':$this->input->post('BANK_ALLOW_PRE_NUM_CHKS'),
                            "BANK_ALLOW_MANUAL_CHKS"=>empty($this->input->post('BANK_ALLOW_MANUAL_CHKS'))?'N':$this->input->post('BANK_ALLOW_MANUAL_CHKS'),
                            "BANK_PRINT_CHK_TEST_PAGES"=>empty($this->input->post('BANK_PRINT_CHK_TEST_PAGES'))?'N':$this->input->post('BANK_PRINT_CHK_TEST_PAGES'),
                            "BANK_NEXT_CHK_NUMBER"=>empty($this->input->post('BANK_NEXT_CHK_NUMBER'))?NULL:$this->input->post('BANK_NEXT_CHK_NUMBER'),
                            "BANK_STR_ADDR1"=>empty($this->input->post('BANK_STR_ADDR1'))?NULL:$this->input->post('BANK_STR_ADDR1'),
                            "BANK_STR_ADDR2"=>empty($this->input->post('BANK_STR_ADDR2'))?NULL:$this->input->post('BANK_STR_ADDR2'),
                            "BANK_STR_ADDR3"=>empty($this->input->post('BANK_STR_ADDR3'))?NULL:$this->input->post('BANK_STR_ADDR3'),
                            "BANK_COUNTRY_ID"=>empty($this->input->post('BANK_COUNTRY_ID'))?NULL:$this->input->post('BANK_COUNTRY_ID'),
                            "BANK_STATE_ID"=>empty($this->input->post('BANK_STATE_ID'))?NULL:$this->input->post('BANK_STATE_ID'),
                            "BANK_CITY_ID"=>empty($this->input->post('BANK_CITY_ID'))?NULL:$this->input->post('BANK_CITY_ID'),
                            "BANK_POSTAL_CODE_ID"=>empty($this->input->post('BANK_POSTAL_CODE_ID'))?NULL:$this->input->post('BANK_POSTAL_CODE_ID'),
                            "BANK_PHONE1"=>empty($this->input->post('BANK_PHONE1'))?NULL:$this->input->post('BANK_PHONE1'),
                            "BANK_PHONE2"=>empty($this->input->post('BANK_PHONE2'))?NULL:$this->input->post('BANK_PHONE2'),
                            "BANK_FAX1"=>empty($this->input->post('BANK_FAX1'))?NULL:$this->input->post('BANK_FAX1'),
                            "BANK_FAX2"=>empty($this->input->post('BANK_FAX2'))?NULL:$this->input->post('BANK_FAX2'),
                            "BANK_E_MAIL1"=>empty($this->input->post('BANK_E_MAIL1'))?NULL:$this->input->post('BANK_E_MAIL1'),
                            "BANK_E_MAIL2"=>empty($this->input->post('BANK_E_MAIL2'))?NULL:$this->input->post('BANK_E_MAIL2'),
                            "BANK_EDI1"=>empty($this->input->post('BANK_EDI1'))?NULL:$this->input->post('BANK_EDI1'),
                            "BANK_EDI2"=>empty($this->input->post('BANK_EDI2'))?NULL:$this->input->post('BANK_EDI2'),
                      
                            "BANK_NOTES"=>empty($this->input->post('BANK_NOTES'))?'N/A':$this->input->post('BANK_NOTES'),
                            "BANK_CRE_BY"=>$userCon->USERNAME,
                        );
                     
                if($this->unicon->updateArrayUniversal('BANKS',$data,NULL)){
                $url = "<script>location.reload();</script>>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$url));
                }else{
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                }
            }
        }

        /*================================ EMPLOYEE TABLE LIST ==============================*/
        
        public function empListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'EMP_CODE','EMP_NAME1','EMP_PHONE1','EMP_STR_ADDR1','EMPC_NAME',NULL),
                "column_search" => array('EMP_CODE','EMP_NAME1','EMP_PHONE1','EMP_STR_ADDR1','EMPC_NAME'),
                "order" => array('EMP_ID' => 'desc')
            );
            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'EMPLOYEE',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'EMP_CATEGORY',
                    "JOIN_1_TABLE_CONN"=>'EMP_CATEGORY.EMPC_CODE=EMPLOYEE.EMP_CAT_ID',
            );


            $sqlQuery = datatableSqlData($sqlQueryTemp);
            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $empCode = dataEncyptbase64($rowdata->EMP_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->EMP_CODE;
                $row[] = $rowdata->EMP_NAME1;
                $row[] = $rowdata->EMP_PHONE1;
                $row[] = $rowdata->EMP_STR_ADDR1;
                $row[] = "<p>Username : <strong>{$rowdata->EMP_CODE}</strong></p></br><p>Password : <strong>{$rowdata->EMP_EDI2}</strong></p>";
                $row[] = $rowdata->EMPC_NAME;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('EmployeesAdd?tokenid=').$empCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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

        /*================================ SALESMAN TABLE LIST ==============================*/
        
        public function salesManListJson(){
            $dataPostArr = array(
                                    "whse_code" => $this->input->post('whse_code'),
                                );
                              
            $filterdata = array(
                "column_order" => array(NULL,'SLSP_CODE','EMP_CODE','EMP_NAME1','SA_DESC','EMPC_NAME',NULL),
                "column_search" => array('SLSP_CODE','EMP_CODE','EMP_NAME1','SA_DESC','EMPC_NAME'),
                "order" => array('SLSP_CODE' => 'desc')
            );
            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'SALES_PERSON',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'EMPLOYEE',
                    "JOIN_1_TABLE_CONN"=>'EMPLOYEE.EMP_CODE=SALES_PERSON.SLSP_EMPLOYEE_CODE',

                "JOIN_2_CONTROL" => TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_2_TABLE_NAME" => 'SALES_AREAS',
                    "JOIN_2_TABLE_CONN" => 'SALES_AREAS.SA_SALES_AREA=SALES_PERSON.SLSP_SALES_AREA',

                "JOIN_3_CONTROL" => TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_3_TABLE_NAME" => 'EMP_CATEGORY',
                    "JOIN_3_TABLE_CONN" => 'EMP_CATEGORY.EMPC_CODE=EMPLOYEE.EMP_CAT_ID',
            );

            if(isset($dataPostArr['whse_code'])){
                $whseCodeArr = [];
                foreach ($dataPostArr['whse_code'] as $getWhseData) {
                    if($getWhseData){
                        $whseCodeArr[] = "'$getWhseData'";
                    }
                }
                if(count($whseCodeArr)>0){
                    $empDatadb = $this->unicon->CoreQuery("SELECT SLSP_EMPLOYEE_CODE FROM SALES_PERSON,SALES_MAN_ASSIGN_WHSE WHERE SLSP_CODE = SMSW_SLSP_CODE AND SMSW_WHSE_CODE IN(".implode(",",$whseCodeArr).") GROUP BY SLSP_EMPLOYEE_CODE","result");
                    $empCodeArr = [];
                    foreach ($empDatadb as $empDatadbgetData) {
                        $empCodeArr[] = "'{$empDatadbgetData->SLSP_EMPLOYEE_CODE}'";
                    }
                }


                $sqlQueryTemp["CORE_WHERE_1_CONTROL"] = TRUE;  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                $sqlQueryTemp["CORE_WHERE_1_DATA"] = "EMPLOYEE.EMP_CODE IN(".implode(",",$empCodeArr).")";
            }

            $sqlQuery = datatableSqlData($sqlQueryTemp);
            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                
                $no++; $row = array();
                $row[] = $no.".";
              
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->SLSP_CODE;
                $row[] = $rowdata->EMP_CODE;
                $row[] = $rowdata->EMP_NAME1;
                $row[] = $rowdata->SA_DESC;
                $row[] = "<button  data-salecode='{$rowdata->SLSP_CODE}' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='#standard_model' onClick='viewUnitDet(this)'>View detail</button>";
                $row[] = $rowdata->EMPC_NAME;
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
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