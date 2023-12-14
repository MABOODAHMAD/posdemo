
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
                                                <?php if($saleType == 'invoice'){ ?>
                                                    <?php if(dashRole(["role_check"=>"SALE_CREATE_INVOICE"])){?><a href="<?=base_Url()?>SaleAdd" class="btn btn-primary" >Add New Sale</a><?php }?>
                                                <?php }else if($saleType == 'order'){?>
                                                    <?php if(dashRole(["role_check"=>"SALE_CREATE_ORDER"])){?><a href="<?=base_Url()?>SaleAdd" class="btn btn-primary" >Add New Sale</a><?php }?>
                                                <?php }?>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                                
                                            </div>
                                        </div>
                                        <p><?=$this->session->flashdata('all_ret')?></p>
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
                                                        <th scope="col">Order Type</th>
                                                        <th scope="col">Return Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- <tr>
                                                        <th scope="row">1</th>
                                                        <td>Magento Developer</td>
                                                        <td>Themesbrand</td>
                                                        <td>California</td>
                                                        <td>0-2 Years</td>
                                                        <td>2</td>
                                                        <td><span class="badge badge-soft-success">Full Time</span></td>
                                                        <td>02 June 2021</td>
                                                        <td>25 June 2021</td>
                                                        <td><span class="badge bg-success">Active</span></td>
                                                        <td>
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                    <a href="job-details.html" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                    <a href="#" class="btn btn-sm btn-soft-info"><i class="mdi mdi-pencil-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                    <a href="#jobDelete" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Product Designer</td>
                                                        <td>Web Technology pvt.ltd</td>
                                                        <td>California</td>
                                                        <td>1-2 Years</td>
                                                        <td>3</td>
                                                        <td><span class="badge badge-soft-danger">Part Time</span></td>
                                                        <td>15 June 2021</td>
                                                        <td>28 June 2021</td>
                                                        <td><span class="badge bg-info">New</span></td>
                                                        <td>
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                    <a href="job-details.html" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                    <a href="#" class="btn btn-sm btn-soft-info"><i class="mdi mdi-pencil-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                    <a href="#jobDelete" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Marketing Director</td>
                                                        <td>Creative Agency</td>
                                                        <td>Phoenix</td>
                                                        <td>-</td>
                                                        <td>5</td>
                                                        <td><span class="badge badge-soft-success">Full Time</span></td>
                                                        <td>02 June 2021</td>
                                                        <td>25 June 2021</td>
                                                        <td><span class="badge bg-danger">Close</span></td>
                                                        <td>
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                                    <a href="job-details.html" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                    <a href="#" class="btn btn-sm btn-soft-info"><i class="mdi mdi-pencil-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                    <a href="#jobDelete" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr> -->
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
                    // $("#preloader").fadeIn("slow");
                   
                    $('#datatable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
                        "dom" : 'lBfrtip',
                        "buttons" : ['copy', 'csv', 'excel', 'print'],
                        "order": [],
                        "scrollX": true,
                        "ajax": { "url": "<?=base_url('sale/sale-order-table-list'); ?>", "type": "POST","data":{device:"web",sale_type:"<?=$saleType?>"} }
                    });
                });
            </script>