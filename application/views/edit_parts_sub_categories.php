

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
                            <h4 class="page-title">Edit Parts Sub Category</h4>
                        </div>
                        
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="col-md-4 col-lg-3" >
                        <div >
                            
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="white-box">
                               
                                   
                                <form  name="frm" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>partsubcategory/update_parts_sub_categories">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Parts Category</label>
                                        <div class="col-md-9">
                                           
                                            <select name="category" class="form-control">
                                                
                                                
                                                
                                                <option>select value</option>
                                            
                                                <?php foreach($rec as $cat){?>
                                                    <option value="<?php echo $cat->id ;?>"><?php echo $cat->name?></option>
                                                    
                                                
                                                <?php } ?>
                                            </select>
                                            <script type="text/javascript">
                                                document.frm.category.value='<?php echo $scat->category?>';
                                            </script> 
                                        </div>
                                    </div>
                                     <div class="form-group">    
                                        <label  class="col-sm-3 control-label">Upload Part Image</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="image" id="image" size="20" />
                                       </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px">
                                         <img style="width:200px;" src="<?php echo base_url('upload/').$scat->image ;?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Part Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" id="mname"value="<?php echo $scat->name?>" required> </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Part Name Arabic</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="arabic_name" class="form-control" id="mname" value="<?php echo $scat->arabic_name?>" required> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Sorting</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="sorting" class="form-control" id="inputEmail3" value="<?php echo $scat->sorting?>" required> </div>
                                    </div>
                                   
                                    <input type="hidden" name="id" value="<?php echo $scat->id?>">
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Update</button>
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



