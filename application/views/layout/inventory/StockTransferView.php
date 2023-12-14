
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
                                    <h4 class="mb-sm-0 font-size-18">Transfer Order View</h4>
                                    <div class="page-title-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        
                        <div class="row">
                            <div class="col-xl-12">
                                
                                
                                <div class="card" style="-webkit-box-shadow: unset;">
                                    <div class="card-body">
                                        <div class="invoice-title">
                                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="50%" align="left" style="padding: 0rem 1.25rem;">
                                                    <div class="mb-4">
                                                        <img src="assets/images/logo-dark.png" alt="logo" height="40px">
                                                    </div>
                                                </td>
                                                <td width="50%" align="right" style="padding: 0rem 1.25rem;">
                                                    <h4 class="float-end font-size-16">Order #<?=$stockTransferOrderDets[0]->STH_ORDER_NO?></h4>
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                       
                                        <div class="row">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0">

                                                <tr>
                                                    <!-- <td style="padding: 0rem 1.25rem;"></td> -->
                                                    <td style="padding: 0rem 1.25rem;"><strong>Created By and DateTime</strong><br>
                                                    <?=$stockTransferOrderDets[0]->STH_CRE_BY?>-<?=date("d M Y h:i A", strtotime($stockTransferOrderDets[0]->STH_CRE_DATE))?></td>
                                                    <td width="25%" align="right" style="padding: 0rem 1.25rem;"><strong>Transfer Status:</strong><br><?=$stockTransferOrderDets[0]->STH_STATUS?></td>
                                                </tr>
                                                <tr>
                                                    <!-- <td width="25%" style="padding: 0rem 1.25rem;"><strong>Transfer Status:</strong><br><?=$stockTransferOrderDets[0]->STH_STATUS?></td> -->
                                                    <td width="25%" style="padding: 0rem 1.25rem;"><strong>Order Date:</strong><br><?=date('d-M Y', strtotime($stockTransferOrderDets[0]->STH_TRANS_DATE))?></td>
                                                    <td width="25%" align="right" style="padding: 0rem 1.25rem;"><strong>Reason</strong><br>
                                                    <?=$stockTransferOrderDets[0]->TR_TRANS_RSN.'-'.$stockTransferOrderDets[0]->TR_DESC?> </td>
                                                </tr>
                                        
                                                <tr>
                                                    <td style="padding: 0rem 1.25rem;"><strong>From Warehouse</strong><br> <?=$wharehouseFrom->WHSE_DESC?></td>
                                                    <td align="right" style="padding: 0rem 1.25rem;"><strong>To Warehouse</strong><br>
                                                    <?=$wharehouseto->WHSE_DESC?></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 0rem 1.25rem;" class="<?=$stockTransferOrderDets[0]->STH_PRINT_BY?NULL:'d-none'?>"><strong>Print By and DateTime</strong><br>
                                                    <?=$stockTransferOrderDets[0]->STH_PRINT_BY?>-<?=date("d M Y h:i A", strtotime($stockTransferOrderDets[0]->STH_PRINT_DATETIME))?></td>
                                                    <td align="right" style="padding: 0rem 1.25rem;" class="<?=$stockTransferOrderDets[0]->STH_RECEIVED_BY?NULL:'d-none'?>"><strong>Post By and DateTime</strong><br>
                                                    <?=$stockTransferOrderDets[0]->STH_RECEIVED_BY?>-<?=date("d M Y h:i A", strtotime($stockTransferOrderDets[0]->STH_RECEIVED_DATETIME))?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        
                                      <div class="row"></div>
 
 
                                        
                                        <div class="py-2 mt-3">
                                            <h3 class="font-size-15 fw-bold">Order summary</h3>
                                        </div>
                                        <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th width="1%">Sn.</th>
                                                    <th width="10%">Rule</th>
                                                    <th width="5%">Item No</th>
                                                    <th width="15%">Description</th>
                                                    <th width="15%">Vendor Item Code</br>Vendor Code</th>
                                                    <th width="2%">Qty</th>
                                                    <th width="5%">Unit saling Price</th>
                                                    <th width="5%">Final Price</th>
                                                    <!--<th width="10%">Distribution Amount in SAR</th>-->
                                                    <!-- <th width="100%">Final Price</th> -->
                                                </tr>
                                            </thead>
                                            <tbody id="tbUser">
                                                <?php $sn = null; foreach($stockTransferOrderDets as $stockTransferOrderDet): $sn++;?>
                                                <tr>
                                                    <td width="1%"><?=$sn?></td>
                                                    <td width="10%"><?=$stockTransferOrderDet->TRULE_TRANS_RULE.'-'.$stockTransferOrderDet->TRULE_DESC?></td>
                                                    <td width="5%"><?=$stockTransferOrderDet->I_CODE?></td>
                                                    <td width="15%"><span id="i-desc"><?=$stockTransferOrderDet->I_DESC?></span> <br>
                                                        <span id="i-ext-desc"><?=$stockTransferOrderDet->I_EXTEND_DESC?></span>
                                                    </td>
                                                    <td width="15%"><span id="i-desc"><?=$stockTransferOrderDet->VEN_I_CODE?></span> <br>
                                                        <span id="i-ext-desc"><?=$stockTransferOrderDet->VEN_CODE?></span></td>
                                                    <td width="2%"><?=$stockTransferOrderDet->STD_TRANS_QTY?></td>
                                                    <td width="5%"><?=numberSystem($stockTransferOrderDet->STD_UNIT_LIST_PRICE,1)?></td>
                                                    <td width="5%"><?=numberSystem($stockTransferOrderDet->STD_UNIT_LIST_PRICE*$stockTransferOrderDet->STD_TRANS_QTY,1)?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
																		
																		<div class="col-xl-12 row">   
                                                            
                                   
                                                            
                                                                <div class="col-md-12">
                                                                    <table width="100%" class="table table-bordered">
                                                                        <tbody>
                                                                            
                                                                            <tr>
                                                                                <td width="25%" align="right"><b>Total Qty:</b> </td>
                                                                                <td width="15%" align="left"><span id="tot-qty"><?=$stockTransferOrderDets[0]->STH_TOT_QTY?></span></td>
                                                                                <td width="20%" align="right"><b>Grand Total:</b> </td>
                                                                                <td width="40%" align="left" style="font-size: 0.8cm;font-weight: bold;"><span id="grand-tot"><?=numberSystem($stockTransferOrderDets[0]->STH_GRAND_TOT,1)?></span></td>
                                                                            </tr>
                                                          
                                                                        </tbody>
                                                                    </table>
                                                                </div>
																<div class="col-md-12 row" style="border-bottom: black 5px solid;">
																<table width="100%" class="table table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width="30%" align="right"><div align="center"><b>Showroom Manager</b> </div></td>
                                                                            <td width="30%" align="left"><div align="center"><strong><span id="tot-qty">Receiver</span></strong></div></td>
                                                                            <td width="30%" align="right"><div align="center"><b>Account:</b> </div></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            <div>
                                                        </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                        <form id="formdata">
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <?php if(dashRole(["role_check"=>"INVENTORY_PRINT_BY_COST_STOCK_TRANSFER"])){?>
                                                        <a href="<?=base_url("inventory/stockTransferPrint?orderid={$pOrderId}&type=".dataEncyptbase64('COST','encrypt')."")?>" target="_blank" class="btn btn-success waves-effect waves-light me-1">
                                                            <i class="fa fa-print"></i> By Cost
                                                        </a>
                                                    <?php } if(dashRole(["role_check"=>"INVENTORY_PRINT_BY_PRICE_STOCK_TRANSFER"])){?>
                                                    <a href="<?=base_url("inventory/stockTransferPrint?orderid={$pOrderId}&type=".dataEncyptbase64('PRICE','encrypt')."")?>" target="_blank" class="btn btn-success waves-effect waves-light me-1">
                                                        <i class="fa fa-print"></i> By Price
                                                    </a>
                                                    <?php }if($stockTransferOrderDets[0]->TR_TRANS_RSN == '200' && $stockTransferOrderDets[0]->STH_STATUS == 'ORDER'){ ?>
                                                        <a onClick="check('Post')" class="btn btn-primary w-md waves-effect waves-light">Post</a>
                                                    <?php }elseif($stockTransferOrderDets[0]->TR_TRANS_RSN == '201' && ($stockTransferOrderDets[0]->STH_STATUS == 'ORDER' || $stockTransferOrderDets[0]->STH_STATUS == 'IN-TRANSIT')){ 
                                                        if ($sesData->USER_TYPE == 'USER') {
                                                            $fromOrderCheck = $toOrderCheck = FALSE;
                                                            foreach ($whse_assign as $whse_assignGet) {
                                                                if($stockTransferOrderDets[0]->STH_FROM_WHSE == $whse_assignGet->SMSW_WHSE_CODE){
                                                                        $fromOrderCheck = TRUE;
                                                                }elseif ($stockTransferOrderDets[0]->STH_WHSE_TO == $whse_assignGet->SMSW_WHSE_CODE) {
                                                                        $toOrderCheck = TRUE;
                                                                }
                                                            }
                                                            
                                                            if($stockTransferOrderDets[0]->STH_STATUS == 'ORDER' && $fromOrderCheck){
                                                    ?>
                                                        <a onClick="check('<?=$stockTransferOrderDets[0]->STH_STATUS == 'ORDER'?'Print':'Post'?>')" class="btn btn-primary w-md waves-effect waves-light"><?=$stockTransferOrderDets[0]->STH_STATUS == 'ORDER'?'Print':'Post'?></a>
                                                    <?php }elseif($stockTransferOrderDets[0]->STH_STATUS == 'IN-TRANSIT' && $toOrderCheck){ ?>
                                                        <a onClick="check('<?=$stockTransferOrderDets[0]->STH_STATUS == 'ORDER'?'Print':'Post'?>')" class="btn btn-primary w-md waves-effect waves-light"><?=$stockTransferOrderDets[0]->STH_STATUS == 'IN-TRANSIT'?'Post':'Print'?></a>
                                                    <?php } }else{ ?>
                                                        <a onClick="check('<?=$stockTransferOrderDets[0]->STH_STATUS == 'ORDER'?'Print':'Post'?>')" class="btn btn-primary w-md waves-effect waves-light"><?=$stockTransferOrderDets[0]->STH_STATUS == 'ORDER'?'Print':'Post'?></a>
                                                    <?php } }elseif($stockTransferOrderDets[0]->TR_TRANS_RSN == '202' && $stockTransferOrderDets[0]->STH_STATUS == 'ORDER'){ ?>
                                                        <a onClick="check('Post')" class="btn btn-primary w-md waves-effect waves-light">Post</a>
                                                    <?php }elseif($stockTransferOrderDets[0]->TR_TRANS_RSN == '204' && $stockTransferOrderDets[0]->STH_STATUS == 'ORDER'){ ?>
                                                        <a onClick="check('Post')" class="btn btn-primary w-md waves-effect waves-light">Post</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </form>
                                        <span id="outmsg"></span>
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
            <script src="<?=base_url()?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
<script>
   function check(typeMsg) {
        Swal.fire({
            title: 'Are you sure?',
            text: typeMsg == 'Print'?"Need to print this transfer order for in-transit":"Need to Post this tranfer order",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: typeMsg
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('inventory/stock-transfer-in-transit-update')?>",
                    data: {order_no_db:'<?=$stockTransferOrderDets[0]->STH_ORDER_NO?>',trns_resn:'<?=$stockTransferOrderDets[0]->TR_TRANS_RSN?>',trns_status:'<?=$stockTransferOrderDets[0]->STH_STATUS?>'},
                    dataType: "Json",
                    beforeSend: function () {
                            $("#status").fadeIn();
                            $("#preloader").fadeIn();
                        },
                    success: function(resultData){
                        $("#status").fadeOut();
                        $("#preloader").fadeOut();
                        let cht =true;
                        if (resultData.msg == 200) {
                            Swal.fire(
                            'Updated!',
                            'Your opening balance stock has been Updated.',
                            'success'
                            )
                        }else if(resultData.msg == 201){
                            Swal.fire(
                            'Updated!',
                            'Your stock tranfer order has been Updated.',
                            'success'
                            )
                        }else if(resultData.msg == 202){
                            Swal.fire(
                            'Updated!',
                            'Your Good return has been Updated.',
                            'success'
                            )
                        }else if(resultData.msg == 204){
                            Swal.fire(
                            'Updated!',
                            'Your increase and decrease order has been Updated.',
                            'success'
                            )
                        }else if(resultData.msg == 'stock_empty'){
                            Swal.fire(
                            'Denied!',
                            'Your order could not be further processed due to insufficient stock.',
                            'warning'
                            )
                            cht = false;
                        }

                        if (cht) {
                            setTimeout(
                            function() 
                            {
                                location.reload();
                            }, 1200);
                        }
                    }
                });
            }
        })
    }
</script>
        