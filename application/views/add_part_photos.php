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
                            <h4 class="page-title">ADD Part Photo</h4>
                        </div>
                       
                    </div>
                   
                    <?php $this->load->view('message');?>
                    <form  name="frm" method="post" action="<?php echo base_url('part_photos/add_part_photos')?>" enctype="multipart/form-data" >
                        <div class="form-body"style="background: white;padding-bottom:30px">
                            <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>
                            <div class="row" style="padding-top: 20px">
                                <div class="col-md-6">
                                    <label  for="inputEmail3" class="col-sm-3 control-label">Upload Part Photo </label>
                                    <div class="col-sm-9">
                                      <input type="file" class= "form-control btn btn-default" name="image"size="20"  />
                                   </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Offer</label>
                                        <div class="col-md-9">
                                            <input type="text" name="offer_text" class="form-control" placeholder="Offer Text"> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="part_id" value="<?php echo $part_id ?>">
                            
                            <div style="padding-left: 600px;margin-top: 30px">
                                <input type="submit" name="submit" class="btn btn-primary" value="submit">
                            </div>
                        </div>
                    </form>  
                
                </div>
                 <?php $this->load->view('common/common_footer')?>
            </div>
        </div>
        
      <?php $this->load->view('common/common_script')?>
    </body>

</html>

        