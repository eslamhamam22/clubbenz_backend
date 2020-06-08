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
                            <h4 class="page-title">Listing Part Shop</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('partshop/add_part_shop') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Part Shop</a>
                                    <a style="background: #2CABE3" href="<?php echo base_url('partshop/import_part_shop') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">import Part Shop</a>
                                    <a style="background: #2CABE3" href="<?php echo base_url('partshop/export') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Export Part Shop</a>
                        </div>
                    </div>
                        <?php $this->load->view('message');?>
                        <table id="myTable" class="table table-striped" >
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>English/Arabic name</th>
                                    <th>City/Country</th>
                                    <th>Phone</th>
                                    <th>Option</th>
                                </tr>
                             </thead>
                             <tbody>
                                <?php foreach ($rec as $us) {?>
                                <tr>
                                    <td>
                                        <image class="img_size" src="<?php echo base_url('upload/') . $us->service_logo_image; ?>">
                                    </td>
                                    <td style="width:100px"><?php echo $us->name . "<br>" . $us->arabic_name; ?></td>
                                    <td><?php echo $us->city . "<br>" . $us->country; ?></td>

                                    <td><?php echo $us->phone; ?></td>

                                    <td>
                                        <a data-toggle="tooltip" data-original-title="Offer" href="<?php echo base_url(); ?>offers/manage_offers/<?php echo $us->id; ?>/partsshop"><i class="mdi mdi-diamond"></i></a>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('partshop/edit_part_shop') ?>/<?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('partshop/partshop_del/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>



                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                         </table>
                        <?php $this->load->view("common/common_footer");?>
                </div>
            </div>
        </div>
        <?php $this->load->view("common/common_script");?>

        <script>
            $(document).ready( function () {
                $('#myTable').DataTable({"bSort": false});
            });
        </script>
    </body>

</html>




