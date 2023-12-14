
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
                                    <h4 class="mb-sm-0 font-size-18">PAYMENT METHODS</h4>
                                    <div class="page-title-right">
                                        
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Payment Method</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Payment Method Code</label>
                                                                    <input type="text" class="form-control" name="PM_CODE" value="<?=$Paylist?$PaylistDet->PM_CODE:null?>" placeholder="Auto generate if empty" <?=$Paylist?'disabled':null?>>
                                                                    <label id="PM_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Payment Method description</label>
                                                                    <input type="text" class="form-control" name="PM_DESC" value="<?=$Paylist?$PaylistDet->PM_DESC:null?>" placeholder="Enter Payment Method Name ">
                                                                    <label id="PM_DESC-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Payment Method Deductions</label>
                                                                <input type="email" class="form-control" name="PM_DED_PRCNT" value="<?=$Paylist?$PaylistDet->PM_DED_PRCNT:null?>" placeholder="Enter Payment Method Deductions">
                                                                <label id="PM_DED_PRCNT-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Account Level 1 Deduction</label>
                                                                <input type="email" class="form-control" name="PM_ACCT_LVL1_DED" value="<?=$Paylist?$PaylistDet->PM_ACCT_LVL1_DED:null?>" placeholder="Enter Level 1">
                                                                <label id="PM_ACCT_LVL1_DED-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Account Level 2 Deduction</label>
                                                                <input type="email" class="form-control" name="PM_ACCT_LVL2_DED" value="<?=$Paylist?$PaylistDet->PM_ACCT_LVL2_DED:null?>"  placeholder="Enter Level 2">
                                                                <label id="PM_ACCT_LVL2_DED-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- <div class="col-md-4">-->
                                                        <!--    <div class="mb-3">-->
                                                        <!--        <label for="validationCustom04" class="form-label">Customer</label>-->
                                                        <!--        <input type="email" class="form-control" name="contry_abbra" placeholder="Enter Customer">-->
                                                        <!--        <label id="contry_abbra-error" class="error"></label>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">AR Post</label>
                                                                <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox" value="Y" id="formCheck1er" name="PM_AR_POST" <?php if($Paylist){ echo $PaylistDet->PM_AR_POST=='Y'?'Checked':NULL;}?>>
                                                                    <label class="form-check-label" for="formCheck1er">Enabled</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Print</label>
                                                                <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox" value="Y" id="formCheck1print" name="PM_PRINT" <?php if($Paylist){ echo $PaylistDet->PM_PRINT=='Y'?'Checked':NULL;}?>>
                                                                    <label class="form-check-label" for="formCheck1print">Enabled</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                <div>
                                            <!-- <button data-control="master/pay-method-add" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->payMethAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->payMethAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add payment method</button> -->
                                               
                                                    
                                                 <button data-control="master/pay-method-add" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$Paylist?$sweetAlertMsg->payMethUpdate->msg:$sweetAlertMsg->payMethAdd->msg?>" data-sweetalertcontrol="<?=$Paylist?$sweetAlertMsg->payMethUpdate->cont:$sweetAlertMsg->payMethAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$Paylist?'Update Payment Method':'Add Payment Method'?></button>

                                                </div>
                                                <span id="outmsg"></span>

                                                <input type="hidden" value="<?=$Paylist?>" name="Paylist_db">
                                            
                                        </div>
                                        </form>
                                    </div>
                                    <!-- end card -->
                                </div> 
                             </div>
                        </div>
                
                
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-body">
                                                <div class="card-body border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 card-title flex-grow-1">Payment Method Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Code</th>
                                                        <th>Name</th>
                                                        <th>Deductions</th>
                                                        <th>Level 1</th>
                                                        <th>Level 2</th>
                                                        <th>Print</th>
                                                        <th>Ar Post</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Code</th>
                                                        <th>Name</th>
                                                        <th>Deductions</th>
                                                        <th>Level 1</th>
                                                        <th>Level 2</th>
                                                        <th>Print</th>
                                                        <th>Ar Post</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
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
   
    $(document).ready(function() {
        $('#datatable').DataTable({

            "processing": true,

            "serverSide": true,

            "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],

            "dom" : 'lBfrtip',

            "buttons" : ['copy', 'csv', 'excel', 'print'],

            "order": [],

            "scrollX": true,

            "ajax": { "url": "<?=base_url('master/pay-method-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        