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
                                    <h4 class="mb-sm-0 font-size-18">Sales Man  List</h4>
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
                                                        <h5 class="mb-0 card-title flex-grow-1">Sales Man Lists</h5>
                                                        <div class="flex-shrink-0">
                                                            <?php if(dashRole(["role_check"=>"USERS_SALESMAN_CREATE"])){?><a href="<?=base_Url()?>SalesManAdd" class="btn btn-primary" >Add New Sales Man</a><?php } ?>
                                                            <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body border-bottom">
                                                    <div class="row g-3">
                                                        
                                                        <div class="col-xxl-3 col-lg-6">
                                                            <select multiple class="form-control select2 whse-id-in">
                                                                <option value='' Selected disabled>Select Wharehouse</option>
                                                                <?php foreach ($whareDets as $whareDets):
                                                                    ?>
                                                                                <option value="<?=$whareDets->WHSE_CODE?>" orderCount="<?=$whareDets->WHSE_ORDER_COUNT?>"><?=$whareDets->WHSE_CODE . '-' . $whareDets->WHSE_DESC?></option>
                                                                    <?php endforeach; ?>
                                                            </select>
                                                            <label id="whse-id-in-error" class="error"></label>
                                                        </div>
                                                    
                                                        <div class="col-xxl-2 col-lg-4">
                                                            <button type="button" class="btn btn-soft-secondary w-100" onclick="searchVal()"><i class="mdi mdi-filter-outline align-middle"></i> Filter</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Code</th>
                                                        <th>Emp Code</th>
                                                        <th>Name</th>
                                                        <th>Sale Area</th>
                                                        <th>Wharehouse Assign</th>
                                                        <th>Employee type</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                    <th>Sn.</th>
                                                        <th>Code</th>
                                                        <th>Emp Code</th>
                                                        <th>Name</th>
                                                        <th>Sale Area</th>
                                                        <th>Wharehouse Assign</th>
                                                        <th>Employee type</th>
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
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>

function viewUnitDet(ele) {
        let salesman_code = $(ele).data('salecode');
        $('.st_model_send').addClass('d-none');
        $('.st_model_head').html(`Salesman Code : `+salesman_code);
        
        $('.st_model_body').html(`<table Class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Wharehouse Code</th>
                                            <th>Wharehouse Desc</th>
                                            <th>Assign DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody id="unit-tr">
                                    </tbody>
                                </table>`)
        $.ajax({
                    type: "POST",
                    url: "<?=base_url('Common/getSalesmanWhseDet')?>",
                    data: {salesman_code},
                    dataType: "Json",
                    success: function(resultData){

                    if (resultData.length>0) {
                        resultData.forEach(element => {
                            let dataFet = dateFormat1(element.SMSW_CRE_DATE);
                            $('#unit-tr').append(`<tr>
                                                <td>${element.WHSE_CODE}</td>
                                                <td>${element.WHSE_DESC}</td>
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
   
    $(document).ready(function() {
        $('#datatable').DataTable({

            "processing": true,

            "serverSide": true,

            "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],

            "dom" : 'lBfrtip',

            "buttons" : ['copy', 'csv', 'excel', 'print'],

            "order": [],

            "scrollX": true,

            "ajax": { "url": "<?=base_url('master/salesman-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });

    function searchVal() {
        let whse_code = $('.whse-id-in').val();
        if (whse_code) {
            $('#whse-id-in-error').html('');
        }else{
            $('#whse-id-in-error').html('Select Wharehouse');
        }
        if(whse_code){
            $('#datatable').DataTable().clear().destroy();
            $('#datatable').DataTable({

                "processing": true,

                "serverSide": true,

                "lengthMenu": [[-1,10, 25, 50,100], ["All",10, 25, 50,100]],

                "dom" : 'lBfrtip',

                "buttons" : ['copy', 'csv', 'excel', 'print'],

                "order": [],

                "scrollX": true,

                "ajax": { "url": "<?=base_url('master/salesman-table-list'); ?>", "type": "POST","data":{device:"web",whse_code} }

            });
        }
    }
</script>
        