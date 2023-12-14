<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>#MT-<?=$stockTransferOrderDets[0]->STH_ORDER_NO?></title>
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
td{
	padding: 2px 2px 2px 5px;
	
}

</style>
</head>

<body>
<!--a4 size landscape in pixels W 2480 x H 3508 -->
<div style="width:1090px;height:auto; border:#FF0000 solid 0px; padding:5px">
<!--HEAD-->

<!--#################### HEAD START  ##############################-->
  <!--#++++++++++++++++++  A4- landscape +++++++++++++#-->
  <!--#################### HEAD END  ##############################-->
  <!--MID-->
  
  <table width="100%">
        <thead>
          <tr>
            <th width="1%" bgcolor="#E8E8E8">Sn.</th>
            <th width="10%" bgcolor="#E8E8E8">Rule</th>
            <th width="5%" bgcolor="#E8E8E8">Item No</th>
            <th width="15%" bgcolor="#E8E8E8">Description</th>
            <th width="15%" bgcolor="#E8E8E8">Vendor Item Code<br />
            Vendor Code dfdfd</th>
            <th width="2%" bgcolor="#E8E8E8">Qty</th>
            <th width="5%" bgcolor="#E8E8E8"><?=$printType == 'COST'?'Unit Cost':"Sale Price"?>(SAR)</th>
            <th width="5%" bgcolor="#E8E8E8">Final Price</th>
          </tr>
        </thead>
        <tbody id="tbUser">
            <?php 
                $totValue = 0;
                $sn = null; foreach($stockTransferOrderDets as $stockTransferOrderDet): $sn++;
                $itemCostTot = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$stockTransferOrderDet->I_CODE}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
            ?>
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

                    <?php if ($printType == 'COST') { ?>
                    <td width="5%"><?=numberSystem($itemCostTot->INVCOST_STD_COST,1)?></td>
                    <td width="5%"><?=numberSystem($itemCostTot->INVCOST_STD_COST*$stockTransferOrderDet->STD_TRANS_QTY,1)?></td>
                    <?php
                        $totValue += $itemCostTot->INVCOST_STD_COST*$stockTransferOrderDet->STD_TRANS_QTY;
                         }else{ ?>
                    <td width="5%"><?=numberSystem($stockTransferOrderDet->STD_UNIT_LIST_PRICE,1)?></td>
                    <td width="5%"><?=numberSystem($stockTransferOrderDet->STD_UNIT_LIST_PRICE*$stockTransferOrderDet->STD_TRANS_QTY,1)?></td>
                    <?php
                        $totValue += $stockTransferOrderDet->STD_UNIT_LIST_PRICE*$stockTransferOrderDet->STD_TRANS_QTY;
                        } 
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
  </table>
  
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td width="25%" align="right" style="border-bottom:#000000 solid 1px;"><strong>Total Qty:</strong></td>
                <td width="15%" align="left" style="border-bottom:#000000 solid 1px;"><span id="tot-qty"><?=$stockTransferOrderDets[0]->STH_TOT_QTY?></span></td>
                <td width="20%" align="right" style="border-bottom:#000000 solid 1px;"><strong>Grand Total:</strong></td>
                <td width="40%" align="left" style="border-bottom:#000000 solid 1px;"><span id="grand-tot"><?=numberSystem($totValue)?></span></td>
              </tr>
            </tbody>
  </table>
  
  <br />
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr height="37">
      <td colspan="3" width="180" rowspan="3" align="center" valign="top" bgcolor="#E8E8E8" style="border:#000000 solid 2px;"><strong>Showroom Manager</strong>      </td>
      <td width="120" height="37" align="center" valign="top">&nbsp;</td>
      <td colspan="2" width="180" rowspan="3" align="center" valign="top" bgcolor="#E8E8E8" style="border:#000000 solid 2px;"><strong>Receiver</strong>      </td>
      <td width="120" align="center" valign="top">&nbsp;</td>
      <td width="180" colspan="2" rowspan="3" align="center" valign="top" bgcolor="#E8E8E8" style="border:#000000 solid 2px;"><strong>Account:</strong></td>
    </tr>
    
    <tr height="21">
      <td height="20" align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
    </tr>
    
    <tr height="23">
      <td height="35" align="center" valign="top" >&nbsp;</td>
      <td align="center" valign="top" >&nbsp;</td>
    </tr>
  </table>
  
  <!--FOOT-->
</div>
</body>
</html>
