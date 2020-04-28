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
                        <h4 class="page-title">Edit parts</h4>
                    </div>
                    
                </div>
                <div class="col-md-4 col-lg-3" >
                     <div>
                        
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="white-box">
                        <form name="frm" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>partcategory/update_parts_categories">
                            <?php
                                foreach($rec as $us){
                            ?>
                            <div class="form-group">    
                                <label for="inputEmail3" class="col-sm-3 control-label"> Upload Image</label>

                                 <div class="col-sm-9">
                                    <input type="file" class= "form-control btn btn-default" name="image" size="20"/>
                                </div>
                            </div>
                            <div class="form-group" style="padding-left: 200px">
                                 <img style="width:200px;" src="<?php echo base_url('upload/').$us->image ;?>" >
                            </div>
                                
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"> Part Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" class="form-control"  placeholder="Part Name" value="<?php echo $us->name; ?>"> 
                                    </div>
                                </div>
                                    <input type="hidden" name="id" value="<?php echo $us->id ;?>">
                                  <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label"> Part Name Arabic</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="arabic_name" class="form-control"  placeholder="Part Arabic Name" value="<?php echo $us->arabic_name; ?>"required> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Sorting</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="sorting" class="form-control" id="inputEmail3" value="<?php echo $us->sorting?>" required> </div>
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
                    <?php $this->load->view('common/common_footer');?>
                </div>
            </div>
        </div>
        <?php $this->load->view('common/common_script');?>
</body>

</html>



