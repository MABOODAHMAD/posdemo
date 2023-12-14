<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
<!--HEAD-->
<!-- <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="0">
  <tr>
    <td colspan="5" align="center"><img src="<?=base_url('assets/images/invoice/report_head_logo.jpeg')?>" width="650" height="89" /></td>
    </tr>
</table> -->




  <!--MID-->
  <!-- <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td height="26"><strong>05-05-2023</strong></td>
      <td><strong>Classification</strong></td>
      <td><strong>:All</strong></td>
      <td>&nbsp;</td>
      <td><strong>Cost    Type: Sale Price</strong></td>
      <td><strong>Page:&nbsp;&nbsp; 1&nbsp; /&nbsp; 141</strong></td>
    </tr>
    <tr>
      <td height="23"><strong>19:45:47</strong></td>
      <td><strong>From    Item:</strong></td>
      <td><strong>:All</strong></td>
      <td align="center"><span class="style1">Inventory    Status Report</span></td>
      <td><strong>To    Item: All</strong></td>
      <td><strong>Printed    By: 
EMIS2000</strong></td>
    </tr>
    <tr>
      <td height="19" width="116"><strong>ICM2022I</strong></td>
      <td width="137"><strong>        From Category:</strong></td>
      <td width="71"><strong>        02</strong></td>
      <td width="356">&nbsp;</td>
      <td width="178"><strong>        To Category:02</strong></td>
      <td width="180">&nbsp;</td>
    </tr>
    <tr>
      <td height="38"><strong>Whse: 07 </strong></td>
      <td colspan="2"><strong>Al - Dawlee Branch (J3)</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table> -->
 
 
  <table width="100%" border='1' cellpadding="0" cellspacing="0">
   
   
    <?php 
        $stockDet = $this->reportlib->stockStatus((object)array('whseCode'=>$whseCode,'fromCat'=>$fromItemCat,'toCat'=>$toItemCat,'itemCodeFrom'=>$itemCodeFrom,'itemCodeTo'=>$itemCodeTo,'reportType'=>$reportType,'dataType'=>'num_rows'));
        
        $number = $stockDet;
        // echo $number;
        $parts = round($stockDet/16);
        // echo $parts.'M';
        // echo $fetchData/20;
        $parts = $parts>0?$parts:1;
        $partSize = $number / $parts;
        $partSize = round($partSize);
        $gtotQty = $gtotAmt = 0;
        for ($i = 0; $i < $parts+1; $i++) {
          $start = $i * $partSize + 1;
          $start_1 = $start-1;
          $end = ($i + 1) * $partSize;
          $end = $end-1;
          $diff = $end-$start_1;
          $stockDet = $this->reportlib->stockStatus((object)array('whseCode'=>$whseCode,'fromCat'=>$fromItemCat,'toCat'=>$toItemCat,'itemCodeFrom'=>$itemCodeFrom,'itemCodeTo'=>$itemCodeTo,'reportType'=>$reportType,'dataType'=>'result','offset'=>$start_1,'limit'=>$diff+1));
        
        $totQty = $totAmt = 0;
          foreach ($stockDet as $stockDetGet) {

            $itemCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$stockDetGet->IT_ITEM}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
            if($costType == 'sale_price'){
                $itemPrize = $stockDetGet->I_LIST_PRICE;
            }elseif($costType == 'avg_cost'){
                $itemPrize = $itemCost->INVCOST_AVG_COST;
            }elseif($costType == 'unit_cost'){
                $itemPrize = $itemCost->INVCOST_STD_COST;
            }else{
                $itemPrize = $stockDetGet->IT_UNIT_COST;
            }
    ?>

        <tr height="28">
            <td height="31" width="100" align="center"><?=$stockDetGet->IT_ITEM?></td>
            <td  width="100" align="left"><?=$stockDetGet->IT_ITEM_DESC1?></td>
        <?php if($reportType == 'AC'){ ?>
            <td  width="100" align="left"><?=$stockDetGet->V_NAME?></td>
        <?php } ?>
            <td  width="100" align="center"><?=$stockDetGet->I_CLASS_CODE?></td>
            <td  width="50" align="center"><?=$stockDetGet->AVL_QTY?></td>
            <td  width="100" align="center"><?=$itemPrize?></td>
            <td  width="100" align="center"><?=number_format($stockDetGet->AVL_QTY*$itemPrize,2)?></td>
            <td  width="100" align="right"><?=$stockDetGet->VEN_I_DESC?></td>
        </tr>
    <?php 
        $totQty += $stockDetGet->AVL_QTY ; $totAmt += $stockDetGet->AVL_QTY*$itemPrize;
        $gtotQty += $stockDetGet->AVL_QTY ; $gtotAmt += $stockDetGet->AVL_QTY*$itemPrize;

        } 
        if($totAmt>0){
    ?>
        
        <tr height="47">
            <td height="22" colspan="2" align="right"><strong>Page Total</strong></td>
            <td>&nbsp;</td>
            <?php
                if($reportType == 'AC'){
            ?>
            <td align="right" bgcolor="#CCCCCC"><strong>&nbsp;&nbsp;</strong></td>
            <?php
                }
            ?>
            <td align="right" bgcolor="#CCCCCC"><strong><?=$totQty?>  &nbsp;</strong></td>
            <td align="right" bgcolor="#CCCCCC"><strong>&nbsp;&nbsp;</strong></td>
            <td align="right" bgcolor="#CCCCCC"><strong><?=number_format($totAmt,2)?> &nbsp;&nbsp;</strong></td>
            <td align="right">&nbsp;</td>
        </tr>
    <?php
        //   echo "Part ".($i+1)." starts at ".$start." and ends at ".$end."\n";
           }   }
    ?>
   <tr height="47">
            <td height="22" colspan="2" align="right"><strong>Report Total</strong></td>
            <td>&nbsp;</td>
            <?php
                if($reportType == 'AC'){
            ?>
            <td align="right" bgcolor="#CCCCCC"><strong>&nbsp;&nbsp;</strong></td>
            <?php
                }
            ?>
            <td align="right" bgcolor="#CCCCCC"><strong><?=$gtotQty?>  &nbsp;</strong></td>
            <td align="right" bgcolor="#CCCCCC"><strong>&nbsp;&nbsp;</strong></td>
            <td align="right" bgcolor="#CCCCCC"><strong><?=number_format($gtotAmt,2)?> &nbsp;&nbsp;</strong></td>
            <td align="right">&nbsp;</td>
        </tr>
  </table>
  <!--FOOT-->
</div>
</body>
</html>
