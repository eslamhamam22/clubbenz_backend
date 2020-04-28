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
                                <h4 class="page-title">Reviews Listing</h4>
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
                                    <th>User Name</th>
                                    <th>Provider Name</th>
                                    <th>Comment</th>
                                    <th>Date Created</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rec as $r) {?>
                                <?php foreach ($users as $user) {?>
                                <?php if ($user->id == $r->user_id) {?>
                                    <td><?php echo $user->username ?></td>
                                <?php }}?>
                                <?php foreach ($providers as $provider) {?>
                                <?php if ($provider['id'] == $r->provider_id) {?>
                                    <td><?php echo $provider['user_name'] ?></td>
                                <?php }}?>
                                    <td><?php echo $r->comment; ?></td>
                                    <td><?php echo $r->created_at; ?></td>
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
