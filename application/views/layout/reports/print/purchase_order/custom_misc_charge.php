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
.style4 {color: #FFFFFF; font-weight: bold; }

</style>
</head>

<body>
<!--a4 size landscape in pixels W 2480 x H 3508 -->
<div style="width:1090px;height:auto; border:#FF0000 solid 0px; padding:5px">
  <table width="100%" cellpadding="0" cellspacing="0">
    <?php 
        $totPeriod = substr($toPeriod,0,2)-(substr($fromPeriod,0,2)-1);
        for ($i=1; $i < $totPeriod; $i++) { 

            $fetchData = $this->reportlib->customMiscCharge((object)array(
                                                                // 'finaclYear' =>$finaclYear,
                                                                'yearAndPeriod' =>$finaclYear.'-'.str_pad(substr($fromPeriod,0,2)+$i,2, "0", STR_PAD_LEFT),
                                                                // 'toPeriod' =>$toPeriod,
                                                                'busUnit' =>$busUnit,
                                                                'chargeType' =>$chargeType,
                                                                // 'grpBy' =>'POH_VENDOR_CODE',
                                                                'dataType'=>'result'));
    ?>
        <tr height="37">
            <td width="121" height="37" bgcolor="#CCCCCC"><strong>Period <?=str_pad(substr($fromPeriod,0,2)+$i,2, "0", STR_PAD_LEFT)?></strong></td>
            <td width="367" align="center">&nbsp;</td>
            <td width="227" align="center">&nbsp;</td>
            <td width="206" align="center">&nbsp;</td>
            <td width="167" align="center">&nbsp;</td>
        </tr>
        <tr height="21">
            <td width="121" height="21" bgcolor="#F5F5F5"><strong>Type</strong></td>
            <td width="367" align="center" bgcolor="#F5F5F5"><strong>Charges Desc</strong></td>
            <td width="227" align="center" bgcolor="#F5F5F5"><strong>Debit</strong></td>
            <td align="center" bgcolor="#F5F5F5"><strong>Credit</strong></td>
            <td align="center" bgcolor="#F5F5F5"><strong>Balance</strong></td>
        </tr>
        <?php
            foreach ($fetchData as $getData):
        ?>
            <tr height="23">
                <td height="23" width="121"><?=$getData->CHRG_TYPE?></td>
                <td width="367" align="center"><?=$getData->CHRG_DESC?></td>
                <td width="227" align="center">0</td>
                <td align="center"><?=number_format($getData->PODC_PO_CHARGE_AMT,4)?></td>
                <td align="center"><?=number_format($getData->PODC_PO_CHARGE_AMT,4)?></td>
            </tr>
        <?php
            endforeach;
        ?>
    <?php
        }
    ?>
  </table>
  
  <!--FOOT-->
</div>
</body>
</html>
