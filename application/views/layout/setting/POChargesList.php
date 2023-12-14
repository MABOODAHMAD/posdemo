
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
                                    <h4 class="mb-sm-0 font-size-18">PO Charges List</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New PO Charges</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">PO Charges Code</label>
                                                                    <input type="text" class="form-control" name="CHRG_TYPE" value="<?=$poCHargeId?$poChargeDets->CHRG_TYPE:null?>" placeholder="Auto generate if empty" <?=$poCHargeId?'disabled':null?>>
                                                                    <label id="CHRG_TYPE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">PO Charges Description</label>
                                                                    <input type="text" class="form-control" name="CHRG_DESC" value="<?=$poCHargeId?$poChargeDets->CHRG_DESC:null?>">
                                                                    <label id="CHRG_DESC-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">ACCT_LVL1</label>
                                                                <input type="text" class="form-control" name="CHRG_ACCT_LVL1" value="<?=$poCHargeId?$poChargeDets->CHRG_ACCT_LVL1:null?>">
                                                                <label id="CHRG_ACCT_LVL2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">ACCT_LVL2</label>
                                                                    <input type="text" class="form-control" name="CHRG_ACCT_LVL2" value="<?=$poCHargeId?$poChargeDets->CHRG_ACCT_LVL2:null?>">
                                                                <label id="CHRG_ACCT_LVL2-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Notes</label>
                                                               <input type="text" class="form-control" name="CHRG_NOTES" placeholder="Enter Notes" value="<?=$poCHargeId?$poChargeDets->CHRG_NOTES:null?>">
                                                                <label id="CHRG_NOTES-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>
                                                    <!-- <button data-control="master/po-charge-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->POchrgAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->POchrgAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add PO Charges</button> -->

                                                    <button data-control="master/po-charge-add" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$poCHargeId?$sweetAlertMsg->POchrgUpdate->msg:$sweetAlertMsg->POchrgAdd->msg?>" data-sweetalertcontrol="<?=$poCHargeId?$sweetAlertMsg->POchrgUpdate->cont:$sweetAlertMsg->POchrgAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$poCHargeId?'Update PO Charge':'Add PO Charge'?></button>

                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" value="<?=$poCHargeId?>" name="po_charge_list_db">
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
                                                        <h5 class="mb-0 card-title flex-grow-1">PO Charges Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>PO charge code</th>
                                                        <th>PO charge description</th>
                                                        <th>PO charge Account level 1</th>
                                                        <th>PO charge Account level 2</th>
                                                        <th>Note</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>PO charge code</th>
                                                        <th>PO charge description</th>
                                                        <th>PO charge Account level 1</th>
                                                        <th>PO charge Account level 2</th>
                                                        <th>Note</th>
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

            "ajax": { "url": "<?=base_url('master/po-charge-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        