<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo config('app.name', 'DHL') ?></title>

        <!-- Vendor CSS -->
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">        
        <link href="<?php echo env('APP_URL22'); ?>/vendors/bower_components/google-material-color/dist/palette.css" rel="stylesheet">
        
        <!-- CSS -->
        <link href="<?php echo env('APP_URL22'); ?>/css/app.min.1.css" rel="stylesheet">
        <link href="<?php echo env('APP_URL22'); ?>/css/app.min.2.css" rel="stylesheet"> 
         <script src="<?php echo env('APP_URL22'); ?>/vendors/bower_components/jquery/dist/jquery.min.js"></script>
          <script src="<?php echo env('APP_URL22'); ?>/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>

          <script type="text/javascript">
               jQuery(document).ready(function($) {
                    function notify22(message, type){
                        $.growl({
                            message: message
                        },{
                            type: type,
                            allow_dismiss: false,
                            label: 'Cancel',
                            className: 'btn-xs btn-inverse',
                            placement: {
                                from: 'top',
                                align: 'right'
                            },
                            delay: 2500,
                            animate: {
                                    enter: 'animated fadeInDown',
                                    exit: 'animated fadeOutUp'
                            },
                            offset: {
                                x: 20,
                                y: 25
                            }
                        });
                    };

                    <?php if($errors->has('email')){ ?> 

                          notify22('Incorrect Login Credentials. Please try again.','danger')
                <?php } ?>

                <?php if(isset($_GET['nopermission'])){ ?>
                         notify22('Restriced Access! Only administrator can login.','warning')
                 history.pushState(null, null, '/login');
                 <?php } ?>


                }); 

                

          </script>


    </head>
    <body >
 

<div class="login" data-lbg="teal">
            <!-- Login -->
            <div class="l-block " style="display: inline-block;" id="l-login">
                <div class="lb-header palette-Teal bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    Hi there! Please Sign in
                </div>

                <div class="lb-body">
                   
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        


                        <div class="form-group fg-float">
                        <div class="fg-line">
                            <input  id="email" type="email"  name="email" value="{{ old('email') }}" required autofocus class="input-sm form-control fg-input">
                            <label class="fg-label">Email Address</label>
                        </div>
                        
                    </div>

                    <div class="form-group fg-float">
                        <div class="fg-line">
                            <input id="password" type="password" name="password" class="input-sm form-control fg-input" required>
                            <label class="fg-label">Password</label>
                        </div>

                        
                    </div>



                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="">
                                    <label>
                                        <input type="checkbox"  name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn palette-Teal bg">Sign in</button>


                        <div class="m-t-20">
                        <!-- <a data-block="#l-register" data-bg="blue" class="palette-Teal text d-block m-b-5" href="">Creat an account</a> -->
                        <a data-block="#l-forget-password" data-bg="purple" href="" class="palette-Teal text">Forgot password?</a>
                        </div>

                        <!-- <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div> -->
                    </form>


                    

                    

                    
                </div>
            </div>

            

            
        </div>

@include('include/footer')