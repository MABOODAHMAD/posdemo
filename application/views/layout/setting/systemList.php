
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
                                    <h4 class="mb-sm-0 font-size-18">System Setting</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">System Setting list</h5>
                                               
                                            <div class="flex-shrink-0">
                                                <a href="<?=base_Url('systemSetting')?>" class="btn btn-primary" >Add System Setting</a>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                            
                                            </div>
                                        </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Bussiness Code</th>
                                                        <th>Bussiness Name</th>
                                                        <th>Bussiness Name (AR)</th>
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
                                                        <th>Federal Id</th>
                                                        <th>No of Periods</th>
                                                        <!-- <th>Notes</th> -->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Bussiness Code</th>
                                                        <th>Bussiness Name</th>
                                                        <th>Bussiness Name (AR)</th>
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
                                                        <th>Federal Id</th>
                                                        <th>No of Periods</th>
                                                        <!-- <th>Notes</th> -->
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

            "ajax": { "url": "<?=base_url('master/system-setting-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        