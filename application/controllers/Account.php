<?php
     class Account extends CI_Controller{
         public function __construct(){
            parent::__construct();
      
            // $this->load->model('Site_model', 'dbcon');
            $this->load->model('Universal_model','unicon');
            // $this->load->library('form_validation');
            // $this->load->helper('form');
            //$this->load->model('QrController','qrcon');
            $this->load->model('FunctionAndProcedure_model','profunccon');
         }

        public function newAccSetAdd(){
            
            header('Content-Type: application/json');

            $userCon = sessionUserData();

            $this->form_validation->set_rules('AH_BUS_UNIT', 'business name', 'required');
            $this->form_validation->set_rules('AH_MAIN_HEAD', 'Main head', 'required');
            $this->form_validation->set_rules('AH_SUB_HEAD', 'Sub head', 'required');
            $this->form_validation->set_rules('AH_GENERAL', 'General', 'required');
            $this->form_validation->set_rules('AH_SUBSIDERY', 'Subsidiary', 'required');
            $this->form_validation->set_rules('EN_Title', 'English title', 'required');
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{

                $data = [
                            "AH_BUS_UNIT"=>$this->input->post('AH_BUS_UNIT'),
                            "AH_SORT_SEQ"=>$this->input->post('AH_SORT_SEQ'),
                            "AH_MAIN_HEAD"=>$this->input->post('AH_MAIN_HEAD'),
                            "AH_SUB_HEAD"=>$this->input->post('AH_SUB_HEAD'),
                            "AH_GENERAL"=>$this->input->post('AH_GENERAL'),
                            "AH_SUBSIDERY"=>$this->input->post('AH_SUBSIDERY'),
                            "AC_STATUS"=>$this->input->post('AC_STATUS'),
                            "EN_Title"=>$this->input->post('EN_Title'),
                            "AR_Title"=>empty($this->input->post('AR_Title'))?null:$this->input->post('AR_Title'),
                            "AC_NOTES"=>empty($this->input->post('AC_NOTES'))?'N/A':$this->input->post('AC_NOTES'),
                            "AC_CRE_BY"=>$userCon->USERNAME,
                            "AC_CRE_DATE"=>dateTime()
                        ];
                if($this->unicon->insertUniversal('ACCOUNT_HEADS',$data)){
                
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
              
                
                }else{

                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }
        }

        public function glProfileMOduleAdddb(){
            
            header('Content-Type: application/json');

            $userCon = sessionUserData();
            $moduleType = $this->input->post('GLMP_MODULE');
            $this->form_validation->set_rules('GLMP_BUS_UNIT',' Business Unit','required');
            $this->form_validation->set_rules('GLMP_MODULE','Module Name','required');
            $this->form_validation->set_rules('GLMP_TYPE',' Type','required');
            if($moduleType == 'SO'){
                $this->form_validation->set_rules('GLMP_RTN',' return','required');
                $this->form_validation->set_rules('GLMP_RECV_IN',' received by','required');
            }
            
            $this->form_validation->set_rules('GLMP_COST_CENTER','Cost Center Account','required');
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $glBatchCode = $this->input->post('GL_BATCH_CODE');
                
                    if($glBatchCode){
                        $this->unicon->CoreQuery("DELETE FROM GL_MODULE_PROFILE_UP WHERE GLMP_BATCH_CODE='$glBatchCode'");
                    }

                $accType = $this->input->post('acc_type');
                $accNo = $this->input->post('account_det');
                $transType = $this->input->post('trans_type');
                $remark = $this->input->post('GLMP_REMARK');
                $batchCode = $glBatchCode?$glBatchCode:random_strings(10);
                $ret = false;
                foreach ($accNo as $accNoKey => $accNoValue) {
                    if($accNoValue && $accType[$accNoKey] && $transType[$accNoKey]){
                        $data = array(
                            "GLMP_BATCH_CODE"=>$batchCode,
                            "GLMP_BUS_UNIT"=>$this->input->post('GLMP_BUS_UNIT'),
                            "GLMP_MODULE"=>$this->input->post('GLMP_MODULE'),
                            "GLMP_TYPE"=>$this->input->post('GLMP_TYPE'),
                            "GLMP_RTN"=>$this->input->post('GLMP_RTN'),
                            "GLMP_RECV_IN"=>$this->input->post('GLMP_RECV_IN'),
                            "GLMP_ACCOUNT_TYPE"=>$accType[$accNoKey],
                            "GLMP_ACCOUNT_NO"=>$accNoValue,
                            "GLMP_ENTRY_TYPE"=>$transType[$accNoKey],
                            "GLMP_COST_CENTER"=>$this->input->post('GLMP_COST_CENTER'),
                            "GLMP_REMARK"=>$remark[$accNoKey],
                            "GLMP_CRE_BY"=>$userCon->USERNAME,
                            "GLMP_CRE_DATE"=>dateTime()
                        );
                  
                        $ret = $this->unicon->insertUniversal('GL_MODULE_PROFILE_UP',$data);
                    }
                }
                
                if($ret){
                
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
              
                
                }else{

                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }
        }

        // TESTING START
        public function glProfileMOduleAdddbtest(){
            
            header('Content-Type: application/json');

            $userCon = sessionUserData();
            $rev = $this->input->post('GLMP_RECV_IN');
            $this->form_validation->set_rules('GLMP_BUS_UNIT',' Business Unit','required');
            $this->form_validation->set_rules('GLMP_MODULE','Module Name','required');
            $this->form_validation->set_rules('GLMP_TYPE',' Type','required');
            $this->form_validation->set_rules('GLMP_RTN',' return','required');
            $this->form_validation->set_rules('GLMP_RECV_IN',' received by','required');
            $this->form_validation->set_rules('GLMP_VAT_AC',' vat Account','required');
            $this->form_validation->set_rules('GLMP_COGS_AC','Cost Goods Account','required');
            $this->form_validation->set_rules('GLMP_INVENTORY_AC','Inventory Account','required');
            $this->form_validation->set_rules('GLMP_INCOME_AC','Income Account','required');
            $this->form_validation->set_rules('GLMP_DISCOUNT_AC','Discount Account','required');
            $this->form_validation->set_rules('GLMP_COST_CENTER','Cost Center Account','required');
            $this->form_validation->set_rules('GLMP_ADS_AC','Advertisement Account','required');
            $this->form_validation->set_rules('GLMP_ENTRY_TYPE','Entry Type','required');
            if(isset($rev)){
                if($rev == 'C'){
                    $this->form_validation->set_rules('CASH_ON_HAND_AC','Cash on Hand Account','required');
                }
            }
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{

                $data = [
                            "GLMP_BUS_UNIT"=>$this->input->post('GLMP_BUS_UNIT'),
                            "GLMP_MODULE"=>$this->input->post('GLMP_MODULE'),
                            "GLMP_TYPE"=>$this->input->post('GLMP_TYPE'),
                            "GLMP_RTN"=>$this->input->post('GLMP_RTN'),
                            "GLMP_RECV_IN"=>$this->input->post('GLMP_RECV_IN'),
                            "GLMP_VAT_AC"=>$this->input->post('GLMP_VAT_AC'),
                            "GLMP_COGS_AC"=>$this->input->post('GLMP_COGS_AC'),
                            "GLMP_INVENTORY_AC"=>$this->input->post('GLMP_INVENTORY_AC'),
                            "GLMP_INCOME_AC"=>$this->input->post('GLMP_INCOME_AC'),
                            "GLMP_COST_CENTER"=>$this->input->post('GLMP_COST_CENTER'),
                            "GLMP_ADS_AC"=>$this->input->post('GLMP_ADS_AC'),
                            "GLMP_ENTRY_TYPE"=>$this->input->post('GLMP_ENTRY_TYPE'),
                            "CASH_ON_HAND_AC"=>$this->input->post('CASH_ON_HAND_AC'),
                            "GLMP_CRE_BY"=>$userCon->USERNAME,
                            "GLMP_CRE_DATE"=>dateTime()
                        ];
                if($this->unicon->insertUniversal('GL_MODULE_PROFILE',$data)){
                
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
              
                
                }else{

                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }
        }
        // TESTING END

        public function glEntryCreate(){
            
            header('Content-Type: application/json');

            $userCon = sessionUserData();
            // $this->form_validation->set_rules('no_of_entry','Account Detail','required|numeric'); 
            $glPreDb = $this->input->post('gl_pre_db');
            $glOrderDb = $this->input->post('gl_order_db');
            $this->form_validation->set_rules('GLJH_BUS_UNIT',' Business Unit','required');
            if(!$glPreDb && !$glOrderDb){
                $this->form_validation->set_rules('GLJH_JOURNAL_PFX','GL Prefix','required');
            }
            $this->form_validation->set_rules('GLJH_JOURNAL_NO',' journal no','required');
            $this->form_validation->set_rules('GLJH_DESC',' Description','required');
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                
                if($glPreDb && $glOrderDb){
                    $this->unicon->CoreQuery("DELETE FROM GL_JOURNAL_DETAIL WHERE GLJL_JOURNAL_PFX = '$glPreDb' AND GLJL_JOURNAL_NO = '$glOrderDb'");
                }else{
                    $glPre = glPrefix(array('where'=>"WHERE GLP_JOURNAL_PFX = '{$this->input->post('GLJH_JOURNAL_PFX')}'",'dataType'=>'row'));
                    $this->unicon->CoreQuery("UPDATE GL_PREFIXES SET GLP_NEXT_NUMBER = GLP_NEXT_NUMBER+1 WHERE GLP_JOURNAL_PFX = '{$this->input->post('GLJH_JOURNAL_PFX')}'");
                }
                
                
                $accNo = $this->input->post('acc_no_db');
                $accDesc = $this->input->post('acc_desc_db');
                $accDebitVal = $this->input->post('debit_val_db');
                $accCreditVal = $this->input->post('credit_val_db');
                $costCent = $this->input->post('cost_center_db');
                $docDate = $this->input->post('doc_date_db');
                $glCount = 0;
                foreach ($accNo as $accNoKey => $accNoVal) {
                        $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='$accNoVal'",'dataType'=>'row']);
                        $detArr = array(
                                        "GLJL_BUS_UNIT" =>$this->input->post('GLJH_BUS_UNIT'),
                                        "GLJL_JOURNAL_PFX" =>$glOrderDb && $glPreDb?$glPreDb:$this->input->post('GLJH_JOURNAL_PFX'),
                                        "GLJL_JOURNAL_NO" =>$glOrderDb && $glPreDb?$glOrderDb:$glPre->GLP_NEXT_NUMBER,
                                        "GLJL_JOURNAL_LN" =>++$glCount,
                                        "GLJL_ACCT_LVL1" =>$accNoVal,
                                        "GLJL_COST_CENTER" =>$costCent[$accNoKey],
                                        "GLJL_DESC" =>$accDesc[$accNoKey],
                                        "GLJL_DEBIT_AMT" =>$accDebitVal[$accNoKey],
                                        "GLJL_CREDIT_AMT" =>$accCreditVal[$accNoKey],
                                        "GLJL_DOC_DATE" =>$docDate[$accNoKey],
                                        "GLJL_CRE_BY" =>$userCon->USERNAME,
                                        "GLJL_CRE_DATE" =>dateTime()
                                    );
                    $this->unicon->insertUniversal('GL_JOURNAL_DETAIL',$detArr);
                }
                $data = array(
                                "GLJH_BUS_UNIT" =>$this->input->post('GLJH_BUS_UNIT'),
                                // "GLJH_JOURNAL_PFX" =>$this->input->post('GLJH_JOURNAL_PFX'),
                                // "GLJH_JOURNAL_NO" =>$this->input->post('GLJH_JOURNAL_NO'),
                                "GLJH_DESC" =>$this->input->post('GLJH_DESC'),
                                "GLJH_JOURNAL_DATE" =>$this->input->post('gl_date_db'),
                                "GLJH_JOURNAL_REF" =>$this->input->post('GLJH_JOURNAL_REF'),
                                "GLJH_YEAR" =>date('Y'),
                                "GLJH_PERIOD" =>date('m'),
                                // "GLJH_POSTED_DATE" =>date('Y-m-d'),
                                // "GLJH_CRE_BY" =>$userCon->USERNAME,
                                // "GLJH_CRE_DATE" =>dateTime()
                            );
                if($glPreDb && $glOrderDb){
                    // $data["GLJH_POSTED_DATE"] = date('Y-m-d');
                    // $data["GLJH_JOURNAL_ACTION"] = 'P';
                    // $data["GLJH_POST_BY"] = $userCon->USERNAME;
                    // $data["GLJH_CRE_POST_BY"] = dateTime();
                   $this->unicon->updateArrayUniversal('GL_JOURNAL_HEADER',$data,"GLJH_JOURNAL_PFX = '$glPreDb' AND GLJH_JOURNAL_NO = '$glOrderDb'");
                        $this->session->set_flashdata(['ALERT_MSG'=>"<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            GL ENTRY SUCCESSFULLY UPDATED -- $glPreDb-$glOrderDb.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                        $urlRed = "<script>window.setTimeout(function(){window.location.replace('".base_url('glEntryList')."')},1000);</script>";
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$urlRed));
                    // }else{
                    //     echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    // }
                }else{
                    $data["GLJH_CRE_BY"] = $userCon->USERNAME;
                    $data["GLJH_CRE_DATE"] = dateTime();
                    $data["GLJH_JOURNAL_PFX"] = $this->input->post('GLJH_JOURNAL_PFX');
                    $data["GLJH_JOURNAL_NO"] = $glPre->GLP_NEXT_NUMBER;
                    if($this->unicon->insertUniversal('GL_JOURNAL_HEADER',$data)){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
                
            }
        }
        public function glEntryListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'GLJH_BUS_UNIT','GLJH_JOURNAL_PFX','GLJH_JOURNAL_NO','GLJH_DESC','GLJH_JOURNAL_DATE',NULL),
                "column_search" => array('GLJH_BUS_UNIT','GLJH_JOURNAL_PFX','GLJH_JOURNAL_NO','GLJH_DESC','GLJH_JOURNAL_DATE'),
                "order" => array('GLJH_ID' => 'desc')
            );

            $dataPost = (object)array(
                "POST_TYPE" =>$this->input->post('post_type'),
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'GL_JOURNAL_HEADER',

                "WHERE_1_CONTROL"=>TRUE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "WHERE_1_COL_NAME"=>'GLJH_JOURNAL_ACTION',
                        "WHERE_1_DATA"=>$dataPost->POST_TYPE,
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $glId = dataEncyptbase64($rowdata->GLJH_ID,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->GLJH_BUS_UNIT;
                $row[] = $rowdata->GLJH_JOURNAL_PFX;
                $row[] = $rowdata->GLJH_JOURNAL_NO;
                $row[] = $rowdata->GLJH_JOURNAL_REF;
                $row[] = $rowdata->GLJH_DESC;
                $row[] = $rowdata->GLJH_JOURNAL_DATE;
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            
                             <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('glEntry?tokenid=').$glId."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
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

        public function newAccSetupListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'AH_SUBSIDERY','AR_Title','EN_Title','AH_GENERAL','AH_SUB_HEAD','AH_MAIN_HEAD',NULL),
                "column_search" => array('AH_SUBSIDERY','AR_Title','EN_Title','AH_GENERAL','AH_SUB_HEAD','AH_MAIN_HEAD'),
                "order" => array('AH_RECNO' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'ACCOUNT_HEADS',

                "JOIN_1_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
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
                $CuntyCode = dataEncyptbase64($rowdata->AH_RECNO,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
       
                $row[] = $rowdata->AH_SUBSIDERY;
                $row[] = $rowdata->AR_Title;
                $row[] = $rowdata->EN_Title;
                $row[] = $rowdata->AH_GENERAL;
                $row[] = $rowdata->AH_SUB_HEAD;
                $row[] = $rowdata->AH_MAIN_HEAD;
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

        public function glProfileModuleListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'GLMP_BUS_UNIT','GLMP_MODULE','GLMP_TYPE','GLMP_RTN','GLMP_RECV_IN','GLMP_COST_CENTER',null,NULL),
                "column_search" => array('GLMP_BUS_UNIT','GLMP_MODULE','GLMP_TYPE','GLMP_RTN','GLMP_RECV_IN','GLMP_COST_CENTER'),
                "order" => array('GLMP_ID' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'GL_MODULE_PROFILE_UP',

                "GROUP_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "GROUP_1_DATA"=>'GLMP_BATCH_CODE',

                "JOIN_1_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
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
                $glId = dataEncyptbase64($rowdata->GLMP_BATCH_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
             
                $row[] = $rowdata->GLMP_BUS_UNIT;
                $row[] = $rowdata->GLMP_MODULE;
                $row[] = $rowdata->GLMP_TYPE;
                $row[] = $rowdata->GLMP_RTN;
                $row[] = $rowdata->GLMP_RECV_IN;

                $row[] = $rowdata->GLMP_COST_CENTER;

                $row[] = "<button  data-batchcode='{$rowdata->GLMP_BATCH_CODE}' data-modulecode='{$rowdata->GLMP_MODULE}' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='#standard_model' onClick='viewAccDet(this)'>View Linked Account</button>";

                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            
                             <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('glMudleProfle?tokenid=').$glId."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
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

        public function glProfileModuleTestListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'GLMP_BUS_UNIT','GLMP_MODULE','GLMP_TYPE','GLMP_RTN','GLMP_RECV_IN','GLMP_VAT_AC','GLMP_COGS_AC','GLMP_INVENTORY_AC','GLMP_INCOME_AC','GLMP_DISCOUNT_AC','GLMP_COST_CENTER','GLMP_ADS_AC','GLMP_ENTRY_TYPE',NULL),
                "column_search" => array('GLMP_BUS_UNIT','GLMP_MODULE','GLMP_TYPE','GLMP_RTN','GLMP_RECV_IN','GLMP_VAT_AC','GLMP_COGS_AC','GLMP_INVENTORY_AC','GLMP_INCOME_AC','GLMP_DISCOUNT_AC','GLMP_COST_CENTER','GLMP_ADS_AC','GLMP_ENTRY_TYPE'),
                "order" => array('GLMP_ID' => 'desc')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'GL_MODULE_PROFILE',

                "JOIN_1_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
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
                $CuntyCode = dataEncyptbase64($rowdata->GLMP_ID,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
             
                $row[] = $rowdata->GLMP_BUS_UNIT;
                $row[] = $rowdata->GLMP_MODULE;
                $row[] = $rowdata->GLMP_TYPE;
                $row[] = $rowdata->GLMP_RTN;
                $row[] = $rowdata->GLMP_RECV_IN;
                $vatT = accHeadDet(['where'=>"WHERE AH_SUBSIDERY = '{$rowdata->GLMP_VAT_AC}'",'dataType'=>'row']);
                $row[] = $vatT?"{$rowdata->GLMP_VAT_AC}<br>{$vatT->EN_Title}<br>{$vatT->AR_Title}":'NOT LINKED';

                $ccgT = accHeadDet(['where'=>"WHERE AH_SUBSIDERY = '{$rowdata->GLMP_COGS_AC}'",'dataType'=>'row']);
                $row[] = $ccgT?"{$rowdata->GLMP_COGS_AC}<br>{$ccgT->EN_Title}<br>{$ccgT->AR_Title}":'NOT LINKED';
                // $row[] = $rowdata->GLMP_COGS_AC;

                $intT = accHeadDet(['where'=>"WHERE AH_SUBSIDERY = '{$rowdata->GLMP_INVENTORY_AC}'",'dataType'=>'row']);
                $row[] = $intT?"{$rowdata->GLMP_INVENTORY_AC}<br>{$intT->EN_Title}<br>{$intT->AR_Title}":'NOT LINKED';
                // $row[] = $rowdata->GLMP_INVENTORY_AC;

                $incT = accHeadDet(['where'=>"WHERE AH_SUBSIDERY = '{$rowdata->GLMP_INCOME_AC}'",'dataType'=>'row']);
                $row[] = $incT?"{$rowdata->GLMP_INCOME_AC}<br>{$incT->EN_Title}<br>{$incT->AR_Title}":'NOT LINKED';
                // $row[] = $rowdata->GLMP_INCOME_AC;

                $disT = accHeadDet(['where'=>"WHERE AH_SUBSIDERY = '{$rowdata->GLMP_DISCOUNT_AC}'",'dataType'=>'row']);
                $row[] = $disT?"{$rowdata->GLMP_DISCOUNT_AC}<br>{$disT->EN_Title}<br>{$disT->AR_Title}":'NOT LINKED';
                // $row[] = $rowdata->GLMP_DISCOUNT_AC;

                $adsT = accHeadDet(['where'=>"WHERE AH_SUBSIDERY = '{$rowdata->GLMP_ADS_AC}'",'dataType'=>'row']);
                $row[] = $adsT?"{$rowdata->GLMP_ADS_AC}<br>{$adsT->EN_Title}<br>{$adsT->AR_Title}":'NOT LINKED';
                // $row[] = $rowdata->GLMP_ADS_AC;

                $row[] = $rowdata->GLMP_COST_CENTER;
                $row[] = $rowdata->GLMP_ENTRY_TYPE == 'D'?'Debit':'Credit';

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

        public function saleCash(){

            echo round(80.01);
            // $orderDet = (object)array('temp_id'=>'4TYJLECE6V','order_count'=>'000055');
            // print_r($orderDet);
            // $this->accountlib->cashInvoice($orderDet);
        }

        public function getGlTranacDet(){
            header('Content-Type: application/json');

            $incPre = $this->input->post('inc_pre');
            $incCount = $this->input->post('inc_count');
            $moduleType = $this->input->post('module_type');
            if(isset($moduleType)){
                $moduleType = $moduleType !='N'?"AND GLAT_APPL = '$moduleType'":NULL;
            }else{
                $moduleType = NULL;
            }

            $GLDet = $this->unicon->CoreQuery("SELECT * FROM GL_APPL_TRANS 
                                            WHERE GLAT_INVOICE_NO = '{$incCount}'
                                            AND GLAT_INVOICE_PFX = '{$incPre}' $moduleType","result");
            echo json_encode(array("get_data"=>$GLDet));
        }

        //SYSTEM GL CREATE START
        public function systemGlCreate(){
            
            header('Content-Type: application/json');

            $userCon = sessionUserData();
            $this->form_validation->set_rules('from_date_db','from date','required');
            $this->form_validation->set_rules('to_date_db','to date','required');
            $this->form_validation->set_rules('whse_code_db','warehouse code','required');
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $glType = $this->input->post('gl_type');
                $dataArr = (object)array(
                                    'from_date'=>$this->input->post('from_date_db'),
                                    'to_date'=>$this->input->post('to_date_db'),
                                    'whse_code'=>$this->input->post('whse_code_db'),
                                    'gl_type' =>$glType,
                                );
                if($glType == 'Sale'){
                    $tr = $this->accountlib->saleGlentry($dataArr);
                }elseif ($glType == 'NPO' || $glType == 'CPO') {
                        
                    // $tr = $this->accountlib->poGlentry($dataArr);
                    $tr = $this->accountlib->poGlentryEachPoEntry($dataArr);

                }elseif ($glType == 'Transfer'){
                    $tr = $this->accountlib->transGlentry($dataArr);
                }            
                // if($this->unicon->insertUniversal('GL_MODULE_PROFILE',$data)){  
                if($tr){  
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                }else{
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
                }
            }
        }

        //POST GL ENTRY CREATE
        public function postGlEntryCreate(){
            
            header('Content-Type: application/json');

            $userCon = sessionUserData();
            $this->form_validation->set_rules('from_date_db','from date','required');
            $this->form_validation->set_rules('to_date_db','to date','required');
            $this->form_validation->set_rules('gl_prefix_db','gl prefix','required');
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $glType = $this->input->post('gl_type');
                $dataArr = (object)array(
                                    'from_date'=>$this->input->post('from_date_db'),
                                    'to_date'=>$this->input->post('to_date_db'),
                                    'gl_prefix'=>$this->input->post('gl_prefix_db'),
                                    'gl_type' =>$glType,
                                );
                $data = array(
                                'GLJH_JOURNAL_ACTION' => 'P',
                                'GLJH_POSTED_DATE' => date('Y-m-d'),
                                'GLJH_POST_BY' =>$userCon->USERNAME,
                                'GLJH_CRE_POST_BY' =>dateTime(),
                            );             
                // if($this->unicon->insertUniversal('GL_MODULE_PROFILE',$data)){  
                $where = "GLJH_JOURNAL_DATE BETWEEN '{$dataArr->from_date}' AND '{$dataArr->to_date}' AND GLJH_JOURNAL_ACTION = 'N' AND GLJH_JOURNAL_PFX = '{$dataArr->gl_prefix}'";
                if($this->unicon->updateArrayUniversal('GL_JOURNAL_HEADER',$data,$where)>0){  
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Updated Successfully"));
                }else{
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and GL Prefix"));
                }
            }
        }
        //SYSTEM GL CREATE END
        public function testCust(){
            $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
            $pdf = $this->pdf->load();
            $pdf->AddPage('P', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                3, // margin top
                3, // margin bottom
                2, // margin header
                2); // margin footer'
                $pdf->SetHTMLHeader('<div style="text-align: right; font-weight: bold;">My document</div>');
            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
            $pdf->WriteHTML($html);
            $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
            // print_r(itemGoldDia('00404758'));
            // $this->wallet->saleCreditWallet('IFYPJ5DLFV');
            // $this->accountlib->accountReceivable((object)array('orderPre'=>'D07','orderNo'=>'2'));
            // $get = $this->accountlib->stockTransfer((object)array('orderid'=>687440,'type'=>'TRANSFER','module'=>'INV'));
            // echo $get;

            // $accArr = (object)array('temp_id'=>'NPO14','module'=>'PO','type'=>'PURCHASE','rtnType'=>'N');
            // $this->accountlib->puchaseReceived($accArr);
        }
    }