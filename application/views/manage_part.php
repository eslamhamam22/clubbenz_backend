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
                            <h4 class="page-title">Listing Parts </h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('part/add_part') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Parts</a>
                        </div>
                    </div>

                        <?php $this->load->view('message');?>
                        <div style="overflow: auto">
                            <table id="myTable" class="table table-striped" >
                                <thead>
                                <tr>
                                    <th>Photo</th>

                                    <th>Part name/Part number</th>
                                    <th>Category/Sub Category</th>
                                    <th>Price/Discount</th>
                                    <th>Chassis</th>
                                    <th>Brand/User</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
foreach ($rec as $us) {
	$chassis_number = $this->part->get_chassis_number($us->chassis_id);

	/*$brand=  explode(",",$us->part_brand);*/
	$brand = $this->part->brand_data($us->part_brand);
	$cat = $this->part->get_category_name($us->part_category);
	$scat = $this->part->get_subcategory_name($us->part_sub_category);
	$photo_name = $this->partphotos->select_photo($us->id);
	?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($photo_name)) {?>
                                                <img class="img_size" src="<?php echo base_url() . "/upload/$photo_name->photo_name" ?>">
                                            <?php } else {echo "No image";}?>
                                        </td>
                                        <td><?php echo $us->title . "<br>" . $us->part_number; ?></td>
                                        <td><?php echo $cat->name . "<br>" . $scat->name; ?> </td>
                                        <td><?php echo $us->price . "<br>" . $us->discount; ?></td>
                                        <td><?php echo $chassis_number->chassis_num; ?></td>
                                        <td><?php if ($brand) {echo $brand->name;}
	echo "<br>" . $us->username?></td>

                                        <td>
                                            <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('Part/edit_part') ?>/<?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                            <a class="text-inverse " data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('part/del_part/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
<!--                                            <a class="text-inverse " data-toggle="tooltip" data-original-title="Part Photo Listing" href="--><?php //echo base_url('part_photos/manage_part_photos/')?><!----><?php //echo $us->id;?><!--"><i class="ti-image"></i></a>-->

                                        </td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>

                        </div>
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




