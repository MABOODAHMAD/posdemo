
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
                                    <h4 class="mb-sm-0 font-size-18">GL Entry</h4>
                                    <div class="page-title-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                    <form id="form-data">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card" style="-webkit-box-shadow: unset;">
                                    <div class="card-body">
                                        <!-- <div class="py-2 mt-3">
                                            <h3 class="font-size-15 fw-bold">GL Entry</h3>
                                        </div> -->
                                        <div class="row d-print-none">
                                            <div class="mb-3 col-lg-2">
                                                    <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                        <select class="form-control select2" name="GLJH_BUS_UNIT">
                                                            <option value='' Selected disabled>Select</option>
                                                            <?php foreach ($busUnits as $busUnit):?>
                                                                    <option value="<?=$busUnit->BU_CODE?>"><?=$busUnit->BU_NAME1?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <label id="GLJH_BUS_UNIT-error" class="error"></label>
                                            </div>
                                            <div class="mb-3 col-lg-2">
                                                <label for="name">GL PREFIX</label>

                                                <select name="GLJH_JOURNAL_PFX" class="form-control select2" onchange="glPrefixCh(this)">
                                                    <option value='' Selected disabled>Select</option>
                                                    <?php foreach ($prefixs as $prefixsGet): ?>
                                        
                                                        <option value="<?=$prefixsGet->GLP_JOURNAL_PFX?>" orderCount="<?=$prefixsGet->GLP_NEXT_NUMBER?>"><?=$prefixsGet->GLP_JOURNAL_PFX?></option>
                                                        
                                                    <?php endforeach;?>
                                                </select>
                                                <label id="GLJH_JOURNAL_PFX-error" class="error"></label>
                                            </div>
                                            <div class="mb-3 col-lg-2">
                                                <label for="name">Journal No</label>
                                                <input type="text" class="form-control inc-count" name="GLJH_JOURNAL_NO" placeholder="<?php if(isset($moduleType)){ if($moduleType == 'INV'){ echo 'MT';}else{ echo 'INVOICE';}}?> NO" aria-describedby="option-date" readonly>
                                                <label id="GLJH_JOURNAL_NO-error" class="error"></label>
                                            </div>
                                            <div class="mb-3 col-lg-2">
                                                <label for="name">GL Period</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text gl-period-mon-dsp" id="option-date"><?=date('m')?></span>
                                                    <input type="text" class="form-control"
                                                        aria-describedby="option-date" disabled="true" value="<?=date('Y')?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-lg-2">
                                                <label for="name">Journal Date</label>
                                                <input type="date" class="form-control" name="gl_date_db" value="<?=date('Y-m-d')?>">
                                            </div>
                                            <div class="mb-3 col-lg-2">
                                                <label for="name">Journal Reference</label>
                                                <input type="text" class="form-control" name="GLJH_JOURNAL_REF">
                                            </div>
                                            <!-- <div class="mb-3 col-lg-2">
                                                <label for="name">Date</label>
                                                <input type="text" class="form-control" value="" disabled="true" />
                                            </div>
                                            <div class="mb-3 col-lg-2">
                                                <label for="name">Posted</label>
                                                <input type="text" class="form-control" value="" disabled="true" />
                                            </div>
                                            <div class="mb-3 col-lg-2">
                                                <label for="name">Payment Status</label>
                                                <input type="text" class="form-control" value="" disabled="true" />
                                            </div> -->
                                        
                                            
                                            <!-- <div class="mb-3 col-lg-2">
                                                <label for="name">#</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text clear-period-dsp" id="option-date">0</span>
                                                    <input type="text" class="form-control clear-year-dsp" value="0"
                                                        aria-describedby="option-date" placeholder="null" disabled="true">
                                                </div>
                                            </div> -->
                                        </div>

                                        <div class="row d-print-none">
                                            <div class="mb-3 col-lg-6">
                                                <label for="name">Description</label>
                                                <textarea class="form-control" name="GLJH_DESC" rows="4" cols="50"></textarea>
                                                <label id="GLJH_DESC-error" class="error"></label>
                                            </div>
                                            <div class="mb-3 col-lg-6">
                                                <label for="name">Total</label>
                                                <div class="row">
                                                    <div class="row mb-2">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Debit</label>
                                                        <div class="col-sm-9">
                                                        <input type="text" class="form-control t-debit-dsp" id="horizontal-firstname-input" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Credit</label>
                                                        <div class="col-sm-9">
                                                        <input type="text" class="form-control t-credit-dsp" id="horizontal-firstname-input" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Difference</label>
                                                        <div class="col-sm-9">
                                                        <input type="text" class="form-control t-diff-dsp" id="horizontal-firstname-input" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered ">
                                                <thead>
                                                    <tr>
                                                        <th width="2%">Sn.</th>
                                                        <th width="10%">Account</th>
                                                        <th width="20%">Description</th>
                                                        <th width="8%">Debit</th>
                                                        <th width="8%">Credit</th>
                                                        <th width="6%">Cost Centre</th>
                                                        <th width="4%">Doc Date</th>
                                                        <th width="1%">Del.</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tr-append">
                                                </tbody>
                                            </table>
                                        <a href="javascript:void(0)" onClick="glDetail('1')" class="btn btn-success waves-effect waves-light me-1">Add Row</a>								
                                        <div class="col-xl-12 row d-none">
                                        
                                            <h5 class="font-size-14 card-body border-bottom po-charge-hd"><i class="mdi mdi-arrow-right text-primary"></i>Transaction
                                                Details</h5>
                                        
                                            <div class="col-md-6">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 12%;" colspan="2" class="text-center">Transaction</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 12%;">Description</td>
                                                            <td style="width: 12%;" id="gl-desc-dis"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Journal Desc</td>
                                                            <td style="width: 12%;" id="jourl-desc-dis"></td>
                                                        </tr>
                                                        <tr>
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width: 12%;">Account Name</th>
                                                                        <td style="width: 12%;" id="account-name-dis"></td>
                                                                        <th style="width: 12%;">Account Name Arabic</th>
                                                                        <td style="width: 12%;" id="acc-ar-dis"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 12%;" colspan="2" class="text-center">Item Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 12%;">Item code</td>
                                                            <td style="width: 12%;" id="item-code-dis"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Item description</td>
                                                            <td style="width: 12%;" id="item-desc-dis-1"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Item description</td>
                                                            <td style="width: 12%;" id="item-desc-dis-2"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 12%;" colspan="2" class="text-center">Bill to</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 12%;">Bill code</td>
                                                            <td style="width: 12%;" id="bill-code-dis"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Name 1</td>
                                                            <td style="width: 12%;" id="bill-name-1-dis"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Name 2</td>
                                                            <td style="width: 12%;" id="bill-name-2-dis"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 12%;" colspan="2" class="text-center">Journal Detail</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 12%;">Journal Prefix</td>
                                                            <td style="width: 12%;" id="jou-pre-dis"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Journal No</td>
                                                            <td style="width: 12%;" id="jou-no-dis"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Journal Date</td>
                                                            <td style="width: 12%;" id="jou-date-dis"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>
                                        <div class="d-print-none">
                                            <div class="float-end">
                                                <a href="javascript:void(0)" onClick="tbCal()" class="btn btn-success waves-effect waves-light me-1">Calculate</a>
                                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1 d-none"><i class="fa fa-print"></i></a>
                                                    <a data-aftreload="true" data-control="account/gl-entry-db" data-form="form-data" data-sweetalert="<?=$sweetAlertMsg->glEntryAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->glEntryAdd->cont?>" class="ajaxform btn btn-primary w-md waves-effect waves-light" disabled>Save</a>
                                                <span id="outmsg"></span></br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        
                       
                
                
                
                <!-- End Page-content -->
                
                    </div>
                </div>  

            <!-- end main content-->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <!--=============================== Auto Complete script Start=============================-->
            <script src="<?=base_url()?>assets/js/custom_js/jquery-1.8.3.js"></script>
            <script src="<?=base_url()?>assets/js/custom_js/jquery-ui-1.9.2.custom.js"></script>
            <!--=============================== Auto Complete script End=============================-->

<script>
    $('.ajaxform').prop('disabled',true);
    function glDetail(ele) {
        // $('#tr-append').empty();
        let sn_count = 1;
        for (let index = 0; index < ele; index++) {
            let tableLength = $('#tr-append tr').length+1;
            $('#tr-append').append(`
                                    <tr 
                                        class="tr-active-cont" onClick="showGLDetail(this)">
                                        <td>${tableLength}</td>
                                        <td>
                                            <input type="text" class="form-control" onInput="accDet(this)" placeholder="Search Account"></br>
                                            <label class='acc-desc'>no data available</label>
                                            <input type="hidden" name="acc_no_db[]" id="acc-det-db"></br>
                                            <label id="acc-no-error" class="error"></label>
                                        </td>
                                        <td>
                                            <textarea class="form-control acc-desc-in" name="acc_desc_db[]" rows="4" cols="50"></textarea>
                                            </br>
                                            <label id="acc-desc-error" class="error"></label>
                                        </td>
                                        <td><input type="text" name="debit_val_db[]" class="form-control tr-debit-in" onBlur="tbCal()" value="0"></td>
                                        <td><input type="text" name="credit_val_db[]" class="form-control tr-credit-in" onBlur="tbCal()" value="0"></td>
                                        <td>
                                            <select class="form-control cost-center-in" onChange="costCent(this)">
                                                <option value='' Selected disabled>Select</option>
                                                <?php foreach ($costCentDet as $costCentDetGet):?>
                                                    <option value="<?=$costCentDetGet->CC_CODE?>"><?=$costCentDetGet->CC_CODE?></option>
                                                <?php endforeach; ?>
                                            </select></br>
                                            <label id="cost-cent-error" class="error"></label>
                                            <input type="hidden" name="cost_center_db[]" class="form-control cost-center-in-db">
                                        </td>
                                        <td>
                                            <input type="text" name="doc_date_db[]" class="form-control">
                                        </td>
                                        <td width="8%"><a onClick='deleteTraitRow(this)'><i id="11" class="delete fa fa-trash"></i></a></td>
                                    </tr>`);
            sn_count++;
        }
        tbCal();
    }
    function costCent(ele){
        $(ele).closest('tr').find(".cost-center-in-db").val(ele.value);
    }
    function deleteTraitRow(ele) {
            if(confirm('Are you sure you want to delete this row')){
                $(ele).closest('tr').remove();
                tbCal();
            }
        }
    glDetail(2);
    function showGLDetail(ele) {
        $('.tr-active-cont').removeClass('table-success');
        $(ele).addClass('table-success'); 
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
                        let check_ac_no = data.data_fetch.AH_SUBSIDERY.substr(0,1);
                            $(ele).closest('tr').find(".cost-center-in option:last").remove();
                        if(parseInt(check_ac_no) == 4 || parseInt(check_ac_no) == 5){
                            $(ele).closest('tr').find('.cost-center-in').attr("disabled",false);
                        }else{
                            $(ele).closest('tr').find(".cost-center-in").append(`<option value="N"></option>`);
                            $(ele).closest('tr').find(".cost-center-in-db").val('N');

                            // $(ele).closest('tr').find(".cost-center-in").prop('readonly',true);
                            $(ele).closest('tr').find('.cost-center-in').attr("disabled", "disabled");
                            $(ele).closest('tr').find('td .cost-center-in').val('N').trigger('change');
                            $(ele).closest('tr').find('td #cost-cent-error').html('');
                        }
                        $(ele).val(data.data_fetch.AH_SUBSIDERY);
                        $(ele).closest('tr').find('td .acc-desc').html(`<span class='text-success'>${data.data_fetch.AR_Title}-${data.data_fetch.EN_Title}-${data.data_fetch.AH_SUBSIDERY}</span>`);
                        $(ele).closest('tr').find('td #acc-det-db').val(data.data_fetch.AH_SUBSIDERY);
                        $(ele).closest('tr').find('td #acc-no-error').html('');
                    })

                    .catch(function (err) {

                        $('#distriprofile').html(err);

                    });

                }

            });   
        }
    function tbCal(){
        let acc_no_con = true;
        let acc_desc_con = true;
        let cost_cent_con = true;

        let debit = 0;
        let credit = 0;
        console.log(debit);
        $('#tr-append tr').each( (tr_idx,tr) => {
            // $(tr).children('td').each( (td_idx, td) => {
                if($(tr).closest('tr').find('td #acc-det-db').val()){
                    $(tr).closest('tr').find('td #acc-no-error').html('');
                    $(tr).closest('tr').find('td #acc-det-db').removeClass('parsley-error');
                    $(tr).closest('tr').find('td #acc-det-db').addClass('parsley-success');
                }else{
                    $(tr).closest('tr').find('td #acc-no-error').html('Account No Required');
                    $(tr).closest('tr').find('td #acc-det-db').addClass('parsley-error');
                    acc_no_con = false;
                }

                if($(tr).closest('tr').find('td .cost-center-in').val()){
                    $(tr).closest('tr').find('td #cost-cent-error').html('');
                    $(tr).closest('tr').find('td .cost-center-in').removeClass('parsley-error');
                    $(tr).closest('tr').find('td .cost-center-in').addClass('parsley-success');
                }else{
                    $(tr).closest('tr').find('td #cost-cent-error').html('Cost Center Required');
                    $(tr).closest('tr').find('td .cost-center-in').addClass('parsley-error');
                    cost_cent_con = false;

                }

                if($(tr).closest('tr').find('td .acc-desc-in').val()){
                    $(tr).closest('tr').find('td #acc-desc-error').html('');
                    $(tr).closest('tr').find('td .acc-desc-in').removeClass('parsley-error');
                    $(tr).closest('tr').find('td .acc-desc-in').addClass('parsley-success');
                }else{
                    $(tr).closest('tr').find('td #acc-desc-error').html('Account Description Required');
                    $(tr).closest('tr').find('td .acc-desc-in').addClass('parsley-error');

                    acc_desc_con = false;
                }

               debit += parseFloat($(tr).closest('tr').find('td .tr-debit-in').val());
               credit += parseFloat($(tr).closest('tr').find('td .tr-credit-in').val());
            // });
        });
        $('.t-debit-dsp').val(debit.toFixed(2)); 
        $('.t-credit-dsp').val(credit.toFixed(2));
        let diff_amt = parseFloat($('.t-debit-dsp').val())-parseFloat($('.t-credit-dsp').val());
        $('.t-diff-dsp').val(diff_amt.toFixed(2));

        if(acc_desc_con && cost_cent_con && acc_no_con){
            if(diff_amt == 0){
                $('.ajaxform').prop('disabled',false);
            }else{
                $('.ajaxform').prop('disabled',true);
            }
        }else{
            $('.ajaxform').prop('disabled',true);
        }
        
    }

    function glPrefixCh(ele){
        var element = $(ele).find('option:selected'); ;
        var myTag = element.attr("orderCount");
        $('.inc-count').val(myTag);
    }
    // setInterval(function(){ 
    //     tbCal();
    // },500);
</script>