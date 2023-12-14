<?php
class Inputsearch extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // $this->load->model('Site_model', 'dbcon');
        $this->load->model('Universal_model', 'unicon');
        // $this->load->library('form_validation');
        // $this->load->helper('form');
        //$this->load->model('QrController','qrcon');
    }

    /*================================ GET PAY MATHOD DETAIL BY CODE ==============================*/
    
    public function getPayMethod()
    {
        $data = $data1 = array();

        $searchType = $this->input->get('searchtype');
        $venCode = $this->input->get('term');

        $venLists = $this->unicon->CoreQuery("SELECT PM_CODE CODE_F,PM_DESC DESC_F FROM PAY_METHODS 
                                                    WHERE PM_CODE LIKE '%$venCode%' 
                                                    OR PM_DESC LIKE '%$venCode%'", $searchType == 'list' ? "result" : "row");
        if ($searchType == 'list') {
            foreach ($venLists as $venList) {
                $data['id'] = $venList->CODE_F;
                $data["value"] = $venList->CODE_F . '-' . $venList->DESC_F;
                $data1[] = $data;
            }

            $json = json_encode($data1);
            echo $this->input->get('callback') . "({$json})";
        } else {
            $venBalDet = vendorBalDetail(["venCode" => $venCode, "dataType" => "row"]);
            // print_r($venBalDet);
            echo json_encode([
                "vend_det" => $venLists,
                "vend_outstanding_amt" => $venBalDet->OUTSTANDING_AMT ? $venBalDet->OUTSTANDING_AMT : 0
            ]);
        }

    }

    /*================================ GET ACCOUNT DETAIL BY NO AND TITLE ==============================*/
    
    public function getAccDet()
    {
        $data = $data1 = array();

        $searchType = $this->input->get('searchtype');
        $getArgument = $this->input->get('term');

        $FetchData = accHeadDet(['where'=>"WHERE AH_SUBSIDERY LIKE '%$getArgument%' OR EN_Title LIKE '%$getArgument%' OR AR_Title LIKE '%$getArgument%'",'dataType'=>$searchType == 'list' ? "result" : "row"]);

        if ($searchType == 'list') {
            foreach ($FetchData as $fetchLoop) {
                $data['id'] = $fetchLoop->AH_SUBSIDERY;
                $data["value"] = $fetchLoop->AH_SUBSIDERY . '-' . $fetchLoop->EN_Title. '-' . $fetchLoop->AR_Title;
                $data1[] = $data;
            }

            $json = json_encode($data1);
            echo $this->input->get('callback') . "({$json})";
        } else {
            // print_r($venBalDet);
            echo json_encode([
                "data_fetch" => $FetchData
            ]);
        }

    }

    /*================================ GET VENDOR DETAIL BY VENDOR CODE WITH TOTAL PAYMENT PENDING ==============================*/
    
    public function getVenDelByVenCodeGet(){
        $data = $data1 = array();

        $searchType = $this->input->get('searchtype');
        $venCode = $this->input->get('term');

        $venLists = $this->unicon->CoreQuery("SELECT * FROM VENDOR,CURRENCY 
                                                WHERE V_CURR_CODE = CUR_CODE AND (V_CODE LIKE '%$venCode%' 
                                                OR V_NAME LIKE '%$venCode%'
                                                OR V_NAME_AR LIKE '%$venCode%')",$searchType == 'list'?"result":"row");
        if ($searchType == 'list') {
            foreach ($venLists as $venList) {
                $data['id'] = $venList->V_CODE;
                $data["value"] =  $venList->V_CODE.'-'.$venList->V_NAME.'-'.$venList->V_NAME_AR;
                $data1[] = $data;
             }

            $json = json_encode($data1);
            echo $this->input->get('callback')."({$json})";
        }else{
        $venBalDet = vendorBalDetail(["venCode"=>$venCode,"dataType"=>"row"]);
        // print_r($venBalDet);
            echo json_encode([
                                "vend_det" => $venLists,
                                "vend_outstanding_amt"=>$venBalDet->OUTSTANDING_AMT?$venBalDet->OUTSTANDING_AMT:0]);
                                // "vend_outstanding_amt"=>$venBalDet]);
        }

    }

     /*================================ GET CUSTOMER DETAIL BY CUSTOMER CODE WITH TOTAL PAYMENT PENDING ==============================*/

    public function getCusDelByCustCodeGet(){
        $data = $data1 = array();

        $searchType = $this->input->get('searchtype');
        $whseWise = $this->input->get('whse_code');
        if(isset($whseWise)){
            $whseWise = "AND (CUST_WHSE_CODE = '$whseWise')";
        }else{
            $whseWise = NULL;
        }
        $custCode = $this->input->get('term');

        $custLists = $this->unicon->CoreQuery("SELECT * FROM CUSTOMER 
                                                WHERE (CUST_CODE LIKE '%$custCode%' 
                                                OR CUST_NAME LIKE '%$custCode%'
                                                OR CUST_NAME_AR LIKE '%$custCode%') $whseWise",$searchType == 'list'?"result":"row");
        if ($searchType == 'list') {
            foreach ($custLists as $custList) {
                $data['id'] = $custList->CUST_CODE;
                $data["value"] =  $custList->CUST_CODE.'-'.$custList->CUST_NAME.'-'.$custList->CUST_NAME_AR;
                $data1[] = $data;
             }

            $json = json_encode($data1);
            echo $this->input->get('callback')."({$json})";
        }else{
        // $venBalDet = custBalDetail(["custCode"=>$custCode,"dataType"=>"row"]);
        $venBalDet = custBalAmt($custCode);
        // print_r($venBalDet);
            echo json_encode([
                                "vend_det" => $custLists,
                                // "vend_outstanding_amt"=>$venBalDet->OUTSTANDING_AMT?$venBalDet->OUTSTANDING_AMT:0]);
                                "vend_outstanding_amt"=>$venBalDet]);
        }

    }

    public function getRoleAssigByCode(){
        $data = $data1 = array();

        $searchType = $this->input->get('searchtype');
        $custCode = $this->input->get('term');

        $custLists = $this->unicon->CoreQuery("SELECT * FROM ROLE_GROUP 
                                                WHERE RG_NAME LIKE '%$custCode%' AND RG_STATUS = 'Y'",$searchType == 'list'?"result":"row");
        if ($searchType == 'list') {
            foreach ($custLists as $custList) {
                $data['id'] = $custList->RG_NAME;
                $data["value"] =  $custList->RG_NAME;
                $data1[] = $data;
             }

            $json = json_encode($data1);
            echo $this->input->get('callback')."({$json})";
        }else{
        // print_r($venBalDet);
            echo json_encode(["vend_det" => $custLists]);
        }

    }
}

?>