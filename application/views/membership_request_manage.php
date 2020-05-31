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
                                    <h4 class="page-title">Manage Memberships</h4>
                                </div>
                                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('membership/add_membership') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Membership</a>

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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

    <?php foreach ($st as $s) {?>
                                    <tr>
                                        <td><?php echo $s->id ?></td>

                                        <td><?php foreach ($users as $user) {?>
                                        <?php if ($user->id == $s->user_id) {echo $user->username;}}?></td>
                                        <td><?php echo $s->membership; ?></td>
                                        <td><?php echo $s->address; ?></td>
                                        <td> <?php if ($s->status == "pending" || $s->status == "reject") {?>
                                            <a href="<?php echo base_url('membership/approve/') ?><?php echo $s->id; ?>">
                                            <button class="btn btn-small btn-primary"><i class="fa fa-check"></i></button></a>
                                        <?php }?>
                                        <?php if ($s->status == "pending" || $s->status == "approve") {?>
                                            <a href="<?php echo base_url('membership/reject/') ?><?php echo $s->id; ?>"><button class="btn btn-small btn-danger"><i class="fa fa-times"></i></button></a>
                                        <?php }?>
                                        </td>
                                         <td>
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
