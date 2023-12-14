<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('customerDet'))
{
    function customerDet($data = array()){
        $CI =get_instance();
        $CI->load->library('session');
        $sessionData = $CI->session->userdata();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM CUSTOMER $where","{$data['dataType']}");
        return $data;
    }
}
/**========================================================================
 *                           SALE ORDER DETAIL
 *========================================================================**/
if(!function_exists('saleOrderHeadDet'))
{
    function saleOrderHeadDet($data = array()){
        $CI =get_instance();
        $CI->load->library('session');
        $sessionData = $CI->session->userdata();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT *,ROUND(SH_GRAND_TOT) SH_GRAND_TOT FROM SALE_HEADER SH,CUSTOMER C,CITIES CT,STATES ST,COUNTRIES CONT,EMPLOYEE E
                                                    WHERE SH.SH_CUST_ID = C.CUST_CODE
                                                    AND C.CUST_CITY_ID = CT.CTY_CODE
                                                    AND C.CUST_STATE_ID = ST.ST_CODE
                                                    AND C.CUST_COUNTRY_ID = CONT.CNTRY_CODE
                                                    AND E.EMP_CODE = SH.SH_SALESMAN_ID
                                                    $where","{$data['dataType']}");
        return $data;
    }
}
/**========================================================================
 *                           SALE ORDER DETAILE LINE
 *========================================================================**/
if(!function_exists('saleOrderLineDet'))
{
    function saleOrderLineDet($data = array(),$sal_ret=null){
        $CI =get_instance();
        $CI->load->library('session');
        $sessionData = $CI->session->userdata();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
        
            if ($sal_ret == 'check_qty') {

                $data =  $CI->universal_model->CoreQuery("SELECT *,SD_QTY-SUM(ifnull(RD_QTY,0)) RET_QTY FROM SALE_DETAIL SD
                LEFT JOIN RETURN_DETAIL RD
                ON SD.SD_ID = RD.RD_SD_LINE_ID
                INNER JOIN ITEMS I
                ON I.I_CODE = SD.SD_ITEM_CODE
                $where GROUP BY RD.RD_SD_LINE_ID","{$data['dataType']}");
            }elseif($sal_ret == 'multi'){

                $data =  $CI->universal_model->CoreQuery("SELECT {$data['select']} FROM SALE_DETAIL SD
                                                            LEFT JOIN RETURN_DETAIL RD
                                                            ON SD.SD_ID = RD.RD_SD_LINE_ID
                                                            INNER JOIN ITEMS I
                                                            ON I.I_CODE = SD.SD_ITEM_CODE
                                                            $where","{$data['dataType']}");
                
            }elseif($sal_ret == 'ret_view'){
                $data =  $CI->universal_model->CoreQuery("SELECT * FROM RETURN_DETAIL RD,ITEMS I
                                                            WHERE RD.RD_ITEM_CODE = I.I_CODE
                                                            $where","{$data['dataType']}");
            }else{
                $data =  $CI->universal_model->CoreQuery("SELECT * FROM SALE_DETAIL SD,ITEMS I
                                                    WHERE SD.SD_ITEM_CODE = I.I_CODE
                                                    $where","{$data['dataType']}");
            }
            

        return $data;
    }
}
/**========================================================================
 *                           SALE ORDER RETURN DETAIL
 *========================================================================**/
if(!function_exists('saleOrderReturnHeadDet'))
{
    function saleOrderReturnHeadDet($data = array()){
        $CI =get_instance();
        $CI->load->library('session');
        $sessionData = $CI->session->userdata();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT *,ROUND(RH_GRAND_TOT) RH_GRAND_TOT FROM RETURN_HEADER RH,CUSTOMER C,CITIES CT,STATES ST,COUNTRIES CONT,EMPLOYEE E
                                                    WHERE RH.RH_PARTIES_ID = C.CUST_CODE
                                                    AND C.CUST_CITY_ID = CT.CTY_CODE
                                                    AND C.CUST_STATE_ID = ST.ST_CODE
                                                    AND C.CUST_COUNTRY_ID = CONT.CNTRY_CODE
                                                    AND E.EMP_CODE = RH.RH_SALESMAN
                                                    $where","{$data['dataType']}");
        return $data;
    }
}
/**========================================================================
 *                           GET PAYMENT DETAIL BY ORDER ID
 *========================================================================**/
if(!function_exists('paymentDetails'))
{
    function paymentDetails($data = array()){
        $CI =get_instance();
        $CI->load->library('session');
        $sessionData = $CI->session->userdata();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM PAYMENT_DETAIL PD,PAY_METHODS PM
                                                    WHERE PD.PD_PAY_METHOD_ID = PM.PM_CODE
                                                    $where","{$data['dataType']}");
        return $data;
    }
}

/**========================================================================
 *                           CUSTOMER TOT AMT OTHER DETAIL
 *========================================================================**/

 if(!function_exists('custBalDetail'))
 {
     function custBalDetail($data = array()){
 
         $CI =get_instance();
         $CI->load->model('universal_model');
         $data =  $CI->universal_model->CoreQuery("SELECT SUM(SH_GRAND_TOT-SH_PAID_AMT) AS OUTSTANDING_AMT FROM SALE_HEADER WHERE SH_CUST_ID='{$data['custCode']}'","{$data['dataType']}");
         return $data;
 
     }
 }

 /**========================================================================
 *                           ALL INVOICE BY CUSTOMER CODE
 *========================================================================**/
if(!function_exists('invDetByCustCode'))
{
    function invDetByCustCode($data = array()){

        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM SALE_HEADER 
                                                    $where","{$data['dataType']}");
        return $data;

    }
}

/**========================================================================
 *                           SYNC PAYMENT STATUS
 *========================================================================**/

 if(!function_exists('syncPayStatusForCust'))
{
    function syncPayStatusForCust($data = array()){

        $CI =get_instance();
        $CI->load->model('universal_model');
            $IncDetByVens = $data;
            foreach ($IncDetByVens as $IncDetByVen) {
               if ($IncDetByVen->SH_GRAND_TOT == $IncDetByVen->SH_PAID_AMT) {
                    $status = 'PAID';
                    $incSta = 'CLOSE';
               }elseif ($IncDetByVen->SH_GRAND_TOT > $IncDetByVen->SH_PAID_AMT && $IncDetByVen->SH_PAID_AMT>0) {
                    $status = 'PARTIAL';
                    $incSta = 'OPEN';
               }else{
                    $status = 'PENDING';
                    $incSta = 'OPEN';
               }
                $CI->universal_model->CoreQuery("UPDATE SALE_HEADER SET SH_PAY_STATUS = '$status',SH_STATUS='$incSta'  WHERE SH_ORDER_ID = '{$IncDetByVen->SH_ORDER_ID}'");

            }
        return true;

    }
}

/**========================================================================
 *                           SALE ORDER LINE DETAIL
 *========================================================================**/
if(!function_exists('saleOrderLineDetail'))
{
    function saleOrderLineDetail($data = array()){

        $CI =get_instance();
        $CI->load->model('universal_model');
            $IncDetByVens = $data;
            foreach ($IncDetByVens as $IncDetByVen) {
               if ($IncDetByVen->SH_GRAND_TOT == $IncDetByVen->SH_PAID_AMT) {
                    $status = 'PAID';
                    $incSta = 'CLOSE';
               }elseif ($IncDetByVen->SH_GRAND_TOT > $IncDetByVen->SH_PAID_AMT && $IncDetByVen->SH_PAID_AMT>0) {
                    $status = 'PARTIAL';
                    $incSta = 'OPEN';
               }else{
                    $status = 'PENDING';
                    $incSta = 'OPEN';
               }
                $CI->universal_model->CoreQuery("UPDATE SALE_HEADER SET SH_PAY_STATUS = '$status',SH_STATUS='$incSta'  WHERE SH_ORDER_ID = '{$IncDetByVen->SH_ORDER_ID}'");

            }
        return true;

    }
}

/**========================================================================
 *                           SALE ORDER LINE DETAIL
 *========================================================================**/
if(!function_exists('custAccCreAndCheck'))
{
    function custAccCreAndCheck($data = array()){

        if(isset($data['cust_code']) && isset($data['cost_cen_whse'])){

            $CI =get_instance();
            $CI->load->model('universal_model');
                $userCon = sessionUserData();
                $getData = $CI->universal_model->CoreQuery("SELECT * FROM CUSTOMER WHERE CUST_CODE = '{$data['cust_code']}' AND CUST_ACC_NO IS NULL","row");
                
                if($getData){
                    $getDataWhse = $CI->universal_model->CoreQuery("SELECT * FROM `ACCOUNT_HEADS` WHERE `AH_SUBSIDERY` LIKE '{$data['cost_cen_whse']}%'",'num_rows');
                    if($getDataWhse>0){
                        $getDataWhseDet = $CI->universal_model->CoreQuery("SELECT  *,AH_SUBSIDERY+1 NEW_AC_COUNT FROM `ACCOUNT_HEADS` WHERE `AH_SUBSIDERY` LIKE '{$data['cost_cen_whse']}%' ORDER BY AH_SUBSIDERY DESC LIMIT 1",'row');
                        $accInsArr = array(
                            "AH_BUS_UNIT"=>$getDataWhseDet->AH_BUS_UNIT,
                            "AH_SORT_SEQ"=>$getDataWhseDet->AH_SORT_SEQ,
                            "AH_MAIN_HEAD"=>$getDataWhseDet->AH_MAIN_HEAD,
                            "AH_SUB_HEAD"=>$getDataWhseDet->AH_SUB_HEAD,
                            "AH_GENERAL"=>$getDataWhseDet->AH_GENERAL,
                            "AH_SUBSIDERY"=>$getDataWhseDet->NEW_AC_COUNT,
                            "EN_Title"=>$getData->CUST_NAME,
                            "AR_Title"=>$getData->CUST_NAME_AR,
                            "AC_STATUS"=>$getDataWhseDet->AC_STATUS,
                            "AC_CRE_BY"=>$userCon->USERNAME,
                            "AC_CRE_DATE"=>dateTime()
                        );
                        $CI->universal_model->insertUniversal('ACCOUNT_HEADS', $accInsArr);
                        $CI->universal_model->CoreQuery("UPDATE CUSTOMER SET CUST_ACC_NO = '{$accInsArr['AH_SUBSIDERY']}' WHERE CUST_CODE = '{$data['cust_code']}'");
                        return 'if';
                    }else{
                        $getDataWhse = $CI->universal_model->CoreQuery("SELECT * FROM `ACCOUNT_HEADS` WHERE AH_GENERAL = '110104000000'",'row');
                        $accInsArr = array(
                            "AH_BUS_UNIT"=>$getDataWhse->AH_BUS_UNIT,
                            "AH_SORT_SEQ"=>$getDataWhse->AH_SORT_SEQ,
                            "AH_MAIN_HEAD"=>$getDataWhse->AH_MAIN_HEAD,
                            "AH_SUB_HEAD"=>$getDataWhse->AH_SUB_HEAD,
                            "AH_GENERAL"=>$getDataWhse->AH_GENERAL,
                            "AH_SUBSIDERY"=>"{$data['whse_code']}0001",
                            "EN_Title"=>$getData->CUST_NAME,
                            "AR_Title"=>$getData->CUST_NAME_AR,
                            "AC_STATUS"=>$getDataWhse->AC_STATUS,
                            "AC_CRE_BY"=>$userCon->USERNAME,
                            "AC_CRE_DATE"=>dateTime()
                        );
                        $CI->universal_model->insertUniversal('ACCOUNT_HEADS', $accInsArr);
                        $CI->universal_model->CoreQuery("UPDATE CUSTOMER SET CUST_ACC_NO = '{$accInsArr['AH_SUBSIDERY']}' WHERE CUST_CODE = '{$data['cust_code']}'");
                        return 'else';
                    }
                }else{
                    return 'all_ready_ac_exist';
                }
            
        }else{
            return false;
        }

    }
}