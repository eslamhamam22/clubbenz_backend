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
                                    <h4 class="page-title">Manage classes</h4>
                                </div>
                                 <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('classes/add_model') ?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Model</a>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3" >
                                <div>

                                    <div id="morris-area-chart2" style="height:2px;visibility: hidden;"></div>
                                </div>
                            </div>
                            <?php $this->load->view('message');?>

                           <table id="myTable" class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Image</th>
                                        <th>Name En</th>
                                        <th>Name Ar</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
foreach ($rec as $us) {
	?>
                                    <tr>
                                         <td><?php echo $us->sorting; ?></td>
                                        <td><img class="img_size" src="<?php echo base_url('upload/') . $us->image; ?>"></td>
                                        <td><?php echo $us->name; ?></td>
                                        <td><?php echo $us->arabic_name; ?></td>
                                         <td>
                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('classes/model_update') ?>/<?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                            <a class="text-inverse " data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('classes/model_del/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
                                         </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                    <footer class="footer text-center">  </footer>
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
