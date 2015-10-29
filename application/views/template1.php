<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title ?></title>
        <script src="<?php echo asset_url() ?>/js/jquery.js"></script>
<!--        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
        <link href="<?php echo asset_url() ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo asset_url() ?>/css/gridStyle.css" rel="stylesheet">
<!--        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
        <script src="<?php echo asset_url() ?>js/autocomplete.js"></script>

    </head>
    <body>
        <table>
            <tr>
                <th class="menu">Home</th>
                <th class="menu">Master</th> 
                <th class="menu">Field Work</th>
                <th class="menu">Broad Cast</th> 
                <th class="menu">Security</th>
            </tr>
        </table>

        <div class="container">
            <p><?php echo $title ?></p>
            <hr>
            <?php $this->load->view($content, $view_data); ?>
        </div>
    </body>
</html>