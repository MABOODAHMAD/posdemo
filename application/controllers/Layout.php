<?php
     class Layout extends CI_Controller{
         public function __construct(){
            parent::__construct();
      
            // $this->load->model('Site_model', 'dbcon');
            // $this->load->model('Universal_model','unicon');
            // $this->load->library('form_validation');
            // $this->load->helper('form');
            //$this->load->model('QrController','qrcon');
         }
        
        //message Page start
            /*================== ROLE NOT ASSIGN =================*/
                public function not_found(){
                    $newdata = array('login'=>false,'userId'=>'');
                    $this->session->unset_userdata($newdata);
                    $this->session->sess_destroy();
                    $data = array(
                        "pre"=>1,
                        "pos"=>8,
                        "message" =>"If you do not have a role to assign, please contact the administration department."
                    );
                    $this->load->view('layout/messgae',$data);
                }

            /*================== MODULE MAINTENANCE =================*/

            public function module_maintenance(){
                // $newdata = array('login'=>false,'userId'=>'');
                // $this->session->unset_userdata($newdata);
                // $this->session->sess_destroy();
                $data = array(
                    "pre"=>1,
                    "pos"=>9,
                    "message" =>"This module is currently under maintenance."
                );
                $this->load->view('layout/messgae',$data);
            }
        //message Page end
        public function logout(){
            $newdata = array('login'=>false,'userId'=>'');
            $this->session->unset_userdata($newdata);
            $this->session->sess_destroy();
            redirect(base_url(),'refresh');
        }

        public function index(){
            sessionCheck('login');
            $this->load->view('layout/login');
        }

        public function dashboard(){
            $sesData = sessionUserData();
            if($sesData->USER_TYPE == 'SUPERADMIN' || $sesData->USER_TYPE == 'ADMIN'){
                $this->adminDashboard();
            }else{
                $this->userDashboard();
            }
        }
        // <!--Admin dashboard -->
         public function adminDashboard(){
            sessionCheck();
           
            $data['dashDet'] = adminDashboard();
            $this->load->view('layout/header');
            $this->load->view('layout/admin_dashboard',$data);
            $this->load->view('layout/footer');
        }
        
        // User dashboard

        public function userDashboard(){
            sessionCheck();
            dashRole();
            // print_r($role);
            $this->load->view('layout/header');
            $this->load->view('layout/user_dashboard');
            $this->load->view('layout/footer');
        }
        
        // <!-- Add Parties -->
        public function CustomerAdd(){
            sessionCheck();
            $sesData = sessionUserData();

            $custCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($custCode)){
                
                $custDet = customerDet(['where'=>"WHERE CUST_CODE = '$custCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_CNTRY_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Customer Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['custDet'] = $custDet?$custDet:redirect(base_url('dashboard'),'refresh');
                $data['stateDet'] = stateList(['where'=>"WHERE ST_CODE = '{$data['custDet']->CUST_STATE_ID}'",'dataType'=>'result']);
                $data['citiesDet'] = citiesList(['where'=>"WHERE CTY_CODE = '{$data['custDet']->CUST_CITY_ID}'",'dataType'=>'result']);
            }
            $data['custCode'] = $custCode;

            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;

            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['countryLists'] = countryList();
            $data['custTypeDets'] = custTypeDet(['dataType'=>'result']);
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);
            $this->load->view('layout/header');
            $this->load->view('layout/parties/CustomerAdd',$data);
            $this->load->view('layout/footer');
        }
        
        public function CustomerList(){
            sessionCheck();
            $this->load->view('layout/header');
            $this->load->view('layout/parties/CustomerList');
            $this->load->view('layout/footer');
        }

        public function systemSetting(){
            sessionCheck();

            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['systemData'] = $this->commonlib->system(1);
            $data['currencyLists'] = currencyList();
            $data['timeZone'] = timeZone();
            $data['busUnits'] = busUnit();
            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/system',$data);
            $this->load->view('layout/footer');
        }
        
        public function VendorAdd(){
            sessionCheck();

            $vendorCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($vendorCode)){
                
                $vendorDet = vendorList(['where'=>"WHERE V_CODE = '$vendorCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_CNTRY_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Vendor Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['venDet'] = $vendorDet?$vendorDet:redirect(base_url('dashboard'),'refresh');
                $data['stateDet'] = stateList(['where'=>"WHERE ST_CODE = '{$data['venDet']->ST_CODE}'",'dataType'=>'result']);
                $data['citiesDet'] = citiesList(['where'=>"WHERE CTY_CODE = '{$data['venDet']->CTY_CODE}'",'dataType'=>'result']);
            }
            $data['vendorCode'] = $vendorCode;    

            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['countryLists'] = countryList();
            $data['currencyLists'] = currencyList();
            $this->load->view('layout/header');
            $this->load->view('layout/parties/VendorAdd',$data);
            $this->load->view('layout/footer');
        }
        
        public function VendorList(){
            sessionCheck();
            $this->load->view('layout/header');
            $this->load->view('layout/parties/VendorList');
            $this->load->view('layout/footer');
        }
        
        
        
        //############# <!-- Add Product -->###############
        public function ProductAdd(){
            sessionCheck();

            $iCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($iCode)){
                
                $itemDet = itemDetails($iCode);
                $this->session->set_flashdata(['INVALID_CNTRY_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Country Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['itemDet'] = $itemDet?$itemDet:redirect(base_url('dashboard'),'refresh');
                $data['itemClassDet'] = classList(['where'=>"WHERE IC_ITEM_CAT='{$itemDet[0]['I_CAT_CODE']}'",'dataType'=>'result']);
       
            }
            $data['itemCode'] = $iCode;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['uomLists'] = uomList();
            $data['classLists'] = classList();
            $data['categoryLists'] = categoryList();
            $data['vendorLists'] = vendorList();
            $data['countryLists'] = countryList();
            $this->load->view('layout/header');
            $this->load->view('layout/product/ProductsAdd',$data);
            $this->load->view('layout/footer');

        }
        
        public function ProductList(){
            sessionCheck();
            $this->load->view('layout/header');
            $this->load->view('layout/product/ProductList');
            $this->load->view('layout/footer');

        }
        
         public function ProductDetail(){
            sessionCheck();
            $sesData = sessionUserData();
            /*================== USER ROLE =================*/
            if ($sesData->USER_TYPE == 'USER') {
                $redirectCont = false;
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if(!dashRole(["role_check"=>"PRODUCT_INFO"])){
                    $this->session->set_flashdata(['PRODUCT_INFO_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No Product Information has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            
            $itemCode = dataEncypt($this->input->get('item_code'),'decrypt')?dataEncypt($this->input->get('item_code'),'decrypt'):dataEncyptManual($this->input->get('item_code_bak'),'decrypt');

            $itemDets = itemDetails($itemCode);
          
            if($itemDets){
                $data['sesData'] = $sesData;
                $data['itemDets'] = $itemDets;
                $data['whseDets'] = wherehouseDetail(['dataType'=>'result']);
                $this->load->view('layout/header');
                $this->load->view('layout/product/ProductDetail',$data);
                $this->load->view('layout/footer');
            }else{
                redirect(base_url('ProductList'), 'refresh');
            }   
            // $data['itemCode'] = 

            

        }
        
        
        //############### <!-- Add Sals -->###################
        
        public function SaleAdd(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['countryLists'] = countryList();
            $data['custTypeDets'] = custTypeDet(['dataType'=>'result']);
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }

                if(!dashRole(["role_check"=>"SALE_CREDIT"]) && !dashRole(["role_check"=>"SALE_CASH"])){
                    $this->session->set_flashdata(['SALE_TYPE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No sale type has been assigned. like Cash and Credit
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }

                if(!dashRole(["role_check"=>"SALE_CREATE_INVOICE"]) && !dashRole(["role_check"=>"SALE_CREATE_ORDER"])){
                    $this->session->set_flashdata(['INVOICE_TYPE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No invoice type has been assigned. like Invoice And Order.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $this->load->view('layout/header');
            $this->load->view('layout/sale/SaleAdd',$data);
            $dataFooter['js_min_con'] = FALSE;
            $this->load->view('layout/footer',$dataFooter);

        }
        
        public function SaleInvoice(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/sale/SaleInvoice');
            $this->load->view('layout/footer');

        }
        
        public function SaleReturn(){
            sessionCheck();
            $sesData = sessionUserData();
            /*================== USER ROLE =================*/
            if ($sesData->USER_TYPE == 'USER') {
                $redirectCont = false;
                if(!dashRole(["role_check"=>"SALE_RETURN_CREATE"])){
                    $this->session->set_flashdata(['SALE_RETURN_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No sale return has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sweetAlertMsg'] = sweetAlertMsg();

            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;
            
            $OrderDetHed = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            $OrderDetHed?$OrderDetHed:redirect(base_url('dashboard'), 'refresh');
            //* SALE RETUEN QUANTITY CHECK
                $dataDets = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"],'check_qty');
                $qtyCheck = false;
                foreach ($dataDets as $dataDet) {
                    if($dataDet->RET_QTY>0){
                            $qtyCheck = true;
                    }
                }
                $this->session->set_flashdata(['all_ret'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                <i class='mdi mdi-block-helper me-2'></i>
                                                                All items have already been returned. ORDER I'D = $OrderDetHed->SH_ORDER_PREFIX-$OrderDetHed->SH_ORDER_NO
                                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                            </div>"]);
                $qtyCheck?null:redirect(base_url('SaleInvoiceList'), 'refresh'); 
            //* SALE RETURN --> DATA FETCH
            $data['headerDet'] = $OrderDetHed;
            /*================== Check Return Date =================*/
                $whseReturnDate = wherehouseDetail(['where'=>"WHERE WHSE_CODE = '{$OrderDetHed->SH_WHSE_CODE}'",'dataType' => 'row']);
                $date_1 = date("Y-m-d", strtotime("{$OrderDetHed->SH_ORDER_DATE} +{$whseReturnDate->WHSE_EDI2} day"));
                if ($date_1>=date('Y-m-d')) {
                    $data['return_accs'] = 'Y';
                }else{
                    $data['return_accs'] = 'N';
                }
            $data['displayId'] = 'C'.$OrderDetHed->SH_WHSE_CODE.'-'.$OrderDetHed->SH_ORDER_NO;
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            // print_r($data['payDets']);
            
            

            $data['countryLists'] = countryList();
            $data['custTypeDets'] = custTypeDet(['dataType'=>'result']);
            $data['js_min_con'] = FALSE;
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);
            $this->load->view('layout/header');
            $this->load->view('layout/sale/SaleReturn',$data);
            $this->load->view('layout/footer',$data);

        }
        
        public function Payment(){
            $this->session->sess_expiration = '25';
            sessionCheck();
            $data['headerTitle'] = 'Payment In';
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['js_min_con'] = FALSE;
            $sesData = sessionUserData();
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);

            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;

            $this->load->view('layout/header',$data);
            $this->load->view('layout/sale/Payment',$data);
            $this->load->view('layout/footer',$data);

        }
        
        
        public function SaleOrderList(){
            sessionCheck();
            // dashRole(["role_check"=>"SALE"]);
            $data['saleType'] = 'order';

            $this->load->view('layout/header');
            $this->load->view('layout/sale/SaleList',$data);
            $this->load->view('layout/footer');

        }

        public function SaleInvoiceList(){
            sessionCheck();

            $data['saleType'] = 'invoice';

            $this->load->view('layout/header');
            $this->load->view('layout/sale/SaleList',$data);
            $this->load->view('layout/footer');

        }
        
         public function SaleView(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;

            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->SH_CRE_DATE,
                                                        "gettot"=>$data['headerDet']->SH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->SH_TOT_VAT,
                                                    ));
             
            $this->load->view('layout/header');
            $this->load->view('layout/sale/SaleView',$data);
            $this->load->view('layout/footer');

        }
        
        public function purchasePrint(){
            sessionCheck();

            $orderId = dataEncypt($this->input->get('orderid'),'decrypt')?dataEncypt($this->input->get('orderid'),'decrypt'):dataEncyptManual($this->input->get('bakOrderid'),'decrypt');

            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = purchaseOrderHeaderDet($orderId,"row");
            $data['poItemDets'] = purchaseOrderItemDet($orderId,'result');
            $data['poCharges'] = freightChargeDets($orderId,"SELLER");
            $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
    
            $data['invoiceData'] = (object)array(
                                                    "invoiceType"=>$data['clearanceDet']->CPO_RECEIPT_PFX?"Invoice":"Order",
                                                    "invoiceNo"=>$data['headerDet']->POH_ORDER_ID,
                                                    "invoicePrefix"=>$data['headerDet']->POH_PREFIX,
                                                    "invoiceDate"=>date('d-M Y', strtotime($data['headerDet']->POH_ORDER_DATE)),
                                                    "totQty"=>$data['headerDet']->POH_TOT_QTY,
                                                    "subTot"=>$data['headerDet']->POH_PO_CHARG_TOT,
                                                    "totDis"=>0,
                                                    "totVat"=>0,
                                                    "grandTot"=>$data['headerDet']->POH_GRAND_TOTAL,
                                                );
            $this->load->view('layout/invoice/purchasePrint',$data);
        }
        public function saleReturnPrint_old(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;

            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderReturnHeadDet(["where"=>"AND RH_TEMP_ID='$orderId'","dataType"=>"row"]);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND RD.RD_RH_ID='$orderId'","dataType"=>"result"],'ret_view');
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->RH_CRE_BY_DATE,
                                                        "gettot"=>$data['headerDet']->RH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->RH_TOT_VAT,
                                                    ));
            $data['invoiceData'] = (object)array(
                                                    "invoiceType"=>$data['headerDet']->RH_INV_PREFIX?"Invoice":"Order",
                                                    "invoiceNo"=>$data['headerDet']->RH_INV_NO,
                                                    "invoicePrefix"=>$data['headerDet']->RH_INV_PREFIX,
                                                    "invoiceDate"=>date('d-M Y', strtotime($data['headerDet']->RH_DATE)),
                                                    "totQty"=>$data['headerDet']->RH_TOT_QTY,
                                                    "subTot"=>$data['headerDet']->RH_SUB_TOT,
                                                    "totDis"=>$data['headerDet']->RH_TOT_DISC,
                                                    "totVat"=>$data['headerDet']->RH_TOT_VAT,
                                                    "grandTot"=>$data['headerDet']->RH_GRAND_TOT,
                                                );
            $this->load->view('layout/invoice/saleReturnPrint',$data);
        }
        
        public function saleReturnPrint(){
           sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;

            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderReturnHeadDet(["where"=>"AND RH_TEMP_ID='$orderId'","dataType"=>"row"]);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND RD.RD_RH_ID='$orderId'","dataType"=>"result"],'ret_view');
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['wharehouse'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE='{$data['headerDet']->RH_WHSE}'","dataType"=>'row']);
            $data['saleHeadDet'] = invDetByCustCode(['where'=>"WHERE SH_ORDER_ID = '{$data['headerDet']->RH_SH_TEMP_ID}'","dataType"=>"row"]);
            
            
                    //   $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_PREFIX:$data['headerDet']->SH_ORDER_PREFIX;
                    //   $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_NO:$data['headerDet']->SH_ORDER_NO;
                    
           $printV2 = $data['headerDet']->RH_INV_PREFIX?$data['headerDet']->RH_INV_PREFIX:$data['headerDet']->RH_ORDER_PREFIX;
           $printV3 = $data['headerDet']->RH_INV_PREFIX?$data['headerDet']->RH_INV_NO:$data['headerDet']->RH_ORDER_NO;
				
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->RH_CRE_BY_DATE,
                                                        "gettot"=>$data['headerDet']->RH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->RH_TOT_VAT,
                                                    ));
            $data['invoiceData'] = (object)array(
                                                    "invoiceType"=>$data['headerDet']->RH_INV_PREFIX?"Invoice":"Order",
                                                    "invoiceNo"=>$data['headerDet']->RH_INV_NO,
                                                    "invoicePrefix"=>$data['headerDet']->RH_INV_PREFIX,
                                                    "invoiceDate"=>date('d-M Y', strtotime($data['headerDet']->RH_DATE)),
                                                    "totQty"=>$data['headerDet']->RH_TOT_QTY,
                                                    "subTot"=>$data['headerDet']->RH_SUB_TOT,
                                                    "totDis"=>$data['headerDet']->RH_TOT_DISC,
                                                    "totVat"=>$data['headerDet']->RH_TOT_VAT,
                                                    "grandTot"=>$data['headerDet']->RH_GRAND_TOT,
                                                    "saleInvNo" =>$data['saleHeadDet']->SH_INV_PREFIX.'-'.$data['saleHeadDet']->SH_INV_NO,
                                                    "saleInvDate" =>$data['saleHeadDet']->SH_ORDER_DATE,
                                                );
       
            $html = $this->load->view('layout/invoice/SaleReturnPrintPDF',$data, true);

            $pdf = $this->pdf->load();
            $pdf->AddPage('P', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                60, // margin top
                3, // margin bottom
                5, // margin header
                2); // margin footer
            $pdf->SetHTMLHeader("
            <table width='100%' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='20%' valign='top'><img src='assets/images/logo-dark.png' width='176' height='40' />
   <table width='200' border='0' cellpadding='0' cellspacing='0'>
  <tr>
    <td class='sdbod-l sdbod-t'><strong>رقم الفاتورة مبيعات</strong></td>
    <td class='sdbod-r sdbod-t'><strong>{$data['invoiceData']->saleInvNo}</strong></td>
    </tr>
  <tr>
    <td class='sdbod-l sdbod-b'><strong>تاريخ الفاتورة مبيعات</strong></td>
    <td class='sdbod-b sdbod-r'><strong>{$data['invoiceData']->saleInvDate}</strong></td>
    </tr>
</table>
    </td>
    
    
    <td width='58%' align='center' style='font-size:12px;'><h2>
        شركة محمد عثمان المعلم
   <br>920016990 </h2>
   {$data['wharehouse']->WHSE_DESC} - {$data['wharehouse']->WHSE_STR_ADDR1}- {$data['wharehouse']->WHSE_STR_ADDR2} 
<br />                 
 <strong>PHONE</strong> :  {$data['wharehouse']->WHSE_PHONE1}. || <strong>FAX</strong>: {$data['wharehouse']->WHSE_FAX1}</td>
 
 
    <td width='22%' align='right' valign='top' style='font-size:12px;'>
	<strong style='
    font-size: 18px;
'>
	    اشعار دائن للفاتورة
الضريبيةالمبسطة

</strong>
    <br><strong>الرقم الضريبى:</strong> 300232189200003<br />
     <h4 class='float-end font-size-11'> رقم السجل التجاری و رقم الرخصة
     {$data['invoiceData']->invoiceType} #{$data['invoiceData']->invoicePrefix}-{$data['invoiceData']->invoiceNo}
    
    </h4>
                                           
    </td>
  </tr>
  </table>
  
  
  <table width='100%' border='0' cellpadding='0' cellspacing='0' class='' style='margin-bottom:5px' >
    
	  
	  <tr>
				<td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b sdbod-l'><span class='style17'><strong> CASH</strong>  &#1606;&#1608;&#1593; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1577;</span> </td>
				<td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b '><span class='style17'><strong>{$printV2}-{$printV3} </strong> &#1585;&#1602;&#1605; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1577;</span></td>
				<td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b'><span class='style17'><strong>
				
			
				  ".date('d-M Y', strtotime($data['invoiceData']->invoiceDate))." : 
				</strong> &#1578;&#1575;&#1585;&#1610;&#1582; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1607;</span></td>
			    <td width='10%' align='center' class=' sdbod-t sdbod-r sdbod-b'>Page 1-1 </td>
	  </tr>
</table>
  
    <div style='width:100%;  border:#000000 solid 1px; padding:5px;border-radius: 10px; float:left; margin:5px;'>
    
    <table width='100%' border='0' cellpadding='0' cellspacing='0' style='font-size: 19px;'>
                                                              
                                                              <tr height='20'>
                                                                <td height='20' dir='RTL' align='right' width='83'>&#1575;&#1604;&#1573;&#1587;&#1605;</td>
                                                                <td height='20' colspan='4' align='left'>{$data['headerDet']->CUST_CODE}-{$data['headerDet']->CUST_NAME_AR}-{$data['headerDet']->CUST_NAME}</td>
                                                                <td width='111' align='left'>&nbsp;</td>
                                                                <td width='328' align='right' dir='rtl'>&#1575;&#1604;&#1585;&#1602;&#1605; &#1575;&#1604;&#1590;&#1585;&#1610;&#1576;&#1610; &#1604;&#1604;&#1593;&#1605;&#1610;&#1604;</td>
                                                                <td width='37' align='left'>{$data['headerDet']->CUST_E_MAIL2}</td>
                                                              </tr>
                                                              
                                                              <tr height='20'>
                                                                <td height='20' align='right' dir='rtl'>&#1575;&#1604;&#1588;&#1575;&#1585;&#1593;</td>
                                                                <td width='79' align='left'>{$data['headerDet']->CUST_STR_ADDR1}</td>
                                                                <td width='144' height='20' align='right' dir='rtl'>&#1575;&#1604;&#1605;&#1583;&#1610;&#1606;&#1577;</td>
                                                                <td width='162' align='left'>{$data['headerDet']->CTY_NAME}</td>
                                                                <td width='151' align='right' dir='rtl'>&#1585;&#1602;&#1605; &#1575;&#1604;&#1576;&#1591;&#1575;&#1602;&#1577;</td>
                                                                <td align='left'><!--Card No -->
                                                                    {$data['headerDet']->CUST_EDI1}</td>
                                                                <td align='right' dir='rtl'>&#1578;&#1610;&#1604;&#1610;&#1601;&#1608;&#1606;</td>
                                                                <td align='left'>{$data['headerDet']->CUST_PHONE1}</td>
                                                              </tr>
                                                              
                                                              <tr height='20'>
                                                                <td height='20' align='right' dir='rtl'>&#1586;-&#1576;&#1585;&#1610;&#1583;&#1610;</td>
                                                                <td align='left'>{$data['headerDet']->CUST_POSTAL_CODE_ID}
  &nbsp;</td>
                                                                <td height='20' align='right' dir='rtl'>&#1589;-&#1575;&#1604;&#1576;&#1585;&#1610;&#1583;</td>
                                                                <td align='left'>{$data['headerDet']->CUST_POSTAL_CODE_ID}</td>
                                                                <td align='right' dir='rtl'>&#1575;&#1604;&#1576;&#1585;&#1610;&#1583; &#1575;&#1604;&#1573;&#1603;&#1578;&#1585;&#1608;&#1606;&#1610;</td>
                                                                <td align='left'>{$data['headerDet']->CUST_E_MAIL1}</td>
                                                                <td align='right' dir='rtl'>&#1580;&#1608;&#1575;&#1604;</td>
                                                                <td align='left'>{$data['headerDet']->CUST_PHONE2}</td>
                                                              </tr>
      </table>
  </div>",'O',true);
            
            // $pdf->SetHTMLHeader('<div style="text-align: right;top:100px; font-weight: bold;">My document</div>','E',true);

            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #Page</div>');
            $pdf->WriteHTML($html);
            $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
            
            

        }
        
        public function SalePrintARPDF(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;
            // $orderId = 'AJNUPTNC95';
            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            $data['custBal'] = custBalAmt($data['headerDet']->SH_CUST_ID);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
             //$data['WHOUSE'] = WHDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['wharehouse'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE='{$data['headerDet']->SH_WHSE_CODE}'","dataType"=>'row']);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->SH_CRE_DATE,
                                                        "gettot"=>$data['headerDet']->SH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->SH_TOT_VAT,
                                                    ));
             
            // $this->load->view('layout/header');
            //$html = $this->load->view('layout/invoice/SalePrintAR',$data, true);
            //$this->load->view('layout/footer');
            
            
            // $html = $this->load->view('layout/invoice/SalePrintAR',$data);
            $html = $this->load->view('layout/invoice/SalePrintARPDF',$data, true);
            $typeHead = $data['headerDet']->SH_TERM_ID == '997'?'CASH':'CREDIT';
            $printV2 = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_PREFIX:$data['headerDet']->SH_ORDER_PREFIX;
            $printV3 = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_NO:$data['headerDet']->SH_ORDER_NO;
            $invDsp = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_PREFIX:$data['headerDet']->SH_ORDER_PREFIX."-".$data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_NO:$data['headerDet']->SH_ORDER_NO;
            $pdf = $this->pdf->load();
            $pdf->AddPage('P', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                50, // margin top
                3, // margin bottom
                5, // margin header
                2); // margin footer
            $pdf->SetHTMLHeader("
                                <table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                <tr>
                                    <td width='20%' valign='top'><img src='assets/images/logo-dark.png' width='176' height='40' /></td>
                                    
                                    
                                    <td width='58%' align='center' style='font-size:12px;'><h2>
                                            شركة محمد عثمان المعلم
                                        <br>920016990 </h2>
                                            {$data['wharehouse']->WHSE_DESC} - {$data['wharehouse']->WHSE_STR_ADDR1}-{$data['wharehouse']->WHSE_STR_ADDR2} 
                                        <br/>                 
                                        <strong>PHONE</strong> :  {$data['wharehouse']->WHSE_PHONE1}. || <strong>FAX</strong>: {$data['wharehouse']->WHSE_FAX1}
                                    </td>
                                    <td width='22%' align='right' valign='top' style='font-size:12px;'>
                                        <strong style='font-size: 18px;'>فاتورة ضريبية مبسطة</strong>
                                        <br><strong>الرقم الضريبى:</strong> 300232189200003<br />
                                        <h4 class='float-end font-size-11'> رقم السجل التجاری و رقم الرخصة{$data['wharehouse']->WHSE_EDI1} </h4>                                   
                                    </td>
                                </tr>
                            </table>
                        
                            <table width='100%' border='0' cellpadding='0' cellspacing='0' style='margin-bottom:5px'>
                                <tr>
                                    <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b sdbod-l'><span class='style17'><strong> {$typeHead}</strong>  &#1606;&#1608;&#1593; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1577;</span> </td>
                                    <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b '><span class='style17'><strong>  {$printV2}
                                            -
                                            {$printV3}</strong> &#1585;&#1602;&#1605; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1577;</span></td>
                                    <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b'><span class='style17'><strong> ".date('d-M Y', strtotime($data['headerDet']->SH_ORDER_DATE))." : </strong> &#1578;&#1575;&#1585;&#1610;&#1582; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1607;</span></td>
                                    <td width='10%' align='center' class=' sdbod-t sdbod-r sdbod-b'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                </tr>
                            </table>
                        
                            <div style='width:100%;  border:#000000 solid 1px; padding:5px;border-radius: 10px; float:left; margin:5px;'>
                                <table width='100%' border='0' cellpadding='0' cellspacing='0' style='font-size: 19px;'>
                                    <tr height='20'>
                                    <td height='20' dir='RTL' align='right' width='83'>&#1575;&#1604;&#1573;&#1587;&#1605;</td>
                                    <td height='20' colspan='4' align='left'>{$data['headerDet']->CUST_CODE}-{$data['headerDet']->CUST_NAME_AR}-{$data['headerDet']->CUST_NAME}</td>
                                    <td width='111' align='left'>&nbsp;</td>
                                    <td width='328' align='right' dir='rtl'>&#1575;&#1604;&#1585;&#1602;&#1605; &#1575;&#1604;&#1590;&#1585;&#1610;&#1576;&#1610; &#1604;&#1604;&#1593;&#1605;&#1610;&#1604;</td>
                                    <td width='37' align='left'>{$data['headerDet']->CUST_E_MAIL2}</td>
                                    </tr>
                                    <tr height='20'>
                                    <td height='20' align='right' dir='rtl'>&#1575;&#1604;&#1588;&#1575;&#1585;&#1593;</td>
                                    <td width='79' align='left'>{$data['headerDet']->CUST_STR_ADDR1}</td>
                                    <td width='144' height='20' align='right' dir='rtl'>&#1575;&#1604;&#1605;&#1583;&#1610;&#1606;&#1577;</td>
                                    <td width='162' align='left'>{$data['headerDet']->CTY_NAME}</td>
                                    <td width='151' align='right' dir='rtl'>&#1585;&#1602;&#1605; &#1575;&#1604;&#1576;&#1591;&#1575;&#1602;&#1577;</td>
                                    <td align='left'><!--Card No -->
                                        {$data['headerDet']->CUST_EDI1}</td>
                                    <td align='right' dir='rtl'>&#1578;&#1610;&#1604;&#1610;&#1601;&#1608;&#1606;</td>
                                    <td align='left'>{$data['headerDet']->CUST_PHONE1}</td>
                                    </tr>
                                    <tr height='20'>
                                    <td height='20' align='right' dir='rtl'>&#1586;-&#1576;&#1585;&#1610;&#1583;&#1610;</td>
                                    <td align='left'>{$data['headerDet']->CUST_POSTAL_CODE_ID}&nbsp;</td>
                                    <td height='20' align='right' dir='rtl'>&#1589;-&#1575;&#1604;&#1576;&#1585;&#1610;&#1583;</td>
                                    <td align='left'>{$data['headerDet']->CUST_POSTAL_CODE_ID}</td>
                                    <td align='right' dir='rtl'>&#1575;&#1604;&#1576;&#1585;&#1610;&#1583; &#1575;&#1604;&#1573;&#1603;&#1578;&#1585;&#1608;&#1606;&#1610;</td>
                                    <td align='left'>{$data['headerDet']->CUST_E_MAIL1}</td>
                                    <td align='right' dir='rtl'>&#1580;&#1608;&#1575;&#1604;</td>
                                    <td align='left'>{$data['headerDet']->CUST_PHONE2}</td>
                                    </tr>
                                </table>
                            </div>
                            ",'O',true);
            // $pdf->SetHTMLHeader('<div style="text-align: right;top:100px; font-weight: bold;">My document</div>','E',true);

            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #Page</div>');
            $pdf->WriteHTML($html);
            $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
            
            

        }
        
        public function SalePrintENPDF(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;
            // $orderId = 'AJNUPTNC95';
            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            $data['custBal'] = custBalAmt($data['headerDet']->SH_CUST_ID);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
             //$data['WHOUSE'] = WHDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['wharehouse'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE='{$data['headerDet']->SH_WHSE_CODE}'","dataType"=>'row']);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->SH_CRE_DATE,
                                                        "gettot"=>$data['headerDet']->SH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->SH_TOT_VAT,
                                                    ));
             
            // $this->load->view('layout/header');
            //$html = $this->load->view('layout/invoice/SalePrintAR',$data, true);
            //$this->load->view('layout/footer');
            
            
            // $html = $this->load->view('layout/invoice/SalePrintAR',$data);
            $html = $this->load->view('layout/invoice/SalePrintENPDF',$data, true);
            $printV1 = $data['headerDet']->SH_TERM_ID == '997'?'CASH':'CREDIT';
            $printV2 = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_PREFIX:$data['headerDet']->SH_ORDER_PREFIX;
            $printV3 = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_NO:$data['headerDet']->SH_ORDER_NO;
            $pdf = $this->pdf->load();
            $pdf->AddPage('P', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                50, // margin top
                3, // margin bottom
                5, // margin header
                2); // margin footer
            $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0'>
                                    <tr>
                                        <td width='20%' valign='top'><img src='assets/images/logo-dark.png' width='176' height='40' /></td>
                                        <td width='58%' align='center' style='font-size:12px;'><h2>
                                        Mohammad Othman Al-Moallim
                                    <br>920016990 </h2>
                                    {$data['wharehouse']->WHSE_DESC} - {$data['wharehouse']->WHSE_STR_ADDR1}'- '{$data['wharehouse']->WHSE_STR_ADDR2} 
                                    <br />                 
                                    <strong>PHONE</strong> :  {$data['wharehouse']->WHSE_PHONE1}. || <strong>FAX</strong>: {$data['wharehouse']->WHSE_FAX1}</td>
                                        <td width='22%' align='right' valign='top' style='font-size:12px;'>
                                            <strong style='font-size: 18px;'>INVOICE</strong>
                                            <br><strong>VAT No:</strong> 300232189200003<br />
                                            <h4 class='float-end font-size-11'> CR. No And Licence
                                            {$data['wharehouse']->WHSE_EDI1} 
                                            </h4>        
                                        </td>
                                    </tr>
                                </table>
                            
                            <table width='100%' border='0' cellpadding='0' cellspacing='0' style='margin-bottom:5px' >
                                
                                
                                <tr>
                                            <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b sdbod-l'><span class='style17'> Type<strong>:
                            
                                            {$printV1}
                                            </strong></span> </td>
                                            <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b '><span class='style17'> Invoice No<strong>:
                            
                                            {$printV2}
                                            -
                                            {$printV3}
                                            </strong></span></td>
                                            <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b'><span class='style17'> Invoice Date<strong>:
                            
                                            ".date('d-M Y', strtotime($data['headerDet']->SH_ORDER_DATE))."
                                            </strong></span></td>
                                            <td width='10%' align='center' class=' sdbod-t sdbod-r sdbod-b'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                </tr>
                            </table>
                            
                                <div style='width:100%;  border:#000000 solid 1px; padding:5px;border-radius: 10px; float:left; margin:5px;'>
                                
                                <table width='100%' border='0' cellpadding='0' cellspacing='0' style='font-size: 19px;'>
                                                                                        
                                                                                        <tr height='20'>
                                                                                            <td height='20' dir='RTL' align='right' width='83'>Name</td>
                                                                                            <td height='20' colspan='4' align='left'>{$data['headerDet']->CUST_CODE}'-'{$data['headerDet']->CUST_NAME_AR}-.{$data['headerDet']->CUST_NAME}</td>
                                                                                            <td width='111' align='left'>&nbsp;</td>
                                                                                            <td width='328' align='right' dir='rtl'>Cust VAT No</td>
                                                                                            <td width='37' align='left'>{$data['headerDet']->CUST_E_MAIL2}</td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr height='20'>
                                                                                            <td height='20' align='right' dir='rtl'>Street</td>
                                                                                            <td width='79' align='left'>{$data['headerDet']->CUST_STR_ADDR1}</td>
                                                                                            <td width='144' height='20' align='right' dir='rtl'>City</td>
                                                                                            <td width='162' align='left'>{$data['headerDet']->CTY_NAME}</td>
                                                                                            <td width='151' align='right' dir='rtl'>Card No</td>
                                                                                            <td align='left'><!--Card No -->
                                                                                                {$data['headerDet']->CUST_EDI1}</td>
                                                                                            <td align='right' dir='rtl'>phone</td>
                                                                                            <td align='left'>{$data['headerDet']->CUST_PHONE1}</td>
                                                                                        </tr>
                                                                                        
                                                                                        <tr height='20'>
                                                                                            <td height='20' align='right' dir='rtl'>Address</td>
                                                                                            <td align='left'>{$data['headerDet']->CUST_POSTAL_CODE_ID}
                            &nbsp;</td>
                                                                                            <td height='20' align='right' dir='rtl'>Postal Code</td>
                                                                                            <td align='left'>{$data['headerDet']->CUST_POSTAL_CODE_ID}</td>
                                                                                            <td align='right' dir='rtl'>Email</td>
                                                                                            <td align='left'>{$data['headerDet']->CUST_E_MAIL1}</td>
                                                                                            <td align='right' dir='rtl'>Cell</td>
                                                                                            <td align='left'>{$data['headerDet']->CUST_PHONE2}</td>
                                                                                        </tr>
                                                                                </table>
                            </div>",'O',true);

            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #Page</div>');
            $pdf->WriteHTML($html);
            $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
            
            

        }
        
         public function SalePrintGFPDF(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;
            // $orderId = 'AJNUPTNC95';
            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            $data['custBal'] = custBalAmt($data['headerDet']->SH_CUST_ID);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
             //$data['WHOUSE'] = WHDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['wharehouse'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE='{$data['headerDet']->SH_WHSE_CODE}'","dataType"=>'row']);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->SH_CRE_DATE,
                                                        "gettot"=>$data['headerDet']->SH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->SH_TOT_VAT,
                                                    ));
             
            // $this->load->view('layout/header');
            //$html = $this->load->view('layout/invoice/SalePrintAR',$data, true);
            //$this->load->view('layout/footer');
            
            
            // $html = $this->load->view('layout/invoice/SalePrintAR',$data);
            $html = $this->load->view('layout/invoice/SalePrintGFPDF',$data, true);
            $printV1 = $data['headerDet']->SH_TERM_ID == '997'?'CASH':'CREDIT';
            //$printV2 = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_PREFIX:$data['headerDet']->SH_ORDER_PREFIX."-".$data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_NO:$data['headerDet']->SH_ORDER_NO;
           
            $printV2 = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_PREFIX:$data['headerDet']->SH_ORDER_PREFIX;
            $printV3 = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_NO:$data['headerDet']->SH_ORDER_NO;
            $pdf = $this->pdf->load();
            $pdf->AddPage('P', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                50, // margin top
                3, // margin bottom
                5, // margin header
                2); // margin footer
            $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='20%' valign='top'><img src='assets/images/logo-dark.png' width='176' height='40' /></td>
              
              
              <td width='58%' align='center' style='font-size:12px;'><h2>
                  شركة محمد عثمان المعلم
             <br>920016990 </h2>
             {$data['wharehouse']->WHSE_DESC} - {$data['wharehouse']->WHSE_STR_ADDR1}-{$data['wharehouse']->WHSE_STR_ADDR2} 
          <br />                 
           <strong>PHONE</strong> :  {$data['wharehouse']->WHSE_PHONE1}. || <strong>FAX</strong>: {$data['wharehouse']->WHSE_FAX1}</td>
           
           
              <td width='22%' align='right' valign='top' style='font-size:12px;'>
              <strong style='
              font-size: 18px;
          '>إشعار هديه
                  </strong>
              <br><strong>الرقم الضريبى:</strong> 300232189200003<br />
               <h4 class='float-end font-size-11'> رقم السجل التجاری و رقم الرخصة
               {$data['wharehouse']->WHSE_EDI1} 
              
              </h4>
                                                     
              </td>
            </tr>
            </table>
            
             <table width='100%' border='0' cellpadding='0' cellspacing='0' style='margin-bottom:5px' >
              
                
                <tr>
                          <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b sdbod-l'><span class='style17'><strong> {$printV1}</strong>  &#1606;&#1608;&#1593; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1577;</span> </td>
                          <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b '><span class='style17'><strong>  {$printV2} - {$printV3} </strong> &#1585;&#1602;&#1605; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1577;</span></td>
                          <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b'><span class='style17'><strong> ".date('d-M Y', strtotime($data['headerDet']->SH_ORDER_DATE))." : </strong> &#1578;&#1575;&#1585;&#1610;&#1582; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1607;</span></td>
                          <td width='10%' align='center' class=' sdbod-t sdbod-r sdbod-b'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                </tr>
          </table>
          
              <div style='width:100%;  border:#000000 solid 1px; padding:5px;border-radius: 10px; float:left; margin:5px;'>
              
              <table width='100%' border='0' cellpadding='0' cellspacing='0' style='font-size: 19px;'>
                                                                        
                                                                        <tr height='20'>
                                                                          <td height='20' dir='RTL' align='right' width='83'>&#1575;&#1604;&#1573;&#1587;&#1605;</td>
                                                                          <td height='20' colspan='4' align='left'>{$data['headerDet']->CUST_CODE}-{$data['headerDet']->CUST_NAME_AR}-{$data['headerDet']->CUST_NAME}</td>
                                                                          <td width='111' align='left'>&nbsp;</td>
                                                                          <td width='328' align='right' dir='rtl'>&#1575;&#1604;&#1585;&#1602;&#1605; &#1575;&#1604;&#1590;&#1585;&#1610;&#1576;&#1610; &#1604;&#1604;&#1593;&#1605;&#1610;&#1604;</td>
                                                                          <td width='37' align='left'>{$data['headerDet']->CUST_E_MAIL2}</td>
                                                                        </tr>
                                                                        
                                                                        <tr height='20'>
                                                                          <td height='20' align='right' dir='rtl'>&#1575;&#1604;&#1588;&#1575;&#1585;&#1593;</td>
                                                                          <td width='79' align='left'>{$data['headerDet']->CUST_STR_ADDR1}</td>
                                                                          <td width='144' height='20' align='right' dir='rtl'>&#1575;&#1604;&#1605;&#1583;&#1610;&#1606;&#1577;</td>
                                                                          <td width='162' align='left'>{$data['headerDet']->CTY_NAME}</td>
                                                                          <td width='151' align='right' dir='rtl'>&#1585;&#1602;&#1605; &#1575;&#1604;&#1576;&#1591;&#1575;&#1602;&#1577;</td>
                                                                          <td align='left'><!--Card No -->
                                                                              {$data['headerDet']->CUST_EDI1}</td>
                                                                          <td align='right' dir='rtl'>&#1578;&#1610;&#1604;&#1610;&#1601;&#1608;&#1606;</td>
                                                                          <td align='left'>{$data['headerDet']->CUST_PHONE1}</td>
                                                                        </tr>
                                                                        
                                                                        <tr height='20'>
                                                                          <td height='20' align='right' dir='rtl'>&#1586;-&#1576;&#1585;&#1610;&#1583;&#1610;</td>
                                                                          <td align='left'>{$data['headerDet']->CUST_POSTAL_CODE_ID}
            &nbsp;</td>
                                                                          <td height='20' align='right' dir='rtl'>&#1589;-&#1575;&#1604;&#1576;&#1585;&#1610;&#1583;</td>
                                                                          <td align='left'>{$data['headerDet']->CUST_POSTAL_CODE_ID}</td>
                                                                          <td align='right' dir='rtl'>&#1575;&#1604;&#1576;&#1585;&#1610;&#1583; &#1575;&#1604;&#1573;&#1603;&#1578;&#1585;&#1608;&#1606;&#1610;</td>
                                                                          <td align='left'>{$data['headerDet']->CUST_E_MAIL1}</td>
                                                                          <td align='right' dir='rtl'>&#1580;&#1608;&#1575;&#1604;</td>
                                                                          <td align='left'>{$data['headerDet']->CUST_PHONE2}</td>
                                                                        </tr>
                </table>
            </div>",'O',true);
            // $pdf->SetHTMLHeader('<div style="text-align: right;top:100px; font-weight: bold;">My document</div>','E',true);

            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #Page</div>');
            $pdf->WriteHTML($html);
            $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
            
            

        }
        
         public function SalePrintPRPDF(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;
            // $orderId = 'AJNUPTNC95';
            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            $data['custBal'] = custBalAmt($data['headerDet']->SH_CUST_ID);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
             //$data['WHOUSE'] = WHDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['wharehouse'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE='{$data['headerDet']->SH_WHSE_CODE}'","dataType"=>'row']);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->SH_CRE_DATE,
                                                        "gettot"=>$data['headerDet']->SH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->SH_TOT_VAT,
                                                    ));
             
            // $this->load->view('layout/header');
            //$html = $this->load->view('layout/invoice/SalePrintAR',$data, true);
            //$this->load->view('layout/footer');
            
            
            // $html = $this->load->view('layout/invoice/SalePrintAR',$data);
            $html = $this->load->view('layout/invoice/SalePrintPRPDF',$data, true);
            $printV1 = $data['headerDet']->SH_TERM_ID == '997'?'CASH':'CREDIT';
            //$printV2 = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_PREFIX:$data['headerDet']->SH_ORDER_PREFIX."-".$data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_NO:$data['headerDet']->SH_ORDER_NO;
            
            $printV2 = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_PREFIX:$data['headerDet']->SH_ORDER_PREFIX;
            $printV3 = $data['headerDet']->SH_INV_PREFIX?$data['headerDet']->SH_INV_NO:$data['headerDet']->SH_ORDER_NO;
            $pdf = $this->pdf->load();
            $pdf->AddPage('P', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                50, // margin top
                3, // margin bottom
                5, // margin header
                2); // margin footer
            $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0'>
            <tr>
              <td width='20%' valign='top'><img src='assets/images/logo-dark.png' width='176' height='40' /></td>
              
              
              <td width='58%' align='center' style='font-size:12px;'><h2>
                  شركة محمد عثمان المعلم
             <br>920016990 </h2>
             {$data['wharehouse']->WHSE_DESC} - {$data['wharehouse']->WHSE_STR_ADDR1}-{$data['wharehouse']->WHSE_STR_ADDR2} 
          <br />                 
           <strong>PHONE</strong> :  {$data['wharehouse']->WHSE_PHONE1}. || <strong>FAX</strong>: {$data['wharehouse']->WHSE_FAX1}</td>
           
           
              <td width='22%' align='right' valign='top' style='font-size:12px;'>
              <strong style='
              font-size: 18px;
          '>فاتورة ضريبية مبسطة</strong>
              <br><strong>الرقم الضريبى:</strong> 300232189200003<br />
               <h4 class='float-end font-size-11'> رقم السجل التجاری و رقم الرخصة
               {$data['wharehouse']->WHSE_EDI1} 
              
              </h4>
                                                     
              </td>
            </tr>
            </table>
            
             <table width='100%' border='0' cellpadding='0' cellspacing='0' style='margin-bottom:5px' >
              
                
                <tr>
                          <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b sdbod-l'><span class='style17'><strong> {$printV1}</strong>  &#1606;&#1608;&#1593; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1577;</span> </td>
                          <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b '><span class='style17'><strong> {$printV2} - {$printV3}  </strong> &#1585;&#1602;&#1605; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1577;</span></td>
                          <td width='30%' align='center' class=' sdbod-t sdbod-r sdbod-b'><span class='style17'><strong> ".date('d-M Y', strtotime($data['headerDet']->SH_ORDER_DATE))." : </strong> &#1578;&#1575;&#1585;&#1610;&#1582; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1607;</span></td>
                          <td width='10%' align='center' class=' sdbod-t sdbod-r sdbod-b'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                </tr>
          </table>
          
              <div style='width:100%;  border:#000000 solid 1px; padding:5px;border-radius: 10px; float:left; margin:5px;'>
              
              <table width='100%' border='0' cellpadding='0' cellspacing='0' style='font-size: 19px;'>
                                                                        
                                                                        <tr height='20'>
                                                                          <td height='20' dir='RTL' align='right' width='83'>&#1575;&#1604;&#1573;&#1587;&#1605;</td>
                                                                          <td height='20' colspan='4' align='left'>{$data['headerDet']->CUST_CODE}-{$data['headerDet']->CUST_NAME_AR}-{$data['headerDet']->CUST_NAME}</td>
                                                                          <td width='111' align='left'>&nbsp;</td>
                                                                          <td width='328' align='right' dir='rtl'>&#1575;&#1604;&#1585;&#1602;&#1605; &#1575;&#1604;&#1590;&#1585;&#1610;&#1576;&#1610; &#1604;&#1604;&#1593;&#1605;&#1610;&#1604;</td>
                                                                          <td width='37' align='left'>{$data['headerDet']->CUST_E_MAIL2}</td>
                                                                        </tr>
                                                                        
                                                                        <tr height='20'>
                                                                          <td height='20' align='right' dir='rtl'>&#1575;&#1604;&#1588;&#1575;&#1585;&#1593;</td>
                                                                          <td width='79' align='left'>{$data['headerDet']->CUST_STR_ADDR1}</td>
                                                                          <td width='144' height='20' align='right' dir='rtl'>&#1575;&#1604;&#1605;&#1583;&#1610;&#1606;&#1577;</td>
                                                                          <td width='162' align='left'>{$data['headerDet']->CTY_NAME}</td>
                                                                          <td width='151' align='right' dir='rtl'>&#1585;&#1602;&#1605; &#1575;&#1604;&#1576;&#1591;&#1575;&#1602;&#1577;</td>
                                                                          <td align='left'><!--Card No -->
                                                                              {$data['headerDet']->CUST_EDI1}</td>
                                                                          <td align='right' dir='rtl'>&#1578;&#1610;&#1604;&#1610;&#1601;&#1608;&#1606;</td>
                                                                          <td align='left'>{$data['headerDet']->CUST_PHONE1}</td>
                                                                        </tr>
                                                                        
                                                                        <tr height='20'>
                                                                          <td height='20' align='right' dir='rtl'>&#1586;-&#1576;&#1585;&#1610;&#1583;&#1610;</td>
                                                                          <td align='left'>{$data['headerDet']->CUST_POSTAL_CODE_ID}
            &nbsp;</td>
                                                                          <td height='20' align='right' dir='rtl'>&#1589;-&#1575;&#1604;&#1576;&#1585;&#1610;&#1583;</td>
                                                                          <td align='left'>{$data['headerDet']->CUST_POSTAL_CODE_ID}</td>
                                                                          <td align='right' dir='rtl'>&#1575;&#1604;&#1576;&#1585;&#1610;&#1583; &#1575;&#1604;&#1573;&#1603;&#1578;&#1585;&#1608;&#1606;&#1610;</td>
                                                                          <td align='left'>{$data['headerDet']->CUST_E_MAIL1}</td>
                                                                          <td align='right' dir='rtl'>&#1580;&#1608;&#1575;&#1604;</td>
                                                                          <td align='left'>{$data['headerDet']->CUST_PHONE2}</td>
                                                                        </tr>
                                                              </table>
            </div>",'O',true);
            // $pdf->SetHTMLHeader('<div style="text-align: right;top:100px; font-weight: bold;">My document</div>','E',true);

            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #Page</div>');
            $pdf->WriteHTML($html);
            $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
            
            

        }
        
         
        
        
        
        
        public function SalePrintAR(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;

            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            
            $data['headerDet'] = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            $data['custBal'] = custBalAmt($data['headerDet']->SH_CUST_ID);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
             //$data['WHOUSE'] = WHDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['wharehouse'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE='{$data['headerDet']->SH_WHSE_CODE}'","dataType"=>'row']);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->SH_CRE_DATE,
                                                        "gettot"=>$data['headerDet']->SH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->SH_TOT_VAT,
                                                    ));
             
            // $this->load->view('layout/header');
            $this->load->view('layout/invoice/SalePrintAR',$data);
            // $this->load->view('layout/footer');

        }


        public function SalePrintEN(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;

            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['wharehouse'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE='{$data['headerDet']->SH_WHSE_CODE}'","dataType"=>'row']);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->SH_CRE_DATE,
                                                        "gettot"=>$data['headerDet']->SH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->SH_TOT_VAT,
                                                    ));
             
            // $this->load->view('layout/header');
            $this->load->view('layout/invoice/SalePrintEN',$data);
            // $this->load->view('layout/footer');

        }


        public function SalePrintGF(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;

            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['wharehouse'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE='{$data['headerDet']->SH_WHSE_CODE}'","dataType"=>'row']);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->SH_CRE_DATE,
                                                        "gettot"=>$data['headerDet']->SH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->SH_TOT_VAT,
                                                    ));
             
            // $this->load->view('layout/header');
            $this->load->view('layout/invoice/SalePrintGF',$data);
            // $this->load->view('layout/footer');

        }


        public function SalePrintPR(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;

            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderHeadDet(["where"=>"AND SH_ORDER_ID='$orderId'","dataType"=>"row"]);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND SD.SD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            $data['wharehouse'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE='{$data['headerDet']->SH_WHSE_CODE}'","dataType"=>'row']);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            
            $data['qr_image'] = $this->zatca->qrCodeGenerate(array(
                                                        "com_name"=>$data['busUnit']->BU_NAME2.'-'.$data['busUnit']->BU_NAME1,
                                                        "vat_no"=>$sys->SS_TRN,
                                                        "datetime"=>$data['headerDet']->SH_CRE_DATE,
                                                        "gettot"=>$data['headerDet']->SH_GRAND_TOT,
                                                        "vat"=>$data['headerDet']->SH_TOT_VAT,
                                                    ));
             
            // $this->load->view('layout/header');
            $this->load->view('layout/invoice/SalePrintPR',$data);
            // $this->load->view('layout/footer');

        }
        
        

        public function saleReturnView(){
            sessionCheck();
            $sys =  $this->commonlib->currentSetting();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt')?dataEncyptbase64($this->input->get('orderid'),'decrypt'):null;

            // purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = saleOrderReturnHeadDet(["where"=>"AND RH_TEMP_ID='$orderId'","dataType"=>"row"]);
            $data['detailsLists'] = saleOrderLineDet(["where"=>"AND RD.RD_RH_ID='$orderId'","dataType"=>"result"],'ret_view');
            $data['payDets'] = paymentDetails(["where"=>"AND PD_ORDER_ID='$orderId'","dataType"=>"result"]);
            // $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail();
            
            $this->load->view('layout/header');
            $this->load->view('layout/sale/saleReturnView',$data);
            $this->load->view('layout/footer');

        }
        
         public function SaleReturnList(){
            sessionCheck();
            $this->load->view('layout/header');
            $this->load->view('layout/sale/SaleReturnList');
            $this->load->view('layout/footer');

        }
        
         public function PaymentList(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/sale/PaymentList');
            $this->load->view('layout/footer');

        }
        
// ############<!-- Purchase -->##################
        
        
        public function PurchaseAdd(){
            sessionCheck();
            $sesData = sessionUserData();
            /*================== USER ROLE =================*/
            if ($sesData->USER_TYPE == 'USER') {
                $redirectCont = false;
                if(!dashRole(["role_check"=>"PURCHASE_CREATE_ORDER"]) || !dashRole(["role_check"=>"PURCHASE_CREATE_INVOICE"])){
                    $this->session->set_flashdata(['PURCHASE_ORDER_CREATE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No create purchase order has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PurchaseAdd',$data);
            $this->load->view('layout/footer');

        }
        
        
        public function PurchaseOrderList(){
            sessionCheck();

            $sesData = sessionUserData();
            /*================== USER ROLE =================*/
            if ($sesData->USER_TYPE == 'USER') {
                $redirectCont = false;
                if(!dashRole(["role_check"=>"PURCHASE_ORDER_LIST"])){
                    $this->session->set_flashdata(['PURCHASE_ORDER_LIST_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No purchase order list has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['purchaseType'] = 'order';
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PurchaseList',$data);
            $this->load->view('layout/footer');

        }

        public function PurchaseView(){
            sessionCheck();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $orderId = dataEncypt($this->input->get('orderid'),'decrypt')?dataEncypt($this->input->get('orderid'),'decrypt'):dataEncyptManual($this->input->get('bakOrderid'),'decrypt');

            purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');

            $data['orderId'] = $orderId;
            $data['headerDet'] = purchaseOrderHeaderDet($orderId,"row");
            $data['poItemDets'] = purchaseOrderItemDet($orderId);
            $data['poCharges'] = freightChargeDets($orderId,"SELLER");
            $data['clearanceDet'] = clearancDet($orderId,'row');
            $data['busUnit'] = busUnitDetail(array('where'=>"WHERE BU_CODE = 111"));

            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PurchaseView',$data);
            $this->load->view('layout/footer');

        }
        
        public function PurchaseInvoice(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PurchaseInvoice');
            $this->load->view('layout/footer');

        }
        
         public function PriceChangerAdd(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            /*================== USER ROLE =================*/
            if ($sesData->USER_TYPE == 'USER') {
                $redirectCont = false;
                if(!dashRole(["role_check"=>"PURCHASE_PRICE_CHANGE_ORDER_UPDATE"])){
                    $this->session->set_flashdata(['PURCHASE_PRICE_CHANGE_ORDER_UPDATE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No price chnager update has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PriceChanger',$data);
            $this->load->view('layout/footer');

        }
        
        public function PriceChangerView(){
            sessionCheck();
            $sesData = sessionUserData();
            /*================== USER ROLE =================*/
            if ($sesData->USER_TYPE == 'USER') {
                $redirectCont = false;
                if(!dashRole(["role_check"=>"PURCHASE_PRICE_CHANGE_ORDER_LIST"])){
                    $this->session->set_flashdata(['PURCHASE_PRICE_CHANGE_ORDER_LIST_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No price changer list has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PriceChangerView');
            $this->load->view('layout/footer');

        }
        
         public function landingCost(){
            sessionCheck();
            $sesData = sessionUserData();
            /*================== USER ROLE =================*/
            if ($sesData->USER_TYPE == 'USER') {
                $redirectCont = false;
                if(!dashRole(["role_check"=>"PURCHASE_FREIGHT_DETAIL"])){
                    $this->session->set_flashdata(['PURCHASE_FREIGHT_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No purchase order freight detail has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $orderId = dataEncypt($this->input->get('orderid'),'decrypt')?dataEncypt($this->input->get('orderid'),'decrypt'):dataEncyptManual($this->input->get('bakOrderid'),'decrypt');
            purchaseOrderHeaderDet($orderId,'num_rows')>0?null:redirect(base_url('PurchaseList'), 'refresh');
            $data['orderid'] = $orderId;
            $data['sesData'] = $sesData;
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/LandingCost',$data);
            $this->load->view('layout/footer');

        }
        
        public function PurchaseInvoiceList(){
            sessionCheck();

            $sesData = sessionUserData();
            /*================== USER ROLE =================*/
            if ($sesData->USER_TYPE == 'USER') {
                $redirectCont = false;
                if(!dashRole(["role_check"=>"PURCHASE_INVOICE_LIST"])){
                    $this->session->set_flashdata(['PURCHASE_INVOICE_LIST_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No purchase Invoice list has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['purchaseType'] = 'invoice';
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PurchaseList',$data);
            // $this->load->view('layout/purchase/PurchaseInvoiceList');
            $this->load->view('layout/footer');

        }
        
         public function PurchaseReturn(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PurchaseReturn');
            $this->load->view('layout/footer');

        }
        
         public function PurchaseReturnList(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PurchaseReturnList');
            $this->load->view('layout/footer');

        }
        
         public function PaymentOut(){
            sessionCheck();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['js_min_con'] = FALSE;
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PaymentOut',$data);
            $this->load->view('layout/footer',$data);

        }
        
        public function voucherPrint(){
            $vochNo = $this->input->get('vouc-no');
            $vouchType = $this->input->get('vouc-type');
            $vochNo = dataEncypt($vochNo, 'decrypt');
            if ($vouchType == 'P') {
                $detail = $this->unicon->CoreQuery("SELECT *,V_NAME AS V_NAME,V_NAME_AR AS V_NAME_AR FROM PAYMENT_VOCHER PV,PAY_METHODS PM,VENDOR V
                                                WHERE PM_CODE = PV_PAY_METH AND V_CODE = PV_PARTIES_CODE
                                                AND PV_ID='$vochNo'","row");
                $data['detail'] = $detail?$detail:redirect(base_url('PaymentOut'),'refresh');
                $data['head'] = "PAYMENT OUT";
            }elseif ($vouchType == 'S') {
                $detail = $this->unicon->CoreQuery("SELECT *,CUST_NAME AS V_NAME,CUST_NAME_AR AS V_NAME_AR FROM PAYMENT_VOCHER PV,PAY_METHODS PM,CUSTOMER C
                                                WHERE PM_CODE = PV_PAY_METH AND CUST_CODE = PV_PARTIES_CODE
                                                AND PV_ID='$vochNo'","row");
                $data['detail'] = $detail?$detail:redirect(base_url('Payment'),'refresh');
                $data['head'] = "PAYMENT IN";
            }else{
                redirect(base_url(),'refresh');
            }
            
            $this->load->view('layout/sale/Voucher',$data);
      
        }
        
         public function PaymentOutList(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/PaymentOutList');
            $this->load->view('layout/footer');

        }
        
        
// ############<!-- Users -->##################

        public function addItemTrait(){
            sessionCheck();
            if($this->input->get('type') == 'view'){
                $itemCode = dataEncypt($this->input->get('item_code'), 'decrypt') ? dataEncypt($this->input->get('item_code'), 'decrypt') : dataEncyptManual($this->input->get('item_code_bak'),'decrypt');
                $data['itemCode'] = $itemCode;

            }else{
                $itemCode = dataEncypt($this->input->get('item_code'), 'decrypt') ? dataEncypt($this->input->get('item_code'), 'decrypt') : dataEncyptManual($this->input->get('item_code_bak'),'decrypt');
                $data['itemCode'] = $itemCode;
                // $data['itemCode'] = $this->encryption->decrypt($this->session->userdata('item_code'));
            }

            $this->load->view('layout/header');
            $this->load->view('layout/product/addItemTrait',$data);
            $this->load->view('layout/footer');

         }

// ############<!-- Inventory -->##################

        public function Inventory(){

            $this->load->view('layout/header');
            $this->load->view('layout/inventory/Inventory');
            $this->load->view('layout/footer');

         }
         
          public function StockTransfer(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }

                if(!dashRole(["role_check"=>"INVENTORY_STOCK_TRANSFER_CREATE"])){
                    $this->session->set_flashdata(['INVENTORY_STOCK_TRANSFER_CREATE_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No stock transfer has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/inventory/StockTransfer',$data);
            $this->load->view('layout/footer');

         }
         
          public function StockRecevied(){

            $this->load->view('layout/header');
            $this->load->view('layout/inventory/StockRecevied');
            $this->load->view('layout/footer');

         }
         
         public function StockTransferView(){
            sessionCheck();
            $data['sesData'] = sessionUserData();
            $orderId = dataEncyptbase64($this->input->get('orderid'),'decrypt');

            $stockTransferOrderDets = StockTransferOrderDet(["where" => "WHERE STH_ORDER_NO = '$orderId'", "dataType" => 'result']);

            $data['stockTransferOrderDets'] = count($stockTransferOrderDets)>0?$stockTransferOrderDets:redirect(base_url('StockTransferList'),'refresh');
            $data['wharehouseFrom'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE = '{$data['stockTransferOrderDets'][0]->STH_FROM_WHSE}'","dataType"=>'row']);
            $data['wharehouseto'] = wherehouseDetail(["where"=>"WHERE WHSE_CODE = '".$data['stockTransferOrderDets'][0]->STH_WHSE_TO."'","dataType"=>'row']);
            
            $whseAs = assignRoleBreak();
            $data['whse_assign'] = $whseAs['whse_assign'];

            //Print Vaiable
            $data['pOrderId'] = dataEncyptbase64($orderId,'encrypt');
            $this->load->view('layout/header');
            $this->load->view('layout/inventory/StockTransferView',$data);
            $this->load->view('layout/footer');

         }
         
          public function StockAdjustment(){

            $this->load->view('layout/header');
            $this->load->view('layout/inventory/StockAdjustment');
            $this->load->view('layout/footer');

         }
         
          public function PhysicalInventory(){

            sessionCheck();
            $sesData = sessionUserData();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);
            /*================== USER ROLE =================*/
            if ($sesData->USER_TYPE == 'USER') {
                $redirectCont = $redirectContWhse = FALSE;

                $whseAs = assignRoleBreak();
                
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectContWhse = true;
                    
                }

                if(!dashRole(["role_check"=>"INVENTORY_PHYSICAL_INVENTROY_COUNT_CREATE"])){
                    $this->session->set_flashdata(['PURCHASE_PRICE_CHANGE_ORDER_UPDATE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No price chnager update has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                
                if($redirectCont || $redirectContWhse){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['busUnits'] = busUnit(['dataType'=>'result']);
            $this->load->view('layout/header');
            $this->load->view('layout/inventory/PhysicalInventory',$data);
            $this->load->view('layout/footer');

            // $this->load->view('layout/header');
            // $this->load->view('layout/inventory/PhysicalInventory');
            // $this->load->view('layout/footer');

         }
         
          public function InventoryList(){
            sessionCheck();
            $sesData = sessionUserData();
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }

                if(!dashRole(["role_check"=>"INVENTORY_INVENTORY_LIST"])){
                    $this->session->set_flashdata(['INVENTORY_LIST_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No inventory list has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['whareDets'] = wherehouseDetail(['dataType' => 'result']);
            $this->load->view('layout/header');
            $this->load->view('layout/inventory/InventoryList',$data);
            $this->load->view('layout/footer');

         }
         
          public function StockTransferList(){
            sessionCheck();
            $this->load->view('layout/header');
            $this->load->view('layout/inventory/StockTransferList');
            $this->load->view('layout/footer');

         }
         
          public function StockReceviedList(){

            $this->load->view('layout/header');
            $this->load->view('layout/inventory/StockReceviedList');
            $this->load->view('layout/footer');

         }
         
          public function StockAdjustmentList(){

            $this->load->view('layout/header');
            $this->load->view('layout/inventory/StockAdjustmentList');
            $this->load->view('layout/footer');

         }
         
          public function PhysicalInventoryList(){
            sessionCheck();
            $sesData = sessionUserData();
            /*================== USER ROLE =================*/
            if ($sesData->USER_TYPE == 'USER') {
                $redirectCont = false;
                if(!dashRole(["role_check"=>"INVENTORY_PHYSICAL_INVENTROY_COUNT_LIST"])){
                    $this->session->set_flashdata(['PURCHASE_PRICE_CHANGE_ORDER_LIST_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No price changer list has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }

            $this->load->view('layout/header');
            $this->load->view('layout/inventory/PhysicalInventoryList');
            $this->load->view('layout/footer');

         }

/*================================ USER ROLE MANAGEMENT ==============================*/

    public function createGrpMod(){
        sessionCheck();
        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['busUnits'] = busUnit();
        $data['modules'] = module(['type'=>"AND MAF_TYPE='MODULE'"]);
        $this->load->view('layout/header');
        $this->load->view('layout/user_role_management/create_module_assign',$data);
        $this->load->view('layout/footer');
    }

    public function userRoleAsign(){
        sessionCheck();
        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;

        $this->load->view('layout/header');
        $this->load->view('layout/user_role_management/user_role_assign',$data);
        $this->load->view('layout/footer',$data);
    }

    public function groupModuleList(){
        sessionCheck();

        $this->load->view('layout/header');
        $this->load->view('layout/user_role_management/group_module_list');
        $this->load->view('layout/footer');
    }

    public function userRoleAsignList(){
        sessionCheck();

        $this->load->view('layout/header');
        $this->load->view('layout/user_role_management/user_assign_list');
        $this->load->view('layout/footer');
    }
/*================================ ACCOUNT ==============================*/
    public function newAccSetup(){
        sessionCheck();
        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;
        $data['busUnits'] = busUnit();
        $data['mainHead'] = accHeadDet(['where'=>"GROUP BY AH_MAIN_HEAD",'dataType'=>'result']);
  
        $this->load->view('layout/header');
        $this->load->view('layout/account/new_acc_setup',$data);
        $this->load->view('layout/footer',$data);
    }

    public function glMudleProfleTest(){
        sessionCheck();
        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;
        $data['busUnits'] = busUnit();
        
        $data['layouts'] = glModuleProfileLayout();
        $this->load->view('layout/header');
        $this->load->view('layout/account/lg_module_profile',$data);
        $this->load->view('layout/footer',$data);
    }

    public function glMudleProfle(){
        sessionCheck();

        $glBatchCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($glBatchCode)){
                
                $glDet = glModuleAccDet(['where'=>"AND GLMP_BATCH_CODE='$glBatchCode'",'dataType'=>'result']);
               
                $this->session->set_flashdata(['INVALID_WHSE_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity GL MODULE PROFILE URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['glDet'] = $glDet?$glDet:redirect(base_url('dashboard'),'refresh');
            }
            
        $data['glBatchCode'] = $glBatchCode;


        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;
        $data['busUnits'] = busUnit(['dataType'=>'result']);
        $data['costCentDet'] = costCenter(['dataType'=>'result']);

        
        // $data['layouts'] = glModuleProfileLayout();
        $this->load->view('layout/header');
        $this->load->view('layout/account/gl_mod_profile_new',$data);
        $this->load->view('layout/footer',$data);
    }

    public function glEntry(){
        sessionCheck();

        $glEntryId = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($glEntryId)){
                
                $glDet = glEntryDatail(['where'=>"AND GLJH_ID='$glEntryId'",'dataType'=>'result']);
               
                $this->session->set_flashdata(['INVALID_WHSE_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity GL Entry URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['glDet'] = $glDet?$glDet:redirect(base_url('dashboard'),'refresh');
            }
            
        $data['glEntryId'] = $glEntryId;

        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;
        $data['busUnits'] = busUnit(['dataType'=>'result']);
        $data['prefixs'] = glPrefix(array('dataType'=>'result'));
        $data['costCentDet'] = costCenter(['dataType'=>'result']);

        $this->load->view('layout/header');
        $this->load->view('layout/account/gl_entry',$data);
        $this->load->view('layout/footer',$data);
    }

    public function glEntryList(){
        sessionCheck();
        $data['postType'] = 'N';
        $this->load->view('layout/header');
        $this->load->view('layout/account/gl_entry_list',$data);
        $this->load->view('layout/footer');
    }

    public function systemGlEntry(){
        sessionCheck();
        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);
        $data['mainTitle'] = 'Post SO G/L';
        $data['subTitle'] = 'POST SALE JOURNAL TO G/L';
        $data['submit'] = 'Sale';
        $this->load->view('layout/header');
        $this->load->view('layout/account/system_gl_entry',$data);
        $this->load->view('layout/footer');
    }

    public function systemGlEntryPO(){
        sessionCheck();
        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_CODE = '01'",'dataType' => 'result']);
        $data['mainTitle'] = 'Post PO G/L';
        $data['subTitle'] = 'POST PURCHASE JOURNAL TO G/L';
        $data['submit'] = 'Purchase';
        $this->load->view('layout/header');
        $this->load->view('layout/account/system_gl_entry',$data);
        $this->load->view('layout/footer');
    }

    public function systemGlEntryMT(){
        sessionCheck();
        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE IN('SL','DC','OW')",'dataType' => 'result']);
        $data['mainTitle'] = 'Post MT G/L';
        $data['subTitle'] = 'POST TRANSFER JOURNAL TO G/L';
        $data['submit'] = 'Transfer';
        $this->load->view('layout/header');
        $this->load->view('layout/account/system_gl_entry',$data);
        $this->load->view('layout/footer');
    }

    public function postGLEntry(){
        sessionCheck();
        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['mainTitle'] = 'Post GL Entry';
        $data['subTitle'] = 'POST GL Entry';
        $data['submit'] = 'POST GL';
        $data['prefixs'] = glPrefix(array('dataType'=>'result'));
        $this->load->view('layout/header');
        $this->load->view('layout/account/post_gl_entry',$data);
        $this->load->view('layout/footer');
    }

    public function glEntryPostedList(){
        sessionCheck();
        $data['postType'] = 'P';
        $this->load->view('layout/header');
        $this->load->view('layout/account/gl_entry_list',$data);
        $this->load->view('layout/footer');
    }

    public function glTrans(){
        sessionCheck();

        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;

        // $data['layouts'] = glModuleProfileLayout();
        $this->load->view('layout/header');
        $this->load->view('layout/account/gl_transaction',$data);
        $this->load->view('layout/footer',$data);
    }

    public function glTransSale(){
        sessionCheck();

        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;
        $data['headerTitle'] = 'Sale GL Transaction';
        $data['moduleTitle'] = 'Sale';
        $data['moduleType'] = 'SO';
        // $data['layouts'] = glModuleProfileLayout();
        $this->load->view('layout/header',$data);
        $this->load->view('layout/account/gl_transaction',$data);
        $this->load->view('layout/footer',$data);
    }

    public function glTransAccRec(){
        sessionCheck();

        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;
        $data['headerTitle'] = 'Account Receivable GL Transaction';
        $data['moduleTitle'] = 'Account Receivale';
        $data['moduleType'] = 'AR';
        // $data['layouts'] = glModuleProfileLayout();
        $this->load->view('layout/header',$data);
        $this->load->view('layout/account/gl_transaction',$data);
        $this->load->view('layout/footer',$data);
    }

    public function glTransPurchase(){
        sessionCheck();

        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;
        $data['headerTitle'] = 'Purchase GL Transaction';
        $data['moduleTitle'] = 'Purchase';
        $data['moduleType'] = 'PO';
        // $data['layouts'] = glModuleProfileLayout();
        $this->load->view('layout/header',$data);
        $this->load->view('layout/account/gl_transaction',$data);
        $this->load->view('layout/footer',$data);
    }

    public function glTransStock(){
        sessionCheck();

        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;
        $data['headerTitle'] = 'Inventory GL Transaction';
        $data['moduleTitle'] = 'Inventory';
        $data['moduleType'] = 'INV';
        // $data['layouts'] = glModuleProfileLayout();
        $this->load->view('layout/header',$data);
        $this->load->view('layout/account/gl_transaction',$data);
        $this->load->view('layout/footer',$data);
    }

    public function itemTrans(){
        sessionCheck();

        $data['sweetAlertMsg'] = sweetAlertMsg();
        $data['js_min_con'] = FALSE;
        $data['headerTitle'] = 'Inventory Item Transaction';
        $data['moduleTitle'] = 'Inventory';
        // $data['layouts'] = glModuleProfileLayout();
        $this->load->view('layout/header',$data);
        $this->load->view('layout/inventory/itemTransaction',$data);
        $this->load->view('layout/footer',$data);
    }

// ############<!-- Users -->##################
        
        public function EmployeesAdd(){
            sessionCheck();

            $empCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($empCode)){
                
                $CuntyDet = empdetail(['where'=>"WHERE EMP_CODE='$empCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_CNTRY_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Country Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['empDet'] = $CuntyDet?$CuntyDet:redirect(base_url('dashboard'),'refresh');
                $data['stateDet'] = stateList(['where'=>"WHERE ST_CODE = '{$data['empDet']->EMP_STATE}'",'dataType'=>'result']);
                $data['citiesDet'] = citiesList(['where'=>"WHERE CTY_CODE = '{$data['empDet']->EMP_CITY_ID}'",'dataType'=>'result']);
            }
            $data['empCode'] = $empCode;

            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['countryLists'] = countryList();
            $data['busUnits'] = busUnit();
            $data['empCats'] = empCat();
            $this->load->view('layout/header');
            $this->load->view('layout/users/EmployeesAdd',$data);
            $this->load->view('layout/footer');
        }
        
        
        public function EmployeesList(){
            sessionCheck();

            $this->load->view('layout/header');
            $this->load->view('layout/users/EmployeesList');
            $this->load->view('layout/footer');
        }
        
        
        public function SalesManAdd(){
            sessionCheck();
            
            $data['js_min_con'] = FALSE;

            $data['busUnits'] = busUnit();
            $data['saleAreas'] = salesArea();
            $data['whareDets'] = wherehouseDetail(['dataType' => 'result']);
            $this->load->view('layout/header');
            $this->load->view('layout/users/SalesManAdd',$data);
            $this->load->view('layout/footer',$data);
        }
        
        
        public function SalesManList(){
            sessionCheck();
            $data['whareDets'] = wherehouseDetail(['dataType' => 'result']);
            $this->load->view('layout/header');
            $this->load->view('layout/users/SalesManList',$data);
            $this->load->view('layout/footer');
        }
        
        
        // ############<!-- Reports -->##################
        
        
        public function Payments(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/reports/Payments');
            $this->load->view('layout/footer');

        }
        
        
        public function ProductReport(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/reports/ProductReport');
            $this->load->view('layout/footer');

        }
        
        public function PurchaseReport(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/reports/PurchaseReport');
            $this->load->view('layout/footer');

        }
        
        public function SaleReport(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/reports/SaleReport');
            $this->load->view('layout/footer');

        }

// ############<!-- Master -->##################
       
        public function BusinessUnitList(){
            sessionCheck();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/BusinessUnitList');
            $this->load->view('layout/footer');

        }

        public function BusinessUnitAdd(){
            sessionCheck();
            
            $busunitCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($busunitCode)){
                
                $busDet = busUnitDetail(['where'=>"WHERE BU_CODE='$busunitCode'",'dataType'=>'row']);
                
                $this->session->set_flashdata(['INVALID_WHSE_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Business Unit URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['busDet'] = $busDet?$busDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['busunitCode'] = $busunitCode;
            $data['countryLists'] = countryList();
             $data['statesLists'] = stateList();
            $data['citiesLists'] = citiesList();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            
            
            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/BusinessUnitAdd',$data);
            $this->load->view('layout/footer');

        }
        
        public function WarehouseList(){
            sessionCheck();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/WarehouseList');
            $this->load->view('layout/footer');

        }

        public function WarehouseAdd(){
            sessionCheck();
            $whseCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($whseCode)){
                
                $whseDet = wherehouseDetail(['where'=>"WHERE WHSE_CODE='$whseCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_WHSE_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity warehouse URL update .
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['whseDet'] = $whseDet?$whseDet:redirect(base_url('dashboard'),'refresh');
            }
            $data['whseCode'] = $whseCode;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $data['countryLists'] = countryList();
            $data['statesLists'] = stateList();
            $data['citiesLists'] = citiesList();
            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/WarehouseAdd',$data);
            $this->load->view('layout/footer');

        }
        

        public function CountryList(){
            sessionCheck();
            
            $CuntyCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($CuntyCode)){
                
                $CuntyDet = countryList(['where'=>"WHERE CNTRY_CODE='$CuntyCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_CNTRY_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Country Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['CuntyDet'] = $CuntyDet?$CuntyDet:redirect(base_url('dashboard'),'refresh');
            }
            $data['CuntyCode'] = $CuntyCode;            
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['currencyLists'] = currencyList();            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/country',$data);
            $this->load->view('layout/footer');
        }

        public function stateList(){
            sessionCheck();

            $StateCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($StateCode)){
                
                $StateDet = stateList(['where'=>"WHERE ST_CODE='$StateCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ST_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Country Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['StateDet'] = $StateDet?$StateDet:redirect(base_url('dashboard'),'refresh');
            }
            $data['StateCode'] = $StateCode;           
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['countryLists'] = countryList();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/stateList',$data);
            $this->load->view('layout/footer');
        }

        public function CountryAdd(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/add/country_add');
            $this->load->view('layout/footer');

        }

        // Currency

        public function CurrencyList(){
            sessionCheck();

            $currCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($currCode)){
                
                $currDet = currencyList(['where'=>"WHERE CUR_CODE='$currCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_CURR_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity currency Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['currDet'] = $currDet?$currDet:redirect(base_url('dashboard'),'refresh');
            }
            $data['currCode'] = $currCode;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/CurrencyList',$data);
            $this->load->view('layout/footer');

        }
        
        public function CurrencyExList(){
            sessionCheck();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['currencyLists'] = currencyList();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/CurrencyExList',$data);
            $this->load->view('layout/footer');

        }
        
        
         public function CityList(){
            sessionCheck();

            $CityCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($CityCode)){
                
                $CityDet = citiesList(['where'=>"WHERE CTY_CODE='$CityCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_CTY_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity City Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['CityDet'] = $CityDet?$CityDet:redirect(base_url('dashboard'),'refresh');
            }
            $data['CityCode'] = $CityCode;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['stateLists'] = stateList();

            $this->load->view('layout/header');
            $this->load->view('layout/setting/CityList',$data);
            $this->load->view('layout/footer');

        }

        public function CityAdd(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/add/CityAdd');
            $this->load->view('layout/footer');

        }
        
        public function UOMList(){
            sessionCheck();
            $uomCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($uomCode)){
                
                $uomDet = uomList(['where'=>"WHERE UOM_CODE='$uomCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_UOM_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Unit of measurement Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['uomDet'] = $uomDet?$uomDet:redirect(base_url('dashboard'),'refresh');
            }
            $data['uomCode'] = $uomCode;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/UOMList',$data);
            $this->load->view('layout/footer');

        }

        public function UOMAdd(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/add/UOMAdd');
            $this->load->view('layout/footer');

        }
        
        public function ItemCategoryList(){
            sessionCheck();

            $itemCatCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($itemCatCode)){
                
                $itemCatDet = categoryList(['where'=>"WHERE ICAT_CODE='$itemCatCode'",'dataType'=>'row']);
                // print_r($itemCatDet);
                $this->session->set_flashdata(['INVALID_ITEM_CAT_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity item category URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['itemCatDet'] = $itemCatDet?$itemCatDet:redirect(base_url('dashboard'),'refresh');
            }
            $data['itemCatCode'] = $itemCatCode;

            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/ItemCategoryList',$data);
            $this->load->view('layout/footer');

        }
        
        
         public function ShipList(){
            sessionCheck();

            $shipViaList = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($shipViaList)){
                
                $shipViaListDet = shipViaList(['where'=>"WHERE SHIPV_CODE='$shipViaList'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity SHip Via list Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['shipViaListDet'] = $shipViaListDet?$shipViaListDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['shipViaList'] = $shipViaList;

            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/ShipList',$data);
            $this->load->view('layout/footer');

        }
        public function bulkItemUpload(){
            sessionCheck();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $msg = $this->session->flashdata('ITEM_BULK_MSG');
            if($msg){
                $mesData = $this->unicon->CoreQuery("SELECT * FROM FLASHDATA_MSG WHERE FM_ID='$msg'","row");
                        $this->unicon->CoreQuery("DELETE FROM FLASHDATA_MSG WHERE FM_ID='$msg'");
            }
            $data['msg'] = isset($mesData)?$mesData:null;
            $this->load->view('layout/header');
            $this->load->view('layout/product/bulkItemUpload',$data);
            $this->load->view('layout/footer');

        }

        public function vendorPriceUpload(){
            sessionCheck();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $msg = $this->session->flashdata('ITEM_BULK_MSG');
            if($msg){
                $mesData = $this->unicon->CoreQuery("SELECT * FROM FLASHDATA_MSG WHERE FM_ID='$msg'","row");
                        $this->unicon->CoreQuery("DELETE FROM FLASHDATA_MSG WHERE FM_ID='$msg'");
            }
            $data['msg'] = isset($mesData)?$mesData:null;
            $this->load->view('layout/header');
            $this->load->view('layout/purchase/vendor_price_upload',$data);
            $this->load->view('layout/footer');

        }

        public function bulkItemTraitUpload(){
            sessionCheck();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $msg = $this->session->flashdata('ITEM_BULK_MSG');
            if($msg){
                $mesData = $this->unicon->CoreQuery("SELECT * FROM FLASHDATA_MSG WHERE FM_ID='$msg'","row");
                        $this->unicon->CoreQuery("DELETE FROM FLASHDATA_MSG WHERE FM_ID='$msg'");
            }
            $data['msg'] = isset($mesData)?$mesData:null;
            $this->load->view('layout/header');
            $this->load->view('layout/product/bulkItemTraitUpload',$data);
            $this->load->view('layout/footer');

        }

        public function bulkImageUpload(){
            sessionCheck();
            $data['imageDets'] = $this->unicon->CoreQuery("SELECT * FROM BULK_IMAGE_UPLOAD","result");
            $this->load->view('layout/header');
            $this->load->view('layout/product/bulkImageUpload',$data);
            $this->load->view('layout/footer');

        }
        // public function ItemCategoryAdd(){
            
        //     $this->load->view('layout/header');
        //     $this->load->view('layout/setting/add/ItemCategoryAdd');
        //     $this->load->view('layout/footer');

        // }
        
        public function ItemClassList(){
            sessionCheck();
            $itemClassCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;

            if(isset($itemClassCode)){
                
                $itemClassDet = classList(['where'=>"WHERE IC_CODE='$itemClassCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Item class Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['itemClassDet'] = $itemClassDet?$itemClassDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['itemClassCode'] = $itemClassCode;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $data['categoryLists'] = categoryList();
            $data['uomLists'] = uomList();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/ItemClassList',$data);
            $this->load->view('layout/footer');

        }

        // public function ItemClassAdd(){
            
        //     $this->load->view('layout/header');
        //     $this->load->view('layout/setting/add/ItemClassAdd');
        //     $this->load->view('layout/footer');

        // }
        
        public function PasswordList(){
            sessionCheck();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/PasswordList',$data);
            $this->load->view('layout/footer');
        }
        
        public function PasswordUsedList(){
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/PasswordUsedList',$data);
            $this->load->view('layout/footer');

        }

        public function TraiteCategoryList(){
            sessionCheck();
            $traitCatCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;

            if(isset($traitCatCode)){
                
                $traitCatDet = traitCatList(['where'=>"WHERE TC_CODE='$traitCatCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity trait Cat Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['traitCatDet'] = $traitCatDet?$traitCatDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['traitCatCode'] = $traitCatCode;

            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();

            $this->load->view('layout/header');
            $this->load->view('layout/setting/TraiteCategoryList',$data);
            $this->load->view('layout/footer');

        }


        public function TraiteCategoryAdd(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/add/TraiteCategoryAdd');
            $this->load->view('layout/footer');

        }
        
        
         public function TraitesList(){
            sessionCheck();

            $traitCode = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;

            if(isset($traitCode)){
                
                $traitDet = traitAddList(['where'=>"WHERE TRAIT_SUB_CAT_CODE='$traitCode'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Trait Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['traitDet'] = $traitDet?$traitDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['traitCode'] = $traitCode;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['traitCatLists'] = traitCatList();

            $this->load->view('layout/header');
            $this->load->view('layout/setting/TraitesList',$data);
            $this->load->view('layout/footer');

        }

        public function TraitesAdd(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/add/TraitesAdd');
            $this->load->view('layout/footer');

        }
        



        public function PaymentMethodList(){
            sessionCheck();
            $Paylist = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;

            if(isset($Paylist)){
                
                $PaylistDet = paymentList(['where'=>"WHERE PM_CODE='$Paylist'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Pay list Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['PaylistDet'] = $PaylistDet?$PaylistDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['Paylist'] = $Paylist;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/PaymentMethodList',$data);
            $this->load->view('layout/footer');

        }

        public function PaymentMethodAdd(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/add/PaymentMethodAdd');
            $this->load->view('layout/footer');
        }
        
         public function BankList(){
            
            sessionCheck();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $data['bankDet'] = bankDet();
            $data['countryLists'] = countryList();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/BankList',$data);
            $this->load->view('layout/footer');

        }

        public function BankAdd(){
            
            $this->load->view('layout/header');
            $this->load->view('layout/setting/add/BankAdd');
            $this->load->view('layout/footer');

        }
        

        public function POChargesList(){
            sessionCheck();

            $poChargeId = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;

            if(isset($poChargeId)){
                
                $poChargeDets = poChargeDet(['where'=>"WHERE CHRG_TYPE='$poChargeId'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity PO Charge list Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['poChargeDets'] = $poChargeDets?$poChargeDets:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['poCHargeId'] = $poChargeId;

            $data['sweetAlertMsg'] = sweetAlertMsg();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/POChargesList',$data);
            $this->load->view('layout/footer');

        }
        
         public function FOBList(){
            sessionCheck();

            $fobList = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($fobList)){
                
                $fobListDet = fobList(['where'=>"WHERE FOB_CODE='$fobList'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity FOB list Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['fobListDet'] = $fobListDet?$fobListDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['fobList'] = $fobList;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/FOBList',$data);
            $this->load->view('layout/footer');

        }
        public function FreightList(){
            sessionCheck();
            $FrightList = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;

            if(isset($FrightList)){
                
                $FrightListDet = frightList(['where'=>"WHERE FRT_CODE='$FrightList'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity Fright list Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['FrightListDet'] = $FrightListDet?$FrightListDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['FrightList'] = $FrightList;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/FreightList',$data);
            $this->load->view('layout/footer');

        }

        public function TermsList(){
            sessionCheck();

            $termsList = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($termsList)){
                
                $termsListDet = termsList(['where'=>"WHERE TERM_CODE='$termsList'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity SHip Via list Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['termsListDet'] = $termsListDet?$termsListDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['termsList'] = $termsList;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/TermsList',$data);
            $this->load->view('layout/footer');

        }
        
        public function POPrefixesList(){
            sessionCheck();

            $poPrefixList = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($poPrefixList)){
                
                $poPrefixListDet = poPrefixDet(['where'=>"WHERE POP_ORDER_PFX='$poPrefixList'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity SHip Via list Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['poPrefixListDet'] = $poPrefixListDet?$poPrefixListDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['poPrefixList'] = $poPrefixList;

            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/POPrefixesList',$data);
            $this->load->view('layout/footer');

        }
        public function FiscalYearsList(){
            sessionCheck();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $data['fYearList'] = fYearList();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/FiscalYearsList',$data);
            $this->load->view('layout/footer');

        }
        public function FiscalPeriodsList(){
            sessionCheck();

            $fiscalPeriodList = dataEncyptbase64($this->input->get('tokenid'),'decrypt')?dataEncyptbase64($this->input->get('tokenid'),'decrypt'):null;
            if(isset($fiscalPeriodList)){
                
                $fiscalPeriodListDet = fiscalPeriodDet(['where'=>"WHERE FP_ID='$fiscalPeriodList'",'dataType'=>'row']);
                $this->session->set_flashdata(['INVALID_ITEM_CLASS_CODE'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                                            <i class='mdi mdi-check-all me-2'></i>
                                                                            illegal activity SHip Via list Code URL update.
                                                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                                        </div>"]);
                $data['fiscalPeriodListDet'] = $fiscalPeriodListDet?$fiscalPeriodListDet:redirect(base_url('dashboard'),'refresh');
            }
            
            $data['fiscalPeriodList'] = $fiscalPeriodList;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $this->load->view('layout/header');
            $this->load->view('layout/setting/FiscalPeriodsList',$data);
            $this->load->view('layout/footer');

        }
        public function GLPrefixesList(){
            sessionCheck();
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $data['glPrefix'] = glPrefix(array('dataType'=>'row'));
            $data['glPrefixs'] = glPrefix(array('dataType'=>'result'));
            $this->load->view('layout/header');
            $this->load->view('layout/setting/GLPrefixesList',$data);
            $this->load->view('layout/footer');

        }
        /**========================================================================
         *                           REPORTING LAYOUT
         *========================================================================**/

        /*================== STOCK STATUS ORDER BY CLASS REPORT =================*/
         public function stockStatusOrderByClass(){
            sessionCheck();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE IN('SL','DC','OW')",'dataType' => 'result']);
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['itemDet'] = itemList(['dataType'=>'result']);
            $data['mainTitle'] = 'Stock Status Order By Class Reporting';
            $data['subTitle'] = 'Stock Status Order By Class';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== STOCK STATUS ORDER BY CLASS AC REPORT =================*/
        public function stockStatusOrderByClassAc(){
            sessionCheck();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE IN('SL','DC','OW')",'dataType' => 'result']);
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['itemDet'] = itemList(['dataType'=>'result']);
            $data['mainTitle'] = 'Stock Status Order By Class Ac Reporting';
            $data['subTitle'] = 'Stock Status Order By Class Ac';
            $data['submit'] = 'Print Report';
            $data['reportType'] = 'AC';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== STOCK STATUS ORDER BY CLASS CONS REPORT =================*/
        public function stockStatusOrderByClassCon(){
            sessionCheck();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE IN('SL','DC','OW')",'dataType' => 'result']);
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['itemDet'] = itemList(['dataType'=>'result']);
            $data['mainTitle'] = 'Stock Status Order By Class CONS Reporting';
            $data['subTitle'] = 'Stock Status Order By Class CONS';
            $data['submit'] = 'Print Report';
            $data['reportType'] = 'CON';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== STOCK BY VENDOR PRICE REPORT =================*/
        public function stkVenPrice(){
            sessionCheck();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE IN('SL','DC','OW')",'dataType' => 'result']);
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            $data['mainTitle'] = 'Stock by vendor price Report';
            $data['subTitle'] = 'Stock by vendor price Report';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm_stk_by_ven_price',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== VENDOR STOCK REPORT =================*/
        
        public function vendorStockReport(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            $data['currDet'] = currencyList(['dataType'=>'result']);
            $data['classDet'] = classList(['dataType'=>'result']);
            $data['itemDet'] = itemList(['dataType'=>'result']);
            $data['mainTitle'] = 'Vendor Stock Report';
            $data['subTitle'] = 'Vendor Stock Report';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm_vendor_stock',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== STOCK STATUS AS OF DATE REPORT =================*/
        
        public function stkStaDate(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            $data['currDet'] = currencyList(['dataType'=>'result']);
            $data['classDet'] = classList(['dataType'=>'result']);
            $data['itemDet'] = itemList(['dataType'=>'result']);
            $data['mainTitle'] = 'Stock Status As of Date';
            $data['subTitle'] = 'Stock Status As of Date';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm_stock_status_date',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== INVENTORY TRANSFER ORDER WITH PICTURE REPORT =================*/
        
        public function invTransfOrdWithPic(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $data['mainTitle'] = 'Inventory Transfer Order With Picture Report';
            $data['subTitle'] = 'Inventory Transfer Order With Picture';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm_inv_transf_order_with_pic',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== YEAR SALE COMPANY MONTH REPORT =================*/
        
        public function yearSaleMonReport(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $data['months'] = array(
                                        "01-January",
                                        "02-February",
                                        "03-March",
                                        "04-April",
                                        "05-May",
                                        "06-June",
                                        "07-July",
                                        "08-August",
                                        "09-September",
                                        "10-October",
                                        "11-November",
                                        "12-December"
                                    ); 
            $data['mainTitle'] = 'Year Sale Comp Month Report';
            $data['subTitle'] = 'Year Sale Comp Month';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm_year_sale_comp_mon_rep',$data);
            $this->load->view('layout/footer',$data);
        }
        
        /*================== DAILY SALE REPORT =================*/
        
        public function dailySaleReport(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();

            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['mainTitle'] = 'Daily sale Reporting';
            $data['subTitle'] = 'Daily sale report';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/sale_order',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== PRODUCT WITH PICTURE REPORT =================*/
        
        public function itemWithPicReport(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();

            $data['whareDets'] = wherehouseDetail(['dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['mainTitle'] = 'Item with Picture Reporting';
            $data['subTitle'] = 'Item with Picture report';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm_item_with_picture',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== PRODUCT WITH PICTURE REPORT =================*/
        
        public function itemStockWithPicReport(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();

            $data['whareDets'] = wherehouseDetail(['dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            // $data['classDet'] = classList(['dataType'=>'result']);
            $data['sesData'] = $sesData;
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['mainTitle'] = 'Item stock with Picture Reporting';
            $data['subTitle'] = 'Item stock with Picture report';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm_item_stock_with_pic',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== MANUAL INVENTORY TRANSACTION =================*/
        
        public function manualInvTransReport(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();

            $data['whareDets'] = wherehouseDetail(['dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['reason'] = transReason(['dataType' => 'result']);
            $data['rule'] = transRule(['dataType' => 'result']);
            $data['mainTitle'] = 'Manual Inventory Transaction Report';
            $data['subTitle'] = 'Manual Inventory Transaction Report';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm_manual_inv_trans',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== MANUAL INVENTORY TRANSACTION VENDOR=================*/
        
        public function manualInvTransVendorReport(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();

            $data['whareDets'] = wherehouseDetail(['dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['type'] = 'Y';
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            $data['sesData'] = $sesData;
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['reason'] = transReason(['dataType' => 'result']);
            $data['rule'] = transRule(['dataType' => 'result']);
            $data['mainTitle'] = 'Manual Inventory Transaction Report';
            $data['subTitle'] = 'Manual Inventory Transaction Report';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/icm_manual_inv_trans',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== VENDOR PURCHASE BY DATE REPORT =================*/
        public function venPurByDate(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            $data['classDet'] = classList(['dataType'=>'result']);
            $data['itemDet'] = itemList(['dataType'=>'result']);
            $data['mainTitle'] = 'Vendor Purchase By Date Report';
            $data['subTitle'] = 'Vendor Purchase By Date';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/po_vendor_pur_by_date',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== CUSTOM & MISC. CHARGE REPORT =================*/
        public function custMiscCharg(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['busUnits'] = busUnit();
            $data['poChargeDet'] = poChargeDet(array('dataType'=>'result'));
            $data['months'] = array(
                                        "01-January",
                                        "02-February",
                                        "03-March",
                                        "04-April",
                                        "05-May",
                                        "06-June",
                                        "07-July",
                                        "08-August",
                                        "09-September",
                                        "10-October",
                                        "11-November",
                                        "12-December"
                                    ); 
            $data['mainTitle'] = 'Custom & Misc. Charge Report';
            $data['subTitle'] = 'Custom & Misc. Charge';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/po_custom_misc_charge',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== PAYMENT ACCOUNT LIST REPORT =================*/
        public function payAccList(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            $data['classDet'] = classList(['dataType'=>'result']);
            $data['itemDet'] = itemList(['dataType'=>'result']);
            $data['mainTitle'] = 'Payment Account List Report';
            $data['subTitle'] = 'Payment Account List';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/ap_pay_acc_list',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== VENDOR STATEMENT REPORT =================*/
        public function vendorState(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            $data['classDet'] = classList(['dataType'=>'result']);
            $data['itemDet'] = itemList(['dataType'=>'result']);
            $data['mainTitle'] = 'Vendor Statement Report';
            $data['subTitle'] = 'Vendor Statement';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/ap_vendor_state',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== VENDOR BALANCE AND AMOUNT DUE REPORT =================*/
        public function vendBalAndAmtDue(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            $data['classDet'] = classList(['dataType'=>'result']);
            $data['itemDet'] = itemList(['dataType'=>'result']);
            $data['mainTitle'] = 'Vendor Balance And Amount Due Report';
            $data['subTitle'] = 'Vendor Balance And Amount Due';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/ap_ven_bal_amt_due',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== CUSTOMER STATEMENT REPORT =================*/
        public function custState(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['mainTitle'] = 'Customer Statement Report';
            $data['subTitle'] = 'Customer Statement';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/ar_cust_state',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== CUSTOMER STATEMENT REPORT =================*/
        public function custTrailBal(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['mainTitle'] = 'Customer Trail Balance Report';
            $data['subTitle'] = 'Customer Trail Balance';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/ar_cust_trail_bal',$data);
            $this->load->view('layout/footer',$data);
        }


        /*================== PRINT PURCHASE ORDER RETAIL PRICE REPORT =================*/
        public function purOrderRP(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['sesData'] = $sesData;
            $data['mainTitle'] = 'Print Purchase Order Retail Price Report';
            $data['subTitle'] = 'Print Purchase Order Retail Price';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/po_pur_order_retail_price',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== CONSIGNMENT SALES REPORT =================*/
        public function consignSaleReport(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            $data['itemDet'] = itemList(['dataType'=>'result']);
            $data['mainTitle'] = 'Consignment Sales Report';
            $data['subTitle'] = 'Consignment Sales';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/so_conign_sales_report',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== MONTHLY SALES BY VENDOR BY CATEGORY REPORT =================*/
        public function monSaleyVenByCatReport(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();
            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['vendorDet'] = vendorList(['dataType'=>'result']);
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);
            $data['mainTitle'] = 'Monthly Sales By Vendor By Category Report';
            $data['subTitle'] = 'Monthly Sales By Vendor By Category';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/reports/so_month_sales_by_vendor_by_cata',$data);
            $this->load->view('layout/footer',$data);
        }

        /*================== TRAIL BALANCE REPORT =================*/
        
        public function trailBalanceReport(){
            sessionCheck();
            $sesData = sessionUserData();
            $data['js_min_con'] = FALSE;
            $data['sweetAlertMsg'] = sweetAlertMsg();

            $data['whareDets'] = wherehouseDetail(['where'=>"WHERE WHSE_LOCATION_TYPE = 'SL'",'dataType' => 'result']);
            //WAREHOUSE ASSIGNED
            if ($sesData->USER_TYPE == 'USER') {
                $whseAs = assignRoleBreak();
                $redirectCont = false;
                if(count($whseAs['whse_assign'])>0){
                    $data['whse_assign'] = $whseAs['whse_assign'];
                }else{
                    $this->session->set_flashdata(['USER_WHSE_NOT_ASSIGN_FLASH'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                        <i class='mdi mdi-alert-outline me-2'></i>
                                                        No warehouse has been assigned.
                                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                    </div>"]);
                    $redirectCont = true;
                    
                }
                if($redirectCont){
                    redirect(base_url("dashboard"),'refresh');
                }
            }
            $data['sesData'] = $sesData;
            $data['itemCat'] = categoryList(['where'=>'ORDER BY ICAT_CODE ASC','dataType' => 'result']);

            $data['months'] = array(
                                        "01-January",
                                        "02-February",
                                        "03-March",
                                        "04-April",
                                        "05-May",
                                        "06-June",
                                        "07-July",
                                        "08-August",
                                        "09-September",
                                        "10-October",
                                        "11-November",
                                        "12-December"
                                    ); 
            $data['costCentDet'] = costCenter(['dataType'=>'result']);    
              
            $data['allAccDet'] = $this->accountlib->allAccDet();
             

            $data['mainTitle'] = 'Account Trail Balance';
            $data['subTitle'] = 'Account Trail Balance';
            $data['submit'] = 'Print Report';
            $this->load->view('layout/header');
            $this->load->view('layout/account/acc_trail_bal',$data);
            $this->load->view('layout/footer',$data);
        }
    }