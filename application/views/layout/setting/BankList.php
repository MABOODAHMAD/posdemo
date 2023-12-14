
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
                                    <h4 class="mb-sm-0 font-size-18">Bank List</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Bank</h5>
                                               
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
                                                            <div class="mb-3">
                                                                <label for="example-text-input" class="form-label">Bussiness Unit</label>
                                                                <div class="mb-3">
                                                                        <select class="form-control select2" name="BANK_BUS_UNIT">
                                                                            <option value='' Selected disabled>Select</option>
                                                                            <?php foreach ($busUnits as $busUnit):?>
                                                                                    <option value="<?=$busUnit['BU_CODE']?>" <?=$bankDet->BANK_BUS_UNIT==$busUnit['BU_CODE']?'Selected':Null?>><?=$busUnit['BU_NAME1']?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    <label id="BANK_BUS_UNIT-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        <!-- BANK_CODE -->
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Bank Name1</label>
                                                                    <input type="text" class="form-control" name="BANK_NAME1" value="<?=$bankDet->BANK_NAME1?>" placeholder="Auto generate if empty">
                                                                    <label id="BANK_NAME1-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Bank Name2</label>
                                                                    <input type="text" class="form-control" name="BANK_NAME2" value="<?=$bankDet->BANK_NAME2?>">
                                                                    <label id="BANK_NAME2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Account</label>
                                                                    <input type="text" class="form-control" name="BANK_ACCOUNT" value="<?=$bankDet->BANK_ACCOUNT?>">
                                                                    <label id="BANK_ACCOUNT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Contact</label>
                                                                    <input type="text" class="form-control" name="BANK_CONTACT" value="<?=$bankDet->BANK_CONTACT?>">
                                                                    <label id="BANK_CONTACT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="BANK_ALLOW_PRE_NUM_CHKS" id="formCheck1" value="Y" <?=$bankDet->BANK_ALLOW_PRE_NUM_CHKS=='Y'?'Checked':NULL?>>
                                                            <label class="form-check-label" for="formCheck1">Allow Pre num Chks</label>
                                                            
                                                        </div>
                                                        
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="BANK_ALLOW_MANUAL_CHKS" id="formCheck1" value="Y" <?=$bankDet->BANK_ALLOW_MANUAL_CHKS=='Y'?'Checked':NULL?>>
                                                            <label class="form-check-label" for="formCheck1">Allow Manual Chks</label>
                                                            
                                                        </div>
                                                        
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="BANK_PRINT_CHK_TEST_PAGES" id="formCheck1" value="Y" <?=$bankDet->BANK_PRINT_CHK_TEST_PAGES=='Y'?'Checked':NULL?>>
                                                            <label class="form-check-label" for="formCheck1">Print Chk Test Pagesn</label>
                                                            
                                                        </div>
                                                        
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Next Chk Number</label>
                                                                    <input type="text" class="form-control" name="BANK_NEXT_CHK_NUMBER" value="<?=$bankDet->BANK_NEXT_CHK_NUMBER?>">
                                                                    <label id="BANK_NEXT_CHK_NUMBER-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                       
                                                         
                                                        
                                                       

                                                       
                                        
                                                       
                                                        
                                                      
                                                        
                                                       <div class="col-md-6 row" style="border-right: black 5px solid;">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Address line 1</label>
                                                                    <input type="text" class="form-control" name="BANK_STR_ADDR1"placeholder="Enter Address" value="<?=$bankDet->BANK_STR_ADDR1?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Address line 2</label>
                                                                    <input type="text" class="form-control" name="BANK_STR_ADDR2" placeholder="Enter Address" value="<?=$bankDet->BANK_STR_ADDR2?>">
                                                                    <!-- <label id="city_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Address line 3</label>
                                                                    <input type="text" class="form-control" name="BANK_STR_ADDR3"placeholder="Enter Address" value="<?=$bankDet->BANK_STR_ADDR3?>">
                                                                    <!-- <label id="state_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Country</label>
                                                                <select class="form-control select2" name="BANK_COUNTRY_ID" onChange="stateListJs(this.value)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($countryLists as $countryList):?>
                                                                                <option value="<?=$countryList['CNTRY_CODE']?>" <?=$bankDet->BANK_COUNTRY_ID==$countryList['CNTRY_CODE']?'Selected':Null?>><?=$countryList['CNTRY_NAME']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="BANK_COUNTRY_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">State</label>
                                                                    <select class="form-control select2 stateLists" onChange="stateCh(this.value)" name="BANK_STATE_ID">
                                                                        <option value='' Selected disabled>Select</option>
                                                                    </select>
                                                                <label id="BANK_STATE_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">City</label>
                                                                <select class="form-control select2 cityData" name="BANK_CITY_ID">
                                                                        <option value='' Selected disabled>Select</option>
                                                                    </select>
                                                                <label id="BANK_CITY_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Postal Code</label>
                                                                    <input type="text" class="form-control" name="BANK_POSTAL_CODE_ID"placeholder="Enter code" value="<?=$bankDet->BANK_POSTAL_CODE_ID?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
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
                                                                    <input type="text" class="form-control" name="BANK_PHONE1"placeholder="Phone no." value="<?=$bankDet->BANK_PHONE1?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Phone No 2.</label>
                                                                    <input type="text" class="form-control" name="BANK_PHONE2"placeholder="Phone no." value="<?=$bankDet->BANK_PHONE2?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Fax no 1.</label>
                                                                    <input type="text" class="form-control" name="BANK_FAX1"placeholder="Fax no." value="<?=$bankDet->BANK_FAX1?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                       <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Fax no 2.</label>
                                                                    <input type="text" class="form-control" name="BANK_FAX2"placeholder="Fax no." value="<?=$bankDet->BANK_FAX2?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Email 1</label>
                                                                    <input type="text" class="form-control" name="BANK_E_MAIL1"placeholder="Email" value="<?=$bankDet->BANK_E_MAIL1?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Email 2</label>
                                                                    <input type="text" class="form-control" name="BANK_E_MAIL2"placeholder="Email" value="<?=$bankDet->BANK_E_MAIL2?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                       <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EDI 1</label>
                                                                    <input type="text" class="form-control" name="BANK_EDI1" placeholder="EID no." value="<?=$bankDet->BANK_EDI1?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EDI 2</label>
                                                                    <input type="text" class="form-control" name="BANK_EDI2" placeholder="EID no." value="<?=$bankDet->BANK_EDI2?>">
                                                                    <!-- <label id="country_name-error" class="error"></label> -->
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        </div>
                                                        
                                                        
                                                        
                                                        

                                        
                                                        
                                                        
                                                        
                                                        
                                        
                                                        
                                                    </div>
                                                <div>
                                                    <button data-control="master/bank-detail-update" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->bankUpdate->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->bankUpdate->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="button">Update Bank detail</button>
                                                </div>
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
                    
                
          
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
   
   function stateListJs(ele,stSelect=null) {

        $('stateLists').empty();
        $('stateLists').append(`<option value='' Selected disabled>Select</option>`);

        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getStateByCntryCode')?>",
            data: {country_code:ele},
            dataType: "Json",
            success: function(resultData){
                for (let index = 0; index < resultData.length; index++) {
                        let state_name = resultData[index]['ST_NAME'];
                        let state_code = resultData[index]['ST_CODE'];
                        let st_select = state_code == stSelect?'Selected':null;
                        $('.stateLists').append(`<option value='`+state_code+`' `+st_select+`>`+state_name+`</option>`);
                        // $('.trait_list').append(`<option value='`+trait_code+`'>`+trait_name+`</option>`);
                }
            }
        });
    }

function stateCh(ele,ctySelect=null) {
    $('.cityData').empty();
    $('.cityData').append(`<option value='' Selected disabled>Select</option>`);
    $.ajax({
        type: "POST",
        url: "<?=base_url('Common/getCItyByStCode')?>",
        data: {state_code:ele},
        dataType: "Json",
        success: function(resultData){
           for (let index = 0; index < resultData.length; index++) {
                let cty_name = resultData[index]['CTY_NAME'];
                let cty_code = resultData[index]['CTY_CODE'];
                let cty_select = cty_code == ctySelect?'Selected':null;
                $('.cityData').append(`<option value='`+cty_code+`' `+cty_select+`>`+cty_name+`</option>`);
           }
        }
    });
}

$(document).ready(function(){
    stateListJs('<?=$bankDet->BANK_COUNTRY_ID?>','<?=$bankDet->BANK_STATE_ID?>');
    stateCh('<?=$bankDet->BANK_STATE_ID?>','<?=$bankDet->BANK_CITY_ID?>');

})
</script>
        