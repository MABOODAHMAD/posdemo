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
        <!--#################### HEAD END  ##############################-->
        <!--MID-->
        
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr height="37">
                <td width="34" align="center" bgcolor="#CCCCCC"><strong>Line</strong></td>
                <td width="83" height="25" align="center" bgcolor="#CCCCCC"><strong>Item </strong></td>
                <td width="29" align="center" bgcolor="#CCCCCC"><strong>no </strong></td>
                <td width="87" align="center" bgcolor="#CCCCCC"><strong>Reference</strong></td>
                <td width="270" align="left" bgcolor="#CCCCCC"><strong>Description</strong></td>
                <td width="69" align="center" bgcolor="#CCCCCC"><strong>Qty required</strong></td>
                <td width="46" align="center" bgcolor="#CCCCCC"><strong>UOM</strong></td>
                <td width="94" align="center" bgcolor="#CCCCCC"><strong>Price</strong></td>
                <td width="66" align="center" bgcolor="#CCCCCC"><strong>Total</strong></td>
            </tr>
            <?php
                $sn = 0;
                foreach ($poDetail as $poDetailGet):
            ?>
                <tr height="21">
                    <td width="34" align="center"><?=++$sn?></td>
                    <td width="83" height="20" align="center"><?=$poDetailGet->POD_ITEM_CODE?></td>
                    <td align="center">0</td>
                    <td align="center"><?=$poDetailGet->VEN_I_DESC?></td>
                    <td align="left"><?=$poDetailGet->I_DESC?></td>
                    <td align="center"><?=$poDetailGet->POD_ITEM_QTY?></td>
                    <td align="center"><?=$poDetailGet->I_UOM_CODE?></td>
                    <td align="center"><?=number_format($poDetailGet->POD_UNIT_COST,4)?></td>
                    <td align="right"><?=number_format($poDetailGet->POD_UNIT_COST*$poDetailGet->POD_ITEM_QTY,4)?></td>
                </tr>
            <?php 
                endforeach; 
            ?>

            <tr height="23">
                <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                <td height="35" align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                <td align="left" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong>total qty</strong></td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=$poHeader->POH_TOT_QTY?></strong></td>
                <td align="center" style="border-bottom:#000000 solid 1px;"><strong>Total</strong></td>
                <td align="right" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($poHeader->POH_GRAND_TOTAL,2)?></strong></td>
            </tr>
        </table>
        <!--FOOT-->
    </div>
</body>

</html>