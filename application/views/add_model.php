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
                        <div class="col-lg-12 col-md-12 col-sm-4 col-xs-12">
                            <h4 class="page-title">Add class</h4>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-3">
                    </div>    
                    <div class="col-sm-6">
                        <div class="white-box">
                             <?php $this->load->view('message');?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>classes/add_model">
                                <div class="form-group">	
									<label for="inputEmail3" class="col-sm-4 control-label"> Upload Profile Image</label>
                                    <div class="col-sm-8">
									  <input type="file" class= "form-control btn btn-default" name="image" id="image" size="20" required />
								   </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label"> Model Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="model_name" class="form-control" id="mname" placeholder="Model Name" required> </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label"> Model Name Arabic</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="model_name_arabic" class="form-control" id="mname" placeholder="Model Name Arabic" required> </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Sorting</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="sorting" class="form-control" id="inputEmail3" placeholder="sorting" required> </div>
                                </div>
                                <div class="form-group m-b-0">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <?php $this->load->view("common/common_footer") ;?>
                </div>
            </div>
         </div>       
        
        <?php $this->load->view("common/common_script") ;?>
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



