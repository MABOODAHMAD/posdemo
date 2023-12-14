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

    <div style="width:1090px;height:auto; border:#FF0000 solid 0px; padding:5px">

        <table width="100%" cellpadding="0" cellspacing="0">

            <?php
            $totQty = $totValue = 0;
            $fetchData = $this->reportlib->stockStatusDate(
                                                            (object) array(
                                                                'dateIn' => $dateIn,
                                                                'whseFrom' => $whseFrom,
                                                                'whseTo' => $whseTo,
                                                                'itemCodeFrom' => $itemCodeFrom,
                                                                'itemCodeTo' => $itemCodeTo,
                                                                'itemCatCodeFrom' => $itemCatCodeFrom,
                                                                'itemCatCodeTo' => $itemCatCodeTo,
                                                                'itemClsFrom' => $itemClsFrom,
                                                                'itemClsTo' => $itemClsto,
                                                                'disZeroBal' => $disZeroBal,
                                                                'onlyConStk' => $onlyConStk,
                                                                'withConStk' => $withConStk,
                                                                'byPri' => $byPri,
                                                                'grpBy' => 'IT_WHSE',
                                                                'dataType' => 'result'
                                                            )
                                                        );

            $whseTot = $whseTotVal = 0;
            foreach ($fetchData as $fetchDataGet):

                ?>
                <tr height="21">
                    <td height="20" bgcolor="#9D9D9D"><strong><?=$fetchDataGet->IT_WHSE?></strong></td>
                    <td bgcolor="#9D9D9D"> <strong><?=$fetchDataGet->IT_WHSE_DESC?></strong></td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                </tr>
                <?php
                    
                    $itemDet = $this->reportlib->stockStatusDate(
                                                                    (object) array(
                                                                        'dateIn' => $dateIn,
                                                                        'whseFrom' => $fetchDataGet->IT_WHSE,
                                                                        'whseTo' => 'All',
                                                                        'itemCodeFrom' => $itemCodeFrom,
                                                                        'itemCodeTo' => $itemCodeTo,
                                                                        'itemCatCodeFrom' => $itemCatCodeFrom,
                                                                        'itemCatCodeTo' => $itemCatCodeTo,
                                                                        'itemClsFrom' => $itemClsFrom,
                                                                        'itemClsTo' => $itemClsto,
                                                                        'disZeroBal' => $disZeroBal,
                                                                        'onlyConStk' => $onlyConStk,
                                                                        'withConStk' => $withConStk,
                                                                        'byPri' => $byPri,
                                                                        'grpBy' => 'IT_ITEM',
                                                                        'dataType' => 'result'
                                                                    )
                                                                );

                    $avlQty = $totVal = 0;
                        foreach ($itemDet as $itemDetGet):

                            $itemCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$itemDetGet->IT_ITEM}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));

                ?>
                    <tr height="23">
                        <td height="23" width="169"><?=$itemDetGet->IT_ITEM?></td>
                        <td width="660"><?=$itemDetGet->IT_ITEM_DESC1?></td>
                        <td align="center"><?=$itemDetGet->AVL_QTY?></td>
                        <td align="center" width="163"><?=number_format($itemCost->INVCOST_STD_COST*$itemDetGet->AVL_QTY,2)?></td>
                    </tr>

                <?php
                    $avlQty += $itemDetGet->AVL_QTY; $totVal += $itemCost->INVCOST_STD_COST*$itemDetGet->AVL_QTY;
                    $whseTot += $itemDetGet->AVL_QTY; $whseTotVal += $itemCost->INVCOST_STD_COST*$itemDetGet->AVL_QTY;
                    endforeach;
                ?>
                <tr height="23">
                    <td height="35" align="right" style="border-bottom:#000000 solid 1px;">&nbsp;</td>
                    <td style="border-bottom:#000000 solid 1px;"><strong>Class Total:</strong></td>
                    <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($avlQty,2)?></strong></td>
                    <td align="center" style="border-bottom:#000000 solid 1px;"><strong><?=number_format($totVal,2)?></strong></td>
                </tr>
            <?php
                endforeach;
            ?>

            
            <tr height="23">
                <td height="23">&nbsp;</td>
                <td height="23">&nbsp;</td>
                <td height="23" align="center">&nbsp;</td>
                <td height="23" align="center">&nbsp;</td>
            </tr>
            <tr height="23">
                <td height="23">&nbsp;</td>
                <td height="23"><strong>Whse Total:</strong></td>
                <td height="23" align="center"><strong><?=number_format($whseTot,2)?></strong></td>
                <td height="23" align="center"><strong><?=number_format($whseTotVal,2)?></strong></td>
            </tr>
            <tr height="23">
                <td height="23">&nbsp;</td>
                <td height="23">&nbsp;</td>
                <td height="23" align="center">&nbsp;</td>
                <td height="23" align="center">&nbsp;</td>
            </tr>
            <tr height="23">
                <td height="23">&nbsp;</td>
                <td height="23"><strong>Report Total:</strong></td>
                <td height="23" align="center"><strong><?=number_format($whseTot,2)?></strong></td>
                <td height="23" align="center"><strong><?=number_format($whseTotVal,2)?></strong></td>
            </tr>
        </table>
        <br />
        <br />
        <!--FOOT-->
    </div>
</body>

</html>