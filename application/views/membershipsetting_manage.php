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
                                    <h4 class="page-title">Manage Membership Sittngs</h4>
                                </div>
                            </div>

                            <?php $this->load->view('message');?>

                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>membership/membership_setting_update">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Benefit</th>
                                        <th>Details</th>
                                       <?php foreach ($fet as $fe) {$ct = count(array($fe->id));?>
                                        <th><?php echo $fe->name; ?></th>
                                       <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Price</td>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($fet as $fe) {?>
                                        <td><?php echo $fe->price; ?></td>
                                         <?php }?>
                                    </tr>
                                    <tr>
                                        <td>Card Image</td>
                                        <td></td>
                                        <td></td>
                                        <?php foreach ($fet as $fe) {?>
                                        <td><?php echo $fe->name; ?></td>
                                        <?php }?>
                                    </tr>
                                    <?php foreach ($rec as $us) {?>
                                    <tr>
                                        <td><?php echo $us->id ?></td>
                                        <td><?php echo $us->benefit ?></td>
                                        <td><?php foreach ($rel as $re) {?>
                                            <?php if ($us->id == $re->membership_id) {echo '-' . $re->details . '<br>';}}?>
                                        </td>
                                        <td>
                                            <?php for ($i = 0; $i < $ct; $i++) {?>
                                        <input style="margin: 15px"  type="checkbox" name="gold[<?php echo $us->id ?>]" value="gold"  <?php echo ($us->gold == 'gold') ? "checked" : ""; ?>></td>
                                        <?php }?>

                                        <td><input style="margin: 15px"  type="checkbox" name="platinum[<?php echo $us->id ?>]" value="platinum"  <?php echo ($us->platinum == 'platinum') ? "checked" : ""; ?>></td>
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
