
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
                                    <h4 class="mb-sm-0 font-size-18">Sales Man</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add Sales Man</h5>
                                                <div class="flex-shrink-0">
                                                <a href="<?=base_Url()?>SalesManList" class="btn btn-primary" >View Sales Man List</a>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                               
                                            </div>
                                        </div>
                                        
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="form-label">Bussiness Unit</label>
                                                                <div class="mb-3">
                                                                    <select class="form-control bus-unit-sel" name="SLSP_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?=defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label id="SLSP_BUS_UNIT-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Search Employee</label>
                                                                    <input type="text" class="form-control" id="employe-code-search">
                                                                    <input type="hidden" name="SLSP_EMPLOYEE_CODE" id="emp-code-db">
                                                                    <label id="SLSP_EMPLOYEE_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group">
                                                            <label for="pur_pro" class="">Details</label>
                                                                <span id="distriprofile"></span>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Sales Area</label>
                                                                <select class="form-control sale-area-sel" name="SLSP_SALES_AREA">
                                                                    <option value='' Selected disabled>Select</option>
                                                                    <?php foreach ($saleAreas as $saleArea):?>
                                                                            <option value="<?=$saleArea->SA_SALES_AREA?>"><?=$saleArea->SA_DESC?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <label id="SLSP_SALES_AREA-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom04" class="form-label">Note </label>
                                                                <input type="email" class="form-control" name="SLSP_NOTES" placeholder="Note">
                                                                <label id="SLSP_NOTES-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                        
                                                        
                                                        
                                                       
                                                        
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">User Access</h4>
                                    <div class="page-title-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="form-label">Bussiness Unit</label>
                                                                <div class="mb-3">
                                                                    <select class="form-control emp-asin-bus-unit" name="WHSE_BUS_UNIT_ASSIGN">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>"><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label id="WHSE_BUS_UNIT_ASSIGN-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="form-label">Warehouse</label>
                                                                <div class="mb-3">
                                                                    <select class="form-control whse-select" multiple name="WHSE_CODE[]">
                                                                        <option value='' disabled>Select</option>
                                                                        <?php foreach ($whareDets as $whareDet):?>
                                                                                <option value="<?=$whareDet->WHSE_CODE?>"><?=$whareDet->WHSE_CODE.'-'.$whareDet->WHSE_DESC?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label id="WHSE_CODE[]-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                    </div>
                                                <div>
                                                    <button data-control="master/salesman-assign-create" data-form="formdata" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Sales Man</button>
                                                </div>
                                                <span id="outmsg"></span>
                                            
                                        </div>
                                        </form>
                                    </div>
                                    <!-- end card -->
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

$(function(){

    $(".whse-select").select2();
    $(".emp-asin-bus-unit").select2();
    $(".sale-area-sel").select2();
    $(".bus-unit-sel").select2();
    // $(".bus-unit-sel").select2().val('111').trigger("change");

  
    $("#employe-code-search").autocomplete({

        source: function( request, response ) {

            $.ajax({url: "<?=base_url('common/getEmpDetByEmpCode')?>", dataType: "jsonp", data: { term: request.term,searchtype:"list"},

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

            fetch(`<?php echo base_url('common/getEmpDetByEmpCode') ?>?term=${ui.item.id}&searchtype=select`)

            .then(response => response.json())

            .then(function (data) {

                distriprofile(data);
                
                $('#emp-code-db').val(ui.item.id);

                if(data.emp_ass_list){
                   
                    let emp_asin_list = data.emp_ass_list;

                    $(".emp-asin-bus-unit").select2().val(emp_asin_list[0].SMSW_BUS_UNIT).trigger("change");
                    $(".sale-area-sel").select2().val(emp_asin_list[0].SLSP_SALES_AREA).trigger("change");
                    
                    // $(".emp-asin-bus-unit option[value=" + emp_asin_list[0].SMSW_BUS_UNIT + "]").prop("selected",true);
                    // $(".sale-area-sel option[value=" + emp_asin_list[0].SLSP_SALES_AREA + "]").prop("selected",true);
                    let whseAss = [];
                    emp_asin_list.forEach(element => {
                        whseAss.push(element.SMSW_WHSE_CODE);
                            // $(".whse-select option[value=" + element.SMSW_WHSE_CODE + "]").prop("selected",true);
                    });
                    // console.log(whseAss);
                    $(".whse-select").select2().val(whseAss).trigger("change");
                }

            })

            .catch(function (err) {

                $('#distriprofile').html(err);

            });

        }

    });

});
   
        function distriprofile(ele) {
            $('#employe-code-search').val(ele.vend_det.ENG_NAME);
            $('#distriprofile').html(`
                                            <input type="hidden" id="retailid" name="retailid" value="1"> 
                                            <div style="border: 2px dotted;">
                                                <div class="row">
                                                    <div class="col-md-4 dname">
                                                        <b>Name :</b> `+ele.vend_det.ENG_NAME+`
                                                    </div>
                                                    <div class="col-md-3">
                                                        <b>Mobile :</b> `+ele.vend_det.PHONE1+`
                                                    </div>
                                                    <div class="col-md-5">
                                                        <b>Address :</b> `+ele.vend_det.ADD1+`
                                                    </div>
                                                <div>
                                            </div>`);
        }
 
</script>
        