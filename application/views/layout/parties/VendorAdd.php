
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
                                    <h4 class="mb-sm-0 font-size-18">VENDOR CREATE</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Vendor</h5>
                                               
                                            <div class="flex-shrink-0">
                                                <a href="<?=base_Url()?>VendorList" class="btn btn-primary" >View Vendor List</a>
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
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Code</label>
                                                                    <input type="text" class="form-control" name="V_CODE" value="<?=$vendorCode?$venDet->V_CODE:null?>" placeholder="Enter Vendor Code" <?=$vendorCode?'disabled':null?>>
                                                                    <label id="V_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Vendr Name</label>
                                                                    <input type="text" class="form-control" name="V_NAME" value="<?=$vendorCode?$venDet->V_NAME:null?>" placeholder="Enter Vendr Name ">
                                                                    <label id="V_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Vendr Name in Arabic</label>
                                                                    <input type="text" class="form-control" name="V_NAME_AR" value="<?=$vendorCode?$venDet->V_NAME_AR:null?>" placeholder="Enter Vendr Name in Arabic">
                                                                    <label id="V_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Contact No</label>
                                                                    <input type="text" class="form-control" name="V_CONTACT" value="<?=$vendorCode?$venDet->V_CONTACT:null?>" placeholder="Enter Vendr Name in Arabic">
                                                                    <label id="V_CONTACT-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Email I'd</label>
                                                                    <input type="text" class="form-control" name="V_EMAIL" value="<?=$vendorCode?$venDet->V_EMAIL:null?>" placeholder="Enter Vendr Name in Arabic">
                                                                    <label id="V_EMAIL-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Unit no</label>
                                                                    <input type="text" class="form-control" name="UNIT_NO" value="<?=$vendorCode?$venDet->UNIT_NO:null?>" placeholder="Enter Vendr Name in Arabic">
                                                                    <label id="UNIT_NO-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Vat no</label>
                                                                    <input type="text" class="form-control" name="VAT_NO" value="<?=$vendorCode?$venDet->VAT_NO:null?>" placeholder="Enter Vendr Name in Arabic">
                                                                    <label id="VAT_NO-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose Currency</label>
                                                                    <select class="form-control select2" name="currcy_id">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($currencyLists as $currencyList):?>
                                                                                <option value="<?=$currencyList['CUR_CODE']?>" <?php if($vendorCode){ echo $venDet->V_CURR_CODE == $currencyList['CUR_CODE']?'selected':null; }?>><?=$currencyList['CUR_CODE'].'-'.$currencyList['CUR_NAME']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="currcy_id-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Supplier Type</label>
                                                                <select class="form-control select2" name="currcy_id">
                                                                        <option>Supplier Type</option>
                                                                            <option value="AK">Alaska</option>
                                                                            <option value="HI">Hawaii</option>
                                                                    </select>
                                                                <label id="currcy_id-error" class="error"></label>
                                                            </div>
                                                        </div> -->
                                                        
                                                        
                                                        <div class="card-body border-bottom" style="margin-bottom: 20px;">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="mb-0 card-title flex-grow-1"><i class="mdi mdi-arrow-right text-primary"></i>Address</h5>
                                                            </div>
                                                        </div> 
                                                        
                                                       <!--<h5 class="font-size-14"><i class="mdi mdi-arrow-right text-primary"></i> Address</h5>-->
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Select Country</label>
                                                                    <select class="form-control select2" name="country_name" onChange='countryCh(this)'>
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($countryLists as $countryList):?>
                                                                                <option value="<?=$countryList['CNTRY_CODE']?>" <?php if($vendorCode){ echo $venDet->CNTRY_CODE == $countryList['CNTRY_CODE']?'selected':null; }?>><?=$countryList['CNTRY_NAME']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="country_name-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Select State</label>
                                                                    <select class="form-control select2 stateData" onChange="stateCh(this)" name="state_name">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php if($vendorCode){ foreach ($stateDet as $stateDetGet):?>
                                                                                <option value="<?=$stateDetGet->ST_CODE?>" <?php if($vendorCode){ echo $venDet->ST_CODE == $stateDetGet->ST_CODE?'selected':null; }?>><?=$stateDetGet->ST_NAME?></option>
                                                                        <?php endforeach; }?>
                                                                    </select>
                                                                <label id="state_name-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Select City</label>
                                                                    <select class="form-control select2 cityData" name="city_name">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php if($vendorCode){ foreach ($citiesDet as $citiesDetGet):?>
                                                                                <option value="<?=$citiesDetGet->CTY_CODE?>" <?php if($vendorCode){ echo $venDet->CTY_CODE == $citiesDetGet->CTY_CODE?'selected':null; }?>><?=$citiesDetGet->CTY_NAME?></option>
                                                                        <?php endforeach; }?>
                                                                    </select>
                                                                <label id="city_name-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">City</label>
                                                                    <input type="text" class="form-control" name="city_name" placeholder="Enter Address">
                                                                    <label id="city_name-error" class="error"></label>
                                                            </div>
                                                        </div> -->
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Postal Code</label>
                                                                    <input type="text" class="form-control" name="V_POSTAL_CODE_ID" value="<?=$vendorCode?$venDet->V_POSTAL_CODE:null?>" placeholder="Enter State">
                                                                <label id="V_POSTAL_CODE_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Full Address</label>
                                                                <input type="text" class="form-control" name="FULL_ADDRESS" value="<?=$vendorCode?$venDet->FULL_ADDRESS:null?>" placeholder="Enter State">
                                                                <label id="FULL_ADDRESS-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Building No</label>
                                                                <input type="text" class="form-control" name="BUILDING_NO" value="<?=$vendorCode?$venDet->BUILDING_NO:null?>" placeholder="Enter Postal Code">
                                                                <label id="BUILDING_NO-error" class="error"></label>
                                                            </div>
                                                        </div> 

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Street</label>
                                                                <input type="text" class="form-control" name="STREET" value="<?=$vendorCode?$venDet->STREET:null?>" placeholder="Enter Postal Code">
                                                                <label id="STREET-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="card-body border-bottom" style="margin-bottom: 20px;">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="mb-0 card-title flex-grow-1"><i class="mdi mdi-arrow-right text-primary"></i>Company details</h5>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Company Name</label>
                                                                    <input type="text" class="form-control" name="COMPANY_NAME" value="<?=$vendorCode?$venDet->COMPANY_NAME:null?>" placeholder="Enter Vendor Code ">
                                                                    <label id="COMPANY_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Company Contact</label>
                                                                    <input type="text" class="form-control" name="COMPANY_CONTACT" value="<?=$vendorCode?$venDet->COMPANY_CONTACT:null?>" placeholder="Enter Vendr Name ">
                                                                    <label id="COMPANY_CONTACT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Company Email I'd</label>
                                                                    <input type="text" class="form-control" name="COMPANY_EMAIL" value="<?=$vendorCode?$venDet->COMPANY_EMAIL:null?>" placeholder="Enter Vendr Name in Arabic">
                                                                <label id="COMPANY_EMAIL-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        <div class="card-body border-bottom" style="margin-bottom: 20px;">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="mb-0 card-title flex-grow-1"><i class="mdi mdi-arrow-right text-primary"></i>Bank details</h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Bank Name</label>
                                                                    <input type="text" class="form-control" name="BANK_AC" value="<?=$vendorCode?$venDet->BANK_AC:null?>" placeholder="Enter Vendor Code ">
                                                                    <label id="BANK_AC-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">A/C Number</label>
                                                                    <input type="text" class="form-control" name="BANK_NO" value="<?=$vendorCode?$venDet->BANK_NO:null?>" placeholder="Enter Vendr Name ">
                                                                    <label id="BANK_NO-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">IBAN</label>
                                                                    <input type="text" class="form-control" name="IBAN" value="<?=$vendorCode?$venDet->IBAN:null?>" placeholder="Enter Vendr Name in Arabic">
                                                                <label id="IBAN-error" class="error"></label>
                                                            </div>
                                                        </div>
                                        
                                                        <div class="card-body border-bottom" style="margin-bottom: 20px;">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="mb-0 card-title flex-grow-1"><i class="mdi mdi-arrow-right text-primary"></i>Accounts</h5>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Credit Limit</label>
                                                                    <input type="text" class="form-control" name="CREDIT_LIMIT" placeholder="Enter Vendr Name ">
                                                                    <label id="CREDIT_LIMIT-error" class="error"></label>
                                                            </div>
                                                        </div> -->
                                                        
                                                        <!-- <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Opening Balance</label>
                                                                    <input type="text" class="form-control" name="OPENING_BAL" placeholder="Enter Vendr Name in Arabic">
                                                                <label id="OPENING_BAL-error" class="error"></label>
                                                            </div>
                                                        </div> -->
                                                        
                                        
                                                        
                                                    </div>
                                                <div>
                                                    <button data-aftreload="true" data-control="parties/vendor-add" data-form="formdata" data-sweetalert="<?=$vendorCode?$sweetAlertMsg->venUpdate->msg:$sweetAlertMsg->venAdd->msg?>" data-sweetalertcontrol="<?=$vendorCode?$sweetAlertMsg->venUpdate->cont:$sweetAlertMsg->venAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$vendorCode?'Update Vendor':'Add Vendor'?></button>
                                                    <!-- <button data-aftreload="true" data-control="parties/vendor-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->venAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->venAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Vendor</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" value="<?=$vendorCode?>" name="vendor_code_db">
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

    function countryCh(ele) {
        $('.stateData').empty();
        $('.stateData').append(`<option value='' Selected disabled>Select</option>`);
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getStateByCntryCode')?>",
            data: {country_code:ele.value},
            dataType: "Json",
            success: function(resultData){
               for (let index = 0; index < resultData.length; index++) {
                    let st_name = resultData[index]['ST_NAME'];
                    let st_code = resultData[index]['ST_CODE'];
                    $('.stateData').append(`<option value='`+st_code+`'>`+st_name+`</option>`);
               }
            }
        });
    }

    function stateCh(ele) {
        $('.cityData').empty();
        $('.cityData').append(`<option value='' Selected disabled>Select</option>`);
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getCItyByStCode')?>",
            data: {state_code:ele.value},
            dataType: "Json",
            success: function(resultData){
               for (let index = 0; index < resultData.length; index++) {
                    let cty_name = resultData[index]['CTY_NAME'];
                    let cty_code = resultData[index]['CTY_CODE'];
                    $('.cityData').append(`<option value='`+cty_code+`'>`+cty_name+`</option>`);
               }
            }
        });
    }
</script>
        