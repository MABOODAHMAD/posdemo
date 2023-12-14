<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
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
  <!-- <table width="100%" cellpadding="0" cellspacing="0">
    
    
    <tr height="23">
      <td height="5" colspan="5" align="right" style="border-bottom:#000000 solid 1px;"></td>
    </tr>
    <tr height="23">
      <td width="93" height="35" align="right" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td width="143" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td width="522" align="center" style="border-bottom:#000000 solid 1px;"><strong>Total Sold Qty &amp; Value</strong></td>
      <td width="168" align="center" style="border-bottom:#000000 solid 1px;"><strong>35</strong></td>
      <td width="162" align="center" style="border-bottom:#000000 solid 1px;"><strong>21,372.50</strong></td>
    </tr>
  </table> -->
  <table width="100%" cellpadding="0" cellspacing="0">
    
    <tr height="37">
      <td width="93" height="25" bgcolor="#CCCCCC"><strong>Item</strong></td>
      <td width="143" bgcolor="#CCCCCC"><strong>Vendor Ref</strong></td>
      <td width="522" align="left" bgcolor="#CCCCCC"><strong>Description</strong></td>
      <td width="168" align="center" bgcolor="#CCCCCC"><strong>Sold Qty</strong></td>
      <td width="162" align="center" bgcolor="#CCCCCC"><strong>Vendor Price </strong></td>
    </tr>
    <?php
      foreach ($whseDet as $whseDetGet):
          $venDet = $this->unicon->CoreQuery("SELECT * FROM VENDOR WHERE V_CODE BETWEEN '{$vCodeFrom}' AND '{$vCodeTo}'","result");

          $query = null;
          if ($itemFrom != 'All' && $itemTo != 'All') {
              $query .= "AND I_CODE BETWEEN '{$itemFrom}' AND '{$itemTo}' ";
          }else{
              if($itemFrom != 'All'){
                  $query .= "AND I_CODE = '{$itemFrom}' ";
              }elseif($itemTo != 'All'){
                  $query .= "AND I_CODE = '{$itemTo}' ";
              }
          }
          $saleDet = $this->unicon->CoreQuery("SELECT *
                                                FROM SALE_HEADER,SALE_DETAIL,ITEMS,VENDOR
                                                WHERE SH_ORDER_ID = SD_ORDER_ID
                                                AND VEN_CODE = V_CODE
                                                AND SD_ITEM_CODE = I_CODE
                                                AND SH_WHSE_CODE = '{$whseDetGet->WHSE_CODE}' 
                                                AND SH_ORDER_DATE BETWEEN '{$fromDate}' AND '{$toDate}'
                                                $query","result");
        if(count($saleDet)>0){
          $totQty = $totVal = 0;
          foreach ($saleDet as $saleDetSum):
            foreach ($venDet as $venDetGet) {
              if ($venDetGet->V_CODE == $saleDetSum->V_CODE) {
                $curRate = currencyExchangeByCurrencyCode($saleDetSum->V_CURR_CODE);
                $itemCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$saleDetSum->I_CODE}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
                $totQty += $saleDetSum->SD_QTY;
                $totVal += $itemCost->INVCOST_STD_COST*$saleDetSum->SD_QTY*$curRate->EXCHR_BUY_RATE;
              }
            }
            
          endforeach;

    ?>
      <tr height="21">
        <td height="20" bgcolor="#FFFFCC"><strong>Location</strong></td>
        <td colspan="2" bgcolor="#FFFFCC"> <strong><?=$whseDetGet->WHSE_CODE.'-'.$whseDetGet->WHSE_DESC?></strong></td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr height="21">
        <td height="20" bgcolor="#FFFFCC"><strong>Currency:</strong></td>
        <td bgcolor="#FFFFCC"><strong>SAR</strong></td>
        <td align="center" bgcolor="#FFFFCC"><strong>Total:</strong></td>
        <td align="center" bgcolor="#FFFFCC"><strong><?=$totQty?></strong></td>
        <td align="center" bgcolor="#FFFFCC"><strong><?=$totVal?></strong></td>
      </tr>
      <?php
         foreach ($saleDet as $saleDetGet):
          foreach ($venDet as $venDetGet) {
            if ($venDetGet->V_CODE == $saleDetGet->V_CODE) {
              $curRate = currencyExchangeByCurrencyCode($saleDetGet->V_CURR_CODE);
              $itemCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$saleDetGet->I_CODE}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
      ?>
        <tr height="21">
          <td height="20" width="93"><?=$saleDetGet->I_CODE?></td>
          <td width="143"><?=$saleDetGet->I_DESC?></td>
          <td align="left"><?=$saleDetGet->I_DESC?></td>
          <td align="center"><?=$saleDetGet->SD_QTY?></td>
          <td align="right"><?=$itemCost->INVCOST_STD_COST*$saleDetGet->SD_QTY*$curRate->EXCHR_BUY_RATE?></td>
        </tr>
      <?php 
            } 
          } 
        endforeach; 
      ?>
      <tr height="23">
        <td height="35" align="right" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
        <td style="border-bottom:#000000 solid 1px;">&nbsp;</td>
        <td align="left" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
        <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
        <td align="right" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      </tr>
      <tr height="23">
        <td height="23">&nbsp;</td>
        <td>&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
    <?php } endforeach; ?>
  </table>
  <br />
  <br />
  <!--FOOT-->
</div>
</body>
</html>
