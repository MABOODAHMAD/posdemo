
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
                                    <h4 class="mb-sm-0 font-size-18">Terms</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Terms</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        
                                                         <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                                    <select class="form-control select2" name="TERM_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                            <option value="<?=$busUnit['BU_CODE']?>" <?php if($termsList){ echo $termsListDet->TERM_BUS_UNIT == $busUnit['BU_CODE']?'selected':null; }else{ echo defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null;}?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="TERM_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Terms Code</label>
                                                                    <input type="text" class="form-control" name="TERM_CODE" value="<?=$termsList?$termsListDet->TERM_CODE:null?>" placeholder="Auto generate if empty" <?=$termsList?'disabled':null?>>
                                                                    <label id="TERM_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Terms Description</label>
                                                                    <input type="text" class="form-control" name="TERM_DESC" value="<?=$termsList?$termsListDet->TERM_DESC:null?>">
                                                                    <label id="TERM_DESC-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Due Days</label>
                                                                    <input type="number" class="form-control" name="TERM_DUE_DAYS" value="<?=$termsList?$termsListDet->TERM_DUE_DAYS:null?>">
                                                                    <label id="TERM_DUE_DAYS-error" class="error"></label>
                                                            </div>
                                                        </div> 
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Disc Days</label>
                                                                <input type="number" class="form-control" name="TERM_DISC_DAYS" value="<?=$termsList?$termsListDet->TERM_DISC_DAYS:null?>">
                                                                <label id="TERM_DISC_DAYS-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Disc EOM</label>
                                                                <select class='form-control' name="TERM_FROM_EOM">
                                                                    <option value="N" <?php if($termsList){ echo $termsListDet->TERM_FROM_EOM == 'N'?'selected':null; }?>>N</option>
                                                                    <option value="Y" <?php if($termsList){ echo $termsListDet->TERM_FROM_EOM == 'Y'?'selected':null; }?>>Y</option>
                                                                </select>
                                                                <!-- <input type="text" class="form-control" name="TERM_FROM_EOM" maxlength="1"> -->
                                                                <label id="TERM_FROM_EOM-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Disc Percent %</label>
                                                                <input type="text" class="form-control" name="TERM_DISC_PCT" value="<?=$termsList?$termsListDet->TERM_DISC_PCT:null?>">
                                                                <label id="TERM_DISC_PCT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Notes</label>
                                                               <input type="text" class="form-control" name="TERM_NOTES" placeholder="Enter Notes" value="<?=$termsList?$termsListDet->TERM_NOTES:null?>">
                                                                <label id="TERM_NOTES-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>

                                                    <button data-control="master/term-add" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$termsList?$sweetAlertMsg->termUpdate->msg:$sweetAlertMsg->termAdd->msg?>" data-sweetalertcontrol="<?=$termsList?$sweetAlertMsg->termUpdate->cont:$sweetAlertMsg->termAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$termsList?'Update Term':'Add Term'?></button>
                                                
                                                    <!-- <button data-control="master/term-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->termAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->termAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add term</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                            
                                        </div>
                                        <input type="hidden" value="<?=$termsList?>" name="term_list_db">
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
                                                        <h5 class="mb-0 card-title flex-grow-1">Term Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Term business Unit</th>
                                                        <th>Term Code</th>
                                                        <th>Term description</th>
                                                        <th>Due Days</th>
                                                        <th>Discount days</th>
                                                        <th>Discount end of Month</th>
                                                        <th>Discount Percentage</th>
                                                        <th>Notes</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Term business Unit</th>
                                                        <th>Term Code</th>
                                                        <th>Term description</th>
                                                        <th>Due Days</th>
                                                        <th>Discount days</th>
                                                        <th>Discount end of Month</th>
                                                        <th>Discount Percentage</th>
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

            "ajax": { "url": "<?=base_url('master/term-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        