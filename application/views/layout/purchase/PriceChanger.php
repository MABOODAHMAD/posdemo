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
                                <a href="<?= base_Url() ?>PriceChangerView" class="btn btn-primary">View Price Change
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
                                <h5 class="mb-0 card-title flex-grow-1">Price Change Order</h5>

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

                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Document
                                                    Number</label>
                                                <input type="text" class="form-control"
                                                    value="<?= rand(99999, 10000) ?>" name="doc_no_db"
                                                    placeholder="Enter Number" readonly>
                                                <label id="doc_no_db-error" class="error"></label>
                                            </div>
                                        </div>


                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Document Date</label>
                                                <input class="form-control" type="date" name="item_rev_date"
                                                    value="<?= date('Y-m-d') ?>">
                                                <label id="V_NAME-error" class="error"></label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="mb-3">

                                                <label for="validationCustom03" class="form-label">Refrence</label>
                                                <input type="text" class="form-control" name="refernce_db">
                                                <label id="refernce_db-error" class="error"></label>
                                            </div>
                                        </div>


                                        <div class="col-md-2 d-none">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Type </label>
                                                <input type="text" class="form-control" name="V_CODE"
                                                    placeholder="Type ">
                                                <label id="V_CODE-error" class="error"></label>
                                            </div>

                                        </div>
                                        <div class="col-md-2 d-none">
                                            <label for="validationCustom03" class="form-label">Report And Post</label>
                                            <div class="hstack gap-2  mb-0">
                                                <button type="button" class="btn btn-primary">Report</button></br>
                                                <button type="button" class="btn btn-primary">Post</button>
                                            </div>

                                        </div>

                                        <div class="col-md-5">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Remark</label>
                                                <input class="form-control" type="text" name="remark_db">
                                                <label id="remark_db-error" class="error"></label>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="mb-3">

                                                <label for="validationCustom03" class="form-label">Warehouse</label>
                                                <input type="text" class="form-control" name="Item Desc">
                                                <label id="V_NAME_AR-error" class="error"></label>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="mb-3">

                                                <label for="validationCustom03" class="form-label">posted</label>
                                                <input type="text" class="form-control" value="N" disabled="true">
                                                <label id="V_NAME_AR-error" class="error"></label>
                                            </div>
                                        </div>




                                        <div class="col-md-3 d-none">
                                            <label for="validationCustom03" class="form-label">For Authenticate</label>
                                            <div class="hstack gap-2  mb-0">
                                                <button type="button" class="btn btn-primary">Authenticate</button>
                                                <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                                            </div>
                                        </div>

                                        <div class="col-md-3 d-none">
                                            <div class="mb-3">

                                                <label for="validationCustom03" class="form-label">Price Change
                                                    %</label>
                                                <select class="form-select" name="item_status">
                                                    <option value="0">0</option>
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                </select>
                                                <label id="V_NAME_AR-error" class="error"></label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 d-none">
                                            <label for="validationCustom03" class="form-label">Apply or Revert
                                                Changes</label>
                                            <div class="hstack gap-2  mb-0">
                                                <button type="button" class="btn btn-primary">Apply Change</button>
                                                <button type="button" class="btn btn-primary">Revert Change</button>
                                            </div>
                                        </div>

                                        <div class="col-md-2 d-none">
                                            <div class="mb-3">

                                                <label for="validationCustom03" class="form-label">Promotion
                                                    Code</label>
                                                <input type="text" class="form-control" name="V_NAME_AR">
                                                <label id="V_NAME_AR-error" class="error"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-none">
                                            <label for="validationCustom03" class="form-label">Add to Promotion</label>
                                            <div class="hstack gap-2  mb-0">
                                                <button type="button" class="btn btn-primary">Add to Promotion</button>
                                                <!--<button type="button" class="btn btn-secondary">Revert Change</button>-->
                                            </div>
                                        </div>
                                        <h2 class="mb-3">Price Change Order</h2>
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap table-check">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 20px;" class="align-middle"></th>
                                                        <th class="align-middle" width='100px'>Item</th>
                                                        <th class="align-middle" width='350px'>Item Desc</th>
                                                        <th class="align-middle" width='250'>Vendor Item Code</br>Vendor Code</th>
                                                        <th class="align-middle" width='100px'>Price</th>
                                                        <th class="align-middle" width='50px'>Markup</th>

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
                                                <div class='col-md-4'>
                                                    <input type="file" name='price_changer_line_file' onChange="lineUpload(this)"
                                                        class="form-control mt-3 mt-lg-0">
                                                </div>
                                                <div class='col-md-4'>
                                                    <a href="<?= base_url('uploads/price_changer/template/ITEM_PRICE_CHANGER.xlsx') ?>"
                                                        download="">
                                                        <!-- <button class="mb-2 mr-2 btn-icon-vertical btn btn-primary"><i class="lnr-enter btn-icon-wrapper"> </i>Downlaod File</button> -->
                                                        <button type="button" class="btn btn-primary">Download Template
                                                            <i class="bx bx-download align-baseline ms-1"></i></button>
                                                    </a>
                                                </div>
                                            </div>
                                            <br><br>
                                            <button data-control="purchase/price-update-changer" data-aftreload="true"
                                                data-sweetalert="<?= $sweetAlertMsg->itemPriceChangeUp->msg ?>"
                                                data-sweetalertcontrol="<?= $sweetAlertMsg->itemPriceChangeUp->cont ?>"
                                                data-form="formdata"
                                                class="ajaxform btn btn-primary waves-effect waves-light"
                                                type="submit">Update Price</button>

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
                    url: "<?=base_url('upload/bulkItemPriceChanger')?>",
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

                                            if (item_arr.indexOf(element.item_det.I_CODE) == -1 && item_data.I_DESC) {
                                                item_arr.push(element.item_det.I_CODE);
                                                let tableLength = $('#tbUser tr').length + 1;
                                                let ext_desc = item_data.I_EXTEND_DESC.substr(0, 20);
                                                let item_desc = item_data.I_DESC.substr(0, 20);
                                                $('#tbUser').append(`<tr>
                                                    <td width="5%"><span>${tableLength}<span></td>
                                                    <td width="18%"><input type="text" onInput='itemSearchIn(this)' value="${item_data.I_CODE}" class="form-control"/></td>
                                                    <td width="20%"><span id="i-desc">${item_desc}</span></br><span id="i-ext-desc"></span></td>
                                                    <td width="15%"><span id="ven-item-code-dsp">${item_data.VEN_I_CODE}</span></br><span id="ven-code-dsp">${item_data.VEN_CODE}</span></td>
                                                    <td width="15%"><input type="number" class="form-control list-price-in" value="${element.unt_price_sar}" name="list_price_db[]" readonly="true"></td>
                                                    <td width="20%"><span id="markup-val-dsp">${item_data.I_COST_MULTIPLIER}</span>
                                                        <input type="hidden" name="item_code_db[]" id="item-code-db" value="${item_data.I_CODE}">
                                                        <input type="hidden" name="markup[]" id="markup-db" value="${item_data.I_COST_MULTIPLIER}">
                                                    </td>
                                                    
                                                </tr>`);

                                            } else {
                                                $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
                                                $(ele).closest('tr').find('td #i-ext-desc').html('');

                                                $(ele).closest('tr').find('td .list-price-in').prop('readonly', true);

                                                $(ele).closest('tr').find('td #markup-val-dsp').html('');
                                                $(ele).closest('tr').find('td #ven-item-code-dsp').html('');
                                                $(ele).closest('tr').find('td #ven-code-dsp').html('');
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
                                    <td width="18%"><input type="text" onInput='itemSearchIn(this)' class="form-control"/></td>
                                    <td width="20%"><span id="i-desc"></span></br><span id="i-ext-desc"></span></td>
                                    <td width="15%"><span id="ven-item-code-dsp"></span></br><span id="ven-code-dsp"></td>
                                    <td width="15%"><input type="number" class="form-control list-price-in" name="list_price_db[]" readonly="true"></td>
                                    <td width="20%"><span id="markup-val-dsp"></span>
                                        <input type="hidden" name="item_code_db[]" id="item-code-db">
                                        <input type="hidden" name="markup[]" id="markup-db">
                                    </td>
                                    
                                </tr>`);
        }

        for (let index = 0; index < 10; index++) {
            additemLine();
        }

        function itemSearchIn(ele) {
            $(ele).closest('tr').find('td #item-code-db').val('');
            $(ele).closest('tr').find('td #item-ven-price-db').val('');
            $(ele).closest('tr').find('td #item-qty-db').val('');
            $(ele).closest('tr').find('td #markup-db').val('');

            $(ele).closest('tr').find('td .list-price-in').val('');

            if (ele.value.length > 3) {
                let v_code = $('.v-code-dis').html();
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Common/getItemDelWithPurPriceByItemCode') ?>",
                    data: { item_code: ele.value },
                    dataType: "Json",
                    success: function (resultData) {
                        let item_data = resultData.item_det;

                        if (item_data.I_DESC) {

                            $(ele).closest('tr').find('td #item-code-db').val(item_data.I_CODE);


                            $(ele).closest('tr').find('td .list-price-in').val(resultData.unt_price_sar);

                            $(ele).closest('tr').find('td #i-desc').html(item_data.I_DESC);
                            $(ele).closest('tr').find('td #i-ext-desc').html(item_data.I_EXTEND_DESC);

                            $(ele).closest('tr').find('td #ven-item-code-dsp').html(item_data.VEN_I_CODE);
                            $(ele).closest('tr').find('td #ven-code-dsp').html(item_data.VEN_CODE);

                            $(ele).closest('tr').find('td #markup-val-dsp').html(item_data.I_COST_MULTIPLIER);

                            $(ele).closest('tr').find('td .list-price-in').prop('readonly', false);

                            $(ele).closest('tr').find('td #markup-db').val(item_data.I_COST_MULTIPLIER);



                        } else {
                            $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
                            $(ele).closest('tr').find('td #i-ext-desc').html('');

                            $(ele).closest('tr').find('td .list-price-in').prop('readonly', true);

                            $(ele).closest('tr').find('td #markup-val-dsp').html('');
                            $(ele).closest('tr').find('td #ven-item-code-dsp').html('');
                            $(ele).closest('tr').find('td #ven-code-dsp').html('');
                        }
                    }
                });
            } else {
                $(ele).closest('tr').find('td #i-desc').html('DATA NOT AVAILABLE');
                $(ele).closest('tr').find('td #i-ext-desc').html('');

                $(ele).closest('tr').find('td .list-price-in').prop('readonly', true);

                $(ele).closest('tr').find('td #markup-val-dsp').html('');
                $(ele).closest('tr').find('td #ven-item-code-dsp').html('');
                $(ele).closest('tr').find('td #ven-code-dsp').html('');
            }
        }

    </script>