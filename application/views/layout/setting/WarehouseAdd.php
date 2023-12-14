
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
                                    <h4 class="mb-sm-0 font-size-18">Warehouse</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Wharehouse</h5>
                                               
                                            <div class="flex-shrink-0">
                                                <a href="<?=base_Url()?>WarehouseList" class="btn btn-primary" >View Wharehouse List</a>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                            
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        <!--<div class="card-body border-bottom" style="margin-bottom: 20px;">-->
                                                        <!--    <div class="d-flex align-items-center">-->
                                                        <!--        <h5 class="mb-0 card-title flex-grow-1"><i class="mdi mdi-arrow-right text-primary"></i>Basic Detail</h5>-->
                                                        <!--    </div>-->
                                                        <!--</div> -->
                                                        <div class="col-md-3">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="form-label">Bussiness Unit</label>
                                                                <div class="mb-3">
                                                                    <select class="form-control select2" name="WHSE_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?php if($whseCode){echo $whseDet->WHSE_BUS_UNIT == $busUnit['BU_CODE']?'selected':'';}else{echo defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null;}?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label id="WHSE_BUS_UNIT-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Wharehouse Code</label>
                                                                    <input type="text" class="form-control" value="<?=$whseCode?$whseDet->WHSE_CODE:null?>" name="WHSE_CODE" placeholder="Auto generate if empty" <?=$whseCode?'disabled':null?>>
                                                                    <label id="WHSE_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Description</label>
                                                                    <input type="text" class="form-control" name="WHSE_DESC" value="<?=$whseCode?$whseDet->WHSE_DESC:null?>">
                                                                    <label id="WHSE_DESC-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="form-label">Location Type</label>
                                                                <div class="mb-3">
                                                                        <select class="form-control select2" name="WHSE_LOCATION_TYPE">
                                                                            <option value='' Selected disabled>Select</option>
                                                                                <option value="DC" <?php if($whseCode){echo $whseDet->WHSE_LOCATION_TYPE == 'DC'?'selected':'';}else{echo null;}?>>Distribution</option>
                                                                                <option value="FC" <?php if($whseCode){echo $whseDet->WHSE_LOCATION_TYPE == 'FC'?'selected':'';}else{echo null;}?>>Factory</option>
                                                                                <option value="OW" <?php if($whseCode){echo $whseDet->WHSE_LOCATION_TYPE == 'OW'?'selected':'';}else{echo null;}?>>Outside Warehouse</option>
                                                                                <option value="SC" <?php if($whseCode){echo $whseDet->WHSE_LOCATION_TYPE == 'SC'?'selected':'';}else{echo null;}?>>Service Center</option>
                                                                                <option value="SL" <?php if($whseCode){echo $whseDet->WHSE_LOCATION_TYPE == 'SL'?'selected':'';}else{echo null;}?>>Selling Location</option>
                                                                        </select>
                                                                    <label id="WHSE_LOCATION_TYPE-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        
                                                       <div class="col-md-6 row" style="border-right: black 5px solid;">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Address line 1</label>
                                                                    <input type="text" class="form-control" name="WHSE_STR_ADDR1"placeholder="Enter Address" value="<?=$whseCode?$whseDet->WHSE_STR_ADDR1:null?>">
                                                                    <label id="WHSE_STR_ADDR1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Address line 2</label>
                                                                    <input type="text" class="form-control" name="WHSE_STR_ADDR2" placeholder="Enter Address" value="<?=$whseCode?$whseDet->WHSE_STR_ADDR2:null?>">
                                                                    <label id="WHSE_STR_ADDR2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Address line 3</label>
                                                                    <input type="text" class="form-control" name="WHSE_STR_ADDR3"placeholder="Enter Address" value="<?=$whseCode?$whseDet->WHSE_STR_ADDR3:null?>">
                                                                    <label id="WHSE_STR_ADDR3-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Country</label>
                                                                <select class="form-control select2" name="WHSE_COUNTRY" onChange="stateListJs(this)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($countryLists as $countryList):?>
                                                                                <option value="<?=$countryList['CNTRY_CODE']?>" <?php if($whseCode){echo $whseDet->WHSE_COUNTRY == $countryList['CNTRY_CODE']?'selected':'';}else{echo null;}?>> <?=$countryList['CNTRY_NAME']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="WHSE_COUNTRY-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">State</label>
                                                                    <select class="form-control select2 stateLists" onChange="stateCh(this)" name="WHSE_STATE">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php if($whseCode){ foreach ($statesLists as $statesList): if($statesList['ST_CNTRY_ID'] == $whseDet->WHSE_COUNTRY){?>
                                                                                <option value="<?=$statesList['ST_CODE']?>" <?php if($whseCode){echo $whseDet->WHSE_STATE == $statesList['ST_CODE']?'selected':'';}else{echo null;}?>><?=$statesList['ST_NAME']?></option>
                                                                        <?php }endforeach;} ?>
                                                                    </select>
                                                                <label id="WHSE_STATE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">City</label>
                                                                <select class="form-control select2 cityData" name="WHSE_CITY">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php if($whseCode){ foreach ($citiesLists as $citiesList): if($citiesList['CTY_STATE_CODE'] == $whseDet->WHSE_STATE){?>
                                                                                <option value="<?=$citiesList['CTY_CODE']?>" <?php if($whseCode){echo $whseDet->WHSE_CITY == $citiesList['CTY_CODE']?'selected':'';}else{echo null;}?>><?=$citiesList['CTY_NAME']?></option>
                                                                        <?php } endforeach;} ?>
                                                                    </select>
                                                                <label id="WHSE_CITY-error" class="error"></label>
                                                            </div>
                                                        </div>
            
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Postal Code</label>
                                                                    <input type="text" class="form-control" name="WHSE_POSTAL_CODE" placeholder="Enter code" value="<?=$whseCode?$whseDet->WHSE_POSTAL_CODE:null?>">
                                                                    <label id="WHSE_POSTAL_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    
                                                        
                                                        </div>
                                                        <div class="col-md-6 row" style="padding-left: 25px;">
                                                            
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Phone No 1.</label>
                                                                    <input type="text" class="form-control" name="WHSE_PHONE1" placeholder="Phone no." value="<?=$whseCode?$whseDet->WHSE_PHONE1:null?>">
                                                                    <label id="WHSE_PHONE1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Phone No 2.</label>
                                                                    <input type="text" class="form-control" name="WHSE_PHONE2" placeholder="Phone no." value="<?=$whseCode?$whseDet->WHSE_PHONE2:null?>">
                                                                    <label id="WHSE_PHONE2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Fax no 1.</label>
                                                                    <input type="text" class="form-control" name="WHSE_FAX1" placeholder="Fax no." value="<?=$whseCode?$whseDet->WHSE_FAX1:null?>">
                                                                    <label id="WHSE_FAX1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                       <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Fax no 2.</label>
                                                                    <input type="text" class="form-control" name="WHSE_FAX2" placeholder="Fax no." value="<?=$whseCode?$whseDet->WHSE_FAX2:null?>">
                                                                    <label id="WHSE_FAX2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Email 1</label>
                                                                    <input type="text" class="form-control" name="WHSE_E_MAIL1" placeholder="Email" value="<?=$whseCode?$whseDet->WHSE_E_MAIL1:null?>">
                                                                    <label id="WHSE_E_MAIL1-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Email 2</label>
                                                                    <input type="text" class="form-control" name="WHSE_E_MAIL2" placeholder="Email" value="<?=$whseCode?$whseDet->WHSE_E_MAIL2:null?>">
                                                                    <label id="WHSE_E_MAIL2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                       <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EDI 1</label>
                                                                    <input type="text" class="form-control" name="WHSE_EDI1" placeholder="EID no." value="<?=$whseCode?$whseDet->WHSE_EDI1:null?>">
                                                                    <label id="WHSE_EDI1-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Return Days</label>
                                                                    <input type="text" class="form-control" name="WHSE_EDI2"placeholder="Enter return day" value="<?=$whseCode?$whseDet->WHSE_EDI2:null?>">
                                                                    <label id="WHSE_EDI2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <!-- Sale Prefix Start -->
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Sale Order Count</label>
                                                                    <input type="text" class="form-control" name="WHSE_ORDER_COUNT"placeholder="Enter return day" value="<?=$whseCode?$whseDet->WHSE_ORDER_COUNT:null?>">
                                                                    <label id="WHSE_ORDER_COUNT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Sale Invoice Count</label>
                                                                    <input type="text" class="form-control" name="WHSE_INVOICE_COUNT"placeholder="Enter return day" value="<?=$whseCode?$whseDet->WHSE_INVOICE_COUNT:null?>">
                                                                    <label id="WHSE_INVOICE_COUNT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Sale Return Order Count</label>
                                                                    <input type="text" class="form-control" name="WHSE_RET_ORDER_COUNT"placeholder="Enter return day" value="<?=$whseCode?$whseDet->WHSE_RET_ORDER_COUNT:null?>">
                                                                    <label id="WHSE_RET_ORDER_COUNT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Sale Return Invoice Count</label>
                                                                    <input type="text" class="form-control" name="WHSE_RET_INVOICE_COUNT"placeholder="Enter return day" value="<?=$whseCode?$whseDet->WHSE_RET_INVOICE_COUNT:null?>">
                                                                    <label id="WHSE_RET_INVOICE_COUNT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Credit Memo Count</label>
                                                                    <input type="text" class="form-control" name="WHSE_CREDIT_MEMO_COUNT"placeholder="Enter return day" value="<?=$whseCode?$whseDet->WHSE_CREDIT_MEMO_COUNT:null?>">
                                                                    <label id="WHSE_CREDIT_MEMO_COUNT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Debit Memo Count</label>
                                                                    <input type="text" class="form-control" name="WHSE_DEBIT_MEMO_COUNT"placeholder="Enter return day" value="<?=$whseCode?$whseDet->WHSE_DEBIT_MEMO_COUNT:null?>">
                                                                    <label id="WHSE_DEBIT_MEMO_COUNT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Payment Count</label>
                                                                    <input type="text" class="form-control" name="WHSE_PAYMENT_COUNT"placeholder="Enter return day" value="<?=$whseCode?$whseDet->WHSE_PAYMENT_COUNT:null?>">
                                                                    <label id="WHSE_PAYMENT_COUNT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Sale Prefix End -->


                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox" value="Y" name="WHSE_ERP_PLANNING" id="formCheck1erp" <?php if($whseCode){echo $whseDet->WHSE_ERP_PLANNING == 'Y'?'checked':'';}else{echo null;}?>>
                                                                    <label class="form-check-label" for="formCheck1erp">ERP Planning</label> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3"> 
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox" value="Y" name="WHSE_MRP_REGEN" id="formCheck1mrp" <?php if($whseCode){echo $whseDet->WHSE_MRP_REGEN == 'Y'?'checked':'';}else{echo null;}?>>
                                                                    <label class="form-check-label" for="formCheck1mrp">MRP Regen</label>      
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox" value="Y" name="WHSE_DISTRIBUTION" id="formCheck1dis" <?php if($whseCode){echo $whseDet->WHSE_DISTRIBUTION == 'Y'?'checked':'';}else{echo null;}?>>
                                                                    <label class="form-check-label" for="formCheck1dis">Distriution</label> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3"> 
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox" value="Y" name="WHSE_TIME_ATTEND" id="formCheck1time" <?php if($whseCode){echo $whseDet->WHSE_TIME_ATTEND == 'Y'?'checked':'';}else{echo null;}?>>
                                                                    <label class="form-check-label" for="formCheck1time">Time Attend</label>      
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                <div>
                                                    
                                                    <button data-control="master/whse-add-db" data-form="formdata" data-sweetalert="<?=$whseCode?$sweetAlertMsg->whseUpdate->msg:$sweetAlertMsg->whseAdd->msg?>" data-sweetalertcontrol="<?=$whseCode?$sweetAlertMsg->whseUpdate->cont:$sweetAlertMsg->whseAdd->cont?>" data-aftreload="true" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$whseCode?'Update Warehouse':'Add Warehouse'?></button>
                                                </div>
                                                <span id="outmsg"></span>
                                                
                                        </div>
                                                <!-- //db input -->
                                                <input type="hidden" value="<?=$whseCode?>" name="whse_code_db">
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
   
   function stateListJs(ele) {

$('.stateLists').empty();
$('.stateLists').append(`<option value='' Selected disabled>Select</option>`);

$.ajax({
    type: "POST",
    url: "<?=base_url('Common/getStateByCntryCode')?>",
    data: {country_code:ele.value},
    dataType: "Json",
    success: function(resultData){
        for (let index = 0; index < resultData.length; index++) {
                let state_name = resultData[index]['ST_NAME'];
                let state_code = resultData[index]['ST_CODE'];
                $('.stateLists').append(`<option value='`+state_code+`'>`+state_name+`</option>`);
                // $('.trait_list').append(`<option value='`+trait_code+`'>`+trait_name+`</option>`);
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
        