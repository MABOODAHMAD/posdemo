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
                                    <h4 class="mb-sm-0 font-size-18">Sale Order</h4>
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
                                            <h5 class="mb-0 card-title flex-grow-1">Add New Sale</h5>
                                            <div class="flex-shrink-0">
                                                <a href="<?= base_Url('SaleList') ?>" class="btn btn-primary" >View Sale List</a>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">Warehouse</label>
                                                                <select name="SH_WHSE_CODE" class="form-control select2 whse-id-in" onchange="whseIn(this,'main_whse')">
                                                                    <option value='' Selected disabled>Select</option>
                                                                    <?php foreach ($whareDets as $whareDet):
                                                                        if (strlen($whareDet->WHSE_CODE) == 2) { 
                                                                            if($sesData->USER_TYPE == 'SUPERADMIN'){ ?>
                                                                                <option value="<?=$whareDet->WHSE_CODE?>" orderCount="<?=$whareDet->WHSE_ORDER_COUNT?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                            <?php }elseif ($sesData->USER_TYPE == 'USER') { 
                                                                                    foreach ($whse_assign as $whseGet):
                                                                                        if($whseGet->SMSW_WHSE_CODE == $whareDet->WHSE_CODE){
                                                                            ?>

                                                                            <option value="<?=$whareDet->WHSE_CODE?>" orderCount="<?=$whareDet->WHSE_ORDER_COUNT?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                        <?php } endforeach; } }endforeach; ?>
                                                                </select>
                                                                <label id="SH_WHSE_CODE-error" class="error"></label>
                                                        </div>
                                                    </div>     
                                                                                                
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <label for="validationCustom03" class="form-label">Type</label>
                                                            <?php if(dashRole(["role_check"=>"SALE_CASH"])){?>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <div class="form-check mb-3">
                                                                        <input class="form-check-input" type="radio" name="formRadios" value="cash" id="formRadios1" checked="" onclick="invoiceType(this)">
                                                                        <label class="form-check-label" for="formRadios1">
                                                                            Cash
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php } ?>
                                                            <?php if(dashRole(["role_check"=>"SALE_CREDIT"])){?>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <div class="form-check mb-3">
                                                                        <input class="form-check-input" type="radio" name="formRadios" value="credit" id="formRadios2" onclick="invoiceType(this)">
                                                                        <label class="form-check-label" for="formRadios2">
                                                                            Credit
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php } ?>
                                                            <label id="V_NAME-error" class="error"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-8 mb-3">
                                                                <label for="validationCustom03" class="form-label">Sale To </label>
                                                                <input type="text" class="form-control" id="cust-val-q" onInput="custSearchIn(this.value)" placeholder="Enter Customer Name" disabled>
                                                                <input type="hidden" name="SH_CUST_ID" id="vendor-code-db">
                                                                <label id="SH_CUST_ID-error" class="error"></label>
                                                            </div>
                                                            <div class="col-md-4 my-4">
                                                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fas fa-user-plus"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-2">
                                                        <div class="mb-2">
                                                            <label for="validationCustom03" class="form-label">sd</label>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                        <div class="mb-3">
                                                            
                                                            <label for="validationCustom03" class="form-label">Order No</label>
                                                                <input type="text" class="form-control order-type-val" disabled="true">
                                                                <label id="POH_CLASS-error" class="error"></label>
                                                        </div>
                                                        </div>
                                                            <div class="col-md-8">
                                                        <div class="mb-3">
                                                            
                                                            <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                <input type="text" class="form-control order-no-val" disabled="true">
                                                                <label id="POH_CLASS-error" class="error"></label>
                                                        </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">Salesman</label>
                                                                    <input type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                    <input type="text" class="form-control" name="SH_SALESMAN_ID" value="01-test" readonly>
                                                                    <label id="SH_SALESMAN_ID-error" class="error"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">Search Salesman</label>
                                                            <input type="text" class="form-control" id="employe-code-search">
                                                            <input type="hidden" name="SH_SALESMAN_ID" id="salesman-code-db">
                                                            <label id="SH_SALESMAN_ID-error" class="error"></label>
                                                        </div>
                                                    </div>
                                                        
                                                    <div class="col-md-4">
                                                        <table>
                                                            <tr>
                                                                <td>Customer Code</td>
                                                                <td id="v-code"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Customer Name</td>
                                                                <td id="v-name"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Customer Contact</td>
                                                                <td id="v-contact"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">Order Date</label>
                                                                    <input class="form-control" type="date" name="SH_ORDER_DATE" value="<?=date('Y-m-d')?>" 
                                                                    <?=dashRole(["role_check"=>"SALE_ORDER_DATE"])?NULL:"readonly"?>>
                                                                <label id="SH_ORDER_DATE-error" class="error"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                            
                                                            <div class="mb-3">
                                                                        <label for="validationCustom03" class="form-label">Currency</label>
                                                                        <input type="text" class="form-control" onInput="curExtRate(this.value,2)" placeholder="SAR" readonly>
                                                                        <input type="hidden" name="POH_CUR_EXCH_ID" id="cur-exch-id-db">
                                                                        <label id="POH_CUR_EXCH_ID-error" class="error"></label>
                                                                    <span class="text-muted cur-pri-lis-exch-rate-dis"></span>
                                                                    </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Due Date</label>
                                                                        <input class="form-control" type="date" name="SH_DUE_DATE" value="<?= date('Y-m-d') ?>" <?=dashRole(["role_check"=>"SALE_ORDER_DATE"])?NULL:"readonly"?>>
                                                                    <label id="SH_DUE_DATE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Status</label>
                                                                    <input class="form-control" type="text" value="OPEN">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Terms</label>
                                                                <input type="text" class="form-control term-in-val" onInput="termIn(this)" readonly>
                                                                <input type="hidden" name="SH_TERM_ID" id="term-db">
                                                                <label id="SH_TERM_ID-error" class="error"></label>
                                                                <label id="term-in"></label>
                                                            </div>
                                                        </div>
                                                </div>
                                                        
                                                        
                                                        
                                                        
                                                        <div class="d-none item-line-table-dis">
                                                            <h5 class="font-size-14 card-body border-bottom"><i class="mdi mdi-arrow-right text-primary"></i> Item Line</h5>
                                                            <div class="col-xl-12">
                                                                <div class="form-row">
                                                                    <div style="overflow-x:auto; overflow-y:hidden; /* white-space:nowrap; */ margin:0 10px;" class="ftable col-md-12">
                                                                        <table class="table table-hover table-striped table-bordered ">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="5%">Sn.</th>
                                                                                    <th width="5%">Location</th>
                                                                                    <th width="12%">Item No</th>
                                                                                    <!-- <th width="14%">Description</th> -->
                                                                                    <th width="8%">Qty</th>
                                                                                    <th width="8%">UOM</th>
                                                                                    <th width="8%">Sale Price</th>
                                                                                    <th width="8%">Sub Total</th>
                                                                                    <th width="8%">Discount</th>
                                                                                    <th width="8%">Discountable Amount</th>
                                                                                    <th width="8%">VAT</th>
                                                                                    <th width="8%">Final Price</th>
                                                                                    <!--<th width="10%">Distribution Amount in SAR</th>-->
                                                                                    <!-- <th width="100%">Final Price</th> -->
                                                                                    <th width="5%">Del.</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="tbUser">
                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                        <input type="button" class="btn btn-success mt-3 mt-lg-0" onCLick="additemLine()" value="Add item line row"/>
                                                                    </div>
                                                                </div> 
                                                            </div>

                                                           
                                                            
                                                            
                                                            <div class="col-xl-12 row">   
                                                            
                                                             
                                                            <h5 class="font-size-14 card-body border-bottom po-charge-hd"><i class="mdi mdi-arrow-right text-primary"></i>Enter Payment</h5>
                                            
                                                            <div class="col-md-6">
                                        
                                                                
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="d-none table table-hover table-striped table-bordered po-charge-table">
                                                                   
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
                                                                <div class="col-md-6">
                                                                    <table width="100%" class="table table-bordered" >
                                                                        <tbody>
                                                                            
                                                                            <tr>
                                                                                <td width="70%" align="right"><b>Total Qty:</b> </td>
                                                                                <td width="30%" align="left"><span id="tot-qty">0</span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="70%" align="right"><b>Subtol:</b> </td>
                                                                                <td width="30%" align="left"><span class="cur-abbrv"></span> <span id="main-sub-tot-dsp"></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="70%" align="right"><b>Total Discount:</b> </td>
                                                                                <td width="30%" align="left"><span class="cur-abbrv"></span> <span id="main-tot-dis-dsp"></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="70%" align="right"><b>Total Vat:</b> </td>
                                                                                <td width="30%" align="left"><span class="cur-abbrv"></span> <span id="main-tot-vat-dsp"></span></td>
                                                                            </tr>
                                                                            <!-- strt -->
                                                                            <!-- <tr>
                                                                                <td width="70%" align="right"><b>Enter Payment:</b> </td>
                                                                                <input type="hidden" name="gtoltax" id="gtoltaxid" value="217.65">
                                                                                <td width="30%" align="left">
                                                                                    <span id="curt-cur-abbre-po-charge"></span> 
                                                                                    <span id="main-tot-po-charge">0</span>
                                                                                    <input type="hidden" name="tot_po_charge" id="tot-po-charge-db">
                                                                                </td>
                                                                            </tr> -->
                                                                            <!-- end -->
                                                                            <!-- <tr style="display:none;"> -->
                                                                            <tr>
                                                                                <td width="70%" align="right"><b>Total round off:</b> </td>
                                                                                <td width="30%" align="left"><span class="cur-abbrv"></span> <span id="tot-round-off"></span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="70%" align="right"><b>Grand Total:</b> </td>
                                                                                <td width="30%" align="left" style="    font-size: 0.8cm;    font-weight: bold;"><span class="cur-abbrv"></span> <span id="grand-tot">0</span> </td>
                                                                            </tr>
                                                                            <tr class="tot-pay-tr">
                                                                                <td width="70%" align="right"><b>Total Payment:</b> </td>
                                                                                <td width="30%" align="left">
                                                                                    <span class="cur-abbrv"></span> <span id="main-tot-pay-dsp"></span>
                                                                                </td>
                                                                            </tr>
                                                                            <tr class="tot-bal-tr">
                                                                                <td width="70%" align="right"><b>Balance:</b> </td>
                                                                                <td width="30%" align="left"><span class="cur-abbrv"></span> <span id="main-tot-bal-dsp"></span></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    
                                                <div>
                                                    <button data-control="sale/sale-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->saleAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->saleAdd->cont?>" class="ajaxform sale-btn btn btn-primary waves-effect waves-light" type="submit" disabled="true">Add SALE ORDER</button>
                                                </div>
                                                </div>
                                                <span id="outmsg"></span>
                                            
                                        </div>
                                        <!-- JS DATA -->
                                            <input type="hidden" name="POD_EXCH_RATE" id="cur-rate-exch">
                                            <input type="hidden" name="credit_auth_id_db" id="credit-auth-id-db">
                                            <input type="hidden" name="discount_auth_id_db" id="discount-auth-id-db">
                                        </form>
                                    </div>
                                    <!-- end card -->
                                    
                                    
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

            <!--=============================== NEW MODAL START =============================-->

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Quick Customer Add</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                            <form id="custformdata">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Code</label>
                                                    <input type="text" class="form-control" name="CUST_CODE" placeholder="Code ">
                                                    <label id="CUST_CODE-error" class="error"></label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Customer Name</label>
                                                    <input type="text" class="form-control" name="CUST_NAME" placeholder="Customer Group ">
                                                    <label id="CUST_NAME-error" class="error"></label>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Customer Name(AR)</label>
                                                <input type="email" class="form-control" name="CUST_NAME_AR" placeholder="Customer Name">
                                                <label id="CUST_NAME_AR-error" class="error"></label>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Customer Type</label>
                                                <!-- <input type="email" class="form-control" name="CUST_CUST_TYPE" placeholder="Customer Type"> -->
                                                <select class="form-control select2" name="CUST_CUST_TYPE">
                                                        <option value='' Selected disabled>Select</option>
                                                        <?php foreach ($custTypeDets as $custTypeDet):?>
                                                                <option value="<?=$custTypeDet->CTYP_CUST_TYPE?>"><?=$custTypeDet->CTYP_CUST_TYPE.'-'.$custTypeDet->CTYP_DESC?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <label id="CUST_CUST_TYPE-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Wharehouse</label>
                                                <select name="CUST_WHSE_CODE" class="form-control select2">
                                                    <option value='' Selected disabled>Select</option>
                                                    <?php foreach ($whareDets as $whareDet):
                                                        if (strlen($whareDet->WHSE_CODE) == 2) { 
                                                            if($sesData->USER_TYPE == 'SUPERADMIN'){ ?>
                                                                <option value="<?=$whareDet->WHSE_CODE?>" orderCount="<?=$whareDet->WHSE_ORDER_COUNT?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                            <?php }elseif ($sesData->USER_TYPE == 'USER') { 
                                                                    foreach ($whse_assign as $whseGet):
                                                                        if($whseGet->SMSW_WHSE_CODE == $whareDet->WHSE_CODE){
                                                            ?>

                                                                            <option value="<?=$whareDet->WHSE_CODE?>" orderCount="<?=$whareDet->WHSE_ORDER_COUNT?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                        <?php } endforeach; } }endforeach; ?>
                                                </select>
                                                <label id="CUST_WHSE_CODE-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Address Line 1</label>
                                                <input type="email" class="form-control" name="CUST_STR_ADDR1" placeholder="Address Line 1">
                                                <label id="CUST_STR_ADDR1-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom05" class="form-label">Select Country</label>
                                                    <select class="form-control select2" name="CUST_COUNTRY_ID" onChange='countryCh(this)'>
                                                        <option value='' Selected disabled>Select</option>
                                                        <?php foreach ($countryLists as $countryList):?>
                                                                <option value="<?=$countryList['CNTRY_CODE']?>"><?=$countryList['CNTRY_NAME']?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <label id="CUST_COUNTRY_ID-error" class="error"></label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom05" class="form-label">Select State</label>
                                                    <select class="form-control select2 stateData" onChange="stateCh(this)" name="CUST_STATE_ID">
                                                        <option value='' Selected disabled>Select</option>
                                                    </select>
                                                <label id="CUST_STATE_ID-error" class="error"></label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom05" class="form-label">Select City</label>
                                                    <select class="form-control select2 cityData" name="CUST_CITY_ID">
                                                        <option value='' Selected disabled>Select</option>
                                                    </select>
                                                <label id="CUST_CITY_ID-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Postal Code</label>
                                                <input type="email" class="form-control" name="CUST_POSTAL_CODE_ID" placeholder="Tax Withholding Category">
                                                <label id="CUST_POSTAL_CODE_ID-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Phone no 1</label>
                                                <input type="email" class="form-control" name="CUST_PHONE1" placeholder="Phone no 1">
                                                <label id="CUST_PHONE1-error" class="error"></label>
                                            </div>
                                        </div>
                                    </div>
                                <div>
                                    <button data-control="parties/customre-add-db" data-form="custformdata" data-function="Y" data-confmsg="Are you sure? You want add new customer" class="form-modal btn btn-success waves-effect waves-light" type="submit">Add Customer</button>
                                </div>
                                <span id="modal-out-msg"></span>
                            </div>
                            <input type="hidden" name="cust_retuen_type" value="Q">
                        </form>
                    </div>
                </div>
            </div>

            <!--=============================== NEW MODAL END =============================-->
            
<!-- Sweet Alerts js -->
<script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!--=============================== Auto Complete script Start=============================-->
<script src="<?=base_url()?>assets/js/custom_js/jquery-1.8.3.js"></script>
<script src="<?=base_url()?>assets/js/custom_js/jquery-ui-1.9.2.custom.js"></script>
<!--=============================== Auto Complete script End=============================-->
<script>
var item_arr = [];   
// SALE JS START

// Global Variable  
var inv_type = 'cash';
var emp_disc = 0;
var alert_disc = 0;
<?php if(dashRole(["role_check"=>"SALE_CASH"])){?>
    termIn('997');
<?php } ?>


function invoiceType(ele) {
    inv_type = ele.value;
    $('#tbUser').empty();
    $('#term-in').html('');
    $('#term-db').val('');
    $('.term-in-val').val('');
    $('.item-line-table-dis').addClass('d-none');

    if (inv_type == 'cash') {

        termIn('997');
        $('.po-charge-table').removeClass('d-none');
        $('.po-charge-hd').removeClass('d-none');
    }else if(inv_type == 'credit'){
        $('#standard_model').modal('show');
        $('.st_model_head').html(`Authentication Required`);
        $('.st_model_body').html(`<form id="formdata-modal">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Username</label>
                                                    <input type="text" class="form-control" name="auth_username" placeholder="Enter Items Code ">
                                                    <label id="auth_username-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Password</label>
                                                    <input type="text" class="form-control" name="auth_password" placeholder="Enter Items Code ">
                                                    <label id="auth_password-error" class="error"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="auth_type" value="CREDIT">
                                </form>`);
        $('#formRadios2').prop('checked',false);
        $('#form-control-modal').html(`<button type="button" data-function="Y" data-modalid="standard_model" data-confmsg="Check All field then verify it" data-control="sale/validate-user-pass" data-form="formdata-modal" class="form-modal btn btn-primary waves-effect waves-light st_model_send">Verify</button>`);

        
        
        $('.po-charge-table').addClass('d-none');
        $('.po-charge-hd').addClass('d-none');
    }
}

function customFunction(){
   let auth_id = retuen_data_ajax?retuen_data_ajax.auth_id:null;
   let auth_type = retuen_data_ajax?retuen_data_ajax.auth_type:null;
   let cust_code_q = retuen_data_ajax?retuen_data_ajax.cust_code_q:null;
   emp_disc = retuen_data_ajax?retuen_data_ajax.dis_ext:0;

    if (auth_type == 'CREDIT') {
        $('#credit-auth-id-db').val(auth_id);
    }else if(auth_type == 'DISCOUNT'){
        $('#discount-auth-id-db').val(auth_id);
    }
    if(cust_code_q){
        $('#cust-val-q').val(cust_code_q);
        window.setTimeout(function(){
            custSearchIn();
        },500);
    }

   if ($('#credit-auth-id-db').val()) {
    $('#formRadios2').prop('checked','true');
    termIn('995');
   }else{
    $('#formRadios1').prop('checked','true');
    termIn('997');
   }
}



function custSearchIn() {
        let ele = $('#cust-val-q').val();
        $('#vendor-code-db').val('');
        let whse_code = $('.whse-id-in').val();
        if(ele.length>3){
            $.ajax({
                type: "POST",
                url: "<?= base_url('Common/getCustDelByCustCode') ?>",
                data: {cust_code:ele},
                dataType: "Json",
                success: function(resultData){
                    if(resultData.cust_det){
                        // $('.item-line-table-dis').removeClass('d-none');
                        if(resultData.cust_det['CUST_WHSE_CODE'] == 'ALL' || resultData.cust_det['CUST_WHSE_CODE'] == whse_code){
                            $('#v-code').html(`<span class='text-success v-code-dis'>${resultData.cust_det['CUST_CODE']}</span>`);
                            $('#v-name').html(`<span class='text-success'>${resultData.cust_det['CUST_NAME']} ${resultData.cust_det['CUST_NAME_AR']}</span>`);
                            $('#v-contact').html(`<span class='text-success'>${resultData.cust_det['CUST_PHONE1']}</span>`);

                            $('#vendor-code-db').val(resultData.cust_det['CUST_CODE']);
                        }else{
                            $('#v-code').html(`<span class='text-warning v-code-dis'>DATA NOT AVAILABLE</span>`);
                            $('#v-name').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                            $('#v-contact').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                        }
                        // $('#class_desc_in').val(resultData[0]['IC_DESC']);
                    }else{
                        // $('.item-line-table-dis').addClass('d-none');
                        $('#v-code').html(`<span class='text-warning v-code-dis'>DATA NOT AVAILABLE</span>`);
                        $('#v-name').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                        $('#v-contact').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                        // $('#class_desc_in').val('');
                    }
                }
            });
        }else{
            // $('.item-line-table-dis').addClass('d-none');
            $('#v-code').html(`<span class='text-warning v-code-dis'>DATA FETCHING...</span>`);
            $('#v-name').html(`<span class='text-warning'>DATA FETCHING...</span>`);
            $('#v-contact').html(`<span class='text-warning'>DATA FETCHING...</span>`);
        }
    }

    function whseAndCustCheck() {
        let cust_code = $('#vendor-code-db').val();
        let whse_id = $('.whse-id-in').val();
        if(whse_id){
            $('#cust-val-q').prop('disabled',false);
            if(cust_code){
                $('.item-line-table-dis').removeClass('d-none');
                $('#employe-code-search').prop('disabled',false);
            }else{
                $('#employe-code-search').prop('disabled',true);
                $('.item-line-table-dis').addClass('d-none');
            }
        }else{
            $('#employe-code-search').prop('disabled',true);
            $('.item-line-table-dis').addClass('d-none');
            $('#cust-val-q').prop('disabled',true);
        }
    }

    setInterval(function(){ 
        tableCalculation();
        whseAndCustCheck();
    },500);

     // item Line
     function additemLine() {
            // $('.po-charge-table').removeClass('d-none');
            // $('.po-charge-hd').removeClass('d-none');
            let tableLength = $('#tbUser tr').length+1;
            let cur_exch_rate = $('#cur-rate-exch').val();
            // let index = document.getElementsByTagName("table")[0].childElementCount;
            $('#tbUser').append(`<tr>
                                    <td width="5%"><span>${tableLength}<span></td>
                                    <td width="5%">
                                                <input class="form-control" type="text" id="whse-det-dsp" disabled="true">
                                    </td>
                                    <td width="12%">
                                        <input type="text" onInput='itemSearchIn(this)' class="form-control item-search-in">
                                        <span id="i-desc"></span></br><span id="i-ext-desc"></span>
                                    </td>
                                    <td width="8%"><input type="text" class="form-control qty-val-in" onInput='qtyIn(this)' value="1"></td>
                                    
                                    <td width="8%"><span id="uom-dsp"><span></td>
                                    <td width="8%"><span id="unit-pri-dis-amt-dsp"><span></td>
                                    <td width="8%"><span id="sub-tot-dsp"><span></td>
                                    <td width="8%">
                                        <select class="form-control dis-select-in" name="SD_DIST_TYPE[]" onchange="disSelCh(this)" onchange="tableCalculation()">
                                            <option value="per">%</option>
                                            <option value="in">SAR</option>
                                        </select>
                                        <input type="number" onInput="disIn(this)" value="0" name="dis_per_db[]" class="form-control dis-in-val">
                                    </td>
                                    <td width="8%"><span class="discountable-amt-dsp">0<span></td>
                                    <td width="8%"><span class="vat-dsp"><span></td>
                                    <td width="8%"><span class="final-price">0<span></td>
                                    <td width="8%"><a onClick='deleteTraitRow(this)'><i id="11" class="delete fa fa-trash"></i></a>

                                    <input type="hidden" name="SD_ITEM_CODE[]" id="item-code-db">
                                    <input type="hidden" name="SD_SALE_PRICE[]" id="item-unit-price-db">
                                    <input type="hidden" name="SD_QTY[]" id="item-qty-db">
                                    <input type="hidden" name="SD_WHSE_LOC_ID[]" id="whse-code-db">
                                    <input type="hidden" name="SD_DIST_AMT[]" id="discountable-amt-dsp-db">
                                    <input type="hidden" name="SO_VAT_AMT[]" id="vat-in-db">

                                    <input type="hidden" id="stock-qty">
                                    <input type="hidden" id="stock-cont">
                                    </td>
                                    
                                </tr>`);
    }
    function disSelCh(ele) {
        $(ele).closest('tr').find('td .dis-in-val').val(0);
    }
    function disIn(ele) {
        let dis_sel = $(ele).closest('tr').find('td .dis-select-in').val();
            console.log(dis_sel);
            if (dis_sel == 'per') {
                if (parseFloat(ele.value) > parseInt(-1) && parseFloat(ele.value) <= parseInt(100)) {
                    
                }else{
                    alert('Invalid discount');
                    $(ele).val(0);
                }
            }else if(dis_sel == 'in'){

            }
            // tableCalculation();
    }

    function itemSearchIn(ele) {
      
        $(ele).closest('tr').find('td #stock-qty').val('');
        $(ele).closest('tr').find('td .qty-val').val('');

        $(ele).closest('tr').find('td #item-code-db').val('');
        $(ele).closest('tr').find('td #item-unit-price-db').val('');
        $(ele).closest('tr').find('td #item-qty-db').val('');
        $(ele).closest('tr').find('td #whse-code-db').val('');


        $(ele).closest('tr').find('td .vat-dsp').html('');

        $(ele).closest('tr').find('td #whse-det-dsp').val('');
        
        if(ele.value.length>3){
            let v_code = $('.v-code-dis').html();
            let from_whse_code = $('.whse-id-in').val();
            let stk_resn = '201';
            $.ajax({
                type: "POST",
                url: "<?= base_url('Common/getItemStockQty') ?>",
                data: {item_code:ele.value,from_whse_code,stk_resn,serach_type:'sale'},
                dataType: "Json",
                success: function(resultData){
                 
                    $(ele).closest('tr').find('td #stock-cont').val(null);
                    
                    if (resultData.item_det && parseInt(resultData.sale_stock_det.stock)>0) {
                        if(item_arr.indexOf(resultData.item_det[0]['I_CODE']) == -1){  
                            item_arr.push(resultData.item_det[0]['I_CODE']);
                            $(ele).closest('tr').find('td #stock-qty').val(resultData.sale_stock_det.stock);
                            $(ele).closest('tr').find('td #stock-cont').val(resultData.stock_con);
                            
                            $(ele).closest('tr').find('td #i-desc').html(resultData.item_det[0]['I_DESC']);
                            $(ele).closest('tr').find('td #i-ext-desc').html(resultData.item_det[0]['I_EXTEND_DESC']);

                            $(ele).closest('tr').find('td #uom-dsp').html(resultData.item_det[0]['UOM_DESC']);
                            
                            $(ele).closest('tr').find('td #unit-pri-dis-amt-dsp').html(resultData.temp_list_price);
                            $(ele).closest('tr').find('td #sub-tot-dsp').html(resultData.temp_list_price*1);
                            $(ele).closest('tr').find('td .final-price').html(resultData.temp_list_price*1);
                        
                            $(ele).closest('tr').find('td #whse-det-dsp').val(resultData.sale_stock_det.whse_code);


                            $(ele).closest('tr').find('td #item-code-db').val(resultData.item_det[0]['I_CODE']);
                            $(ele).closest('tr').find('td #item-unit-price-db').val(resultData.temp_list_price);
                            $(ele).closest('tr').find('td #item-qty-db').val(1);
                            $(ele).closest('tr').find('td #whse-code-db').val(resultData.sale_stock_det.whse_code);


                            $(ele).closest('tr').find('td .qty-val').val(1);
                            if (resultData.item_det[0]['I_FLAMMABLE'] == 'Y') {
                                $(ele).closest('tr').find('td .vat-dsp').html(`<?=systemVat()?>%`);
                            }else{
                                $(ele).closest('tr').find('td .vat-dsp').html('Exempted');
                            }
                        }else{
                            Swal.fire({
                                        title: "Item Validation",
                                        text: "Item already added to this list",
                                        icon: "error",
                                        confirmButtonColor: "#556ee6"
                                    });
                        }
                    }else{
                        $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
                        $(ele).closest('tr').find('td #i-ext-desc').html('');
                        $(ele).closest('tr').find('td #uom-dsp').html('');
                        $(ele).closest('tr').find('td #unit-pri-dis-amt-dsp').html('');
                        $(ele).closest('tr').find('td #sub-tot-dsp').html('');
                        $(ele).closest('tr').find('td .final-price').html('');
                        $(ele).closest('tr').find('td #whse-code-db').val('');

                    }
                }
            });
        }else{
            $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
            $(ele).closest('tr').find('td #i-ext-desc').html('');
            $(ele).closest('tr').find('td #uom-dsp').html('');
            $(ele).closest('tr').find('td #unit-pri-dis-amt-dsp').html('');
            $(ele).closest('tr').find('td #sub-tot-dsp').html('');
            $(ele).closest('tr').find('td .final-price').html('');
            $(ele).closest('tr').find('td #whse-code-db').val('');


        }
        // tableCalculation();
    }

    function qtyIn(ele) {
        let stock_qty = $(ele).closest('tr').find('td #stock-qty').val();
        let stock_con = $(ele).closest('tr').find('td #stock-cont').val();
        let qty_in = ele.value>0?ele.value:0;
        if (parseFloat(qty_in)<= parseFloat(stock_qty) || stock_con == 'no_limit') {
                                    
        }else{
            Swal.fire({
                    title: "Stock alert",
                    text: "The quantity is not greater than the inventory stock. Total Stock quantity : "+stock_qty,
                    icon: "error",
                    confirmButtonColor: "#556ee6"
                });

                qty_in = stock_qty;
                $(ele).val(qty_in);
        }
        $(ele).closest('tr').find('td #item-qty-db').val(qty_in);
        $(ele).closest('tr').find('td .qty-in').html(qty_in);
        // tableCalculation();
    }

    // WHAREHOUSE
    function  whseIn(ele,whse_type=null) {
        $('#cust-val-q').val('');
        $('#vendor-code-db').val('');
        $('#v-code').html('');
        $('#v-name').html('');
        $('#v-contact').html('');

        // console.log(whse_type);
        if (whse_type == 'main_whse') {
            $('#tbUser').empty();
        }
        let order_count = $(ele).find('option:selected');
        order_count = order_count.attr("orderCount");
        
        $('.order-no-val').val(order_count);
        $('.order-type-val').val('S'+ele.value);


        // $(ele).closest('tr').find('td .item-search-in').prop("disabled","true");
        $(ele).closest('tr').find('td #whse-code-db').val("");

        let whse_id = $('.whse-id-in').val().length>parseInt(2)?'main':'section';
        $(ele).closest('tr').find('td #whse-det-dsp').html('');
        $.ajax({
                type: "POST",
                url: "<?= base_url('Common/getWharehouseDet') ?>",
                data: {whse_code:ele.value},
                dataType: "Json",
                success: function(resultData){
                    // console.log(resultData);
                    if(resultData.whse_det.WHSE_CODE){
                        
                        let whse_in = $('.whse-id-in').val();
                        // console.log('type',whse_id,'whse val',whse_in,'main_code',resultData.whse_det.WHSE_CODE);
                        if (whse_id == 'section') {
                            
                            if(whse_in.slice(0,2) == resultData.whse_det.WHSE_CODE.slice(0,2)){
                                // $(ele).closest('tr').find('td .item-search-in').prop("disabled","");
                                $(ele).closest('tr').find('td #whse-code-db').val(resultData.whse_det.WHSE_CODE);

                                $(ele).closest('tr').find('td #whse-det-dsp').html(resultData.whse_det.WHSE_CODE+'-'+resultData.whse_det.WHSE_DESC);
                            }else{
                                $(ele).closest('tr').find('td #whse-det-dsp').html('Enter a different location code. This code is not acceptable for this location.');
                            }
                        }else if(whse_id == 'main'){
                            if(whse_in == resultData.whse_det.WHSE_CODE){
                                // $(ele).closest('tr').find('td .item-search-in').prop("disabled","");
                                $(ele).closest('tr').find('td #whse-code-db').val(resultData.whse_det.WHSE_CODE);

                                $(ele).closest('tr').find('td #whse-det-dsp').html(resultData.whse_det.WHSE_CODE+'-'+resultData.whse_det.WHSE_DESC);
                            }else{
                                $(ele).closest('tr').find('td #whse-det-dsp').html('Enter a different location code. This code is not acceptable for this location.');
                            }
                        }
                    }else{

                        $(ele).closest('tr').find('td #whse-det-dsp').html('Data not Found');

                    }
                }
            });
    }
    var grnd_tot = 0;
    function tableCalculation() {
        // let cur_exch_rate = $('#cur-rate-exch').val();
        let cur_exch_rate = 1;
        let tot_pay_in = $('#tot-po-charge').html();
        // let grnd_tot = parseFloat($('#grand-tot').html());
        console.log(grnd_tot);
        if (inv_type == 'cash') {
            if ((parseInt(tot_pay_in).toFixed(4) == parseInt(grnd_tot)) && parseInt(grnd_tot)>0) {
                $('.sale-btn').prop("disabled","");
            }else{
                $('.sale-btn').prop("disabled","true");
            }
        }else{
            if (parseInt(grnd_tot)>0) {
            $('.sale-btn').prop("disabled","");
            }else{
                $('.sale-btn').prop("disabled","true");
            }
        }
        
        $('#tot-pay-db').val(tot_pay_in);
        // $('#main-tot-po-charge').html(po_charge_tot*cur_exch_rate);
        // $('#tot-po-charge-db').val(po_charge_tot*cur_exch_rate);
        let tableLength = parseFloat($('#tbUser tr').length);
        // let distr_po_chgr = po_charge_tot?parseFloat(po_charge_tot)/tableLength:0;
        
        if(tableLength>0 && inv_type == 'cash'){
            $('.po-charge-table').removeClass('d-none');
            $('.po-charge-hd').removeClass('d-none');

            $('.tot-pay-tr').removeClass('d-none');
            $('.tot-bal-tr').removeClass('d-none');
        }else{
            $('.po-charge-table').addClass('d-none');
            $('.po-charge-hd').addClass('d-none');

            $('.tot-pay-tr').addClass('d-none');
            $('.tot-bal-tr').addClass('d-none');
        }
        
        let so = 1;
        let tot_qty_in = 0;
        let sub_tot_in = 0;
        let tot_dis_in = 0;
        let tot_vat_in = 0;
        let tot_grand_in = 0;
        $('#tbUser tr').each( (tr_idx,tr) => {
            $(tr).children('td').each( (td_idx, td) => {
                if(td_idx == 0){
                    $(td).html(so);
                }

                let qty_in = $(tr).closest('tr').find('td .qty-val-in').val();
                let dis_sel = $(tr).closest('tr').find('td .dis-select-in').val();
                let dis_val = $(tr).closest('tr').find('td .dis-in-val').val();
                let vat_in = $(tr).closest('tr').find('td .vat-dsp').html();
                
                // let final_price = 
                let list_price = $(tr).closest('tr').find('td #unit-pri-dis-amt-dsp').html();
                let sub_tot_bf_dis = parseFloat(list_price)*parseFloat(qty_in);
                // item sub total
                $(tr).closest('tr').find('td #sub-tot-dsp').html(sub_tot_bf_dis.toFixed(4));

                let final_dis_cal = 0;
                    // console.log(sub_tot_bf_dis,dis_val,'qty',qty_in,'list',list_price);
                if (dis_sel == 'per') {
                    if (parseFloat(emp_disc)>=parseFloat(dis_val)) {
                        final_dis_cal = parseFloat(sub_tot_bf_dis)*(parseFloat(dis_val)/100);
                        
                        alert_disc = 0;
                    }else{
                        if (alert_disc == 0 && parseFloat(dis_val)>0) {
                            // Swal.fire({
                            //     title: "Discount alert",
                            //     text: "No more than the maximum permitted discount : Allow limit = "+emp_disc+"%",
                            //     icon: "warning",
                            //     confirmButtonColor: "#556ee6"
                            // });
                            Swal.fire({
                                title: 'Discount Alert',
                                showDenyButton: true,
                                showCancelButton: true,
                                confirmButtonText: 'Extend discount limit',
                                denyButtonText: 'View Current discount limit',
                                customClass: {
                                    actions: 'my-actions',
                                    cancelButton: 'order-1 right-gap',
                                    confirmButton: 'order-2',
                                    denyButton: 'order-3',
                                }
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    // Swal.fire('Saved!', '', 'success')
                                    $('#standard_model').modal('show');
                                    $('.st_model_head').html(`Authentication Required`);
                                    $('.st_model_body').html(`<form id="formdata-modal">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <label for="validationCustom03" class="form-label">Username</label>
                                                                                <input type="text" class="form-control" name="auth_username" placeholder="Enter Items Code ">
                                                                                <label id="auth_username-error" class="error"></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <label for="validationCustom03" class="form-label">Password</label>
                                                                                <input type="text" class="form-control" name="auth_password" placeholder="Enter Items Code ">
                                                                                <label id="auth_password-error" class="error"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="auth_type" value="DISCOUNT">
                                                            </form>`);
                                    $('#formRadios1').prop('checked','true');
                                    $('#form-control-modal').html(`<button type="button" data-function="Y" data-modalid="standard_model" data-confmsg="Check All field then verify it" data-control="sale/validate-user-pass" data-form="formdata-modal" class="form-modal btn btn-primary waves-effect waves-light st_model_send">Verify</button>`);
                                    
                                } else if (result.isDenied) {
                                    Swal.fire({
                                                    title: "Discount alert",
                                                    text: "No more than the maximum permitted discount : Allow limit = "+emp_disc+"%",
                                                    icon: "warning",
                                                    confirmButtonColor: "#556ee6"
                                                });
                                }
                            })
                        alert_disc = 1;
                        $(tr).closest('tr').find('td .dis-in-val').val(emp_disc);
                        final_dis_cal = parseFloat(sub_tot_bf_dis)*(parseFloat(emp_disc)/100);
                        }
                    }
                    

                }else if(dis_sel == 'in'){
                    if (parseFloat(sub_tot_bf_dis)*(parseFloat(emp_disc)/100)>=parseFloat(dis_val)) {
                        final_dis_cal = parseFloat(dis_val);
                    }else{
                        if (alert_disc == 0 && parseFloat(dis_val)>0) {
                            let dis_to_in = parseFloat(sub_tot_bf_dis)*(parseFloat(emp_disc)/100);
                            // Swal.fire({
                            //     title: "Discount alert",
                            //     text: "No more than the maximum permitted discount : Allow limit = "+dis_to_in+"/-",
                            //     icon: "warning",
                            //     confirmButtonColor: "#556ee6"
                            // });
                            Swal.fire({
                                title: 'Discount Alert',
                                showDenyButton: true,
                                showCancelButton: true,
                                confirmButtonText: 'Extend discount limit',
                                denyButtonText: 'View Current discount limit',
                                customClass: {
                                    actions: 'my-actions',
                                    cancelButton: 'order-1 right-gap',
                                    confirmButton: 'order-2',
                                    denyButton: 'order-3',
                                }
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    // Swal.fire('Saved!', '', 'success')
                                    $('#standard_model').modal('show');
                                    $('.st_model_head').html(`Authentication Required`);
                                    $('.st_model_body').html(`<form id="formdata-modal">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <label for="validationCustom03" class="form-label">Username</label>
                                                                                <input type="text" class="form-control" name="auth_username" placeholder="Enter Items Code ">
                                                                                <label id="auth_username-error" class="error"></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <label for="validationCustom03" class="form-label">Password</label>
                                                                                <input type="text" class="form-control" name="auth_password" placeholder="Enter Items Code ">
                                                                                <label id="auth_password-error" class="error"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="auth_type" value="DISCOUNT">
                                                            </form>`);
                                    $('#formRadios1').prop('checked','true');
                                    $('#form-control-modal').html(`<button type="button" data-function="Y" data-modalid="standard_model" data-confmsg="Check All field then verify it" data-control="sale/validate-user-pass" data-form="formdata-modal" class="form-modal btn btn-primary waves-effect waves-light st_model_send">Verify</button>`);
                                    
                                } else if (result.isDenied) {
                                    Swal.fire({
                                                    title: "Discount alert",
                                                    text: "No more than the maximum permitted discount : Allow limit = "+dis_to_in+"/-",
                                                    icon: "warning",
                                                    confirmButtonColor: "#556ee6"
                                                });
                                }
                            })
                        alert_disc = 1;
                        $(tr).closest('tr').find('td .dis-in-val').val(dis_to_in);
                        final_dis_cal = dis_to_in;
                        }
                    }
                    
                }
                let tot_dis_cal = final_dis_cal;
                // Discountable Amount
                $(tr).closest('tr').find('td .discountable-amt-dsp').html(final_dis_cal.toFixed(2));
                $(tr).closest('tr').find('td #discountable-amt-dsp-db').val(final_dis_cal.toFixed(2));

                let final_price_cal = parseFloat(sub_tot_bf_dis)-parseFloat(final_dis_cal);
                
                // VAT Include
                let vat_cal = 0;
                if (vat_in != 'Exempted') {
                    let vat_value_dyn = parseFloat(<?=systemVat()?>);
                        vat_cal = (parseFloat(final_price_cal)*vat_value_dyn/100);
                        final_price_cal = parseFloat(final_price_cal)+parseFloat(vat_cal);
                }else{
                    vat_cal = 0;
                }
                // VAT DB
                $(tr).closest('tr').find('td #vat-in-db').val(vat_cal.toFixed(4));
 
                // Final Amount
                $(tr).closest('tr').find('td .final-price').html(final_price_cal.toFixed(4));
          
                // console.log( '[' +tr_idx+ ',' +td_idx+ '] => ' + $(td).text());
                // Outside Loop
                if(td_idx == 3){
                    tot_qty_in += parseInt(qty_in);
                }
                if (td_idx == 6) {
                    sub_tot_in += parseFloat(sub_tot_bf_dis);
                }
                if (td_idx == 8) {
                    tot_dis_in += parseFloat(tot_dis_cal);
                    tot_vat_in += parseFloat(vat_cal);
                    tot_grand_in += parseFloat(final_price_cal);
                }
                
            });
            so++;
            $('#tot-qty').html(tot_qty_in);
            $('#main-sub-tot-dsp').html(sub_tot_in.toFixed(4));
            $('#main-tot-dis-dsp').html(tot_dis_in.toFixed(4));
            $('#main-tot-vat-dsp').html(tot_vat_in.toFixed(4));
            // $('#grand-tot').html(tot_grand_in.toFixed(4));
            $('#tot-round-off').html(parseFloat(parseFloat(tot_grand_in.toFixed(4))-Math.round(tot_grand_in.toFixed(4))).toFixed(4));
            // $('#tot-round-off').html(parseFloat(tot_grand_in.toFixed(4)));
            grnd_tot = Math.round(tot_grand_in.toFixed(4));
            $('#grand-tot').html(Number(Math.round(tot_grand_in.toFixed(4))).toLocaleString());
        });
        $('#main-tot-bal-dsp').html(Number(parseFloat(Math.round(tot_grand_in.toFixed(4)))-parseFloat(tot_pay_in)).toLocaleString())
        // amtDistributionIndividual();
    }

    // PAYMENT METHOD
    
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
            // console.log( '[' +tr_idx+ ',' +td_idx+ '] => ' + $(td).text() + ' TOT ---' + tot_po_charge);
        }); 
        $('#tot-po-charge').html(tot_po_charge.toFixed(4));
        $('#main-tot-pay-dsp').html(tot_po_charge.toFixed(4));
    });

    // tableCalculation();
    }

    function termIn(ele) {
        $('#term-db').val('');
        $('.term-in-val').val('');
            $.ajax({
                type: "POST",
                url: "<?= base_url('Common/getTermdetBytermCode') ?>",
                data: {term_code:ele},
                dataType: "Json",
                success: function(resultData){
                    console.log(resultData);
                    if(resultData.term_det){
                        if (inv_type == 'cash' && resultData.term_det['TERM_CODE'] == '997') {
                            $('.term-in-val').val(resultData.term_det['TERM_CODE']);
                            $('#term-in').html(`<span class='text-success'>${resultData.term_det['TERM_CODE']} - ${resultData.term_det['TERM_DESC']}</span>`);
                            $('#term-db').val(resultData.term_det['TERM_CODE']);
                        }else if(inv_type == 'credit' && resultData.term_det['TERM_CODE'] == '995'){
                            $('.term-in-val').val(resultData.term_det['TERM_CODE']);
                            $('#term-in').html(`<span class='text-success'>${resultData.term_det['TERM_CODE']} - ${resultData.term_det['TERM_DESC']}</span>`);
                            $('#term-db').val(resultData.term_det['TERM_CODE']);
                        }
                    }else{
                        $('#term-in').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                    }
                }
            });
    }

$(function(){

    $("#employe-code-search").autocomplete({

        source: function( request, response ) {

            $.ajax({url: "<?=base_url('common/getEmpDetByEmpCode')?>", dataType: "jsonp", data: { term: request.term,searchtype:"list",whse_in:$('.whse-id-in').val()},

                success: function( data ) {response(data); }

            });

        },

        minLength: 1,

        select: function (event, ui) {

            $('#distriprofile').html('Loading profile..');

            fetch(`<?php echo base_url('common/getEmpDetByEmpCode') ?>?term=${ui.item.id}&searchtype=select&whse_in=${$('.whse-id-in').val()}`)

            .then(response => response.json())

            .then(function (data) {
            
                // distriprofile(data);
                emp_disc = data.vend_det.EMP_DISC;
            
                $('#salesman-code-db').val(ui.item.id);

            })

            .catch(function (err) {

                // $('#distriprofile').html(err);

            });

        }

    });

});

function countryCh(ele) {
        $('.stateData').empty();
        $('.stateData').append(`<option value='' Selected disabled>Select</option>`);
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getStateByCntryCode')?>",
            data: {country_code:ele.value},
            dataType: "Json",
            success: function(resultData){
               for (let index = 0; index < resultData.length; index++) {
                    let st_name = resultData[index]['ST_NAME'];
                    let st_code = resultData[index]['ST_CODE'];
                    $('.stateData').append(`<option value='`+st_code+`'>`+st_name+`</option>`);
               }
            }
        });
    }

    function stateCh(ele) {
        $('.cityData').empty();
        $('.cityData').append(`<option value='' Selected disabled>Select</option>`);
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getCItyByStCode')?>",
            data: {state_code:ele.value},
            dataType: "Json",
            success: function(resultData){
               for (let index = 0; index < resultData.length; index++) {
                    let cty_name = resultData[index]['CTY_NAME'];
                    let cty_code = resultData[index]['CTY_CODE'];
                    $('.cityData').append(`<option value='`+cty_code+`'>`+cty_name+`</option>`);
               }
            }
        });
    }

// SALE JS END

/**========================================================================
 *                           BELOW CODE NOT USED THIS PAGE
 *========================================================================**/

    //PO CHARGE END

    function shipViaIn(ele) {
        $('#ship-via-db').val('');
       
        if(ele.value.length>=2){
            $.ajax({
                type: "POST",
                url: "<?= base_url('Common/getShipDetByShipCode') ?>",
                data: {ship_code:ele.value},
                dataType: "Json",
                success: function(resultData){
                    console.log(resultData);
                    if(resultData.ship_det){
                        $('#ship-via-in-det').html(`<span class='text-success'>${resultData.ship_det['SHIPV_CODE']} - ${resultData.ship_det['SHIPV_DESC']}</span>`);
                        $('#ship-via-db').val(resultData.ship_det['SHIPV_CODE']);
                    }else{
                        $('#ship-via-in-det').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                    }
                }
            });
        }else if(ele.value.length>=1){
            $('#ship-via-in-det').html(`<span class='text-warning'>DATA FETCHING...</span>`);
        }else{
            $('#ship-via-in-det').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
        }
    }

    function freightIn(ele) {
        $('#freight-code-db').val('');
        if(ele.value.length>=2){
            $.ajax({
                type: "POST",
                url: "<?= base_url('Common/getFreightDelByfreightCode') ?>",
                data: {freight_code:ele.value},
                dataType: "Json",
                success: function(resultData){
                    console.log(resultData);
                    if(resultData.freight_det){
                        $('#frt-in').html(`<span class='text-success'>${resultData.freight_det['FRT_CODE']} - ${resultData.freight_det['FRT_DESC']}</span>`);
                        $('#freight-code-db').val(resultData.freight_det['FRT_CODE']);
                    }else{
                        $('#frt-in').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                    }
                }
            });
        }else if(ele.value.length>=1){
            $('#frt-in').html(`<span class='text-warning'>DATA FETCHING...</span>`);
        }else{
            $('#frt-in').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
        }

    }

    function fobIn(ele) {
        $('#fob-db').val('');

        if(ele.value.length>=2){
            $.ajax({
                type: "POST",
                url: "<?= base_url('Common/getFobdetByFobCode') ?>",
                data: {fob_code:ele.value},
                dataType: "Json",
                success: function(resultData){
                    console.log(resultData);
                    if(resultData.fob_det){
                        $('#fob-in').html(`<span class='text-success'>${resultData.fob_det['FOB_CODE']} - ${resultData.fob_det['FOB_DESC']}</span>`);
                        $('#fob-db').val(resultData.fob_det['FOB_CODE']);
                    }else{
                        $('#fob-in').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                    }
                }
            });
        }else if(ele.value.length>=1){
            $('#fob-in').html(`<span class='text-warning'>DATA FETCHING...</span>`);
        }else{
            $('#fob-in').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
        }
    }
    function curExtRate(ele,type) {
        // type 1 = currency exchange 2 = buy currency
        $('#cur-exch-id-db').val('');
        $.ajax({
            type: "POST",
            url: "<?= base_url('Common/getCurExhRateByCurCode') ?>",
            data: {cur_exh_code:ele},
            dataType: "Json",
            success: function(resultData){
                console.log(resultData);
                if(type==1){
                    if(resultData.cur_exh_det && ele.length>2){
                        
                        $('.cur-abbrv').html(resultData.cur_exh_det['CUR_ABBRV']);


                        $('#cur-exch-id-db').val(resultData.cur_exh_det['EXCHR_ID']);
                        $('.cur-exc-rate-dis-main-div').removeClass('d-none');
                        $('.cur-exh-rate-val').val(resultData.cur_exh_det['EXCHR_BUY_RATE']);
                        $('.cur-exh-rate-dis').html(`1 ${resultData.cur_exh_det['CUR_NAME']} [${resultData.cur_exh_det['CUR_ABBRV']}] = ${resultData.cur_exh_det['EXCHR_BUY_RATE']} SAR`);
                        // $('#fob-in').html(`<span class='text-success'>${resultData.fob_det['FOB_CODE']} - ${resultData.fob_det['FOB_DESC']}</span>`);
                    }else{
                        $('.cur-exc-rate-dis-main-div').addClass('d-none');
                        $('.cur-exh-rate-val').val('');
                        $('.cur-exh-rate-dis').html('');
                    }
                }else if(type==2){
                    
                    if(resultData.cur_exh_det && ele.length>2){
                        
                        $('.cur-abbrv').html(resultData.cur_exh_det['CUR_ABBRV']);

                        $('#cur-exch-id-db').val(resultData.cur_exh_det['EXCHR_ID']);
                        $('#cur-rate-exch').val(resultData.cur_exh_det['EXCHR_BUY_RATE']);


                        // let tableLength = $('#tbUser tr').length;
                        // for (let tblen = 1; tblen <= tableLength; tblen++) {
                        //     $('#cur-exch-dis-line'+tblen).html(resultData.cur_exh_det['EXCHR_BUY_RATE']);
                        // }
                        // $("table > tbody > tr").each(function () {
                        //     alert($("##cur-exch-dis-line").text());
                        // });
                        tableCalculation();

                        $('.cur-pri-lit-exch-rate-main-div').removeClass('d-none');
                        $('.cur-pri-lit-main-div').removeClass('d-none');
                        $('.cur-pri-lis-exch-rate-val').val(resultData.cur_exh_det['CUR_NAME']+' - '+resultData.cur_exh_det['CUR_ABBRV']+' - '+resultData.cur_exh_det['EXCHR_BUY_RATE']);
                        // $('.cur-pri-lis-val').val(resultData.cur_exh_det['CUR_NAME']+' - '+resultData.cur_exh_det['CUR_ABBRV']);
                        $('.cur-pri-lis-exch-rate-dis').html(`1 ${resultData.cur_exh_det['CUR_NAME']} [${resultData.cur_exh_det['CUR_ABBRV']}] = ${resultData.cur_exh_det['EXCHR_BUY_RATE']} SAR`);
                        // $('#fob-in').html(`<span class='text-success'>${resultData.fob_det['FOB_CODE']} - ${resultData.fob_det['FOB_DESC']}</span>`);
                    }else{
                        $('.cur-pri-lit-exch-rate-main-div').addClass('d-none');
                        $('.cur-pri-lit-main-div').addClass('d-none');
                        $('.cur-pri-lis-exch-rate-val').val('');
                        // $('.cur-pri-lis-val').val('');
                        $('.cur-pri-lis-exch-rate-dis').html('');
                    }
                }
            }
        });

    }

    function name() {
        $("table > tbody > tr").each(function () {
            alert($(".FieldNameID").text() + " " + $(".OperatorID").text());
        });
    }

    curExtRate('001',2);
   
    
                                    // <td class="d-none">
                                    //     <td><input type="hidden" name="POD_ITEM_CODE[]" id="item-code-db"></td>
                                    //     <td><input type="hidden" name="POD_ITEM_PRICE[]" id="item-ven-price-db"></td>
                                    //     <td><input type="hidden" name="POD_ITEM_QTY[]" id="item-qty-db"></td>
                                    // </td>
                                    // <td width="5%"><span id="cur-exch-dis-line">${cur_exch_rate}<span></td>
                                    // <td width="10%"><span id="dist-amt-dis-line">0<span></td>

    function deleteTraitRow(ele) {
            $(ele).closest('tr').remove();
            
            item_arr.splice(item_arr.indexOf($(ele).closest('tr').find('td #item-code-db').val()), 1);
            tableCalculation();
        }

    // function tableCalculation() {
    //     // let cur_exch_rate = $('#cur-rate-exch').val();
    //     let cur_exch_rate = 1;
    //     let po_charge_tot = $('#tot-po-charge').html();
    //     $('#main-tot-po-charge').html(po_charge_tot*cur_exch_rate);
    //     $('#tot-po-charge-db').val(po_charge_tot*cur_exch_rate);
    //     let tableLength = parseFloat($('#tbUser tr').length);
    //     let distr_po_chgr = po_charge_tot?parseFloat(po_charge_tot)/tableLength:0;
    //     if(tableLength>0){
    //         $('.po-charge-table').removeClass('d-none');
    //         $('.po-charge-hd').removeClass('d-none');
    //     }else{
    //         $('.po-charge-table').addClass('d-none');
    //         $('.po-charge-hd').addClass('d-none');
    //     }
    //     let tot_qty = 0;
    //     let so = 1;
    //     let venChr = 0;
    //     let qty_in = 0;
    //     let item_into_qty = 0;
    //     $('#tbUser tr').each( (tr_idx,tr) => {
    //         $(tr).children('td').each( (td_idx, td) => {

    //             if(td_idx == 0){
    //                 $(td).html(so);
    //             }

    //             if(td_idx == 3){
    //                 qty_in = parseFloat($(td).text());
    //                 tot_qty = tot_qty+qty_in;
    //             }
                
    //             if(td_idx == 4){
    //                  venChr = parseFloat($(td).text())*parseFloat(cur_exch_rate)*qty_in;
    //                 //  venChr = venChr + parseFloat(distr_po_chgr);
    //                  item_into_qty = item_into_qty + venChr;
    //             }
    //             if(td_idx == 5){
    //                 $(td).html(`<span id="cur-exch-dis-line">${cur_exch_rate}<span>`);
    //             }

    //             // if(td_idx == 7){
    //             //     $(td).html(`<span class="unit-cost-sar-line" id="unit-cost-sar-line">${venChr}<span>`);
    //             //     venChr = null;
    //             // }
    //             // console.log( '[' +tr_idx+ ',' +td_idx+ '] => ' + $(td).text() + ' Distribution amt --' + distr_po_chgr);
    //         });
    //         so++;
    //         $('#tot-item-unit-amt-into-qty').html(item_into_qty);
    //         $('#tot-item-unit-amt-into-qty-db').val(item_into_qty);
    //         $('#tot-qty').html(tot_qty);
    //     });
    //     amtDistributionIndividual();
    // }
    // function amtDistributionIndividual() {
    //     // let cur_exch_rate = $('#cur-rate-exch').val(); OPTIONAL
    //     let cur_exch_rate = 1;
    //     let po_charge_tot = parseFloat($('#main-tot-po-charge').html());
    //     let tot_amt_with_unit_into_qty = $('#tot-item-unit-amt-into-qty').html();
    //     let qty_in = 0;
    //     let dist_amt = 0;
    //     let unit_cost = 0;
    //     let grand_tot = 0;
    //     $('#tbUser tr').each( (tr_idx,tr) => {
            
    //         $(tr).children('td').each( (td_idx, td) => {

    //             if(td_idx == 3){
    //                 qty_in = $(td).text(); 
    //             }

    //             if(td_idx == 4){
    //                 dist_amt = parseFloat($(td).text())*parseFloat(qty_in)*parseFloat(cur_exch_rate);

    //                 unit_cost = dist_amt;
    //                 dist_amt = (dist_amt/tot_amt_with_unit_into_qty)*100;
                   
                    
    //             }
    //             if(td_idx == 5){
    //                 dist_amt = po_charge_tot*(dist_amt/100);
    //                 let dis_u = dist_amt?dist_amt:0;
    //                 $(td).html((unit_cost+dis_u)/qty_in);
    //                 qty_in = 0;
    //             }
    //             if(td_idx == 6){
                    
    //                 $(td).html(dist_amt);
                    
    //             }

    //             if(td_idx == 7){
    //                 let dis_amt_null = dist_amt?dist_amt:0;
    //                 grand_tot = parseFloat(grand_tot)+parseFloat(dis_amt_null + unit_cost);
    //                 $(td).html(`<span class="unit-cost-sar-line" id="unit-cost-sar-line">${dis_amt_null + unit_cost}<span>`);
    //                 unit_cost = 0;
    //                 dist_amt = 0;
    //             }

    //         });
    //         $('#grand-tot').html(grand_tot);
    //     });
    // }

    function venPriceIn(ele) {
        let venVal = ele.value>0?ele.value:0;
        $(ele).closest('tr').find('td #item-ven-price-db').val(venVal);
        $(ele).closest('tr').find('td .ven-in-dis').html(venVal);
            // let cur_exch_rate = $('#cur-rate-exch').val();
        tableCalculation();
            // let tot_unit_cost = parseFloat(ele.value)*parseFloat(cur_exch_rate);
            // $(ele).closest('tr').find('td .unit-cost-sar-line').html(tot_unit_cost);
    }

    function popOrderPre() {
    //    let pop_prefix_val = $('.pur-order-pre-det').val();
       let selected = $('.pur-order-pre-det').find('option:selected');
       let nxt_num = selected.data('nxtno');
       $('.po-prefix-next-num-dis').val(nxt_num);
    }

    $(document).ready(function(){
        $('.pur-order-pre-det').empty();
            $.ajax({
                    type: "POST",
                    url: "<?= base_url('Common/getPoPrefix') ?>",
                    data: {check:1},
                    dataType: "Json",
                    success: function(resultData){
                    for (let index = 0; index < resultData.length; index++) {
                        if(resultData[index]['POP_ORDER_PFX'] == 'NPO' || resultData[index]['POP_ORDER_PFX'] == 'CPO'){
                            $('.pur-order-pre-det').append(`<option value="${resultData[index]['POP_ORDER_PFX']}" data-nxtno="${resultData[index]['POP_NEXT_NUMBER']}">${resultData[index]['POP_ORDER_PFX']}</option>`);
                        }
                    }
                }
            });

        setTimeout(popOrderPre, 1000);
    })
    
</script>
        