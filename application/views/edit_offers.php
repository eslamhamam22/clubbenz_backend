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
                            <h4 class="page-title">Edit Offer</h4>
                        </div>
                       
                    </div>
                   
                    
                    <form  name="frm" method="post" action="<?php echo base_url('offers/update_offers')?>" enctype="multipart/form-data" >
                        <div class="form-body"style="background: white;padding-bottom:30px">
                            <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>
                            <div class="row" style="padding-top: 20px">
                                <div class="col-md-6">
                                    
                                       
                                    <label  for="inputEmail3" class="col-sm-3 control-label"> Offer Photo</label>
                                    <div class="col-sm-9">
                                      <input type="file" class= "form-control btn btn-default" name="image"size="20" multiple="multiple"  />
                                      <br><span style="color: red; font-size: 12px;">Image size should be 400X310</span>
                                   </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Offer Text</label>
                                        <div class="col-md-9">
                                            <input type="text" name="offer_text" class="form-control" value="<?php echo $rec->offer_text;?>"> </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group margin-top" style="padding-left: 200px">
                                        <img style="width:200px;" src="<?php echo base_url('upload/').$rec->image ;?>" >
                                    </div>
                            
                            
                                
                          
                            
                            <div class="row" style="margin-top: 80px ">    
                               
                                 <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Offer Text Arabic</label>
                                        <div class="col-md-9">
                                            <input type="text" name="offer_text_arabic" class="form-control" value="<?php echo $rec->offer_text_arabic;?>"> </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Link</label>
                                        <div class="col-md-9">
                                            <input type="text"  name="link" class="form-control" value="<?php echo $rec->link;?>"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-top"> 
                                    <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Offer End Date</label>
                                        <div class="col-md-9">
                                            <?php $date= $rec->offer_end!='0000-00-00' ? $rec->offer_end :"" ; ?>
                                            <input type="text" data-date-format='yyyy-mm-dd' id="datepicker"  name="offer_end" class="form-control" autocomplete="off" value="<?php echo $date ;?>"> </div>
                                    </div>
                                </div>
                            </div>   
                            <input type="hidden" name="type" value="<?php echo $rec->type ?>">
                            <input type="hidden" name="shop_id" value="<?php echo $rec->shop_id ?>">
                            <input type="hidden" name="offer_id" value="<?php echo $rec->id ?>">
                            
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
      <script type="text/javascript">
            $("#datepicker").datepicker().datepicker( new Date());
        </script>
        
        
        

    </body>

</html>

        