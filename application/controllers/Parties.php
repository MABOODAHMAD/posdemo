<?php
     class Parties extends CI_Controller{
         public function __construct(){
            parent::__construct();
    
            $this->load->model('Universal_model','unicon');
            sessionCheck();
         }

         // Country

        public function vendorAdd(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');

            // ID`, `V_NAME`, ``, ``, ``, `V_EMAIL`, ``, `COMPANY_NAME`, `COMPANY_CONTACT`, `COMPANY_EMAIL`, `BANK_AC`, `BANK_NO`, `IBAN`, `FULL_ADDRESS`, `BUILDING_NO`, `STREET`, `ADDITIONAL_NO`, `OTHER_SELLER_ID`, `COUNTRY`, `POSTAL_CODE`, `VAT_NO`, `UNIT_NO`, `OPENING_BAL`, `CREDIT_LIMIT`, `WALLET`, `ADD_BY`, `C_DATE`

            $contryId = $this->input->post('V_CODE');
            $vc_email = $this->input->post('COMPANY_EMAIL');
            $vc_contact = $this->input->post('V_CONTACT');
            $vendorCodeUp = $this->input->post('vendor_code_db');
            if($contryId && !$vendorCodeUp){
                $this->form_validation->set_rules('V_CODE', 'unique code', 'unique_code_db[VENDOR.V_CODE.Vendor Code already used, Please choose a different one]');
            }
            if($vc_email){
                $this->form_validation->set_rules('COMPANY_EMAIL', 'unique code', 'unique_code_db[VENDOR.COMPANY_EMAIL.Company email already used, Please choose a different one]');
            }
            if($vc_contact){
                $this->form_validation->set_rules('V_CONTACT', 'unique code', 'unique_code_db[VENDOR.V_CONTACT.Contact No already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('V_NAME', 'Vendor Name', 'required');
            $this->form_validation->set_rules('V_NAME_AR', 'Vendor Name Arabic', 'required');
            $this->form_validation->set_rules('COMPANY_CONTACT', 'Company Contact no', 'required|numeric');
            $this->form_validation->set_rules('country_name', 'Country name', 'required');
            $this->form_validation->set_rules('state_name', 'State name', 'required');
            $this->form_validation->set_rules('city_name', 'City name', 'required');
            // $this->form_validation->set_rules('V_POSTAL_CODE_ID', 'Postal code', 'required');
            $this->form_validation->set_rules('currcy_id','currency', 'required');


            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                
                $data = array(
                    
                            // "V_CODE"=>empty($contryId)?insertUniqueCode('V_CODE'):$contryId,
                            "V_NAME"=>$this->input->post('V_NAME'),
                            "V_NAME_AR"=>$this->input->post('V_NAME_AR'),
                            "V_CONTACT"=>$this->input->post('V_CONTACT'),
                            "V_EMAIL"=>$this->input->post('V_EMAIL'),
                            "V_POSTAL_CODE"=>$this->input->post('V_POSTAL_CODE_ID'),
                            "CITY_ID"=>$this->input->post('city_name'),
                            "COMPANY_NAME"=>empty($this->input->post('COMPANY_NAME'))?NULL:$this->input->post('COMPANY_NAME'),
                            "COMPANY_CONTACT"=>empty($this->input->post('COMPANY_CONTACT'))?NULL:$this->input->post('COMPANY_CONTACT'),
                            "COMPANY_EMAIL"=>empty($this->input->post('COMPANY_EMAIL'))?NULL:$this->input->post('COMPANY_EMAIL'),
                            "VAT_NO"=>empty($this->input->post('VAT_NO'))?NULL:$this->input->post('VAT_NO'),
                            "UNIT_NO"=>empty($this->input->post('UNIT_NO'))?NULL:$this->input->post('UNIT_NO'),
                            // "OPENING_BAL"=>empty($this->input->post('OPENING_BAL'))?'0':$this->input->post('OPENING_BAL'),
                            // "CREDIT_LIMIT"=>empty($this->input->post('CREDIT_LIMIT'))?'0':$this->input->post('CREDIT_LIMIT'),
                            "BANK_AC"=>empty($this->input->post('BANK_AC'))?NULL:$this->input->post('BANK_AC'),
                            "BANK_NO"=>empty($this->input->post('BANK_NO'))?NULL:$this->input->post('BANK_NO'),
                            "IBAN"=>empty($this->input->post('IBAN'))?NULL:$this->input->post('IBAN'),
                            "FULL_ADDRESS"=>empty($this->input->post('FULL_ADDRESS'))?NULL:$this->input->post('FULL_ADDRESS'),
                            "BUILDING_NO"=>empty($this->input->post('BUILDING_NO'))?NULL:$this->input->post('BUILDING_NO'),
                            "STREET"=>empty($this->input->post('STREET'))?NULL:$this->input->post('STREET'),
                            "V_CURR_CODE"=>empty($this->input->post('currcy_id'))?NULL:$this->input->post('currcy_id'),
                            "ADDITIONAL_NO"=>empty($this->input->post('ADDITIONAL_NO'))?NULL:$this->input->post('ADDITIONAL_NO'),
                            "V_CRE_BY"=>$userCon->USERNAME,
                        );
                if($vendorCodeUp){
                    if($this->unicon->updateArrayUniversal('VENDOR',$data,"V_CODE = '$vendorCodeUp'")>0){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }else{
                    $data["V_CODE"] = empty($contryId)?insertUniqueCode('V_CODE'):$contryId;
                    if($this->unicon->insertUniversal('VENDOR',$data)){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
                
            }
        }

        public function customeraddDb(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');
           
            $custCode = $this->input->post('CUST_CODE');
            $vc_email = $this->input->post('CUST_E_MAIL1');
            $vc_contact = $this->input->post('CUST_PHONE1');
            $custCodeUp = $this->input->post('cust_code_db');
            if($custCode && !$custCodeUp){
                $this->form_validation->set_rules('CUST_CODE', 'unique code', 'unique_code_db[CUSTOMER.CUST_CODE.Customer Code already used, Please choose a different one]');
            }
            if($vc_email && !$custCodeUp){
                $this->form_validation->set_rules('CUST_E_MAIL1', 'unique code', 'unique_code_db[CUSTOMER.CUST_E_MAIL1.Customer email already used, Please choose a different one]');
            }
            if($vc_contact && !$custCodeUp){
                $this->form_validation->set_rules('CUST_PHONE1', 'unique code', 'unique_code_db[CUSTOMER.CUST_PHONE1.Customer contact no already used, Please choose a different one]');
            }
            // $this->form_validation->set_rules('CUST_NAME', 'Customer Name', 'required|alpha_space');
            // $this->form_validation->set_rules('CUST_E_MAIL1', 'Vendor Name Arabic', 'required');
            $this->form_validation->set_rules('CUST_NAME_AR', 'Customer Name Arabic', 'required');
            $this->form_validation->set_rules('CUST_COUNTRY_ID', 'Country name', 'required');
            $this->form_validation->set_rules('CUST_STATE_ID', 'State name', 'required');
            $this->form_validation->set_rules('CUST_CITY_ID', 'City name', 'required');
            // $this->form_validation->set_rules('CUST_POSTAL_CODE_ID', 'Postal code', 'required');
            $this->form_validation->set_rules('CUST_CUST_TYPE', 'Customer type', 'required');
            $this->form_validation->set_rules('CUST_WHSE_CODE', 'Select warehouse', 'required');


            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                        $data = [
                            // 'CUST_CODE' => empty($custCode)?rand(999999,111111):$custCode,
                            'CUST_NAME' => $this->input->post('CUST_NAME'),
                            'CUST_NAME_AR' => $this->input->post('CUST_NAME_AR'),
                            'CUST_WHSE_CODE' => $this->input->post('CUST_WHSE_CODE'),
                            'CUST_STATUS' => empty($this->input->post('CUST_STATUS'))?'A':$this->input->post('CUST_STATUS'),
                            'CUST_CUST_TYPE' => $this->input->post('CUST_CUST_TYPE'),
                            'CUST_CREDIT_MANAGER' => empty($this->input->post('CUST_CREDIT_MANAGER'))?'DEFLT':$this->input->post('CUST_CREDIT_MANAGER'),
                            'CUST_CREDIT_LIMIT' => empty($this->input->post('CUST_CREDIT_LIMIT'))?0:$this->input->post('CUST_CREDIT_LIMIT'),
                            'CUST_TAX_AUTHORITY' => $this->input->post('CUST_TAX_AUTHORITY'),
                            'CUST_TAX_EXEMPT_ID' => $this->input->post('CUST_TAX_EXEMPT_ID'),
                            'CUST_STR_ADDR1' => $this->input->post('CUST_STR_ADDR1'),
                            'CUST_STR_ADDR2' => $this->input->post('CUST_STR_ADDR2'),
                            'CUST_STR_ADDR3' => $this->input->post('CUST_STR_ADDR3'),
                            'CUST_CITY_ID' => $this->input->post('CUST_CITY_ID'),
                            'CUST_STATE_ID' => $this->input->post('CUST_STATE_ID'),
                            'CUST_POSTAL_CODE_ID' => $this->input->post('CUST_POSTAL_CODE_ID'),
                            'CUST_COUNTRY_ID' => $this->input->post('CUST_COUNTRY_ID'),
                            'CUST_PHONE1' => $this->input->post('CUST_PHONE1'),
                            'CUST_PHONE2' => $this->input->post('CUST_PHONE2'),
                            'CUST_FAX1' => $this->input->post('CUST_FAX1'),
                            'CUST_FAX2' => $this->input->post('CUST_FAX2'),
                            'CUST_E_MAIL1' => $this->input->post('CUST_E_MAIL1'),
                            'CUST_E_MAIL2' => $this->input->post('CUST_E_MAIL2'),
                            'CUST_EDI1' => $this->input->post('CUST_EDI1'),
                            'CUST_EDI2' => $this->input->post('CUST_EDI2'),
                            // 'CUST_DOB' => $this->input->post(''),
                            'CUST_CARD' => $this->input->post('CUST_CARD'),
                            'CUST_ARABIC_SALUTATION' => $this->input->post('CUST_ARABIC_SALUTATION'),
                            'CUST_CRE_BY' => $userCon->USERNAME,
                        ];
                if($custCodeUp){
                    if($this->unicon->updateArrayUniversal('CUSTOMER',$data,"CUST_CODE = '$custCodeUp'")>0){
                        echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Updated Successfully"));
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }else{
                    $data['CUST_CODE'] = empty($custCode)?rand(999999,111111):$custCode;
                    if($this->unicon->insertUniversal('CUSTOMER',$data)){

                        $custRetType = $this->input->post('cust_retuen_type');
                        if($custRetType == 'Q'){
                            echo json_encode(array("multi"=>"false",
                            "err"=>"false",
                            "msg"=>"Customer Successfully Created",
                            "returndata"=>array(
                                                "cust_code_q" =>$data['CUST_CODE']
                                            )));
                        }else{
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                        }
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
                    }
                }
                
            }
        }


        public function customerListJson(){
            $userCon = sessionUserData();
            $filterdata = array(
                "column_order" => array(NULL,'CUST_CODE','CUST_NAME','CUST_STATUS','CUST_PHONE1','CUST_STR_ADDR1','CUST_CUST_TYPE','CUST_WHSE_CODE',NULL),
                "column_search" => array('CUST_CODE','CUST_NAME','CUST_NAME_AR','CUST_STATUS','CUST_PHONE1','CUST_STR_ADDR1','CUST_CUST_TYPE','CUST_WHSE_CODE'),
                "order" => array('ID' => 'desc')
            );
            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'CUSTOMER',

                "JOIN_1_CONTROL"=>FALSE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'CURRENCY as CR',
                    "JOIN_1_TABLE_CONN"=>'CR.CUR_ID=CT.CNTRY_CURRENCY',
            );

            if ($userCon->USER_TYPE == 'SUPERADMIN' || $userCon->USER_TYPE == 'ADMIN') {
                
            }elseif($userCon->USER_TYPE == 'USER'){
                $sqlQueryTemp["CORE_WHERE_1_CONTROL"] = TRUE;  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                $sqlQueryTemp["CORE_WHERE_1_DATA"] = "CUST_CRE_BY = '{$userCon->USERNAME}'";
            }else{
                redirect(base_url('dashboard'),'refresh');
            }

            $sqlQuery = datatableSqlData($sqlQueryTemp);
            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $row[] = $no.".";
                $custCode = dataEncyptbase64($rowdata->CUST_CODE,'encrypt');
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->CUST_CODE;
                $row[] = $rowdata->CUST_NAME.'</br>'.$rowdata->CUST_NAME_AR;
                $row[] = $rowdata->CUST_STATUS;
                $row[] = $rowdata->CUST_PHONE1;
                $row[] = $rowdata->CUST_STR_ADDR1;
                $row[] = $rowdata->CUST_CUST_TYPE;
                $row[] = $rowdata->CUST_WHSE_CODE;
                $row[] = custBalAmt($rowdata->CUST_CODE);
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('CustomerAdd?tokenid=').$custCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
                $data[] = $row;
            }
            $output = array(
                "draw" => empty($this->input->post('draw')) ? 'none' : $this->input->post('draw'),
                "recordsTotal" => $this->datatableCon->countAll($sqlQuery),
                "recordsFiltered" => $this->datatableCon->countFiltered($_POST,$sqlQuery),
                "data" => $data
            );
            //output to json format
            header('Content-Type: application/json');
            echo json_encode($output);
        }

        public function vendorListJson(){
            $filterdata = array(
                "column_order" => array(NULL,'V_CODE','V_NAME','V_CONTACT',NULL,NULL),
                "column_search" => array('V_CODE','V_NAME','V_CONTACT','CUR_CODE','CUR_NAME','CUR_ABBRV'),
                "order" => array('ID' => 'desc')
            );
            $sqlQueryTemp = array(

                "SELECT"=>'*',
                "FROM"=>'VENDOR',

                "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                    "JOIN_1_TABLE_NAME"=>'CURRENCY as CR',
                    "JOIN_1_TABLE_CONN"=>'CR.CUR_CODE=VENDOR.V_CURR_CODE',
            );

            $sqlQuery = datatableSqlData($sqlQueryTemp);

            $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);

            $ttype = $this->input->post('saletype')=="invoice"?'saleinvoice':'saleorder';
        
            $data = array();
            $no = $this->input->post('start');
            foreach ($memData as $rowdata) {
                $no++; $row = array();
                $vCode = dataEncyptbase64($rowdata->V_CODE,'encrypt');
                $row[] = $no.".";
                // $row[] = "<a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."'>$rowdata->INVOICE_NO</a>";
                // $row[] = $rowdata->TOT_QTY;
                // $row[] ="<div class='badge badge-success' bis_skin_checked='1'> <i class='fa fa-inr' aria-hidden='true' title='Full View'></i>".$rowdata->GRAND_TOT."</div>";
                // $row[] = "<strong>".$rowdata->REASON."</strong>";
                $row[] = $rowdata->V_CODE;
                $row[] = $rowdata->V_NAME."</br> Currency : {$rowdata->V_CURR_CODE}-{$rowdata->CUR_NAME}({$rowdata->CUR_ABBRV})";
                $row[] = $rowdata->V_CONTACT;
                $row[] = $rowdata->V_POSTAL_CODE;
                $row[] = '0';
                $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                            <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                <a href='".base_url('VendorAdd?tokenid=').$vCode."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                            </li>
                        </ul>";
                //$editSt = $rowdata->STATUS != 'COMPLETE'?"<a href= '".base_url('stockTransfer/stockTransferEdit/').$rowdata->INVOICE_NO."' title='Edit' class='btn-danger btn btn-primary' ><i class='fa fa-edit' > </i></a>":'';
                // $row[] ="
                //         <div role='group' class='btn-group-sm btn-group'>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' target='_blank' title='Full View' class='btn-shadow btn btn-primary' ><i class='fa fa-eye' aria-hidden='true' ></i></a>
                //         <a href= '".base_url('stockTransfer/stockAdjustmentDetail/').$rowdata->INVOICE_NO."' title='Print' target='_blank' class='btn-info btn btn-primary' ><i class='lnr-printer  opacity-0 btn-icon-wrapper mb-2' > </i></a>
                //         </div>";
                $data[] = $row;
            }
            $output = array(
                "draw" => empty($this->input->post('draw')) ? 'none' : $this->input->post('draw'),
                "recordsTotal" => $this->datatableCon->countAll($sqlQuery),
                "recordsFiltered" => $this->datatableCon->countFiltered($_POST,$sqlQuery),
                "data" => $data
            );
            //output to json format
            header('Content-Type: application/json');
            echo json_encode($output);
        }

    }

?>