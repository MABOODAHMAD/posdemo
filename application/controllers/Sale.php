<?php
class Sale extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sessionCheck();
        $this->load->model('Universal_model', 'unicon');
    }

    /*================================ VALIDATING USERNAME AND PASSWORD ==============================*/
    
    public function validUserPass(){
        $userCon = sessionUserData();
        header('Content-Type: application/json');
        $this->form_validation->set_rules('auth_username', 'username', 'required');
        $this->form_validation->set_rules('auth_password', 'password', 'required');
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            $userName = $this->input->post('auth_username');
            $pass = $this->input->post('auth_password');
            $authType = $this->input->post('auth_type');

            $this->unicon->CoreQuery("UPDATE GENERATE_PASS SET MDP_ASSIGN_BY=null,MDP_TEMP_BLOCK='N' WHERE MDP_STATUS ='0' AND MDP_TEMP_BLOCK='Y' AND MDP_ASSIGN_BY='$userCon->USERNAME' AND MDP_TYPE = '$authType'");
            $dataFetch = $this->unicon->CoreQuery("SELECT * FROM GENERATE_PASS WHERE MDP_USER ='$userName' AND MDP_PWD = '$pass' AND MDP_TYPE = '$authType' ","result");
            if(count($dataFetch) === 1){
                $this->unicon->CoreQuery("UPDATE GENERATE_PASS SET MDP_ASSIGN_BY='$userCon->USERNAME',MDP_TEMP_BLOCK='Y' WHERE MDP_SEQ ='{$dataFetch[0]->MDP_SEQ}'");
            
                // $data = array(
                //             "CTY_CODE"=>empty($cityCode)?insertUniqueCode('CITY_CODE'):$cityCode,
                //             "CTY_NAME"=>$this->input->post('CTY_NAME'),
                //             "CTY_NAME_AR"=>$this->input->post('CITY_NAME_AR'),
                //             "CTY_ABBRV"=>$this->input->post('CTY_ABBRV'),
                //             "CTY_STATE_CODE"=>$this->input->post('ST_CODE'),
                //             "CTY_DESC"=>empty($this->input->post('CTY_DESC'))?'N/A':$this->input->post('CTY_DESC'),
                //             "CTY_CRE_BY"=>$userCon->USERNAME,
                //         );
                // if($this->unicon->insertUniversal('CITIES',$data)){
                // $rt = true;
                // if($rt){
                echo json_encode(array("multi"=>"false",
                                        "err"=>"false",
                                        "msg"=>"Data Inserted Successfully",
                                        "returndata"=>array(
                                                            "auth_id"=>$dataFetch[0]->MDP_SEQ,
                                                            "dis_ext"=>$authType == 'DISCOUNT'?$dataFetch[0]->MDP_GEN_DISC:0,
                                                            "auth_type"=>$authType
                                                        )));
            
                
                // }else{

                // echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                // }
            }else{
                echo json_encode(array("multi"=>"false",
                                        "err"=>"true",
                                        "msg"=>"Detail Not Matched"));
            }
        }
    }
    /*================================ SALE RETURN CREATE ==============================*/
    
    public function saleReturnAdddb()
    {

        $curDateTime = dateTime();
        $userCon = sessionUserData();
        header('Content-Type: application/json');
        //JS
        // $url = "<script>location.reload();</script>";
        $url = null;
        //DATA POST
        $this->form_validation->set_rules('order_id_db', 'order id', 'required');
        $itemCode = $this->input->post('SD_ITEM_CODE');
        $retQty = $this->input->post('SD_QTY');
        $salePrice = $this->input->post('SD_SALE_PRICE');
        $saleLineMainId = $this->input->post('SD_MAIN_LINE_IN');
        $authId = $this->input->post('auth_id_db');
        $retAcc = $this->input->post('return_acc_db');
        $disId = explode("-",$this->input->post('display_id_db'));
        //INITIAL VARIABLE ASSIGN
        $countAs = TRUE;
        $totAmt = 0;
        // $this->form_validation->set_rules('formRadios', 'invoice type', 'required');
        // $this->form_validation->set_rules('SH_WHSE_CODE', 'location code', 'required');
        // $this->form_validation->set_rules('SH_TERM_ID', 'Sterm', 'required');
        // $this->form_validation->set_rules('SH_SALESMAN_ID', 'salesman code', 'required');
        // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if ($this->form_validation->run() === FALSE) {
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi" => "true", "err" => "true", "msg" => $omsg));
        } else {
            $ty = false;
            $checkAuthCon = true;
            if($retAcc == 'N' && isset($itemCode)){
                if(count($itemCode)>0){
                    $checkAuth = $this->unicon->CoreQuery("SELECT * FROM GENERATE_PASS WHERE MDP_TEMP_BLOCK='Y' AND MDP_STATUS ='0' AND MDP_SEQ = '$authId'","num_rows");
                    if ($checkAuth == 1) {
                        $this->unicon->CoreQuery("UPDATE GENERATE_PASS SET MDP_ORDER_PFX='{$disId[0]}',MDP_ORDER_NO='{$disId[1]}',MDP_ASSIGN_BY='{$userCon->USERNAME}',MDP_TEMP_BLOCK='N',MDP_STATUS=1,MDP_USE_DATE = '$curDateTime' WHERE MDP_SEQ ='{$authId}'");
                        $checkAuthCon = true;
                    }else{
                        $checkAuthCon = false;
                    }
                }
            }
            if (!isset($itemCode)) {
                $url = "<script>location.reload();</script>";
                echo json_encode(array("multi" => "false", "err" => "true", "msg" => "item line empty".$url));
                
            }elseif(!$checkAuthCon) {
                $url = "<script>location.reload();</script>";
                echo json_encode(array("multi" => "false", "err" => "true", "msg" => "Return Authentication Username and Password Mismatched".$url));
            }else {
                if(count($itemCode)>0){
                    $temp_order_id = random_strings(10, 'AN');
                    $orderNo = $this->unicon->CoreQuery("SELECT WHSE_CODE,WHSE_RET_ORDER_COUNT,WHSE_RET_INVOICE_COUNT FROM WHAREHOUSE WHERE WHSE_CODE='{$this->input->post('SH_WHSE_CODE')}'", "row");
                    $this->unicon->CoreQuery("UPDATE WHAREHOUSE SET WHSE_RET_ORDER_COUNT = LPAD(WHSE_RET_ORDER_COUNT+1,6,0),WHSE_RET_INVOICE_COUNT = LPAD(WHSE_RET_INVOICE_COUNT+1,6,0) WHERE WHSE_CODE='{$this->input->post('SH_WHSE_CODE')}'");
                    $dataHeader = [
                        "RH_TEMP_ID" => $temp_order_id,
                        "RH_INV_ID" =>insertUniqueCode('SALE_RET'),
                        "RH_SH_TEMP_ID" =>$this->input->post('order_id_db'),
                        "RH_DATE" => date('Y-m-d'),
                        "RH_PARTIES_ID" => $this->input->post('cust_id_db'),
                        "RH_SALESMAN" => $this->input->post('RH_SALESMAN'),
                        "RH_WHSE" => $this->input->post('SH_WHSE_CODE'),
                        "RH_INV_PREFIX" => 'C'.$this->input->post('SH_WHSE_CODE'),
                        "RH_INV_NO" => $orderNo->WHSE_RET_INVOICE_COUNT,
                        "RH_CRE_BY_DATE" => dateTime(),
                        "RH_CRE_BY" => $userCon->USERNAME,
                    ];

                    $this->unicon->insertUniversal('RETURN_HEADER', $dataHeader);

                        for ($itemLop=0; $itemLop < count($itemCode); $itemLop++) { 
                            $itemDet = itemDetails($itemCode[$itemLop]);
                        
                            if($itemDet[0]['I_CODE']==$itemCode[$itemLop]){
                                $getLineDet = saleOrderLineDet(["where" => "AND SD_ID = '{$saleLineMainId[$itemLop]}'", "dataType" => "row"]);
                                if($retQty[$itemLop]>0){
                                    $totDisAmt = $retQty[$itemLop]*($getLineDet->SD_DIST_AMT/$getLineDet->SD_QTY);
                                    $totVatAmt = (($retQty[$itemLop]*$getLineDet->SD_SALE_PRICE)-$totDisAmt)*systemVat()/100;
                                    $dataDet = [
                                        "RD_RH_ID" => $temp_order_id,
                                        "RD_ITEM_CODE" => $itemCode[$itemLop],
                                        "RD_QTY" => $retQty[$itemLop],
                                        "RD_SALE_PRICE" => $getLineDet->SD_SALE_PRICE,
                                        "RD_DISC_TYPE" => $getLineDet->SD_DIST_TYPE,
                                        "RD_DIST_AMT" => $totDisAmt,
                                        "RD_SUB_TOT" => $retQty[$itemLop]*$getLineDet->SD_SALE_PRICE,
                                        "RD_WHSE_LOC_ID" => $getLineDet->SD_WHSE_LOC_ID,
                                        "RD_DIST_PER" => $getLineDet->SD_DIST_PER,
                                        "RD_VAT_AMT" => $itemDet[0]['I_FLAMMABLE']=='Y'?$totVatAmt:0,
                                        "RD_SD_LINE_ID" => $saleLineMainId[$itemLop]
                                    ];
                                    $st = $this->unicon->insertUniversal('RETURN_DETAIL', $dataDet);
                                }
                            }else{
                                $countAs = FALSE;
                            }
                        }

                        /*================== ACCOUNT SECTION =================*/
                        $saleHeadDet = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='{$dataHeader['RH_SH_TEMP_ID']}'","dataType"=>"row"]);
                        if($saleHeadDet->SH_SALE_TYPE == 'CASH'){
                            $accCashArr = (object)array('temp_id'=>$dataHeader['RH_TEMP_ID'],'return_id'=>$dataHeader['RH_INV_ID'],'order_count'=>$saleHeadDet->SH_INV_NO,'module'=>'SO','type'=>'CASH','rtnType'=>'Y');
                            $this->accountlib->cashInvoiceReturn($accCashArr);
                        }

                        /*================== ITEM TRACKING SECTION =================*/
                            $this->commonlib->saleReturnInvTrans($temp_order_id);
                        
                        /*================== PAYMENT DETAIL =================*/
                        $payDetailChargeData = array(
                            "PD_REF_ID" => 'PAY-' . random_strings(10, 'AN'),
                            "PD_ORDER_ID" => $temp_order_id,
                            "PD_PAY_METHOD_ID" => '01',
                            "PD_AMOUNT" => $this->input->post('grand_tot_db'),
                            "PD_TYPE" => "SALE_RETURN",
                            "PD_STATUS" => "RECEIVED",
                            "PD_PARTIES_ID" => $this->input->post('cust_id_db'),
                            "PD_BAL_TYPE" => "D",
                            "PD_EXCH_RATE" => 1,
                            "PD_CRE_BY" => $userCon->USERNAME,
                        );
                        $this->unicon->insertUniversal('PAYMENT_DETAIL', $payDetailChargeData);

                        if($countAs && $st){
                            $this->session->set_flashdata(['ret_cre'=>"<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            The item was successfully returned.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                            $pUrl = base_url('SaleReturnList');
                            $url = "<script>window.location.replace('$pUrl');</script>";
                            echo json_encode(array("multi" => "false", "err" => "false", "msg" => "Data Inserted Successfully".$url));
                        }else{
                            echo json_encode(array("multi" => "false", "err" => "true", "msg" => "item line empty count".$url));
                        }
                    
                }else{
                    echo json_encode(array("multi" => "false", "err" => "true", "msg" => "item line empty".$url));
                }
                
                // if ($ty) {
                //     echo json_encode(array("multi" => "false", "err" => "false", "msg" => "Data Inserted Successfully"));
                // } else {
                //     echo json_encode(array("multi" => "false", "err" => "true", "msg" => "something went wrong"));
                // }
            }
        }
    }
    
    /*================================ SALE CREATE ==============================*/
    public function saleAdddb()
    {
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        $payload = $this->input->post();
        header('Content-Type: application/json');

        $this->form_validation->set_rules('SH_CUST_ID', 'customer code/name', 'required');
        $this->form_validation->set_rules('formRadios', 'invoice type', 'required');
        $this->form_validation->set_rules('SH_WHSE_CODE', 'location code', 'required');
        $this->form_validation->set_rules('SH_TERM_ID', 'Sterm', 'required');
        $this->form_validation->set_rules('SH_SALESMAN_ID', 'salesman code', 'required');
        // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if ($this->form_validation->run() === FALSE) {
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi" => "true", "err" => "true", "msg" => $omsg));
        } else {
        
            $temp_order_id = random_strings(10, 'AN');
            // COMMON VARIABLE
            $saleType = $this->input->post('formRadios');
            
            // SO HEADER
            $orderNo = $this->unicon->CoreQuery("SELECT WHSE_CODE,WHSE_ORDER_COUNT,WHSE_INVOICE_COUNT FROM WHAREHOUSE WHERE WHSE_CODE='{$this->input->post('SH_WHSE_CODE')}'", "row");
            $this->unicon->CoreQuery("UPDATE WHAREHOUSE SET WHSE_ORDER_COUNT = LPAD(WHSE_ORDER_COUNT+1,6,0) WHERE WHSE_CODE='{$this->input->post('SH_WHSE_CODE')}'");
            $dataHeader = [
                            "SH_ORDER_ID" => $temp_order_id,
                            "SH_ORDER_PREFIX" => 'S'.$orderNo->WHSE_CODE,
                            "SH_ORDER_NO" => $orderNo->WHSE_ORDER_COUNT,
                            "SH_INV_PREFIX" => 'I'.$orderNo->WHSE_CODE,
                            "SH_INV_NO" => $orderNo->WHSE_INVOICE_COUNT,
                            "SH_STATUS" => $saleType=='cash'?"CLOSE":"OPEN",
                            "SH_SALE_TYPE" => $saleType=='cash'?'CASH':'CREDIT',
                            "SH_ORDER_DATE" => dashRole(["role_check"=>"SALE_ORDER_DATE"])?$payload['SH_ORDER_DATE']:date('Y-m-d'),
                            "SH_CUST_ID" => $this->input->post('SH_CUST_ID'),
                            "SH_SALESMAN_ID" => $this->input->post('SH_SALESMAN_ID'),
                            "SH_WHSE_CODE" => $this->input->post('SH_WHSE_CODE'),
                            "SH_DUE_DATE" => $this->input->post('SH_DUE_DATE'),
                            "SH_PAY_STATUS" => $saleType=='cash'?'PAID':'PENDING',
                            "SH_TERM_ID" => $saleType=='cash'?'997':'995',
                            "SH_CRE_BY" => $userCon->USERNAME,
                        ];

                $poInst = $this->unicon->insertUniversal('SALE_HEADER', $dataHeader);
                if ($saleType == 'credit') {
                    $crdId = $this->input->post('credit_auth_id_db');
                    $this->unicon->CoreQuery("UPDATE GENERATE_PASS SET MDP_ORDER_PFX='{$dataHeader['SH_ORDER_PREFIX']}',MDP_ORDER_NO='{$dataHeader['SH_ORDER_NO']}',MDP_ASSIGN_BY='{$dataHeader['SH_CRE_BY']}',MDP_TEMP_BLOCK='N',MDP_STATUS=1,MDP_USE_DATE = '$curDateTime' WHERE MDP_SEQ ='{$crdId}'");
                }
                $disExt = $this->input->post('discount_auth_id_db');
                if (isset($disExt)) {
                    $this->unicon->CoreQuery("UPDATE GENERATE_PASS SET MDP_ORDER_PFX='{$dataHeader['SH_ORDER_PREFIX']}',MDP_ORDER_NO='{$dataHeader['SH_ORDER_NO']}',MDP_ASSIGN_BY='{$dataHeader['SH_CRE_BY']}',MDP_TEMP_BLOCK='N',MDP_STATUS=1,MDP_USE_DATE = '$curDateTime' WHERE MDP_SEQ ='{$disExt}'");
                }
            // $poInst = FALSE;
            // $poInst = $this->unicon->insertUniversal('SALE_HEADER', $data);

            // SO DETAIL

            $itemCode = $this->input->post('SD_ITEM_CODE');
            $itemQty = $this->input->post('SD_QTY');
            $itemPrice = $this->input->post('SD_SALE_PRICE');
            $disType = $this->input->post('SD_DIST_TYPE');
            $disAmt = $this->input->post('SD_DIST_AMT');
            $vatAmt = $this->input->post('SO_VAT_AMT');
            $whseLocId = $this->input->post('SD_WHSE_LOC_ID');
            $disPerIn = $this->input->post('dis_per_db');

            for ($i = 0; $i < count($itemCode); $i++) {
                $getItemRow = $this->unicon->CoreQuery("SELECT * FROM ITEMS WHERE I_CODE ='{$itemCode[$i]}'", "num_rows");
                if ($getItemRow > 0 && $itemPrice[$i] > 0) {
                    if($disType[$i] == 'per' && $disPerIn[$i]>0){
                        $disTypeIn = 'PER';
                    }elseif ($disType[$i] == 'in' && $disPerIn[$i]>0) {
                        $disTypeIn = 'FIXED';
                    }else{
                        $disTypeIn = 'NO_DISCOUNT';
                    }
                    $itemCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$itemCode[$i]}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
                    $soDetailData = [
                                    "SD_ORDER_ID" => $temp_order_id,
                                    "SD_ITEM_CODE" => $itemCode[$i],
                                    "SD_QTY" => $itemQty[$i],
                                    "SD_SALE_PRICE" => $itemPrice[$i],
                                    "SD_DIST_TYPE" => $disTypeIn,
                                    "SD_DIST_AMT" => $disAmt[$i],
                                    "SO_VAT_AMT" => $vatAmt[$i],
                                    "SO_SUB_TOT" => $itemQty[$i]*$itemPrice[$i],
                                    "SD_WHSE_LOC_ID" => $whseLocId[$i],
                                    "SD_COST_PRICE" => $itemCost->INVCOST_STD_COST,
                                    "SD_DIST_PER" => $disType[$i] == 'per'?$disPerIn[$i]:null,
                                ];

                    $this->unicon->insertUniversal('SALE_DETAIL', $soDetailData);

                // NOTE : WHAREHOUSE STOCK DEBIT AFTER EACH SALE ORDER DETAIL CREATE ALSO UPDATE SALE HEADER TOT_QTY,GRAND_TOT ETC *** THROUGH TRIGGER : STOCK_DEBIT_AFTER_SALE_AND_UPDATE_SALE_HEAD

                }

            }

            // PAYMETN RECEIVED
            if ($saleType == 'cash') {

                $payMethId = $this->input->post('PD_PAY_METHOD_ID');
                $payAmt = $this->input->post('PD_AMOUNT');
                for ($iPoChrge = 0; $iPoChrge < count($payMethId); $iPoChrge++) {
                    $getPoChareRow = paymentList(['where'=>"WHERE PM_CODE = '{$payMethId[$iPoChrge]}'",'dataType'=>'num_rows']);
                    if ($getPoChareRow > 0 && $payAmt[$iPoChrge] > 0) {
                        $payDetailChargeData = [
                            "PD_REF_ID" => 'PAY-' . random_strings(10, 'AN'),
                            "PD_ORDER_ID" => $temp_order_id,
                            "PD_PAY_METHOD_ID" => $payMethId[$iPoChrge],
                            "PD_AMOUNT" => $payAmt[$iPoChrge],
                            "PD_TYPE" => "SALE",
                            "PD_STATUS" => "RECEIVED",
                            "PD_BAL_TYPE" => "C",
                            "PD_PARTIES_ID" => $this->input->post('SH_CUST_ID'),
                            "PD_CRE_DATE" => dateTime(),
                            "PD_CRE_BY" => $userCon->USERNAME,
                        ];

                        $this->unicon->insertUniversal('PAYMENT_DETAIL', $payDetailChargeData);
                        // MOTE AFTER PAYMENT ADD SALE HEADER UPDATE THROUGH TRIGGER **** TRIGGER NAME : UPDATE_ORDER_AFTER_PAY_ADD ******
                    }

                }
                //ACCOUNT SALE ORDER CASH START
                    $accCashArr = (object)array('temp_id'=>$dataHeader['SH_ORDER_ID'],'order_count'=>$dataHeader['SH_INV_NO'],'module'=>'SO','type'=>'CASH','rtnType'=>'N');
                    $this->accountlib->cashInvoice($accCashArr);
                //ACCOUNT SALE ORDER CASH START
            }else{
                //ACCOUNT SALE ORDER CASH START
                    $accCreditArr = (object)array('temp_id'=>$dataHeader['SH_ORDER_ID'],'order_count'=>$dataHeader['SH_INV_NO'],'module'=>'SO','type'=>'RECEIVEABLE','rtnType'=>'N');
                    $this->accountlib->creditInvoice($accCreditArr);
                //ACCOUNT SALE ORDER CASH START

                //WALLET MODULE START
                    $this->wallet->saleCreditWallet($temp_order_id);
                //WALLET MODULE END
            }

            if ($poInst) {
                $this->unicon->CoreQuery("UPDATE WHAREHOUSE SET WHSE_INVOICE_COUNT = LPAD(WHSE_INVOICE_COUNT+1,6,0) WHERE WHSE_CODE='{$this->input->post('SH_WHSE_CODE')}'");
                
                // $purOrderType = $this->input->post('pur_order_type_db');
                // $preFix = $this->unicon->CoreQuery("SELECT * FROM PO_PREFIXES WHERE POP_ORDER_PFX ='$purOrderType'", "row");

                // $this->unicon->CoreQuery("UPDATE CLEARANCE_PO_ID SET CPO_ORDER_ID='{$preFix->POP_NEXT_NUMBER}',CPO_ORDER_PFX='$purOrderType' WHERE CPO_TEMP_CL_ID='$temp_order_id'");
                // $this->unicon->CoreQuery("UPDATE PO_HEADER SET POH_ORDER_ID='{$preFix->POP_NEXT_NUMBER}',POH_PREFIX='$purOrderType' WHERE POH_TEMP_ORDER_ID='$temp_order_id'");
                // $this->unicon->CoreQuery("UPDATE PO_DETAILS SET POD_POH_ORDER_ID='{$preFix->POP_NEXT_NUMBER}',POD_PREFIX='$purOrderType' WHERE POD_TEMP_ORDER_ID='$temp_order_id'");
                // $this->unicon->CoreQuery("UPDATE PO_DETAILS_CHARGES SET PODC_POH_ORDER_ID='{$preFix->POP_NEXT_NUMBER}',PODC_PREFIX='$purOrderType' WHERE PODC_TEMP_ORDER_ID='$temp_order_id'");
                $orderId = dataEncyptbase64($temp_order_id,'encrypt');
                // ITEM TRACKING START
                    $this->commonlib->saleInvTrans($temp_order_id);
                // ITEM TRACKING END
                $url = base_url('SaleView?orderid=').$orderId;
                $url = "<script>window.location.replace('$url');</script>";
                echo json_encode(array("multi" => "false", "err" => "false", "msg" => "Data Inserted Successfully" . $url));

            } else {

                echo json_encode(array("multi" => "false", "err" => "true", "msg" => "something went wrong"));

            }
        }
    }

    /**=======================================================================================================================
     *                                                    SALE RETURN TABLE LIST START
     *=======================================================================================================================**/

     public function saleReturnListJson(){
        $userCon = sessionUserData();
        $saleType = $this->input->post('sale_type');
        $filterdata = array(
            "column_order" => array(NULL,NULL),
            "column_search" => array(NULL),
            "order" => array('RH_CRE_BY_DATE' => 'DESC')
        );

        $sqlQueryTemp = array(

            "SELECT"=>'*',
            "FROM"=>'RETURN_HEADER',

            "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                "JOIN_1_TABLE_NAME"=>'CUSTOMER',
                "JOIN_1_TABLE_CONN"=>'CUSTOMER.CUST_CODE=RETURN_HEADER.RH_PARTIES_ID',

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
        );
        // if ($saleType == "invoice") {
        //     $sqlQueryTemp["CORE_WHERE_1_DATA"] = "SALE_HEADER.SH_INV_PREFIX IS NOT NULL";
        // }else{
        //     $sqlQueryTemp["CORE_WHERE_1_DATA"] = "SALE_HEADER.SH_INV_PREFIX IS NULL";
        // }
        /*================== ROLE ASSIGN =================*/
        
        if ($userCon->USER_TYPE == 'SUPERADMIN' || $userCon->USER_TYPE == 'ADMIN') {
                
        }elseif($userCon->USER_TYPE == 'USER'){
            $sqlQueryTemp["CORE_WHERE_1_CONTROL"] = TRUE;  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
            $sqlQueryTemp["CORE_WHERE_1_DATA"] = "RH_CRE_BY = '{$userCon->USERNAME}'";
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

            $orderId = dataEncyptbase64($rowdata->RH_TEMP_ID,'encrypt');
            $invCount = $rowdata->RH_INV_NO?$rowdata->RH_INV_NO:substr($rowdata->RH_INV_ID,8);
            $row[] = "<a href='".base_url('saleReturnView?orderid=').$orderId."' class='text-body fw-bold'>{$rowdata->RH_INV_PREFIX}-{$invCount}</a>";
            $row[] = "{$rowdata->CUST_NAME}</br>{$rowdata->CUST_NAME_AR}"; 
            $row[] = "{$rowdata->RH_DATE}";
            $row[] = numberSystem($rowdata->RH_TOT_QTY,2);
            $row[] = numberSystem($rowdata->RH_GRAND_TOT);
            if ($rowdata->RH_STATUS == 'PAID') {$payStsBg = "success";}elseif ($rowdata->RH_STATUS == 'PARTIAL') {$payStsBg = "primary";}else {$payStsBg = "warning";}
            $row[] = "<span class='badge bg-$payStsBg'>{$rowdata->RH_STATUS}</span>";
            if ($saleType == "invoice") {
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='View'>
                                <a href='".base_url('saleReturnView?orderid=').$orderId."' class='btn btn-sm btn-soft-primary'><i class='mdi mdi-eye-outline'></i></a>
                            </li>
                        </ul>";
            }else{
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='View'>
                                <a href='".base_url('saleReturnView?orderid=').$orderId."' class='btn btn-sm btn-soft-primary'><i class='mdi mdi-eye-outline'></i></a>
                            </li>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Invoice Print'>
                                <a href='".base_url('saleReturnPrint?orderid=').$orderId."' target='_blank' class='btn btn-sm btn-soft-dark waves-effect waves-light'><i class='mdi mdi-printer-check'></i></a>
                            </li>
                        </ul>";
            }
           
                    // <li data-bs-toggle='tooltip' data-bs-placement='top' title='Delete'>
                    // <a href='#jobDelete' data-bs-toggle='modal' class='btn btn-sm btn-soft-danger'><i class='mdi mdi-delete-outline'></i></a>
                    // </li>
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

    /**========================================================================
     *                           SALE RETURN TABLE LIST END
     *========================================================================**/

    
    /**=======================================================================================================================
     *                                                    SALE TABLE LIST START
     *=======================================================================================================================**/

     public function saleOrderListJson(){
        $userCon = sessionUserData();
        
        $saleType = $this->input->post('sale_type');
        $filterdata = array(
            "column_order" => array(NULL,'SH_ORDER_NO','SH_CUST_ID','SH_ORDER_DATE','SH_TOT_QTY','SH_GRAND_TOT','SH_PAY_STATUS','SH_SALE_TYPE',NULL),
            "column_search" => array('SH_ORDER_PREFIX','SH_ORDER_NO','SH_CUST_ID','SH_ORDER_DATE','SH_TOT_QTY','SH_GRAND_TOT','SH_PAY_STATUS','SH_SALE_TYPE'),
            "order" => array('SH_CRE_DATE' => 'DESC')
        );

   

        $sqlQueryTemp = array(

            "SELECT"=>'*',
            "FROM"=>'SALE_HEADER',

            "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                "JOIN_1_TABLE_NAME"=>'CUSTOMER',
                "JOIN_1_TABLE_CONN"=>'CUSTOMER.CUST_CODE=SALE_HEADER.SH_CUST_ID',

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
            
            "CORE_WHERE_1_CONTROL"=>TRUE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
        );
        if ($saleType == "invoice") {
            $sqlQueryTemp["CORE_WHERE_1_DATA"] = "SALE_HEADER.SH_INV_PREFIX IS NOT NULL";
        }else{
            $sqlQueryTemp["CORE_WHERE_1_DATA"] = "SALE_HEADER.SH_INV_PREFIX IS NULL";
        }
        /*================== ROLE ASSIGN =================*/ 
            if ($userCon->USER_TYPE == 'SUPERADMIN' || $userCon->USER_TYPE == 'ADMIN') {
                
            }elseif($userCon->USER_TYPE == 'USER'){
                $sqlQueryTemp["CORE_WHERE_1_DATA"] = "{$sqlQueryTemp["CORE_WHERE_1_DATA"]} AND SH_CRE_BY = '{$userCon->USERNAME}'";
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

            $orderId = dataEncyptbase64($rowdata->SH_ORDER_ID,'encrypt');

            $row[] = "<a href='".base_url('SaleView?orderid=').$orderId."' class='text-body fw-bold'>{$rowdata->SH_INV_PREFIX}-{$rowdata->SH_INV_NO}</a>";
            $row[] = "{$rowdata->CUST_NAME}</br>{$rowdata->CUST_NAME_AR}"; 
            $row[] = "{$rowdata->SH_ORDER_DATE}";
            $row[] = numberSystem($rowdata->SH_TOT_QTY,2);
            $row[] = numberSystem($rowdata->SH_GRAND_TOT);
            $orderType = $rowdata->SH_TERM_ID == '997' ? 'CASH' : 'CREDIT';
            $orderTypeBg = $rowdata->SH_TERM_ID == '997' ? 'success' : 'danger';
            if ($rowdata->SH_PAY_STATUS == 'PAID') {$payStsBg = "success";}elseif ($rowdata->SH_PAY_STATUS == 'PARTIAL') {$payStsBg = "primary";}else {$payStsBg = "warning";}
            if($rowdata->SH_SALE_TYPE == 'CASH'){
                $orderSt = "<span class='badge bg-$payStsBg'>{$rowdata->SH_PAY_STATUS}</span>";
            }else{
                $orderSt = "Credit";
            }
            $row[] = $orderSt;

            $row[] = "<span class='badge bg-$orderTypeBg'>{$orderType}</span>";
            if($rowdata->SH_RET_STATUS == 'F'){
                $retTypeBg = "danger";
                $retTypeName = "Fully Return";
            }elseif ($rowdata->SH_RET_STATUS == 'P') {
                $retTypeBg = "primary";
                $retTypeName = "Partially Return";
            }else{
                $retTypeBg = "success";
                $retTypeName = "No Return";
            }
            $row[] = "<span class='badge bg-$retTypeBg'>{$retTypeName}</span>";
            if ($saleType == "invoice") {
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='View'>
                                <a href='".base_url('SaleView?orderid=').$orderId."' class='btn btn-sm btn-soft-primary'><i class='mdi mdi-eye-outline'></i></a>
                            </li>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Return'>
                                <a href='".base_url('SaleReturn?orderid=').$orderId."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-backup-restore'></i></a>
                            </li>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Invoice Print AR'>
                                <a href='".base_url('SalePrintARPDF?orderid=').$orderId."' class='btn btn-sm btn-soft-dark waves-effect waves-light' target='_blank'><i class='mdi mdi-printer-check'></i></a>
                            </li>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Invoice Print English'>
                                <a href='".base_url('SalePrintENPDF?orderid=').$orderId."' class='btn btn-sm btn-primary waves-effect waves-light' target='_blank'><i class='mdi mdi-printer-check'></i></a>
                            </li>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Invoice Print Gift'>
                                <a href='".base_url('SalePrintGFPDF?orderid=').$orderId."' class='btn btn-sm btn-warning waves-effect waves-light' target='_blank'><i class='mdi mdi-printer-check'></i></a>
                            </li>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Invoice Print Price'>
                                <a href='".base_url('SalePrintPRPDF?orderid=').$orderId."' class='btn btn-sm btn-danger waves-effect waves-light' target='_blank'><i class='mdi mdi-printer-check'></i></a>
                            </li>
                        </ul>";
                        // <li data-bs-toggle='tooltip' data-bs-placement='top' title='get gl entry'>
                        //     <a href='".base_url('export/saleOrderGL?orderid=').$orderId."' class='btn btn-sm btn-soft-success'><i class='mdi mdi-arrow-collapse-down'></i></a>
                        // </li>
            }else{
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='View'>
                                <a href='".base_url('SaleView?orderid=').$orderId."' class='btn btn-sm btn-soft-primary'><i class='mdi mdi-eye-outline'></i></a>
                            </li>
                        </ul>";
            }
           
                    // <li data-bs-toggle='tooltip' data-bs-placement='top' title='Delete'>
                    // <a href='#jobDelete' data-bs-toggle='modal' class='btn btn-sm btn-soft-danger'><i class='mdi mdi-delete-outline'></i></a>
                    // </li>
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

    /**========================================================================
     *                           SALE ORDER TABLE LIST END
     *========================================================================**/

     /*================================ PAYMENT IN ==============================*/
        
     public function payInCreate(){
        $userCon = sessionUserData();
        header('Content-Type: application/json');

        // $this->form_validation->set_rules('vchno_p_db', 'voucher No', 'required|unique_code_db[PAYMENT_VOCHER.PV_ORDER_NO.Voucher No already used, Please reFresh this page]');
        $this->form_validation->set_rules('vendor_code_db', 'select supplier', 'required');
        $this->form_validation->set_rules('vchno_p_db', 'voucher', 'required');
        $this->form_validation->set_rules('voch_order_pre', 'select warehouse First', 'required');
        $this->form_validation->set_rules('amount_p_db', 'amount', 'required|numeric');
        $this->form_validation->set_rules('PV_WHSE_CODE', 'warehouse', 'required|numeric');
        
        if ($this->form_validation->run() === FALSE) {
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi" => "true", "err" => "true", "msg" => $omsg));
        } else {
            $orderPre = $this->input->post('voch_order_pre');
            $venCode = $this->input->post('vendor_code_db');
            $amount = $this->input->post('amount_p_db');
            $whseCode = $this->input->post('PV_WHSE_CODE');
            $multiPayMeth = $this->input->post('PD_PAY_METHOD_ID');
            $payAmtMul = $this->input->post('PD_AMOUNT');
            $payBatchCode = 'PAY-'.random_strings(8);
            $tempCheck = false;
            if(substr($orderPre,0,1) == 'P'){
                foreach ($multiPayMeth as $key => $multiPayMethGetValue) {
                    if($payAmtMul[$key]>0){
                        $headerData = [
                            "PV_ORDER_NO" => payInOrderUpdate($whseCode,substr($orderPre,0,1)),
                            "PV_WHSE_CODE" => $whseCode,
                            "PV_ORDER_PRE" =>$orderPre,
                            "PV_DATE" => date('Y-m-d'),
                            "PV_DESC" => empty($this->input->post('voch_desc_p_db'))?NULL:$this->input->post('voch_desc_p_db'),
                            "PV_AMT" => $payAmtMul[$key],
                            "PV_PAY_METH" => $multiPayMethGetValue,
                            "PV_PARTIES_CODE" => $venCode,
                            "PV_BATCH_CODE" => $payBatchCode,
                            "PV_TYPE" => 'CUSTOMER',
                            "PV_CRE_DATE" => dateTime(),
                            "PV_CRE_BY" =>$userCon->USERNAME,
                        ];
                        $this->unicon->insertUniversal('PAYMENT_VOCHER',$headerData);

                        //ACCOUNT START
                        $this->accountlib->accountReceivable((object)array('orderPre'=>$headerData['PV_ORDER_PRE'],'orderNo'=>$headerData['PV_ORDER_NO']));
                        //ACCOUNT END
                        // WALLET START
                            $this->wallet->payIn((object)array('orderPre'=>$headerData['PV_ORDER_PRE'],'orderNo'=>$headerData['PV_ORDER_NO']));
                        // WALLET END
                    }
                    $tempCheck = true;
                }
            }elseif(substr($orderPre,0,1) == 'C'){
                foreach ($multiPayMeth as $key => $multiPayMethGetValue) {
                    if($payAmtMul[$key]>0){
                        $headerData = [
                            "PV_ORDER_NO" => payInOrderUpdate($whseCode,substr($orderPre,0,1)),
                            "PV_WHSE_CODE" => $whseCode,
                            "PV_ORDER_PRE" =>$orderPre,
                            "PV_DATE" => date('Y-m-d'),
                            "PV_DESC" => empty($this->input->post('voch_desc_p_db'))?NULL:$this->input->post('voch_desc_p_db'),
                            "PV_AMT" => $payAmtMul[$key],
                            "PV_PAY_METH" => $multiPayMethGetValue,
                            "PV_PARTIES_CODE" => $venCode,
                            "PV_BATCH_CODE" => $payBatchCode,
                            "PV_TYPE" => 'CUSTOMER',
                            "PV_CRE_DATE" => dateTime(),
                            "PV_CRE_BY" =>$userCon->USERNAME,
                        ];
                        $this->unicon->insertUniversal('PAYMENT_VOCHER',$headerData);

                        //ACCOUNT START
                        $this->accountlib->accountReceivable((object)array('orderPre'=>$headerData['PV_ORDER_PRE'],'orderNo'=>$headerData['PV_ORDER_NO']));
                        //ACCOUNT END
                        // WALLET START
                            $this->wallet->payIn((object)array('orderPre'=>$headerData['PV_ORDER_PRE'],'orderNo'=>$headerData['PV_ORDER_NO']));
                        // WALLET END
                    }
                    $tempCheck = true;
                }
            }else{
                foreach ($multiPayMeth as $key => $multiPayMethGetValue) {
                    if($payAmtMul[$key]>0){
                        $headerData = [
                            "PV_ORDER_NO" => payInOrderUpdate($whseCode,substr($orderPre,0,1)),
                            "PV_WHSE_CODE" => $whseCode,
                            "PV_ORDER_PRE" =>$orderPre,
                            "PV_DATE" => date('Y-m-d'),
                            "PV_DESC" => empty($this->input->post('voch_desc_p_db'))?NULL:$this->input->post('voch_desc_p_db'),
                            "PV_AMT" => $payAmtMul[$key],
                            "PV_PAY_METH" => $multiPayMethGetValue,
                            "PV_PARTIES_CODE" => $venCode,
                            "PV_BATCH_CODE" => $payBatchCode,
                            "PV_TYPE" => 'CUSTOMER',
                            "PV_CRE_DATE" => dateTime(),
                            "PV_CRE_BY" =>$userCon->USERNAME,
                        ];
                        $this->unicon->insertUniversal('PAYMENT_VOCHER',$headerData);

                        //ACCOUNT START
                        $this->accountlib->accountReceivable((object)array('orderPre'=>$headerData['PV_ORDER_PRE'],'orderNo'=>$headerData['PV_ORDER_NO']));
                        //ACCOUNT END
                        // WALLET START
                            $this->wallet->payIn((object)array('orderPre'=>$headerData['PV_ORDER_PRE'],'orderNo'=>$headerData['PV_ORDER_NO']));
                        // WALLET END
                    }
                    $tempCheck = true;
                }
            }

            if($tempCheck){
                
                echo json_encode(array("multi" => "false", "err" => "false", "msg" => "Payment Voucher Successfully created"));
            }else{
                echo json_encode(array("multi" => "false", "err" => "true", "msg" => "Please add some item"));
                }
            }
        }

    public function payInCreateOld(){
        $userCon = sessionUserData();
        header('Content-Type: application/json');

        // $this->form_validation->set_rules('vchno_p_db', 'voucher No', 'required|unique_code_db[PAYMENT_VOCHER.PV_ORDER_NO.Voucher No already used, Please reFresh this page]');
        $this->form_validation->set_rules('vendor_code_db', 'select supplier', 'required');
        $this->form_validation->set_rules('vchno_p_db', 'voucher', 'required');
        $this->form_validation->set_rules('voch_order_pre', 'select warehouse First', 'required');
        $this->form_validation->set_rules('amount_p_db', 'amount', 'required|numeric');
        $this->form_validation->set_rules('PV_WHSE_CODE', 'warehouse', 'required|numeric');
        
        if ($this->form_validation->run() === FALSE) {
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi" => "true", "err" => "true", "msg" => $omsg));
        } else {
            $orderPre = $this->input->post('voch_order_pre');
            $venCode = $this->input->post('vendor_code_db');
            $amount = $this->input->post('amount_p_db');
            $whseCode = $this->input->post('PV_WHSE_CODE');
            if(substr($orderPre,0,1) == 'P'){
                $incDets = invDetByCustCode(['where'=>"WHERE SH_CUST_ID='$venCode' AND SH_PAY_STATUS IN('PENDING','PARTIAL') ORDER BY SH_ORDER_DATE ASC",'dataType'=>'result']);
                $outAmt = $amount;
                    foreach ($incDets as $incDet) {
                        $outAmtInc = $incDet->SH_GRAND_TOT-$incDet->SH_PAID_AMT;
                            if ($outAmt>=$outAmtInc) {
                                $this->unicon->CoreQuery("UPDATE SALE_HEADER SET SH_PAID_AMT = SH_PAID_AMT+'$outAmtInc' WHERE SH_ORDER_ID = '{$incDet->SH_ORDER_ID}'");
                                $this->unicon->CoreQuery("UPDATE SALE_HEADER SET SH_PAY_STATUS = IF (SH_GRAND_TOT = SH_PAID_AMT,'PAID', SH_PAY_STATUS ) WHERE SH_ORDER_ID = '{$incDet->SH_ORDER_ID}'");

                                $payDetailChargeData = [
                                    "PD_REF_ID" => 'PAY-' . random_strings(10, 'AN'),
                                    "PD_ORDER_ID" => $incDet->SH_ORDER_ID,
                                    "PD_PAY_METHOD_ID" => empty($this->input->post('pay_meth_db'))?'01':$this->input->post('pay_meth_db'),
                                    "PD_AMOUNT" => $outAmtInc,
                                    "PD_TYPE" => "SALE",
                                    "PD_STATUS" => "RECEIVED",
                                    "PD_BAL_TYPE" => "C",
                                    "PD_PARTIES_ID" => $venCode,
                                    "PD_VOCH_CODE" => $this->input->post('vchno_p_db'),
                                    "PD_CRE_BY" => $userCon->USERNAME,
                                ];
                                $dr = $this->unicon->insertUniversal('PAYMENT_DETAIL', $payDetailChargeData);
                                $outAmt = $outAmt - $outAmtInc;
                            }elseif ($outAmtInc>$outAmt && $outAmt>0) {
                                $this->unicon->CoreQuery("UPDATE SALE_HEADER SET SH_PAID_AMT = SH_PAID_AMT+'$outAmt' WHERE SH_ORDER_ID = '{$incDet->SH_ORDER_ID}'");
                                $this->unicon->CoreQuery("UPDATE SALE_HEADER SET SH_PAY_STATUS = IF (SH_GRAND_TOT > SH_PAID_AMT, 'PARTIAL', SH_PAY_STATUS ) WHERE SH_ORDER_ID = '{$incDet->SH_ORDER_ID}'");
                                
                                $payDetailChargeData = [
                                    "PD_REF_ID" => 'PAY-' . random_strings(10, 'AN'),
                                    "PD_ORDER_ID" => $incDet->SH_ORDER_ID,
                                    "PD_PAY_METHOD_ID" => empty($this->input->post('pay_meth_db'))?'01':$this->input->post('pay_meth_db'),
                                    "PD_AMOUNT" => $outAmt,
                                    "PD_TYPE" => "SALE",
                                    "PD_STATUS" => "RECEIVED",
                                    "PD_BAL_TYPE" => "C",
                                    "PD_PARTIES_ID" => $venCode,
                                    "PD_VOCH_CODE" => $this->input->post('vchno_p_db'),
                                    "PD_CRE_BY" => $userCon->USERNAME,
                                ];
        
                                $rt = $this->unicon->insertUniversal('PAYMENT_DETAIL', $payDetailChargeData);
                                $outAmt = $outAmt - $outAmt;
                            }
                    }
                    //* SYNC SALE HEADER PAYMENT STATUS 
                    syncPayStatusForCust(invDetByCustCode(['where'=>"WHERE SH_CUST_ID='$venCode' AND SH_PAY_STATUS IN('PENDING','PARTIAL') ORDER BY SH_ORDER_DATE ASC",'dataType'=>'result']));
            }elseif(substr($orderPre,0,1) == 'C'){

            }else{

            }
            $tempCheck = false;

                $headerData = [
                            "PV_ORDER_NO" => payInOrderUpdate($whseCode,substr($orderPre,0,1)),
                            "PV_WHSE_CODE" => $whseCode,
                            "PV_ORDER_PRE" =>$orderPre,
                            "PV_DATE" => date('Y-m-d'),
                            "PV_DESC" => empty($this->input->post('voch_desc_p_db'))?NULL:$this->input->post('voch_desc_p_db'),
                            "PV_AMT" => empty($this->input->post('amount_p_db'))?NULL:$this->input->post('amount_p_db'),
                            "PV_PAY_METH" => empty($this->input->post('pay_meth_db'))?'01':$this->input->post('pay_meth_db'),
                            "PV_PARTIES_CODE" => $venCode,
                            "PV_TYPE" => 'CUSTOMER',
                            "PV_CRE_DATE" => dateTime(),
                            "PV_CRE_BY" =>$userCon->USERNAME,
                        ];

            if($this->unicon->insertUniversal('PAYMENT_VOCHER',$headerData)){
                //ACCOUNT START
                    $this->accountlib->accountReceivable((object)array('orderPre'=>$headerData['PV_ORDER_PRE'],'orderNo'=>$headerData['PV_ORDER_NO']));
                //ACCOUNT END
                // WALLET START
                    $this->wallet->payIn((object)array('orderPre'=>$headerData['PV_ORDER_PRE'],'orderNo'=>$headerData['PV_ORDER_NO']));
                // WALLET END
                echo json_encode(array("multi" => "false", "err" => "false", "msg" => "Payment Voucher Successfully created"));
            }else{
                echo json_encode(array("multi" => "false", "err" => "true", "msg" => "Please add some item"));
                }
            }
        }



        /*================================ SALE RETURN ==============================*/

        public function getLineDetbyOrderId(){
            $orderId = $this->input->post('order_id');
            $orderDet = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            if($orderDet->SH_RET_STATUS == 'N' || $orderDet->SH_RET_STATUS == 'P'){
                $dataDet = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","select"=>"*,SD_QTY-SD_RET_QTY RET_QTY","dataType"=>"result"],'multi');
            }
            echo json_encode(["lineDetail" => $dataDet]);
        }
        
        
}