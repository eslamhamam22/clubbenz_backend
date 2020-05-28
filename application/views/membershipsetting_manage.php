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
                                    <h4 class="page-title">Manage Membership Sittng</h4>
                                </div>
                                <!-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('membership/add_membership') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Membership</a>

                                </div> -->
                            </div>

                            <?php $this->load->view('message');?>

                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>membership/membership_setting_update">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Benefit</th>
                                        <th>Gold</th>
                                        <th>Platinum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Price</td>
                                        <td></td>
                                    <?php foreach ($fet as $fe) {?>
                                        <td><?php echo $fe->price; ?></td>
                                        <td><?php echo $fe->platinum_price; ?></td>
                                    <?php }?>
                                    </tr>
                                    <tr>
                                        <td>Card Image</td>
                                        <td></td>
                                    <?php foreach ($fet as $fe) {?>
                                        <td><img style="width:60px; height: 60px" src="<?php echo base_url('upload/') . $fe->gold_image; ?>" ></td>
                                        <td><img style="width:60px; height: 60px" src="<?php echo base_url('upload/') . $fe->platinum_image; ?>" ></td>
                                    <?php }?>
                                    </tr>
                                    <?php foreach ($rec as $us) {?>
                                    <tr>
                                        <td><?php echo $us->id ?></td>
                                        <td><?php echo $us->benefit ?></td>

                                        <td><input style="margin: 15px"  type="checkbox" name="gold[<?php echo $us->id; ?>]" value="gold"  <?php echo ($us->gold == "gold") ? "checked" : ""; ?>></td>

                                        <td><input style="margin: 15px"  type="checkbox" name="platinum[<?php echo $us->id; ?>]" value="platinum"  <?php echo ($us->platinum == "platinum") ? "checked" : ""; ?>></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                                <button type="submit"  class="btn btn-info m-btn--pill waves-effect waves-light">Update</button>
                            </form>
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
