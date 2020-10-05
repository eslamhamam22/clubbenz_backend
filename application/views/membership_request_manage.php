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
                                    <h4 class="page-title">Manage Membership request</h4>
                                </div>
                            </div>

                            <?php $this->load->view('message');?>

                            <table id="myTable" class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Membership</th>
                                        <th>Address</th>
                                        <th>NID</th>
                                        <th>NID Front</th>
                                        <th>NID Rear</th>
                                        <th>license Front</th>
                                        <th>license Rear</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

    <?php foreach ($st as $s) {
	$memberships = $this->membership->get_membership_features($s->membership_id);
	$user = $this->membership->get_user_name($s->user_id);
	?>
                                    <tr>
                                        <td><?php echo $s->id ?></td>

                                        <td>
                                            <?php if (isset($user->username)) {?>
                                            <?php echo $user->username; ?>
                                            <?php } else {echo "No User Found";}?>
                                        </td>
                                        <td>
                                            <?php if (isset($memberships->name)) {?>
                                            <?php echo $memberships->name; ?>
                                            <?php } else {echo "No Membership Found";}?>
                                        </td>
                                        <td><?php echo $s->address; ?></td>
                                        <td><?php echo $s->nid; ?></td>
                                        <td><img class="img_size" src="<?php echo base_url() . "/upload/$s->nid_front" ?>"></td>
                                        <td><img class="img_size" src="<?php echo base_url() . "/upload/$s->nid_front" ?>"></td>
                                        <td><img class="img_size" src="<?php echo base_url() . "/upload/$s->licence_front" ?>"></td>
                                        <td><img class="img_size" src="<?php echo base_url() . "/upload/$s->licence_rear" ?>"></td>
                                        <td>
                                            <?php if ($s->status == 'pending') {echo "pending";}?>
                                            <?php if ($s->status == 'approve') {echo "Delivery";}?>
                                            <?php if ($s->status == 'reject') {echo "Requested";}?>

                                            </td>

                                         <td>
                                             <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('membership/edit_memberships_users') ?>/<?php echo $s->id ?>"><i class="ti-marker-alt"></i></a>
                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('membership/membership_request_del/') ?><?php echo $s->id ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
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
