<?php
     class Common extends CI_Controller{
         public function __construct(){
            parent::__construct();
      
            // $this->load->model('Site_model', 'dbcon');
            $this->load->model('Universal_model','unicon');
            // $this->load->library('form_validation');
            // $this->load->helper('form');
            //$this->load->model('QrController','qrcon');
            $this->load->model('FunctionAndProcedure_model','profunccon');
         }

        public function getCurrentDateAndTime(){
          
            echo json_encode(dateTime());
        }

        public function getCustLisByWhseCode(){
            $whseCode = $this->input->post('whse_code');
            $data = customerDet(array('where'=>"WHERE CUST_WHSE_CODE = '$whseCode' ORDER BY CUST_CODE ASC",'dataType'=>"result"));
            echo json_encode($data);
        }

        public function getStateByCntryCode(){
            $cntryCode = $this->input->post('country_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM STATES WHERE ST_CNTRY_ID='$cntryCode'","result_array");
            echo json_encode($data);
        }

        public function getAccSubHeadDetByCode(){
            $accMainHead = $this->input->post('acc_main_head');
            $data = accHeadDet(['where'=>"WHERE AH_MAIN_HEAD = '$accMainHead' GROUP BY AH_SUB_HEAD",'dataType'=>'result_array']);
            echo json_encode($data);
        }

        public function getAccGenHeadDetByCode(){
            $accSubHead = $this->input->post('acc_sub_head');
            $data = accHeadDet(['where'=>"WHERE AH_SUB_HEAD = '$accSubHead' GROUP BY AH_GENERAL",'dataType'=>'result_array']);
            echo json_encode($data);
        }

        public function getSubsidary(){
            $genCode = $this->input->post('gen_code');
            $data = accHeadDet(['where'=>"WHERE AH_GENERAL = '$genCode' ORDER BY AH_SUBSIDERY DESC LIMIT 1",'dataType'=>'row']);
            echo json_encode($data);
        }

        /*================== role Module =================*/
        
        public function getSubModuleByModuleName(){
            $moduleName = $this->input->post('module');
            $data = module(['type'=>"AND MAF_TYPE NOT IN('MODULE') AND MAF_NAME LIKE '{$moduleName}%'"]);
            echo json_encode($data);
        }

        /*================== Get module NAme by role group name =================*/
        
        public function getModuleDetByRolegrpName(){
            // $moduleName = $this->input->post('role_code');
            $moduleName = explode(',',$this->input->post('role_asign'));
            $rType = $this->input->post('user_role');
            if(isset($rType) == 'Y'){
                $roleCode = $this->input->post('role_code');
                $moduleName = $this->unicon->CoreQuery("SELECT * FROM ROLE_GROUP WHERE RG_NAME = '$roleCode'","row");
                $moduleName = explode(',',$moduleName->RG_ASSIGN);
            }
                $newSql = [];
                foreach ($moduleName as $fetchData) {
                    $newSql[] = "'$fetchData'";
                }
                $data = module(['type'=>"AND MAF_NAME IN (".implode(',',$newSql).")"]);
            
            echo json_encode($data);
        }

        /*================================ get salesman wharehouse details ==============================*/
        
        public function getSalesmanWhseDet(){
            $salesCode = $this->input->post('salesman_code');
            $data = $this->unicon->CoreQuery("SELECT * 
                                                FROM SALES_MAN_ASSIGN_WHSE,WHAREHOUSE
                                                WHERE SMSW_WHSE_CODE = WHSE_CODE AND
                                                SMSW_SLSP_CODE='$salesCode'","result");
            echo json_encode($data);
        }

        public function getCItyByStCode(){
            $stateCode = $this->input->post('state_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM CITIES WHERE CTY_STATE_CODE='$stateCode'","result_array");
            echo json_encode($data);
        }

        public function getClassDescbyCode(){
            $classCode = $this->input->post('class_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM ITEM_CLASSES WHERE IC_CODE='$classCode'","result_array");
            echo json_encode($data);
        }

        public function getCatDescbyCode(){
            $catCode = $this->input->post('cat_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM ITEM_CATEGORY WHERE ICAT_CODE='$catCode'","result_array");
            echo json_encode($data);
        }

        public function getCntryDescbyCode(){
            $cntryCode = $this->input->post('cntry_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM COUNTRIES WHERE CNTRY_CODE='$cntryCode'","result_array");
            echo json_encode($data);
        }

        public function getClassListByCategoryCode(){
            $catCode = $this->input->post('cat_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM ITEM_CLASSES WHERE IC_ITEM_CAT='$catCode'","result_array");
            echo json_encode($data);
        }

        public function getTraitListbyCode(){
            $catCode = $this->input->post('cat_code');

            $catDesc = $this->unicon->CoreQuery("SELECT * FROM TRAIT_CATEGORY WHERE TC_CODE='$catCode'","result_array");
            $data = $this->unicon->CoreQuery("SELECT * FROM TRAIT_SUB_CATEGORY WHERE TRAIT_CAT_ID='$catCode'","result_array");

            echo json_encode(['trait_data'=>$data,'cat_desc'=>count($catDesc)==1?$catDesc[0]['TC_DESC']:'Data not Available']);
        }

        public function getItemTraitByItemCode(){
            $itemCode = $this->input->post('itemCode');

            $itemDel = $this->unicon->CoreQuery("SELECT * FROM ITEMS WHERE I_CODE='$itemCode'","result_array");

            $data = $this->unicon->CoreQuery("SELECT * FROM ITEMS as I
                                                        JOIN ITEM_TRAITS AS IT
                                                        ON IT.ITM_CODE =I.I_CODE
                                                        JOIN TRAIT_CATEGORY AS TC
                                                        ON TC.TC_CODE = IT.ITM_TRAIT_CAT_CODE
                                                        JOIN TRAIT_SUB_CATEGORY AS TSC
                                                        ON TSC.TRAIT_SUB_CAT_CODE =IT.ITM_TRAIT_CODE AND TSC.TRAIT_CAT_ID =IT.ITM_TRAIT_CAT_CODE
                                                        WHERE I.I_CODE='$itemCode'","result_array");

            echo json_encode(['traitDeaits'=>$data,'itemdel'=>count($itemDel)==1?$itemDel:NULL]);
        }

        public function getVenDelByVenCode(){
            $venCode = $this->input->post('ven_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM VENDOR WHERE V_CODE LIKE '$venCode%'","row_array");
            echo json_encode(['ven_det'=>$data]);
        }

        public function getEmpDetByEmpCode(){
            $data = $data1 = array();

            $searchType = $this->input->get('searchtype');
            $venCode = $this->input->get('term');
            $whseId = $this->input->get('whse_in');
            if(isset($whseId)){
                $venLists = $this->unicon->CoreQuery("SELECT EMP_CODE AS CODE,EMP_NAME1 AS ENG_NAME,EMP_NAME2 AS NAME_AR,EMP_STR_ADDR1 AS ADD1,EMP_PHONE1 AS PHONE1,EMP_DISC_PER AS EMP_DISC
                FROM EMPLOYEE,SALES_PERSON,SALES_MAN_ASSIGN_WHSE
                WHERE EMP_CODE = SLSP_EMPLOYEE_CODE
                AND SLSP_CODE = SMSW_SLSP_CODE
                AND SMSW_WHSE_CODE LIKE '%$whseId%'
                AND (EMP_CODE LIKE '%$venCode%' 
                OR EMP_NAME1 LIKE '%$venCode%'
                OR EMP_NAME2 LIKE '%$venCode%') GROUP BY SMSW_SLSP_CODE",$searchType == 'list'?"result":"row");
            }else{
                $venLists = $this->unicon->CoreQuery("SELECT EMP_CODE AS CODE,EMP_NAME1 AS ENG_NAME,EMP_NAME2 AS NAME_AR,EMP_STR_ADDR1 AS ADD1,EMP_PHONE1 AS PHONE1,EMP_DISC_PER AS EMP_DISC
                                                        FROM EMPLOYEE
                                                        WHERE EMP_CODE LIKE '%$venCode%' 
                                                        OR EMP_NAME1 LIKE '%$venCode%'
                                                        OR EMP_NAME2 LIKE '%$venCode%'",$searchType == 'list'?"result":"row");
                if($searchType == 'select'){
                    $empAsignList = $this->unicon->CoreQuery("SELECT * FROM SALES_PERSON,SALES_MAN_ASSIGN_WHSE
                                                            WHERE SLSP_CODE = SMSW_SLSP_CODE
                                                            AND SLSP_EMPLOYEE_CODE ='{$venLists->CODE}'","result");
                }
            }
            
            if ($searchType == 'list') {
                foreach ($venLists as $venList) {
                    $data['id'] = $venList->CODE;
                    $data["value"] =  $venList->CODE.'-'.$venList->ENG_NAME.'-'.$venList->NAME_AR;
                    $data1[] = $data;
                 }

                $json = json_encode($data1);
                echo $this->input->get('callback')."({$json})";
            }else{
            // print_r($venBalDet);
                echo json_encode([
                                    "vend_det" => $venLists,
                                    "emp_ass_list"=>isset($empAsignList)?$empAsignList:null]);
            }
  
        }

        public function getCustDelByCustCode(){
            $custCode = $this->input->post('cust_code');
            $data = customerDet(['dataType' => 'row','where'=> "WHERE CUST_CODE LIKE '$custCode%' OR CUST_NAME LIKE '$custCode%' OR CUST_NAME_AR LIKE '$custCode%'"]);
            echo json_encode(['cust_det'=>$data]);
        }

        public function getEmployeeRoleAssignDel(){
            $empCode = $this->input->post('emp_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM ROLE_ASSIGN_USER RAU,ROLE_GROUP 
                                            WHERE RAU_ROLE_CODE = RG_NAME 
                                            AND RAU_EMP_CODE='$empCode'","row");
            echo json_encode(['role_del'=>$data]);
        }

        public function getRoleGroupDet(){
            $roleGrpName = $this->input->post('role_group_name');
            $data = $this->unicon->CoreQuery("SELECT * FROM ROLE_GROUP
                                            WHERE RG_NAME ='$roleGrpName'","row");
            echo json_encode(['role_del'=>$data]);
        }

        public function getFreightDelByfreightCode(){
            $frtCode = $this->input->post('freight_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM FREIGHTS WHERE FRT_CODE LIKE '$frtCode%'","row_array");
            echo json_encode(['freight_det'=>$data]);
        }

        public function getTermdetBytermCode(){
            $termCode = $this->input->post('term_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM TERMS WHERE TERM_CODE LIKE '$termCode%'","row_array");
            echo json_encode(['term_det'=>$data]);
        }

        public function getFobdetByFobCode(){
            $fobCode = $this->input->post('fob_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM FOBS WHERE FOB_CODE LIKE '$fobCode%'","row_array");
            echo json_encode(['fob_det'=>$data]);
        }

        public function getShipDetByShipCode(){
            $shipCode = $this->input->post('ship_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM SHIP_VIA WHERE SHIPV_CODE LIKE '$shipCode%'","row_array");
            echo json_encode(['ship_det'=>$data]);
        }

        public function getPOChargeByPoCode(){
            $poChargeType = $this->input->post('po_charge_type');
            $data = $this->unicon->CoreQuery("SELECT * FROM PO_CHARGES WHERE CHRG_TYPE LIKE '$poChargeType%'","row_array");
            echo json_encode(['po_charge_det'=>$data]);
        }

        public function getPaymentMethodByCode(){
            $poyMethCode = $this->input->post('pay_meth_code');
            $data = $this->unicon->CoreQuery("SELECT * FROM PAY_METHODS WHERE PM_CODE LIKE '$poyMethCode%'","row");
            echo json_encode(['pay_meth_det'=>$data]);
        }

        public function getCurExhRateByCurCode(){
            $curCodeNdName = $this->input->post('cur_exh_code');
            $data = $this->unicon->CoreQuery("SELECT *
                                                FROM CURRENCY
                                                JOIN CURRENCY_EXCHANGE_RATE
                                                ON CURRENCY_EXCHANGE_RATE.EXCHR_CURRENCY = CURRENCY.CUR_CODE
                                                WHERE CURRENCY.CUR_CODE LIKE '%$curCodeNdName%' 
                                                OR
                                                CURRENCY.CUR_NAME LIKE '%$curCodeNdName%'
                                                ORDER BY CURRENCY_EXCHANGE_RATE.EXCHR_CRE_DATE DESC
                                                LIMIT 1","row_array");
            echo json_encode(['cur_exh_det'=>$data]);
        }

        public function getitemDetByItemCode(){
            $itemCode = $this->input->post('item_code');
            $venCode = $this->input->post('v_code');
            $data = itemDetails($itemCode,1,$venCode);
            echo json_encode(['item_det'=>$data]);
        }
        public function getItemDelWithPurPriceByItemCode(){
            $itemCode = $this->input->post('item_code');
            $itemDet = itemList(array('where'=>"WHERE I_CODE = '$itemCode'",'dataType'=>'row'));
            $data = itemPriceDet($itemCode);
            if($data){
                $landCost = freightChargeDets($data->POH_PREFIX.$data->POH_ORDER_ID,'BUYER',"SUM(PODC_PO_CHARGE_AMT) AS TOT_LANDED_COST",'row');
                $itemDisPer = $data->POD_UNIT_COST/$data->POH_GRAND_TOTAL;
                $landedCostPerItem = $landCost->TOT_LANDED_COST * $itemDisPer;
                $ItemPriceWithLandedCost = $landedCostPerItem + ($data->POD_UNIT_COST * $data->POD_EXCH_RATE);
                $ItemPriceWithLandedCost = $ItemPriceWithLandedCost*$data->I_COST_MULTIPLIER;
            }else{
                $ItemPriceWithLandedCost = 0;
            }
            
            echo json_encode(['item_det'=>$itemDet,"unt_price_sar"=>floattwo($ItemPriceWithLandedCost)]);
        }


        public function getPoPrefix(){
            header('Content-Type: application/json');
            $preType = $this->input->post('pre_type')?$this->input->post('pre_type'):null;
            $data = poPrefixes($preType);
            echo json_encode($data);
        }

        public function getLandingCostByOrderid(){

            $orderId = $this->input->post('order_id');
            $FreightData = freightChargeDets($orderId,"BUYER");
            $purItemDelData = purchaseOrderItemDet($orderId);
            $purHeaderDetData = purchaseOrderHeaderDet($orderId);
            $clearanceDetData = clearancDet($orderId);

            echo json_encode([
                                "landing_det" =>$FreightData,
                                "pur_item_det" =>$purItemDelData,
                                "pur_header_det" =>$purHeaderDetData,
                                "clearance_det" =>$clearanceDetData,
                            ]);
        }

        public function getPurOrderDetByOrderId(){

            $orderId = $this->input->post('order_id');
            $purDet = purchaseOrderHeaderDet($orderId,'num_rows');

            echo json_encode($purDet);
        }

        public function getWharehouseDet(){
            $userCon = sessionUserData();
            $whseCode = $this->input->post('whse_code');
            $whseType = $this->input->post('whse_type');

            $whareHouseDet = wherehouseDetail(["where" =>"WHERE WHSE_CODE LIKE '$whseCode%'","dataType" => "row"]);
                /*================== ROLE MANAGEMENT =================*/
                $tranResnAcc = FALSE;
                    if ($userCon->USER_TYPE == 'SUPERADMIN' || $userCon->USER_TYPE == 'ADMIN') {
                        $tranResnAcc = TRUE;
                    }elseif($userCon->USER_TYPE == 'USER'){
                        $whseAs = assignRoleBreak();
                        if(isset($whseType)){
                            if($whseType == 'from'){
                                if(count($whseAs['whse_assign'])>0){
                                $whseAs = $whseAs['whse_assign'];
                                $checkWhseCode = false;
                                    foreach ($whseAs as $whseAsGet) {
                                            if($whseAsGet->SMSW_WHSE_CODE == $whareHouseDet->WHSE_CODE){
                                                $checkWhseCode = true;
                                                break;
                                            }
                                    }
                                    $whareHouseDet = $checkWhseCode?$whareHouseDet:false;
                                }else{
                                    $whareHouseDet = false;
                                }
                            }
                        }
                    }
            echo json_encode([
                                "whse_det" =>$whareHouseDet,
                            ]);
        }

        public function getTransResnByCode(){
            $userCon = sessionUserData();
            $transResnCode = $this->input->post('trans_resn_code');

            $transResnDet = transReason(["where" =>"WHERE TR_TRANS_RSN LIKE '$transResnCode%'","dataType" => "row"]);
                /*================== ROLE MANAGEMENT =================*/
                $tranResnAcc = FALSE;
                    if ($userCon->USER_TYPE == 'SUPERADMIN' || $userCon->USER_TYPE == 'ADMIN') {
                        $tranResnAcc = TRUE;
                    }elseif(dashRole(["role_check"=>"INVENTORY_STOCK_TRANSFER_CREATE"])){
                        if($transResnDet->TR_TRANS_RSN == 201){
                            $tranResnAcc = TRUE; 
                        }
                    }
            echo json_encode([
                                "trans_resn_det" =>$transResnDet,
                                "trans_resn_acc" =>$tranResnAcc,
                            ]);
        }

        public function getTransRuleByCode(){

            $transRuleCode = $this->input->post('trans_rule_code');

            $transRuleDet = transRule(["where" =>"WHERE TRULE_TRANS_RULE LIKE '$transRuleCode%'","dataType" => "row"]);

            echo json_encode([
                                "trans_rule_det" =>$transRuleDet,
                            ]);
        }

        public function getStockTransfDetByOrderId(){

            $orderId = $this->input->post('order_id');

            $stockTransferOrderDets = StockTransferOrderDet(["where" => "WHERE STH_ORDER_NO = '$orderId'", "dataType" => 'num_rows']);

            echo json_encode($stockTransferOrderDets);
        }

        public function getInvItemTransDet(){

            $iCode = $this->input->post('i_code');
            $whseCode = $this->input->post('whse_code');
            $where = NULL;
            if($whseCode){
                $where = " AND IT_WHSE = '$whseCode'";
            }
            $itemDet = itemDetails($iCode,null,null,'row');
            $transDet = $this->unicon->CoreQuery("SELECT *,DATE_FORMAT(IT_CRE_DATE, '%d-%m-%Y %H:%i') IT_CRE_DATE
                                                FROM INV_TRANS
                                                WHERE IT_ITEM='{$itemDet->I_CODE}'$where ORDER BY IT_REF_NO ASC","result");
            echo json_encode(array(
                                    "item_detail"=>$itemDet,
                                    "trans_detail"=>$transDet
                                ));
        }

        public function getItemStockQty(){
            $itemCode = $this->input->post('item_code');
            $whseCode = $this->input->post('from_whse_code');
            $stockReasn = $this->input->post('stk_resn');
            $searchType = $this->input->post('serach_type');
            $searchType = isset($searchType)?$searchType:null;

            $data = itemDetails($itemCode,1);

            $temp_list_price = itemUnitCost(["where" => "WHERE INVCOST_ITEM_CODE = '{$data[0]['I_CODE']}' ORDER BY INVCOST_ID DESC", "dataType" => "row"]);
            
            if ($temp_list_price) {
                $list_price = $temp_list_price->INVCOST_ACT_COST;
            }else{
                $list_price = null;
            }
            
            if ($stockReasn == 200) {
                $stockCon = 'no_limit';
            }elseif ($stockReasn == 201) {
                $stockCon = 'limit';
            }elseif ($stockReasn == 202) {
                $stockCon = 'limit';
            }elseif ($stockReasn == 204) {
                $stockCon = 'no_limit';
            }
            $stock_check = array();
            if ($data) {
                if ($searchType == 'sale') {
                    $whseDets = wherehouseDetail(['where' => "WHERE WHSE_CODE LIKE '$whseCode%'", 'dataType' => 'result']);
                    foreach ($whseDets as $whseDet) {
                        $item_P = array(
                            "dataType" => 'row',
                            "itemCode" => $data[0]['I_CODE'],
                            "whseId" => $whseDet->WHSE_CODE,
                        );
                        $stockDet = itemStockDet($item_P);
                        if($stockDet>0){
                            $stock_check['stock'] = $stockDet;
                            $stock_check['whse_code'] = $whseDet->WHSE_CODE;
                            break;
                        }
                    }
                }else{
                    $item_P = array(
                        "dataType" => 'row',
                        "itemCode" => $data[0]['I_CODE'],
                        "whseId" => $whseCode,
                    );
                    $stockDet = itemStockDet($item_P);
                }
                
                // $list_price = $data[0]['I_LIST_PRICE']>0?$data[0]['I_LIST_PRICE']:$list_price;
                $list_price = $data[0]['I_LIST_PRICE']>0?$data[0]['I_LIST_PRICE']:0;
            }else{
                $stockDet = 0;
            }

            
            

            echo json_encode([
                            'item_det' => $data,
                            'stock_det' => $stockDet,
                            'stock_con' => $stockCon,
                            "temp_list_price" => $list_price,
                            "sale_stock_det" => $stock_check,
                        ]);
        }

        public function getGlmodeileAccLink(){

            $batchCode = $this->input->post('batchCode');
            $getData = glModuleAccDet(["where" =>"AND GLMP_BATCH_CODE = '$batchCode'","dataType" => "result"]);
            echo json_encode([
                                "get_data" =>$getData,
                            ]);
        }

        public function getItemUntCost(){

            $itemCode = $this->input->post('item_code');
            $itemCostDet = itemUnitCost(["where" =>"WHERE INVCOST_ITEM_CODE = '$itemCode' ORDER BY INVCOST_ID DESC LIMIT 1","dataType" => "result"]);
            echo json_encode([
                                "item_cost_det" =>$itemCostDet,
                            ]);
        }

        public function getItemVendorCost(){

            $itemCode = $this->input->post('item_code');
            $itemCostDet = itemVendorCost(["where" =>",CURRENCY_EXCHANGE_RATE,CURRENCY WHERE CUR_CODE = EXCHR_CURRENCY AND VC_CURRENCY_LIST = EXCHR_CURRENCY AND VC_ITEM_CODE = '$itemCode' ORDER BY EXCHR_ID,VC_ID DESC LIMIT 1","dataType" => "result"]);
            echo json_encode([
                                "item_cost_det" =>$itemCostDet,
                            ]);
        }

        public function getPriceChangerDetail(){

            $docNo = $this->input->post('doc_no');
            $priceChangerDel = priceChnagerDetail(["where" =>"WHERE PCD_DOCUMENT_NO = '$docNo'","dataType" => "result"]);
            echo json_encode([
                                "price_changer_del" =>$priceChangerDel,
                            ]);
        }


        // public function getTraitByItemCode(){
        //     $itemCode = $this->input->post('itemCode');

        //     $itemDel = $this->unicon->CoreQuery("SELECT * FROM ITEMS WHERE I_CODE='$itemCode'","result_array");

        //     $data = $this->unicon->CoreQuery("SELECT * FROM ITEMS as I
        //                                                 JOIN ITEM_TRAITS AS IT
        //                                                 WHERE I.I_CODE='$itemCode'","result_array");

        //     echo json_encode(['traitDeaits'=>$data,'itemdel'=>count($itemDel)==1?$itemDel:NULL]);
        // }

        /**========================================================================
         *                           PAYMENT VOUCHER TABLE LIST
         *========================================================================**/

         /*================================ PAYMENTOUT TABLE LIST ==============================*/
            
         public function paymentOutListJson(){
            $userCon = sessionUserData();
            $pvType = $this->input->post('pv_type');

            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'PAYMENT_VOCHER',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'PAY_METHODS',
                    "JOIN_1_TABLE_CONN"=>'PAY_METHODS.PM_CODE=PAYMENT_VOCHER.PV_PAY_METH',

                "JOIN_3_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_3_TABLE_NAME"=>'USERS',
                    "JOIN_3_TABLE_CONN"=>'USERS.USERNAME=PAYMENT_VOCHER.PV_CRE_BY',

                "JOIN_4_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_4_TABLE_NAME"=>'CLEARANCE_PO_ID',
                    "JOIN_4_TABLE_CONN"=>'CLEARANCE_PO_ID.CPO_TEMP_CL_ID=PO_HEADER.POH_TEMP_ORDER_ID',
                
                "JOIN_5_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_5_TABLE_NAME"=>'CLEARANCE_ID',
                    "JOIN_5_TABLE_CONN"=>'CLEARANCE_ID.INV_CL_NO = CLEARANCE_PO_ID.CPO_CL_NO',
                
                "WHERE_1_CONTROL"=>TRUE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "WHERE_1_COL_NAME"=>'PAYMENT_VOCHER.PV_TYPE',
                    "WHERE_1_DATA"=>$pvType,
            );
            if ($pvType == 'VENDOR') {
                   $sqlQueryTemp["JOIN_2_CONTROL"] = TRUE;  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                   $sqlQueryTemp["JOIN_2_TABLE_NAME"] = 'VENDOR';
                   $sqlQueryTemp["JOIN_2_TABLE_CONN"] = 'VENDOR.V_CODE=PAYMENT_VOCHER.PV_PARTIES_CODE';

                   $filterdata = array(
                    "column_order" => array(NULL,'V_NAME','PV_ORDER_NO','PV_CRE_BY','PV_DESC','PV_AMT',NULL),
                    "column_search" => array('V_NAME','PV_ORDER_NO','PV_CRE_BY','PV_DESC','PV_AMT'),
                    "order" => array('PAYMENT_VOCHER.PV_ID' => 'DESC')
                );

            }elseif ($pvType == 'CUSTOMER') {
                   $sqlQueryTemp["JOIN_2_CONTROL"] = TRUE;  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                   $sqlQueryTemp["JOIN_2_TABLE_NAME"] = 'CUSTOMER';
                   $sqlQueryTemp["JOIN_2_TABLE_CONN"] = 'CUSTOMER.CUST_CODE=PAYMENT_VOCHER.PV_PARTIES_CODE';

                   $filterdata = array(
                    "column_order" => array(NULL,'CUST_NAME','PV_ORDER_NO','PV_CRE_BY','PV_DESC','PV_AMT',NULL),
                    "column_search" => array('CUST_NAME','PV_ORDER_NO','PV_CRE_BY','PV_DESC','PV_AMT'),
                    "order" => array('PAYMENT_VOCHER.PV_ID' => 'DESC')
                );
            }

            if ($userCon->USER_TYPE == 'SUPERADMIN' || $userCon->USER_TYPE == 'ADMIN') {
                
            }elseif($userCon->USER_TYPE == 'USER'){
                $sqlQueryTemp["CORE_WHERE_1_CONTROL"] = TRUE;  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                $sqlQueryTemp["CORE_WHERE_1_DATA"] = "PV_CRE_BY = '{$userCon->USERNAME}'";
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
                if ($pvType == 'VENDOR') {
                    $partyNameEng = $rowdata->V_NAME;
                    $partyNameAr = $rowdata->V_NAME_AR;
                    $vouchType = 'P';
                }elseif ($pvType == 'CUSTOMER') {
                    $partyNameEng = $rowdata->CUST_NAME;
                    $partyNameAr = $rowdata->CUST_NAME_AR;
                    $vouchType = 'S';

                }
                $vouchNo = dataEncypt($rowdata->PV_ID,'encrypt');
                if($pvType == 'CUSTOMER'){
                    $orderDet = "{$rowdata->PV_ORDER_PRE}-{$rowdata->PV_ORDER_NO}";
                }else{
                    $orderDet = "{$rowdata->PV_ORDER_NO}";
                }
                $row[] = "{$partyNameEng}</br>{$partyNameAr}"; 
                $row[] = "{$orderDet}";
                $row[] = "{$rowdata->PV_DATE}";
                $row[] = "{$rowdata->PV_DESC}";
                $row[] = "{$rowdata->PV_AMT}";
                $row[] = "{$rowdata->NAME}";
                // $row[] = '<div class="d-flex gap-3">
                //             <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                //             <a href="javascript:void(0);" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                //         </div>';
                $prtUrl = base_url("voucherPrint?vouc-no=$vouchNo&vouc-type=$vouchType");
                $row[] = "<div class='d-flex gap-3'>
                    <a href='{$prtUrl}' class='text-success'><i class='fa fa-print font-size-18'></i></a>
                    <a href='javascript:void(0);' class='text-danger'><i class='fa fa-trash font-size-18'></i></a>
                </div>";
                
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
        //*================================ SALESMAN AUTHENTICATION ==============================*/
        
        public function salesmanAuth(){
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
                $whseCode = $this->input->post('whse_code');
                $empCheck = $this->unicon->CoreQuery("SELECT EMP_CODE AS CODE,EMP_NAME1 AS ENG_NAME,EMP_NAME2 AS NAME_AR,EMP_STR_ADDR1 AS ADD1,EMP_PHONE1 AS PHONE1,EMP_DISC_PER AS EMP_DISC
                                                        FROM EMPLOYEE,SALES_PERSON,SALES_MAN_ASSIGN_WHSE
                                                        WHERE EMP_CODE = SLSP_EMPLOYEE_CODE
                                                        AND SLSP_CODE = SMSW_SLSP_CODE
                                                        AND EMP_CAT_ID = '1001'
                                                        AND SMSW_WHSE_CODE = '$whseCode'
                                                        AND EMP_CODE = '$userName' GROUP BY SMSW_SLSP_CODE","row");
               $ty = false;
               $omsg = null;
               if($empCheck){
                    
                    $outMsg = $this->profunccon->userSigninCredential(['username'=>$userName]);
                    if($outMsg['MSG'] == 'Y'){
                        if($pass == $this->encryption->decrypt($outMsg['PASSWORD_IN'])){
                            
                            $err = 'false';
                            $omsg .= 'success';
                            $ty = true;
                        }else{
                            $err = 'false';
                            $omsg = 'Password invalid';
                        }
                    }else{
                        $err = 'false';
                        $omsg = 'Username and Password invalid';
                    }
                }else{
                    $err = 'false';
                    $omsg = 'Your username is not allowed to authenticate this invoice. Please enter the store manager login credential.';
                }

                echo json_encode(array("multi"=>"false",
                                            "err"=>$err,
                                            "msg"=>"$omsg",
                                            "returndata"=>array(
                                                                "login"=>$ty,
                                                                "auth_type"=>$authType,
                                                                "ReMsg"=>"$omsg",
                                                            )));
                
                // if(count($dataFetch) === 1){
                //     $this->unicon->CoreQuery("UPDATE GENERATE_PASS SET MDP_ASSIGN_BY='$userCon->ID',MDP_TEMP_BLOCK='Y' WHERE MDP_SEQ ='{$dataFetch[0]->MDP_SEQ}'");
                //     echo json_encode(array("multi"=>"false",
                //                             "err"=>"false",
                //                             "msg"=>"Data Inserted Successfully",
                //                             "returndata"=>array(
                //                                                 "auth_id"=>$dataFetch[0]->MDP_SEQ,
                //                                                 "dis_ext"=>$authType == 'DISCOUNT'?$dataFetch[0]->MDP_GEN_DISC:0,
                //                                                 "auth_type"=>$authType
                //                                             )));
                
                // }
            }
        }

        /*================================ LOGIN AUTHENTICATION ==============================*/
        
        public function userAuth(){
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


               $ty = false;
               $omsg = null;
               if($userCon->USERNAME == $userName){
                    
                    $outMsg = $this->profunccon->userSigninCredential(['username'=>$userCon->USERNAME]);
                    if($outMsg['MSG'] == 'Y'){
                        if($pass == $this->encryption->decrypt($outMsg['PASSWORD_IN'])){
                            
                            $err = 'false';
                            $omsg .= 'success';
                            $ty = true;
                        }else{
                            $err = 'false';
                            $omsg = 'Password invalid';
                        }
                    }else{
                        $err = 'false';
                        $omsg = 'Username and Password invalid';
                    }
                }else{
                    $err = 'false';
                    $omsg = 'This username is unauthenticated.';
                }

                echo json_encode(array("multi"=>"false",
                                            "err"=>$err,
                                            "msg"=>"$omsg",
                                            "returndata"=>array(
                                                                "login"=>$ty,
                                                                "auth_type"=>$authType,
                                                                "ReMsg"=>"$omsg",
                                                            )));
     
            }
        }

        public function getPhysicalInvCountByCountNumber(){

            $docNo = $this->input->post('doc_no');
            $data = $this->unicon->CoreQuery("SELECT * FROM PHY_INV_COUNT_DETAIL
                                                LEFT JOIN ITEMS
                                                ON PICD_ITEM = I_CODE WHERE PICD_ORDER_NO='$docNo' ORDER BY PICD_ORDER_LN ASC","result");
            echo json_encode([
                                "detail" =>$data,
                            ]);
        }
        

        public function stkFreezeProcedure(){

            $docNo = $this->input->post('doc_no');
            $doc_bus = $this->input->post('doc_bus');

            $getFreezeData = $this->unicon->CoreQuery("SELECT DISTINCT IFNULL(T.PISF_COMPLETE,'N') COUNT_FREEZE FROM PHY_INV_STK_FREEZE T
                                                WHERE PISF_BUS_UNIT = '$doc_bus'
                                                AND PISF_ORDER_NO = '$docNo'","row");
            $getFreezeData = $getFreezeData ?'Y':'N';
            if ($getFreezeData == 'Y') {
                $this->unicon->CoreQuery("DELETE FROM PHY_INV_STK_FREEZE
                                            WHERE PISF_BUS_UNIT = '{$doc_bus}'
                                            AND PISF_ORDER_NO = '{$docNo}'");
                $this->stockFreezeProcF1($docNo,$doc_bus);
            }elseif($getFreezeData == 'N'){
                $this->stockFreezeProcF1($docNo,$doc_bus);
            }

            echo json_encode(true);
        }

        private function stockFreezeProcF1($order,$bus){
            $get1 = $this->unicon->CoreQuery("SELECT TRUNCATE(R.PICH_IC_START_DATE, 0) AS PICH_IC_START_DATE,
                                                        TRUNCATE(R.PICH_IC_END_DATE, 0) AS PICH_IC_END_DATE,
                                                        UPPER(R.PICH_WHSE) AS PICH_WHSE
                                                        FROM PHY_INV_COUNT_HEADER R
                                                        WHERE R.PICH_BUS_UNIT = '$bus'
                                                            AND R.PICH_ORDER_NO = '$order'
                                                            AND R.PICH_STATUS = 'P'","row");
        
            if($get1) {
                $this->unicon->CoreQuery("DELETE FROM PHY_INV_STK_FREEZE
                                            WHERE PISF_BUS_UNIT = '{$bus}'
                                            AND PISF_ORDER_NO = '{$order}'
                                            AND PISF_WHSE = '{$get1->PICH_WHSE}'");

                $this->unicon->CoreQuery("INSERT INTO PHY_INV_STK_FREEZE
                                                    SELECT CASE t.IT_WHSE
                                                            WHEN '04' THEN SUBSTR(t.IT_WHSE, 1, 2)
                                                            ELSE t.IT_WHSE
                                                        END,
                                                        i.I_CODE,
                                                        SUM(t.IT_TRANS_QTY),
                                                        'N',
                                                        {$bus},
                                                        {$order},
                                                        NULL
                                                    FROM INV_TRANS t, ITEMS i
                                                    WHERE t.IT_ITEM = i.I_CODE
                                                    AND t.IT_WHSE LIKE CONCAT(IFNULL({$get1->PICH_WHSE}, ''), '%')
                                                    GROUP BY t.IT_WHSE, i.I_CODE
                                                    HAVING SUM(t.IT_TRANS_QTY) <> 0;");

                    $this->unicon->CoreQuery("UPDATE PHY_INV_STK_FREEZE
                                                SET PISF_COMPLETE = 'Y'
                                                WHERE PISF_BUS_UNIT = {$bus}
                                                AND PISF_ORDER_NO = {$order}
                                                AND PISF_WHSE = {$get1->PICH_WHSE};");

                                
                
            }
        }

        public function genReportProcedure(){

            $docNo = $this->input->post('doc_no');
            $doc_bus = $this->input->post('doc_bus');

            $getGenRepData1 = $this->unicon->CoreQuery("SELECT DISTINCT IFNULL(T.PISF_COMPLETE,'N') COUNT_FREEZE 
                                                        FROM PHY_INV_STK_FREEZE T
                                                        WHERE PISF_BUS_UNIT = '$doc_bus'
                                                        AND PISF_ORDER_NO = '$docNo'","row");

            $getGenRepData2 = $this->unicon->CoreQuery("SELECT  H.PICH_WHSE WH ,L.PICD_ITEM ITEMS
                                                        FROM PHY_INV_COUNT_HEADER H ,PHY_INV_COUNT_DETAIL L
                                                        WHERE H.PICH_BUS_UNIT=L.PICD_BUS_UNIT
                                                        AND H.PICH_ORDER_NO=L.PICD_ORDER_NO
                                                        AND H.PICH_BUS_UNIT='$doc_bus'
                                                        AND H.PICH_ORDER_NO IN ('$docNo')
                                                        GROUP BY H.PICH_WHSE,L.PICD_ITEM 
                                                        EXCEPT
                                                        SELECT F.PISF_WHSE WH ,F.PISF_ITEM ITEMS
                                                        FROM   PHY_INV_STK_FREEZE F
                                                        WHERE PISF_BUS_UNIT = '$doc_bus' AND F.PISF_ORDER_NO='$docNo'","result");


            $getGenRepData3 = $this->unicon->CoreQuery("SELECT A.PICH_REP_PREP MV_REP_GEN 
                                                        FROM PHY_INV_COUNT_HEADER A
                                                        WHERE A.PICH_BUS_UNIT = '$doc_bus'
                                                        AND A.PICH_ORDER_NO = '$docNo'","row");

            $alreadyFreeze = 'N';
            $repGen = 'N';
            $ip = 0;
            $iSTATUS ='Excess';
            $icomp = 'Y';
            if ($getGenRepData1) {
                if ($getGenRepData1->COUNT_FREEZE == 'Y') {
                   $alreadyFreeze = 'Y';
                }
            }

            if ($alreadyFreeze == 'Y') {
                $repGen = $getGenRepData3->MV_REP_GEN;
            }elseif($alreadyFreeze == 'N'){
                $repGen = 'N';
            }

            if ($repGen == 'N') {
                $this->unicon->CoreQuery("DELETE FROM  PHY_INV_STK_CRPT
                                            WHERE PISC_BUS_UNIT= '$doc_bus'
                                            AND PISC_ORDER_NO='$docNo'");

                $this->unicon->CoreQuery("INSERT INTO PHY_INV_STK_CRPT 
                                            ( SELECT F.PISF_WHSE,F.PISF_ITEM,I.I_DESC,I.I_LIST_PRICE,F.PISF_QTY,$ip,$ip,NULL,NULL,'111',F.PISF_ORDER_NO,NULL,NULL FROM PHY_INV_STK_FREEZE F, ITEMS I 
                                            WHERE F.PISF_ITEM=I.I_CODE AND F.PISF_ORDER_NO= '$docNo' AND F.PISF_BUS_UNIT= '$doc_bus')");
                
                foreach ($getGenRepData2 as $getGenRepData2Value) {
                    $L1 = $this->unicon->CoreQuery("SELECT L.PICD_ITEM_DESC1 ITEM_DESC,SUM(L.PICD_COUNT_QTY) I_QTY
                                                FROM PHY_INV_COUNT_HEADER H ,PHY_INV_COUNT_DETAIL L
                                                WHERE H.PICH_BUS_UNIT= L.PICD_BUS_UNIT
                                                AND H.PICH_ORDER_NO= L.PICD_ORDER_NO
                                                AND H.PICH_BUS_UNIT= '$doc_bus' 
                                                AND H.PICH_ORDER_NO = '$docNo'
                                                AND L.PICD_ITEM='$getGenRepData2Value->ITEMS'
                                                GROUP BY L.PICD_ITEM_DESC1",'row_array');
         
                            $this->unicon->CoreQuery("INSERT INTO PHY_INV_STK_CRPT 
                                                        (select '$getGenRepData2Value->WH','$getGenRepData2Value->ITEMS','{$L1['ITEM_DESC']}',$ip,$ip,{$L1['I_QTY']},$ip,'$iSTATUS','$icomp','$doc_bus','$docNo',NULL,NULL)");
                }

                $this->unicon->CoreQuery("UPDATE PHY_INV_STK_CRPT T
                                            SET T.PISC_CNTQTY = (SELECT  SUM(L.PICD_COUNT_QTY) 
                                            FROM PHY_INV_COUNT_HEADER H ,PHY_INV_COUNT_DETAIL L
                                            WHERE H.PICH_BUS_UNIT=L.PICD_BUS_UNIT
                                            AND H.PICH_ORDER_NO=L.PICD_ORDER_NO
                                            AND H.PICH_BUS_UNIT='$doc_bus'
                                            AND H.PICH_ORDER_NO IN ('$docNo')
                                            AND H.PICH_BUS_UNIT=T.PISC_BUS_UNIT
                                            AND H.PICH_ORDER_NO=T.PISC_ORDER_NO
                                            AND L.PICD_ITEM=T.PISC_ITEM)
                                            WHERE T.PISC_BUS_UNIT='$doc_bus' AND T.PISC_ORDER_NO='$docNo'
                                            AND T.PISC_CNTQTY = 0
                                            AND T.PISC_ITEM IN ( SELECT  L.PICD_ITEM
                                            FROM PHY_INV_COUNT_HEADER H ,PHY_INV_COUNT_DETAIL L
                                            WHERE H.PICH_BUS_UNIT=L.PICD_BUS_UNIT
                                            AND H.PICH_ORDER_NO=L.PICD_ORDER_NO
                                            AND H.PICH_BUS_UNIT='$doc_bus'
                                            AND H.PICH_ORDER_NO IN ('$docNo'));");

                $this->unicon->CoreQuery("UPDATE PHY_INV_STK_CRPT T1
                                            SET T1.PISC_DIFF= T1.PISC_SYSQTY-T1.PISC_CNTQTY
                                            WHERE T1.PISC_BUS_UNIT='$doc_bus' AND T1.PISC_ORDER_NO='$docNo';");

                $this->unicon->CoreQuery("UPDATE PHY_INV_STK_CRPT T1
                                            SET T1.PISC_STATUS='EXCESS'
                                            WHERE T1.PISC_BUS_UNIT='$doc_bus' AND T1.PISC_ORDER_NO='$docNo'
                                            AND T1.PISC_DIFF <0;");

                $this->unicon->CoreQuery("UPDATE PHY_INV_STK_CRPT T1
                                            SET T1.PISC_STATUS='SHORT'
                                            WHERE T1.PISC_BUS_UNIT='$doc_bus' AND T1.PISC_ORDER_NO='$doc_bus'
                                            AND T1.PISC_DIFF >0;");
            }

            
            
            echo json_encode(true);
        }

        public function imageDelete(){
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            
            // unlink('uploads/VENUE_IMAGE/'.$name);
            unlink("uploads/images/item/".$name);
         
            $data['details']= $this->unicon->deleteUniversal(array('data1'=>$id,'data2'=>NULL,'data3'=>NULL,'data4'=>NULL,'where1'=>'BIU_ID','where2'=>NULL,'where3'=>NULL,'where4'=>NULL,'whereCore'=>NULL,'table'=>'BULK_IMAGE_UPLOAD'));
        }

        public function testPrint(){

            $this->commonlib->saleReturnInvTrans("0TPC1UL8AX");
            $this->commonlib->saleReturnInvTrans("8S26T4GNVW");
            $this->commonlib->saleReturnInvTrans("BSX7IRPGVW");
            
        }

        public function fileRead(){


            // $file = fopen(base_url("ftp_file/upload/test_file.csv"), 'r');

            // while (($line = fgets($file)) !== false) {
            //     $data = str_getcsv($line);
                
            //     print_r($data);
            //     foreach ($data as $value) {
            //         echo $value."<br>";
            //     }
            // }
            

            // fclose($file);

            echo 'dfdf';
            $path = base_url("uploads/item");

            // Get the list of files in the directory
            $files = scandir($path);

            // Remove "." and ".." directories from the list
            $files = array_diff($files, array('.', '..'));

            // Sort the files by their last modified time in descending order
            usort($files, function($a, $b) use ($path) {
                return filemtime($path . '/' . $b) - filemtime($path . '/' . $a);
            });

            // The first file in the sorted list will be the last updated file
            $lastUpdatedFile = reset($files);
        }

    }