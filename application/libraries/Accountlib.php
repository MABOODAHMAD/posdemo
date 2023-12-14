<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accountlib{

    protected $CI;

    public function __construct() {
            // reference to the CodeIgniter super object
        $this->CI =& get_instance();
        $this->CI->load->model('Universal_model','unicon');
    }
    /**========================================================================
     *                           SALE ACCOUNT
     *========================================================================**/

     /*================== TEST FOR CASH SALE ORDER =================*/
     
        public function TestCashInvoice($data = array()){
            header('Content-Type: application/json');
            $curDateTime = dateTime();
            $userCon = sessionUserData();
            //Data fetch from sale header and detail table
            $orderDet = $this->CI->unicon->CoreQuery("SELECT * 
                                                        FROM SALE_HEADER,CUSTOMER
                                                        WHERE SH_CUST_ID = CUST_CODE
                                                        AND SH_ORDER_ID = '{$data->temp_id}' AND SH_INV_NO = '{$data->order_count}'","row");
            $orderLineDet = $this->CI->unicon->CoreQuery("SELECT W.WHSE_DESC WHSE_DESC,SD.SO_SUB_TOT LINE_AMT_BEF_VAT_BEF_DIS,I.I_CODE ITEM_CODE,IC.ICAT_DESC CAT_DESC,(SD.SO_SUB_TOT-SD.SD_DIST_AMT) LINE_AMT_AFT_DIS,SD.SD_WHSE_LOC_ID LOCA
                                                        FROM SALE_DETAIL SD,ITEMS I,ITEM_CATEGORY IC,WHAREHOUSE W
                                                        WHERE SD.SD_ITEM_CODE = I.I_CODE
                                                        AND I.I_CAT_CODE = IC.ICAT_CODE
                                                        AND SD.SD_WHSE_LOC_ID = W.WHSE_CODE
                                                        AND SD.SD_ORDER_ID = '{$data->temp_id}'","result");
            $glRuleFetch = glModuleAccDet(array('where'=>"AND CC_WHSE_CODE = '{$orderDet->SH_WHSE_CODE}' GROUP by GLMP_BATCH_CODE ORDER BY GLMP_ID DESC",'dataType'=>'row'));
            $glRuleGet = glModuleAccDet(array('where'=>"AND GLMP_BATCH_CODE = '{$glRuleFetch->GLMP_BATCH_CODE}'",'dataType'=>'result'));
            $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '{$orderDet->SH_WHSE_CODE}'",'dataType'=>'row'));
            $glTransDataArr = array(
                                    "GLAT_BUS_UNIT" =>$glRuleFetch->GLMP_BUS_UNIT,
                                    "GLAT_APPL" => $glRuleFetch->GLMP_MODULE,
                                    "GLAT_ACCT_LVL1" => $glRuleFetch->GLMP_COST_CENTER,
                                    // "GLAT_ACCT_LVL2" => , USED
                                    "GLAT_YEAR" =>date('Y'),
                                    "GLAT_PERIOD" =>date('m'),
                                    // "GLAT_DEBIT_AMT" => , USED
                                    // "GLAT_CREDIT_AMT" => , USED
                                    // "GLAT_CURRENCY" => ,
                                    // "GLAT_EXCHANGE_DATE" => ,
                                    // "GLAT_EXCHANGE_RATE" => ,
                                    "GLAT_ORDER_PFX" => $orderDet->SH_ORDER_PREFIX,
                                    "GLAT_ORDER_NO" => $orderDet->SH_ORDER_NO,
                                    "GLAT_WHSE" =>$whseDet->WHSE_CODE,
                                    "GLAT_WHSE_DESC" =>$whseDet->WHSE_DESC,
                                    "GLAT_SOLDTO_CUST" =>$orderDet->CUST_CODE,
                                    "GLAT_SOLDTO_NAME1" =>$orderDet->CUST_NAME,
                                    "GLAT_SOLDTO_NAME2" =>$orderDet->CUST_NAME_AR,
                                    "GLAT_CRE_BY" =>$userCon->USERNAME,
                                    "GLAT_CRE_DATE" =>$curDateTime
                            );
            foreach ($glRuleGet as $glRuleGetData) {

                unset($glTransDataArr['GLAT_ACCT_LVL2']);
                unset($glTransDataArr['GLAT_DEBIT_AMT']);
                unset($glTransDataArr['GLAT_CREDIT_AMT']);

                if($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CASH_AC'){

                        $glTransDataArr['GLAT_ACCT_LVL2'] = $glRuleGetData->GLMP_ACCOUNT_NO;

                            if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->SH_GRAND_TOT;

                            }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->SH_GRAND_TOT;

                            }else{

                                $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                $glTransDataArr['GLAT_CREDIT_AMT'] = '0';

                            }
                        $glTransDataArr['GLAT_NOTES'] = 'CASH_AC';
                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'VAT_AC') {
                        $glTransDataArr['GLAT_ACCT_LVL2'] = $glRuleGetData->GLMP_ACCOUNT_NO;

                            if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->SH_TOT_VAT;

                            }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->SH_TOT_VAT;

                            }else{

                                $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                
                            }
                            $glTransDataArr['GLAT_NOTES'] = 'VAT_AC';
                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'STK_AC') {
                        foreach ($orderLineDet as $orderLineDetGet) {
                            if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'STK_AC') {
                                $glTransDataArr['GLAT_ACCT_LVL2'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;

                                    if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                        $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                    }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                        $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                    }else{

                                        $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                        $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                        
                                    }
                                    $glTransDataArr['GLAT_NOTES'] = 'STK_AC';
                                $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                            }
                        }
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CG_AC') {
                        foreach ($orderLineDet as $orderLineDetGet) {
                            if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CG_AC') {
                                $glTransDataArr['GLAT_ACCT_LVL2'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;

                                    if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                        $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                    }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                        $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                    }else{

                                        $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                        $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                        
                                    }
                                    $glTransDataArr['GLAT_NOTES'] = 'CG_AC';
                                $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                            }
                        }
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'DIS_AC') {
                        $glTransDataArr['GLAT_ACCT_LVL2'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                        $glTransDataArr["GLAT_WHSE"] = $whseDet->WHSE_CODE;
                        $glTransDataArr["GLAT_WHSE_DESC"] = $whseDet->WHSE_DESC;

                            if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->SH_TOT_DISCOUNT;

                            }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->SH_TOT_DISCOUNT;

                            }else{

                                $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                
                            }
                            $glTransDataArr['GLAT_NOTES'] = 'DIS_AC';
                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'INC_AC') {
                        $glTransDataArr['GLAT_ACCT_LVL2'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                        foreach ($orderLineDet as $orderLineDetGet) {
                            if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'INC_AC') {
                                $glTransDataArr['GLAT_ACCT_LVL2'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;

                                    if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                        $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_BEF_VAT_BEF_DIS;

                                    }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                        $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_BEF_VAT_BEF_DIS;

                                    }else{

                                        $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                        $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                        
                                    }
                                    $glTransDataArr['GLAT_NOTES'] = 'INC_AC';
                                $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                            }
                        }
                    }
                }


            $glArr = (object)array(
                                    'cash_amt'=>$orderDet->SH_PAID_AMT,
                                    'vat_amt'=>$orderDet->SH_TOT_VAT,
                                    'sale_disc'=>$orderDet->SH_TOT_DISCOUNT,
                                    'temp_id'=>$orderDet->SH_ORDER_ID,
                                 );
            $GLdb = array(
                            "GL_APPL" =>"SO",
                            // "GL_GLA_DESC" =>,
                            // "GL_CA_SUBSIDERY" =>,
                            "GL_COST_CENTER" =>'148',
                            "GL_YEAR" =>date('Y'),
                            "GL_PERIOD" =>date('m'),
                            // "GL_DEBIT_AMT_GL" =>,
                            // "GL_CREDIT_AMT_GL" =>,
                            // "GL_JOURNAL_REF" =>,
                            // "GL_DESC" =>,
                            "GL_ORDER_PFX" =>$orderDet->SH_ORDER_PREFIX,
                            "GL_ORDER_NO" =>$orderDet->SH_ORDER_NO,
                            "GL_WHSE" =>$orderDet->SH_WHSE_CODE,
                            "GL_WHSE_DESC" =>'N/A',
                            "GL_ITEM" =>2435345,
                            "GL_BILLTO_CUST" =>$orderDet->SH_CUST_ID,
                            "GL_BILLTO_NAME1" =>'Usman Ahmad',
                            "GL_CRE_BY" =>$userCon->USERNAME,
                            "GL_CRE_DATE" =>$curDateTime
                        );
            //LEVEL 1
                $GLdb['GL_GLA_DESC'] = 'Cash On Hand - Saudi Riyal';
                $GLdb['GL_CA_SUBSIDERY'] = '1111000001';
                $GLdb['GL_DEBIT_AMT_GL'] = $glArr->cash_amt;
                $GLdb['GL_JOURNAL_REF'] = 'CASH_PAYMENT';
                $GLdb['GL_DESC'] = 'CASH_PAYMENT';

                $this->CI->unicon->insertUniversal('GL_ENTRY',$GLdb);
            //LEVEL 2
                $GLdb['GL_GLA_DESC'] = 'VAT FOR SALES & Cash Receipt';
                $GLdb['GL_CA_SUBSIDERY'] = '1120000099';
                $GLdb['GL_CREDIT_AMT_GL'] = $glArr->vat_amt;
                $GLdb['GL_JOURNAL_REF'] = 'VAT IN SALES';
                $GLdb['GL_DESC'] = 'VAT IN SALES';
                unset($GLdb['GL_WHSE']);
                unset($GLdb['GL_DEBIT_AMT_GL']);

                $this->CI->unicon->insertUniversal('GL_ENTRY',$GLdb);
            // LEVEL 3 
                // 3 ENTRY STOCK , C.G.S AND RETURN ITEM LINE ENTRY

            $orderLineDet = $this->CI->unicon->CoreQuery("SELECT W.WHSE_DESC WHSE_DESC,SD.SO_SUB_TOT LINE_AMT_BEF_VAT_BEF_DIS,I.I_CODE ITEM_CODE,IC.ICAT_DESC CAT_DESC,(SD.SO_SUB_TOT-SD.SD_DIST_AMT) LINE_AMT_AFT_DIS,SD.SD_WHSE_LOC_ID LOCA
                                                            FROM SALE_DETAIL SD,ITEMS I,ITEM_CATEGORY IC,WHAREHOUSE W
                                                            WHERE SD.SD_ITEM_CODE = I.I_CODE
                                                            AND I.I_CAT_CODE = IC.ICAT_CODE
                                                            AND SD.SD_WHSE_LOC_ID = W.WHSE_CODE
                                                            AND SD.SD_ORDER_ID = '{$glArr->temp_id}'","result");
          
            $orderLineArr = $orderLineRetArr = array();
            foreach ($orderLineDet as $orderLineDetGet) {
                $orderLineArr[] = (object)array(
                                        'GLA_DESC' =>$orderLineDetGet->CAT_DESC,
                                        'LINE_AMT' =>$orderLineDetGet->LINE_AMT_AFT_DIS,
                                        'GL_JOURNAL_REF' => $orderLineDetGet->LOCA,
                                        'DESC' => $orderLineDetGet->WHSE_DESC,
                                        "GL_WHSE" =>$orderLineDetGet->LOCA,
                                        "ITEM" => $orderLineDetGet->ITEM_CODE,
                                        "CA_SUB" => '1130000002'
                                    );
                $orderLineRetArr[] = (object)array(
                                                    'GLA_DESC' =>$orderLineDetGet->CAT_DESC,
                                                    'LINE_AMT' =>$orderLineDetGet->LINE_AMT_BEF_VAT_BEF_DIS,
                                                    'GL_JOURNAL_REF' => 'LINE_AMT',
                                                    'DESC' => 'LINE_AMT',
                                                    'GL_WHSE' => $orderLineDetGet->LOCA,
                                                    'WHSE_DESC' => $orderLineDetGet->WHSE_DESC,
                                                    "ITEM" => $orderLineDetGet->ITEM_CODE,
                                                    "CA_SUB" => '1130000002'
                                                );
            }
            // LEVEL 3 GL ENTRY
            foreach ($orderLineArr as $orderLineArrGet) {

                $GLdb['GL_GLA_DESC'] = $orderLineArrGet->GLA_DESC.' Stock';
                $GLdb['GL_CA_SUBSIDERY'] = $orderLineArrGet->CA_SUB;
                $GLdb['GL_CREDIT_AMT_GL'] = $orderLineArrGet->LINE_AMT;
                $GLdb['GL_JOURNAL_REF'] = $orderLineArrGet->GL_JOURNAL_REF;
                $GLdb['GL_DESC'] = $orderLineArrGet->DESC;
                $GLdb['GL_WHSE'] = $orderLineArrGet->GL_WHSE;
                $GLdb['GL_WHSE_DESC'] = $orderLineArrGet->DESC;
                unset($GLdb['GL_DEBIT_AMT_GL']);

                $this->CI->unicon->insertUniversal('GL_ENTRY',$GLdb);

                $GLdb['GL_GLA_DESC'] = $orderLineArrGet->GLA_DESC.' C.G.S';
                $GLdb['GL_CA_SUBSIDERY'] = $orderLineArrGet->CA_SUB;
                $GLdb['GL_DEBIT_AMT_GL'] = $orderLineArrGet->LINE_AMT;
                $GLdb['GL_JOURNAL_REF'] = $orderLineArrGet->GL_JOURNAL_REF;
                $GLdb['GL_DESC'] = $orderLineArrGet->DESC;
                $GLdb['GL_WHSE'] = $orderLineArrGet->GL_WHSE;
                $GLdb['GL_WHSE_DESC'] = $orderLineArrGet->DESC;
                unset($GLdb['GL_CREDIT_AMT_GL']);

                $this->CI->unicon->insertUniversal('GL_ENTRY',$GLdb);
            }

            // LEVEL 4 SALE DISCOUNT
            $GLdb['GL_GLA_DESC'] = 'Sales Discount';
            $GLdb['GL_CA_SUBSIDERY'] = '4130000001';
            $GLdb['GL_DEBIT_AMT_GL'] = $glArr->sale_disc;
            $GLdb['GL_JOURNAL_REF'] = 'INV_DISCOUNT';
            $GLdb['GL_DESC'] = 'INV_DISCOUNT';

            unset($GLdb['GL_CREDIT_AMT_GL']);
            unset($GLdb['GL_WHSE']);
            unset($GLdb['GL_WHSE_DESC']);

            $this->CI->unicon->insertUniversal('GL_ENTRY',$GLdb);

            // LEVEL 4 SALE RETURN 

            foreach ($orderLineRetArr as $orderLineRetArrGet) {

                $GLdb['GL_GLA_DESC'] = $orderLineRetArrGet->GLA_DESC.' Sales and Return';
                $GLdb['GL_CA_SUBSIDERY'] = $orderLineRetArrGet->CA_SUB;
                $GLdb['GL_CREDIT_AMT_GL'] = $orderLineRetArrGet->LINE_AMT;
                $GLdb['GL_JOURNAL_REF'] = $orderLineRetArrGet->GL_JOURNAL_REF;
                $GLdb['GL_DESC'] = $orderLineRetArrGet->DESC;
                $GLdb['GL_WHSE'] = $orderLineRetArrGet->GL_WHSE;
                $GLdb['GL_WHSE_DESC'] = $orderLineRetArrGet->WHSE_DESC;
                unset($GLdb['GL_DEBIT_AMT_GL']);

                $this->CI->unicon->insertUniversal('GL_ENTRY',$GLdb);
            }

            echo json_encode($data->temp_id.$data->order_count);
        }
/*================== CASH SALE ORDER =================*/
    public function cashInvoice($data = array()){
            // print_r($data);
            $curDateTime = dateTime();
            $userCon = sessionUserData();
            //Data fetch from sale header and detail table

            $orderDet = $this->CI->unicon->CoreQuery("SELECT *,SH_GRAND_TOT-SH_PAID_AMT DIFF_AMT
                                                        FROM SALE_HEADER,CUSTOMER
                                                        WHERE SH_CUST_ID = CUST_CODE
                                                        AND SH_ORDER_ID = '{$data->temp_id}' AND SH_INV_NO = '{$data->order_count}'","row");

            $glRuleFetch = glModuleAccDet(array('where'=>"AND CC_WHSE_CODE = '{$orderDet->SH_WHSE_CODE}' AND GLMP_TYPE = '{$data->type}' AND GLMP_MODULE = '{$data->module}' AND GLMP_RTN = '{$data->rtnType}' GROUP BY GLMP_BATCH_CODE ORDER BY GLMP_ID DESC",'dataType'=>'row'));
            if($glRuleFetch){

                $orderLineDet = $this->CI->unicon->CoreQuery("SELECT W.WHSE_DESC WHSE_DESC,SD.SO_SUB_TOT LINE_AMT_BEF_VAT_BEF_DIS,I.I_CODE ITEM_CODE,IC.ICAT_DESC CAT_DESC,(SD.SO_SUB_TOT-SD.SD_DIST_AMT) LINE_AMT_AFT_DIS,SD.SD_WHSE_LOC_ID LOCA,I.I_SECONDARY_DESC I_SECONDARY_DESC,I.I_DESC I_DESC
                                                                FROM SALE_DETAIL SD,ITEMS I,ITEM_CATEGORY IC,WHAREHOUSE W
                                                                WHERE SD.SD_ITEM_CODE = I.I_CODE
                                                                AND I.I_CAT_CODE = IC.ICAT_CODE
                                                                AND SD.SD_WHSE_LOC_ID = W.WHSE_CODE
                                                                AND SD.SD_ORDER_ID = '{$data->temp_id}'","result");
                
                $payDet = paymentDetails(["where"=>"AND PD_ORDER_ID='{$orderDet->SH_ORDER_ID}'","dataType"=>"result"]);
                
                
                $glRuleGet = glModuleAccDet(array('where'=>"AND GLMP_BATCH_CODE = '{$glRuleFetch->GLMP_BATCH_CODE}'",'dataType'=>'result'));
                $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '{$orderDet->SH_WHSE_CODE}'",'dataType'=>'row'));
                $glTransDataArr = array(
                                        "GLAT_BUS_UNIT" =>$glRuleFetch->GLMP_BUS_UNIT,
                                        "GLAT_APPL" => $glRuleFetch->GLMP_MODULE,
                                        "GLAT_ACCT_LVL2" => $glRuleFetch->GLMP_COST_CENTER,
                                        // "GLAT_ACCT_LVL1" => , USED
                                        "GLAT_YEAR" =>date('Y'),
                                        "GLAT_PERIOD" =>date('m'),
                                        "GLAT_APPL_TYPE" => $glRuleFetch->GLMP_TYPE,
                                        // "GLAT_DEBIT_AMT" => , USED
                                        // "GLAT_CREDIT_AMT" => , USED
                                        // "GLAT_CURRENCY" => ,
                                        // "GLAT_EXCHANGE_DATE" => ,
                                        // "GLAT_EXCHANGE_RATE" => ,
                                        "GLAT_INVOICE_PFX" => $orderDet->SH_INV_PREFIX,
                                        "GLAT_INVOICE_NO" => $orderDet->SH_INV_NO,
                                        "GLAT_WHSE" =>$whseDet->WHSE_CODE,
                                        "GLAT_WHSE_DESC" =>$whseDet->WHSE_DESC,
                                        "GLAT_SOLDTO_CUST" =>$orderDet->CUST_CODE,
                                        "GLAT_SOLDTO_NAME1" =>$orderDet->CUST_NAME,
                                        "GLAT_SOLDTO_NAME2" =>$orderDet->CUST_NAME_AR,
                                        "GLAT_ORDER_TEMP" => $data->temp_id,
                                        "GLAT_CRE_BY" =>$userCon->USERNAME,
                                        "GLAT_CRE_DATE" =>$curDateTime
                                );
                
                foreach ($glRuleGet as $glRuleGetData) {

                    unset($glTransDataArr['GLAT_ACCT_LVL1']);
                    unset($glTransDataArr['GLAT_DEBIT_AMT']);
                    unset($glTransDataArr['GLAT_CREDIT_AMT']);
                    unset($glTransDataArr['GLAT_ITEM']);
                    unset($glTransDataArr['GLAT_ITEM_DESC1']);
                    unset($glTransDataArr['GLAT_ITEM_DESC2']);
                    unset($glTransDataArr['GLAT_ACCOUNT_DESC']);
                    unset($glTransDataArr['GLAT_JOURNAL_REF']);
                    unset($glTransDataArr['GLAT_DESC']);
                    unset($glTransDataArr['GLAT_ACCOUNT_DESC_AR']);
                    
                    if($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CASH_AC'){
                            foreach ($payDet as $payDetGet) {
                               if($payDetGet->PM_DED_PRCNT > 0){
                                    $leve1 = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$payDetGet->PM_ACCT_LVL1_DED}'",'dataType'=>'row']);
                                    $leve2 = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$payDetGet->PM_ACCT_LVL2_DED}'",'dataType'=>'row']);
                                    if($leve1){
                                        $glTransDataArr['GLAT_ACCT_LVL1'] = $leve1->AH_SUBSIDERY;
                                        $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Advertisement";
                                        $glTransDataArr['GLAT_JOURNAL_REF'] = "CARD DISCOUNT";
                                        $glTransDataArr['GLAT_DESC'] = "CARD DISCOUNT";
                                        $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $leve1->AR_Title;
                                        $glTransDataArr['GLAT_DEBIT_AMT'] = ($payDetGet->PD_AMOUNT*$payDetGet->PM_DED_PRCNT)/100;
            
                                        $glTransDataArr['GLAT_NOTES'] = 'CARD_DISCOUNT';
                                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                    }
                                    if($leve2){
                                        $glTransDataArr['GLAT_ACCT_LVL1'] = $leve2->AH_SUBSIDERY;
                                        $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Dedtors";
                                        $glTransDataArr['GLAT_JOURNAL_REF'] = "AR_TOTAL_AMT";
                                        $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $leve2->AR_Title;
                                        $glTransDataArr['GLAT_DESC'] = "AR_TOTAL_AMT";
                                        $perCal = 100-$payDetGet->PM_DED_PRCNT;
                                        $glTransDataArr['GLAT_DEBIT_AMT'] = ($payDetGet->PD_AMOUNT*$perCal)/100;

                                        $glTransDataArr['GLAT_NOTES'] = 'CASH_AC';
                                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                    }
                               }else{
                                    $cashAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Cash On Hand - Saudi Riyal";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "CASH_PAYMENT";
                                    $glTransDataArr['GLAT_DESC'] = "CASH_PAYMENT";
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $cashAccAr->AR_Title;
                                    // $diffAmt = $orderDet->DIFF_AMT < 0 ?abs($orderDet->DIFF_AMT):0;
                                    $diffAmt = 0;
                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {
        
                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $payDetGet->PD_AMOUNT+$diffAmt;
        
                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {
        
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $payDetGet->PD_AMOUNT+$diffAmt;
        
                                        }else{
        
                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
        
                                        }
                                    $glTransDataArr['GLAT_NOTES'] = 'CASH_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                               }
                            }
                            
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'VAT_AC') {
                            $vatAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                            $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $vatAccAr->AR_Title;
                            $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                            $glTransDataArr['GLAT_ACCOUNT_DESC'] = "VAT FOR SALES & Cash Receipt";
                            $glTransDataArr['GLAT_JOURNAL_REF'] = "VAT IN SALES";
                            $glTransDataArr['GLAT_DESC'] = "VAT IN SALES";

                                if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->SH_TOT_VAT;

                                }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                    $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->SH_TOT_VAT;

                                }else{

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                    $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                    
                                }
                                $glTransDataArr['GLAT_NOTES'] = 'VAT_AC';
                            $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'STK_AC') {
                            foreach ($orderLineDet as $orderLineDetGet) {
                                if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'STK_AC') {
                                    $stkAcAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $stkAcAr->AR_Title;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "STOCK {$orderLineDetGet->CAT_DESC}";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "{$orderDet->SH_INV_PREFIX}-{$orderDet->SH_INV_NO}";
                                    $glTransDataArr['GLAT_DESC'] = "WHSE: {$orderLineDetGet->WHSE_DESC}";

                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                    $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;

                                    $glTransDataArr['GLAT_ITEM'] = $orderLineDetGet->ITEM_CODE;
                                    $glTransDataArr['GLAT_ITEM_DESC1'] = $orderLineDetGet->I_DESC;
                                    $glTransDataArr['GLAT_ITEM_DESC2'] = $orderLineDetGet->I_SECONDARY_DESC;

                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }else{

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                            
                                        }
                                        $glTransDataArr['GLAT_NOTES'] = 'STK_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);

                                }
                            }
                        }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CG_AC') {
                            foreach ($orderLineDet as $orderLineDetGet) {
                                if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CG_AC') {
                                    $cgAcAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $cgAcAr->AR_Title;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "C.G.S {$orderLineDetGet->CAT_DESC}";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "{$orderDet->SH_INV_PREFIX}-{$orderDet->SH_INV_NO}";
                                    $glTransDataArr['GLAT_DESC'] = "WHSE: {$orderLineDetGet->WHSE_DESC}";

                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                    $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;
                                    $glTransDataArr['GLAT_ITEM'] = $orderLineDetGet->ITEM_CODE;
                                    $glTransDataArr['GLAT_ITEM_DESC1'] = $orderLineDetGet->I_DESC;
                                    $glTransDataArr['GLAT_ITEM_DESC2'] = $orderLineDetGet->I_SECONDARY_DESC;


                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }else{

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                            
                                        }
                                        $glTransDataArr['GLAT_NOTES'] = 'CG_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                }
                            }
                        }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'DIS_AC') {
                            $disAcAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                            $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $disAcAr->AR_Title;
                            $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Sales Discount";
                            $glTransDataArr['GLAT_JOURNAL_REF'] = "INV_DISCOUNT";
                            $glTransDataArr['GLAT_DESC'] = "INV_DISCOUNT";

                            $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                            $glTransDataArr["GLAT_WHSE"] = $whseDet->WHSE_CODE;
                            $glTransDataArr["GLAT_WHSE_DESC"] = $whseDet->WHSE_DESC;
                            
                            $diffAmt = 0;
                            // $diffAmt = $orderDet->DIFF_AMT > 0 ?abs($orderDet->DIFF_AMT):0;

                                if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->SH_TOT_DISCOUNT+$diffAmt;

                                }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                    $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->SH_TOT_DISCOUNT+$diffAmt;

                                }else{

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                    $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                    
                                }
                                $glTransDataArr['GLAT_NOTES'] = 'DIS_AC';
                            $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                        }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'INC_AC') {
                            $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                            foreach ($orderLineDet as $orderLineDetGet) {
                                if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'INC_AC') {
                                    $IncAcAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $IncAcAr->AR_Title;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Sales Income";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "LINE_AMT";
                                    $glTransDataArr['GLAT_DESC'] = "LINE_AMT";


                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                    $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;
                                    $glTransDataArr['GLAT_ITEM'] = $orderLineDetGet->ITEM_CODE;
                                    $glTransDataArr['GLAT_ITEM_DESC1'] = $orderLineDetGet->I_DESC;
                                    $glTransDataArr['GLAT_ITEM_DESC2'] = $orderLineDetGet->I_SECONDARY_DESC;

                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_BEF_VAT_BEF_DIS;

                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_BEF_VAT_BEF_DIS;

                                        }else{

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                            
                                        }
                                        $glTransDataArr['GLAT_NOTES'] = 'INC_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                }
                            }
                        }
                    }
                }else{
                    $glTransDataArr = array(
                                            "GLATE_ORDER_ID" =>$data->temp_id,
                                            "GLATE_INV_COUNT" =>$data->order_count,
                                            "GLATE_TYPE" => 'SO_CASH',
                                            "GLATE_REASON" => 'GL MODULE PROFILE NOT CONFIGURE',
                                            "GLATE_CRE_BY" =>$userCon->USERNAME,
                                            "GLATE_CRE_DATE" =>$curDateTime
                                        );
                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS_EXCEPTION',$glTransDataArr);
                }
       return true;
    }

    public function cashInvoiceReturn($data = array()){
            // print_r($data);
            $curDateTime = dateTime();
            $userCon = sessionUserData();
            //Data fetch from sale header and detail table
            $orderDet = saleOrderReturnHeadDet(["where"=>"AND RH_TEMP_ID='{$data->temp_id}' AND RH_INV_ID = '{$data->return_id}'","dataType"=>"row"]);

            $glRuleFetch = glModuleAccDet(array('where'=>"AND CC_WHSE_CODE = '{$orderDet->RH_WHSE}' AND GLMP_TYPE = '{$data->type}' AND GLMP_MODULE = '{$data->module}' AND GLMP_RTN = '{$data->rtnType}' GROUP BY GLMP_BATCH_CODE ORDER BY GLMP_ID DESC",'dataType'=>'row'));
            if($glRuleFetch){

                $orderLineDet = $this->CI->unicon->CoreQuery("SELECT W.WHSE_DESC WHSE_DESC,SD.RD_SUB_TOT LINE_AMT_BEF_VAT_BEF_DIS,I.I_CODE ITEM_CODE,IC.ICAT_DESC CAT_DESC,(SD.RD_SUB_TOT-SD.RD_DIST_AMT) LINE_AMT_AFT_DIS,SD.RD_WHSE_LOC_ID LOCA,I.I_SECONDARY_DESC I_SECONDARY_DESC,I.I_DESC I_DESC
                                                                FROM RETURN_DETAIL SD,ITEMS I,ITEM_CATEGORY IC,WHAREHOUSE W
                                                                WHERE SD.RD_ITEM_CODE = I.I_CODE
                                                                AND I.I_CAT_CODE = IC.ICAT_CODE
                                                                AND SD.RD_WHSE_LOC_ID = W.WHSE_CODE
                                                                AND SD.RD_RH_ID = '{$data->temp_id}'","result");
                
                $glRuleGet = glModuleAccDet(array('where'=>"AND GLMP_BATCH_CODE = '{$glRuleFetch->GLMP_BATCH_CODE}'",'dataType'=>'result'));
                $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '{$orderDet->RH_WHSE}'",'dataType'=>'row'));
                $glTransDataArr = array(
                                        "GLAT_BUS_UNIT" =>$glRuleFetch->GLMP_BUS_UNIT,
                                        "GLAT_APPL" => $glRuleFetch->GLMP_MODULE,
                                        "GLAT_ACCT_LVL2" => $glRuleFetch->GLMP_COST_CENTER,
                                        // "GLAT_ACCT_LVL1" => , USED
                                        "GLAT_YEAR" =>date('Y'),
                                        "GLAT_PERIOD" =>date('m'),
                                        "GLAT_APPL_TYPE" => $glRuleFetch->GLMP_TYPE,
                                        // "GLAT_DEBIT_AMT" => , USED
                                        // "GLAT_CREDIT_AMT" => , USED
                                        // "GLAT_CURRENCY" => ,
                                        // "GLAT_EXCHANGE_DATE" => ,
                                        // "GLAT_EXCHANGE_RATE" => ,
                                        "GLAT_INVOICE_PFX" => $orderDet->RH_INV_PREFIX,
                                        "GLAT_INVOICE_NO" =>  $orderDet->RH_INV_NO,
                                        "GLAT_ORDER_TEMP" => $data->temp_id,
                                        "GLAT_WHSE" =>$whseDet->WHSE_CODE,
                                        "GLAT_WHSE_DESC" =>$whseDet->WHSE_DESC,
                                        "GLAT_SOLDTO_CUST" =>$orderDet->CUST_CODE,
                                        "GLAT_SOLDTO_NAME1" =>$orderDet->CUST_NAME,
                                        "GLAT_SOLDTO_NAME2" =>$orderDet->CUST_NAME_AR,
                                        "GLAT_CRE_BY" =>$userCon->USERNAME,
                                        "GLAT_CRE_DATE" =>$curDateTime
                                );
                foreach ($glRuleGet as $glRuleGetData) {

                    unset($glTransDataArr['GLAT_ACCT_LVL1']);
                    unset($glTransDataArr['GLAT_DEBIT_AMT']);
                    unset($glTransDataArr['GLAT_CREDIT_AMT']);
                    unset($glTransDataArr['GLAT_ITEM']);
                    unset($glTransDataArr['GLAT_ITEM_DESC1']);
                    unset($glTransDataArr['GLAT_ITEM_DESC2']);
                    unset($glTransDataArr['GLAT_ACCOUNT_DESC']);
                    unset($glTransDataArr['GLAT_JOURNAL_REF']);
                    unset($glTransDataArr['GLAT_DESC']);
                    unset($glTransDataArr['GLAT_ACCOUNT_DESC_AR']);

                    if($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CASH_AC'){
                            $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                            $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                            $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;

                            $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Cash On Hand - Saudi Riyal";
                            $glTransDataArr['GLAT_JOURNAL_REF'] = "CASH_PAYMENT";
                            $glTransDataArr['GLAT_DESC'] = "CASH_PAYMENT";

                                if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->RH_GRAND_TOT;

                                }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                    $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->RH_GRAND_TOT;

                                }else{

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                    $glTransDataArr['GLAT_CREDIT_AMT'] = '0';

                                }
                            $glTransDataArr['GLAT_NOTES'] = 'CASH_AC';
                            $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'VAT_AC') {
                        $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                            $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                            $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;

                            $glTransDataArr['GLAT_ACCOUNT_DESC'] = "VAT FOR SALES & Cash Receipt";
                            $glTransDataArr['GLAT_JOURNAL_REF'] = "VAT IN SALES";
                            $glTransDataArr['GLAT_DESC'] = "VAT IN SALES";

                                if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->RH_TOT_VAT;

                                }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                    $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->RH_TOT_VAT;

                                }else{

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                    $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                    
                                }
                                $glTransDataArr['GLAT_NOTES'] = 'VAT_AC';
                            $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'STK_AC') {
                            foreach ($orderLineDet as $orderLineDetGet) {
                                if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'STK_AC') {
                                    $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "STOCK {$orderLineDetGet->CAT_DESC}";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "{$orderDet->RH_INV_PREFIX}-{$orderDet->RH_INV_NO}";
                                    $glTransDataArr['GLAT_DESC'] = "WHSE: {$orderLineDetGet->WHSE_DESC}";

                                    $glTransDataArr['GLAT_ITEM'] = $orderLineDetGet->ITEM_CODE;
                                    $glTransDataArr['GLAT_ITEM_DESC1'] = $orderLineDetGet->I_DESC;
                                    $glTransDataArr['GLAT_ITEM_DESC2'] = $orderLineDetGet->I_SECONDARY_DESC;
                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                    $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;

                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }else{

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                            
                                        }
                                        $glTransDataArr['GLAT_NOTES'] = 'STK_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                }
                            }
                        }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CG_AC') {
                            foreach ($orderLineDet as $orderLineDetGet) {
                                if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CG_AC') {
                                    $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "C.G.S {$orderLineDetGet->CAT_DESC}";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "{$orderDet->RH_INV_PREFIX}-{$orderDet->RH_INV_NO}";
                                    $glTransDataArr['GLAT_DESC'] = "WHSE: {$orderLineDetGet->WHSE_DESC}";

                                    $glTransDataArr['GLAT_ITEM'] = $orderLineDetGet->ITEM_CODE;
                                    $glTransDataArr['GLAT_ITEM_DESC1'] = $orderLineDetGet->I_DESC;
                                    $glTransDataArr['GLAT_ITEM_DESC2'] = $orderLineDetGet->I_SECONDARY_DESC;
                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                    $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;

                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }else{

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                            
                                        }
                                        $glTransDataArr['GLAT_NOTES'] = 'CG_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                }
                            }
                        }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'DIS_AC') {
                            $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                            $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                            $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Sales Discount";
                            $glTransDataArr['GLAT_JOURNAL_REF'] = "INV_DISCOUNT";
                            $glTransDataArr['GLAT_DESC'] = "INV_DISCOUNT";

                            $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                            $glTransDataArr["GLAT_WHSE"] = $whseDet->WHSE_CODE;
                            $glTransDataArr["GLAT_WHSE_DESC"] = $whseDet->WHSE_DESC;

                                if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->RH_TOT_DISC;

                                }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                    $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->RH_TOT_DISC;

                                }else{

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                    $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                    
                                }
                                $glTransDataArr['GLAT_NOTES'] = 'DIS_AC';
                            $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                        }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'INC_AC') {
                            $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                            foreach ($orderLineDet as $orderLineDetGet) {
                                if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'INC_AC') {
                                    $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Sales Income";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "LINE_AMT";
                                    $glTransDataArr['GLAT_DESC'] = "LINE_AMT";

                                    $glTransDataArr['GLAT_ITEM'] = $orderLineDetGet->ITEM_CODE;
                                    $glTransDataArr['GLAT_ITEM_DESC1'] = $orderLineDetGet->I_DESC;
                                    $glTransDataArr['GLAT_ITEM_DESC2'] = $orderLineDetGet->I_SECONDARY_DESC;
                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                    $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;

                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_BEF_VAT_BEF_DIS;

                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_BEF_VAT_BEF_DIS;

                                        }else{

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                            
                                        }
                                        $glTransDataArr['GLAT_NOTES'] = 'INC_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                }
                            }
                        }
                    }
                }else{
                    $glTransDataArr = array(
                                            "GLATE_ORDER_ID" =>$data->temp_id,
                                            "GLATE_INV_COUNT" =>$data->order_count,
                                            "GLATE_TYPE" => 'SO_CASH',
                                            "GLATE_REASON" => 'GL MODULE PROFILE NOT CONFIGURE',
                                            "GLATE_CRE_BY" =>$userCon->USERNAME,
                                            "GLATE_CRE_DATE" =>$curDateTime
                                        );
                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS_EXCEPTION',$glTransDataArr);
                }
        return true;
    }

    /*================== CREDIT SALE ORDER =================*/
    public function creditInvoice($data = array()){
            // print_r($data);
            $curDateTime = dateTime();
            $userCon = sessionUserData();
            //Data fetch from sale header and detail table

            $orderDet = $this->CI->unicon->CoreQuery("SELECT *,SH_GRAND_TOT-SH_PAID_AMT DIFF_AMT
                                                        FROM SALE_HEADER,CUSTOMER
                                                        WHERE SH_CUST_ID = CUST_CODE
                                                        AND SH_ORDER_ID = '{$data->temp_id}' AND SH_INV_NO = '{$data->order_count}'","row");

            $glRuleFetch = glModuleAccDet(array('where'=>"AND CC_WHSE_CODE = '{$orderDet->SH_WHSE_CODE}' AND GLMP_TYPE = '{$data->type}' AND GLMP_MODULE = '{$data->module}' AND GLMP_RTN = '{$data->rtnType}' GROUP BY GLMP_BATCH_CODE ORDER BY GLMP_ID DESC",'dataType'=>'row'));
            if($glRuleFetch){
                custAccCreAndCheck(array('cost_cen_whse'=>$glRuleFetch->CC_ACC_REC,'cust_code'=>$orderDet->SH_CUST_ID));
                $orderLineDet = $this->CI->unicon->CoreQuery("SELECT W.WHSE_DESC WHSE_DESC,SD.SO_SUB_TOT LINE_AMT_BEF_VAT_BEF_DIS,I.I_CODE ITEM_CODE,IC.ICAT_DESC CAT_DESC,(SD.SO_SUB_TOT-SD.SD_DIST_AMT) LINE_AMT_AFT_DIS,SD.SD_WHSE_LOC_ID LOCA,I.I_SECONDARY_DESC I_SECONDARY_DESC,I.I_DESC I_DESC
                                                                FROM SALE_DETAIL SD,ITEMS I,ITEM_CATEGORY IC,WHAREHOUSE W
                                                                WHERE SD.SD_ITEM_CODE = I.I_CODE
                                                                AND I.I_CAT_CODE = IC.ICAT_CODE
                                                                AND SD.SD_WHSE_LOC_ID = W.WHSE_CODE
                                                                AND SD.SD_ORDER_ID = '{$data->temp_id}'","result");
                
                $payDet = paymentDetails(["where"=>"AND PD_ORDER_ID='{$orderDet->SH_ORDER_ID}'","dataType"=>"result"]);
                
                
                $glRuleGet = glModuleAccDet(array('where'=>"AND GLMP_BATCH_CODE = '{$glRuleFetch->GLMP_BATCH_CODE}'",'dataType'=>'result'));
                $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '{$orderDet->SH_WHSE_CODE}'",'dataType'=>'row'));
                $glTransDataArr = array(
                                        "GLAT_BUS_UNIT" =>$glRuleFetch->GLMP_BUS_UNIT,
                                        "GLAT_APPL" => $glRuleFetch->GLMP_MODULE,
                                        "GLAT_ACCT_LVL2" => $glRuleFetch->GLMP_COST_CENTER,
                                        // "GLAT_ACCT_LVL1" => , USED
                                        "GLAT_YEAR" =>date('Y'),
                                        "GLAT_PERIOD" =>date('m'),
                                        "GLAT_APPL_TYPE" => $glRuleFetch->GLMP_TYPE,
                                        // "GLAT_DEBIT_AMT" => , USED
                                        // "GLAT_CREDIT_AMT" => , USED
                                        // "GLAT_CURRENCY" => ,
                                        // "GLAT_EXCHANGE_DATE" => ,
                                        // "GLAT_EXCHANGE_RATE" => ,
                                        "GLAT_INVOICE_PFX" => $orderDet->SH_INV_PREFIX,
                                        "GLAT_INVOICE_NO" => $orderDet->SH_INV_NO,
                                        "GLAT_WHSE" =>$whseDet->WHSE_CODE,
                                        "GLAT_WHSE_DESC" =>$whseDet->WHSE_DESC,
                                        "GLAT_SOLDTO_CUST" =>$orderDet->CUST_CODE,
                                        "GLAT_SOLDTO_NAME1" =>$orderDet->CUST_NAME,
                                        "GLAT_SOLDTO_NAME2" =>$orderDet->CUST_NAME_AR,
                                        "GLAT_ORDER_TEMP" => $data->temp_id,
                                        "GLAT_CRE_BY" =>$userCon->USERNAME,
                                        "GLAT_CRE_DATE" =>$curDateTime
                                );
                
                foreach ($glRuleGet as $glRuleGetData) {

                    unset($glTransDataArr['GLAT_ACCT_LVL1']);
                    unset($glTransDataArr['GLAT_DEBIT_AMT']);
                    unset($glTransDataArr['GLAT_CREDIT_AMT']);
                    unset($glTransDataArr['GLAT_ITEM']);
                    unset($glTransDataArr['GLAT_ITEM_DESC1']);
                    unset($glTransDataArr['GLAT_ITEM_DESC2']);
                    unset($glTransDataArr['GLAT_ACCOUNT_DESC']);
                    unset($glTransDataArr['GLAT_JOURNAL_REF']);
                    unset($glTransDataArr['GLAT_DESC']);
                    unset($glTransDataArr['GLAT_ACCOUNT_DESC_AR']);
                    
                    if($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CASH_AC'){
                            foreach ($payDet as $payDetGet) {
                            if($payDetGet->PM_DED_PRCNT > 0){
                                    $leve1 = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$payDetGet->PM_ACCT_LVL1_DED}'",'dataType'=>'row']);
                                    $leve2 = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$payDetGet->PM_ACCT_LVL2_DED}'",'dataType'=>'row']);
                                    if($leve1){
                                        $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $leve1->AR_Title;
                                        $glTransDataArr['GLAT_ACCT_LVL1'] = $leve1->AH_SUBSIDERY;
                                        $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Advertisement";
                                        $glTransDataArr['GLAT_JOURNAL_REF'] = "CARD DISCOUNT";
                                        $glTransDataArr['GLAT_DESC'] = "CARD DISCOUNT";
            
                                        $glTransDataArr['GLAT_DEBIT_AMT'] = ($payDetGet->PD_AMOUNT*$payDetGet->PM_DED_PRCNT)/100;
            
                                        $glTransDataArr['GLAT_NOTES'] = 'CARD_DISCOUNT';
                                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                    }
                                    if($leve2){
                                        $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $leve2->AR_Title;
                                        $glTransDataArr['GLAT_ACCT_LVL1'] = $leve2->AH_SUBSIDERY;
                                        $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Dedtors";
                                        $glTransDataArr['GLAT_JOURNAL_REF'] = "AR_TOTAL_AMT";
                                        $glTransDataArr['GLAT_DESC'] = "AR_TOTAL_AMT";
                                        $perCal = 100-$payDetGet->PM_DED_PRCNT;
                                        $glTransDataArr['GLAT_DEBIT_AMT'] = ($payDetGet->PD_AMOUNT*$perCal)/100;

                                        $glTransDataArr['GLAT_NOTES'] = 'CASH_AC';
                                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                    }
                            }else{
                                    $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Cash On Hand - Saudi Riyal";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "CASH_PAYMENT";
                                    $glTransDataArr['GLAT_DESC'] = "CASH_PAYMENT";

                                    // $diffAmt = $orderDet->DIFF_AMT < 0 ?abs($orderDet->DIFF_AMT):0;
                                    $diffAmt = 0;
                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {
        
                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $payDetGet->PD_AMOUNT+$diffAmt;
        
                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {
        
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $payDetGet->PD_AMOUNT+$diffAmt;
        
                                        }else{
        
                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
        
                                        }
                                    $glTransDataArr['GLAT_NOTES'] = 'CASH_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                            }
                            }
                            
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'VAT_AC') {
                            $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                            $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                            $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                            $glTransDataArr['GLAT_ACCOUNT_DESC'] = "VAT FOR SALES & Cash Receipt";
                            $glTransDataArr['GLAT_JOURNAL_REF'] = "VAT IN SALES";
                            $glTransDataArr['GLAT_DESC'] = "VAT IN SALES";

                                if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->SH_TOT_VAT;

                                }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                    $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->SH_TOT_VAT;

                                }else{

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                    $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                    
                                }
                                $glTransDataArr['GLAT_NOTES'] = 'VAT_AC';
                            $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'STK_AC') {
                            foreach ($orderLineDet as $orderLineDetGet) {
                                if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'STK_AC') {
                                    $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "STOCK {$orderLineDetGet->CAT_DESC}";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "{$orderDet->SH_INV_PREFIX}-{$orderDet->SH_INV_NO}";
                                    $glTransDataArr['GLAT_DESC'] = "WHSE: {$orderLineDetGet->WHSE_DESC}";

                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                    $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;

                                    $glTransDataArr['GLAT_ITEM'] = $orderLineDetGet->ITEM_CODE;
                                    $glTransDataArr['GLAT_ITEM_DESC1'] = $orderLineDetGet->I_DESC;
                                    $glTransDataArr['GLAT_ITEM_DESC2'] = $orderLineDetGet->I_SECONDARY_DESC;

                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }else{

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                            
                                        }
                                        $glTransDataArr['GLAT_NOTES'] = 'STK_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);

                                }
                            }
                        }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CG_AC') {
                            foreach ($orderLineDet as $orderLineDetGet) {
                                if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CG_AC') {
                                    $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "C.G.S {$orderLineDetGet->CAT_DESC}";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "{$orderDet->SH_INV_PREFIX}-{$orderDet->SH_INV_NO}";
                                    $glTransDataArr['GLAT_DESC'] = "WHSE: {$orderLineDetGet->WHSE_DESC}";

                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                    $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;
                                    $glTransDataArr['GLAT_ITEM'] = $orderLineDetGet->ITEM_CODE;
                                    $glTransDataArr['GLAT_ITEM_DESC1'] = $orderLineDetGet->I_DESC;
                                    $glTransDataArr['GLAT_ITEM_DESC2'] = $orderLineDetGet->I_SECONDARY_DESC;


                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_AFT_DIS;

                                        }else{

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                            
                                        }
                                        $glTransDataArr['GLAT_NOTES'] = 'CG_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                }
                            }
                        }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'DIS_AC') {
                            $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                            $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                            $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Sales Discount";
                            $glTransDataArr['GLAT_JOURNAL_REF'] = "INV_DISCOUNT";
                            $glTransDataArr['GLAT_DESC'] = "INV_DISCOUNT";

                            $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                            $glTransDataArr["GLAT_WHSE"] = $whseDet->WHSE_CODE;
                            $glTransDataArr["GLAT_WHSE_DESC"] = $whseDet->WHSE_DESC;
                            
                            $diffAmt = 0;
                            // $diffAmt = $orderDet->DIFF_AMT > 0 ?abs($orderDet->DIFF_AMT):0;

                                if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->SH_TOT_DISCOUNT+$diffAmt;

                                }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                    $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->SH_TOT_DISCOUNT+$diffAmt;

                                }else{

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                    $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                    
                                }
                                $glTransDataArr['GLAT_NOTES'] = 'DIS_AC';
                            $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                        }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'INC_AC') {
                            $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                            foreach ($orderLineDet as $orderLineDetGet) {
                                if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'INC_AC') {
                                    $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                    $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                                    $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Sales Income";
                                    $glTransDataArr['GLAT_JOURNAL_REF'] = "LINE_AMT";
                                    $glTransDataArr['GLAT_DESC'] = "LINE_AMT";


                                    $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                    $glTransDataArr['GLAT_WHSE'] = $orderLineDetGet->LOCA;
                                    $glTransDataArr['GLAT_WHSE_DESC'] = $orderLineDetGet->WHSE_DESC;
                                    $glTransDataArr['GLAT_ITEM'] = $orderLineDetGet->ITEM_CODE;
                                    $glTransDataArr['GLAT_ITEM_DESC1'] = $orderLineDetGet->I_DESC;
                                    $glTransDataArr['GLAT_ITEM_DESC2'] = $orderLineDetGet->I_SECONDARY_DESC;

                                        if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = $orderLineDetGet->LINE_AMT_BEF_VAT_BEF_DIS;

                                        }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                            $glTransDataArr['GLAT_CREDIT_AMT'] = $orderLineDetGet->LINE_AMT_BEF_VAT_BEF_DIS;

                                        }else{

                                            $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                            $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                            
                                        }
                                        $glTransDataArr['GLAT_NOTES'] = 'INC_AC';
                                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                                }
                            }
                        }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'DEBT_AC') {
                            $custDet = customerDet(array('where'=>"WHERE CUST_CODE ='{$orderDet->SH_CUST_ID}'",'dataType'=>'row'));
                            $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$custDet->CUST_ACC_NO}'",'dataType'=>'row']);
                            $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                            $glTransDataArr['GLAT_ACCT_LVL1'] = $custDet->CUST_ACC_NO;
                            $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Dedtors";
                            $glTransDataArr['GLAT_JOURNAL_REF'] = "AR_TOTAL_AMT";
                            $glTransDataArr['GLAT_DESC'] = "AR_TOTAL_AMT";

                            $glTransDataArr['GLAT_WHSE'] = $orderDet->SH_WHSE_CODE;
                            $glTransDataArr['GLAT_WHSE_DESC'] = $whseDet->WHSE_DESC;

                                if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = $orderDet->SH_GRAND_TOT;

                                }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                    $glTransDataArr['GLAT_CREDIT_AMT'] = $orderDet->SH_GRAND_TOT;

                                }else{

                                    $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                    $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                    
                                }
                                $glTransDataArr['GLAT_NOTES'] = 'INC_AC';
                            $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                        }
                    }
                }else{
                    $glTransDataArr = array(
                                            "GLATE_ORDER_ID" =>$data->temp_id,
                                            "GLATE_INV_COUNT" =>$data->order_count,
                                            "GLATE_TYPE" => 'SO_CASH',
                                            "GLATE_REASON" => 'GL MODULE PROFILE NOT CONFIGURE',
                                            "GLATE_CRE_BY" =>$userCon->USERNAME,
                                            "GLATE_CRE_DATE" =>$curDateTime
                                        );
                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS_EXCEPTION',$glTransDataArr);
                }
    return true;
    }

    /*================================ STOCK TRANSFER ACCOUNT ==============================*/
    
    public function stockTransfer($data = array()){
           
            $curDateTime = dateTime();
            $userCon = sessionUserData();
            /*================== Variable declare =================*/
            $orderId = $data->orderid;
            $mType = $data->type;
            $module = $data->module;

            $orderDet = StockTransferOrderDet(array('where'=>"WHERE STH_ORDER_NO = '$orderId' AND STH_STATUS = 'RECEIVED'",'dataType'=>'result'));
            if($mType == 'TRANSFER'){
                $glRuleFetchFrom = glModuleAccDet(array('where'=>"AND CC_WHSE_CODE = '".substr($orderDet[0]->STH_FROM_WHSE,0,2)."' AND GLMP_TYPE = '{$mType}' AND GLMP_MODULE = '{$module}' GROUP BY GLMP_BATCH_CODE ORDER BY GLMP_ID DESC",'dataType'=>'row'));
                $glRuleFetchto = glModuleAccDet(array('where'=>"AND CC_WHSE_CODE = '".substr($orderDet[0]->STH_WHSE_TO,0,2)."' AND GLMP_TYPE = '{$mType}' AND GLMP_MODULE = '{$module}' GROUP BY GLMP_BATCH_CODE ORDER BY GLMP_ID DESC",'dataType'=>'row'));

            }
            if($glRuleFetchFrom && $glRuleFetchto){
              
                
                $glRuleGetFrom = glModuleAccDet(array('where'=>"AND GLMP_BATCH_CODE = '{$glRuleFetchFrom->GLMP_BATCH_CODE}'",'dataType'=>'result'));
                $glRuleGetTo = glModuleAccDet(array('where'=>"AND GLMP_BATCH_CODE = '{$glRuleFetchto->GLMP_BATCH_CODE}'",'dataType'=>'result'));
                $glTransDataArr = array(
                                        "GLAT_BUS_UNIT" =>$orderDet[0]->STH_BUS_UNIT,
                                        "GLAT_APPL" => $glRuleFetchFrom->GLMP_MODULE,
                                        // "GLAT_ACCT_LVL2" => $glRuleFetch->GLMP_COST_CENTER,
                                        // "GLAT_ACCT_LVL1" => , USED
                                        "GLAT_YEAR" =>date('Y'),
                                        "GLAT_PERIOD" =>date('m'),
                                        "GLAT_APPL_TYPE" => $glRuleFetchFrom->GLMP_TYPE,
                                        // "GLAT_DEBIT_AMT" => , USED
                                        // "GLAT_CREDIT_AMT" => , USED
                                        // "GLAT_CURRENCY" => ,
                                        // "GLAT_EXCHANGE_DATE" => ,
                                        // "GLAT_EXCHANGE_RATE" => ,
                                        "GLAT_INVOICE_PFX" => 'MT',
                                        "GLAT_INVOICE_NO" => $orderDet[0]->STH_ORDER_NO,
                                        // "GLAT_WHSE" =>$whseDet->WHSE_CODE,
                                        // "GLAT_WHSE_DESC" =>$whseDet->WHSE_DESC,
                                        // "GLAT_SOLDTO_CUST" =>$orderDet->CUST_CODE,
                                        // "GLAT_SOLDTO_NAME1" =>$orderDet->CUST_NAME,
                                        // "GLAT_SOLDTO_NAME2" =>$orderDet->CUST_NAME_AR,
                                        // "GLAT_ORDER_TEMP" => $data->temp_id,
                                        "GLAT_CRE_BY" =>$userCon->USERNAME,
                                        "GLAT_CRE_DATE" =>$curDateTime
                                );
                    foreach ($orderDet as $getOrderDet) {
                        //FUNCTION DATA FETCHING
                        $whseDetFrom = wherehouseDetail(array('where'=>"WHERE WHSE_CODE ='{$getOrderDet->STH_FROM_WHSE}'",'dataType'=>'row'));
                        $whseDetTo = wherehouseDetail(array('where'=>"WHERE WHSE_CODE ='{$getOrderDet->STH_WHSE_TO}'",'dataType'=>'row'));
                        // FROM WAREHOUSE
                        foreach ($glRuleGetFrom as $glRuleGetDataFrom) {
                            //ARRAY UNSET
                            unset($glTransDataArr['GLAT_ACCT_LVL1']);
                            unset($glTransDataArr['GLAT_DEBIT_AMT']);
                            unset($glTransDataArr['GLAT_CREDIT_AMT']);
                            unset($glTransDataArr['GLAT_ITEM']);
                            unset($glTransDataArr['GLAT_ITEM_DESC1']);
                            unset($glTransDataArr['GLAT_ITEM_DESC2']);
                            unset($glTransDataArr['GLAT_ACCOUNT_DESC']);
                            unset($glTransDataArr['GLAT_JOURNAL_REF']);
                            unset($glTransDataArr['GLAT_DESC']);
                            unset($glTransDataArr['GLAT_ACCOUNT_DESC_AR']);
                            unset($glTransDataArr['GLAT_ACCT_LVL2']);
                            //VARIABLE DECLARE
                            //MAIN LOGIN
                            if($glRuleGetDataFrom->GLMP_ACCOUNT_TYPE == 'STK_AC'){
                                        $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetDataFrom->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                        $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;

                                        $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetDataFrom->GLMP_ACCOUNT_NO;
                                        $glTransDataArr['GLAT_ACCT_LVL2'] = $glRuleGetDataFrom->GLMP_COST_CENTER;

                                        $glTransDataArr['GLAT_WHSE'] = $whseDetFrom->WHSE_CODE;
                                        $glTransDataArr['GLAT_WHSE_DESC'] = $whseDetFrom->WHSE_DESC;

                                        $glTransDataArr['GLAT_ITEM'] = $getOrderDet->I_CODE;
                                        $glTransDataArr['GLAT_ITEM_DESC1'] = $getOrderDet->I_DESC;
                                        $glTransDataArr['GLAT_ITEM_DESC2'] = $getOrderDet->I_SECONDARY_DESC;

                                        $glTransDataArr['GLAT_ACCOUNT_DESC'] = "{$getOrderDet->ICAT_DESC} Stock";
                                        $glTransDataArr['GLAT_JOURNAL_REF'] = "TRANSFER-{$getOrderDet->STH_ORDER_NO}";
                                        $glTransDataArr['GLAT_DESC'] = "TRANSFER-{$getOrderDet->STH_ORDER_NO}";

                                        // $diffAmt = $orderDet->DIFF_AMT < 0 ?abs($orderDet->DIFF_AMT):0;
                                        
                                            if($glRuleGetDataFrom->GLMP_ENTRY_TYPE == 'D') {
            
                                                $glTransDataArr['GLAT_DEBIT_AMT'] = $getOrderDet->STD_UNIT_COST*$getOrderDet->STD_TRANS_QTY;
            
                                            }elseif($glRuleGetDataFrom->GLMP_ENTRY_TYPE == 'C') {
            
                                                $glTransDataArr['GLAT_CREDIT_AMT'] = $getOrderDet->STD_UNIT_COST*$getOrderDet->STD_TRANS_QTY;
            
                                            }elseif($glRuleGetDataFrom->GLMP_ENTRY_TYPE == 'B'){
                                                $glTransDataArr['GLAT_CREDIT_AMT'] = $getOrderDet->STD_UNIT_COST*$getOrderDet->STD_TRANS_QTY;
                                            }else{
            
                                                $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                                $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
            
                                            }
                                        $glTransDataArr['GLAT_NOTES'] = 'STK_AC';
                                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                            }
                        }
                        //TO WAREHOUSE
                        foreach ($glRuleGetTo as $glRuleGetDataTo) {
                            unset($glTransDataArr['GLAT_ACCT_LVL1']);
                            unset($glTransDataArr['GLAT_DEBIT_AMT']);
                            unset($glTransDataArr['GLAT_CREDIT_AMT']);
                            unset($glTransDataArr['GLAT_ITEM']);
                            unset($glTransDataArr['GLAT_ITEM_DESC1']);
                            unset($glTransDataArr['GLAT_ITEM_DESC2']);
                            unset($glTransDataArr['GLAT_ACCOUNT_DESC']);
                            unset($glTransDataArr['GLAT_JOURNAL_REF']);
                            unset($glTransDataArr['GLAT_DESC']);
                            unset($glTransDataArr['GLAT_ACCOUNT_DESC_AR']);
                            unset($glTransDataArr['GLAT_ACCT_LVL2']);
                            if($glRuleGetDataTo->GLMP_ACCOUNT_TYPE == 'STK_AC'){
                                $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetDataTo->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                        $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;

                                        $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetDataTo->GLMP_ACCOUNT_NO;
                                        $glTransDataArr['GLAT_ACCT_LVL2'] = $glRuleGetDataTo->GLMP_COST_CENTER;

                                        $glTransDataArr['GLAT_WHSE'] = $whseDetTo->WHSE_CODE;
                                        $glTransDataArr['GLAT_WHSE_DESC'] = $whseDetTo->WHSE_DESC;

                                        $glTransDataArr['GLAT_ITEM'] = $getOrderDet->I_CODE;
                                        $glTransDataArr['GLAT_ITEM_DESC1'] = $getOrderDet->I_DESC;
                                        $glTransDataArr['GLAT_ITEM_DESC2'] = $getOrderDet->I_SECONDARY_DESC;

                                        $glTransDataArr['GLAT_ACCOUNT_DESC'] = "{$getOrderDet->ICAT_DESC} Stock";
                                        $glTransDataArr['GLAT_JOURNAL_REF'] = "TRANSFER-{$getOrderDet->STH_ORDER_NO}";
                                        $glTransDataArr['GLAT_DESC'] = "TRANSFER-{$getOrderDet->STH_ORDER_NO}";

                                        // $diffAmt = $orderDet->DIFF_AMT < 0 ?abs($orderDet->DIFF_AMT):0;
                                        
                                            if($glRuleGetDataTo->GLMP_ENTRY_TYPE == 'D') {
            
                                                $glTransDataArr['GLAT_DEBIT_AMT'] = $getOrderDet->STD_UNIT_COST*$getOrderDet->STD_TRANS_QTY;
            
                                            }elseif($glRuleGetDataTo->GLMP_ENTRY_TYPE == 'C') {
            
                                                $glTransDataArr['GLAT_CREDIT_AMT'] = $getOrderDet->STD_UNIT_COST*$getOrderDet->STD_TRANS_QTY;
            
                                            }elseif($glRuleGetDataTo->GLMP_ENTRY_TYPE == 'B'){
                                                $glTransDataArr['GLAT_DEBIT_AMT'] = $getOrderDet->STD_UNIT_COST*$getOrderDet->STD_TRANS_QTY;
                                            }else{
            
                                                $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                                $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
            
                                            }
                                        $glTransDataArr['GLAT_NOTES'] = 'STK_AC';
                                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                            }
                        }
                    }   
                }else{
                    $glTransDataArr = array(
                                            "GLATE_ORDER_ID" =>$orderId,
                                            "GLATE_INV_COUNT" =>$orderId,
                                            "GLATE_TYPE" => 'SO_CASH',
                                            "GLATE_REASON" => 'GL MODULE PROFILE NOT CONFIGURE',
                                            "GLATE_CRE_BY" =>$userCon->USERNAME,
                                            "GLATE_CRE_DATE" =>$curDateTime
                                        );
                    $this->CI->unicon->insertUniversal('GL_APPL_TRANS_EXCEPTION',$glTransDataArr);
                }
    return true;
    }


    public function puchaseReceived($data = array()){
        
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        //Variable Declare
        $orderId = $data->temp_id;
        $mType = $data->type;
        $module = $data->module;
        //Data fetch from sale header and detail table
        $purHeadDet = purchaseOrderHeaderDet($orderId, 'row');

        $glRuleFetch = glModuleAccDet(array('where'=>"AND CC_WHSE_CODE = '01' AND GLMP_TYPE = '{$mType}' AND GLMP_MODULE = '{$module}' AND GLMP_RTN = '{$data->rtnType}' AND GLMP_REMARK = '{$purHeadDet->POH_VENDOR_CODE}' GROUP BY GLMP_BATCH_CODE ORDER BY GLMP_ID DESC",'dataType'=>'row'));
   
        if($glRuleFetch){

            $purLineDet = purchaseOrderItemDet($orderId,'result');
            $landedCost = freightChargeDets($orderId,'BUYER','SUM(PODC_PO_CHARGE_AMT) LANDED_COST','row');
            $glRuleGet = glModuleAccDet(array('where'=>"AND GLMP_BATCH_CODE = '{$glRuleFetch->GLMP_BATCH_CODE}'",'dataType'=>'result'));
            $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '01'",'dataType'=>'row'));
            $glTransDataArr = array(
                                    "GLAT_BUS_UNIT" =>$glRuleFetch->GLMP_BUS_UNIT,
                                    "GLAT_APPL" => $glRuleFetch->GLMP_MODULE,
                                    "GLAT_ACCT_LVL2" => $glRuleFetch->GLMP_COST_CENTER,
                                    // "GLAT_ACCT_LVL1" => , USED
                                    "GLAT_YEAR" =>date('Y'),
                                    "GLAT_PERIOD" =>date('m'),
                                    "GLAT_APPL_TYPE" => $glRuleFetch->GLMP_TYPE,
                                    // "GLAT_DEBIT_AMT" => , USED
                                    // "GLAT_CREDIT_AMT" => , USED
                                    // "GLAT_CURRENCY" => ,
                                    // "GLAT_EXCHANGE_DATE" => ,
                                    // "GLAT_EXCHANGE_RATE" => ,
                                    "GLAT_INVOICE_PFX" => $purHeadDet->POH_PREFIX,
                                    "GLAT_INVOICE_NO" =>  $purHeadDet->POH_ORDER_ID,
                                    "GLAT_ORDER_TEMP" => $orderId,
                                    "GLAT_WHSE" =>$whseDet->WHSE_CODE,
                                    "GLAT_WHSE_DESC" =>$whseDet->WHSE_DESC,
                                    // "GLAT_SOLDTO_CUST" =>$purHeadDet->CUST_CODE,
                                    // "GLAT_SOLDTO_NAME1" =>$purHeadDet->CUST_NAME,
                                    // "GLAT_SOLDTO_NAME2" =>$purHeadDet->CUST_NAME_AR,
                                    "GLAT_VENDOR" =>$purHeadDet->V_CODE,
                                    "GLAT_VENDOR_NAME1" =>$purHeadDet->V_NAME,
                                    "GLAT_VENDOR_NAME2" =>$purHeadDet->V_NAME_AR,
                                    "GLAT_CRE_BY" =>$userCon->USERNAME,
                                    "GLAT_CRE_DATE" =>$curDateTime
                            );
            foreach ($glRuleGet as $glRuleGetData) {

                unset($glTransDataArr['GLAT_ACCT_LVL1']);
                unset($glTransDataArr['GLAT_DEBIT_AMT']);
                unset($glTransDataArr['GLAT_CREDIT_AMT']);
                unset($glTransDataArr['GLAT_ITEM']);
                unset($glTransDataArr['GLAT_ITEM_DESC1']);
                unset($glTransDataArr['GLAT_ITEM_DESC2']);
                unset($glTransDataArr['GLAT_ACCOUNT_DESC']);
                unset($glTransDataArr['GLAT_JOURNAL_REF']);
                unset($glTransDataArr['GLAT_DESC']);
                unset($glTransDataArr['GLAT_ACCOUNT_DESC_AR']);

                if($glRuleGetData->GLMP_ACCOUNT_TYPE == 'CASH_AC'){
                        $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                        $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                        $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;

                        $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Cash On Hand - Saudi Riyal";
                        $glTransDataArr['GLAT_JOURNAL_REF'] = "CASH_PAYMENT";
                        $glTransDataArr['GLAT_DESC'] = "CASH_PAYMENT";

                            if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                $glTransDataArr['GLAT_DEBIT_AMT'] = $purHeadDet->POH_GRAND_TOTAL*$purHeadDet->EXCHR_BUY_RATE;

                            }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                $glTransDataArr['GLAT_CREDIT_AMT'] = $purHeadDet->POH_GRAND_TOTAL*$purHeadDet->EXCHR_BUY_RATE;

                            }else{

                                $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                $glTransDataArr['GLAT_CREDIT_AMT'] = '0';

                            }
                        $glTransDataArr['GLAT_NOTES'] = 'CASH_AC';
                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'STK_AC') {
                        foreach ($purLineDet as $orderLineDetGet) {
                            if ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'STK_AC') {
                                $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                                $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                                $glTransDataArr['GLAT_ACCOUNT_DESC'] = "STOCK {$orderLineDetGet->ICAT_DESC}";
                                $glTransDataArr['GLAT_JOURNAL_REF'] = "{$purHeadDet->POH_PREFIX}-{$purHeadDet->POH_ORDER_ID}";
                                $glTransDataArr['GLAT_DESC'] = "WHSE: {$whseDet->WHSE_DESC}";

                                $glTransDataArr['GLAT_ITEM'] = $orderLineDetGet->I_CODE;
                                $glTransDataArr['GLAT_ITEM_DESC1'] = $orderLineDetGet->I_DESC;
                                $glTransDataArr['GLAT_ITEM_DESC2'] = $orderLineDetGet->I_SECONDARY_DESC;
                                $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                                $glTransDataArr['GLAT_WHSE'] = $whseDet->WHSE_CODE;
                                $glTransDataArr['GLAT_WHSE_DESC'] = $whseDet->WHSE_DESC;
                                    $disAmt = ($orderLineDetGet->POD_ITEM_QTY*$orderLineDetGet->POD_UNIT_COST*$orderLineDetGet->POD_EXCH_RATE)/($purHeadDet->POH_GRAND_TOTAL*$purHeadDet->EXCHR_BUY_RATE);
                                    
                                    if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                        $glTransDataArr['GLAT_DEBIT_AMT'] = ($orderLineDetGet->POD_ITEM_QTY*$orderLineDetGet->POD_UNIT_COST*$orderLineDetGet->POD_EXCH_RATE)+($landedCost->LANDED_COST*$disAmt);

                                    }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                        $glTransDataArr['GLAT_CREDIT_AMT'] = ($orderLineDetGet->POD_ITEM_QTY*$orderLineDetGet->POD_UNIT_COST*$orderLineDetGet->POD_EXCH_RATE)+($landedCost->LANDED_COST*$disAmt);

                                    }else{

                                        $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                        $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                        
                                    }
                                    $glTransDataArr['GLAT_NOTES'] = 'STK_AC';
                                $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                            }
                        }
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'PAY_AC') {
                        $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                        $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                        $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Debiter";
                        $glTransDataArr['GLAT_JOURNAL_REF'] = "PAYABLE_AMT";
                        $glTransDataArr['GLAT_DESC'] = "PAYABLE_AMT";

                        $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                        $glTransDataArr["GLAT_WHSE"] = $whseDet->WHSE_CODE;
                        $glTransDataArr["GLAT_WHSE_DESC"] = $whseDet->WHSE_DESC;

                            if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                $glTransDataArr['GLAT_DEBIT_AMT'] = $purHeadDet->POH_GRAND_TOTAL*$purHeadDet->EXCHR_BUY_RATE;

                            }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                $glTransDataArr['GLAT_CREDIT_AMT'] = $purHeadDet->POH_GRAND_TOTAL*$purHeadDet->EXCHR_BUY_RATE;

                            }else{

                                $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                
                            }
                            $glTransDataArr['GLAT_NOTES'] = 'DIS_AC';
                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                    }elseif ($glRuleGetData->GLMP_ACCOUNT_TYPE == 'TRAN_CUST_AC') {
                        $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$glRuleGetData->GLMP_ACCOUNT_NO}'",'dataType'=>'row']);
                        $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
                        $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Landed Cost";
                        $glTransDataArr['GLAT_JOURNAL_REF'] = "LANDED_COST";
                        $glTransDataArr['GLAT_DESC'] = "LANDED_COST";

                        $glTransDataArr['GLAT_ACCT_LVL1'] = $glRuleGetData->GLMP_ACCOUNT_NO;
                        $glTransDataArr["GLAT_WHSE"] = $whseDet->WHSE_CODE;
                        $glTransDataArr["GLAT_WHSE_DESC"] = $whseDet->WHSE_DESC;

                            if($glRuleGetData->GLMP_ENTRY_TYPE == 'D') {

                                $glTransDataArr['GLAT_DEBIT_AMT'] = $landedCost->LANDED_COST;

                            }elseif($glRuleGetData->GLMP_ENTRY_TYPE == 'C') {

                                $glTransDataArr['GLAT_CREDIT_AMT'] = $landedCost->LANDED_COST;

                            }else{

                                $glTransDataArr['GLAT_DEBIT_AMT'] = '0';
                                $glTransDataArr['GLAT_CREDIT_AMT'] = '0';
                                
                            }
                            $glTransDataArr['GLAT_NOTES'] = 'DIS_AC';
                        $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
                    }
                }
            }else{
                $glTransDataArr = array(
                                        "GLATE_ORDER_ID" =>substr($orderId,0,3),
                                        "GLATE_INV_COUNT" =>substr($orderId,3),
                                        "GLATE_TYPE" => 'SO_CASH',
                                        "GLATE_REASON" => 'GL MODULE PROFILE NOT CONFIGURE',
                                        "GLATE_CRE_BY" =>$userCon->USERNAME,
                                        "GLATE_CRE_DATE" =>$curDateTime
                                    );
                $this->CI->unicon->insertUniversal('GL_APPL_TRANS_EXCEPTION',$glTransDataArr);
            }
        return true;
    }

    public function accountReceivable($data = array()){
        
        $curDateTime = dateTime();
        $userCon = sessionUserData();

        //Data fetch from sale header and detail table
        $vochDet = $this->CI->unicon->CoreQuery("SELECT * FROM PAYMENT_VOCHER,COST_CENTER,WHAREHOUSE WHERE PV_WHSE_CODE = CC_WHSE_CODE AND PV_WHSE_CODE = WHSE_CODE AND PV_ORDER_PRE = '{$data->orderPre}' AND PV_ORDER_NO = '{$data->orderNo}'","row");
        custAccCreAndCheck(array('cost_cen_whse'=>$vochDet->CC_ACC_REC,'cust_code'=>$vochDet->PV_PARTIES_CODE));
        $custDet = customerDet(array('where'=>"WHERE CUST_CODE = '{$vochDet->PV_PARTIES_CODE}'","dataType"=>'row'));
        if($custDet->CUST_ACC_NO){
            
            $glTransDataArr = array(
                    "GLAT_BUS_UNIT" =>'111',
                    "GLAT_APPL" =>'AR',
                    "GLAT_ACCT_LVL2" => $vochDet->CC_CODE,
                    // "GLAT_ACCT_LVL1" => , USED
                    "GLAT_YEAR" =>date('Y'),
                    "GLAT_PERIOD" =>date('m'),
                    "GLAT_APPL_TYPE" => 'Account Receivable',
                    // "GLAT_DEBIT_AMT" => , USED
                    // "GLAT_CREDIT_AMT" => , USED
                    // "GLAT_CURRENCY" => ,
                    // "GLAT_EXCHANGE_DATE" => ,
                    // "GLAT_EXCHANGE_RATE" => ,
                    "GLAT_INVOICE_PFX" => $vochDet->PV_ORDER_PRE,
                    "GLAT_INVOICE_NO" =>  $vochDet->PV_ORDER_NO,
                    "GLAT_ORDER_TEMP" => null,
                    "GLAT_WHSE" =>$vochDet->WHSE_CODE,
                    "GLAT_WHSE_DESC" =>$vochDet->WHSE_DESC,
                    "GLAT_SOLDTO_CUST" =>$custDet->CUST_CODE,
                    "GLAT_SOLDTO_NAME1" =>$custDet->CUST_NAME,
                    "GLAT_SOLDTO_NAME2" =>$custDet->CUST_NAME_AR,
                    // "GLAT_VENDOR" =>$vochDet->V_CODE,
                    // "GLAT_VENDOR_NAME1" =>$vochDet->V_NAME,
                    // "GLAT_VENDOR_NAME2" =>$vochDet->V_NAME_AR,
                    "GLAT_CRE_BY" =>$userCon->USERNAME,
                    "GLAT_CRE_DATE" =>$curDateTime
            );

            if(substr($vochDet->PV_ORDER_PRE,0,1) == 'D'){
                $glTransDataArr['GLAT_DEBIT_AMT'] = $vochDet->PV_AMT;
            }elseif(substr($vochDet->PV_ORDER_PRE,0,1) == 'P'){
                $glTransDataArr['GLAT_CREDIT_AMT'] = $vochDet->PV_AMT;
            }else{
                $glTransDataArr['GLAT_CREDIT_AMT'] = $vochDet->PV_AMT;
            }

            $getAccAr = accHeadDet(['where'=>"WHERE AH_SUBSIDERY ='{$custDet->CUST_ACC_NO}'",'dataType'=>'row']);
            $glTransDataArr['GLAT_ACCOUNT_DESC_AR'] = $getAccAr->AR_Title;
            $glTransDataArr['GLAT_ACCOUNT_DESC'] = "Account Receivable";
            $glTransDataArr['GLAT_JOURNAL_REF'] = "Account Receivable";
            $glTransDataArr['GLAT_DESC'] = "Account Receivable";

            $glTransDataArr['GLAT_ACCT_LVL1'] = $custDet->CUST_ACC_NO;
            $glTransDataArr["GLAT_WHSE"] = $vochDet->WHSE_CODE;
            $glTransDataArr["GLAT_WHSE_DESC"] = $vochDet->WHSE_DESC;

            $this->CI->unicon->insertUniversal('GL_APPL_TRANS',$glTransDataArr);
        }
    }

    /*================== SALE GL ENTRY =================*/
    
    public function saleGlentry($data = array()){
        header('Content-Type: application/json');
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        

        $glTransDet = $this->CI->unicon->CoreQuery("SELECT *,DATE_FORMAT(GLAT_CRE_DATE,'%Y-%m-%d'),SUM(GLAT_DEBIT_AMT) DEBIT,SUM(GLAT_CREDIT_AMT) CREDIT
                                                    FROM GL_APPL_TRANS,SALE_HEADER
                                                    WHERE GLAT_INVOICE_PFX = SH_INV_PREFIX
                                                    AND GLAT_INVOICE_NO = SH_INV_NO
                                                    AND SH_ORDER_DATE BETWEEN '{$data->from_date}' AND '{$data->to_date}'
                                                    AND SH_WHSE_CODE = '{$data->whse_code}'
                                                    AND GLAT_APPL = 'SO'
                                                    AND GLAT_POSTED = 'N'
                                                    GROUP BY GLAT_INVOICE_PFX,
                                                            GLAT_INVOICE_NO,
                                                            GLAT_BUS_UNIT,
                                                            GLAT_CRE_BY,
                                                            GLAT_POSTED,
                                                            GLAT_PERIOD,
                                                            GLAT_YEAR,
                                                            GLAT_ACCT_LVL1,
                                                            GLAT_ACCT_LVL2,
                                                            SH_ORDER_DATE
                                                    ORDER BY SH_ORDER_DATE,
                                                            GLAT_INVOICE_NO,
                                                            GLAT_INVOICE_PFX
                                                ",'result');
        if(count($glTransDet)>0){
            $glPre = glPrefix(array('where'=>"WHERE GLP_JOURNAL_PFX = 'SO'",'dataType'=>'row'));
            $this->CI->unicon->CoreQuery("UPDATE GL_PREFIXES SET GLP_NEXT_NUMBER = GLP_NEXT_NUMBER+1 WHERE GLP_JOURNAL_PFX = 'SO'");
            //Data fetch from sale header and detail table

            

            $glHdArr = array(
                                "GLJH_BUS_UNIT" => $glTransDet[0]->GLAT_BUS_UNIT,
                                "GLJH_JOURNAL_PFX"  => 'SO',
                                "GLJH_JOURNAL_NO" => $glPre->GLP_NEXT_NUMBER,
                                "GLJH_DESC" => 'Sales Invoicing '.$glTransDet[0]->GLAT_WHSE_DESC,
                                "GLJH_JOURNAL_CLS" => 'A',
                                "GLJH_JOURNAL_DATE" => date('Y-m-d'),
                                "GLJH_JOURNAL_REF" => 'Sales Invoicing - Whse :'.$glTransDet[0]->GLAT_WHSE,
                                "GLJH_YEAR" => $glTransDet[0]->GLAT_YEAR,
                                "GLJH_PERIOD" => $glTransDet[0]->GLAT_PERIOD,
                                "GLJH_JOURNAL_REF_NO" =>'MANUAL',
                                "GLJH_CRE_DATE" =>$curDateTime,
                                "GLJH_CRE_BY" =>$userCon->USERNAME
                            );
            $this->CI->unicon->insertUniversal('GL_JOURNAL_HEADER',$glHdArr);
            $mcount = 1;
            foreach ($glTransDet as $glTransDetGet) {
                $glHdArr = array(
                                "GLJL_BUS_UNIT" =>$glTransDetGet->GLAT_BUS_UNIT,
                                "GLJL_JOURNAL_PFX" =>'SO',
                                "GLJL_JOURNAL_NO" =>$glPre->GLP_NEXT_NUMBER,
                                "GLJL_JOURNAL_LN" =>$mcount++,
                                "GLJL_ACCT_LVL1" =>$glTransDetGet->GLAT_ACCT_LVL1,
                                "GLJL_COST_CENTER" =>$glTransDetGet->GLAT_ACCT_LVL2,
                                "GLJL_DESC" =>$glTransDetGet->GLAT_SOLDTO_CUST.'-'.$glTransDetGet->GLAT_SOLDTO_NAME1.'-'.$glTransDetGet->GLAT_INVOICE_PFX.'-'.$glTransDetGet->GLAT_INVOICE_NO,
                                "GLJL_JOURNAL_REF" =>$glTransDetGet->GLAT_INVOICE_PFX.'-'.$glTransDetGet->GLAT_INVOICE_NO,
                                "GLJL_REF_NO" =>'',
                                "GLJL_CREDIT_AMT" =>$glTransDetGet->CREDIT,
                                "GLJL_DEBIT_AMT" =>$glTransDetGet->DEBIT,
                                "GLJL_CRE_BY" =>$userCon->USERNAME,
                                "GLJL_CRE_DATE" =>$curDateTime,
                                "GLJL_INV_PFX" =>$glTransDetGet->GLAT_INVOICE_PFX,
                                "GLJL_INV_NO" =>$glTransDetGet->GLAT_INVOICE_NO,
                                "GLJL_NOTES" =>"MANUAL"
                            );
                $updateArr = array(
                                    'GLAT_POSTED' => 'Y',
                                    'GLAT_JOURNAL_NO'=>$glPre->GLP_NEXT_NUMBER,
                                    'GLAT_JOURNAL_PFX'=>'SO',
                                    'GLAT_POSTED_DATE' =>date('Y-m-d')
                                );
                $this->CI->unicon->updateArrayUniversal('GL_APPL_TRANS',$updateArr,"GLAT_INVOICE_PFX = '{$glTransDetGet->GLAT_INVOICE_PFX}' AND GLAT_INVOICE_NO = '{$glTransDetGet->GLAT_INVOICE_NO}'");
                $this->CI->unicon->insertUniversal('GL_JOURNAL_DETAIL',$glHdArr);
            }
            $con =  true;
        }else{
            $con =  false;
        }

        $glTransReturnDet = $this->CI->unicon->CoreQuery("SELECT *,DATE_FORMAT(GLAT_CRE_DATE,'%Y-%m-%d'),SUM(GLAT_DEBIT_AMT) DEBIT,SUM(GLAT_CREDIT_AMT) CREDIT
                                                            FROM GL_APPL_TRANS,RETURN_HEADER
                                                            WHERE GLAT_INVOICE_PFX = RH_INV_PREFIX
                                                            AND GLAT_INVOICE_NO = RH_INV_NO
                                                            AND RH_DATE BETWEEN '{$data->from_date}' AND '{$data->to_date}'
                                                            AND RH_WHSE = '{$data->whse_code}'
                                                            AND GLAT_APPL = 'SO'
                                                            AND GLAT_POSTED = 'N'
                                                            GROUP BY GLAT_INVOICE_PFX,
                                                                    GLAT_INVOICE_NO,
                                                                    GLAT_BUS_UNIT,
                                                                    GLAT_CRE_BY,
                                                                    GLAT_POSTED,
                                                                    GLAT_PERIOD,
                                                                    GLAT_YEAR,
                                                                    GLAT_ACCT_LVL1,
                                                                    GLAT_ACCT_LVL2,
                                                                    RH_DATE
                                                            ORDER BY RH_DATE,
                                                                    GLAT_INVOICE_NO,
                                                                    GLAT_INVOICE_PFX
                                                        ",'result');
        if(count($glTransReturnDet)>0){
            $glPre = glPrefix(array('where'=>"WHERE GLP_JOURNAL_PFX = 'SO'",'dataType'=>'row'));
            $this->CI->unicon->CoreQuery("UPDATE GL_PREFIXES SET GLP_NEXT_NUMBER = GLP_NEXT_NUMBER+1 WHERE GLP_JOURNAL_PFX = 'SO'");
            //Data fetch from sale header and detail table

            

            $glHdArr = array(
                                "GLJH_BUS_UNIT" => $glTransReturnDet[0]->GLAT_BUS_UNIT,
                                "GLJH_JOURNAL_PFX"  => 'SO',
                                "GLJH_JOURNAL_NO" => $glPre->GLP_NEXT_NUMBER,
                                "GLJH_DESC" => 'Sales Invoicing Retuen '.$glTransReturnDet[0]->GLAT_WHSE_DESC,
                                "GLJH_JOURNAL_CLS" => 'A',
                                "GLJH_JOURNAL_DATE" => date('Y-m-d'),
                                "GLJH_JOURNAL_REF" => 'Sales Invoicing Retuen - Whse :'.$glTransReturnDet[0]->GLAT_WHSE,
                                "GLJH_YEAR" => $glTransReturnDet[0]->GLAT_YEAR,
                                "GLJH_PERIOD" => $glTransReturnDet[0]->GLAT_PERIOD,
                                "GLJH_JOURNAL_REF_NO" =>'MANUAL',
                                "GLJH_CRE_DATE" =>$curDateTime,
                                "GLJH_CRE_BY" =>$userCon->USERNAME
                            );
            $this->CI->unicon->insertUniversal('GL_JOURNAL_HEADER',$glHdArr);
            $mcount = 1;
            foreach ($glTransReturnDet as $glTransReturnDetGet) {
                $glHdArr = array(
                                "GLJL_BUS_UNIT" =>$glTransReturnDetGet->GLAT_BUS_UNIT,
                                "GLJL_JOURNAL_PFX" =>'SO',
                                "GLJL_JOURNAL_NO" =>$glPre->GLP_NEXT_NUMBER,
                                "GLJL_JOURNAL_LN" =>$mcount++,
                                "GLJL_ACCT_LVL1" =>$glTransReturnDetGet->GLAT_ACCT_LVL1,
                                "GLJL_COST_CENTER" =>$glTransReturnDetGet->GLAT_ACCT_LVL2,
                                "GLJL_DESC" =>$glTransReturnDetGet->GLAT_SOLDTO_CUST.'-'.$glTransReturnDetGet->GLAT_SOLDTO_NAME1.'-'.$glTransReturnDetGet->GLAT_INVOICE_PFX.'-'.$glTransReturnDetGet->GLAT_INVOICE_NO,
                                "GLJL_JOURNAL_REF" =>$glTransReturnDetGet->GLAT_INVOICE_PFX.'-'.$glTransReturnDetGet->GLAT_INVOICE_NO,
                                "GLJL_REF_NO" =>'',
                                "GLJL_CREDIT_AMT" =>$glTransReturnDetGet->CREDIT,
                                "GLJL_DEBIT_AMT" =>$glTransReturnDetGet->DEBIT,
                                "GLJL_CRE_BY" =>$userCon->USERNAME,
                                "GLJL_CRE_DATE" =>$curDateTime,
                                "GLJL_INV_PFX" =>$glTransReturnDetGet->GLAT_INVOICE_PFX,
                                "GLJL_INV_NO" =>$glTransReturnDetGet->GLAT_INVOICE_NO,
                                "GLJL_NOTES" =>"MANUAL"
                            );
                $updateArr = array(
                                    'GLAT_POSTED' => 'Y',
                                    'GLAT_JOURNAL_NO'=>$glPre->GLP_NEXT_NUMBER,
                                    'GLAT_JOURNAL_PFX'=>'SO',
                                    'GLAT_POSTED_DATE' =>date('Y-m-d')
                                );
                $this->CI->unicon->updateArrayUniversal('GL_APPL_TRANS',$updateArr,"GLAT_INVOICE_PFX = '{$glTransReturnDetGet->GLAT_INVOICE_PFX}' AND GLAT_INVOICE_NO = '{$glTransReturnDetGet->GLAT_INVOICE_NO}'");
                $this->CI->unicon->insertUniversal('GL_JOURNAL_DETAIL',$glHdArr);
            }
            $con =  true;
        }else{
            $con =  false;
        }

        return $con;
    }

    /*================== PURCHASE GL ENTRY =================*/
    
    public function poGlentry($data = array()){
        header('Content-Type: application/json');
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        

        $glTransDet = $this->CI->unicon->CoreQuery("SELECT *,DATE_FORMAT(GLAT_CRE_DATE,'%Y-%m-%d'),SUM(GLAT_DEBIT_AMT) DEBIT,SUM(GLAT_CREDIT_AMT) CREDIT
                                                    FROM GL_APPL_TRANS,PO_HEADER
                                                    WHERE GLAT_INVOICE_PFX = '{$data->gl_type}'
                                                    AND GLAT_INVOICE_NO = POH_ORDER_ID
                                                    AND POH_ORDER_DATE BETWEEN '{$data->from_date}' AND '{$data->to_date}'
                                                    AND GLAT_WHSE = '{$data->whse_code}'
                                                    AND GLAT_APPL = 'PO'
                                                    AND GLAT_POSTED = 'N'
                                                    GROUP BY GLAT_INVOICE_PFX,
                                                            GLAT_APPL,
                                                            GLAT_INVOICE_NO,
                                                            GLAT_BUS_UNIT,
                                                            GLAT_CRE_BY,
                                                            GLAT_POSTED,
                                                            GLAT_PERIOD,
                                                            GLAT_YEAR,
                                                            GLAT_ACCT_LVL1,
                                                            GLAT_ACCT_LVL2,
                                                            POH_ORDER_DATE
                                                    ORDER BY POH_ORDER_DATE,
                                                            GLAT_INVOICE_NO,
                                                            GLAT_INVOICE_PFX
                                                ",'result');
        if(count($glTransDet)>0){
            $glPre = glPrefix(array('where'=>"WHERE GLP_JOURNAL_PFX = 'PO'",'dataType'=>'row'));
            $this->CI->unicon->CoreQuery("UPDATE GL_PREFIXES SET GLP_NEXT_NUMBER = GLP_NEXT_NUMBER+1 WHERE GLP_JOURNAL_PFX = 'PO'");
            //Data fetch from sale header and detail table

            

            $glHdArr = array(
                                "GLJH_BUS_UNIT" => $glTransDet[0]->GLAT_BUS_UNIT,
                                "GLJH_JOURNAL_PFX"  => 'PO',
                                "GLJH_JOURNAL_NO" => $glPre->GLP_NEXT_NUMBER,
                                "GLJH_DESC" => "P.O-WHSE:".$glTransDet[0]->GLAT_WHSE_DESC,
                                "GLJH_JOURNAL_CLS" => 'A',
                                "GLJH_JOURNAL_DATE" => date('Y-m-d'),
                                "GLJH_JOURNAL_REF" => "Purchasing Transaction:".$glTransDet[0]->GLAT_WHSE,
                                "GLJH_YEAR" => $glTransDet[0]->GLAT_YEAR,
                                "GLJH_PERIOD" => $glTransDet[0]->GLAT_PERIOD,
                                "GLJH_JOURNAL_REF_NO" =>'MANUAL',
                                "GLJH_CRE_DATE" =>$curDateTime,
                                "GLJH_CRE_BY" =>$userCon->USERNAME
                            );
            $this->CI->unicon->insertUniversal('GL_JOURNAL_HEADER',$glHdArr);
            $mcount = 1;
            foreach ($glTransDet as $glTransDetGet) {
                $glHdArr = array(
                                "GLJL_BUS_UNIT" =>$glTransDetGet->GLAT_BUS_UNIT,
                                "GLJL_JOURNAL_PFX" =>'PO',
                                "GLJL_JOURNAL_NO" =>$glPre->GLP_NEXT_NUMBER,
                                "GLJL_JOURNAL_LN" =>$mcount++,
                                "GLJL_ACCT_LVL1" =>$glTransDetGet->GLAT_ACCT_LVL1,
                                "GLJL_COST_CENTER" =>$glTransDetGet->GLAT_ACCT_LVL2,
                                "GLJL_DESC" =>$glTransDetGet->GLAT_VENDOR.'-'.$glTransDetGet->GLAT_VENDOR_NAME1.'-'.$glTransDetGet->GLAT_VENDOR_NAME2.'-'.$glTransDetGet->GLAT_INVOICE_PFX.'-'.$glTransDetGet->GLAT_INVOICE_NO,
                                "GLJL_JOURNAL_REF" =>$glTransDetGet->GLAT_INVOICE_PFX.'-'.$glTransDetGet->GLAT_INVOICE_NO,
                                "GLJL_REF_NO" =>'',
                                "GLJL_CREDIT_AMT" =>$glTransDetGet->CREDIT,
                                "GLJL_DEBIT_AMT" =>$glTransDetGet->DEBIT,
                                "GLJL_CRE_BY" =>$userCon->USERNAME,
                                "GLJL_CRE_DATE" =>$curDateTime,
                                "GLJL_INV_PFX" =>$glTransDetGet->GLAT_INVOICE_PFX,
                                "GLJL_INV_NO" =>$glTransDetGet->GLAT_INVOICE_NO,
                                "GLJL_NOTES" =>"MANUAL"
                            );
                $updateArr = array(
                                    'GLAT_POSTED' => 'Y',
                                    'GLAT_JOURNAL_NO'=>$glPre->GLP_NEXT_NUMBER,
                                    'GLAT_JOURNAL_PFX'=>'PO',
                                    'GLAT_POSTED_DATE' =>date('Y-m-d')
                                );
                $this->CI->unicon->updateArrayUniversal('GL_APPL_TRANS',$updateArr,"GLAT_INVOICE_PFX = '{$glTransDetGet->GLAT_INVOICE_PFX}' AND GLAT_INVOICE_NO = '{$glTransDetGet->GLAT_INVOICE_NO}'");
                $this->CI->unicon->insertUniversal('GL_JOURNAL_DETAIL',$glHdArr);
            }
            return true;
        }else{
            return false;
        }
    }

    /*================== PURCHASE GL ENTRY EACH PO ENTRY=================*/
    
    public function poGlentryEachPoEntry($data = array()){
        header('Content-Type: application/json');
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        

        $glTransDet = $this->CI->unicon->CoreQuery("SELECT *,DATE_FORMAT(GLAT_CRE_DATE,'%Y-%m-%d'),SUM(GLAT_DEBIT_AMT) DEBIT,SUM(GLAT_CREDIT_AMT) CREDIT
                                                    FROM GL_APPL_TRANS,PO_HEADER
                                                    WHERE GLAT_INVOICE_PFX = '{$data->gl_type}'
                                                    AND GLAT_INVOICE_NO = POH_ORDER_ID
                                                    AND POH_ORDER_DATE BETWEEN '{$data->from_date}' AND '{$data->to_date}'
                                                    AND GLAT_WHSE = '{$data->whse_code}'
                                                    AND GLAT_APPL = 'PO'
                                                    AND GLAT_POSTED = 'N'
                                                    GROUP BY GLAT_INVOICE_PFX,
                                                            GLAT_INVOICE_NO
                                                    ORDER BY POH_ORDER_DATE,
                                                            GLAT_INVOICE_NO,
                                                            GLAT_INVOICE_PFX
                                                ",'result');
        if(count($glTransDet)>0){

            foreach ($glTransDet as $glTransDetGet):

                $glPre = glPrefix(array('where'=>"WHERE GLP_JOURNAL_PFX = 'PO'",'dataType'=>'row'));
                $this->CI->unicon->CoreQuery("UPDATE GL_PREFIXES SET GLP_NEXT_NUMBER = GLP_NEXT_NUMBER+1 WHERE GLP_JOURNAL_PFX = 'PO'");

                $glHdArr = array(
                    "GLJH_BUS_UNIT" => $glTransDetGet->GLAT_BUS_UNIT,
                    "GLJH_JOURNAL_PFX"  => 'PO',
                    "GLJH_JOURNAL_NO" => $glPre->GLP_NEXT_NUMBER,
                    "GLJH_DESC" => "P.O-WHSE:".$glTransDetGet->GLAT_WHSE_DESC,
                    "GLJH_JOURNAL_CLS" => 'A',
                    "GLJH_JOURNAL_DATE" => date('Y-m-d'),
                    "GLJH_JOURNAL_REF" => "Purchasing Transaction:".$glTransDetGet->GLAT_WHSE,
                    "GLJH_YEAR" => $glTransDetGet->GLAT_YEAR,
                    "GLJH_PERIOD" => $glTransDetGet->GLAT_PERIOD,
                    "GLJH_JOURNAL_REF_NO" =>'MANUAL',
                    "GLJH_CRE_DATE" =>$curDateTime,
                    "GLJH_CRE_BY" =>$userCon->USERNAME
                );
                $this->CI->unicon->insertUniversal('GL_JOURNAL_HEADER',$glHdArr);
            
                $getSubTrans = $this->CI->unicon->CoreQuery("SELECT *,DATE_FORMAT(GLAT_CRE_DATE,'%Y-%m-%d'),SUM(GLAT_DEBIT_AMT) DEBIT,SUM(GLAT_CREDIT_AMT) CREDIT
                                                            FROM GL_APPL_TRANS,PO_HEADER
                                                            WHERE GLAT_INVOICE_PFX = '{$data->gl_type}'
                                                            AND GLAT_INVOICE_NO = POH_ORDER_ID
                                                            AND POH_ORDER_DATE BETWEEN '{$data->from_date}' AND '{$data->to_date}'
                                                            AND GLAT_WHSE = '{$data->whse_code}'
                                                            AND GLAT_APPL = 'PO'
                                                            AND GLAT_POSTED = 'N'
                                                            AND POH_ORDER_ID = '{$glTransDetGet->GLAT_INVOICE_NO}'
                                                            GROUP BY GLAT_INVOICE_PFX,
                                                                    GLAT_APPL,
                                                                    GLAT_INVOICE_NO,
                                                                    GLAT_BUS_UNIT,
                                                                    GLAT_CRE_BY,
                                                                    GLAT_POSTED,
                                                                    GLAT_PERIOD,
                                                                    GLAT_YEAR,
                                                                    GLAT_ACCT_LVL1,
                                                                    GLAT_ACCT_LVL2,
                                                                    POH_ORDER_DATE
                                                            ORDER BY POH_ORDER_DATE,
                                                                    GLAT_INVOICE_NO,
                                                                    GLAT_INVOICE_PFX",'result');
                $mcount = 1;
                foreach ($getSubTrans as $getSubTransData) {
                    $glHdArr = array(
                                    "GLJL_BUS_UNIT" =>$getSubTransData->GLAT_BUS_UNIT,
                                    "GLJL_JOURNAL_PFX" =>'PO',
                                    "GLJL_JOURNAL_NO" =>$glPre->GLP_NEXT_NUMBER,
                                    "GLJL_JOURNAL_LN" =>$mcount++,
                                    "GLJL_ACCT_LVL1" =>$getSubTransData->GLAT_ACCT_LVL1,
                                    "GLJL_COST_CENTER" =>$getSubTransData->GLAT_ACCT_LVL2,
                                    "GLJL_DESC" =>$getSubTransData->GLAT_VENDOR.'-'.$getSubTransData->GLAT_VENDOR_NAME1.'-'.$getSubTransData->GLAT_VENDOR_NAME2.'-'.$getSubTransData->GLAT_INVOICE_PFX.'-'.$getSubTransData->GLAT_INVOICE_NO,
                                    "GLJL_JOURNAL_REF" =>$getSubTransData->GLAT_INVOICE_PFX.'-'.$getSubTransData->GLAT_INVOICE_NO,
                                    "GLJL_REF_NO" =>'',
                                    "GLJL_CREDIT_AMT" =>$getSubTransData->CREDIT,
                                    "GLJL_DEBIT_AMT" =>$getSubTransData->DEBIT,
                                    "GLJL_CRE_BY" =>$userCon->USERNAME,
                                    "GLJL_CRE_DATE" =>$curDateTime,
                                    "GLJL_INV_PFX" =>$getSubTransData->GLAT_INVOICE_PFX,
                                    "GLJL_INV_NO" =>$getSubTransData->GLAT_INVOICE_NO,
                                    "GLJL_NOTES" =>"MANUAL"
                                );

                    $this->CI->unicon->insertUniversal('GL_JOURNAL_DETAIL',$glHdArr);
                }

                    $updateArr = array(
                        'GLAT_POSTED' => 'Y',
                        'GLAT_JOURNAL_NO'=>$glPre->GLP_NEXT_NUMBER,
                        'GLAT_JOURNAL_PFX'=>'PO',
                        'GLAT_POSTED_DATE' =>date('Y-m-d')
                    );
                    $this->CI->unicon->updateArrayUniversal('GL_APPL_TRANS',$updateArr,"GLAT_INVOICE_PFX = '{$glTransDetGet->GLAT_INVOICE_PFX}' AND GLAT_INVOICE_NO = '{$glTransDetGet->GLAT_INVOICE_NO}'");

            endforeach;
            
            return true;
        }else{
            return false;
        }
    }

    /*================== TRANSFER GL ENTRY =================*/
    
    public function transGlentry($data = array()){
        header('Content-Type: application/json');
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        

        $glTransDet = $this->CI->unicon->CoreQuery("SELECT *,DATE_FORMAT(GLAT_CRE_DATE,'%Y-%m-%d'),SUM(GLAT_DEBIT_AMT) DEBIT,SUM(GLAT_CREDIT_AMT) CREDIT
                                                    FROM GL_APPL_TRANS,STOCK_TRANSFER_HEADER,TRANSFER_REASON
                                                    WHERE GLAT_INVOICE_PFX = 'MT'
                                                    AND GLAT_INVOICE_NO = STH_ORDER_NO
                                                    AND STH_TRANS_RSN = TR_TRANS_RSN
                                                    AND STH_TRANS_DATE BETWEEN '{$data->from_date}' AND '{$data->to_date}'
                                                    AND STH_FROM_WHSE = '{$data->whse_code}'
                                                    AND GLAT_APPL = 'INV'
                                                    AND GLAT_POSTED = 'N'
                                                    GROUP BY GLAT_INVOICE_PFX,
                                                            GLAT_APPL,
                                                            GLAT_INVOICE_NO,
                                                            GLAT_BUS_UNIT,
                                                            GLAT_CRE_BY,
                                                            GLAT_POSTED,
                                                            GLAT_PERIOD,
                                                            GLAT_YEAR,
                                                            GLAT_ACCT_LVL1,
                                                            GLAT_ACCT_LVL2,
                                                            STH_TRANS_DATE
                                                    ORDER BY STH_TRANS_DATE,
                                                            GLAT_INVOICE_NO,
                                                            GLAT_INVOICE_PFX
                                                ",'result');
        if(count($glTransDet)>0){
            $glPre = glPrefix(array('where'=>"WHERE GLP_JOURNAL_PFX = 'IC'",'dataType'=>'row'));
            $this->CI->unicon->CoreQuery("UPDATE GL_PREFIXES SET GLP_NEXT_NUMBER = GLP_NEXT_NUMBER+1 WHERE GLP_JOURNAL_PFX = 'IC'");
            //Data fetch from sale header and detail table

            

            $glHdArr = array(
                                "GLJH_BUS_UNIT" => $glTransDet[0]->GLAT_BUS_UNIT,
                                "GLJH_JOURNAL_PFX"  => 'IC',
                                "GLJH_JOURNAL_NO" => $glPre->GLP_NEXT_NUMBER,
                                "GLJH_DESC" => "Inventory:".$glTransDet[0]->GLAT_WHSE_DESC,
                                "GLJH_JOURNAL_CLS" => 'A',
                                "GLJH_JOURNAL_DATE" => date('Y-m-d'),
                                "GLJH_JOURNAL_REF" => "Inventory:".$glTransDet[0]->GLAT_WHSE,
                                "GLJH_YEAR" => $glTransDet[0]->GLAT_YEAR,
                                "GLJH_PERIOD" => $glTransDet[0]->GLAT_PERIOD,
                                "GLJH_JOURNAL_REF_NO" =>'MANUAL',
                                "GLJH_CRE_DATE" =>$curDateTime,
                                "GLJH_CRE_BY" =>$userCon->USERNAME
                            );
            $this->CI->unicon->insertUniversal('GL_JOURNAL_HEADER',$glHdArr);
            $mcount = 1;
            foreach ($glTransDet as $glTransDetGet) {
                $glHdArr = array(
                                "GLJL_BUS_UNIT" =>$glTransDetGet->GLAT_BUS_UNIT,
                                "GLJL_JOURNAL_PFX" =>'IC',
                                "GLJL_JOURNAL_NO" =>$glPre->GLP_NEXT_NUMBER,
                                "GLJL_JOURNAL_LN" =>$mcount++,
                                "GLJL_ACCT_LVL1" =>$glTransDetGet->GLAT_ACCT_LVL1,
                                "GLJL_COST_CENTER" =>$glTransDetGet->GLAT_ACCT_LVL2,
                                "GLJL_DESC" =>$glTransDetGet->GLAT_INVOICE_PFX.'-'.$glTransDetGet->GLAT_INVOICE_NO.'-'.$glTransDetGet->GLAT_WHSE,
                                "GLJL_JOURNAL_REF" =>$glTransDetGet->GLAT_INVOICE_PFX.'-'.$glTransDetGet->GLAT_INVOICE_NO,
                                "GLJL_REF_NO" =>'',
                                "GLJL_CREDIT_AMT" =>$glTransDetGet->CREDIT,
                                "GLJL_DEBIT_AMT" =>$glTransDetGet->DEBIT,
                                "GLJL_CRE_BY" =>$userCon->USERNAME,
                                "GLJL_CRE_DATE" =>$curDateTime,
                                "GLJL_INV_PFX" =>$glTransDetGet->GLAT_INVOICE_PFX,
                                "GLJL_INV_NO" =>$glTransDetGet->GLAT_INVOICE_NO,
                                "GLJL_NOTES" =>"MANUAL"
                            );
                $updateArr = array(
                                    'GLAT_POSTED' => 'Y',
                                    'GLAT_JOURNAL_NO'=>$glPre->GLP_NEXT_NUMBER,
                                    'GLAT_JOURNAL_PFX'=>'IC',
                                    'GLAT_POSTED_DATE' =>date('Y-m-d')
                                );
                $this->CI->unicon->updateArrayUniversal('GL_APPL_TRANS',$updateArr,"GLAT_INVOICE_PFX = '{$glTransDetGet->GLAT_INVOICE_PFX}' AND GLAT_INVOICE_NO = '{$glTransDetGet->GLAT_INVOICE_NO}'");
                $this->CI->unicon->insertUniversal('GL_JOURNAL_DETAIL',$glHdArr);
            }
            return true;
        }else{
            return false;
        }
    }
    public function allAccDet(){
        $accNo = array();
            $totMainHead = accHeadDet(array('where'=>"GROUP BY AH_MAIN_HEAD",'dataType'=>'result'));       
            $totSubHead = accHeadDet(array('where'=>"GROUP BY AH_SUB_HEAD",'dataType'=>'result'));       
            $totGenHead = accHeadDet(array('where'=>"GROUP BY AH_GENERAL",'dataType'=>'result'));       
            $totSubsideHead = accHeadDet(array('where'=>"GROUP BY AH_SUBSIDERY",'dataType'=>'result')); 
        // foreach ($totMainHead as $totMainHeadGet) {
        //     if($totMainHeadGet->AH_MAIN_HEAD>0){
        //         $accNo[] = $totMainHeadGet->AH_MAIN_HEAD;
        //     }
            
        // }
        // foreach ($totSubHead as $totSubHeadGet) {
        //     if($totSubHeadGet->AH_SUB_HEAD>0){
        //         $accNo[] = $totSubHeadGet->AH_SUB_HEAD;
        //     }
        // }
        // foreach ($totGenHead as $totGenHeadGet) {
        //     if($totGenHeadGet->AH_GENERAL>0){
        //         $accNo[] = $totGenHeadGet->AH_GENERAL;
        //     }
        // }
        foreach ($totSubsideHead as $totSubsideHeadGet) {
            if($totSubsideHeadGet->AH_SUBSIDERY>0){
                $accNo[] = $totSubsideHeadGet->AH_SUBSIDERY;
            }
        }

        return $accNo;
    }
}

?>