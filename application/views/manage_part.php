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
                            <h4 class="page-title">Manage parts </h4>
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
                                    <th style="text-align: center;"><input type="checkbox" class="selectAll"></th>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Provider Name</th>
                                    <th>Provider Logo</th>
                                    <th>Part name/Part number</th>
                                    <th>Category/Sub Category</th>
                                    <th>class/Chassis</th>
                                    <th>Part Case</th>
                                    <th>Brand/User</th>
                                    <th>Approve/Reject</th>
                                    <th>Option</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
foreach ($rec as $us) {
	$chassis_number = $this->part->get_chassis_number($us->chassis_id);
	$model_number = $this->part->get_model_number($us->model_id);

	/*$brand=  explode(",",$us->part_brand);*/
	$brand = $this->part->brand_data($us->part_brand);
	$cat = $this->part->get_category_name($us->part_category);
	$scat = $this->part->get_subcategory_name($us->part_sub_category);
	$photo_name = $this->partphotos->select_photo($us->id);
	?>
                                    <tr>
                            <td></td>
                            <td><?php echo $us->id ?></td>
                                        <td>
                                            <?php if (!empty($photo_name)) {?>
                                                <img class="img_size" src="<?php echo base_url() . "/upload/$photo_name->photo_name" ?>">
                                            <?php } else {echo "No image";}?>
                                        </td>
                                        <td>
                                        <?php foreach ($providers as $provider) {if ($us->provider_id == $provider['id']) {echo $provider['user_name'];}}?>

                                        </td>
                                        <td>
                                        <?php foreach ($providers as $provider) {if ($us->provider_id == $provider['id']) {?>
                                            <img class="img_size" src="<?php echo base_url('upload/') . $provider['logo']; ?>" >
                                         <?php }}?>

                                        </td>
                                        <td><?php echo $us->title . "<br>" . $us->part_number; ?></td>
                                        <td><?php echo $cat->name . "<br>" . $scat->name; ?> </td>
                                        <td><?php echo $chassis_number->chassis_num; ?> <br> <?php if (empty($model_number)) {echo "No Class";} else {echo $model_number->name;}?> </td>
                                        <td><?php echo $us->part_case; ?> </td>
                                        <td><?php if ($brand) {echo $brand->name;}
	echo "<br>" . $us->username?></td>
                                        <td> <?php if ($us->status == "pending" || $us->status == "reject") {?>
                                            <a href="<?php echo base_url('part/approve/') ?><?php echo $us->id; ?>">
                                            <button class="btn btn-small btn-primary"><i class="fa fa-check"></i></button></a>
                                        <?php }?>
                                        <?php if ($us->status == "pending" || $us->status == "approve") {?>
                                            <a href="<?php echo base_url('part/reject/') ?><?php echo $us->id; ?>"><button class="btn btn-small btn-danger"><i class="fa fa-times"></i></button></a>
                                        <?php }?>
                                        </td>

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
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

        <script>
            $(document).ready( function () {
        var table= $('#myTable').DataTable({
            dom: 'Bfrtip',
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            } ],
            select: {
                style:    'multi+shift',
                selector: 'td:first-child'
            },
            buttons: [
                'excel',
                {
                    text: 'Approve',
                    action: function () {
                        var arr= [];
                        var data= table.rows( { selected: true } ).data().toArray();;
                        data.forEach(function (part) {
                            arr.push(part[1])
                        })
                        $.ajax({
                            type: 'post',
                            url:'<?php echo base_url("part/approve_many") ?>',
                            data: {parts: arr},
                            success: function (mydata) {
                                console.log(mydata);
                                location.href= mydata
                            }
                        });
                    }
                },
                {
                    text: 'Reject',
                    action: function () {
                        var arr= [];
                        var data= table.rows( { selected: true } ).data().toArray();;
                        data.forEach(function (part) {
                            arr.push(part[1])
                        })
                        $.ajax({
                            type: 'post',
                            url:'<?php echo base_url("part/reject_many") ?>',
                            data: {parts: arr},
                            success: function (mydata) {
                                console.log(mydata);
                                location.href= mydata
                            }
                        });
                    }
                },
                {
                    text: 'Delete',
                    action: function () {
                        var arr= [];
                        var data= table.rows( { selected: true } ).data().toArray();;
                        data.forEach(function (part) {
                            arr.push(part[1])
                        })
                        $.ajax({
                            type: 'post',
                            url:'<?php echo base_url("part/delete_many") ?>',
                            data: {parts: arr},
                            success: function (mydata) {
                                console.log(mydata);
                                location.href= mydata
                            }
                        });
                    }
                },
            ],
            "bSort": false
        });
        $(".selectAll").on( "click", function(e) {
            if ($(this).is( ":checked" )) {
                table.rows({ page: 'current' }).select();
            } else {
                table.rows({ page: 'current' }).deselect();
            }
            console.log(table.rows( { selected: true } ).data())
        });
            });
        </script>
    </body>

</html>




