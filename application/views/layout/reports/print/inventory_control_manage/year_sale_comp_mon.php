<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Untitled Document</title>
    <style type="text/css">
    </style>
</head>

<body>
    <!--a4 size landscape in pixels W 2480 x H 3508 -->
    <div style="width:1090px;height:auto; border:#FF0000 solid 0px; padding:5px">
        <!--HEAD-->

        <table width="100%" cellpadding="0" cellspacing="0">

            <tr height="37">
                <td width="226" height="37" bgcolor="#CCCCCC"><strong>Locations</strong></td>
                <td width="200" align="center" bgcolor="#CCCCCC"><strong>QTY SOLD</strong></td>
                <td width="198" align="center" bgcolor="#CCCCCC"><strong>NET SALES</strong></td>
                <td width="180" align="center" bgcolor="#CCCCCC"><strong>DISC%</strong></td>
                <td width="143" align="center" bgcolor="#CCCCCC"><strong>GOC SOLD</strong></td>
                <td width="141" align="center" bgcolor="#CCCCCC"><strong>GROSS PROFIT</strong></td>
            </tr>
            <tr height="21">
                <td height="21" width="226"><?=$year_1?></td>
                <td width="200" align="center"><?=$partOne->SH_TOT_QTY?></td>
                <td width="198" align="center"><?=$partOne->TOT_REVENUE?></td>
                <td align="center">0</td>
                <td align="center">0</td>
                <td align="center">0</td>
            </tr>
            <tr height="23">
                <td height="23" width="226"><?=$year_2?></td>
                <td width="200" align="center"><?=$partTwo->SH_TOT_QTY?></td>
                <td width="198" align="center"><?=$partTwo->TOT_REVENUE?></td>
                <td align="center">0</td>
                <td align="center">0</td>
                <td align="center">0</td>
            </tr>
        </table>

        <!--FOOT-->
    </div>
</body>

</html>