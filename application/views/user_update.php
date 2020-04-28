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
                        <h4 class="page-title">Edit User</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <?php $this->load->view('message');?>
                            <form class="form-horizontal" name="frm" method="post" action="<?php echo base_url(); ?>permissions/update_usergroup" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $rec->id; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-md-3 control-label">First Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name="first_name" class="form-control" required value="<?php echo $rec->first_name; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-md-3 control-label">Last Name</label>
                                            <div class="col-md-9">
                                                <input type="text" name="last_name" class="form-control" required value="<?php echo $rec->last_name; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-md-3 control-label">Email</label>
                                            <div class="col-md-9">
                                                <input type="text" name="email" class="form-control" id="email" required value="<?php echo $rec->email; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-md-3 control-label">Phone</label>
                                            <div class="col-md-9">
                                                <input type="text" name="phone" class="form-control" id="phone" required value="<?php echo $rec->phone; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php $roles_arr = $this->acl_model->get_group_by_user_id($rec->id);
$roles = explode(',', $roles_arr['ids']);
?>
                                            <label class="control-label col-md-3">Role</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <select name="groups[]" id="groups" class="js-example-tokenizer" style="width:100%" width="100%" >
                                                    <?php foreach ($groups as $g) {?>
                                                        <option <?php if (in_array($g['id'], $roles)) {?> selected="selected" <?php }?> value="<?php echo $g['id']; ?>" ><?php echo $g['name']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-md-3 control-label">Class</label>
                                            <div class="col-md-9">
                                                <select name="model_id" id="class" class="form-control">
                                                    <option value="0">Select Class</option>
                                                    <?php foreach ($model as $m) {?>
                                                        <option value="<?php echo $m->id; ?>"><?php echo $m->name ?></option>
                                                    <?php }?>
                                                </select>
                                                <script type="text/javascript">
                                                    document.frm.car_type_id.value ='<?php echo $rec->car_type_id ?>';
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        document.frm.model_id.value= '<?php echo $rec->model_id; ?>';
                                    </script>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-md-3 control-label">Fuel Type</label>
                                            <div class="col-md-9">
                                                <select name="car_type_id" id="fuel" class="form-control">
                                                    <option value="0">Select Fuel Type</option>
                                                    <?php foreach ($fuel_types as $ft) {?>
                                                        <option value="<?php echo $ft->id; ?>"><?php echo $ft->name ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        document.frm.car_type_id.value= '<?php echo $rec->car_type_id; ?>';
                                    </script>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-md-3 control-label">Years</label>
                                            <div class="col-md-9">
                                                <select name="year_id" id="year" class="form-control" >
                                                    <option value="0">Select year</option>
                                                    <?php foreach ($years as $y) {?>
                                                        <option value="<?php echo $y->id; ?>"><?php echo $y->name ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        document.frm.year_id.value= '<?php echo $rec->year_id; ?>';
                                    </script>
                                </div>
                                <?php $model_text = $this->Car_model->get_car_model_by_car_vin_prefix($rec->car_vin_prefix);?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-md-3 control-label">Chassis</label>
                                            <div class="col-md-9">
                                                <select name="chassis_id" id="chassis" class="form-control" >
                                                    <option value="0">Select Chassis</option>
                                                    <?php foreach ($chassis as $ch) {?>
                                                        <option value="<?php echo $ch->id; ?>"><?php echo $ch->chassis_num; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        document.frm.chassis.value= '<?php echo $rec->chassis; ?>';
                                    </script>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-3 control-label">Cars</label>
                                            <div class="col-sm-9">
                                                 <select name="car_id" id="car" class="form-control" >
                                                    <option>Cars List</option>
                                                    <option value="<?php echo $rec->car_id ?>"><?php echo $model_text ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <script type="text/javascript">
                                        document.frm.car_id.value= '<?php echo $rec->car_id; ?>';
                                    </script>
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
                                      <?php if (!empty($rec->profile_picture)) {

	if (strpos($rec->profile_picture, 'fbsbx') !== false) {
		$profile_picture = $rec->profile_picture;
	} else {
		$profile_picture = base_url('upload/profile_picture/') . $rec->profile_picture;
	}

} else {
	$profile_picture = '';
}
?>
                                        <img style="width:150px;float: right;border-radius: 10%;" src="<?php echo $profile_picture; ?>" >


                                    </div>

                                    <div class="col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10 pull-right">Update</button>
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
                        url:'<?php echo base_url("permissions/cars") ?>',
                        data: {'class_id':class_id,'fuel_id':fuel_id,'year_id':year_id,'chassis_id':chassis_id},
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
