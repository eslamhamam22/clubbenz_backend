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
                            <h4 class="page-title">Manage Offers</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url(); ?>offers/add_offers/<?php echo $shop_id . '/' . $type; ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Offers</a>
                        </div>
                    </div>


                        <div class="col-md-4 col-lg-3" >
                            <div>
                                <div id="morris-area-chart2" style="height:2px;visibility: hidden;"></div>
                            </div>
                        </div>

                        <?php $this->load->view('message');?>

                        <table id="myTable" class="table table-striped" >
                            <thead>
                                <tr>
                                    <th> Image</th>
                                    <th>End Offer Date</th>
                                    <th>Offer Text</th>
                                    <th>offer Text  Arabic</th>
                                    <th>Link</th>
                                    <th>Type</th>
                                    <th>Option</th>
                                </tr>
                             </thead>
                             <tbody>
                                <?php
if ($this->data['rec'] > 0) {
	foreach ($rec as $us) {
		/* $value= explode(",",$us->part_group);*/
		?>
                                <tr>
                                    <td><image class="img_size" src="<?php echo base_url('upload/') . $us['image']; ?>"></td>
                                    <td><?php
if ($us['offer_end'] != '0000-00-00') {
			echo $us['offer_end'];
		}
		?>
                                    </td>
                                    <td><?php echo $us['offer_text']; ?></td>
                                    <td><?php echo $us['offer_text_arabic']; ?></td>
                                    <td><?php echo $us['link']; ?></td>
                                    <td><?php echo $us['type']; ?></td>

                                    <td>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('offers/edit_offers') ?>/<?php echo $us['id']; ?>"><i class="ti-marker-alt"></i></a>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('offers/del_offers/') ?><?php echo $us['id'] . "/" . $us['shop_id'] . "/" . $us['type']; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
                                    </td>
                                </tr>
                                <?php }}?>
                            </tbody>
                         </table>
                    <?php $this->load->view('common/common_footer')?>
                </div>
            </div>
        </div>
        <?php $this->load->view('common/common_script')?>
       <script>
            $(document).ready( function () {
                $('#myTable').DataTable({"bSort": false});
            });
        </script>
    </body>
</html>
