<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Export extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("PHPExcel");
        // $this->load->model('Universal_model','unicon');
    }

    public function index(){

        $object = new PHPExcel();
        
        $object->setActiveSheetIndex(0);

        $table_columns = array("Name", "Address", "Gender", "Designation", "Age");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $employee_data = array(
            (object) array('name' => 'Usman ahmad', 'address' => 'Kanpur', 'gender' => 'M', 'designation' => 'Software Engineer', 'age' => '25', ),
            (object) array('name' => 'Usman ahmad', 'address' => 'Kanpur', 'gender' => 'M', 'designation' => 'Software Engineer', 'age' => '25', ),
            (object) array('name' => 'Usman ahmad', 'address' => 'Kanpur', 'gender' => 'M', 'designation' => 'Software Engineer', 'age' => '25', ),
            (object) array('name' => 'Usman ahmad', 'address' => 'Kanpur', 'gender' => 'M', 'designation' => 'Software Engineer', 'age' => '25', ),
        );

        $excel_row = 2;

        foreach ($employee_data as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->address);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->gender);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->designation);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->age);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Employee Data.xlsx"');
        $object_writer->save('php://output');

    }
    public function action()
    {
        $this->load->library("PHPExcel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("Name", "Address", "Gender", "Designation", "Age");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $employee_data = array(
            (object) array('name' => 'Usman ahmad', 'address' => 'Kanpur', 'gender' => 'M', 'designation' => 'Software Engineer', 'age' => '25', ),
            (object) array('name' => 'Usman ahmad', 'address' => 'Kanpur', 'gender' => 'M', 'designation' => 'Software Engineer', 'age' => '25', ),
            (object) array('name' => 'Usman ahmad', 'address' => 'Kanpur', 'gender' => 'M', 'designation' => 'Software Engineer', 'age' => '25', ),
            (object) array('name' => 'Usman ahmad', 'address' => 'Kanpur', 'gender' => 'M', 'designation' => 'Software Engineer', 'age' => '25', ),
        );

        $excel_row = 2;

        foreach ($employee_data as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->name);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->address);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->gender);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->designation);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->age);
            $excel_row++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Employee Data.xls"');
        $object_writer->save('php://output');
    }

    public function saleOrderGL(){

        $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;
        $headerDet = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
        $GLDet = $this->unicon->CoreQuery("SELECT * FROM GL_APPL_TRANS 
                                            WHERE GLAT_ORDER_TEMP ='{$headerDet->SH_ORDER_ID}' 
                                            AND GLAT_INVOICE_NO = '{$headerDet->SH_INV_NO}'
                                            AND GLAT_INVOICE_PFX = '{$headerDet->SH_INV_PREFIX}'","result");
        $fileName = $headerDet->SH_INV_PREFIX.'-'.$headerDet->SH_INV_NO;
        // print_r($GLDet);
        if(count($GLDet)>0){
            $object = new PHPExcel();

            $object->setActiveSheetIndex(0);

            $table_columns = array('GLAT_REF_NO','GLAT_BUS_UNIT','GLAT_ACCOUNT_DESC','GLAT_APPL','GLAT_ACCT_LVL1','GLAT_ACCT_LVL2','GLAT_YEAR','GLAT_PERIOD','GLAT_DEBIT_AMT','GLAT_CREDIT_AMT','GLAT_CURRENCY','GLAT_EXCHANGE_DATE','GLAT_EXCHANGE_RATE','GLAT_POSTED','GLAT_JOURNAL_REF','GLAT_DESC','GLAT_INVOICE_PFX','GLAT_INVOICE_NO','GLAT_ORDER_TEMP','GLAT_WHSE','GLAT_WHSE_DESC','GLAT_ITEM','GLAT_ITEM_DESC1','GLAT_ITEM_DESC2','GLAT_SOLDTO_CUST','GLAT_SOLDTO_NAME1','GLAT_SOLDTO_NAME2','GLAT_CRE_BY','GLAT_CRE_DATE');

            $column = 0;

            foreach ($table_columns as $field) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
                $column++;
            }
            


            $excel_row = 2;

            foreach ($GLDet as $row) {
                $column = 0;
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_REF_NO);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_BUS_UNIT);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_ACCOUNT_DESC);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_APPL);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_ACCT_LVL1);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_ACCT_LVL2);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_YEAR);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_PERIOD);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_DEBIT_AMT);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_CREDIT_AMT);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_CURRENCY);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_EXCHANGE_DATE);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_EXCHANGE_RATE);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_POSTED);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_JOURNAL_REF);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_DESC);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_INVOICE_PFX);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_INVOICE_NO);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_ORDER_TEMP);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_WHSE);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_WHSE_DESC);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_ITEM);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_ITEM_DESC1);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_ITEM_DESC2);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_SOLDTO_CUST);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_SOLDTO_NAME1);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_SOLDTO_NAME2);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_CRE_BY);
                $object->getActiveSheet()->setCellValueByColumnAndRow($column++, $excel_row, $row->GLAT_CRE_DATE);
                $excel_row++;
            }

            $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$fileName.'.xlsx"');
            $object_writer->save('php://output');
            $this->session->set_flashdata(['all_ret'=>"<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                                <i class='mdi mdi-block-helper me-2'></i>
                                                                GL TRANS ENTRY EXPORT SUCCESSFULLY. ORDER I'D = $headerDet->SH_ORDER_PREFIX-$headerDet->SH_ORDER_NO
                                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                            </div>"]);
            redirect(base_url('SaleInvoiceList'),'refresh');
        }else{
            $this->session->set_flashdata(['all_ret'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                <i class='mdi mdi-block-helper me-2'></i>
                                                                GL TRANS ENTRY NOT CREATED. ORDER I'D = $headerDet->SH_ORDER_PREFIX-$headerDet->SH_ORDER_NO
                                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                            </div>"]);
            redirect(base_url('SaleInvoiceList'),'refresh');
        }
    }

}