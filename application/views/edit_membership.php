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
                            <h4 class="page-title">Edit Membership</h4>
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
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>membership/membership_update">
                                    <?php
foreach ($rec as $us) {
	?>
                                        <input type="hidden"  name="id" value="<?php echo $us->id; ?>">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Benefit</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="benefit" class="form-control" id="benefit"value="<?php echo $us->benefit; ?>" required> </div>
                                    </div>

                                     <!-- <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9">
                                            <input style="margin: 15px"  type="checkbox" name="gold" value="gold"  <?php echo ($us->gold == "gold") ? "checked" : ""; ?>> Gold
                                            <input style="margin: 15px"  type="checkbox" name="platinum" value="platinum"  <?php echo ($us->platinum == "platinum") ? "checked" : ""; ?>> Platinum
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Upload Photo</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="gold_image" id="gold_image" size="20" />

                                       </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px">
                                        <img style="width:200px;" src="<?php echo base_url('upload/') . $us->gold_image; ?>" >
                                    </div>

                                     <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Upload Photo</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="platinum_image" id="platinum_image" size="20" />

                                       </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px">
                                        <img style="width:200px;" src="<?php echo base_url('upload/') . $us->platinum_image; ?>" >
                                    </div> -->

<?php
$error_solution = $this->membership->get_membership_rel_id($us->id);
	foreach ($error_solution as $es) {?>

                                <input type="hidden" name="error_id[]" value="<?php echo $es->id ?>">

                                <div class="row margin-top" id="multiple-<?php echo $es->id ?>" >
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Details</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="details[]" class="form-control" id="details"value="<?php echo $es->details; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row margin-top">
                                        <div align="center" >
                                            <input style="width: 150px; height: 40px; background-color: forestgreen " type="button" onclick="delete_sol(<?php echo $es->id ?>);"  name="delete" class="btn btn-primary" value="Delete">
                                        </div>
                                    </div>
                                </div>
<?php }?>
                                <div id="addsol">

                            </div>
                            <div align="center" style="margin-top:12px; ">
                                <input style="background-color: #0c0c0c;font-size: 40px;height: 80px; width: 80px ; border-radius: 50%"  type="button" onclick="add_data();" name="btn" class="btn-primary"  value="+">
                                <div>
                                    <h6><b>Add other Solution</b> </h6>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

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

    <script type="text/javascript">
            var index=0
                function add_data(){
                    index = index +1;
                    $.post("<?php echo base_url() ?>membership/add_ajax_details",{index: index}, function( data ) {
                        $("#addsol").append(data);
                    });
                }
                function delete_sol(val){
                   var result =  confirm("Are you sure you want to delete this!");
                   if(result){



                      $.ajax({
                        type: 'post',
                        url:'<?php echo base_url("membership/delete_membership_rel_solution") ?>',
                        data: {'id':val},
                        success: function (mydata) {
                            $('#multiple-'+val).hide()
                        }
                    });


                   }
                }
            </script>




</html>



