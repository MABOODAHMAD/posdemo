
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
                                    <h4 class="mb-sm-0 font-size-18"><?=$headerTitle?></h4>
                                    <div class="page-title-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row d-print-none">
                            <div class="mb-3 col-lg-2">
                                <label for="name">Item Code</label>
                                <!-- <div class='row'> -->
                                    <!-- <div class="col-md-3"> -->
                                        <input type="text" onInput="glDetail()" class="form-control i-code-in" placeholder="Item Code" aria-describedby="option-date">
                                    <!-- </div> -->
                                    <!-- <div class="col-md-9">
                                        <input type="text" onInput="glDetail()" class="form-control inc-count" placeholder="0001" aria-describedby="option-date">
                                    </div>
                                </div> -->
                                
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Whse Code</label>
                                <input type="text" onInput="glDetail()" class="form-control i-whse-in" placeholder="Warehouse Code" aria-describedby="option-date">
                            </div>
                            <div class="mb-3 col-lg-3">
                                <label for="name">Item Description</label>
                                <input type="text" class="form-control i-desc-dsp" placeholder="item Description" readonly>
                            </div>
                            <div class="mb-3 col-lg-3">
                                <label for="name">Item Secondary Desc</label>
                                <input type="text" class="form-control i-sec-desc-dsp" placeholder="item Secondary Description" readonly>
                            </div>
                            <div class="mb-3 col-lg-3">
                                <label for="name">Item Extended Description</label>
                                <input type="text" class="form-control i-ext-desc-dsp" placeholder="item Extended Description" readonly>
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
                                        <div class="col-xl-12 row">
                                        
                                            <h5 class="font-size-14 card-body border-bottom po-charge-hd"><i class="mdi mdi-arrow-right text-primary"></i>Item
                                                Details</h5>
                                        
                                            <div class="col-md-4">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 12%;">Item Class</td>
                                                            <td style="width: 12%;" id="i-class-dsp"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Item UOM</td>
                                                            <td style="width: 12%;" id="i-uom-dsp"></td>
                                                        </tr>
                                                        <tr>
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width: 12%;">Trans Period</th>
                                                                        <td style="width: 12%;" id="i-year-dsp"></td>
                                                                        <td style="width: 12%;" id="i-period-dsp"></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 12%;">Sale Price</td>
                                                            <td style="width: 12%;" id="i-sale-price-dis"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Allow Discount</td>
                                                            <td style="width: 12%;" id="i-allow-dis-dsp"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Max Discount</td>
                                                            <td style="width: 12%;" id="i-max-dis-dsp"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4">
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 12%;">Cost Multiplier</td>
                                                            <td style="width: 12%;" id="i-cost-multi-dis"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Taxable</td>
                                                            <td style="width: 12%;" id="i-tax-dis"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 12%;">Order Type</td>
                                                            <td style="width: 12%;" id="i-order-type-dsp"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="py-2 mt-3">
                                            <h3 class="font-size-15 fw-bold"><?=isset($moduleTitle)?$moduleTitle:''?> Item Transaction Summary</h3>
                                        </div>
                                        <div class="table-responsive">
                                        <table class="table table-hover table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th>Sn.</th>
                                                    <th>Transaction Date</th>
                                                    <th colspan="2" class="text-center">Stock Location Code & Name</th>
                                                    <th colspan="2" class="text-center">Order Number</th>
                                                    <th>Unit Cost</th>
                                                    <th>In</th>
                                                    <th>Out</th>
                                                    <th>Balance</th>
                                                    <th>Value</th>
                                                    <!--<th width="10%">Distribution Amount in SAR</th>-->
                                                    <!-- <th width="100%">Final Price</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="tr-append">
                                               <tr><td colspan="11" class="text-center"><strong>No data Found</strong><td></tr>
                                            </tbody>
                                        </table>
																		
                                        
                                            
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

        $('.i-desc-dsp').val('');
        $('#i-sec-desc-dsp').val('');
        $('#i-ext-desc-dsp').val('');
        $('#i-class-dsp').html('');
        $('#i-uom-dsp').html('');
        $('#i-year-dsp').html('');
        $('#i-period-dsp').html('');
        $('#i-sale-price-dis').html('');
        $('#i-allow-dis-dsp').html('');
        $('#i-max-dis-dsp').html('');
        $('#i-cost-multi-dis').html('');
        $('#i-tax-dis').html('');
        $('#i-order-type-dsp').html('');
        

        // $('#tr-append').html(`<tr><td colspan="8" class="text-center">Data Fetching.....</td></tr>`);
        let i_code = $('.i-code-in').val();
        let whse_code = $('.i-whse-in').val();
        // alert(inc_pre,inc_count);
        $.ajax({
            type: "post",
            url: "<?=base_url('common/getInvItemTransDet')?>",
            beforeSend: function () {
                            $('#tr-append').html(`<tr><td colspan="8" class="text-center">Data Fetching.....</td></tr>`);
                        },
            data:{i_code,whse_code},
            dataType: "Json",
            success: function (response) {
                console.log(response);
                if(response.item_detail){
                    $('.i-desc-dsp').val(response.item_detail.I_DESC);
                    $('.i-sec-desc-dsp').val(response.item_detail.I_SECONDARY_DESC);
                    $('.i-ext-desc-dsp').val(response.item_detail.I_EXTEND_DESC);
                    $('#i-class-dsp').html(response.item_detail.I_CLASS_CODE);
                    $('#i-uom-dsp').html(response.item_detail.I_UOM_CODE);
                    $('#i-sale-price-dis').html(response.item_detail.I_LIST_PRICE);
                    $('#i-allow-dis-dsp').html('Y');
                    $('#i-max-dis-dsp').html(response.item_detail.I_MAX_DISCOUNT);
                    $('#i-cost-multi-dis').html(response.item_detail.I_COST_MULTIPLIER);
                    $('#i-tax-dis').html(response.item_detail.I_FLAMMABLE);
                    $('#i-order-type-dsp').html(response.item_detail.I_TYPE);
                }
                
                $('#tr-append').empty();
               let get_data = response.trans_detail;
               if(get_data.length > 0){
                let sn_count = 1;
                let tot_debit = 0;
                let tot_credit = 0;
                let bal_count = 0;
                get_data.forEach(element => {

                    $('#i-year-dsp').html(element.IT_YEAR);
                    $('#i-period-dsp').html(element.IT_PERIOD);

                    let qtyCont = parseInt(element.IT_TRANS_QTY);
                    if(qtyCont>0){
                        bal_count = qtyCont+bal_count;
                    }else{
                        bal_count = bal_count-Math.abs(qtyCont);
                    }
                    let unit_cost = parseFloat(element.IT_UNIT_COST);
                            
                            $('#tr-append').append(`
                                                <tr 
                                                    class="tr-active-cont" onClick="showGLDetail(this)">
                                                    <td>${sn_count}</td>
                                                    <td>${element.IT_CRE_DATE}</td>
                                                    <td>${element.IT_WHSE}</td>
                                                    <td>${element.IT_WHSE_DESC}</td>
                                                    <td>${element.IT_ORDER_PFX}</td>
                                                    <td>${element.IT_ORDER_NO}</td>
                                                    <td>${unit_cost}</td>
                                                    <td class="${qtyCont>0?'table-success':''}">${qtyCont>0?Math.abs(qtyCont):''}</td>
                                                    <td class="${qtyCont<0?'table-danger':''}">${qtyCont<0?Math.abs(qtyCont):''}</td>
                                                    <td class="table-info">${Math.abs(bal_count)}</td>
                                                    <td>${unit_cost*Math.abs(bal_count)}</td>
                                                </tr>`);

                            // tot_debit += parseFloat(element.GLAT_DEBIT_AMT);
                            // tot_credit += parseFloat(element.GLAT_CREDIT_AMT);
                            sn_count++;
                        });
                    // $('#tr-append').append(`
                    //                             <tr>
                    //                                 <td colspan='4'></td>
                    //                                 <td>Total Amount</td>
                    //                                 <td>${tot_debit.toFixed(2)}</td>
                    //                                 <td>${tot_credit.toFixed(2)}</td>
                    //                                 <td></td>
                    //                             </tr>`);

               }else{
                    $('#tr-append').html(`<tr><td colspan="8" class="text-center">No Data Found.....</td></tr>`);
               }
            }
        });
    }
    function showGLDetail(ele) {

        $('.tr-active-cont').removeClass('table-success');
        $(ele).addClass('table-success');
        
    }
</script>