
<?php $this->load->view('provider/common/common_header');?>
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
					<h4 class="page-title">Subscribe to <?php echo $plan->title; ?></h4>
				</div>

			</div>
			<?php $this->load->view('message');?>
			<div style="overflow: auto">
				<form action="<?php echo site_url('provider/plan/subscribe/' . $plan->id); ?>" method="get">
					<div class="form-group">
						<div class="col-xs-12">
							<label>Extra number of days: </label>
							<input class="form-control" type="number" required name="extra_days" placeholder="10" value="0">
						</div>
					</div>
					<div class="form-group text-center m-t-20">
						<div class="col-xs-12">
							<button style="margin-top: 20px" class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Subscribe</button>
						</div>
					</div>
				</form>
			</div>
			<?php $this->load->view("provider/common/common_footer")?>
		</div>

	</div>
</div>
</div>
<?php $this->load->view("provider/common/common_script")?>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({"bSort": false});
    });
</script>

</body>
</html>
