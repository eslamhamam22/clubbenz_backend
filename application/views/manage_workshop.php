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
                            <h4 class="page-title">Listing Wrokshops</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <a style="background: #2CABE3" href="<?php echo base_url('workshop/add_workshop') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Workshop</a>
                            <a style="background: #2CABE3" href="<?php echo base_url('workshop/import_workshop') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">import Workshop</a>
                            <a style="background: #2CABE3" href="<?php echo base_url('workshop/export') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Export Workshop</a>
                        </div>
                    </div>
                        <?php $this->load->view('message');?>
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Logo</th>
                                <th style="width:100px">English/Arabic name</th>
                                <th>City/Country</th>
                                <!-- <th style="width:100px" >Service Tag</th> -->
                                 <th>Phone</th>
                                 <th>Rating image</th>
                                <th>Booking Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
foreach ($rec as $us) {
	/* $ser = $this->cars->workshop_tag($us->service_tag);*/
	/*!empty($us->service_tag) ? explode(",",$us->service_tag) : "";*/
	/*$ser=explode(",",$us->service_tag);*/
	?>
                            <tr>
                                <td><img class="img_size" src="<?php echo base_url('upload/') . $us->workshop_logo; ?>"></td>
                                <td><?php echo $us->name . "<br>" . $us->arabic_name; ?></td>
                                <td style="width:100px"><?php echo $us->city . "<br>" . $us->country; ?></td>
                                <td><?php echo $us->phone; ?></td>
                                <td><img class="img_size" src="<?php echo base_url('upload/') . $us->photo_selection_arround_rating; ?>"></td>
                                <!-- <td style="width:100px">
                                 <?php
if (!empty($ser)) {

		foreach ($ser as $srv) {

			$dt = $this->cars->workshop_tag($srv);
			echo $dt->name . ",";
		}

	}?>
                                </td> -->

                               <!--  <td><?php echo $ser->name; ?></td> -->

                                <!-- <td><?php echo $us->address; ?></td> -->

                                <td>
                                     <?php $active = $us->active;if ($active == 1) {?>
                                    <a href="<?php echo base_url('workshop/update_active?sid=') ?><?php echo $us->id; ?>&sval=<?php echo $active; ?> " class="btn btn-danger">in Active</a>
                                    <?php } else {?>
                                         <a href="<?php echo base_url('workshop/update_active?sid=') ?><?php echo $us->id; ?>&sval=<?php echo $active; ?> " class="btn btn-success">Active</a>
                                    <?php }?>
                                </td>

                                <td>
                                  <a data-toggle="tooltip" data-original-title="Offer" href="<?php echo base_url(); ?>offers/manage_offers/<?php echo $us->id; ?>/workshop"><i class="mdi mdi-diamond"></i></a>
                                  <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('workshop/edit_workshop') ?>/<?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                  <a class="text-inverse " data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('workshop/ws_del/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>

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
            });
        </script>


    </body>

</html>
