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
                            <h4 class="page-title">Listing Cluster Errors </h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                                    <a style="background: #2CABE3" href="<?php echo base_url('car_guide/add_cluster_error') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Cluster Error</a>
                        </div>
                    </div>

                        <?php $this->load->view('message');?>

                        <table id="myTable" class="table table-striped" >
                            <thead>
                                <tr>
                                    <th>image</th>
                                    <th>Chassis</th>
                                     <th>Title/Title Arabic</th>

                                     <th>Error Description Text</th>
                                      <th>Shop Type</th>
                                      <th>Shop Name</th>
                                    <th>Option</th>

                                </tr>
                             </thead>
                             <tbody>
                             <?php $this->load->model('Car_guide_model', 'car_guide');?>

                                <?php
foreach ($rec as $us) {
	// $chassis_number = $this->car_guide->get_chassis_number($us->chassis);
	$chassis_arr = explode(",", $us->chassis, 5);

	$shop = $this->car_guide->get_shop_name_by_id($us->shop_type, $us->shop_id);
	?>
                                <tr>
                                    <td>
                                        <image class="img_size" src="<?php echo base_url('upload/') . $us->pic1; ?>">
                                    </td>
                                    <td>
        <?php $cou = count($chassis_arr);
	?>

        <?php
if ($cou <= 4) {
		foreach ($chassis_number as $chassis_n) {
			if (in_array($chassis_n->id, $chassis_arr)) {

				echo $chassis_n->chassis_num . ', ';

			}}
	} else {
		foreach ($chassis_number as $chassis_n) {
			if (in_array($chassis_n->id, $chassis_arr)) {

				echo $chassis_n->chassis_num . ', ';

			}}
		echo "More...";
	}
	?>

                                    </td>

                                    <td><?php echo $us->title . '<br>' . $us->title_arabic ?></td>
                                    <td><?php echo $us->description; ?></td>

                                    <td><?php echo $us->shop_type ?></td>
                                    <td><?php if ($shop != "") {echo $shop->name;}?> </td>

                                    <td>
                                        <a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('car_guide/edit_cluster_error') ?>/<?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
                                        <a class="text-inverse " data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('car_guide/del_cluster_error/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>

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
         <script type="text/javascript">
                function get_shop(shop_type){


                    if(shop_type ==="NULL"){
                        $('#shop').html('');
                        $("#shop").val("");
                    }
                    $.ajax({
                        type: 'post',
                        url:'<?php echo base_url("car_guide/get_shops") ?>',
                        data: {'shop_type':shop_type},
                        success: function (mydata) {
                            console.log(mydata);
                            $('#shop').html(mydata);
                            $("#shop").val("<?php echo $rec->shop_id ?>");
                        }
                    });
                }
        </script>

    </body>

</html>




