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
                                    <h4 class="mb-sm-0 font-size-18">Role group List</h4>
                                    
                                    <div class="flex-shrink-0">
                                        <a href="<?=base_Url('createGrpMod')?>" class="btn btn-primary" >Add New role group</a>
                                        <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
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
                                                        <h5 class="mb-0 card-title flex-grow-1">Role group Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Role Batch Code</th>
                                                        <th>Role User Detail</th>
                                                        <th>Role Assign detail</th>
                                                        <th>Status</th>
                                                        <th>Create By</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Role Batch Code</th>
                                                        <th>Role User Detail</th>
                                                        <th>Role Assign detail</th>
                                                        <th>Status</th>
                                                        <th>Create By</th>
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
   
   function viewRoleDet(ele) {
        let role_code = $(ele).data('id');

        $('.st-content').css("width","700px");
        $('.st_model_send').addClass('d-none');
        $('.st_model_head').html(`Item Code : `+role_code);
        
        $('.st_model_body').html(`<table Class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th width="10%">MODULE NAME</th>
                                            <th width="80%">SUB MODULE</th>
                                            <th width="10%">FUNCTION</th>
                                        </tr>
                                    </thead>
                                    <tbody id="unit-tr">
                        
                                    </tbody>
                                </table>`)
        $.ajax({
                    type: "POST",
                    url: "<?=base_url('Common/getModuleDetByRolegrpName')?>",
                    data: {role_code,user_role:'Y'},
                    dataType: "Json",
                    success: function(resultData){
       
                    if (resultData.length>0) {

                        resultData.forEach(element => {
                            if(element.MAF_TYPE == 'MODULE'){
                                $('#unit-tr').append(`<tr>
                                                        <td id="module${element.MAF_NAME}">${element.MAF_NAME}</td>
                                                        <td id="sub-module${element.MAF_NAME}"></td>
                                                        <td id="function${element.MAF_NAME}"></td>
                                                    </tr>`);
                            }
                        });

                        resultData.forEach(element => {
                            if(element.MAF_TYPE == 'SUB_MODULE'){
                                let ty = element.MAF_NAME.split("_");
                                $('#sub-module'+ty[0]).append(`<tr><td>${element.MAF_NAME}<td></tr>`);
                            }
                        });

                        resultData.forEach(element => {
                            if(element.MAF_TYPE == 'FUNCTION'){
                                let ty = element.MAF_NAME.split("_");
                                $('#function'+ty[0]).append(`<tr><td>${element.MAF_NAME}<td></tr>`);
                            }
                        });
                        // resultData.forEach(element => {
                        //     console.log(element.MAF_NAME,element.MAF_TYPE);
                        //     if(element.MAF_TYPE == 'MODULE'){
                        //         $('#module').append(`<p>${element.MAF_NAME}</p>`);
                        //     }else if(element.MAF_TYPE == 'SUB_MODULE'){
                        //         $('#sub-module').append(`<p>${element.MAF_NAME}</p>`);
                        //     }else{
                        //         $('#function').append(`<p>${element.MAF_NAME}</p>`);
                        //     }
                        // });
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

            "ajax": { "url": "<?=base_url('role/user-assign-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        