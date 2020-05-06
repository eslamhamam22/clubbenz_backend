
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
					<h4 class="page-title">Shipping Requests</h4>
				</div>
				<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					<a style="background: #2CABE3" href="<?php echo base_url('provider/shipping/add_request') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Request</a>
				</div>
			</div>
			<?php $this->load->view('message');?>
			<div style="overflow: auto">
				<table id="myTable" class="table table-striped" >
					<thead>
					<tr>
						<th>Part ID</th>
						<th>Dimensions</th>
						<th>Weight</th>
						<th>Address</th>
						<th>Request Date</th>
						<th>Message</th>
						<th>Status</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($requests as $request) {?>
						<tr>
						<td><?php echo $request->part_id; ?></td>
						<td><?php echo $request->height . "*" . $request->width . "*" . $request->length; ?>(cm)</td>
						<td><?php echo $request->weight; ?>(gm)</td>
						<td><?php echo $request->address . ", " . $request->city; ?></td>
						<td><?php echo $request->created_at; ?></td>
						<td><?php echo $request->message; ?></td>
						<td><?php echo $request->status; ?></td>
						</tr>
						<?php }?>
					</tbody>
				</table>

			</div>
			<?php $this->load->view("common/common_footer")?>
		</div>

	</div>
</div>
</div>
<?php $this->load->view("common/common_script")?>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({"bSort": false});
    });
</script>

</body>
</html>
