<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo csrf_token() ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <title><?php echo config('app.name', 'DHL') ?></title>

        <!-- Vendor CSS -->
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">        
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/google-material-color/dist/palette.css" rel="stylesheet">
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
       <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">
        
        <!-- CSS -->
        <link href="<?php echo env('APP_URL22'); ?>/css/app.css" rel="stylesheet">
        
        <link href="<?php echo env('APP_URL22'); ?>/css/app.min.2.css" rel="stylesheet">
        <link href="<?php echo env('APP_URL22'); ?>/css/app.min.1.css" rel="stylesheet">
        <!-- js --> 
        <script src="<?php echo env('APP_URL22'); ?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo env('APP_URL22'); ?>/js/jquery-ui.min.js"></script>
        <script src="<?php echo env('APP_URL22'); ?>/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo env('APP_URL22'); ?>/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="<?php echo env('APP_URL22'); ?>/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
         <script src="<?php echo env('APP_URL22'); ?>/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <!-- js end -->
        <style type="text/css">
            #example_length{ margin-left: 40px; }
            #example_info{ margin-left: 40px; margin-top: 10px; }
            #example_filter,#example_paginate{ margin-right:14px; padding-bottom: 20px; }
            .cta_add{position: absolute;right: 30px; top: 21px;}
            .sixteen.wide.column{    width: 99%!important;
    margin-left: 3%;}
    .action-header .actions{ z-index: 40; }
        </style>
        <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script type="text/javascript">
    var APP_URL = '<?php echo env('APP_URL22'); ?>';
    
    </script>
    </head>
    <body data-ma-header="teal">
    <?php echo env('APP_URL'); ?>