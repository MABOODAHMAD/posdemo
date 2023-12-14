
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
                                    <h4 class="mb-sm-0 font-size-18">Warehouse</h4>
                                    <div class="page-title-right">
                                        
                                    </div>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Warehouse list</h5>
                                               
                                            <div class="flex-shrink-0">
                                                <a href="<?=base_Url()?>WarehouseAdd" class="btn btn-primary" >Add Warehouse Unit</a>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                            
                                            </div>
                                        </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Bussiness Unit</th>
                                                        <th>Warehouse Code</th>
                                                        <th>Warehouse Description</th>
                                                        <th>Address line 1</th>
                                                        <th>Address line 2</th>
                                                        <th>Address line 3</th>
                                                        <th>Country</th>
                                                        <th>State</th>
                                                        <th>City</th>
                                                        <th>Postal Code</th>
                                                        <th>Phone No 1.</th>
                                                        <th>Phone No 2.</th>
                                                        <th>Fax no 1.</th>
                                                        <th>Fax no 2.</th>
                                                        <th>Email 1</th>
                                                        <th>Email 2</th>
                                                        <th>EDI 1</th>
                                                        <th>EDI 2</th>
                                                        <th>ERP Planing</th>
                                                        <th>MRP Regen</th>
                                                        <th>Distribution</th>
                                                        <th>Time Attend</th>
                                                        <th>Sale Order Count</th>
                                                        <th>Sale Invoice Count</th>
                                                        <th>Sale Return Order Count</th>
                                                        <th>Sale Return Invoice Count</th>
                                                        <th>Credit Memo Count</th>
                                                        <th>Debit Memo Count</th>
                                                        <th>Payment Count</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Bussiness Unit</th>
                                                        <th>Warehouse Code</th>
                                                        <th>Warehouse Description</th>
                                                        <th>Address line 1</th>
                                                        <th>Address line 2</th>
                                                        <th>Address line 3</th>
                                                        <th>Country</th>
                                                        <th>State</th>
                                                        <th>City</th>
                                                        <th>Postal Code</th>
                                                        <th>Phone No 1.</th>
                                                        <th>Phone No 2.</th>
                                                        <th>Fax no 1.</th>
                                                        <th>Fax no 2.</th>
                                                        <th>Email 1</th>
                                                        <th>Email 2</th>
                                                        <th>EDI 1</th>
                                                        <th>EDI 2</th>
                                                        <th>ERP Planing</th>
                                                        <th>MRP Regen</th>
                                                        <th>Distribution</th>
                                                        <th>Time Attend</th>
                                                        <th>Sale Order Count</th>
                                                        <th>Sale Invoice Count</th>
                                                        <th>Sale Return Order Count</th>
                                                        <th>Sale Return Invoice Count</th>
                                                        <th>Credit Memo Count</th>
                                                        <th>Debit Memo Count</th>
                                                        <th>Payment Count</th>
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

            "ajax": { "url": "<?=base_url('master/wharehouse-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>