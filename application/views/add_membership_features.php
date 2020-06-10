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
                            <h4 class="page-title">Add New</h4>
                        </div>

                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="col-md-4 col-lg-3" >
                        <div>

                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="white-box">
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>membership/add_membership_features">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" required> </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="price" class="form-control" id="price" placeholder="Price" required> </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Upload image</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="image" id="image" size="20" required/>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Duration</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="duration" class="form-control" id="duration" placeholder="Duration" required> </div>
                                    </div>

                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button  type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php $this->load->view('common/common_footer');?>
                </div>
            </div>
         </div>
       <?php $this->load->view('common/common_script');?>

</body>

</html>



