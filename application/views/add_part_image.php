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
                            <h4 class="page-title">Add Part Image</h4>
                        </div>
                        
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="col-md-4 col-lg-3" >
                        <div >
                            
                        </div>
                    </div>

                        <div class="col-md-6">
                            <div class="white-box">
                                 <?php $this->load->view('message');?>
                                 
                                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>part_photos/add_part_photos/<?php echo $part_id ?>">
                                    <input type="hidden" name="part_id" value="<?php echo $part_id;?>">
                                    <div class="form-group">    
                                        <label  class="col-sm-3 control-label">Upload Image</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="image" id="image" size="20" required />
                                       </div>
                                    </div>
                                    <div class="form-group">    
                                        <label  class="col-sm-3 control-label">Default Image</label>
                                        <div class="col-sm-9">
                                        <select class= "form-control" name="is_default">
                                            <option value="">Select Option</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>  
                                       </div>
                                    </div>
                                    
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
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



