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
                                                    <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Cost Center</label>
                                                                    <select class="form-control select2" name="cost_center_db">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($costCentDet as $costCentDetGet):?>
                                                                            <option value="<?=$costCentDetGet->CC_CODE?>"><?=$costCentDetGet->CC_CODE.'-'.$costCentDetGet->CC_WHSE_CODE.'-'.$costCentDetGet->WHSE_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="cost_center_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Financial Year</label>
                                                                    <select class="form-control select2" name="finacl_year_db">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <option value='<?=date('Y')?>'><?=date('Y')?></option>
                                                                        <?php 
                                                                            for ($i=1; $i < 10; $i++) { 
                                                                                $last_year = date("Y", strtotime("-$i year"));
                                                                        ?>
                                                                                <option value='<?=$last_year?>'><?=$last_year?></option>
                                                                        <?php }?>
                                                                    </select>
                                                                <label id="finacl_year_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">From Period</label>
                                                                    <select name="from_period_db" class="form-control select2 period-from" onChange="checkPeriod()">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach($months as $monthsGet):?>
                                                                            <option value="<?=$monthsGet?>"><?=$monthsGet?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="from_period_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">To Period</label>
                                                                    <select name="to_period_db" class="form-control select2 period-to" onChange="checkPeriod()">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach($months as $monthsGet):?>
                                                                            <option value="<?=$monthsGet?>"><?=$monthsGet?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="to_period_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">From Level</label>
                                                                    <select name="level_from" class="form-control select2 level-from" onChange="checkLevel()">
                                                                        <option value='1'>Level 1</option>
                                                                        <option value='2'>Level 2</option>
                                                                        <option value='3'>Level 3</option>
                                                                        <option value='4'>Level 4</option>
                                                                    </select>
                                                                <label id="level_from-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">To Level</label>
                                                                    <select name="level_to" class="form-control select2 level-to" onChange="checkLevel()">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <option value='1'>Level 1</option>
                                                                        <option value='2'>Level 2</option>
                                                                        <option value='3'>Level 3</option>
                                                                        <option value='4'>Level 4</option>
                                                                    </select>
                                                                <label id="level_to-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">From Account</label>
                                                                    <select name="from_acc_db" class="form-control select2 acc-from" onChange="checkAccount()">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach($allAccDet as $allAccDetGet):?>
                                                                            <option value="<?=$allAccDetGet?>"><?=$allAccDetGet?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="from_acc_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">To Account</label>
                                                                    <select name="to_acc_db" class="form-control select2 acc-to" onChange="checkAccount()">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach($allAccDet as $allAccDetGet):?>
                                                                            <option value="<?=$allAccDetGet?>"><?=$allAccDetGet?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="to_acc_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Post type</label>
                                                                    <select name="post_type" class="form-control select2">
                                                                        <option value='P'>POSTED</option>
                                                                        <option value=''>UN-POSTED</option>
                                                                    </select>
                                                                <label id="post_type-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                            <input type="hidden" name="gl_type" value="<?=$submit?>">
                                                        <div>
                                                            <button data-control="report/account-trail-balance" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->stockStatusOrderByclass->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->stockStatusOrderByclass->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$submit?></button>
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
        
        function checkPeriod() {
            fromDate = $('.period-from').val();
            toDate = $('.period-to').val();
            if(fromDate<=toDate){

            }else{
                $('.period-to').val("").select2();
                if(fromDate && toDate){
                    Swal.fire({
                        title: "Period alert",
                        text: "To period less than from period Check period Range",
                        icon: "error",
                        confirmButtonColor: "#556ee6"
                    });
                }
            }
        }
        function checkLevel() {
            fromDate = $('.level-from').val();
            toDate = $('.level-to').val();
            if(fromDate<=toDate){

            }else{
                $('.level-to').val("").select2();
                if(fromDate && toDate){
                    Swal.fire({
                        title: "Level alert",
                        text: "To Level less than from Level Check Level Range",
                        icon: "error",
                        confirmButtonColor: "#556ee6"
                    });
                }
            }
        }
        function checkAccount() {
            fromDate = $('.acc-from').val();
            toDate = $('.acc-to').val();
            if(fromDate<=toDate){

            }else{
                $('.acc-to').val("").select2();
                if(fromDate && toDate){
                    Swal.fire({
                        title: "Account alert",
                        text: "To Account less than from Account Check Account Range",
                        icon: "error",
                        confirmButtonColor: "#556ee6"
                    });
                }
            }
        }
    </script>