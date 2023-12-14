<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mohammad Othman Al-Moallim  VAT Invoice Arbic (<?=$headerDet->SH_INV_PREFIX?"Invoice":"Order"?> #<?=$headerDet->SH_INV_PREFIX?$headerDet->SH_INV_PREFIX:$headerDet->SH_ORDER_PREFIX?>-<?=$headerDet->SH_INV_PREFIX?$headerDet->SH_INV_NO:$headerDet->SH_ORDER_NO?>)</title>
</head>
<body>
    <style type="text/css">

body {
	color: #000000;
	background: #FFF;
	font-family: 'Open Sans',sans-serif;
	padding: 0px !important;
	margin: 0px !important;
	font-size: 11px;
	letter-spacing: 0px;
	text-rendering: optimizeLegibility;
}
.style1 {
	font-size: 24px;
	font-weight: bold;
}
td{
	padding: 2px 2px 2px 5px;
	
}

	.sdbod-l
		{
			border-left: #000 solid 1px;
		}
	
	.sdbod-r
		{
			border-right:#000 solid 1px;
		}
	.sdbod-t
		{
			border-top:#000 solid 1px;
		}
	.sdbod-b
		{
			border-bottom: #000 solid 1px;
		}
.avatar-md {
    height: 5.5rem;
    width: 5rem;
}
</style>

<div style="width:780px;height:auto; border:#FF0000 solid 0px; padding:5px">
<!--HEAD-->

<!--#################### HEAD START  ##############################-->
  <!--#++++++++++++++++++  A4- landscape +++++++++++++#-->
  
  
   
  
  <!--#################### HEAD END  ##############################-->
  <!--MID-->


  <table width="100%" border="0" cellpadding="0" cellspacing="0"  style="margin-bottom: 0.3rem;">
                                            <thead>
                                                <tr>
                                                  <th width="10%" align="center" bgcolor="#E4E4E4" style="text-align: center;">رقم القطعه</th>
                                                    <th width="40%" align="center" bgcolor="#E4E4E4" style="text-align: center;">وصف القطعة</th>
                                                    <th width="2%" align="center" bgcolor="#E4E4E4" style="text-align: center;">الوحدة</th>
                                                    <th width="2%" align="center" bgcolor="#E4E4E4" style="text-align: center;">الكمية</th>
                                                    <!--<th width="15%">السعر القطعة</th>-->
                                                    <!--<th width="15%">Total Discount</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sn = 1; foreach ($detailsLists as $poItemDet): $weight = itemGoldDia($poItemDet->SD_ITEM_CODE);?>
    <tr>
              <td width="5%" style="text-align: center; border-bottom:#000000 solid 1px;"><?php if($poItemDet->I_PRINTABLE == 'Y'){ ?><img src="<?=base_url('uploads/images/item/').$poItemDet->I_IMAGE_FILENAME?>" alt="" title="<?=$poItemDet->I_IMAGE_FILENAME?>" class="avatar-md"><?php }else{ ?><img src="<?=base_url('uploads/images/item/no_image.png')?>" alt="no_image" title="no_image" class="avatar-md"><?php } ?> <?=$poItemDet->SD_ITEM_CODE?></td>
                <td width="25%" style="text-align: center; border-bottom:#000000 solid 1px;">
                    <?//=$poItemDet->I_DESC?><!--<br>-->
                    <?=$poItemDet->I_EXTEND_DESC?>
                    <div style="font-size: 11px;"> <?=$weight->gold?'Go:'.$weight->gold:''?><?=$weight->diamond?',Di:'.$weight->diamond:''?> <?php if($poItemDet->I_CLEARITY){ ?>,&nbsp;&nbsp;|&nbsp;&nbsp; درجة نقاء الالماس : VS:<?=$poItemDet->I_CLEARITY?> ,<?php }if($poItemDet->I_CLR_COLOR){ ?> لون G:<?=$poItemDet->I_CLR_COLOR?> <?php }?></div>        </td>
                <td width="2%" style="font-size: 11px; text-align: center; border-bottom:#000000 solid 1px;"><?=$poItemDet->I_UOM_CODE?></td>
                <td width="2%" style="text-align: center; border-bottom:#000000 solid 1px;"><?=$poItemDet->SD_QTY?></td>
                </tr>
                                                <?php $sn++; endforeach; ?>
                                                
                                                <?php if($sn<9){
		$i1=$sn+1; for($j=$i1;$j<=9;$j++){ ?>
		
		<tr>
            <td width="5%" style="text-align: center; border-bottom:#000000 solid 1px;" height="65">&nbsp;</td>
            <td width="15%" style="text-align: center; border-bottom:#000000 solid 1px;">&nbsp;</td>
            <td width="2%" style="text-align: center; border-bottom:#000000 solid 1px;">&nbsp;</td>
            <td width="2%" style="text-align: center; border-bottom:#000000 solid 1px;">&nbsp;</td>
            </tr>
  
  <?php } } ?>
                                            </tbody>
  </table>
 <!--MID-->
 
  <!--FOOT-->
  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="">
  
   <tr>
    <td width="37%"  align="center" valign="top"  class="">&nbsp;</td>
    <td width="36%"  align="center" class="">               </td>
    <td width="14%" align="right" bgcolor="#C9C9C9" class="sdbod-b sdbod-t sdbod-l sdbod-r"><b>اجمالى الكميه</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="5%" align="right" bgcolor="#C9C9C9" class="sdbod-b sdbod-t sdbod-l sdbod-r"> <span id="tot-qty"> <?=$headerDet->SH_TOT_QTY?></span></td>
    </tr>
  </table>
  
  
  <!--terms-->
  
  

 
 
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1.5rem;">
  <tr>
    <td width="27%" align="center" style="font-size: 12px;">أصدرت من قبل <br>
      Abdullah Alamoudi</td>
    <td width="5%">&nbsp;</td>
    
    
    <td width="26%" align="center" style="font-size: 12px;">البائع <br>
      Basil aL Sadat</td>
      
    <td width="6%">&nbsp;</td>
    <td width="36%" align="center" style="font-size: 13px;">
توقيع العميل
-
استلمت القطع با لموصفات المو ضحه بالفاتورة
  <br>
وانا علی علم بسیا سه الا ستبدال و الا سترجاع      </td>

    </tr>
  <tr>
    <td class="sdbod-b">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="sdbod-b">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="sdbod-b">&nbsp;</td>
    </tr>
</table>
 
 
 
 
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  
  <tr>
  <td width="18%">E-Invoice QR Code <img src="<?=$qr_image?>" alt="" width="150" height="150"></td>
    <td width="80%" dir="RTL" ><div align="right" style="font-size: 12px;">  * شروط استرجاع او تبديل البضاعه المباعه <br />
      &#8226; -البضاعه المباعه تستبدل خلال 48 ساعه من تاريخ الشراء مع وجود أصل فاتورة الشراء  <br />
      &#8226; -البضاعه المباعه ترجع قبل اغلاق المحل فى نفس يوم الشراء مع وجود أصل فاتورة الشراء  <br />
      &#8226; -البضاعه المباعه خلال العروض الموسمية تستبدل او ترجع قبل اغلاق المحل فى نفس يوم الشراء مع وجود أصل فاتورة الشراء  <br />
      &#8226; -في حال وجود تلف من سوء الاستخدام سيتحمل العميل تكلفه الاصلاح  <br />

      &#8226; - عند اجراء اي اصلاح او تعديل على القطعة خارج معارضنا فلن يتم قبولها للاصلاح مرة اخري من قبل معارضنا   <br />
      &#8226; - يتم استقبال قطع الاصلاح بمدينه جدة بمعرض المنار فقط بشارع التحليه ت: 6644123 مع ضرورة احضار اصل فاتورة الشراء  <br />
 &#8226; - almoallimjewelrysa.com للتسوق عبر الموقع الالكترونى والتطبيق زورونا على 
	  </div></td>
    
    </tr>
  <tr>
    <td><img src="assets/images/scan.jpg"  style="width: 150px;"/>        </td>
    <td valign="top" dir="RTL"><div align="right" style="font-size: 12px;"><strong> : تفضلو بزيارة معارضنا في كل من 
    </strong>
	<br />

جدة:شارع التحلية،مرآز المنار[ 6655306 ] سوق جدة الدولي[ 2632639 ] سوق حراء الدولي [ 6541362 ]
<br />
الرياض: شارع العليا العام بجوار مرآز المملكه[ 2169002 ] شارع العليا العام بجوار فندق نارسيس[ 2931562 ]
<br />
8990182 ] ] الخبر: مجمع الراشد التجاري بوابة رقم</div></td>
    
    </tr>
</table>




</div>
 
</body>
</html>