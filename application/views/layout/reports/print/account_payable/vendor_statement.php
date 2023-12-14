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

  <table width="100%" cellpadding="0" cellspacing="0">
    <?php
        
        $openingBal = $this->reportlib->venOpBal((object)array(
                                                                'fromDate'=>$fromDate,
                                                                'toDate'=>$toDate,
                                                                'vCode'=>$vCode,
                                                                'curr'=>$curr,
                                                                'dataType'=>'row'));
    ?>
    <tr height="21">
      <td height="20" align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center"><strong>Opening Balance -</strong></td>
      <td align="center"><strong><?=$openingBal?></strong></td>
    </tr>
    <?php
            $vendVoucDet = $this->reportlib->venState((object)array(
                                                                    'fromDate'=>$fromDate,
                                                                    'toDate'=>$toDate,
                                                                    'vCode'=>$vCode,
                                                                    'curr'=>$curr,
                                                                    'dataType'=>'result'));
        $totCredit = $totDebit = 0; 
        foreach ($vendVoucDet as $vendVoucDetGetData):
            $totCredit += $vendVoucDetGetData->VW_CREDIT_AMT; 
            $totDebit += $vendVoucDetGetData->VW_DEBIT_AMT;
            // $totBal += $vendVoucDetGetData->VW_CREDIT_AMT-$vendVoucDetGetData->VW_DEBIT_AMT
    ?>
    <tr height="21">
      <td height="20" align="center"><?=$vendVoucDetGetData->VW_DATE?></td>
      <td width="146" align="center"><?=$vendVoucDetGetData->VW_INC_PREFIX?></td>
      <td align="left"><?=$vendVoucDetGetData->VW_INC_NO?></td>
      <td align="center"><?=number_format($vendVoucDetGetData->VW_DEBIT_AMT,2)?></td>
      <td align="center"><?=number_format($vendVoucDetGetData->VW_CREDIT_AMT,2)?></td>
      <td align="center"><?=number_format($totCredit-$totDebit,2)?></td>
    </tr>
    <?php endforeach; ?>
    <tr height="23">
      <td height="35" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong>Total</strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totDebit,2)?> </strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totCredit,2)?></strong></td>
      <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totCredit-$totDebit,2)?></strong></td>
    </tr>
    <tr height="23">
      <td height="23" align="center">&nbsp;</td>
      <td align="center"><br /></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr height="21">
      <td height="20" align="center">&nbsp;</td>
      <td align="center"><strong>Accountant</strong></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center"><strong> Recipient</strong></td>
    </tr>
    <tr height="21">
      <td height="20" align="center">&nbsp;</td>
      <td align="center"><strong><?=$username?></strong></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
  <br />
  <br />
  <!--FOOT-->
</div>
</body>
</html>
