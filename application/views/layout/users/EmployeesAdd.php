
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
                                    <h4 class="mb-sm-0 font-size-18">Employee</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add Employee</h5>
                                                <div class="flex-shrink-0">
                                                <a href="<?=base_Url()?>EmployeesList" class="btn btn-primary" >View Employees List</a>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                               
                                            </div>
                                        </div>
                                        
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="form-label">Bussiness Unit</label>
                                                                <div class="mb-3">
                                                                    <select class="form-control select2" name="EMP_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?php if($empCode){echo $empDet->EMP_BUS_UNIT == $busUnit['BU_CODE']?'selected':'';}else{echo defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null;}?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label id="EMP_BUS_UNIT-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Employee Code</label>
                                                                    <input type="text" class="form-control" name="EMP_CODE" value="<?=$empCode?$empDet->EMP_CODE:null?>" placeholder="Auto generate if empty" <?=$empCode?'disabled':null?>>
                                                                    <label id="EMP_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Employee Name</label>
                                                                    <input type="text" class="form-control" name="EMP_NAME1" value="<?=$empCode?$empDet->EMP_NAME1:null?>" placeholder="Employee Group ">
                                                                    <label id="EMP_NAME1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Employee Name(AR)</label>
                                                                <input type="text" class="form-control" name="EMP_NAME2" value="<?=$empCode?$empDet->EMP_NAME2:null?>" placeholder="Employee Name">
                                                                <label id="EMP_NAME2-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">SSN </label>
                                                                <input type="text" class="form-control" name="EMP_SSN" value="<?=$empCode?$empDet->EMP_SSN:null?>" placeholder="SSN">
                                                                <label id="EMP_SSN-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="form-label">Designation</label>
                                                                <div class="mb-3">
                                                                    <select class="form-control select2" name="EMP_CAT_ID">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($empCats as $empCat):?>
                                                                                <option value="<?=$empCat->EMPC_CODE?>" <?php if($empCode){echo $empDet->EMP_CAT_ID == $empCat->EMPC_CODE?'selected':'';}else{echo null;}?>><?=$empCat->EMPC_NAME?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label id="EMP_CAT_ID-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Max Disc Allow % </label>
                                                                <input type="number" class="form-control" name="EMP_DISC_PER" value="<?=$empCode?$empDet->EMP_DISC_PER:null?>" placeholder="in percentage">
                                                                <label id="EMP_DISC_PER-error" class="error"></label>
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
                                                                <input type="text" class="form-control" name="EMP_STR_ADDR1" value="<?=$empCode?$empDet->EMP_STR_ADDR1:null?>" placeholder="Address Line 1">
                                                                <label id="EMP_STR_ADDR1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Address Line 2</label>
                                                                <input type="text" class="form-control" name="EMP_STR_ADDR2" value="<?=$empCode?$empDet->EMP_STR_ADDR2:null?>" placeholder="Address Line 2">
                                                                <label id="EMP_STR_ADDR2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Address Line 3</label>
                                                                <input type="text" class="form-control" name="EMP_STR_ADDR3" value="<?=$empCode?$empDet->EMP_STR_ADDR3:null?>" placeholder="Address Line 3">
                                                                <label id="EMP_STR_ADDR3-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Select Country</label>
                                                                    <select class="form-control select2" name="EMP_COUNTRY_ID" onChange='countryCh(this)'>
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($countryLists as $countryList):?>
                                                                                <option value="<?=$countryList['CNTRY_CODE']?>" <?php if($empCode){echo $empDet->EMP_COUNTRY_ID == $countryList['CNTRY_CODE']?'selected':'';}else{echo null;}?>><?=$countryList['CNTRY_NAME']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="EMP_COUNTRY_ID-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Select State</label>
                                                                    <select class="form-control select2 stateData" onChange="stateCh(this)" name="EMP_STATE">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php if($empCode){ foreach ($stateDet as $stateDetGet):?>
                                                                                <option value="<?=$stateDetGet->ST_CODE?>" <?php if($empCode){ echo $empDet->EMP_STATE == $stateDetGet->ST_CODE?'selected':null; }?>><?=$stateDetGet->ST_NAME?></option>
                                                                        <?php endforeach; }?>
                                                                    </select>
                                                                <label id="EMP_STATE-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Select City</label>
                                                                    <select class="form-control select2 cityData" name="EMP_CITY_ID">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php if($empCode){ foreach ($citiesDet as $citiesDetGet):?>
                                                                                <option value="<?=$citiesDetGet->CTY_CODE?>" <?php if($empCode){ echo $empDet->EMP_CITY_ID == $citiesDetGet->CTY_CODE?'selected':null; }?>><?=$citiesDetGet->CTY_NAME?></option>
                                                                        <?php endforeach; }?>
                                                                    </select>
                                                                <label id="EMP_CITY_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Postal Code</label>
                                                                <input type="text" class="form-control" name="EMP_POSTAL_CODE_ID" value="<?=$empCode?$empDet->EMP_POSTAL_CODE_ID:null?>" placeholder="Tax Withholding Category">
                                                                <label id="EMP_POSTAL_CODE_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Fax 1</label>
                                                                <input type="text" class="form-control" name="EMP_FAX1" value="<?=$empCode?$empDet->EMP_FAX1:null?>" placeholder="Fax 1">
                                                                <label id="EMP_FAX1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Fax 2</label>
                                                                <input type="text" class="form-control" name="EMP_FAX2" value="<?=$empCode?$empDet->EMP_FAX2:null?>" placeholder="Fax 2">
                                                                <label id="EMP_FAX2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Phone no 1</label>
                                                                <input type="text" class="form-control" name="EMP_PHONE1" value="<?=$empCode?$empDet->EMP_PHONE1:null?>" placeholder="Phone no 1">
                                                                <label id="EMP_PHONE1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Phone No 2</label>
                                                                <input type="text" class="form-control" name="EMP_PHONE2" value="<?=$empCode?$empDet->EMP_PHONE2:null?>" placeholder="Phone No 2">
                                                                <label id="CUST_PHONE2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Email 1</label>
                                                                <input type="email" class="form-control" name="EMP_E_MAIL1" value="<?=$empCode?$empDet->EMP_E_MAIL1:null?>" placeholder="Email 1">
                                                                <label id="EMP_E_MAIL1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Email 2</label>
                                                                <input type="email" class="form-control" name="EMP_E_MAIL2" value="<?=$empCode?$empDet->EMP_E_MAIL2:null?>" placeholder="Email 1">
                                                                <label id="EMP_E_MAIL2-error" class="error"></label>
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
                                                                <input type="text" class="form-control" name="EMP_EDI1" value="<?=$empCode?$empDet->EMP_EDI1:null?>" placeholder="EDI1">
                                                                <label id="EMP_EDI1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Create new Password</label>
                                                                <input type="text" class="form-control" name="EMP_EDI2" value="<?=$empCode?$empDet->EMP_EDI2:null?>" placeholder="Create new password">
                                                                <label id="EMP_EDI2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>
                                                <button data-aftreload="true" data-control="master/emp-create" data-form="formdata" data-sweetalert="<?=$empCode?$sweetAlertMsg->empUpdate->msg:$sweetAlertMsg->empAdd->msg?>" data-sweetalertcontrol="<?=$empCode?$sweetAlertMsg->empUpdate->cont:$sweetAlertMsg->empAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$empCode?'Update Employee':'Add Employee'?></button>
                                                    <!-- <button data-control="master/emp-create" data-sweetalert="<?=$sweetAlertMsg->empAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->empAdd->cont?>" data-form="formdata" data-aftreload="true" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Employees</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" value="<?=$empCode?>" name="emp_code_db">
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
        