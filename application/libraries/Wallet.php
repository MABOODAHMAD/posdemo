<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wallet{

    protected $CI;

    public function __construct() {
            // reference to the CodeIgniter super object
        $this->CI =& get_instance();
        $this->CI->load->model('Universal_model','unicon');
    }

    public function saleCreditWallet($orderId){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        $headDet = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
        if($headDet){
            $invTransArr = array(
                "W_WHSE_CODE" =>$headDet->SH_WHSE_CODE,
                "W_PARTIES_CODE" =>$headDet->SH_CUST_ID,
                "W_INC_PREFIX" =>$headDet->SH_INV_PREFIX,
                "W_INC_NO" =>$headDet->SH_INV_NO,
                "W_INC_TEMP_ID" =>$headDet->SH_ORDER_ID,
                // "W_DEBIT_AMT" =>$headDet->SH_WHSE_CODE,
                "W_DEBIT_AMT" =>$headDet->SH_GRAND_TOT,
                "W_CRE_BY" =>$userCon->USERNAME,
                "W_CRE_DATE" =>$curDateTime,
            );

            $this->CI->unicon->insertUniversal('WALLET',$invTransArr);
        }else{
            return false;
        }        
    }

    public function payIn($data = array()){
        $curDateTime = dateTime();
        $userCon = sessionUserData();
        $vochDet = $this->CI->unicon->CoreQuery("SELECT * FROM PAYMENT_VOCHER WHERE PV_ORDER_PRE = '{$data->orderPre}' AND PV_ORDER_NO = '{$data->orderNo}'","row");
        if($vochDet){
            $invTransArr = array(
                "W_WHSE_CODE" =>$vochDet->PV_WHSE_CODE,
                "W_PARTIES_CODE" =>$vochDet->PV_PARTIES_CODE,
                "W_INC_PREFIX" =>$vochDet->PV_ORDER_PRE,
                "W_INC_NO" =>$vochDet->PV_ORDER_NO,
                "W_INC_TEMP_ID" =>$vochDet->PV_BATCH_CODE,
                // "W_DEBIT_AMT" =>$vochDet->SH_WHSE_CODE,
                // "W_DEBIT_AMT" =>$vochDet->SH_GRAND_TOT,
                "W_CRE_BY" =>$userCon->USERNAME,
                "W_CRE_DATE" =>$curDateTime,
            );

            if(substr($vochDet->PV_ORDER_PRE,0,1) == 'D'){
                $invTransArr['W_DEBIT_AMT'] = $vochDet->PV_AMT;
            }elseif(substr($vochDet->PV_ORDER_PRE,0,1) == 'P'){
                $invTransArr['W_CREDIT_AMT'] = $vochDet->PV_AMT;
            }else{
                $invTransArr['W_CREDIT_AMT'] = $vochDet->PV_AMT;
            }

            $this->CI->unicon->insertUniversal('WALLET',$invTransArr);
        }else{
            return false;
        }        
    }
}