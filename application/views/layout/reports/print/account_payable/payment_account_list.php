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
    
        <table width="100%" cellpadding="0" cellspacing="0">
            <?php

                $fetchData = $this->reportlib->payAccList((object)array(
                                                                    'dataDueFrom'=>$dataDueFrom,
                                                                    'dataDueTo'=>$dataDueTo,
                                                                    'vCodefrom'=>$vCodefrom,
                                                                    'vCodeTo'=>$vCodeTo,
                                                                    'grpBy' => 'POH_VENDOR_CODE',
                                                                    'dataType'=>'result'));
                foreach ($fetchData as $getData):
            ?>
            <tr height="21">
                <td height="20" bgcolor="#9D9D9D"><strong>Vendor <?=$getData->V_CODE?></strong></td>
                <td bgcolor="#9D9D9D"> <strong><?=$getData->V_NAME?></strong></td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
            </tr>
            <?php 
                $fetchDataSub = $this->reportlib->payAccList((object)array(
                                                                        'dataDueFrom'=>$dataDueFrom,
                                                                        'dataDueTo'=>$dataDueTo,
                                                                        'vCode'=>$getData->V_CODE,
                                                                        'dataType'=>'result'));
                    $totAmt = $totNetAmt = $totPaidAmt = $totBalAmt = 0;
                    foreach ($fetchDataSub as $getDataSub):


            ?>  
                <tr height="21">
                    <td height="20" width="101"><?=$getDataSub->POH_PREFIX?></td>
                    <td width="230"><?=$getDataSub->POH_PREFIX?></td>
                    <td align="center"><?=$getDataSub->POH_ORDER_DATE?></td>
                    <td align="center"><?=$getDataSub->due_date?></td>
                    <td align="center">0</td>
                    <td align="center"><?=number_format($getDataSub->POH_GRAND_TOTAL,2)?></td>
                    <td align="center">0</td>
                    <td align="center"><?=number_format($getDataSub->POH_GRAND_TOTAL,2)?></td>
                    <td align="center"><?=number_format($getDataSub->POD_PAID_AMT,2)?></td>
                    <td align="center"><?=number_format($getDataSub->POH_GRAND_TOTAL-$getDataSub->POD_PAID_AMT,2)?></td>
                    <td align="center">0</td>
                </tr>   

            <?php 
                    $totAmt += $getDataSub->POH_GRAND_TOTAL;
                    $totNetAmt += $getDataSub->POH_GRAND_TOTAL;
                    $totPaidAmt += $getDataSub->POD_PAID_AMT;
                    $totBalAmt += $getDataSub->POH_GRAND_TOTAL-$getDataSub->POD_PAID_AMT;      
                    endforeach;  
            ?>
            
                <tr height="23">
                    <td height="35" align="right" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                    <td style="border-bottom:#000000 solid 1px;"><strong>Vendor Total:</strong></td>
                    <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                    <td align="center" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                    <td align="center" style="border-bottom:#000000 solid 1px;"><strong>0</strong></td>
                    <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totAmt,2)?></strong></td>
                    <td align="center" style="border-bottom:#000000 solid 1px;"><strong>0</strong></td>
                    <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totNetAmt,2)?></strong></td>
                    <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totPaidAmt,2)?></strong></td>
                    <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totBalAmt,2)?></strong></td>
                    <td align="center" style="border-bottom:#000000 solid 1px;"><strong>0</strong></td>
                </tr>

                <tr height="23">
                    <td height="23">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                </tr>
                
                <tr height="23">
                    <td height="23">&nbsp;</td>
                    <td height="23"><strong>Currency Total:</strong></td>
                    <td height="23" align="center">&nbsp;</td>
                    <td height="23" align="center">&nbsp;</td>
                    <td align="center">0</td>
                    <td align="center"><strong><?=$getData->CUR_ABBRV?> <?=number_format($totAmt,2)?></strong></td>
                    <td align="center">0</td>
                    <td align="center"><strong><?=$getData->CUR_ABBRV?> <?=number_format($totNetAmt,2)?></strong></td>
                    <td align="center"><?=$getData->CUR_ABBRV?> <?=number_format($totPaidAmt,2)?></td>
                    <td align="center"><strong><?=$getData->CUR_ABBRV?> <?=number_format($totBalAmt,2)?></strong></td>
                    <td align="center">0</td>
                </tr>

            <?php
                    endforeach; 
            ?>
            
            
            
        </table>
        <br />
        <br />
        <!--FOOT-->
    </div>
</body>

</html>