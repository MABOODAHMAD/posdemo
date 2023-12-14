
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
                                    <h4 class="mb-sm-0 font-size-18">Fiscal Periods</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Fiscal Periods</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                                    <select class="form-control select2" name="FP_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                            <option value="<?=$busUnit['BU_CODE']?>" <?php if($fiscalPeriodList){ echo $fiscalPeriodListDet->FP_BUS_UNIT == $busUnit['BU_CODE']?'selected':null; }else{ echo defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null;}?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="FP_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Year</label>
                                                                    <input type="number"  class="form-control" name="FP_YEAR" value="<?=$fiscalPeriodList?$fiscalPeriodListDet->FP_YEAR:null?>">
                                                                    <label id="FP_YEAR-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Period</label>
                                                                <input type="number" class="form-control" name="FP_PERIOD" value="<?=$fiscalPeriodList?$fiscalPeriodListDet->FP_PERIOD:null?>">
                                                                <label id="FP_PERIOD-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Start Date</label>
                                                                <input type="date" class="form-control" name="FP_START_DATE" value="<?=$fiscalPeriodList?$fiscalPeriodListDet->FP_START_DATE:null?>">
                                                                <label id="FP_START_DATE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">End Date</label>
                                                                <input type="date" class="form-control" name="FP_END_DATE" value="<?=$fiscalPeriodList?$fiscalPeriodListDet->FP_END_DATE:null?>">
                                                                <label id="FP_END_DATE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Notes</label>
                                                               <input type="text" class="form-control" name="FP_NOTES" placeholder="Enter Notes" value="<?=$fiscalPeriodList?$fiscalPeriodListDet->FP_NOTES:null?>">
                                                                <label id="FP_NOTES-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>

                                                    <button data-control="master/fiscal-year-period-add" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$fiscalPeriodList?$sweetAlertMsg->finacPeriUpdate->msg:$sweetAlertMsg->finacPeriAdd->msg?>" data-sweetalertcontrol="<?=$fiscalPeriodList?$sweetAlertMsg->finacPeriUpdate->cont:$sweetAlertMsg->finacPeriAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$fiscalPeriodList?'Update financial Periods':'Add financial Periods'?></button>

                                                    <!-- <button data-control="master/fiscal-year-period-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->finacPeriAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->finacPeriAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add financial Periods</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" value="<?=$fiscalPeriodList?>" name="fiscal_period_db">
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
                                                        <th>Business unit</th>
                                                        <th>financial year</th>
                                                        <th>financial Oeriods</th>
                                                        <th>Start date</th>
                                                        <th>End date</th>
                                                        <th>Notes</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Business unit</th>
                                                        <th>financial year</th>
                                                        <th>financial Oeriods</th>
                                                        <th>Start date</th>
                                                        <th>End date</th>
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

            "ajax": { "url": "<?=base_url('master/fiscal-year-period-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        