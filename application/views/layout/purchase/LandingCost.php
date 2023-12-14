<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Add Landing Cost</h4>

                                    <!-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Add item trait</li>
                                        </ol>
                                    </div> -->

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <form id="formdata">
                                        <h4 class="card-title mb-4">Landing Cost</h4>
                                            <div class="row">
                                                <div  class="mb-3 col-lg-3">
                                                    <label for="name">Clearance #</label>
                                                    <input type="text" class="form-control clearance-id-dsp" disabled="true"/>
                                                    <input type="hidden" name="clearance_id_db" id="clearance-id-db">
                                                    <label id="clearance_id_db-error" class="error"></label>
                                                </div>
                                                <div  class="mb-3 col-lg-3">
                                                    <label for="name">Period</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text clear-period-dsp" id="option-date">data fetching..</span>
                                                        <input type="text" class="form-control clear-year-dsp" value="data fetching.."
                                                            aria-describedby="option-date" placeholder="null" disabled="true">
                                                    </div>
                                                </div>
                                                <div  class="mb-3 col-lg-3">
                                                    <label for="name">Date</label>
                                                    <input type="text" class="form-control clear-date-dsp" disabled="true"/>
                                                    <label id="item-code-error" class="error"></label>
                                                </div>
                                                <div  class="mb-3 col-lg-3">
                                                    <label for="name">Posted</label>
                                                    <input type="text" class="form-control clear-post-dsp" disabled="true"/>
                                                    <label id="item-code-error" class="error"></label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div  class="mb-3 col-lg-3">
                                                    <label for="name">Order id</label>
                                                    <input type="text" value='<?=$orderid?>' onInput='orderIn(this)' class="form-control" <?=$sesData->USER_TYPE == 'USER'?'disabled':''?>>
                                                    <input type="hidden" name="po_order_db" id="po-order-db">
                                                    <input type="hidden" name="po_temp_order_db" id="po-temp-order-db">
                                                    <label id="po_order_db-error" class="error"></label>
                                                </div>
                                                <div  class="mb-3 col-lg-3">
                                                    <label for="name">Exchange Rate</label>
                                                    <input type="text" class="form-control cur-exch-val" disabled="true">
                                                    <span class="d-none cur-exch-rate-usd"></span>
                                                    <label class="text-primary cur-exch-date-dsp"></label>
                                                </div>
                                            </div>

                                            <h5 class="font-size-14 card-body border-bottom"><i class="mdi mdi-arrow-right text-primary"></i> Item Line</h5>
                                            <div class="col-xl-12">
                                                <div class="form-row">
                                                    <div style="overflow-x:auto; overflow-y:hidden; /* white-space:nowrap; */ margin:0 10px;" class="ftable col-md-12">
                                                        <table class="table table-hover table-striped table-bordered ">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5%">Sn.</th>
                                                                    <th width="18%">Item No</th>
                                                                    <th width="20%">Description</th>
                                                                    <th width="15%">Qty</th>
                                                                    <!-- <th width="20%">V Price</th> -->
                                                                    <th width="30%">Unit Price</th>
                                                                    <!--<th width="10%">Distribution Amount in SAR</th>-->
                                                                    <!-- <th width="100%">Final Price</th> -->
                                                                    <!-- <th width="5%">Del.</th> -->
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbUser">
                                                                
                                                            </tbody>
                                                        </table>
                                                        <!-- <input type="button" class="btn btn-success mt-3 mt-lg-0" onCLick="additemLine()" value="Add item line row"/> -->
                                                    </div>
                                                </div> 
                                            </div>
                                            <h5 class="font-size-14 card-body border-bottom po-charge-hd"><i class="mdi mdi-arrow-right text-primary"></i>Landing Charges</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    
                                                    <table id="tableDet" width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered po-charge-table">
                                                        <tbody>

                                                        </tbody>
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
                                                                    <td width="30%" align="left">SAR <span id="tot-item-unit-amt-into-qty"></span></td>
                                                                    <td class="d-none">
                                                                        <b>total item unit X QTY</b>
                                                                        <!-- <span id="tot-item-unit-amt-into-qty"></span> -->
                                                                        <input type="hidden" name="tot_item_into_qty" id="tot-item-unit-amt-into-qty-db">
                                                                    </td>
                                                                </tr>
                                                                <!-- strt -->
                                                                <tr>
                                                                    <td width="70%" align="right"><b>Landed Cost:</b> </td>
                                                                    <input type="hidden" name="gtoltax" id="gtoltaxid">
                                                                    <td width="30%" align="left">
                                                                        SAR 
                                                                        <span id="main-tot-po-charge">0</span>
                                                                        <input type="hidden" name="tot_po_charge" id="tot-po-charge-db">
                                                                    </td>
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
                                            <!-- <input type="button" class="btn btn-success mt-3 mt-lg-0" value="Add row"/> -->
                                            <input type="hidden" id="item_code_min" name="item_Code_p" value='<?=$orderid?>'>
                                            <?php if(dashRole(["role_check"=>"PURCHASE_FREIGHT_UPDATE"])){ ?>              
                                                <button data-control="purchase/landed-cost-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->purLandedCostAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->purLandedCostAdd->cont?>" data-aftreload="true" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Submit Landing Cost</button>             
                                            <?php } ?>

                                            <span id="outmsg"></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            <!-- end main content-->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

            <script>
                window.curent_cur = 'SAR';

                function orderIn(ele){
                    
                    $('.error').empty();

                    $('#po-temp-order-db').val('');
                    $('#po-order-db').val('');
                    $('#clearance-id-db').val('');
                    $('.clearance-id-dsp').val('No data Found');
                    $('.clear-period-dsp').html('No data Found');
                    $('.clear-year-dsp').val('No data Found');
                    $('.clear-date-dsp').val('No data Found');
                    $('.clear-post-dsp').val('No data Found');

                    $('.cur-exch-val').val('No data Found');
                    $('#tbUser').empty();
                    $('#tableDet tbody').empty();
                    $('#tot-qty').html(0);
                    $('#tot-item-unit-amt-into-qty').html(0);
                    $('#main-tot-po-charge').html(0);
                    $('#grand-tot').html(0);

                    $.ajax({
                            type: "POST",
                            url: "<?=base_url('Common/getLandingCostByOrderid')?>",
                            data: {order_id:ele.value},
                            dataType: "Json",
                            success: function(resultData){
                              
                                let landing_det = resultData.landing_det;
                                let pur_itm_det = resultData.pur_item_det;
                                let pur_header_det = resultData.pur_header_det;
                                let clearance_det = resultData.clearance_det;
                                if(clearance_det['INV_POSTED'] == 'Y'){
                                    $('.ajaxform').prop('disabled',true);
                                }

                                let tableLength = $('#tbUser tr').length+1;
                                let cur_exch_rate = pur_header_det[0]['EXCHR_BUY_RATE'];
                                $('.cur-exch-val').val(pur_header_det[0]['CUR_ABBRV']+' 1 = SAR '+pur_header_det[0]['EXCHR_BUY_RATE']);
                                $('.cur-exch-date-dsp').html('Currency Exchange Rate Date : '+dateFormat1(pur_header_det[0]['EXCHR_START_DATE']));
                                $('.cur-exch-rate-usd').html(pur_header_det[0]['EXCHR_BUY_RATE']);
                                
                                $('.clearance-id-dsp').val(clearance_det['INV_CL_NO']);
                                $('.clear-period-dsp').html(clearance_det['INV_PERIOD']);
                                $('.clear-year-dsp').val(clearance_det['INV_YEAR']);
                                $('.clear-date-dsp').val(clearance_det['INV_DATE']);
                                $('.clear-post-dsp').val(clearance_det['INV_POSTED']);
                                $('#clearance-id-db').val(clearance_det['INV_CL_NO']);
                                $('#po-temp-order-db').val(pur_header_det[0]['POH_TEMP_ORDER_ID']);
                                $('#po-order-db').val(pur_header_det[0]['POH_PREFIX']+pur_header_det[0]['POH_ORDER_ID']);

                                for (let addItmTr = 0; addItmTr < pur_itm_det.length; addItmTr++) {
                                    let unitCostLineLoop = Number(pur_itm_det[addItmTr]['POD_UNIT_COST']*cur_exch_rate).toFixed(4);
                                    $('#tbUser').append(`<tr>
                                            <td width="5%">
                                                <span>${addItmTr+1}<span>
                                            </td>
                                            <td width="18%">
                                                <input type="text" onInput='itemSearchIn(this)' value="${pur_itm_det[addItmTr]['I_CODE']}" class="form-control" disabled="true"/>
                                            </td>
                                            <td width="20%">
                                                <span id="i-desc">${pur_itm_det[addItmTr]['I_DESC']}</span>
                                                </br>
                                                <span id="i-ext-desc">${pur_itm_det[addItmTr]['I_EXTEND_DESC']}</span>
                                            </td>
                                            <td width="15%">
                                                <input type="text" class="form-control" onInput='qtyIn(this)' value="${pur_itm_det[addItmTr]['POD_ITEM_QTY']}" disabled="true">
                                                <span class="d-none qty-in">${pur_itm_det[addItmTr]['POD_ITEM_QTY']}</span>
                                            </td>
                                            <td width="20%" class="d-none">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="option-date">${curent_cur}</span>
                                                    <input type="text" class="form-control" value="${pur_itm_det[addItmTr]['POD_UNIT_COST']*cur_exch_rate}"
                                                        aria-describedby="option-date" placeholder="null" disabled="true">
                                                </div>
                                                <span class="d-none ven-in-dis">${pur_itm_det[addItmTr]['POD_UNIT_COST']*cur_exch_rate}</span>
                                            </td>
                                            
                                            <td width="5%">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="option-date1">${curent_cur}</span>
                                                    <input type="text" class="form-control final-pri-val" value="${unitCostLineLoop}"
                                                        aria-describedby="option-date1" placeholder="null" disabled="true">
                                                </div>
                                                <span id="unit-pri-dis-amt-dsp" class="d-none">${unitCostLineLoop}<span>
                                            </td>
                                            <td width="10%" class="d-none">
                                                <span id="dist-amt-dis-line">0<span>
                                            </td>

                                            <td width="100%" class="d-none"><span class="unit-cost-sar-line" id="unit-cost-sar-line">0<span></td>
                                            <td width="10%">
                                                <input type="hidden" name="POD_ITEM_CODE[]" id="item-code-db">
                                                <input type="hidden" name="POD_UNIT_COST[]" id="item-ven-price-db">
                                                <input type="hidden" name="POD_ITEM_QTY[]" id="item-qty-db">
                                            </td>
                                            
                                        </tr>`);
                                    
                                }

                                for (let index = 0; index < landing_det.length; index++) {
                                    
                                    $('#tableDet tbody').append(`<tr>
                                                            <td style="width: 12%;">
                                                                <input type="text" class="form-control" onInput="poChargeIn(this)" value="${landing_det[index]['PODC_PO_CHARGE_CODE']}">
                                                                <input type="hidden" name="PODC_PO_CHARGE_CODE[]" id="po-charge-code-db">
                                                            </td>
                                                            <td style="width: 12%;"><span id="po-charge-desc-dis">${landing_det[index]['CHRG_DESC']}</span></td>
                                                            <td style="width: 12%;">
                                                                <input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" value="${landing_det[index]['PODC_PO_CHARGE_AMT']}"> 
                                                                <span class="d-none po-charge-val-dis">${landing_det[index]['PODC_PO_CHARGE_AMT']}</span>
                                                                <input type="hidden" name="PODC_PO_CHARGE_AMT[]" id="po-charge-amt-db">
                                                            </td>
                                                        </tr>`);
                                }
                                for (let addLandTr = 0; addLandTr < 5-landing_det.length; addLandTr++) {
                                    $('#tableDet tbody').append(`<tr>
                                                        <td style="width: 12%;">
                                                            <input type="text" class="form-control" onInput="poChargeIn(this)" placeholder="Enter PO Charge Code">
                                                            <input type="hidden" name="PODC_PO_CHARGE_CODE[]" id="po-charge-code-db">
                                                        </td>
                                                        <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                                        <td style="width: 12%;">
                                                            <input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> 
                                                            <span class="d-none po-charge-val-dis">0</span>
                                                            <input type="hidden" name="PODC_PO_CHARGE_AMT[]" id="po-charge-amt-db">
                                                        </td>
                                                    </tr>`);
                                }

                                poChargeCal();
                            // for (let index = 0; index < resultData.length; index++) {
                            //     $('.pur-order-pre-det').append(`<option value="${resultData[index]['POP_ORDER_PFX']}" data-nxtno="${resultData[index]['POP_NEXT_NUMBER']}">${resultData[index]['POP_ORDER_PFX']}</option>`);
                            // }
                        }
                    });
                }
                $(document).ready(function(){
                    $.ajax({
                            type: "POST",
                            url: "<?=base_url('Common/getLandingCostByOrderid')?>",
                            data: {order_id:'<?=$orderid?>'},
                            dataType: "Json",
                            success: function(resultData){
                                console.log(resultData);
                                let landing_det = resultData.landing_det;
                                let pur_itm_det = resultData.pur_item_det;
                                let pur_header_det = resultData.pur_header_det;
                                let clearance_det = resultData.clearance_det;
                                if(clearance_det['INV_POSTED'] == 'Y'){
                                    $('.ajaxform').prop('disabled',true);
                                }
                                let tableLength = $('#tbUser tr').length+1;
                                let cur_exch_rate = pur_header_det[0]['EXCHR_BUY_RATE'];
                                $('.cur-exch-val').val(pur_header_det[0]['CUR_ABBRV']+' 1 = SAR '+pur_header_det[0]['EXCHR_BUY_RATE']);
                                $('.cur-exch-date-dsp').html('Currency Exchange Rate Date : '+dateFormat1(pur_header_det[0]['EXCHR_START_DATE']));
                                $('.cur-exch-rate-usd').html(pur_header_det[0]['EXCHR_BUY_RATE']);

                                $('.clearance-id-dsp').val(clearance_det['INV_CL_NO']);
                                $('.clear-period-dsp').html(clearance_det['INV_PERIOD']);
                                $('.clear-year-dsp').val(clearance_det['INV_YEAR']);
                                $('.clear-date-dsp').val(clearance_det['INV_DATE']);
                                $('.clear-post-dsp').val(clearance_det['INV_POSTED']);
                                $('#clearance-id-db').val(clearance_det['INV_CL_NO']);

                                $('#po-temp-order-db').val(pur_header_det[0]['POH_TEMP_ORDER_ID']);
                                $('#po-order-db').val('<?=$orderid?>');

                                for (let addItmTr = 0; addItmTr < pur_itm_det.length; addItmTr++) {
                                    let unitCostLineLoop = Number(pur_itm_det[addItmTr]['POD_UNIT_COST']*cur_exch_rate).toFixed(4);
                                    $('#tbUser').append(`<tr>
                                            <td width="5%">
                                                <span>${addItmTr+1}<span>
                                            </td>
                                            <td width="18%">
                                                <input type="text" onInput='itemSearchIn(this)' value="${pur_itm_det[addItmTr]['I_CODE']}" class="form-control" disabled="true"/>
                                            </td>
                                            <td width="20%">
                                                <span id="i-desc">${pur_itm_det[addItmTr]['I_DESC']}</span>
                                                </br>
                                                <span id="i-ext-desc">${pur_itm_det[addItmTr]['I_EXTEND_DESC']}</span>
                                            </td>
                                            <td width="15%">
                                                <input type="text" class="form-control" onInput='qtyIn(this)' value="${pur_itm_det[addItmTr]['POD_ITEM_QTY']}" disabled="true">
                                                <span class="d-none qty-in">${pur_itm_det[addItmTr]['POD_ITEM_QTY']}</span>
                                            </td>
                                            <td width="20%" class="d-none">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="option-date">${curent_cur}</span>
                                                    <input type="text" class="form-control" value="${pur_itm_det[addItmTr]['POD_UNIT_COST']*cur_exch_rate}"
                                                        aria-describedby="option-date" placeholder="null" disabled="true">
                                                </div>
                                                <span class="d-none ven-in-dis">${pur_itm_det[addItmTr]['POD_UNIT_COST']*cur_exch_rate}</span>
                                            </td>
                                            
                                            <td width="5%">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="option-date1">${curent_cur}</span>
                                                    <input type="text" class="form-control final-pri-val" value="${unitCostLineLoop}"
                                                        aria-describedby="option-date1" placeholder="null" disabled="true">
                                                </div>
                                                <span id="unit-pri-dis-amt-dsp" class="d-none">${unitCostLineLoop}<span>
                                            </td>
                                            <td width="10%" class="d-none">
                                                <span id="dist-amt-dis-line">0<span>
                                            </td>

                                            <td width="100%" class="d-none"><span class="unit-cost-sar-line" id="unit-cost-sar-line">0<span></td>
                                            <td width="10%">
                                                <input type="hidden" id="item-code-db">
                                                <input type="hidden" id="item-ven-price-db">
                                                <input type="hidden" id="item-qty-db">
                                            </td>
                                            
                                        </tr>`);
                                    
                                }

                                for (let index = 0; index < landing_det.length; index++) {
                                    
                                    $('#tableDet').append(`<tr>
                                                            <td style="width: 12%;">
                                                                <input type="text" class="form-control" onInput="poChargeIn(this)" value="${landing_det[index]['PODC_PO_CHARGE_CODE']}">
                                                                <input type="hidden" name="PODC_PO_CHARGE_CODE[]" value="${landing_det[index]['PODC_PO_CHARGE_CODE']}" id="po-charge-code-db">
                                                            </td>
                                                            <td style="width: 12%;"><span id="po-charge-desc-dis">${landing_det[index]['CHRG_DESC']}</span></td>
                                                            <td style="width: 12%;">
                                                                <input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" value="${landing_det[index]['PODC_PO_CHARGE_AMT']}"> 
                                                                <span class="d-none po-charge-val-dis">${landing_det[index]['PODC_PO_CHARGE_AMT']}</span>
                                                                <input type="hidden" name="PODC_PO_CHARGE_AMT[]" value="${landing_det[index]['PODC_PO_CHARGE_AMT']}" id="po-charge-amt-db">
                                                            </td>
                                                        </tr>`);
                                }
                                for (let addLandTr = 0; addLandTr < 5-landing_det.length; addLandTr++) {
                                    $('#tableDet tbody').append(`<tr>
                                                        <td style="width: 12%;">
                                                            <input type="text" class="form-control" onInput="poChargeIn(this)" placeholder="Enter PO Charge Code">
                                                            <input type="hidden" name="PODC_PO_CHARGE_CODE[]" id="po-charge-code-db">
                                                        </td>
                                                        <td style="width: 12%;"><span id="po-charge-desc-dis"></span></td>
                                                        <td style="width: 12%;">
                                                            <input type="number" class="form-control po-char-in-val-dis" onInput="poChargeValIn(this)" disabled="true"> 
                                                            <span class="d-none po-charge-val-dis">0</span>
                                                            <input type="hidden" name="PODC_PO_CHARGE_AMT[]" id="po-charge-amt-db">
                                                        </td>
                                                    </tr>`);
                                }

                                poChargeCal();
                            // for (let index = 0; index < resultData.length; index++) {
                            //     $('.pur-order-pre-det').append(`<option value="${resultData[index]['POP_ORDER_PFX']}" data-nxtno="${resultData[index]['POP_NEXT_NUMBER']}">${resultData[index]['POP_ORDER_PFX']}</option>`);
                            // }
                        }
                    });
                })

                function poChargeIn(ele) {
                        $(ele).closest('tr').find('td #po-charge-code-db').val('');
                        if(ele.value.length>=2){
                            $.ajax({
                                type: "POST",
                                url: "<?=base_url('Common/getPOChargeByPoCode')?>",
                                data: {po_charge_type:ele.value},
                                dataType: "Json",
                                success: function(resultData){
                                    console.log(resultData);
                                    if(resultData.po_charge_det){

                                        $(ele).closest('tr').find('td #po-charge-code-db').val(resultData.po_charge_det['CHRG_TYPE']);
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
                        $('.po-charge-table tbody tr').each( (tr_idx,tr) => {
                            $(tr).children('td').each( (td_idx, td) => {
                                if(td_idx == 2){
                                    tot_po_charge = parseFloat(tot_po_charge) + parseFloat($(td).text());
                                }
                                // console.log( '[' +tr_idx+ ',' +td_idx+ '] => ' + $(td).text() + ' TOT ---' + tot_po_charge);
                            }); 
                            $('#main-tot-po-charge').html(tot_po_charge);
                        });

                        tableCalculation();
                    }

                    function tableCalculation() {
                    // let cur_exch_rate = $('#cur-rate-exch').val();
                    // cur-exch-rate-usd
                    let cur_exch_rate = 1;
                    let po_charge_tot = $('#main-tot-po-charge').html();
                    
                    $('#main-tot-po-charge').html(Number(po_charge_tot*cur_exch_rate).toFixed(4));
                    $('#tot-po-charge-db').val(po_charge_tot*cur_exch_rate);
                        
                    let distr_po_chgr = po_charge_tot?parseFloat(po_charge_tot):0;
                    
                    let tot_qty = 0;
                    let venChr = 0;
                    let qty_in = 0;
                    let item_into_qty = 0;
                    $('#tbUser tr').each( (tr_idx,tr) => {
                        $(tr).children('td').each( (td_idx, td) => {
                            // console.log(parseFloat($(td).text()));
                            if(td_idx == 3){
                                qty_in = parseFloat($(td).text());
                                tot_qty = tot_qty+qty_in;
                            }
                            
                            if(td_idx == 4){

                                let ven_pri_in_d = $(td).closest('tr').find('td .ven-in-dis').html();
                                venChr = parseFloat(ven_pri_in_d)*parseFloat(cur_exch_rate)*qty_in;
                                item_into_qty = item_into_qty + venChr;
                            }
                        });
                        
                        $('#tot-item-unit-amt-into-qty').html(Number(item_into_qty).toFixed(4));
                        $('#tot-item-unit-amt-into-qty-db').val(Number(item_into_qty).toFixed(4));
                        $('#tot-qty').html(Number(tot_qty).toFixed(2));
                    });
                    amtDistributionIndividual();
                }
                function amtDistributionIndividual() {
                    // let cur_exch_rate = $('#cur-rate-exch').val();
                    let cur_exch_rate = 1;
                    let po_charge_tot = parseFloat($('#main-tot-po-charge').html());
                    let tot_amt_with_unit_into_qty = $('#tot-item-unit-amt-into-qty').html();
                    let qty_in = 0;
                    let dist_amt = 0;
                    let unit_cost = 0;
                    let grand_tot = 0;
                    $('#tbUser tr').each( (tr_idx,tr) => {
                        
                        $(tr).children('td').each( (td_idx, td) => {

                            if(td_idx == 3){
                                qty_in = $(td).text(); 
                            }

                            if(td_idx == 4){
                                let ven_pri_in_d = $(td).closest('tr').find('td .ven-in-dis').html();
                                dist_amt = parseFloat(ven_pri_in_d)*parseFloat(qty_in)*parseFloat(cur_exch_rate);

                                unit_cost = dist_amt;
                                dist_amt = (dist_amt/tot_amt_with_unit_into_qty)*100;
                            
                                
                            }
                            if(td_idx == 5){
                                dist_amt = po_charge_tot*(dist_amt/100);
                                let dis_u = dist_amt?dist_amt:0;
                                $(td).closest('tr').find('td .final-pri-val').val(Number((unit_cost+dis_u)/qty_in).toFixed(4));
                                // $(td).html((unit_cost+dis_u)/qty_in);
                                qty_in = 0;
                            }
                            if(td_idx == 6){
                                
                                $(td).html(dist_amt);
                                
                            }

                            if(td_idx == 7){
                               
                                let dis_amt_null = dist_amt?dist_amt:0;
                                grand_tot = parseFloat(grand_tot)+parseFloat(dis_amt_null + unit_cost);

                                // $(td).closest('tr').find('td .final-pri-val').val(dis_amt_null + unit_cost);

                                $(td).html(`<span class="unit-cost-sar-line" id="unit-cost-sar-line">${dis_amt_null + unit_cost}<span>`);
                                unit_cost = 0;
                                dist_amt = 0;
                            }

                        });
                        $('#grand-tot').html(Number(grand_tot).toLocaleString());
                    });
                }

            </script>