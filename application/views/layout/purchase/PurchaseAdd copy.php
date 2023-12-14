
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
                                    <h4 class="mb-sm-0 font-size-18">Purchase</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Purchase</h5>
                                               
                                            <div class="flex-shrink-0">
                                                <a href="<?=base_Url()?>PurchaseList" class="btn btn-primary" >View Purchase List</a>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                            
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                         
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Vendor Code / Name</label>
                                                                    <input type="text" class="form-control" onInput="vendorSearchIn(this)" placeholder="Enter Items Code ">
                                                                    <input type="hidden" name="POH_VENDOR_CODE" id="vendor-code-db">
                                                                    <label id="POH_VENDOR_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="row">
                                                                <label for="validationCustom03" class="form-label">Purchase Order No</label>
                                                                    <div class="col-md-3">
                                                                        <select class="form-control pur-order-pre-det" onChange="popOrderPre(this)">
                                                                        </select>
                                                                        <!-- <input class="form-control" type="text" name="item_rev_date"> -->
                                                                    </div>
                                                                    <div class="col-md-9">
                                                                        <input class="form-control po-prefix-next-num-dis" type="text" name="item_rev_date">
                                                                    </div>
                                                                <label id="V_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                         <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Order Date</label>
                                                                    	<input class="form-control" type="date" name="POH_ORDER_DATE" value="2022-11-30">
                                                                    <label id="POH_ORDER_DATE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Class</label>
                                                                    <input type="text" class="form-control" name="POH_CLASS" >
                                                                    <label id="POH_CLASS-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <table>
                                                                <tr>
                                                                    <td>Vendor Code</td>
                                                                    <td id="v-code"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Vendor Name</td>
                                                                    <td id="v-name"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Vendor Contact</td>
                                                                    <td id="v-contact"></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Reference No</label>
                                                                    	<input class="form-control" type="text" name="POH_REF_NO_1">
                                                                    <label id="POH_REF_NO_1-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Reference No 2</label>
                                                                    <input type="text" class="form-control" name="POH_REF_NO_2" >
                                                                    <label id="POH_REF_NO_2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Status</label>
                                                                    <select class="form-select" name="POH_STATUS">
                                                                        <option value="1">Open</option>
                                                                        <option value="0">Close</option>
                                                                    </select>
                                                                    <label id="POH_STATUS-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-1">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                            <input class="form-check-input" value="1" type="checkbox" id="formCheck1" name="POH_HOLD_FLAG">
                                                            <label class="form-check-label" for="formCheck1">Hold Flag</label>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Ship via</label>
                                                                    <input class="form-control" onInput="shipViaIn(this)" type="text">
                                                                    <input type="hidden" name="POH_SHIP_VIA_CODE" id="ship-via-db">
                                                                    <label id="POH_SHIP_VIA_CODE-error" class="error"></label>
                                                                    <label id="ship-via-in-det"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Freight</label>
                                                                    <input class="form-control" type="text" onInput="freightIn(this)">
                                                                    <input type="hidden" name="POH_FREIGHT_CODE" id="freight-code-db">
                                                                    <label id="POH_FREIGHT_CODE-error" class="error"></label>
                                                                    <label id="frt-in"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Terms</label>
                                                                    <input type="text" class="form-control" onInput="termIn(this)">
                                                                    <input type="hidden" name="POH_TERMS_CODE" id="term-db">
                                                                    <label id="POH_TERMS_CODE-error" class="error"></label>
                                                                    <label id="term-in"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">FOB</label>
                                                                    <input type="text" class="form-control" onInput="fobIn(this)">
                                                                    <input type="hidden" name="POH_FOB_CODE" id="fob-db">
                                                                    <label id="POH_FOB_CODE-error" class="error"></label>
                                                                    <label id="fob-in"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                          <div class="card-body border-bottom" style="margin-bottom: 20px;">
                                                            <div class="d-flex align-items-center">
                                                                <h5 class="mb-0 card-title flex-grow-1"><i class="mdi mdi-arrow-right text-primary"></i>Currency and Price List</h5>
                                                            </div>
                                                        </div> 
                                                        
                                                        
                                                        <!-- <div class="col-md-6">
                                                        	<div class="mb-3 row">
                                                        	    
                                                        	    
                                                            <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Currency</label>
                                                                    	<input class="form-control" type="text" onInput="curExtRate(this.value,1)" name="item_rev_date" placeholder="SAR">
                                                                    <label id="V_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12 d-none cur-exc-rate-dis-main-div">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Exchange Rate</label>
                                                                    	<input class="form-control cur-exh-rate-val" type="text" name="item_rev_date" placeholder="Exchange Rate" disabled>
                                                                    	<span class="text-muted cur-exh-rate-dis"></span>
                                                                    <label id="V_NAME-error" class="error"></label>
                                                            </div>
                                                        </div> -->
                                                        
                                                        </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                        	<div class="mb-3 row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="validationCustom03" class="form-label">Currency exchange</label>
                                                                        <input type="text" class="form-control" onInput="curExtRate(this.value,2)" name="V_NAME_AR" placeholder="SAR" >
                                                                        <label id="V_NAME_AR-error" class="error"></label>
                                                                    </div>
                                                                </div>
                                                        
                                                            <!-- <div class="col-md-4 d-none cur-pri-lit-main-div">
                                                                <div class="mb-3">
                                                                    
                                                                    <label for="validationCustom03" class="form-label">Price List Currency</label>
                                                                        <input type="text" class="form-control cur-pri-lis-val" name="V_NAME_AR"  placeholder="USD">
                                                                        <label id="V_NAME_AR-error" class="error"></label>
                                                                </div>
                                                            </div> -->
                                                            <div class="col-md-6 d-none cur-pri-lit-exch-rate-main-div">
                                                                <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">Exchange Rate</label>
                                                                    <input type="text" class="form-control cur-pri-lis-exch-rate-val" name="V_NAME_AR" placeholder="3.75" disabled>
                                                                    <span class="text-muted cur-pri-lis-exch-rate-dis"></span>
                                                                    <label id="V_NAME_AR-error" class="error"></label>
                                                                </div>
                                                            </div>
                                                           <!-- <div class="col-md-4 d-none cur-pri-lit-main-div"> 
                                                                <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                    <div class="form-check mb-3">
                                                                        <input class="form-check-input" type="checkbox" id="formCheck1">
                                                                        <label class="form-check-label" for="formCheck1">Ignore Pricing Rule</label>
                                                                    </div>
                                                                </div>
                                                            </div> -->
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
                                                                                    <th width="10%">Item No</th>
                                                                                    <th width="20%">Description</th>
                                                                                    <th width="15%">Qty</th>
                                                                                    <th width="20%">V Price</th>
                                                                                    <th width="5%">Exchange Rate</th>
                                                                                    <th width="10%">Distribution Amount</th>
                                                                                    <th width="100%">Unit Cost in SAR</th>
                                                                                    <th width="5%">Del.</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="tbUser">
                                                                                <!-- <tr>
                                                                                    <td width="5%">1</td>
                                                                                    <td width="10%">02288888</td>
                                                                                    <td width="20%">Ring</td>
                                                                                    <td width="15%"><input type="text" class="form-control" name="V_NAME_AR" value="1"></td>
                                                                                    <td width="20%"><input type="text" class="form-control" name="V_NAME_AR2" value="100" /></td>
                                                                                    <td width="5%"><span class="gqty" id="tknqty11">3.77</span> </td>
                                                                                    <td width="10%">1433.33 </td>
                                                                                    <td width="100%">1808.33</td>
                                                                                    <td width="10%"><i id="11" class="delete fa fa-trash"></i></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="5%">2</td>
                                                                                    <td width="10%">02277777</td>
                                                                                    <td width="20%">Bracelet</td>
                                                                                    <td width="15%"><input type="text" class="form-control" name="V_NAME_AR" value="1"></td>
                                                                                    <td width="20%"><input type="text" class="form-control" name="V_NAME_AR2" value="50" /></td>
                                                                                    <td width="5%"><span class="gqty" id="tknqty11">3.77</span> </td>
                                                                                    <td width="10%">1433.33 </td>
                                                                                    <td width="100%">1620.83</td>
                                                                                    <td width="10%"><i id="11" class="delete fa fa-trash"></i></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="5%">3</td>
                                                                                    <td width="10%">02277777</td>
                                                                                    <td width="20%">Bangle</td>
                                                                                    <td width="15%"><input type="text" class="form-control" name="V_NAME_AR" value="1"></td>
                                                                                    <td width="20%"><input type="text" class="form-control" name="V_NAME_AR2" value="25" /></td>
                                                                                    <td width="5%"><span class="gqty" id="tknqty11">3.77</span> </td>
                                                                                    <td width="10%">1433.33 </td>
                                                                                    <td width="100%">1527.08</td>
                                                                                    <td width="10%"><i id="11" class="delete fa fa-trash"></i></td>
                                                                                </tr> -->
                                                                            </tbody>
                                                                        </table>
                                                                        <input type="button" class="btn btn-success mt-3 mt-lg-0" onCLick="additemLine()" value="Add item line row"/>
                                                                    </div>
                                                                </div> 
                                                            </div>

                                                            <h5 class="font-size-14 card-body border-bottom po-charge-hd"><i class="mdi mdi-arrow-right text-primary"></i>Charges</h5>
                                
                                                            <div class="col-md-6">
                                        
                                                                <!-- <div class="mb-3">
                                                                    <label for="validationCustom03" class="d-none form-label po-charge-hd">Charges</label>
                                                                </div> -->
                                            
                                                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="d-none table table-hover table-striped table-bordered po-charge-table">
                                                                    <tr>
                                                                        <td style="width: 12%;"><input type="text" class="form-control" onInput="poChargeIn(this)"></td>
                                                                        <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                                                        <td style="width: 12%;"><input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> <span class="d-none po-charge-val-dis">0</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 12%;"><input type="text" class="form-control" onInput="poChargeIn(this)"></td>
                                                                        <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                                                        <td style="width: 12%;"><input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> <span class="d-none po-charge-val-dis">0</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 12%;"><input type="text" class="form-control" onInput="poChargeIn(this)"></td>
                                                                        <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                                                        <td style="width: 12%;"><input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> <span class="d-none po-charge-val-dis">0</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 12%;"><input type="text" class="form-control" onInput="poChargeIn(this)"></td>
                                                                        <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                                                        <td style="width: 12%;"><input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> <span class="d-none po-charge-val-dis">0</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 12%;"><input type="text" class="form-control" onInput="poChargeIn(this)"></td>
                                                                        <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                                                        <td style="width: 12%;"><input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"><span class="d-none po-charge-val-dis">0</span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 12%;"></td>
                                                                        <td style="width: 12%;">Total</td>
                                                                        <td style="width: 12%;"><span id="tot-po-charge">0</span></td>
                                                                    </tr>
                                                                </table>
                                                            </div>                   
                                                            <div class="col-xl-12">                        	                     	    
                                                                <div class="col-md-12">
                                                                    <table width="100%" class="table table-bordered" >
                                                                        <tbody>
                                                                            
                                                                            <tr>
                                                                                <td width="70%" align="right"><b>Total Qty:</b> </td>
                                                                                <td width="30%" align="left"><span id="tot-qty">0</span></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="70%" align="right"><b>Subtol:</b> </td>
                                                                                <td width="30%" align="left">SAR <span id="gsubtol">0</span></td>
                                                                            </tr>
                                                                            <!-- strt -->
                                                                            <tr>
                                                                                <td width="70%" align="right"><b>PO Charges:</b> </td>
                                                                                <input type="hidden" name="gtoltax" id="gtoltaxid" value="217.65">
                                                                                <td width="30%" align="left">SAR <span id="main-tot-po-charge">0</span></td>
                                                                            </tr>
                                                                            <!-- end -->
                                                                            <!-- <tr style="display:none;"> -->
                                                                            <tr>
                                                                                <td width="70%" align="right"><b>Grand Total:</b> </td>
                                                                                <td width="30%" align="left" style="    font-size: 0.8cm;    font-weight: bold;">SAR <span id="grand-tot">0</span> </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                <div>
                                                    <button data-control="purchase/purchase-add" data-form="formdata" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Purchase</button>
                                                </div>
                                                <span id="outmsg"></span>
                                            
                                        </div>
                                        <!-- JS DATA -->
                                            <input type="hidden" id="cur-rate-exch">
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
   

    // PO CHARGE
    
    function poChargeIn(ele) {

        if(ele.value.length>=2){
            $.ajax({
                type: "POST",
                url: "<?=base_url('Common/getPOChargeByPoCode')?>",
                data: {po_charge_type:ele.value},
                dataType: "Json",
                success: function(resultData){
                    console.log(resultData);
                    if(resultData.po_charge_det){
                        $(ele).closest('tr').find('td .po-char-in-val-dis').prop('disabled', false);
                        $(ele).closest('tr').find('td .po-char-in-val-dis').val('');
                        $(ele).closest('tr').find('td #po-charge-desc-dis').html(resultData.po_charge_det['CHRG_DESC']);
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
            $(ele).val(0);
            in_Value = 0;
        }

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
            $('#tot-po-charge').html(tot_po_charge);
        });

        tableCalculation();
    }

    //PO CHARGE END
    function vendorSearchIn(ele) {
        $('#vendor-code-db').val('');
        if(ele.value.length>3){
            $.ajax({
                type: "POST",
                url: "<?=base_url('Common/getVenDelByVenCode')?>",
                data: {ven_code:ele.value},
                dataType: "Json",
                success: function(resultData){
                    console.log(resultData);
                    if(resultData.ven_det){
                        $('.item-line-table-dis').removeClass('d-none');
                        $('#v-code').html(`<span class='text-success v-code-dis'>${resultData.ven_det['V_CODE']}</span>`);
                        $('#v-name').html(`<span class='text-success'>${resultData.ven_det['V_NAME']}</span>`);
                        $('#v-contact').html(`<span class='text-success'>${resultData.ven_det['V_CONTACT']}</span>`);

                        $('#vendor-code-db').val(resultData.ven_det['V_CODE']);
                        // $('#class_desc_in').val(resultData[0]['IC_DESC']);
                    }else{
                        $('.item-line-table-dis').addClass('d-none');
                        $('#v-code').html(`<span class='text-warning v-code-dis'>DATA NOT AVAILABLE</span>`);
                        $('#v-name').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                        $('#v-contact').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                        // $('#class_desc_in').val('');
                    }
                }
            });
        }else{
            $('.item-line-table-dis').addClass('d-none');
            $('#v-code').html(`<span class='text-warning v-code-dis'>DATA FETCHING...</span>`);
            $('#v-name').html(`<span class='text-warning'>DATA FETCHING...</span>`);
            $('#v-contact').html(`<span class='text-warning'>DATA FETCHING...</span>`);
        }
    }

    function shipViaIn(ele) {
        $('#ship-via-db').val('');
       
        if(ele.value.length>=2){
            $.ajax({
                type: "POST",
                url: "<?=base_url('Common/getShipDetByShipCode')?>",
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
                url: "<?=base_url('Common/getFreightDelByfreightCode')?>",
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

    function termIn(ele) {
        $('#term-db').val('');
        if(ele.value.length>=2){
            $.ajax({
                type: "POST",
                url: "<?=base_url('Common/getTermdetBytermCode')?>",
                data: {term_code:ele.value},
                dataType: "Json",
                success: function(resultData){
                    console.log(resultData);
                    if(resultData.term_det){
                        $('#term-in').html(`<span class='text-success'>${resultData.term_det['TERM_CODE']} - ${resultData.term_det['TERM_DESC']}</span>`);
                        $('#term-db').val(resultData.term_det['TERM_CODE']);

                    }else{
                        $('#term-in').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                    }
                }
            });
        }else if(ele.value.length>=1){
            $('#term-in').html(`<span class='text-warning'>DATA FETCHING...</span>`);
        }else{
            $('#term-in').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
        }
    }

    function fobIn(ele) {
        $('#fob-db').val('');

        if(ele.value.length>=2){
            $.ajax({
                type: "POST",
                url: "<?=base_url('Common/getFobdetByFobCode')?>",
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
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getCurExhRateByCurCode')?>",
            data: {cur_exh_code:ele},
            dataType: "Json",
            success: function(resultData){
                console.log(resultData);
                if(type==1){
                    if(resultData.cur_exh_det && ele.length>2){
                        
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
    // item Line
    function additemLine() {
            $('.po-charge-table').removeClass('d-none');
            $('.po-charge-hd').removeClass('d-none');
            let tableLength = $('#tbUser tr').length+1;
            let cur_exch_rate = $('#cur-rate-exch').val();
            // let index = document.getElementsByTagName("table")[0].childElementCount;
            $('#tbUser').append(`<tr>
                                    <td width="5%"><span>${tableLength}<span></td>
                                    <td width="10%"><input type="text" onInput='itemSearchIn(this)' class="form-control"/></td>
                                    <td width="20%"><span id="i-desc"></span></br><span id="i-ext-desc"></span></td>
                                    <td width="15%"><input type="number" class="form-control" onInput='qtyIn(this)' value="1"><span class="d-none qty-in">1</span></td>
                                    <td width="20%"><span class="d-none ven-in-dis">0</span><input type="number" class="form-control ven-pri-in-val" onInput="venPriceIn(this)" name="V_NAME_AR2" /></td>
                                    <td width="5%"><span id="cur-exch-dis-line">${cur_exch_rate}<span></td>
                                    <td width="10%"><span id="dist-amt-dis-line">0<span></td>
                                    <td width="100%"><span class="unit-cost-sar-line" id="unit-cost-sar-line">0<span></td>
                                    <td width="10%"><a onClick='deleteTraitRow(this)'><i id="11" class="delete fa fa-trash"></i></a></td>
                                </tr>`);
    }

    function deleteTraitRow(ele) {
            $(ele).closest('tr').remove();
            tableCalculation();
        }

    function tableCalculation() {
        let po_charge_tot = $('#tot-po-charge').html();
        $('#main-tot-po-charge').html(po_charge_tot);
        let tableLength = parseFloat($('#tbUser tr').length);
        let distr_po_chgr = po_charge_tot?parseFloat(po_charge_tot)/tableLength:0;
        if(tableLength>0){
            $('.po-charge-table').removeClass('d-none');
            $('.po-charge-hd').removeClass('d-none');
        }else{
            $('.po-charge-table').addClass('d-none');
            $('.po-charge-hd').addClass('d-none');
        }
        let grand_tot = 0;
        let tot_qty = 0;
        let so = 1;
        let cur_exch_rate = $('#cur-rate-exch').val();
        let venChr = 0;
        let qty_in = 0;
        $('#tbUser tr').each( (tr_idx,tr) => {
            $(tr).children('td').each( (td_idx, td) => {

                if(td_idx == 0){
                    $(td).html(so);
                }

                if(td_idx == 3){
                    qty_in = parseFloat($(td).text());
                    tot_qty = tot_qty+qty_in;
                }
                
                if(td_idx == 5){

                    $(td).html(`<span id="cur-exch-dis-line">${cur_exch_rate}<span>`);
                }
                if(td_idx == 4){
                     venChr = parseFloat($(td).text())*parseFloat(cur_exch_rate)*qty_in;
                     venChr = venChr + parseFloat(distr_po_chgr);
                     grand_tot = venChr+grand_tot
                }
                if(td_idx == 6){
                    $(td).html(distr_po_chgr);
                }
                if(td_idx == 7){
                    $(td).html(`<span class="unit-cost-sar-line" id="unit-cost-sar-line">${venChr}<span>`);
                    venChr = null;
                }
                console.log( '[' +tr_idx+ ',' +td_idx+ '] => ' + $(td).text() + ' Distribution amt --' + distr_po_chgr);
            }); 
            so++;
            $('#tot-qty').html(tot_qty);
            $('#grand-tot').html(grand_tot);
        });
        
    }
    function itemSearchIn(ele) {
        
        if(ele.value.length>3){
            let v_code = $('.v-code-dis').html();
            $.ajax({
                type: "POST",
                url: "<?=base_url('Common/getitemDetByItemCode')?>",
                data: {item_code:ele.value,v_code},
                dataType: "Json",
                success: function(resultData){
                    
                    if(resultData.item_det){
                        $(ele).closest('tr').find('td #i-desc').html(resultData.item_det[0]['I_DESC']);
                        $(ele).closest('tr').find('td #i-ext-desc').html(resultData.item_det[0]['I_EXTEND_DESC']);

                        $(ele).closest('tr').find('td .ven-pri-in-val').val(0);
                        $(ele).closest('tr').find('td .ven-in-dis').html(0);
                    }else{
                        $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
                        $(ele).closest('tr').find('td #i-ext-desc').html('');

                        $(ele).closest('tr').find('td .ven-pri-in-val').val(0);
                        $(ele).closest('tr').find('td .ven-in-dis').html(0);
                    }
                }
            });
        }else{
            $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
            $(ele).closest('tr').find('td #i-ext-desc').html('');

            $(ele).closest('tr').find('td .ven-pri-in-val').val(0);
            $(ele).closest('tr').find('td .ven-in-dis').html(0);
        }
        tableCalculation();
    }

    function venPriceIn(ele) {
        let venVal = ele.value>0?ele.value:0;
   
        $(ele).closest('tr').find('td .ven-in-dis').html(venVal);
        // let cur_exch_rate = $('#cur-rate-exch').val();
        tableCalculation();
        // let tot_unit_cost = parseFloat(ele.value)*parseFloat(cur_exch_rate);
        // $(ele).closest('tr').find('td .unit-cost-sar-line').html(tot_unit_cost);
    }

    function qtyIn(ele) {
        let qty_in = ele.value>0?ele.value:0;
        $(ele).closest('tr').find('td .qty-in').html(qty_in);
        tableCalculation();
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
                    url: "<?=base_url('Common/getPoPrefix')?>",
                    data: {check:1},
                    dataType: "Json",
                    success: function(resultData){
                    for (let index = 0; index < resultData.length; index++) {
                        $('.pur-order-pre-det').append(`<option value="${resultData[index]['POP_ORDER_PFX']}" data-nxtno="${resultData[index]['POP_NEXT_NUMBER']}">${resultData[index]['POP_ORDER_PFX']}</option>`);
                    }
                }
            });

            
            setTimeout(popOrderPre, 1000)
        })
    
</script>
        