
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
                                    <h4 class="mb-sm-0 font-size-18"> User Assign Role</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add  User Assign Role</h5>
                                                <div class="flex-shrink-0">
                                                <a href="<?=base_Url("userRoleAsignList")?>" class="btn btn-primary" >View  User Assign Role List</a>
                                                <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                                            </div>
                                               
                                            </div>
                                        </div>
                                        
                                    <div class="card-body">
                                            <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                         
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Search Employee</label>
                                                                    <input type="text" class="form-control" id="employe-code-search">
                                                                    <input type="hidden" name="SLSP_EMPLOYEE_CODE" id="emp-code-db">
                                                                    <label id="SLSP_EMPLOYEE_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- <div class="col-md-4">
                                                            <div class="position-relative form-group">
                                                            <label for="pur_pro" class="">Details</label>
                                                                <span id="distriprofile"></span>
                                                            </div>
                                                        </div>
                                                         -->
                                                          
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                                                    <h4 class="mb-sm-0 font-size-18">User Access</h4>
                                                                    <div class="page-title-right">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                        
                                                        <div class="col-xl-12">
                                                                <div class="form-row">
                                                                    <div style="overflow-x:auto; overflow-y:hidden; /* white-space:nowrap; */ margin:0 10px;" class="ftable col-md-12">
                                                                        <table class="table table-hover table-striped table-bordered ">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="5%">employee Detail</th>
                                                                                    <th width="12%">Role Assign</th>
                                                                                    <th width="5%">Del.</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="tbUser">
                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div> 
                                                            </div>
                        
                                                        
                                                        
                                                    </div>
                                                <div>
                                                    <button data-control="role/user-role-assign" data-sweetalert="<?=$sweetAlertMsg->empAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->empAdd->cont?>" data-form="formdata" data-aftreload="true" class="ajaxform btn btn-success waves-effect waves-light" type="submit">ADD USER ROLE ASSIGN</button>
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
var empArr = [];
$(function(){
    $('#emp_code_db').val('');
    $('#role-assign-code-db').val('');
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

                    $('#employe-code-search').focus();

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

                    $('#employe-code-search').focus();

                });

                $(this).val('');

            }

            },

        select: function (event, ui) {

            $('#distriprofile').html('Loading profile..');

            fetch(`<?php echo base_url('common/getEmpDetByEmpCode') ?>?term=${ui.item.id}&searchtype=select`)

            .then(response => response.json())

            .then(function (data) {

                // distriprofile(data);
                var role_name = null;
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('Common/getEmployeeRoleAssignDel') ?>",
                    data: {emp_code:ui.item.id},
                    dataType: "Json",
                    success: function(resultData){

                        role_name = resultData.role_del?resultData.role_del.RAU_ROLE_CODE:'';

                        if(empArr.indexOf(data.vend_det.CODE) == -1){
                            $('#tbUser').append(`<tr>
                                                    <td>
                                                        <p>Name : ${data.vend_det.ENG_NAME}</p>
                                                        <p>Mobile : ${data.vend_det.PHONE1}</p>
                                                        <p>Address : ${data.vend_det.ADD1}</p>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" onInput="roleAssign(this)" value="${role_name}">
                                                        <input type="hidden" name="role_assign_code_db[]" id="role-assign-code-db" value="${role_name}">
                                                        <input type="hidden" name="emp_code_db[]" value="${ui.item.id}">
                                                    </td>
                                                    <td>Delete</td>
                                                </tr>`);
                                empArr.push(data.vend_det.CODE);
                            }
                        $('#employe-code-search').val('');
                    }
                });
                
            })

            .catch(function (err) {

                $('#distriprofile').html(err);

            });

        }

    });

});
   
        function distriprofile(ele) {

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
    
    function roleAssign(ele) {
        $('#role-assign-code-db').val('');
        $(ele).autocomplete({

            source: function( request, response ) {

                $.ajax({url: "<?=base_url('inputsearch/getRoleAssigByCode')?>", dataType: "jsonp", data: { term: request.term,searchtype:"list"},

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

                fetch(`<?php echo base_url('inputsearch/getRoleAssigByCode') ?>?term=${ui.item.id}&searchtype=select`)

                .then(response => response.json())

                .then(function (data) {
                    $(ele).val(ui.item.id);
                    // $('#role-assign-code-db').val(ui.item.id);
                    $(ele).closest('tr').find('td #role-assign-code-db').val(ui.item.id);
                })

                .catch(function (err) {

                    $('#distriprofile').html(err);

                });

            }

        });
    }
</script>
        