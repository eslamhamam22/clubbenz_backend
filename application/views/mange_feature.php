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
                 <div id="page-wrapper"style="background: white">
                        <div class="container-fluid">
                            <div class="row bg-title">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                    <h4 class="page-title">Manage Featured Items</h4>
                                </div>
                                <!-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('service/add_services') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Service Type</a>
                                </div> -->
                            </div>

                            <?php $this->load->view('message');?>

                            <table id="myTable" class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>City</th>
                                        <th>Phone Number</th>
                                        <th>Part Title</th>
                                        <th>Curant Plan</th>
                                        <th>Featured</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($rec as $us) {
	$current_plan = $this->Provider_plan_model->get_current_plan_with_details_by_provider($us['id']);

	?>
       <?php foreach ($parts as $part) {
		if ($part->provider_id == $us['id']) {
			?>
                                    <tr>
                                        <td><?php echo $us['user_name']; ?></td>
                                        <td><?php echo $us['user_email']; ?></td>
                                        <td><?php echo $us['city']; ?></td>
                                        <td><?php echo $us['user_mobile']; ?></td>
                                        <td><?php echo $part->title ?></td>
                                        <td><?php
if ($current_plan) {
				echo $current_plan->plan->title;
			} else {
				echo 'No Plan';
			}
			?></td>
                                        <td>

                                            <?php $featured = $part->featured;if ($featured == 1) {?>
                                                <a href="<?php echo base_url('feature/update_status?sid=') ?><?php echo $part->id; ?>&sval=<?php echo $featured; ?> " class="btn btn-success">Active</a>
                                                <?php } else {?>
                                                     <a href="<?php echo base_url('feature/update_status?sid=') ?><?php echo $part->id; ?>&sval=<?php echo $featured; ?> " class="btn btn-danger">in Active</a>
                                                <?php }?>
                                                <?php }}?>
                                            </td>

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
    </body>

</html>
