<?php $this->load->view('common/common_header');?>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper" style="background: white">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        


     
           <?php $this->load->view('common/top_nav');?>
                 <!-- ============================================================== -->
           

            <?php $this->load->view('common/left_nav');?>
                 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Dashboard 1</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
                        <a href="javascript:void(0)" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Buy Admin Now</a>
                        <ol class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">Dashboard 1</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                    
                    <div class="col-md-4 col-lg-3" style="visibility: hidden">
                        <div class="panel wallet-widgets">
                            
                            <div id="morris-area-chart2" style="height:200px"></div>
                            
                        </div>
                    </div>
        <form action="<?php echo base_url()?>carmodel/carmodel" method="post">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    
                    <div class="form-group">
                        <label>Upload Car Image</label>
                        <span class="input-group-btn">
                            <span class="btn btn-primary btn-file">
                                 <?php echo form_upload(['name'=>'userfile'] );?>
                            </span>
                        </span>
                        </div>
                       
                        <div style="margin-top: 25px">
                        <label>Car Name</label>
                        <input type="text" class="form-control" name="carname">
                    </div>
                    <div style="margin-top: 25px">
                        
                        <input type="submit" class="form-control btn btn-primary" value="submit" name="submit">
                    </div>
                </div>
            </div>
        </div>

        </form>
            
            
               
            


            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
       
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo  base_url();?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo  base_url();?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo  base_url();?>assets/js/waves.js"></script>
    <!--Counter js -->
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/morrisjs/morris.js"></script>
    <!-- chartist chart -->
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Calendar JavaScript -->
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/moment/moment.js"></script>
    <script src='<?php echo  base_url();?>assets/plugins/bower_components/calendar/dist/fullcalendar.min.js'></script>
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/calendar/dist/cal-init.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo  base_url();?>assets/js/custom.min.js"></script>
    <script src="<?php echo  base_url();?>assets/js/dashboard1.js"></script>
    <!-- Custom tab JavaScript -->
    <script src="<?php echo  base_url();?>assets/js/cbpFWTabs.js"></script>
    <!-- <script type="text/javascript">
    (function() {
        [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
            new CBPFWTabs(el);
        });
    })();
    </script> -->
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!--Style Switcher -->
    <script src="<?php echo  base_url();?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
