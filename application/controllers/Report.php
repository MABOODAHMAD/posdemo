<?php
     class Report extends CI_Controller{
         public function __construct(){
            parent::__construct();
      
            // $this->load->model('Site_model', 'dbcon');
            $this->load->model('Universal_model','unicon');
            // $this->load->library('form_validation');
            // $this->load->helper('form');
            //$this->load->model('QrController','qrcon');
            $this->load->model('FunctionAndProcedure_model','profunccon');
        }

        /*================================ STOKC STATUS ORDER BY CLASS ==============================*/
        
        
        public function stockStatusOrderByClass(){
            
            header('Content-Type: application/json');

            $userCon = sessionUserData();
            $cond = $this->input->post('report_type');
            if(isset($cond)){
              if ($cond != 'CON') {
                $this->form_validation->set_rules('item_cat_from','from item category','required');
                $this->form_validation->set_rules('item_cat_to','to item category','required');
              }
            }else{
              $this->form_validation->set_rules('item_cat_from','from item category','required');
              $this->form_validation->set_rules('item_cat_to','to item category','required');
            }
            
            $this->form_validation->set_rules('whse_code_db','warehouse code','required');
            // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
            // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                // $glType = $this->input->post('gl_type');
                // $dataArr = (object)array(
                //                     'from_date'=>$this->input->post('from_date_db'),
                //                     'to_date'=>$this->input->post('to_date_db'),
                //                     'whse_code'=>$this->input->post('whse_code_db'),
                //                     'gl_type' =>$glType,
                //                 );
                // if($glType == 'Sale'){
                //     $tr = $this->accountlib->saleGlentry($dataArr);
                // }elseif ($glType == 'NPO' || $glType == 'CPO') {
                //     $tr = $this->accountlib->poGlentry($dataArr);
                // }elseif ($glType == 'Transfer'){
                //     $tr = $this->accountlib->transGlentry($dataArr);
                // }  
                $tr = true;          
                // if($this->unicon->insertUniversal('GL_MODULE_PROFILE',$data)){ 
                if($tr){  
                    $urlCret = "fromItemCat=".dataEncyptbase64($this->input->post('item_cat_from'),'encrypt')."&toItemCat=".dataEncyptbase64($this->input->post('item_cat_to'),'encrypt')."&whseCode=".dataEncyptbase64($this->input->post('whse_code_db'),'encrypt')."&costType=".dataEncyptbase64($this->input->post('cost_type_db'),'encrypt')."&itemCodeFrom=".dataEncyptbase64($this->input->post('item_code_from_db'),'encrypt')."&itemCodeTo=".dataEncyptbase64($this->input->post('item_code_to_db'),'encrypt')."&reportType=".dataEncyptbase64($this->input->post('report_type'),'encrypt')."";
                    $pageRedirect = "<script>window.open('".base_url('report/stockStatusOrderByClassPrint?').$urlCret."');</script>";
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
                }else{
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
                }
            }
        }

        public function stockStatusOrderByClassPrint(){
            $userCon = sessionUserData();
            // $data['fromDate'] = $this->input->get('fromDate');
            // $data['toDate'] = $this->input->get('toDate');
            $data['fromItemCat'] = dataEncyptbase64($this->input->get('fromItemCat'),'decrypt');
            $data['toItemCat'] = dataEncyptbase64($this->input->get('toItemCat'),'decrypt');
            $data['whseCode'] = dataEncyptbase64($this->input->get('whseCode'),'decrypt');
            $data['costType'] = dataEncyptbase64($this->input->get('costType'),'decrypt');
            $data['reportType'] = dataEncyptbase64($this->input->get('reportType'),'decrypt');
            $data['itemCodeFrom'] = empty(dataEncyptbase64($this->input->get('itemCodeFrom'),'decrypt'))?'All':dataEncyptbase64($this->input->get('itemCodeFrom'),'decrypt');
            $data['itemCodeTo'] = empty(dataEncyptbase64($this->input->get('itemCodeTo'),'decrypt'))?'All':dataEncyptbase64($this->input->get('itemCodeTo'),'decrypt');
            $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '{$data['whseCode']}'",'dataType'=>'row'));
            
            $html = $this->load->view('layout/reports/print/stock_status_order_by_class',$data,true);
            if($data['reportType'] == 'AC'){
              $trDet = "<td align='left' bgcolor='#CCCCCC'><strong>Vendor</strong></td>";
            }else{
              $trDet = null;
            }
            // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
            $htmlPdfCon = 'Y';
              if($htmlPdfCon == 'Y'){
                $pdf = $this->pdf->load();
                $pdf->AddPage('L', // L - landscape, P - portrait
                    '', '', '', '',
                    3, // margin_left
                    3, // margin right
                    65, // margin top
                    3, // margin bottom
                    2, // margin header
                    2); // margin footer'
                    $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                    <tr>
                      <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='650' height='89' /></td>
                      </tr>
                  </table>
                  <table width='100%' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td height='26'><strong>".date('Y-m-d')."</strong></td>
                      <td><strong>Classification</strong></td>
                      <td><strong>:All</strong></td>
                      <td>&nbsp;</td>
                      <td><strong>Cost    Type: ".strtoupper($data['costType'])."</strong></td>
                      <td><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                    </tr>
                    <tr>
                      <td height='23'><strong>".substr(dateTime(),11)."</strong></td>
                      <td><strong>From    Item:</strong></td>
                      <td><strong>:All</strong></td>
                      <td align='center'><span class='style1'>Inventory    Status Report</span></td>
                      <td><strong>To    Item: All</strong></td>
                      <td><strong>Printed    By: 
                {$userCon->USERNAME}</strong></td>
                    </tr>
                    <tr>
                      <td height='19' width='116'><strong>ICM2022I</strong></td>
                      <td width='137'><strong>        From Category:</strong></td>
                      <td width='71'><strong>        :{$data['fromItemCat']}</strong></td>
                      <td width='356'>&nbsp;</td>
                      <td width='178'><strong>        To Category:{$data['toItemCat']}</strong></td>
                      <td width='180'>&nbsp;</td>
                    </tr>
                    <tr>
                      <td height='38'><strong>Whse: {$whseDet->WHSE_CODE} </strong></td>
                      <td colspan='2'><strong>{$whseDet->WHSE_DESC}</strong></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                    <table width='100%' cellpadding='1' cellspacing='1'>
        <tr height='37'>
          <td align='center' height='37' bgcolor='#CCCCCC'><strong>Item Code</strong></td>
          <td align='left' bgcolor='#CCCCCC'><strong>Item Name</strong></td>
          $trDet
          <td align='center' bgcolor='#CCCCCC'><strong>Class</strong></td>
          <td align='center' bgcolor='#CCCCCC'><strong> Qty.</strong></td>
          <td align='center' bgcolor='#CCCCCC'><strong>Amount</strong></td>
          <td align='center' bgcolor='#CCCCCC'><strong>Total Amount</strong></td>
          <td align='right' bgcolor='#CCCCCC'><strong>Reference</strong></td>
        </tr></table>",'O',true);
                // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
                $pdf->WriteHTML($html);
                $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
          }else{
            $this->load->view('layout/reports/print/stock_status_order_by_class',$data);
          }
        }

    /*================================ DAILY SALE REPORT ==============================*/
    public function dailySaleReport(){
            
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('from_date_db','from date','required');
        $this->form_validation->set_rules('to_date_db','to date','required');
        $this->form_validation->set_rules('whse_code_db','warehouse code','required');
        // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            // $glType = $this->input->post('gl_type');
            // $dataArr = (object)array(
            //                     'from_date'=>$this->input->post('from_date_db'),
            //                     'to_date'=>$this->input->post('to_date_db'),
            //                     'whse_code'=>$this->input->post('whse_code_db'),
            //                     'gl_type' =>$glType,
            //                 );
            // if($glType == 'Sale'){
            //     $tr = $this->accountlib->saleGlentry($dataArr);
            // }elseif ($glType == 'NPO' || $glType == 'CPO') {
            //     $tr = $this->accountlib->poGlentry($dataArr);
            // }elseif ($glType == 'Transfer'){
            //     $tr = $this->accountlib->transGlentry($dataArr);
            // }  
            $tr = true;          
            // if($this->unicon->insertUniversal('GL_MODULE_PROFILE',$data)){  
            if($tr){  
                $urlCret = "fromDate=".dataEncyptbase64($this->input->post('from_date_db'),'encrypt')."&toDate=".dataEncyptbase64($this->input->post('to_date_db'),'encrypt')."&whseCode=".dataEncyptbase64($this->input->post('whse_code_db'),'encrypt')."";
                $pageRedirect = "<script>window.open('".base_url('report/dailySaleReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function dailySaleReportPrint(){
        $userCon = sessionUserData();
        $data['fromDate'] = dataEncyptbase64($this->input->get('fromDate'),'decrypt');
        $data['toDate'] = dataEncyptbase64($this->input->get('toDate'),'decrypt');
        $data['whseCode'] = dataEncyptbase64($this->input->get('whseCode'),'decrypt');
        $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '{$data['whseCode']}'",'dataType'=>'row'));
        
        $html = $this->load->view('layout/reports/print/sale_order/daily_sale_report',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              65, // margin top
              3, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                    <tr>
                                      <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='650' height='89' /></td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td height='26'><strong></strong></td>
                                      <td><strong></strong></td>
                                      <td><strong></strong></td>
                                      <td>&nbsp;</td>
                                      <td><strong></strong></td>
                                      <td><strong>Printed On: 
                                      ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                    </tr>
                                    <tr>
                                      <td><strong>From date : {$data['fromDate']}</strong></td>
                                      <td><strong></strong></td>
                                      <td><strong></strong></td>
                                      <td align='center'><span class='style1'>Daily Sale Report</span></td>
                                      <td><strong></strong></td>
                                      <td><strong>Printed    By: 
                                {$userCon->USERNAME}</strong></td>
                                    </tr>
                                    <tr>
                                      <td><strong>To date : {$data['toDate']}</strong></td>
                                      <td width='137'><strong></strong></td>
                                      <td width='71'><strong></strong></td>
                                      <td align='center'>{$whseDet->WHSE_DESC}</td>
                                      <td width='178'><strong></strong></td>
                                      <td width='180'>{PAGENO} / {nbpg}</td>
                                    </tr>
                                    <tr>
                                      <td height='38'><strong>Whse: {$whseDet->WHSE_CODE} </strong></td>
                                      <td colspan='2'><strong></strong></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td></td>
                                    </tr>
                                  </table>
                                    <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr height='37'>
                                      <td width='127' align='center' height='37' bgcolor='#CCCCCC'><strong>Customer</strong></td>
                                      <td width='177' align='center' bgcolor='#CCCCCC'><strong>Invoice No</strong></td>
                                      <td width='100' align='center' bgcolor='#CCCCCC'><strong>Order No</strong></td>
                                      <td width='150' align='center' bgcolor='#CCCCCC'><strong>Net Sale</strong></td>
                                      <td width='150' align='center' bgcolor='#CCCCCC'><strong>Sales Person</strong></td>
                                      <td width='100' align='center' bgcolor='#CCCCCC'><strong>Prepared by</strong></td>
                                      <td width='100' align='center' bgcolor='#CCCCCC'><strong>Verified By</strong></td>
                                      </tr>
                                    </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/sale_order/daily_sale_report',$data);
        }
    }

    /*================================ STOCK BY VENDOR PRICE REPORT ==============================*/
      public function stkByVenPrice(){
              
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('date_db','from date','required');
        $this->form_validation->set_rules('v_code_db','to date','required');
        // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            // $glType = $this->input->post('gl_type');
            // $dataArr = (object)array(
            //                     'from_date'=>$this->input->post('from_date_db'),
            //                     'to_date'=>$this->input->post('to_date_db'),
            //                     'whse_code'=>$this->input->post('whse_code_db'),
            //                     'gl_type' =>$glType,
            //                 );
            // if($glType == 'Sale'){
            //     $tr = $this->accountlib->saleGlentry($dataArr);
            // }elseif ($glType == 'NPO' || $glType == 'CPO') {
            //     $tr = $this->accountlib->poGlentry($dataArr);
            // }elseif ($glType == 'Transfer'){
            //     $tr = $this->accountlib->transGlentry($dataArr);
            // }  
            $tr = true;          
            // if($this->unicon->insertUniversal('GL_MODULE_PROFILE',$data)){  
            if($tr){  
                $urlCret = "dateIn={$this->input->post('date_db')}&vCode={$this->input->post('v_code_db')}&itemCat={$this->input->post('item_cat_db')}&reportGrp={$this->input->post('report_grp_db')}&itemPic={$this->input->post('item_picture_db')}";
                
                $pageRedirect = "<script>window.open('".base_url('report/stkByVenPriceReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function stkByVenPriceReportPrint(){
        $userCon = sessionUserData();
        $data['dateIn'] = $this->input->get('dateIn');
        $data['vCode'] = $this->input->get('vCode');
        $data['itemCat'] = $this->input->get('itemCat');
        $data['reportGrp'] = $this->input->get('reportGrp');
        $data['itemPic'] = $this->input->get('itemPic');
        $vendorDet = vendorList(array('where'=>"WHERE V_CODE = '{$data['vCode']}'",'dataType'=>'row'));
        $html = $this->load->view('layout/reports/print/inventory_control_manage/stock_by_ven_pri',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              72, // margin top
              0, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                    <tr>
                                      <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='650' height='89' /></td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td height='26'><strong></strong></td>
                                      <td><strong></strong></td>
                                      <td><strong></strong></td>
                                      <td>&nbsp;</td>
                                      <td><strong></strong></td>
                                      <td><strong>Printed    By: 
                                      {$userCon->USERNAME}</strong></td>
                                    </tr>
                                    <tr>
                                      <td height='23'><strong></strong></td>
                                      <td><strong></td>
                                      <td><strong></strong></td>
                                      <td align='center'><span class='style1'>STOCK BY VENDOR PRICE REPORT</span></td>
                                      <td></td>
                                      <td><strong>Printed    On: 
                                ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                    </tr>
                                    <tr>
                                      <td height='19' width='116'><strong></strong></td>
                                      <td width='137'><strong>    </strong></td>
                                      <td width='71'><strong>        </strong></td>
                                      <td width='356' align='center'>BY CURRENCY BY ITEMS</td>
                                      <td width='178'><strong>        </strong></td>
                                      <td width='180'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                    </tr>
                                    <tr>
                                      <td height='38'><strong>Vendor: </strong></td>
                                      <td colspan='2'><strong>{$vendorDet->V_CODE}-{$vendorDet->V_NAME}</strong></td>
                                      <td align='center'>As of : ".date("d M Y", strtotime($data['dateIn']))."</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                    <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr height='37'>
                                      <td width='100' align='center' height='37' bgcolor='#CCCCCC'><strong>Item</strong></td>
                                      <td width='210' align='center' bgcolor='#CCCCCC'><strong>Vendor Reference</strong></td>
                                      <td width='210' align='center' bgcolor='#CCCCCC'><strong>Item Description</strong></td>
                                      <td width='60' align='center' bgcolor='#CCCCCC'><strong>Qty</strong></td>
                                      <td width='100' align='center' bgcolor='#CCCCCC'><strong>Price</strong></td>
                                      <td width='100' align='center' bgcolor='#CCCCCC'><strong>Value</strong></td>
                                      <td width='100' align='center' bgcolor='#CCCCCC'><strong>Currency</strong></td>
                                      </tr>
                                    </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/inventory_control_manage/stock_by_ven_pri',$data);
        }
    }

    /*================================ VENDOR STOCK REPORT ==============================*/
      public function vendorStockReport(){
                
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('date_db','from date','required');
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
          
            $tr = true;          
           
            if($tr){ 

                $urlCret = "dateIn=".dataEncyptbase64($this->input->post('date_db'),'encrypt')."&vCode=".dataEncyptbase64($this->input->post('v_code_db'),'encrypt')."&curCode=".dataEncyptbase64($this->input->post('curr_db'),'encrypt')."&whseCode=".dataEncyptbase64($this->input->post('whse_code_db'),'encrypt')."&whseDet=".dataEncyptbase64($this->input->post('whse_det_db'),'encrypt')."&itemCatCode=".dataEncyptbase64($this->input->post('item_cat_db'),'encrypt')."&itemCatCodeDet=".dataEncyptbase64($this->input->post('item_cat_det_db'),'encrypt')."&itemClsCode=".dataEncyptbase64($this->input->post('item_cls_db'),'encrypt')."&itemClsCodeDet=".dataEncyptbase64($this->input->post('item_cls_det_db'),'encrypt')."&itemCode=".dataEncyptbase64($this->input->post('item_code_db'),'encrypt')."&itemCodeDet=".dataEncyptbase64($this->input->post('item_code_det_db'),'encrypt')."&costVal=".dataEncyptbase64($this->input->post('cost_val_db'),'encrypt')."&prtVenRef=".dataEncyptbase64($this->input->post('print_ven_ref_db'),'encrypt')."";
                
                $pageRedirect = "<script>window.open('".base_url('report/vendorStockReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function vendorStockReportPrint(){
        $userCon = sessionUserData();
        $data['dateIn'] = dataEncyptbase64($this->input->get('dateIn'),'decrypt');
        $data['vCode'] = dataEncyptbase64($this->input->get('vCode'),'decrypt');
        $data['curCode'] = dataEncyptbase64($this->input->get('curCode'),'decrypt');
        $data['whseCode'] = dataEncyptbase64($this->input->get('whseCode'),'decrypt');
        $data['whseDet'] = dataEncyptbase64($this->input->get('whseDet'),'decrypt');
        $data['itemCatCode'] = dataEncyptbase64($this->input->get('itemCatCode'),'decrypt');
        $data['itemCatCodeDet'] = dataEncyptbase64($this->input->get('itemCatCodeDet'),'decrypt');
        $data['itemClsCode'] = dataEncyptbase64($this->input->get('itemClsCode'),'decrypt');
        $data['itemClsCodeDet'] = dataEncyptbase64($this->input->get('itemClsCodeDet'),'decrypt');
        $data['itemCode'] = dataEncyptbase64($this->input->get('itemCode'),'decrypt');
        $data['itemCodeDet'] = dataEncyptbase64($this->input->get('itemCodeDet'),'decrypt');
        $data['costVal'] = dataEncyptbase64($this->input->get('costVal'),'decrypt');
        $data['prtVenRef'] = dataEncyptbase64($this->input->get('prtVenRef'),'decrypt');
    

        $vendorDet = vendorList(array('where'=>"WHERE V_CODE = '{$data['vCode']}'",'dataType'=>'row'));
        $html = $this->load->view('layout/reports/print/inventory_control_manage/vendor_stock',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              65, // margin top
              0, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                    <tr>
                                      <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='650' height='89' /></td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td height='26'><strong></strong></td>
                                      <td><strong></strong></td>
                                      <td><strong></strong></td>
                                      <td>&nbsp;</td>
                                      <td><strong></strong></td>
                                      <td><strong>Printed    By: 
                                      {$userCon->USERNAME}</strong></td>
                                    </tr>
                                    <tr>
                                      <td height='23'><strong></strong></td>
                                      <td><strong></td>
                                      <td><strong></strong></td>
                                      <td align='center'><span class='style1'>VENDOR STOCK REPORT</span></td>
                                      <td></td>
                                      <td><strong>Printed    On: 
                                ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                    </tr>
                                    <tr>
                                      <td height='19' width='116'><strong></strong></td>
                                      <td width='137'><strong>    </strong></td>
                                      <td width='71'><strong>        </strong></td>
                                      <td width='356' align='center'>BY CURRENCY BY ITEMS</td>
                                      <td width='178'><strong>        </strong></td>
                                      <td width='180'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                    </tr>
                                    <tr>
                                      <td height='38'><strong>Vendor: </strong></td>
                                      <td colspan='2'><strong></strong></td>
                                      <td align='center'>As of : ".date("d M Y", strtotime($data['dateIn']))."</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                    <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr height='37'>
                                      <td width='100' align='center' height='37' colspan='2' bgcolor='#CCCCCC'><strong>Vendor /Whse / Category / Class</strong></td>\
                                      <td width='60' align='center' bgcolor='#CCCCCC'><strong>Qty</strong></td>
                                      <td width='100' align='center' bgcolor='#CCCCCC'><strong>Vendor Cost</strong></td>
                                      <td width='100' align='center' bgcolor='#CCCCCC'><strong>Vendor Value</strong></td>
                                      </tr>
                                    </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/inventory_control_manage/vendor_stock',$data);
        }
    }

    /*================================ STOCK STATUS AS OF DATE REPORT ==============================*/
      public function stkStaDateReport(){
                  
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('date_db','from date','required');
        $this->form_validation->set_rules('whse_from_db','from warehouse','required');
        $this->form_validation->set_rules('whse_to_db','to warehouse','required');
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
          
            $tr = true;          
          
            if($tr){ 

                $urlCret = "dateIn=".dataEncyptbase64($this->input->post('date_db'),'encrypt')."&whseFrom=".dataEncyptbase64($this->input->post('whse_from_db'),'encrypt')."&whseTo=".dataEncyptbase64($this->input->post('whse_to_db'),'encrypt')."&itemCodeFrom=".dataEncyptbase64($this->input->post('item_code_from_db'),'encrypt')."&itemCodeTo=".dataEncyptbase64($this->input->post('item_code_to_db'),'encrypt')."&itemCatCodeFrom=".dataEncyptbase64($this->input->post('item_cat_from_db'),'encrypt')."&itemCatCodeTo=".dataEncyptbase64($this->input->post('item_cat_to_db'),'encrypt')."&itemClsFrom=".dataEncyptbase64($this->input->post('item_cls_from_db'),'encrypt')."&itemClsto=".dataEncyptbase64($this->input->post('item_cls_to_db'),'encrypt')."&disZeroBal=".dataEncyptbase64($this->input->post('dis_zero_bal_db'),'encrypt')."&onlyConStk=".dataEncyptbase64($this->input->post('only_con_stk_db'),'encrypt')."&withConStk=".dataEncyptbase64($this->input->post('with_con_stk_db'),'encrypt')."&byPri=".dataEncyptbase64($this->input->post('by_pri_db'),'encrypt')."";
                
                $pageRedirect = "<script>window.open('".base_url('report/stkStaDateReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function stkStaDateReportPrint(){
        $userCon = sessionUserData();
        $data['dateIn'] = dataEncyptbase64($this->input->get('dateIn'),'decrypt');
        $data['whseFrom'] = dataEncyptbase64($this->input->get('whseFrom'),'decrypt');
        $data['whseTo'] = dataEncyptbase64($this->input->get('whseTo'),'decrypt');
        $data['itemCodeFrom'] = empty(dataEncyptbase64($this->input->get('itemCodeFrom'),'decrypt'))?'All':dataEncyptbase64($this->input->get('itemCodeFrom'),'decrypt');
        $data['itemCodeTo'] = empty(dataEncyptbase64($this->input->get('itemCodeTo'),'decrypt'))?'All':dataEncyptbase64($this->input->get('itemCodeTo'),'decrypt');
        $data['itemCatCodeFrom'] = empty(dataEncyptbase64($this->input->get('itemCatCodeFrom'),'decrypt'))?'All':dataEncyptbase64($this->input->get('itemCatCodeFrom'),'decrypt');
        $data['itemCatCodeTo'] = empty(dataEncyptbase64($this->input->get('itemCatCodeTo'),'decrypt'))?'All':dataEncyptbase64($this->input->get('itemCatCodeTo'),'decrypt');
        $data['itemClsFrom'] = empty(dataEncyptbase64($this->input->get('itemClsFrom'),'decrypt'))?'All':dataEncyptbase64($this->input->get('itemClsFrom'),'decrypt');
        $data['itemClsto'] = empty(dataEncyptbase64($this->input->get('itemClsto'),'decrypt'))?'All':dataEncyptbase64($this->input->get('itemClsto'),'decrypt');
        $data['disZeroBal'] = empty(dataEncyptbase64($this->input->get('disZeroBal'),'decrypt'))?'None':dataEncyptbase64($this->input->get('disZeroBal'),'decrypt');
        $data['onlyConStk'] = empty(dataEncyptbase64($this->input->get('onlyConStk'),'decrypt'))?'None':dataEncyptbase64($this->input->get('onlyConStk'),'decrypt');
        $data['withConStk'] = empty(dataEncyptbase64($this->input->get('withConStk'),'decrypt'))?'None':dataEncyptbase64($this->input->get('withConStk'),'decrypt');
        $data['byPri'] = empty(dataEncyptbase64($this->input->get('byPri'),'decrypt'))?'None':dataEncyptbase64($this->input->get('byPri'),'decrypt');
    
        $html = $this->load->view('layout/reports/print/inventory_control_manage/stock_status_date',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              54, // margin top
              0, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                      <tr>
                          
                                          <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='555' height='75' /></td>
                          
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                        <td height='20'><strong>Printed    On: 
                                        ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                        <td width='181'><strong>From Whse: {$data['whseFrom']} </strong></td>
                                        <td width='50'>&nbsp;</td>
                                        <td rowspan='2' align='center'><span class='style1'>Items Balance Report</span></td>
                                        <td><strong>To Whse: {$data['whseTo']} </strong></td>
                                        <td><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                    </tr>
                                    <tr>
                                        <td height='20'><strong></strong></td>
                                        <td><strong>From Item: {$data['itemCodeFrom']} </strong></td>
                                        <td>&nbsp;</td>
                                        <td><strong>To Item: {$data['itemCodeTo']} </strong></td>
                                        <td><strong>Printed By:
                                                EMIS2000</strong></td>
                                    </tr>
                                    <tr>
                                        <td width='114' rowspan='2'><strong>Desplay Zero Balance: Yes </strong></td>
                                        <td height='20' colspan='2'><strong> From Category : {$data['itemCatCodeFrom']}</strong></td>
                                        <td width='338' align='center'>As Of Date ".date('d-m-Y',strtotime($data['dateIn']))."</td>
                                        <td width='207'><strong> To Category : {$data['itemCatCodeTo']} </strong></td>
                                        <td width='148'><strong>Report Code:</strong></td>
                                    </tr>
                                    <tr>
                                        <td height='20' colspan='2'><strong>From Class : {$data['itemClsFrom']} </strong></td>
                                        <td>&nbsp;</td>
                                        <td><strong>To Class : {$data['itemClsto']} </strong></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                                <table width='100%' cellpadding='0' cellspacing='0'>
                                  <tr height='37'>
                                      <td width='169' height='37' bgcolor='#CCCCCC'><strong>Item Code</strong></td>
                                      <td width='660' bgcolor='#CCCCCC'><strong>Item Name</strong></td>
                                      <td width='96' align='center' bgcolor='#CCCCCC'><strong>Qty</strong></td>
                                      <td width='163' align='center' bgcolor='#CCCCCC'><strong>Total</strong></td>
                                  </tr>
                                </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/inventory_control_manage/stock_status_date',$data);
        }
    }

    /*================================ INVENTORY TRANSFER ORDER WITH PICTURE REPORT ==============================*/
      public function invTransfOrderWithPicReport(){
                    
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('bus_unit_db','Business Unit','required');
        $this->form_validation->set_rules('order_no_db','Order No','required');
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
          
            $tr = true;          
          
            if($tr){ 

                $urlCret = "busUnit=".dataEncyptbase64($this->input->post('bus_unit_db'),'encrypt')."&orderNo=".dataEncyptbase64($this->input->post('order_no_db'),'encrypt')."";
                
                $pageRedirect = "<script>window.open('".base_url('report/invTransfOrderWithPicReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function invTransfOrderWithPicReportPrint(){
        $userCon = sessionUserData();
        $data['busUnit'] = dataEncyptbase64($this->input->get('busUnit'),'decrypt');
        $data['orderNo'] = dataEncyptbase64($this->input->get('orderNo'),'decrypt');
        $data['stockTransDet'] = StockTransferOrderDet(["where" => "WHERE STH_ORDER_NO = '{$data['orderNo']}' AND STH_BUS_UNIT = '{$data['busUnit']}'", "dataType" => 'result']);
        $html = $this->load->view('layout/reports/print/inventory_control_manage/inv_transf_order_wth_pic',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('P', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              25, // margin top
              0, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                    <tr>
                                        <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='468' height='63' /></td>
                                    </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                        <td width='91' height='20' bgcolor='#CCCCCC'><strong>Order No :</strong></td>
                                        <td width='947' colspan='2' bgcolor='#CCCCCC'><strong></strong>{$data['orderNo']}</td>
                                    </tr>
                                  </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/inventory_control_manage/inv_transf_order_wth_pic',$data);
        }
    }

    /*================================ YEAR SALE COMP MONTH REPORT ==============================*/
      public function yearSaleCompMonReport(){
                      
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('finacl_year_1_db','year 1','required');
        $this->form_validation->set_rules('finacl_year_2_db','year 2','required');
        $this->form_validation->set_rules('period_1_db','month 1','required');
        $this->form_validation->set_rules('period_2_db','month 2','required');
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
          
            $tr = true;          
          
            if($tr){ 

                $urlCret = "year_1=".dataEncyptbase64($this->input->post('finacl_year_1_db'),'encrypt')."&year_2=".dataEncyptbase64($this->input->post('finacl_year_2_db'),'encrypt')."&mon_1=".dataEncyptbase64($this->input->post('period_1_db'),'encrypt')."&mon_2=".dataEncyptbase64($this->input->post('period_2_db'),'encrypt')."";
                
                $pageRedirect = "<script>window.open('".base_url('report/yearSaleCompMonReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function yearSaleCompMonReportPrint(){
        $userCon = sessionUserData();
        $data['year_1'] = dataEncyptbase64($this->input->get('year_1'),'decrypt');
        $data['year_2'] = dataEncyptbase64($this->input->get('year_2'),'decrypt');
        $data['mon_1'] = dataEncyptbase64($this->input->get('mon_1'),'decrypt');
        $data['mon_2'] = dataEncyptbase64($this->input->get('mon_2'),'decrypt');

        $data['partOne'] = $this->reportlib->yearSaleCompMon((object)array('year'=>$data['year_1'],'month'=>$data['mon_1'],'dataType'=>'row'));
        $data['partTwo'] = $this->reportlib->yearSaleCompMon((object)array('year'=>$data['year_2'],'month'=>$data['mon_2'],'dataType'=>'row'));

        $html = $this->load->view('layout/reports/print/inventory_control_manage/year_sale_comp_mon',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              45, // margin top
              0, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                        <td width='110' height='26' valign='bottom'>&nbsp;</td>
                                        <td width='126' valign='bottom'>&nbsp;</td>
                                        <td width='642' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='523' height='71' /></td>
                                        <td width='210' valign='bottom'><strong>Report Code: MSR001</strong><br /></td>
                                    </tr>
                                    <tr>
                                        <td width='110' height='29'><strong></strong></td>
                                        <td width='126' valign='bottom'></td>
                                        <td rowspan='2' align='center'><span class='style1'>YEARLY SALES COMPARISON REPORT</span></td>
                                        <td><strong>".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                    </tr>
                                    <tr>
                                        <td height='29'><strong></strong></td>
                                        <td></td>
                                        <td><strong>Printed By:
                                        {$userCon->USERNAME}</strong></td>
                                    </tr>
                        
                                    <tr>
                                        <td height='25'><strong></strong></td>
                                        <td colspan='2'></td>
                                        <td><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                    </tr>
                                </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/inventory_control_manage/year_sale_comp_mon',$data);
        }
    }

    /*================================ MANUAL INVENTORY TRANSACTION REPORT ==============================*/
      public function manualInvTransReport(){
                
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('from_date_db','from date','required');
        $this->form_validation->set_rules('to_date_db','to date','required');
        $this->form_validation->set_rules('from_whse_code_db','from warehouse','required');
        $this->form_validation->set_rules('to_whse_code_db','to warehouse','required');
        $this->form_validation->set_rules('rep_type_db','report type','required');
        // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            // $glType = $this->input->post('gl_type');
            // $dataArr = (object)array(
            //                     'from_date'=>$this->input->post('from_date_db'),
            //                     'to_date'=>$this->input->post('to_date_db'),
            //                     'whse_code'=>$this->input->post('whse_code_db'),
            //                     'gl_type' =>$glType,
            //                 );
            // if($glType == 'Sale'){
            //     $tr = $this->accountlib->saleGlentry($dataArr);
            // }elseif ($glType == 'NPO' || $glType == 'CPO') {
            //     $tr = $this->accountlib->poGlentry($dataArr);
            // }elseif ($glType == 'Transfer'){
            //     $tr = $this->accountlib->transGlentry($dataArr);
            // }  
            $tr = true; 
                    
            // if($this->unicon->insertUniversal('GL_MODULE_PROFILE',$data)){  
            if($tr){  
                $urlCret = "dateFrom=".dataEncyptbase64($this->input->post('from_date_db'),'encrypt')."&dateTo=".dataEncyptbase64($this->input->post('to_date_db'),'encrypt')."&whseFrom=".dataEncyptbase64($this->input->post('from_whse_code_db'),'encrypt')."&whseTo=".dataEncyptbase64($this->input->post('to_whse_code_db'),'encrypt')."&reason=".dataEncyptbase64($this->input->post('reason_db'),'encrypt')."&rule=".dataEncyptbase64($this->input->post('rule_db'),'encrypt')."&itemCat=".dataEncyptbase64($this->input->post('item_cat_db'),'encrypt')."&repType=".dataEncyptbase64($this->input->post('rep_type_db'),'encrypt')."";
                $inv_type = $this->input->post('inv_type');
                if (isset($inv_type)) {
                  if ($inv_type == 'Y') {
                      $urlCret .= "&vCode=".dataEncyptbase64($this->input->post('v_code_db'),'encrypt')."";
                  }
                } 
                $pageRedirect = "<script>window.open('".base_url('report/manualInvTransReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function manualInvTransReportPrint(){
        $userCon = sessionUserData();
        $vCode = dataEncyptbase64($this->input->get('vCode'),'decrypt');
        $vCode = isset($vCode)?$vCode:null;
        $data['vCode'] = $vCode;
        $data['dateFrom'] = dataEncyptbase64($this->input->get('dateFrom'),'decrypt');
        $data['dateTo'] = dataEncyptbase64($this->input->get('dateTo'),'decrypt');
        $data['whseFrom'] = dataEncyptbase64($this->input->get('whseFrom'),'decrypt');
        $data['whseTo'] = dataEncyptbase64($this->input->get('whseTo'),'decrypt');
        $data['reason'] = dataEncyptbase64($this->input->get('reason'),'decrypt');
        $data['rule'] = dataEncyptbase64($this->input->get('rule'),'decrypt');
        $data['itemCat'] = dataEncyptbase64($this->input->get('itemCat'),'decrypt');
        $itemCatDsp = $data['itemCat']?$data['itemCat']:'All';
        $data['repType'] = dataEncyptbase64($this->input->get('repType'),'decrypt');
        $html = $this->load->view('layout/reports/print/inventory_control_manage/manual_inv_trans',$data,true);
        $headTitle = "MANUAL ORDER REPORT";
        if ($vCode) {
            $vTitle = "Vendor : $vCode";
        }else{
          $vTitle = null;
        }
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              65, // margin top
              0, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                    <tr>
                                      <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='650' height='89' /></td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td><strong>From date : {$data['dateFrom']}</strong></td>
                                      <td><strong>Reason : {$data['reason']}</strong></td>
                                      <td><strong></strong></td>
                                      <td>&nbsp;</td>
                                      <td><strong></strong></td>
                                      <td><strong>Printed    By: 
                                      {$userCon->USERNAME}</strong></td>
                                    </tr>
                                    <tr>
                                      <td><strong>To date : {$data['dateTo']}</strong></td>
                                      <td><strong>Item Cat : {$itemCatDsp}</strong></td>
                                      <td><strong></strong></td>
                                      <td align='center'><span class='style1'>$headTitle</span></td>
                                      <td></td>
                                      <td><strong>Printed    On: 
                                ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                    </tr>
                                    <tr>
                                      <td height='19' width='116'><strong>Transfer From Whse : {$data['whseFrom']}</strong></td>
                                      <td width='137'><strong>    </strong></td>
                                      <td width='71'><strong>        </strong></td>
                                      <td width='356' align='center'></td>
                                      <td width='178'><strong>        </strong></td>
                                      <td width='180'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                    </tr>
                                    <tr>
                                      <td height='38'><strong>To Whse : {$data['whseTo']}</strong></td>
                                      <td colspan='2'><strong>$vTitle</strong></td>
                                      <td align='center'></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                    <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr height='37'>
                                      <td width='100' align='center' height='37' bgcolor='#CCCCCC'><strong>Line</strong></td>
                                      <td width='210' align='center' bgcolor='#CCCCCC'><strong>Item Code</strong></td>
                                      <td width='210' align='center' bgcolor='#CCCCCC'><strong>Item Description</strong></td>
                                      <td width='60' align='center' bgcolor='#CCCCCC'><strong>Qty</strong></td>
                                      <td width='100' align='center' bgcolor='#CCCCCC'><strong>Extended</strong></td>
                                      </tr>
                                    </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/inventory_control_manage/manual_inv_trans',$data);
        }
    }

    /*================================ ITEM WITH PICTURE REPORT ==============================*/
    public function itemWithPicReport(){
              
      header('Content-Type: application/json');

      $userCon = sessionUserData();
      $this->form_validation->set_rules('whse_code_db','from date','required');
      // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
      // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
      if($this->form_validation->run() === FALSE){
          $omsg = $this->form_validation->error_array();
          echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
      }else{
          $tr = true;          
          // if($this->unicon->insertUniversal('GL_MODULE_PROFILE',$data)){  
          if($tr){  
              $urlCret = "whseCode=".dataEncyptbase64($this->input->post('whse_code_db'),'encrypt')."";
              $pageRedirect = "<script>window.open('".base_url('report/itemWithPicReportPrint?').$urlCret."');</script>";
              echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
          }else{
              echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
          }
      }
  }

    public function itemWithPicReportPrint(){
      $userCon = sessionUserData();
      $data['whseCode'] = dataEncyptbase64($this->input->get('whseCode'),'decrypt');
      
      $htmlPdfCon = 'Y';
      if($htmlPdfCon == 'Y'){
        $html = $this->load->view('layout/reports/print/inventory_control_manage/item_with_picture',$data,true);
        $pdf = $this->pdf->load();
        $pdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            3, // margin_left
            3, // margin right
            30, // margin top
            3, // margin bottom
            2, // margin header
            2); // margin footer'
            $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                  <tr>
                                    <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='468' height='63' /></td>
                                  </tr>
                                </table>
                                <table width='100%' cellpadding='0' cellspacing='0'>
                                  <tr>
                                    <td width='91' height='20' bgcolor='#CCCCCC'><strong>Location : </strong></td>
                                    <td width='947' colspan='2' bgcolor='#CCCCCC'><strong>{$data['whseCode']}</strong></td>
                                  </tr>
                                </table>",'O',true);
        // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
        $pdf->WriteHTML($html);
        $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
      }else{
        $this->load->view('layout/reports/print/inventory_control_manage/item_with_picture',$data);
      }
  }

  /*================================ ITEM STOCK WITH PICTURE REPORT ==============================*/
    public function itemStockWithPicReport(){
                
      header('Content-Type: application/json');

      $userCon = sessionUserData();
      $this->form_validation->set_rules('whse_code_db','from date','required');
      $this->form_validation->set_rules('v_code_db','from date','required');
      // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
      // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
      if($this->form_validation->run() === FALSE){
          $omsg = $this->form_validation->error_array();
          echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
      }else{
          // $glType = $this->input->post('gl_type');
          // $dataArr = (object)array(
          //                     'from_date'=>$this->input->post('from_date_db'),
          //                     'to_date'=>$this->input->post('to_date_db'),
          //                     'whse_code'=>$this->input->post('whse_code_db'),
          //                     'gl_type' =>$glType,
          //                 );
          // if($glType == 'Sale'){
          //     $tr = $this->accountlib->saleGlentry($dataArr);
          // }elseif ($glType == 'NPO' || $glType == 'CPO') {
          //     $tr = $this->accountlib->poGlentry($dataArr);
          // }elseif ($glType == 'Transfer'){
          //     $tr = $this->accountlib->transGlentry($dataArr);
          // }  
          $tr = true;          
          // if($this->unicon->insertUniversal('GL_MODULE_PROFILE',$data)){  
          if($tr){  
              $urlCret = "whseCode=".dataEncyptbase64($this->input->post('whse_code_db'),'encrypt')."&vCode=".dataEncyptbase64($this->input->post('v_code_db'),'encrypt')."&itemClass=".dataEncyptbase64($this->input->post('item_class_db'),'encrypt')."";
              $pageRedirect = "<script>window.open('".base_url('report/itemStockWithPicReportPrint?').$urlCret."');</script>";
              echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
          }else{
              echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
          }
      }
  }

    public function itemStockWithPicReportPrint(){
      $userCon = sessionUserData();
      $data['whseCode'] = dataEncyptbase64($this->input->get('whseCode'),'decrypt');
      $data['vCode'] = dataEncyptbase64($this->input->get('vCode'),'decrypt');
      $data['itemClass'] = dataEncyptbase64($this->input->get('itemClass'),'decrypt');
      $whseDet = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '{$data['whseCode']}'",'dataType'=>'row'));
      $html = $this->load->view('layout/reports/print/inventory_control_manage/item_stock_with_picture',$data,true);
      $htmlPdfCon = 'Y';
      if($htmlPdfCon == 'Y'){
        // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
        $pdf = $this->pdf->load();
        $pdf->AddPage('P', // L - landscape, P - portrait
            '', '', '', '',
            3, // margin_left
            3, // margin right
            30, // margin top
            3, // margin bottom
            2, // margin header
            2); // margin footer'
            $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                  <tr>
                                    <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='468' height='63' /></td>
                                  </tr>
                                </table>
                                <table width='100%' cellpadding='0' cellspacing='0'>
                                  <tr>
                                    <td width='91' height='20' bgcolor='#CCCCCC'><strong>Location : </strong></td>
                                    <td width='947' colspan='2' bgcolor='#CCCCCC'><strong>{$whseDet->WHSE_CODE} - {$whseDet->WHSE_DESC}</strong></td>
                                  </tr>
                                </table>",'O',true);
        // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
        $pdf->WriteHTML($html);
        $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
      }else{
        $this->load->view('layout/reports/print/inventory_control_manage/item_stock_with_picture',$data);
      }
  }

    /*================================ TRAIL BALANCE ==============================*/
    
      public function accountTrailBalance(){
                
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('from_period_db','from period','required');
        $this->form_validation->set_rules('to_period_db','to period','required');
        $this->form_validation->set_rules('from_acc_db','from Account','required');
        $this->form_validation->set_rules('to_acc_db','to Account','required');
        $this->form_validation->set_rules('level_from','from level','required');
        $this->form_validation->set_rules('level_to','to level','required');
        $this->form_validation->set_rules('cost_center_db','cost center','required');
        $this->form_validation->set_rules('finacl_year_db','financial year','required');
        // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            // $glType = $this->input->post('gl_type');
            // $dataArr = (object)array(
            //                     'from_date'=>$this->input->post('from_date_db'),
            //                     'to_date'=>$this->input->post('to_date_db'),
            //                     'whse_code'=>$this->input->post('whse_code_db'),
            //                     'gl_type' =>$glType,
            //                 );
            // if($glType == 'Sale'){
            //     $tr = $this->accountlib->saleGlentry($dataArr);
            // }elseif ($glType == 'NPO' || $glType == 'CPO') {
            //     $tr = $this->accountlib->poGlentry($dataArr);
            // }elseif ($glType == 'Transfer'){
            //     $tr = $this->accountlib->transGlentry($dataArr);
            // }  
            $tr = true;          
            // if($this->unicon->insertUniversal('GL_MODULE_PROFILE',$data)){  
            if($tr){  
                $urlCret = "fromAcc={$this->input->post('from_acc_db')}&toAcc={$this->input->post('to_acc_db')}&fromPeriod={$this->input->post('from_period_db')}&toPeriod={$this->input->post('to_period_db')}&fromLevel={$this->input->post('level_from')}&toLevel={$this->input->post('level_to')}&costCenter={$this->input->post('cost_center_db')}&finaclYear={$this->input->post('finacl_year_db')}&postType={$this->input->post('post_type')}";
                $pageRedirect = "<script>window.open('".base_url('report/accountTrailBalPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }
      public function accountTrailBalPrint(){
        $userCon = sessionUserData();
        $data['fromAcc'] = $this->input->get('fromAcc');
        $data['toAcc'] = $this->input->get('toAcc');
        $data['fromPeriod'] = $this->input->get('fromPeriod');
        $data['toPeriod'] = $this->input->get('toPeriod');
        $data['fromLevel'] = $this->input->get('fromLevel');
        $data['toLevel'] = $this->input->get('toLevel');
        $data['costCenter'] = $this->input->get('costCenter');
        $data['finaclYear'] = $this->input->get('finaclYear');
        $data['postType'] = $this->input->get('postType');

        $data['userCon'] = $userCon;
        $data['fetchData'] = $this->reportlib->trailBalance((object)array(
                                                                  'fromAcc' =>$data['fromAcc'],
                                                                  'toAcc' =>$data['toAcc'],
                                                                  'fromPeriod' =>$data['fromPeriod'],
                                                                  'toPeriod' =>$data['toPeriod'],
                                                                  'fromLevel' =>$data['fromLevel'],
                                                                  'toLevel' =>$data['toLevel'],
                                                                  'costCenter' =>$data['costCenter'],
                                                                  'finaclYear' =>$data['finaclYear'],
                                                                  'postType' =>$data['postType'],
                                                                  'dataType'=>'num_rows'));
        $html = $this->load->view('layout/reports/print/account/trail_balance',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              3, // margin top
              3, // margin bottom
              2, // margin header
              2); // margin footer'
              // $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
              //                       <tr>
              //                         <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='650' height='89' /></td>
              //                         </tr>
              //                     </table>
              //                     <table width='100%' cellpadding='0' cellspacing='0'>
              //                       <tr>
              //                         <td height='26'><strong></strong></td>
              //                         <td><strong></strong></td>
              //                         <td><strong></strong></td>
              //                         <td>&nbsp;</td>
              //                         <td><strong></strong></td>
              //                         <td><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
              //                       </tr>
              //                       <tr>
              //                         <td height='23'><strong></strong></td>
              //                         <td><strong></td>
              //                         <td><strong></strong></td>
              //                         <td align='center'><span class='style1'>Vendor Stock Report</span></td>
              //                         <td><strong>Printed    On: 
              //                         ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
              //                         <td><strong>Printed    By: 
              //                   {$userCon->USERNAME}</strong></td>
              //                       </tr>
              //                       <tr>
              //                         <td height='19' width='116'><strong></strong></td>
              //                         <td width='137'><strong>    </strong></td>
              //                         <td width='71'><strong>        </strong></td>
              //                         <td width='356'>&nbsp;</td>
              //                         <td width='178'><strong>        </strong></td>
              //                         <td width='180'>&nbsp;</td>
              //                       </tr>
              //                       <tr>
              //                         <td height='38'><strong>Vendor: </strong></td>
              //                         <td colspan='2'><strong>{$data['vCode']}</strong></td>
              //                         <td>&nbsp;</td>
              //                         <td>&nbsp;</td>
              //                         <td>&nbsp;</td>
              //                       </tr>
              //                     </table>
              //                       <table width='100%' cellpadding='0' cellspacing='0'>
              //                         <tr height='37'>
              //                         <td width='127' align='center' height='37' bgcolor='#CCCCCC'><strong>Item</strong></td>
              //                         <td width='177' align='center' bgcolor='#CCCCCC'><strong>Vendor Reference</strong></td>
              //                         <td width='100' align='center' bgcolor='#CCCCCC'><strong>Item Description</strong></td>
              //                         <td width='150' align='center' bgcolor='#CCCCCC'><strong>Qty</strong></td>
              //                         <td width='150' align='center' bgcolor='#CCCCCC'><strong>Price</strong></td>
              //                         <td width='100' align='center' bgcolor='#CCCCCC'><strong>Value</strong></td>
              //                         <td width='100' align='center' bgcolor='#CCCCCC'><strong>Currency</strong></td>
              //                         </tr>
              //                       </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/account/trail_balance',$data);
        }
    }

    /*================================ VENDOR PURCHASE BY DATE REPORT ==============================*/
      public function venPurBydateReport(){
              
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('from_date_db','from date','required');
        $this->form_validation->set_rules('to_date_db','to date','required');
        $this->form_validation->set_rules('v_code_db','warehouse code','required');
        // $this->form_validation->set_rules('saledate', 'Saleorder Date', 'required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            $tr = true;          
 
            if($tr){  
                $urlCret = "fromDate=".dataEncyptbase64($this->input->post('from_date_db'),'encrypt')."&toDate=".dataEncyptbase64($this->input->post('to_date_db'),'encrypt')."&vCode=".dataEncyptbase64($this->input->post('v_code_db'),'encrypt')."&itemCat=".dataEncyptbase64($this->input->post('item_cat_db'),'encrypt')."&ItemCls=".dataEncyptbase64($this->input->post('item_cls_db'),'encrypt')."&ItemCode=".dataEncyptbase64($this->input->post('item_code_db'),'encrypt')."";
                $pageRedirect = "<script>window.open('".base_url('report/venPurBydateReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function venPurBydateReportPrint(){
        $userCon = sessionUserData();
        $data['fromDate'] = dataEncyptbase64($this->input->get('fromDate'),'decrypt');
        $data['toDate'] = dataEncyptbase64($this->input->get('toDate'),'decrypt');
        $data['vCode'] = dataEncyptbase64($this->input->get('vCode'),'decrypt');
        $data['itemCat'] = dataEncyptbase64($this->input->get('itemCat'),'decrypt');
        $data['ItemCls'] = dataEncyptbase64($this->input->get('ItemCls'),'decrypt');
        $data['ItemCode'] = dataEncyptbase64($this->input->get('ItemCode'),'decrypt');
      
        $getData = $this->reportlib->venPurByDate((object)array(
                                                                'fromDate' =>$data['fromDate'],
                                                                'toDate' =>$data['toDate'],
                                                                'vCode' =>$data['vCode'],
                                                                'itemCat' =>$data['itemCat'],
                                                                'ItemCls' =>$data['ItemCls'],
                                                                'ItemCode' =>$data['ItemCode'],
                                                                'grpBy' =>'POH_VENDOR_CODE',
                                                                'dataType'=>'row'));
          
        $html = $this->load->view('layout/reports/print/purchase_order/vendor_pur_by_date',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              83, // margin top
              3, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                    <tr>
                                      <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='650' height='89' /></td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td><strong>From date : </strong></td>
                                      <td><strong></strong></td>
                                      <td><strong></strong></td>
                                      <td>&nbsp;</td>
                                      <td><strong></strong></td>
                                      <td><strong>Printed    By: 
                                      {$userCon->USERNAME}</strong></td>
                                    </tr>
                                    <tr>
                                      <td><strong>To date : </strong></td>
                                      <td><strong></strong></td>
                                      <td><strong></strong></td>
                                      <td align='center'><span class='style1'>Vendor Purchase By Date</span></td>
                                      <td></td>
                                      <td><strong>Printed    On: 
                                ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                    </tr>
                                    <tr>
                                      <td height='19' width='116'><strong></strong></td>
                                      <td width='137'><strong>    </strong></td>
                                      <td width='71'><strong>        </strong></td>
                                      <td width='356' align='center'></td>
                                      <td width='178'><strong>        </strong></td>
                                      <td width='180'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                    </tr>
                                    <tr>
                                      <td height='38'><strong></strong></td>
                                      <td colspan='2'><strong></strong></td>
                                      <td align='center'></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                    <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr height='37'>
                                        <th width='100' colspan='4' align='center' height='37' bgcolor='#CCCCCC'><strong>Vendor</strong></th>
                                        <th width='210' align='center' bgcolor='#CCCCCC'><strong>PO Qty</strong></th>
                                        <th width='210' align='center' bgcolor='#CCCCCC'><strong>Cost Value</strong></th>
                                      </tr>
                                      <tr height='37'>
                                        <td width='100' colspan='4' align='center' height='37'><strong>{$data['vCode']}</strong></td>
                                        <td width='210' align='center'><strong>{$getData->SUB_QTY}</strong></td>
                                        <td width='210' align='center'><strong>{$getData->SUB_TOT}</strong></td>
                                      </tr>
                                      <tr height='37'>
                                        <td width='10' height='37' bgcolor='#CCCCCC'><strong>Order No</strong></td>
                                        <td width='10' align='center' bgcolor='#CCCCCC'><strong>Doc Date</strong></td>
                                        <td width='20' align='center' bgcolor='#CCCCCC'><strong>Item</strong></td>
                                        <td width='49' align='center' bgcolor='#CCCCCC'><strong>Description</strong></td>
                                        <td width='210' align='center' bgcolor='#CCCCCC'><strong></strong></td>
                                        <td width='210' align='center' bgcolor='#CCCCCC'><strong></strong></td>
                                      </tr>
                                    </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/purchase_order/vendor_pur_by_date',$data);
        }
    }

    /*================================ CUSTOM & MIS CHARGES REPORT ==============================*/
      public function custMiscChargeReport(){
                
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('finacl_year_db','Financial year','required');
        $this->form_validation->set_rules('from_period_db','From Period','required');
        $this->form_validation->set_rules('to_period_db','To Period','required');
        $this->form_validation->set_rules('bus_unit_db', 'Business Unit', 'required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            $tr = true;          

            if($tr){  
                $urlCret = "finaclYear=".dataEncyptbase64($this->input->post('finacl_year_db'),'encrypt')."&fromPeriod=".dataEncyptbase64($this->input->post('from_period_db'),'encrypt')."&toPeriod=".dataEncyptbase64($this->input->post('to_period_db'),'encrypt')."&busUnit=".dataEncyptbase64($this->input->post('bus_unit_db'),'encrypt')."&chargeType=".dataEncyptbase64($this->input->post('charge_type_db'),'encrypt')."";
                $pageRedirect = "<script>window.open('".base_url('report/custMiscChargeReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function custMiscChargeReportPrint(){
        $userCon = sessionUserData();
        $data['finaclYear'] = dataEncyptbase64($this->input->get('finaclYear'),'decrypt');
        $data['fromPeriod'] = dataEncyptbase64($this->input->get('fromPeriod'),'decrypt');
        $data['toPeriod'] = dataEncyptbase64($this->input->get('toPeriod'),'decrypt');
        $data['busUnit'] = dataEncyptbase64($this->input->get('busUnit'),'decrypt');
        $data['chargeType'] = dataEncyptbase64($this->input->get('chargeType'),'decrypt');
          
        $html = $this->load->view('layout/reports/print/purchase_order/custom_misc_charge',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              30, // margin top
              3, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                      <td width='95' valign='bottom'><strong>Report Code: </strong><br /></td>
                                      <td width='86' valign='bottom'><strong>pom2801</strong></td>
                                      <td width='725' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='491' height='66' /></td>
                                      <td width='182' valign='bottom'><strong>Printed    By: 
                                      {$userCon->USERNAME}</strong></td>
                                    </tr>
                                    <tr>
                                      <td><strong>Printed    On: 
                                      ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                      <td width='86'><strong></strong></td>
                                      <td align='center'><span class='style1'>CUSTOM AND MISCELLANEOUS CHARGES</span><br />
                                
                                    For The Year {$data['finaclYear']}</td>
                                      <td><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                    </tr>
                                  </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/purchase_order/custom_misc_charge',$data);
        }
    }

    /*================================ PAYMENT ACCOUNT LIST REPORT ==============================*/
      public function payAccListReport(){
                  
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('v_code_from_db','vendor From','required');
        $this->form_validation->set_rules('v_code_to_db','vendor to','required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            $tr = true;          

            if($tr){  
                $urlCret = "vCodefrom=".dataEncyptbase64($this->input->post('v_code_from_db'),'encrypt')."&vCodeTo=".dataEncyptbase64($this->input->post('v_code_to_db'),'encrypt')."&itemClsFrom=".dataEncyptbase64($this->input->post('item_cls_from_db'),'encrypt')."&itemClsTo=".dataEncyptbase64($this->input->post('item_cls_to_db'),'encrypt')."&dataDueFrom=".dataEncyptbase64($this->input->post('from_date_due_db'),'encrypt')."&dataDueTo=".dataEncyptbase64($this->input->post('to_date_due_db'),'encrypt')."&vType=".dataEncyptbase64($this->input->post('v_type_db'),'encrypt')."&repType=".dataEncyptbase64($this->input->post('report_type_db'),'encrypt')."&paidIncType=".dataEncyptbase64($this->input->post('paid_inc_type_db'),'encrypt')."";
                $pageRedirect = "<script>window.open('".base_url('report/payAccListReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function payAccListReportPrint(){
        $userCon = sessionUserData();
        $data['vCodefrom'] = dataEncyptbase64($this->input->get('vCodefrom'),'decrypt');
        $data['vCodeTo'] = dataEncyptbase64($this->input->get('vCodeTo'),'decrypt');
        $data['itemClsFrom'] = dataEncyptbase64($this->input->get('itemClsFrom'),'decrypt');
        $data['itemClsTo'] = dataEncyptbase64($this->input->get('itemClsTo'),'decrypt');
        $data['dataDueFrom'] = dataEncyptbase64($this->input->get('dataDueFrom'),'decrypt');
        $data['dataDueTo'] = dataEncyptbase64($this->input->get('dataDueTo'),'decrypt');
        $data['vType'] = dataEncyptbase64($this->input->get('vType'),'decrypt');
        $data['repType'] = dataEncyptbase64($this->input->get('repType'),'decrypt');
        $data['paidIncType'] = dataEncyptbase64($this->input->get('paidIncType'),'decrypt');
          
        $html = $this->load->view('layout/reports/print/account_payable/payment_account_list',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              35, // margin top
              3, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                      <tr>
                                          <td colspan='5' align='center'>
                                              <p>
                                                  <img src=''".base_url('assets/images/invoice/report_head_logo.jpeg')."'' width='555' height='75' />
                                              </p>
                                          </td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr>
                                          <td height='20'><strong>Printed    On: 
                                      ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                          <td width='133'><strong>From Vendor: {$data['vCodefrom']}</strong></td>
                                          <td rowspan='2' align='center'><span class='style1'>PAYMENTS ACCOUNT LIST</span></td>
                                          <td><strong>To Vendor: {$data['vCodeTo']} </strong></td>
                                          <td><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                      </tr>
                                      <tr>
                                          <td height='20'><strong></strong></td>
                                          <td><strong>From Class: {$data['itemClsFrom']} </strong></td>
                                          <td><strong>To Class: {$data['itemClsTo']}</strong></td>
                                          <td><strong>Printed By:
                                          {$userCon->USERNAME}</strong></td>
                                      </tr>
                                      <tr>
                                          <td width='179'><strong>Currency </strong></td>
                                          <td height='20'><strong>Vendor Type: {$data['vType']} </strong></td>
                                          <td width='447' align='center'><strong>Due date:&nbsp;&nbsp; from-
                                                  {$data['dataDueFrom']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to - {$data['dataDueTo']}</strong></td>
                                          <td width='161'><strong> Report Type :{$data['repType']}</strong></td>
                                          <td width='168'><strong>Report Code: APM2092I</strong></td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr height='37'>
                                        <td width='101' height='37' bgcolor='#CCCCCC'><strong>Doc Number</strong></td>
                                        <td width='230' bgcolor='#CCCCCC'><strong>vendor
                                                document</strong></td>
                                        <td width='77' align='center' bgcolor='#CCCCCC'><strong>Vendor Date</strong></td>
                                        <td width='88' align='center' bgcolor='#CCCCCC'><strong>Due Date</strong></td>
                                        <td width='75' align='center' bgcolor='#CCCCCC'><strong>Disc.%</strong></td>
                                        <td width='83' align='center' bgcolor='#CCCCCC'><strong>Total Amt </strong></td>
                                        <td width='87' align='center' bgcolor='#CCCCCC'><strong>Discount Amt</strong></td>
                                        <td width='83' align='center' bgcolor='#CCCCCC'><strong>Net Amt</strong></td>
                                        <td width='68' align='center' bgcolor='#CCCCCC'><strong>Paid amt </strong></td>
                                        <td width='95' align='center' bgcolor='#CCCCCC'><strong>Remaining Amt</strong></td>
                                        <td width='101' align='center' bgcolor='#CCCCCC'><strong>Remaining Disc Amt</strong></td>
                                    </tr>
                                  </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/account_payable/payment_account_list',$data);
        }
    }

    /*================================ VENDOR STATEMENT REPORT ==============================*/
      public function venStateReport(){
                    
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('v_code_db','vendor','required');
        $this->form_validation->set_rules('from_date_db','from date','required');
        $this->form_validation->set_rules('to_date_db','to date','required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            $tr = true;          

            if($tr){  
                $urlCret = "fromDate=".dataEncyptbase64($this->input->post('from_date_db'),'encrypt')."&toDate=".dataEncyptbase64($this->input->post('to_date_db'),'encrypt')."&vCode=".dataEncyptbase64($this->input->post('v_code_db'),'encrypt')."&curr=".dataEncyptbase64($this->input->post('curr_db'),'encrypt')."";
                $pageRedirect = "<script>window.open('".base_url('report/venStateReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function venStateReportPrint(){
        $userCon = sessionUserData();
        $data['fromDate'] = dataEncyptbase64($this->input->get('fromDate'),'decrypt');
        $data['toDate'] = dataEncyptbase64($this->input->get('toDate'),'decrypt');
        $data['vCode'] = dataEncyptbase64($this->input->get('vCode'),'decrypt');
        $data['curr'] = dataEncyptbase64($this->input->get('curr'),'decrypt');
        $vendorDet = vendorList(array('where'=>"WHERE V_CODE = '{$data['vCode']}'",'dataType'=>'row'));
        $data['username'] = $userCon->USERNAME;
        $html = $this->load->view('layout/reports/print/account_payable/vendor_statement',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              42, // margin top
              3, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                    <tr>
                                    
                                      <td colspan='5' align='center'><p>
                                      <img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='462' height='59' /></p>      </td>
                                      </tr>
                                  </table>
                                    <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr>
                                        <td width='179' height='20'><strong>Printed    On: 
                                        ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                        <td width='156'><strong>From Date : {$data['fromDate']}</strong></td>
                                        <td width='424' rowspan='2' align='center'><span class='style1'>Vendor Statement</span>
                                      <strong><br />
                                      Vendor Name: &nbsp;&nbsp;{$vendorDet->V_NAME}</strong></td>
                                        <td width='161'><strong>To Date : {$data['toDate']}</strong></td>
                                        <td width='168'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                      </tr>
                                      <tr>
                                        <td height='20'><strong>Currency: {$vendorDet->CUR_NAME}</strong></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><strong>Printed    By: 
                                        {$userCon->USERNAME}</strong></td>
                                      </tr>
                                    </table>
                                    <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr height='37'>
                                        <td width='98' height='37' align='center' bgcolor='#CCCCCC'><strong>Doc 
                                        Date</strong></td>
                                        <td width='146' align='center' bgcolor='#CCCCCC'><strong>Doc Number</strong></td>
                                        <td width='280' align='center' bgcolor='#CCCCCC'><strong>Document Description</strong></td>
                                        <td width='147' align='center' bgcolor='#CCCCCC'><strong>Debit </strong></td>
                                        <td width='201' align='center' bgcolor='#CCCCCC'><strong>Credit</strong></td>
                                        <td width='216' align='center' bgcolor='#CCCCCC'><strong>Balance</strong></td>
                                      </tr>
                                  </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/account_payable/vendor_statement',$data);
        }
    }

    /*================================ VENDOR STATEMENT REPORT ==============================*/
      public function vendBalAmtDueReport(){
                      
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('v_code_db','vendor','required');
        $this->form_validation->set_rules('date_db','from date','required');
        $this->form_validation->set_rules('date_db','date','required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            $tr = true;          

            if($tr){  
                $urlCret = "date=".dataEncyptbase64($this->input->post('date_db'),'encrypt')."&vCode=".dataEncyptbase64($this->input->post('v_code_db'),'encrypt')."&curr=".dataEncyptbase64($this->input->post('curr_db'),'encrypt')."";
                $pageRedirect = "<script>window.open('".base_url('report/vendBalAmtDueReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function vendBalAmtDueReportPrint(){
        $userCon = sessionUserData();
        $data['date'] = dataEncyptbase64($this->input->get('date'),'decrypt');
        $data['vCode'] = dataEncyptbase64($this->input->get('vCode'),'decrypt');
        $data['curr'] = dataEncyptbase64($this->input->get('curr'),'decrypt');
        $vendorDet = vendorList(array('where'=>"WHERE V_CODE = '{$data['vCode']}'",'dataType'=>'row'));
        $currDet = currencyList(array('where'=>"WHERE CUR_CODE = '{$vendorDet->V_CURR_CODE}'",'dataType'=>'row'));
        $data['username'] = $userCon->USERNAME;
        $data['venDet'] = $vendorDet;
        $html = $this->load->view('layout/reports/print/account_payable/vendor_bal_and_amount_due',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              35, // margin top
              3, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                    <tr>

                                        <td colspan='5' align='center'>
                                            <p>
                                                <img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='462' height='59' />
                                            </p>
                                        </td>
                                    </tr>
                                </table>

                                <table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr>
                                        <td width='179' height='20'><strong>Printed    On: 
                                        ".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                        <td width='156'>&nbsp;</td>
                                        <td width='424' rowspan='2' align='center'><span class='style1'>VENDOR BALANCES</span><br />
                                            <strong>AS OF DUE DATE : {$data['date']}
                                            </strong>
                                        </td>
                                        <td width='161'><strong>Report Code:APM2937</strong></td>
                                        <td width='168'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                    </tr>
                                    <tr>
                                        <td height='20'><strong>Currency: {$currDet->CUR_CODE}-{$currDet->CUR_NAME}</strong></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><strong>Printed By:
                                        {$userCon->USERNAME}</strong></td>
                                    </tr>
                                </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/account_payable/vendor_bal_and_amount_due',$data);
        }
    }

    /*================================ CUSTOMER STATEMENT REPORT ==============================*/
      public function custStateReport(){
                        
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('from_date_db','From Date','required');
        $this->form_validation->set_rules('to_date_db','To date','required');
        $this->form_validation->set_rules('whse_code_db','Warehouse','required');
        $this->form_validation->set_rules('cust_db','Customer','required');
        // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            $tr = true;          

            if($tr){  
                $urlCret = "fromDate=".dataEncyptbase64($this->input->post('from_date_db'),'encrypt')."&toDate=".dataEncyptbase64($this->input->post('to_date_db'),'encrypt')."&whseCode=".dataEncyptbase64($this->input->post('whse_code_db'),'encrypt')."&custCode=".dataEncyptbase64($this->input->post('cust_db'),'encrypt')."";
                $pageRedirect = "<script>window.open('".base_url('report/custStateReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function custStateReportPrint(){
        $userCon = sessionUserData();
        $data['fromDate'] = dataEncyptbase64($this->input->get('fromDate'),'decrypt');
        $data['toDate'] = dataEncyptbase64($this->input->get('toDate'),'decrypt');
        $data['whseCode'] = dataEncyptbase64($this->input->get('whseCode'),'decrypt');
        $data['custCode'] = dataEncyptbase64($this->input->get('custCode'),'decrypt');
        $data['custDet'] = customerDet(array('where'=>"WHERE CUST_CODE = '{$data['custCode']}'",'dataType'=>'row'));
        $data['username'] = $userCon->USERNAME;
        $openingBal = $this->reportlib->custOpBal((object)array(
                                                                'fromDate'=>$data['fromDate'],
                                                                'custCode'=>$data['custCode']));
        $html = $this->load->view('layout/reports/print/account_receiveable/customer_statement',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              50, // margin top
              3, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                  <tr>

                                      <td colspan='5' align='center'>
                                          <p>
                                              <img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='462' height='59' />
                                          </p>
                                      </td>
                                  </tr>
                              </table>
                              <table width='100%' cellpadding='0' cellspacing='0'>
                                  <tr>
                                      <td width='179' height='20'><strong>".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                      <td width='156'>&nbsp;</td>
                                      <td width='424' rowspan='2' align='center'><span class='style1'>Customer Statement</span><br />
                                          <strong>FROM 1-2016&nbsp;&nbsp;&nbsp;&nbsp; Until 12-2023</strong>
                                      </td>
                                      <td width='161'><strong>Report Code: ARM2930</strong></td>
                                      <td width='168'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                  </tr>
                                  <tr>
                                      <td height='20'>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td><strong>Printed By:
                                      {$userCon->USERNAME}</strong></td>
                                  </tr>
                              </table>
                              <table width='100%' cellpadding='0' cellspacing='0'>
                                <tr height='37'>
                                    <td align='center' bgcolor='#E8E8E8'><strong>Customer</strong></td>
                                    <td height='37' align='center' bgcolor='#E8E8E8'>{$data['custDet']->CUST_CODE}</td>
                                    <td align='center' bgcolor='#E8E8E8'><strong>Name</strong></td>
                                    <td align='left' bgcolor='#E8E8E8'>{$data['custDet']->CUST_NAME_AR}</td>
                                    <td align='center' bgcolor='#E8E8E8'><strong></strong></td>
                                    <td align='center' bgcolor='#E8E8E8'><strong>Opening Balance -</strong></td>
                                    <td align='center' bgcolor='#E8E8E8'><strong>{$openingBal}</strong></td>
                                </tr>
                                <tr height='37'>
                                    <td width='98' align='center' bgcolor='#CCCCCC'><strong>Document</strong></td>
                                    <td width='98' height='37' align='center' bgcolor='#CCCCCC'><strong>Doc
                                            Date</strong></td>
                                    <td width='146' align='center' bgcolor='#CCCCCC'><strong>Doc Number</strong></td>
                                    <td width='280' align='center' bgcolor='#CCCCCC'><strong>Document Description</strong></td>
                                    <td width='147' align='center' bgcolor='#CCCCCC'><strong>Debit </strong></td>
                                    <td width='201' align='center' bgcolor='#CCCCCC'><strong>Credit</strong></td>
                                    <td width='216' align='center' bgcolor='#CCCCCC'><strong>Balance</strong></td>
                                </tr>
                              </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/account_receiveable/customer_statement',$data);
        }
    }

    /*================================ CUSTOMER STATEMENT REPORT ==============================*/
        public function custTrailBalReport(){
                            
          header('Content-Type: application/json');

          $userCon = sessionUserData();
          $this->form_validation->set_rules('from_date_db','From Date','required');
          $this->form_validation->set_rules('to_date_db','To date','required');
          $this->form_validation->set_rules('whse_code_db','Warehouse','required');
          $this->form_validation->set_rules('cust_from_db','Customer','required');
          $this->form_validation->set_rules('cust_to_db','Customer','required');
          // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
          if($this->form_validation->run() === FALSE){
              $omsg = $this->form_validation->error_array();
              echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
          }else{
              $tr = true;          

              if($tr){  
                  $urlCret = "fromDate=".dataEncyptbase64($this->input->post('from_date_db'),'encrypt')."&toDate=".dataEncyptbase64($this->input->post('to_date_db'),'encrypt')."&whseCode=".dataEncyptbase64($this->input->post('whse_code_db'),'encrypt')."&custCodeFrom=".dataEncyptbase64($this->input->post('cust_from_db'),'encrypt')."&custCodeTo=".dataEncyptbase64($this->input->post('cust_to_db'),'encrypt')."&zeroBal=".dataEncyptbase64($this->input->post('zero_bal_db'),'encrypt')."&repType=".dataEncyptbase64($this->input->post('repType'),'encrypt')."&conign=".dataEncyptbase64($this->input->post('conign_db'),'encrypt')."";
                  $pageRedirect = "<script>window.open('".base_url('report/custTrailBalReportPrint?').$urlCret."');</script>";
                  echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
              }else{
                  echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
              }
          }
      }

        public function custTrailBalReportPrint(){
          $userCon = sessionUserData();

          $data['fromDate'] = dataEncyptbase64($this->input->get('fromDate'),'decrypt');
          $data['toDate'] = dataEncyptbase64($this->input->get('toDate'),'decrypt');
          $data['whseCode'] = dataEncyptbase64($this->input->get('whseCode'),'decrypt');
          $data['custCodeFrom'] = dataEncyptbase64($this->input->get('custCodeFrom'),'decrypt');
          $data['custCodeTo'] = dataEncyptbase64($this->input->get('custCodeTo'),'decrypt');
          $data['zeroBal'] = dataEncyptbase64($this->input->get('zeroBal'),'decrypt');
          $data['repType'] = dataEncyptbase64($this->input->get('repType'),'decrypt');
          $data['conign'] = dataEncyptbase64($this->input->get('conign'),'decrypt');
          $data['username'] = $userCon->USERNAME;
          $data['custDet'] = customerDet(array('where'=>"WHERE CUST_CODE BETWEEN '{$data['custCodeFrom']}' AND '{$data['custCodeTo']}'",'dataType'=>'result'));
          $data['whseDet'] = wherehouseDetail(array('where'=>"WHERE WHSE_CODE = '{$data['whseCode']}'",'dataType'=>'row'));
          $html = $this->load->view('layout/reports/print/account_receiveable/customer_trail_bal',$data,true);
          $htmlPdfCon = 'Y';
          if($htmlPdfCon == 'Y'){
            // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
            $pdf = $this->pdf->load();
            $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                42, // margin top
                3, // margin bottom
                2, // margin header
                2); // margin footer'
                $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                      <tr>

                                          <td colspan='5' align='center'>
                                              <p>
                                                  <img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='462' height='59' />
                                              </p>
                                          </td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr>
                                          <td width='179' height='20'><strong>".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                          <td width='156'>&nbsp;</td>
                                          <td width='424' rowspan='2' align='center'><span class='style1'>AR Trial Balance</span><br />
                                              <strong>From Period: ".date("Y-m", strtotime($data['fromDate']))." To Period: ".date("Y-m", strtotime($data['toDate']))."</strong>
                                          </td>
                                          <td width='161'><strong>Report Code: ARM2930</strong></td>
                                          <td width='168'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                      </tr>
                                      <tr>
                                          <td height='20' colspan='2'><strong>Showroom: {$data['whseDet']->WHSE_DESC}</strong></td>
                                          <td>&nbsp;</td>
                                          <td><strong>Printed By:
                                          {$userCon->USERNAME}</strong></td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                    <tr height='37'>
                                        <td width='86' height='37' align='center' bgcolor='#CCCCCC'><strong>Code</strong></td>
                                        <td width='367' align='center' bgcolor='#CCCCCC'><strong>Customer</strong></td>
                                        <td width='112' align='center' bgcolor='#CCCCCC'><strong>Openning Balance</strong></td>
                                        <td width='122' align='center' bgcolor='#CCCCCC'><strong>Debit </strong></td>
                                        <td width='136' align='center' bgcolor='#CCCCCC'><strong>Credit</strong></td>
                                        <td width='145' align='center' bgcolor='#CCCCCC'><strong>Debit Balance</strong></td>
                                        <td width='120' align='center' bgcolor='#CCCCCC'><strong>Credit Balance</strong></td>
                                    </tr>
                                  </table>",'O',true);
            // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
            $pdf->WriteHTML($html);
            $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
          }else{
            $this->load->view('layout/reports/print/account_receiveable/customer_trail_bal',$data);
          }
      }

      /*================================ PRINT PURCHASE ORDER REPORT ==============================*/
        public function purOderRPReport(){
                              
          header('Content-Type: application/json');

          $userCon = sessionUserData();
          $this->form_validation->set_rules('order_no_db','Order No','required');
          // if($usertype=="mechanic"){ $this->form_validation->set_rules('delboyid', 'Delivery Boy', 'required'); }
          if($this->form_validation->run() === FALSE){
              $omsg = $this->form_validation->error_array();
              echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
          }else{
              $tr = true;          

              if($tr){  
                  $urlCret = "prefix=".dataEncyptbase64($this->input->post('prefix_db'),'encrypt')."&orderNo=".dataEncyptbase64($this->input->post('order_no_db'),'encrypt')."";
                  $pageRedirect = "<script>window.open('".base_url('report/purOderRPReportPrint?').$urlCret."');</script>";
                  echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
              }else{
                  echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
              }
          }
      }

        public function purOderRPReportPrint(){
          $userCon = sessionUserData();

          $data['orderNo'] = dataEncyptbase64($this->input->get('orderNo'),'decrypt');
          $data['prefix'] = dataEncyptbase64($this->input->get('prefix'),'decrypt');
          $data['clearDet'] = clearancDet($data['prefix'].$data['orderNo'],'row');
          $data['poHeader'] = purchaseOrderHeaderDet($data['prefix'].$data['orderNo'],'row');
          $data['poDetail'] = purchaseOrderItemDet($data['prefix'].$data['orderNo'],'result');
          $data['busUnit'] = busUnitDetail(array('where'=>"WHERE BU_CODE = 111"));
          $data['user'] = $userCon;
          $html = $this->load->view('layout/reports/print/purchase_order/print_purchase_order_retail_price',$data,true);
          $htmlPdfCon = 'Y';
          if($htmlPdfCon == 'Y'){
            // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
            $pdf = $this->pdf->load();
            $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                52, // margin top
                3, // margin bottom
                2, // margin header
                2); // margin footer'
                $pdf->SetHTMLHeader("<table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr>
                                          <td height='20'><strong>".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                          <td colspan='4' rowspan='2' align='center' valign='middle'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='359'
                                                  height='47' /></td>
                                          <td align='right'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                      </tr>
                                      <tr>
                                          <td height='20'><strong>Report Code: APM2092I</strong></td>
                                          <td align='right'><strong>Printed By:
                                                  {$userCon->USERNAME}</strong></td>
                                      </tr>
                                      <tr>
                                          <td height='20'><strong>Vendor</strong></td>
                                          <td><strong>Purchase Orde</strong></td>
                                          <td><strong>Terms</strong></td>
                                          <td><strong>Freight</strong></td>
                                          <td><strong>INVOICE NO: </strong></td>
                                          <td><strong>clearance number: </strong></td>
                                      </tr>
                                      <tr>
                                          <td width='157' height='20'><strong>{$data['poHeader']->POH_VENDOR_CODE}</strong></td>
                                          <td width='127'><strong> {$data['poHeader']->POH_PREFIX}-{$data['poHeader']->POH_ORDER_ID}</strong></td>
                                          <td width='107'><strong>{$data['poHeader']->TERM_DESC}</strong></td>
                                          <td width='99'><strong> {$data['poHeader']->SHIPV_DESC}</strong></td>
                                          <td width='134'><strong> {$data['clearDet']->CPO_RECEIPT_PFX}-{$data['clearDet']->CPO_RECEIPT_NO}</strong></td>
                                          <td width='154'><strong>{$data['clearDet']->CPO_CL_NO}</strong></td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr>
                                          <td width='256' height='20' style='border:#000000 solid 1px; border-bottom:#000000 solid 0px;'>
                                              <strong>{$data['busUnit']->BU_NAME1} </strong></td>
                                          <td rowspan='3' align='center'><span class='style1'>Purchase Order</span></td>
                                          <td width='260' align='right' style='border:#000000 solid 1px; border-bottom:#000000 solid 0px;'>
                                              <strong>{$data['poHeader']->V_NAME}</strong>.</td>
                                      </tr>
                                      <tr>
                                          <td height='20' style='border-left:#000000 solid 1px; border-right:#000000 solid 1px;'>
                                              <strong>{$data['busUnit']->BU_STR_ADDR1}</strong></td>
                                          <td align='right' style='border-left:#000000 solid 1px; border-right:#000000 solid 1px;'><strong>{$data['poHeader']->BUILDING_NO},{$data['poHeader']->STREET},{$data['poHeader']->FULL_ADDRESS}</strong></td>
                                      </tr>
                                      <tr>
                                          <td height='20' style='border-left:#000000 solid 1px; border-right:#000000 solid 1px;'>
                                              <strong>{$data['busUnit']->CTY_NAME}</strong></td>
                                          <td align='right' style='border-left:#000000 solid 1px; border-right:#000000 solid 1px;'>
                                              <strong>{$data['poHeader']->CTY_NAME}</strong></td>
                                      </tr>
                                      <tr>
                                          <td height='20' style='border:#000000 solid 1px; border-top:#000000 solid 0px;'><strong>
                                          {$data['busUnit']->CNTRY_NAME},{$data['busUnit']->ST_NAME} ,{$data['busUnit']->CTY_NAME}</strong></td>
                                          <td width='226' align='center'>&nbsp;</td>
                                          <td height='20' align='right' style='border:#000000 solid 1px; border-top:#000000 solid 0px;'><strong>
                                          {$data['poHeader']->CNTRY_NAME},{$data['poHeader']->ST_NAME} ,{$data['poHeader']->CTY_NAME}</strong></td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr height='23'>
                                          <td height='10' align='right' style='border-bottom:#000000 solid 2px;'></td>
                                      </tr>
                                      <tr height='10'>
                                          <td height='10' align='right' style='border-bottom:#000000 solid 0px;'></td>
                                      </tr>
                                  </table>",'O',true);
            // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
            $pdf->WriteHTML($html);
            $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
          }else{
            $this->load->view('layout/reports/print/purchase_order/print_purchase_order_retail_price',$data);
          }
      }

    /*================================ CONSIGNMENT SALES REPORT ==============================*/
      public function consignSaleReport(){
                              
        header('Content-Type: application/json');

        $userCon = sessionUserData();
        $this->form_validation->set_rules('v_code_from_db','From Vendor','required');
        $this->form_validation->set_rules('v_code_to_db','To Vendor','required');
        $this->form_validation->set_rules('from_whse_code_db','Warehouse','required');
        $this->form_validation->set_rules('to_whse_code_db','Customer','required');
        if($this->form_validation->run() === FALSE){
            $omsg = $this->form_validation->error_array();
            echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
        }else{
            $tr = true;          

            if($tr){  
                $urlCret = "fromDate=".dataEncyptbase64($this->input->post('from_date_db'),'encrypt')."&toDate=".dataEncyptbase64($this->input->post('to_date_db'),'encrypt')."&vCodeFrom=".dataEncyptbase64($this->input->post('v_code_from_db'),'encrypt')."&vCodeTo=".dataEncyptbase64($this->input->post('v_code_to_db'),'encrypt')."&whseFrom=".dataEncyptbase64($this->input->post('from_whse_code_db'),'encrypt')."&whseTo=".dataEncyptbase64($this->input->post('to_whse_code_db'),'encrypt')."&itemFrom=".dataEncyptbase64($this->input->post('item_code_from_db'),'encrypt')."&itemTo=".dataEncyptbase64($this->input->post('item_code_to_db'),'encrypt')."&itemClass=".dataEncyptbase64($this->input->post('item_cls_db'),'encrypt')."&venRef=".dataEncyptbase64($this->input->post('vendor_ref_db'),'encrypt')."&withPic=".dataEncyptbase64($this->input->post('with_pic_db'),'encrypt')."";
                $pageRedirect = "<script>window.open('".base_url('report/consignSaleReportPrint?').$urlCret."');</script>";
                echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
            }else{
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
            }
        }
    }

      public function consignSaleReportPrint(){
        $userCon = sessionUserData();

        $data['fromDate'] = dataEncyptbase64($this->input->get('fromDate'),'decrypt');
        $data['toDate'] = dataEncyptbase64($this->input->get('toDate'),'decrypt');
        $data['vCodeFrom'] = dataEncyptbase64($this->input->get('vCodeFrom'),'decrypt');
        $data['vCodeTo'] = dataEncyptbase64($this->input->get('vCodeTo'),'decrypt');
        $data['whseFrom'] = dataEncyptbase64($this->input->get('whseFrom'),'decrypt');
        $data['whseTo'] = dataEncyptbase64($this->input->get('whseTo'),'decrypt');
        $data['itemFrom'] = dataEncyptbase64($this->input->get('itemFrom'),'decrypt');
        $data['itemTo'] = dataEncyptbase64($this->input->get('itemTo'),'decrypt');
        $data['itemClass'] = dataEncyptbase64($this->input->get('itemClass'),'decrypt');
        $data['venRef'] = dataEncyptbase64($this->input->get('venRef'),'decrypt');
        $data['withPic'] = dataEncyptbase64($this->input->get('withPic'),'decrypt');
        $data['username'] = $userCon->USERNAME;
        $data['whseDet'] = wherehouseDetail(array('where'=>"WHERE WHSE_CODE BETWEEN '{$data['whseFrom']}' AND '{$data['whseTo']}' AND WHSE_LOCATION_TYPE = 'SL'",'dataType'=>"result"));
        $html = $this->load->view('layout/reports/print/sale_order/consign_sales_report',$data,true);
        $htmlPdfCon = 'Y';
        if($htmlPdfCon == 'Y'){
          // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
          $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              42, // margin top
              3, // margin bottom
              2, // margin header
              2); // margin footer'
              $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                      <tr>
                                  
                                      <td colspan='5' align='center'><p>
                                      <img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='555' height='75' /></p>      </td>
                                      </tr>
                                  </table>
                                  <table width='100%' cellpadding='0' cellspacing='0'>
                                      <tr>
                                      <td height='20'><strong>".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                      <td width='133'><strong>From Vendor: {$data['vCodeFrom']} </strong></td>
                                      <td rowspan='2' align='center'><span class='style1'>SALES REPORT (VENDOR WISE)</span></td>
                                      <td><strong>To Vendor : {$data['vCodeTo']}</strong></td>
                                      <td><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                      </tr>
                                      <tr>
                                      <td height='20'><strong></strong></td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td><strong>Printed    By: 
                                  {$userCon->USERNAME}</strong></td>
                                      </tr>
                                      <tr>
                                      <td width='179'><strong>Item Class: All </strong></td>
                                      <td height='20'>&nbsp;</td>
                                      <td width='447' align='center'><strong>Date:&nbsp;&nbsp;      from- {$data['fromDate']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to - {$data['toDate']}</strong></td>
                                      <td width='161'>&nbsp;</td>
                                      <td width='168'><strong>Report Code: APM2092I</strong></td>
                                      </tr>
                                  </table>",'O',true);
          // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
        }else{
          $this->load->view('layout/reports/print/sale_order/consign_sales_report',$data);
        }
    }

    /*================================ MONTHLY SALES BY VENDOR BY CATEGORY REPORT ==============================*/
        public function monthSaleByVendorCateReport(){
                                
            header('Content-Type: application/json');

            $userCon = sessionUserData();
            $this->form_validation->set_rules('item_cat_db','Item Category','required');
            $this->form_validation->set_rules('whse_code_db','warehouse','required');
            $this->form_validation->set_rules('v_code_db','vendor','required');
            $this->form_validation->set_rules('month_db','month','required');
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $tr = true;          

                if($tr){  
                    $urlCret = "itmCat=".dataEncyptbase64($this->input->post('item_cat_db'),'encrypt')."&whseCode=".dataEncyptbase64($this->input->post('whse_code_db'),'encrypt')."&vCode=".dataEncyptbase64($this->input->post('v_code_db'),'encrypt')."&mon=".dataEncyptbase64($this->input->post('month_db'),'encrypt')."&withItmDet=".dataEncyptbase64($this->input->post('with_item_det_db'),'encrypt')."&byVeSum=".dataEncyptbase64($this->input->post('by_ve_summay_db'),'encrypt')."&byClsSum=".dataEncyptbase64($this->input->post('by_cls_summary_db'),'encrypt')."&bestVenSum=".dataEncyptbase64($this->input->post('best_ven_summary_db'),'encrypt')."&custPurDet=".dataEncyptbase64($this->input->post('cust_pur_det_db'),'encrypt')."";
                    $pageRedirect = "<script>window.open('".base_url('report/monthSaleByVendorCateReportPrint?').$urlCret."');</script>";
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$pageRedirect));
                }else{
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data found this date and Warehouse"));
                }
            }
        }

        public function monthSaleByVendorCateReportPrint(){
            $userCon = sessionUserData();

            $data['itmCat'] = dataEncyptbase64($this->input->get('itmCat'),'decrypt');
            $data['whseCode'] = dataEncyptbase64($this->input->get('whseCode'),'decrypt');
            $data['vCode'] = dataEncyptbase64($this->input->get('vCode'),'decrypt');
            $data['mon'] = dataEncyptbase64($this->input->get('mon'),'decrypt');
            $data['withItmDet'] = dataEncyptbase64($this->input->get('withItmDet'),'decrypt');
            $data['byVeSum'] = dataEncyptbase64($this->input->get('byVeSum'),'decrypt');
            $data['bestVenSum'] = dataEncyptbase64($this->input->get('bestVenSum'),'decrypt');
            $data['custPurDet'] = dataEncyptbase64($this->input->get('custPurDet'),'decrypt');
            $data['username'] = $userCon->USERNAME;
            $data['whseDet'] = wherehouseDetail(array('where'=>"WHERE WHSE_CODE BETWEEN '{$data['whseFrom']}' AND '{$data['whseTo']}' AND WHSE_LOCATION_TYPE = 'SL'",'dataType'=>"result"));
            $html = $this->load->view('layout/reports/print/sale_order/consign_sales_report',$data,true);
            $htmlPdfCon = 'Y';
            if($htmlPdfCon == 'Y'){
            // $html = $this->load->view('layout/user_role_management/group_module_list',[], true);
            $pdf = $this->pdf->load();
            $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                42, // margin top
                3, // margin bottom
                2, // margin header
                2); // margin footer'
                $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                        <tr>
                                    
                                        <td colspan='5' align='center'><p>
                                        <img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='555' height='75' /></p>      </td>
                                        </tr>
                                    </table>
                                    <table width='100%' cellpadding='0' cellspacing='0'>
                                        <tr>
                                        <td height='20'><strong>".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                        <td width='133'><strong>From Vendor: {$data['vCodeFrom']} </strong></td>
                                        <td rowspan='2' align='center'><span class='style1'>SALES REPORT (VENDOR WISE)</span></td>
                                        <td><strong>To Vendor : {$data['vCodeTo']}</strong></td>
                                        <td><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                        </tr>
                                        <tr>
                                        <td height='20'><strong></strong></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td><strong>Printed    By: 
                                    {$userCon->USERNAME}</strong></td>
                                        </tr>
                                        <tr>
                                        <td width='179'><strong>Item Class: All </strong></td>
                                        <td height='20'>&nbsp;</td>
                                        <td width='447' align='center'><strong>Date:&nbsp;&nbsp;      from- {$data['fromDate']}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to - {$data['toDate']}</strong></td>
                                        <td width='161'>&nbsp;</td>
                                        <td width='168'><strong>Report Code: APM2092I</strong></td>
                                        </tr>
                                    </table>",'O',true);
            // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
            $pdf->WriteHTML($html);
            $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
            }else{
            $this->load->view('layout/reports/print/sale_order/consign_sales_report',$data);
            }
        }

        /*================================  PHYSICAL INVENTORY COUNT ==============================*/
        
        public function exccesAndShortReportPrint(){
            $userCon = sessionUserData();

            $data['orderId'] = dataEncypt($this->input->get('orderid'),'decrypt');
            $data['username'] = $userCon->USERNAME;
            
            $checkDet = $this->unicon->CoreQuery("SELECT * FROM PHY_INV_STK_CRPT WHERE PISC_ORDER_NO =  '{$data['orderId']}'","num_rows");
            if ($checkDet == 0) {
                $this->session->set_flashdata(['FLASH_ALERT'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <i class='mdi mdi-alert-outline me-2'></i>
                                                    SOMETHING WENT WRONG RETRY
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>"]);
                redirect(base_url('PhysicalInventoryList'),'refresh');
            }
            $data['excessDet'] = $this->unicon->CoreQuery("SELECT T.PISC_ITEM, T.PISC_ITEM_DESC, T.PISC_PRICE  MICER_PRICE, T.PISC_SYSQTY, T.PISC_CNTQTY, T.PISC_DIFF,(T.PISC_DIFF * T.PISC_PRICE)  MICER_VAR_VALUE
                                                            FROM PHY_INV_STK_CRPT  T
                                                            WHERE T.PISC_BUS_UNIT =111
                                                            AND T.PISC_ORDER_NO =  '{$data['orderId']}'
                                                            AND T.PISC_STATUS = 'EXCESS'
                                                            ORDER BY T.PISC_ITEM","result");

            $data['shortDet'] = $this->unicon->CoreQuery("SELECT T.PISC_ITEM MICSR_ITEM, T.PISC_ITEM_DESC MICSR_ITEM_DESC1, T.PISC_PRICE  MICSR_PRICE, T.PISC_SYSQTY MICSR_SYSTEM_QTY, T.PISC_CNTQTY MICSR_COUNT_QTY, T.PISC_DIFF MICSR_VAR_QTY, (T.PISC_DIFF * T.PISC_PRICE)  MICSR_VAR_VALUE
                                                            FROM PHY_INV_STK_CRPT  T
                                                            WHERE T.PISC_BUS_UNIT = 111
                                                            AND T.PISC_ORDER_NO = '{$data['orderId']}'
                                                            AND T.PISC_STATUS = 'SHORT'
                                                            AND PISC_SHORT_NOTE IS  NULL
                                                            ORDER BY 1","result");

            if (count($data['shortDet']) == 0 && count($data['excessDet']) == 0) {
                $this->session->set_flashdata(['FLASH_ALERT'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <i class='mdi mdi-alert-outline me-2'></i>
                                                    NO SHORT AND EXCESS QTY FOUND
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>"]);
                redirect(base_url('PhysicalInventoryList'),'refresh');
            }
            $whseDet = $this->unicon->CoreQuery("SELECT * FROM PHY_INV_COUNT_HEADER,WHAREHOUSE WHERE PICH_WHSE = WHSE_CODE AND PICH_ORDER_NO ='{$data['orderId']}'","row");
            $htmlPdfCon = 'Y';
            if($htmlPdfCon == 'Y'){
            $html = $this->load->view('layout/reports/print/physical_inventory_count/excees_and_short',$data,true);
            $pdf = $this->pdf->load();
            $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '',
                3, // margin_left
                3, // margin right
                33, // margin top
                3, // margin bottom
                2, // margin header
                2); // margin footer'
                $pdf->SetHTMLHeader("<table width='100%' cellpadding='0' cellspacing='0'>
                                        <tr>
                                        <td width='181'>&nbsp;</td>
                                        <td width='108'>&nbsp;</td>
                                        <td width='501' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='462' height='59' /></td>
                                        <td width='127'>&nbsp;</td>
                                        <td width='171' align='right'>&nbsp;</td>
                                        </tr>
                                    </table>
                                    <table width='100%' cellpadding='0' cellspacing='0'>
                                        <tr>
                                        <td width='167'><strong>Report Code:  ICM9992</strong></td>
                                        <td>&nbsp;</td>
                                        <td rowspan='2' align='center'><span class='style1'>Physical Count Report</span></td>
                                        <td align='right'><strong>Page:&nbsp;&nbsp;{PAGENO} / {nbpg}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><strong>".date('Y-m-d')." ".substr(dateTime(),11)."</strong></td>
                                        <td>&nbsp;</td>
                                        <td align='right'><strong>Printed    By: 
                                        {$userCon->USERNAME}</strong></td>
                                        </tr>
                                        <tr>
                                        <td height='20'>&nbsp;</td>
                                        <td width='175'>&nbsp;</td>
                                        <td width='426' align='center'><strong>{$whseDet->WHSE_CODE}-{$whseDet->WHSE_DESC}</strong></td>
                                        <td width='320' align='right'>&nbsp;</td>
                                        </tr>
                                        <tr>
                                        <td height='5' colspan='4' style='border-bottom:#000000 solid 2px;'></td>
                                        </tr>
                                    </table>",'O',true);
            // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
            $pdf->WriteHTML($html);
            $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
            }else{
                $this->load->view('layout/reports/print/physical_inventory_count/excees_and_short',$data);
            }
        }

        public function shortWithPicReportPrint(){
            $userCon = sessionUserData();
            $data['orderId'] = dataEncypt($this->input->get('orderid'),'decrypt');
            $checkDet = $this->unicon->CoreQuery("SELECT * FROM PHY_INV_STK_CRPT WHERE PISC_ORDER_NO =  '{$data['orderId']}'","num_rows");
            if ($checkDet == 0) {
                $this->session->set_flashdata(['FLASH_ALERT'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <i class='mdi mdi-alert-outline me-2'></i>
                                                    SOMETHING WENT WRONG RETRY
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>"]);
                redirect(base_url('PhysicalInventoryList'),'refresh');
            }


            $data['shortDet'] = $this->unicon->CoreQuery("SELECT T.PISC_ITEM MICSR_ITEM, T.PISC_ITEM_DESC MICSR_ITEM_DESC1, T.PISC_PRICE  MICSR_PRICE, T.PISC_SYSQTY MICSR_SYSTEM_QTY, T.PISC_CNTQTY MICSR_COUNT_QTY, T.PISC_DIFF MICSR_VAR_QTY, (T.PISC_DIFF * T.PISC_PRICE)  MICSR_VAR_VALUE,I.I_IMAGE_FILENAME
                                                            FROM PHY_INV_STK_CRPT  T, ITEMS I
                                                            WHERE T.PISC_BUS_UNIT =111 
                                                            AND T.PISC_ITEM = I.I_CODE
                                                            AND T.PISC_ORDER_NO = '{$data['orderId']}'
                                                            AND T.PISC_STATUS = 'SHORT'
                                                            ORDER BY 1","result");

            if (count($data['shortDet']) == 0) {
                $this->session->set_flashdata(['FLASH_ALERT'=>"<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                    <i class='mdi mdi-alert-outline me-2'></i>
                                                    NO SHORT QTY FOUND
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>"]);
                redirect(base_url('PhysicalInventoryList'),'refresh');
            }

            $whseDet = $this->unicon->CoreQuery("SELECT * FROM PHY_INV_COUNT_HEADER,WHAREHOUSE WHERE PICH_WHSE = WHSE_CODE AND PICH_ORDER_NO ='{$data['orderId']}'","row");

            $htmlPdfCon = 'Y';
            if($htmlPdfCon == 'Y'){
              $html = $this->load->view('layout/reports/print/physical_inventory_count/short_with_image',$data,true);
              $pdf = $this->pdf->load();
              $pdf->AddPage('P', // L - landscape, P - portrait
                  '', '', '', '',
                  3, // margin_left
                  3, // margin right
                  30, // margin top
                  3, // margin bottom
                  2, // margin header
                  2); // margin footer'
                  $pdf->SetHTMLHeader("<table width='100%' border='0' cellpadding='0' cellspacing='0' bordercolor='0'>
                                        <tr>
                                          <td colspan='5' align='center'><img src='".base_url('assets/images/invoice/report_head_logo.jpeg')."' width='468' height='63' /></td>
                                        </tr>
                                      </table>
                                      <table width='100%' cellpadding='0' cellspacing='0'>
                                        <tr>
                                          <td width='91' height='20' bgcolor='#CCCCCC'><strong>Location : </strong></td>
                                          <td width='947' colspan='2' bgcolor='#CCCCCC'><strong>{$whseDet->WHSE_CODE}-{$whseDet->WHSE_DESC}</strong></td>
                                        </tr>
                                      </table>",'O',true);
              // $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:0pt;">{PAGENO}/{nbpg} #GFYHY</div>');
              $pdf->WriteHTML($html);
              $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
            }else{
              $this->load->view('layout/reports/print/physical_inventory_count/short_with_image',$data);
            }
        }

    public function reportTest(){
      $html = $this->load->view('layout/reports/print/r_test',[],true);
      $pdf = $this->pdf->load();
          $pdf->AddPage('L', // L - landscape, P - portrait
              '', '', '', '',
              3, // margin_left
              3, // margin right
              3, // margin top
              3, // margin bottom
              2, // margin header
              2); // margin footer'
          $pdf->WriteHTML($html);
          $pdf->Output('Invoice_#asdf.pdf','I'); // I - View, D - Download
    }
    
    public function testInt(){
      // $this->load->helper('cookie');
      $this->input->set_cookie('usman', '322', 15,'','/report');
      delete_cookie('remember_me');
    }

    public function testCoc(){
        print_r(itemGoldDia('00269584'));
    }
  }
?>