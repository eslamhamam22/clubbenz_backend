
<?php $this->load->view('common/common_header');?>
<body class="fix-header">

<div class="preloader">
	<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
	</svg>
</div>
<div id="wrapper">
	<?php $this->load->view('provider/common/top_nav');?>
	<?php $this->load->view('provider/common/left_nav');?>

	<div id="page-wrapper" style="background: white">
		<div class="container-fluid">
			<div class="row bg-title">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<h4 class="page-title"><?php echo lang("Profile"); ?> </h4>
				</div>
			</div>

			<?php $this->load->view('message');?>
			<div class="row" style="overflow: auto">
				<form enctype="multipart/form-data" class="col-xs-12 form-horizontal new-lg-form" method="post" id="loginform" action="<?php echo base_url('provider/provider/edit'); ?>">
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Email"); ?></label>
							<input class="form-control" type="text" required name="user_email" placeholder="" value="<?php echo $user->user_email; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Password"); ?></label>
							<input class="form-control" type="password" name="user_password" placeholder="<?php echo lang("Leave_empty_if_you_don't_want_to_change_it"); ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Name"); ?></label>
							<input class="form-control" type="text" required name="user_name" placeholder="" value="<?php echo $user->user_name; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Mobile"); ?></label>
							<input class="form-control" type="text" required name="user_mobile" placeholder="" value="<?php echo $user->user_mobile; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Store_Name"); ?></label>
							<input class="form-control" type="text" required name="store_name" placeholder="" value="<?php echo $user->store_name; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Contact_Person"); ?></label>
							<input class="form-control" type="text" required name="contact_person" placeholder="" value="<?php echo $user->contact_person; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Address"); ?></label>
							<input class="form-control" type="text" required name="address" placeholder="" value="<?php echo $user->address; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Country"); ?></label>
							<select class="form-control" required name="country" id="country">
								<?php foreach ($countries as $country) {?>
									<option value="<?php echo $country->id; ?>" <?php echo $user->country == $country->id ? "selected" : ""; ?>><?php echo $country->name; ?></option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Governorate"); ?></label>
							<select class="form-control" required name="governorate" id="states">
								<?php foreach ($states as $state) {?>
									<option value="<?php echo $state->id; ?>" <?php echo $user->governorate == $state->id ? "selected" : ""; ?>><?php echo $state->name; ?></option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("City"); ?></label>
							<input class="form-control" type="text" required name="city" placeholder="" value="<?php echo $user->city; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Zip_Code"); ?></label>
							<input class="form-control" type="number" required name="zip_code" placeholder="" value="<?php echo $user->zip_code; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Business_Website"); ?></label>
							<input class="form-control" type="text" required name="business_website" placeholder="" value="<?php echo $user->business_website; ?>">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12">
							<label><?php echo lang("Logo"); ?></label>
							<input class="form-control" type="file" name="logo" placeholder="">
							<img class="img_size" src="<?php echo base_url() . "/upload/$user->logo" ?>">
						</div>
					</div>
					<div class="form-group text-center m-t-20">
						<div class="col-xs-12">
							<button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit"><?php echo lang("Save"); ?></button>
						</div>
					</div>
				</form>
			</div>
			<?php $this->load->view("common/common_footer")?>
		</div>
	</div>
</div>
<?php $this->load->view("common/common_script")?>
<script type="text/javascript">
    $(document).ready(function(){

        $('#country').change(function () {
            var id = $(this).val();
            $.ajax({
                type: 'post',
                url:'<?php echo base_url("provider/world/states") ?>',
                data: {'id':id},
                success: function (mydata) {
                    console.log(mydata);
                    $('#states').html(mydata);
                }
            });
        });
    });
</script>
</body>
</html>
