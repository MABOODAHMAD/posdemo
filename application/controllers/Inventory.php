<?php
     class Inventory extends CI_Controller{
         public function __construct(){
            parent::__construct();
            $this->load->model('Universal_model','unicon');
         }

         
        public function stockTransTransotUpdate(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
            $transResn = $this->input->post('trns_resn');
            $orderNo = $this->input->post('order_no_db');
            $trnsStatus = $this->input->post('trns_status');
            $stockTransferOrderDets = StockTransferOrderDet(["where" => "WHERE STH_ORDER_NO = '$orderNo'", "dataType" => 'result']);
            $stockChk = false;
            foreach ($stockTransferOrderDets as $stockTransferOrderDet) {
                $item_P = array(
                    "dataType" => 'row',
                    "itemCode" => $stockTransferOrderDet->STD_ITEM_CODE,
                    "whseId" => $stockTransferOrderDet->STH_FROM_WHSE,
                );
                $stockDet = itemStockDet($item_P);
                if($stockDet >= $stockTransferOrderDet->STD_TRANS_QTY){
                    $stockChk = true;
                }else{
                    $stockChk = false;
                    break;
                }
            }
        // if ($stockChk) {
            if ($transResn == 200) {
                $data = [
                    "STH_STATUS" => "RECEIVED"
                ];
                $updateWhere = "STH_ORDER_NO = '$orderNo'";
                $stockChk = true;
            } elseif ($transResn == 201 && $stockChk) {
                
                $trnsStausIn = $trnsStatus == 'ORDER' ? 'IN-TRANSIT' : 'RECEIVED';
                
                $data = [
                    "STH_STATUS" => $trnsStausIn
                ];
                $updateWhere = "STH_ORDER_NO = '$orderNo'";
                $stockChk = true;
            } elseif ($transResn == 202 && $stockChk) {
                $data = [
                    "STH_STATUS" => "RECEIVED"
                ];
                $updateWhere = "STH_ORDER_NO = '$orderNo'";
                $stockChk = true;
            } elseif ($transResn == 204) {
                $data = [
                    "STH_STATUS" => "RECEIVED"
                ];
                $updateWhere = "STH_ORDER_NO = '$orderNo'";
                $stockChk = true;
            }else{
                $stockChk = false;
            }

            if ($trnsStatus == 'ORDER') {
               $data['STH_PRINT_BY'] = $userCon->USERNAME;
               $data['STH_PRINT_DATETIME'] = dateTime();
            }elseif ($trnsStatus == 'IN-TRANSIT') {
                $data['STH_RECEIVED_BY'] = $userCon->USERNAME;
                $data['STH_RECEIVED_DATETIME'] = dateTime();
            }
            $check = $stockChk?$this->unicon->updateArrayUniversal('STOCK_TRANSFER_HEADER',$data,$updateWhere):false;
            //ACCOUNT INTEGRATE
                if ($transResn == 201 && $stockChk) {
                    
                    $trnsStatus == 'ORDER' ? 'IN-TRANSIT' : $this->accountlib->stockTransfer((object)array('orderid'=>$orderNo,'type'=>'TRANSFER','module'=>'INV'));
                
                }
            //END
            //INVENTORY TRACKING INTEGRATE
                $this->commonlib->stockTransInvTrans($orderNo);
            //END
        // }else{
        //     $check = false;
        // }
            // $check = $this->unicon->updateArrayUniversal('STOCK_TRANSFER_HEADER',$data,$updateWhere);
            
            // NOTE :  WHAREHOUSE STOCK STATUS UPDATE AFTER TRANSFER HEADER UPDATE *** THROUGH TRIGGER : UPDATE_WHAREHOUSE_STOCK_STATUS
                // $check = false;
                if($check){    
                    echo json_encode(array("multi" => "false", "err" => "false", "msg" => "$transResn"));
                }elseif(!$stockChk){
                    echo json_encode(array("multi" => "false", "err" => "false", "msg" =>"stock_empty"));
                }else{
                    echo json_encode(array("multi" => "false", "err" => "true", "msg" => "Please add some item"));
                    }
            }
            
        public function stockTransOrderAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');

            $this->form_validation->set_rules('order_no_db', 'stock order no', 'required|unique_code_db[PRICE_CHANGER_HEADER.PCH_DOCUMENT_NO.Document No already used, Please reFresh this page]');
            $this->form_validation->set_rules('trans_resn_db', 'transfer reason', 'required');
            $this->form_validation->set_rules('STH_BUS_UNIT', 'Business Unit', 'required');
            $this->form_validation->set_rules('from_whse_db', 'from warehouse', 'required');
            $this->form_validation->set_rules('to_whse_db', 'to warehouse', 'required');
            
            if ($this->form_validation->run() === FALSE) {
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi" => "true", "err" => "true", "msg" => $omsg));
            } else {
                $orderNo = $this->input->post('order_no_db');
                $itemCode = $this->input->post('STD_ITEM_CODE');
                $listPrice = $this->input->post('STD_UNIT_LIST_PRICE');
                $qty = $this->input->post('STD_TRANS_QTY');
                $stockTransRule = $this->input->post('STD_TRANS_RULE');
                $check = false;
                
                // refrence_db
                $headerData = [
                    "STH_ORDER_NO" => $orderNo,
                    "STH_YEAR" => date("Y", strtotime($this->input->post('trans_date_db'))),
                    "STH_PERIOD" => date("m", strtotime($this->input->post('trans_date_db'))),
                    "STH_TRANS_DATE" => $this->input->post('trans_date_db'),
                    "STH_BUS_UNIT" => $this->input->post('STH_BUS_UNIT'),
                    "STH_TRANS_RSN" => $this->input->post('trans_resn_db'),
                    "STH_FROM_WHSE" => $this->input->post('from_whse_db'),
                    "STH_WHSE_TO" => $this->input->post('to_whse_db'),
                    "STH_STATUS" => "ORDER",
                    "STH_CRE_BY" => $userCon->USERNAME,
                    "STH_CRE_DATE" => dateTime(),
                ];

                $headerIn = true;
                foreach ($itemCode as $itemCodeKey => $itemCodeValue) {
                    
                    if($itemCode[$itemCodeKey]){
                        if ($listPrice[$itemCodeKey]>0) {
                            if ($qty[$itemCodeKey]>0) {
                                $headerIn?$this->unicon->insertUniversal('STOCK_TRANSFER_HEADER',$headerData):null;

                                $unitCost = itemUnitCost(['where' => "WHERE INVCOST_ITEM_CODE = '{$itemCode[$itemCodeKey]}' ORDER BY INVCOST_ID DESC LIMIT 1",'dataType'=>"row"]);
                                $unitCost = $unitCost?$unitCost->INVCOST_ACT_COST:0;
                                $detailData = [
                                    "STD_ORDER_NO" => $orderNo ,
                                    "STD_ITEM_CODE" => $itemCode[$itemCodeKey],
                                    "STD_UNIT_LIST_PRICE" => $listPrice[$itemCodeKey],
                                    "STD_TRANS_QTY" => $qty[$itemCodeKey],
                                    "STD_TRANS_RULE" => $stockTransRule[$itemCodeKey],
                                    "STD_UNIT_COST" => $unitCost,
                                    "STD_CRE_BY" =>$userCon->USERNAME,
                                ];
                              
                                $this->unicon->insertUniversal('STOCK_TRANSFER_DETAIL',$detailData);
                                // NOTE STOCK TRANSFER DETAIL INSERT WHAREHOUSE STOCK *** TRIGGER NAME : TRANSFER_ORDER_DETAILS_ADD_WHSE_STOCK ***
                                
                                $check = true;
                                $headerIn = false;
                            }
                        }
                    }
                }
                // for ($i=0; $i < count($itemCode) ; $i++) { 
                //     if($itemCode[$i] && $listPrice[$i]>0 && $qty[$i]>0){
                       
                //         $headerIn?$this->unicon->insertUniversal('STOCK_TRANSFER_HEADER',$headerData):null;

                //         $unitCost = itemUnitCost(['where' => "WHERE INVCOST_ITEM_CODE = '{$itemCode[$i]}' ORDER BY INVCOST_ID DESC LIMIT 1",'dataType'=>"row"]);
                //         $unitCost = $unitCost?$unitCost->INVCOST_ACT_COST:0;
                //         $detailData = [
                //             "STD_ORDER_NO" => $orderNo ,
                //             "STD_ITEM_CODE" => $itemCode[$i],
                //             "STD_UNIT_LIST_PRICE" => $listPrice[$i],
                //             "STD_TRANS_QTY" => $qty[$i],
                //             "STD_TRANS_RULE" => $stockTransRule[$i],
                //             "STD_UNIT_COST" => $unitCost,
                //             "STD_CRE_BY" =>$userCon->USERNAME,
                //         ];
                      
                //         $this->unicon->insertUniversal('STOCK_TRANSFER_DETAIL',$detailData);
                //         // NOTE STOCK TRANSFER DETAIL INSERT WHAREHOUSE STOCK *** TRIGGER NAME : TRANSFER_ORDER_DETAILS_ADD_WHSE_STOCK ***
                        
                //         $check = true;
                //         $headerIn = false;
                //     }
                // }
                
                if($check){
                    // $url = "<script>location.reload();</script>";
                    echo json_encode(array("multi" => "false", "err" => "false", "msg" => "Stock transfer order create Successfully"));
                }else{
                    echo json_encode(array("multi" => "false", "err" => "true", "msg" => "Please add some item"));
                    }
                }
            }

            public function inventoryListJson(){

                $sesData = sessionUserData();
                if ($sesData->USER_TYPE == 'USER') {
                    $whseAs = assignRoleBreak();
                    $redirectCont = false;
                    if(count($whseAs['whse_assign'])>0){

                    }else{
                        $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                            <i class='mdi mdi-alert-outline me-2'></i>
                                                            No warehouse has been assigned.
                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                        </div>"]);
                        $redirectCont = true;
                        
                    }
    
                    if(!dashRole(["role_check"=>"INVENTORY_INVENTORY_LIST"])){
                        $this->session->set_flashdata(['INVENTORY_LIST_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                            <i class='mdi mdi-alert-outline me-2'></i>
                                                            No inventory list has been assigned.
                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                        </div>"]);
                        $redirectCont = true;
                    }
                    if($redirectCont){
                        redirect(base_url("dashboard"),'refresh');
                    }
                }
                $whseCOde = $this->input->post('whse_code');

                $filterdata = array(
                    "column_order" => array(NULL,'I_CODE','I_DESC','VEN_CODE','I_CNTRY_CODE','I_CAT_CODE',NULL),
                    "column_search" => array('I_CODE','I_DESC','VEN_CODE','I_CNTRY_CODE','I_CAT_CODE'),
                    "order" => array('I_CRE_DATE' => 'DESC')
                );
    
                $sqlQueryTemp = array(
    
                    "SELECT"=>'*',
                    "FROM"=>'ITEMS',
    
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
                    
                    $itemCodeEncrpt = dataEncypt($rowdata->I_CODE,'encrypt');
                    $itemCodeBak = dataEncyptManual($rowdata->I_CODE, 'encrypt');
                    
                        $avlQty = 0;
                        $noOfWhareHoses = wherehouseDetail(['dataType' => 'result']);
                        foreach ($noOfWhareHoses as $noOfWhareHose) {
                            if (isset($whseCOde)) {
                                if ($whseCOde == $noOfWhareHose->WHSE_CODE || $whseCOde == 'ALL') {

                                    $item_P = array(
                                        "dataType" => 'row',
                                        "itemCode" => $rowdata->I_CODE,
                                        "whseId" => $noOfWhareHose->WHSE_CODE,
                                    );
                                    $avlQty += itemStockDet($item_P);
                                }
                            }else{
                                if($sesData->USER_TYPE == 'SUPERADMIN') {
                                    $item_P = array(
                                        "dataType" => 'row',
                                        "itemCode" => $rowdata->I_CODE,
                                        "whseId" => $noOfWhareHose->WHSE_CODE,
                                    );
                                    $avlQty += itemStockDet($item_P);
                                }elseif($sesData->USER_TYPE == 'USER'){
                                    // $whseAs = $whseAs['whse_assign'];
                                    foreach ($whseAs['whse_assign'] as $whseAsGetData) {
                                        
                                        if($whseAsGetData->SMSW_WHSE_CODE == $noOfWhareHose->WHSE_CODE){
                                            $item_P = array(
                                                "dataType" => 'row',
                                                "itemCode" => $rowdata->I_CODE,
                                                "whseId" => $noOfWhareHose->WHSE_CODE,
                                            );
                                            $avlQty += itemStockDet($item_P);
                                        }
                                    }
                                }
                            }
                        }
                    
                    if ($avlQty>0) {
                    $no++; $row = array();
                    $row[] = $no.".";
                    $row[] = "<img src='http://moallim.e-invoicesaudi.com/uploads/images/item/$rowdata->I_IMAGE_FILENAME' class='avatar-sm'>
                    <h5 class='text-truncate font-size-14'><a href='".base_url('ProductDetail?item_code=').$itemCodeEncrpt.'&item_code_bak='.$itemCodeBak."' class='text-dark'>$rowdata->I_CODE</a></h5>";
                    $row[] = $rowdata->I_DESC;
                    $row[] = "<span class='badge bg-success'>$avlQty</span>";
                    $row[] = $rowdata->VEN_CODE;
                    $row[] = $rowdata->I_SECONDARY_DESC;
                    $row[] = $rowdata->I_CAT_CODE;
                    if(dashRole(["role_check"=>"PRODUCT_VIEW_UNIT_COST"])){
                    $row[] = "<button  data-itemcode='{$rowdata->I_CODE}' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='#standard_model' onClick='viewUnitDet(this)'>View Uniit Cost</button>";
                    }
                    // $row[] = "<a href='".base_url('addItemTrait?item_code=').$itemCodeEncrpt.'&type=view'."'> <button type='button' class='btn btn-primary btn-sm btn-rounded'>View Details</button></a>";
                //   $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                //                 <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                //                     <a href='#' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                //                 </li>
                //             </ul>";
                        // if ($avlQty>0) {
                            $data[] = $row;
                        }
                    
                }
                $data = array_values_recursive($data);
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


            public function inventoryInvListJson(){

                $sesData = sessionUserData();
                if ($sesData->USER_TYPE == 'USER') {
                    $whseAs = assignRoleBreak();
                    $redirectCont = false;
                    if(count($whseAs['whse_assign'])>0){

                    }else{
                        $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                            <i class='mdi mdi-alert-outline me-2'></i>
                                                            No warehouse has been assigned.
                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                        </div>"]);
                        $redirectCont = true;
                        
                    }
    
                    if(!dashRole(["role_check"=>"INVENTORY_INVENTORY_LIST"])){
                        $this->session->set_flashdata(['INVENTORY_LIST_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                            <i class='mdi mdi-alert-outline me-2'></i>
                                                            No inventory list has been assigned.
                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                        </div>"]);
                        $redirectCont = true;
                    }
                    if($redirectCont){
                        redirect(base_url("dashboard"),'refresh');
                    }
                }
                $whseCOde = $this->input->post('whse_code');

                $filterdata = array(
                    "column_order" => array(NULL,'I_CODE','I_DESC','VEN_CODE','I_CNTRY_CODE','I_CAT_CODE',NULL),
                    "column_search" => array('I_CODE','I_DESC','VEN_CODE','I_CNTRY_CODE','I_CAT_CODE'),
                    "order" => array('I_CRE_DATE' => 'DESC')
                );
    
                $sqlQueryTemp = array(
    
                    "SELECT"=>'*,SUM(IT_TRANS_QTY) IT_TRANS_QTY_SUM',
                    "FROM"=>'ITEMS',
                    
                    "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "JOIN_1_TABLE_NAME"=>'INV_TRANS',
                        "JOIN_1_TABLE_CONN"=>'I_CODE=IT_ITEM',
                    
                    "GROUP_1_CONTROL"=>TRUE,
                        "GROUP_1_DATA"=>"IT_ITEM",

                    "HAVING_1_CONTROL"=>TRUE,
                        "HAVING_1_DATA"=>"IT_TRANS_QTY_SUM > 0",
    
                    "JOIN_2_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "JOIN_2_TABLE_NAME"=>'TRAIT_SUB_CATEGORY',
                        "JOIN_2_TABLE_CONN"=>'TRAIT_SUB_CATEGORY.TRAIT_CAT_ID=ITEM_TRAITS.ITM_TRAIT_CAT_CODE AND TRAIT_SUB_CATEGORY.TRAIT_SUB_CAT_CODE=ITEM_TRAITS.ITM_TRAIT_CODE',
                    
                    "WHERE_1_CONTROL"=>FALSE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "WHERE_1_COL_NAME"=>'ITEM_TRAITS.ITM_CODE',
                        "WHERE_1_DATA"=>'',
                );
                
                
                if (isset($whseCOde)) {
                    if($sesData->USER_TYPE == 'SUPERADMIN') {
                        $sqlQueryTemp['WHERE_1_CONTROL']= $whseCOde == "ALL"?FALSE:TRUE; // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                            $sqlQueryTemp['WHERE_1_COL_NAME']= "IT_WHSE";
                            $sqlQueryTemp['WHERE_1_DATA']= $whseCOde;
                    }elseif($sesData->USER_TYPE == 'USER'){
                        if ($whseCOde == 'ALL') {
                            $whseAss = array();
                            foreach ($whseAs['whse_assign'] as $whseAsGetData) {
                                    $whseAss[] = "'{$whseAsGetData->SMSW_WHSE_CODE}'";
                            }
                            $whseAss = implode($whseAss,",");
                            $sqlQueryTemp['CORE_WHERE_1_CONTROL']= TRUE;
                            $sqlQueryTemp['CORE_WHERE_1_DATA']= "IT_WHSE IN($whseAss)";
                        }else{
                            $sqlQueryTemp['WHERE_1_CONTROL']= $whseCOde == "ALL"?FALSE:TRUE; // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                                $sqlQueryTemp['WHERE_1_COL_NAME']= "IT_WHSE";
                                $sqlQueryTemp['WHERE_1_DATA']= $whseCOde;
                        }
                    }
                }else{
                    if($sesData->USER_TYPE == 'SUPERADMIN') {

                        $sqlQueryTemp['WHERE_1_CONTROL']= FALSE; // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        $sqlQueryTemp['WHERE_1_COL_NAME']= "IT_WHSE";
                        $sqlQueryTemp['WHERE_1_DATA']= $whseCOde;

                    }elseif($sesData->USER_TYPE == 'USER'){
                        // $whseAs = $whseAs['whse_assign'];
                        $whseAss = array();
                        foreach ($whseAs['whse_assign'] as $whseAsGetData) {
                                $whseAss[] = "'{$whseAsGetData->SMSW_WHSE_CODE}'";
                        }
                        $whseAss = implode($whseAss,",");
                        $sqlQueryTemp['CORE_WHERE_1_CONTROL']= TRUE;
                        $sqlQueryTemp['CORE_WHERE_1_DATA']= "IT_WHSE IN($whseAss)";
                    }
                }


                
                $sqlQuery = datatableSqlData($sqlQueryTemp);
    
                $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
    
                $data = array();
                $no = $this->input->post('start');
                foreach ($memData as $rowdata) {
                    
                    $itemCodeEncrpt = dataEncypt($rowdata->I_CODE,'encrypt');
                    $itemCodeBak = dataEncyptManual($rowdata->I_CODE, 'encrypt');
                    
                        $avlQty = 0;
                        // $noOfWhareHoses = wherehouseDetail(['dataType' => 'result']);
                        // foreach ($noOfWhareHoses as $noOfWhareHose) {
                        //     if (isset($whseCOde)) {
                        //         if ($whseCOde == $noOfWhareHose->WHSE_CODE || $whseCOde == 'ALL') {

                        //             $item_P = array(
                        //                 "dataType" => 'row',
                        //                 "itemCode" => $rowdata->I_CODE,
                        //                 "whseId" => $noOfWhareHose->WHSE_CODE,
                        //             );
                        //             $avlQty += itemStockDet($item_P);
                        //         }
                        //     }else{
                        //         if($sesData->USER_TYPE == 'SUPERADMIN') {
                        //             $item_P = array(
                        //                 "dataType" => 'row',
                        //                 "itemCode" => $rowdata->I_CODE,
                        //                 "whseId" => $noOfWhareHose->WHSE_CODE,
                        //             );
                        //             $avlQty += itemStockDet($item_P);
                        //         }elseif($sesData->USER_TYPE == 'USER'){
                        //             // $whseAs = $whseAs['whse_assign'];
                        //             foreach ($whseAs['whse_assign'] as $whseAsGetData) {
                                        
                        //                 if($whseAsGetData->SMSW_WHSE_CODE == $noOfWhareHose->WHSE_CODE){
                        //                     $item_P = array(
                        //                         "dataType" => 'row',
                        //                         "itemCode" => $rowdata->I_CODE,
                        //                         "whseId" => $noOfWhareHose->WHSE_CODE,
                        //                     );
                        //                     $avlQty += itemStockDet($item_P);
                        //                 }
                        //             }
                        //         }
                        //     }
                        // }
                    
                    // if ($avlQty>0) {
                    $no++; $row = array();
                    $row[] = $no.".";
                    $row[] = "<img src='http://moallim.e-invoicesaudi.com/uploads/images/item/$rowdata->I_IMAGE_FILENAME' class='avatar-sm'>
                    <h5 class='text-truncate font-size-14'><a href='".base_url('ProductDetail?item_code=').$itemCodeEncrpt.'&item_code_bak='.$itemCodeBak."' class='text-dark'>$rowdata->I_CODE</a></h5>";
                    $row[] = $rowdata->I_DESC;
                    // $row[] = "<span class='badge bg-success'>$avlQty</span>";
                    $row[] = "<span class='badge bg-success'>$rowdata->IT_TRANS_QTY_SUM</span>";
                    $row[] = $rowdata->VEN_CODE;
                    $row[] = $rowdata->I_SECONDARY_DESC;
                    $row[] = $rowdata->I_CAT_CODE;
                    if(dashRole(["role_check"=>"PRODUCT_VIEW_UNIT_COST"])){
                    $row[] = "<button  data-itemcode='{$rowdata->I_CODE}' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='#standard_model' onClick='viewUnitDet(this)'>View Uniit Cost</button>";
                    }
                    // $row[] = "<a href='".base_url('addItemTrait?item_code=').$itemCodeEncrpt.'&type=view'."'> <button type='button' class='btn btn-primary btn-sm btn-rounded'>View Details</button></a>";
                //   $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                //                 <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                //                     <a href='#' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                //                 </li>
                //             </ul>";
                        // if ($avlQty>0) {
                            $data[] = $row;
                        // }
                    
                }
                $data = array_values_recursive($data);
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


            public function stockTransOrderListJson(){
                $userCon = sessionUserData();
             
                $filterdata = array(
                    "column_order" => array(NULL,'STH_ORDER_NO','STH_TRANS_DATE','TR_DESC','STH_FROM_WHSE','STH_WHSE_TO','STH_TOT_QTY','STH_GRAND_TOT','STH_STATUS',NULL),
                    "column_search" => array('TR_DESC','STH_TRANS_DATE','STH_ORDER_NO','STH_FROM_WHSE','STH_WHSE_TO','STH_TOT_QTY','STH_GRAND_TOT','STH_STATUS'),
                    "order" => array('STH_CRE_DATE' => 'DESC')
                );

                $sqlQueryTemp = array(
    
                    "SELECT"=>'*',
                    "FROM"=>'STOCK_TRANSFER_HEADER',
    
                    "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "JOIN_1_TABLE_NAME"=>'TRANSFER_REASON',
                        "JOIN_1_TABLE_CONN"=>'TRANSFER_REASON.TR_TRANS_RSN=STOCK_TRANSFER_HEADER.STH_TRANS_RSN',
    
                    "JOIN_2_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "JOIN_2_TABLE_NAME"=>'TRAIT_SUB_CATEGORY',
                        "JOIN_2_TABLE_CONN"=>'TRAIT_SUB_CATEGORY.TRAIT_CAT_ID=ITEM_TRAITS.ITM_TRAIT_CAT_CODE AND TRAIT_SUB_CATEGORY.TRAIT_SUB_CAT_CODE=ITEM_TRAITS.ITM_TRAIT_CODE',
                    
                    "WHERE_1_CONTROL"=>FALSE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "WHERE_1_COL_NAME"=>'ITEM_TRAITS.ITM_CODE',
                        "WHERE_1_DATA"=>'',
                );
                
                if ($userCon->USER_TYPE == 'SUPERADMIN' || $userCon->USER_TYPE == 'ADMIN') {
                
                }elseif($userCon->USER_TYPE == 'USER'){
                    
                    $sqlQueryTemp["CORE_WHERE_1_CONTROL"] = TRUE;  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    $sqlQueryTemp["CORE_WHERE_1_DATA"] = "STH_CRE_BY = '{$userCon->USERNAME}'";
                    $whseAs = assignRoleBreak();
                    if(count($whseAs['whse_assign'])>0){
                        $whseAs = $whseAs['whse_assign'];
                        $whseAssArr = [];
                        foreach ($whseAs as $whseAsGet) {
                            $whseAssArr[] = "'{$whseAsGet->SMSW_WHSE_CODE}'";
                        }
                        $sqlQueryTemp["CORE_WHERE_1_DATA"] = "{$sqlQueryTemp["CORE_WHERE_1_DATA"]} OR STH_WHSE_TO IN(".implode(",",$whseAssArr).")";
                    }
                }else{
                    redirect(base_url('dashboard'),'refresh');
                }
                // print_r($sqlQueryTemp);
                
                $sqlQuery = datatableSqlData($sqlQueryTemp);
    
                $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
    
                $data = array();
                $no = $this->input->post('start');
                foreach ($memData as $rowdata) {
                    $no++; $row = array();
                    $orderId = dataEncyptbase64($rowdata->STH_ORDER_NO,'encrypt');
                    $row[] = $no.".";
           
                    $row[] = "<a href='".base_url('StockTransferView?orderid=').$orderId."' class='text-body fw-bold'>{$rowdata->STH_ORDER_NO}</a>";
                    $row[] = date('d-M Y', strtotime($rowdata->STH_TRANS_DATE));
                    $row[] = $rowdata->TR_DESC;
                    $row[] = $rowdata->STH_FROM_WHSE;
                    $row[] = $rowdata->STH_WHSE_TO;
                    $row[] = $rowdata->STH_TOT_QTY;
                    $row[] = numberSystem($rowdata->STH_GRAND_TOT,1);
                    $row[] = $rowdata->STH_STATUS;
                  
                   // $row[] = "<a href='".base_url('addItemTrait?item_code=').$itemCodeEncrpt.'&type=view'."'> <button type='button' class='btn btn-primary btn-sm btn-rounded'>View Details</button></a>";
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

        /*================== STOCK TRANSFER PRINT =================*/
        
        public function stockTransferPrint(){
            $userCon = sessionUserData();

            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt');
            $data['printType'] = dataEncyptbase64($this->input->get('type'),'decrypt');

            $stockTransferOrderDets = StockTransferOrderDet(["where" => "WHERE STH_ORDER_NO = '$orderId'", "dataType" => 'result']);

            $data['stockTransferOrderDets'] = count($stockTransferOrderDets)>0?$stockTransferOrderDets:redirect(base_url('StockTransferList'),'refresh');
            $data['wharehouseFrom'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE = '{$data['stockTransferOrderDets'][0]->STH_FROM_WHSE}'","dataType"=>'row']);
            $data['wharehouseto'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE = '".$data['stockTransferOrderDets'][0]->STH_WHSE_TO."'","dataType"=>'row']);


            $html = $this->load->view('layout/inventory/stockTransferPrint',$data,true);

            $printByDiv = $postByDiv = null;
            if ($data['stockTransferOrderDets'][0]->STH_PRINT_BY) {
               $printByDiv = "<strong>Print By and DateTime</strong><br />
               {$data['stockTransferOrderDets'][0]->STH_PRINT_BY}-".date('d M Y h:i A', strtotime($data['stockTransferOrderDets'][0]->STH_PRINT_DATETIME))."";
            }
            if ($data['stockTransferOrderDets'][0]->STH_RECEIVED_BY) {
                $postByDiv = "<strong>Post By and DateTime</strong><br />
                {$data['stockTransferOrderDets'][0]->STH_RECEIVED_BY}-".date('d M Y h:i A', strtotime($data['stockTransferOrderDets'][0]->STH_RECEIVED_DATETIME))."</p>";
            }

            if ($data['printType'] == 'COST') {
                $headDsp = "Unit Cost";
            }else{
                $headDsp = "Sale Price";
            }

            $htmlPdfCon = 'Y';
            if($htmlPdfCon == 'Y'){
            // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
            $pdf = $this->pdf->load();
            $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                42, // margin top
                3, // margin bottom
                2, // margin header
                2); // margin footer'
                $pdf->SetHTMLHeader("<table width='100%' cellpadding='0' cellspacing='0'>
                                        <tr>
                                            <td width='256' rowspan='2' style='border:#000000 solid 1px;'><strong>Created By and DateTime</strong><br />
                                                ".$data['stockTransferOrderDets'][0]->STH_CRE_BY."-".date('d M Y h:i A', strtotime($data['stockTransferOrderDets'][0]->STH_CRE_DATE))." <br />
                                                <strong>Order Date</strong>:<br />
                                                ".date('d-M Y', strtotime($data['stockTransferOrderDets'][0]->STH_TRANS_DATE))."<br />
                                                <strong>From Warehouse</strong><br />
                                                {$data['wharehouseFrom']->WHSE_DESC}<br />
                                                $printByDiv
                                            </td>
                                        <td height='20' align='center'><img src='".base_url('assets/images/logo-dark.png')."' width='200' height='47' />
                                    <h4>TRANSFER ORDER PRINT</h4></td>
                                        <td width='260' rowspan='2' align='right' style='border:#000000 solid 1px; '><p><strong>Transfer Status:</strong><br />
                                            {$data['stockTransferOrderDets'][0]->STH_STATUS}<br />
                                            <strong>Reason</strong><br />
                                            {$data['stockTransferOrderDets'][0]->TR_TRANS_RSN}-{$data['stockTransferOrderDets'][0]->TR_DESC}<br />
                                            <strong>To Warehouse</strong><br />
                                            {$data['wharehouseto']->WHSE_DESC}<br />
                                            $postByDiv
                                        </td>
                                        </tr>
                                    
                                    <tr>
                                    <td width='226' height='20' align='center'><h4>Order #$orderId</h4></td>
                                    </tr>
                                </table>
                                <table width='100%' cellpadding='0' cellspacing='0'>
                                    
                                    
                                    <tr height='23'>
                                    <td height='10'  align='right' style='border-bottom:#000000 solid 2px;'></td>
                                    </tr>
                                    <tr height='10'>
                                    <td height='10'  align='right' style='border-bottom:#000000 solid 0px;'></td>
                                    </tr>
                                </table>",'O',true);
            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">#PAGE NO {PAGENO}/{nbpg}</div>');
            $pdf->WriteHTML($html);
            $pdf->Output("#MT-{$stockTransferOrderDets[0]->STH_ORDER_NO}.pdf",'I'); // I - View, D - Download
            }else{
            $this->load->view('layout/inventory/stockTransferPrint',$data);
            }
        }

/*================================ PHYSICAL INVENTORY COUNT ==============================*/
        
    public function phyInvCountAdddb(){
        $userCon = sessionUserData();
        $payload = $this->input->post();
        header('Content-Type: application/json');

        $this->form_validation->set_rules('PICH_ORDER_NO', 'Count Number', 'required|unique_code_db[PRICE_CHANGER_HEADER.PCH_DOCUMENT_NO.Document No already used, Please reFresh this page]');
        $this->form_validation->set_rules('PICH_ORDER_DATE', 'Count Date', 'required');
        $this->form_validation->set_rules('PICH_IC_START_DATE', 'Start Date', 'required');
        $this->form_validation->set_rules('PICH_IC_END_DATE', 'End Date', 'required');
        $this->form_validation->set_rules('PICH_WHSE', 'Warehouse', 'required');
        $this->form_validation->set_rules('PICH_BUS_UNIT', 'Business Unit', 'required');
        if ($this->form_validation->run() === FALSE) {
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi" => "true", "err" => "true", "msg" => $omsg));
        } else {

            $itemCode = $payload['item_code_db'];
            $listPrice = $payload['list_price_db'];
            $qty = $payload['item_qty_db'];
            $itemDesc = $payload['item_desc_db'];
            $itemUom = $payload['item_uom_db'];
            $check = false;
            $sn = 1;
            foreach ($itemCode as $itemCodeKey => $itemCodeValue) {

                if($itemCodeValue && $qty[$itemCodeKey]>0 ){

                    $detailData = array(
                                            'PICD_BUS_UNIT' => $payload['PICH_BUS_UNIT'],
                                            'PICD_ORDER_NO' => $payload['PICH_ORDER_NO'],
                                            'PICD_ORDER_LN' =>$sn++,
                                            'PICD_ITEM' => $itemCode[$itemCodeKey],
                                            'PICD_ITEM_DESC1' => $itemDesc[$itemCodeKey],
                                            'PICD_WHSE' => $payload['PICH_WHSE'],
                                            'PICD_UOM' => $itemUom[$itemCodeKey],
                                            'PICD_COUNT_QTY' => $qty[$itemCodeKey],
                                            'PICD_ITEM_PRICE' => $listPrice[$itemCodeKey],
                                            'PICD_CRE_BY' => $userCon->USERNAME,
                                            'PICD_CRE_DATE' => dateTime()
                                        );
                    $this->unicon->insertUniversal('PHY_INV_COUNT_DETAIL',$detailData);
                    // NOTE ITEM LIST PRICE UPDATE AFTER INSERT PRICE CHANGER DETAIL *** TRIGGER NAME : ITEM_LIST_PRICE_UPDATE ***
                    $check = true;
                }
            }

                $headerData = array(
                                    'PICH_BUS_UNIT' =>$payload['PICH_BUS_UNIT'],
                                    'PICH_ORDER_NO' =>$payload['PICH_ORDER_NO'],
                                    'PICH_ORDER_DATE' =>$payload['PICH_ORDER_DATE'],
                                    'PICH_WHSE' =>$payload['PICH_WHSE'],
                                    'PICH_NOTES' =>$payload['PICH_NOTES'],
                                    'PICH_IC_START_DATE' =>$payload['PICH_IC_START_DATE'],
                                    'PICH_IC_START_BY' =>$userCon->USERNAME,
                                    'PICH_IC_END_DATE' =>$payload['PICH_IC_END_DATE'],
                                    'PICH_STATUS' =>'P',
                                    'PICH_IC_END_BY' =>$userCon->USERNAME,
                                    'PICH_CRE_DATE' =>dateTime(),
                                    'PICH_CRE_BY' =>$userCon->USERNAME
                                );

            if($check){

                $this->unicon->insertUniversal('PHY_INV_COUNT_HEADER',$headerData);
                echo json_encode(array("multi" => "false", "err" => "false", "msg" => "PO recevied successfully and Update All Wharehouse quantity"));
            }else{
                echo json_encode(array("multi" => "false", "err" => "true", "msg" => "Please add some item"));
                }
            }
        }

        public function physicalInventoryCountListJson(){
            $userCon = sessionUserData();
            $filterdata = array(
                "column_order" => array(NULL,'PICH_ORDER_NO','PICH_WHSE','PICH_IC_START_DATE','PICH_IC_END_DATE','PICH_STATUS',NULL),
                "column_search" => array('PICH_BUS_UNIT','PICH_ORDER_NO','PICH_ORDER_DATE','PICH_WHSE','PICH_NOTES','PICH_IC_START_DATE','PICH_IC_START_BY','PICH_IC_END_DATE','PICH_IC_END_BY','PICH_STATUS','PICH_REP_PREP','PICH_NO','PICH_CRE_DATE','PICH_CRE_BY'),
                "order" => array('PICH_CRE_DATE' => 'DESC')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'PHY_INV_COUNT_HEADER',

                "JOIN_1_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'VENDOR',
                    "JOIN_1_TABLE_CONN"=>'VENDOR.V_CODE=PO_HEADER.POH_VENDOR_CODE',

                "JOIN_2_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_2_TABLE_NAME"=>'CURRENCY_EXCHANGE_RATE',
                    "JOIN_2_TABLE_CONN"=>'CURRENCY_EXCHANGE_RATE.EXCHR_ID=PO_HEADER.POH_CUR_EXCH_ID',

                "JOIN_3_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_3_TABLE_NAME"=>'CURRENCY',
                    "JOIN_3_TABLE_CONN"=>'CURRENCY.CUR_CODE=CURRENCY_EXCHANGE_RATE.EXCHR_CURRENCY',

                "JOIN_4_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_4_TABLE_NAME"=>'CLEARANCE_PO_ID',
                    "JOIN_4_TABLE_CONN"=>'CLEARANCE_PO_ID.CPO_TEMP_CL_ID=PO_HEADER.POH_TEMP_ORDER_ID',
                
                "JOIN_5_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_5_TABLE_NAME"=>'CLEARANCE_ID',
                    "JOIN_5_TABLE_CONN"=>'CLEARANCE_ID.INV_CL_NO = CLEARANCE_PO_ID.CPO_CL_NO',
                
                "WHERE_1_CONTROL"=>FALSE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "WHERE_1_COL_NAME"=>'CLEARANCE_ID.INV_POSTED',
                    "WHERE_1_DATA"=>'',
            );

            if ($userCon->USER_TYPE == 'SUPERADMIN' || $userCon->USER_TYPE == 'ADMIN') {
                
            }elseif($userCon->USER_TYPE == 'USER'){
                $sqlQueryTemp["CORE_WHERE_1_CONTROL"] = TRUE;  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                $sqlQueryTemp["CORE_WHERE_1_DATA"] = "PCH_CRE_BY = '{$userCon->USERNAME}'";
            }else{
                redirect(base_url('dashboard'),'refresh');
            }
            $sqlQuery = datatableSqlData($sqlQueryTemp);
            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $row[] = $no.".";
                $orderId = dataEncypt($rowdata->PICH_ORDER_NO,"encrypt");
                $busUnit = dataEncypt($rowdata->PICH_BUS_UNIT,"encrypt");
                $bakOrderId = dataEncyptManual($rowdata->PICH_ORDER_NO,'encrypt');

                $row[] = "{$rowdata->PICH_ORDER_NO}";
                $row[] = "{$rowdata->PICH_WHSE}"; 
                $row[] = date("d-M-Y H:i:s A", strtotime($rowdata->PICH_IC_START_DATE));
                $row[] = date("d-M-Y H:i:s A", strtotime($rowdata->PICH_IC_END_DATE));
                // $row[] = "{$rowdata->PCD_TOT_QTY}";
                $row[] = "{$rowdata->PICH_STATUS}";
                $row[] = "<button data-docno='{$rowdata->PICH_ORDER_NO}' data-busunit='{$rowdata->PICH_BUS_UNIT}' class='btn btn-primary btn-sm btn-rounded' onClick='orderStkFreeze(this)'>Stock Freeze</button>";
                $row[] = "<button data-docno='{$rowdata->PICH_ORDER_NO}' data-busunit='{$rowdata->PICH_BUS_UNIT}' class='btn btn-primary btn-sm btn-rounded' onClick='orderGenRep(this)'>Generate Report</button>";
                $row[] = "<button data-docno='{$rowdata->PICH_ORDER_NO}' data-docdate='{$rowdata->PICH_ORDER_DATE}' type='button' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='.orderdetailsModal' onClick='priceChnagerdetIn(this)'>
                            View Details
                        </button>";
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Excees and Short Report'>
                                <a href='".base_url("report/exccesAndShortReportPrint?orderid=$orderId")."' target='_blank' class='btn btn-sm btn-soft-warning'><i class='mdi mdi-printer-check'></i></a>
                            </li>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Short Report'>
                                <a href='".base_url("report/shortWithPicReportPrint?orderid=$orderId")."' target='_blank' class='btn btn-sm btn-soft-dark waves-effect waves-light'><i class='mdi mdi-printer-check'></i></a>
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