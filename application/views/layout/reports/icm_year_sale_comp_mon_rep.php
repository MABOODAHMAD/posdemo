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
                                                                <label for="validationCustom05" class="form-label">Financial Year 1</label>
                                                                    <select class="form-control select2" name="finacl_year_1_db">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <option value='<?=date('Y')?>'><?=date('Y')?></option>
                                                                        <?php 
                                                                            for ($i=1; $i < 10; $i++) { 
                                                                                $last_year = date("Y", strtotime("-$i year"));
                                                                        ?>
                                                                                <option value='<?=$last_year?>'><?=$last_year?></option>
                                                                        <?php }?>
                                                                    </select>
                                                                <label id="finacl_year_1_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Financial Year 2</label>
                                                                    <select class="form-control select2" name="finacl_year_2_db">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <option value='<?=date('Y')?>'><?=date('Y')?></option>
                                                                        <?php 
                                                                            for ($i=1; $i < 10; $i++) { 
                                                                                $last_year = date("Y", strtotime("-$i year"));
                                                                        ?>
                                                                                <option value='<?=$last_year?>'><?=$last_year?></option>
                                                                        <?php }?>
                                                                    </select>
                                                                <label id="finacl_year_2_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Month-1</label>
                                                                    <select name="period_1_db" class="form-control select2">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach($months as $monthsGet):?>
                                                                            <option value="<?=$monthsGet?>"><?=$monthsGet?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="period_1_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Month-2</label>
                                                                    <select name="period_2_db" class="form-control select2">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach($months as $monthsGet):?>
                                                                            <option value="<?=$monthsGet?>"><?=$monthsGet?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="period_2_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                            <input type="hidden" name="gl_type" value="<?=$submit?>">
                                                        <div>
                                                            <button data-control="report/year-sale-comp-mon-report" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->stockStatusOrderByclass->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->stockStatusOrderByclass->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$submit?></button>
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