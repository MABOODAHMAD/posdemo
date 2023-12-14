
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
                                    <h4 class="mb-sm-0 font-size-18">Purchase Order</h4>
                                    <div class="page-title-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row d-print-none">
                            <div class="mb-3 col-lg-2">
                                <label for="name">#</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text po-pre-npr" id="option-date"><?=$clearanceDet->CPO_ORDER_PFX?></span>
                                    <input type="text" class="form-control po-pre-npr-next-id" value="<?=$clearanceDet->CPO_ORDER_ID?>"
                                        aria-describedby="option-date" placeholder="null" disabled="true">
                                </div>
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Clearance #</label>
                                <input type="text" class="form-control" value="<?=$clearanceDet->CPO_CL_NO?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Period</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="option-date"><?=$clearanceDet->INV_PERIOD?></span>
                                    <input type="text" class="form-control" value="<?=$clearanceDet->INV_YEAR?>"
                                        aria-describedby="option-date" placeholder="null" disabled="true">
                                </div>
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Date</label>
                                <input type="text" class="form-control" value="<?=$clearanceDet->INV_DATE?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Posted</label>
                                <input type="text" class="form-control" value="<?=$clearanceDet->INV_POSTED?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">#</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text clear-period-dsp" id="option-date"><?=$clearanceDet->CPO_ORDER_PFX?></span>
                                    <input type="text" class="form-control clear-year-dsp" value="<?=$clearanceDet->CPO_ORDER_ID?>"
                                        aria-describedby="option-date" placeholder="null" disabled="true">
                                </div>
                            </div>
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
                                                        <h4 class="float-end font-size-16">Order #<?=$orderId?></h4>
                                            
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                       
                                        <div class="row">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        
                                            <tr>
                                                <td width="25%" style="padding: 0rem 1.25rem;"><strong>Vendor</strong><br><?=$headerDet->V_CODE?></td>
                                                <td width="25%" align="right" style="padding: 0rem 1.25rem;">&nbsp;</td>
                                                <td width="25%" align="right" style="padding: 0rem 1.25rem;"><strong>Required Date</strong><br> October 16, 2019
                                                </td>
                                                <td width="25%" align="right" style="padding: 0rem 1.25rem;"><strong>Order Date:</strong><br><?=date('d-M Y', strtotime($headerDet->POH_ORDER_DATE))?>
                                                </td>
                                            </tr>
                                        
                                            <tr>
                                                <td style="padding: 0rem 1.25rem;">
                                                    <strong>Ship via</strong><br>
                                                    <?= $headerDet->SHIPV_DESC ?>
                                                </td>
                                                <td align="right" style="padding: 0rem 1.25rem;"><strong>Freight</strong><br>
                                                    <?= $headerDet->FRT_DESC ?>
                                                </td>
                                                <td align="right" style="padding: 0rem 1.25rem;"><strong>Terms</strong><br>
                                                <?=$headerDet->TERM_DESC?></td>
                                                <td align="right" style="padding: 0rem 1.25rem;"><strong>FOB</strong><br>
                                                <?=$headerDet->FOB_DESC?> </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0rem 1.25rem;"><strong>Buyer</strong></td>
                                                <td align="right" style="padding: 0rem 1.25rem;"><strong>Currency-Exchange Rate</strong><br>
                                                <?=$headerDet->CUR_ABBRV.'-'.$headerDet->EXCHR_BUY_RATE?></td>
                                                <td align="right" style="padding: 0rem 1.25rem;"><strong>Approved By </strong></td>
                                                <td align="right" style="padding: 0rem 1.25rem;">&nbsp;</td>
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
                                                                <?=$headerDet->V_NAME?><br>
                                                                <?=$headerDet->V_NAME_AR?><br>
                                                                <?=$headerDet->BUILDING_NO?><br>
                                                                <?=$headerDet->STREET?><br>
                                                                <?=$headerDet->FULL_ADDRESS?></br>
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
                                                    <th width="15%">Vendor unit Price</th>
                                                    <th width="15%">Distribution unit Amount</th>
                                                    <th width="15%">Final unit Price</th>
                                                    <th width="15%">Sub Total(PO Charge Included)</th>
                                                    <!--<th width="10%">Distribution Amount in SAR</th>-->
                                                    <!-- <th width="100%">Final Price</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $itemSubTot = 0; $sn = 1; foreach ($poItemDets as $poItemDet): ?>
                                                <tr>
                                                    <td width="2%"><?=$sn?></td>
                                                    <td width="8%"><?=$poItemDet['POD_ITEM_CODE']?></td>
                                                    <td width="15%">
                                                        <?=$poItemDet['I_DESC']?><br>
                                                        <?=$poItemDet['I_EXTEND_DESC']?>
                                                    </td>
                                                    <td width="2%"><?=numberSystem($poItemDet['POD_ITEM_QTY'],2)?></td>
                                                    <td width="15%"><?=$headerDet->CUR_ABBRV.' '.numberSystem($poItemDet['POD_ITEM_PRICE'])?></td>
                                                    <td width="15%"><?=$headerDet->CUR_ABBRV.' '.numberSystem($poItemDet['POD_DISTRIBUTION_AMT'])?></td>
                                                    <td width="15%"><?=$headerDet->CUR_ABBRV.' '.numberSystem($poItemDet['POD_UNIT_COST'])?></td>
                                                    <td width="15%"><?=$headerDet->CUR_ABBRV.' '.numberSystem($poItemDet['POD_UNIT_COST']*$poItemDet['POD_ITEM_QTY'])?></td>
                                                </tr>
                                                <?php $itemSubTot += $poItemDet['POD_ITEM_PRICE']*$poItemDet['POD_ITEM_QTY'];  $sn++; endforeach; ?>
                                            </tbody>
                                        </table>
																		
                                        <div class="col-xl-12 row">
                                        
                                            <h5 class="font-size-14 card-body border-bottom po-charge-hd"><i class="mdi mdi-arrow-right text-primary"></i>PO
                                                Charges</h5>
                                        
                                            <div class="col-md-6">
                                        
                                        
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered po-charge-table">
                                                    <tbody>
                                                        <?php $pochrgTot = 0; foreach ($poCharges as $poCharge): ?>
                                                        <tr>
                                                            <td style="width: 12%;"><?=$poCharge['CHRG_TYPE']?></td>
                                                            <td style="width: 12%;"><?=$poCharge['CHRG_DESC']?></td>
                                                            <td style="width: 12%;"><?=$headerDet->CUR_ABBRV.' '.numberSystem($poCharge['PODC_PO_CHARGE_AMT'])?></td>
                                                        </tr>
                                                        <?php $pochrgTot += $poCharge['PODC_PO_CHARGE_AMT']; endforeach; ?>
                                                        <tr>
                                                            <td colspan="3" style="width: 12%;text-align: right;padding-right: 132px;"><?="Total = ".$headerDet->CUR_ABBRV.' '.numberSystem($pochrgTot)?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table width="100%" class="table table-bordered">
                                                    <tbody>
                                        
                                                        <tr>
                                                            <td width="60%" align="right"><b>Total Qty:</b> </td>
                                                            <td width="40%" align="left"><span id="tot-qty"><?=numberSystem($headerDet->POH_TOT_QTY)?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="60%" align="right"><b>Subtol(PO charge Excluded):</b> </td>
                                                            <td width="40%" align="left"><?= $headerDet->CUR_ABBRV . ' ' .numberSystem($itemSubTot)?></td>
                                                        </tr>
                                                        <!-- strt -->
                                                        <tr>
                                                            <td width="60%" align="right"><b>PO Charges:</b> </td>
                                                            <td width="40%" align="left"><?= $headerDet->CUR_ABBRV . ' '.numberSystem($headerDet->POH_PO_CHARG_TOT)?></td>
                                                        </tr>
                                                        <!-- end -->
                                                        <!-- <tr style="display:none;"> -->
                                                        <tr>
                                                            <td width="60%" align="right"><b>Grand Total:</b> </td>
                                                            <td width="40%" align="left" style="    font-size: 0.7cm;    font-weight: bold;"><span
                                                                    id="curt-cur-abbre-grnd-tot"><?= $headerDet->CUR_ABBRV ?></span> <span
                                                                    id="grand-tot"><?=numberSystem($headerDet->POH_GRAND_TOTAL)?></span> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                            
                                        </div>
                                        <form id="form-data">
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <input type="hidden" name="order_id_db" value="<?=$orderId?>">
                                                    <input type="hidden" name="clearance_db" value="<?=$clearanceDet->CPO_CL_NO?>">
                                                    <input type="hidden" name="vendor_code_db" value="<?=$headerDet->V_CODE?>">
                                                    <input type="hidden" name="POH_ORDER_DATE" value="<?=$headerDet->POH_ORDER_DATE?>">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                                    <?php if(dashRole(["role_check"=>"PURCHASE_ORDER_RECEIVED"])){
                                                            if ($clearanceDet->INV_POSTED == 'N') { ?>
                                                                <a data-control="purchase/purchase-recevied" data-form="form-data" data-sweetalert="<?=$sweetAlertMsg->purRev->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->purRev->cont?>" data-aftreload="true" class="ajaxform btn btn-primary w-md waves-effect waves-light">PO Recevie</a>
                                                    <?php } }?>
                                                    <span id="outmsg"></span>
                                                </div>
                                            </div>
                                        </form>
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
            
            <script>
                function nprFetch(data_in) {
                    $.ajax({
                            type: "POST",
                            url: "<?=base_url('Common/getPoPrefix')?>",
                            data: {pre_type:data_in},
                            dataType: "Json",
                            success: function(resultData){
                              
                                $('.po-pre-npr').html(resultData[0]['POP_ORDER_PFX']);
                                $('.po-pre-npr-next-id').val(resultData[0]['POP_NEXT_NUMBER']);
                        }
                    });
                }
                // setInterval(function(){ 
                //     nprFetch('NPR'); 
                // },500);
                <?php if($clearanceDet->CPO_ORDER_PFX == 'NPO'){ ?>
                    <?php if($clearanceDet->INV_POSTED == 'N'){ ?>
                    nprFetch('NPR');
                <?php }}else{ ?>
                    nprFetch('CPR');
                <?php }?>
            </script>