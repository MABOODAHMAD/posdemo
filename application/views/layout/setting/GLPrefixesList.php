
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
                                    <h4 class="mb-sm-0 font-size-18">GL Prefixes</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New GL Prefixes</h5>
                                               
                                            </div>
                                        </div>
                                    <div class="card-body">
                                          <form id="formdata">
                                                <div class="row">
                                                    <div class="row">
                                                        
                                                         <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Choose Business Unit</label>
                                                                    <select class="form-control select2" name="GLP_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?=$glPrefix->GLP_BUS_UNIT==$busUnit['BU_CODE']?'Selected':Null?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="GLP_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Journal Prefix</label>
                                                                    <select class="form-control select2" name="GLP_JOURNAL_PFX" onChange="glPrefixCh(this)">
                                                                        <?php foreach ($glPrefixs as $glPrefixGet):?>
                                                                                <option value="<?=$glPrefixGet->GLP_JOURNAL_PFX?>" orderCount="<?=$glPrefixGet->GLP_NEXT_NUMBER?>" glDesc="<?=$glPrefixGet->GLP_DESC?>" glJorCls="<?=$glPrefixGet->GLP_JOURNAL_CLS?>" notes="<?=$glPrefixGet->GLP_NOTES?>" jourOnline="<?=$glPrefixGet->GLP_ONLINE_JOURNALS?>" printProf="<?=$glPrefixGet->GLP_PRINT_PROOF?>" ap="<?=$glPrefixGet->GLP_AP?>" ar="<?=$glPrefixGet->GLP_AR?>" inv="<?=$glPrefixGet->GLP_INV?>" sf="<?=$glPrefixGet->GLP_SF?>" so="<?=$glPrefixGet->GLP_SO?>" po="<?=$glPrefixGet->GLP_PO?>">
                                                                                    <?=$glPrefixGet->GLP_JOURNAL_PFX?>
                                                                                </option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <!-- <input type="text" class="form-control" name="GLP_JOURNAL_PFX" value="<?=$glPrefix->GLP_JOURNAL_PFX?>" > -->
                                                                    <label id="GLP_JOURNAL_PFX-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Journal CLS</label>
                                                                <input type="text" class="form-control jour-cls" name="GLP_JOURNAL_CLS" value="<?=$glPrefix->GLP_JOURNAL_CLS?>" >
                                                                <label id="GLP_JOURNAL_CLS-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Description</label>
                                                                <input type="text" class="form-control gl-desc" name="GLP_DESC" value="<?=$glPrefix->GLP_DESC?>">
                                                                <label id="GLP_DESC-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Number</label>
                                                                <input type="text" class="form-control order-count" name="GLP_NEXT_NUMBER" value="<?=$glPrefix->GLP_NEXT_NUMBER?>" >
                                                                <label id="GLP_NEXT_NUMBER-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                         <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Journals Online</label>
                                                                    <input type="checkbox" name="GLP_ONLINE_JOURNALS" id="GLP_ONLINE_JOURNALS" switch="bool" value='Y' <?=$glPrefix->GLP_ONLINE_JOURNALS=='Y'?'Checked':Null?>/>
                                                                    <label for="GLP_ONLINE_JOURNALS" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Print Proof</label>
                                                                    <input type="checkbox" name="GLP_PRINT_PROOF" id="GLP_PRINT_PROOF" switch="bool" value='Y' <?=$glPrefix->GLP_PRINT_PROOF=='Y'?'Checked':Null?>/>
                                                                    <label for="GLP_PRINT_PROOF" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">AP</label>
                                                                    <input type="checkbox" name="GLP_AP" id="GLP_AP" switch="bool" value='Y' <?=$glPrefix->GLP_AP=='Y'?'Checked':Null?>/>
                                                                    <label for="GLP_AP" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">AR</label>
                                                                    <input type="checkbox" name="GLP_AR" id="GLP_AR" switch="bool" value='Y' <?=$glPrefix->GLP_AR=='Y'?'Checked':Null?>/>
                                                                    <label for="GLP_AR" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Inv</label>
                                                                    <input type="checkbox" name="GLP_INV" id="GLP_INV" switch="bool" value='Y' <?=$glPrefix->GLP_INV=='Y'?'Checked':Null?>/>
                                                                    <label for="GLP_INV" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">SF</label>
                                                                    <input type="checkbox" name="GLP_SF" id="GLP_SF" switch="bool" value='Y' <?=$glPrefix->GLP_SF=='Y'?'Checked':Null?>/>
                                                                    <label for="GLP_SF" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        
                                                         <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">SO</label>
                                                                    <input type="checkbox" name="GLP_SO" id="GLP_SO" switch="bool" value='Y' <?=$glPrefix->GLP_SO=='Y'?'Checked':Null?>/>
                                                                    <label for="GLP_SO" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">PO</label>
                                                                    <input type="checkbox" name="GLP_PO" id="GLP_PO" switch="bool" value='Y' <?=$glPrefix->GLP_PO=='Y'?'Checked':Null?>/>
                                                                    <label for="GLP_PO" data-on-label="Yes" data-off-label="No"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Notes</label>
                                                               <input type="text" class="form-control notes" name="GLP_NOTES" value="<?=$glPrefix->GLP_NOTES?>" placeholder="Enter Notes">
                                                                <label id="GLP_NOTES-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <div>
                                                    <button data-aftreload="true" data-control="master/gl-prefixes-update" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->GLPrifAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->GLPrifAdd->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type='button'>Update GL Prefixes</button>
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" name="GL_PREFIX_DB" id="gl-prefix-db" value="<?=$glPrefix->GLP_JOURNAL_PFX?>">
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
                    
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                
                
            <script>
                function glPrefixCh(ele) {
                    let order_count = $(ele).find('option:selected');
                    window.orderCount = order_count.attr("orderCount");
                    window.glDesc = order_count.attr("glDesc");
                    window.glJorCls = order_count.attr("glJorCls");
                    window.notes = order_count.attr("notes");
                    window.jourOnline = order_count.attr("jourOnline");
                    window.printProf = order_count.attr("printProf");
                    window.ap = order_count.attr("ap");
                    window.ar = order_count.attr("ar");
                    window.inv = order_count.attr("inv");
                    window.sf = order_count.attr("sf");
                    window.so = order_count.attr("so");
                    window.po = order_count.attr("po");
                    
                    jourOnline == 'N'?$('#GLP_ONLINE_JOURNALS').attr('Checked',false):$('#GLP_ONLINE_JOURNALS').attr('Checked',true);
                    printProf == 'N'?$('#GLP_PRINT_PROOF').attr('Checked',false):$('#GLP_PRINT_PROOF').attr('Checked',true);
                    ap == 'N'?$('#GLP_AP').attr('Checked',false):$('#GLP_AP').attr('Checked',true);
                    ar == 'N'?$('#GLP_AR').attr('Checked',false):$('#GLP_AR').attr('Checked',true);
                    inv == 'N'?$('#GLP_INV').attr('Checked',false):$('#GLP_INV').attr('Checked',true);
                    sf == 'N'?$('#GLP_SF').attr('Checked',false):$('#GLP_SF').attr('Checked',true);
                    so == 'N'?$('#GLP_SO').attr('Checked',false):$('#GLP_SO').attr('Checked',true);
                    po == 'N'?$('#GLP_PO').attr('Checked',false):$('#GLP_PO').attr('Checked',true);
                    $('.order-count').val(orderCount);
                    $('.gl-desc').val(glDesc);
                    $('.jour-cls').val(glJorCls);
                    $('.notes').val(notes);
                    $('#gl-prefix-db').val(ele.value);
                    // $('.voch-pre').empty();
                    // $('.voch-pre').append(`<option value="" selected disabled>Select Type</option>`);
                    // $('.voch-pre').append(`<option value="P${whse_code}" vochPreCount="${oldInvCount}">P${whse_code}</option>`);
                    // $('.voch-pre').append(`<option value="C${whse_code}" vochPreCount="${advPayCount}">C${whse_code}</option>`);
                    // $('.voch-pre').append(`<option value="D${whse_code}" vochPreCount="${debitMemoCount}">D${whse_code}</option>`);
                    
                }
            </script>
            


        