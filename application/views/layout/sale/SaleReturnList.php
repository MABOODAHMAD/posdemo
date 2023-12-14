
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
                                    <h4 class="mb-sm-0 font-size-18">Sale Lists</h4>

                                    <div class="page-title-right">
                                       
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body border-bottom">
                                        <div class="d-flex align-items-center">
                                            <h5 class="mb-0 card-title flex-grow-1">Sale Lists</h5>
                                            <div class="flex-shrink-0">
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                        </div>
                                        <p><?=$this->session->flashdata('ret_cre')?></p>
                                    </div>
                                    <div class="card-body">
        
                                        
                                        
                                                                     
                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                            <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Order I'd</th>
                                                        <th scope="col">Customer detail</th>
                                                        <th scope="col">Order Date</th>
                                                        <th scope="col">Total Quantity</th>
                                                        <th scope="col">Total Amount</th>
                                                        <th scope="col">Pay Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  
                                                </tbody>
                                        </table>
                                        
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
        
                       

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

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
                        "ajax": { "url": "<?=base_url('sale/sale-return-table-list'); ?>", "type": "POST","data":{device:"web",sale_type:"1"} }
                    });
                });
            </script>