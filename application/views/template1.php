<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title ?></title>
        <script src="<?php echo asset_url() ?>/js/jquery.js"></script>
        <!--        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
        <link href="<?php echo asset_url() ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo asset_url() ?>/css/gridStyle.css" rel="stylesheet">
        <link href="<?php echo asset_url() ?>/css/MenuStyle.css" rel="stylesheet">
<!--        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
        <script src="<?php echo asset_url() ?>js/autocomplete.js"></script>

    </head>
    <body>
        <table cellpadding="0" align="center" cellspacing="0" width="100%">
            <tr valign="baseline">
                <td>   </td>
                <td align="left">
                    <img id="Master1_mpowerlogo" src="../../Images/Common/mPowerLogo.jpg" style="height:70px;border-width:0px;">
                </td>
                <td align="left">             </td>
                <td class="Info">
                </td>
                <td align="left" class="Info" style="text-align: right">
                    <span id="Master1_lblUserInfo" class="infoBold"><?php
                        $CI = & get_instance();
                        echo $CI->repname;
                        ?></span>
                </td>
<!--                <td style="text-align: right;" align="right" colspan="">
                    <img id="Master1_custlogo" src="" style="height:70px;border-width:0px;">

                </td>-->
            </tr>
            <tr>
            <div id="Master1_menuMaster" >
                <table style="visibility: visible;" cellpadding="0" border="0" cellspacing="1" class="TopGroup" >
                    <tbody>
                        <tr>
                            <td align="left" style="padding-left:10px;padding-right:10px;" class="TopItem">Home</td>
                            <td align="left" style="padding-left:10px;padding-right:10px;" class="TopItem">Master</td>
                            <td align="left" style="padding-left:10px;padding-right:10px;" class="TopItem">Field Work</td>
                            <td align="left" style="padding-left:10px;padding-right:10px;" class="TopItem">Broadcast</td>
                            <td align="left" style="padding-left:10px;padding-right:10px;" class="TopItem">Security</td>
                            <td align="left" style="padding-left:10px;padding-right:10px;" class="TopItem">Service</td>
                            <td align="left" style="padding-left:10px;padding-right:10px;" class="TopItem">CCP</td>
                            <td align="left" style="padding-left:10px;padding-right:10px;" class="TopItem"><a href="logout">Logout</a></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </tr>

    </table>
    <div class="container">
        <h5 class="Info" style="margin: 0;"><?php echo $title ?></h5>
        <hr>
        <?php $this->load->view($content, $view_data); ?>
    </div>
</body>
</html>