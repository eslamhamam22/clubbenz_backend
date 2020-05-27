
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
					<h4 class="page-title"><?php echo lang("Shipping"); ?></h4>
				</div>

			</div>
			<?php $this->load->view('message');?>
			<div style="overflow: auto">

				<?php if (!empty($file['file'])) {?>
					<div align="center" class="" style="">
						<i class="fa fa-file"></i>
						<a class="aclick" href=" <?php echo base_url('upload/') . $file['file']; ?>" title="Show" rel="bookmark" target="_blank"><?php echo lang("Show"); ?>  </a>
					</div>
				<?php }?>
			</div>
			<?php $this->load->view("provider/common/common_footer")?>
		</div>

	</div>
</div>
</div>
<?php $this->load->view("provider/common/common_script")?>
<script>
</script>

</body>
</html>
