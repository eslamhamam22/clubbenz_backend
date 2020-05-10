<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <link type="image/png" rel="icon"  sizes="16x16" href="<?php echo base_url(); ?>assets/plugins/images/favicon.png">
      <title>Ample Admin Template - The Ultimate Multipurpose admin template</title>
      <link href="<?php echo base_url(); ?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url(); ?>assets/css/spinners.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url(); ?>assets/css/colors/default.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="preloader">
      <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="new-login-register">
      <div class="lg-info-panel">
              <div class="inner-panel" style="background-image: url(<?php echo base_url('upload/bg_image.jpg') ?>)">

                  <a href="javascript:void(0)" class="p-20 di"><img src="<?php echo base_url() ?>assets/plugins/images/admin-logo.png"></a>
                  <div class="lg-content">

                    <h2>CLUBENZ</h2>
                       <!--  <p class="text-muted">with this admin you can get 2000+ pages, 500+ ui component, 2000+ icons, different demos and many more... </p>
                      <a href="#" class="btn btn-rounded btn-danger p-l-20 p-r-20"> Buy now</a> -->
                  </div>
              </div>
      </div>
      <div class="new-login-box">
        <div class="white-box">
          <?php if (isset($message)) {?>
                <div class="alert alert-danger"> <?php echo $message; ?> </div>
            <?php }?>
            <h3 class="box-title m-b-0">Spare Parts Catalogue Portal</h3>
            <small>Enter your details below</small>
          <form class="form-horizontal new-lg-form" method="post" id="loginform" action="<?php echo base_url('provider/auth/login'); ?>">

            <div class="form-group  m-t-20">
              <div class="col-xs-12">
                <label>Email</label>
                <input class="form-control" type="text" required=""name="username" placeholder="Email" value="<?php echo $this->input->cookie('cp_username'); ?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <label>Password</label>
                <input class="form-control" type="password" required="" name="password"placeholder="Password" value="<?php echo $this->input->cookie('cp_password'); ?>">
              </div>
            </div>
<!--            <div class="form-group">-->
<!--              <div class="col-md-12">-->
<!--                <div class="checkbox checkbox-info pull-left p-t-0">-->
<!--                  <input id="checkbox-signup" type="checkbox">-->
<!--                  <label for="checkbox-signup"> Remember me </label>-->
<!--                </div>-->
<!--                <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>-->
<!--            </div>-->
            <div class="form-group text-center m-t-20">
              <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Log In</button>
              </div>
            </div>
<!--            <div class="row">-->
<!--              <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">-->
<!--                <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>-->
<!--              </div>-->
<!--            </div>-->
            <div class="form-group m-b-0">
              <div class="col-sm-12 text-center">
                <p>Don't have an account? <a href="<?php echo site_url('provider/auth/register'); ?>" class="text-primary m-l-5"><b>Sign Up</b></a></p>
              </div>
            </div>
          </form>
          <form class="form-horizontal" id="recoverform" action="<?php echo site_url('provider/auth/forgotPass'); ?>">
            <div class="form-group ">
              <div class="col-xs-12">
                <h3>Recover Password</h3>
                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
              </div>
            </div>
            <div class="form-group ">
              <div class="col-xs-12">
                <input class="form-control" type="text" required="" placeholder="Email">
              </div>
            </div>
            <div class="form-group text-center m-t-20">
              <div class="col-xs-12">
                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <!--Style Switcher -->
    <script type="text/javascript" src="<?php echo base_url() ?>assets//plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
  </body>
</html>
