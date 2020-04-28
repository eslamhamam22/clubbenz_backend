<!DOCTYPE html> 
<html lang="en">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="author" content="">
      <link type="image/png" rel="icon"  sizes="16x16" href="<?php echo base_url(); ?>assets/plugins/images/favicon.png">
      <title>Reset Password </title>
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
              <div class="inner-panel" style="background-image: url(<?php echo base_url('upload/bg_image.jpg')?>)">
                  
                  <a href="javascript:void(0)" class="p-20 di"><img src="<?php echo base_url();?>assets/plugins/images/admin-logo.png"></a>
                  <div class="lg-content">
                    
                    <h2>CLUBENZ</h2>
                       <!--  <p class="text-muted">with this admin you can get 2000+ pages, 500+ ui component, 2000+ icons, different demos and many more... </p>
                      <a href="#" class="btn btn-rounded btn-danger p-l-20 p-r-20"> Buy now</a> -->
                  </div>
              </div>
      </div>
      <div class="new-login-box">
        <div class="white-box">
          <?php if(isset($message)) { ?>
                <div class="alert alert-success"> <?php echo $message; ?> </div>
            <?php } else{ ?>
            <h3 class="box-title m-b-0">Update Your Password</h3>
          
          <form class="form-horizontal new-lg-form" method="post"  action="<?php echo base_url('auth/confirmupdatepassword'); ?>" onsubmit="return validatePasseord()">
            
            <div class="form-group  m-t-20">
              <div class="col-xs-12">
                <label>Password</label>
                <input class="form-control" type="password" required="" name="password"  id="password"  placeholder="Password" value="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <label>Confirm Password</label>
                <input class="form-control" type="password" required="" name="c_password" id="c_password"  placeholder="Confirm Password" value="">
				  <input hidden style="display: none" class="form-control" type="text" required="" name="resetToken"  value="<?php echo $_GET['resetToken']?>">
              </div>
            </div>
            <div class="form-group text-center m-t-20">
              <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Update Password</button>
              </div>
            </div>
          </form>
            <?php }?>
         
        </div>
      </div>            
    </section>
    <script>
    function validatePasseord() {
      var password=document.getElementById("password").value;
      var c_password=document.getElementById("c_password").value;


      if(password == c_password){
        return true;
      }else{
        alert('Password and confirm password should be same');
        return false;
      }
         
        }
</script>
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
    <script type="text/javascript" src="<?php echo base_url()?>assets//plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
  </body>
</html>
