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
                 <div id="page-wrapper" >
                    <div class="container-fluid">
                        <div class="row bg-title">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                <h4 class="page-title">Manaege Service Tag</h4>
                            </div>
                            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('service_tag/add_service_tag') ?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Service tag</a>
                            </div>
                        </div>



                        <?php $this->load->view('message');?>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="panel">
                                        <div class="panel-heading">Workshop Services</div>
                                        <div class="table-responsive">
                                            <table class="table table-hover manage-u-table">
                                                <thead>
                                                    <tr>
                                                        <th width="70" class="text-center">#</th>
                                                        <th>NAME</th>
                                                        <th width="300">MANAGE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <?php foreach ($workshop as $us) {?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $us->sorting ?></td>
                                                        <td><?php echo $us->name ?></td>
                                                        <td>
                                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('service_tag/edit_service_tag/') ?><?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('service_tag/del_service_tag/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
                                                        </td>
                                                     </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel">
                                        <div class="panel-heading">Parts Shop Services</div>
                                        <div class="table-responsive">
                                            <table class="table table-hover manage-u-table">
                                                <thead>
                                                    <tr>
                                                        <th width="70" class="text-center">#</th>
                                                        <th>NAME</th>
                                                        <th width="300">MANAGE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <?php foreach ($partshop as $us) {?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $us->sorting ?></td>
                                                        <td><?php echo $us->name ?></td>
                                                        <td>
                                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('service_tag/edit_service_tag/') ?><?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('service_tag/del_service_tag/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
                                                        </td>
                                                     </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel">
                                        <div class="panel-heading">Service Shop Services</div>
                                        <div class="table-responsive">
                                            <table class="table table-hover manage-u-table">
                                                <thead>
                                                    <tr>
                                                        <th width="70" class="text-center">#</th>
                                                        <th>NAME</th>
                                                        <th width="300">MANAGE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <?php foreach ($serviceshop as $us) {?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $us->sorting ?></td>
                                                        <td><?php echo $us->name ?></td>
                                                        <td>
                                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('service_tag/edit_service_tag/') ?><?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('service_tag/del_service_tag/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
                                                        </td>
                                                     </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <?php $this->load->view('common/common_footer');?>
                </div>
            </div>
        </div>
        <?php $this->load->view('common/common_script');?>
        <!-- <script>
            $(document).ready( function () {
                $('#myTable').DataTable({

                });
            } );
        </script>  -->
    </body>

</html>
