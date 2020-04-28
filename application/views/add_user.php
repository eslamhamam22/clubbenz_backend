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
                            <h4 class="page-title">Add User</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="white-box">
                                <?php $this->load->view('message');?>
                                <form class="form-horizontal" name="frm" method="post" action="<?php echo base_url();?>permissions/add_user" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-md-3 control-label">First Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="first_name" class="form-control" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-md-3 control-label">Last Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="last_name" class="form-control" required> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-md-3 control-label">Email</label>
                                                <div class="col-md-9">
                                                    <input type="text" name="email" class="form-control" id="email" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-md-3 control-label">Password</label>
                                                <div class="col-md-9">
                                                    <input type="Password" name="password" class="form-control" id="password" required> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-md-3 control-label">Phone</label>
                                                <div class="col-md-9">
                                                    <input type="number" name="phone" class="form-control" id="phone" required> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php //$roles_arr = $this->acl_model->get_group_by_user_id($rec->id);
                                                    //$roles =  explode(',',$roles_arr['ids']);
                                                ?>
                                                <label class="control-label col-md-3">Role</label>
                                                <div class="col-md-9 col-sm-9 col-xs-12">
                                                    <select name="groups[]" id="groups" class="js-example-tokenizer" style="width:100%" width="100%" multiple="multiple">
                                                        <?php foreach ($groups as $g) { ?>
                                                            <option value="<?php echo $g['id'];?>" ><?php echo $g['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-md-3 control-label">Class</label>
                                                <div class="col-md-9">
                                                    <select name="model_id" id="class" class="form-control" required>
                                                        <option value="0">Select Class</option>
                                                        <?php foreach ($model as $m) { ?>
                                                            <option value="<?php echo $m->id; ?>"><?php echo $m->name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-md-3 control-label">Fuel Type</label>
                                                <div class="col-md-9">
                                                    <select name="car_type_id" id="fuel" class="form-control" required>
                                                        <option value="0">Select Fuel Type</option>
                                                        <?php foreach ($fuel_types as $ft) { ?>
                                                            <option value="<?php echo $ft->id; ?>"><?php echo $ft->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-md-3 control-label">Years</label>
                                                <div class="col-md-9">
                                                    <select name="year_id" id="year" class="form-control" required>
                                                        <option value="0">Select year</option>
                                                        <?php foreach ($years as $y) { ?>
                                                            <option value="<?php echo $y->id; ?>"><?php echo $y->name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-md-3 control-label">Chassis</label>
                                                <div class="col-md-9">
                                                    <select name="chassis_id" id="chassis" class="form-control" required>
                                                        <option value="0">Select Chassis</option>
                                                        <?php foreach ($chassis as $ch) { ?>
                                                            <option value="<?php echo $ch->id; ?>"><?php echo $ch->chassis_num; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-3 control-label">Cars</label>
                                                <div class="col-sm-9">
                                                     <select name="car_vin_prefix" id="car" class="form-control" required>
                                                        <option>Cars List</option>
                                                        <option value="" ></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label  for="inputEmail3" class="col-md-3 control-label">Profile Picture</label>
                                                <!-- <label for="image" style="  margin-top: 20px; margin-left: 30px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                                                    <i class="fa fa-cloud-upload"></i> Upload picture
                                                </label> -->
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control" name="profile_picture" id="profile_picture"/>
                                                </div>
                                            </div>
                                            <!--                                <img style="width:200px;" src="--><?php //echo base_url?><!--" >-->

                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-info waves-effect waves-light m-t-10 pull-right">Submit</button>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php $this->load->view('common/common_footer');?>
                </div>
            </div>
        </div> 
        <?php $this->load->view('common/common_script');?>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".js-example-tokenizer").select2({
                    tags: true,
                    placeholder: "Please select option",
                    tokenSeparators: [',', ' ']
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#chassis').change(function () {
                    var class_id = $('#class').val();
                    var fuel_id = $('#fuel').val();
                    var year_id = $('#year').val();
                    var chassis_id = $('#chassis').val();
                    if(class_id > 0 && fuel_id > 0 && year_id > 0 && chassis_id > 0){
                        $.ajax({
                            type: 'post',
                            url:'<?php echo base_url("permissions/cars")?>',
                            data: {'class_id':class_id,'fuel_id':fuel_id,'year_id':year_id, 'chassis_id' : chassis_id},
                            success: function (mydata) {
                                    console.log(mydata);
                                    $('#car').html(mydata);
                            }
                        });
                    }
                    else{
                        alert('must select option');
                    } 
                }); 
            });
        </script>
</body>
</html>
