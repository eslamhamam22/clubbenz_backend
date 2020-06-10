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

        <div id="page-wrapper" style="background: white">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Manage Users</h4>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <a style="background: #2CABE3" href="<?php echo base_url('permissions/add_user') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add User</a>
                    </div>
                </div>
                <?php $this->load->view('message');?>
                 <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Membership</th>
                            <th>Expiry Date</th>
                            <th>Car</th>
                            <th>Chassis</th>
                            <th>Class Type</th>
                            <th>Role</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
foreach ($rec as $us) {
	$roles_arr = $this->acl_model->get_group_by_user_id($us->id);
	$membership = $this->membership->get_current_membership_by_user($us->id);
	$class_name = $this->acl_model->get_class_name($us->model_id);
	$chassis = $this->acl_model->get_chassis_name($us->chassis);
	$model_text = $this->Car_model->get_car_model_by_car_vin_prefix($us->car_vin_prefix);
	?>
                        <input type="hidden" name="id" id="id<?php echo $us->id; ?>" value='<?php echo $roles_arr['ids']; ?>'>
                        <tr>
                            <td><?php echo $us->id; ?>
                            <td><?php if ($us->enableFacebook == "false") {
		if (!empty($us->profile_picture)) {

			if (strpos($us->profile_picture, 'fbsbx') !== false) {
				$profile_picture = $us->profile_picture;
			} else {
				$profile_picture = base_url('upload/profile_picture/') . $us->profile_picture;
			}

			?>
                                 <img class="user_img" src="<?php echo $profile_picture; ?>">
<?php
} else {
			echo "No Image";
		}
		?>
                            <?php } else {
		if ($us->fb_picture) {
			echo "<img class='user_img' src='$us->fb_picture'>";
		} else {

			echo "<img class='user_img' src='https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png'>";
		}
	}?></td>
                            <td><?php echo $us->first_name . " " . $us->last_name; ?></td>
                            <td><?php echo $us->email; ?></td>
                            <td><?php echo $us->phone; ?></td>
                            <td><?php if ($membership != "") {echo $membership->name;} else {echo "No Membership";}?></td>
                            <td><?php if ($membership != "") {echo $membership->created_date;} else {echo "No Expiry Date";}?></td>
                            <td><?php echo $model_text; ?></td>
                            <td><?php echo $chassis; ?></td>
                            <td><?php echo $class_name; ?></td>
                            <td><?php echo $roles_arr['names']; ?></td>
                            <td>
                                <a class="text-inverse pr-2" href="<?php echo base_url('permissions/user_update/') ?><?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>

                                <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('permissions/user_del/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>

                                <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Update Password" href="<?php echo base_url('carmodel/change_password/') ?><?php echo $us->id; ?>"><i class="ti-lock"></i></a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                 <?php $this->load->view('common/common_footer');?>
            </div>
        </div>
   	</div>
        <?php $this->load->view('common/common_script');?>
         <script>
            $(document).ready( function () {
                $('#myTable').DataTable({"bSort": false});
            } );
        </script>
         <script>
            $(document).ready( function () {
                $('#myTable').DataTable();

                $('#fil_user').change(function(){
                    // let a = $(this).val();
                    // console.log(a);
                    //
                    filter_user();

                });

                function filter_user() {
                    var fil_user = $(#fil_user).val();
                    $.ajax({
                        url: "<?=base_url('permissions/user_manage')?>",
                        data: "fil_user" + $fil_user,
                        success: function(data) {
                            ("#myTable tbody").html(data)
                        }
                    });
                }

            } );
        </script>

</body>
</html>
