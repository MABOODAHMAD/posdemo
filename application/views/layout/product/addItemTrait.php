<div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Add item trait</h4>

                                    <!-- <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                            <li class="breadcrumb-item active">Add item trait</li>
                                        </ol>
                                    </div> -->

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Add trait</h4>
                                            <div  class="mb-3 col-lg-2">
                                                <label for="name">Item Code</label>
                                                <input type="text" value='<?=$itemCode?>' onInput='itemCodein(this)' class="form-control"/>
                                                <label id="item-code-error" class="error"></label>
                                            </div>
                                        <form id="formdata">
                                        <table id="tbUser">
                                        <!-- <tr>   
                                                <td>
                                                    <div class="row">
                                                        <div  class="mb-3 col-lg-2">
                                                            <label for="name">Tarit category</label>
                                                            <input type="text" id="subject" onInput='catCode(this)' class="form-control"/>
                                                        </div>
            
                                                        <div  class="mb-3 col-lg-2">
                                                            <label for="email">Trait</label>
                                                                <select class="form-control trait_list" onChange="traitCode(this)">
                                                                    <option value='' Selected disabled>Select</option>
                                                                </select>
                                                        </div>
            
                                                        <div  class="mb-3 col-lg-2">
                                                            <label for="subject">category description</label>
                                                            <input type="text" id="subject" class="form-control cat_desc_int"/>
                                                            <input type="hidden" name="trait_code_db[]" id='trait_code_in'>
                                                            <input type="hidden" name="trait_cat_code_db[]" id='trait_cat_code_in'>
                                                        </div>

                                                        <div  class="mb-3 col-lg-2">
                                                            <label for="subject">trait description</label>
                                                            <input type="text" id="trait_desc_in" class="form-control"/>
                                                        </div>

                                                        <div  class="mb-3 col-lg-2">
                                                            <label for="subject">Weight</label>
                                                            <input type="number" step="0.01" id="weight" name="weight[]" class="form-control"/>
                                                        </div>
                                                        
                                                        <div class="col-lg-2 align-self-center">
                                                            <div class="d-grid">
                                                                <input type="button" class="btn btn-primary" onClick='deleteTraitRow(this)' value="Delete"/>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </td>
                                            </tr> -->
                                        </table>
                                            <input type="button" class="btn btn-success mt-3 mt-lg-0" onCLick="addTraitRow()" value="Add row"/>
                                            <input type="hidden" id="item_code_min" name="item_Code_p" value='<?=$itemCode?>'>
                                            <button data-control="item/item-trait-add-db" data-form="formdata" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Submit trait</button>
                                            <span id="outmsg"></span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <!-- <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card-body">
                                                <div class="card-body border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0 card-title flex-grow-1">Traites Lists</h5>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                                        <thead>
                                                            <tr>
                                                                <th>Sn.</th>
                                                                <th>Traites Category code/desc</th>
                                                                <th>Traites code/desc</th>
                                                                <th>Weight</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Sn.</th>
                                                                <th>Traites Category</th>
                                                                <th>Traites</th>
                                                                <th>Weight</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                end row
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

            <!-- end main content-->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

            <script>
                function catCode(ele) {

                    $(ele).closest('tr').find('td #trait_code_de_in').val('');
                    $(ele).closest('tr').find('td #trait_desc_in').val('');
                    $(ele).closest('tr').find('td #weight').val('');
                    // var selected = $(this).find('option:selected');
                    // var extra = selected.data('foo'); 
                    

                    $(ele).closest('tr').find('td .trait_list').empty();
                    $(ele).closest('tr').find('td .trait_list').append(`<option value='' Selected disabled>Select</option>`);
                    // $('.trait_list').empty();
                    // $('.trait_list').append(`<option value='' Selected disabled>Select</option>`);
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('Common/getTraitListbyCode')?>",
                        data: {cat_code:ele.value},
                        dataType: "Json",
                        success: function(resultData){
                            $(ele).closest('tr').find('td .cat_desc_int').val(resultData.cat_desc);
                            let trait_list = resultData.trait_data;
                            for (let index = 0; index < trait_list.length; index++) {

                                    $(ele).closest('tr').find('td #trait_cat_code_in').val(ele.value);

                                    let trait_name = trait_list[index]['TRAIT_DESC'];
                                    let trait_code = trait_list[index]['TRAIT_SUB_CAT_CODE'];
                                    $(ele).closest('tr').find('td .trait_list').append(`<option value='`+trait_code+`' data-desc='`+trait_name+`'>${trait_code} - ${trait_name}</option>`);
                                    // $('.trait_list').append(`<option value='`+trait_code+`'>`+trait_name+`</option>`);

                            }
                        }
                    });
                }

                function traitCode(ele) {
                    
                    var selected = $(ele).find('option:selected');
                    var extra = selected.data('desc'); 
                    $(ele).closest('tr').find('td #trait_desc_in').val(extra);
                    $(ele).closest('tr').find('td #trait_code_in').val(ele.value);
                    $(ele).closest('tr').find('td #trait_code_de_in').val(ele.value);

                }

                function addTraitRow() {
                    
                        $('#tbUser').append(`<tr>   
                                                <td>
                                                    <div class="row">
                                                        <div  class="mb-3 col-lg-1">
                                                            <label for="name">Tarit Cat</label>
                                                            <input type="text" id="subject" onInput='catCode(this)' class="form-control"/>
                                                        </div>
            
                                                        <div  class="mb-3 col-lg-2">
                                                            <label for="email">Trait</label>
                                                                <select class="form-control trait_list" onChange="traitCode(this)">
                                                                    <option value='' Selected disabled>Select</option>
                                                                </select>
                                                        </div>
            
                                                        <div  class="mb-3 col-lg-3">
                                                            <label for="subject">Category Description</label>
                                                            <input type="text" id="subject" class="form-control cat_desc_int"/>
                                                            <input type="hidden" name="trait_code_db[]" id='trait_code_in'>
                                                            <input type="hidden" name="trait_cat_code_db[]" id='trait_cat_code_in'>
                                                        </div>

                                                        <div  class="mb-3 col-lg-1">
                                                            <label for="subject">&nbsp;</label>
                                                            <input type="text" id="trait_code_de_in" class="form-control" disabled/>
                                                        </div>

                                                        <div  class="mb-3 col-lg-3">
                                                            <label for="subject">Trait Description</label>
                                                            <input type="text" id="trait_desc_in" class="form-control"/>
                                                        </div>

                                                        <div  class="mb-3 col-lg-1">
                                                            <label for="subject">Weight</label>
                                                            <input type="text" step="0.01" id="weight" name="weight[]" class="form-control"/>
                                                        </div>
                                                        
                                                        <div class="col-lg-1 align-self-center">
                                                            <div class="d-grid">
                                                                <input type="button" class="btn btn-primary" onClick='deleteTraitRow(this)' value="Delete"/>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </td>
                                            </tr>`);
                }

                function deleteTraitRow(ele) {
                    $(ele).closest('tr').remove();
                }

                $(document).ready(function(){
                    let itemCode = '<?=$itemCode?>';

                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('Common/getItemTraitByItemCode')?>",
                        data: {itemCode},
                        dataType: "Json",
                        success: function(resultData){
                          if(resultData.itemdel){
                            $('#item_code_min').val(itemCode);
                            $('#item-code-error').html('');
                            let trait_list_in = resultData.traitDeaits;
                            if(trait_list_in.length>0){

                                for (let index = 0; index < trait_list_in.length; index++) {
                                    let trait_cat_in = trait_list_in[index]['ITM_TRAIT_CAT_CODE'];
                                    let trait_id_in = trait_list_in[index]['ID'];
                                    let trait_weight = trait_list_in[index]['TRT_WEIGHT'];
                                    let trait_code_int = trait_list_in[index]['ITM_TRAIT_CODE'];
                                    let trait_desc_int = trait_list_in[index]['TRAIT_DESC'];
                                    let trait_cat_desc_int = trait_list_in[index]['TC_DESC'];

                                    $('#tbUser').append(`<tr>   
                                                    <td>
                                                        <div class="row">
                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="name">Tarit Cat</label>
                                                                <input type="text" id="subject" onInput='catCode(this)' value='${trait_cat_in}' class="form-control"/>
                                                            </div>
                
                                                            <div  class="mb-3 col-lg-2">
                                                                <label for="email">Trait</label>
                                                                    <select id="trait-list${trait_id_in}" class="form-control trait_list" onChange="traitCode(this)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        
                                                                        </select>
                                                            </div>
                
                                                            <div  class="mb-3 col-lg-3">
                                                                <label for="subject">Category Description</label>
                                                                <input type="text" id="subject" value="${trait_cat_desc_int}" class="form-control cat_desc_int"/>
                                                                <input type="hidden" name="trait_code_db[]" value="${trait_code_int}" id='trait_code_in'>
                                                                <input type="hidden" name="trait_cat_code_db[]" value="${trait_cat_in}" id='trait_cat_code_in'>
                                                                <input type="hidden" name="item_trait_main_id_db[]" value="${trait_id_in}">
                                                            </div>

                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="subject">&nbsp;</label>
                                                                <input type="text" id="trait_code_de_in" value="${trait_code_int}" class="form-control" disabled/>
                                                            </div>

                                                            <div  class="mb-3 col-lg-3">
                                                                <label for="subject">Trait Description</label>
                                                                <input type="text" id="trait_desc_in" value="${trait_desc_int}" class="form-control" disabled/>
                                                            </div>

                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="subject">Weight</label>
                                                                <input type="text" step="0.01" id="weight" name="weight[]" value="${trait_weight}" class="form-control"/>
                                                            </div>
                                                            
                                                            <div class="col-lg-1 align-self-center">
                                                                <div class="d-grid">
                                                                    <input type="button" class="btn btn-primary" onClick='deleteTraitRow(this)' value="Delete"/>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </td>
                                                </tr>`);

                                                catCodeIn(trait_cat_in,trait_id_in,trait_code_int);
                                        }
                                }else{
                                   
                                    $('#tbUser').append(`<tr>   
                                                    <td>
                                                        <div class="row">
                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="name">Tarit Cat</label>
                                                                <input type="text" id="subject" onInput='catCode(this)' class="form-control"/>
                                                            </div>
                
                                                            <div  class="mb-3 col-lg-2">
                                                                <label for="email">Trait</label>
                                                                    <select class="form-control trait_list" onChange="traitCode(this)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        
                                                                        </select>
                                                            </div>
                
                                                            <div  class="mb-3 col-lg-2">
                                                                <label for="subject">category description</label>
                                                                <input type="text" id="subject" class="form-control cat_desc_int"/>
                                                                <input type="hidden" name="trait_code_db[]" id='trait_code_in'>
                                                                <input type="hidden" name="trait_cat_code_db[]" id='trait_cat_code_in'>
                                                            </div>
                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="subject">&nbsp;</label>
                                                                <input type="text" id="trait_code_de_in" class="form-control" disabled/>
                                                            </div>
                                                            <div  class="mb-3 col-lg-3">
                                                                <label for="subject">trait description</label>
                                                                <input type="text" id="trait_desc_in" class="form-control"/>
                                                            </div>

                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="subject">Weight</label>
                                                                <input type="number" step="0.01" id="weight" name="weight[]" class="form-control"/>
                                                            </div>
                                                            
                                                            <div class="col-lg-1 align-self-center">
                                                                <div class="d-grid">
                                                                    <input type="button" class="btn btn-primary" onClick='deleteTraitRow(this)' value="Delete"/>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </td>
                                                </tr>`);
                                }
                                   
                          }else{
                            $('#item-code-error').html('Invalid item code');
                            $('#tbUser').empty();
                          }
                        }
                    });

                    // $('#datatable').DataTable({

                    //     "processing": true,

                    //     "serverSide": true,

                    //     "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],

                    //     "dom" : 'lBfrtip',

                    //     "buttons" : ['copy', 'csv', 'excel', 'print'],

                    //     "order": [],

                    //     "scrollX": true,

                    //     "ajax": { "url": "<?=base_url('item/item-trait-table-list'); ?>", "type": "POST","data":{device:"web",item_code:'<?=$itemCode?>'} }

                    // });

                })
                
                function itemCodein(ele) {
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('Common/getItemTraitByItemCode')?>",
                        data: {itemCode:ele.value},
                        dataType: "Json",
                        success: function(resultData){
                          if(resultData.itemdel){
                            $('#item_code_min').val(ele.value);
                            $('#item-code-error').html('');
                            let trait_list_in = resultData.traitDeaits;
                            if(trait_list_in.length>0){

                                for (let index = 0; index < trait_list_in.length; index++) {
                                    let trait_cat_in = trait_list_in[index]['ITM_TRAIT_CAT_CODE'];
                                    let trait_id_in = trait_list_in[index]['ID'];
                                    let trait_weight = trait_list_in[index]['TRT_WEIGHT'];
                                    let trait_code_int = trait_list_in[index]['ITM_TRAIT_CODE'];
                                    let trait_desc_int = trait_list_in[index]['TRAIT_DESC'];
                                    let trait_cat_desc_int = trait_list_in[index]['TC_DESC'];

                                    $('#tbUser').append(`<tr>   
                                                    <td>
                                                        <div class="row">
                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="name">Tarit Cat</label>
                                                                <input type="text" id="subject" onInput='catCode(this)' value='${trait_cat_in}' class="form-control"/>
                                                            </div>
                
                                                            <div  class="mb-3 col-lg-2">
                                                                <label for="email">Trait</label>
                                                                    <select id="trait-list${trait_id_in}" class="form-control trait_list" onChange="traitCode(this)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        
                                                                        </select>
                                                            </div>
                
                                                            <div  class="mb-3 col-lg-2">
                                                                <label for="subject">category description</label>
                                                                <input type="text" id="subject" value="${trait_cat_desc_int}" class="form-control cat_desc_int"/>
                                                                <input type="hidden" name="trait_code_db[]" value="${trait_code_int}" id='trait_code_in'>
                                                                <input type="hidden" name="trait_cat_code_db[]" value="${trait_cat_in}" id='trait_cat_code_in'>
                                                                <input type="hidden" name="item_trait_main_id_db[]" value="${trait_id_in}">
                                                            </div>
                                                            
                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="subject">&nbsp;</label>
                                                                <input type="text" id="trait_code_de_in" value="${trait_code_int}" class="form-control" disabled/>
                                                            </div>

                                                            <div  class="mb-3 col-lg-3">
                                                                <label for="subject">trait description</label>
                                                                <input type="text" id="trait_desc_in" value="${trait_code_int} - ${trait_desc_int}" class="form-control" readonly/>
                                                            </div>

                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="subject">Weight</label>
                                                                <input type="number" step="0.01" id="weight" name="weight[]" value="${trait_weight}" class="form-control"/>
                                                            </div>
                                                            
                                                            <div class="col-lg-1 align-self-center">
                                                                <div class="d-grid">
                                                                    <input type="button" class="btn btn-primary" onClick='deleteTraitRow(this)' value="Delete"/>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </td>
                                                </tr>`);

                                                catCodeIn(trait_cat_in,trait_id_in,trait_code_int);
                                        }
                                }else{
                                   
                                    $('#tbUser').append(`<tr>   
                                                    <td>
                                                        <div class="row">
                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="name">Tarit Cat</label>
                                                                <input type="text" id="subject" onInput='catCode(this)' class="form-control"/>
                                                            </div>
                
                                                            <div  class="mb-3 col-lg-2">
                                                                <label for="email">Trait</label>
                                                                    <select class="form-control trait_list" onChange="traitCode(this)">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        
                                                                        </select>
                                                            </div>
                
                                                            <div  class="mb-3 col-lg-2">
                                                                <label for="subject">category description</label>
                                                                <input type="text" id="subject" class="form-control cat_desc_int"/>
                                                                <input type="hidden" name="trait_code_db[]" id='trait_code_in'>
                                                                <input type="hidden" name="trait_cat_code_db[]" id='trait_cat_code_in'>
                                                            </div>

                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="subject">&nbsp;</label>
                                                                <input type="text" id="trait_code_de_in" class="form-control" disabled/>
                                                            </div>

                                                            <div  class="mb-3 col-lg-3">
                                                                <label for="subject">trait description</label>
                                                                <input type="text" id="trait_desc_in" class="form-control"/>
                                                            </div>

                                                            <div  class="mb-3 col-lg-1">
                                                                <label for="subject">Weight</label>
                                                                <input type="number" step="0.01" id="weight" name="weight[]" class="form-control"/>
                                                            </div>
                                                            
                                                            <div class="col-lg-1 align-self-center">
                                                                <div class="d-grid">
                                                                    <input type="button" class="btn btn-primary" onClick='deleteTraitRow(this)' value="Delete"/>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </td>
                                                </tr>`);
                                }
                                   
                          }else{
                            $('#item-code-error').html('Invalid item code');
                            $('#tbUser').empty();
                          }
                        }
                    });
                }

                function catCodeIn(ele,trait_id,trt_code) {
                
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('Common/getTraitListbyCode')?>",
                        data: {cat_code:ele},
                        dataType: "Json",
                        success: function(resultData){
                                    let trait_list = resultData.trait_data;
                                    var trait_list_ser = [];

                                    for (let index = 0; index < trait_list.length; index++) {

                                    let trait_name = trait_list[index]['TRAIT_DESC'];
                                    let trait_code = trait_list[index]['TRAIT_SUB_CAT_CODE'];
                                    let sel_trt = trt_code == trait_code?'Selected':null;
                                    $('#trait-list'+trait_id).append(`<option value='`+trait_code+`' data-desc='`+trait_name+`' ${sel_trt}>${trait_code} - ${trait_name}</option>`);
                                    
                            }
                        }
                    });

                }

            </script>