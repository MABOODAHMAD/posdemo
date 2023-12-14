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


  <!--MID-->
  
  <!--#################### HEAD END  ##############################-->
<br />

<?php if (count($excessDet)>0){ ?>
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr height="37">
      <td height="37" align="center" bgcolor="#CCCCCC"><strong>Excess Items</strong></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr height="37">
      <td width="96" height="37" align="center" bgcolor="#CCCCCC"><strong>Excess Items</strong></td>
      <td width="303" align="center" bgcolor="#CCCCCC"><strong>Description</strong></td>
      <td width="137" align="center" bgcolor="#CCCCCC"><strong>Price</strong></td>
      <td width="163" align="center" bgcolor="#CCCCCC"><strong>System Qty</strong></td>
      <td width="131" align="center" bgcolor="#CCCCCC"><strong>Count Qty</strong></td>
      <td width="131" align="center" bgcolor="#CCCCCC"><strong>Variance Qty</strong></td>
      <td width="127" align="center" bgcolor="#CCCCCC"><strong> Variance Value</strong></td>
    </tr>
    
    <?php 
        $exContQty = $exSysQty = $exDiffQty = $exTotValue = 0;
        foreach ($excessDet as $excessGet): 
    ?>
        <tr height="21">
        <td align="center"><?=$excessGet->PISC_ITEM?></td>
        <td align="center"><?=$excessGet->PISC_ITEM_DESC?></td>
        <td align="center"><?=$excessGet->MICER_PRICE?></td>
        <td align="center"><?=$excessGet->PISC_SYSQTY?></td>
        <td align="center"><?=$excessGet->PISC_CNTQTY?></td>
        <td align="center"><?=$excessGet->PISC_DIFF?></td>
        <td align="center"><?=$excessGet->MICER_VAR_VALUE?></td>
        </tr>
    <?php 
        $exContQty += $excessGet->PISC_CNTQTY; 
        $exSysQty += $excessGet->PISC_SYSQTY; 
        $exDiffQty += $excessGet->PISC_DIFF; 
        $exTotValue += $excessGet->MICER_VAR_VALUE;
        endforeach; 
    ?>
    <tr height="23">
      <td height="35" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
    </tr>
    <tr height="23">
      <td height="35" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
    </tr>
    
    <tr height="23">
      <td height="35" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="right" style="border-bottom:#000000 solid 1px;"><strong>Total :</strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong></strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=$exSysQty?></strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong> <?=$exContQty?> </strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=$exDiffQty?></strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=numberSystem($exTotValue)?></strong></td>
    </tr>
   
  </table>
  <?php } ?>
<hr>
<?php if (count($shortDet)>0){ ?>
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr height="37">
      <td height="37" align="center" bgcolor="#CCCCCC"><strong>Short Items</strong></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr height="37">
      <td width="96" height="37" align="center" bgcolor="#CCCCCC"><strong>Short Items</strong></td>
      <td width="303" align="center" bgcolor="#CCCCCC"><strong>Description</strong></td>
      <td width="137" align="center" bgcolor="#CCCCCC"><strong>Price</strong></td>
      <td width="163" align="center" bgcolor="#CCCCCC"><strong>System Qty</strong></td>
      <td width="131" align="center" bgcolor="#CCCCCC"><strong>Count Qty</strong></td>
      <td width="131" align="center" bgcolor="#CCCCCC"><strong>Variance Qty</strong></td>
      <td width="127" align="center" bgcolor="#CCCCCC"><strong> Variance Value</strong></td>
    </tr>
    
    <?php 
        $shContQty = $shSysQty = $shDiffQty = $shTotValue = 0;
        foreach ($shortDet as $shortGet): 
    ?>
        <tr height="21">
        <td align="center"><?=$shortGet->PISC_ITEM?></td>
        <td align="center"><?=$shortGet->PISC_ITEM_DESC?></td>
        <td align="center"><?=$shortGet->MICER_PRICE?></td>
        <td align="center"><?=$shortGet->PISC_SYSQTY?></td>
        <td align="center"><?=$shortGet->PISC_CNTQTY?></td>
        <td align="center"><?=$shortGet->PISC_DIFF?></td>
        <td align="center"><?=$shortGet->MICER_VAR_VALUE?></td>
        </tr>
    <?php 
        $shContQty += $shortGet->PISC_CNTQTY; 
        $shSysQty += $shortGet->PISC_SYSQTY; 
        $shDiffQty += $shortGet->PISC_DIFF; 
        $shTotValue += $shortGet->MICER_VAR_VALUE;
        endforeach; 
    ?>
    <tr height="23">
      <td height="35" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
    </tr>
    <tr height="23">
      <td height="35" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
    </tr>
    
    <tr height="23">
      <td height="35" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="right" style="border-bottom:#000000 solid 1px;"><strong>Total :</strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong></strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=$shSysQty?></strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong> <?=$shContQty?> </strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=$shDiffQty?></strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=numberSystem($shTotValue)?></strong></td>
    </tr>
  </table>
  <?php } ?>
  <!--FOOT-->
</div>
</body>
</html>
