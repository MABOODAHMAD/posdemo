
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
                                    <h4 class="mb-sm-0 font-size-18">New Account Setup</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Account</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                                    <select class="form-control select2" name="AH_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?=defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="AH_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Main Head</label>
                                                                    <select class="form-control select2" name="AH_MAIN_HEAD" onChange="subHead(this)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($mainHead as $mainHeadGet):?>
                                                                                <option value="<?=$mainHeadGet->AH_MAIN_HEAD?>" shortseq="<?=$mainHeadGet->AH_SORT_SEQ?>"><?=$mainHeadGet->AH_MAIN_HEAD.'-'.$mainHeadGet->AR_Title.'-'.$mainHeadGet->EN_Title?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label id="AH_MAIN_HEAD-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Sub head</label>
                                                                    <select class="form-control select2 sub-head" name="AH_SUB_HEAD" onChange="genHead(this)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                    </select>
                                                                    <label id="AH_SUB_HEAD-error" class="error"></label>
                                                            </div>
                                                        </div> 
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">General</label>
                                                                <select class="form-control select2 gen-head" name="AH_GENERAL" onChange="genSel(this)">
                                                                    <option value='' Selected disabled>Select</option>
                                                                </select>
                                                                <label id="AH_GENERAL-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Subsidiary</label>
                                                               <input type="text" class="form-control" id="sub-ac-db" name="AH_SUBSIDERY" placeholder="Enter Notes">
                                                                <label id="AH_SUBSIDERY-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">English Title</label>
                                                               <input type="text" class="form-control" name="EN_Title" placeholder="Enter Notes">
                                                                <label id="EN_Title-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Arabic Title</label>
                                                               <input type="text" class="form-control" name="AR_Title" placeholder="Enter Notes">
                                                                <label id="AR_Title-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Status</label>
                                                                <select class="form-control select2" name="AC_STATUS">
                                                                    <option value='A' Selected>Active</option>
                                                                    <option value='N'>Deactive</option>
                                                                </select>
                                                                <label id="AC_STATUS-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Notes</label>
                                                               <input type="text" class="form-control" name="AC_NOTES" placeholder="Enter Notes">
                                                                <label id="AC_NOTES-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>
                                                    <button data-control="account/new-acc-setup-add" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->accAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->accAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Create Account</button>

                                                    <!-- <button data-control="master/currency-add" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->currAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->currAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add currency</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" name="AH_SORT_SEQ" id="short-seq-db">
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
                                                        <h5 class="mb-0 card-title flex-grow-1">Account Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Subsidiary</th>
                                                        <th>Arabic Title</th>
                                                        <th>English Title</th>
                                                        <th>General</th>
                                                        <th>Sub head</th>
                                                        <th>Main Head</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Subsidiary</th>
                                                        <th>Arabic Title</th>
                                                        <th>English Title</th>
                                                        <th>General</th>
                                                        <th>Sub head</th>
                                                        <th>Main Head</th>
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
    
    function subHead(ele) {

        let short_seq = $(ele).find('option:selected');
        short_seq = short_seq.attr("shortseq");
        $('#short-seq-db').val(short_seq);
        $('.sub-head').empty();
        $('.sub-head').append(`<option value='' Selected disabled>Select</option>`);
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getAccSubHeadDetByCode')?>",
            data: {acc_main_head:ele.value},
            dataType: "Json",
            success: function(resultData){

               for (let index = 0; index < resultData.length; index++) {
                    let sub_ac = resultData[index]['AH_SUB_HEAD'];
                    let sub_en = resultData[index]['EN_Title'];
                    let sub_ar = resultData[index]['AR_Title'];
                    let sub_head = resultData[index]['AH_SUB_HEAD'];
                    if(sub_head != 0){
                        $('.sub-head').append(`<option value='${sub_head}'>${sub_ac}-${sub_ar}-${sub_en}</option>`);
                    }
               }
            }
        });
    }

    function genHead(ele) {
        $('.gen-head').empty();
        $('.gen-head').append(`<option value='' Selected disabled>Select</option>`);
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getAccGenHeadDetByCode')?>",
            data: {acc_sub_head:ele.value},
            dataType: "Json",
            success: function(resultData){

               for (let index = 0; index < resultData.length; index++) {
                    let sub_ac = resultData[index]['AH_GENERAL'];
                    let sub_en = resultData[index]['EN_Title'];
                    let sub_ar = resultData[index]['AR_Title'];
                    let sub_head = resultData[index]['AH_GENERAL'];
                    if(sub_head != 0){
                        $('.gen-head').append(`<option value='${sub_head}'>${sub_ac}-${sub_ar}-${sub_en}</option>`);
                    }
               }
            }
        });
    }


    function genSel(ele) {
        $('#sub-ac-db').val('');
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getSubsidary')?>",
            data: {gen_code:ele.value},
            dataType: "Json",
            success: function(resultData){
                $('#sub-ac-db').val(parseInt(resultData.AH_SUBSIDERY)+parseInt(1));
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

            "ajax": { "url": "<?=base_url('account/new-acc-setup-table-list'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        