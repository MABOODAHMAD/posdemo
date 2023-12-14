
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
                                    <h4 class="mb-sm-0 font-size-18">New Account Setup</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Account</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                                    <select class="form-control select2" name="GLMP_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit->BU_CODE?>" <?php if($glBatchCode){echo $glDet[0]->GLMP_BUS_UNIT == $busUnit->BU_CODE?'selected':'';}else{echo defaultBusUnit() == $busUnit->BU_CODE ? 'Selected':null;}?>><?=$busUnit->BU_NAME1?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="GLMP_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Module Name</label>
                                                                    <select class="form-control select2" name="GLMP_MODULE" onChange="moduleCh(this.value)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <option value='SO' <?php if($glBatchCode){echo $glDet[0]->GLMP_MODULE == 'SO'?'selected':'';}else{echo null;}?>>SALE ORDER</option>
                                                                        <option value='PO' <?php if($glBatchCode){echo $glDet[0]->GLMP_MODULE == 'PO'?'selected':'';}else{echo null;}?>>PURCHASE ORDER</option>
                                                                        <option value='AR' <?php if($glBatchCode){echo $glDet[0]->GLMP_MODULE == 'AR'?'selected':'';}else{echo null;}?>>ACCOUNT RECEIVEABLE</option>
                                                                        <option value='AP' <?php if($glBatchCode){echo $glDet[0]->GLMP_MODULE == 'AP'?'selected':'';}else{echo null;}?>>ACCOUNT PAYABLE</option>
                                                                        <option value='INV' <?php if($glBatchCode){echo $glDet[0]->GLMP_MODULE == 'INV'?'selected':'';}else{echo null;}?>>INVENTORY</option>
                                                                    </select>
                                                                <label id="GLMP_MODULE-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Type</label>
                                                                    <select class="form-control select2 mud-type-in" name="GLMP_TYPE">
                                                                            <option value='' Selected disabled>Select</option>
                                                                            <option value='CASH' <?php if($glBatchCode){echo $glDet[0]->GLMP_TYPE == 'CASH'?'selected':'';}else{echo null;}?>>CASH</option>
                                                                            <option value='RECEIVEABLE' <?php if($glBatchCode){echo $glDet[0]->GLMP_TYPE == 'RECEIVEABLE'?'selected':'';}else{echo null;}?>>RECEIVEABLE</option>
                                                                    </select>
                                                                <label id="GLMP_TYPE-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Return</label>
                                                                    <select class="form-control select2 ret-in" name="GLMP_RTN">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <option value='Y' <?php if($glBatchCode){echo $glDet[0]->GLMP_RTN == 'Y'?'selected':'';}else{echo null;}?>>Y</option>
                                                                        <option value='N' <?php if($glBatchCode){echo $glDet[0]->GLMP_RTN == 'N'?'selected':'';}else{echo null;}?>>N</option>
                                                                    </select>
                                                                <label id="GLMP_RTN-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Received By</label>
                                                                    <select class="form-control select2 red-in" name="GLMP_RECV_IN">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <option value='D' <?php if($glBatchCode){echo $glDet[0]->GLMP_RECV_IN == 'D'?'selected':'';}else{echo null;}?>>Debitor</option>
                                                                        <option value='C' <?php if($glBatchCode){echo $glDet[0]->GLMP_RECV_IN == 'C'?'selected':'';}else{echo null;}?>>Cash On hand</option>
                                                                    </select>
                                                                <label id="GLMP_RECV_IN-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Cost Center</label>
                                                                    <select class="form-control select2" name="GLMP_COST_CENTER">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($costCentDet as $costCentDetGet):?>
                                                                            <option value="<?=$costCentDetGet->CC_CODE?>" <?php if($glBatchCode){echo $glDet[0]->GLMP_COST_CENTER == $costCentDetGet->CC_CODE?'selected':'';}else{echo null;}?>><?=$costCentDetGet->CC_CODE.'-'.$costCentDetGet->CC_WHSE_CODE.'-'.$costCentDetGet->WHSE_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="GLMP_COST_CENTER-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                                <div class="form-row">
                                                                    <div style="overflow-x:auto; overflow-y:hidden; /* white-space:nowrap; */ margin:0 10px;" class="ftable col-md-12">
                                                                        <table class="table table-hover table-bordered ">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="15%">Account Type</th>
                                                                                    <th width="20%">Account No</th>
                                                                                    <th width="20%">Account Description</th>
                                                                                    <th width="15%">Transaction Type</th>
                                                                                    <th width="30%">Remark</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="tbUser">
                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                    </div>
                                                <div>
                                                    <button data-control="account/gl-profile-module-add" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->currAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->currAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$glBatchCode?'UPDATE':'CREATE'?></button>

                                                    <!-- <button data-control="master/currency-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->currAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->currAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add currency</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" name="AH_SORT_SEQ" id="short-seq-db">
                                                <input type="hidden" name="GL_BATCH_CODE" value="<?=$glBatchCode?>">
                                        </div>
                                        </form>
                                    </div>
                                    <!-- end card -->
                                </div> 
                             </div>
                        </div>
                
                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-body">
                                                <div class="card-body border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 card-title flex-grow-1">Currency Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>Sn.</th>
                                                            <th>Business Unit</th>
                                                            <th>MOdule</th>
                                                            <th>Type</th>
                                                            <th>Return</th>
                                                            <th>Received by</th>
                                                            <th>Cost Center</th>
                                                            <th>View Link Account</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Sn.</th>
                                                            <th>Business Unit</th>
                                                            <th>MOdule</th>
                                                            <th>Type</th>
                                                            <th>Return</th>
                                                            <th>Received by</th>
                                                            <th>Cost Center</th>
                                                            <th>View Link Account</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        <!--end row-->
                                    </div>
                                        </div>
                                    </div>
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
            <!--=============================== Auto Complete script Start=============================-->
            <script src="<?=base_url()?>assets/js/custom_js/jquery-1.8.3.js"></script>
            <script src="<?=base_url()?>assets/js/custom_js/jquery-ui-1.9.2.custom.js"></script>
            <!--=============================== Auto Complete script End=============================-->
<script>
function moduleCh(ele) {
    $('.ret-in').prop('disabled',false);
    $('.red-in').prop('disabled',false);
    $('.mud-type-in').empty();
    if(ele == 'INV'){
        $('.ret-in').prop('disabled',true);
        $('.red-in').prop('disabled',true);
        $('.mud-type-in').append(`
            <option value='TRANSFER'>201-Transfer</option>
            <option value='VENDOR_RETURN'>202-Vendor transfer</option>
            <option value='INCREASE'>204-Increase</option>
            <option value='DECREASE'>204-Decrease</option>
            <option value='OPENING_STOCK'>200-Opening</option>`);
    }else if(ele == 'SO'){
        $('.mud-type-in').append(`
            <option value='' Selected disabled>Select</option>
            <option value='CASH'>CASH</option>
            <option value='RECEIVEABLE'>RECEIVEABLE</option>
        `);
    }else if(ele == 'PO'){
        $('.mud-type-in').append(`
            <option value='N' Selected disabled>Select</option>
            <option value='PURCHASE'>PURCHASE</option>
        `);
    }else{
        $('.mud-type-in').append(`
            <option value='' Selected disabled>No Data Found</option>
        `);
    }
}
function accApp(){
                $('#tbUser').append(`<tr>
                    <td>
                        <select class="form-control acc-type-sel2" name="acc_type[]">
                            <option value='' Selected disabled>Select</option>
                            <option value='VAT_AC'>VAT ACCOUNT</option>
                            <option value='CASH_AC'>CASH ON HAND ACCOUNT</option>   
                            <option value='CG_AC'>COST GOODS ACCOUNT</option>   
                            <option value='STK_AC'>STOCK ACCOUNT</option>
                            <option value='INC_AC'>INCOME ACCOUNT</option>   
                            <option value='ADS_AC'>ADVERTISEMENT ACCOUNT</option>
                            <option value='DIS_AC'>DISCOUNT ACCOUNT</option>   
                            <option value='SAL_RET_AC'>SALE RETURN ACCOUNT</option>   
                            <option value='DEBT_AC'>DEBITOR ACCOUNT</option>   
                            <option value='PAY_AC'>PAYABLE ACCOUNT</option>   
                            <option value='TRAN_CUST_AC'>TRANSFER TO CUSTOM ACCOUNT</option>   
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" onInput="accDet(this)" onPaste="accDet(this)" placeholder="Search Account">
                        <input type="hidden" name="account_det[]" id="acc-det-db">
                    </td>
                    <td>
                        <span class='acc-desc'>no data available</span>
                    </td>
                    <td>
                        <select class="form-control tran-type-sel2" name="trans_type[]">
                            <option value='' Selected disabled>Select</option>
                            <option value='D'>Debit</option>
                            <option value='C'>Credit</option>   
                            <option value='B'>Both</option>   
                        </select>
                    </td>
                    <td>
                        <textarea id="w3review" name="GLMP_REMARK[]" rows="4" cols="50"></textarea>
                        
                    </td>
                </tr>`);
            }

        <?php 
            if($glBatchCode){
                foreach ($glDet as $glDetGet) { 
        ?>
            $('#tbUser').append(`<tr>
                    <td>
                        <select class="form-control acc-type-sel2" name="acc_type[]">
                            <option value='' Selected disabled>Select</option>
                            <option value='VAT_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'VAT_AC'?'selected':null;?>>VAT ACCOUNT</option>
                            <option value='CASH_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'CASH_AC'?'selected':null;?>>CASH ON HAND ACCOUNT</option>   
                            <option value='CG_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'CG_AC'?'selected':null;?>>COST GOODS ACCOUNT</option>   
                            <option value='STK_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'STK_AC'?'selected':null;?>>STOCK ACCOUNT</option>
                            <option value='INC_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'INC_AC'?'selected':null;?>>INCOME ACCOUNT</option>   
                            <option value='ADS_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'ADS_AC'?'selected':null;?>>ADVERTISEMENT ACCOUNT</option>
                            <option value='DIS_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'DIS_AC'?'selected':null;?>>DISCOUNT ACCOUNT</option>   
                            <option value='SAL_RET_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'SAL_RET_AC'?'selected':null;?>>SALE RETURN ACCOUNT</option>   
                            <option value='DEBT_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'DEBT_AC'?'selected':null;?>>DEBITOR ACCOUNT</option>   
                            <option value='PAY_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'PAY_AC'?'selected':null;?>>PAYABLE ACCOUNT</option>   
                            <option value='TRAN_CUST_AC' <?php echo $glDetGet->GLMP_ACCOUNT_TYPE == 'TRAN_CUST_AC'?'selected':null;?>>TRANSFER TO CUSTOM ACCOUNT</option>   
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control" onInput="accDet(this)" onPaste="accDet(this)" value="<?php echo $glDetGet->GLMP_ACCOUNT_NO;?>" placeholder="Search Account">
                        <input type="hidden" name="account_det[]" id="acc-det-db" value="<?php echo $glDetGet->GLMP_ACCOUNT_NO;?>">
                    </td>
                    <td>
                        <span class='acc-desc'><span class='text-success'><?php echo $glDetGet->AR_Title.'-'.$glDetGet->EN_Title.'-'.$glDetGet->AH_SUBSIDERY;?></span></span>
                    </td>
                    <td>
                        <select class="form-control tran-type-sel2" name="trans_type[]">
                            <option value='' Selected disabled>Select</option>
                            <option value='D' <?php echo $glDetGet->GLMP_ENTRY_TYPE == 'D'?'selected':null;?>>Debit</option>
                            <option value='C' <?php echo $glDetGet->GLMP_ENTRY_TYPE == 'C'?'selected':null;?>>Credit</option>   
                            <option value='B' <?php echo $glDetGet->GLMP_ENTRY_TYPE == 'B'?'selected':null;?>>Both</option>   
                        </select>
                    </td>
                    <td>
                        <textarea id="w3review" name="GLMP_REMARK[]" rows="4" cols="50"><?php echo $glDetGet->GLMP_REMARK;?></textarea>
                    </td>
                </tr>`);
                
        <?php } }?>

        
        function muduleSel(ele){
            if(ele.value == 'AR'){
                $(".GLMP_TYPE").select2().val('RECEIVEABLE').trigger("change");
                $(".GLMP_RECV_IN").select2().val('D').trigger("change");
            }else if(ele.value == 'SO'){
                $(".GLMP_TYPE").select2().val('CASH').trigger("change");
                $(".GLMP_RECV_IN").select2().val('C').trigger("change");
            }else{
                $(".GLMP_TYPE").select2().val('').trigger("change");
                $(".GLMP_RECV_IN").select2().val('').trigger("change");
            }
        }

        function accDet(ele) {
            $(ele).closest('tr').find('td .acc-desc').html('');
            $(ele).closest('tr').find('td #acc-det-db').val('');

            $(ele).autocomplete({

                source: function( request, response ) {

                    $.ajax({url: "<?=base_url('inputsearch/getAccDet')?>", dataType: "jsonp", data: { term: request.term,searchtype:"list"},

                        success: function( data ) {response(data); }

                    });

                },

                minLength: 1,

                response: function (event, ui) {

                    if ($(this).val().length >= 16 && ui.content[0].id == 0) {

                        bootbox.alert('no_match_found', function () {

                            $(ele).focus();

                        });

                        $(this).val('');

                    }

                    else if (ui.content.length == 1 && ui.content[0].id != 0) {

                        ui.item = ui.content[0];

                        $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);

                        $(this).autocomplete('close');

                    }

                    else if (ui.content.length == 1 && ui.content[0].id == 0) {

                        bootbox.alert('no_match_found', function () {

                            $(ele).focus();

                        });

                        $(this).val('');

                    }

                    },

                select: function (event, ui) {

                    $('#distriprofile').html('Loading profile..');

                    fetch(`<?php echo base_url('inputsearch/getAccDet') ?>?term=${ui.item.id}&searchtype=select`)

                    .then(response => response.json())

                    .then(function (data) {

                        $(ele).val(data.data_fetch.AH_SUBSIDERY);
                        $(ele).closest('tr').find('td .acc-desc').html(`<span class='text-success'>${data.data_fetch.AR_Title}-${data.data_fetch.EN_Title}-${data.data_fetch.AH_SUBSIDERY}</span>`);
                        $(ele).closest('tr').find('td #acc-det-db').val(data.data_fetch.AH_SUBSIDERY);
                        
                    })

                    .catch(function (err) {

                        $('#distriprofile').html(err);

                    });

                }

            });   
        }
        function viewAccDet(ele) {
            let batchCode = $(ele).data('batchcode');
            let moduleCode = $(ele).data('modulecode');
            $('.st_model_send').addClass('d-none');
            $('.st_model_head').html(`Module Code : `+moduleCode);
            
            $('.st_model_body').html(`<table Class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>ACCOUNT TYPE & INFO</th>
                                                <th>ACCOUNT NUMBER</th>
                                                <th>ACCOUNT DESCRIPTION</th>
                                                <th>TRANSACTION TYPE</th>
                                            </tr>
                                        </thead>
                                        <tbody id="unit-tr">
                                        </tbody>
                                    </table>`)
            $.ajax({
                        type: "POST",
                        url: "<?=base_url('Common/getGlmodeileAccLink')?>",
                        data: {batchCode},
                        dataType: "Json",
                        success: function(resultData){
                    
                        let get_data = resultData.get_data;
                        if (get_data.length>0) {
                            get_data.forEach(element => {
                                $('#unit-tr').append(`<tr>
                                                        <td>${element.GLMP_TYPE} & ${element.GLMP_ACCOUNT_TYPE}</td>
                                                        <td>${element.GLMP_ACCOUNT_NO}</td>
                                                        <td>${element.AR_Title}-${element.EN_Title}</td>
                                                        <td>${element.GLMP_ENTRY_TYPE == 'D'?'Debit':element.GLMP_ENTRY_TYPE == 'B'?'Both':'Credit'}</td>
                                                    </tr>`)
                            });
                        }else{
                            $('#unit-tr').append(`<tr>
                                                    <td colspan='5'><p class="text-center">No data Found</p></td>
                                                </tr>`)
                        }
                    }
            });

                                
    }
    $(document).ready(function() {
        <?php  if($glBatchCode){ ?>
            for (let index = 0; index < <?php echo 10-count($glDet); ?>; index++) {
                accApp();
                $('.acc-type-sel2').select2();
                $('.tran-type-sel2').select2();
            }
        <?php }else{ ?>
            for (let index = 0; index < 10; index++) {
                accApp();
                $('.acc-type-sel2').select2();
                $('.tran-type-sel2').select2();
            }
        <?php } ?>
        

        $('#datatable').DataTable({

            "processing": true,

            "serverSide": true,

            "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],

            "dom" : 'lBfrtip',

            "buttons" : ['copy', 'csv', 'excel', 'print'],

            "order": [],

            "scrollX": true,

            "ajax": { "url": "<?=base_url('account/gl-profile-module-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        