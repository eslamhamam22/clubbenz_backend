
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
					<h4 class="page-title">Add Shipping Request</h4>
				</div>

			</div>
			<?php $this->load->view('message');?>
			<div class="row" style="overflow: auto">
				<form class="col-xs-12 form-horizontal new-lg-form" method="post" id="loginform" action="<?php echo base_url('provider/shipping/add_request_submit'); ?>">
					<div class="form-group  m-t-20">
						<div class="col-xs-12">
							<label>Part</label>
							<select name="part" class="form-control">
								<?php foreach ($parts as $part) {?>
									<option value="<?php echo $part->id; ?>"><?php echo $part->title; ?></option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="form-group  m-t-20">
						<div class="col-xs-12">
							<label>Width</label>
							<input class="form-control" type="number" required="required" name="width" placeholder="1.0" step="0.01" min="0">
						</div>
					</div>
					<div class="form-group  m-t-20">
						<div class="col-xs-12">
							<label>Height</label>
							<input class="form-control" type="number" required="required" name="height" placeholder="1.0" step="0.01" min="0">
						</div>
					</div>
					<div class="form-group  m-t-20">
						<div class="col-xs-12">
							<label>Length</label>
							<input class="form-control" type="number" required="required" name="length" placeholder="1.0" step="0.01" min="0">
						</div>
					</div>
					<div class="form-group  m-t-20">
						<div class="col-xs-12">
							<label>Weight</label>
							<input class="form-control" type="number" required="required" name="weight" placeholder="1.0" step="0.01" min="0">
						</div>
					</div>
					<div class="form-group  m-t-20">
						<div class="col-xs-12">
							<label>Address</label>
							<input class="form-control" type="text" required="" name="address" placeholder="Address">
						</div>
					</div>
					<div class="form-group  m-t-20">
						<div class="col-xs-12">
							<label>City</label>
							<input class="form-control" type="text" required="" name="city" placeholder="City">
						</div>
					</div>
					<div class="form-group  m-t-20">
						<div class="col-xs-12">
							<label>Request Date</label>
							<input required type="date" data-date-format='yyyy-mm-dd'  name="created_at" value="<?php echo $this->input->post("created_at") ?>" id="datepicker"   min="<?php echo date('Y-m-d'); ?>"/ class="form-control">
						</div>
					</div>
					<div class="form-group  m-t-20">
						<div class="col-xs-12">
							<label>Message</label>
							<textarea class="form-control" required="" name="message" placeholder="write your message here"></textarea>
						</div>
					</div>

					<div class="form-group text-center m-t-20">
						<div class="col-xs-12">
							<button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Request</button>
						</div>
					</div>
				</form>
			</div>
			<?php $this->load->view("common/common_footer")?>
		</div>

	</div>
</div>
</div>
<?php $this->load->view("common/common_script")?>
<script>
</script>

</body>
</html>
