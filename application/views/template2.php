<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title ?></title>
         <?php $this->load->view('links'); ?>

    </head>
    <body>
        <div class="section" >
            <div class="container" >
                <?php $this->load->view($content); ?>
            </div>
        </div>
        <?php $this->load->view('footer'); ?>


        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo asset_url() ?>/js/bootstrap.min.js"></script>    
    </body>
</html>