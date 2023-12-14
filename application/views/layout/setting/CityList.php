
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
                                    <h4 class="mb-sm-0 font-size-18">City List</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New City</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">City Code</label>
                                                                    <input type="text" class="form-control" name="CITY_CODE" value="<?=$CityCode?$CityDet->CTY_CODE:null?>" placeholder="Enter Country Name " <?=$CityCode?'disabled':null?>>
                                                                    <label id="CITY_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">City Name</label>
                                                                    <input type="text" class="form-control" name="CTY_NAME" value="<?=$CityCode?$CityDet->CTY_NAME:null?>" placeholder="Enter Country Name ">
                                                                    <label id="CTY_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">City Name Arabic</label>
                                                                    <input type="text" class="form-control" name="CITY_NAME_AR"  value="<?=$CityCode?$CityDet->CTY_ABBRV:null?>" placeholder="Enter Country Name ">
                                                                    <label id="CITY_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Abbreviation</label>
                                                                <input type="email" class="form-control" name="CTY_ABBRV" value="<?=$CityCode?$CityDet->CTY_ABBRV:null?>" placeholder="Enter short name">
                                                                <label id="CTY_ABBRV-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose State</label>
                                                                    <select class="form-control select2" name="ST_CODE">
                                                                        <option value='' Selected disabled>Select state</option>
                                                                        <?php foreach ($stateLists as $stateList):?>
                                                                                <option value="<?=$stateList['ST_CODE']?>" <?php if($CityCode){echo $CityDet->CTY_STATE_CODE == $stateList['ST_CODE']?'selected':'';}else{echo null;}?>><?=$stateList['ST_NAME']?></option>
                                                                                
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="ST_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">City Desc</label>
                                                                    <input type="text" class="form-control" name="CTY_DESC" value="<?=$CityCode?$CityDet->CTY_DESC:null?>" placeholder="Enter Country Name ">
                                                                    <label id="CTY_DESC-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                    </div>
                                                <div>
                                                    
                                                <!-- <button data-control="master/city-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->cityAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->cityAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add City</button> -->
                                                                                            
                                                <button data-control="master/city-add" data-form="formdata" data-sweetalert="<?=$CityCode?$sweetAlertMsg->cityupdate->msg:$sweetAlertMsg->cityAdd->msg?>" data-sweetalertcontrol="<?=$CityCode?$sweetAlertMsg->cityupdate->cont:$sweetAlertMsg->cityAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$CityCode?'Update City':'Add City'?></button>

                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" value="<?=$CityCode?>" name="City_code_db">
                                      
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
                                                        <h5 class="mb-0 card-title flex-grow-1">City Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>City Code</th>
                                                        <th>City Name</th>
                                                        <th>Abbraviation</th>
                                                        <th>State</th>
                                                        <th>City Desc</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>City Code</th>
                                                        <th>City Name</th>
                                                        <th>Abbraviation</th>
                                                        <th>State</th>
                                                        <th>City Desc</th>
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

            "ajax": { "url": "<?=base_url('master/city-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        