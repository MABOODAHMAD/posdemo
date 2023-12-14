
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
                                    <h4 class="mb-sm-0 font-size-18">ITEMS INFO</h4>
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
                                                        <h5 class="mb-0 card-title flex-grow-1">Item Lists</h5>
                                                        <div class="flex-shrink-0">
                                                            <?php if(dashRole(["role_check"=>"PRODUCT_BULK_ITEM_UPLOAD"])){?><a href="<?=base_Url('bulkItemUpload')?>" class="btn btn-primary" >Bulk Item Upload</a><?php } ?>
                                                            <?php if(dashRole(["role_check"=>"PRODUCT_BULK_ITEM_TRAIT_UPLOAD"])){?><a href="<?=base_Url('bulkItemTraitUpload')?>" class="btn btn-primary" >Bulk Item Trait Upload</a><?php } ?>
                                                            <?php if(dashRole(["role_check"=>"PRODUCT_PRODUCT_CREATE"])){?><a href="<?=base_Url('ProductAdd')?>" class="btn btn-primary" >Add New Item</a><?php } ?>
                                                            <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>item Code</th>
                                                        <th>Item Name</th>
                                                        <?php if(dashRole(["role_check"=>"PRODUCT_PRODUCT_VIEW_VENDOR_CODE_AND_DESC"])){ ?>
                                                        <th>Vendor Code/Name</th>
                                                        <?php } ?>
                                                        <th>Item Secondary desc</th>
                                                        <th>item Category</br>Class</br>UOM</th>
                                                        <?php if(dashRole(["role_check"=>"PRODUCT_TRAIT_VIEW_AND_UPDATE"])){ ?>
                                                        <th>View Trait</th>
                                                        <?php } if(dashRole(["role_check"=>"PRODUCT_VIEW_UNIT_COST"])){ ?>
                                                        <th>Unit Cost</th>
                                                        <?php 
                                                            }if(dashRole(["role_check"=>"PRODUCT_VIEW_VENDOR_COST"])){ ?>
                                                        <th>Vendor Cost</th>
                                                        <?php
                                                            }if(dashRole(["role_check"=>"PRODUCT_PRODUCT_EDIT"])){
                                                        ?>
                                                        <th>Action</th>
                                                        <?php } ?><
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>item Code</th>
                                                        <th>Item Name</th>
                                                        <?php if(dashRole(["role_check"=>"PRODUCT_PRODUCT_VIEW_VENDOR_CODE_AND_DESC"])){ ?>
                                                        <th>Vendor Code/Name</th>
                                                        <?php } ?>
                                                        <th>Item Secondary desc</th>
                                                        <th>item Category</br>Class</br>UOM</th>
                                                        <?php if(dashRole(["role_check"=>"PRODUCT_TRAIT_VIEW_AND_UPDATE"])){ ?>
                                                        <th>View Trait</th>
                                                        <?php } if(dashRole(["role_check"=>"PRODUCT_VIEW_UNIT_COST"])){ ?>
                                                        <th>Unit Cost</th>
                                                        <?php 
                                                            }if(dashRole(["role_check"=>"PRODUCT_VIEW_VENDOR_COST"])){ ?>
                                                        <th>Vendor Cost</th>
                                                        <?php
                                                            }if(dashRole(["role_check"=>"PRODUCT_PRODUCT_EDIT"])){
                                                        ?>
                                                        <th>Action</th>
                                                        <?php } ?><
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            </div>
                                            
                                            <!-- <div class="table-responsive">
                                            <table class="table align-middle table-nowrap table-check">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 20px;" class="align-middle">
                                                            <div class="form-check font-size-16">
                                                                <input class="form-check-input" type="checkbox" id="checkAll">
                                                                <label class="form-check-label" for="checkAll"></label>
                                                            </div>
                                                        </th>
                                                        <th class="align-middle">Order ID</th>
                                                        <th class="align-middle">Billing Name</th>
                                                        <th class="align-middle">Date</th>
                                                        <th class="align-middle">Total</th>
                                                        <th class="align-middle">Payment Status</th>
                                                        <th class="align-middle">Payment Method</th>
                                                        <th class="align-middle">View Details</th>
                                                        <th class="align-middle">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input class="form-check-input" type="checkbox" id="orderidcheck01">
                                                                <label class="form-check-label" for="orderidcheck01"></label>
                                                            </div>
                                                        </td>
                                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2540</a> </td>
                                                        <td>Neal Matthews</td>
                                                        <td>
                                                            07 Oct, 2019
                                                        </td>
                                                        <td>
                                                            $400
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                                        </td>
                                                        <td>
                                                            <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                                        </td>
                                                        <td>
                                                    Button trigger modal
                                                           <a href="<?=base_url('ProductDetail')?>"> <button type="button" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" href="ProductDetail.php">
                                                                View Details
                                                            </button></a>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-3">
                                                                <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                                <a href="javascript:void(0);" class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div> -->
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

function viewUnitDet(ele) {
        let item_code = $(ele).data('itemcode');
        $('.st_model_send').addClass('d-none');
        $('.st_model_head').html(`Item Code : `+item_code);
        
        $('.st_model_body').html(`<table Class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>STANDARD COST</th>
                                            <th>ACTUAL COST</th>
                                            <th>AVERAGE COST</th>
                                            <th>USER DEFINE</th>
                                            <th>Update Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="unit-tr">
                                    </tbody>
                                </table>`)
        $.ajax({
                    type: "POST",
                    url: "<?=base_url('Common/getItemUntCost')?>",
                    data: {item_code},
                    dataType: "Json",
                    success: function(resultData){
                   
                    let item_cost_det = resultData.item_cost_det;
                    if (item_cost_det.length>0) {
                        item_cost_det.forEach(element => {
                            let dataFet = dateFormat1(element.INVCOST_CRE_DATE);
                            $('#unit-tr').append(`<tr>
                                                <td>${element.INVCOST_STD_COST}</td>
                                                <td>${element.INVCOST_ACT_COST}</td>
                                                <td>${element.INVCOST_AVG_COST}</td>
                                                <td>${element.INVCOST_UD_COST}</td>
                                                <td>${dataFet}</td>
                                            </tr>`)
                        });
                    }else{
                        $('#unit-tr').append(`<tr>
                                                <td colspan='5'><p class="text-center">No data Found</p></td>
                                            </tr>`)
                    }
                }
        });

                               
   }

   function viewVendorDet(ele) {
        let item_code = $(ele).data('itemcode');
        $('.modal-layout-control').addClass('modal-lg');
        $('.st_model_send').addClass('d-none');
        $('.st_model_head').html(`Item Code : `+item_code);
        
        $('.st_model_body').html(`<table Class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>CURRENCY NAME AND CURRENT RATE</th>
                                            <th>CURRENT VENDOR COST AND DATE</th>
                                            <th>LAST VENDOR COST AND DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody id="unit-tr">
                                    </tbody>
                                </table>`)
        $.ajax({
                    type: "POST",
                    url: "<?=base_url('Common/getItemVendorCost')?>",
                    data: {item_code},
                    dataType: "Json",
                    success: function(resultData){
                   
                    let item_cost_det = resultData.item_cost_det;
                    if (item_cost_det.length>0) {
                        item_cost_det.forEach(element => {
                            let dataFet = dateFormat1(element.VC_CRE_DATE);
                            let dataFetLast = dateFormat1(element.VC_LAST_ACT_DATE);
                            $('#unit-tr').append(`<tr>
                                                    <td>ONE ${element.CUR_NAME} = SAR ${element.EXCHR_BUY_RATE}</td>
                                                    <td>${element.VC_VEND_NON_CON_PRICE} : ${dataFet}</td>
                                                    <td>${element.VC_LAST_ACT_PRICE} : ${dataFetLast}</td>
                                                </tr>`)
                        });
                    }else{
                        $('#unit-tr').append(`<tr>
                                                <td colspan='5'><p class="text-center">No data Found</p></td>
                                            </tr>`)
                    }
                }
        });

                               
   }
   
    $(document).ready(function() {
        $('#datatable').DataTable({

            "processing": true,

            "serverSide": true,

            "lengthMenu": [[10, 25, 50,100,1000, -1], [10, 25, 50,100,1000, "All"]],

            "dom" : 'lBfrtip',

            "buttons" : ['copy', 'csv', 'excel', 'print'],

            "order": [],

            "scrollX": true,

            "ajax": { "url": "<?=base_url('item/item-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        