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
        
        <table width="100%" cellpadding="0" cellspacing="0">

            <tr height="23">
                <td width="119" height="35" align="center" style="border-bottom:#000000 solid 1px;"><strong>Vendor
                        #</strong></td>
                <td align="left" style="border-bottom:#000000 solid 1px;"><strong>Vendor Name</strong></td>
                <td width="258" align="center" style="border-bottom:#000000 solid 1px;"><strong>Balance</strong></td>
                <td width="28" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                <td width="202" align="center" style="border-bottom:#000000 solid 1px;"><strong>Balance Due </strong>
                </td>
            </tr>
            <tr height="21">
                <td height="20" align="center">&nbsp;</td>
                <td align="left">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
            </tr>
            <?php 
                    $openingBal = $this->reportlib->venOpBal((object)array(
                                                                            'date'=>$date,
                                                                            'vCode'=>$vCode,
                                                                            'curr'=>$curr,
                                                                            'dataType'=>'row'));
            ?>
            <tr height="21">
                <td height="20" align="center"><?=$venDet->V_CODE?></td>
                <td width="481" align="left"><?=$venDet->V_NAME?></td>
                <td align="center"><?=number_format($openingBal,2)?></td>
                <td align="center">&nbsp;</td>
                <td align="center">0</td>
            </tr>
            <tr height="23">
                <td height="30" align="center">&nbsp;</td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong>CURRENCY TOTAL ------&gt;</strong>
                </td>
                <td align="center" style="border:#000000 solid 1px;"><strong><?=number_format($openingBal,2)?></strong></td>
                <td align="center" style="border:#000000 solid 0px;">&nbsp;</td>
                <td align="center" style="border:#000000 solid 1px;"><strong> 0</strong></td>
            </tr>
        </table>
        <br />
        <br />
        <!--FOOT-->
    </div>
</body>

</html>