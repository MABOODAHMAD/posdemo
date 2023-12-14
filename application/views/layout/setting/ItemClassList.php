
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
                                    <h4 class="mb-sm-0 font-size-18">Item Class</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Item Class</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                                    <select class="form-control select2" name="IC_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?php if($itemClassCode){ echo $itemClassDet->IC_BUS_UNIT == $busUnit['BU_CODE']?'selected':null; }else{ echo defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null;}?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="IC_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Item Class Code</label>
                                                                    <input type="text" class="form-control" name="ITEM_CLASS_CODE" value="<?=$itemClassCode?$itemClassDet->IC_CODE:null?>" placeholder="Auto generate if empty" <?=$itemClassCode?'disabled':null?>>
                                                                    <label id="ITEM_CLASS_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Item Class Name</label>
                                                                    <input type="text" class="form-control" name="ITEM_CLASS_NAME" value="<?=$itemClassCode?$itemClassDet->IC_DESC:null?>" placeholder="Enter Item Class Name ">
                                                                    <label id="ITEM_CLASS_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose class category</label>
                                                                    <select class="form-control select2" name="IC_ITEM_CAT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($categoryLists as $categoryList):?>
                                                                                <option value="<?=$categoryList['ICAT_CODE']?>" <?php if($itemClassCode){ echo $itemClassDet->IC_ITEM_CAT == $categoryList['ICAT_CODE']?'selected':null; }?>><?=$categoryList['ICAT_DESC']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="IC_ITEM_CAT-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose UOM</label>
                                                                    <select class="form-control select2" name="IC_UOM_STOCK">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($uomLists as $uomList):?>
                                                                                <option value="<?=$uomList['UOM_CODE']?>" <?php if($itemClassCode){ echo $itemClassDet->IC_UOM_STOCK == $uomList['UOM_CODE']?'selected':null; }?>><?=$uomList['UOM_DESC']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="IC_UOM_STOCK-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Item Class Arbic Name</label>
                                                                    <input type="text" class="form-control" name="IC_CLASS_NAME_AR" placeholder="Enter Item Class Name ">
                                                                    <label id="IC_CLASS_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>  -->
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Notes</label>
                                                               <input type="text" class="form-control" name="ITEM_CLASS_NOTE" value="<?=$itemClassCode?$itemClassDet->IC_NOTES:null?>" placeholder="Enter Notes">
                                                                <label id="ITEM_CLASS_NOTE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>
                                                    <button data-control="master/item-class-add" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$itemClassCode?$sweetAlertMsg->itemClassUpdate->msg:$sweetAlertMsg->itemClassAdd->msg?>" data-sweetalertcontrol="<?=$itemClassCode?$sweetAlertMsg->itemClassUpdate->cont:$sweetAlertMsg->itemClassAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$itemClassCode?'Update Item class':'Add Item class'?></button>
                                                    
                                                    <!-- <button data-control="master/item-class-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->itemClassAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->itemClassAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Item class</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" value="<?=$itemClassCode?>" name="item_class_code_db">
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
                                                        <h5 class="mb-0 card-title flex-grow-1">Item Class Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Item Class Code</th>
                                                        <th>Item Class Name</th>
                                                        <th>Item Category</th>
                                                        <th>UOM</th>
                                                        <th>Notes</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Item Class Code</th>
                                                        <th>Item Class Name</th>
                                                        <th>Item Category</th>
                                                        <th>UOM</th>
                                                        <th>Notes</th>
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

            "ajax": { "url": "<?=base_url('master/item-class-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        