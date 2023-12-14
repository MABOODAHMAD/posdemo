<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Untitled Document</title>
<style type="text/css">

.style1 {
	font-size: 24px;
	font-weight: bold;
}
</style>
</head>

<body>
<!--a4 size landscape in pixels W 2480 x H 3508 -->
<div style="width:1090px;height:auto; border:#FF0000 solid 0px; padding:5px">
<!--HEAD-->
  <table border ="1" width="100%" cellpadding="0" cellspacing="0">
    <?php

            $fetchData = $this->reportlib->venPurByDate((object)array(
                                                                        'fromDate' =>$fromDate,
                                                                        'toDate' =>$toDate,
                                                                        'vCode' =>$vCode,
                                                                        'itemCat' =>$itemCat,
                                                                        'ItemCls' =>$ItemCls,
                                                                        'ItemCode' =>$ItemCode,
                                                                        'grpBy' => 'POD_ITEM_CODE',
                                                                        'dataType'=>'num_rows'));
                    
            $number = $fetchData;
            // echo $number;
            $parts = round($fetchData/12);
            // echo $parts.'M';
            // echo $fetchData/20;
            $parts = $parts>0?$parts:1;
            $partSize = $number / $parts;
            $partSize = round($partSize);

            for ($i = 0; $i < $parts+1; $i++) {
                $start = $i * $partSize + 1;
                $start_1 = $start-1;
                $end = ($i + 1) * $partSize;
                $end = $end-1;
                //   echo $start_1.'<->'.$end;
                $diff = $end-$start_1;
                //   if($partNew == $i){
                //     $diff = 20;
                //   }
                
                
                $fetchDataSub = $this->reportlib->venPurByDate((object)array(
                                                                            'fromDate' =>$fromDate,
                                                                            'toDate' =>$toDate,
                                                                            'vCode' =>$vCode,
                                                                            'itemCat' =>$itemCat,
                                                                            'ItemCls' =>$ItemCls,
                                                                            'ItemCode' =>$ItemCode,
                                                                            'grpBy' => 'POD_ITEM_CODE',
                                                                            'dataType'=>'result',
                                                                            'offset'=>$start_1,
                                                                            'limit'=>$diff+1));
                    
                $totQty = $totValue = 0;
                $sno = 1;
                foreach ($fetchDataSub as $fetchDataGet):
            ?>
                    <tr height="21">
                        <td height="35" width="10"><?=$fetchDataGet->POH_ORDER_ID?></td>
                        <td width="10" align="center"><?=$fetchDataGet->POH_ORDER_DATE?></td>
                        <td width="20" align="center"><?=$fetchDataGet->I_CODE?></td>
                        <td width="40" align="center"><?=$fetchDataGet->I_DESC?></td>
                        <td width="210" align="center"><?=$fetchDataGet->SUB_QTY?></td>
                        <td width="210" align="center"><?=$fetchDataGet->SUB_TOT?></td>
                    </tr>
            <?php 
                $totQty += $fetchDataGet->SUB_QTY;
                $totValue += $fetchDataGet->SUB_TOT;
                endforeach; 
                if ($totQty>0) {
            ?>
        <tr height="23">
            <td height="23" align="center"></td>
            <td align="center"><span class="style4"></span></td>
            <td align="center"><span class="style4"></span></td>
            <td align="center"><span class="style4"><p class="style4">Page Total</p></span></td>
            <td align="center"><span class="style4"><?=number_format($totQty,2)?></span></td>
            <td align="center"><span class="style4"><?=number_format($totValue,2)?></span></td>
        </tr>
    <?php
        } }
    ?>
    
  </table>
  
  <!--FOOT-->
</div>
</body>
</html>
