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
                                    <h4 class="mb-sm-0 font-size-18">Price Changer List</h4>
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
                                                        <h5 class="mb-0 card-title flex-grow-1">Price Changer Lists</h5>
                                                        <div class="flex-shrink-0">
                                                            <?php if(dashRole(["role_check"=>"INVENTORY_PHYSICAL_INVENTROY_COUNT_CREATE"])){?><a href="<?=base_Url("PhysicalInventory")?>" class="btn btn-primary" >Add New Price Changer </a><?php } ?>
                                                            <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                                        </div>
                                                    </div>
                                                    <p><?=$this->session->flashdata('FLASH_ALERT')?></p>
                                                </div>

                                                <div class="table-responsive">
                                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Sn.</th>
                                                                <th>Count Number</th>
                                                                <th>Whse</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Posted</th>
                                                                <th>Stock Freeze</th>
                                                                <th>Generate Report</th>
                                                                <th>View Details</th>
                                                                <th>Report</th>
                                                            </tr>
                                                        </thead> 
                                                        <tfoot>
                                                            <tr>
                                                                
                                                             <th>Sn.</th>
                                                                <th>Count Number</th>
                                                                <th>Whse</th>
                                                                <th>Start Date</th>
                                                                <th>End Date</th>
                                                                <th>Posted</th>
                                                                <th>Stock Freeze</th>
                                                                <th>Generate Report</th>
                                                                <th>View Details</th>
                                                                <th>Report</th>
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
            
            
             <!-- Modal -->
                <div class="modal fade orderdetailsModal" tabindex="-1" role="dialog" aria-labelledby=orderdetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id=orderdetailsModalLabel">Order Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-2">Documnet No: <span class="text-primary doc-no"></span></p>
                                <p class="mb-4">Document date: <span class="text-primary doc-date"></span></p>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap">
                                        <thead>
                                            <tr>
                                            <th scope="col">Sn</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Product Desc</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody-detail">
                                            <!-- <tr>
                                                <th scope="row">
                                                    <div>
                                                        <img src="assets/images/product/img-7.png" alt="" class="avatar-sm">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                                        <p class="text-muted mb-0">$ 225 x 1</p>
                                                    </div>
                                                </td>
                                                <td>$ 255</td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal -->
                
                
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script src="<?=base_url()?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
            <script>

                function priceChnagerdetIn(ele) {
                    let doc_no = $(ele).data('docno');
                    let doc_date = $(ele).data('docdate');
                   
                    $('.doc-no').html(doc_no);
                    $('.doc-date').html(doc_date);
                    $('#tbody-detail').empty();
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('Common/getPhysicalInvCountByCountNumber')?>",
                        data: {doc_no},
                        dataType: "Json",
                        success: function(resultData){
                            
                            let detail = resultData.detail;
                            detail.forEach(element => {
                            let imageUrl = element.I_IMAGE_FILENAME?element.I_IMAGE_FILENAME:'no_image.png';
                            $('#tbody-detail').append(`<tr>
                                                            <td>${element.PICD_ORDER_LN}</td>
                                                            <th scope="row">
                                                                <div>
                                                                    <img src="<?=base_url('uploads/images/item/')?>${imageUrl}" alt="" class="avatar-sm">
                                                                    <p class="text-muted mb-0">${element.PICD_ITEM}</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div>
                                                                    <h5 class="text-truncate font-size-14">${element.PICD_ITEM_DESC1}</h5>
                                                                </div>
                                                            </td>
                                                            <td>${element.PICD_COUNT_QTY}</td>
                                                            <td>SAR ${element.PICD_ITEM_PRICE}</td>
                                                        </tr>`);
                            });
                        }
                    });
                }

                function orderStkFreeze(ele) {
                        let doc_no = $(ele).data('docno');
                        let doc_bus = $(ele).data('busunit');
                        
                        Swal.fire({
                        title: 'Are you sure?',
                        text: "Need to Freeze this Stock for Physical Inventory Check",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Stock Freeze'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "<?=base_url('Common/stkFreezeProcedure')?>",
                                data: {doc_no,doc_bus},
                                dataType: "Json",
                                beforeSend: function () {
                                    $("#status").fadeIn();
                                    $("#preloader").fadeIn();
                                },
                                success: function(resultData){
                                    $("#status").fadeOut();
                                    $("#preloader").fadeOut();
                                    Swal.fire(
                                            'Updated!',
                                            'You Physical Inventory Stock Freeze Successfully',
                                            'success'
                                            )
                                }
                            })
                        }
                    }) 
                }


                function orderGenRep(ele) {
                        let doc_no = $(ele).data('docno');
                        let doc_bus = $(ele).data('busunit');
                        
                        Swal.fire({
                        title: 'Are you sure?',
                        text: "Need to Generate Report for Physical Inventory",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Generate Report'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "<?=base_url('Common/genReportProcedure')?>",
                                data: {doc_no,doc_bus},
                                dataType: "Json",
                                beforeSend: function () {
                                    $("#status").fadeIn();
                                    $("#preloader").fadeIn();
                                },
                                success: function(resultData){
                                    $("#status").fadeOut();
                                    $("#preloader").fadeOut();
                                    Swal.fire(
                                            'Updated!',
                                            'You Physical Inventory Stock Freeze Successfully',
                                            'success'
                                            )
                                }
                            })
                        }
                    }) 
                }

                $(document).ready(function() {
                    $('#datatable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
                        "dom" : 'lBfrtip',
                        "buttons" : ['copy', 'csv', 'excel', 'print'],
                        "order": [],
                        "scrollX": true,
                        "ajax": { "url": "<?=base_url('inventory/physical-inventory-count-table-list'); ?>", "type": "POST","data":{device:"web"} }
                    });
                });
</script>
        