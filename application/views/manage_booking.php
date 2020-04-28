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
                                <h4 class="page-title">Manage Booking</h4>
                            </div>
                        </div>
                        <?php $this->load->view('message');?>
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Work Shop Name</th>
                                    <th>Username</th>
                                    <th>Phone</th>
                                    <th>Requested service time</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                    <th>Comments</th>
                                    <th>Updated By</th>
                                    <th>Approval time</th>
                                    <th>Request time</th>
                                    <th>Option</th>
                                </tr>
                             </thead>
                              <tbody>
                                <?php foreach ($rec as $us) {?>
                                <tr>
                                    <td><?php echo $us->workshop_name; ?></td>
                                    <td><?php echo $us->first_name . "." . $us->last_name; ?></td>
                                    <td><?php echo $us->phone; ?></td>
                                    <td><?php echo date("d/m/Y h:i:s", strtotime($us->date)); ?></td>
                                    <td><?php echo $us->status; ?></td>
                                    <td><?php echo $us->description; ?></td>
                                    <td><?php echo $us->comments; ?></td>
                                    <td><?php echo $this->Users_model->get_user_name($us->updated_by); ?></td>
                                    <td><?php echo ($us->updated_at == "0000-00-00 00:00:00") ? "" : date("d/m/Y h:i a", strtotime($us->updated_at)); ?></td>
                                    <td><?php echo ($us->created_date == "0000-00-00 00:00:00") ? "" : date("d/m/Y h:i a", strtotime($us->created_date)); ?></td>
                                    <td>
                                         <!-- <a href="<?php echo base_url('carmodel/edit_service_shop') ?>/<?php echo $us->id; ?>"><input type="button" class='btn
                                          btn-warning' value="Edit"></a> -->
                                         <!-- <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="javascript:void(0)"  data-toggle="modal" data-target="#edit_role" onclick="update('<?php echo $us->id; ?>','<?php echo $us->status; ?>','<?php echo $us->description; ?>')"><i class="ti-marker-alt"></i></a>    -->
                                        <a class="text-inverse pr-2" title="Edit"  data-original-title="Edit" href="javascript:void(0)"  data-toggle="modal" data-target="#edit_role" onclick="update('<?php echo $us->id; ?>','<?php echo $us->status; ?>','<?php echo $us->description; ?>')"><i class="ti-marker-alt"></i></a>
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
                                <form name="frm" method="post"type="foo.MyAction" scope="request" action="<?php echo base_url('/booking/status_update') ?>">
                                <input type="hidden" name="user_id" id="user_id" />
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3 col-xs-12">
                                                <label>Status</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-12">

                                                    <select id="status"  name="status" class="form-control">
                                                            <option>completed</option>
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




