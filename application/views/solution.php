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
                 <div id="page-wrapper" style="background:white">
                    <div class="container-fluid">
                        <div class="row bg-title">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                <h4 class="page-title">Manage Error Solution</h4>
                            </div>
                        </div>
                        <?php $this->load->view('message');?>
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Date of Posting</th>
                                    <th>Admin Name</th>
                                    <th>Date of Approval or Action taken</th>
                                    <th>Option</th>
                                </tr>
                             </thead>
                              <tbody>
                                <?php foreach ($rec as $us) {
	$user = $this->review->get_user_name($us->submited_by);
	$updated_by = $this->review->get_user_name($us->updated_by);
	?>
                                <tr>
                                    <td><?php if (!empty($user->profile_picture)) {
		if (strpos($user->profile_picture, 'fbsbx') !== false) {
			$profile_picture = $user->profile_picture;
		} else {
			$profile_picture = base_url('upload/profile_picture/') . $user->profile_picture;
		}
		?>

                                                <img class="user_img" src="<?php echo $profile_picture; ?>">
                                        <?php } else {echo "No image";}?>
                                    </td>
                                    <td><?php if ($user != "") {echo $user->first_name . " " . $user->last_name;}?></td>
                                    <td><?php echo $us->status; ?></td>
                                    <td><?php echo $us->description; ?></td>
                                    <td><?php if ($us->created_on != "0000-00-00 00:00:00") {echo $us->created_on;}?></td>
                                    <td><?php if ($updated_by != "") {echo $updated_by->first_name . " " . $updated_by->last_name;}?></td>
                                    <td><?php if ($us->updated_on != "0000-00-00 00:00:00") {echo $us->updated_on;}?></td>
                                    <td>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('car_guide/edit_error_solution') ?>/<?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('car_guide/del_error_solution/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>

                                    </td>
                                </tr>

                                <?php }?>
                            </tbody>
                        </table>
                        <div id="edit_role" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel1">Update status</h4>
                                </div>
                                <form name="frm" method="post"type="foo.MyAction" scope="request" action="<?php echo base_url('/car_guide/status_update_solution') ?>">
                                <input type="hidden" name="user_id" id="user_id" />
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-12">

                                                    <select id="status"  name="status" class="form-control">
                                                            <option>approve</option>
                                                            <option>rejected</option>
                                                    </select><br>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <textarea  name="description" id="description" class="form-control" rows="3"></textarea>
                                            </div>
                                            <input type="hidden" name="id" id="id">


                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="submit"  class="btn btn-info m-btn--pill waves-effect waves-light">Update</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                   <?php $this->load->view('common/common_footer');?>
                </div>
            </div>
        </div>


        <script type="text/javascript">
            function update(uid,status,description){
                $("#id").val(uid);
                $("#status").val(status);
                $("#description").val(description);
               }

        </script>


       <?php $this->load->view('common/common_script');?>
         <script>
            $(document).ready( function () {
                $('#myTable').DataTable({"bSort": false});
            } );
        </script>



    </body>

</html>




