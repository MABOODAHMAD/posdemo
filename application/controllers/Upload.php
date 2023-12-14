<?php
     class Upload extends CI_Controller{

         public function __construct(){
            parent::__construct();
            $this->load->library("PHPExcel");
            // $this->load->model('Universal_model','unicon');
         }
        public function bulkItemAdddb(){
            $userCon = sessionUserData();
            $path = 'uploads/item/'; $filename = $ierr = $inputFileName = null;
            if(isset($_FILES["item_file"]) && !empty($_FILES["item_file"]["name"])){
            $config['upload_path'] = $path;
            $foname = $_FILES['item_file']['name'];
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['max_size'] = 5000;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('item_file')){
                $filename = $this->upload->data()['file_name'];
            }else{ $ierr = $this->upload->display_errors(); } }

            if(empty($ierr)){
                if($filename){ $flag=false;
                $inputFileName = $path.$filename;
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                     $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                     $objPHPExcel = $objReader->load($inputFileName);
                     $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                     $pro = array();
                     $flashData = "";
                     $ty = true;
                     $exSn = 0;
                     foreach ($allDataInSheet as $value) {
                        $exSn++;
                        if($exSn>1){
                        $snNw = $exSn-1;
                        $flag=true;
                        $pro_code = false;
                            $itemCodeCheck = itemDetails("{$value['A']}");
                            $venCodeCheck = vendorList(['dataType'=>'num_rows','where'=>"WHERE V_CODE = '{$value['G']}'"]);
                            $itemClassCodeCheck = classList(['dataType'=>'num_rows','where'=>"WHERE IC_CODE = '{$value['I']}'"]);
                            $itemCatCodeCheck = categoryList(['dataType'=>'num_rows','where'=>"WHERE ICAT_CODE = '{$value['J']}'"]);
                            $uomCodeCheck = uomList(['dataType'=>'num_rows','where'=>"WHERE UOM_CODE = '{$value['K']}'"]);
                            $contCodeCheck = countryList(['dataType'=>'num_rows','where'=>"WHERE CNTRY_CODE = '{$value['L']}'"]);
                            if(count($itemCodeCheck) === 0 && $venCodeCheck === 1 && $itemClassCodeCheck > 0 && $itemCatCodeCheck === 1 && $uomCodeCheck === 1 && $contCodeCheck === 1 && $value['M'] && $value['Z']){
                                $excelDataArr = array(
                                                        'I_CODE' =>$value['A'],
                                                        'I_DESC' =>$value['B'],
                                                        'I_SECONDARY_DESC' =>$value['C'],
                                                        'I_EXTEND_DESC' =>$value['D'],
                                                        'VEN_I_CODE' =>$value['E'],
                                                        'VEN_I_DESC' =>$value['F'],
                                                        'VEN_CODE' =>$value['G'],
                                                        'REV_DATE' =>date('Y-m-d', strtotime($value['H'])),
                                                        'I_CLASS_CODE' =>$value['I'],
                                                        'I_CAT_CODE' =>$value['J'],
                                                        'I_UOM_CODE' =>$value['K'],
                                                        'I_CNTRY_CODE' =>$value['L'],
                                                        'I_TYPE' =>$value['M'],
                                                        'I_STATUS' =>$value['N']?$value['N']:'Y',
                                                        'I_NOTE' =>$value['O'],
                                                        'I_CLEARITY' =>$value['P'],
                                                        'I_CLR_COLOR' =>$value['Q'],
                                                        'I_CLR_GLOBAL_ATTRIBUTE' =>$value['R'],
                                                        'I_STYLE' =>$value['S'],
                                                        'I_STY_COLOR' =>$value['T'],
                                                        'I_STY_SIZE' =>$value['U'],
                                                        'I_LENGTH' =>$value['R'],
                                                        'I_WIDTH' =>$value['V'],
                                                        'I_HEIGHT' =>$value['X'],
                                                        'I_WEIGHT' =>$value['Y'],
                                                        'I_COST_MULTIPLIER' =>$value['Z'],
                                                        'I_MAX_DISCOUNT' =>$value['AA']?$value['AA']:0,
                                                        'I_FREEZABLE' =>$value['AB']?$value['AB']:'N',
                                                        'I_FLAMMABLE' =>$value['AC']?$value['AC']:'N',
                                                        'I_IMAGE_FILENAME' =>$value['AD']?$value['AD']:'no_image.jpg',
                                                        'I_CRE_BY' =>$userCon->USERNAME,
                                                        'I_CRE_DATE' =>dateTime(),
                                                    );
                                if($value['A']){
                                    $ty = true;
                                    if($this->unicon->insertUniversal('ITEMS',$excelDataArr)){
                                        $flashData .= "<tr>
                                                            <td>$snNw</td>
                                                            <td>{$excelDataArr['I_CODE']}</td>
                                                            <td>Y</td>
                                                        </tr>";
                                        // echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"All Booklet Assigned.... :)"));
                                    }else{
                                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"Quantity not more then "));
                                    }
                                }else{
                                    break;
                                }
                            }else{
                                if(!$value['A']){
                                    break;
                                }

                                
                                $vendorMsg = $venCodeCheck === 0?'Vendor Code Invalid':'';
                                $itemCatMsg = $itemCatCodeCheck === 0?'Item Category Code Invalid':'';
                                $itemClassMsg = $itemClassCodeCheck === 0?'Item Class Code Invalid':'';
                                $itemCodeMsg = count($itemCodeCheck) === 0?'':'Item Code Already Exist';
                                $uomMsg = $uomCodeCheck === 0?'unit of measurement Code Invalid':'';
                                $contMsg = $contCodeCheck === 0?'country Code Invalid':'';
                                $iteTypeMsg = $value['M']?'':'Item type value missing';
                                $costMultiMsg = $value['Z']?'':'Cost multiplier value missing';

                                $flashData .= "<tr>
                                                    <td>$snNw</td>
                                                    <td>{$value['A']}</td>
                                                    <td>
                                                        <p>$vendorMsg</p>
                                                        <p>$itemCodeMsg</p>
                                                        <p>$itemClassMsg</p>
                                                        <p>$itemCatMsg</p>
                                                        <p>$uomMsg</p>
                                                        <p>$contMsg</p>
                                                        <p>$iteTypeMsg</p>
                                                        <p>$costMultiMsg</p>
                                                    </td>
                                                </tr>";
                            }
                        }
                    }
                        if($ty){
                            
                            $last_id = $this->unicon->insertUniversal('FLASHDATA_MSG',array('FM_MSG'=>$flashData),1);
                            $this->session->set_flashdata(['ITEM_BULK_MSG'=>$last_id]);
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Uploaded"));
                        }
                    } catch(Exception $e) {
                        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                    } 
                    // $msg = $flag ? "Data Uploded successfully  ": "Something went wrong";
                }else{ 
                    $msg = "Please select excel file."; 
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
                }else{
                    $msg = $ierr;
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
        }

        public function bulkItemTraitAdddb(){
            $userCon = sessionUserData();
            $path = 'uploads/item/'; $filename = $ierr = $inputFileName = null;
            if(isset($_FILES["item_file"]) && !empty($_FILES["item_file"]["name"])){
            $config['upload_path'] = $path;
            $foname = $_FILES['item_file']['name'];
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['max_size'] = 5000;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('item_file')){
                $filename = $this->upload->data()['file_name'];
            }else{ $ierr = $this->upload->display_errors(); } }

            if(empty($ierr)){
                if($filename){ $flag=false;
                $inputFileName = $path.$filename;
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                     $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                     $objPHPExcel = $objReader->load($inputFileName);
                     $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                     $pro = array();
                     $flashData = "";
                     $ty = true;
                     $exSn = 0;
                     foreach ($allDataInSheet as $value) {
                        $exSn++;
                        if($exSn>1){
                        $snNw = $exSn-1;
                        $flag=true;
                        $pro_code = false;
                        
                            $itemCodeCheck = $this->unicon->CoreQuery("SELECT * FROM ITEMS WHERE I_CODE='{$value['A']}'","num_rows");
                            $itemTraitCatCheck = traitCatList(['dataType'=>'num_rows','where'=>"WHERE TC_CODE = '{$value['B']}'"]);
                            $itemTraitCheck = traitAddList(['dataType'=>'num_rows','where'=>"WHERE TRAIT_SUB_CAT_CODE = '{$value['C']}'"]);
                            $itemWeightCheck = $value['D']>0?1:0;
                            if($itemCodeCheck === 1 && $itemTraitCatCheck === 1 && $itemTraitCheck > 0 && $itemWeightCheck === 1){
                                $excelDataArr = array(
                                                        'ITM_CODE' =>$value['A'],
                                                        'ITM_TRAIT_CAT_CODE' =>$value['B'],
                                                        'ITM_TRAIT_CODE' =>$value['C'],
                                                        'TRT_WEIGHT' =>$value['D'],
                                                        'ITM_TRT_CRE_BY' =>$userCon->USERNAME,
                                                        'ITM_TRT_CRE_DATE' =>dateTime(),
                                                        'TRT_CRE_TYPE' => 'UPLOAD',
                                                    );
                                if($value['A']){
                                    $ty = true;
                                    if($this->unicon->insertUniversal('ITEM_TRAITS',$excelDataArr)){
                                        $flashData .= "<tr>
                                                            <td>$snNw</td>
                                                            <td>{$excelDataArr['ITM_CODE']}</td>
                                                            <td>TRAIT ADDED</td>
                                                        </tr>";
                                        // echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"All Booklet Assigned.... :)"));
                                    }else{
                                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"Quantity not more then "));
                                    }
                                }else{
                                    break;
                                }
                            }else{
                                if(!$value['A']){
                                    break;
                                }
                                $vendorMsg = $itemTraitCatCheck === 0?'Trait category Code Invalid':'';
                                $itemCatMsg = $itemTraitCheck > 0?'Trait Code Invalid':'';
                                $itemClassMsg = $itemWeightCheck === 0?'Weight Invalid':'';
                                $itemCodeMsg = $itemCodeCheck === 0?'Item Code Not Exist':'';

                                $flashData .= "<tr>
                                                    <td>$snNw</td>
                                                    <td>{$value['A']}</td>
                                                    <td>
                                                        <p>$vendorMsg</p>
                                                        <p>$itemCodeMsg</p>
                                                        <p>$itemClassMsg</p>
                                                        <p>$itemCatMsg</p>
                                                    </td>
                                                </tr>";
                            }
                        }
                    }
                        if($ty){
                            
                            $last_id = $this->unicon->insertUniversal('FLASHDATA_MSG',array('FM_MSG'=>$flashData),1);
                            $this->session->set_flashdata(['ITEM_BULK_MSG'=>$last_id]);
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Uploaded"));
                        }
                    } catch(Exception $e) {
                        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                    } 
                    // $msg = $flag ? "Data Uploded successfully  ": "Something went wrong";
                }else{ 
                    $msg = "Please select excel file."; 
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
                }else{
                    $msg = $ierr;
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
        }

        // public function bulkItemAdddb(){
        //     $userCon = sessionUserData();
        //     $path = 'uploads/item/'; $filename = $ierr = $inputFileName = null;
        //     if(isset($_FILES["item_file"]) && !empty($_FILES["item_file"]["name"])){
        //     $config['upload_path'] = $path;
        //     $foname = $_FILES['item_file']['name'];
        //     $config['allowed_types'] = 'xlsx|xls|csv';
        //     $config['max_size'] = 5000;
        //     $this->load->library('upload', $config);
        //     if($this->upload->do_upload('item_file')){
        //         $filename = $this->upload->data()['file_name'];
        //     }else{ $ierr = $this->upload->display_errors(); } }

        //     if(empty($ierr)){
        //         if($filename){ $flag=false;
        //         $inputFileName = $path.$filename;
        //         try {
        //             $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        //              $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        //              $objPHPExcel = $objReader->load($inputFileName);
        //              $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        //              $pro = array();
        //              $flashData = "";
        //              $ty = true;
        //              $exSn = 0;
        //              foreach ($allDataInSheet as $value) {
        //                 $exSn++;
        //                 if($exSn>1){
        //                 $snNw = $exSn-1;
                      
        //                     if(){
        //                         $excelDataArr = array(
        //                                                 'I_CODE' =>$value['A'],
        //                                                 'I_DESC' =>$value['B'],
        //                                                 'I_SECONDARY_DESC' =>$value['C'],
        //                                                 'I_EXTEND_DESC' =>$value['D'],
                                                      
        //                                             );
        //                         if($value['A']){
        //                             $ty = true;
        //                             if($this->unicon->insertUniversal('ITEMS',$excelDataArr)){
        //                                 $flashData .= "<tr>
        //                                                     <td>$snNw</td>
        //                                                     <td>{$excelDataArr['I_CODE']}</td>
        //                                                     <td>Y</td>
        //                                                 </tr>";
        //                                 // echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"All Booklet Assigned.... :)"));
        //                             }else{
        //                                     echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"Quantity not more then "));
        //                             }
        //                         }else{
        //                             break;
        //                         }
        //                     }else{
        //                         if(!$value['A']){
        //                             break;
        //                         }
        //                         $vendorMsg = $venCodeCheck === 0?'Vendor Code Invalid':'';
        //                         $itemCatMsg = $itemCatCodeCheck === 0?'Item Category Code Invalid':'';
        //                         $flashData .= "<tr>
        //                                             <td>$snNw</td>
        //                                             <td>{$value['A']}</td>
        //                                             <td>
        //                                                 <p>$vendorMsg</p>
        //                                             </td>
        //                                         </tr>";
        //                     }
        //                 }
        //             }
        //                 if($ty){
                            
        //                     $this->session->set_flashdata(['ITEM_BULK_MSG'=>$flashData]);
        //                     echo json_encode(array("multi"=>"false","err"=>"false","msg"=>""));
        //                 }
        //             } catch(Exception $e) {
        //                 die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        //             } 
        //             // $msg = $flag ? "Data Uploded successfully  ": "Something went wrong";
        //         }else{ 
        //             $msg = "Please select excel file."; 
        //             echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
        //         }
        //         }else{
        //             $msg = $ierr;
        //             echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
        //         }
        // }

        public function bulkPoLineUp(){
            $userCon = sessionUserData();
            $path = 'uploads/purchase/'; $filename = $ierr = $inputFileName = null;
            if(isset($_FILES["po_line_file"]) && !empty($_FILES["po_line_file"]["name"])){
            $config['upload_path'] = $path;
            $foname = $_FILES['po_line_file']['name'];
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['max_size'] = 5000;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('po_line_file')){
                $filename = $this->upload->data()['file_name'];
            }else{ $ierr = $this->upload->display_errors(); } }

            if(empty($ierr)){
                if($filename){ $flag=false;
                $inputFileName = $path.$filename;
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                     $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                     $objPHPExcel = $objReader->load($inputFileName);
                     $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                     $pro = array();
                     $flashData = "";
                     $ty = true;
                     $exSn = 0;
                     foreach ($allDataInSheet as $value) {
                        $exSn++;
                        if($exSn>1){
                        $snNw = $exSn-1;
                            $itemDet = itemDetails($value['A'],1,$this->input->post('POH_VENDOR_CODE'));
                            if($itemDet && $value['B']>0){
                                $excelDataArr = array(
                                                        'item_det' =>$itemDet,
                                                        'I_QUANTITY' =>$value['B'],
                                                        'VENDOR_PRICE' =>$value['C'],
                                                    );
                                $pro[] = $excelDataArr;
                                if($value['A']){
                                    $ty = true;
                                    if($ty){
                                        // print_r($pro);
                                        // echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"All Booklet Assigned.... :)"));
                                    }else{
                                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"Quantity not more then "));
                                    }
                                }else{
                                    break;
                                }
                            }else{
                                if(!$value['A']){
                                    break;
                                }
                                
                            }
                        }
                    }
                        if($ty){
                            // print_r($pro);
                            // $this->session->set_flashdata(['ITEM_BULK_MSG'=>$flashData]);
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data_Received","data"=>$pro));
                        }
                    } catch(Exception $e) {
                        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                    } 
                    // $msg = $flag ? "Data Uploded successfully  ": "Something went wrong";
                }else{ 
                    $msg = "Please select excel file."; 
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
                }else{
                    $msg = $ierr;
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
        }

        public function imageUploadDB(){
            $userCon = sessionUserData();
            $uploadDir = 'uploads/images/item/';
            // $id = $this->input->post('image_name');
            if (!empty($_FILES)) {
             $tmpFile = $_FILES['file']['tmp_name'];
             $filename = $uploadDir.'/'.$_FILES['file']['name'];
    
             $data =array(
                            'BIU_NAME'=>$_FILES['file']['name'],
                            'BIU_CRE_BY'=>$userCon->USERNAME,
                            'BIU_CRE_DATE'=>dateTime()
                        );
             $this->unicon->insertUniversal('BULK_IMAGE_UPLOAD',$data);
             move_uploaded_file($tmpFile,$filename);
            }
        }

        public function bulkStockTransLineUp(){
            $userCon = sessionUserData();
            $path = 'uploads/stock_transfer/'; $filename = $ierr = $inputFileName = null;
            if(isset($_FILES["po_line_file"]) && !empty($_FILES["po_line_file"]["name"])){
            $config['upload_path'] = $path;
            $foname = $_FILES['po_line_file']['name'];
            $config['allowed_types'] = 'xlsx';
            $config['max_size'] = 5000;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('po_line_file')){
                $filename = $this->upload->data()['file_name'];
            }else{ $ierr = $this->upload->display_errors(); } }

            if(empty($ierr)){
                if($filename){ $flag=false;
                $inputFileName = $path.$filename;
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                     $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                     $objPHPExcel = $objReader->load($inputFileName);
                     $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                     $pro = array();
                     $flashData = "";
                     $ty = true;
                     $exSn = 0;
                     foreach ($allDataInSheet as $value) {
                        $exSn++;
                        if($exSn>1){
                        $snNw = $exSn-1;
                            $itemDet = itemDetails($value['B']);
                            $transRuleDet = transRule(["where" =>"WHERE TRULE_TRANS_RULE = '{$value['A']}'","dataType" => "row"]);
                            if($itemDet && $value['C']>0 && $transRuleDet){
                            //START
                                
                                $whseCode = $this->input->post('from_whse_db');
                                $stockReasn = $this->input->post('trans_resn_db');
                                $searchType = null;

                                $data = $itemDet;

                                if ($value['D']>0 && $stockReasn == 200) {
                                    $dataInvCostArr = [
                                                "INVCOST_BUS_UNIT" => 111,
                                                "INVCOST_ITEM_CODE" => $data[0]['I_CODE'],
                                                "INVCOST_WHSE_CODE" => '01',
                                                "INVCOST_EFF_START_DATE" =>date('Y-01-01'),
                                                "INVCOST_EFF_END_DATE" => date('Y-12-31'),
                                                "INVCOST_STD_COST" => $value['D'],
                                                "INVCOST_AVG_COST" => $value['D'],
                                                "INVCOST_ACT_COST" => $value['D'],
                                                "INVCOST_CRE_BY" => $userCon->USERNAME,
                                        ];
                                    $this->unicon->insertUniversal('ITEM_COST',$dataInvCostArr);
                                }
                                

                                $temp_list_price = itemUnitCost(["where" => "WHERE INVCOST_ITEM_CODE = '{$data[0]['I_CODE']}' ORDER BY INVCOST_ID DESC", "dataType" => "row"]);
                                
                                if ($temp_list_price) {
                                    $list_price = $temp_list_price->INVCOST_ACT_COST;
                                }else{
                                    $list_price = 0;
                                }
                                
                                if ($stockReasn == 200) {
                                    $stockCon = 'no_limit';
                                }elseif ($stockReasn == 201) {
                                    $stockCon = 'limit';
                                }elseif ($stockReasn == 202) {
                                    $stockCon = 'limit';
                                }elseif ($stockReasn == 204) {
                                    $stockCon = 'no_limit';
                                }
                                $stock_check = array();
                                if ($data) {
                                    if ($searchType == 'sale') {
                                        $whseDets = wherehouseDetail(['where' => "WHERE WHSE_CODE LIKE '$whseCode%'", 'dataType' => 'result']);
                                        foreach ($whseDets as $whseDet) {
                                            $item_P = array(
                                                "dataType" => 'row',
                                                "itemCode" => $data[0]['I_CODE'],
                                                "whseId" => $whseDet->WHSE_CODE,
                                            );
                                            $stockDet = itemStockDet($item_P);
                                            if($stockDet>0){
                                                $stock_check['stock'] = $stockDet;
                                                $stock_check['whse_code'] = $whseDet->WHSE_CODE;
                                                break;
                                            }
                                        }
                                    }else{
                                        $item_P = array(
                                            "dataType" => 'row',
                                            "itemCode" => $data[0]['I_CODE'],
                                            "whseId" => $whseCode,
                                        );
                                        $stockDet = itemStockDet($item_P);
                                    }
                                    
                                    // $list_price = $data[0]['I_LIST_PRICE']>0?$data[0]['I_LIST_PRICE']:$list_price;
                                    $list_price = $data[0]['I_LIST_PRICE']>0?$data[0]['I_LIST_PRICE']:0;
                                }else{
                                    $stockDet = 0;
                                }

                            //END

                                if ($stockCon == 'no_limit') {
                                    $inQty = $value['C'];
                                }else{
                                    $inQty = $stockDet >= $value['C']?$value['C']:$stockDet;
                                }

                                $excelDataArr = array(
                                                        'item_det' => $data,
                                                        'stock_det' => $stockDet,
                                                        'stock_con' => $stockCon,
                                                        "temp_list_price" => $list_price,
                                                        "sale_stock_det" => $stock_check,
                                                        "trans_rule_det" =>$transRuleDet,
                                                        'in_quantity' => $inQty
                                                    );
                                $pro[] = $excelDataArr;
                                if($value['B']){
                                    $ty = true;
                                    if($ty){
                                        // print_r($pro);
                                        // echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"All Booklet Assigned.... :)"));
                                    }else{
                                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"Quantity not more then "));
                                    }
                                }else{
                                    break;
                                }
                            }else{
                                if(!$value['B']){
                                    break;
                                }
                                
                            }
                        }
                    }
                        if($ty){
                            // print_r($pro);
                            // $this->session->set_flashdata(['ITEM_BULK_MSG'=>$flashData]);
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data_Received","data"=>$pro));
                        }
                    } catch(Exception $e) {
                        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                    } 
                    // $msg = $flag ? "Data Uploded successfully  ": "Something went wrong";
                }else{ 
                    $msg = "Please select excel file."; 
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
            }else{
                $msg = $ierr;
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
            }
        }

        public function bulkItemPriceChanger(){
            $userCon = sessionUserData();
            $path = 'uploads/price_changer/'; $filename = $ierr = $inputFileName = null;
            if(isset($_FILES["price_changer_line_file"]) && !empty($_FILES["price_changer_line_file"]["name"])){
            $config['upload_path'] = $path;
            $foname = $_FILES['price_changer_line_file']['name'];
            $config['allowed_types'] = 'xlsx';
            $config['max_size'] = 5000;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('price_changer_line_file')){
                $filename = $this->upload->data()['file_name'];
            }else{ $ierr = $this->upload->display_errors(); } }

            if(empty($ierr)){
                if($filename){ $flag=false;
                $inputFileName = $path.$filename;
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                     $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                     $objPHPExcel = $objReader->load($inputFileName);
                     $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                     $pro = array();
                     $flashData = "";
                     $ty = true;
                     $exSn = 0;
                     foreach ($allDataInSheet as $value) {
                        $exSn++;
                        if($exSn>1){
                        $snNw = $exSn-1;

                            $itemCode = $value['A'];
                            $data = itemPriceDet($itemCode);
                            $itemDet = itemList(array('where'=>"WHERE I_CODE = '$itemCode'",'dataType'=>'row'));
                            if($data){
                                $landCost = freightChargeDets($data->POH_PREFIX.$data->POH_ORDER_ID,'BUYER',"SUM(PODC_PO_CHARGE_AMT) AS TOT_LANDED_COST",'row');
                                $itemDisPer = $data->POD_UNIT_COST/$data->POH_GRAND_TOTAL;
                                $landedCostPerItem = $landCost->TOT_LANDED_COST * $itemDisPer;
                                $ItemPriceWithLandedCost = $landedCostPerItem + ($data->POD_UNIT_COST * $data->POD_EXCH_RATE);
                                $ItemPriceWithLandedCost = $ItemPriceWithLandedCost*$data->I_COST_MULTIPLIER;
                                if ($value['B']>0) {
                                    $ItemPriceWithLandedCost = $value['B'];
                                }
                            }elseif($itemDet){
                                $ItemPriceWithLandedCost = $value['B'];
                            }else{
                                $ItemPriceWithLandedCost = 0;
                            }
                            
                            // echo json_encode(['item_det'=>$data,"unt_price_sar"=>floattwo($ItemPriceWithLandedCost*$data->I_COST_MULTIPLIER)]);

                            
                            
                            if($itemDet){
                            //START
                                
                                $excelDataArr = array(
                                                        'item_det' => $itemDet,
                                                        'unt_price_sar' => $ItemPriceWithLandedCost
                                                    );
                                $pro[] = $excelDataArr;
                                
                                    $ty = true;
                            }
                        }
                    }
                        if($ty){
                            // print_r($pro);
                            // $this->session->set_flashdata(['ITEM_BULK_MSG'=>$flashData]);
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data_Received","data"=>$pro));
                        }
                    } catch(Exception $e) {
                        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                    } 
                    // $msg = $flag ? "Data Uploded successfully  ": "Something went wrong";
                }else{ 
                    $msg = "Please select excel file."; 
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
            }else{
                $msg = $ierr;
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
            }
        }

        public function bulkPhysicalInventoryCount(){
            $userCon = sessionUserData();
            $path = 'uploads/physical_inventory_count/'; $filename = $ierr = $inputFileName = null;
            if(isset($_FILES["physical_inventory_count_line_file"]) && !empty($_FILES["physical_inventory_count_line_file"]["name"])){
            $config['upload_path'] = $path;
            $foname = $_FILES['physical_inventory_count_line_file']['name'];
            $config['allowed_types'] = 'xlsx';
            $config['max_size'] = 5000;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('physical_inventory_count_line_file')){
                $filename = $this->upload->data()['file_name'];
            }else{ $ierr = $this->upload->display_errors(); } }

            if(empty($ierr)){
                if($filename){ $flag=false;
                $inputFileName = $path.$filename;
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                     $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                     $objPHPExcel = $objReader->load($inputFileName);
                     $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                     $pro = array();
                     $flashData = "";
                     $ty = true;
                     $exSn = 0;
                     foreach ($allDataInSheet as $value) {
                        $exSn++;
                        if($exSn>1){
                        $snNw = $exSn-1;

                            $itemCode = $value['A'];
                            $itemDet = itemList(array('where'=>"WHERE I_CODE = '$itemCode'",'dataType'=>'row'));

                            
                            // echo json_encode(['item_det'=>$data,"unt_price_sar"=>floattwo($ItemPriceWithLandedCost*$data->I_COST_MULTIPLIER)]);

                            
                            
                            if($value['B'] > 0){
                            //START
                                
                                $excelDataArr = array(
                                                        'item_det' => $itemDet?$itemDet:$itemCode,
                                                        'item_det_cont' => $itemDet?'Y':'N',
                                                        'item_qty' => $value['B']
                                                    );
                                $pro[] = $excelDataArr;
                                
                                    $ty = true;
                            }
                        }
                    }
                        if($ty){
                            // print_r($pro);
                            // $this->session->set_flashdata(['ITEM_BULK_MSG'=>$flashData]);
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data_Received","data"=>$pro));
                        }
                    } catch(Exception $e) {
                        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                    } 
                    // $msg = $flag ? "Data Uploded successfully  ": "Something went wrong";
                }else{ 
                    $msg = "Please select excel file."; 
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
            }else{
                $msg = $ierr;
                echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
            }
        }

        public function vendorPriceUpload(){
            $userCon = sessionUserData();
            $path = 'uploads/vendor_price/'; $filename = $ierr = $inputFileName = null;
            if(isset($_FILES["item_file"]) && !empty($_FILES["item_file"]["name"])){
            $config['upload_path'] = $path;
            $foname = $_FILES['item_file']['name'];
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['max_size'] = 5000;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('item_file')){
                $filename = $this->upload->data()['file_name'];
            }else{ $ierr = $this->upload->display_errors(); } }

            if(empty($ierr)){
                if($filename){ $flag=false;
                $inputFileName = $path.$filename;
                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                     $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                     $objPHPExcel = $objReader->load($inputFileName);
                     $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                     $pro = array();
                     $flashData = "";
                     $ty = true;
                     $exSn = 0;
                     foreach ($allDataInSheet as $value) {
                        $exSn++;
                        if($exSn>1){
                        $snNw = $exSn-1;
                        $flag=true;
                        $pro_code = false;

                            // $itemCodeCheck = itemDetails($value['A'],null,null."row");
                            $itemCodeCheck = $this->unicon->CoreQuery("SELECT * FROM ITEMS,VENDOR WHERE VEN_CODE = V_CODE AND I_CODE = '{$value['A']}'","row");

                            if ($itemCodeCheck) {
                                $currDet = currencyExchangeByCurrencyCode($itemCodeCheck->V_CURR_CODE);
                            }else{
                                $currDet = null;
                            }

                            if($itemCodeCheck && !empty($value['B']) && $currDet){
                                
                                $vendPriceDet = $this->unicon->CoreQuery("SELECT * FROM VENDOR_COST WHERE VC_ITEM_CODE = '{$itemCodeCheck->I_CODE}' ORDER BY VC_ID DESC","row");

                                $invTransArr = array(
                                                    'VC_BUS_UNIT' =>111,
                                                    'VC_VEN_CODE' =>$itemCodeCheck->VEN_CODE,
                                                    'VC_ITEM_CODE' =>$itemCodeCheck->I_CODE,
                                                    'VC_ITEM_REV' =>0,
                                                    'VC_WHSE' =>'00',
                                                    'VC_VENDOR_ITEM' =>$itemCodeCheck->VEN_I_CODE,
                                                    'VC_DESC1' =>$itemCodeCheck->I_DESC,
                                                    'VC_DESC2' =>$itemCodeCheck->I_EXTEND_DESC,
                                                    'VC_UOM' =>$itemCodeCheck->I_UOM_CODE,
                                                    'VC_VEND_LIST_PRICE' =>$value['B'],
                                                    'VC_CURRENCY_LIST' =>$currDet->EXCHR_CURRENCY,
                                                    'VC_VEND_NON_CON_PRICE' =>$value['B'],
                                                    'VC_CURRENCY_NON_CON' =>$currDet->EXCHR_CURRENCY,
                                                    'VC_EXCHANGE_RATE_NON_CON' =>$currDet->EXCHR_BUY_RATE,
                                                    'VC_LAST_ACT_DATE' =>$vendPriceDet?date("Y-m-d", strtotime($vendPriceDet->VC_CRE_DATE)):date('Y-m-d'),
                                                    'VC_LAST_ACT_PRICE' =>$vendPriceDet?$vendPriceDet->VC_VEND_LIST_PRICE:$value['B'],
                                                    'VC_CURRENCY_LAST_ACT' =>$vendPriceDet?$vendPriceDet->VC_CURRENCY_NON_CON:$currDet->EXCHR_CURRENCY,
                                                    'VC_CRE_BY' =>$userCon->USERNAME,
                                                    'VC_CRE_DATE' =>dateTime(),
                                );
                                $this->unicon->insertUniversal('VENDOR_COST',$invTransArr);
                                $flashData .= "<tr>
                                                    <td>$snNw</td>
                                                    <td>{$itemCodeCheck->I_CODE}</td>
                                                    <td>Y</td>
                                                </tr>";
                            }else{
                                if(!$value['A']){
                                    break;
                                }
                                $itemCodeMsg = $itemCodeCheck?'':'Item Code Invalid';
                                $uomMsg = empty($value['B'])?'Vendor Price Invalid':'';

                                $flashData .= "<tr>
                                                    <td>$snNw</td>
                                                    <td>{$value['A']}</td>
                                                    <td>
                                                        <p>$itemCodeMsg</p>
                                                        <p>$uomMsg</p>
                                                    </td>
                                                </tr>";
                            }
                        }
                    }
                        if($ty){
                            
                            $last_id = $this->unicon->insertUniversal('FLASHDATA_MSG',array('FM_MSG'=>$flashData),1);
                            $this->session->set_flashdata(['ITEM_BULK_MSG'=>$last_id]);
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Uploaded"));
                        }
                    } catch(Exception $e) {
                        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                    } 
                    // $msg = $flag ? "Data Uploded successfully  ": "Something went wrong";
                }else{ 
                    $msg = "Please select excel file."; 
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
                }else{
                    $msg = $ierr;
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$msg));
                }
        }
    }