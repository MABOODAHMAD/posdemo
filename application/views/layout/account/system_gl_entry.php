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
                                                            <?php if(dashRole(["role_check"=>"ACCOUNT_GL_ENTRY"])){?><a href="<?=base_Url('glEntry')?>" class="btn btn-primary" >GL Entry List</a><?php } ?>
                                                             <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <p><?=$this->session->flashdata('ALERT_MSG')?></p>
                                            <div class="card-body">
                                                <form id="formdata">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <div class="form-floating mb-3">
                                                                    <input name="from_date_db" type="date" class="form-control from-date" onBlur="dateCom()" id="floatingnameInput" placeholder="Enter Name" value="<?=date('Y-m').'-01'?>">
                                                                    <label for="floatingnameInput">From date</label>
                                                                </div>
                                                                <label id="from_date_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <div class="form-floating mb-3">
                                                                    <input name="to_date_db" type="date" onBlur="dateCom()" class="form-control to-date" id="floatingnameInput" placeholder="Enter Name" value="<?=date('Y-m').'-30'?>">
                                                                    <label for="floatingnameInput">To date</label>
                                                                </div>
                                                                <label id="to_date_db-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Warehouse</label>
                                                                    <!-- <input type="text" class="form-control"  placeholder="Enter Name"> -->
                                                                    <select name="whse_code_db" class="form-control select2">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach($whareDets as $whareDet):
                                                                        if($submit == 'Transfer'){ ?>
                                                                                    <option value="<?=$whareDet->WHSE_CODE?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                        <?php  }else{ if (strlen($whareDet->WHSE_CODE) == 2) { ?>
                                                                                    <option value="<?=$whareDet->WHSE_CODE?>"><?=$whareDet->WHSE_CODE . '-' . $whareDet->WHSE_DESC?></option>
                                                                        <?php } } endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <label id="whse_code_db-error" class="error"></label>
                                                        </div>
                                                        <?php if($submit == 'Sale'){?>
                                                            <input type="hidden" name="gl_type" value="<?=$submit?>">
                                                        <?php }elseif($submit == 'Purchase'){?>
                                                            <div class="col-md-3">
                                                                <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">Purchase GL type</label>
                                                                        <!-- <input type="text" class="form-control"  placeholder="Enter Name"> -->
                                                                        <select name="gl_type" class="form-control select2">
                                                                            <option value="NPO">NPO</option>
                                                                            <option value="CPO">CPO</option>
                                                                        </select>
                                                                    </div>
                                                                    <label id="gl_type-error" class="error"></label>
                                                            </div>
                                                        <?php }elseif($submit == 'Transfer'){ ?>
                                                            <input type="hidden" name="gl_type" value="<?=$submit?>">
                                                        <?php }?>
                                                        <div>
                                                            <button data-control="account/system-gl-create-db" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->systemGlAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->systemGlAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$submit?> GL</button>
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
            <!-- end main content-->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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