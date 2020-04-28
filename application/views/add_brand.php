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
                            <h4 class="page-title">Add Brand</h4>
                        </div>
                        
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="col-md-4 col-lg-3" >
                        <div >
                            <div id="morris-area-chart2" style="height:2px;visibility: hidden;"></div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="white-box">
                                <?php $this->load->view('message');?>
                                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>brand/add_brand">
                                    <div class="form-group">	
    									<label for="inputEmail3" class="col-sm-3 control-label"> Image</label>
                                        <div class="col-sm-9">
    									   <input type="file" class= "form-control btn btn-default" name="image" id="image" title="Image size should be 400X100" size="20" required />
    								        <span style="color: red">Image Resolution should be 400X100.</span>
                                       </div>
                                    </div>
                                    <div id=popup class="alert-box success"></div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Brand Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" id="mname" placeholder="Part Name" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Brand Name Arabic</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="arabic_name" class="form-control" id="mname" placeholder="Arabic Name" required> </div>
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
<script type="text/javascript">

        $(function(){
        	$("#btn") .click(function(){
        		if($('#image').val()==''  || $('#mname').val()==''){
        			alert('your form empty filed');
        			 	return false;
        			}
        		});
        	}

        $( "#submit" ).click(function() {
            $('#popup').html('<h4> added Successfully</h4>');
                $( "div.success" ).fadeIn( 100 ).delay( 3000 ).fadeOut( 2000 );
             });


      
		

	</script>



</html>



