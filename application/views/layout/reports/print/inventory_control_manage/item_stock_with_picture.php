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

        .avatar-md {
            height: 10rem;
            width: 9rem;
        }
    </style>
</head>

<body>
  
        <?php 
            $fetchData = $this->reportlib->itemStockWithPic((object)array('whseCode'=>$whseCode,'vCode'=>$vCode,'itemClass'=>$itemClass,'dataType'=>'num_rows'));
            
            $number = $fetchData;
            // echo $number;
            $parts = round($fetchData/13);
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
                $diff = $end-$start_1;

            $fetchData = $this->reportlib->itemStockWithPic((object)array('whseCode'=>$whseCode,'vCode'=>$vCode,'itemClass'=>$itemClass,'dataType'=>'result','offset'=>$start_1,'limit'=>$diff+1));
            
            $totQty = $totValue = 0;
            foreach ($fetchData as $fetchDataGet) {

                $itemCost = itemUnitCost(array('where'=>"WHERE INVCOST_ITEM_CODE = '{$fetchDataGet->I_CODE}' ORDER BY INVCOST_ID DESC",'dataType'=>'row'));
        ?>
        
        <div style="width:47%; height:11rem; border:#000000 solid 1px; padding:5px;border-radius: 10px; float: left; margin: 5px;">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="34%" rowspan="4" align="center" valign="middle">
        <img src="<?=base_url('uploads/images/item/').$fetchDataGet->I_IMAGE_FILENAME?>" alt="" title="<?=$fetchDataGet->I_IMAGE_FILENAME?>" class="avatar-md" >
                                    
                                </td>
                                <td width="66%"><strong><?=$fetchDataGet->I_CODE?></strong><br />
                                    <strong><?=$fetchDataGet->I_DESC?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td><strong><?=$fetchDataGet->IC_DESC?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>QTY</strong> :<?=$fetchDataGet->AVL_QTY?></td>
                            </tr>
                            
                        </table>
                    </div>
          
        <?php } }?>
       
</body>

</html>