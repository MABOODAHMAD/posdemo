<?php
     class Purchase extends CI_Controller{
         public function __construct(){
            parent::__construct();
            sessionCheck();
            $this->load->model('Universal_model','unicon');
        }

        public function purchaseAdddb(){

            $userCon = sessionUserData();
            header('Content-Type: application/json');
            
            $this->form_validation->set_rules('POH_VENDOR_CODE', 'vendor code/name', 'required');
            $this->form_validation->set_rules('POH_SHIP_VIA_CODE', 'ship via', 'required');
            $this->form_validation->set_rules('POH_FREIGHT_CODE', 'freight', 'required');
            $this->form_validation->set_rules('POH_TERMS_CODE', 'Sterm', 'required');
            $this->form_validation->set_rules('POH_FOB_CODE', 'fob', 'required');
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $exchRate = $this->input->post('POD_EXCH_RATE');
                $temp_order_id = random_strings(10,'AN');
            // print_r($temp_order_id);
                $this->unicon->insertUniversal('CLEARANCE_PO_ID',["CPO_TEMP_CL_ID"=>$temp_order_id]);
                // PO HEADER
                    $data = [
                        "POH_BUS_UNIT" =>111,
                        "POH_TEMP_ORDER_ID"=>$temp_order_id,
                        "POH_ORDER_DATE"=>$this->input->post('POH_ORDER_DATE'),
                        "POH_CLASS"=>$this->input->post('POH_CLASS'),
                        "POH_VENDOR_CODE"=>$this->input->post('POH_VENDOR_CODE'),
                        "POH_REF_NO_1"=>$this->input->post('POH_REF_NO_1'),
                        "POH_REF_NO_2"=>$this->input->post('POH_REF_NO_2'),
                        // "POH_STATUS"=>'OPEN',
                        "POH_HOLD_FLAG"=>empty($this->input->post('POH_HOLD_FLAG'))?'0':$this->input->post('POH_HOLD_FLAG'),
                        "POH_SHIP_VIA_CODE"=>$this->input->post('POH_SHIP_VIA_CODE'),
                        "POH_FREIGHT_CODE"=>$this->input->post('POH_FREIGHT_CODE'),
                        "POH_TERMS_CODE"=>$this->input->post('POH_TERMS_CODE'),
                        "POH_FOB_CODE"=>$this->input->post('POH_FOB_CODE'),
                        "POH_CUR_EXCH_ID"=>$this->input->post('POH_CUR_EXCH_ID'),
                        "POH_CRE_BY"=>$userCon->USERNAME,
                    ];

                    $poInst = $this->unicon->insertUniversal('PO_HEADER',$data);

                // PO DETAIL
                    $totItemIntoQty = $this->input->post('tot_item_into_qty');
                    $totPoCharge = $this->input->post('tot_po_charge');

                    $itemCode = $this->input->post('POD_ITEM_CODE');
                    $itemQty = $this->input->post('POD_ITEM_QTY');
                    $itemPrice = $this->input->post('POD_ITEM_PRICE');
                    for ($i=0; $i <count($itemCode) ; $i++) { 
                        $getItemRow = $this->unicon->CoreQuery("SELECT * FROM ITEMS WHERE VEN_CODE='{$data['POH_VENDOR_CODE']}' AND I_CODE ='{$itemCode[$i]}'","num_rows");
                        if($getItemRow>0 && $itemPrice[$i]>0){
                            $dis_amt_ind = ($itemPrice[$i]*$itemQty[$i])/$totItemIntoQty;
                            $poDetailData=[
                                            "POD_TEMP_ORDER_ID"=>$temp_order_id,
                                            "POD_ITEM_CODE"=>$itemCode[$i],
                                            "POD_ITEM_QTY"=>$itemQty[$i],
                                            "POD_ITEM_PRICE"=>$itemPrice[$i],
                                            "POD_EXCH_RATE"=>$exchRate,
                                            "POD_DISTRIBUTION_AMT"=>($totPoCharge*$dis_amt_ind)/$itemQty[$i],
                                            "POD_UNIT_COST"=>(($totPoCharge*$dis_amt_ind)+($itemQty[$i]*$itemPrice[$i]))/$itemQty[$i],
                                            "POD_CRE_BY"=>$userCon->USERNAME,
                            ];
                            $this->unicon->insertUniversal('PO_DETAILS',$poDetailData);
                        }

                        // print_r($poDetailData);
                        
                    }
                
                // PO CHARGE
                    $poChrgeCode = $this->input->post('PODC_PO_CHARGE_CODE');
                    $poChargeAmt = $this->input->post('PODC_PO_CHARGE_AMT');
                    for ($iPoChrge=0; $iPoChrge<count($poChrgeCode) ; $iPoChrge++) { 
                        $getPoChareRow = $this->unicon->CoreQuery("SELECT * FROM PO_CHARGES WHERE CHRG_TYPE='{$poChrgeCode[$iPoChrge]}'","num_rows");
                        if($getPoChareRow>0 && $poChargeAmt[$iPoChrge]>0){
                            $poDetailChargeData=[
                                            "PODC_TEMP_ORDER_ID"=>$temp_order_id,
                                            "PODC_PO_CHARGE_CODE"=>$poChrgeCode[$iPoChrge],
                                            "PODC_PO_CHARGE_AMT"=>$poChargeAmt[$iPoChrge],
                                            "PODC_TYPE"=>"SELLER",
                                            "PODC_CRE_BY"=>$userCon->USERNAME,
                            ];

                            $this->unicon->insertUniversal('PO_DETAILS_CHARGES',$poDetailChargeData);
                        }
                        
                    }

                if($poInst){
                    
                        $purOrderType = $this->input->post('pur_order_type_db');
                        $preFix = $this->unicon->CoreQuery("SELECT * FROM PO_PREFIXES WHERE POP_ORDER_PFX ='$purOrderType'","row");

                        $this->unicon->CoreQuery("UPDATE CLEARANCE_PO_ID SET CPO_ORDER_ID='{$preFix->POP_NEXT_NUMBER}',CPO_ORDER_PFX='$purOrderType' WHERE CPO_TEMP_CL_ID='$temp_order_id'");
                        $this->unicon->CoreQuery("UPDATE PO_HEADER SET POH_ORDER_ID='{$preFix->POP_NEXT_NUMBER}',POH_PREFIX='$purOrderType' WHERE POH_TEMP_ORDER_ID='$temp_order_id'");
                        $this->unicon->CoreQuery("UPDATE PO_DETAILS SET POD_POH_ORDER_ID='{$preFix->POP_NEXT_NUMBER}',POD_PREFIX='$purOrderType' WHERE POD_TEMP_ORDER_ID='$temp_order_id'");
                        $this->unicon->CoreQuery("UPDATE PO_DETAILS_CHARGES SET PODC_POH_ORDER_ID='{$preFix->POP_NEXT_NUMBER}',PODC_PREFIX='$purOrderType' WHERE PODC_TEMP_ORDER_ID='$temp_order_id'");

                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
              
                
                }else{

                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }
        }

        public function purchaseOrderListJson(){
            $userCon = sessionUserData();
            $purchaseType = $this->input->post('purchase_type');
            $filterdata = array(
                "column_order" => array(NULL,'POH_ORDER_ID','V_NAME','POH_ORDER_DATE',NULL,NULL,'POH_PAY_STATUS',NULL,NULL,NULL),
                "column_search" => array('POH_ORDER_ID','V_NAME','V_NAME_AR','POH_ORDER_DATE','POH_PAY_STATUS','V_CODE'),
                "order" => array('POH_CRE_DATE' => 'DESC')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'PO_HEADER',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'VENDOR',
                    "JOIN_1_TABLE_CONN"=>'VENDOR.V_CODE=PO_HEADER.POH_VENDOR_CODE',

                "JOIN_2_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_2_TABLE_NAME"=>'CURRENCY_EXCHANGE_RATE',
                    "JOIN_2_TABLE_CONN"=>'CURRENCY_EXCHANGE_RATE.EXCHR_ID=PO_HEADER.POH_CUR_EXCH_ID',

                "JOIN_3_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_3_TABLE_NAME"=>'CURRENCY',
                    "JOIN_3_TABLE_CONN"=>'CURRENCY.CUR_CODE=CURRENCY_EXCHANGE_RATE.EXCHR_CURRENCY',

                "JOIN_4_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_4_TABLE_NAME"=>'CLEARANCE_PO_ID',
                    "JOIN_4_TABLE_CONN"=>'CLEARANCE_PO_ID.CPO_TEMP_CL_ID=PO_HEADER.POH_TEMP_ORDER_ID',
                
                "JOIN_5_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_5_TABLE_NAME"=>'CLEARANCE_ID',
                    "JOIN_5_TABLE_CONN"=>'CLEARANCE_ID.INV_CL_NO = CLEARANCE_PO_ID.CPO_CL_NO',
                
                "WHERE_1_CONTROL"=>TRUE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "WHERE_1_COL_NAME"=>'CLEARANCE_ID.INV_POSTED',
                    "WHERE_1_DATA"=>$purchaseType=='order'?'N':'Y',
            );

            if ($userCon->USER_TYPE == 'SUPERADMIN' || $userCon->USER_TYPE == 'ADMIN') {
                
            }elseif($userCon->USER_TYPE == 'USER'){
                $sqlQueryTemp["CORE_WHERE_1_CONTROL"] = TRUE;  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                $sqlQueryTemp["CORE_WHERE_1_DATA"] = "POH_CRE_BY = '{$userCon->USERNAME}'";
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
                $orderId = dataEncypt($rowdata->POH_PREFIX.$rowdata->POH_ORDER_ID,"encrypt");
                $bakOrderId = dataEncyptManual($rowdata->POH_PREFIX.$rowdata->POH_ORDER_ID,'encrypt');

                $row[] = "<a href='".base_url('purchaseView?orderid=').$orderId.'&bakOrderid='.$bakOrderId."' class='text-body fw-bold'>{$rowdata->POH_PREFIX}-{$rowdata->POH_ORDER_ID}</a>";
                $row[] = "{$rowdata->V_NAME}</br>{$rowdata->V_NAME_AR}"; 
                $row[] = "{$rowdata->POH_ORDER_DATE}";
                $row[] = "{$rowdata->CUR_ABBRV} ".numberSystem($rowdata->POH_GRAND_TOTAL)."";
                $row[] = "{$rowdata->EXCHR_BUY_RATE}";
                if ($rowdata->POH_PAY_STATUS == 'PENDING') {$stBg = 'warning';}elseif ($rowdata->POH_PAY_STATUS == 'PARTIAL') {$stBg = 'primary';}else {$stBg = 'success';}
                $row[] = "<span class='badge badge-pill badge-soft-{$stBg} font-size-12'>{$rowdata->POH_PAY_STATUS}</span>";

                // $row[] = '<i class="fab fa-cc-mastercard me-1"></i> Mastercard';
                $row[] = numberSystem($rowdata->POD_PAID_AMT);
                if(dashRole(["role_check"=>"PURCHASE_FREIGHT_DETAIL"])){
                    $row[] = "<a href='".base_url('landingCost?orderid=').$orderId.'&bakOrderid='.$bakOrderId."'><button type='button' class='btn btn-primary btn-sm btn-rounded'>
                                    View Landed Cost
                                </button></a>";
                }
                
                // $row[] = '<button type="button" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target=".orderdetailsModal">
                //             View Details
                //         </button>';
                if($purchaseType == 'invoice'){
                    // $row[] = "<div class='d-flex gap-3'>
                    //                 <a href='javascript:void(0);' class='text-success'><i class='mdi mdi-pencil font-size-18'></i></a>
                    //                 <a href='".base_url('purchasePrint?orderid=').$orderId."' class='btn btn-sm btn-soft-dark waves-effect waves-light'><i class='mdi mdi-printer-check'></i></a>
                    //             </div>";
                    $printUrl = base_url("report/purOderRPReportPrint?prefix=".dataEncyptbase64($rowdata->POH_PREFIX,'encrypt')."&orderNo=".dataEncyptbase64($rowdata->POH_ORDER_ID,'encrypt')."");
                    $row[] = "<div class='d-flex gap-3'>
                                <a href='javascript:void(0);' class='text-success'><i class='mdi mdi-pencil font-size-18'></i></a>
                                <a href='$printUrl' target='_blank' class='btn btn-sm btn-soft-dark waves-effect waves-light'><i class='mdi mdi-printer-check'></i></a>
                            </div>";
                }else{
                    $row[] = '<div class="d-flex gap-3">
                                </div>';
                }
                
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
        
        
        
        public function priceChangerListJson(){
            $userCon = sessionUserData();
            $filterdata = array(
                "column_order" => array(NULL,'PCH_DOCUMENT_NO','PCH_DOCUMENT_DATE','PCH_REFRENCE','PCD_TOT_QTY','POSTED',NULL,NULL,NULL),
                "column_search" => array('PCH_DOCUMENT_NO','PCH_DOCUMENT_DATE','PCH_REFRENCE','PCD_TOT_QTY','POSTED'),
                "order" => array('PCH_CRE_DATE' => 'DESC')
            );

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'PRICE_CHANGER_HEADER',

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
                $orderId = dataEncypt($rowdata->PCH_DOCUMENT_NO,"encrypt");
                $bakOrderId = dataEncyptManual($rowdata->PCH_DOCUMENT_NO,'encrypt');

                $row[] = "{$rowdata->PCH_DOCUMENT_NO}";
                $row[] = "{$rowdata->PCH_DOCUMENT_DATE}"; 
                $row[] = "{$rowdata->PCH_REFRENCE}";
                // $row[] = "{$rowdata->PCD_TOT_QTY}";
                $row[] = "{$rowdata->POSTED}";
                $row[] = "<button data-docno='{$rowdata->PCH_DOCUMENT_NO}' data-docdate='{$rowdata->PCH_DOCUMENT_DATE}' type='button' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='.orderdetailsModal' onClick='priceChnagerdetIn(this)'>
                            View Details
                        </button>";
                // $row[] = '<div class="d-flex gap-3">
                //             <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                //             <a href="javascript:void(0);" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                //         </div>';
                
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

        public function landedCostAdddb(){

            $userCon = sessionUserData();
            header('Content-Type: application/json');
            
            $this->form_validation->set_rules('clearance_id_db', 'Clearance', 'required');
            $this->form_validation->set_rules('po_order_db', 'purchase order', 'required');
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $orderTempid = $this->input->post('po_temp_order_db');
                $orderId = $this->input->post('po_order_db');
                $poChrgeCode = $this->input->post('PODC_PO_CHARGE_CODE');
                $poChargeAmt = $this->input->post('PODC_PO_CHARGE_AMT');
                
                
                $this->unicon->updateArrayUniversal('PO_DETAILS_CHARGES',["PODC_UPDATE_STATUS" => '0'],"PODC_TEMP_ORDER_ID = '$orderTempid' AND PODC_TYPE = 'BUYER' ");

                for ($iPoChrge=0; $iPoChrge<count($poChrgeCode) ; $iPoChrge++) { 
                    $getPoChareRow = $this->unicon->CoreQuery("SELECT * FROM PO_CHARGES WHERE CHRG_TYPE='{$poChrgeCode[$iPoChrge]}'","num_rows");
                    if($getPoChareRow>0 && $poChargeAmt[$iPoChrge]>0){

                            $poDetailChargeData=[
                                            "PODC_TEMP_ORDER_ID"=>$orderTempid,
                                            "PODC_PREFIX"=>substr($orderId,0,3),
                                            "PODC_POH_ORDER_ID"=>substr($orderId,3),
                                            "PODC_PO_CHARGE_CODE"=>$poChrgeCode[$iPoChrge],
                                            "PODC_PO_CHARGE_AMT"=>$poChargeAmt[$iPoChrge],
                                            "PODC_TYPE"=>"BUYER",
                                            "PODC_CRE_BY"=>$userCon->USERNAME,
                                            "PODC_UPDATE_STATUS"=>'1',
                            ];

                            $TPO = freightChargeDetsByOrderNdFreightCode($orderId,"BUYER",$poDetailChargeData['PODC_PO_CHARGE_CODE']);

                            if(count($TPO)>0){

                                $where = "PODC_TEMP_ORDER_ID = '$orderTempid' AND PODC_PO_CHARGE_CODE = '{$poChrgeCode[$iPoChrge]}' AND PODC_TYPE = 'BUYER' ";
                                $poinstCheck = $this->unicon->updateArrayUniversal('PO_DETAILS_CHARGES',$poDetailChargeData,$where);
                                $poinstCheck = true;

                            }else{

                                $poinstCheck = $this->unicon->insertUniversal('PO_DETAILS_CHARGES',$poDetailChargeData);

                            }
                        // $TPO =null;
                    }

                    
                }
                $this->unicon->CoreQuery("DELETE FROM PO_DETAILS_CHARGES WHERE PODC_TEMP_ORDER_ID = '$orderTempid' AND PODC_TYPE = 'BUYER' AND PODC_UPDATE_STATUS = '0' ");

                if($poinstCheck){
                    
                    // $url = "<script>location.reload();</script>";

                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
              
                
                }else{

                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }
        }

        public function purchaseRecevied(){

            $userCon = sessionUserData();
            header("Content-Type: text/plain");

            $orderId = $this->input->post('order_id_db');
            $clearancId = $this->input->post('clearance_db');
            $POH_ORDER_DATE = $this->input->post('POH_ORDER_DATE');
            $landedCostCheck = freightChargeDets($orderId,'BUYER');
            $prefixId = substr($orderId,0,3);
            if($prefixId == 'NPO'){
                $nrpDet = poPrefixes('NPR');
            }else{
                $nrpDet = poPrefixes('CPR');
            }
            $venCode = $this->input->post('vendor_code_db');
            $getVendorDet = glModuleAccDet(array('where'=>"AND GLMP_MODULE = 'PO' AND GLMP_COST_CENTER = '1001' AND GLMP_REMARK = '$venCode'",'dataType'=>'row'));
        
            if(count($landedCostCheck)>0){
                if($getVendorDet){
                    $chkdets = purchaseOrderItemDet($orderId,'result');
                    $chkhed = purchaseOrderHeaderDet($orderId, 'row');
                    $chkFre = freightChargeDets($orderId, 'BUYER', 'SUM(PODC_PO_CHARGE_AMT) AS PO_TOT', 'row');
                        
                        foreach ($chkdets as $chkdet) {

                            $itemPer = ($chkdet->POD_UNIT_COST * $chkdet->POD_ITEM_QTY) / $chkhed->POH_GRAND_TOTAL;
                            $mainUnitCost = (($chkFre->PO_TOT*$itemPer/$chkdet->POD_ITEM_QTY)+$chkdet->POD_UNIT_COST*$chkdet->POD_EXCH_RATE);

                    // print_r($mainUnitCost.'/');
                            $getItemCost = itemCostGet($chkdet->POD_ITEM_CODE);
                            $avgCost = ($getItemCost->cost_total+$mainUnitCost)/($getItemCost->cost_count+1);
                            $data = [
                                    "INVCOST_BUS_UNIT" => 111,
                                    "INVCOST_ITEM_CODE" => $chkdet->POD_ITEM_CODE,
                                    "INVCOST_WHSE_CODE" => '01',
                                    "INVCOST_EFF_START_DATE" =>date('Y-01-01'),
                                    "INVCOST_EFF_END_DATE" => date('Y-12-31'),
                                    "INVCOST_STD_COST" => $mainUnitCost,
                                    "INVCOST_AVG_COST" => $avgCost,
                                    "INVCOST_ACT_COST" => $mainUnitCost,
                                    "INVCOST_CRE_DATE" => $POH_ORDER_DATE,
                                    "INVCOST_CRE_BY" => $userCon->USERNAME,
                            ];
                            $this->unicon->insertUniversal('ITEM_COST',$data);

                        }
                    

                    $this->unicon->CoreQuery("UPDATE CLEARANCE_PO_ID SET CPO_RECEIPT_PFX = '{$nrpDet[0]['POP_ORDER_PFX']}',CPO_RECEIPT_NO = '{$nrpDet[0]['POP_NEXT_NUMBER']}' WHERE CPO_CL_NO = '$clearancId' ");
                    // MOTE AFTER UPDATE SOME TABLE ARE UPDATING THROGH TRIGGER **** TRIGGER NAME : UPDATE_NPR_COUNT_AND_UPDATE_WHSE_STOCK ******
                    
                    //ACCOUNT PO START
                        $accArr = (object)array('temp_id'=>$orderId,'module'=>'PO','type'=>'PURCHASE','rtnType'=>'N');
                        $this->accountlib->puchaseReceived($accArr);
                    //ACCOUNT PO END
                    // VENDOR WALLET START
                        $this->commonlib->venWalletPur($accArr);
                    // VENDOR WALLET END
                    // TRANSACTION HISTRY START
                        $this->commonlib->purchaseInvTrans($orderId);
                    // TRANSACTION HISTRY END
                    // VENDOR PRICE START
                        $this->commonlib->purchaseVendorPrice($orderId);
                    // VENDOR PRICE END
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"PO recevied successfully and Update All Wharehouse quantity"));
                }else{
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"Vendor GL Profile Not Configure"));
                }       
            }else{
                
                $url = base_url('landingCost?orderid=').dataEncypt($orderId,"encrypt").'&bakOrderid='.dataEncyptManual($orderId,'encrypt');;
                
                $url = "<script>window.location.replace('".$url."');</script>";
              
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"Landed Cost not Updated".$url));

            }
        }

    public function priceUpdateChanger(){
        $userCon = sessionUserData();
        header('Content-Type: application/json');

        $this->form_validation->set_rules('doc_no_db', 'document No', 'required|unique_code_db[PRICE_CHANGER_HEADER.PCH_DOCUMENT_NO.Document No already used, Please reFresh this page]');
        // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if ($this->form_validation->run() === FALSE) {
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi" => "true", "err" => "true", "msg" => $omsg));
        } else {
            $docNo = $this->input->post('doc_no_db');
            $itemCode = $this->input->post('item_code_db');
            $listPrice = $this->input->post('list_price_db');
            $markup = $this->input->post('markup');
            $check = false;
            
            
            for ($i=0; $i < count($itemCode) ; $i++) { 
                if($itemCode[$i] && $listPrice[$i]>0){

                    $detailData = [
                        "PCD_DOCUMENT_NO" => $docNo ,
                        "PCD_ITEM_CODE" => $itemCode[$i],
                        "PCD_UNIT_PRICE" => $listPrice[$i],
                        "PCD_MARKUP" => $markup[$i],
                        "PCD_CRE_BY" =>$userCon->USERNAME,
                    ];
                    $this->unicon->insertUniversal('PRICE_CHANGER_DETAIL',$detailData);
                    // NOTE ITEM LIST PRICE UPDATE AFTER INSERT PRICE CHANGER DETAIL *** TRIGGER NAME : ITEM_LIST_PRICE_UPDATE ***
                    $check = true;
                }
            }

                $headerData = [
                            "PCH_DOCUMENT_NO" => $docNo ,
                            "PCH_DOCUMENT_DATE" => $this->input->post('item_rev_date'),
                            "PCH_REFRENCE" => empty($this->input->post('refernce_db'))?NULL:$this->input->post('refernce_db'),
                            "PCH_REMARK" => empty($this->input->post('remark_db'))?NULL:$this->input->post('remark_db'),
                            "POSTED" => 'Y',
                            "PCH_CRE_BY" =>$userCon->USERNAME,
                        ];

            if($check){

                $this->unicon->insertUniversal('PRICE_CHANGER_HEADER',$headerData);
                echo json_encode(array("multi" => "false", "err" => "false", "msg" => "PO recevied successfully and Update All Wharehouse quantity"));
            }else{
                echo json_encode(array("multi" => "false", "err" => "true", "msg" => "Please add some item"));
                }
            }
        }

        /*================================ PAYMENTOUT ==============================*/
        
        public function payOutCreate(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
    
            $this->form_validation->set_rules('vchno_p_db', 'voucher No', 'required|unique_code_db[PAYMENT_VOCHER.PV_ORDER_NO.Voucher No already used, Please reFresh this page]');
            $this->form_validation->set_rules('vendor_code_db', 'select supplier', 'required');
            $this->form_validation->set_rules('pay_meth_db', 'select payment mathod', 'required');
            $this->form_validation->set_rules('amount_p_db', 'amount', 'required|numeric');
            
            if ($this->form_validation->run() === FALSE) {
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi" => "true", "err" => "true", "msg" => $omsg));
            } else {
                $venCode = $this->input->post('vendor_code_db');
                $amount = $this->input->post('amount_p_db');
            // print_r($balDet);
                $incDets = invDetByVenCode(['where'=>"AND POH_VENDOR_CODE ='$venCode' AND POH_PAY_STATUS IN('PENDING','PARTIAL') ORDER BY POH_ORDER_DATE ASC",'dataType'=>'result']);
                $outAmt = $amount;
                    foreach ($incDets as $incDet) {
                        $outAmtInc = $incDet->POH_GRAND_TOTAL-$incDet->POD_PAID_AMT;
                            if ($outAmt>=$outAmtInc && $outAmt>0) {
                                $this->unicon->CoreQuery("UPDATE PO_HEADER SET POD_PAID_AMT = POD_PAID_AMT+'$outAmtInc' WHERE POH_TEMP_ORDER_ID = '{$incDet->POH_TEMP_ORDER_ID}'");
                                // $this->unicon->CoreQuery("UPDATE PO_HEADER SET POH_PAY_STATUS = IF (POH_GRAND_TOTAL = POD_PAID_AMT,'PAID', POH_PAY_STATUS ) WHERE POH_TEMP_ORDER_ID = '{$incDet->POH_TEMP_ORDER_ID}'");
                                
                                $payDetailChargeData = [
                                    "PD_REF_ID" => 'PAY-' . random_strings(10, 'AN'),
                                    "PD_ORDER_ID" => $incDet->POH_TEMP_ORDER_ID,
                                    "PD_PAY_METHOD_ID" => $this->input->post('pay_meth_db'),
                                    "PD_AMOUNT" => $outAmtInc,
                                    "PD_TYPE" => "PURCHASE",
                                    "PD_STATUS" => "RECEIVED",
                                    "PD_PARTIES_ID" => $venCode,
                                    "PD_BAL_TYPE" => "D",
                                    "PD_VOCH_CODE" => $this->input->post('vchno_p_db'),
                                    "PD_CUR_EXCH_ID" => $this->input->post('exch_rate_id'),
                                    "PD_EXCH_RATE" => $this->input->post('exch_rate_db'),
                                    "PD_CRE_BY" => $userCon->USERNAME,
                                ];
        
                                $this->unicon->insertUniversal('PAYMENT_DETAIL', $payDetailChargeData);

                                $outAmt = $outAmt - $outAmtInc;
                                

                            }elseif ($outAmtInc>$outAmt && $outAmt>0) {
                                $this->unicon->CoreQuery("UPDATE PO_HEADER SET POD_PAID_AMT = POD_PAID_AMT+'$outAmt' WHERE POH_TEMP_ORDER_ID = '{$incDet->POH_TEMP_ORDER_ID}'");
                                // $this->unicon->CoreQuery("UPDATE PO_HEADER SET POH_PAY_STATUS = IF (POH_GRAND_TOTAL > POD_PAID_AMT, 'PARTIAL', POH_PAY_STATUS ) WHERE POH_TEMP_ORDER_ID = '{$incDet->POH_TEMP_ORDER_ID}'");
                                
                                $payDetailChargeData = [
                                    "PD_REF_ID" => 'PAY-' . random_strings(10, 'AN'),
                                    "PD_ORDER_ID" => $incDet->POH_TEMP_ORDER_ID,
                                    "PD_PAY_METHOD_ID" => $this->input->post('pay_meth_db'),
                                    "PD_AMOUNT" => $outAmt,
                                    "PD_TYPE" => "PURCHASE",
                                    "PD_STATUS" => "RECEIVED",
                                    "PD_BAL_TYPE" => "D",
                                    "PD_VOCH_CODE" => $this->input->post('vchno_p_db'),
                                    "PD_PARTIES_ID" => $venCode,
                                    "PD_CUR_EXCH_ID" => $this->input->post('exch_rate_id'),
                                    "PD_EXCH_RATE" => $this->input->post('exch_rate_db'),
                                    "PD_CRE_BY" => $userCon->USERNAME,
                                ];
        
                                $this->unicon->insertUniversal('PAYMENT_DETAIL', $payDetailChargeData);
                                $outAmt = $outAmt - $outAmt;
                                
                            }
                            
                    }
                    //* SYNC PO HEADER PAYMENT STATUS 
                    syncPayStatus(invDetByVenCode(['where'=>"AND POH_VENDOR_CODE ='$venCode' AND POH_PAY_STATUS IN('PENDING','PARTIAL') ORDER BY POH_ORDER_DATE ASC",'dataType'=>'result']));
            
                $tempCheck = false;
                    
                
                
                    $headerData = [
                                "PV_ORDER_NO" => $this->input->post('vchno_p_db'),
                                "PV_DATE" => date('Y-m-d'),
                                "PV_DESC" => empty($this->input->post('voch_desc_p_db'))?NULL:$this->input->post('voch_desc_p_db'),
                                "PV_AMT" => empty($this->input->post('amount_p_db'))?NULL:$this->input->post('amount_p_db'),
                                "PV_PAY_METH" => empty($this->input->post('pay_meth_db'))?NULL:$this->input->post('pay_meth_db'),
                                "PV_PARTIES_CODE" => $venCode,
                                "PV_TYPE" => 'VENDOR',
                                "PV_CUR_EXCH_ID" => $this->input->post('exch_rate_id'),
                                "PV_EXCH_RATE" => $this->input->post('exch_rate_db'),
                                "PV_CRE_DATE" => dateTime(),
                                "PV_CRE_BY" =>$userCon->USERNAME,
                            ];
                if($this->unicon->insertUniversal('PAYMENT_VOCHER',$headerData)){
                    // TRANSACTION HISTRY START
                        $transArr = (object)array('vouch_no'=>$headerData['PV_ORDER_NO']);
                        $this->commonlib->venWalletVouch($transArr);
                    // TRANSACTION HISTRY END
                    echo json_encode(array("multi" => "false", "err" => "false", "msg" => "PO recevied successfully and Update All Wharehouse quantity"));
                }else{
                    echo json_encode(array("multi" => "false", "err" => "true", "msg" => "Please add some item"));
                    }
                }
            }
         
    }