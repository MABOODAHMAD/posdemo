
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
                                    <h4 class="mb-sm-0 font-size-18">PO Prefixes</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New PO Prefixes</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                                    <select class="form-control select2" name="POP_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                            <option value="<?=$busUnit['BU_CODE']?>" <?php if($poPrefixList){ echo $poPrefixListDet->POP_BUS_UNIT == $busUnit['BU_CODE']?'selected':null; }else{ echo defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null;}?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="POP_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">PO Prefixes Code</label>
                                                                    <input type="text" class="form-control" name="POP_ORDER_PFX" value="<?=$poPrefixList?$poPrefixListDet->POP_ORDER_PFX:null?>" placeholder="Auto generate if empty" <?=$poPrefixList?'disabled':null?>>
                                                                    <label id="POP_ORDER_PFX-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">PO Prefixes Description</label>
                                                                    <input type="text" class="form-control" name="POP_DESC" value="<?=$poPrefixList?$poPrefixListDet->POP_DESC:null?>">
                                                                    <label id="POP_DESC-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Order Class</label>
                                                                    <!-- <input type="text" class="form-control" name="POP_ORDER_CLS" > -->
                                                                    <select class='form-control' name="POP_ORDER_CLS">
                                                                        <option value="N" <?php if($poPrefixList){ echo $poPrefixListDet->POP_ORDER_CLS == 'N'?'selected':null; }?>>N</option>
                                                                        <option value="Y" <?php if($poPrefixList){ echo $poPrefixListDet->POP_ORDER_CLS == 'Y'?'selected':null; }?>>Y</option>
                                                                    </select>
                                                                    <label id="POP_ORDER_CLS-error" class="error"></label>
                                                            </div>
                                                        </div> 
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Next Number</label>
                                                                <input type="number" class="form-control" name="POP_NEXT_NUMBER" value="<?=$poPrefixList?$poPrefixListDet->POP_NEXT_NUMBER:null?>">
                                                                <label id="POP_NEXT_NUMBER-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="POP_UPD_INV" value="Y" id="formCheck1upd" <?php if($poPrefixList){ echo $poPrefixListDet->POP_UPD_INV == 'Y'?'checked':null; }?>>
                                                            <label class="form-check-label" for="formCheck1upd">UPD Inventory</label>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">&nbsp;</label>
                                                                  <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="POP_PRINT_ORDER" value="Y" id="formCheck1print" <?php if($poPrefixList){ echo $poPrefixListDet->POP_PRINT_ORDER == 'Y'?'checked':null; }?>>
                                                            <label class="form-check-label" for="formCheck1print">Print Order</label>
                                                        </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Document Type</label>
                                                                <select class="form-select" name="POP_DOCUMENT_TYPE">
                                                                        <option value="PO" <?php if($poPrefixList){ echo $poPrefixListDet->POP_DOCUMENT_TYPE == 'PO'?'selected':null; }?>>PO</option>
                                                                        <option value="REC" <?php if($poPrefixList){ echo $poPrefixListDet->POP_DOCUMENT_TYPE == 'REC'?'selected':null; }?>>REC</option>
                                                                    </select>
                                                                <label id="POP_DOCUMENT_TYPE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Notes</label>
                                                               <input type="text" class="form-control" name="POP_NOTES" placeholder="Enter Notes" value="<?=$poPrefixList?$poPrefixListDet->POP_NOTES:null?>">
                                                                <label id="POP_NOTES-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>

                                                    <button data-control="master/po-prefixes-add" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$poPrefixList?$sweetAlertMsg->POPrefixUpdate->msg:$sweetAlertMsg->POPrefixAdd->msg?>" data-sweetalertcontrol="<?=$poPrefixList?$sweetAlertMsg->POPrefixUpdate->cont:$sweetAlertMsg->POPrefixAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit"><?=$poPrefixList?'Update PO Prefix':'Add PO Prefix'?></button>

                                                    <!-- <button data-control="master/po-prefixes-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->POPrefixAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->POPrefixAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add PO Prefix</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" value="<?=$poPrefixList?>" name="po_prefix_db">
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
                                                        <h5 class="mb-0 card-title flex-grow-1">Currency Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>PO Prefix Business Unit</th>
                                                        <th>PO Prefixes Code</th>
                                                        <th>PO Prefixes Description</th>
                                                        <th>Order Class</th>
                                                        <th>Next Number</th>
                                                        <th>UPD Inventory</th>
                                                        <th>Print Order</th>
                                                        <th>Document type</th>
                                                        <th>Notes</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>PO Prefix Business Unit</th>
                                                        <th>PO Prefixes Code</th>
                                                        <th>PO Prefixes Description</th>
                                                        <th>Order Class</th>
                                                        <th>Next Number</th>
                                                        <th>UPD Inventory</th>
                                                        <th>Print Order</th>
                                                        <th>Document type</th>
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

            "ajax": { "url": "<?=base_url('master/po-prefixes-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        