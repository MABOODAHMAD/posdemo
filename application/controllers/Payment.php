<?php
class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        sessionCheck();
        $this->load->model('Universal_model', 'unicon');
    }

    public function addSalePayment(){
        $userCon = sessionUserData();
        header('Content-Type: application/json');

        $payMethId = $this->input->post('PD_PAY_METHOD_ID');
        $payAmt = $this->input->post('PD_AMOUNT');
        for ($iPoChrge = 0; $iPoChrge < count($payMethId); $iPoChrge++) {
            $getPoChareRow = $this->unicon->CoreQuery("SELECT * FROM PO_CHARGES WHERE CHRG_TYPE='{$payMethId[$iPoChrge]}'", "num_rows");
            if ($getPoChareRow > 0 && $payAmt[$iPoChrge] > 0) {
                $payDetailChargeData = [
                    "PD_REF_ID" => 'PAY-' . random_strings(10, 'AN'),
                    "PD_ORDER_ID" => $this->input->post('order_id_db'),
                    "PD_PAY_METHOD_ID" => $payMethId[$iPoChrge],
                    "PD_AMOUNT" => $payAmt[$iPoChrge],
                    "PD_TYPE" => "SALE",
                    "PD_STATUS" => "RECEIVED",
                    "PD_PARTIES_ID" => $this->input->post('SH_CUST_ID'),
                    "PD_CRE_BY" => $userCon->USERNAME,
                ];

                $this->unicon->insertUniversal('PAYMENT_DETAIL', $payDetailChargeData);
            }

        }
        $url = "<script>location.reload();</script>";
        echo json_encode(array("multi" => "false", "err" => "true", "msg" => "Data Inserted Successfully".$url));
    }
}