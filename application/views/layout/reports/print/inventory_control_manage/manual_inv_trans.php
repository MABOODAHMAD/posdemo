<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vendor Stock Report</title>
<style type="text/css">
body {
	color: #000000;
	background: #FFF;
	font-family: 'Open Sans',sans-serif;
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
</style>
</head>

<body>
<!--a4 size landscape in pixels W 2480 x H 3508 -->
<div style="width:1080px;height:auto; border:#FF0000 solid 0px; padding:5px">
<!--HEAD-->
<!-- <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="0">
  <tr>
    <td colspan="5" align="center"><img src="<?=base_url('assets/images/invoice/report_head_logo.jpeg')?>" width="650" height="89" /></td>
    </tr>
</table> -->




  <!--MID-->
  <!-- <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td height="26"><strong>05-05-2023</strong></td>
      <td><strong>Classification</strong></td>
      <td><strong>:All</strong></td>
      <td>&nbsp;</td>
      <td><strong>Cost    Type: Sale Price</strong></td>
      <td><strong>Page:&nbsp;&nbsp; 1&nbsp; /&nbsp; 141</strong></td>
    </tr>
    <tr>
      <td height="23"><strong>19:45:47</strong></td>
      <td><strong>From    Item:</strong></td>
      <td><strong>:All</strong></td>
      <td align="center"><span class="style1">Inventory    Status Report</span></td>
      <td><strong>To    Item: All</strong></td>
      <td><strong>Printed    By: 
EMIS2000</strong></td>
    </tr>
    <tr>
      <td height="19" width="116"><strong>ICM2022I</strong></td>
      <td width="137"><strong>        From Category:</strong></td>
      <td width="71"><strong>        02</strong></td>
      <td width="356">&nbsp;</td>
      <td width="178"><strong>        To Category:02</strong></td>
      <td width="180">&nbsp;</td>
    </tr>
    <tr>
      <td height="38"><strong>Whse: 07 </strong></td>
      <td colspan="2"><strong>Al - Dawlee Branch (J3)</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table> -->
 
 
  <table border='1' width="100%" cellpadding="0" cellspacing="0">
    <!-- <tr height="37">
      <td width="127" height="37" bgcolor="#CCCCCC"><strong>Item Code</strong></td>
      <td width="377" bgcolor="#CCCCCC"><strong>Item Name</strong></td>
      <td width="79" bgcolor="#CCCCCC"><strong>Class</strong></td>
      <td width="68" bgcolor="#CCCCCC"><strong>Actual Qty.</strong></td>
      <td width="114" bgcolor="#CCCCCC"><strong>Amount</strong></td>
      <td width="93" bgcolor="#CCCCCC"><strong>Total Amount</strong></td>
      <td width="145" align="center" bgcolor="#CCCCCC"><strong>Reference</strong></td>
    </tr> -->
    <?php 
        $fetchData = $this->reportlib->manualInvTrans((object)array('dateFrom'=>$dateFrom,'dateTo'=>$dateTo,'whseFrom'=>$whseFrom,'whseTo'=>$whseTo,'reason'=>$reason,'rule'=>$rule,'itemCat'=>$itemCat,'vCode'=>$vCode,'repType'=>$repType,'dataType'=>'num_rows'));
        
        $number = $fetchData;
        // echo $number;
        $parts = round($fetchData/14);
        // echo $parts.'M';
        // echo $fetchData/20;
        $parts = $parts>0?$parts:1;
        $partSize = $number / $parts;
        $partSize = round($partSize);
       
        $gQty = $gSubTot = 0; 
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
          
         
          $fetchData = $this->reportlib->manualInvTrans((object)array('dateFrom'=>$dateFrom,'dateTo'=>$dateTo,'whseFrom'=>$whseFrom,'whseTo'=>$whseTo,'reason'=>$reason,'rule'=>$rule,'itemCat'=>$itemCat,'vCode'=>$vCode,'repType'=>$repType,'dataType'=>'result','offset'=>$start_1,'limit'=>$diff+1));
        
        $totQty = $totValue = 0;
        $sno = 1;
          foreach ($fetchData as $fetchDataGet) {
    ?>

        <tr height="37">
            <td align="center" height="37" width="100"><?=$repType == 's'?'Order No':$fetchDataGet->STD_ORDER_LN?></td>
            <td align="center" width="210"><?=$repType == 's'?$fetchDataGet->STH_ORDER_NO:$fetchDataGet->STD_ITEM_CODE?></td>
            <td align="center" width="210"><?=$repType == 's'?'Order Date : '.$fetchDataGet->STH_TRANS_DATE:$fetchDataGet->I_DESC?></td>
            <td align="center" width="60"><?=$repType == 's'?$fetchDataGet->STH_TOT_QTY:$fetchDataGet->STD_TRANS_QTY?></td>
            <td align="center" width="100"><?=$repType == 's'?number_format($fetchDataGet->STH_GRAND_TOT,2):number_format($fetchDataGet->STD_TRANS_QTY*$fetchDataGet->STD_UNIT_LIST_PRICE,2)?></td>
            
        </tr>
    <?php 
            if($repType == 's'){
                $totQty += $fetchDataGet->STH_TOT_QTY; 
                $totValue += $fetchDataGet->STH_GRAND_TOT; 
                $gQty += $fetchDataGet->STH_TOT_QTY; 
                $gSubTot += $fetchDataGet->STH_GRAND_TOT; 
            }else{
                
                $totQty += $fetchDataGet->STD_TRANS_QTY; 
                $totValue += $fetchDataGet->STD_TRANS_QTY*$fetchDataGet->STD_UNIT_LIST_PRICE; 
                $gQty += $fetchDataGet->STD_TRANS_QTY; 
                $gSubTot += $fetchDataGet->STD_TRANS_QTY*$fetchDataGet->STD_UNIT_LIST_PRICE; 
            }
            
           
        } 
        if($totQty>0){
    ?>
        <tr height="47">
            <td height="22" colspan="2" align="right">&nbsp;</td>
            <td height="22" align="center"><strong>Page Total</strong></td>
            <td align="center" ><strong><?=$totQty?></strong></td>
            <td align="center"><?=number_format($totValue,2)?></td>
        </tr>
    <?php
        //   echo "Part ".($i+1)." starts at ".$start." and ends at ".$end."\n";
           }   
        }
    ?>

        <tr height="47">
            <td height="22" colspan="2" align="right">&nbsp;</td>
            <td height="22" align="center"><strong>Report Total</strong></td>
            <td align="center" ><strong><?=$gQty?></strong></td>
            <td align="center"><?=number_format($gSubTot,2)?></td>
        </tr>
  </table>
  <!--FOOT-->
</div>
</body>
</html>
