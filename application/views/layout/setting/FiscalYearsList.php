
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
                                    <h4 class="mb-sm-0 font-size-18">fiscal years</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Fiscal Years</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                             <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                         <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                                    <select class="form-control select2" name="FY_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?=defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="FY_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Year</label>
                                                                    <input type="text" class="form-control" name="FY_YEAR" maxlength="4">
                                                                    <label id="FY_YEAR-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;&nbsp;Pseudo&nbsp;Year&nbsp;End&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                                    <input type="checkbox" name="FY_PSEUDO_YEAREND" id="FY_PSEUDO_YEAREND" switch="bool" value='Y'/>
                                                                    <label for="FY_PSEUDO_YEAREND" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">CRE GL ACCT Buckets</label>
                                                                    <input type="checkbox" name="FY_CRE_GL_ACCT_BUCKETS" id="FY_CRE_GL_ACCT_BUCKETS" switch="bool" value='Y'/>
                                                                    <label for="FY_CRE_GL_ACCT_BUCKETS" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY APM</label>
                                                                    <input type="checkbox" name="FY_EOY_APM" id="FY_EOY_APM" switch="bool" value='Y'/>
                                                                    <label for="FY_EOY_APM" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY ARM</label>
                                                                    <input type="checkbox" name="FY_EOY_ARM" id="FY_EOY_ARM" switch="bool" value='Y'/>
                                                                    <label for="FY_EOY_ARM" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY GLM</label>
                                                                    <input type="checkbox" name="FY_EOY_GLM" id="FY_EOY_GLM" switch="bool" value='Y'/>
                                                                    <label for="FY_EOY_GLM" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY ICM</label>
                                                                    <input type="checkbox" name="FY_EOY_ICM" id="FY_EOY_ICM" switch="bool" value='Y'/>
                                                                    <label for="FY_EOY_ICM" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY POM</label>
                                                                    <input type="checkbox" name="FY_EOY_POM" id="FY_EOY_POM" switch="bool" value='Y'/>
                                                                    <label for="FY_EOY_POM" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY SFM</label>
                                                                    <input type="checkbox" name="FY_EOY_SFM" id="FY_EOY_SFM" switch="bool" value='Y'/>
                                                                    <label for="FY_EOY_SFM" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
    
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY SOM</label>
                                                                    <input type="checkbox" name="FY_EOY_SOM" id="FY_EOY_SOM" switch="bool" value='Y'/>
                                                                    <label for="FY_EOY_SOM" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Notes</label>
                                                               <input type="text" class="form-control" name="FY_NOTES" placeholder="Enter Notes">
                                                                <label id="FY_NOTES-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>
                                                    <button data-control="master/fiscal-year-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->finacYearAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->finacYearAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Financial year</button>
                                                </div>
                                                <span id="outmsg"></span>
                                            
                                        </div>
                                        </form>
                                    </div>
                                    <!-- end card -->

                                   <!-- Update Form Start -->

                                   <!-- <div class="card-body">
                                             <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                         <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                                    <select class="form-control select2" name="FY_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?=$fYearList->FY_BUS_UNIT=='Y'?'Selected':Null?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="FY_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Year</label>
                                                                    <input type="text" class="form-control" value="<?=$fYearList->FY_YEAR?>" name="CUR_ID">
                                                                    <label id="CUR_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Pseudo Year End</label>
                                                                   <select class="form-select" name="item_status">
                                                                       <option value="Y" <?=$fYearList->FY_PSEUDO_YEAREND=='Y'?'Selected':Null?>>Yes</option>
                                                                        <option value="N" <?=$fYearList->FY_PSEUDO_YEAREND=='N'?'Selected':Null?>>No</option>
                                                                    </select>
                                                                    <label id="CUR_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">CRE GL ACCT Buckets</label>
                                                                   <select class="form-select" name="item_status">
                                                                       <option value="Y" <?=$fYearList->FY_CRE_GL_ACCT_BUCKETS=='Y'?'Selected':Null?>>Yes</option>
                                                                        <option value="N" <?=$fYearList->FY_CRE_GL_ACCT_BUCKETS=='N'?'Selected':Null?>>No</option>
                                                                    </select>
                                                                    <label id="CUR_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY APM</label>
                                                                   <select class="form-select" name="item_status">
                                                                       <option value="Y" <?=$fYearList->FY_EOY_APM=='Y'?'Selected':Null?>>Yes</option>
                                                                        <option value="N" <?=$fYearList->FY_EOY_APM=='N'?'Selected':Null?>>No</option>
                                                                    </select>
                                                                    <label id="CUR_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY ARM</label>
                                                                   <select class="form-select" name="item_status">
                                                                       <option value="Y" <?=$fYearList->FY_EOY_ARM=='Y'?'Selected':Null?>>Yes</option>
                                                                       <option value="N" <?=$fYearList->FY_EOY_ARM=='N'?'Selected':Null?>>No</option>
                                                                    </select>
                                                                    <label id="CUR_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY GLM</label>
                                                                   <select class="form-select" name="item_status">
                                                                        <option value="Y" <?=$fYearList->FY_EOY_GLM=='Y'?'Selected':Null?>>Yes</option>
                                                                        <option value="N" <?=$fYearList->FY_EOY_GLM=='N'?'Selected':Null?>>No</option>
                                                                    </select>
                                                                    <label id="CUR_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY ICM</label>
                                                                   <select class="form-select" name="item_status">
                                                                        <option value="Y" <?=$fYearList->FY_EOY_ICM=='Y'?'Selected':Null?>>Yes</option>
                                                                        <option value="N" <?=$fYearList->FY_EOY_ICM=='N'?'Selected':Null?>>No</option>
                                                                    </select>
                                                                    <label id="CUR_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY POM</label>
                                                                   <select class="form-select" name="item_status">
                                                                        <option value="Y" <?=$fYearList->FY_EOY_POM=='Y'?'Selected':Null?>>Yes</option>
                                                                        <option value="N" <?=$fYearList->FY_EOY_POM=='N'?'Selected':Null?>>No</option>
                                                                    </select>
                                                                    <label id="CUR_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY SFM</label>
                                                                   <select class="form-select" name="item_status">
                                                                        <option value="Y" <?=$fYearList->FY_EOY_SFM=='Y'?'Selected':Null?>>Yes</option>
                                                                        <option value="N" <?=$fYearList->FY_EOY_SFM=='N'?'Selected':Null?>>No</option>
                                                                    </select>
                                                                    <label id="CUR_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">EOY SOM</label>
                                                                   <select class="form-select" name="item_status">
                                                                        <option value="Y" <?=$fYearList->FY_EOY_SOM=='Y'?'Selected':Null?>>Yes</option>
                                                                        <option value="N" <?=$fYearList->FY_EOY_SOM=='N'?'Selected':Null?>>No</option>
                                                                    </select>
                                                                    <label id="CUR_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Notes</label>
                                                               <input type="text" class="form-control" name="FY_NOTES" placeholder="Enter Notes">
                                                                <label id="FY_NOTES-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>
                                                    <button data-control="master/currency-add" data-form="formdata" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add currency</button>
                                                </div>
                                                <span id="outmsg"></span>
                                            
                                        </div>
                                        </form>
                                    </div> -->
                                    <!-- end card -->

                                   <!-- Update Form end -->


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
                                                        <th>Business Unit</th>
                                                        <th>Year</th>
                                                        <th>Pseudo&nbsp;Year&nbsp;End</th>
                                                        <th>CRE GL ACCT Buckets</th>
                                                        <th>EOY APM</th>
                                                        <th>EOY ARM</th>
                                                        <th>EOY GLM</th>
                                                        <th>EOY ICM</th>
                                                        <th>EOY POM</th>
                                                        <th>EOY SFM</th>
                                                        <th>EOY SOM</th>
                                                        <th>Notes</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>

                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Business Unit</th>
                                                        <th>Year</th>
                                                        <th>Pseudo&nbsp;Year&nbsp;End</th>
                                                        <th>CRE GL ACCT Buckets</th>
                                                        <th>EOY APM</th>
                                                        <th>EOY ARM</th>
                                                        <th>EOY GLM</th>
                                                        <th>EOY ICM</th>
                                                        <th>EOY POM</th>
                                                        <th>EOY SFM</th>
                                                        <th>EOY SOM</th>
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

            "ajax": { "url": "<?=base_url('master/fiscal-year-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        