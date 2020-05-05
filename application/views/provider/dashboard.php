
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
        <?php $this->load->view('provider/message');?>
		<div id="page-wrapper" style="background: white">
			<div class="container-fluid">
				<div class="row bg-title">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h4 class="page-title"> <?php echo lang("Dashboard"); ?></h4>
					</div>
				</div>

				<?php $this->load->view('message');?>
				<div class="row">
					<div class="col-sm-12">
					<?php
if ($current_plan) {
	?>
						<div class="bg-title" style="padding: 10px 20px; margin-left: 0px; margin-right: 0px;">
							<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
								<h5>Current Plan Title: <strong><?php echo $current_plan->plan->title; ?></strong></h5>
								<h5>Current Plan Duration: <strong><?php echo $current_plan->plan->frequency; ?>
										Months</strong></h5>
								<h5>Start Date: <strong><?php echo $current_plan->created_at; ?></strong></h5>
								<h5>End Date: <strong><?php echo $current_plan->end_date ?></strong></h5>
								<h5>Status: <strong><?php echo $current_plan->status; ?></strong></h5>
							</div>

						</div>
						<?php
}
?>
					</div>
					<div class="col-sm-12" id="shops">
						<div class="white-box">
							<div class="row row-in">
								<div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
									<ul class="col-in">
										<li>
											<span class="circle circle-md bg-info"><i class="ti-wallet"></i></span>
										</li>
										<li class="col-last">
											<?php if ($current_plan) {?>
												<h3 class="counter text-right m-t-15"><?php echo $current_plan->plan->num_parts - count($active_parts); ?></h3>
											<?php }?>
										</li>
										<li class="col-middle">
											<?php if ($current_plan) {?>
											<h4>Available Parts</h4>
											<div class="progress">
												<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
													<span class="sr-only">40% Complete (success)</span>
												</div>
											</div>
											<?php } else {?>
												<h4>No Plan available</h4>
											<?php }?>
										</li>
									</ul>
								</div>
								<div class="col-lg-3 col-sm-6 row-in-br">
									<ul class="col-in">
										<li>
											<span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span>
										</li>
										<li class="col-last">
											<h3 class="counter text-right m-t-15"><?php echo count($active_parts); ?></h3>
										</li>
										<li class="col-middle">
											<h4>Total Active Parts</h4>
											<div class="progress">
												<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
													<span class="sr-only">40% Complete (success)</span>
												</div>
											</div>
										</li>
									</ul>
								</div>
								<div class="col-lg-3 col-sm-6 row-in-br">
									<ul class="col-in">
										<li>
											<span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
										</li>
										<li class="col-last">

											<h3 class="counter text-right m-t-15"><?php echo count($parts) - count($active_parts); ?></h3>
										</li>
										<li class="col-middle">
											<h4>Total InActive Parts</h4>
											<div class="progress">
												<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
													<span class="sr-only">40% Complete (success)</span>
												</div>
											</div>
										</li>
									</ul>
								</div>
								<div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
									<ul class="col-in">
										<li>
											<span class="circle circle-md bg-info"><i class="ti-wallet"></i></span>
										</li>
										<li class="col-last">
											<h3 class="counter text-right m-t-15"><?php echo count($requests); ?></h3>
										</li>
										<li class="col-middle">
											<h4>Total Shipping Requests</h4>
											<div class="progress">
												<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
													<span class="sr-only">40% Complete (success)</span>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $this->load->view("common/common_footer")?>
			</div>
		</div>

	</div>
    <?php $this->load->view("common/common_script")?>
</body>
</html>
