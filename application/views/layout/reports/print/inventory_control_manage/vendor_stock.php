<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vendor Stock Report</title>
<style type="text/css">
body {
	color: #000000;
	background: #FFF;
	font-family: 'Open Sans',sans-serif;
	padding: 0px !important;
	margin: 0px !important;
	font-size: 12px;
	letter-spacing: 0px;
	text-rendering: optimizeLegibility;
}
.style1 {
	font-size: 24px;
	font-weight: bold;
}
</style>
</head>

<body>
<!--a4 size landscape in pixels W 2480 x H 3508 -->
<div style="width:1080px;height:auto; border:#FF0000 solid 0px; padding:5px">

  <table border='1' width="100%" cellpadding="0" cellspacing="0">
   
    <?php 
        $totQty = $totValue = 0;
        $fetchData = $this->reportlib->vendorStockReport((object)array(
                                                                        'dateIn'=>$dateIn,
                                                                        'vCode'=>$vCode,
                                                                        'curCode'=>$curCode,
                                                                        'whseCode'=>$whseCode,
                                                                        'whseDet'=>$whseDet,
                                                                        'itemCatCode'=>$itemCatCode,
                                                                        'itemCatCodeDet'=>$itemCatCodeDet,
                                                                        'itemClsCode'=>$itemClsCode,
                                                                        'itemClsCodeDet'=>$itemClsCodeDet,
                                                                        'itemCode'=>$itemCode,
                                                                        'itemCodeDet'=>$itemCodeDet,
                                                                        'costVal'=>$costVal,
                                                                        'prtVenRef'=>$prtVenRef,
                                                                        'dataType'=>'result'
                                                                    ));
        
        $gQty = $gSubTot = 0;
        foreach ($fetchData as $fetchDataGet):

        ?>
            <tr height="37">
                <td align="center" bgcolor='#CCCCCC' height="37" width="100" colspan="2"><?=$fetchDataGet->V_CODE.'-'.$fetchDataGet->V_NAME?></td>
                <td align="center" width="60"><?=$fetchDataGet->AVL_QTY?></td>
                <td align="center" width="100"></td>
                <td align="center" width="100"><?=$fetchDataGet->TOT_VALUE?></td>
            </tr>

        <?php  
                $whseDet = $this->reportlib->vendorStockReport((object)array('dateIn'=>$dateIn,
                                                                            'vCode'=>$fetchDataGet->V_CODE,
                                                                            'curCode'=>$curCode,
                                                                            'whseCode'=>$whseCode,
                                                                            'whseDet'=>$whseDet,
                                                                            'itemCatCode'=>$itemCatCode,
                                                                            'itemCatCodeDet'=>$itemCatCodeDet,
                                                                            'itemClsCode'=>$itemClsCode,
                                                                            'itemClsCodeDet'=>$itemClsCodeDet,
                                                                            'itemCode'=>$itemCode,
                                                                            'itemCodeDet'=>$itemCodeDet,
                                                                            'costVal'=>$costVal,
                                                                            'prtVenRef'=>$prtVenRef,
                                                                            'grpBy'=>"IT_WHSE",
                                                                            'dataType'=>'result'));
            foreach ($whseDet as $whseDetGet):
        ?>

            <tr height="37">
                <td align="center" bgcolor='#CCCCCC' height="37" width="100" colspan="2"><?=$whseDetGet->IT_WHSE.'-'.$whseDetGet->IT_WHSE_DESC?></td>
                <td align="center" width="60"><?=$whseDetGet->AVL_QTY?></td>
                <td align="center" width="100"></td>
                <td align="center" width="100"><?=$whseDetGet->TOT_VALUE?></td>
            </tr>
    <?php 
            endforeach;

            $catDet = $this->reportlib->vendorStockReport((object)array('dateIn'=>$dateIn,
                                                                            'vCode'=>$fetchDataGet->V_CODE,
                                                                            'curCode'=>$curCode,
                                                                            'whseCode'=>$whseCode,
                                                                            'whseDet'=>$whseDet,
                                                                            'itemCatCode'=>$itemCatCode,
                                                                            'itemCatCodeDet'=>$itemCatCodeDet,
                                                                            'itemClsCode'=>$itemClsCode,
                                                                            'itemClsCodeDet'=>$itemClsCodeDet,
                                                                            'itemCode'=>$itemCode,
                                                                            'itemCodeDet'=>$itemCodeDet,
                                                                            'costVal'=>$costVal,
                                                                            'prtVenRef'=>$prtVenRef,
                                                                            'grpBy'=>"I_CAT_CODE",
                                                                            'dataType'=>'result'));
            foreach ($catDet as $catDetGet):

        ?>

                <tr height="37">
                    <td align="center" bgcolor='#CCCCCC' height="37" width="100" colspan="2"><?=$catDetGet->ICAT_CODE.'-'.$catDetGet->ICAT_DESC?></td>
                    <td align="center" width="60"><?=$catDetGet->AVL_QTY?></td>
                    <td align="center" width="100"></td>
                    <td align="center" width="100"><?=$catDetGet->TOT_VALUE?></td>
                </tr>
        <?php 
            endforeach;
            
            $classDet = $this->reportlib->vendorStockReport((object)array('dateIn'=>$dateIn,
                                                                            'vCode'=>$fetchDataGet->V_CODE,
                                                                            'curCode'=>$curCode,
                                                                            'whseCode'=>$whseCode,
                                                                            'whseDet'=>$whseDet,
                                                                            'itemCatCode'=>$itemCatCode,
                                                                            'itemCatCodeDet'=>$itemCatCodeDet,
                                                                            'itemClsCode'=>$itemClsCode,
                                                                            'itemClsCodeDet'=>$itemClsCodeDet,
                                                                            'itemCode'=>$itemCode,
                                                                            'itemCodeDet'=>$itemCodeDet,
                                                                            'costVal'=>$costVal,
                                                                            'prtVenRef'=>$prtVenRef,
                                                                            'grpBy'=>"I_CLASS_CODE",
                                                                            'dataType'=>'result'));
            foreach ($classDet as $classDetGet):


        ?>
            <tr height="37">
                <td align="center" bgcolor='#E6E6E6' height="37" width="100" colspan="2"><?=$classDetGet->I_CLASS_CODE.'-'.$classDetGet->IC_DESC?></td>
                <td align="center" width="60"><?=$classDetGet->AVL_QTY?></td>
                <td align="center" width="100"></td>
                <td align="center" width="100"><?=$classDetGet->TOT_VALUE?></td>
            </tr>
    <?php  
        if($itemCodeDet == 'Y'){
            $subItemDet = $this->reportlib->vendorStockReport((object)array(
                                                                            'dateIn'=>$dateIn,
                                                                            'vCode'=>$fetchDataGet->V_CODE,
                                                                            'curCode'=>$curCode,
                                                                            'whseCode'=>$whseCode,
                                                                            'whseDet'=>$whseDet,
                                                                            'itemCatCode'=>$itemCatCode,
                                                                            'itemCatCodeDet'=>$itemCatCodeDet,
                                                                            'itemClsCode'=>$itemClsCode,
                                                                            'itemClsCodeDet'=>$itemClsCodeDet,
                                                                            'itemCode'=>$itemCode,
                                                                            'itemCodeDet'=>$itemCodeDet,
                                                                            'costVal'=>$costVal,
                                                                            'prtVenRef'=>$prtVenRef,
                                                                            'grpBy'=>"I_CLASS_CODE,I_CODE",
                                                                            'dataType'=>'result'
                                                                        ));

            foreach ($subItemDet as $subItemDetGet):
                if($classDetGet->I_CLASS_CODE == $subItemDetGet->I_CLASS_CODE){
                    // $itemCostTot = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$subItemDetGet->I_CODE}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
                    $itemCostTot = vendorCostByItem(array('where'=>"WHERE VC_ITEM_CODE = '{$subItemDetGet->I_CODE}' ORDER BY VC_ID DESC",'dataType'=>'row'));
                    $venCost = $itemCostTot?numberSystem($itemCostTot->VC_VEND_NON_CON_PRICE):'Not Found';

                    $itemValueDet = $venCost>0?numberSystem($subItemDetGet->AVL_QTY*$itemCostTot->VC_VEND_NON_CON_PRICE):'Not Found';
    ?>
                <tr height="37">
                    <td align="center" height="37" width="100" colspan="2"><?=$subItemDetGet->I_CODE.'-'.$subItemDetGet->I_DESC?></td>
                    <td align="center" width="60"><?=$subItemDetGet->AVL_QTY?></td>
                    <td align="center" width="100"><?=$venCost?></td>
                    <td align="center" width="100"><?=$itemValueDet?></td>
                </tr>
    <?php       }
            endforeach;
        }
        endforeach;
    ?>
            <tr height="47">
                <!-- <td height="22" colspan="2" align="right">&nbsp;</td> -->
                <td height="22" align="center" colspan="2"><strong>Page Total</strong></td>
                <td align="center" bgcolor="#CCCCCC"><?=$fetchDataGet->AVL_QTY?>  &nbsp;</strong></td>
                <td align="right" ><strong>&nbsp;&nbsp;</strong></td>
                <td align="center" ><strong><?=numberSystem($fetchDataGet->TOT_VALUE)?></strong></td>
            </tr>
    <?php
        $gQty += $fetchDataGet->AVL_QTY;
        $gSubTot += $fetchDataGet->TOT_VALUE;
        endforeach;
        
    ?>
     <tr height="47">
        <!-- <td height="22" colspan="2" align="right">&nbsp;</td> -->
        <td height="22" align="center" colspan="2"><strong>Report Total</strong></td>
        <td align="center" bgcolor="#CCCCCC"><?=$gQty?>  &nbsp;</strong></td>
        <td align="right" ><strong>&nbsp;&nbsp;</strong></td>
        <td align="center" ><strong><?=number_format($gSubTot,2)?></strong></td>
    </tr>
  </table>
  <!--FOOT-->
</div>
</body>
</html>
