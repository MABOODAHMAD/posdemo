
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
                                    <h4 class="mb-sm-0 font-size-18">ADD Customer</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Customer</h5>
                                                <div class="flex-shrink-0">
                                                    <a href="<?=base_Url()?>CustomerList" class="btn btn-primary" >Customer List</a>
                                                    <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Code</label>
                                                                    <input type="text" class="form-control" name="CUST_CODE" value="<?=$custCode?$custDet->CUST_CODE:null?>" placeholder="Customer Code" <?=$custCode?'disabled':null?>>
                                                                    <label id="CUST_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Customer Name</label>
                                                                    <input type="text" class="form-control" name="CUST_NAME" placeholder="Customer Name " value="<?=$custCode?$custDet->CUST_NAME:null?>">
                                                                    <label id="CUST_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Customer Name(AR)</label>
                                                                <input type="email" class="form-control" name="CUST_NAME_AR" placeholder="Customer Name" value="<?=$custCode?$custDet->CUST_NAME_AR:null?>">
                                                                <label id="CUST_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Customer Type</label>
                                                                <!-- <input type="email" class="form-control" name="CUST_CUST_TYPE" placeholder="Customer Type"> -->
                                                                <select class="form-control select2" name="CUST_CUST_TYPE">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($custTypeDets as $custTypeDet):?>
                                                                                <option value="<?=$custTypeDet->CTYP_CUST_TYPE?>" <?php if($custCode){ echo $custDet->CUST_CUST_TYPE == $custTypeDet->CTYP_CUST_TYPE?'selected':null; }?>><?=$custTypeDet->CTYP_CUST_TYPE.'-'.$custTypeDet->CTYP_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="CUST_CUST_TYPE-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Credit Manager</label>
                                                                <input type="text" class="form-control" name="CUST_CREDIT_MANAGER" placeholder="Territory" value="<?=$custCode?$custDet->CUST_CREDIT_MANAGER:null?>">
                                                                <label id="CUST_CREDIT_MANAGER-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Credit Limit</label>
                                                                <input type="text" class="form-control" name="CUST_CREDIT_LIMIT" placeholder="Territory" value="<?=$custCode?$custDet->CUST_CREDIT_LIMIT:null?>">
                                                                <label id="CUST_CREDIT_LIMIT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Tax Authority</label>
                                                                <input type="text" class="form-control" name="CUST_TAX_AUTHORITY" placeholder="Account Manager" value="<?=$custCode?$custDet->CUST_TAX_AUTHORITY:null?>">
                                                                <label id="CUST_TAX_AUTHORITY-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Exempt ID</label>
                                                                <input type="text" class="form-control" name="CUST_TAX_EXEMPT_ID" placeholder="Enter Customer" value="<?=$custCode?$custDet->CUST_TAX_EXEMPT_ID:null?>">
                                                                <label id="CUST_TAX_EXEMPT_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Warehouse</label>
                                                                <select name="CUST_WHSE_CODE" class="form-control select2">
                                                                    <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($whareDets as $whareDet):
                                                                            if (strlen($whareDet->WHSE_CODE) == 2) { 
                                                                                if($sesData->USER_TYPE == 'SUPERADMIN'){ ?>
                                                                                    <option value="<?=$whareDet->WHSE_CODE?>" orderCount="<?=$whareDet->WHSE_ORDER_COUNT?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                                <?php }elseif ($sesData->USER_TYPE == 'USER') { 
                                                                                        foreach ($whse_assign as $whseGet):
                                                                                            if($whseGet->SMSW_WHSE_CODE == $whareDet->WHSE_CODE){
                                                                                ?>

                                                                                <option value="<?=$whareDet->WHSE_CODE?>" orderCount="<?=$whareDet->WHSE_ORDER_COUNT?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                            <?php } endforeach; } }endforeach; ?>
                                                                </select>
                                                                <label id="CUST_WHSE_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                       
                                                        
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                                                    <h4 class="mb-sm-0 font-size-18">Address</h4>
                                                                    <div class="page-title-right">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                        
                                                          <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Address Line 1</label>
                                                                <input type="text" class="form-control" name="CUST_STR_ADDR1" placeholder="Address Line 1" value="<?=$custCode?$custDet->CUST_STR_ADDR1:null?>">
                                                                <label id="CUST_STR_ADDR1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Address Line 2</label>
                                                                <input type="text" class="form-control" name="CUST_STR_ADDR2" placeholder="Address Line 2" value="<?=$custCode?$custDet->CUST_STR_ADDR2:null?>">
                                                                <label id="CUST_STR_ADDR2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Address Line 3</label>
                                                                <input type="text" class="form-control" name="CUST_STR_ADDR3" placeholder="Address Line 3" value="<?=$custCode?$custDet->CUST_STR_ADDR3:null?>">
                                                                <label id="CUST_STR_ADDR3-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Select Country</label>
                                                                    <select class="form-control select2" name="CUST_COUNTRY_ID" onChange='countryCh(this)'>
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($countryLists as $countryList):?>
                                                                                <option value="<?=$countryList['CNTRY_CODE']?>" <?php if($custCode){ echo $custDet->CUST_COUNTRY_ID == $countryList['CNTRY_CODE']?'selected':null; }?>><?=$countryList['CNTRY_NAME']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="CUST_COUNTRY_ID-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Select State</label>
                                                                    <select class="form-control select2 stateData" onChange="stateCh(this)" name="CUST_STATE_ID" value="<?=$custCode?$custDet->CUST_NAME:null?>">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php if($custCode){ foreach ($stateDet as $stateDetGet):?>
                                                                                <option value="<?=$stateDetGet->ST_CODE?>" <?php if($custCode){ echo $custDet->CUST_STATE_ID == $stateDetGet->ST_CODE?'selected':null; }?>><?=$stateDetGet->ST_NAME?></option>
                                                                        <?php endforeach; }?>
                                                                    </select>
                                                                <label id="CUST_STATE_ID-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Select City</label>
                                                                    <select class="form-control select2 cityData" name="CUST_CITY_ID">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php if($custCode){ foreach ($citiesDet as $citiesDetGet):?>
                                                                                <option value="<?=$citiesDetGet->CTY_CODE?>" <?php if($custCode){ echo $custDet->CUST_CITY_ID == $citiesDetGet->CTY_CODE?'selected':null; }?>><?=$citiesDetGet->CTY_NAME?></option>
                                                                        <?php endforeach; }?>
                                                                    </select>
                                                                <label id="CUST_CITY_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Postal Code</label>
                                                                <input type="text" class="form-control" name="CUST_POSTAL_CODE_ID" placeholder="Tax Withholding Category" value="<?=$custCode?$custDet->CUST_POSTAL_CODE_ID:null?>">
                                                                <label id="CUST_POSTAL_CODE_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Fax 1</label>
                                                                <input type="text" class="form-control" name="CUST_FAX1" placeholder="Fax 1" value="<?=$custCode?$custDet->CUST_FAX1:null?>">
                                                                <label id="CUST_FAX1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Fax 2</label>
                                                                <input type="text" class="form-control" name="CUST_FAX2" placeholder="Fax 2" value="<?=$custCode?$custDet->CUST_FAX2:null?>">
                                                                <label id="CUST_FAX2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Phone no 1</label>
                                                                <input type="text" class="form-control" name="CUST_PHONE1" placeholder="Phone no 1" value="<?=$custCode?$custDet->CUST_PHONE1:null?>">
                                                                <label id="CUST_PHONE1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Phone No 2</label>
                                                                <input type="text" class="form-control" name="CUST_PHONE2" placeholder="Phone No 2" value="<?=$custCode?$custDet->CUST_PHONE2:null?>">
                                                                <label id="CUST_PHONE2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Email 1</label>
                                                                <input type="text" class="form-control" name="CUST_E_MAIL1" placeholder="Email 1" value="<?=$custCode?$custDet->CUST_E_MAIL1:null?>">
                                                                <label id="CUST_E_MAIL1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Email 2</label>
                                                                <input type="text" class="form-control" name="CUST_E_MAIL2" placeholder="Email 1" value="<?=$custCode?$custDet->CUST_E_MAIL2:null?>">
                                                                <label id="CUST_E_MAIL2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                                                    <h4 class="mb-sm-0 font-size-18">More</h4>
                                                                    <div class="page-title-right">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">EDI1</label>
                                                                <input type="text" class="form-control" name="CUST_EDI1" placeholder="EDI1" value="<?=$custCode?$custDet->CUST_EDI1:null?>">
                                                                <label id="CUST_EDI1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">EDI2</label>
                                                                <input type="text" class="form-control" name="CUST_EDI2" placeholder="EDI2" value="<?=$custCode?$custDet->CUST_EDI2:null?>">
                                                                <label id="CUST_EDI2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Card</label>
                                                                <input type="text" class="form-control" name="CUST_CARD" placeholder="Card" value="<?=$custCode?$custDet->CUST_CARD:null?>">
                                                                <label id="CUST_CARD-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">ARABIC SALUTATION</label>
                                                                <input type="text" class="form-control" name="CUST_ARABIC_SALUTATION" placeholder="ENGLISH SALUTATION" value="<?=$custCode?$custDet->CUST_ARABIC_SALUTATION:null?>">
                                                                <label id="CUST_ARABIC_SALUTATION-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>
                                                    <button data-aftreload="true" data-control="parties/customre-add-db" data-form="formdata" data-sweetalert="<?=$custCode?$sweetAlertMsg->custUpdate->msg:$sweetAlertMsg->custAdd->msg?>" data-sweetalertcontrol="<?=$custCode?$sweetAlertMsg->custUpdate->cont:$sweetAlertMsg->custAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$custCode?'Update Customer':'Add Customer'?></button>
                                                    <!-- <button data-control="parties/customre-add-db" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->custAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->custAdd->cont?>" data-aftreload="true" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Customer</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" name="cust_retuen_type" value="M">
                                                <input type="hidden" value="<?=$custCode?>" name="cust_code_db">
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
        