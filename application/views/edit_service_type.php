<?php $this->load->view('common/common_header');?>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="wrapper" style="background: white">
         <?php $this->load->view('common/top_nav');?>
         <?php $this->load->view('common/left_nav');?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Brand</h4>
                    </div>

                </div>
                <div class="col-md-4 col-lg-3" >
                     <div>

                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="white-box">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>service_tag/service_type_update">
                            <?php
foreach ($rec as $us) {
	?>

                                    <input type="hidden" name="id" value="<?php echo $us->id; ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"> Service Type Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control"  placeholder="Enter Service Type Name" value="<?php echo $us->name; ?>">
                                    </div>
                                </div>

                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Update</button>
                                    </div>
                                </div>

                               <?php }?>
                            </form>
                        </div>
                    </div>
                    <?php $this->load->view('common/common_footer')?>
                </div>
            </div>
        </div>
        <?php $this->load->view('common/common_script')?>
</body>

</html>



