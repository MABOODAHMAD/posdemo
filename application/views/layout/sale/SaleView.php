
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
                                    <h4 class="mb-sm-0 font-size-18">Sale <?=$headerDet->SH_INV_PREFIX?"Invoice":"Order"?></h4>
                                    <div class="page-title-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row d-print-none">
                            <div class="mb-3 col-lg-2">
                                <label for="name">#<?=$headerDet->SH_INV_PREFIX?"Invoice":"Order"?></label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text po-pre-npr" id="option-date"><?=$headerDet->SH_INV_PREFIX?$headerDet->SH_INV_PREFIX:$headerDet->SH_ORDER_PREFIX?></span>
                                    <input type="text" class="form-control po-pre-npr-next-id" value="<?=$headerDet->SH_INV_PREFIX?$headerDet->SH_INV_NO:$headerDet->SH_ORDER_NO?>"
                                        aria-describedby="option-date" placeholder="null" disabled="true">
                                </div>
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Order Type</label>
                                <input type="text" class="form-control" value="<?=$headerDet->SH_TERM_ID == '997'?'CASH':'CREDIT'?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Order Status</label>
                                <input type="text" class="form-control" value="<?=$headerDet->SH_STATUS?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Date</label>
                                <input type="text" class="form-control" value="<?=date('d-M Y', strtotime($headerDet->SH_ORDER_DATE))?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Posted</label>
                                <input type="text" class="form-control" value="<?=$headerDet->SH_INV_PREFIX?'Y':'Y'?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-2">
                                <label for="name">Payment Status</label>
                                <input type="text" class="form-control" value="<?=$headerDet->SH_PAY_STATUS?>" disabled="true" />
                            </div>
                            <div class="mb-3 col-lg-4 d-none">
                                    <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#standard_model" onclick="payModal(this)">
                                        <i class="mdi mdi-truck-fast me-1"></i>Payment</a>
                            </div>
                            
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
                                                        <h4 class="float-end font-size-16"><?=$headerDet->SH_INV_PREFIX?"Invoice":"Order"?> #<?=$headerDet->SH_INV_PREFIX?$headerDet->SH_INV_PREFIX:$headerDet->SH_ORDER_PREFIX?>-<?=$headerDet->SH_INV_PREFIX?$headerDet->SH_INV_NO:$headerDet->SH_ORDER_NO?></h4>
                                            
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                        <div class="row">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td width="61%" style="padding: 0rem 1.25rem;">
                                                        <div class="col-sm-12 mt-3">
                                                            <address>
                                                                <strong>Billed To:</strong>
                                                            </address>
															<div style="border: #e5dfdf solid 1px;border-radius: 8px;">
															    <style>
															        .inv td{
                                                                                padding: 0.15rem 0.75rem;
                                                                                border-color: inherit;
                                                                                border-style: solid;
                                                                                border-width: 0;
                                                                            }
															    </style>
                                                            <table width="100%" cellpadding="0" cellspacing="0" class="inv">
                                                              
                                                              <tr height="20">
                                                                <td height="20" dir="RTL" align="right" width="84">&#1575;&#1604;&#1573;&#1587;&#1605;</td>
                                                                <td align="left" width="242"><?=$headerDet->CUST_NAME_AR.'-'.$headerDet->CUST_NAME?></td>
                                                                <td dir="RTL" align="right" width="161">&#1575;&#1604;&#1585;&#1602;&#1605; &#1575;&#1604;&#1590;&#1585;&#1610;&#1576;&#1610; &#1604;&#1604;&#1593;&#1605;&#1610;&#1604;</td>
                                                                <td align="left" width="172"><?=$headerDet->CUST_TAX_EXEMPT_ID?></td>
                                                              </tr>
                                                              
                                                              <tr height="20">
                                                                <td height="20" dir="RTL" align="right">&#1575;&#1604;&#1588;&#1575;&#1585;&#1593;</td>
                                                                <td align="left"><?=$headerDet->CUST_STR_ADDR1?></td>
                                                                <td dir="RTL" align="right">&#1578;&#1610;&#1604;&#1610;&#1601;&#1608;&#1606;</td>
                                                                <td align="left"><?=$headerDet->CUST_PHONE1?></td>
                                                              </tr>
                                                              
                                                              <tr height="20">
                                                                <td height="20" dir="RTL" align="right">&#1589;-&#1575;&#1604;&#1576;&#1585;&#1610;&#1583;</td>
                                                                <td align="left"><?=$headerDet->CUST_POSTAL_CODE_ID?></td>
                                                                <td dir="RTL" align="right">&#1580;&#1608;&#1575;&#1604;</td>
                                                                <td align="left"><?=$headerDet->CUST_PHONE2?></td>
                                                              </tr>
                                                              
                                                              <tr height="20">
                                                                <td height="20" dir="RTL" align="right">&#1586;-&#1576;&#1585;&#1610;&#1583;&#1610;</td>
                                                                <td align="left"><?=$headerDet->CUST_POSTAL_CODE_ID?>&nbsp;</td>
                                                                <td dir="RTL" align="right">&#1585;&#1602;&#1605; &#1575;&#1604;&#1576;&#1591;&#1575;&#1602;&#1577;</td>
                                                                <td align="left"><!--Card No --><?=$headerDet->CUST_EDI1?></td>
                                                              </tr>
                                                              
                                                              <tr height="20">
                                                                <td height="20" dir="RTL" align="right">&#1575;&#1604;&#1605;&#1583;&#1610;&#1606;&#1577;</td>
                                                                <td align="left"><?=$headerDet->CTY_NAME?></td>
                                                                <td dir="RTL" align="right">&#1575;&#1604;&#1576;&#1585;&#1610;&#1583; &#1575;&#1604;&#1573;&#1603;&#1578;&#1585;&#1608;&#1606;&#1610;</td>
                                                                <td align="left"><?=$headerDet->CUST_E_MAIL1?></td>
                                                              </tr>
                                                            </table>
                                                           </div>
                                                            
                                                      </div>
                                                  </td>
                                        
                                                    <td width="39%" align="right" style="padding: 0rem 1.25rem;">
                                                        <div class="col-sm-12 mt-3 text-sm-end">
                                                            <address>
                                                                <strong>Shipped To:</strong>
                                                            </address>
                                                            <div style="border: #e5dfdf solid 1px; border-radius: 8px;"> 
                                                            <table width="100%" cellpadding="0" cellspacing="0" class="inv">
                                                             
                                                              <tr height="20">
                                                                <td height="20" dir="RTL" align="right" width="126">&#1585;&#1602;&#1605;    &#1575;&#1604;&#1587;&#1580;&#1604; &#1575;&#1604;&#1578;&#1580;&#1575;&#1585;&#1609;</td>
                                                                <td align="left" width="295">C.R. No / &#1585;&#1602;&#1605; &#1575;&#1604;&#1585;&#1582;&#1589;:  Licence No</td>
                                                              </tr>
                                                              
                                                              <tr height="20">
                                                                <td height="20" dir="RTL" align="right">&#1575;&#1604;&#1585;&#1602;&#1605; &#1575;&#1604;&#1590;&#1585; &#1610;&#1576;&#1609;</td>
                                                                <td align="left">300232189200003</td>
                                                              </tr>
                                                              
                                                              <tr height="20">
                                                                <td height="20" dir="RTL" align="right">&#1585;&#1602;&#1605; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1577;</td>
                                                                <td align="left"><?=$headerDet->SH_INV_PREFIX?$headerDet->SH_INV_PREFIX:$headerDet->SH_ORDER_PREFIX?>-<?=$headerDet->SH_INV_PREFIX?$headerDet->SH_INV_NO:$headerDet->SH_ORDER_NO?></td>
                                                              </tr>
                                                              
                                                              <tr height="20">
                                                                <td height="20" dir="RTL" align="right">&#1606;&#1608;&#1593; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1577;</td>
                                                                <td align="left"><?=$headerDet->SH_TERM_ID == '997'?'CASH':'CREDIT'?></td>
                                                              </tr>
                                                              
                                                              <tr height="20">
                                                                <td height="20" dir="RTL" align="right">&#1578;&#1575;&#1585;&#1610;&#1582; &#1575;&#1604;&#1601;&#1575;&#1578;&#1608;&#1585;&#1607;</td>
                                                                <td align="left"><?=date('d-M Y', strtotime($headerDet->SH_ORDER_DATE))?></td>
                                                              </tr>
                                                            </table>
                                                            </div>
                                                            
                                                      </div>
                                                  </td>
                                                </tr>
                                            </table>
                                        </div>
 
 
                                        
                                        <div class="py-2 mt-3">
                                            <h3 class="font-size-15 fw-bold">Order Summary</h3>
                                        </div>
                                        <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th width="2%">Sn.</th>
                                                    <th width="8%">رقم القطعه</th>
                                                    <th width="15%">وصف القطعة</th>
                                                    <th width="2%">الوحدة</th>
                                                    <th width="2%">الكمية</th>
                                                    <th width="15%">السعر القطعة</th>
                                                    <th width="15%">Total Discount</th>
                                                    <th width="15%">السعر بعد الخصم</th>
                                                    <th width="15%">نسبة الضريبه</th>
                                                    <th width="15%">المبلغ شامل الضريبة بالريال</th>
                                                    <!--<th width="10%">Distribution Amount in SAR</th>-->
                                                    <!-- <th width="100%">Final Price</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sn = 1; foreach ($detailsLists as $poItemDet): ?>
                                                <tr>
                                                    <td width="2%"><?=$sn?></td>
                                                    <td width="8%"><img src="<?=base_url('uploads/images/item/').$poItemDet->I_IMAGE_FILENAME?>" alt="product-img" title="product-img" class="avatar-md"> <?=$poItemDet->SD_ITEM_CODE?></td>
                                                    <td width="15%">
                                                        <?=$poItemDet->I_DESC?><br>
                                                        <?=$poItemDet->I_EXTEND_DESC?>                                                    </td>
                                                    <td width="2%">&nbsp;</td>
                                                    <td width="2%"><?=numberSystem($poItemDet->SD_QTY,2)?></td>
                                                    <td width="15%"><?=sysCur().' '.numberSystem($poItemDet->SD_SALE_PRICE)?></td>
                                                    <td width="15%"><?=sysCur().' '.numberSystem($poItemDet->SD_DIST_AMT)?></td>
                                                    <td width="15%"><?=sysCur().' '.numberSystem($poItemDet->SO_SUB_TOT)?></td>
                                                    <td width="15%"><?=sysCur().' '.numberSystem($poItemDet->SO_VAT_AMT)?></td>
                                                    <td width="15%"><?=sysCur().' '.numberSystem((($poItemDet->SO_SUB_TOT-$poItemDet->SD_DIST_AMT)+($poItemDet->SO_VAT_AMT)))?></td>
                                                </tr>
                                                <?php $sn++; endforeach; ?>
                                            </tbody>
                                        </table>
																		
                                        <div class="col-xl-12 row">
                                        
                                            <h5 class="font-size-14 card-body border-bottom po-charge-hd"><i class="mdi mdi-arrow-right text-primary"></i>تفاصيل الدفع</h5>
                                        
                                            <div class="col-md-6">
                                        
                                                
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered <?=$headerDet->SH_SALE_TYPE == 'CASH'?'':'d-none'?>">
                                                    <tbody>
                                                        <?php $pochrgTot = 0; foreach ($payDets as $payDet): ?>
                                                        <tr>
                                                            <td style="width: 12%;"><?=$payDet->PM_DESC?></td>
                                                            <td style="width: 12%;"><?=sysCur().' '.numberSystem($payDet->PD_AMOUNT)?></td>
                                                        </tr>
                                                        <?php $pochrgTot += $payDet->PD_AMOUNT; endforeach; ?>
                                                        <tr>
                                                            <td colspan="3" style="width: 12%;text-align: right;padding-right: 132px;"><?="المبلغ الإجمالي= ".sysCur().' '.numberSystem($pochrgTot)?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                
                                                    <img src="<?=$qr_image?>" alt="" class="rounded avatar-lg" style="width:13rem;height:13rem;">
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <table width="100%" class="table table-bordered">
                                                    <tbody>
                                        
                                                        <tr>
                                                            <td width="60%" align="right"><b>Total Qty:</b> </td>
                                                            <td width="40%" align="left"><span id="tot-qty"><?=numberSystem($headerDet->SH_TOT_QTY,2)?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="60%" align="right"><b>Subtol(Discount Excluded)</b> </td>
                                                            <td width="40%" align="left"><?=sysCur().' '.numberSystem($headerDet->SH_SUB_TOT)?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="60%" align="right"><b>Total discount:</b> </td>
                                                            <td width="40%" align="left"><?=sysCur().' '.numberSystem($headerDet->SH_TOT_DISCOUNT)?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="60%" align="right"><b>Subtol(VAT Excluded with Discount Included):</b> </td>
                                                            <td width="40%" align="left"><?=sysCur()?> <?=numberSystem($headerDet->SH_SUB_TOT-$headerDet->SH_TOT_DISCOUNT)?></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="60%" align="right"><b>Total VAT</b> </td>
                                                            <td width="40%" align="left"><?=sysCur()?> <?=numberSystem($headerDet->SH_TOT_VAT)?></td>
                                                        </tr>
                                                        <!-- strt -->
                                                        <tr>
                                                            <td width="60%" align="right"><b>Subtol(VAT Included):</b> </td>
                                                            <td width="40%" align="left"><?=sysCur()?> <?=numberSystem(round(($headerDet->SH_SUB_TOT-$headerDet->SH_TOT_DISCOUNT)+$headerDet->SH_TOT_VAT))?></td>
                                                        </tr>
                                                        <!-- end -->
                                                        <!-- <tr style="display:none;"> -->
                                                        <tr>
                                                            <td width="60%" align="right"><b>Grand Total:</b> </td>
                                                            <td width="40%" align="left" style="    font-size: 0.7cm;    font-weight: bold;"><span
                                                                    id="curt-cur-abbre-grnd-tot"><?=sysCur()?></span> <span
                                                                    id="grand-tot"><?=numberSystem($headerDet->SH_GRAND_TOT)?></span> </td>
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