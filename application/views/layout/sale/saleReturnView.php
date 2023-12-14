
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
                                    <h4 class="mb-sm-0 font-size-18">Sale Return Detail</h4>
                                    <div class="page-title-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row d-print-none">
                            <div class="mb-3 col-lg-2">
                                <label for="name">#Invoice</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text po-pre-npr" id="option-date"><?=$headerDet->RH_INV_PREFIX?></span>
                                    <input type="text" class="form-control po-pre-npr-next-id" value="<?=$headerDet->RH_INV_NO?>"
                                        aria-describedby="option-date" placeholder="null" disabled="true">
                                </div>
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Order Type</label>
                                <input type="text" class="form-control" value="<?='CASH'?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Order Status</label>
                                <input type="text" class="form-control" value="<?=$headerDet->RH_STATUS_ORDER == 'RECEIVED'?'CLOSE':'OPEN'?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Date</label>
                                <input type="text" class="form-control" value="<?=date('d-M Y', strtotime($headerDet->RH_DATE))?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Posted</label>
                                <input type="text" class="form-control" value="<?=$headerDet->RH_STATUS_ORDER == 'RECEIVED'?'Y':'Y'?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Payment Status</label>
                                <input type="text" class="form-control" value="<?=$headerDet->RH_STATUS?>" disabled="true" />
                            </div>
                            <!-- <div class="mb-3 col-lg-4">
                                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#standard_model" onclick="payModal(this)">
                                        <i class="mdi mdi-truck-fast me-1"></i>Payment</a>
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
                                                        <h4 class="float-end font-size-16"><?=$headerDet->RH_STATUS_ORDER == 'RECEIVED'?"Invoice":"Order"?> #<?=$headerDet->RH_INV_PREFIX?>-<?=$headerDet->RH_INV_NO?></h4>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <div class="row">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td width="50%" style="padding: 0rem 1.25rem;">
                                                        <div class="col-sm-12 mt-3">
                                                            <address>
                                                                <strong>Billed To:</strong><br>
                                                                <?=$headerDet->CUST_NAME?><br>
                                                                <?=$headerDet->CUST_NAME_AR?><br>
                                                                <?=$headerDet->CUST_STR_ADDR1?><br>
                                                                <?=$headerDet->CUST_POSTAL_CODE_ID?><br>
                                                                <?=$headerDet->CNTRY_NAME.' ,'.$headerDet->ST_NAME.' ,'.$headerDet->CTY_NAME?>
                                                            </address>
                                                        </div>
                                                    </td>
                                        
                                                    <td width="50%" align="right" style="padding: 0rem 1.25rem;">
                                                        <div class="col-sm-12 mt-3 text-sm-end">
                                                            <address>
                                                                <strong>Shipped To:</strong><br>
                                                                <?=$busUnit->BU_NAME1?><br>
                                                                <?=$busUnit->BU_NAME2?><br>
                                                                <?=$busUnit->BU_STR_ADDR1?><br>
                                                                <?=$busUnit->BU_POSTAL_CODE?><br>
                                                                <?=$busUnit->CNTRY_NAME.' ,'.$busUnit->ST_NAME.' ,'.$busUnit->CTY_NAME?>

                                                            </address>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
 
 
                                        
                                        <div class="py-2 mt-3">
                                            <h3 class="font-size-15 fw-bold">Order summary</h3>
                                        </div>
                                        <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th width="2%">Sn.</th>
                                                    <th width="8%">Item No</th>
                                                    <th width="15%">Description</th>
                                                    <th width="2%">Qty</th>
                                                    <th width="15%">Sale Price</th>
                                                    <th width="15%">Total Discount</th>
                                                    <th width="15%">Sub Total(VAT Excluding)</th>
                                                    <th width="15%">Total VAT</th>
                                                    <th width="15%">Sub Total(VAT Included)</th>
                                                    <!--<th width="10%">Distribution Amount in SAR</th>-->
                                                    <!-- <th width="100%">Final Price</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sn = 1; foreach ($detailsLists as $poItemDet): ?>
                                                <tr>
                                                    <td width="2%"><?=$sn?></td>
                                                    <td width="8%"><?=$poItemDet->RD_ITEM_CODE?></td>
                                                    <td width="15%">
                                                        <?=$poItemDet->I_DESC?><br>
                                                        <?=$poItemDet->I_EXTEND_DESC?>
                                                    </td>
                                                    <td width="2%"><?=numberSystem($poItemDet->RD_QTY,2)?></td>
                                                    <td width="15%"><?=sysCur().' '.numberSystem($poItemDet->RD_SALE_PRICE)?></td>
                                                    <td width="15%"><?=sysCur().' '.numberSystem($poItemDet->RD_DIST_AMT)?></td>
                                                    <td width="15%"><?=sysCur().' '.numberSystem($poItemDet->RD_SUB_TOT)?></td>
                                                    <td width="15%"><?=sysCur().' '.numberSystem($poItemDet->RD_VAT_AMT)?></td>
                                                    <td width="15%"><?=sysCur().' '.numberSystem((($poItemDet->RD_SUB_TOT-$poItemDet->RD_DIST_AMT)+($poItemDet->RD_VAT_AMT)))?></td>
                                                </tr>
                                                <?php $sn++; endforeach; ?>
                                            </tbody>
                                        </table>
																		
                                        <div class="col-xl-12 row">
                                        
                                            <h5 class="font-size-14 card-body border-bottom po-charge-hd"><i class="mdi mdi-arrow-right text-primary"></i>Payment
                                                Details</h5>
                                        
                                            <div class="col-md-6">
                                        
                                        
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered">
                                                    <tbody>
                                                        <?php $pochrgTot = 0; foreach ($payDets as $payDet): ?>
                                                        <tr>
                                                            <td style="width: 12%;"><?=$payDet->PM_DESC?></td>
                                                            <td style="width: 12%;"><?=sysCur().' '.numberSystem($payDet->PD_AMOUNT)?></td>
                                                        </tr>
                                                        <?php $pochrgTot += $payDet->PD_AMOUNT; endforeach; ?>
                                                        <tr>
                                                            <td colspan="3" style="width: 12%;text-align: right;padding-right: 132px;"><?="Total = ".sysCur().' '.numberSystem($pochrgTot)?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table width="100%" class="table table-bordered">
                                                    <tbody>
                                        
                                                        <tr>
                                                            <td width="60%" align="right"><b>Total Qty:</b> </td>
                                                            <td width="40%" align="left"><span id="tot-qty"><?=numberSystem($headerDet->RH_TOT_QTY,2)?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="60%" align="right"><b>Total discount:</b> </td>
                                                            <td width="40%" align="left"><?=sysCur().' '.numberSystem($headerDet->RH_TOT_DISC)?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="60%" align="right"><b>Subtol(VAT Excluded):</b> </td>
                                                            <td width="40%" align="left"><?=sysCur()?> <?=numberSystem($headerDet->RH_SUB_TOT-$headerDet->RH_TOT_DISC)?></td>
                                                        </tr>
                                                        <!-- strt -->
                                                        <tr>
                                                            <td width="60%" align="right"><b>Subtol(VAT Included):</b> </td>
                                                            <td width="40%" align="left"><?=sysCur()?> <?=numberSystem(($headerDet->RH_SUB_TOT-$headerDet->RH_TOT_DISC)+$headerDet->RH_TOT_VAT)?></td>
                                                        </tr>
                                                        <!-- end -->
                                                        <!-- <tr style="display:none;"> -->
                                                        <tr>
                                                            <td width="60%" align="right"><b>Grand Total:</b> </td>
                                                            <td width="40%" align="left" style="    font-size: 0.7cm;    font-weight: bold;"><span
                                                                    id="curt-cur-abbre-grnd-tot"><?=sysCur()?></span> <span
                                                                    id="grand-tot"><?=numberSystem($headerDet->RH_GRAND_TOT)?></span> </td>
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
                /*================================ Payment Modal ==============================*/
                
                function payModal(ele) {
                    
                    $('.st_model_send').addClass('d-none');
                    $('.st_model_head').html(`Payment`);
                    $('.st_model_body').html(`<div class="p-4 border">
                                                                <form id="formdata">
                                                                    <div class="form-group mb-0">
                                                                        <label for="cardnumberInput">Outstanding Amount</label>
                                                                        <input type="text" class="form-control" value="<?=sysCur()?> <?=$headerDet->SH_PAID_AMT?$headerDet->SH_GRAND_TOT-$headerDet->SH_PAID_AMT:$headerDet->SH_GRAND_TOT?>">
                                                                    </div>
                                                                    <div class="row">
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
                                                                        <input type="hidden" name="order_id_db" value="<?=$headerDet->SH_ORDER_ID?>">
                                                                        <input type="hidden" name="SH_CUST_ID" value="<?=$headerDet->SH_CUST_ID?>">
                                                                        <button data-control="payment/sale-payment-add" data-form="formdata" class="ajaxform pay-button btn btn-primary waves-effect waves-light" type="submit" disabled="true">Add Payment</button>
                                                                    </div>
                                                                        <span id="outmsg"></span>
                                                                </form>

                                                            </div>`);
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
                                    $(ele).closest('tr').find('td #po-charge-desc-dis').html('');
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

                    function poChargeCal() {

                    let tot_po_charge = 0;
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
                            console.log( '[' +tr_idx+ ',' +td_idx+ '] => ' + $(td).text());
                        }); 
                        $('#tot-po-charge').html(tot_po_charge.toFixed(4));
                        $('#main-tot-pay-dsp').html(tot_po_charge.toFixed(4));
                        
                    });
                    let out_amt = parseFloat('<?=$headerDet->SH_GRAND_TOT?>');
                        if (out_amt >= parseFloat(tot_po_charge)) {
                            if (parseFloat(tot_po_charge)>0) {
                                $('.pay-button').prop('disabled',"");
                            }else{
                                $('.pay-button').prop('disabled',"true");
                            }
                        }else{
                            $('.pay-button').prop('disabled',"true");
                            Swal.fire({
                                title: "Payment alert",
                                text: "Payment not Add more than outstanding amount confirm again then submit",
                                icon: "error",
                                confirmButtonColor: "#556ee6"
                            });
                        }
                    // tableCalculation();
                    }
                
                // function nprFetch(data_in) {
                //     $.ajax({
                //             type: "POST",
                //             url: "<?=base_url('Common/getPoPrefix')?>",
                //             data: {pre_type:data_in},
                //             dataType: "Json",
                //             success: function(resultData){
                              
                //                 $('.po-pre-npr').html(resultData[0]['POP_ORDER_PFX']);
                //                 $('.po-pre-npr-next-id').val(resultData[0]['POP_NEXT_NUMBER']);
                //         }
                //     });
                // }
                // setInterval(function(){ 
                //     nprFetch('NPR'); 
                // },500);
                // nprFetch('NPR');
            </script>