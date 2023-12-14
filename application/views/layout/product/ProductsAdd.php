
<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Items Info</h4>
                                    <div class="page-title-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        

                       
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card"> 
                                    <div class="card-body border-bottom">
                                            <div class="d-flex align-items-center">
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Product</h5>
                                               
                                            <div class="flex-shrink-0">
                                                <a href="<?=base_Url()?>ProductList" class="btn btn-primary" >View Products List</a>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                            
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="card-body border-bottom" style="margin-bottom: 20px;">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="mb-0 card-title flex-grow-1"><i class="mdi mdi-arrow-right text-primary"></i>Basic Detail</h5>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Items Code</label>
                                                                    <input type="text" class="form-control" name="item_code" value="<?=$itemCode?$itemDet[0]['I_CODE']:null?>" placeholder="Auto generate if empty" <?=$itemCode?'disabled':null?>>
                                                                    <label id="item_code-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Item description</label>
                                                                    <input type="text" class="form-control" name="item_desc" value="<?=$itemCode?$itemDet[0]['I_DESC']:null?>">
                                                                    <label id="item_desc-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Secondary Description</label>
                                                                    <input type="text" class="form-control" name="item_sec_desc" value="<?=$itemCode?$itemDet[0]['I_SECONDARY_DESC']:null?>">
                                                                    <label id="item_sec_desc-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Extended Description</label>
                                                                    <input type="text" class="form-control" name="item_ext_desc" value="<?=$itemCode?$itemDet[0]['I_EXTEND_DESC']:null?>">
                                                                    <label id="item_ext_desc-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-10">
                                                        	<div class="mb-3 row">
                                                        		<label for="validationCustom03" class="form-label">Vendor Item Code, Description & No</label>
                                                        		<div class="col-md-2">
                                                        			<input class="form-control" type="text" name="vendor_item_code" placeholder="vendor item Code" value="<?=$itemCode?$itemDet[0]['VEN_I_CODE']:null?>">
                                                                    <label id="vendor_item_code-error" class="error"></label>
                                                                </div>
                                                        		<div class="col-md-8">
                                                        			<input class="form-control" type="text" name="vendor_item_desc" placeholder="Description" value="<?=$itemCode?$itemDet[0]['VEN_I_DESC']:null?>"> 
                                                                    <label id="vendor_item_desc-error" class="error"></label>
                                                                </div>
                                                        		<div class="col-md-2">
                                                        			<!-- <input class="form-control" type="text" id="example-text-input" placeholder="Vendor No"> -->
                                                                    <select class="form-control select2" onChange="catList(this)" name="item_vendor_Code">
                                                                        <option value='' Selected disabled>Vendor No</option>
                                                                        <?php foreach ($vendorLists as $vendorList):?>
                                                                            <option value="<?=$vendorList['V_CODE']?>" <?php if($itemCode){echo $itemDet[0]['VEN_CODE'] == $vendorList['V_CODE']?'selected':'';}else{echo null;}?>><?=$vendorList['V_CODE']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label id="item_vendor_Code-error" class="error"></label>
                                                                </div>
                                                        	</div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                        	<div class="mb-3 row">
                                                        		<label for="validationCustom03" class="form-label">Revision Date</label>
                                                        		<div class="col-md-10">
                                                        			<input class="form-control" type="date" name="item_rev_date" value="<?=$itemCode?$itemDet[0]['REV_DATE']:date('Y-m-d')?>"> 
                                                                </div>
                                                        	</div>
                                                        </div>
                                                        
                                                        <hr>

                                                        <div class="col-md-7">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="col-md-2 col-form-label">Category</label>
                                                                <div class="col-md-3">
                                                                    <!-- <input class="form-control" type="text"  id="example-text-input"> </div> -->
                                                                        <select class="form-control select2" onChange="catList(this)" name="item_cat_code">
                                                                            <option value='' Selected disabled>Select</option>
                                                                            <?php foreach ($categoryLists as $categoryList):?>
                                                                                <option value="<?=$categoryList['ICAT_CODE']?>" <?php if($itemCode){echo $itemDet[0]['I_CAT_CODE'] == $categoryList['ICAT_CODE']?'selected':'';}else{echo null;}?>><?=$categoryList['ICAT_CODE']?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    <label id="item_cat_code-error" class="error"></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input class="form-control" type="text" value="<?=$itemCode?$itemDet[0]['ICAT_DESC']:null?>" id="cat_desc_in" disabled>
                                                                </div>
                                                            </div>
                                                        </div>                        
                                                        
                                                        <div class="col-md-5">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="col-md-2 col-form-label">UOM</label>
                                                                <div class="col-md-6">
                                                                        <select class="form-control select2" name="item_uon_code">
                                                                            <option value='' Selected disabled>Select</option>
                                                                            <?php foreach ($uomLists as $uomList):?>
                                                                                <option value="<?=$uomList['UOM_CODE']?>" <?php if($itemCode){echo $itemDet[0]['I_UOM_CODE'] == $uomList['UOM_CODE']?'selected':'';}else{echo null;}?>><?=$uomList['UOM_DESC']?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    <label id="item_uon_code-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        
                                                        <hr>
                                                        <div class="col-md-7">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="col-md-2 col-form-label">Class</label>
                                                                <div class="col-md-3">
                                                                    <!-- <input class="form-control" type="text"  id="example-text-input">  -->
                                                                    <select class="form-control select2 class-list" onChange="classLists(this)" name="item_class_code">
                                                                            <option value='' Selected disabled>Select category first</option>
                                                                        <?php if($itemCode){ foreach ($itemClassDet as $itemClassDetGet): ?>
                                                                            <option value="<?=$itemClassDetGet->IC_CODE?>" <?php if($itemCode){echo $itemDet[0]['I_CLASS_CODE'] == $itemClassDetGet->IC_CODE?'selected':'';}else{echo null;}?>><?=$itemClassDetGet->IC_CODE?></option>
                                                                        <?php endforeach; } ?>
                                                                    </select>
                                                                    <label id="item_class_code-error" class="error"></label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <input class="form-control" type="text" value="<?=$itemCode?$itemDet[0]['IC_DESC']:null?>" id="class_desc_in" disabled> 
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-5">
                                                        <div class="mb-3 row">
                                                        	<label for="example-text-input" class="col-md-2 col-form-label">Type</label>
                                                        	<div class="col-md-6">
                                                        		<select class="form-select" name="item_type">
                                                        		    <option value="DRAWING">Drawing</option>
                                                        			<option value="MANUFACTURED_ITEM">Manufactured Item</option>
                                                        			<option value="MASTER_SCHEDULE_ITEM">Master Schedule Item</option>
                                                        			<option value="PLANING_ITEM">Planing Item</option>
                                                        			<option value="PURCHASE_ITEM" selected>Purchase Item</option>
                                                        			<option value="TOOLING_ITEM">Tooling Item</option>
                                                        		</select>
                                                        	</div>
                                                        </div>	
                                                        </div>
                                                        
                                                        <hr>
                                                       <div class="col-md-7">
                                                        <div class="mb-3 row">
                                                        	<label for="example-text-input" class="col-md-2 col-form-label">Country of Origin</label>
                                                        	<div class="col-md-3">
                                                        		<!-- <input class="form-control" type="text"  id="example-text-input">  -->
                                                                <select class="form-control select2" onChange="cntryList(this)" name="item_cntry_code">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($countryLists as $countryList):?>
                                                                            <option value="<?=$countryList['CNTRY_CODE']?>" <?php if($itemCode){echo $itemDet[0]['I_CNTRY_CODE'] == $countryList['CNTRY_CODE']?'selected':'';}else{echo null;}?>><?=$countryList['CNTRY_CODE']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="item_cntry_code-error" class="error"></label>
                                                            </div>
                                                        	<div class="col-md-6">
                                                        		<input class="form-control" type="text" value="<?=$itemCode?$itemDet[0]['CNTRY_NAME']:null?>" id="cntry_desc_in" disabled> 
                                                            </div>
                                                        </div>
                                                        </div>
                                                
                                                        <div class="col-md-5">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="col-md-2 col-form-label">Status</label>
                                                                <div class="col-md-6">
                                                                            <select class="form-select" name="item_status">
                                                                        <option value="Y" <?php if($itemCode){echo $itemDet[0]['I_STATUS'] == 'Y'?'selected':'';}else{echo null;}?>>Active</option>
                                                                        <option value="N" <?php if($itemCode){echo $itemDet[0]['I_STATUS'] == 'N'?'selected':'';}else{echo null;}?>>Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>	
                                                        </div>
                                        
                                                        <div class="card-body border-bottom" style="margin-bottom: 20px;">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="mb-0 card-title flex-grow-1"><i class="mdi mdi-arrow-right text-primary"></i>Items Attributes</h5>
                                                            </div>
                                                        </div> 
                                                        
                                                       <!--<h5 class="font-size-14"><i class="mdi mdi-arrow-right text-primary"></i> Address</h5>-->
                                                        
                                                       <div class="col-md-8 row" style="border-right: black 5px solid;">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Clearity</label>
                                                                    <input type="text" class="form-control" name="item_clearity" value="<?=$itemCode?$itemDet[0]['I_CLEARITY']:null?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Style</label>
                                                                    <input type="text" class="form-control" name="item_style" placeholder="Enter Address" value="<?=$itemCode?$itemDet[0]['I_STYLE']:null?>">
                                                                    <!-- <label id="city_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Length</label>
                                                                    <input type="text" class="form-control" name="item_length" value="<?=$itemCode?$itemDet[0]['I_LENGTH']:null?>">
                                                                    <!-- <label id="state_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Width</label>
                                                                    <input type="text" class="form-control" name="item_width" value="<?=$itemCode?$itemDet[0]['I_WIDTH']:null?>">
                                                                    <!-- <label id="state_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Color</label>
                                                                <input type="email" class="form-control" name="item_clr_color" value="<?=$itemCode?$itemDet[0]['I_CLR_COLOR']:null?>">
                                                                <!-- <label id="V_POSTAL_CODE_ID-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Color</label>
                                                                <input type="email" class="form-control" name="item_sty_color" value="<?=$itemCode?$itemDet[0]['I_STY_COLOR']:null?>">
                                                                <!-- <label id="FULL_ADDRESS-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Image Printable</label>
                                                                <input type="checkbox" name="I_PRINTABLE" id="I_PRINTABLE" switch="bool" value='Y' <?php if($itemCode){ echo $itemDet[0]['I_PRINTABLE'] == 'Y'?'Checked':null;}else{ echo 'Checked';}?>/>
                                                                <label for="I_PRINTABLE" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>        
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Global Attributes</label>
                                                                    <input type="text" class="form-control" name="item_global_att" value="<?=$itemCode?$itemDet[0]['I_CLR_GLOBAL_ATTRIBUTE']:null?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Size</label>
                                                                    <input type="text" class="form-control" name="item_size" value="<?=$itemCode?$itemDet[0]['I_STY_SIZE']:null?>">
                                                                    <!-- <label id="city_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Height</label>
                                                                    <input type="text" class="form-control" name="item_height" value="<?=$itemCode?$itemDet[0]['I_HEIGHT']:null?>">
                                                                    <!-- <label id="state_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Weight</label>
                                                                    <input type="text" class="form-control" name="item_weight" value="<?=$itemCode?$itemDet[0]['I_WEIGHT']:null?>">
                                                                    <!-- <label id="state_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-3 row">
                                                            <!-- <label for="example-text-input" class="col-md-2 col-form-label">Email Alart</label>
                                                            <div class="col-md-2">
                                                                <input class="form-control" type="text" id="example-text-input"> 
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input class="form-control" type="text" id="example-text-input"> 
                                                            </div> -->
                                                        </div>
                                                        
                                                        </div>
                                                        <div class="col-md-4 row" style="padding-left: 25px;">
                                                            
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Cost Multiplier</label>
                                                                    <input type="text" class="form-control" name="item_cost_mult" value="<?=$itemCode?$itemDet[0]['I_COST_MULTIPLIER']:null?>">
                                                                    <label id="item_cost_mult-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="item_Flammable" value = 'Y' id="item_Flammable" <?php if($itemCode){echo $itemDet[0]['I_FLAMMABLE'] == 'Y'?'checked':'';}else{echo 'checked';}?>>
                                                            <label class="form-check-label" for="item_Flammable">Taxable</label>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Max Discount%</label>
                                                                    <input type="text" class="form-control" name="item_max_discount" value="<?=$itemCode?$itemDet[0]['I_MAX_DISCOUNT']:null?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="item_freezable" value='Y' id="item_freezable" <?php if($itemCode){echo $itemDet[0]['I_FREEZABLE'] == 'Y'?'checked':'';}else{echo 'checked';}?>>
                                                            <label class="form-check-label" for="item_freezable">Discount</label>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-8">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label" style="font-size: xx-large;">KSA Price</label>
                                                                    <input type="text" class="form-control" value="<?=$itemCode?$itemDet[0]['I_LIST_PRICE']:'0'?>" disabled="true" >
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="item_stocked" id="formCheck1" checked>
                                                            <label class="form-check-label" for="formCheck1">Stocked</label>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        </div>
                                                        
                                                        <div class="col-md-3">

                                                            <div class="position-relative form-group">

                                                            <label for="proimg" class="">Product Image</label>

                                                            <input type="file" id="proimg" name="proimg" class="proup form-control" >

                                                            <label id="proimg-error" class="error"></label>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-3"><img width="120px" src="#" id="blah" alt=""></div>

                                        
                                                        
                                                        
                                                        
                                                        
                                        
                                                        
                                                    </div>
                                                <div>
                                                    <!-- <button data-control="item/item-add-db" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->prodAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->prodAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Items</button> -->
                                                    <button data-aftreload="true" data-control="item/item-add-db" data-form="formdata" data-sweetalert="<?=$itemCode?$sweetAlertMsg->prodUp->msg:$sweetAlertMsg->prodAdd->msg?>" data-sweetalertcontrol="<?=$itemCode?$sweetAlertMsg->prodUp->cont:$sweetAlertMsg->prodAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$itemCode?'Update Item':'Add item'?></button>
                                               
                                                </div>
                                                <input type="hidden" name="item_code_db" value="<?=$itemCode?$itemCode:null?>">
                                                <span id="outmsg"></span>
                                            
                                        </div>
                                        </form>
                                    </div>
                                    <!-- end card -->
                                </div> 
                             </div>
                        </div>
                
                
                
                <!-- End Page-content -->
                
                    </div>
                </div>
                    
                <!-- Modal -->
                <div class="modal fade" id="jobDelete" tabindex="-1" aria-labelledby="jobDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                            <div class="modal-body px-4 py-5 text-center">
                                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div class="avatar-sm mb-4 mx-auto">
                                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                                        <i class="mdi mdi-trash-can-outline"></i>
                                    </div>
                                </div>
                                <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently erase the job.</p>
                                
                                <div class="hstack gap-2 justify-content-center mb-0">
                                    <button type="button" class="btn btn-danger">Delete Now</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- end main content-->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
   
    function classLists(ele) {
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getClassDescbyCode')?>",
            data: {class_code:ele.value},
            dataType: "Json",
            success: function(resultData){
                if(resultData.length>0){
                    $('#class_desc_in').val(resultData[0]['IC_DESC']);
                }else{
                    $('#class_desc_in').val('');
                }
            }
        });
    }

    function catList(ele) {
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getCatDescbyCode')?>",
            data: {cat_code:ele.value},
            dataType: "Json",
            success: function(resultData){
                if(resultData.length>0){
                    $('#cat_desc_in').val(resultData[0]['ICAT_DESC']);
                }else{
                    $('#cat_desc_in').val('');
                }
            }
        });
        $('#class_desc_in').val('');
        $('.class-list').empty();
        $('.class-list').append(`<option value='' Selected disabled>Select</option>`);
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getClassListByCategoryCode')?>",
            data: {cat_code:ele.value},
            dataType: "Json",
            success: function(resultData){
                for (let index = 0; index < resultData.length; index++) {
                    // let cty_name = resultData[index]['CTY_NAME'];
                    let class_code = resultData[index]['IC_CODE'];
                    $('.class-list').append(`<option value='`+class_code+`'>`+class_code+`</option>`);
               }
            }
        });
    }

    function cntryList(ele) {
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getCntryDescbyCode')?>",
            data: {cntry_code:ele.value},
            dataType: "Json",
            success: function(resultData){
                if(resultData.length>0){
                    $('#cntry_desc_in').val(resultData[0]['CNTRY_NAME']);
                }else{
                    $('#cntry_desc_in').val('');
                }
            }
        });
    }

</script>
        