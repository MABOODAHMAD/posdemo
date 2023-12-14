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
            $totQty = $totValue = 0;
            foreach ($shortDet as $shortDetGet):
                
        ?>
        
        
        
    
        <div style="width:47%; height:11rem; border:#000000 solid 1px; padding:5px;border-radius: 10px; float: left; margin: 5px;">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="34%" rowspan="4" align="center" valign="middle"><img src="<?=base_url('uploads/images/item/').$shortDetGet->I_IMAGE_FILENAME?>" alt="" title="<?=$shortDetGet->I_IMAGE_FILENAME?>"
                                        class="avatar-md">
                                </td>
                                <td width="66%"><strong><?=$shortDetGet->MICSR_ITEM?></strong><br />
                                    <strong><?=$shortDetGet->MICSR_ITEM_DESC1?></strong>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Price</strong> :<?=numberSystem($shortDetGet->MICSR_VAR_VALUE)?></td>
                            </tr>
                        </table>
                    </div>
            <!-- <tr>
                <td style="height:auto; border:#000000 solid 1px; padding:5px;border-radius: 10px;">
                    
                </td>
            </tr> -->
        <?php endforeach;?>
        <!-- </table> -->
        <br />
        <br />
        <!--FOOT-->
    
</body>

</html>