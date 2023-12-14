
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
                                    <h4 class="mb-sm-0 font-size-18">ADD Customer</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Customer</h5>
                                                <div class="flex-shrink-0">
                                                    <a href="<?=base_Url()?>CustomerList" class="btn btn-primary" >Customer List</a>
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
                                                                <label for="validationCustom03" class="form-label">Code</label>
                                                                    <input type="text" class="form-control" name="SS_ID" value="<?=$systemData->SS_ID?>" disabled>
                                                                    <label id="SS_ID-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">TRN NO</label>
                                                                    <input type="text" class="form-control" name="SS_TRN" placeholder="Customer Name " value="<?=$systemData->SS_TRN?>">
                                                                    <label id="SS_TRN-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Currency</label>
                                                                    <select class="form-control select2" name="SS_CURRENCY">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($currencyLists as $currencyList):?>
                                                                                <option value="<?=$currencyList['CUR_ABBRV']?>" <?= $systemData->SS_CURRENCY == $currencyList['CUR_ABBRV']?'selected':null;?>><?=$currencyList['CUR_CODE'].'-'.$currencyList['CUR_NAME']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="SS_CURRENCY-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Time Zone</label>
                                                                    <select class="form-control select2" name="SS_TIME_ZONE">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($timeZone as $timeZoneGet):?>
                                                                                <option value="<?=$timeZoneGet->TZ_FUNC_NAME?>" <?=$systemData->SS_TIME_ZONE == $timeZoneGet->TZ_FUNC_NAME?'selected':null;?>><?=$timeZoneGet->TZ_NAME?> timestamp : <?php date_default_timezone_set($timeZoneGet->TZ_FUNC_NAME); echo date('Y-m-d H:i:s');?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="SS_TIME_ZONE-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Vat(%)</label>
                                                                    <select class="form-control select2" name="SS_VAT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php for ($i=1; $i <= 100 ; $i++) {?>
                                                                            <option value="<?=$i?>" <?= $systemData->SS_VAT == $i?'selected':null;?>><?=$i?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                <label id="SS_VAT-error" class="error"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom05" class="form-label">Default Business Unit</label>
                                                                    <select class="form-control select2" name="SS_BUS_UNIT">
                                                                        <option value='' Selected disabled>Select</option>
                                                                        <?php foreach ($busUnits as $busUnit):?>
                                                                                <option value="<?=$busUnit['BU_CODE']?>" <?= $systemData->SS_BUS_UNIT == $busUnit['BU_CODE']?'selected':null;?>><?=$busUnit['BU_NAME1']?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                <label id="SS_BUS_UNIT-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                <div>
                                                    <button data-aftreload="true" data-control="master/system-setting-update-db" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->systemUpdate->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->systemUpdate->cont?>" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Setting Update</button>
                                                    <!-- <button data-control="parties/customre-add-db" data-form="formdata" data-sweetalert="<?=$sweetAlertMsg->custAdd->msg?>" data-sweetalertcontrol="<?=$sweetAlertMsg->custAdd->cont?>" data-aftreload="true" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Customer</button> -->
                                                </div>
                                                <span id="outmsg"></span>
                                                <input type="hidden" name="cust_retuen_type" value="M">
                                                <input type="hidden" value="<?=$systemData->SS_ID?>" name="system_id_db">
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

        