
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
                                    <h4 class="mb-sm-0 font-size-18"><?=isset($moduleTitle)?$moduleTitle:''?> GL Transaction</h4>
                                    <div class="page-title-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row d-print-none">
                            <div class="mb-3 col-lg-2">
                                <label for="name"><?php if(isset($moduleType)){ if($moduleType == 'INV'){ echo 'MT';}else{ echo 'INVOICE';}}?> PREFIX</label>
                                <!-- <div class='row'> -->
                                    <!-- <div class="col-md-3"> -->
                                        <input type="text" onInput="glDetail()" class="form-control po-pre-npr-next-id inc-pre" placeholder="<?php if(isset($moduleType)){ if($moduleType == 'INV'){ echo 'MT';}else{ echo 'INVOICE';}}?> PREFIX" aria-describedby="option-date">
                                    <!-- </div> -->
                                    <!-- <div class="col-md-9">
                                        <input type="text" onInput="glDetail()" class="form-control po-pre-npr-next-id inc-count" placeholder="0001" aria-describedby="option-date">
                                    </div>
                                </div> -->
                                
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name"><?php if(isset($moduleType)){ if($moduleType == 'INV'){ echo 'MT';}else{ echo 'INVOICE';}}?> NO</label>
                                <input type="text" onInput="glDetail()" class="form-control po-pre-npr-next-id inc-count" placeholder="<?php if(isset($moduleType)){ if($moduleType == 'INV'){ echo 'MT';}else{ echo 'INVOICE';}}?> NO" aria-describedby="option-date">
                            </div>
                            <!-- <div class="mb-3 col-lg-2">
                                <label for="name">Order Type</label>
                                <input type="text" class="form-control" value="" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Order Status</label>
                                <input type="text" class="form-control" value="" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
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
                        
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card" style="-webkit-box-shadow: unset;">
                                    <div class="card-body">
                                        <div class="invoice-title">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td width="50%" align="left" style="padding: 0rem 1.25rem;">
                                                        <div class="mb-4">
                                                            <img src="assets/images/logo-dark.png" alt="logo" height="40px">
                                                        </div>
                                                    </td>
                                            
                                                    <td width="50%" align="right" style="padding: 0rem 1.25rem;">
                                                        <h4 class="float-end font-size-16"></h4>
                                            
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <div class="py-2 mt-3">
                                            <h3 class="font-size-15 fw-bold"><?=isset($moduleTitle)?$moduleTitle:''?> GL Transaction Summary</h3>
                                        </div>
                                        <div class="table-responsive">
                                        <table class="table table-hover table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th>Sn.</th>
                                                    <th colspan="2" class="text-center">GL Period</th>
                                                    <th colspan="2" class="text-center">Account & Cost Centre</th>
                                                    <th>Debit</th>
                                                    <th>Credit</th>
                                                    <th>Posted</th>
                                                    <!--<th width="10%">Distribution Amount in SAR</th>-->
                                                    <!-- <th width="100%">Final Price</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="tr-append">
                                               <tr><td colspan="8" class="text-center">No data Found<td></tr>
                                            </tbody>
                                        </table>
																		
                                        <div class="col-xl-12 row">
                                        
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
                                        <a href="javascript:window.print()" class="d-print-none btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                        <!-- <form id="form-data">
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <input type="hidden" name="order_id_db" value="<?=$orderId?>">
                                                    <input type="hidden" name="clearance_db" value="<?=$clearanceDet->CPO_CL_NO?>">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                                    <?php if ($clearanceDet->INV_POSTED == 'N') { ?>
                                                    <a data-control="purchase/purchase-recevied" data-form="form-data" class="ajaxform btn btn-primary w-md waves-effect waves-light">PO Recevie</a>
                                                    <?php } ?>
                                                    <span id="outmsg"></span>
                                                </div>
                                            </div>
                                        </form> -->
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
            <script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

<script>
    function glDetail() {

        $('#gl-desc-dis').html('');
        $('#jourl-desc-dis').html('');
        $('#item-code-dis').html('');
        $('#item-desc-dis-1').html('');
        $('#item-desc-dis-2').html('');
        $('#account-name-dis').html('');
        $('#bill-code-dis').html('');
        $('#bill-name-1-dis').html('');
        $('#bill-name-2-dis').html('');

        // $('#tr-append').html(`<tr><td colspan="8" class="text-center">Data Fetching.....</td></tr>`);
        let inc_pre = $('.inc-pre').val();
        let inc_count = $('.inc-count').val();
        // alert(inc_pre,inc_count);
        $.ajax({
            type: "post",
            url: "<?=base_url('account/getGlTranacDet')?>",
            beforeSend: function () {
                            $('#tr-append').html(`<tr><td colspan="8" class="text-center">Data Fetching.....</td></tr>`);
                        },
            data:{inc_pre,inc_count,module_type:'<?=isset($moduleType)?$moduleType:'N'?>'},
            dataType: "Json",
            success: function (response) {
                $('#tr-append').empty();
               let get_data = response.get_data;
               if(get_data.length > 0){
                let sn_count = 1;
                let tot_debit = 0;
                let tot_credit = 0;
                get_data.forEach(element => {

                            $('#tr-append').append(`
                                                <tr 
                                                    class="tr-active-cont" onClick="showGLDetail(this)" 
                                                    data-year="${element.GLAT_YEAR}" data-gldesc="${element.GLAT_DESC}" 
                                                    data-joudesc="${element.GLAT_JOURNAL_REF}" data-itemcode="${element.GLAT_ITEM}"
                                                    data-itemdesc1="${element.GLAT_ITEM_DESC1}" data-itemdesc2="${element.GLAT_ITEM_DESC2}"
                                                    data-accname="${element.GLAT_ACCOUNT_DESC}" data-biilcode="${element.GLAT_SOLDTO_CUST}"
                                                    data-billdesc1="${element.GLAT_SOLDTO_NAME1}" data-billdesc2="${element.GLAT_SOLDTO_NAME2}"
                                                    data-joupre="${element.GLAT_JOURNAL_PFX}" data-jouno="${element.GLAT_JOURNAL_NO}"
                                                    data-joudate="${element.GLAT_POSTED_DATE}" data-accar="${element.GLAT_ACCOUNT_DESC_AR}"
                                                    data-vcode="${element.GLAT_VENDOR}" data-vname1="${element.GLAT_VENDOR_NAME1}" 
                                                    data-vname2="${element.GLAT_VENDOR_NAME2}">
                                                    <td>${sn_count}</td>
                                                    <td>${element.GLAT_YEAR}</td>
                                                    <td>${element.GLAT_PERIOD}</td>
                                                    <td>${element.GLAT_ACCT_LVL1}</td>
                                                    <td>${element.GLAT_ACCT_LVL2}</td>
                                                    <td>${Number(element.GLAT_DEBIT_AMT).toLocaleString()}</td>
                                                    <td>${Number(element.GLAT_CREDIT_AMT).toLocaleString()}</td>
                                                    <td>${element.GLAT_POSTED}</td>
                                                </tr>`);
                            tot_debit += parseFloat(element.GLAT_DEBIT_AMT);
                            tot_credit += parseFloat(element.GLAT_CREDIT_AMT);
                            sn_count++;
                        });
                    $('#tr-append').append(`
                                                <tr>
                                                    <td colspan='4'></td>
                                                    <td>Total Amount</td>
                                                    <td>${Number(tot_debit).toLocaleString()}</td>
                                                    <td>${Number(tot_credit).toLocaleString()}</td>
                                                    <td></td>
                                                </tr>`);

               }else{
                    $('#tr-append').html(`<tr><td colspan="8" class="text-center">No Data Found.....</td></tr>`);
               }
            }
        });
    }
    function showGLDetail(ele) {

        let item_code = $(ele).data('itemcode')?$(ele).data('itemcode'):'';
        let item_desc_1 = $(ele).data('itemdesc1')?$(ele).data('itemdesc1'):'';
        let item_desc_2 = $(ele).data('itemdesc2')?$(ele).data('itemdesc2'):'';

        let bill_code = $(ele).data('biilcode')?$(ele).data('biilcode'):$(ele).data('vcode');
        let bill_name_1 = $(ele).data('billdesc1')?$(ele).data('billdesc1'):$(ele).data('vname1');
        let bill_name_2 = $(ele).data('billdesc2')?$(ele).data('billdesc2'):$(ele).data('vname2');
        $('.tr-active-cont').removeClass('table-success');
        $(ele).addClass('table-success');

        $('#gl-desc-dis').html($(ele).data('gldesc'));
        $('#jourl-desc-dis').html($(ele).data('joudesc'));
        $('#item-code-dis').html(item_code);
        $('#item-desc-dis-1').html(item_desc_1);
        $('#item-desc-dis-2').html(item_desc_2);
        $('#account-name-dis').html($(ele).data('accname'));
        $('#bill-code-dis').html(bill_code);
        $('#bill-name-1-dis').html(bill_name_1);
        $('#bill-name-2-dis').html(bill_name_2);
        $('#jou-date-dis').html($(ele).data('joudate'));
        $('#jou-no-dis').html($(ele).data('jouno'));
        $('#jou-pre-dis').html($(ele).data('joupre'));
        $('#acc-ar-dis').html($(ele).data('accar'));
        
    }
</script>