<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Commonlib{

    protected $CI;

    public function __construct() {
            // reference to the CodeIgniter super object
        $this->CI =& get_instance();
        $this->CI->load->model('Universal_model','unicon');
    }

    public function system($id){
        $data = $this->CI->unicon->CoreQuery("SELECT * FROM SYSTEM_SETTING WHERE SS_ID = '$id'","row");
        return $data;
    }

    public function currentSetting(){
        $data = $this->CI->unicon->CoreQuery("SELECT * FROM SYSTEM_SETTING WHERE SS_STATUS = 'Y'","row");
        return $data;
    }
    public function purchaseInvTrans($orderId){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        $orderDet = purchaseOrderItemDet($orderId,"result");
        $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '01'",'dataType'=>'row'));
        if($orderDet){
            $bugChargGet = freightChargeDets($orderId,"BUYER",'SUM(PODC_PO_CHARGE_AMT) TOT_CHARGE','row');
            foreach ($orderDet as $orderDetGet) {
                
                $itemCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$orderDetGet->POD_ITEM_CODE}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));

                $invTransArr = array(
                                        "IT_BUS_UNIT" =>111,
                                        "IT_WHSE" =>'01',
                                        "IT_ITEM" =>$orderDetGet->POD_ITEM_CODE,
                                        "IT_TRANS_DATE" =>date('Y-m-d',strtotime($orderDetGet->POD_CRE_DATE)),
                                        "IT_YEAR" =>date('Y',strtotime($orderDetGet->POD_CRE_DATE)),
                                        "IT_PERIOD" =>date('m',strtotime($orderDetGet->POD_CRE_DATE)),
                                        "IT_ORDER_TYP" =>'PO',
                                        "IT_ORDER_PFX" =>$orderDetGet->POD_PREFIX,
                                        "IT_ORDER_NO" =>$orderDetGet->POD_POH_ORDER_ID,
                                        "IT_ORDER_LN" =>null,
                                        "IT_TRANS_QTY" =>$orderDetGet->POD_ITEM_QTY,
                                        "IT_UNIT_COST" =>$itemCost->INVCOST_STD_COST,
                                        "IT_UOM" =>$orderDetGet->I_UOM_CODE,
                                        "IT_REFERENCE" =>'Purchase',
                                        "IT_UOM_STOCK" =>$orderDetGet->I_UOM_CODE,
                                        "IT_ITEM_DESC1" =>$orderDetGet->I_DESC,
                                        "IT_ITEM_DESC2" =>$orderDetGet->I_EXTEND_DESC,
                                        "IT_WHSE_DESC" =>$whseDet->WHSE_DESC,
                                        "IT_CRE_BY" =>$userCon->USERNAME,
                                        "IT_CRE_DATE" =>date('Y-m-d',strtotime($orderDetGet->POD_CRE_DATE)),
                );
                $this->CI->unicon->insertUniversal('INV_TRANS',$invTransArr);
            }
        }
        
    }

    public function purchaseVendorPrice($orderId){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        $orderHeadDet = purchaseOrderHeaderDet($orderId,'row');
        $orderDet = purchaseOrderItemDet($orderId,"result");
        $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '01'",'dataType'=>'row'));
        if($orderDet){
            foreach ($orderDet as $orderDetGet) {
                
                $vendPriceDet = $this->CI->unicon->CoreQuery("SELECT * FROM VENDOR_COST WHERE VC_ITEM_CODE = '{$orderDetGet->POD_ITEM_CODE}' ORDER BY VC_LAST_ACT_DATE DESC","row");

                $invTransArr = array(
                                    'VC_BUS_UNIT' =>111,
                                    'VC_VEN_CODE' =>$orderHeadDet->POH_VENDOR_CODE,
                                    'VC_ITEM_CODE' =>$orderDetGet->POD_ITEM_CODE,
                                    'VC_ITEM_REV' =>0,
                                    'VC_WHSE' =>'01',
                                    'VC_VENDOR_ITEM' =>$orderDetGet->VEN_I_CODE,
                                    'VC_DESC1' =>$orderDetGet->I_DESC,
                                    'VC_DESC2' =>$orderDetGet->I_EXTEND_DESC,
                                    'VC_UOM' =>$orderDetGet->I_UOM_CODE,
                                    'VC_VEND_LIST_PRICE' =>$orderDetGet->POD_UNIT_COST,
                                    'VC_CURRENCY_LIST' =>$orderHeadDet->CUR_CODE,
                                    'VC_VEND_NON_CON_PRICE' =>$orderDetGet->POD_UNIT_COST,
                                    'VC_CURRENCY_NON_CON' =>$orderHeadDet->CUR_CODE,
                                    'VC_EXCHANGE_RATE_NON_CON' =>$orderHeadDet->EXCHR_BUY_RATE,
                                    'VC_LAST_ACT_DATE' =>$vendPriceDet?date("Y-m-d", strtotime($vendPriceDet->VC_CRE_DATE)):date('Y-m-d'),
                                    'VC_LAST_ACT_PRICE' =>$vendPriceDet?$vendPriceDet->VC_VEND_LIST_PRICE:$orderDetGet->POD_UNIT_COST,
                                    'VC_CURRENCY_LAST_ACT' =>$vendPriceDet?$vendPriceDet->VC_CURRENCY_NON_CON:$orderDetGet->CUR_CODE,
                                    'VC_CRE_BY' =>$userCon->USERNAME,
                                    'VC_CRE_DATE' =>$curDateTime,
                );
                $this->CI->unicon->insertUniversal('VENDOR_COST',$invTransArr);
            }
        }
    }
    public function saleInvTrans($orderId){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        $orderDet = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"]);
        $orderHead = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
        if($orderDet){
            foreach ($orderDet as $orderDetGet) {
                $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '{$orderDetGet->SD_WHSE_LOC_ID}'",'dataType'=>'row'));
                $itemUnitCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$orderDetGet->SD_ITEM_CODE}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
                $invTransArr = array(
                                        "IT_BUS_UNIT" =>111,
                                        "IT_WHSE" =>$whseDet->WHSE_CODE,
                                        "IT_ITEM" =>$orderDetGet->SD_ITEM_CODE,
                                        "IT_TRANS_DATE" =>date('Y-m-d',strtotime($orderHead->SH_ORDER_DATE)),
                                        "IT_YEAR" =>date('Y',strtotime($orderHead->SH_ORDER_DATE)),
                                        "IT_PERIOD" =>date('m',strtotime($orderHead->SH_ORDER_DATE)),
                                        "IT_ORDER_TYP" =>'SO',
                                        "IT_ORDER_PFX" =>$orderHead->SH_INV_PREFIX,
                                        "IT_ORDER_NO" =>$orderHead->SH_INV_NO,
                                        "IT_ORDER_LN" =>null,
                                        "IT_TRANS_QTY" =>-$orderDetGet->SD_QTY,
                                        "IT_UNIT_COST" =>$itemUnitCost->INVCOST_STD_COST,
                                        "IT_UOM" =>$orderDetGet->I_UOM_CODE,
                                        "IT_REFERENCE" =>'Sale Order',
                                        "IT_UOM_STOCK" =>$orderDetGet->I_UOM_CODE,
                                        "IT_ITEM_DESC1" =>$orderDetGet->I_DESC,
                                        "IT_ITEM_DESC2" =>$orderDetGet->I_EXTEND_DESC,
                                        "IT_WHSE_DESC" =>$whseDet->WHSE_DESC,
                                        "IT_CRE_BY" =>$userCon->USERNAME,
                                        "IT_CRE_DATE" =>$curDateTime,
                );
                $this->CI->unicon->insertUniversal('INV_TRANS',$invTransArr);
            }
        }
    }

    public function saleReturnInvTrans($orderId){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        $orderDet = saleOrderLineDet(["where"=>"AND RD_RH_ID='$orderId'","dataType"=>"result"],"ret_view");
        $orderHead = saleOrderReturnHeadDet(["where"=>"AND RH_TEMP_ID='$orderId'","dataType"=>"row"]);
        if($orderDet){
            foreach ($orderDet as $orderDetGet) {
                $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '{$orderDetGet->RD_WHSE_LOC_ID}'",'dataType'=>'row'));
                $itemUnitCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$orderDetGet->RD_ITEM_CODE}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
                $invTransArr = array(
                                        "IT_BUS_UNIT" =>111,
                                        "IT_WHSE" =>$whseDet->WHSE_CODE,
                                        "IT_ITEM" =>$orderDetGet->RD_ITEM_CODE,
                                        "IT_TRANS_DATE" =>date('Y-m-d',strtotime($orderHead->RH_DATE)),
                                        "IT_YEAR" =>date('Y',strtotime($orderHead->RH_DATE)),
                                        "IT_PERIOD" =>date('m',strtotime($orderHead->RH_DATE)),
                                        "IT_ORDER_TYP" =>'SO',
                                        "IT_ORDER_PFX" =>$orderHead->RH_INV_PREFIX,
                                        "IT_ORDER_NO" =>$orderHead->RH_INV_NO,
                                        "IT_ORDER_LN" =>null,
                                        "IT_TRANS_QTY" =>$orderDetGet->RD_QTY,
                                        "IT_UNIT_COST" =>$itemUnitCost->INVCOST_STD_COST,
                                        "IT_UOM" =>$orderDetGet->I_UOM_CODE,
                                        "IT_REFERENCE" =>'Sale Return',
                                        "IT_UOM_STOCK" =>$orderDetGet->I_UOM_CODE,
                                        "IT_ITEM_DESC1" =>$orderDetGet->I_DESC,
                                        "IT_ITEM_DESC2" =>$orderDetGet->I_EXTEND_DESC,
                                        "IT_WHSE_DESC" =>$whseDet->WHSE_DESC,
                                        "IT_CRE_BY" =>$userCon->USERNAME,
                                        "IT_CRE_DATE" =>$curDateTime,
                );
                $this->CI->unicon->insertUniversal('INV_TRANS',$invTransArr);
            }
        }
    }

    public function stockTransInvTrans($orderId){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        $orderDet = StockTransferOrderDet(array('where'=>"WHERE STH_ORDER_NO = '$orderId' AND STH_STATUS = 'RECEIVED'",'dataType'=>'result'));

        if($orderDet){
            if($orderDet[0]->STH_TRANS_RSN == 201){
                foreach ($orderDet as $orderDetGet) {
                    $whseDetFrom = wherehouseDetail(array('where'=>"WHERE WHSE_CODE ='{$orderDetGet->STH_FROM_WHSE}'",'dataType'=>'row'));
                    $whseDetTo = wherehouseDetail(array('where'=>"WHERE WHSE_CODE ='{$orderDetGet->STH_WHSE_TO}'",'dataType'=>'row'));
                    //FROM
                    $invTransArr = array(
                                            "IT_BUS_UNIT" =>$orderDetGet->STH_BUS_UNIT,
                                            "IT_WHSE" =>$whseDetFrom->WHSE_CODE,
                                            "IT_ITEM" =>$orderDetGet->I_CODE,
                                            "IT_TRANS_DATE" =>$orderDetGet->STH_TRANS_DATE,
                                            "IT_YEAR" =>date('Y',strtotime($orderDetGet->STH_TRANS_DATE)),
                                            "IT_PERIOD" =>date('m',strtotime($orderDetGet->STH_TRANS_DATE)),
                                            "IT_ORDER_TYP" =>'MT',
                                            "IT_ORDER_PFX" =>'MT',
                                            "IT_ORDER_NO" =>$orderDetGet->STH_ORDER_NO,
                                            "IT_ORDER_LN" =>null,
                                            "IT_TRANS_QTY" =>-$orderDetGet->STD_TRANS_QTY,
                                            "IT_UNIT_COST" =>$orderDetGet->STD_UNIT_COST,
                                            "IT_UOM" =>$orderDetGet->I_UOM_CODE,
                                            "IT_REFERENCE" =>'Transfer',
                                            "IT_UOM_STOCK" =>$orderDetGet->I_UOM_CODE,
                                            "IT_ITEM_DESC1" =>$orderDetGet->I_DESC,
                                            "IT_ITEM_DESC2" =>$orderDetGet->I_EXTEND_DESC,
                                            "IT_WHSE_DESC" =>$whseDetFrom->WHSE_DESC,
                                            "IT_CRE_BY" =>$userCon->USERNAME,
                                            "IT_CRE_DATE" =>$curDateTime,
                    );
                    $this->CI->unicon->insertUniversal('INV_TRANS',$invTransArr);
                    //TO
                    $invTransArr = array(
                                            "IT_BUS_UNIT" =>$orderDetGet->STH_BUS_UNIT,
                                            "IT_WHSE" =>$whseDetTo->WHSE_CODE,
                                            "IT_ITEM" =>$orderDetGet->I_CODE,
                                            "IT_TRANS_DATE" =>$orderDetGet->STH_TRANS_DATE,
                                            "IT_YEAR" =>date('Y',strtotime($orderDetGet->STH_TRANS_DATE)),
                                            "IT_PERIOD" =>date('m',strtotime($orderDetGet->STH_TRANS_DATE)),
                                            "IT_ORDER_TYP" =>'MT',
                                            "IT_ORDER_PFX" =>'MT',
                                            "IT_ORDER_NO" =>$orderDetGet->STH_ORDER_NO,
                                            "IT_ORDER_LN" =>null,
                                            "IT_TRANS_QTY" =>$orderDetGet->STD_TRANS_QTY,
                                            "IT_UNIT_COST" =>$orderDetGet->STD_UNIT_COST,
                                            "IT_UOM" =>$orderDetGet->I_UOM_CODE,
                                            "IT_REFERENCE" =>'Transfer',
                                            "IT_UOM_STOCK" =>$orderDetGet->I_UOM_CODE,
                                            "IT_ITEM_DESC1" =>$orderDetGet->I_DESC,
                                            "IT_ITEM_DESC2" =>$orderDetGet->I_EXTEND_DESC,
                                            "IT_WHSE_DESC" =>$whseDetTo->WHSE_DESC,
                                            "IT_CRE_BY" =>$userCon->USERNAME,
                                            "IT_CRE_DATE" =>$curDateTime,
                        );
                        $this->CI->unicon->insertUniversal('INV_TRANS',$invTransArr);

                }
            }elseif ($orderDet[0]->STH_TRANS_RSN == 200) {
                foreach ($orderDet as $orderDetGet) {
                    $whseDetFrom = wherehouseDetail(array('where'=>"WHERE WHSE_CODE ='{$orderDetGet->STH_FROM_WHSE}'",'dataType'=>'row'));
                    //FROM
                    $invTransArr = array(
                                            "IT_BUS_UNIT" =>$orderDetGet->STH_BUS_UNIT,
                                            "IT_WHSE" =>$whseDetFrom->WHSE_CODE,
                                            "IT_ITEM" =>$orderDetGet->I_CODE,
                                            "IT_TRANS_DATE" =>$orderDetGet->STH_TRANS_DATE,
                                            "IT_YEAR" =>date('Y',strtotime($orderDetGet->STH_TRANS_DATE)),
                                            "IT_PERIOD" =>date('m',strtotime($orderDetGet->STH_TRANS_DATE)),
                                            "IT_ORDER_TYP" =>'OB',
                                            "IT_ORDER_PFX" =>'OB',
                                            "IT_ORDER_NO" =>$orderDetGet->STH_ORDER_NO,
                                            "IT_ORDER_LN" =>null,
                                            "IT_TRANS_QTY" =>$orderDetGet->STD_TRANS_QTY,
                                            "IT_UNIT_COST" =>$orderDetGet->STD_UNIT_COST,
                                            "IT_UOM" =>$orderDetGet->I_UOM_CODE,
                                            "IT_REFERENCE" =>'Opening Balance',
                                            "IT_UOM_STOCK" =>$orderDetGet->I_UOM_CODE,
                                            "IT_ITEM_DESC1" =>$orderDetGet->I_DESC,
                                            "IT_ITEM_DESC2" =>$orderDetGet->I_EXTEND_DESC,
                                            "IT_WHSE_DESC" =>$whseDetFrom->WHSE_DESC,
                                            "IT_CRE_BY" =>$userCon->USERNAME,
                                            "IT_CRE_DATE" =>$curDateTime,
                    );
                    $this->CI->unicon->insertUniversal('INV_TRANS',$invTransArr);
                }
            }elseif ($orderDet[0]->STH_TRANS_RSN == 202) {
                foreach ($orderDet as $orderDetGet) {
                    $whseDetFrom = wherehouseDetail(array('where'=>"WHERE WHSE_CODE ='{$orderDetGet->STH_FROM_WHSE}'",'dataType'=>'row'));
                    //FROM
                    $invTransArr = array(
                                            "IT_BUS_UNIT" =>$orderDetGet->STH_BUS_UNIT,
                                            "IT_WHSE" =>$whseDetFrom->WHSE_CODE,
                                            "IT_ITEM" =>$orderDetGet->I_CODE,
                                            "IT_TRANS_DATE" =>$orderDetGet->STH_TRANS_DATE,
                                            "IT_YEAR" =>date('Y',strtotime($orderDetGet->STH_TRANS_DATE)),
                                            "IT_PERIOD" =>date('m',strtotime($orderDetGet->STH_TRANS_DATE)),
                                            "IT_ORDER_TYP" =>'VR',
                                            "IT_ORDER_PFX" =>'VR',
                                            "IT_ORDER_NO" =>$orderDetGet->STH_ORDER_NO,
                                            "IT_ORDER_LN" =>null,
                                            "IT_TRANS_QTY" =>-$orderDetGet->STD_TRANS_QTY,
                                            "IT_UNIT_COST" =>$orderDetGet->STD_UNIT_COST,
                                            "IT_UOM" =>$orderDetGet->I_UOM_CODE,
                                            "IT_REFERENCE" =>'Vendor Return',
                                            "IT_UOM_STOCK" =>$orderDetGet->I_UOM_CODE,
                                            "IT_ITEM_DESC1" =>$orderDetGet->I_DESC,
                                            "IT_ITEM_DESC2" =>$orderDetGet->I_EXTEND_DESC,
                                            "IT_WHSE_DESC" =>$whseDetFrom->WHSE_DESC,
                                            "IT_CRE_BY" =>$userCon->USERNAME,
                                            "IT_CRE_DATE" =>$curDateTime,
                    );
                    $this->CI->unicon->insertUniversal('INV_TRANS',$invTransArr);
                }
            }elseif ($orderDet[0]->STH_TRANS_RSN == 204) {
                foreach ($orderDet as $orderDetGet) {

                    $whseDetFrom = wherehouseDetail(array('where'=>"WHERE WHSE_CODE ='{$orderDetGet->STH_FROM_WHSE}'",'dataType'=>'row'));
                    
                    $invTransArr = array(
                                            "IT_BUS_UNIT" =>$orderDetGet->STH_BUS_UNIT,
                                            "IT_WHSE" =>$whseDetFrom->WHSE_CODE,
                                            "IT_ITEM" =>$orderDetGet->I_CODE,
                                            "IT_TRANS_DATE" =>$orderDetGet->STH_TRANS_DATE,
                                            "IT_YEAR" =>date('Y',strtotime($orderDetGet->STH_TRANS_DATE)),
                                            "IT_PERIOD" =>date('m',strtotime($orderDetGet->STH_TRANS_DATE)),
                                            "IT_ORDER_TYP" =>'ID',
                                            "IT_ORDER_PFX" =>'ID',
                                            "IT_ORDER_NO" =>$orderDetGet->STH_ORDER_NO,
                                            "IT_ORDER_LN" =>null,
                                            "IT_TRANS_QTY" =>$orderDetGet->STD_TRANS_QTY,
                                            "IT_UNIT_COST" =>$orderDetGet->STD_UNIT_COST,
                                            "IT_UOM" =>$orderDetGet->I_UOM_CODE,
                                            "IT_REFERENCE" =>'Increase and Decrease',
                                            "IT_UOM_STOCK" =>$orderDetGet->I_UOM_CODE,
                                            "IT_ITEM_DESC1" =>$orderDetGet->I_DESC,
                                            "IT_ITEM_DESC2" =>$orderDetGet->I_EXTEND_DESC,
                                            "IT_WHSE_DESC" =>$whseDetFrom->WHSE_DESC,
                                            "IT_CRE_BY" =>$userCon->USERNAME,
                                            "IT_CRE_DATE" =>$curDateTime,
                    );

                    if ($orderDetGet->STD_TRANS_RULE == '002') {
                        $invTransArr['IT_TRANS_QTY'] = $orderDetGet->STD_TRANS_QTY;
                    }elseif ($orderDetGet->STD_TRANS_RULE == '003') {
                        $invTransArr['IT_TRANS_QTY'] = -$orderDetGet->STD_TRANS_QTY;
                    }
                    $this->CI->unicon->insertUniversal('INV_TRANS',$invTransArr);
                }
            }
        }
    }

    public function venWalletPur($data = array()){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        $purDet = purchaseOrderHeaderDet($data->temp_id,"row");

        $venWallet = array(
                                "VW_WHSE_CODE" =>'01',
                                "VW_PARTIES_CODE" =>$purDet->POH_VENDOR_CODE,
                                "VW_CREDIT_AMT" =>$purDet->POH_GRAND_TOTAL,
                                "VW_INC_PREFIX" =>$purDet->POH_PREFIX,
                                "VW_INC_NO" =>$purDet->POH_ORDER_ID,
                                "VW_INC_TEMP_ID" =>$purDet->POH_TEMP_ORDER_ID,
                                "VW_DATE" =>$purDet->POH_ORDER_DATE,
                                "VW_CRE_BY" =>$userCon->USERNAME,
                                "VW_CRE_DATE" =>$curDateTime,
                            );
        $this->CI->unicon->insertUniversal('VENDOR_WALLET',$venWallet);
    }

    public function venWalletVouch($data = array()){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        $data = $this->CI->unicon->CoreQuery("SELECT * FROM PAYMENT_VOCHER WHERE PV_ORDER_NO = '{$data->vouch_no}'","row");
        $venWallet = array(
                                "VW_WHSE_CODE" =>'01',
                                "VW_PARTIES_CODE" =>$data->PV_PARTIES_CODE,
                                "VW_DEBIT_AMT" =>$data->PV_AMT,
                                "VW_INC_PREFIX" =>'VH',
                                "VW_INC_NO" =>$data->PV_ORDER_NO,
                                "VW_INC_TEMP_ID" =>$data->PV_ORDER_NO,
                                "VW_DATE" =>$data->PV_DATE,
                                "VW_CRE_BY" =>$userCon->USERNAME,
                                "VW_CRE_DATE" =>$curDateTime,
                            );
        $this->CI->unicon->insertUniversal('VENDOR_WALLET',$venWallet);
    }
}