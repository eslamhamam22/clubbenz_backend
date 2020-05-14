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
                                    <h4 class="page-title">Manage Service Type</h4>
                                </div>
                                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('plan/add_plans') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Plan Type</a>

                                </div>
                            </div>

                            <?php $this->load->view('message');?>

                            <table id="myTable" class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Parts</th>
                                        <th>Price</th>
                                        <th>Frequency</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($rec as $us) {
	?>
                                    <tr>
                                        <td><?php echo $us->title ?></td>
                                        <td><?php echo $us->num_parts ?></td>
                                        <td><?php echo $us->price ?></td>
                                        <td><?php echo $us->frequency ?> Month</td>
                                         <td>
                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('plan/edit_plan') ?>/<?php echo $us->id ?>"><i class="ti-marker-alt"></i></a>
                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('plan/plan_del/') ?><?php echo $us->id ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
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
