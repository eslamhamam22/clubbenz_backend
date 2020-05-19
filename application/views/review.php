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
                                <h4 class="page-title">Manage User Reviews</h4>
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
                                    <th>Profile</th>
                                    <th>Username</th>
                                    <th>Rate</th>
                                    <th>Discription</th>
                                    <th>Review Photo</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Shop Name</th>
									<th>Admin Name</th>
                                    <th>Date Updated</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
foreach ($rec as $r) {
	$user = $this->review->get_user_name($r->user_id);
	$updated_by = $this->review->get_user_name($r->updated_by);

	$shop_name = $this->review->get_shop_name($r->shop_id, $r->type);
	?>
                                <tr>
                                    <td>
                                        <?php if (!empty($user->profile_picture)) {
		if (strpos($user->profile_picture, 'fbsbx') !== false) {
			$profile_picture = $user->profile_picture;
		} else {
			$profile_picture = base_url('upload/profile_picture/') . $user->profile_picture;
		}

		?>

                                                <img  class="user_img"  height='50px' src="<?php echo $profile_picture; ?>">
                                        <?php } else {echo "No image";}?>
                                    </td>
                                    <td><?php if ($user != "") {echo $user->username;}?></td>
                                    <td><?php echo $r->rate; ?></td>
                                    <td><?php echo $r->detail; ?></td>
                                    <td>
                                        <?php if (!empty($r->picture)) {?>
                                                <img width="50px"  height='50px' src="<?php echo base_url() . '/upload/' . $r->picture; ?>">
                                        <?php } else {echo "No image";}?>
                                    </td>
                                    <td><?php echo $r->date_created; ?></td>
                                    <td><?php echo $r->status; ?></td>
                                    <td><?php echo $r->type; ?></td>
                                    <td><?php echo $shop_name; ?></td>



									<td><?php if ($updated_by != "") {echo $updated_by->first_name . " " . $updated_by->last_name;}?></td>

									<td><?php echo $r->date_updated; ?></td>
                                    <td>
                                        <!-- <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('review/') ?><?php echo $r->shop_id; ?>"><i class="ti-marker-alt"></i></a> -->
                                        <a class="text-inverse pr-2" title="Edit"  data-original-title="Edit" href="javascript:void(0)"  data-toggle="modal" data-target="#edit_role" onclick="update('<?php echo $r->id; ?>','<?php echo $r->status; ?>')"><i class="ti-marker-alt"></i></a>
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

        <div id="edit_role" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel1">Update status</h4>
                    </div>
                    <form name="frm" method="post"type="foo.MyAction" scope="request" action="<?php echo base_url('/reviews/status_update') ?>">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                    <label>Status</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select id="status"  name="status" class="form-control">
                                            <option>pending</option>
                                            <option>approve</option>
                                            <option>reject</option>
                                    </select><br>
                                </div>
                            </div>
                            <input type="hidden" name="id" id="id">
                        </div>
                        <div class="modal-footer">
                           <button type="submit"  class="btn btn-info m-btn--pill waves-effect waves-light">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php $this->load->view('common/common_script');?>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable({"bSort": false});
            } );
        </script>
        <script type="text/javascript">
            function update(uid,status){
                $("#id").val(uid);
                $("#status").val(status);
               }

        </script>
    </body>

</html>
