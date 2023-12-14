<?php
class Autocomplete extends CI_Controller
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

    public function getPayMethod()
    {
        $data = $data1 = array();

        $searchType = $this->input->get('searchtype');
        $venCode = $this->input->get('term');

        $venLists = $this->unicon->CoreQuery("SELECT PM_CODE CODE_F,PM_DESC_F DESC FROM PAY_METHODS 
                                                    WHERE PM_CODE LIKE '%$venCode%' 
                                                    OR PM_DESC LIKE '%$venCode%'", $searchType == 'list' ? "result" : "row");
        if ($searchType == 'list') {
            foreach ($venLists as $venList) {
                $data['id'] = $venList->CODE_F;
                $data["value"] = $venList->CODE_F . '-' . $venList->PM_DESC_F;
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
}

?>