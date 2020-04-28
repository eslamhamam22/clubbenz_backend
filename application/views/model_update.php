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
                        <h4 class="page-title">Update Class</h4>
                    </div>
                   
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                </div>     
                <div class="col-sm-6">
                    <div class="white-box">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>classes/model_update_value">
                            <?php
                                foreach($rec as $us){
                            ?>
                        	<div class="form-group">	
								<label for="inputEmail3" class="col-sm-4 control-label"> Upload Image</label>

								 <div class="col-sm-8">
									<input type="file" class= "form-control btn btn-default" name="image" size="20"/>
								</div>
                                

							</div>
                            
                            <div  class="form-group" style="padding-left: 150px">


                                <div style="text-align: center;">
                                    <img style="width:200px;" src="<?php echo base_url('upload/').$us->image ;?>" >
                            </div>
                                
                            </div>
                                
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label"> Model Name</label>
                                <div class="col-sm-8">
                                    <input type="text" name="model_name" class="form-control"  placeholder="Model Name" value="<?php echo $us->name; ?>"required> 
                                </div>
                            </div>
                            <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label"> Model Name Arabic</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="model_name_arabic" class="form-control" id="mname" value="<?php echo $us->arabic_name; ?>" required> </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Sorting</label>
                                <div class="col-sm-8">
                                    <input type="text" name="sorting" value="<?php echo $us->sorting;?>" class="form-control" required> 
                                </div>
                            </div>
                                    
                                    <input type="hidden" name="id" value="<?php echo $us->id ;?>">

                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-4 col-sm-8">
                                        <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Update</button>
                                    </div>
                                </div>
                            
                               <?php }?> 
                            </form>
                        </div>
                    </div>
                    <?php $this->load->view("common/common_footer")?>
                </div>
              </div>  
            </div>
        </div>
       <?php $this->load->view("common/common_script")?>
</body>

</html>



