
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
                                    <h4 class="mb-sm-0 font-size-18">Create role group</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Create role group</h5>
                                                <div class="flex-shrink-0">
                                                <a href="<?=base_Url('groupModuleList')?>" class="btn btn-primary" >View role group List</a>
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
                                                                    <select class="form-control select2 bus-unit-in" name="RG_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?=defaultBusUnit() == $busUnit['BU_CODE'] ? 'Selected':null?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <label id="RG_BUS_UNIT-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Module Group Code</label>
                                                                    <input type="text" class="form-control role-group-name" name="RG_NAME" placeholder="Auto generate if empty" onInput="searchGroupMOdule()">
                                                                    <label id="RG_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Custom Field 1</label>
                                                                    <input type="text" class="form-control" name="EMP_CODE" placeholder="Auto generate if empty">
                                                                    <label id="EMP_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="form-label">Select Module</label>
                                                                <div class="mb-3">
                                                                    <select class="form-control select2" onChange="moduleCh(this)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($modules as $module):?>
                                                                                <option value="<?=$module->MAF_NAME?>"><?=$module->MAF_NAME?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <!-- <label id="EMP_BUS_UNIT-error" class="error"></label> -->
                                                                </div>
                                                            </div>	
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mb-3 row">
                                                                <label for="example-text-input" class="form-label">Select function</label>
                                                                <div class="mb-3">
                                                                    <select class="form-control select2 sub-mod" onChange="subFunc(this)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                    </select>
                                                                    <label id="EMP_BUS_UNIT-error" class="error"></label>
                                                                </div>
                                                            </div>	
                                                        </div>
                                                    <div>
                                                    <h5 class="font-size-14 card-body border-bottom"><i class="mdi mdi-arrow-right text-primary"></i>Group Role List</h5>
                                                    <div class="col-xl-12">
                                                        <div class="form-row">
                                                            <div style="overflow-x:auto; overflow-y:hidden; /* white-space:nowrap; */ margin:0 10px;" class="ftable col-md-12">
                                                                <table class="table table-hover table-striped table-bordered ">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="5%">Module Name</th>
                                                                            <th width="12%">Function</th>
                                                                            <!-- <th width="5%">Del.</th> -->
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbUser">
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <button data-control="role/group-role-assign" data-sweetalert="<?=$sweetAlertMsg->empAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->empAdd->cont?>" data-form="formdata" data-aftreload="true" class="ajaxform btn btn-success waves-effect waves-light" type="submit">ADD MODULE GROUP</button>
                                                </div>
                                                <span id="outmsg"></span>
                                            
                                        </div>
                                        <!-- DB DATA -->
                                        <input type="hidden" name="RG_ASSIGN" id="assign-list-db">
                                        <input type="hidden" name="update_group_role_db" id="update_code-db">
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
<script>
    var moduleArr = funcArr = [];
    // var funcArr = []
    function moduleCh(ele) {
        // $('#tbUser').empty();
        $('.sub-mod').empty();
        $('.sub-mod').append(`<option value='' Selected disabled>Select</option>`);

        let ArrCh = moduleArr.indexOf(ele.value);
        if(ArrCh == -1){
            $('#tbUser').append(`<tr>
                                    <td onClick="mainDelete(this)">${ele.value}</td>
                                    <td id="td-func-${ele.value}"></td>
                                </tr>`);
            moduleArr.push(ele.value);
        }
        
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getSubModuleByModuleName')?>",
            data: {module:ele.value},
            dataType: "Json",
            success: function(resultData){
               for (let index = 0; index < resultData.length; index++) {
                    let st_name = resultData[index]['MAF_NAME'].replace(ele.value+'_', '');
                    let st_code = resultData[index]['MAF_NAME'];
                    $('.sub-mod').append(`<option value='`+st_code+`'>`+st_name+`</option>`);
               }
            }
        });
    }

    function subFunc(ele) {

        let ArrCh = funcArr.indexOf(ele.value);
        if(ArrCh == -1){
            let ty = ele.value.split("_");
            $('#td-func-'+ty[0]).append(`<tr><td onClick="deleteFun(this)">${ele.value}</td><tr>`);
            funcArr.push(ele.value);
        }
        $('#assign-list-db').val(funcArr);
        console.log(funcArr);
    }

    function searchGroupMOdule() {
        let roleGrpName = $('.role-group-name').val();
        $('#update_code-db').val(false);
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getRoleGroupDet')?>",
            data: {role_group_name:roleGrpName},
            dataType: "Json",
            success: function(resultData){
                if(resultData.role_del.RG_NAME == roleGrpName){
                    $(".bus-unit-in").select2().val(resultData.role_del.RG_BUS_UNIT).trigger("change");
                    $('#update_code-db').val(true);
                    let role_code = resultData.role_del.RG_NAME;
                    let role_asign = resultData.role_del.RG_ASSIGN;
                            $.ajax({
                                type: "POST",
                                url: "<?=base_url('Common/getModuleDetByRolegrpName')?>",
                                data: {role_code,role_asign},
                                dataType: "Json",
                                success: function(resultData){
                
                                if (resultData.length>0) {

                                    resultData.forEach(element => {
                                        if(element.MAF_TYPE == 'MODULE'){
                                            $('#tbUser').append(`<tr>
                                                                    <td onClick="mainDelete(this)">${element.MAF_NAME}</td>
                                                                    <td id="td-func-${element.MAF_NAME}"></td>
                                                                    
                                                                </tr>`);

                                                                    // <td id="module${element.MAF_NAME}">${element.MAF_NAME}</td>
                                                                    // <td id="sub-module${element.MAF_NAME}"></td>
                                                                    // <td id="function${element.MAF_NAME}"></td>
                                        }
                                        funcArr.push(element.MAF_NAME);
                                        $('#assign-list-db').val(funcArr);
                                    });

                                    resultData.forEach(element => {
                                        if(element.MAF_TYPE == 'SUB_MODULE'){
                                            let ty = element.MAF_NAME.split("_");
                                            $('#td-func-'+ty[0]).append(`<tr><td onClick="deleteFun(this)">${element.MAF_NAME}<td></tr>`);
                                        }
                                    });

                                    resultData.forEach(element => {
                                        if(element.MAF_TYPE == 'FUNCTION'){
                                            let ty = element.MAF_NAME.split("_");
                                            $('#td-func-'+ty[0]).append(`<tr><td onClick="deleteFun(this)">${element.MAF_NAME}<td></tr>`);
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
                                    $('#tbUser').append(`<tr>
                                                            <td colspan='5'><p class="text-center">No data Found</p></td>
                                                        </tr>`)
                                }
                            }
                    });
                }
            }
        });

    }

    function deleteFun(ele) {
        $(ele).remove();
            funcArr.splice(funcArr.indexOf($(ele).html()), 1);
            $('#assign-list-db').val(funcArr);
    }
    function mainDelete(ele) {
        $(ele).remove();
        $('#td-func-'+$(ele).html()).remove();
        funcArr.forEach(element_1 => {
                                    if(element_1.match($(ele).html())){
                                        funcArr.splice(funcArr.indexOf(element_1), 1);
                                    }
                                });
        $('#assign-list-db').val(funcArr);
    }
    function arrCal() {
        
        funcArr.forEach(element => {
            let sn = 1;
            funcArr.forEach(element_1 => {
                                    if(element_1.match(element+'_')){
                                        sn++;
                                    }
                                });
                    console.log(sn,element);
                    if(sn == 1){
                        funcArr.splice(funcArr.indexOf(element), 1);
                    }
                });
            
    }
</script>
        