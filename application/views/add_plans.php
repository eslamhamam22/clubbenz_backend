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
                            <h4 class="page-title">Add Plans Type</h4>
                        </div>

                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="col-md-4 col-lg-3" >
                        <div>

                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="white-box">
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>plan/add_plans">
                                    <div class="form-group">
    									<label for="inputEmail3" class="col-sm-3 control-label"> Upload Plan Photo</label>
                                        <div class="col-sm-9">
    									  <input type="file" class= "form-control btn btn-default" name="photo" id="photo" size="20" required/>
    								   </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" class="form-control" id="title" placeholder="title" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Parts</label>
                                        <div class="col-sm-9">
                                        <input type="number" name="num_parts" class="form-control" id="num_parts" placeholder="num parts" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Featured</label>
                                        <div class="col-sm-9">
                                        <input type="number" name="num_featured" class="form-control" id="num_featured" placeholder="num featured" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Price</label>
                                        <div class="col-sm-9">
                                        <input type="number" name="price" class="form-control" id="price" placeholder="price" maxlength="6" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Frequency</label>
                                        <div class="col-sm-9">
                                            <select id="frequency"  name="frequency" class="form-control" required>
                                                <option value="3">3 month</option>
                                                <option value="6">6 month</option>
                                                <option value="9">9 month</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Extra Days</label>
                                        <div class="col-sm-9">
                                        <input type="number" name="extra_days" class="form-control" id="extra_days" placeholder="Extra Days" required> </div>
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

        $( "#submit" ).click(function() {
            $('#popup').html('<h4> added Successfully</h4>');
                $( "div.success" ).fadeIn( 100 ).delay( 3000 ).fadeOut( 2000 );
             });





	</script>



</html>



