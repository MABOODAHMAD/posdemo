/<!--
 *  ALL WAREHOUSE DATA SHOW EXCEPT WHEN A LOGIN SPECIFIC USER 
 *  
 *  
 *  
 *  
 *  
 *  
 *  
 -->
<style>
/* Tooltip container */
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
 
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
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
                                    <h4 class="mb-sm-0 font-size-18">Full Item Detail</h4>

                                   

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-5">
                                                <div class="product-detai-imgs">
                                                    <div class="row">
                                                       
                                                        <div class="">
                                                            <div class="tab-content" id="v-pills-tabContent">
                                                                <div class="tab-pane fade show active tooltip" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                                                    <div>
                                                                    <span class="tooltiptext"><?=$itemDets[0]['I_IMAGE_FILENAME']?></span>
                                                                        <img src="<?=base_url('uploads/images/item/').$itemDets[0]['I_IMAGE_FILENAME']?>" alt="<?=$itemDets[0]['I_IMAGE_FILENAME']?>" class="img-fluid mx-auto d-block">
                                                                    </div>
                                                                </div>
                                                               
                                                               
                                                               
                                                            </div>
                                                            <!-- <div class="text-center">
                                                                <a type="text" class="btn btn-primary waves-effect waves-light mt-2 me-1">
                                                                    <i class=" me-2">Gold</i> 2.45
                                                                </a>
                                                                <a type="text" class="btn btn-success waves-effect  mt-2 waves-light">
                                                                    <i class=" me-2">Diamond</i>0.14
                                                                </a>
                                                            </div> -->
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-xl-7">
                                                <div class="mt-4 mt-xl-3">
                                                    <h3 class="mt-1 mb-3">Item Code- <?=$itemDets[0]['I_CODE']?></h3>
                                                    
                                                    <h4 class="mb-4">Category : <a class="text-primary"><?=$itemDets[0]['ICAT_CODE'].' - '.$itemDets[0]['ICAT_DESC']?></a></h4>
                                                    <h5 class="mb-4">Class : <a class="text-primary"><?=$itemDets[0]['IC_CODE'].' - '.$itemDets[0]['IC_DESC']?></a></h5>
                                                    <h6 class="mb-4">Country of Orgin : <a class="text-primary"><?=$itemDets[0]['CNTRY_CODE'].' - '.$itemDets[0]['CNTRY_NAME']?></a></h6>
                                                    <h6 class="mb-4">Revisions date : <a class="text-primary"><?=date('d-M-Y', strtotime($itemDets[0]['REV_DATE']))?></a></h6>
                                                    <h6 class="mb-4">Unit of measurement : <a class="text-primary"><?=$itemDets[0]['I_UOM_CODE']?></a></h6>
    
                                                   
                                                    <!--<p class="text-muted mb-4">Country of Orgin( United Arab Emirates )</p>-->
    
                                                    <h6 class="text-success text-uppercase"><?=$itemDets[0]['I_MAX_DISCOUNT']?> % Discount</h6>
                                                    <h5 class="mb-4"><b>KSA Prise <?=$itemDets[0]['I_LIST_PRICE']?numberSystem($itemDets[0]['I_LIST_PRICE'],null):'Undefined'?> SR</b></h5>
                                                   <a class="text-primary">Description</a>
                                                   <p class="text-muted mb-4"><?=$itemDets[0]['I_DESC']?></p>
                                                   <a class="text-primary">Extended Description</a>
                                                   <p class="text-muted mb-4"><?=$itemDets[0]['I_EXTEND_DESC']?></p>
                                                   
                                                    <a class="text-primary">Vendor Item Code - Desc</a>
                                                   <p class="text-muted mb-4"><?=$itemDets[0]['VEN_I_CODE'].' - '.$itemDets[0]['VEN_I_DESC']?></p>
                                                <?php if(dashRole(["role_check"=>"PRODUCT_PRODUCT_VIEW_VENDOR_CODE_AND_DESC"])){ ?>
                                                   <a class="text-primary">Vendor Code And Desc</a>
                                                   <p class="text-muted mb-4"><?=$itemDets[0]['V_CODE'].' - '.$itemDets[0]['V_NAME']?></p>
                                                <?php } ?>
                                                    <div class="row mb-3">
                                                        <div class="col-md-4">
                                                            <div>
                                                                <p class="text-muted"><i class=" font-size-12 align-middle text-primary me-1">Clearty</i> <?=$itemDets[0]['I_CLEARITY']?></p>
                                                                <p class="text-muted"><i class="font-size-12 align-middle text-primary me-1">Color</i> <?=$itemDets[0]['I_CLR_COLOR']?></p>
                                                                <p class="text-muted"><i class="font-size-12 align-middle text-primary me-1">Global Atribute</i> <?=$itemDets[0]['I_CLR_GLOBAL_ATTRIBUTE']?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div>
                                                                <p class="text-muted"><i class="font-size-12 align-middle text-primary me-1">Style</i> <?=$itemDets[0]['I_STYLE']?></p>
                                                                <p class="text-muted"><i class="font-size-12 align-middle text-primary me-1">Color</i>  <?=$itemDets[0]['I_STY_COLOR']?></p>
                                                                <p class="text-muted"><i class="font-size-12 align-middle text-primary me-1">Size</i>  <?=$itemDets[0]['I_STY_SIZE']?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div>
                                                                <p class="text-muted"><i class=" font-size-12 align-middle text-primary me-1">Length</i> <?=$itemDets[0]['I_LENGTH']?></p>
                                                                <p class="text-muted"><i class="font-size-12 align-middle text-primary me-1">Width</i> <?=$itemDets[0]['I_WIDTH']?></p>
                                                                <p class="text-muted"><i class="font-size-12 align-middle text-primary me-1">Weight</i> <?=$itemDets[0]['I_WEIGHT']?></p>
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <!--<div class="product-color">-->
                                                    <!--    <h5 class="font-size-15">Color :</h5>-->
                                                    <!--    <a href="javascript: void(0);" class="active">-->
                                                    <!--        <div class="product-color-item border rounded">-->
                                                    <!--            <img src="assets/images/product/img-7.png" alt="" class="avatar-md">-->
                                                    <!--        </div>-->
                                                    <!--        <p>Black</p>-->
                                                    <!--    </a>-->
                                                    <!--    <a href="javascript: void(0);">-->
                                                    <!--        <div class="product-color-item border rounded">-->
                                                    <!--            <img src="assets/images/product/img-7.png" alt="" class="avatar-md">-->
                                                    <!--        </div>-->
                                                    <!--        <p>Blue</p>-->
                                                    <!--    </a>-->
                                                    <!--    <a href="javascript: void(0);">-->
                                                    <!--        <div class="product-color-item border rounded">-->
                                                    <!--            <img src="assets/images/product/img-7.png" alt="" class="avatar-md">-->
                                                    <!--        </div>-->
                                                    <!--        <p>Gray</p>-->
                                                    <!--    </a>-->
                                                    <!--</div>-->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <h2 class="mb-3">Item Traits</h2>
                                         <div class="table-responsive">
                                            <table class="table align-middle table-nowrap table-check">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width: 20px;" class="align-middle">
                                                            S/N
                                                        </th>
                                                        <th class="align-middle">Trait Category</th>
                                                        <th class="align-middle">Trait no</th>
                                                        <th class="align-middle">Category Desc</th>
                                                        <th class="align-middle">Trait Desc</th>
                                                        <th class="align-middle">Weight</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $sn=1; foreach($itemDets as $itemDet): 
                                                            if($itemDet['ITM_TRAIT_CAT_CODE']){
                                                    ?>
                                                    <tr>
                                                        <td><?=$sn;?></td>
                                                        <td><?=$itemDet['ITM_TRAIT_CAT_CODE']?></td>
                                                        <td><?=$itemDet['ITM_TRAIT_CODE']?></td>
                                                        <td><?=$itemDet['TC_DESC']?></td>
                                                        <td><?=$itemDet['TRAIT_DESC']?></td>
                                                        <td><?=$itemDet['TRT_WEIGHT']?></td>
                                                    </tr>
                                                    <?php $sn++; }else{ ?>
                                                        <tr><td colspan='6' class="text-center">The item trait is not available on the item. </td></tr>
                                                   <?php } endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                      
                                <?php if(dashRole(["role_check"=>"PRODUCT_WAREHOUSE_INFO"])){ ?>
                                    <h5 class="font-size-14 card-body border-bottom po-charge-hd"><i class="mdi mdi-arrow-right text-primary"></i>Stock</h5>
                                    <div class="col-xs-12">
                                        <?php if ($sesData->USER_TYPE == 'SUPERADMIN' || $sesData->USER_TYPE == 'ADMIN') { ?>
                                            <h3 class="bold">Default Warehouse Stock</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-condensed dfTable two-columns">
                                                <thead>
                                                    <tr>
                                                        <th>Wharehouse Name</th>
                                                        <th>Quantity (الكمية)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($whseDets as $whseDet):

                                                                    if ($whseDet->WHSE_CODE == '01') {
                                                                        $item_P = array(
                                                                            "dataType" => 'row',
                                                                            "itemCode" => $itemDets[0]['I_CODE'],
                                                                            "whseId" => $whseDet->WHSE_CODE,
                                                                        );
                                                                        $stockDet = itemStockDet($item_P); ?>
                                                            <tr>
                                                                <td><?= $whseDet->WHSE_CODE . '-' . $whseDet->WHSE_DESC ?></td>
                                                                <td><strong><?=$stockDet?$stockDet:0?></strong></td>
                                                            </tr>
                                                    <?php }  endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <h3 class="bold">All Warehouse Stock</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-condensed dfTable two-columns">
                                                <thead>
                                                    <tr>
                                                        <th>Warehouse Name</th>
                                                        <th>Quantity (الكمية)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                    
                                                <?php foreach($whseDets as $whseDet):

                                                                    $item_P = array(
                                                                        "dataType" => 'row',
                                                                        "itemCode" => $itemDets[0]['I_CODE'],
                                                                        "whseId" => $whseDet->WHSE_CODE,
                                                                    );
                                                                    $stockDet = itemStockDet($item_P);
                                                                    $checkWhseQty = false;
                                                                    if($whseDet->WHSE_CODE != '01' && $stockDet>0){ ?>
                                                    <tr>
                                                        <td><?=$whseDet->WHSE_CODE.'-'.$whseDet->WHSE_DESC?></td>
                                                        <td><strong><?=$stockDet?></strong></td>
                                                    </tr>
                                                <?php $checkWhseQty = true; } endforeach; if(!$checkWhseQty){ ?>

                                                    <tr>
                                                        <td colspan="2"><p class="text-center">Other warehouse stock quantities are empty.</p></td>
                                                    </tr>

                                                <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php }else if($sesData->USER_TYPE == 'USER'){ 
                                            $saleWhseArr = array();
                                            foreach ($whse_assign as $getValue) {
                                                $saleWhseArr[] = "'$getValue->SMSW_WHSE_CODE'";
                                            }
                                            
                                            $stokAndWhseDet = $this->unicon->CoreQuery("SELECT SUM(IT_TRANS_QTY) STOCK_QTY,IT_WHSE,IT_WHSE_DESC 
                                                                                        FROM INV_TRANS 
                                                                                        WHERE IT_ITEM = '{$itemDets[0]['I_CODE']}' 
                                                                                        AND IT_WHSE NOT IN(".implode(',',$saleWhseArr).") 
                                                                                        GROUP BY IT_WHSE HAVING STOCK_QTY > 0","result");
                                        if($stokAndWhseDet){?>                    
                                        <h3 class="bold">All Warehouse Stock</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-condensed dfTable two-columns">
                                                <thead>
                                                    <tr>
                                                        <th>Warehouse Name</th>
                                                        <th>Quantity (الكمية)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                    
                                                <?php foreach($stokAndWhseDet as $whseDet): ?>
                                                    <tr>
                                                        <td><?=$whseDet->IT_WHSE.'-'.$whseDet->IT_WHSE_DESC?></td>
                                                        <td><strong><?=$whseDet->STOCK_QTY?></strong></td>
                                                    </tr>
                                                <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                            
                                        <?php } ?>
                                    </div>
                                <?php } }?>
                                        <!-- end Specifications -->
    
                                       
    
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                       

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->