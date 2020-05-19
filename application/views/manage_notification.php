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
                            <h4 class="page-title">Manage Notification</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <a style="background: #2CABE3" href="<?php echo base_url('push_notification/send_notification') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Push Notification</a>
                        </div>
                    </div>
                        <?php $this->load->view('message');?>
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Message</th>
                                <th>User</th>
                                <th>Shop</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php foreach ($rec as $a) {
	$username = $this->notification->get_user_name($a->user_id);
	$part_shop_name = $this->notification->get_part_shop_name($a->shop_id);
	?>

                            <tr>
                                <td><?php echo $a->title; ?></td>
                                <td><?php echo $a->message; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $part_shop_name; ?></td>
                                <td><?php echo $a->shop_type; ?></td>
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
            });
        </script>


    </body>

</html>
