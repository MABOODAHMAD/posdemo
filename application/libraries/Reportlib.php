<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportlib{

    protected $CI;

    public function __construct() {
            // reference to the CodeIgniter super object
        $this->CI =& get_instance();
        $this->CI->load->model('Universal_model','unicon');
    }
    public function stockStatus($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        $query = null;
        if ($data->itemCodeFrom != 'All' && $data->itemCodeTo != 'All') {
            $query .= "AND I_CODE BETWEEN '{$data->itemCodeFrom}' AND '{$data->itemCodeTo}' ";
        }else{
            if($data->itemCodeFrom != 'All'){
                $query .= "AND I_CODE = '{$data->itemCodeFrom}' ";
            }elseif($data->itemCodeTo != 'All'){
                $query .= "AND I_CODE = '{$data->itemCodeTo}' ";
            }
        }

        if ($data->reportType == 'CON') {
            $query .= "AND VEN_I_CODE = '0489' ";
        }
         
        $stockDet = $this->CI->unicon->CoreQuery("SELECT *,SUM(IT_TRANS_QTY) AVL_QTY
                                                    FROM INV_TRANS,ITEMS,ITEM_CATEGORY,VENDOR
                                                    WHERE IT_ITEM = I_CODE
                                                    AND I_CAT_CODE = ICAT_CODE
                                                    AND VEN_CODE = V_CODE
                                                    AND ICAT_CODE BETWEEN '{$data->fromCat}' AND '{$data->toCat}'
                                                    AND IT_WHSE LIKE '{$data->whseCode}%'
                                                    $query
                                                    GROUP BY IT_ITEM HAVING SUM(IT_TRANS_QTY)>0 $offset","$data->dataType");
        return $stockDet;
    }

    public function dailySaleReport($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        $saleDet = $this->CI->unicon->CoreQuery("SELECT *
                                                    FROM SALE_HEADER,CUSTOMER,EMPLOYEE
                                                    WHERE SH_CUST_ID = CUST_CODE
                                                    AND SH_SALESMAN_ID = EMP_CODE
                                                    AND SH_ORDER_DATE BETWEEN '{$data->fromDate}' AND '{$data->toDate}'
                                                    AND SH_WHSE_CODE = '{$data->whseCode}' $offset","$data->dataType");

        $payDet = $this->CI->unicon->CoreQuery("SELECT *,SUM(PD_AMOUNT) TOT_AMT
                                                    FROM SALE_HEADER,PAYMENT_DETAIL,PAY_METHODS
                                                    WHERE PM_CODE = PD_PAY_METHOD_ID
                                                    AND SH_ORDER_ID = PD_ORDER_ID
                                                    AND SH_ORDER_DATE BETWEEN '{$data->fromDate}' AND '{$data->toDate}'
                                                    AND SH_WHSE_CODE = '{$data->whseCode}' 
                                                    AND PD_TYPE = 'SALE' GROUP BY PD_PAY_METHOD_ID","result");                                            
        return (object)array('get_sale_data' =>$saleDet,'get_pay_Data'=>$payDet);
    }

    public function itemStockWithPic($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        
        if(isset($data->whseCode) && isset($data->vCode)){
            $query = "AND IT_WHSE = '{$data->whseCode}' AND VEN_CODE = '{$data->vCode}'";
        }
        if(isset($data->itemClass)){
            if(!empty($data->itemClass)){
                $query .= " AND I_CAT_CODE = '{$data->itemClass}'";
            }
        }
        $sql_str = "SELECT *,SUM(IT_TRANS_QTY) AVL_QTY
                    FROM INV_TRANS,ITEMS,ITEM_CATEGORY,VENDOR,CURRENCY,ITEM_CLASSES
                    WHERE IT_ITEM = I_CODE
                    AND I_CAT_CODE = ICAT_CODE
                    AND V_CODE = VEN_CODE
                    AND V_CURR_CODE = CUR_CODE
                    AND I_CLASS_CODE = IC_CODE
                    AND IC_ITEM_CAT = I_CAT_CODE
                    $query GROUP BY IT_ITEM HAVING SUM(IT_TRANS_QTY)>0 $offset";
        // echo $sql_str;
        $stockDet = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        return $stockDet;
    }
    public function stkByVenPri($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        
        if(isset($data->dateIn) && isset($data->vCode)){
            $query = "AND IT_TRANS_DATE <= '{$data->dateIn}' AND VEN_CODE = '{$data->vCode}'";
        }elseif(isset($data->whseCode)){
            $query = "AND IT_WHSE LIKE '{$data->whseCode}%'";
        }
        if(isset($data->itemCat)){

        }
        $stockDet = $this->CI->unicon->CoreQuery("SELECT *,SUM(IT_TRANS_QTY) AVL_QTY
                                                    FROM INV_TRANS,ITEMS,ITEM_CATEGORY,VENDOR,CURRENCY
                                                    WHERE IT_ITEM = I_CODE
                                                    AND I_CAT_CODE = ICAT_CODE
                                                    AND V_CODE = VEN_CODE
                                                    AND V_CURR_CODE = CUR_CODE
                                                    $query GROUP BY IT_ITEM $offset","$data->dataType");
        return $stockDet;
    }

    public function trailBalance($data = array()){
        if($data->fromLevel == 1){
            $colName = "AH_MAIN_HEAD";
        }elseif($data->fromLevel == 2){
            $colName = "AH_SUB_HEAD";
        }elseif($data->fromLevel == 3){
            $colName = "AH_GENERAL";
        }elseif($data->fromLevel == 4){
            $colName = "AH_SUBSIDERY";
        }
        $yearCal = substr($data->fromPeriod,0,2) == '01'?$data->finaclYear-1:$data->finaclYear;
        $monCal = substr($data->fromPeriod,0,2) == '01'?'12':str_pad(substr($data->fromPeriod,0,2)-1, 2, "0", STR_PAD_LEFT);
        
        $fromAccRecNo = accHeadDet(array('where'=>"WHERE AH_MAIN_HEAD = '{$data->fromAcc}' OR AH_SUB_HEAD = '{$data->fromAcc}' OR AH_GENERAL = '{$data->fromAcc}' OR AH_SUBSIDERY = '{$data->fromAcc}'",'dataType'=>'row'));
        $toAccRecNo = accHeadDet(array('where'=>"WHERE AH_MAIN_HEAD = '{$data->toAcc}' OR AH_SUB_HEAD = '{$data->toAcc}' OR AH_GENERAL = '{$data->toAcc}' OR AH_SUBSIDERY = '{$data->toAcc}'",'dataType'=>'row'));

        $totMainHead = accHeadDet(array('where'=>"WHERE AH_RECNO BETWEEN '{$fromAccRecNo->AH_RECNO}' AND '{$toAccRecNo->AH_RECNO}' GROUP BY $colName",'dataType'=>'result'));
        $accountArr = array();
        foreach ($totMainHead as $totMainHeadGet) {
            $openBal = accOpenBal((object)array(
                                                    "accNo" =>$totMainHeadGet->$colName,
                                                    "accLevel"=>$data->fromLevel,
                                                    "postType" =>$data->postType,
                                                    "lastCloseDate" =>$monCal.'-'.$yearCal,
                                                    "costCenter" =>$data->costCenter,
                                                    "busUnit" =>111,
                                                    "dataType" => 'row'
                                                ));
            $transBal = accTransBal((object)array(
                                                    "accNo" =>$totMainHeadGet->$colName,
                                                    "accLevel"=>$data->fromLevel,
                                                    "postType" =>$data->postType,
                                                    "fromPeriod" =>substr($data->fromPeriod,0,2),
                                                    "toPeriod" =>substr($data->toPeriod,0,2),
                                                    "finacYear" =>$data->finaclYear,
                                                    "costCenter" =>$data->costCenter,
                                                    "accCont" =>true,
                                                    "busUnit" =>111,
                                                    "dataType" => 'row'
                                                ));
            $obCredit = $openBal?$openBal->CREDIT:0;
            $obdebit = $openBal?$openBal->DEBIT:0;
            $trCredit = $transBal?$transBal->CREDIT:0;
            $trDebit = $transBal?$transBal->DEBIT:0;
            $calBal = ($obdebit-$obCredit)+($trDebit-$trCredit);
            if($calBal>0){
                $calBalCredit = 0;
                $calBaldebit = $calBal;
            }else{
                $calBaldebit = 0;
                $calBalCredit = abs($calBal);
            }
            $accountArr[] = (object)array(
                                    'account_no' => $totMainHeadGet->$colName,
                                    'level_name_en' => $totMainHeadGet->EN_Title,
                                    'level_name_ar' => $totMainHeadGet->AR_Title,
                                    'open_bal_credit'=> $openBal?$openBal->CREDIT:0,
                                    'open_bal_debit'=> $openBal?$openBal->DEBIT:0,
                                    'trans_bal_credit'=> $transBal?$transBal->CREDIT:0,
                                    'trans_bal_debit'=> $transBal?$transBal->DEBIT:0,
                                    'bal_credit' =>$calBalCredit,
                                    'bal_debit' =>$calBaldebit,
                                ); 
        }
        // $stockDet = $this->CI->unicon->CoreQuery("SELECT *,SUM(IT_TRANS_QTY) AVL_QTY
        //                                             FROM INV_TRANS,ITEMS,ITEM_CATEGORY,VENDOR,CURRENCY
        //                                             WHERE IT_ITEM = I_CODE
        //                                             AND I_CAT_CODE = ICAT_CODE
        //                                             AND V_CODE = VEN_CODE
        //                                             AND V_CURR_CODE = CUR_CODE
        //                                             $query GROUP BY IT_ITEM $offset","$data->dataType");
        return $accountArr;
    }

    public function manualInvTrans($data = array()){
    
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        
        $query = "AND STH_TRANS_DATE BETWEEN '{$data->dateFrom}' AND '{$data->dateTo}'";
        $query .= " AND STH_FROM_WHSE = '{$data->whseFrom}' AND STH_WHSE_TO = '{$data->whseTo}'";
        $query .= " AND STH_TRANS_RSN = '{$data->reason}'";
        
        if(isset($data->rule)){
            if(!empty($data->rule)){
                $query .= " AND STD_TRANS_RULE = '{$data->rule}'";
            }
        }
        if(isset($data->itemCat)){
            if(!empty($data->itemCat)){
                $query .= " AND ICAT_CODE = '{$data->itemCat}'";
            }
        }
        if($data->repType == 's'){
            $grpBy = "GROUP BY STH_ORDER_NO";
        }elseif($data->repType == 'd'){
            $grpBy = null;
        }else{
            $grpBy = null;
        }

        if($data->vCode){
            $query .= " AND V_CODE = '{$data->vCode}'";
        }
        $sql_str = "SELECT *
                    FROM STOCK_TRANSFER_HEADER,STOCK_TRANSFER_DETAIL,ITEMS,ITEM_CATEGORY,VENDOR
                    WHERE STH_ORDER_NO = STD_ORDER_NO
                    AND STD_ITEM_CODE = I_CODE
                    AND ICAT_CODE = I_CAT_CODE
                    AND V_CODE = VEN_CODE
                    AND STH_STATUS = 'RECEIVED'
                    $query $grpBy $offset";
        // echo $sql_str;
        $stockDet = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        return $stockDet;
    }

    public function vendorStockReport($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        $query = '';
        if (!empty($data->dateIn)) {
           $query .= "AND IT_TRANS_DATE <= '{$data->dateIn}' ";
        }
        if (!empty($data->vCode)) {
            $query .= "AND V_CODE = '{$data->vCode}' ";
         }
         if (!empty($data->curCode)) {
            $query .= "AND V_CURR_CODE = '{$data->curCode}' ";
         }
         if (!empty($data->whseCode)) {
            $query .= "AND IT_WHSE = '{$data->whseCode}' ";
         }
         if (!empty($data->itemCatCode)) {
            $query .= "AND I_CAT_CODE = '{$data->itemCatCode}' ";
         }
         if (!empty($data->itemClsCode)) {
            $query .= "AND I_CLASS_CODE = '{$data->itemClsCode}' ";
         }
         if (!empty($data->itemCode)) {
            $query .= "AND I_CODE = '{$data->itemCode}' ";
         }
         if(isset($data->grpBy)){
            $groupBy = "GROUP BY {$data->grpBy}";
         }else{
            $groupBy = "GROUP BY V_CODE";
         }
         $sql_str = "SELECT *,SUM(IT_TRANS_QTY) AVL_QTY,SUM(IT_TRANS_QTY*I_VEN_PRICE) TOT_VALUE
                        FROM INV_TRANS,ITEMS,ITEM_CATEGORY,VENDOR,ITEM_CLASSES
                        WHERE IT_ITEM = I_CODE
                        AND I_CAT_CODE = ICAT_CODE
                        AND V_CODE = VEN_CODE
                        AND I_CLASS_CODE = IC_CODE
                        AND IC_ITEM_CAT = I_CAT_CODE
                        $query $groupBy HAVING SUM(IT_TRANS_QTY)>0 $offset";
        // echo $sql_str;

        $stockDet = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        return $stockDet;
    }

    public function stockStatusDate($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        $query = '';
        if (!empty($data->dateIn)) {
           $query .= "AND IT_TRANS_DATE <= '{$data->dateIn}' ";
        }
            
         if (!empty($data->whseFrom) && !empty($data->whseTo)) {
            $query .= "AND WHSE_CODE BETWEEN '{$data->whseFrom}' AND '{$data->whseTo}' ";
         }else{
            if(!empty($data->whseFrom)){
                $query .= "AND WHSE_CODE = '{$data->whseFrom}' ";
            }elseif(!empty($data->whseTo)){
                $query .= "AND WHSE_CODE = '{$data->whseTo}' ";
            }
         }
         if ($data->itemCodeFrom != 'All' && $data->itemCodeTo != 'All') {
            $query .= "AND I_CODE BETWEEN '{$data->itemCodeFrom}' AND '{$data->itemCodeTo}' ";
         }else{
            if($data->itemCodeFrom != 'All'){
                $query .= "AND I_CODE = '{$data->itemCodeFrom}' ";
            }elseif($data->itemCodeTo != 'All'){
                $query .= "AND I_CODE = '{$data->itemCodeTo}' ";
            }
         }
         if ($data->itemCatCodeFrom != 'All' && $data->itemCatCodeTo != 'All') {
            $query .= "AND ICAT_CODE BETWEEN '{$data->itemCatCodeFrom}' AND '{$data->itemCatCodeTo}' ";
         }else{
            if($data->itemCatCodeFrom != 'All'){
                $query .= "AND ICAT_CODE = '{$data->itemCatCodeFrom}' ";
            }elseif($data->itemCatCodeTo != 'All'){
                $query .= "AND ICAT_CODE = '{$data->itemCatCodeTo}' ";
            }
         }
         if ($data->itemClsFrom != 'All' && $data->itemClsTo != 'All') {
            $query .= "AND ICAT_CODE BETWEEN '{$data->itemClsFrom}' AND '{$data->itemClsTo}' ";
         }else{
            if($data->itemClsFrom != 'All'){
                $query .= "AND ICAT_CODE = '{$data->itemClsFrom}' ";
            }elseif($data->itemClsTo != 'All'){
                $query .= "AND ICAT_CODE = '{$data->itemClsTo}' ";
            }
         }
         if(isset($data->grpBy)){
            $groupBy = "GROUP BY {$data->grpBy}";
         }else{
            $groupBy = "GROUP BY V_CODE";
         }
         $sql_str = "SELECT *,SUM(IT_TRANS_QTY) AVL_QTY
                        FROM INV_TRANS,ITEMS,ITEM_CATEGORY,VENDOR,CURRENCY,WHAREHOUSE,ITEM_CLASSES
                        WHERE IT_ITEM = I_CODE
                        AND I_CAT_CODE = ICAT_CODE
                        AND V_CODE = VEN_CODE
                        AND V_CURR_CODE = CUR_CODE
                        AND IT_WHSE = WHSE_CODE
                        AND I_CLASS_CODE = IC_CODE
                        AND IC_ITEM_CAT = I_CAT_CODE
                        $query $groupBy HAVING SUM(IT_TRANS_QTY)>0 $offset";
        echo $sql_str;

        $stockDet = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        return $stockDet;
    }

    public function yearSaleCompMon($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        
       
        $sql_str = "SELECT *,SUM(SH_GRAND_TOT) TOT_REVENUE
                    FROM SALE_HEADER
                    WHERE DATE_FORMAT(SH_ORDER_DATE,'%Y') = '{$data->year}'
                    AND DATE_FORMAT(SH_ORDER_DATE,'%m') = '".substr($data->month,0,2)."' $offset";
        // echo $sql_str;
        $detail = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        return $detail;
    }

    public function venPurByDate($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        $query = $grpBy = null;
        if(!empty($data->itemCat)){
            $query .= "AND I_CAT_CODE = '$data->itemCat' ";
        }
        if (!empty($data->ItemCls)) {
            $query .= "AND I_CLASS_CODE = '$data->ItemCls' ";
        }
        if (!empty($data->ItemCode)) {
            $query .= "AND I_CODE = '$data->ItemCode' ";
        }
        if (isset($data->grpBy)) {
            $grpBy = "GROUP BY {$data->grpBy}";
        }
        $sql_str = "SELECT *,SUM(POH_GRAND_TOTAL) GRAND_TOT,SUM(POH_TOT_QTY) TOT_QTY,SUM(POD_ITEM_QTY) SUB_QTY,SUM(POD_UNIT_COST*POD_ITEM_QTY) SUB_TOT
                    FROM PO_HEADER,PO_DETAILS,ITEMS
                    WHERE POH_TEMP_ORDER_ID = POD_TEMP_ORDER_ID
                    AND POD_ITEM_CODE = I_CODE
                    AND POH_STATUS = 'CLOSE'
                    AND POH_ORDER_DATE BETWEEN '{$data->fromDate}' AND '{$data->toDate}'
                    AND POH_VENDOR_CODE = '{$data->vCode}'
                    $query
                    $grpBy
                    $offset";
        // echo $sql_str;
        $detail = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        return $detail;
    }

    public function customMiscCharge($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        $query = $grpBy = null;
        if (isset($data->grpBy)) {
            $grpBy = "GROUP BY {$data->grpBy}";
        }
        if (!empty($data->chargeType)) {
            $query .= "AND PODC_PO_CHARGE_CODE = '$data->chargeType' ";
        }
        $sql_str = "SELECT *
                    FROM PO_DETAILS_CHARGES,PO_CHARGES
                    WHERE PODC_PO_CHARGE_CODE= CHRG_TYPE
                    AND DATE_FORMAT(PODC_CRE_DATE,'%Y-%m') = '{$data->yearAndPeriod}'
                    AND PODC_TYPE = 'BUYER'
                    $query
                    $grpBy
                    $offset";
        // echo $sql_str;
        $detail = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        return $detail;
    }

    public function payAccList($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        $query = $grpBy = null;
        if (isset($data->grpBy)) {
            $grpBy = "GROUP BY {$data->grpBy}";
        }
        if (isset($data->vCodefrom) && isset($data->vCodeTo)) {
            $query .= "AND V_CODE BETWEEN '{$data->vCodefrom}' AND '{$data->vCodeTo}'";
        }else{
            $query .= "AND V_CODE = '{$data->vCode}'";
        }
        $sql_str = "SELECT *,DATE_ADD(POH_ORDER_DATE, INTERVAL TERM_DUE_DAYS DAY) due_date
                    FROM PO_HEADER,TERMS,VENDOR,CURRENCY
                    WHERE POH_TERMS_CODE = TERM_CODE
                    AND POH_VENDOR_CODE = V_CODE
                    AND CUR_CODE = V_CURR_CODE
                    AND DATE_ADD(POH_ORDER_DATE, INTERVAL TERM_DUE_DAYS DAY) BETWEEN '{$data->dataDueFrom}' AND '{$data->dataDueTo}'
                    $query
                    $grpBy
                    $offset";
        // echo $sql_str;
        $detail = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        return $detail;
    }

    public function venOpBal($data = array()){
        if(isset($data->date)){
            $query = "VW_DATE <= '{$data->date}'";
        }else{
            $query = "VW_DATE < '{$data->fromDate}'";
        }
        $totAmt = $this->CI->unicon->CoreQuery("SELECT SUM(VW_CREDIT_AMT-VW_DEBIT_AMT) TOT_AMT 
                                                FROM VENDOR_WALLET
                                                WHERE $query
                                                AND VW_PARTIES_CODE = '{$data->vCode}'","row");

        return $totAmt->TOT_AMT?$totAmt->TOT_AMT:0;
    }

    public function custOpBal($data = array()){
        if(isset($data->date)){
            $query = "DATE_FORMAT(W_CRE_DATE,'%Y-%m-%d') <= '{$data->date}'";
        }else{
            $query = "DATE_FORMAT(W_CRE_DATE,'%Y-%m-%d') < '{$data->fromDate}'";
        }
        $totAmt = $this->CI->unicon->CoreQuery("SELECT SUM(W_DEBIT_AMT-W_CREDIT_AMT) TOT_AMT 
                                                FROM WALLET
                                                WHERE $query
                                                AND W_PARTIES_CODE = '{$data->custCode}'","row");
        return $totAmt->TOT_AMT?$totAmt->TOT_AMT:0;
    }

    public function custTrailBal($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        $query = $grpBy = null;
        if (isset($data->grpBy)) {
            $grpBy = "GROUP BY {$data->grpBy}";
        }

        $sql_str = "SELECT SUM(W_DEBIT_AMT) TOT_DEBIT,SUM(W_CREDIT_AMT) TOT_CREDIT,DATE_FORMAT(W_CRE_DATE,'%Y-%m-%d') V_DATE
                    FROM WALLET
                    WHERE DATE_FORMAT(W_CRE_DATE,'%Y-%m') BETWEEN '{$data->fromDate}' AND '{$data->toDate}'
                    AND W_PARTIES_CODE = '{$data->custCode}'
                    $grpBy
                    $offset";
        // echo $sql_str;
        $detail = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        if(!empty($detail->TOT_DEBIT) && !empty($detail->TOT_CREDIT) && !empty($detail->V_DATE)){
            return $detail;

        }else{
            return false;

        }
    }

    public function custState($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        $query = $grpBy = null;
        if (isset($data->grpBy)) {
            $grpBy = "GROUP BY {$data->grpBy}";
        }

        $sql_str = "SELECT *,DATE_FORMAT(W_CRE_DATE,'%Y-%m-%d') V_DATE
                    FROM WALLET
                    WHERE DATE_FORMAT(W_CRE_DATE,'%Y-%m-%d') BETWEEN '{$data->fromDate}' AND '{$data->toDate}'
                    AND W_PARTIES_CODE = '{$data->custCode}'
                    $grpBy
                    $offset";
        // echo $sql_str;
        $detail = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        return $detail;
    }

    public function venState($data = array()){
        $offset = isset($data->limit)?"LIMIT {$data->limit} OFFSET {$data->offset}":null;
        $query = $grpBy = null;
        if (isset($data->grpBy)) {
            $grpBy = "GROUP BY {$data->grpBy}";
        }

        $sql_str = "SELECT *
                    FROM VENDOR_WALLET
                    WHERE VW_DATE BETWEEN '{$data->fromDate}' AND '{$data->toDate}'
                    AND VW_PARTIES_CODE = '{$data->vCode}'
                    $grpBy
                    $offset";
        // echo $sql_str;
        $detail = $this->CI->unicon->CoreQuery($sql_str,"$data->dataType");
        return $detail;
    }
}
?>