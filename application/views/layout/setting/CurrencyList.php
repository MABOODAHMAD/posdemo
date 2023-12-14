
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
                                    <h4 class="mb-sm-0 font-size-18">Currency</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Currency</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Currency Code</label>
                                                                    <input type="text" class="form-control" name="CUR_ID" value="<?=$currCode?$currDet->CUR_CODE:null?>" placeholder="Auto generate if empty" <?=$currCode?'disabled':null?>>
                                                                    <label id="CUR_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Currency Name</label>
                                                                    <input type="text" class="form-control" name="CUR_NAME" value="<?=$currCode?$currDet->CUR_NAME:null?>" placeholder="Enter Currency Name ">
                                                                    <label id="CUR_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Currency Arbic Name</label>
                                                                    <input type="text" class="form-control" name="CUR_NAME_AR" value="<?=$currCode?$currDet->CUR_NAME_AR:null?>" placeholder="Enter Currency Name ">
                                                                    <label id="CUR_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div> 
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Abbreviation</label>
                                                                <input type="text" class="form-control" name="CUR_ABBRV" value="<?=$currCode?$currDet->CUR_ABBRV:null?>" placeholder="Enter Abbreviation">
                                                                <label id="CUR_ABBRV-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Notes</label>
                                                               <input type="text" class="form-control" name="CUR_NOTES" value="<?=$currCode?$currDet->CUR_NOTES:null?>" placeholder="Enter Notes">
                                                                <label id="CUR_NOTES-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>
                                                    <button data-control="master/currency-add" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$currCode?$sweetAlertMsg->currUpdate->msg:$sweetAlertMsg->currAdd->msg?>" data-sweetalertcontrol="<?=$currCode?$sweetAlertMsg->currUpdate->cont:$sweetAlertMsg->currAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$currCode?'Update currency':'Add currency'?></button>

                                                    <!-- <button data-control="master/currency-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->currAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->currAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add currency</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" value="<?=$currCode?>" name="curr_code_db">
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
                                                        <h5 class="mb-0 card-title flex-grow-1">Currency Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Currency Code</th>
                                                        <th>Currency Name</th>
                                                        <th>Abbraviation</th>
                                                        <th>Notes</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Currency Code</th>
                                                        <th>Currency Name</th>
                                                        <th>Abbraviation</th>
                                                        <th>Notes</th>
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

            "ajax": { "url": "<?=base_url('master/currency-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        