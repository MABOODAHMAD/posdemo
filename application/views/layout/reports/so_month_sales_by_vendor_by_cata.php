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
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">Category</label>
                                                                    <select name="item_cat_db" class="form-control select2">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach($itemCat as $itemCatGet): ?>
                                                                            <option value="<?=$itemCatGet->ICAT_CODE?>"><?=$itemCatGet->ICAT_CODE . '-' . $itemCatGet->ICAT_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="item_cat_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Location</label>
                                                                    <!-- <input type="text" class="form-control"  placeholder="Enter Name"> -->
                                                                <select name="whse_code_db" class="form-control select2">
                                                                    <option value='' Selected disabled>Select</option>
                                                                    <?php foreach ($whareDets as $whareDet):
                                                                        if (strlen($whareDet->WHSE_CODE) == 2) { 
                                                                            if($sesData->USER_TYPE == 'SUPERADMIN'){ ?>
                                                                                <option value="<?=$whareDet->WHSE_CODE?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                            <?php }elseif ($sesData->USER_TYPE == 'USER') { 
                                                                                    foreach ($whse_assign as $whseGet):
                                                                                        if($whseGet->SMSW_WHSE_CODE == $whareDet->WHSE_CODE){
                                                                            ?>

                                                                            <option value="<?=$whareDet->WHSE_CODE?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                        <?php } endforeach; } }endforeach; ?>
                                                                </select>
                                                                <label id="whse_code_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">Vendor</label>
                                                                    <select name="v_code_db" class="form-control select2">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach($vendorDet as $vendorDetGet): ?>
                                                                            <option value="<?=$vendorDetGet->V_CODE?>"><?=$vendorDetGet->V_CODE . '-' . $vendorDetGet->V_NAME?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="v_code_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <div class="form-floating mb-3">
                                                                    <input class="form-control" name="month_db" type="month" value="<?=date('Y-m')?>" id="example-month-input">
                                                                    <label for="floatingnameInput">Month WIth Year</label>
                                                                </div>
                                                                <label id="month_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">With Item detail</label>
                                                                    <input type="checkbox" name="with_item_det_db" id="with_item_det_db" switch="bool" value='Y'/>
                                                                    <label for="with_item_det_db" data-on-label="Yes" data-off-label="No"></label>
                                                                <label id="with_item_det_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">By vendor Summary</label>
                                                                    <input type="checkbox" name="by_ve_summay_db" id="by_ve_summay_db" switch="bool" value='Y'/>
                                                                    <label for="by_ve_summay_db" data-on-label="Yes" data-off-label="No"></label>
                                                                <label id="by_ve_summay_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">By Class Summary</label>
                                                                    <input type="checkbox" name="by_cls_summary_db" id="by_cls_summary_db" switch="bool" value='Y'/>
                                                                    <label for="by_cls_summary_db" data-on-label="Yes" data-off-label="No"></label>
                                                                <label id="by_cls_summary_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">Best vendor Summary</label>
                                                                    <input type="checkbox" name="best_ven_summary_db" id="best_ven_summary_db" switch="bool" value='Y'/>
                                                                    <label for="best_ven_summary_db" data-on-label="Yes" data-off-label="No"></label>
                                                                <label id="best_ven_summary_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">Customer Purchase Detail</label>
                                                                    <input type="checkbox" name="cust_pur_det_db" id="cust_pur_det_db" switch="bool" value='Y'/>
                                                                    <label for="cust_pur_det_db" data-on-label="Yes" data-off-label="No"></label>
                                                                <label id="cust_pur_det_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button data-aftreload="true" data-control="report/month-sale-vendor-cate-report" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->stockStatusOrderByclass->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->stockStatusOrderByclass->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$submit?></button>
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
                    function dateCom() {
                        fromDate = $('.from-date').val();
                        toDate = $('.to-date').val();
                        if(fromDate<=toDate){

                        }else{
                            $('.to-date').val('');
                            if(fromDate && toDate){
                                Swal.fire({
                                    title: "Date alert",
                                    text: "To date less than from date Check date Range",
                                    icon: "error",
                                    confirmButtonColor: "#556ee6"
                                });
                            }
                        }
                    }
                </script>