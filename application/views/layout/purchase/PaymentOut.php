
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
                                    <h4 class="mb-sm-0 font-size-18">PAYMENT Out</h4>
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
		<div class="col-md-3 searchCust">
			<div class="position-relative form-group">
				<label for="pur_pro" class="">Search Suppliers</label>
				<input type="text" id="searchuser" value="" class="form-control br-1 ui-autocomplete-input" placeholder="Search Suppliers" autocomplete="off" required="">
				<input type="hidden" name="vendor_code_db" id="vendor-code-db">
                <label id="vendor_code_db-error" class="error"></label>
			</div>
		</div>
		<div class="col-md-9">
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
                <div class="position-relative form-group">
                    <label for="vchno" class="">Vch No.</label>
                    <div class="input-group">
                        <input type="text" name="vchno_p_db" placeholder="Vch No." value="<?=rand(100000,999999)?>" class="form-control"> </div>
                    <label id="vchno_p_db-error" class="error"></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label for="vchdate" class="">Vch Date</label> 
                    <div class="input-group">
                        <input type="date" id="vchdate" name="vchdate" value="<?=date('Y-m-d')?>" class="form-control" disabled> </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label for="vchdesc" class="">Voucher Desc</label>
                    <div class="input-group">
                        <input type="text" name="voch_desc_p_db" class="form-control br-1" placeholder="Voch desc" value="" >
                    
                    </div>
                    <label id="voch_desc_p_db-error" class="error"></label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label for="accmount" class="">Payment mode</label>
                    <div class="input-group">
                        <input type="text" id="pay-meth"  placeholder="Type pay code" class=" form-control">
                        <input type="hidden" name="pay_meth_db" id="pay-meth-db">
                    </div>
                    <label id="pay_meth_db-error" class="error"></label>
                </div>
            </div>
            <!-- <div class="col-md-4">
                <div class="position-relative form-group">
                    <label for="accmount" class="">Payemnt Desc</label>
                    <div class="input-group">
                        <input type="text" id="accmount" name="accmount" placeholder="Pay desc" class=" form-control po-charge-val-dis" disabled>
                    </div>
                    <label id="accmount-error" class="error"></label>
                </div>
            </div> -->
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label for="accmount" class="">Currency</label>
                    <div class="input-group">
                        <span class="text-muted cur-pri-lis-exch-rate-dis"></span>
                    </div>
                    <!-- <label id="amount_p_db-error" class="error"></label> -->
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="position-relative form-group">
                    <label for="accmount" class="">Amount</label>
                    <div class="input-group">
                        <input type="text" name="amount_p_db" id="out-amt-db" oninput="payIn(this)" placeholder="Amount" class=" form-control" disabled>
                    </div>
                    <label id="amount_p_db-error" class="error"></label>
                </div>
            </div>
        </div>
        <div>
            <button data-control="purchase/payment-out-create" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->payOutAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->payOutAdd->cont?>" class="ajaxform btn btn-primary waves-effect waves-light" type="button" disabled="true">CREATE PAYMENT VOUCHER</button>
            <input type="hidden" name="exch_rate_db" id="exch-rate-db">
            <input type="hidden" name="exch_rate_id" id="exch-rate-id">
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
            <script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
            <!-- end main content-->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <!--=============================== Auto Complete script Start=============================-->
            <script src="<?=base_url()?>assets/js/custom_js/jquery-1.8.3.js"></script>
	        <script src="<?=base_url()?>assets/js/custom_js/jquery-ui-1.9.2.custom.js"></script>
            <!--=============================== Auto Complete script End=============================-->

    <script>
        var out_amt = 0;
                function payMethIn(ele) {
                    $(ele).closest('tr').find('td #po-charge-code-db').val('');
                    if(ele.value.length>=2){
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('Common/getPaymentMethodByCode') ?>",
                            data: {pay_meth_code:ele.value},
                            dataType: "Json",
                            success: function(resultData){
                                // console.log(resultData);
                                let pay_meth_det = resultData.pay_meth_det;
                                if(pay_meth_det){

                                    $(ele).closest('tr').find('td #po-charge-code-db').val(pay_meth_det.PM_CODE);
                                    $(ele).closest('tr').find('td .po-char-in-val-dis').prop('disabled', false);
                                    $(ele).closest('tr').find('td .po-char-in-val-dis').val('');
                                    $('.po-charge-val-dis').val(pay_meth_det.PM_DESC);
                                }else{
                                    $(ele).closest('tr').find('td .po-char-in-val-dis').prop('disabled', true);
                                    $(ele).closest('tr').find('td .po-char-in-val-dis').val('');
                                    $('.po-charge-val-dis').val('');
                                }
                            }
                        });
                    }else{
                        $(ele).closest('tr').find('td .po-char-in-val-dis').prop('disabled', true);
                        $(ele).closest('tr').find('td .po-char-in-val-dis').val('');
                        $(ele).closest('tr').find('td #po-charge-desc-dis').html('');
                    }
                    // $(ele).closest('tr').find('td .po-charge-val-dis').html(0);
                    // poChargeCal();
                }

        $(function(){

            $("#searchuser").autocomplete({

                source: function( request, response ) {

                    $.ajax({url: "<?=base_url('Inputsearch/getVenDelByVenCodeGet')?>", dataType: "jsonp", data: { term: request.term,searchtype:"list"},

                        success: function( data ) {response(data); }

                    });

                },

                minLength: 1,

                select: function (event, ui) {

                    $('#distriprofile').html('Loading profile..');

                    fetch(`<?php echo base_url('Inputsearch/getVenDelByVenCodeGet') ?>?term=${ui.item.id}&searchtype=select`)

                    .then(response => response.json())

                    .then(function (data) {

                        distriprofile(data);

                        $('#out-amt-db').prop("disabled",false);
                        $('#vendor-code-db').val(ui.item.id);
                        $('#out-amt-db').val(data.vend_outstanding_amt);
                        out_amt = data.vend_outstanding_amt;
                        if(parseFloat(out_amt)>0){
                            $('.ajaxform').prop("disabled",false);
                        }else{
                            $('.ajaxform').prop("disabled",true);
                        }

                    })

                    .catch(function (err) {

                        $('#distriprofile').html(err);

                    });

                }

            });

        });

        $(function(){

            $("#pay-meth").autocomplete({

                source: function( request, response ) {

                    $.ajax({url: "<?=base_url('Inputsearch/getPayMethod')?>", dataType: "jsonp", data: { term: request.term,searchtype:"list"},

                        success: function( data ) {response(data); }

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

            $('#distriprofile').html(`
                                            <div style="border: 2px dotted;">
                                                <div class="row">
                                                    <div class="col-md-3 dname">
                                                        <b>Name :</b> `+ele.vend_det.V_NAME+`
                                                    </div>
                                                    <div class="col-md-3">
                                                        <b>Mobile :</b> `+ele.vend_det.V_CONTACT+`
                                                    </div>
                                                    <div class="col-md-6">
                                                        <b>Address :</b> `+ele.vend_det.FULL_ADDRESS+`
                                                    </div>
                                                <div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <b>Wallet :</b> `+ele.vend_det.CUR_ABBRV+` `+ele.vend_outstanding_amt+`
                                                    </div>
                                                    <div class="col-md-6">
                                                        <b>Wallet :</b> <?=sysCur()?> `+ele.vend_det.WALLET+`
                                                    </div>
                                                <div>
                                            </div>`);
                                            curExtRate(ele.vend_det.CUR_CODE,2)
        }

        function payIn(ele) {
            console.log(parseFloat(ele.value),parseFloat(out_amt));
            if (parseFloat(out_amt) >= parseFloat(ele.value) && parseFloat(ele.value) >= 0) {
                $('.ajaxform').prop("disabled",false);
            }else{
                $(ele).val(0);
                Swal.fire({
                    title: "Payment Alert",
                    text: "Amount not entered is greater than the outstanding amount ",
                    icon: "error",
                    confirmButtonColor: "#556ee6"
                });
                $('.ajaxform').prop("disabled",true);
            }
        }

    function curExtRate(ele,type) {
        // type 1 = currency exchange 2 = buy currency
        $('#exch-rate-id').val('');
        $('#exch-rate-db').val('');
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getCurExhRateByCurCode')?>",
            data: {cur_exh_code:ele},
            dataType: "Json",
            success: function(resultData){
                if(type==2){
                    
                    if(resultData.cur_exh_det && ele.length>2){

                        $('.cur-pri-lis-exch-rate-dis').html(`1 ${resultData.cur_exh_det['CUR_NAME']} [${resultData.cur_exh_det['CUR_ABBRV']}] = ${resultData.cur_exh_det['EXCHR_BUY_RATE']} SAR`);
                        $('#exch-rate-id').val(resultData.cur_exh_det['EXCHR_ID']);
                        $('#exch-rate-db').val(resultData.cur_exh_det['EXCHR_BUY_RATE']);
                    }else{

                        $('.cur-pri-lis-exch-rate-dis').html('');
                        $('#exch-rate-id').val('');
                        $('#exch-rate-db').val('');
                    }
                }
            }
        });

    }

    $(document).ready(function() {
        $('#datatable').DataTable({

            "processing": true,

            "serverSide": true,

            "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],

            "dom" : 'lBfrtip',

            "buttons" : ['copy', 'csv', 'excel', 'print'],

            "order": [],

            "scrollX": true,

            "ajax": { "url": "<?=base_url('common/payment-out-table-list'); ?>", "type": "POST","data":{device:"web",pv_type:'VENDOR'} }

        });

    });
</script>
        