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
    <div style="width:1040px;height:auto; border:#FF0000 solid 0px; padding:5px">
        <!--HEAD-->
        <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="0">
            <tr>

                <td colspan="5" align="center"><img src="<?= base_url('assets/images/invoice/report_head_logo.jpeg') ?>"
                        width="650" height="89" /></td>

            </tr>
        </table>




        <!--MID-->
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td height="20"><strong>
                        <?= substr(dateTime(), 0, 10) ?>
                    </strong></td>
                <td width="181"><strong>From Period :<?=$fromPeriod?></strong></td>
                <td width="50">&nbsp;</td>
                <td rowspan="2" align="center"><span class="style1">Trial Balance by Levels</span></td>
                <td><strong>To Period: <?=$toPeriod?></strong></td>
                <td><strong>Page:&nbsp;&nbsp; 1&nbsp; /&nbsp; 1</strong></td>
            </tr>
            <tr>
                <td height="20"><strong>
                        <?= substr(dateTime(), 11) ?>
                    </strong></td>
                <td><strong>From Leve: <?=$fromLevel?> </strong></td>
                <td>&nbsp;</td>
                <td><strong>To Level: <?=$toLevel?> </strong></td>
                <td><strong>Printed By:
                        <?= $userCon->USERNAME ?></strong></td>
            </tr>
            <tr>
                <td height="20" width="114">&nbsp;</td>
                <td colspan="2"><strong> From Account : </strong><strong><?=$fromAcc?></strong></td>
                <td width="338" align="center"><strong>Fiscal Year : <?=$finaclYear?></strong></td>
                <td width="207"><strong> To Account No. : <?=$toAcc?></strong></td>
                <td width="148">&nbsp;</td>
            </tr>
            <tr>
                <td height="20"><strong>Branches :01</strong></td>
                <td colspan="2"><strong>Closed Accounts : Yes</strong></td>
                <td>&nbsp;</td>
                <td><strong>Beg. Bal. Status : Posted</strong></td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table border="1" cellpadding="1" cellspacing="1" bordercolor="#000000">
            <col width="108" />
            <col width="205" />
            <col width="127" />
            <col width="133" />
            <col width="112" />
            <col width="119" span="2" />
            <col width="116" />
            <tr height="21">
                <td width="114" height="42" rowspan="2" align="center" bgcolor="#CCCCCC"><strong>Account No</strong>
                </td>
                <td width="233" rowspan="2" align="center" bgcolor="#CCCCCC"><strong>Trial Balance by Levels</strong>
                </td>
                <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Begining Balance</strong></td>
                <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Transaction</strong></td>
                <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Balance</strong></td>
            </tr>
            <tr height="21">
                <td width="110" height="42" align="center" bgcolor="#CCCCCC"><strong>Debit</strong></td>
                <td width="110" align="center" bgcolor="#CCCCCC"><strong>Credit</strong></td>
                <td width="110" align="center" bgcolor="#CCCCCC"><strong>Debit</strong></td>
                <td width="110" align="center" bgcolor="#CCCCCC"><strong>Credit</strong></td>
                <td width="110" align="center" bgcolor="#CCCCCC"><strong>Debit</strong></td>
                <td width="110" align="center" bgcolor="#CCCCCC"><strong>Credit</strong></td>
            </tr>
            <?php 
                $obCredit = $obDebit = $trCredit = $trDebit = $balCredit = $balDebit = 0;
                foreach ($fetchData as $getData): 
            ?>
                <tr height="20">
                    <td height="20" bgcolor="#FBFBFB"><?=$getData->account_no?></td>
                    <td width="233" align="left" bgcolor="#FBFBFB" dir="rtl"><?=$getData->level_name_en.' '.$getData->level_name_ar?></td>
                    <td bgcolor="#FBFBFB"><?=number_format($getData->open_bal_debit,2)?></td>
                    <td bgcolor="#FBFBFB"><?=number_format($getData->open_bal_credit,2)?></td>
                    <td bgcolor="#FBFBFB"><?=number_format($getData->trans_bal_debit,2)?></td>
                    <td bgcolor="#FBFBFB"><?=number_format($getData->trans_bal_credit,2)?></td>
                    <td bgcolor="#FBFBFB"><?=number_format($getData->bal_debit,2)?></td>
                    <td bgcolor="#FBFBFB"><?=number_format($getData->bal_credit,2)?></td>

                </tr>
            <?php 
                $obCredit += $getData->open_bal_credit;
                $obDebit += $getData->open_bal_debit;
                $trCredit += $getData->trans_bal_credit;
                $trDebit += $getData->trans_bal_debit;
                $balCredit += $getData->bal_credit;
                $balDebit += $getData->bal_debit;
                endforeach; 
            ?>
            <tr height="19">
                <td height="19" colspan="2" align="center"><strong>Total :</strong></td>
                <td bgcolor="#CCCCCC"><strong><?=number_format($obDebit,2)?></strong></td>
                <td bgcolor="#CCCCCC"><strong><?=number_format($obCredit,2)?></strong></td>
                <td bgcolor="#CCCCCC"><strong><?=number_format($trDebit,2)?></strong></td>
                <td bgcolor="#CCCCCC"><strong><?=number_format($trCredit,2)?></strong></td>
                <td bgcolor="#CCCCCC"><strong><?=number_format($balDebit,2)?></strong></td>
                <td bgcolor="#CCCCCC"><strong><?=number_format($trCredit,2)?></strong></td>
            </tr>
        </table>
        <br />
        <br />
        <!--FOOT-->
    </div>
</body>

</html>