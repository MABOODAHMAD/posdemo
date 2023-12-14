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
                                    <h4 class="mb-sm-0 font-size-18"><?=$mainTitle?></h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        

                       
                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-body">
                                                <div class="card-body border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 card-title flex-grow-1"><?=$subTitle?></h5>
                                                        <div class="flex-shrink-0">
                                                            <!-- <?php if(dashRole(["role_check"=>"ACCOUNT_GL_ENTRY"])){?><a href="<?=base_Url('glEntry')?>" class="btn btn-primary" >GL Entry List</a><?php } ?>
                                                             <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            <p><?=$this->session->flashdata('ALERT_MSG')?></p>
                                            <div class="card-body">
                                                <form id="formdata">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">From Warehouse</label>
                                                                    <!-- <input type="text" class="form-control"  placeholder="Enter Name"> -->
                                                                <select name="whse_from_db" class="form-control select2">
                                                                    <option value='' Selected disabled>Select</option>
                                                                    <?php foreach ($whareDets as $whareDet):
                                                                            if($sesData->USER_TYPE == 'SUPERADMIN'){ ?>
                                                                                <option value="<?=$whareDet->WHSE_CODE?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                            <?php }elseif ($sesData->USER_TYPE == 'USER') { 
                                                                                    foreach ($whse_assign as $whseGet):
                                                                                        if($whseGet->SMSW_WHSE_CODE == $whareDet->WHSE_CODE){
                                                                            ?>

                                                                            <option value="<?=$whareDet->WHSE_CODE?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                        <?php } endforeach; } endforeach; ?>
                                                                </select>
                                                                <label id="whse_from_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">To Warehouse</label>
                                                                    <!-- <input type="text" class="form-control"  placeholder="Enter Name"> -->
                                                                <select name="whse_to_db" class="form-control select2">
                                                                    <option value='' Selected disabled>Select</option>
                                                                    <?php foreach ($whareDets as $whareDet):
                                                                            if($sesData->USER_TYPE == 'SUPERADMIN'){ ?>
                                                                                <option value="<?=$whareDet->WHSE_CODE?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                            <?php }elseif ($sesData->USER_TYPE == 'USER') { 
                                                                                    foreach ($whse_assign as $whseGet):
                                                                                        if($whseGet->SMSW_WHSE_CODE == $whareDet->WHSE_CODE){
                                                                            ?>

                                                                            <option value="<?=$whareDet->WHSE_CODE?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                        <?php } endforeach; } endforeach; ?>
                                                                </select>
                                                                <label id="whse_to_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">From Item</label>
                                                                    <select name="item_code_from_db" class="form-control select2">
                                                                        <option value='' Selected>All</option>
                                                                        <?php foreach($itemDet as $itemDetGet): ?>
                                                                            <option value="<?=$itemDetGet->I_CODE?>"><?=$itemDetGet->I_CODE . '-' . $itemDetGet->I_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="item_code_from_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">To Item</label>
                                                                    <select name="item_code_to_db" class="form-control select2">
                                                                        <option value='' Selected>All</option>
                                                                        <?php foreach($itemDet as $itemDetGet): ?>
                                                                            <option value="<?=$itemDetGet->I_CODE?>"><?=$itemDetGet->I_CODE . '-' . $itemDetGet->I_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="item_code_to_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">From Category</label>
                                                                    <select name="item_cat_from_db" class="form-control select2 item-cat-from" onChange="itemCatCh(this)">
                                                                        <option value='' Selected>All</option>
                                                                        <?php foreach($itemCat as $itemCatGet): ?>
                                                                            <option value="<?=$itemCatGet->ICAT_CODE?>"><?=$itemCatGet->ICAT_CODE . '-' . $itemCatGet->ICAT_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="item_cat_from_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">To Category</label>
                                                                    <select name="item_cat_to_db" class="form-control select2 item-cat-to" onChange="itemCatCh(this)">
                                                                        <option value='' Selected>All</option>
                                                                        <?php foreach($itemCat as $itemCatGet): ?>
                                                                            <option value="<?=$itemCatGet->ICAT_CODE?>"><?=$itemCatGet->ICAT_CODE . '-' . $itemCatGet->ICAT_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="item_cat_to_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">From Class</label>
                                                                    <!-- <input type="text" class="form-control"  placeholder="Enter Name"> -->
                                                                    <select name="item_cls_from_db" class="form-control select2 item-cls-from" onChange="itemClsCh(this)">
                                                                        <option value='' Selected>All</option>
                                                                        <?php foreach($classDet as $classDetGet): ?>
                                                                            <option value="<?=$classDetGet->IC_CODE?>"><?=$classDetGet->IC_CODE . '-' . $classDetGet->IC_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="item_cls_from_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">To Class</label>
                                                                    <!-- <input type="text" class="form-control"  placeholder="Enter Name"> -->
                                                                    <select name="item_cls_to_db" class="form-control select2 item-cls-to" onChange="itemClsCh(this)">
                                                                        <option value='' Selected>All</option>
                                                                        <?php foreach($classDet as $classDetGet): ?>
                                                                            <option value="<?=$classDetGet->IC_CODE?>"><?=$classDetGet->IC_CODE . '-' . $classDetGet->IC_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="item_cls_to_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <div class="form-floating mb-3">
                                                                    <input name="date_db" type="date" class="form-control from-date" id="floatingnameInput" value="<?=date('Y-m-d')?>">
                                                                    <label for="floatingnameInput">As of Date</label>
                                                                </div>
                                                                <label id="date_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Display Zero Balance</label>
                                                                    <!-- <input type="text" class="form-control"  placeholder="Enter Name"> -->
                                                                    <select name="dis_zero_bal_db" class="form-control select2">
                                                                        <option value='Y' Selected>Yes</option>
                                                                    </select>
                                                                <label id="dis_zero_bal_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">Only Cons Stock&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                    <input type="checkbox" name="only_con_stk_db" id="only_con_stk_db" switch="bool" value='Y'/>
                                                                    <label for="only_con_stk_db" data-on-label="Yes" data-off-label="No"></label>
                                                                <label id="only_con_stk_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">With Cons Stock&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                    <input type="checkbox" name="with_con_stk_db" id="with_con_stk_db" switch="bool" value='Y'/>
                                                                    <label for="with_con_stk_db" data-on-label="Yes" data-off-label="No"></label>
                                                                <label id="with_con_stk_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">By Price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                    <input type="checkbox" name="by_pri_db" id="by_pri_db" switch="bool" value='Y'/>
                                                                    <label for="by_pri_db" data-on-label="Yes" data-off-label="No"></label>
                                                                <label id="by_pri_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                            <input type="hidden" name="gl_type" value="<?=$submit?>">
                                                        <div>
                                                            <button data-control="report/stock-status-date-report" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->stockStatusOrderByclass->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->stockStatusOrderByclass->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$submit?></button>
                                                        </div>
                                                        <span id="outmsg"></span>
                                                    </div>
                                                     <!-- JS DATA -->
                                                </form>
                                            </div>
                                        <!--end row-->
                                    </div>
                                        </div>
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
                <script src="<?= base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

                <!--=============================== Auto Complete script Start=============================-->
                <script src="<?=base_url()?>assets/js/custom_js/jquery-1.8.3.js"></script>
                <script src="<?=base_url()?>assets/js/custom_js/jquery-ui-1.9.2.custom.js"></script>
                <!--=============================== Auto Complete script End=============================-->
    <script>
        function itemCatCh(){
            fromItemCat = $('.item-cat-from').val();
            toItemCat = $('.item-cat-to').val();
            console.log(fromItemCat,toItemCat);
            if(fromItemCat<=toItemCat){

            }else{
                // $(".item-cat-to").select2().val("0").trigger("change");
                $('.item-cat-to').val("").select2();
                if(fromItemCat && toItemCat){
                    Swal.fire({
                        title: "Item Category alert",
                        text: "To Item Category less than from Item Category Check Item Category Range",
                        icon: "error",
                        confirmButtonColor: "#556ee6"
                    });
                }
            }
        }

        function itemClsCh(){
            fromItemcls = $('.item-cls-from').val();
            toItemcls = $('.item-cls-to').val();
            if(fromItemcls<=toItemcls){

            }else{
                // $(".item-cls-to").select2().val("0").trigger("change");
                $('.item-cls-to').val("").select2();
                if(fromItemcls && toItemcls){
                    Swal.fire({
                        title: "Item class alert",
                        text: "To Item class less than from Item class Check Item class Range",
                        icon: "error",
                        confirmButtonColor: "#556ee6"
                    });
                }
            }
        }
    </script>