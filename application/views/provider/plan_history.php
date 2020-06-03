
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
					<h4 class="page-title"><?php echo lang("Plans"); ?></h4>
				</div>

			</div>
			<?php $this->load->view('message');?>
			<div style="overflow: auto">
				<?php
if ($current_plan) {
	?>
					<div class="bg-title" style="padding: 10px 20px; margin-left: 0px; margin-right: 0px;">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5><?php echo lang("Current_Plan_Title"); ?>: <strong><?php echo $current_plan->plan->title; ?></strong></h5>
							<h5><?php echo lang("Current_Plan_Duration"); ?>: <strong><?php echo $current_plan->plan->frequency; ?>
									<?php echo lang("Months"); ?></strong></h5>
							<h5><?php echo lang("Start_Date"); ?>: <strong><?php echo $current_plan->created_at; ?></strong></h5>
							<h5><?php echo lang("End_Date"); ?>: <strong><?php echo $current_plan->end_date ?></strong></h5>
							<h5><?php echo lang("Status"); ?>: <strong><?php echo $current_plan->status; ?></strong></h5>
						</div>

					</div>
					<?php
}
?>
				<table id="myTable" class="table table-striped" >
					<thead>
					<tr>
						<th><?php echo lang("Image"); ?></th>
						<th><?php echo lang("Title"); ?></th>
						<th><?php echo lang("Number of Parts"); ?></th>
						<th><?php echo lang("Price"); ?></th>
						<th><?php echo lang("Start_Date"); ?></th>
						<th><?php echo lang("End_Date"); ?></th>
						<th><?php echo lang("Status"); ?></th>
					</tr>
					</thead>
					<tbody>
					<?php if (is_array($plans)): ?>
					<?php foreach ($plans as $plan) {if ($plan->plan->id == $current_plan->plan_id) {?>
							<tr style="background-color: #2F323E!important; color: white !important;">
							<?php } else {?>
							<tr>
							<?php }?>
						<td>
							<?php if (!empty($plan->plan->photo)) {?>
								<img class="img_size" src="<?php echo base_url() . "/upload/" . $plan->plan->photo; ?>">
							<?php } else {echo "No image";}?>
						</td>
						<td><?php echo $plan->plan->title; ?></td>
						<td><?php echo $plan->plan->num_parts; ?> Parts</td>
						<td><?php echo $plan->plan->price; ?></td>
						<td><?php echo $plan->created_at; ?></td>
						<td><?php echo $plan->end_date; ?></td>
						<td><?php echo $plan->status; ?></td>
						</tr>
						<?php
}

?><?php endif;?>
					</tbody>
				</table>

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
