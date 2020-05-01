<?php $this->load->view('common/common_header');?>

<body class="fix-header">

<div class="preloader">
	<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
	</svg>
</div>

<div id="wrapper" style="background: white">

	<?php $this->load->view('provider/common/top_nav');?>

	<?php $this->load->view('provider/common/left_nav');?>
	<div id="page-wrapper" style="background: white">
		<div class="container-fluid">
			<div class="row bg-title">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<h4 class="page-title">Listing Parts </h4>
				</div>
				<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					<a style="background: #2CABE3" href="<?php echo base_url('provider/parts/add_part') ?>" class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Parts</a>
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

						<th>Part name/Part number</th>
						<th>Category/Sub Category</th>
						<th>Price/Discount</th>
						<th>Chassis</th>
						<th>Brand/User</th>
						<th>Status</th>
						<th>Featured</th>
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
							<td></td>
							<td><?php echo $us->id?></td>
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
								<?php if($us->status == "pending"){ ?>
									<button class="btn btn-small btn-info">Pending</button>
								<?php }else if($us->status == "approve"){ ?>
									<?php if($us->active){ ?>
										<a href="<?php echo base_url('provider/parts/deactivate/') ?><?php echo $us->id; ?>"><button class="btn btn-small btn-danger">Deactivate</button></a>
									<?php }else{ ?>
										<a href="<?php echo base_url('provider/parts/activate/') ?><?php echo $us->id; ?>"><button class="btn btn-small btn-success">Activate</button></a>
									<?php } ?>
								<?php }else{ ?>
									<button class="btn btn-small btn-danger">Rejected</button>
								<?php } ?>
							</td>
							<td>
								<?php if($us->featured == 0){ ?>
									<a href="<?php echo base_url('provider/parts/add_to_featured/') ?><?php echo $us->id; ?>"><button class="btn btn-small btn-danger">Add</button></a>
								<?php }else{ ?>
									<a href="<?php echo base_url('provider/parts/remove_from_featured/') ?><?php echo $us->id; ?>"><button class="btn btn-small btn-success">Remove</button></a>
								<?php } ?>
							</td>

							<td>
								<a class="text-inverse pr-2" data-toggle="tooltip" data-original-title="Edit" href="<?php echo base_url('provider/parts/edit_part') ?>/<?php echo $us->id; ?>"><i class="ti-marker-alt"></i></a>
								<a class="text-inverse " data-toggle="tooltip" data-original-title="Delete" href="<?php echo base_url('provider/parts/del_part/') ?><?php echo $us->id; ?>" onclick="return confirm('Are You Sure To Delete This?')"><i class="ti-trash"></i></a>
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
        // Setup - add a text input to each footer cell
        // $('#myTable tfoot th').each( function () {
        //     var title = $(this).text();
        //     if(title)
	    //         $(this).html( '<input style="width: 150px; font-weight: 100;" type="text" placeholder="Search '+title+'" />' );
        // } );

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
                    text: 'Activate',
                    action: function () {
                        var arr= [];
                        var data= table.rows( { selected: true } ).data().toArray();;
                        data.forEach(function (part) {
							arr.push(part[1])
                        })
                        $.ajax({
                            type: 'post',
                            url:'<?php echo base_url("provider/parts/activate_many") ?>',
                            data: {parts: arr},
                            success: function (mydata) {
                                console.log(mydata);
                                location.href= mydata
                            }
                        });
                    }
                },
                {
                    text: 'Deactivate',
                    action: function () {
                        var arr= [];
                        var data= table.rows( { selected: true } ).data().toArray();;
                        data.forEach(function (part) {
							arr.push(part[1])
                        })
                        $.ajax({
                            type: 'post',
                            url:'<?php echo base_url("provider/parts/deactivate_many") ?>',
                            data: {parts: arr},
                            success: function (mydata) {
                                console.log(mydata);
                                location.href= mydata
                            }
                        });
                    }
                },
                {
                    text: 'Add to Featured',
                    action: function () {
                        var arr= [];
                        var data= table.rows( { selected: true } ).data().toArray();;
                        data.forEach(function (part) {
							arr.push(part[1])
                        })
                        $.ajax({
                            type: 'post',
                            url:'<?php echo base_url("provider/parts/add_to_featured_many") ?>',
                            data: {parts: arr},
                            success: function (mydata) {
                                console.log(mydata);
                                location.href= mydata
                            }
                        });
                    }
                },
                {
                    text: 'Remove from Featured',
                    action: function () {
                        var arr= [];
                        var data= table.rows( { selected: true } ).data().toArray();;
                        data.forEach(function (part) {
							arr.push(part[1])
                        })
                        $.ajax({
                            type: 'post',
                            url:'<?php echo base_url("provider/parts/remove_from_featured_many") ?>',
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
                            url:'<?php echo base_url("provider/parts/delete_many") ?>',
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

        // Apply the search
        // table.columns().every( function () {
        //     var that = this;
		//
        //     $( 'input', this.footer() ).on( 'keyup change clear', function () {
        //         if ( that.search() !== this.value ) {
        //             that
        //                 .search( this.value )
        //                 .draw();
        //         }
        //     } );
        // } );

    });
</script>
</body>

</html>




