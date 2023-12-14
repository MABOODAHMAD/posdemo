
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
                                    <h4 class="mb-sm-0 font-size-18">Items Stock Query for Stores Managers</h4>
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
                                                <h5 class="mb-0 card-title flex-grow-1">Add New Inventory</h5>
                                               
                                            <div class="flex-shrink-0">
                                                <a href="<?=base_Url()?>InventoryList" class="btn btn-primary" >View Inventory List</a>
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
                                                                <label for="validationCustom03" class="form-label">Item Code </label>
                                                                    <input type="text" class="form-control" name="V_CODE" placeholder="Enter Items Code ">
                                                                    <label id="V_CODE-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                           <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Status</label>
                                                                    <select class="form-select" name="item_status">
                                                                        <option value="1">Open</option>
                                                                        <option value="0">Close</option>
                                                                    </select>
                                                                    <label id="V_NAME_AR-error" class="error"></label>
                                                  </div>
                                                        </div>
                                                         <div class="col-md-2">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Revision Date</label>
                                                                    	<input class="form-control" type="date" name="item_rev_date" value="2022-11-30">
                                                                    <label id="V_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">UOM</label>
                                                                    <input type="text" class="form-control" name="V_NAME_AR" >
                                                                    <label id="V_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Description </label>
                                                                    <input type="text" class="form-control" name="V_CODE" placeholder="Description ">
                                                                    <label id="V_CODE-error" class="error"></label>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Item Class</label>
                                                                    	<input class="form-control" type="text" name="Item Class">
                                                                    <label id="V_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Item Desc</label>
                                                                    <input type="text" class="form-control" name="Item Desc" >
                                                                    <label id="V_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                        <!--    <div class="mb-3">-->
                                                        <!--        <label for="validationCustom03" class="form-label">&nbsp;</label>-->
                                                        <!--          <div class="form-check mb-3">-->
                                                        <!--    <input class="form-check-input" type="checkbox" id="formCheck1">-->
                                                        <!--    <label class="form-check-label" for="formCheck1">Hold Flag</label>-->
                                                        <!--</div>-->
                                                        <!--    </div>-->
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        <div class="col-md-4">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">secondry Desc</label>
                                                                    	<input class="form-control" type="text" name="item_rev_date">
                                                                    <label id="V_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                <label for="validationCustom03" class="form-label">Item Catogory</label>
                                                                    	<input class="form-control" type="text" name="item_rev_date">
                                                                    <label id="V_NAME-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">catogory Desc</label>
                                                                    <input type="text" class="form-control" name="V_NAME_AR" >
                                                                    <label id="V_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Price</label>
                                                                    <input type="text" class="form-control" name="V_NAME_AR" >
                                                                    <label id="V_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <!--  <div class="card-body border-bottom" style="margin-bottom: 20px;">-->
                                                        <!--    <div class="d-flex align-items-center">-->
                                                        <!--        <h5 class="mb-0 card-title flex-grow-1"><i class="mdi mdi-arrow-right text-primary"></i>Currency and Price List</h5>-->
                                                        <!--    </div>-->
                                                        <!--</div> -->
                                                        
                                                        
                                                        <!--<div class="col-md-6">-->
                                                        <!--	<div class="mb-3 row">-->
                                                        	    
                                                        	    
                                                        <!--    <div class="col-md-12">-->
                                                        <!--    <div class="mb-3">-->
                                                        <!--        <label for="validationCustom03" class="form-label">Currency</label>-->
                                                        <!--            	<input class="form-control" type="text" name="item_rev_date" placeholder="SAR">-->
                                                        <!--            <label id="V_NAME-error" class="error"></label>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        
                                                        <!--<div class="col-md-12">-->
                                                        <!--    <div class="mb-3">-->
                                                        <!--        <label for="validationCustom03" class="form-label">Exchange Rate</label>-->
                                                        <!--            	<input class="form-control" type="text" name="item_rev_date" placeholder="USD">-->
                                                        <!--            	<span class="text-muted">1 USD = [?] SAR</span>-->
                                                        <!--            <label id="V_NAME-error" class="error"></label>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        
                                                        <!--</div>-->
                                                        <!--</div>-->
                                                        
                                                        <!--<div class="col-md-6">-->
                                                        <!--	<div class="mb-3 row">-->
                                                        
                                                        <!--<div class="col-md-12">-->
                                                        <!--    <div class="mb-3">-->
                                                                
                                                        <!--        <label for="validationCustom03" class="form-label">Price List</label>-->
                                                        <!--            <input type="text" class="form-control" name="V_NAME_AR" placeholder="US$" >-->
                                                        <!--            <label id="V_NAME_AR-error" class="error"></label>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        
                                                        <!--<div class="col-md-12">-->
                                                        <!--    <div class="mb-3">-->
                                                                
                                                        <!--        <label for="validationCustom03" class="form-label">Price List Currency</label>-->
                                                        <!--            <input type="text" class="form-control" name="V_NAME_AR"  placeholder="USD">-->
                                                        <!--            <label id="V_NAME_AR-error" class="error"></label>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <!-- <div class="col-md-8">-->
                                                        <!--    <div class="mb-3">-->
                                                                
                                                        <!--        <label for="validationCustom03" class="form-label">Price List Exchange Rate</label>-->
                                                        <!--            <input type="text" class="form-control" name="V_NAME_AR" placeholder="3.75">-->
                                                        <!--            <span class="text-muted">1 USD = [?] SAR</span>-->
                                                        <!--            <label id="V_NAME_AR-error" class="error"></label>-->
                                                        <!--    </div>-->
                                                        <!--    </div>-->
                                                        <!--   <div class="col-md-4"> -->
                                                        <!--    <div class="mb-3">-->
                                                        <!--        <label for="validationCustom03" class="form-label">&nbsp;</label>-->
                                                        <!--          <div class="form-check mb-3">-->
                                                        <!--    <input class="form-check-input" type="checkbox" id="formCheck1">-->
                                                        <!--    <label class="form-check-label" for="formCheck1">Ignore Pricing Rule</label>-->
                                                        <!--</div>-->
                                                        <!--    </div>-->
                                                        <!--</div>-->
                                                        <!--</div>-->
                                                        
                                                        <!--</div>-->
                                                        
                                                         <h5 class="font-size-14 card-body border-bottom"><i class="mdi mdi-arrow-right text-primary"></i> Item Line</h5>

                                                       
                                                       
                                                       <div class="col-xl-12">
                                	<div class="form-row">
    						<div style="overflow-x:auto; overflow-y:hidden; /* white-space:nowrap; */ margin:0 10px;" class="ftable col-md-12">
    							<table id="productable" class="table table-hover table-striped table-bordered">
    								<thead>
    									<tr>
    										<th width="5%">Sn.</th>
    										<!-- <th width="5%">Brand</th> -->
    										<th width="5%">Whse</th>
    										<th width="20%">Description</th>
    										<!-- <th width="8%">Hsn</th> -->
    										<!-- <th width="5%">Avl. Qty</th> -->
    										<th width="15%">Status</th>
    										<th width="15%">On Hand</th>
    										<th class="d-none" width="5%">Tkn. Qty</th>
    										<!-- <th width="10%">List Price</th> -->
    										<th width="10%">Allocated</th>
    										<!--<th class="d-none" width="10%">Reserved</th>-->
    										<th width="10%">Reserved</th>
    										<th width="10%">Available</th>
    										<!--<th width="10%">Total before VAT</th>-->
    										<!--<th width="10%">VAT</th>-->
    										 <th width="15%">Sub Toal</th> 
    										<!--<th width="5%">Del.</th>-->
    									</tr>
    								</thead>
    								<tbody>
    									<tr>
    										<td width="5%">1
    										 </td>
    										<td width="10%"><input type="text" class="form-control" name="V_CODE" placeholder="text ">
    										</td>
    										<td width="20%"><input type="text" class="form-control" name="V_CODE" placeholder="text ">
    										</td>
    										<td width="5%">
    										<input class="form-control" type="text" name="item_rev_date">
    											<input type="hidden" id="opt11" value="*">
    											<input type="hidden" id="uqty11" value="12"> </td>
    										<td width="20%">
    										   <input class="form-control" type="text" name="item_rev_date"> </td>
    										<td class="d-none" width="5%"><span class="gqty" id="tknqty11">1</span> </td>
    										<td width="10%">
    											<input class="form-control" type="text" name="item_rev_date">
    										<td width="100%">
    											<input class="form-control" type="text" name="item_rev_date">
    											<!--<select class="select_dis" id="dis_cat11" name="dis_cat">-->
    											<!--	<option value="flat">RS </option>-->
    											<!--	<option value="per">%</option>-->
    											<!--</select>-->
    										</td>
    										<td width="10%">
    										    <input class="form-control" type="text" name="item_rev_date"> </td>
    										<td width="15%">
    										    <input class="form-control" type="text" name="item_rev_date">
    										    </td>
    										<!--<td width="10%"> <span></span>-->
    										<!--	<select class="tax_select" id="tax_per11" name="tax_per[]">-->
    										<!--		<option value="15">15%</option> A PHP Error was encountered Severity: Warning Message: Use of undefined constant pro - assumed 'pro' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Warning Message: Use of undefined constant taxperc - assumed 'taxperc' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Notice Message: Undefined variable: protaxperc Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once-->
    										<!--		<option value="15">15%</option> A PHP Error was encountered Severity: Warning Message: Use of undefined constant pro - assumed 'pro' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Warning Message: Use of undefined constant taxperc - assumed 'taxperc' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Notice Message: Undefined variable: protaxperc Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once-->
    										<!--		<option value="5">5%</option> A PHP Error was encountered Severity: Warning Message: Use of undefined constant pro - assumed 'pro' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Warning Message: Use of undefined constant taxperc - assumed 'taxperc' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Notice Message: Undefined variable: protaxperc Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once-->
    										<!--		<option value="12">12%</option> A PHP Error was encountered Severity: Warning Message: Use of undefined constant pro - assumed 'pro' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Warning Message: Use of undefined constant taxperc - assumed 'taxperc' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Notice Message: Undefined variable: protaxperc Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once-->
    										<!--		<option value="18">18%</option> A PHP Error was encountered Severity: Warning Message: Use of undefined constant pro - assumed 'pro' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Warning Message: Use of undefined constant taxperc - assumed 'taxperc' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Notice Message: Undefined variable: protaxperc Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once-->
    										<!--		<option value="28">28%</option>-->
    										<!--	</select>-->
    										<!--</td>-->
    										<!--<td width="5%"><i id="11" class="delete fa fa-trash"></i></td>-->
    									</tr>
    									<tr>
    										<td width="5%">2
    										 </td>
    										<td width="10%"><input type="text" class="form-control" name="V_CODE" placeholder="text "></td>
    										<td width="20%"><input type="text" class="form-control" name="V_CODE" placeholder="text "></td>
    										<td width="5%">
    											<input class="form-control" type="text" name="item_rev_date">
    											<input type="hidden" id="opt10" value="*">
    											<input type="hidden" id="uqty10" value="1"> </td>
    										<td width="20%">
    										   <input class="form-control" type="text" name="item_rev_date"> </td>
    										<td class="d-none" width="5%"><span class="gqty" id="tknqty10">1</span> </td>
    										<td width="10%">
    											<input class="form-control" type="text" name="item_rev_date"> </td>
    										<td width="100%">
    											<input class="form-control" type="text" name="item_rev_date">
    											<!--<select class="select_dis" id="dis_cat10" name="dis_cat">-->
    											<!--	<option value="flat">RS </option>-->
    											<!--	<option value="per">%</option>-->
    											<!--</select>-->
    										</td>
    										<td width="10%">
    										    <input class="form-control" type="text" name="item_rev_date"> </td>
    										<td width="10%"><input class="form-control" type="text" name="item_rev_date"></td>
    										<!--<td width="10%"> <span></span>-->
    										<!--	<select class="tax_select" id="tax_per10" name="tax_per[]">-->
    										<!--		<option value="15">15%</option> A PHP Error was encountered Severity: Warning Message: Use of undefined constant pro - assumed 'pro' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Warning Message: Use of undefined constant taxperc - assumed 'taxperc' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Notice Message: Undefined variable: protaxperc Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once-->
    										<!--		<option value="15">15%</option> A PHP Error was encountered Severity: Warning Message: Use of undefined constant pro - assumed 'pro' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Warning Message: Use of undefined constant taxperc - assumed 'taxperc' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Notice Message: Undefined variable: protaxperc Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once-->
    										<!--		<option value="5">5%</option> A PHP Error was encountered Severity: Warning Message: Use of undefined constant pro - assumed 'pro' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Warning Message: Use of undefined constant taxperc - assumed 'taxperc' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Notice Message: Undefined variable: protaxperc Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once-->
    										<!--		<option value="12">12%</option> A PHP Error was encountered Severity: Warning Message: Use of undefined constant pro - assumed 'pro' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Warning Message: Use of undefined constant taxperc - assumed 'taxperc' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Notice Message: Undefined variable: protaxperc Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once-->
    										<!--		<option value="18">18%</option> A PHP Error was encountered Severity: Warning Message: Use of undefined constant pro - assumed 'pro' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Warning Message: Use of undefined constant taxperc - assumed 'taxperc' (this will throw an Error in a future version of PHP) Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once A PHP Error was encountered Severity: Notice Message: Undefined variable: protaxperc Filename: inven/newpurchaseorder.php Line Number: 993 Backtrace: File: /home/erpwala/public_html/soft/application/views/inven/newpurchaseorder.php Line: 993 Function: _error_handler File: /home/erpwala/public_html/soft/application/controllers/Inven.php Line: 742 Function: view File: /home/erpwala/public_html/soft/index.php Line: 315 Function: require_once-->
    										<!--		<option value="28">28%</option>-->
    										<!--	</select>-->
    										<!--</td>-->
    										<!--<td width="5%"><i id="10" class="delete fa fa-trash"></i></td>-->
    									</tr>
    								</tbody>
    							</table>
    						</div>
    						
    						</div>
    					</div>
    						  <!--<h5 class="font-size-14 card-body border-bottom"><i class="mdi mdi-arrow-right text-primary"></i> Extra Charges</h5>-->
    						                          <div class="col-md-2"> </div>
    						                          <div class="col-md-2"> </div>
    						                          <div class="col-md-2"> </div>
                                        
    						                          <div class="col-md-2">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Total Allocated</label>
                                                                    <input type="text" class="form-control" name="V_NAME_AR" >
                                                                    <label id="V_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Total Reserved</label>
                                                                    <input type="text" class="form-control" name="V_NAME_AR" >
                                                                    <label id="V_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="mb-3">
                                                                
                                                                <label for="validationCustom03" class="form-label">Total Available</label>
                                                                    <input type="text" class="form-control" name="V_NAME_AR" >
                                                                    <label id="V_NAME_AR-error" class="error"></label>
                                                            </div>
                                                        </div>
    						  
        <!--						  <div class="col-md-6">-->
        						      
        <!--                            <div class="mb-3">-->
        <!--                            <label for="validationCustom03" class="form-label">FOB Charges</label>-->
        <!--                            </div>-->
                                           
        <!--                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered">-->
        <!--<tr>-->
        <!--<td>&nbsp;</td>-->
        <!--<td>FOB</td>-->
        <!--<td>Amount</td>-->
        <!--<td>Amount ( SAR )</td>-->
        <!--<td>&nbsp;</td>-->
        <!--</tr>-->
        <!--<tr>-->
        <!--<td>&nbsp;</td>-->
        <!--<td>shipping</td>-->
        <!--<td>500</td>-->
        <!--<td>500</td>-->
        <!--<td>&nbsp;</td>-->
        <!--</tr>-->
        <!--</table>-->
        
        <!--<div class="col-md-8">-->
        <!--                                                        <div class="mb-3">-->
                                                                    
        <!--                                                            <label for="validationCustom03" class="form-label">Total FOB Charges</label>-->
        <!--                                                                <input type="text" class="form-control" name="V_NAME_AR" placeholder="500.00">-->
        <!--                                                                <span class="text-muted">1 USD = [?] SAR</span>-->
        <!--                                                                <label id="V_NAME_AR-error" class="error"></label>-->
        <!--                                                        </div>-->
        <!--                                                        </div>-->
        <!--                                </div>-->
                                        
        <!--                          <div class="col-md-6">-->
        <!--                                    <div class="mb-3">-->
        <!--                            <label for="validationCustom03" class="form-label">Extra Charges</label>-->
        <!--                            </div>-->
        <!--                                   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-hover table-striped table-bordered">-->
        <!--<tr>-->
        <!--<td>&nbsp;</td>-->
        <!--<td>Purchase Charges</td>-->
        <!--<td>Amount</td>-->
        
        <!--<td>&nbsp;</td>-->
        <!--</tr>-->
        <!--<tr>-->
        <!--<td>&nbsp;</td>-->
        <!--<td>Freight and Forwarding Charges</td>-->
        <!--<td>400.00</td>-->
        
        <!--<td>&nbsp;</td>-->
        <!--</tr>-->
        <!--</table>-->
        
        <!--<div class="col-md-8">-->
        <!--                                                        <div class="mb-3">-->
                                                                    
        <!--                                                            <label for="validationCustom03" class="form-label">Total Extra Charges</label>-->
        <!--                                                                <input type="text" class="form-control" name="V_NAME_AR" placeholder="400.00">-->
        <!--                                                                <span class="text-muted">1 USD = [?] SAR</span>-->
        <!--                                                                <label id="V_NAME_AR-error" class="error"></label>-->
        <!--                                                        </div>-->
        <!--                                                        </div>-->
        <!--                                </div>-->
                                                            
                                                        
                                    
        <!--                        <div class="col-xl-12">                        	    -->
                                                        	    
    				<!--		<div class="col-md-12">-->
    				<!--			<table width="100%" class="table table-bordered" >-->
    				<!--				<tbody>-->
    				<!--					<tr>-->
    				<!--						<td width="80%" align="right" style="" id="select_order_type"> <span style="float:right;"><div class="position-relative form-check form-check-inline"> <label class="form-check-label"><input type="radio" name="purch_inv" value="p_order" class="form-check-input"> Purchase Order </label> </div> <div class="position-relative form-check form-check-inline"> <label class="form-check-label"><input type="radio" name="purch_inv" value="p_invoice" class="form-check-input" checked=""> Purchase Invoice</label> </div><span> </span></span>-->
    				<!--						</td>-->
    				<!--						<td width="20%" align="left">&nbsp;</td>-->
    				<!--					</tr>-->
    				<!--					<tr>-->
    				<!--						<td width="80%" align="right"><b>Total Qty:</b> </td>-->
    				<!--						<td width="20%" align="left"><span id="gqty">2</span></td>-->
    				<!--					</tr>-->
    				<!--					<tr>-->
    				<!--						<td width="80%" align="right"><b>Subtol:</b> </td>-->
    				<!--						<td width="20%" align="left">RS <span id="gsubtol">131.00</span></td>-->
    				<!--					</tr>-->
    									<!-- strt -->
    				<!--					<tr>-->
    				<!--						<td width="80%" align="right"><b>Total Tax:</b> </td>-->
    				<!--						<input type="hidden" name="gtoltax" id="gtoltaxid" value="217.65">-->
    				<!--						<td width="20%" align="left">RS <span id="gtoltax">217.65</span></td>-->
    				<!--					</tr>-->
    									<!-- end -->
    									<!-- <tr style="display:none;"> -->
    				<!--					<tr>-->
    				<!--						<td width="80%" align="right"><b>Grand Total:</b> </td>-->
    				<!--						<td width="20%" align="left">RS <span id="gtol">348.65</span> </td>-->
    				<!--					</tr>-->
    				<!--				</tbody>-->
    				<!--			</table>-->
    				<!--		</div>-->
    				<!--	</div>-->
                            
                           
                                                    </div>
                                                <!--<div>-->
                                                <!--    <button data-control="parties/vendor-add" data-form="formdata" class="ajaxform btn btn-success waves-effect waves-light" type="submit">Add Purchase</button>-->
                                                <!--</div>-->
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
<script>
   
    function classLists(ele) {
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getClassDescbyCode')?>",
            data: {class_code:ele.value},
            dataType: "Json",
            success: function(resultData){
                if(resultData.length>0){
                    $('#class_desc_in').val(resultData[0]['IC_DESC']);
                }else{
                    $('#class_desc_in').val('');
                }
            }
        });
    }

    function catList(ele) {
        $.ajax({
            type: "POST",
            url: "<?=base_url('Common/getCatDescbyCode')?>",
            data: {cat_code:ele.value},
            dataType: "Json",
            success: function(resultData){
                if(resultData.length>0){
                    $('#cat_desc_in').val(resultData[0]['ICAT_DESC']);
                }else{
                    $('#cat_desc_in').val('');
                }
            }
        });
    }

</script>
        