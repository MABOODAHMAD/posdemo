
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
                                    <h4 class="mb-sm-0 font-size-18">Password List</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Password</h5>
                                               
                                            </div>
                                    </div>
                                    
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="form-label">Bussiness Unit</label>
                                                                <div class="mb-3">
                                                                    <select class="form-control select2" name="MDP_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?=defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label id="MDP_BUS_UNIT-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                        <label class="form-label">Password Type</label>
                                                        <select class="form-control select2" name="type">
                                                            <option value='' Selected disabled>Select</option>
                                                                        <optgroup label="Credit">
                                                                            <option value="SYSTEM2-CREDIT">SYSTEM2</option>
                                                                            <option value="MARWAN2-CREDIT">MARWAN2</option>
                                                                        </optgroup>
                                                                        <optgroup label="Discount">
                                                                            <option value="SYSTEM-DISCOUNT">SYSTEM</option>
                                                                            <option value="ABDU-DISCOUNT">ABDU</option>
                                                                            <option value="MARWAN-DISCOUNT">MARWAN</option>
                                                                        </optgroup>
                                                                        <optgroup label="Sale Return">
                                                                            <option value="SYSTEM-SALE_RETURN">SYSTEM</option>
                                                                            <option value="ABDU-SALE_RETURN">ABDU</option>
                                                                            <option value="MARWAN-SALE_RETURN">MARWAN</option>
                                                                        </optgroup>
                                                        </select>
                                                        <label id="type-error" class="error"></label>
                                                    </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Generate Password Qty</label>
                                                                    <input type="number" class="form-control" name="qty" placeholder="Enter no Of qty">
                                                                    <label id="qty-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Discount(%)</label>
                                                                    <input type="text" class="form-control" name="MDP_GEN_DISC" placeholder="Enter % of Discount">
                                                                    <label id="MDP_GEN_DISC-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Password Desc</label>
                                                                    <input type="text" class="form-control" name="Pass_DESC" placeholder="Enter Desc">
                                                                    <label id="Pass_DESC-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                <div>
                                                    <button data-control="master/Pass-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->pssGex->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->pssGex->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Generate  Pass</button>
                                                </div>
                                                <span id="outmsg"></span>
                                            
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
                                                        <h5 class="mb-0 card-title flex-grow-1">Password Lists</h5>
                                                        
                                                        <div class="flex-shrink-0">
                                                <a href="<?=base_url('PasswordUsedList')?>" class="btn btn-primary">View Used Password List</a>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>SEQ</th>
                                                        <th>Username</th>
                                                        <th>Password</th>
                                                        <th>Type</th>
                                                        <th>Pass Desc</th>
                                                        <th>Max Discount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>SEQ</th>
                                                        <th>Username</th>
                                                        <th>Password</th>
                                                        <th>Type</th>
                                                        <th>Pass Desc</th>
                                                        <th>Max Discount</th>
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
                                    <div class="avatar-title bg-primary text-primary bg-opaPass-10 font-size-20 rounded-3">
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

            "ajax": { "url": "<?=base_url('master/Pass-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        