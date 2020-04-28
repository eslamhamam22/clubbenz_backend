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
                            <h4 class="page-title">ADD Cluster Error Solution</h4>
                        </div>
                       
                    </div>
                    <?php $this->load->view('message');?>
                    <form  name="frm" method="post" action="<?php echo base_url('car_guide/add_error_solution')?>" enctype="multipart/form-data" >
                        <div class="form-body"style="background: white;padding-bottom:30px">
                            <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>
                            <div class="row" style="padding-top: 20px">
                                
                                <div class="col-md-6" >
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Cluster Error</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="status">
                                                    <option value="S">select Option</option>
                                                    <?php foreach($cluster_error as $cl){ ?>
                                                        <option value="serviceshop">approve</option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Status</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="status">
                                                    <option value="S">select Option</option>
                                                    <option value="workshop">pending</option>
                                                    <option value="serviceshop">approve</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="row margin-top">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            <input type="text" name="title" class="form-control" placeholder=" Title" value="<?php echo $this->input->post("title")?>" /> </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Title Arabic</label>
                                        <div class="col-md-9">
                                            <input type="text" name="title_arabic" class="form-control" placeholder="Title Arabic"value="<?php echo $this->input->post("title_arabic")?>"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-top" id="multiple" style="margin-bottom: 20px;width: 1091px ">
                              <p>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Description</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="4" name="description"><?php  if(!empty($this->input->post('description'))){ echo $this->input->post('description');}?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Description Arabic</label>
                                        <div class="col-md-9">
                                           <textarea class="form-control" rows="4" name="description_arabic"><?php  if(!empty($this->input->post('description_arabic'))){ echo $this->input->post('description_arabic');}?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 margin-top">
                                    <label  for="inputEmail3" class="col-sm-3 control-label"> Image</label>
                                    <div class="col-sm-9">
                                      <input type="file" class= "form-control btn btn-default" name="image"size="20" />
                                    </div>
                                </div>
                                </p>
                            </div>
                            
                             <div style="margin-top:12px;padding-left: 144px; ">
                                <input  type="button" onclick="add_data();" name="btn" class="btn-primary"  value="+">    
                            </div>
                                
                           
                            <div class="margin-top" style="padding-left: 600px;">
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
                var index=0
                function add_data(){
                    index = index +1;
                    $.post("<?php echo base_url()?>car_guide/add_ajax_description",{index: index}, function( data ) {
                        $("#multiple").append(data);
                    });
                }
        </script>
        <script >
           $('.tokenfield').tokenfield({
              autocomplete: {
                source: [],
                delay: 100
              },
              showAutocompleteOnFocus: true
            })
        </script>
    </body>

</html>

        