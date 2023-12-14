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
                                                                    <div class="form-floating mb-3">
                                                                        <input name="from_date_db" type="date" class="form-control from-date" onBlur="dateCom()" id="floatingnameInput" placeholder="Enter Name" value="<?=date('Y-m-d')?>">
                                                                        <label for="floatingnameInput">From date</label>
                                                                    </div>
                                                                    <label id="from_date_db-error" class="error"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <div class="form-floating mb-3">
                                                                        <input name="to_date_db" type="date" onBlur="dateCom()" class="form-control to-date" id="floatingnameInput" placeholder="Enter Name" value="<?=date('Y-m-d')?>">
                                                                        <label for="floatingnameInput">To date</label>
                                                                    </div>
                                                                    <label id="to_date_db-error" class="error"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="validationCustom03" class="form-label">Warehouse</label>
                                                                        <select name="whse_code_db" class="form-control select2" onchange="whseIn(this.value)">
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
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                        <label for="validationCustom03" class="form-label">Customer</label>
                                                                        <select name="cust_db" class="form-control select2 cust-add">
                                                                            <option value=''></option>
                                                                        </select>
                                                                    <label id="cust_db-error" class="error"></label>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button data-control="report/customer-statement-report" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->stockStatusOrderByclass->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->stockStatusOrderByclass->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$submit?></button>
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

        function whseIn(ele) {
            $('.cust-add').empty();
            $.ajax({
                type: "POST",
                url: "<?= base_url('Common/getCustLisByWhseCode') ?>",
                data: {whse_code:ele},
                dataType: "Json",
                success: function(resultData){
                    resultData.forEach(element => {
                            
                        $('.cust-add').append(`<option value='${element.CUST_CODE}'>${element.CUST_CODE}-${element.CUST_NAME}</option>`);
                    });
                }
            });
        }
    </script>