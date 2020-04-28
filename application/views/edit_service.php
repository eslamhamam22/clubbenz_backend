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
                            <h4 class="page-title">Edit Service Type</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            
                            
                           
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
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>service/service_update">
                                    <?php
                                foreach($rec as $us){?>
                                    <div class="form-group">    
                                        <label  class="col-sm-3 control-label"> Upload Service Icon</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="s_image" id="image" size="20"/>
                                          
                                       </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px">
                                            <img style="width:200px;" src="<?php echo base_url('upload/').$us->image ;?>" >
                                            </div>  
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Service Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="service_name" class="form-control" id="mname"value="<?php echo $us->name ; ?>"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Service Name Arabic</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="service_name_arabic" class="form-control" id="Sname"value="<?php echo $us->arabic_name ; ?>">

                                        </div>
                                        <input type="hidden"  name="id" value="<?php echo $us->id;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Sorting</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="sorting" class="form-control" value="<?php echo $us->sorting?>" required> 
                                        </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 131px">
                                        <div class="checkbox checkbox-circle">
                                                <input id="col-sm-3" name="show_services" type="checkbox" <?php if($us->show_services=='on'){?> checked="checked" <?php }?>>
                                                <label for="checkbox7"> <b>Show On HomePage </b></label>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Update</button>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    <?php $this->load->view("common/common_footer")?>
                </div>
            </div>
         </div>       
        <?php $this->load->view("common/common_script")?>
        
</body>



</html>



