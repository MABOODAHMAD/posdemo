<?php
     class Item extends CI_Controller{
         public function __construct(){
            parent::__construct();
      
            // $this->load->model('Site_model', 'dbcon');
            // $this->load->model('Universal_model','unicon');
            // $this->load->library('form_validation');
            // $this->load->helper('form');
            //$this->load->model('QrController','qrcon');
         }

         public function itemAdddb(){

            $userCon = sessionUserData();
            header('Content-Type: application/json');

            $itemCode = $this->input->post('item_code');
            $itemCodeUp = $this->input->post('item_code_db');

            if($itemCode && !$itemCodeUp){
                $this->form_validation->set_rules('item_code', 'unique code', 'unique_code_db[ITEMS.I_CODE.item Code already used, Please choose a different one]');
            }
            $this->form_validation->set_rules('item_desc', 'item description', 'required');
            $this->form_validation->set_rules('item_sec_desc', 'item secondary description', 'required');
            $this->form_validation->set_rules('item_ext_desc', 'item extended decription', 'required');
            $this->form_validation->set_rules('vendor_item_code', 'vendor item code', 'required');
            $this->form_validation->set_rules('vendor_item_desc', 'vendor item description', 'required');
            $this->form_validation->set_rules('item_vendor_Code', 'vendor code', 'required');
            $this->form_validation->set_rules('item_class_code', 'item class code', 'required');
            $this->form_validation->set_rules('item_uon_code', 'item uom code', 'required');
            $this->form_validation->set_rules('item_cat_code', 'item category code', 'required');
            $this->form_validation->set_rules('item_cntry_code', 'country code', 'required');
            $this->form_validation->set_rules('item_cost_mult', 'cost multiplier', 'required|numeric');
            
            if($this->form_validation->run() === FALSE){
                $omsg = $this->form_validation->error_array();
                echo json_encode(array("multi"=>"true","err"=>"true","msg"=>$omsg));
            }else{
                $itemPrintAble = $this->input->post('I_PRINTABLE');
                $taxable = $this->input->post('item_Flammable');
                $discountable = $this->input->post('item_freezable');
                $ishok = $this->input->post('item_stocked');

                $filename = 'noimage.png'; $ierr = '';
				if(isset($_FILES["proimg"]) && !empty($_FILES["proimg"]["name"])){
				$config['upload_path'] = 'uploads/images/item/';
				$foname = $_FILES['proimg']['name'];
				$config['file_name'] = createimgname($foname);
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['max_size'] = 5000;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('proimg')){
					$filename = $this->upload->data()['file_name'];
				    $this->unicon->resizeimg($config['upload_path'],$filename,"95",'800','800');

                    $data = [
                                // "I_CODE"=>empty($itemCode)?insertUniqueCode('I_CODE'):$itemCode,
                                "I_DESC"=>$this->input->post('item_desc'),
                                "I_IMAGE_FILENAME"=>$filename,
                                "I_SECONDARY_DESC"=>$this->input->post('item_sec_desc'),
                                "I_EXTEND_DESC"=>$this->input->post('item_ext_desc'),
                                "VEN_I_CODE"=>$this->input->post('vendor_item_code'),
                                "VEN_I_DESC"=>$this->input->post('vendor_item_desc'),
                                "VEN_CODE"=>$this->input->post('item_vendor_Code'),
                                "I_CLASS_CODE"=>$this->input->post('item_class_code'),
                                "I_UOM_CODE"=>$this->input->post('item_uon_code'),
                                "I_CAT_CODE"=>$this->input->post('item_cat_code'),
                                "I_CNTRY_CODE"=>$this->input->post('item_cntry_code'),
                                "I_TYPE"=>$this->input->post('item_type'),
                                "I_STATUS"=>$this->input->post('item_status'),
                                "REV_DATE"=>empty($this->input->post('item_rev_date'))?NULL:$this->input->post('item_rev_date'),
                                "I_CLEARITY"=>empty($this->input->post('item_clearity'))?NULL:$this->input->post('item_clearity'),
                                "I_STYLE"=>empty($this->input->post('item_style'))?NULL:$this->input->post('item_style'),
                                "I_LENGTH"=>empty($this->input->post('item_length'))?NULL:$this->input->post('item_length'),
                                "I_WIDTH"=>empty($this->input->post('item_width'))?NULL:$this->input->post('item_width'),
                                "I_CLR_COLOR"=>empty($this->input->post('item_clr_color'))?NULL:$this->input->post('item_clr_color'),
                                "I_STY_COLOR"=>empty($this->input->post('item_sty_color'))?NULL:$this->input->post('item_sty_color'),
                                "I_CLR_GLOBAL_ATTRIBUTE"=>empty($this->input->post('item_global_att'))?NULL:$this->input->post('item_global_att'),
                                "I_STY_SIZE"=>empty($this->input->post('item_size'))?NULL:$this->input->post('item_size'),
                                "I_HEIGHT"=>empty($this->input->post('item_height'))?NULL:$this->input->post('item_height'),
                                "I_WEIGHT"=>empty($this->input->post('item_weight'))?NULL:$this->input->post('item_weight'),
                                "I_COST_MULTIPLIER"=>empty($this->input->post('item_cost_mult'))?NULL:$this->input->post('item_cost_mult'),
                                "I_MAX_DISCOUNT"=>empty($this->input->post('item_max_discount'))?NULL:$this->input->post('item_max_discount'),
                                "I_PRICE"=>empty($this->input->post('item_price'))?0:$this->input->post('item_price'),
                                "I_PRINTABLE"=>isset($itemPrintAble)?$itemPrintAble:'N',
                                "I_FLAMMABLE"=>isset($taxable)?$taxable:'N',
                                "I_FREEZABLE"=>isset($discountable)?'Y':'N',
                                "I_SHOCKED"=>isset($ishok)?'Y':'N',
                                // "I_PRICE"=>empty($this->input->post('item_price'))?0:$this->input->post('item_price'),
                                // "I_PRICE"=>empty($this->input->post('item_price'))?0:$this->input->post('item_price'),
                                "I_CRE_BY"=>$userCon->USERNAME,
                                // "C1"=>$this->encryption->encrypt(empty($itemCode)?insertUniqueCode('I_CODE'):$itemCode),
                            ];
                        
                        if($itemCodeUp){
                                if($this->unicon->updateArrayUniversal('ITEMS',$data,"I_CODE = '$itemCodeUp'")>0){
                                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                                }else{
                                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data Updated"));
                                }
                        }else{
                                $data["I_CODE"] = empty($itemCode)?insertUniqueCode('I_CODE'):$itemCode;
                                $itemCodeEncrpt = dataEncypt($data['I_CODE'],'encrypt');
                                $itemCodeBak = dataEncyptManual($data['I_CODE'],'encrypt');
                                if($this->unicon->insertUniversal('ITEMS',$data)){
                                    // $this->session->set_userdata(['item_code'=>$this->encryption->encrypt($data['I_CODE'])]);
                                    $urlCred = base_url('addItemTrait').'?item_code='.$itemCodeEncrpt.'&item_code_bak='.$itemCodeBak;
                                    // $urlCred = base_url('addItemTrait');
                                    $urlRed = "<script>window.location.replace('$urlCred');</script>";
                                    
                                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully".$urlRed));
                            
                                }else{
        
                                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));
        
                                }
                        }

				}else{ $ierr = $this->upload->display_errors(); 
                    
                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>$ierr.'Note : jpg|png|jpeg Only these extension Allowed'));
                
                } 

                }else{
                    if($itemCodeUp){
                        $data = [
                            // "I_CODE"=>empty($itemCode)?insertUniqueCode('I_CODE'):$itemCode,
                            "I_DESC"=>$this->input->post('item_desc'),
                            // "I_IMAGE_FILENAME"=>$filename,
                            "I_SECONDARY_DESC"=>$this->input->post('item_sec_desc'),
                            "I_EXTEND_DESC"=>$this->input->post('item_ext_desc'),
                            "VEN_I_CODE"=>$this->input->post('vendor_item_code'),
                            "VEN_I_DESC"=>$this->input->post('vendor_item_desc'),
                            "VEN_CODE"=>$this->input->post('item_vendor_Code'),
                            "I_CLASS_CODE"=>$this->input->post('item_class_code'),
                            "I_UOM_CODE"=>$this->input->post('item_uon_code'),
                            "I_CAT_CODE"=>$this->input->post('item_cat_code'),
                            "I_CNTRY_CODE"=>$this->input->post('item_cntry_code'),
                            "I_TYPE"=>$this->input->post('item_type'),
                            "I_STATUS"=>$this->input->post('item_status'),
                            "REV_DATE"=>empty($this->input->post('item_rev_date'))?NULL:$this->input->post('item_rev_date'),
                            "I_CLEARITY"=>empty($this->input->post('item_clearity'))?NULL:$this->input->post('item_clearity'),
                            "I_STYLE"=>empty($this->input->post('item_style'))?NULL:$this->input->post('item_style'),
                            "I_LENGTH"=>empty($this->input->post('item_length'))?NULL:$this->input->post('item_length'),
                            "I_WIDTH"=>empty($this->input->post('item_width'))?NULL:$this->input->post('item_width'),
                            "I_CLR_COLOR"=>empty($this->input->post('item_clr_color'))?NULL:$this->input->post('item_clr_color'),
                            "I_STY_COLOR"=>empty($this->input->post('item_sty_color'))?NULL:$this->input->post('item_sty_color'),
                            "I_CLR_GLOBAL_ATTRIBUTE"=>empty($this->input->post('item_global_att'))?NULL:$this->input->post('item_global_att'),
                            "I_STY_SIZE"=>empty($this->input->post('item_size'))?NULL:$this->input->post('item_size'),
                            "I_HEIGHT"=>empty($this->input->post('item_height'))?NULL:$this->input->post('item_height'),
                            "I_WEIGHT"=>empty($this->input->post('item_weight'))?NULL:$this->input->post('item_weight'),
                            "I_COST_MULTIPLIER"=>empty($this->input->post('item_cost_mult'))?NULL:$this->input->post('item_cost_mult'),
                            "I_MAX_DISCOUNT"=>empty($this->input->post('item_max_discount'))?NULL:$this->input->post('item_max_discount'),
                            "I_PRICE"=>empty($this->input->post('item_price'))?0:$this->input->post('item_price'),
                            "I_PRINTABLE"=>isset($itemPrintAble)?$itemPrintAble:'N',
                            "I_FLAMMABLE"=>isset($taxable)?$taxable:'N',
                            "I_FREEZABLE"=>isset($discountable)?'Y':'N',
                            "I_SHOCKED"=>isset($ishok)?'Y':'N',
                            // "I_PRICE"=>empty($this->input->post('item_price'))?0:$this->input->post('item_price'),
                            // "I_PRICE"=>empty($this->input->post('item_price'))?0:$this->input->post('item_price'),
                            "I_CRE_BY"=>$userCon->USERNAME,
                            // "C1"=>$this->encryption->encrypt(empty($itemCode)?insertUniqueCode('I_CODE'):$itemCode),
                        ];
                        
                        if($this->unicon->updateArrayUniversal('ITEMS',$data,"I_CODE = '$itemCodeUp'")>0){
                            echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully"));
                        }else{
                            echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"No data Updated"));
                        }
                    }else{
                        echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"choose item Image"));
                        
                    }
                }
  
            }
        }

        public function itemTraitAdddb(){
            $userCon = sessionUserData();
            header('Content-Type: application/json');

                $traitCode = $this->input->post('trait_code_db');
                $weight = $this->input->post('weight');
                $itemCode = $this->input->post('item_Code_p');
                $itemCatCode = $this->input->post('trait_cat_code_db');
                $itemTraitMainId = $this->input->post('item_trait_main_id_db');
                $this->unicon->CoreQuery("UPDATE ITEM_TRAITS SET TRT_STATUS='0' WHERE ITM_CODE='$itemCode'");
                if(count($weight)>0){
                    $sn = 0;
                    for ($i=0; $i <count($traitCode) ; $i++) {
                        $data = [
                            "TRT_WEIGHT"=>$weight[$i],
                            "ITM_TRAIT_CODE"=>$traitCode[$i],
                            "ITM_TRAIT_CAT_CODE"=>$itemCatCode[$i],
                            "ITM_TRT_CRE_BY"=>$userCon->USERNAME,
                            "ITM_CODE"=>$itemCode,
                            "TRT_STATUS"=>'1',
                        ];
                        if($weight[$i]>0){
                            if(!empty($itemTraitMainId[$i])){
                                $updateWhere = "ID = '{$itemTraitMainId[$i]}'";
                                $this->unicon->updateArrayUniversal('ITEM_TRAITS',$data,$updateWhere);
                            }else{
                                $this->unicon->insertUniversal('ITEM_TRAITS',$data);
                            }
                            

                            $sn++;
                        }
                    }
                    $this->unicon->CoreQuery("DELETE FROM ITEM_TRAITS WHERE TRT_STATUS='0' AND ITM_CODE='$itemCode'");
                    echo json_encode(array("multi"=>"false","err"=>"false","msg"=>"Data Inserted Successfully No of Trait Add ".$sn));
                }else{

                    echo json_encode(array("multi"=>"false","err"=>"true","msg"=>"something went wrong"));

                }
            }


            public function itemTraitListJson(){
                $itemCode = $this->input->post('item_code');

                $filterdata = array(
                    "column_order" => array(NULL,'TC_DESC','TRAIT_DESC','TRT_WEIGHT',NULL),
                    "column_search" => array('TC_DESC','TRAIT_DESC','TRT_WEIGHT'),
                    "order" => array('ID' => 'DESC')
                );
    
                $sqlQueryTemp = array(
    
                    "SELECT"=>'*',
                    "FROM"=>'ITEM_TRAITS',
    
                    "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "JOIN_1_TABLE_NAME"=>'TRAIT_CATEGORY',
                        "JOIN_1_TABLE_CONN"=>'TRAIT_CATEGORY.TC_CODE=ITEM_TRAITS.ITM_TRAIT_CAT_CODE',
    
                    "JOIN_2_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "JOIN_2_TABLE_NAME"=>'TRAIT_SUB_CATEGORY',
                        "JOIN_2_TABLE_CONN"=>'TRAIT_SUB_CATEGORY.TRAIT_CAT_ID=ITEM_TRAITS.ITM_TRAIT_CAT_CODE AND TRAIT_SUB_CATEGORY.TRAIT_SUB_CAT_CODE=ITEM_TRAITS.ITM_TRAIT_CODE',
                    
                    "WHERE_1_CONTROL"=>TRUE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "WHERE_1_COL_NAME"=>'ITEM_TRAITS.ITM_CODE',
                        "WHERE_1_DATA"=>$itemCode,
                );
                
                
                $sqlQuery = datatableSqlData($sqlQueryTemp);
    
                $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
    
            
                $data = array();
                $no = $this->input->post('start');
                foreach ($memData as $rowdata) {
                    $no++; $row = array();
                    $row[] = $no.".";

                    $row[] = $rowdata->TC_CODE.'/'.$rowdata->ITM_TRAIT_CAT_CODE.'/'.$rowdata->TC_DESC;
                    $row[] = $rowdata->TRAIT_SUB_CAT_CODE.'/'.$rowdata->ITM_TRAIT_CODE.'/'.$rowdata->TRAIT_DESC;
                    $row[] = $rowdata->TRT_WEIGHT;
                    $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                                <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                    <a href='#' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                                </li>
                            </ul>";
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

            public function itemListJson(){
                $userCon = sessionUserData();
                // $itemCode = $this->input->post('item_code');

                $filterdata = array(
                    "column_order" => array(NULL,'I_CODE','I_DESC','VEN_CODE','I_CNTRY_CODE','I_CAT_CODE',NULL),
                    "column_search" => array('I_CODE','I_DESC','VEN_CODE','I_SECONDARY_DESC','I_CNTRY_CODE','I_CAT_CODE','UOM_DESC','IC_DESC','ICAT_DESC'),
                    "order" => array('I_CRE_DATE' => 'DESC')
                );
    
                $sqlQueryTemp = array(
    
                    "SELECT"=>'*',
                    "FROM"=>'ITEMS',
    
                    "JOIN_1_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "JOIN_1_TABLE_NAME"=>'ITEM_CATEGORY',
                        "JOIN_1_TABLE_CONN"=>'ITEM_CATEGORY.ICAT_CODE=ITEMS.I_CAT_CODE',
    
                    "JOIN_2_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "JOIN_2_TABLE_NAME"=>'ITEM_CLASSES',
                        "JOIN_2_TABLE_CONN"=>'ITEM_CLASSES.IC_CODE=ITEMS.I_CLASS_CODE AND ITEM_CLASSES.IC_ITEM_CAT = ITEMS.I_CAT_CODE',

                    "JOIN_3_CONTROL"=>TRUE,  // TABLE JOINING CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "JOIN_3_TABLE_NAME"=>'UNIT_OF_MEASUREMENT',
                        "JOIN_3_TABLE_CONN"=>'UNIT_OF_MEASUREMENT.UOM_CODE=ITEMS.I_UOM_CODE',
                    
                    "WHERE_1_CONTROL"=>FALSE,  // TABLE WHERE CLOUSE CONTROL TRUE ENABLE AND FALSE DISABLE DEFAULT VALUE FALSE
                        "WHERE_1_COL_NAME"=>'ITEM_TRAITS.ITM_CODE',
                        "WHERE_1_DATA"=>'',
                );
                
  
                
                
                $sqlQuery = datatableSqlData($sqlQueryTemp);
    
                $memData = $this->datatableCon->getRows($_POST,$sqlQuery,$filterdata);
    
                $data = array();
                $no = $this->input->post('start');
                foreach ($memData as $rowdata) {
                    $no++; $row = array();
                    $itemCodeEncrpt = dataEncypt($rowdata->I_CODE,'encrypt');
                    $itemCodeBak = dataEncyptManual($rowdata->I_CODE, 'encrypt');
                    $iteCode64 = dataEncyptbase64($rowdata->I_CODE,'encrypt');
                    $row[] = $no.".";

                    $row[] = "<a href='".base_url('ProductDetail?item_code=').$itemCodeEncrpt.'&item_code_bak='.$itemCodeBak."' class=text-body fw-bold>$rowdata->I_CODE</a>";
                    $row[] = $rowdata->I_DESC;
                    if(dashRole(["role_check"=>"PRODUCT_PRODUCT_VIEW_VENDOR_CODE_AND_DESC"])){
                    $row[] = $rowdata->VEN_CODE;
                    }
                    $row[] = $rowdata->I_SECONDARY_DESC;
                    $row[] = "{$rowdata->ICAT_DESC}</br>{$rowdata->IC_DESC}</br>{$rowdata->UOM_DESC}";
                    if(dashRole(["role_check"=>"PRODUCT_TRAIT_VIEW_AND_UPDATE"])){
                        $row[] = "<a href='".base_url('addItemTrait?item_code=').$itemCodeEncrpt.'&type=view&item_code_bak='.$itemCodeBak."'> <button type='button' class='btn btn-primary btn-sm btn-rounded'>
                                    View Details
                                </button></a>";
                    }
                    
                    if(dashRole(["role_check"=>"PRODUCT_VIEW_UNIT_COST"])){
                        $row[] = "<button  data-itemcode='{$rowdata->I_CODE}' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='#standard_model' onClick='viewUnitDet(this)'>View Uniit Cost</button>";
                    }

                    if(dashRole(["role_check"=>"PRODUCT_VIEW_VENDOR_COST"])){
                        $row[] = "<button  data-itemcode='{$rowdata->I_CODE}' class='btn btn-primary btn-sm btn-rounded' data-bs-toggle='modal' data-bs-target='#standard_model' onClick='viewVendorDet(this)'>View Vendor Cost</button>";
                    }

                    if(dashRole(["role_check"=>"PRODUCT_PRODUCT_EDIT"])){
                        $row[] = "<ul class='list-unstyled hstack gap-1 mb-0'>
                                    <li data-bs-toggle='tooltip' data-bs-placement='top' title='Edit'>
                                        <a href='".base_url('ProductAdd?tokenid=').$iteCode64."' class='btn btn-sm btn-soft-info'><i class='mdi mdi-pencil-outline'></i></a>
                                    </li>
                                </ul>";
                    }
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