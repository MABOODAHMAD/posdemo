<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if(!function_exists('numberSystem'))
{
    function numberSystem($number,$type=1){
        $CI =get_instance();
        $CI->load->library('session');
        $sessionData = $CI->session->userdata();
        $CI->load->model('universal_model');
            // $data =  $CI->universal_model->CoreQuery("SELECT * FROM USERS WHERE ID='{$sessionData['userId']}'","row");
        if ($type == 1) {
            $formatting = number_format($number,4,'.',',');
        }elseif($type == 2){
            $formatting = number_format($number,0,'.',',');
        }else{
            $formatting = number_format($number,2,'.',',');
        }
        
        return $formatting;
    }
}

if(!function_exists('sessionUserData'))
{
    function sessionUserData(){
        $CI =get_instance();
        $CI->load->library('session');
        $sessionData = $CI->session->userdata();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM USERS WHERE ID='{$sessionData['userId']}'","row");
        
        return $data;
    }
}

if(!function_exists('dateTime'))
{
    function dateTime(){
        $CI =get_instance();
        $CI->load->library('Commonlib');
        $data =  $CI->commonlib->currentSetting();
        date_default_timezone_set($data->SS_TIME_ZONE);
        return date('Y-m-d H:i:s');
    }
}

if(!function_exists('systemVat'))
{
    function systemVat(){
        $CI =get_instance();
        $CI->load->library('Commonlib');
        $data =  $CI->commonlib->system(1);
        $vat = $data->SS_VAT;
        return $vat;
    }
}

if(!function_exists('defaultBusUnit'))
{
    function defaultBusUnit(){
        $CI =get_instance();
        $CI->load->library('Commonlib');
        $data =  $CI->commonlib->system(1);
        $default = $data->SS_BUS_UNIT;
        return $default;
    }
}

if(!function_exists('delete_cache'))
{
    function delete_cache($uri_string=null){
        $CI =& get_instance();
        $path = $CI->config->item('cache_path');
        $path = rtrim($path, DIRECTORY_SEPARATOR);

        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

        $uri =  $CI->config->item('base_url').
                $CI->config->item('index_page').
                $uri_string;

        $cache_path .= md5($uri);

        return unlink($cache_path);
    }
}

if(!function_exists('headerTitle'))
{
    function headerTitle(){
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['REQUEST_URI'];

        $fullURL = $protocol . "://" . $host . $path;

        headerTitleCon($fullURL,'SaleView','Sale View');
        headerTitleCon($fullURL,'SaleOrderList','Sale Order List');
        headerTitleCon($fullURL,'SaleAdd','Sale Add');
        headerTitleCon($fullURL,'SaleInvoiceList','Sale Invoice List');
        headerTitleCon($fullURL,'SaleReturnList','Sale Return List');
        headerTitleCon($fullURL,'aleReturnView','Sale Return View ');
        headerTitleCon($fullURL,'glTransSale','GL transaction');
        headerTitleCon($fullURL,'systemGlEntry','Post sale journal to G/L');
        headerTitleCon($fullURL,'dailySaleReport','Daily Sale Report');
        headerTitleCon($fullURL,'PurchaseOrderList','Purchase Order List');
        headerTitleCon($fullURL,'PurchaseAdd','Purchase Add');
        headerTitleCon($fullURL,'landingCost','Landed Cost');
        headerTitleCon($fullURL,'purchaseView','Purchase View');
        headerTitleCon($fullURL,'PriceChangerView','Price Changer List');
        headerTitleCon($fullURL,'PriceChangerAdd','Price Changer View');
    }
}

if(!function_exists('headerTitleCon'))
{
    function headerTitleCon($fullURL,$urlFilter,$title){
        
        if (strpos($fullURL, $urlFilter)) {
            echo $title;
        }else{
            return null;
        }
    }
}

if(!function_exists('headerTitleCon'))
{
    function headerTitleCon(){
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['REQUEST_URI'];

        $fullURL = $protocol . "://" . $host . $path;

        $getHeader = explode($fullURL,'SaleView');
        if ($getHeader[0] == 'SaleView') {
            return "Sale View";
        }
        
        return 'df';
    }
}

if(!function_exists('userRoleSidePanel'))
{
    function userRoleSidePanel($type,$allow=''){
        //$allow value VIEW,ADD,UPDATE 
        //$type Value rep,pro,pur,inv,hsn,cat,sale,brnd,exp
        $CI =get_instance();
        $CI->load->library('session');
        $sessionData = $CI->session->userdata();
        $CI->load->model('universal_model');
        if($allow === 'ADD'){$allow = ",SUBSTRING_INDEX(SUBSTRING_INDEX(ar.allowed, ',',1), ',',-1) as allow";
        }elseif ($allow === 'VIEW') { $allow = ",SUBSTRING_INDEX(SUBSTRING_INDEX(ar.allowed, ',',2), ',',-1) as allow";
        }elseif ($allow === 'UPDATE') { $allow = ",SUBSTRING_INDEX(SUBSTRING_INDEX(ar.allowed, ',',3), ',',-1) as allow"; }
            $data =  $CI->universal_model->CoreQuery("SELECT *$allow FROM staff as s JOIN assign_role as ar ON ar.emp_id=s.id  WHERE s.emp_email='{$sessionData['username']}' AND ar.reqst='$type'","row");
        return $data;
    }
}

if(!function_exists('sessionCheck'))
{
    function sessionCheck($con='dash'){
        $CI =get_instance();
        $CI->load->library('session');
        $sessionData = $CI->session->userdata();
        
        if($con == 'dash'){

            if(!isset($sessionData['login'])){
                redirect(base_url(), 'refresh');
            }
        }
        if($con == 'login'){
            if(isset($sessionData['login'])){
                redirect(base_url('dashboard'), 'refresh');
            }
        }
        
    }
}

if(!function_exists('datatableSqlData'))
{
    function datatableSqlData($sqlQueryTemp)
    {
        // $data = array();

        $data['SELECT'] = $sqlQueryTemp['SELECT'];
        $data['FROM'] = $sqlQueryTemp['FROM'];
        $data['JOIN_1_CONTROL'] = isset($sqlQueryTemp['JOIN_1_CONTROL'])?$sqlQueryTemp['JOIN_1_CONTROL']:FALSE; // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['JOIN_2_CONTROL'] = isset($sqlQueryTemp['JOIN_2_CONTROL'])?$sqlQueryTemp['JOIN_2_CONTROL']:FALSE; // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['JOIN_3_CONTROL'] = isset($sqlQueryTemp['JOIN_3_CONTROL'])?$sqlQueryTemp['JOIN_3_CONTROL']:FALSE; // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['JOIN_4_CONTROL'] = isset($sqlQueryTemp['JOIN_4_CONTROL'])?$sqlQueryTemp['JOIN_4_CONTROL']:FALSE; // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['JOIN_5_CONTROL'] = isset($sqlQueryTemp['JOIN_5_CONTROL'])?$sqlQueryTemp['JOIN_5_CONTROL']:FALSE; // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['WHERE_1_CONTROL'] = isset($sqlQueryTemp['WHERE_1_CONTROL'])?$sqlQueryTemp['WHERE_1_CONTROL']:FALSE; // TABLE WHERE CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['WHERE_2_CONTROL'] = isset($sqlQueryTemp['WHERE_2_CONTROL'])?$sqlQueryTemp['WHERE_2_CONTROL']:FALSE; // TABLE WHERE CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['WHERE_3_CONTROL'] = isset($sqlQueryTemp['WHERE_3_CONTROL'])?$sqlQueryTemp['WHERE_3_CONTROL']:FALSE; // TABLE WHERE CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['CORE_WHERE_1_CONTROL'] = isset($sqlQueryTemp['CORE_WHERE_1_CONTROL'])?$sqlQueryTemp['CORE_WHERE_1_CONTROL']:FALSE; // TABLE CORE WHERE CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['CORE_WHERE_2_CONTROL'] = isset($sqlQueryTemp['CORE_WHERE_2_CONTROL'])?$sqlQueryTemp['CORE_WHERE_2_CONTROL']:FALSE; // TABLE CORE WHERE CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['CORE_WHERE_3_CONTROL'] = isset($sqlQueryTemp['CORE_WHERE_3_CONTROL'])?$sqlQueryTemp['CORE_WHERE_3_CONTROL']:FALSE; // TABLE CORE WHERE CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['WHERE_IN_1_CONTROL'] = isset($sqlQueryTemp['WHERE_IN_1_CONTROL'])?$sqlQueryTemp['WHERE_IN_1_CONTROL']:FALSE; // TABLE WHERE CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['GROUP_1_CONTROL'] = isset($sqlQueryTemp['GROUP_1_CONTROL'])?$sqlQueryTemp['GROUP_1_CONTROL']:FALSE; // TABLE GROUP CONTROL TRUE ENABLE AND FALSE DISABLE
        $data['HAVING_1_CONTROL'] = isset($sqlQueryTemp['HAVING_1_CONTROL'])?$sqlQueryTemp['HAVING_1_CONTROL']:FALSE; // TABLE HAVING CONTROL TRUE ENABLE AND FALSE DISABLE
            
        //JOIN 1
            if($data['JOIN_1_CONTROL']){

                $data["JOIN_1_TABLE_NAME"]=$sqlQueryTemp['JOIN_1_TABLE_NAME'];
                $data["JOIN_1_TABLE_CONN"]=$sqlQueryTemp['JOIN_1_TABLE_CONN'];

            }
        //JOIN 2
            if($data['JOIN_2_CONTROL']){

                $data["JOIN_2_TABLE_NAME"]=$sqlQueryTemp['JOIN_2_TABLE_NAME'];
                $data["JOIN_2_TABLE_CONN"]=$sqlQueryTemp['JOIN_2_TABLE_CONN'];

            }
        //JOIN 3
            if($data['JOIN_3_CONTROL']){

                $data["JOIN_3_TABLE_NAME"]=$sqlQueryTemp['JOIN_3_TABLE_NAME'];
                $data["JOIN_3_TABLE_CONN"]=$sqlQueryTemp['JOIN_3_TABLE_CONN'];

            }
         //JOIN 3
            if($data['JOIN_4_CONTROL']){

                $data["JOIN_4_TABLE_NAME"]=$sqlQueryTemp['JOIN_4_TABLE_NAME'];
                $data["JOIN_4_TABLE_CONN"]=$sqlQueryTemp['JOIN_4_TABLE_CONN'];

            }
        //JOIN 5
            if($data['JOIN_5_CONTROL']){

                $data["JOIN_5_TABLE_NAME"]=$sqlQueryTemp['JOIN_5_TABLE_NAME'];
                $data["JOIN_5_TABLE_CONN"]=$sqlQueryTemp['JOIN_5_TABLE_CONN'];

            }
        //WHERE CLAUSE 1
            if($data['WHERE_1_CONTROL']){

                $data["WHERE_1_COL_NAME"]=$sqlQueryTemp['WHERE_1_COL_NAME'];
                $data["WHERE_1_DATA"]=$sqlQueryTemp['WHERE_1_DATA'];

            }
        //WHERE CLAUSE 2
            if($data['WHERE_2_CONTROL']){

                $data["WHERE_2_COL_NAME"]=$sqlQueryTemp['WHERE_2_COL_NAME'];
                $data["WHERE_2_DATA"]=$sqlQueryTemp['WHERE_2_DATA'];

            }
        //WHERE CLAUSE 3
            if($data['WHERE_3_CONTROL']){

                $data["WHERE_3_COL_NAME"]=$sqlQueryTemp['WHERE_3_COL_NAME'];
                $data["WHERE_3_DATA"]=$sqlQueryTemp['WHERE_3_DATA'];

            }
        //CORE WHERE CLAUSE 1
            if($data['CORE_WHERE_1_CONTROL']){

                $data["CORE_WHERE_1_DATA"]=$sqlQueryTemp['CORE_WHERE_1_DATA'];

            }
        //CORE WHERE CLAUSE 2
            if($data['CORE_WHERE_2_CONTROL']){

                $data["CORE_WHERE_2_DATA"]=$sqlQueryTemp['CORE_WHERE_2_DATA'];

            }
        //CORE WHERE CLAUSE 3
            if($data['CORE_WHERE_3_CONTROL']){

                $data["CORE_WHERE_3_DATA"]=$sqlQueryTemp['CORE_WHERE_3_DATA'];

            }
        //WHERE_IN CLAUSE 1
            if($data['WHERE_IN_1_CONTROL']){

                $data["WHERE_IN_1_COL_NAME"]=$sqlQueryTemp['WHERE_IN_1_COL_NAME'];
                $data["WHERE_IN_1_DATA"]=$sqlQueryTemp['WHERE_IN_1_DATA'];

            }
        //WHERE_IN CLAUSE 1
            if($data['GROUP_1_CONTROL']){

                $data["GROUP_1_DATA"]=$sqlQueryTemp['GROUP_1_DATA'];

            }

        //HAVING CLAUSE 1
            if($data['HAVING_1_CONTROL']){

                $data["HAVING_1_DATA"]=$sqlQueryTemp['HAVING_1_DATA'];

            }

    return $data;
    }
}

if(!function_exists('insertUniqueCode'))
{
    function insertUniqueCode($colName){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM TABLE_ID_CODE WHERE COL_NAME='$colName'","row");
        return $data->PREFIX.'-'.$data->COUNT;
    }
}

if(!function_exists('currencyExchangeByCurrencyCode'))
{
    function currencyExchangeByCurrencyCode($currCode){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM CURRENCY_EXCHANGE_RATE WHERE EXCHR_CURRENCY='$currCode' ORDER BY EXCHR_ID DESC","row");
        return $data;
    }
}

if(!function_exists('glModuleAccDet'))
{
    function glModuleAccDet($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM GL_MODULE_PROFILE_UP,ACCOUNT_HEADS,COST_CENTER WHERE AH_SUBSIDERY = GLMP_ACCOUNT_NO AND CC_CODE = GLMP_COST_CENTER $where",$data['dataType']);
        return $data;
    }
}

if(!function_exists('glEntryDatail'))
{
    function glEntryDatail($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM GL_JOURNAL_HEADER,GL_JOURNAL_DETAIL,ACCOUNT_HEADS WHERE GLJH_JOURNAL_PFX = GLJL_JOURNAL_PFX AND GLJH_JOURNAL_NO = GLJL_JOURNAL_NO AND GLJL_ACCT_LVL1 = AH_SUBSIDERY $where",$data['dataType']);
        return $data;
    }
}

if(!function_exists('currencyList'))
{
    function currencyList($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM CURRENCY $where","$dataType");
        return $data;
    }
}

if(!function_exists('busUnits'))
{
    function busUnit($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM BUS_UNIT","$dataType");
        return $data;
    }
}

if(!function_exists('costCenter'))
{
    function costCenter($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM COST_CENTER,WHAREHOUSE WHERE CC_WHSE_CODE = WHSE_CODE $where","$dataType");
        return $data;
    }
}

// if(!function_exists('countryList'))
// {
//     function countryList(){
//         $CI =get_instance();
//         $CI->load->model('universal_model');
//             $data =  $CI->universal_model->CoreQuery("SELECT * FROM COUNTRIES","result_array");
//         return $data;
//     }
// }

if(!function_exists('countryList'))
{
    function countryList($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM COUNTRIES $where","$dataType");
        return $data;
    }
}

if(!function_exists('stateList'))
{
    function stateList($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM STATES $where","$dataType");
        return $data;
    }
}

if(!function_exists('citiesList'))
{
    function citiesList($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM CITIES $where","$dataType");
        return $data;
    }
}

if(!function_exists('traitCatList'))
{
    function traitCatList($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $CI->load->model('universal_model');
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM TRAIT_CATEGORY $where","$dataType");
        return $data;
    }

}


if(!function_exists('traitAddList'))
{
    function traitAddList($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $CI->load->model('universal_model');
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM TRAIT_SUB_CATEGORY $where","$dataType");
        return $data;
    }

}


if(!function_exists('paymentList'))
{
    function paymentList($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $CI->load->model('universal_model');
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM PAY_METHODS $where","$dataType");
        return $data;
    }

}

if(!function_exists('frightList'))
{
    function frightList($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $CI->load->model('universal_model');
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM FREIGHTS $where","$dataType");
        return $data;
    }

}

if(!function_exists('fobList'))
{
    function fobList($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $CI->load->model('universal_model');
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM FOBS $where","$dataType");
        return $data;
    }

}

if(!function_exists('termsList'))
{
    function termsList($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $CI->load->model('universal_model');
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM TERMS $where","$dataType");
        return $data;
    }

}

if(!function_exists('shipViaList'))
{
    function shipViaList($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $CI->load->model('universal_model');
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM SHIP_VIA $where","$dataType");
        return $data;
    }

}


if(!function_exists('uomList'))
{
    function uomList($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM UNIT_OF_MEASUREMENT $where","$dataType");
        return $data;
    }
}

if(!function_exists('classList'))
{
    function classList($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM ITEM_CLASSES $where","$dataType");
        return $data;
    }
}

if(!function_exists('categoryList'))
{
    function categoryList($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
        $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
        $data =  $CI->universal_model->CoreQuery("SELECT * FROM ITEM_CATEGORY $where","$dataType");
        return $data;
    }
}

if(!function_exists('vendorList'))
{
    function vendorList($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $dataType = isset($data['dataType'])?$data['dataType']:'result_array';
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM VENDOR 
                                                        JOIN CITIES ON CTY_CODE = CITY_ID 
                                                        JOIN STATES ON ST_CODE = CTY_STATE_CODE 
                                                        JOIN COUNTRIES ON CNTRY_CODE = ST_CNTRY_ID $where","$dataType");
        return $data;
    }
}

if(!function_exists('fYearList'))
{
    function fYearList(){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM FISCAL_YEARS","row");
        return $data;
    }
}

// if(!function_exists('glPrefix'))
// {
//     function glPrefix(){
//         $CI =get_instance();
//         $CI->load->model('universal_model');
//             $data =  $CI->universal_model->CoreQuery("SELECT * FROM GL_PREFIXES","row");
//         return $data;
//     }
// }

if(!function_exists('timeZone'))
{
    function timeZone(){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM TIME_ZONE","result");
        return $data;
    }
}

if(!function_exists('bankDet'))
{
    function bankDet(){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM BANKS","row");
        return $data;
    }
}

if(!function_exists('bankDet'))
{
    function bankDet(){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM BANKS","row");
        return $data;
    }
}
/*================================ EMPLOYEE CATEGORY ==============================*/
if(!function_exists('empCat'))
{
    function empCat(){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM EMP_CATEGORY","result");
        return $data;
    }
}

/*================================ EMPLOYEE DETAIL ==============================*/
if(!function_exists('empdetail'))
{
    function empdetail($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM EMPLOYEE $where",$data['dataType']);
        return $data;
    }
}

/*================================ SALES AREAS ==============================*/
if(!function_exists('salesArea'))
{
    function salesArea(){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM SALES_AREAS","result");
        return $data;
    }
}

if(!function_exists('fiscalPeriodDet'))
{
    function fiscalPeriodDet($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM FISCAL_PERIODS $where","{$data['dataType']}");
        return $data;
    }
}

if(!function_exists('itemList'))
{
    function itemList($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
        $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM ITEMS $where","{$data['dataType']}");
        return $data;
    }
}


if(!function_exists('poPrefixes'))
{
    function poPrefixes($prefixType=null){
        $CI =get_instance();
        $CI->load->model('universal_model');
            if($prefixType){
                $prefixType = "WHERE POP_ORDER_PFX = '$prefixType'";
            }
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM PO_PREFIXES $prefixType","result_array");
        return $data;
    }
}

if(!function_exists('itemGoldDia'))
{
    function itemGoldDia($itemCode){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $gold = $dia = null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM ITEM_TRAITS WHERE ITM_CODE = '$itemCode' AND ITM_TRAIT_CAT_CODE = '15'","result");
            foreach ($data as $getValue) {
                if($getValue->ITM_TRAIT_CODE == '01'){
                    $gold = $getValue->TRT_WEIGHT;
                }elseif($getValue->ITM_TRAIT_CODE == '02'){
                    $dia = $getValue->TRT_WEIGHT;
                }
            }
        return (object)array('gold'=>$gold,'diamond'=>$dia);
    }
}

if(!function_exists('itemDetails'))
{
    function itemDetails($itemCode,$type=null,$venCode=null,$dataType="result_array"){
        $CI =get_instance();
        $CI->load->model('universal_model');
        if($type && $venCode){
            $where = "I_CODE LIKE '%$itemCode%' AND VEN_CODE = '$venCode'";
        }else if($type){
            $where = "I_CODE LIKE '%$itemCode%'";
        }else{
            $where = "I_CODE='$itemCode'";
        }
       
        $data =  $CI->universal_model->CoreQuery("SELECT * 
                                                    FROM ITEMS
                                                    LEFT JOIN ITEM_CATEGORY
                                                    ON ITEM_CATEGORY.ICAT_CODE= ITEMS.I_CAT_CODE
                                                    LEFT JOIN ITEM_CLASSES
                                                    ON ITEM_CLASSES.IC_CODE = ITEMS.I_CLASS_CODE AND ITEM_CLASSES.IC_ITEM_CAT = ITEMS.I_CAT_CODE
                                                    LEFT JOIN COUNTRIES
                                                    ON  COUNTRIES.CNTRY_CODE= ITEMS.I_CNTRY_CODE
                                                    LEFT JOIN ITEM_TRAITS
                                                    ON ITEM_TRAITS.ITM_CODE = ITEMS.I_CODE
                                                    LEFT JOIN TRAIT_CATEGORY
                                                    ON TRAIT_CATEGORY.TC_CODE = ITEM_TRAITS.ITM_TRAIT_CAT_CODE
                                                    LEFT JOIN TRAIT_SUB_CATEGORY
                                                    ON TRAIT_SUB_CATEGORY.TRAIT_SUB_CAT_CODE = ITEM_TRAITS.ITM_TRAIT_CODE  AND TRAIT_SUB_CATEGORY.TRAIT_CAT_ID = ITEM_TRAITS.ITM_TRAIT_CAT_CODE
                                                    LEFT JOIN VENDOR
                                                    ON VENDOR.V_CODE = ITEMS.VEN_CODE
                                                    LEFT JOIN UNIT_OF_MEASUREMENT
                                                    ON UNIT_OF_MEASUREMENT.UOM_CODE = ITEMS.I_UOM_CODE
                                                    WHERE $where
                                                    ORDER BY ITEM_TRAITS.ITM_TRAIT_CODE ASC",$dataType);
        return $data;
    }
}

if(!function_exists('wherehouseDetail'))
{
    function wherehouseDetail($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM WHAREHOUSE $where","{$data['dataType']}");
        return $data;
    }
}





if(!function_exists('busUnitDetail'))
{
    function busUnitDetail($data = array()){
        $CI =get_instance();
        $where = isset($data['where'])?$data['where']:null;
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM BUS_UNIT
                                                        JOIN COUNTRIES
                                                        ON COUNTRIES.CNTRY_CODE= BUS_UNIT.BU_COUNTRY
                                                        JOIN STATES
                                                        ON STATES.ST_CODE = BUS_UNIT.BU_STATE
                                                        JOIN CITIES
                                                        ON CITIES.CTY_CODE = BUS_UNIT. BU_CITY $where","row");
        return $data;
    }
}

if(!function_exists('itemStockDet'))
{
    function itemStockDet($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
        // SUM(WHSE_STK_QTY) AS STOCK_QTY 
            $data =  $CI->universal_model->CoreQuery("SELECT *
                                                        FROM WHAREHOUSE_STOCK 
                                                        WHERE WHSE_STK_WHSE_ID = '{$data['whseId']}' 
                                                        AND WHSE_STK_ITEM_CODE = '{$data['itemCode']}' 
                                                        AND WHSE_STK_STATUS = 'RECEIVED'","result");
        $credit_in = $debit_in = 0;
        foreach ($data as $dataFetch) {
            if($dataFetch->WHSE_STK_TRANS_TYPE == 'CREDIT'){
                $credit_in += $dataFetch->WHSE_STK_QTY;
            }elseif ($dataFetch->WHSE_STK_TRANS_TYPE == 'DEBIT') {
                $debit_in += $dataFetch->WHSE_STK_QTY;
            }
        }

        $data = $credit_in - $debit_in;
        return $data;
    }
}

if(!function_exists('poPrefixDet'))
{
    function poPrefixDet($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM PO_PREFIXES $where","{$data['dataType']}");
        return $data;
    }
}

if(!function_exists('transReason'))
{
    function transReason($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM TRANSFER_REASON $where","{$data['dataType']}");
        return $data;
    }
}

if(!function_exists('vendorCostByItem'))
{
    function vendorCostByItem($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM VENDOR_COST $where","{$data['dataType']}");
        return $data;
    }
}

if(!function_exists('itemUnitCost'))
{
    function itemUnitCost($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM ITEM_COST $where","{$data['dataType']}");
        return $data;
    }
}

if(!function_exists('itemVendorCost'))
{
    function itemVendorCost($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM VENDOR_COST $where","{$data['dataType']}");
        return $data;
    }
}

if(!function_exists('glPrefix'))
{
    function glPrefix($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM GL_PREFIXES $where","{$data['dataType']}");
        return $data;
    }
}

if(!function_exists('poChargeDet'))
{
    function poChargeDet($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM PO_CHARGES $where","{$data['dataType']}");
        return $data;
    }
}

if(!function_exists('transRule'))
{
    function transRule($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM TRANSFER_RULE $where","{$data['dataType']}");
        return $data;
    }
}

if(!function_exists('priceChnagerDetail'))
{
    function priceChnagerDetail($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * 
                                                        FROM PRICE_CHANGER_DETAIL
                                                        JOIN ITEMS
                                                        ON ITEMS.I_CODE = PRICE_CHANGER_DETAIL.PCD_ITEM_CODE
                                                         $where","{$data['dataType']}");
        return $data;
    }
}

if(!function_exists('StockTransferOrderDet'))
{
    function StockTransferOrderDet($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * 
                                                        FROM STOCK_TRANSFER_HEADER 
                                                        JOIN STOCK_TRANSFER_DETAIL
                                                        ON STOCK_TRANSFER_DETAIL.STD_ORDER_NO = STOCK_TRANSFER_HEADER.STH_ORDER_NO
                                                        JOIN TRANSFER_REASON
                                                        ON TRANSFER_REASON.TR_TRANS_RSN = STOCK_TRANSFER_HEADER.STH_TRANS_RSN
                                                        JOIN TRANSFER_RULE
                                                        ON TRANSFER_RULE.TRULE_TRANS_RULE = STOCK_TRANSFER_DETAIL.STD_TRANS_RULE
                                                        JOIN ITEMS
                                                        ON ITEMS.I_CODE = STOCK_TRANSFER_DETAIL.STD_ITEM_CODE
                                                        JOIN ITEM_CATEGORY
                                                        ON ITEM_CATEGORY.ICAT_CODE= ITEMS.I_CAT_CODE
                                                        JOIN ITEM_CLASSES
                                                        ON ITEM_CLASSES.IC_CODE = ITEMS.I_CLASS_CODE AND ITEM_CLASSES.IC_ITEM_CAT = ITEMS.I_CAT_CODE
                                                        JOIN COUNTRIES
                                                        ON  COUNTRIES.CNTRY_CODE= ITEMS.I_CNTRY_CODE
                                                        JOIN VENDOR
                                                        ON VENDOR.V_CODE = ITEMS.VEN_CODE
                                                        JOIN UNIT_OF_MEASUREMENT
                                                        ON UNIT_OF_MEASUREMENT.UOM_CODE = ITEMS.I_UOM_CODE
                                                        $where","{$data['dataType']}");
        return $data;
    }
}

// CUSTOMER TYPE
if(!function_exists('custTypeDet'))
{
    function custTypeDet($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM CUST_TYPE $where","{$data['dataType']}");
        return $data;
    }
}
/*================== ROLE MODULE AND FUNCTION =================*/

if(!function_exists('module'))
{
    function module($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM MODULE_AND_FUNCTION WHERE MAF_STATUS = 'Y' {$data['type']}","result");
        return $data;
    }
}

/*================== ACCOUNT HEADS =================*/

if(!function_exists('accHeadDet'))
{
    function accHeadDet($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM ACCOUNT_HEADS $where",$data['dataType']);
        return $data;
    }
}

/*================== OPENING BALANCE =================*/

if(!function_exists('accOpenBal'))
{
    function accOpenBal($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
            if($data->accLevel == 1){
                $selectHead = "AH_MAIN_HEAD";
                $accLevel = "AND AH_MAIN_HEAD = '{$data->accNo}'";
            }elseif($data->accLevel == 2){
                $selectHead = "AH_SUB_HEAD";
                $accLevel = "AND AH_SUB_HEAD = '{$data->accNo}'";
            }elseif($data->accLevel == 3){
                $selectHead = "AH_GENERAL";
                $accLevel = "AND AH_GENERAL = '{$data->accNo}'";
            }elseif($data->accLevel == 4){
                $selectHead = "AH_SUBSIDERY";
                $accLevel = "AND AH_SUBSIDERY = '{$data->accNo}'";
            }else{
                $accLevel = null;
            }
            if(isset($data->postType)){
                if ($data->postType == '') {
                    $postedCon = null;
                }else{
                    $postedCon = "AND GLJH_JOURNAL_ACTION = '{$data->postType}'";
                }
            }else{
                $postedCon = null;
            }
            if(strlen($data->lastCloseDate) == 7){
                $dateData = "AND DATE_FORMAT(h.GLJH_JOURNAL_DATE, '%m-%Y') = '{$data->lastCloseDate}'"; 
            }else{
                $dateData = "AND h.GLJH_JOURNAL_DATE < '{$data->lastCloseDate}'"; 
            }
            $data =  $CI->universal_model->CoreQuery("SELECT $selectHead headDet,EN_Title,AR_Title,
                                                        sum(l.GLJL_DEBIT_AMT) DEBIT, sum(l.GLJL_CREDIT_AMT) CREDIT
                                                        FROM  GL_JOURNAL_HEADER h, GL_JOURNAL_DETAIL l, ACCOUNT_HEADS a
                                                        WHERE h.GLJH_BUS_UNIT=l.GLJL_BUS_UNIT
                                                        AND h.GLJH_JOURNAL_PFX= l.GLJL_JOURNAL_PFX
                                                        AND h.GLJH_JOURNAL_NO= l.GLJL_JOURNAL_NO
                                                        AND l.GLJL_BUS_UNIT= a.AH_BUS_UNIT
                                                        AND l.GLJL_ACCT_LVL1 = a.AH_SUBSIDERY
                                                        $dateData
                                                        AND l.GLJL_COST_CENTER = '{$data->costCenter}'
                                                        AND h.GLJH_BUS_UNIT = '{$data->busUnit}'
                                                        $accLevel
                                                        $postedCon
                                                        GROUP BY  a.$selectHead,l.GLJL_COST_CENTER",$data->dataType);
        return $data;
    }
}

/*================== TRANSACTION BALANCE =================*/

if(!function_exists('accTransBal'))
{
    function accTransBal($data = array()){
        $CI =get_instance();
        $CI->load->model('universal_model');
 
        if($data->accLevel == 1){
            $selectHead = "AH_MAIN_HEAD";
            $accLevel = "AND AH_MAIN_HEAD = '{$data->accNo}'";
        }elseif($data->accLevel == 2){
            $selectHead = "AH_SUB_HEAD";
            $accLevel = "AND AH_SUB_HEAD = '{$data->accNo}'";
        }elseif($data->accLevel == 3){
            $selectHead = "AH_GENERAL";
            $accLevel = "AND AH_GENERAL = '{$data->accNo}'";
        }elseif($data->accLevel == 4){
            $selectHead = "AH_SUBSIDERY";
            $accLevel = "AND AH_SUBSIDERY = '{$data->accNo}'";
        }else{
            $accLevel = null;
        }
            if(isset($data->postType)){
                if ($data->postType == '') {
                    $postedCon = null;
                }else{
                    $postedCon = "AND GLJH_JOURNAL_ACTION = '{$data->postType}'";
                }
            }else{
                $postedCon = null;
            }
            if(isset($data->accCont)){
                $accDate = "AND GLJH_YEAR = '{$data->finacYear}' AND GLJH_PERIOD BETWEEN '$data->fromPeriod' AND '$data->toPeriod'";
            }
            $data =  $CI->universal_model->CoreQuery("SELECT $selectHead headDet,EN_Title,AR_Title,
                                                        sum(l.GLJL_DEBIT_AMT) DEBIT, sum(l.GLJL_CREDIT_AMT) CREDIT
                                                        FROM  GL_JOURNAL_HEADER h, GL_JOURNAL_DETAIL l, ACCOUNT_HEADS a
                                                        WHERE h.GLJH_BUS_UNIT=l.GLJL_BUS_UNIT
                                                        AND h.GLJH_JOURNAL_PFX= l.GLJL_JOURNAL_PFX
                                                        AND h.GLJH_JOURNAL_NO= l.GLJL_JOURNAL_NO
                                                        AND l.GLJL_BUS_UNIT= a.AH_BUS_UNIT
                                                        AND l.GLJL_ACCT_LVL1 = a.AH_SUBSIDERY
                                                        $accDate
                                                        AND l.GLJL_COST_CENTER = '{$data->costCenter}'
                                                        AND h.GLJH_BUS_UNIT = '{$data->busUnit}'
                                                        $accLevel
                                                        $postedCon
                                                        GROUP BY  a.$selectHead,l.GLJL_COST_CENTER",$data->dataType);
        return $data;
    }
}

/*================================ ACCOUNT ==============================*/
if(!function_exists('cashAccWhseWise'))
{
    function cashAccWhseWise($data = array()){

        $CI =get_instance();
        $CI->load->model('universal_model');
            $where = isset($data['where'])?$data['where']:null;
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM ACCOUNT_HEADS $where",$data['dataType']);
        return $data;
    }
}

/*================================ CUSTOMER WALLET ==============================*/
if(!function_exists('custBalAmt'))
{
    function custBalAmt($custCode){

        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT SUM(W_DEBIT_AMT-W_CREDIT_AMT) BAL_AMT FROM WALLET WHERE W_PARTIES_CODE = '$custCode'",'row');
        if($data->BAL_AMT){
            return $data->BAL_AMT;
        }else{
            return '0';
        }
    }
}

/*================================ PAYMENT IN ORDER UPDATE ==============================*/
if(!function_exists('payInOrderUpdate'))
{
    function payInOrderUpdate($whseCode,$type){

        $CI =get_instance();
        $CI->load->model('universal_model');
            $data =  $CI->universal_model->CoreQuery("SELECT * FROM WHAREHOUSE WHERE WHSE_CODE = '$whseCode'",'row');
            if($type == 'P'){
                $CI->universal_model->CoreQuery("UPDATE WHAREHOUSE SET WHSE_PAYMENT_COUNT = lpad({$data->WHSE_PAYMENT_COUNT},7,0)+ 1 WHERE WHSE_CODE = '$whseCode'");
                return $data->WHSE_PAYMENT_COUNT;
            }elseif ($type == 'C') {
                $CI->universal_model->CoreQuery("UPDATE WHAREHOUSE SET WHSE_CREDIT_MEMO_COUNT = lpad({$data->WHSE_CREDIT_MEMO_COUNT},7,0)+ 1 WHERE WHSE_CODE = '$whseCode'");
                return $data->WHSE_CREDIT_MEMO_COUNT;
            }else{
                $CI->universal_model->CoreQuery("UPDATE WHAREHOUSE SET WHSE_DEBIT_MEMO_COUNT = lpad({$data->WHSE_DEBIT_MEMO_COUNT},7,0)+ 1 WHERE WHSE_CODE = '$whseCode'");
                return $data->WHSE_DEBIT_MEMO_COUNT;
            }
            
    }
}

/*================================ DEFAULT CURRENCY ==============================*/
if(!function_exists('sysCur'))
{
    function sysCur(){
        $CI =get_instance();
        $CI->load->library('Commonlib');
        $data =  $CI->commonlib->currentSetting();
        return $data->SS_CURRENCY;
    }
}

/*================================ ADMIN DASHBOARD ==============================*/
    if(!function_exists('adminDashboard'))
    {
        function adminDashboard($data = array()){
            $CI =get_instance();
            $CI->load->model('universal_model');

            //SALE
                $totSaleInvCount =  $CI->universal_model->CoreQuery("SELECT * FROM SALE_HEADER","num_rows");
                $todaySaleInvCount =  $CI->universal_model->CoreQuery("SELECT * FROM SALE_HEADER WHERE SH_ORDER_DATE = CURDATE()","num_rows");
                $thisMOnthSaleInvCount =  $CI->universal_model->CoreQuery("SELECT * FROM SALE_HEADER WHERE DATE_FORMAT(SH_ORDER_DATE,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m')","num_rows");
            //PURCHASE
                $totPurInvCount =  $CI->universal_model->CoreQuery("SELECT * FROM PO_HEADER","num_rows");
                $todayPurInvCount =  $CI->universal_model->CoreQuery("SELECT * FROM PO_HEADER WHERE POH_ORDER_DATE = CURDATE()","num_rows");
                $thisMOnthPurInvCount =  $CI->universal_model->CoreQuery("SELECT * FROM PO_HEADER WHERE DATE_FORMAT(POH_ORDER_DATE,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m')","num_rows");
            //VENDOR
                $totVendor =  $CI->universal_model->CoreQuery("SELECT * FROM VENDOR","num_rows");
            //CUSTOMER
                $totCustomer =  $CI->universal_model->CoreQuery("SELECT * FROM CUSTOMER","num_rows");
            //ITEM
                $totItem =  $CI->universal_model->CoreQuery("SELECT * FROM ITEMS","num_rows");
            //USER
                $totUser =  $CI->universal_model->CoreQuery("SELECT * FROM USERS","num_rows");
            //SALESMAN
                $totSalesman =  $CI->universal_model->CoreQuery("SELECT * FROM SALES_PERSON","num_rows");
            //EMPLOYEE
                $totEmployee =  $CI->universal_model->CoreQuery("SELECT * FROM EMPLOYEE","num_rows");
            //WAREHOUSE
                $totWhse =  $CI->universal_model->CoreQuery("SELECT * FROM WHAREHOUSE","num_rows");
            //STORE
                $totStore =  $CI->universal_model->CoreQuery("SELECT * FROM WHAREHOUSE WHERE WHSE_LOCATION_TYPE = 'SL'","num_rows");
            //REVENUE
                $totRev =  $CI->universal_model->CoreQuery("SELECT SUM(SH_GRAND_TOT) TOT_REV FROM SALE_HEADER","row");

            //REVENUE GROWTH
                $totLastMonthRev =  $CI->universal_model->CoreQuery("SELECT SUM(SH_GRAND_TOT) TOT_REV FROM SALE_HEADER WHERE DATE_FORMAT(SH_ORDER_DATE,'%Y-%m') = DATE_FORMAT((DATE_SUB(NOW(), INTERVAL 1 MONTH)),'%Y-%m')","row");
                $totCurrMonthRev =  $CI->universal_model->CoreQuery("SELECT SUM(SH_GRAND_TOT) TOT_REV FROM SALE_HEADER WHERE DATE_FORMAT(SH_ORDER_DATE,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m')","row");
                $totCurrMonthRev = $totCurrMonthRev?$totCurrMonthRev->TOT_REV:0;
                $totLastMonthRev = $totLastMonthRev?$totLastMonthRev->TOT_REV:0;
                $revGrouthLastMonth = ($totCurrMonthRev-$totLastMonthRev);
                $revGrouthLastMonth = $totLastMonthRev == 0?0:$revGrouthLastMonth/$totLastMonthRev;
                $revGrouthLastMonth = $revGrouthLastMonth*100;

            //TOTAL PURCHASE
                $totPur =  $CI->universal_model->CoreQuery("SELECT SUM(POH_GRAND_TOTAL) TOT_PUR,EXCHR_BUY_RATE FROM PO_HEADER,CURRENCY_EXCHANGE_RATE WHERE EXCHR_ID = POH_CUR_EXCH_ID","row");
                $totBuyCost =  $CI->universal_model->CoreQuery("SELECT SUM(PODC_PO_CHARGE_AMT) TOT_PUR FROM PO_DETAILS_CHARGES WHERE PODC_TYPE = 'BUYER'","row");
            
            //PURCHASE GROWTH
                $totLastMonthPur =  $CI->universal_model->CoreQuery("SELECT SUM(POH_GRAND_TOTAL) TOT_PUR,EXCHR_BUY_RATE FROM PO_HEADER,CURRENCY_EXCHANGE_RATE WHERE EXCHR_ID = POH_CUR_EXCH_ID AND DATE_FORMAT(POH_ORDER_DATE,'%Y-%m') = DATE_FORMAT((DATE_SUB(NOW(), INTERVAL 1 MONTH)),'%Y-%m')","row");
                $totCurrMonthPur =  $CI->universal_model->CoreQuery("SELECT SUM(POH_GRAND_TOTAL) TOT_PUR,EXCHR_BUY_RATE FROM PO_HEADER,CURRENCY_EXCHANGE_RATE WHERE EXCHR_ID = POH_CUR_EXCH_ID AND DATE_FORMAT(POH_ORDER_DATE,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m')","row");
                $totCurrMonthPur = $totCurrMonthPur?$totCurrMonthPur->TOT_PUR:0;
                $totLastMonthPur = $totLastMonthPur?$totLastMonthPur->TOT_PUR:0;
                $purGrouthLastMonth = ($totCurrMonthPur-$totLastMonthPur);
                $purGrouthLastMonth = $totLastMonthPur == 0?0:$purGrouthLastMonth/$totLastMonthPur;
                $purGrouthLastMonth = $purGrouthLastMonth*100;

            //CREDIT AMOUNT CUSTOMER
                $totCreditAmtCust =  $CI->universal_model->CoreQuery("SELECT SUM(W_DEBIT_AMT-W_CREDIT_AMT) TOT_AMT FROM WALLET","row");

            //CREDIT AMOUNT GROWTH
                $totLastMonthCreditAmt =  $CI->universal_model->CoreQuery("SELECT SUM(W_DEBIT_AMT-W_CREDIT_AMT) TOT_AMT FROM WALLET WHERE DATE_FORMAT(W_CRE_DATE,'%Y-%m') = DATE_FORMAT((DATE_SUB(NOW(), INTERVAL 1 MONTH)),'%Y-%m')","row");
                $totCurrMonthCreditAmt =  $CI->universal_model->CoreQuery("SELECT SUM(W_DEBIT_AMT-W_CREDIT_AMT) TOT_AMT FROM WALLET WHERE DATE_FORMAT(W_CRE_DATE,'%Y-%m') = DATE_FORMAT(CURDATE(),'%Y-%m')","row");
                $totCurrMonthCreditAmt = $totCurrMonthCreditAmt?$totCurrMonthCreditAmt->TOT_AMT:0;
                $totLastMonthCreditAmt = $totLastMonthCreditAmt?$totLastMonthCreditAmt->TOT_AMT:0;
                $creditAmtGrouthLastMonth = ($totCurrMonthCreditAmt-$totLastMonthCreditAmt);
                $creditAmtGrouthLastMonth = $totLastMonthCreditAmt == 0?0:$creditAmtGrouthLastMonth/$totLastMonthCreditAmt;
                $creditAmtGrouthLastMonth = $creditAmtGrouthLastMonth*100;

            //SALE CATEGORY WISE PIE CHART
                $saleCatPieChart =  $CI->universal_model->CoreQuery("SELECT SUM(SD_QTY) TOT_QTY,ICAT_DESC FROM SALE_DETAIL,ITEMS,ITEM_CATEGORY 
                                                                        WHERE SD_ITEM_CODE = I_CODE AND I_CAT_CODE = ICAT_CODE
                                                                        GROUP BY I_CAT_CODE","result");   
            return (object)array(
                                    "totSaleInv" =>$totSaleInvCount?$totSaleInvCount:0,
                                    "todaySaleInv" =>$todaySaleInvCount?$todaySaleInvCount:0,
                                    "thisMonthSaleInv" =>$thisMOnthSaleInvCount?$thisMOnthSaleInvCount:0,

                                    "totPurInv" =>$totPurInvCount?$totPurInvCount:0,
                                    "todayPurInv" =>$todayPurInvCount?$todayPurInvCount:0,
                                    "thisMonthPurInv" =>$thisMOnthPurInvCount?$thisMOnthPurInvCount:0,

                                    "totVendor" =>$totVendor?$totVendor:0,
                                    "totCustomer" =>$totCustomer?$totCustomer:0,

                                    "totItem" =>$totItem?$totItem:0,

                                    "totUser" =>$totUser?$totUser:0,

                                    "totSalesman" =>$totSalesman?$totSalesman:0,

                                    "totEmployee" =>$totEmployee?$totEmployee:0,

                                    "totWhse" =>$totWhse?$totWhse:0,
                                    "totStore" =>$totStore?$totStore:0,

                                    "totRev" =>$totRev?$totRev->TOT_REV:0,
                                    "revGrouthLastMonth" =>$revGrouthLastMonth?number_format($revGrouthLastMonth,2):0,

                                    "totPur" => $totPur?($totPur->EXCHR_BUY_RATE*$totPur->TOT_PUR)+($totBuyCost->TOT_PUR):0,
                                    "purGrouthLastMonth" =>$purGrouthLastMonth?number_format($purGrouthLastMonth,2):0,

                                    "totCreditAmtCust" =>$totCreditAmtCust?$totCreditAmtCust->TOT_AMT:0,
                                    "creditAmtGrouthLastMonth" =>$creditAmtGrouthLastMonth?number_format($creditAmtGrouthLastMonth,2):0,

                                    "totCurrMonthRev" =>$totCurrMonthRev,
                                    "saleCatPieChart" =>$saleCatPieChart?$saleCatPieChart:null,
                                );
        }
    }

if(!function_exists('sweetAlertMsg'))
{
    function sweetAlertMsg(){
        $alertData = [
            "empAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"],  //* EMPLOYEE ADD
            "empUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"],  //* EMPLOYEE UPDATE
            "busAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* BUSINESS UNIT ADD
            "busUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't update","cont"=>"Y"], //* BUSINESS UNIT UPDATE
            "whseAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* WAREHOUSE ADD
            "whseUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't update","cont"=>"Y"], //* WAREHOUSE UPDATE
            "contyAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* COUNTRY ADD
            "contyupdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't POST","cont"=>"Y"], //* COUNTRY Update
            "stateAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* STATE ADD
            "stateupdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't POST","cont"=>"Y"], //* STATE Update
            "cityAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* CITY ADD
            "cityupdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't POST","cont"=>"Y"], //* CITY Update
            "pssGex" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* PASSWORD GENERATE
            "currAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* CURRENCY ADD
            "currUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* CURRENCY UPDATE
            "currExchAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* CURRENCY EXCHANGE ADD
            "UOMAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* UOM ADD 
            "UOMUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* UOM UPDATE
            "itemCatAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* ITEM CATEGORY ADD
            "itemCatUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* ITEM CATEGORY UPDATE
            "itemClassAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* ITEM CLASS ADD
            "itemClassUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* ITEM CLASS UPDATE
            "traitCatAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* TRAIT CATEGORY ADD
            "traitCatUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* TRAIT CATEGORY UPDATE
            "traitAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* TRAIT ADD
            "traitUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* TRAIT UPDATE
            "payMethAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* PAYMENT METHOD ADD
            "payMethUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* PAYMENT METHOD  UPDATE
            "bankUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* BANK DETAIL UPDATE
            "frightAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* FREIGHT ADD
            "frightUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* FREIGHT UPDATE
            "fobAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* FOB ADD
            "fobUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* FOB UPDATE
            "shipAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* SHIP ADD
            "shipUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* SHIP UPDATE
            "termAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* TERMS ADD
            "termUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* TERMS UPDATE
            "POchrgAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* PO CHARGE ADD
            "POchrgUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* PO CHARGE ADD
            "POPrefixAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* PO PREFIX ADD
            "POPrefixUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* PO PREFIX UPDATE
            "finacYearAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* FINANCIAL YEAR ADD
            "finacPeriAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST","cont"=>"Y"], //* FINANCIAL PERIOD ADD
            "finacPeriUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* FINANCIAL PERIOD UPDATE
            "GLPrifAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE","cont"=>"Y"], //* GENERAL LEDGER PREFIX ADD
            "saleAdd" => (object)["msg"=>"Are you sure?Need to Save the Invoice/SAVE/Don't SAVE/SALE INVOICE CREATED/SALE NOT CREATED","cont"=>"Y"], //* SALE ADD
            "saleReturn" => (object)["msg"=>"Are you sure?Need to Return This Invoice./Return/Don't Return/SALE RETURN CREATED/SALE RETURN NOT CREATED","cont"=>"Y"], //* SALE RETURN ADD
            "purchaseAdd" => (object)["msg"=>"Are you sure? Need to save Purchase Order./Save/Don't Saved/PURCHASE INVOICE CREATED/PURCHASE NOT CREATED","cont"=>"Y"], //* PURCHASE ADD
            "itemPriceChangeUp" => (object)["msg"=>"Are you sure? Need to update item price./Update/Don't Update/ITEM PRICE SUCCESSFULLY UPDATED/ITEM PRICE NOT UPDATE","cont"=>"Y"], //* PURCHASE ADD
            "phyInvCountdb" => (object)["msg"=>"Are you sure? Need to create physical inventory count./Create/Don't Create/PHYSICAL INVENTORY COUNT SUCCESSFULLY CRAETED/PHYSICAL INVENOTRY COUNT NOT CRAETED","cont"=>"Y"], //* PHYSICAL INVENTORY COUNT ADD
            "custAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST/CUSTOMER SUCCESSFULLY CREATED/DATA NOT POSTED","cont"=>"Y"], //* CUSTOMER ADD
            "custUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE/CUSTOMER SUCCESSFULLY UPDATED/DATA NOT UPDATE","cont"=>"Y"], //* CUSTOMER UPDATE
            "venAdd" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST/VENDOR SUCCESSFULLY CREATED/DATA NOT POSTED","cont"=>"Y"], //* VENDOR ADD
            "venUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE/VENDOR SUCCESSFULLY UPDATED/DATA NOT UPDATED","cont"=>"Y"], //* VENDOR UPDATE
            "prodAdd" => (object)["msg"=>"Are u Sure ? need to Upload Items?/Upload/Cancel/PRODUCT SUCCESSFULLY CREATED/DATA NOT POSTED","cont"=>"Y"], //* PRODUCT ADD
            "bulkTraitUpload" => (object)["msg"=>"Are u Sure ? need to Upload Items Trait?/Upload/Don't Upload/ITEM TRAIT SUCCESSFULLY CREATED/DATA NOT Uploaded","cont"=>"Y"], //* ITEM TRAIT ADD
            "prodUp" => (object)["msg"=>"Are u Sure? Need to Update Item Data/UPDATE/Don't UPDATE/PRODUCT SUCCESSFULLY UPDATED/DATA NOT SAVED","cont"=>"Y"], //* PRODUCT UPDATE
            "transAdd" => (object)["msg"=>"Are you sure? need to save the transfer Order./SAVE/Don't SAVE/TRANSFER SUCCESSFULLY CREATED/DATA NOT SAVE","cont"=>"Y"], //* TRANSFER ORDER ADD
            "purRev" => (object)["msg"=>"Are you sure? Need to Receive Purchase Order/Receive/Don't Receive/PURCHASE INVOICE SUCCESSFULLY RECEIVED/PURCHASE INVOICE RECEIVE AGAIN","cont"=>"Y"], //* PURCHASE RECEIVED
            "purLandedCostAdd" => (object)["msg"=>"Are you sure? need to distribute the landed cost/Save/Don't Save/LANDED COST SUCCESSFULLY UPDATED/LANDED COST NOT UPDATED","cont"=>"Y"], //* LANDED COST ADD
            "payOutAdd" => (object)["msg"=>"Are you sure?  Need to Save Account Payable Voucher/SAVE/Don't SAVE/PAYMENT SUCCESSFULLY UPDATED/PAYMENT NOT UPDATED","cont"=>"Y"], //* PAYMENT OUT ADD
            "payInAdd" => (object)["msg"=>"Are you sure? Need to Save Account Receivable Voucher/SAVE/Don't SAVE/PAYMENT SUCCESSFULLY UPDATED/PAYMENT NOT UPDATED","cont"=>"Y"], //* PAYMENT IN ADD
            "glEntryAdd" => (object)["msg"=>"Are you sure? Need to Save This GL/SAVE/Don't SAVE/GL ENTRY SUCCESSFULLY SAVE/GL ENTRY NOT SAVE","cont"=>"Y"], //* GL ENTRY ADD
            "glEntryPost" => (object)["msg"=>"Are you sure? Need to UPDATE This GL/UPDATE/Don't UPDATE/GL ENTRY SUCCESSFULLY UPDATE/GL ENTRY NOT UPDATE","cont"=>"Y"], //* GL ENTRY POSTED
            
            "systemUpdate" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./UPDATE/Don't UPDATE/SETTING SUCCESSFULLY UPDATED/DATA NOT UPDATE","cont"=>"Y"], //* CUSTOMER UPDATE

            "systemGlAdd" => (object)["msg"=>"Are you sure? Need to Post Journal to GL/POST/Don't POST/GL SUCCESSFULLY CREATED/DATA NOT POSTED","cont"=>"Y"], //* SYSTEM GL CREATED ADD
            "postGLEntry" => (object)["msg"=>"Are you sure? Your data sent to the server could not be rolled back after you submitted this form./POST/Don't POST/POST GL ENTRY SUCCESSFULLY CREATED/DATA NOT POSTED","cont"=>"Y"], //* POST GL CREATED ADD
            //REPORTING
            "stockStatusOrderByclass" => (object)["msg"=>"Are you sure?You want to print this report/Print/Don't Print/REPORT SUCCESSFULLY PRINTING/DATA NOT PRINT","cont"=>"Y"], //* STOCK STATUS ORDER BY CLASS
            //ACCOUNT
            "accAdd" => (object)["msg"=>"Are you sure? Need to create this Account/SAVE/Don't SAVE/GL SUCCESSFULLY CREATED/DATA NOT SAVE","cont"=>"Y"], //* ADD ACCOUNT

        ];

        return (object)$alertData;
    }
}

// SELECT *,SUBSTRING_INDEX(SUBSTRING_INDEX(ar.allowed, ',',4), ',',-1) as allow FROM staff as s JOIN assign_role as ar ON ar.emp_id=s.id WHERE s.emp_email='usmanahmad.czars+18@gmail.com' AND reqst='sale'
?>