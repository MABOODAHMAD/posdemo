<table class="main" width="100%" cellpadding="0" cellspacing="0"
    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px;  margin: 0; border: none;">
    <tr
        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <td class="content-wrap aligncenter"
            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;padding: 20px; color: #495057; border: 2px solid #1d1e3a;border-radius: 7px; background-color: #fff;"
            align="center" valign="top">


            <table width="100%" cellpadding="0" cellspacing="0"
                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <tr
                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">

                    <td class="content-block" style="
                    font-family: 'Helvetica  Neue',Helvetica,Arial,sans-serif; 
                    box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign=" top ">

                        <table width="100% " border="0 " cellpadding="0 " cellspacing="0 ">
                            <tr>
                                <td><img src="http://moallim.e-invoicesaudi.com/assets/images/logo-dark.png "
                                        alt="logo " height="40px "> </td>

                                <td>
                                    <h2 class="aligncenter "
                                        style="font-family: 'Helvetica Neue',Helvetica,Arial, 'Lucida Grande',sans-serif; box-sizing: border-box; font-size: 24px; color: #000; line-height: 1.2em; font-weight: 400; text-align: center; margin: 40px 0 0; "
                                        align="center "><?=$head?> VOUCHER</h2>
                                </td>
                                <td align="right "><b>Al Moallim Jewellery</b> <br
                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; " />
                                    Voucher No #<?=$detail->PV_ORDER_PRE.'-'.$detail->PV_ORDER_NO?> <br
                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; " />
                                    <?=date('d-M Y', strtotime($detail->PV_DATE))?></td>
                            </tr>
                            <tr class="total "
                                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; ">
                                <td colspan="3 " align="right " valign="top " class="alignright "
                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; font-weight: 700; margin: 0; padding: 5px 0; ">
                                    &nbsp;</td>
                            </tr>
                            <tr>
                                <td>Doc No : </td>
                                <td>&nbsp;</td>
                                <td>Print Date : <?=date('d-M Y', strtotime(date('Y-m-d')))?></td>
                            </tr>
                            <tr>
                                <td>Showroom : </td>
                                <td>&nbsp;</td>
                                <td>Receipt Date : <?=date('d-M Y', strtotime($detail->PV_DATE))?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr
                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; ">
                    <td class="content-block aligncenter "
                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px; "
                        align="center " valign="top ">
                        <table class="invoice "
                            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; text-align: left; width: 100%; margin: 40px auto; ">
                            <tr
                                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; ">
                                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0; "
                                    valign="top ">
                                    <p><b>Name</b>
                                        <br
                                            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; " />
                                        <?=$detail->V_NAME.' '.$detail->V_NAME_AR?>
                                    </p>
                                </td>
                            </tr>
                            <tr
                                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; ">
                                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 5px 0; "
                                    valign="top ">
                                    <table class="invoice-items " cellpadding="0 " cellspacing="0 "
                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; margin: 0; ">

                                        <tr
                                            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; ">
                                            <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0; "
                                                valign="top "><?=$detail->PM_DESC?></td>
                                            <td width="41% " align="right " valign="top " class="alignright "
                                                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0; ">
                                                &nbsp;</td>
                                            <td width="20% " align="right " valign="top " class="alignright "
                                                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 1px; border-top-color: #eee; border-top-style: solid; margin: 0; padding: 5px 0; ">
                                                <?=sysCur().' '.$detail->PV_AMT?> </td>
                                        </tr>
                                        <tr class="total "
                                            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; ">
                                            <td class="alignright " width="39% "
                                                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0; "
                                                align="right " valign="top ">&nbsp;</td>
                                            <td class="alignright "
                                                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0; "
                                                align="right " valign="top "><span class="alignright "
                                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0; ">Total</span>
                                            </td>
                                            <td class="alignright "
                                                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: right; border-top-width: 2px; border-top-color: #333; border-top-style: solid; border-bottom-color: #333; border-bottom-width: 2px; border-bottom-style: solid; font-weight: 700; margin: 0; padding: 5px 0; "
                                                align="right " valign="top "><?=sysCur().' '.$detail->PV_AMT?> </td>
                                        </tr>
                                    </table>

                                    <table width="100% " class="table table-bordered ">
                                        <tbody>

                                            <tr>
                                                <td width="35% " align="right ">
                                                    <div align="center "><b>Showroom Manager</b> </div>
                                                </td>
                                                <td width="30% " align="left ">
                                                    <div align="center "><strong><span
                                                                id="tot-qty ">Receiver</span></strong></div>
                                                </td>
                                                <td width="35% " align="right ">
                                                    <div align="center "><b>Account:</b> </div>
                                                </td>
                                            </tr>

                                            <!-- strt -->

                                            <!-- end -->
                                            <!-- <tr style="display:none; "> -->
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr
                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; ">
                    <td class="content-block aligncenter "
                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 0 0 20px; "
                        align="center " valign="top ">
                        Al Moallim Jewellery Inc. 2896 Howell Rd, Russellville, AR, 72823 </td>
                </tr>

                <tr
                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0; ">
                    <td class="content-block "
                        style="text-align: center;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0; "
                        valign="top ">
                        © Al Moallim Jewellery </td>
                </tr>
            </table>


        </td>
    </tr>
</table>