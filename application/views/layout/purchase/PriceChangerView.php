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
                                                            <?php if(dashRole(["role_check"=>"PURCHASE_PRICE_CHANGE_ORDER_UPDATE"])){?><a href="<?=base_Url("PriceChangerAdd")?>" class="btn btn-primary" >Add New Price Changer </a><?php } ?>
                                                            <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Sn.</th>
                                                                <th>Document Number</th>
                                                                <th>Document Date</th>
                                                                <th>Refrence</th>
                                                                <!-- <th>Qty</th> -->
                                                                <th>Posted</th>
                                                                <!-- <th>Made By</th> -->
                                                                <th>View Details</th>
                                                                <!-- <th>Action</th> -->
                                                            </tr>
                                                        </thead> 
                                                        <tfoot>
                                                            <tr>
                                                                
                                                             <th>Sn.</th>
                                                                <th>Document Number</th>
                                                                <th>Document Date</th>
                                                                <th>Refrence</th>
                                                                <!-- <th>Qty</th> -->
                                                                <th>Posted</th>
                                                                <!-- <th>Made By</th> -->
                                                                <th>View Details</th>
                                                                <!-- <th>Action</th> -->
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
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                                            <th scope="col">Product</th>
                                            <th scope="col">Product Name</th>
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
            <script>

                function priceChnagerdetIn(ele) {
                    let doc_no = $(ele).data('docno');
                    let doc_date = $(ele).data('docdate');
                    console.log(doc_date);
                    $('.doc-no').html(doc_no);
                    $('.doc-date').html(doc_date);
                    $('#tbody-detail').empty();
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('Common/getPriceChangerDetail')?>",
                        data: {doc_no},
                        dataType: "Json",
                        success: function(resultData){
                            
                            let price_changer_del = resultData.price_changer_del;
                            price_changer_del.forEach(element => {
                                console.log(element.PCD_UNIT_PRICE)
                            $('#tbody-detail').append(`<tr>
                                                            <th scope="row">
                                                                <div>
                                                                    <img src="<?=base_url('uploads/images/item/')?>${element.I_IMAGE_FILENAME}" alt="" class="avatar-sm">
                                                                    <p class="text-muted mb-0">${element.I_CODE}</p>
                                                                </div>
                                                            </th>
                                                            <td>
                                                                <div>
                                                                    <h5 class="text-truncate font-size-14">${element.I_DESC}</h5>
                                                                    <p class="text-muted mb-0">${element.I_EXTEND_DESC}</p>
                                                                </div>
                                                            </td>
                                                            <td>SAR ${element.PCD_UNIT_PRICE}</td>
                                                        </tr>`);
                            });
                        }
                    });
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
                        "ajax": { "url": "<?=base_url('purchase/price-changer-table-list'); ?>", "type": "POST","data":{device:"web"} }
                    });
                });
</script>
        