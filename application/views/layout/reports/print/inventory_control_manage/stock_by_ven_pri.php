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
 
 
  <table border='1' width="100%" cellpadding="0" cellspacing="0">
    <!-- <tr height="37">
      <td width="127" height="37" bgcolor="#CCCCCC"><strong>Item Code</strong></td>
      <td width="377" bgcolor="#CCCCCC"><strong>Item Name</strong></td>
      <td width="79" bgcolor="#CCCCCC"><strong>Class</strong></td>
      <td width="68" bgcolor="#CCCCCC"><strong>Actual Qty.</strong></td>
      <td width="114" bgcolor="#CCCCCC"><strong>Amount</strong></td>
      <td width="93" bgcolor="#CCCCCC"><strong>Total Amount</strong></td>
      <td width="145" align="center" bgcolor="#CCCCCC"><strong>Reference</strong></td>
    </tr> -->
    <?php 
        $fetchData = $this->reportlib->stkByVenPri((object)array('dateIn'=>$dateIn,'vCode'=>$vCode,'itemCat'=>$itemCat,'reportGrp'=>$reportGrp,'itemPic'=>$itemPic,'dataType'=>'num_rows'));
        
        $number = $fetchData;
        // echo $number;
        $parts = round($fetchData/13);
        // echo $parts.'M';
        // echo $fetchData/20;
        $parts = $parts>0?$parts:1;
        $partSize = $number / $parts;
        $partSize = round($partSize);
        $gtotQty = $gsubTot = 0;
        for ($i = 0; $i < $parts+1; $i++) {
          $start = $i * $partSize + 1;
          $start_1 = $start-1;
          $end = ($i + 1) * $partSize;
          $end = $end-1;
        //   echo $start_1.'<->'.$end;
          $diff = $end-$start_1;
        //   if($partNew == $i){
        //     $diff = 20;
        //   }
          
         
          $fetchData = $this->reportlib->stkByVenPri((object)array('dateIn'=>$dateIn,'vCode'=>$vCode,'itemCat'=>$itemCat,'reportGrp'=>$reportGrp,'itemPic'=>$itemPic,'dataType'=>'result','offset'=>$start_1,'limit'=>$diff+1));
        
        $totQty = $totValue = 0;
        $sno = 1;
          foreach ($fetchData as $fetchDataGet) {
            $currRate = currencyExchangeByCurrencyCode($fetchDataGet->CUR_CODE);
            // $itemCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$fetchDataGet->IT_ITEM}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
            // $itemCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$fetchDataGet->IT_ITEM}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
            $itemCost = vendorCostByItem(array('where'=>"WHERE VC_ITEM_CODE = '{$fetchDataGet->IT_ITEM}' ORDER BY VC_ID DESC",'dataType'=>'row'));
   
   ?>

        <tr height="37">
            <td align="center" height="37" width="100"><?=$fetchDataGet->IT_ITEM?></td>
            <td align="center" width="210"><?=$fetchDataGet->VEN_I_DESC?></td>
            <td align="center" width="210"><?=$fetchDataGet->I_DESC?></td>
            <td align="center" width="60"><?=$fetchDataGet->AVL_QTY?></td>
            <td align="center" width="100"><?=numberSystem($fetchDataGet->I_VEN_PRICE)?></td>
            <td align="center" width="100"><?=numberSystem($fetchDataGet->AVL_QTY*($fetchDataGet->I_VEN_PRICE))?></td>
            <td align="center" width="100"><?=$fetchDataGet->CUR_NAME?></td>
            
        </tr>
    <?php 
            $totQty += $fetchDataGet->AVL_QTY; 
            $totValue += $fetchDataGet->AVL_QTY*($fetchDataGet->I_VEN_PRICE);
            $gtotQty += $fetchDataGet->AVL_QTY;
            $gsubTot += $fetchDataGet->AVL_QTY*($fetchDataGet->I_VEN_PRICE);
        } 
        if($totQty>0){
    ?>
        <tr height="47">
            <td height="22" colspan="2" align="right">&nbsp;</td>
            <td height="22" align="center"><strong>Page Total</strong></td>
            <td align="center" bgcolor="#CCCCCC"><?=$totQty?>  &nbsp;</strong></td>
            <td align="right" ><strong>&nbsp;&nbsp;</strong></td>
            <td align="right" ><strong><?=numberSystem($totValue,1)?></strong></td>
            <td align="right">&nbsp;</td>
        </tr>
    <?php
        //   echo "Part ".($i+1)." starts at ".$start." and ends at ".$end."\n";
           }   }

    ?>
    <tr height="47">
        <td height="22" colspan="2" align="right">&nbsp;</td>
        <td height="22" align="center"><strong>Report Total</strong></td>
        <td align="center" bgcolor="#CCCCCC"><?=$gtotQty?>  &nbsp;</strong></td>
        <td align="right" ><strong>&nbsp;&nbsp;</strong></td>
        <td align="right" ><strong><?=numberSystem($gsubTot,1)?></strong></td>
        <td align="right">&nbsp;</td>
    </tr>
  </table>
  <!--FOOT-->
</div>
</body>
</html>
