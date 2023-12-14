<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('freightChargeDets'))
{
    function freightChargeDets($orderId,$type,$selectData = '*',$dataType='result_array'){

        $prefixId = substr($orderId,0,3);
        $orderId = substr($orderId,3);
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT $selectData 
                                                        FROM PO_DETAILS_CHARGES 
                                                        JOIN PO_CHARGES
                                                        ON PO_CHARGES.CHRG_TYPE = PO_DETAILS_CHARGES.PODC_PO_CHARGE_CODE
                                                        WHERE PODC_PREFIX='$prefixId' 
                                                        AND PODC_POH_ORDER_ID ='$orderId' 
                                                        AND PODC_TYPE = '$type'","$dataType");
        return $data;
    }
}

if(!function_exists('freightChargeDetsByOrderNdFreightCode'))
{
    function freightChargeDetsByOrderNdFreightCode($orderId,$type,$freightCode){
        
        $prefixId = substr($orderId,0,3);
        $orderId = substr($orderId,3);
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * 
                                                        FROM PO_DETAILS_CHARGES 
                                                        JOIN PO_CHARGES
                                                        ON PO_CHARGES.CHRG_TYPE = PO_DETAILS_CHARGES.PODC_PO_CHARGE_CODE
                                                        WHERE PODC_PREFIX = '$prefixId' 
                                                        AND PODC_POH_ORDER_ID = '$orderId' 
                                                        AND PODC_TYPE = '$type'
                                                        AND PODC_PO_CHARGE_CODE = '$freightCode' ","result_array");
        
        return $data;
    }
}

if(!function_exists('purchaseOrderItemDet'))
{
    function purchaseOrderItemDet($orderId,$dataType = 'result_array'){

        $prefixId = substr($orderId,0,3);
        $orderId = substr($orderId,3);
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * 
                                                        FROM PO_DETAILS 
                                                        JOIN ITEMS
                                                        ON ITEMS.I_CODE = PO_DETAILS.POD_ITEM_CODE
                                                        JOIN ITEM_CATEGORY
                                                        ON ICAT_CODE = I_CAT_CODE
                                                        WHERE POD_PREFIX='$prefixId' 
                                                        AND POD_POH_ORDER_ID ='$orderId'","$dataType");
        return $data;
    }
}

if(!function_exists('purchaseOrderHeaderDet'))
{
    function purchaseOrderHeaderDet($orderId,$dataType="result_array"){

        $prefixId = substr($orderId,0,3);
        $orderId = substr($orderId,3);
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * 
                                                        FROM PO_HEADER
                                                        JOIN VENDOR
                                                        ON VENDOR.V_CODE = PO_HEADER.POH_VENDOR_CODE
                                                        JOIN FREIGHTS
                                                        ON FREIGHTS.FRT_CODE = PO_HEADER.POH_FREIGHT_CODE
                                                        JOIN SHIP_VIA
                                                        ON SHIP_VIA.SHIPV_CODE = PO_HEADER.POH_SHIP_VIA_CODE
                                                        JOIN FOBS
                                                        ON FOBS.FOB_CODE = PO_HEADER.POH_FOB_CODE
                                                        JOIN TERMS
                                                        ON TERMS.TERM_CODE = PO_HEADER.POH_TERMS_CODE
                                                        JOIN CURRENCY_EXCHANGE_RATE
                                                        ON CURRENCY_EXCHANGE_RATE.EXCHR_ID = PO_HEADER.POH_CUR_EXCH_ID
                                                        JOIN CURRENCY
                                                        ON CURRENCY.CUR_CODE = CURRENCY_EXCHANGE_RATE.EXCHR_CURRENCY
                                                        JOIN CITIES
                                                        ON CITIES.CTY_CODE = VENDOR.CITY_ID
                                                        JOIN STATES
                                                        ON STATES.ST_CODE = CITIES.CTY_STATE_CODE
                                                        JOIN COUNTRIES
                                                        ON COUNTRIES.CNTRY_CODE = STATES.ST_CNTRY_ID
                                                        WHERE POH_PREFIX='$prefixId' 
                                                        AND POH_ORDER_ID ='$orderId'","$dataType");
        return $data;
    }
}

if(!function_exists('clearancDet'))
{
    function clearancDet($orderId,$dataType="row_array"){

        $prefixId = substr($orderId,0,3);
        $orderId = substr($orderId,3);
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * 
                                                        FROM CLEARANCE_PO_ID 
                                                        JOIN CLEARANCE_ID
                                                        ON CLEARANCE_ID.INV_CL_NO = CLEARANCE_PO_ID.CPO_CL_NO
                                                        WHERE CPO_ORDER_PFX ='$prefixId' 
                                                        AND CPO_ORDER_ID ='$orderId'","$dataType");
        return $data;
    }
}

if(!function_exists('itemPriceDet'))
{
    function itemPriceDet($itemCode,$dataType = 'row'){


        $CI =get_instance();
        $CI->load->model('universal_model');
        $data =  $CI->universal_model->CoreQuery("SELECT *
                                                FROM PO_DETAILS 
                                                JOIN PO_HEADER
                                                ON PO_HEADER.POH_TEMP_ORDER_ID = PO_DETAILS.POD_TEMP_ORDER_ID
                                                JOIN ITEMS
                                                ON ITEMS.I_CODE = PO_DETAILS.POD_ITEM_CODE
                                                WHERE I_CODE = '$itemCode' ","$dataType");
        return $data;
    }
}

/**============================================
 *               ITEM COST
 *=============================================**/

 if(!function_exists('itemCostGet'))
    {
        function itemCostGet($itemCode){

            $CI =get_instance();
            $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT SUM(INVCOST_STD_COST) COST_TOTAL,COUNT(INVCOST_ID) COST_COUNT 
                                                        FROM ITEM_COST
                                                        WHERE INVCOST_ITEM_CODE = '$itemCode' 
                                                        GROUP BY INVCOST_ITEM_CODE","row");
            // $avgCost = $data->COST_TOTAL/$data->COST_COUNT;
            // $CI->universal_model->CoreQuery("UPDATE ITEM_COST SET INVCOST_AVG_COST = $avgCost WHERE INVCOST_ITEM_CODE = '$itemCode'");
            return (object)array('cost_total'=>$data->COST_TOTAL,'cost_count'=>$data->COST_COUNT);
        }
    }

/**========================================================================
 *                           VENDOR TOT AMT OTHER DETAIL
 *========================================================================**/

if(!function_exists('vendorBalDetail'))
{
    function vendorBalDetail($data = array()){

        $CI =get_instance();
        $CI->load->model('universal_model');
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM PO_HEADER PH,CURRENCY_EXCHANGE_RATE CER,CURRENCY CUR,CLEARANCE_PO_ID CPI,CLEARANCE_ID CI
                                                    WHERE PH.POH_CUR_EXCH_ID = CER.EXCHR_ID 
                                                    AND CER.EXCHR_CURRENCY = CUR.CUR_CODE 
                                                    AND CPO_TEMP_CL_ID = POH_TEMP_ORDER_ID 
                                                    AND INV_CL_NO = CPO_CL_NO
                                                    AND INV_POSTED = 'Y'
                                                    AND POH_VENDOR_CODE='{$data['venCode']}'","result");
        $grandTot = $paidAmt = 0;
        
        foreach ($data as $getData) {
            // $exch = $getData->EXCHR_BUY_RATE;
            $exch = 1;
            $grandTot += $getData->POH_GRAND_TOTAL * $exch;
            $paidAmt += $getData->POD_PAID_AMT;
        }
        $cal = $grandTot - $paidAmt;
        $retData = ["OUTSTANDING_AMT" => floattwo($cal)];
        // $data =  $CI->universal_model->CoreQuery("SELECT SUM(POH_GRAND_TOTAL-POD_PAID_AMT) AS OUTSTANDING_AMT FROM PO_HEADER WHERE POH_VENDOR_CODE='{$data['venCode']}'","{$data['dataType']}");
        return (object)$retData;
        // return $data;

    }
}

/**========================================================================
 *                           ALL INVOICE BY VENDOR CODE
 *========================================================================**/
if(!function_exists('invDetByVenCode'))
{
    function invDetByVenCode($data = array()){

        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM PO_HEADER PH,CURRENCY_EXCHANGE_RATE CER,CLEARANCE_PO_ID CPI,CLEARANCE_ID CI
                                                    WHERE PH.POH_CUR_EXCH_ID = CER.EXCHR_ID 
                                                    AND CPO_TEMP_CL_ID = POH_TEMP_ORDER_ID 
                                                    AND INV_CL_NO = CPO_CL_NO
                                                    AND INV_POSTED = 'Y'
                                                    $where","{$data['dataType']}");
        return $data;

    }
}

/**========================================================================
 *                           SYNC PAYMENT STATUS
 *========================================================================**/

 if(!function_exists('syncPayStatus'))
{
    function syncPayStatus($data = array()){

        $CI =get_instance();
        $CI->load->model('universal_model');
            $IncDetByVens = $data;
            foreach ($IncDetByVens as $IncDetByVen) {

               if (floattwo($IncDetByVen->POH_GRAND_TOTAL) == $IncDetByVen->POD_PAID_AMT) {
                    $status = 'PAID';
               }elseif (floattwo($IncDetByVen->POH_GRAND_TOTAL) > $IncDetByVen->POD_PAID_AMT && $IncDetByVen->POD_PAID_AMT>0) {
                    $status = 'PARTIAL';
               }else{
                    $status = 'PENDING';
               }
                $CI->universal_model->CoreQuery("UPDATE PO_HEADER SET POH_PAY_STATUS = '$status'  WHERE POH_TEMP_ORDER_ID = '{$IncDetByVen->POH_TEMP_ORDER_ID}'");

            }
        return true;

    }
    
}
?>