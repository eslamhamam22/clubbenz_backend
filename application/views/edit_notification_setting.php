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
                            <h4 class="page-title">Edit Plan Type</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">



                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="col-md-4 col-lg-3" >
                        <div >

                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="white-box">
                                 <?php $this->load->view('message');?>
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>push_notification/update_notification_setting">
                                    <?php
foreach ($rec as $us) {?>
                                        <input type="hidden"  name="id" value="<?php echo $us->id; ?>">


                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Interval Hours</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="interval_hours" class="form-control" id="interval_hours"value="<?php echo $us->interval_hours; ?>" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Max Distance (km)</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="max_distance" class="form-control" step="0.01" id="max_distance"value="<?php echo $us->max_distance; ?>" required>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Message</label>
                                        <div class="col-sm-9">
                                            <textarea name="message" class="form-control" rows="4" placeholder="message"><?php echo $us->message ?> </textarea>

                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Update</button>
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
        <?php $this->load->view("common/common_script")?>

</body>

<script type="text/javascript">

        $("#num_featured").on("keyup", function(){
            var max= $("#num_parts").val();
            if($("#num_featured").val() > max){
                alert("Number of featured parts cannot exceed the number of parts.")
                $("#num_featured").val(max)
            }
        });



    </script>




</html>



