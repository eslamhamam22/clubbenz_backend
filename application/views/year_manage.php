<?php $this->load->view('common/common_header');?>
    <body class="fix-header">
        <div class="preloader">

        </div>

        <div id="wrapper" style="background: white">
            <?php $this->load->view('common/top_nav');?>
            <?php $this->load->view('common/left_nav');?>
                 <div id="page-wrapper">
                        <div class="container-fluid" style="background: white">
                            <div class="row bg-title">
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                    <h4 class="page-title">Manaege Years</h4>
                                </div>
                                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('years/add_year') ?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Year</a>
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3" >
                                <div>

                                    <div id="morris-area-chart2" style="height:2px;visibility: hidden;"></div>
                                </div>
                            </div>
                             <?php $this->load->view('message');?>
                             <!-- <div style="margin-left:155px;padding-left:760px;margin-bottom: 10px;">
                                <a href="<?php echo base_url('carmodel/add_year') ?>" <input type="button" class='btn' style="color:white;background: #2CABE3">Add Car Year </a>
                            </div> -->

                            <table id="myTable" class="table table-striped">

                                 <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th >Model Year</th>
                                        <th >Options</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
foreach ($rec as $us) {
	?>
                                    <tr>
                                        <td><?php echo $us->sorting; ?></td>
                                        <td><?php echo $us->name; ?></td>

                                        <td>
                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('years/year_update') ?>/<?php echo $us->id; ?>/<?php echo $us->name; ?>/<?php echo $us->sorting; ?>"><i class="ti-marker-alt"></i></a>
                                            <a class="text-inverse " data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('years/year_del/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
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

        <script type="text/javascript">
            $(document).ready( function () {
                $('#myTable').DataTable({"bSort": false});
            });
        </script>



    </body>

</html>
