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
                            <h4 class="page-title">Update Advertisement</h4>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3" >
                        <div>

                        </div>
                    </div>

                        <div class="col-md-6">
                            <div class="white-box">
                                 <?php $this->load->view('message');?>
                                <form class="form-horizontal" name="frm" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>advertisement/update_advertisement">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Advertisement Type</label>
                                        <div class="col-sm-9">
                                            <select name="type" id="type" class="form-control" onchange="changeResolution();">
                                                <option value="Select Type"><?php echo $row->type ?></option>
                                                <option value="Slider">Slider</option>
                                                <option value="Home Page Bottom">Home Page Bottom</option>
                                                <option value="Listing Page">Listing Page</option>
                                                <option value="Detail page">Detail page</option>
                                                <option value="Reviews">Reviews</option>
                                            </select> <span class="help-block"> </span>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        document.frm.type.value = "<?php echo $row->type; ?>";
                                    </script>
                                    <div class="form-group">
    									<label for="inputEmail3" class="col-sm-3 control-label"> Upload Image</label>
                                        <div class="col-sm-9">
    									  <input type="file" class= "form-control btn btn-default" name="image" id="image" size="20" />
    								        <span style="color: red;" id="imageResolution"></span>
                                       </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px">
                                        <img style="width:200px;" src="<?php echo base_url('upload/') . $row->image; ?>" >
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Page Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="pagename" class="form-control" id="mname" value="<?php echo $row->pagename ?>" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Link</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="link" class="form-control" id="mname" value="<?php echo $row->link ?>" required> </div>
                                            <input type="hidden" name="id" value="<?php echo $row->id ?>">
                                    </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        var x = $("#type").val();
        if(x == "Slider")
            $("#imageResolution").html("Image Resolution should be 400X250");
        if(x == "Home Page Bottom")
            $("#imageResolution").html("Image Resolution should be 380X100");
        if(x == "Listing Page")
            $("#imageResolution").html("Image Resolution should be 400X100");
        if(x == "Detail page")
            $("#imageResolution").html("Image Resolution should be 380X90");
        if(x == "Reviews")
            $("#imageResolution").html("Image Resolution should be 400X100");
        if(x == "")
            $("#imageResolution").html(" ");

    });

    function changeResolution(){
        var x = $("#type").val();
        if(x == "Slider")
            $("#imageResolution").html("Image Resolution should be 400X250");
        if(x == "Home Page Bottom")
            $("#imageResolution").html("Image Resolution should be 380X100");
        if(x == "Listing Page")
            $("#imageResolution").html("Image Resolution should be 400X100");
        if(x == "Detail page")
            $("#imageResolution").html("Image Resolution should be 380X90");
        if(x == "Reviews")
            $("#imageResolution").html("Image Resolution should be 400X100");
        if(x == "")
            $("#imageResolution").html(" ");
    }
</script>
</html>



