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
                 <div id="page-wrapper" style="background: white">
                    <div class="container-fluid">
                        <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Listing Car Guide </h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('car_guide/add_car_guide') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Car Guide</a>
                        </div>
                    </div>

                        <?php $this->load->view('message');?>
                        <table id="myTable" class="table table-striped" >
                            <thead>
                                <tr>
                                    <th>Chassis</th>
                                    <th>Option</th>

                                </tr>
                             </thead>
                             <tbody>
                                <?php
foreach ($rec as $us) {
	$chassis_number = $this->car_guide->get_chassis_number($us->chassis);

	?>
                                <tr>
                                    <td><?php echo $chassis_number->chassis_num; ?></td>
                                    <td>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('car_guide/edit_car_guide') ?>/<?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                        <a class="text-inverse " data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('car_guide/del_car_guide/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>

                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                         </table>
                        <?php $this->load->view("common/common_footer")?>
                </div>
            </div>
        </div>
        <?php $this->load->view("common/common_script")?>

        <script>
            $(document).ready( function () {
                $('#myTable').DataTable({"bSort": false});
            });
        </script>
    </body>

</html>




