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
                        <h4 class="mb-sm-0 font-size-18">Price Change Order</h4>
                        <div class="page-title-right">
                            <div class="flex-shrink-0">
                                <a href="<?=base_Url('PhysicalInventoryList')?>" class="btn btn-primary">Physical Inventory
                                    List</a>
                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                            </div>
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
                                <h5 class="mb-0 card-title flex-grow-1">Physical Inventory Count</h5>

                                <!--<div class="flex-shrink-0">-->
                                <!--    <a href="<?= base_Url() ?>InventoryList" class="btn btn-primary" >View Inventory List</a>-->
                                <!--    <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>-->
                                <!--</div>-->

                            </div>
                        </div>
                        <div class="card-body">
                            <form id="formdata">
                                <div class="row">
                                    <div class="row">

                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                    <select class="form-control select2" name="PICH_BUS_UNIT">
                                                        <option value='' Selected disabled>Select</option>
                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                <option value="<?=$busUnit->BU_CODE?>" <?=defaultBusUnit() == $busUnit->BU_CODE?'Selected':null;?>><?=$busUnit->BU_NAME1?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <label id="PICH_BUS_UNIT-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Count Number</label>
                                                <input type="text" class="form-control"
                                                    value="<?= rand(99999, 10000) ?>" name="PICH_ORDER_NO"
                                                    placeholder="Enter Number" readonly>
                                                <label id="PICH_ORDER_NO-error" class="error"></label>
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Date</label>
                                                <input class="form-control" type="date" name="PICH_ORDER_DATE"
                                                    value="<?= date('Y-m-d') ?>">
                                                <label id="PICH_ORDER_DATE-error" class="error"></label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Warehouse</label>
                                                    <select name="PICH_WHSE" class="form-control select2">
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
                                                    <label id="PICH_WHSE-error" class="error"></label>
                                            </div>
                                        </div> 

                                        <div class="col-md-2">
                                            <div class="mb-3">

                                                <label for="validationCustom03" class="form-label">Note</label>
                                                <input type="text" class="form-control" name="PICH_NOTES">
                                                <label id="PICH_NOTES-error" class="error"></label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">

                                                <label for="validationCustom03" class="form-label">Count Start date</label>
                                                <input type="datetime-local" name="PICH_IC_START_DATE" class="form-control" value="<?=dateTime()?>">
                                                <label id="PICH_IC_START_DATE-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">

                                                <label for="validationCustom03" class="form-label">Count End date</label>
                                                <input type="datetime-local" name="PICH_IC_END_DATE" class="form-control end-date-dsp">
                                                <label id="PICH_IC_END_DATE-error" class="error"></label>
                                            </div>
                                        </div>

                                        <div class="row">
                                                                            
                                                <div class='col-md-12'>
                                                    <h2 class="mb-3">Physical Inventory Line item</h2>
                                                </div>
                                                <div class='col-md-4 my-3'>
                                                    <input type="file" name='physical_inventory_count_line_file' onChange="lineUpload(this)"
                                                        class="form-control mt-3 mt-lg-0">
                                                </div>
                                                <div class='col-md-4 my-3'>
                                                    <a href="<?= base_url('uploads/physical_inventory_count/template/PHYSICAL_INVENTORY_COUNT.xlsx') ?>"
                                                        download="">
                                                        <!-- <button class="mb-2 mr-2 btn-icon-vertical btn btn-primary"><i class="lnr-enter btn-icon-wrapper"> </i>Downlaod File</button> -->
                                                        <button type="button" class="btn btn-primary">Download Template
                                                            <i class="bx bx-download align-baseline ms-1"></i></button>
                                                    </a>
                                                </div>
                                        </div>
                                        

                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap table-check">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 20px;" class="align-middle">Line No</th>
                                                        <th class="align-middle" width='100px'>Item</th>
                                                        <th class="align-middle" width='350px'>Item Desc</th>
                                                        <th class="align-middle" width='100px'>Price</th>
                                                        <th class="align-middle" width='50px'>Count Qty</th>

                                                    </tr>
                                                </thead>
                                                <tbody id="tbUser">
                                                    <!-- <tr>
                                                        <td></td>
                                                        <td><a class="text-body fw-bold">15</a> </td>
                                                        <td>01</td>
                                                        <td>
                                                            Weight
                                                        </td>
                                                        <td>
                                                            Gold
                                                        </td>
                                                        <td>
                                                            2.21
                                                        </td>
                                                    </tr> -->
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class='col-md-4'>
                                                    <input type="button" class="btn btn-success mt-3 mt-lg-0"
                                                        onCLick="additemLine()" value="Add item row" />
                                                </div>
                                            </div>
                                            <br><br>
                                            <button type="button" id="auth-button" onCLick="checkAuth()" class="btn btn-primary btn-lg btn-block">Authentication</button>
                                            <div id="auth-button-show">

                                            </div>
                                        </div>
                                    </div>


                                    <span id="outmsg"></span>

                                </div>
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
                    <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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

        var item_arr = [];

        function lineUpload(ele) {
            $('#tbUser').empty();
            var form_data = new FormData($('#formdata')[0]);
            $.ajax({
                    type: "POST",
                    url: "<?=base_url('upload/bulkPhysicalInventoryCount')?>",
                    data: form_data,
                    dataType: "Json",
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                                $("#status").fadeIn();
                                $("#preloader").fadeIn();
                            },
                    success: function(resultData){
                        
                        if(resultData.err == "true"){
                            Swal.fire({
                                        title: "File Extension Warning",
                                        text: "Please choose different File extension like xlsx",
                                        icon: "error",
                                        confirmButtonColor: "#556ee6"
                                    });
                        }else{
                            let fetch_line = resultData.data
                                fetch_line.forEach(element => {

                                        let item_data = element.item_det;
                                        let item_det_cont = element.item_det_cont;

                                                let ext_desc = item_det_cont == 'Y'?item_data.I_EXTEND_DESC.substr(0, 20):'Unknown Item';
                                                let item_desc = item_det_cont == 'Y'?item_data.I_DESC.substr(0, 20):'Unknown Item';
                                                let item_code = item_det_cont == 'Y'?item_data.I_CODE:item_data;
                                                let item_uom = item_det_cont == 'Y'?item_data.I_UOM_CODE:'Unknown Item';
                                                let item_price = item_det_cont == 'Y'?item_data.I_LIST_PRICE:0;

                                            if (item_arr.indexOf(item_code) == -1) {
                                                item_arr.push(item_code);
                                                let tableLength = $('#tbUser tr').length + 1;

                                                

                                                $('#tbUser').append(`<tr>
                                                                        <td width="5%"><span>${tableLength}<span></td>
                                                                        <td width="18%"><input type="text" onInput='itemSearchIn(this)' value="${item_code}" class="form-control"/></td>
                                                                        <td width="20%"><span id="i-desc">${item_desc}</span></br><span id="i-ext-desc"></span></td>
                                                                        <td width="15%"><input type="number" class="form-control list-price-in" value="${item_price}" name="list_price_db[]"></td>
                                                                        <td width="20%">
                                                                            <input type="number" class="form-control item-qty-db" name="item_qty_db[]" value="${element.item_qty}">
                                                                            <input type="hidden" name="item_code_db[]" id="item-code-db" value="${item_code}">
                                                                            <input type="hidden" name="item_desc_db[]" id="item-desc-db" value="${item_desc}">
                                                                            <input type="hidden" name="item_uom_db[]" id="item-uom-db" value="${item_uom}">
                                                                        </td>
                                                                    </tr>`);

                                            } else {
                                                $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
                                                $(ele).closest('tr').find('td #i-ext-desc').html('');

                                                $(ele).closest('tr').find('td .list-price-in').prop('readonly', true);
                                            }
                                        });
                                
                        }
                        $("#status").fadeOut();
                        $("#preloader").fadeOut();
                    }
            })
        }


        function additemLine() {
            let tableLength = $('#tbUser tr').length + 1;
            let cur_exch_rate = $('#cur-rate-exch').val();
            // let index = document.getElementsByTagName("table")[0].childElementCount;

            $('#tbUser').append(`<tr>
                                    <td width="5%"><span>${tableLength}<span></td>
                                    <td width="18%">
                                        <input type="text" onInput='itemSearchIn(this)' class="form-control"/>
                                    </td>
                                    <td width="20%">
                                        <span id="i-desc"></span></br><span id="i-ext-desc"></span>
                                    </td>
                                    <td width="15%">
                                        <input type="number" class="form-control list-price-in" name="list_price_db[]">
                                    </td>
                                    <td width="20%">
                                        <input type="number" name="item_qty_db[]" class="form-control item-qty-db">

                                        <input type="hidden" name="item_code_db[]" id="item-code-db">
                                        <input type="hidden" name="item_desc_db[]" id="item-desc-db">
                                        <input type="hidden" name="item_uom_db[]" id="item-uom-db">
                                    </td>
                                    
                                </tr>`);
        }

        for (let index = 0; index < 10; index++) {
            additemLine();
        }

        function itemSearchIn(ele) {
            $(ele).closest('tr').find('td #item-code-db').val('');
            $(ele).closest('tr').find('td #item-desc-db').val('');
            $(ele).closest('tr').find('td .item-qty-db').val('');
            $(ele).closest('tr').find('td .list-price-in').val('');
            $(ele).closest('tr').find('td #item-uom-db').val('');


            if (ele.value.length > 3) {
                let v_code = $('.v-code-dis').html();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Common/getItemDelWithPurPriceByItemCode') ?>",
                    data: { item_code: ele.value },
                    dataType: "Json",
                    success: function (resultData) {
                        let item_data = resultData.item_det;

                        let itemCode  = null;
                        let itemDesc = null;
                        let itemPrice = null; 
                        let itemUom = null; 
                        if (item_data) {
                            itemCode = item_data.I_CODE;
                            itemDesc = item_data.I_DESC;
                            itemPrice = item_data.I_LIST_PRICE;
                            itemUom = item_data.I_UOM_CODE;
                        }else{
                            itemCode = ele.value;
                            itemDesc = 'Unknown Item';
                            itemPrice = 0;
                            itemUom = 'Unknown Item';
                        }



                        if (item_arr.indexOf(itemCode) == -1) {
                            item_arr.push(itemCode);

                            $(ele).closest('tr').find('td #item-code-db').val(itemCode);


                            $(ele).closest('tr').find('td .list-price-in').val(itemPrice);

                            $(ele).closest('tr').find('td #i-ext-desc').html(itemDesc);

                            $(ele).closest('tr').find('td #item-desc-db').val(itemDesc);
                            $(ele).closest('tr').find('td .item-qty-db').val(1);
                            $(ele).closest('tr').find('td #item-uom-db').val(itemUom);

                        } else {
                            $(ele).closest('tr').find('td #i-ext-desc').html('DATA NOT AVAILABLE');
                        }
                    }
                });
            } else {
                $(ele).closest('tr').find('td #i-ext-desc').html('DATA NOT AVAILABLE');
            }
        }

        function currentDateTime() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('Common/getCurrentDateAndTime') ?>",
                dataType: "Json",
                success: function(resultData){
                    $('.end-date-dsp').val(resultData);
                }

            })
            
        }
        currentDateTime();
        setInterval(function(){ 
            currentDateTime();
        },10000);

        function checkAuth() {
            $('#staticBackdrop').modal('show');
            $('.fixed-modal-head').html(`Authentication Required`);
            $('.fixed-modal-body').html(`<form id="formdata-modal">
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
                                        <input type="hidden" name="auth_type" value="USER_LOGIN">
                                    </form>`);
            $('#formRadios1').prop('checked','true');
            $('.fixed-modal-footer').html(`
                <button type="button" class="btn btn-light op d-none" data-bs-dismiss="modal" class="fixed-modal-close">Close</button>
                <button type="button" data-function="Y" data-modalid="null" data-confmsg="Check All field then verify it" data-control="common/user-auth" data-form="formdata-modal" class="form-modal btn btn-primary waves-effect waves-light st_model_send">Verify</button>`);
        }

        function customFunction() {
            if(retuen_data_ajax.auth_type == 'USER_LOGIN'){

            if(retuen_data_ajax.login){
                Swal.fire({
                            title: "Authentication success",
                            text: "Accepted Physical Inventory Count Request",
                            icon: "success",
                            confirmButtonColor: "#556ee6"
                        });
                $('#staticBackdrop').modal('hide');
                $('#auth-button').addClass('d-none');
                $('#auth-button-show').html(`<button data-control="inventory/physical-inventory-count-add-db" data-aftreload="true"
                                                data-sweetalert="<?= $sweetAlertMsg->phyInvCountdb->msg ?>"
                                                data-sweetalertcontrol="<?= $sweetAlertMsg->phyInvCountdb->cont ?>"
                                                data-form="formdata"
                                                class="ajaxform btn btn-primary waves-effect waves-light"
                                                type="submit">Add Physical Inventory Count</button>`);
            }else{
                Swal.fire({
                            title: "Authentication Failed",
                            text: `${retuen_data_ajax.ReMsg}`,
                            icon: "error",
                            confirmButtonColor: "#556ee6"
                        });
            }
            }
        }
    </script>