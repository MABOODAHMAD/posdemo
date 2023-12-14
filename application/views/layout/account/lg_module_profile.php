
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
                                                        
                                                        <?php 
                                                        
                                                            foreach ($layouts as $layout):
                                                                if($layout->L_DISPLAY == 'Y'){
                                                        ?>
                                                            
                                                                    <div class="col-md-3">
                                                                        <div class="mb-3">
                                                                            <label for="validationCustom03" class="form-label"><?=$layout->L_TITLE?></label>
                                                                                <?php if($layout->L_TYPE == "INPUT"){?>
                                                                                    <input 
                                                                                        type="text" 
                                                                                        class="form-control <?=$layout->L_UNIQUE_ID?>" 
                                                                                        name="<?=$layout->DB_NAME?>" 
                                                                                        placeholder="Enter Notes"
                                                                                        <?php if(isset($layout->JFUNC_CONT)){ ?>
                                                                                            <?php if($layout->JFUNC_TYPE == 'INPUT'){ ?>
                                                                                                onInput = "<?=$layout->JFUNC_NAME?>"
                                                                                            <?php }else{ ?>

                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                        <?php if(isset($layout->DATA_ATTRIBUTE_CON)){ ?>
                                                                                            <?php if(isset($layout->FIRST_ATT_NAME)){ ?>
                                                                                                data-FIRST_ATT_NAME = "<?=$layout->FIRST_ATT_NAME?>"
                                                                                            <?php }else{ ?>

                                                                                            <?php } ?>
                                                                                        <?php } ?>
                                                                                    >
                                                                                <?php }else if($layout->L_TYPE == 'SELECT'){ ?>
                                                                                    <select 
                                                                                        class="form-control select2 <?=$layout->DB_NAME?>"
                                                                                        name="<?=$layout->DB_NAME?>"
                                                                                        <?php if(isset($layout->JFUNC_CONT)){ ?>
                                                                                            <?php if($layout->JFUNC_TYPE == 'CHANGE'){ ?>
                                                                                                onChange = "<?=$layout->JFUNC_NAME?>"
                                                                                            <?php }else{ } ?>
                                                                                        <?php } ?>
                                                                                    >
                                                                                        <?php foreach ($layout->L_SEL_DATA_LOOP as $selectDataGet):?>
                                                                                            <option value="<?=$selectDataGet->{$layout->L_SEL_DATA_LOOP_VALUE}?>">
                                                                                                <?php if(isset($layout->L_SEL_DATA_LOOP_CUST_DISP) && $layout->L_UNIQUE_ID == 'COST_CENTER'){?>
                                                                                                    <?=$selectDataGet->CC_CODE.'-'.$selectDataGet->CC_WHSE_CODE.'-'.$selectDataGet->WHSE_DESC?>
                                                                                                <?php }else{?>
                                                                                                    <?=$selectDataGet->{$layout->L_SEL_DATA_LOOP_DISP}?>
                                                                                                <?php }?>
                                                                                            </option>
                                                                                        <?php endforeach; ?>
                                                                                    </select>
                                                                                <?php } ?>
                                                                                <label id="<?=$layout->DB_NAME?>-error" class="error"></label>
                                                                        </div>
                                                                    </div> 
                                                        <?php 
                                                                }  
                                                            endforeach; 
                                                        ?>
                                                    </div>
                                                <div>
                                                    <button data-control="account/gl-profile-module-add-test" data-aftreload="true" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->currAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->currAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Create Account</button>

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
                                                        <h5 class="mb-0 card-title flex-grow-1">Currency Lists</h5>
                                                    </div>
                                                </div>

                                            <div class="table-responsive">
                                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Business Unit</th>
                                                        <th>MOdule</th>
                                                        <th>Type</th>
                                                        <th>Return</th>
                                                        <th>Received by</th>
                                                        <th>Vat Account</th>
                                                        <th>Cost Goods Account</th>
                                                        <th>Inventory Account</th>
                                                        <th>Income Account</th>
                                                        <th>Discount ACCOUNT</th>
                                                        <th>Advertisement Account</th>
                                                        <th>Cost Center</th>
                                                        <th>Entry Type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>Sn.</th>
                                                        <th>Business Unit</th>
                                                        <th>MOdule</th>
                                                        <th>Type</th>
                                                        <th>Return</th>
                                                        <th>Received by</th>
                                                        <th>Vat Account</th>
                                                        <th>Cost Goods Account</th>
                                                        <th>Inventory Account</th>
                                                        <th>Income Account</th>
                                                        <th>Discount ACCOUNT</th>
                                                        <th>Advertisement Account</th>
                                                        <th>Cost Center</th>
                                                        <th>Entry Type</th>
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
            <!--=============================== Auto Complete script Start=============================-->
            <script src="<?=base_url()?>assets/js/custom_js/jquery-1.8.3.js"></script>
            <script src="<?=base_url()?>assets/js/custom_js/jquery-ui-1.9.2.custom.js"></script>
            <!--=============================== Auto Complete script End=============================-->
<script>

        function muduleSel(ele){
            if(ele.value == 'AR'){
                $(".GLMP_TYPE").select2().val('RECEIVEABLE').trigger("change");
                $(".GLMP_RECV_IN").select2().val('D').trigger("change");
            }else if(ele.value == 'SO'){
                $(".GLMP_TYPE").select2().val('CASH').trigger("change");
                $(".GLMP_RECV_IN").select2().val('C').trigger("change");
            }else{
                $(".GLMP_TYPE").select2().val('').trigger("change");
                $(".GLMP_RECV_IN").select2().val('').trigger("change");
            }
        }

        function accDet(ele) {
            $('#'+$(ele).data('first_att_name')+'-error').html('');
            $(ele).autocomplete({

                source: function( request, response ) {

                    $.ajax({url: "<?=base_url('inputsearch/getAccDet')?>", dataType: "jsonp", data: { term: request.term,searchtype:"list"},

                        success: function( data ) {response(data); }

                    });

                },

                minLength: 1,

                response: function (event, ui) {

                    if ($(this).val().length >= 16 && ui.content[0].id == 0) {

                        bootbox.alert('no_match_found', function () {

                            $(ele).focus();

                        });

                        $(this).val('');

                    }

                    else if (ui.content.length == 1 && ui.content[0].id != 0) {

                        ui.item = ui.content[0];

                        $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);

                        $(this).autocomplete('close');

                    }

                    else if (ui.content.length == 1 && ui.content[0].id == 0) {

                        bootbox.alert('no_match_found', function () {

                            $(ele).focus();

                        });

                        $(this).val('');

                    }

                    },

                select: function (event, ui) {

                    $('#distriprofile').html('Loading profile..');

                    fetch(`<?php echo base_url('inputsearch/getAccDet') ?>?term=${ui.item.id}&searchtype=select`)

                    .then(response => response.json())

                    .then(function (data) {

                        $(ele).val(data.data_fetch.AH_SUBSIDERY);
                        $('#'+$(ele).data('first_att_name')+'-error').html(`<span class='text-success'>${data.data_fetch.AR_Title}-${data.data_fetch.EN_Title}-${data.data_fetch.AH_SUBSIDERY}</span>`);
                        
                    })

                    .catch(function (err) {

                        $('#distriprofile').html(err);

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

            "ajax": { "url": "<?=base_url('account/gl-profile-module-table-list-test'); ?>", "type": "POST","data":{device:"web"} }

        });

    });
</script>
        