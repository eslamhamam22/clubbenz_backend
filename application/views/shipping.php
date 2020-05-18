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
			<div style="overflow: auto">

			<div id="page-wrapper" style="background: white">
                    <div class="container-fluid">
                        <div class="row bg-title">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                <h4 class="page-title">Manage shipping request</h4>
                            </div>
                           <!--  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('fuel/add_fuel') ?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Fuel Type</a>
                            </div> -->
                        </div>

                        <div class="col-md-4 col-lg-3" >

                        </div>

                        <?php $this->load->view('message');?>

                         <table  id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Provider Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
									<th>Cost</th>
                                    <th>Request Date</th>
                                    <th>Shipping Date</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rec as $r) {
	?>
                                <tr>
                                    <td>
    <?php foreach ($providers as $provider) {
		if ($r['provider_id'] == $provider['id']) {
			echo $provider['user_name'];?>

                                    </td>
                                    <td><?php echo $provider['user_email']; ?></td>
                                    <td><?php echo $provider['user_mobile']; ?></td>
                                    <?php }}?>
                                    <td><?php echo $r['price']; ?><?php if (!empty($r['price'])) {echo " E.G.P";}?></td>
                                    <td><?php echo $r['shippment_date']; ?></td>
                                    <td><?php echo $r['created_at']; ?></td>
                                    <td><?php echo $r['status']; ?></td>
                                    <td>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('shippinglist/edit_shippinglist') ?>/<?php echo $r['id']; ?>"><i class="ti-marker-alt"></i></a>
                                        <a class="text-inverse " data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('shippinglist/shippinglist_del/') ?><?php echo $r['id']; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                         </table>


						</div>
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
