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
        
        <table border="1" width="100%" cellpadding="0" cellspacing="0">
            <?php
                $custStateDet = $this->reportlib->custState((object)array(
                                                                        'fromDate'=>$fromDate,
                                                                        'toDate'=>$toDate,
                                                                        'custCode'=>$custCode,
                                                                        'whseCode'=>$whseCode,
                                                                        'dataType'=>'result'));
                $totCredit = $totDebit = 0;
                foreach ($custStateDet as $custStateDetGet):
                
                    $totCredit += $custStateDetGet->W_CREDIT_AMT;
                    $totDebit += $custStateDetGet->W_DEBIT_AMT;
                if(substr($custStateDetGet->W_INC_PREFIX,0,1) == 'I'){
                    $invType = "Invoice";
                }elseif (substr($custStateDetGet->W_INC_PREFIX,0,1) == 'C') {
                   $invType = "Credit Memo";
                }elseif (substr($custStateDetGet->W_INC_PREFIX,0,1) == 'D') {
                   $invType = "Debit Memo";
                }else{
                    $invType = "P";
                }
            ?>
                <tr height="21">
                    <td align="center"><?=$invType?></td>
                    <td height="20" align="center"><?=$custStateDetGet->V_DATE?></td>
                    <td width="146" align="center"><?=$custStateDetGet->W_INC_PREFIX.'-'.$custStateDetGet->W_INC_NO?></td>
                    <td align="center">INV:R1/2356</td>
                    <td align="center"><?=number_format($custStateDetGet->W_DEBIT_AMT,2)?></td>
                    <td align="center"><?=number_format($custStateDetGet->W_CREDIT_AMT,2)?></td>
                    <td align="center"><?=number_format($totDebit-$totCredit,2)?></td>
                </tr>
            <?php
                endforeach;
            ?>  
            <tr height="23">
                <td align="center">&nbsp;</td>
                <td height="35" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong>Total</strong></td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totDebit,2)?> </strong></td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totCredit,2)?></strong></td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totDebit-$totCredit,2)?></strong></td>
            </tr>
        </table>
        <br />
        <br />

        <table width="100%" cellpadding="0" cellspacing="0">
            <tr height="37">
                <td colspan="3" width="180" rowspan="3" align="center" valign="top" bgcolor="#E8E8E8"
                    style="border:#000000 solid 2px;"><strong>Fainancial Department</strong>
                </td>
                <td width="120" height="37" align="center" valign="top">&nbsp;</td>
                <td colspan="2" width="180" rowspan="3" align="center" valign="top" bgcolor="#E8E8E8"
                    style="border:#000000 solid 2px;"><strong>Customer Services</strong>
                </td>
                <td width="120" align="center" valign="top">&nbsp;</td>
                <td width="180" colspan="2" rowspan="3" align="center" valign="top" bgcolor="#E8E8E8"
                    style="border:#000000 solid 2px;"><strong>Managment</strong></td>
            </tr>

            <tr height="21">
                <td height="20" align="center" valign="top">&nbsp;</td>
                <td align="center" valign="top">&nbsp;</td>
            </tr>

            <tr height="23">
                <td height="35" align="center" valign="top">&nbsp;</td>
                <td align="center" valign="top">&nbsp;</td>
            </tr>
        </table>
        <p>&nbsp;</p>
        <p><br />
            <br />
            <!--FOOT-->
        </p>
    </div>
</body>

</html>