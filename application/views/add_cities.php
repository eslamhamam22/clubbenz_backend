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
                            <h4 class="page-title">Add States</h4>
                        </div>

                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="col-md-4 col-lg-3" >
                        <div>

                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="white-box">
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>membership/add_cities">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" required> </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Name Ar</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name_ar" class="form-control" id="name_ar" placeholder="Name Ar" required> </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">States</label>
                                        <div class="col-sm-9">
                                            <select name="state_id" class="form-control" style="width: 400px ; margin-top: 20px">
                                                <option>Select States</option>
                                                <?php foreach ($states as $name) {?>
                                                    <?php echo '<option value="' . $name->id . '">' . $name->name . '</option>'; ?>
                                                <?php }?>
                                            </select>
                                        </div>
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
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css">
       <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
</body>

</html>



