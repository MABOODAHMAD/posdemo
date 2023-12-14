<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Untitled Document</title>
    <style type="text/css">
        body {
            color: #000000;
            background: #FFF;
            font-family: 'Open Sans', sans-serif;
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

        td {
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
        <table border='1' width="100%" cellpadding="0" cellspacing="0">
            <?php

                            
                $totCredit = $totDebit = $totbalcredit = $totbaldebit = 0;
                foreach ($custDet as $custDetGet):
                    $getOpBal = $this->reportlib->custOpBal((object)array('fromDate'=>$fromDate,'custCode'=>$custDetGet->CUST_CODE));
                    $getCustData = $this->reportlib->custTrailBal((object)array(
                                                                'fromDate'=>$fromDate,
                                                                'toDate'=>$toDate,
                                                                'whseCode'=>$whseCode,
                                                                'custCode'=>$custDetGet->CUST_CODE,
                                                                'zeroBal'=>$zeroBal,
                                                                'repType'=>$repType,
                                                                'conign'=>$conign,
                                                                'dataType'=>'row'));
                    $totCredit += $getCustData?$getCustData->TOT_CREDIT:0;
                    $totDebit += $getCustData?$getCustData->TOT_DEBIT:0;
                if($getCustData){

                    $calBal = $getOpBal + ($getCustData->TOT_DEBIT - $getCustData->TOT_CREDIT);
                    if($calBal>0){
                        $totbaldebit += $calBal;
                        $totInDebit = $calBal;
                        $totInCredit = 0; 
                    }elseif ($calBal<0) {
                        $totbalcredit += $abs($calBal);
                        $totInDebit = 0;
                        $totInCredit = abs($calBal); 
                    }
            ?>
                <tr height="21">
                    <td align="center"><?=$custDetGet->CUST_CODE?></td>
                    <td width="367" align="left"><?=$custDetGet->CUST_NAME_AR?></td>
                    <td align="center"><?=number_format($getOpBal,2)?></td>
                    <td align="center"><?=number_format($getCustData->TOT_DEBIT,2)?></td>
                    <td align="center"><?=number_format($getCustData->TOT_CREDIT,2)?></td>
                    <td align="center"><?=number_format($totInDebit,2)?></td>
                    <td align="center"><?=number_format($totInCredit,2)?></td>
                </tr>
            <?php } endforeach; ?>
            <tr height="23">
                <td height="35" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                <td align="center" style="border-bottom:#000000 solid 1px;">Last</td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong>Total</strong></td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totDebit,2)?> </strong></td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totCredit,2)?></strong></td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totbaldebit,2)?></strong></td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totbalcredit,2)?></strong></td>
            </tr>
        </table>

        <!--FOOT-->
    </div>
</body>

</html>