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
                            <h4 class="page-title">Add Services Shop Type</h4>
                        </div>
                        
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="col-md-4 col-lg-3" >
                        <div >
                            
                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="white-box">
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>service/add_services">
                                    <div class="form-group">	
    									<label for="inputEmail3" class="col-sm-3 control-label"> Upload Service Icon</label>
                                        <div class="col-sm-9">
    									  <input type="file" class= "form-control btn btn-default" name="s_image" id="image" size="20"/>
    								   </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Service Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="service_name" class="form-control" id="mname" placeholder="Service Name"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Service Name Arabic</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="service_name_arabic" class="form-control" id="Sname" placeholder="Service Name Arabic"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Sorting</label>
                                        <div class="col-sm-9">
                                        <input type="text" name="sorting" class="form-control" id="inputEmail3" placeholder="sorting" required> </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 131px">
                                        <div class="checkbox checkbox-circle">
                                                <input id="col-sm-3" name="show_services" type="checkbox">
                                                <label for="checkbox7"> <b>Show On HomePage </b></label>
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



