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
                        <h4 class="mb-sm-0 font-size-18">PAYMENT IN</h4>
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
                                <h5 class="mb-0 card-title flex-grow-1">Add New Payment</h5>
                                <p class="card-title-desc">CREDIT VOUCHER</p>
                            </div>
                        </div>
                        <div class="card-body">

                            <form id="formdata">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="validationCustom03" class="form-label">Wharehouse</label>
                                                <select name="PV_WHSE_CODE" class="form-control select2 whse-id-in" onchange="whseIn()">
                                                    <option value='' Selected disabled>Select</option>
                                                    <?php foreach ($whareDets as $whareDet):
                                                        if (strlen($whareDet->WHSE_CODE) == 2) { 
                                                            if($sesData->USER_TYPE == 'SUPERADMIN'){ ?>
                                                                <option value="<?=$whareDet->WHSE_CODE?>" oldInvPayCount="<?=$whareDet->WHSE_PAYMENT_COUNT?>" advancePayCount="<?=$whareDet->WHSE_CREDIT_MEMO_COUNT?>" debitMemoCount="<?=$whareDet->WHSE_DEBIT_MEMO_COUNT?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                            <?php }elseif ($sesData->USER_TYPE == 'USER') { 
                                                                    foreach ($whse_assign as $whseGet):
                                                                        if($whseGet->SMSW_WHSE_CODE == $whareDet->WHSE_CODE){
                                                            ?>
                                                                <option value="<?=$whareDet->WHSE_CODE?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                        <?php } endforeach; } }endforeach; ?>
                                                </select>
                                                <label id="PV_WHSE_CODE-error" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 searchCust">
                                        <div class="position-relative form-group">
                                            <label for="pur_pro" class="">Search Customer</label>
                                            <input type="text" id="searchuser" value=""
                                                class="form-control br-1 ui-autocomplete-input"
                                                placeholder="Search Customer" autocomplete="off" required="">
                                            <input type="hidden" name="vendor_code_db" id="vendor-code-db">
                                            <label id="vendor_code_db-error" class="error"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="pur_pro" class="">Search Details</label>
                                            <span id="distriprofile"></span>
                                        </div>
                                    </div>


                                    <!-- <div class="col-md-3">
            <div class="position-relative form-group">
            <label for="pur_pro" class="">&nbsp;<br></label><br>
        <a id="paymentmodal" class="mb-2 mr-2 btn-pill btn-hover-shine btn btn-info" data-toggle="modal" data-target="#commonmodal" style="">
            View Details
        </a>
        </div> -->
                                    <!-- <span id="distriprofile"></span> -->
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="validationCustom03" class="form-label">Vch No</label>
                                                <div class="col-md-5">
                                                    <select class="form-control voch-pre" name="voch_order_pre" onChange="vochPrech(this)">
                                                    </select>
                                                    <!-- <input class="form-control" type="text" name="item_rev_date"> -->
                                                </div>
                                                <div class="col-md-7">
                                                    <input class="form-control voch-pre-next-id" type="text" name="vchno_p_db" readonly>
                                                </div>
                                            <label id="vchno_p_db-error" class="error"></label>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="vchno" class="">Vch No.</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text voch-pre" id="option-date"></span>
                                                    <input type="text" class="form-control voch-pre-next-id" value="<?=rand(100000, 999999)?>"
                                                        aria-describedby="option-date" name="vchno_p_db" placeholder="null" disabled="true">
                                                </div>
                                                <input type="text" id="voch_" name="vchno_p_db" placeholder="Vch No."
                                                    value="<?= rand(100000, 999999) ?>" class="form-control">
                                            </div>
                                            <label id="vchno_p_db-error" class="error"></label>
                                        </div>
                                    </div> -->
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="vchdate" class="">Vch Date</label>
                                            <div class="input-group">
                                                <input type="date" id="vchdate" name="vchdate"
                                                    value="<?= date('Y-m-d') ?>" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="position-relative form-group">
                                            <label for="vchdesc" class="">Voucher Desc</label>
                                            <div class="input-group">
                                                <input type="text" name="voch_desc_p_db" class="form-control br-1"
                                                    placeholder="Voch desc" value="">

                                            </div>
                                            <label id="voch_desc_p_db-error" class="error"></label>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="accmount" class="">Payment mode</label>
                                            <div class="input-group">
                                                <input type="text" id="pay-meth" placeholder="Type pay code"
                                                    class=" form-control">
                                                <input type="hidden" name="pay_meth_db" id="pay-meth-db">
                                            </div>
                                            <label id="pay_meth_db-error" class="error"></label>
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-md-4">
                <div class="position-relative form-group">
                    <label for="accmount" class="">Payemnt Desc</label>
                    <div class="input-group">
                        <input type="text" id="accmount" name="accmount" placeholder="Pay desc" class=" form-control po-charge-val-dis" disabled>
                    </div>
                    <label id="accmount-error" class="error"></label>
                </div>
            </div> -->
                                    <div class="col-md-6">
                                        <div class="position-relative form-group">
                                            <label for="accmount" class="">Amount</label>
                                            <div class="input-group">
                                                <input type="text" name="amount_p_db" id="out-amt-db"
                                                    oninput="payIn(this)" placeholder="Amount" class=" form-control"
                                                    >
                                            </div>
                                            <label id="amount_p_db-error" class="error"></label>
                                        </div>
                                    </div>
                                </div>

                                <label for="validationCustom03" class="form-label">By Payment Method</label>
                                <div class="col-md-12 multi-pay-tb">
                                                                
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered po-charge-table">
                                        
                                        <tr>
                                            <td style="width: 12%;">
                                                <input type="text" class="form-control" onInput="payMethIn(this)">
                                                <input type="hidden" name="PD_PAY_METHOD_ID[]" id="po-charge-code-db">
                                            </td>
                                            <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                            <td style="width: 12%;">
                                                <input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> 
                                                <span class="d-none po-charge-val-dis">0</span>
                                                <input type="hidden" name="PD_AMOUNT[]" id="po-charge-amt-db">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 12%;">
                                                <input type="text" class="form-control" onInput="payMethIn(this)">
                                                <input type="hidden" name="PD_PAY_METHOD_ID[]" id="po-charge-code-db">
                                            </td>
                                            <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                            <td style="width: 12%;">
                                                <input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> 
                                                <span class="d-none po-charge-val-dis">0</span>
                                                <input type="hidden" name="PD_AMOUNT[]" id="po-charge-amt-db">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 12%;">
                                                <input type="text" class="form-control" onInput="payMethIn(this)">
                                                <input type="hidden" name="PD_PAY_METHOD_ID[]" id="po-charge-code-db">
                                            </td>
                                            <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                            <td style="width: 12%;">
                                                <input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> 
                                                <span class="d-none po-charge-val-dis">0</span>
                                                <input type="hidden" name="PD_AMOUNT[]" id="po-charge-amt-db">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 12%;">
                                                <input type="text" class="form-control" onInput="payMethIn(this)">
                                                <input type="hidden" name="PD_PAY_METHOD_ID[]" id="po-charge-code-db">
                                            </td>
                                            <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                            <td style="width: 12%;">
                                                <input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> 
                                                <span class="d-none po-charge-val-dis">0</span>
                                                <input type="hidden" name="PD_AMOUNT[]" id="po-charge-amt-db">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 12%;">
                                                <input type="text" class="form-control" onInput="payMethIn(this)">
                                                <input type="hidden" name="PD_PAY_METHOD_ID[]" id="po-charge-code-db">
                                            </td>
                                            <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                            <td style="width: 12%;">
                                                <input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> 
                                                <span class="d-none po-charge-val-dis">0</span>
                                                <input type="hidden" name="PD_AMOUNT[]" id="po-charge-amt-db">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 12%;"></td>
                                            <td style="width: 12%;">Total</td>
                                            <td style="width: 12%;">
                                                <span id="tot-po-charge">0</span>
                                                <input type="hidden" name="tot_pay_db" id="tot-pay-db">
                                            </td>
                                        </tr>
                                    </table>
                                </div> 
                                <div>
                                    <button data-control="sale/payment-in-create" data-form="formdata"
                                        data-sweetalert="<?= $sweetAlertMsg->payInAdd->msg ?>"
                                        data-sweetalertcontrol="<?= $sweetAlertMsg->payInAdd->cont ?>"
                                        data-aftreload="true" class="ajaxform btn btn-primary waves-effect waves-light"
                                        type="button" disabled="true">CREATE PAYMENT VOUCHER</button>
                                </div>
                                <!-- <button data-control="master/po-charge-add" data-form="formdata" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Submit</button> -->
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
                                            <h5 class="mb-0 card-title flex-grow-1">Payment In Lists</h5>
                                            <p class="card-title-desc">CREDIT VOUCHER LIST</p>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Sn.</th>
                                                    <th>Party Name</th>
                                                    <th>Vch No.</th>
                                                    <th>Vch Date</th>
                                                    <th>Voucher Desc</th>
                                                    <th>Amount</th>
                                                    <th>Made By</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Sn.</th>
                                                    <th>Party Name</th>
                                                    <th>Vch No.</th>
                                                    <th>Vch Date</th>
                                                    <th>Voucher Desc</th>
                                                    <th>Amount</th>
                                                    <th>Made By</th>
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
                    <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
    <script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- end main content-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!--=============================== Auto Complete script Start=============================-->
    <script src="<?= base_url() ?>assets/js/custom_js/jquery-1.8.3.js"></script>
    <script src="<?= base_url() ?>assets/js/custom_js/jquery-ui-1.9.2.custom.js"></script>
    <!--=============================== Auto Complete script End=============================-->

    <script>
        var out_amt = 0;

        function payMethIn(ele) {
            $(ele).closest('tr').find('td #po-charge-code-db').val('');
            if (ele.value.length >= 2) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Common/getPaymentMethodByCode') ?>",
                    data: { pay_meth_code: ele.value },
                    dataType: "Json",
                    success: function (resultData) {
                        // console.log(resultData);
                        let pay_meth_det = resultData.pay_meth_det;
                        if (pay_meth_det) {

                            $(ele).closest('tr').find('td #po-charge-code-db').val(pay_meth_det.PM_CODE);
                            $(ele).closest('tr').find('td .po-char-in-val-dis').prop('disabled', false);
                            $(ele).closest('tr').find('td .po-char-in-val-dis').val('');
                            $('.po-charge-val-dis').val(pay_meth_det.PM_DESC);
                        } else {
                            $(ele).closest('tr').find('td .po-char-in-val-dis').prop('disabled', true);
                            $(ele).closest('tr').find('td .po-char-in-val-dis').val('');
                            $('.po-charge-val-dis').val('');
                        }
                    }
                });
            } else {
                $(ele).closest('tr').find('td .po-char-in-val-dis').prop('disabled', true);
                $(ele).closest('tr').find('td .po-char-in-val-dis').val('');
                $(ele).closest('tr').find('td #po-charge-desc-dis').html('');
            }
            // $(ele).closest('tr').find('td .po-charge-val-dis').html(0);
            // poChargeCal();
        }

        function whseIn() {
            whse_code = $('.whse-id-in').val();
            let order_count = $('.whse-id-in').find('option:selected');
            window.oldInvCount = order_count.attr("oldInvPayCount");
            window.advPayCount = order_count.attr("advancePayCount");
            window.debitMemoCount = order_count.attr("debitMemoCount");
            $('.voch-pre').empty();
            $('.voch-pre').append(`<option value="" selected disabled>Select Type</option>`);
            $('.voch-pre').append(`<option value="P${whse_code}" vochPreCount="${oldInvCount}">P${whse_code}</option>`);
            $('.voch-pre').append(`<option value="C${whse_code}" vochPreCount="${advPayCount}">C${whse_code}</option>`);
            $('.voch-pre').append(`<option value="D${whse_code}" vochPreCount="${debitMemoCount}">D${whse_code}</option>`);
            
        }

        function vochPrech(ele){
            let order_count_get = $(ele).find('option:selected');
            order_count_get = order_count_get.attr("vochPreCount");
            $('.voch-pre-next-id').val(order_count_get);
        }

        $(function () {
                window.whse_code = $('.whse-id-in').val();

                $("#searchuser").autocomplete({

                    source: function (request, response) {
                        if(whse_code){

                            $.ajax({
                                url: "<?= base_url('Inputsearch/getCusDelByCustCodeGet') ?>", dataType: "jsonp", data: { term: request.term, searchtype: "list",whse_code},

                                success: function (data) { response(data); }

                            });

                        }else{
                                Swal.fire({
                                            title: "Warehouse Alert",
                                            text: "Select Warehouse First",
                                            icon: "error",
                                            confirmButtonColor: "#556ee6"
                                        });
                            }

                    },

                    minLength: 1,

                    select: function (event, ui) {

                        $('#distriprofile').html('Loading profile..');

                        fetch(`<?php echo base_url('Inputsearch/getCusDelByCustCodeGet') ?>?term=${ui.item.id}&searchtype=select&whse_code=${whse_code}`)

                            .then(response => response.json())

                            .then(function (data) {

                                distriprofile(data);

                                $('#out-amt-db').prop("disabled", false);
                                $('#vendor-code-db').val(ui.item.id);
                                $('#out-amt-db').val(data.vend_outstanding_amt);
                                out_amt = data.vend_outstanding_amt;
                                // if (parseFloat(out_amt) > 0) {
                                //     $('.ajaxform').prop("disabled", false);
                                //   ').removeClass('d-none');
                                // } else {
                                //     $('.ajaxform').prop("disabled", true);
                                //   ').addClass('d-none');
                                // }
                            })

                            .catch(function (err) {

                                $('#distriprofile').html(err);

                            });

                    }

                });

        });

        $(function () {

            $("#pay-meth").autocomplete({

                source: function (request, response) {

                    $.ajax({
                        url: "<?= base_url('Inputsearch/getPayMethod') ?>", dataType: "jsonp", data: { term: request.term, searchtype: "list" },

                        success: function (data) { response(data); }

                    });

                },

                minLength: 1,

                select: function (event, ui) {

                    // $('#distriprofile').html('Loading profile..');

                    fetch(`<?php echo base_url('Inputsearch/getPayMethod') ?>?term=${ui.item.id}&searchtype=select`)

                        .then(response => response.json())

                        .then(function (data) {

                            // distriprofile(data);

                            $('#pay-meth-db').val(ui.item.id);

                        })

                        .catch(function (err) {

                            // $('#distriprofile').html(err);

                        });

                }

            });

        });

        function distriprofile(ele) {
            console.log(ele);
            $('#distriprofile').html(`
                                            <div style="border: 2px dotted;">
                                                <div class="row">
                                                    <div class="col-md-3 dname">
                                                        <b>Name :</b> `+ ele.vend_det.CUST_NAME + `
                                                    </div>
                                                    <div class="col-md-3">
                                                        <b>Mobile :</b> `+ ele.vend_det.CUST_PHONE1 + `
                                                    </div>
                                                    <div class="col-md-6">
                                                        <b>Address :</b> `+ ele.vend_det.CUST_STR_ADDR1 + `
                                                    </div>
                                                <div>
                                                <div class="row">
                                                    <div class="col-md-12 dname">
                                                        <b>Balance :</b> <?= sysCur() ?> `+ ele.vend_outstanding_amt + `
                                                    </div>
                                                <div>
                                            </div>`);
        }

        function payIn(ele) {
            console.log(parseFloat(ele.value), parseFloat(out_amt));
            if (parseFloat(out_amt) >= parseFloat(ele.value) && parseFloat(ele.value) >= 0) {
                // $('.ajaxform').prop("disabled", false);
                //  ').removeClass('d-none');
            } else {
                // $(ele).val(0);
                // Swal.fire({
                //     title: "Payment Alert",
                //     text: "Amount not entered is greater than the outstanding amount ",
                //     icon: "error",
                //     confirmButtonColor: "#556ee6"
                // });
                // $('.ajaxform').prop("disabled", true);
                //  ').removeClass('d-none');
            }
        }

        function payMethIn(ele) {
            $(ele).closest('tr').find('td #po-charge-code-db').val('');
            if(ele.value.length>=2){
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Common/getPaymentMethodByCode') ?>",
                    data: {pay_meth_code:ele.value},
                    dataType: "Json",
                    success: function(resultData){
                        console.log(resultData);
                        let pay_meth_det = resultData.pay_meth_det;
                        if(pay_meth_det){

                            $(ele).closest('tr').find('td #po-charge-code-db').val(pay_meth_det.PM_CODE);
                            $(ele).closest('tr').find('td .po-char-in-val-dis').prop('disabled', false);
                            $(ele).closest('tr').find('td .po-char-in-val-dis').val('');
                            $(ele).closest('tr').find('td #po-charge-desc-dis').html(pay_meth_det.PM_DESC);
                        }else{
                            $(ele).closest('tr').find('td .po-char-in-val-dis').prop('disabled', true);
                            $(ele).closest('tr').find('td .po-char-in-val-dis').val('');
                            $(ele).closest('tr').find('td #po-charge-desc-dis').html('No data Found');
                        }
                    }
                });
            }else{
                $(ele).closest('tr').find('td .po-char-in-val-dis').prop('disabled', true);
                $(ele).closest('tr').find('td .po-char-in-val-dis').val('');
                $(ele).closest('tr').find('td #po-charge-desc-dis').html('');
            }
            $(ele).closest('tr').find('td .po-charge-val-dis').html(0);
            poChargeCal();
        }

        function poChargeCal() {

            let tot_po_charge = 0;
            let main_tot = $('#out-amt-db').val();
            $('.po-charge-table tr').each( (tr_idx,tr) => {
                $(tr).children('td').each( (td_idx, td) => {
                    if(td_idx == 2){
                        if(tr_idx != 5){
                            tot_po_charge = parseFloat(tot_po_charge) + parseFloat($(td).text());
                        }else{
                            tot_po_charge = parseFloat(tot_po_charge) + parseFloat(0);
                        }
                    }else{
                        tot_po_charge = parseFloat(tot_po_charge) + parseFloat(0);
                    }
                    // console.log( '[' +tr_idx+ ',' +td_idx+ '] => ' + $(td).text() + ' TOT ---' + tot_po_charge);
                }); 
                $('#tot-po-charge').html(tot_po_charge.toFixed(4));
                if(parseFloat(main_tot) == parseFloat(tot_po_charge)){
                    $('.ajaxform').prop("disabled", false);
                }else{
                    $('.ajaxform').prop("disabled", true);
                }
                // $('#main-tot-pay-dsp').html(tot_po_charge.toFixed(4));
            });

            // tableCalculation();
        }

        function poChargeValIn(ele) {

            let in_Value = ele.value;

            if(in_Value>0){

            }else{
                if(in_Value.length>1){
                    $(ele).val(0);
                    in_Value = 0;
                }
            }

            $(ele).closest('tr').find('td #po-charge-amt-db').val(in_Value);

            $(ele).closest('tr').find('td .po-charge-val-dis').html(in_Value);
            poChargeCal();
        }

        $(document).ready(function () {
            $('#datatable').DataTable({

                "processing": true,

                "serverSide": true,

                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],

                "dom": 'lBfrtip',

                "buttons": ['copy', 'csv', 'excel', 'print'],

                "order": [],

                "scrollX": true,

                "ajax": { "url": "<?= base_url('common/payment-out-table-list'); ?>", "type": "POST", "data": { device: "web", pv_type: 'CUSTOMER' } }

            });

        });
    </script>