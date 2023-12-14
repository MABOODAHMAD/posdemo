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
						<h4 class="mb-sm-0 font-size-18">Stock Transfer</h4>
						<div class="page-title-right"> </div>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-xl-12">
					<div class="card">
						<div class="card-body border-bottom">
							<div class="d-flex align-items-center">
								<h5 class="mb-0 card-title flex-grow-1">Add New Stock Transfer</h5>
								<div class="flex-shrink-0"> <a href="<?=base_Url()?>StockTransferList" class="btn btn-primary">View Stock Transfer List</a> <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a> </div>
							</div>
						</div>
						<div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="mb-3 row">
                                                            <label for="example-text-input" class="form-label">Bussiness Unit</label>
                                                            <div class="mb-3">
                                                                <select class="form-control select2" name="STH_BUS_UNIT">
                                                                    <option value='' Selected disabled>Select</option>
                                                                    <?php foreach ($busUnits as $busUnit):?>
                                                                            <option value="<?=$busUnit['BU_CODE']?>" <?=defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null?>><?=$busUnit['BU_NAME1']?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <label id="STH_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>	
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">Order Number</label>
                                                            <input type="text" class="form-control" name="order_no_db" value="<?=rand(999999,100000)?>" placeholder="Enter Number">
                                                            <label id="order_no_db-error" class="error"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <?php if(dashRole(["role_check"=>"INVENTORY_ORDER_DATE_OPEN_STOCK_TRANSFER"])){  ?>
                                                                <label for="validationCustom03" class="form-label">Order Date</label>
                                                                <input class="form-control" name="trans_date_db" type="date" value="<?=date('Y-m-d')?>">
                                                                <!-- <label id="V_NAME-error" class="error"></label> -->
                                                            <?php }else{ ?>
                                                                <label for="validationCustom03" class="form-label">Order Date</label>
                                                                <input class="form-control" name="trans_date_db" type="text" value="<?=date('Y-m-d')?>" readonly>
                                                                <!-- <label id="V_NAME-error" class="error"></label> -->
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">Refrence</label>
                                                            <input type="text" class="form-control" name="refrence_db">
                                                            <label id="refrence_db-error" class="error"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">Reason</label>
                                                            <input class="form-control" onInput="transReason(this)" type="text">
                                                            <input type="hidden" name="trans_resn_db" value="0" id="trans-resn-db">
                                                            <label id="trans_resn_db-error" class="error"></label>
                                                            <label id="trans-resn-in-det"></label>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-2">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">Rule</label>
                                                            <input type="text" class="form-control" onInput="transRule(this)">
                                                            <input type="hidden" name="trans_rule_db" id="trans-rule-db">
                                                            <label id="trans_rule_db-error" class="error"></label>
                                                            <label id="trans-rule-in"></label>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">From Warehouse</label>
                                                            <input class="form-control from-whse-val" type="text" onblur="whseDet(this,'from')">
                                                            <input type="hidden" name="from_whse_db" id="from-whse-db">
                                                            <label id="from_whse_db-error" class="error"></label>
                                                            <label id="from-whse-dsp"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="validationCustom03" class="form-label">To Warehouse</label>
                                                            <input class="form-control to-whse-val" type="text" onblur="whseDet(this,'to')">
                                                            <input type="hidden" name="to_whse_db" id="to-whse-db">
                                                            <label id="to_whse_db-error" class="error"></label>
                                                            <label id="to-whse-dsp"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="item-line-table-dis d-none">
                                                    <h5 class="font-size-14 card-body border-bottom"><i class="mdi mdi-arrow-right text-primary"></i> Item Line</h5>
                                                    <div class="col-xl-12">
                                                        <div class="form-row">
                                                            <div style="overflow-x:auto; overflow-y:hidden; /* white-space:nowrap; */ margin:0 10px;"
                                                                class="ftable col-md-12">
                                                                <table class="table table-hover table-striped table-bordered ">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="5%">Sn.</th>
                                                                            <th width="18%">Rule</th>
                                                                            <th width="18%">Item No</th>
                                                                            <th width="20%">Description</th>
                                                                            <th width="15%">Qty</th>
                                                                            <th width="20%">UOM</th>
                                                                            <th width="30%">Unit Saling Price</th>
                                                                            <th width="10%">Total</th>
                                                                            <!-- <th width="100%">Final Price</th> -->
                                                                            <th width="5%">Del.</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbUser">
                                            
                                                                    </tbody>
                                                                </table>
                                                                <div class='row'>
                                                                    <div class='col-md-4'>
                                                                        <input type="button" class="btn btn-success mt-3 mt-lg-0" onCLick="additemLine()" value="Add item line row" />
                                                                    </div>
                                                                    <?php if(dashRole(["role_check"=>"INVENTORY_BULK_UPLOAD_LINE_STOCK_TRANSFER"])){?>
                                                                        <div class='col-md-4'>
                                                                            <input type="file" name='po_line_file' onChange="lineUpload(this)" class="form-control mt-3 mt-lg-0">
                                                                        </div>
                                                                        <div class='col-md-4'>
                                                                            <a href="<?=base_url('uploads/stock_transfer/template/STOCK_TRANSFER_UPLOAD_LINE_EXCEL.xlsx')?>" download="">
                                                                                <!-- <button class="mb-2 mr-2 btn-icon-vertical btn btn-primary"><i class="lnr-enter btn-icon-wrapper"> </i>Downlaod File</button> -->
                                                                                <button type="button" class="btn btn-primary">Download Template <i class="bx bx-download align-baseline ms-1"></i></button>
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            
                                            
                                            
                                            
                                                    <div class="col-xl-12 row">
                                            
                                            
                                            
                                            
                                                        <div class="col-md-12">
                                                            <table width="100%" class="table table-bordered">
                                                                <tbody>
                                            
                                                                    <tr>
                                                                        <td width="70%" align="right"><b>Total Qty:</b> </td>
                                                                        <td width="30%" align="left"><span id="tot-qty"></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width="70%" align="right"><b>Grand Total:</b> </td>
                                                                        <td width="30%" align="left" style="font-size: 0.8cm;font-weight: bold;">
                                                                            <span id="grand-tot"></span> 
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <div>
                                                    <button data-aftreload="true" data-control="inventory/stock-transfer-order-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->transAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->transAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Transfer order submit</button>
                                                </div>
                                                <span id="outmsg"></span>
                                            
                                                </div>
                                                <!-- JS DATA -->
                                            </form>
                                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Sweet Alerts js -->
<script src="<?=base_url()?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
var item_arr = [];

    function lineUpload(ele) {
        var form_data = new FormData($('#formdata')[0]);
        $.ajax({
                type: "POST",
                url: "<?=base_url('upload/bulkStockTransLineUp')?>",
                data: form_data,
                dataType: "Json",
                processData: false,
                contentType: false,
                beforeSend: function () {
                            $("#status").fadeIn();
                            $("#preloader").fadeIn();
                        },
                success: function(resultData){
                    
                    let fetch_line = resultData.data
                        fetch_line.forEach(element => {
                            

                            $(ele).closest('tr').find('td #stock-cont').val(null);
                            if (element.item_det && element.temp_list_price) {
                                let itemArr = item_arr.indexOf(element.item_det[0]['I_CODE']);
                                    if(itemArr == -1 && (element.stock_det>0 || element.stock_con == 'no_limit')){
                                        $('.po-charge-table').removeClass('d-none');
                                        $('.po-charge-hd').removeClass('d-none');
                                        let tableLength = $('#tbUser tr').length+1;
                                        let subTotal = parseFloat(element.temp_list_price)*parseFloat(element.in_quantity);
                                        // let index = document.getElementsByTagName("table")[0].childElementCount;
                                        $('#tbUser').append(`<tr>
                                                                <td width="5%"><span>${tableLength}</span></td>
                                                                <td width="10%">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <input class="form-control" type="text" onInput="transRule(this)" value="${element.trans_rule_det.TRULE_TRANS_RULE}">
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            <input class="form-control rule-dsp" type="text" disabled="true" value="${element.trans_rule_det.TRULE_DESC}">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td width="18%">
                                                                    <input type="text" onInput='itemSearchIn(this)' class="form-control item-code-val-in" value="${element.item_det[0]['I_CODE']}" >
                                                                </td>
                                                                <td width="20%">
                                                                    <span id="i-desc"></span></br><span id="i-ext-desc">${element.item_det[0]['I_DESC']}</span>
                                                                </td>
                                                                <td width="15%">
                                                                    <input type="text" class="form-control qty-val" onInput='qtyIn(this)' value="${element.in_quantity}"><span class="d-none qty-in">${element.in_quantity}</span>
                                                                </td>
                                                                <td width="20%">
                                                                    <span id="uom-dsp">${element.item_det[0]['UOM_DESC']}</span>
                                                                </td>
                                                                
                                                                <td width="5%">
                                                                    <span id="unit-pri-dis-amt-dsp">${element.temp_list_price}</span>
                                                                </td>
                                                                <td width="10%">
                                                                    <span id="sub-tot-dsp">${subTotal}</span>
                                                                </td>

                                                                <td width="100%" class="d-none"><span class="unit-cost-sar-line" id="unit-cost-sar-line">0<span></td>
                                                                <td width="10%"><a onClick='deleteTraitRow(this)'><i id="11" class="delete fa fa-trash"></i></a>
                                                                <input type="hidden" name="STD_ITEM_CODE[]" id="item-code-db" value="${element.item_det[0]['I_CODE']}">
                                                                <input type="hidden" name="STD_UNIT_LIST_PRICE[]" id="item-unit-price-db" value="${element.temp_list_price}">
                                                                <input type="hidden" name="STD_TRANS_QTY[]" id="item-qty-db" value="${element.in_quantity}">
                                                                <input type="hidden" name="STD_TRANS_RULE[]" id="stock-trans-rule-db" value="${element.trans_rule_det.TRULE_TRANS_RULE}">

                                                                <input type="hidden" id="stock-qty" value="${element.stock_det}">
                                                                <input type="hidden" id="stock-cont" value="${element.stock_con}">

                                                                </td>
                                                                
                                                            </tr>`);

                                        item_arr.push(element.item_det[0]['I_CODE']);
                                    }else{
                                        if (element.stock_det<=0 && element.stock_con == 'limit') {
                                            Swal.fire({
                                                title: "Item Stock Alert",
                                                text: "Stock not Available this warehouse",
                                                icon: "error",
                                                confirmButtonColor: "#556ee6"
                                            });
                                        }else{
                                            Swal.fire({
                                                title: "Item Validation",
                                                text: "Items already added to this list",
                                                icon: "error",
                                                confirmButtonColor: "#556ee6"
                                            });
                                        }
                                        
                                    }
                            }

                             
                            // if(item_arr.indexOf(element.item_det[0]['I_CODE']) == -1 && element.item_det && element.temp_list_price && element.stock_det){
                                
                            //     item_arr.push(element.item_det[0]['I_CODE']);
                                

                            //         $('.po-charge-table').removeClass('d-none');
                            //         $('.po-charge-hd').removeClass('d-none');
                            //         let tableLength = $('#tbUser tr').length+1;
                            //         let subTotal = parseFloat(element.temp_list_price)*parseFloat(element.in_quantity);
                            //         // let index = document.getElementsByTagName("table")[0].childElementCount;
                            //         $('#tbUser').append(`<tr>
                            //                                 <td width="5%"><span>${tableLength}</span></td>
                            //                                 <td width="10%">
                            //                                     <div class="row">
                            //                                         <div class="col-md-5">
                            //                                             <input class="form-control" type="text" onInput="transRule(this)" value="${element.trans_rule_det.TRULE_TRANS_RULE}">
                            //                                         </div>
                            //                                         <div class="col-md-7">
                            //                                             <input class="form-control rule-dsp" type="text" disabled="true" value="${element.trans_rule_det.TRULE_DESC}">
                            //                                         </div>
                            //                                     </div>
                            //                                 </td>
                            //                                 <td width="18%">
                            //                                     <input type="text" onInput='itemSearchIn(this)' class="form-control item-code-val-in" value="${element.item_det[0]['I_CODE']}" >
                            //                                 </td>
                            //                                 <td width="20%">
                            //                                     <span id="i-desc"></span></br><span id="i-ext-desc">${element.item_det[0]['I_EXTEND_DESC']}</span>
                            //                                 </td>
                            //                                 <td width="15%">
                            //                                     <input type="text" class="form-control qty-val" onInput='qtyIn(this)' value="${element.in_quantity}"><span class="d-none qty-in">${element.in_quantity}</span>
                            //                                 </td>
                            //                                 <td width="20%">
                            //                                     <span id="uom-dsp">${element.item_det[0]['UOM_DESC']}</span>
                            //                                 </td>
                                                            
                            //                                 <td width="5%">
                            //                                     <span id="unit-pri-dis-amt-dsp">${element.temp_list_price}</span>
                            //                                 </td>
                            //                                 <td width="10%">
                            //                                     <span id="sub-tot-dsp">${subTotal}</span>
                            //                                 </td>

                            //                                 <td width="100%" class="d-none"><span class="unit-cost-sar-line" id="unit-cost-sar-line">0<span></td>
                            //                                 <td width="10%"><a onClick='deleteTraitRow(this)'><i id="11" class="delete fa fa-trash"></i></a>
                            //                                 <input type="hidden" name="STD_ITEM_CODE[]" id="item-code-db" value="${element.item_det[0]['I_CODE']}">
                            //                                 <input type="hidden" name="STD_UNIT_LIST_PRICE[]" id="item-unit-price-db" value="${element.temp_list_price}">
                            //                                 <input type="hidden" name="STD_TRANS_QTY[]" id="item-qty-db" value="${element.in_quantity}">
                            //                                 <input type="hidden" name="STD_TRANS_RULE[]" id="stock-trans-rule-db" value="${element.trans_rule_det.TRULE_TRANS_RULE}">

                            //                                 <input type="hidden" id="stock-qty" value="${element.stock_det}">
                            //                                 <input type="hidden" id="stock-cont" value="${element.stock_con}">

                            //                                 </td>
                                                            
                            //                             </tr>`);
                            //         }
                                });
                        $("#status").fadeOut();
                        $("#preloader").fadeOut();
                        tableCalculation();
                }
        })
    }
    // RULE
    function transRule(ele) {

        $(ele).closest('tr').find('td .item-code-val-in').prop("disabled","");
        $(ele).closest('tr').find('td .qty-val').prop("disabled","");
        $(ele).closest('tr').find('td #stock-trans-rule-db').val("");
        
        $('.error').html('');
        // $('#trans-rule-db').val('');
        let reson_val = $('#trans-resn-db').val();
        if(ele.value.length>=3){
            $.ajax({
                type: "POST",
                url: "<?=base_url('Common/getTransRuleByCode')?>",
                data: {trans_rule_code:ele.value},
                dataType: "Json",
                success: function(resultData){
                    
                    
                    if(resultData.trans_rule_det){
                        $(ele).closest('tr').find('td #stock-trans-rule-db').val(resultData.trans_rule_det.TRULE_TRANS_RULE);
                        if(reson_val == 201 && resultData.trans_rule_det.TRULE_TRANS_RULE == 001){
                            $(ele).closest('tr').find('td .rule-dsp').val(resultData.trans_rule_det.TRULE_DESC);
                        }else if(reson_val == 200 && (resultData.trans_rule_det.TRULE_TRANS_RULE == 002)){
                            $(ele).closest('tr').find('td .rule-dsp').val(resultData.trans_rule_det.TRULE_DESC);
                        }else if(reson_val == 202 && resultData.trans_rule_det.TRULE_TRANS_RULE == 999){
                            $(ele).closest('tr').find('td .rule-dsp').val(resultData.trans_rule_det.TRULE_DESC);
                        }else if(reson_val == 204 && (resultData.trans_rule_det.TRULE_TRANS_RULE == 002 || resultData.trans_rule_det.TRULE_TRANS_RULE == 003)){
                            $(ele).closest('tr').find('td .rule-dsp').val(resultData.trans_rule_det.TRULE_DESC);
                        }else{
                            $(ele).closest('tr').find('td .rule-dsp').val('Not Allow');
                            $(ele).closest('tr').find('td .qty-val').prop("disabled","true");
                            $(ele).closest('tr').find('td .item-code-val-in').prop("disabled","true");
                        }

                        
                        

                        // $('#trans-rule-in').html(`<span class='text-success'>${resultData.trans_rule_det.TRULE_TRANS_RULE} - ${resultData.trans_rule_det.TRULE_DESC}</span>`);
                        // $('#trans-rule-db').val(resultData.trans_rule_det.TRULE_TRANS_RULE);
                    }else{
                        // $('#trans-rule-in').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                        $(ele).closest('tr').find('td .rule-dsp').val('DATA NOT AVAILABLE');
                        $(ele).closest('tr').find('td .qty-val').prop("disabled","true");
                        $(ele).closest('tr').find('td .item-code-val-in').prop("disabled","true");
                    }
                }
            });
        }else if(ele.value.length>=1){
            $(ele).closest('tr').find('td .rule-dsp').val('DATA FETCHING...');
            $(ele).closest('tr').find('td .qty-val').prop("disabled","true");
            $(ele).closest('tr').find('td .item-code-val-in').prop("disabled","true");
            // $('#trans-rule-in').html(`<span class='text-warning'>DATA FETCHING...</span>`);
        }else{
            $(ele).closest('tr').find('td .rule-dsp').val('DATA NOT AVAILABLE');
            $(ele).closest('tr').find('td .qty-val').prop("disabled","true");
            $(ele).closest('tr').find('td .item-code-val-in').prop("disabled","true");
            // $('#trans-rule-in').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
        }
    }

    // Reason
        function transReason(ele) {
            $('#tbUser').empty();
            $('.error').html('');
            $('#trans-resn-db').val('');
            $('#to-whse-db').val('');
            $('#from-whse-db').val('');

            $('.to-whse-val').val('');
            $('.from-whse-val').val('');
            $('#to-whse-dsp').html('');
            $('#from-whse-dsp').html('');
        
            if(ele.value.length>=3){
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Common/getTransResnByCode') ?>",
                    data: {trans_resn_code:ele.value},
                    dataType: "Json",
                    success: function(resultData){
                        if(resultData.trans_resn_det){
                            if(resultData.trans_resn_acc){
                                $('#trans-resn-in-det').html(`<span class='text-success'>${resultData.trans_resn_det.TR_TRANS_RSN} - ${resultData.trans_resn_det.TR_DESC}</span>`);
                                $('#trans-resn-db').val(resultData.trans_resn_det.TR_TRANS_RSN);
                            }else{
                                    $('#trans-resn-in-det').html(`<span class='text-danger'>ACCESS DENIED</span>`);
                            }
                        }else{
                            $('#trans-resn-in-det').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
                        }
                    }
                });
            }else if(ele.value.length>=1){
                $('#trans-resn-in-det').html(`<span class='text-warning'>DATA FETCHING...</span>`);
            }else{
                $('#trans-resn-in-det').html(`<span class='text-warning'>DATA NOT AVAILABLE</span>`);
            }
        } 
    // WHEREHOUSE SEARCH

    function whseDet(ele,type){
        item_arr.length = 0;
        $('#tbUser').empty();
        $('.error').html('');

        let from_whse =  $('.from-whse-val').val();
        let to_whse =  $('.to-whse-val').val();
        let resn_val = $('#trans-resn-db').val();
        if(resn_val != 0){
        if(ele.value.length>=2){
            $.ajax({
                    type: "POST",
                    url: "<?= base_url('Common/getWharehouseDet') ?>",
                    data: {whse_code:ele.value,whse_type:type},
                    dataType: "Json",
                    success: function(resultData){
                 
                        if(type == 'from'){
                            $('#from-whse-db').val('');
                            if(resultData.whse_det.WHSE_CODE){

                                if (resn_val == 200 || resn_val == 202 || resn_val == 204) {
                                    $('#from-whse-dsp').html(`<spna class="text-primary">`+resultData.whse_det.WHSE_CODE+`</span> - <spna class="text-primary">`+resultData.whse_det.WHSE_DESC+`</span>`);
                                    $('#from-whse-db').val(resultData.whse_det.WHSE_CODE);

                                    $('.to-whse-val').prop("disabled","true");
                                    $('.to-whse-val').val(resultData.whse_det.WHSE_CODE);
                                    $('#to-whse-db').val(resultData.whse_det.WHSE_CODE);
                                    $('#to-whse-dsp').html(`<spna class="text-primary">`+resultData.whse_det.WHSE_CODE+`</span> - <spna class="text-primary">`+resultData.whse_det.WHSE_DESC+`</span>`);
                                }else if(resn_val == 201){
                                    $('.from-whse-val').prop("disabled","");
                                    $('.to-whse-val').prop("disabled","");
                                    if(to_whse != resultData.whse_det){
                                        $('#from-whse-dsp').html(`<spna class="text-primary">`+resultData.whse_det.WHSE_CODE+`</span> - <spna class="text-primary">`+resultData.whse_det.WHSE_DESC+`</span>`);
                                        $('#from-whse-db').val(resultData.whse_det.WHSE_CODE);
                                    }else{
                                        $(ele).val('');
                                        $('#from-whse-dsp').html(`<spna class="text-danger ">Enter different wharehouse code</span>`);
                                        Swal.fire({
                                            title: "Wharehouse",
                                            text: "Please choose different wharehouse",
                                            icon: "error",
                                            confirmButtonColor: "#556ee6"
                                        });
                                    }
                                }

                                // if(to_whse != resultData.whse_det){
                                //     $('#from-whse-dsp').html(`<spna class="text-primary">`+resultData.whse_det.WHSE_CODE+`</span> - <spna class="text-primary">`+resultData.whse_det.WHSE_DESC+`</span>`);
                                //     $('#from-whse-db').val(resultData.whse_det.WHSE_CODE);
                                // }else{
                                //     $(ele).val('');
                                //     $('#from-whse-dsp').html(`<spna class="text-danger ">Enter different wharehouse code</span>`);
                                //     Swal.fire({
                                //         title: "Wharehouse",
                                //         text: "Please choose different wharehouse",
                                //         icon: "error",
                                //         confirmButtonColor: "#556ee6"
                                //     });
                                // }

                            }else{
                                $('#from-whse-dsp').html(`<spna class="text-danger">Data not available</span>`);
                            }
                        }

                        if (type == 'to') {
                            $('#to-whse-db').val('');
                            if(resultData.whse_det.WHSE_CODE){

                                if (resn_val == 200 || resn_val == 202 || resn_val == 204) {
                                    $('#to-whse-dsp').html(`<spna class="text-primary">`+resultData.whse_det.WHSE_CODE+`</span> - <spna class="text-primary">`+resultData.whse_det.WHSE_DESC+`</span>`);
                                    $('#to-whse-db').val(resultData.whse_det.WHSE_CODE);

                                    $('.from-whse-val').prop("disabled","true");
                                    $('.from-whse-val').val(resultData.whse_det.WHSE_CODE);
                                    $('#from-whse-db').val(resultData.whse_det.WHSE_CODE);
                                    $('#from-whse-dsp').html(`<spna class="text-primary">`+resultData.whse_det.WHSE_CODE+`</span> - <spna class="text-primary">`+resultData.whse_det.WHSE_DESC+`</span>`);
                                }else if(resn_val == 201){
                                    $('.from-whse-val').prop("disabled","");
                                    $('.to-whse-val').prop("disabled","");
                                    if(from_whse != resultData.whse_det.WHSE_CODE){
                                        $('#to-whse-db').val(resultData.whse_det.WHSE_CODE);
                                        $('#to-whse-dsp').html(`<spna class="text-primary">`+resultData.whse_det.WHSE_CODE+`</span> - <spna class="text-primary">`+resultData.whse_det.WHSE_DESC+`</span>`);
                                    }else{
                                        $(ele).val('');
                                        $('#to-whse-dsp').html(`<spna class="text-danger">Enter different wharehouse code</span>`);
                                        Swal.fire({
                                            title: "Wharehouse",
                                            text: "Please choose different wharehouse",
                                            icon: "error",
                                            confirmButtonColor: "#556ee6"
                                        });
                                    }
                                }

                                // if(from_whse != resultData.whse_det.WHSE_CODE){
                                //     $('#to-whse-db').val(resultData.whse_det.WHSE_CODE);
                                //     $('#to-whse-dsp').html(`<spna class="text-primary">`+resultData.whse_det.WHSE_CODE+`</span> - <spna class="text-primary">`+resultData.whse_det.WHSE_DESC+`</span>`);
                                // }else{
                                //     $(ele).val('');
                                //     $('#to-whse-dsp').html(`<spna class="text-danger">Enter different wharehouse code</span>`);
                                //     Swal.fire({
                                //         title: "Wharehouse",
                                //         text: "Please choose different wharehouse",
                                //         icon: "error",
                                //         confirmButtonColor: "#556ee6"
                                //     });
                                // }
                            }else{
                                $('#to-whse-dsp').html(`<spna class="text-danger">Data not available</span>`);
                            }
                        }
                    }
                });
            }else{
                if(type == 'from'){
                    if (resn_val == 200 || resn_val == 202 || resn_val == 204) {
                        $('.to-whse-val').prop("disabled","");
                        $('.to-whse-val').val('');
                        $('#to-whse-dsp').html('');
                        $('#to-whse-db').val('');

                        $('#from-whse-dsp').html(`<spna class="text-warning">Enter wharehouse code</span>`);
                        $('#from-whse-db').val('');
                    }else if(resn_val == 201){
                        $('#from-whse-dsp').html(`<spna class="text-warning">Enter wharehouse code</span>`);
                        $('#from-whse-db').val('');
                    }
                        
                }
                if (type == 'to') {

                    if (resn_val == 200 || resn_val == 202 || resn_val == 204) {
                        $('.from-whse-val').prop("disabled","");
                        $('.from-whse-val').val('');
                        $('#from-whse-dsp').html('');
                        $('#from-whse-db').val('');

                        $('#to-whse-dsp').html(`<spna class="text-warning">Enter wharehouse code</span>`);
                        $('#to-whse-db').val('');
                    }else if(resn_val == 201){
                        $('#to-whse-dsp').html(`<spna class="text-warning">Enter wharehouse code</span>`);
                        $('#to-whse-db').val('');
                    }
                }
            }
        }else{
            Swal.fire({
                    title: "Field alert",
                    text: "Select Reason first",
                    icon: "warning",
                    confirmButtonColor: "#556ee6"
                });
                $(ele).val('');
        }
                
            
           
    }

    function checkWhseField() {

        if($('#from-whse-db').val() && $('#to-whse-db').val() && $('#trans-resn-db').val() != 0){
                $('.item-line-table-dis').removeClass('d-none');
            }else{
                $('.item-line-table-dis').addClass('d-none');
            }
    }

    setInterval(function(){ 
        checkWhseField();
        tableCalculation();
    },500);
    // <input type="text" class="form-control" onInput="transRule(this)">
    // item Line
    function additemLine() {
            $('.po-charge-table').removeClass('d-none');
            $('.po-charge-hd').removeClass('d-none');
            let tableLength = $('#tbUser tr').length+1;
            let cur_exch_rate = $('#cur-rate-exch').val();
            // let index = document.getElementsByTagName("table")[0].childElementCount;
            $('#tbUser').append(`<tr>
                                    <td width="5%"><span>${tableLength}</span></td>
                                    <td width="10%">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input class="form-control" type="text" onInput="transRule(this)">
                                            </div>
                                            <div class="col-md-7">
                                                <input class="form-control rule-dsp" type="text" disabled="true">
                                            </div>
                                        </div>
                                    </td>
                                    <td width="18%">
                                        <input type="text" onInput='itemSearchIn(this)' class="form-control item-code-val-in" disabled="true"/>
                                    </td>
                                    <td width="20%">
                                        <span id="i-desc"></span></br><span id="i-ext-desc"></span>
                                    </td>
                                    <td width="15%">
                                        <input type="text" class="form-control qty-val" onInput='qtyIn(this)' value="0" disabled="true"><span class="d-none qty-in">1</span>
                                    </td>
                                    <td width="20%">
                                        <span id="uom-dsp"></span>
                                    </td>
                                    
                                    <td width="5%">
                                        <span id="unit-pri-dis-amt-dsp"></span>
                                    </td>
                                    <td width="10%">
                                        <span id="sub-tot-dsp"></span>
                                    </td>

                                    <td width="100%" class="d-none"><span class="unit-cost-sar-line" id="unit-cost-sar-line">0<span></td>
                                    <td width="10%"><a onClick='deleteTraitRow(this)'><i id="11" class="delete fa fa-trash"></i></a>
                                    <input type="hidden" name="STD_ITEM_CODE[]" id="item-code-db">
                                    <input type="hidden" name="STD_UNIT_LIST_PRICE[]" id="item-unit-price-db">
                                    <input type="hidden" name="STD_TRANS_QTY[]" id="item-qty-db">
                                    <input type="hidden" name="STD_TRANS_RULE[]" id="stock-trans-rule-db">

                                    <input type="hidden" id="stock-qty">
                                    <input type="hidden" id="stock-cont">
                                    </td>
                                    
                                </tr>`);
    }


    function deleteTraitRow(ele) {
            $(ele).closest('tr').remove();
            item_arr.splice(item_arr.indexOf($(ele).closest('tr').find('td #item-code-db').val()), 1);
            let tableLength = $('#tbUser tr').length;
            if (tableLength == 0) {
                $('#grand-tot').html(0);
                $('#tot-qty').html(0);
            }
            // tableCalculation();
        }

    function tableCalculation() {
        let so = 1;
        let unit_list_pri = 0;
        let qty = 0;
        let tot_qty = 0;
        let sub_tot = 0;
        $('#tbUser tr').each( (tr_idx,tr) => {
            $(tr).children('td').each( (td_idx, td) => {

                if(td_idx == 0){
                    $(td).html(so);
                }

                if(td_idx == 4){
                    qty = $(td).text();
                    
                    tot_qty += parseFloat($(td).text());
                    // console.log('tot+'+tot_qty);
                }

                if(td_idx == 6){
                    unit_list_pri = $(td).text();
                }

                if(td_idx == 7){
                    $(td).html(parseFloat(qty*unit_list_pri));
                    sub_tot += qty*unit_list_pri;
                }

                // console.log( '[' +tr_idx+ ',' +td_idx+ '] => ' + $(td).text());
            });
            so++;
            $('#grand-tot').html(Number(sub_tot).toFixed(4));
            $('#tot-qty').html(Number(tot_qty).toFixed(2));
        });
    
    }
    
    function itemSearchIn(ele) {
        
        $(ele).closest('tr').find('td #stock-qty').val('');
        $(ele).closest('tr').find('td .qty-val').val('');

        $(ele).closest('tr').find('td #item-code-db').val('');
        $(ele).closest('tr').find('td #item-unit-price-db').val('');
        $(ele).closest('tr').find('td #item-qty-db').val('');
        
        if(ele.value.length>3){
            let v_code = $('.v-code-dis').html();
            let from_whse_code = $('#from-whse-db').val();
            let stk_resn = $('#trans-resn-db').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('Common/getItemStockQty') ?>",
                data: {item_code:ele.value,from_whse_code,stk_resn},
                dataType: "Json",
                success: function(resultData){
                    // console.log(resultData);
                    $(ele).closest('tr').find('td #stock-cont').val(null);
                    if (resultData.item_det && resultData.temp_list_price) {
                        let itemArr = item_arr.indexOf(resultData.item_det[0]['I_CODE']);
                            if(itemArr == -1 && (resultData.stock_det>0 || resultData.stock_con == 'no_limit')){
                                $(ele).closest('tr').find('td #stock-qty').val(resultData.stock_det);
                                $(ele).closest('tr').find('td #stock-cont').val(resultData.stock_con);
                                
                                $(ele).closest('tr').find('td #i-desc').html(resultData.item_det[0]['I_DESC']);
                                $(ele).closest('tr').find('td #i-ext-desc').html(resultData.item_det[0]['I_EXTEND_DESC']);

                                $(ele).closest('tr').find('td #uom-dsp').html(resultData.item_det[0]['UOM_DESC']);
                                
                                $(ele).closest('tr').find('td #unit-pri-dis-amt-dsp').html(resultData.temp_list_price);
                                $(ele).closest('tr').find('td #sub-tot-dsp').html(resultData.temp_list_price*1);
                            


                                $(ele).closest('tr').find('td #item-code-db').val(resultData.item_det[0]['I_CODE']);
                                $(ele).closest('tr').find('td #item-unit-price-db').val(resultData.temp_list_price);
                                $(ele).closest('tr').find('td #item-qty-db').val(1);

                                $(ele).closest('tr').find('td .qty-val').val(1);
                                item_arr.push(resultData.item_det[0]['I_CODE']);
                            }else{
                                if (resultData.stock_det<=0 && resultData.stock_con == 'limit') {
                                    Swal.fire({
                                        title: "Item Stock Alert",
                                        text: "Stock not Available this warehouse",
                                        icon: "error",
                                        confirmButtonColor: "#556ee6"
                                    });
                                }else{
                                    Swal.fire({
                                        title: "Item Validation",
                                        text: "Items already added to this list",
                                        icon: "error",
                                        confirmButtonColor: "#556ee6"
                                    });
                                }
                                
                            }
                    }else{
                        $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
                        $(ele).closest('tr').find('td #i-ext-desc').html('');
                        $(ele).closest('tr').find('td #uom-dsp').html('');
                        $(ele).closest('tr').find('td #unit-pri-dis-amt-dsp').html('');
                        $(ele).closest('tr').find('td #sub-tot-dsp').html('');
                    }




                    // if(resultData.item_det){
                            
                    //     $(ele).closest('tr').find('td #stock-qty').val(resultData.stock_det);

                    //     $(ele).closest('tr').find('td #i-desc').html(resultData.item_det[0]['I_DESC']);
                    //     $(ele).closest('tr').find('td #i-ext-desc').html(resultData.item_det[0]['I_EXTEND_DESC']);

                    //     $(ele).closest('tr').find('td #uom-dsp').html(resultData.item_det[0]['UOM_DESC']);
                        
                    //     $(ele).closest('tr').find('td #unit-pri-dis-amt-dsp').html(resultData.temp_list_price);
                    //     $(ele).closest('tr').find('td #sub-tot-dsp').html(resultData.temp_list_price*1);
                     


                    //     $(ele).closest('tr').find('td #item-code-db').val(resultData.item_det[0]['I_CODE']);
                    //     $(ele).closest('tr').find('td #item-unit-price-db').val(resultData.temp_list_price);
                    //     $(ele).closest('tr').find('td #item-qty-db').val(1);

                    //     $(ele).closest('tr').find('td .qty-val').val(1);

                      
                    // }else{
                    //     if(resultData.stock_det == 0){
                    //             Swal.fire({
                    //                     title: "Stock alert",
                    //                     text: "Stock empty purchase first then transfer",
                    //                     icon: "error",
                    //                     confirmButtonColor: "#556ee6"
                    //                 });
                    //     }
                    //     $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
                    //     $(ele).closest('tr').find('td #i-ext-desc').html('');
                    //     $(ele).closest('tr').find('td #uom-dsp').html('');
                    //     $(ele).closest('tr').find('td #unit-pri-dis-amt-dsp').html('');
                    //     $(ele).closest('tr').find('td #sub-tot-dsp').html('');
                       
                       
                    // }
                }
            });
        }else{
            $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
            $(ele).closest('tr').find('td #i-ext-desc').html('');
            $(ele).closest('tr').find('td #uom-dsp').html('');
            $(ele).closest('tr').find('td #unit-pri-dis-amt-dsp').html('');
            $(ele).closest('tr').find('td #sub-tot-dsp').html('');

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
        tableCalculation();
    }
</script>