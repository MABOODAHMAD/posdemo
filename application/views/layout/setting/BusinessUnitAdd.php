
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
                                    <h4 class="mb-sm-0 font-size-18">Business Unit</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Business Unit</h5>
                                               
                                            <div class="flex-shrink-0">
                                                <a href="<?=base_Url()?>BusinessUnitList" class="btn btn-primary" >View Business Unit List</a>
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
                                                       
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Bussiness</label>
                                                                    <input type="text" class="form-control" name="BU_CODE" value="<?=$busunitCode?$busDet->BU_CODE:null?>" placeholder="Auto generate if empty" <?=$busunitCode?'disabled':null?>>
                                                                    <label id="BU_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Bus unit Name(EN)</label>
                                                                    <input type="text" class="form-control" name="BU_NAME1" value="<?=$busunitCode?$busDet->BU_NAME1:null?>" >
                                                                    <label id="BU_NAME1-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Bus unit Name(AR)</label>
                                                                    <input type="text" class="form-control" name="BU_NAME2" value="<?=$busunitCode?$busDet->BU_NAME2:null?>" >
                                                                    <label id="BU_NAME2-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                       <div class="col-md-6 row" style="border-right: black 5px solid;">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Address line 1</label>
                                                                    <input type="text" class="form-control" name="BU_STR_ADDR1"placeholder="Enter Address" value="<?=$busunitCode?$busDet->BU_STR_ADDR1:null?>">
                                                                    <label id="BU_STR_ADDR1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Address line 2</label>
                                                                    <input type="text" class="form-control" name="BU_STR_ADDR2" placeholder="Enter Address" value="<?=$busunitCode?$busDet->BU_STR_ADDR2:null?>">
                                                                    <label id="BU_STR_ADDR2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Address line 2</label>
                                                                    <input type="text" class="form-control" name="BU_STR_ADDR3"placeholder="Enter Address" value="<?=$busunitCode?$busDet->BU_STR_ADDR3:null?>">
                                                                    <label id="BU_STR_ADDR3-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!--<div class="col-md-2">-->
                                                        <!--    <div class="mb-3">-->
                                                        <!--        <label for="validationCustom03" class="form-label">Width</label>-->
                                                        <!--            <input type="text" class="form-control" name="item_width">-->
                                                                    <!-- <label id="state_name-error" class="error"></label> -->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Country</label>
                                                                    <select class="form-control select2" name="BU_COUNTRY" onChange="stateListJs(this)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($countryLists as $countryList):?>
                                                                                <option value="<?=$countryList['CNTRY_CODE']?>" <?php if($busunitCode){echo $busDet->BU_COUNTRY == $countryList['CNTRY_CODE']?'selected':'';}else{echo null;}?>><?=$countryList['CNTRY_NAME']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="BU_COUNTRY-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">State</label>
                                                                    <select class="form-control select2 stateLists" onChange="stateCh(this)" name="BU_STATE">
                                                                        <option value='' Selected disabled>Select</option>
                                   
                                    
                            <?php if($busunitCode){ 
                            foreach ($statesLists as $statesList): if($statesList['ST_CNTRY_ID'] == $busDet->BU_COUNTRY){?>
                                    <option value="<?=$statesList['ST_CODE']?>" <?php if($busunitCode){echo $busDet->BU_STATE == $statesList['ST_CODE']?'selected':'';}else{echo null;}?>><?=$statesList['ST_NAME']?></option>
                            <?php }
                            endforeach;
                            } ?>
                                                                    </select>
                                                                <label id="BU_STATE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">City</label>
                                                                <select class="form-control select2 cityData" name="BU_CITY">
                                                                        <option value='' Selected disabled>Select</option>
            <?php if($busunitCode){ foreach ($citiesLists as $citiesList): if($citiesList['CTY_STATE_CODE'] == $busDet->BU_STATE){?>
                    <option value="<?=$citiesList['CTY_CODE']?>" <?php if($busunitCode){echo $busDet->BU_CITY == $citiesList['CTY_CODE']?'selected':'';}else{echo null;}?>><?=$citiesList['CTY_NAME']?></option>
            <?php } endforeach;} ?>
                                                                    </select>
                                                                <label id="BU_CITY-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Postal Code</label>
                                                                    <input type="text" class="form-control" name="BU_POSTAL_CODE"placeholder="Enter code" value="<?=$busunitCode?$busDet->BU_POSTAL_CODE:null?>">
                                                                    <label id="BU_POSTAL_CODE-error" class="error"></label>
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
                                                        <div class="col-md-6 row" style="padding-left: 25px;">
                                                            
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Phone No 1.</label>
                                                                    <input type="text" class="form-control" name="BU_PHONE1"placeholder="Phone no." value="<?=$busunitCode?$busDet->BU_PHONE1:null?>">
                                                                    <label id="BU_PHONE1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Phone No 2.</label>
                                                                    <input type="text" class="form-control" name="BU_PHONE2"placeholder="Phone no." value="<?=$busunitCode?$busDet->BU_PHONE2:null?>">
                                                                    <label id="BU_PHONE2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Fax no 1.</label>
                                                                    <input type="text" class="form-control" name="BU_FAX1"placeholder="Fax no." value="<?=$busunitCode?$busDet->BU_FAX1:null?>">
                                                                    <label id="BU_FAX1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                       <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Fax no 2.</label>
                                                                    <input type="text" class="form-control" name="BU_FAX2"placeholder="Fax no." value="<?=$busunitCode?$busDet->BU_FAX2:null?>">
                                                                    <label id="BU_FAX2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Email 1</label>
                                                                    <input type="text" class="form-control" name="BU_E_MAIL1"placeholder="Email" value="<?=$busunitCode?$busDet->BU_E_MAIL1:null?>">
                                                                    <label id="BU_E_MAIL1-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Email 2</label>
                                                                    <input type="text" class="form-control" name="BU_E_MAIL2"placeholder="Email" value="<?=$busunitCode?$busDet->BU_E_MAIL2:null?>">
                                                                    <label id="BU_E_MAIL2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                       <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Federal Id</label>
                                                                    <input type="text" class="form-control" name="BU_FEDERAL_ID"placeholder="Federal id." value="<?=$busunitCode?$busDet->BU_FEDERAL_ID:null?>">
                                                                    <label id="BU_FEDERAL_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">No of Periods</label>
                                                                    <input type="text" class="form-control" name="BU_NUMBER_OF_PERIODS"placeholder="No of periods." value="<?=$busunitCode?$busDet->BU_NUMBER_OF_PERIODS:null?>">
                                                                    <label id="BU_NUMBER_OF_PERIODS-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        </div>
                                                       
                                                    </div>
                                                <div>
                                                <!--<button data-control="master/business-unit-add-db" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->busAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->busAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Bussiness</button>-->
                                                    <button data-control="master/business-unit-add-db" data-form="formdata" data-sweetalert="<?=$busunitCode?$sweetAlertMsg->busUpdate->msg:$sweetAlertMsg->busAdd->msg?>" data-sweetalertcontrol="<?=$busunitCode?$sweetAlertMsg->busUpdate->cont:$sweetAlertMsg->busAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$busunitCode?'Update Business Unit':'Add Business Unit'?></button>
                                                
                                                </div>
                                                <span id="outmsg"></span>
                                            <input type="hidden" value="<?=$busunitCode?>" name="bus_code_db">
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
   
   function stateListJs(ele) {

    $('stateLists').empty();
    $('stateLists').append(`<option value='' Selected disabled>Select</option>`);

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
        