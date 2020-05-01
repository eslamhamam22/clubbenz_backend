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
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Update Part </h4>
                        </div>
                    </div>
                   <?php $this->load->view('message');?>

					<div id="edit_role" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" style="display: none;">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="exampleModalLabel1">Photo Update</h4>
								</div>
								<?php print_r($part_photos) ?>
								<form name="" method="post"type="" scope="" action="<?php echo base_url('/provider/parts/update_part_photos') ?>" enctype="multipart/form-data">
									<input type="hidden" name="user_id" id="user_id" />
									<div class="modal-body">
										<div class="row">
											<div class="col-md-3 col-sm-3 col-xs-12">
												<label>Select Photo</label>
											</div>
											<div class="col-md-9 col-sm-9 col-xs-12">

												<input type="file" class= "form-control btn btn-default" name="image" id="image" size="20" required />

											</div>


										</div>
										<input type="hidden" name="id" id="id">
										<input type="hidden" name="part_id" id="part_id">

									</div>
									<div class="modal-footer">
										<button type="submit"  class="btn btn-info m-btn--pill waves-effect waves-light">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>


					<form  name="frm" method="post" action="<?php echo base_url('provider/parts/edit_part/' . $rec->id) ?>" enctype="multipart/form-data" >
                        <div class="form-body"style="background: white;padding-bottom:30px">
                            <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>
							<div class="row" style="padding-top: 20px">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Images</label>
										<div class="col-md-9">
											<div style="cursor: pointer" class="input-images"></div>
										</div>
									</div>
								</div>
							</div>
<!--							<div class="row" style="padding-top: 20px">-->
<!--								<div class="col-md-12">-->
<!--									<div class="form-group">-->
<!--										<label class="control-label col-md-3">Product arrangement in order (1 shown first, then 2, 3, ....)</label>-->
<!--										<div class="col-md-9">-->
<!--											<input type="number" required name="sort_order" class="form-control" placeholder="1"value="--><?php //echo $rec->sort_order; ?><!--">-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->

                            <div class="row" style="padding-top: 20px">



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9"><input type="text" name="title" class="form-control" value="<?php echo $rec->title ?>" maxlength="90"> </div>
                                    </div>
                                </div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Title Arabic</label>
										<div class="col-md-9"><input type="text" name="title_arabic" class="form-control" value="<?php echo $rec->title_arabic ?>" maxlength="90"> </div>
									</div>
								</div>

                            </div>
                            <div class="row margin-top">
								<div class="col-md-6">
									<label class="control-label col-md-3">Parts Category</label>
									<div class="col-md-9">
										<select required name="part_category" class="form-control" id="cat" onchange="get_subcategories(this.value)">
											<option value="">Select services</option>
											<?php foreach ($parts_category as $sr) {?>
												<option value="<?php echo $sr->id; ?>" ><?php echo $sr->name ?></option>
											<?php }?>
										</select>
										<script type="text/javascript">
                                            document.frm.part_category.value='<?php echo $rec->part_category ?>';
										</script>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Parts Sub Category</label>
										<div class="col-md-9">
											<select required name="part_sub_category" class="form-control" id="scat" >
												<option value="">Select Sub Category</option>
											</select>
										</div>
									</div>
								</div>



                            </div>
<!--                            <div class="row margin-top">-->
<!--								<br>-->
<!--								<label style =" color: red ; padding-left  : 80px ; font-size: 14px;" for="inputEmail3" class="control-label">  Main Photo </label>-->

<!--								<div class=" el-element-overlay m-b-40" style="margin: 15px">-->
									<?php
foreach ($part_photos as $us) {
	?>
<!--										<div  style="width: 20%" class=" col-md-4 col-sm-6 col-xs-12">-->
<!--												<div style="padding-bottom: 0px" class="el-card-item">-->
<!--													<div style="height:180px;" class="el-card-avatar el-overlay-1"> <image style="width:180px;margin:auto;" src="--><?php //echo base_url('upload/') . $us['photo_name']; ?><!--">-->
<!--															<div class="el-overlay">-->
<!--																<ul class="el-info">-->
<!---->
<!--																</ul>-->
<!--															</div>-->
<!---->
<!--													</div>-->
<!---->
<!--												</div>-->
<!--											<div align="center">-->
<!---->
<!--											</div>-->
<!--										</div>-->

									<?php }
;?>
									<?php
for ($i = 0; $i < $remaining_count; $i++) {
	?>

<!--										<div  style="width: 20%" class=" col-md-4 col-sm-6 col-xs-12">-->
<!--											<div style="padding-bottom: 0px" class="el-card-item">-->
<!--												<div style="height:180px;" class="el-card-avatar el-overlay-1"> <image style="width:180px;margin:auto;" src="">-->
<!--														<div class="el-overlay">-->
<!--															<ul class="el-info">-->
<!---->
<!--															</ul>-->
<!--														</div>-->
<!---->
<!--												</div>-->
<!---->
<!--											</div>-->
<!--											<div align="center">-->
<!--												<input style =" font-size: 10px; padding  : 12px ; width : 180px ; display : initial ; margin-bottom : 15px"   type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />-->
<!--											</div>-->
<!--										</div>-->


									<?php }
;?>
<!--								</div>-->

<!--							</div>-->
                            <div class="row margin-top">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Part Number</label>
                                        <div class="col-md-9">
                                            <input required type="text" name="part_number" class="form-control" value="<?php echo $rec->part_number ?>" maxlength="20"> </div>
                                    </div>
                                </div>

								<div class="col-md-6">

									<div class="form-group">
										<label class="control-label col-md-3">Description</label>
										<div class="col-md-9">
                                            <textarea required name="description" rows="4" class="form-control"><?php echo $rec->description ?>
                                            </textarea>
										</div>
									</div>
								</div>



							</div>
							<div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
							</div>
							<div class="row margin-top">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Part Case</label>
										<div class="col-md-9">
											<?php $part_array = explode(',', $rec->part_case);?>
											<div style="margin-top: 20px;">
												<input type="radio" name="part_case" value="New" <?php if (in_array("New", $part_array)) {?> checked <?php }?>> New
												<input style="margin-left: 55px" type="radio" name="part_case" value="Used" <?php if (in_array("Used", $part_array)) {?> checked <?php }?> > Used
											</div>
											<span class="help-block"></span>
										</div>
									</div>
								</div>

							</div>
							<div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
							</div>
							<label style =" padding  : 15px ;    font-size: 17px;"> Part Fitting </label>
							<?php
							$chassis_numb = $this->part->get_chassis_by_id($rec->chassis_id);
							?>
							<div style="padding :15px"  class="row margin-top" >

								<div class="col-md-6" >
									<div class="form-group">
										<div class="col-md-9">
											<label class="control-label ">Select Class </label>
											<select id="classes_select" type="text" name="model_id[]" class="form-control js-example-tokenizer3" multiple >
												<option value="">Select Option</option>
												<?php foreach ($model_name as $model) {?>
													<?php if ($chassis_numb->model_id == $model->id) {
														echo '<option selected value="' . $model->id . '">' . $model->name . '</option>';
													} else {
														echo '<option value="' . $model->id . '">' . $model->name . '</option>';
													}
												}?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<div class="col-md-9">
											<label for="chassis" class="control-label">Select Chassis</label>

											<select  required type="text" name="chassis" id="chassis_select" class="form-control">
												<option value="">Select Chassis</option>
												<option value="24" >All</option>
												<?php foreach ($chassis_number as $c) {?>
													<?php if ($chassis_numb->chassis_num == $c->chassis_num) {
														echo '<option selected value="' . $c->id . '">' . $c->chassis_num . '</option>';
													} else {
														echo '<option value="' . $c->id . '">' . $c->chassis_num . '</option>';
													}
												}?>

											</select>
										</div>
									</div>
								</div>

							</div>

							<div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
							</div>
							<label style =" padding  : 15px ;    font-size: 17px;"> Part Price </label>

							<div class="row margin-top">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Price</label>
										<div class="col-md-9">
											<input required type="text" name="price" class="form-control" value="<?php echo $rec->price ?>" maxlength="6">
										</div>
									</div>
								</div>

								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Discount%</label>
                                        <div class="col-md-9">
                                            <input required type="text" name="discount" class="form-control" value="<?php echo $rec->discount ?>"> </div>
                                    </div>
                                </div>
                            </div>
							<div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
							</div>
                            <div class="row margin-top">
                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Parts Brand</label>
                                        <div class="col-md-9">
                                            <?php $brand_arr = explode(',', $rec->part_brand);?>
                                            <select name="part_brand[]"  class="form-control js-example-tokenizer">
                                                <?php foreach ($brand as $b) {?>
                                                <option <?php if (in_array($b->id, $brand_arr)) {?> selected="selected" <?php }?>  value="<?php echo $b->id ?>"><?php echo $b->name; ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
							<div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
							</div>
							<div class="row margin-top">

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3 ">Set Date of Listing</label>
										<div class="col-md-9 " >
											<input  type="date" data-date-format='yyyy-mm-dd' id="add_date" value="<?php echo $rec->add_date ?>" name="add_date"  readonly>

											<div id="Create" style="display:none">
												<label style="margin-top: 10px" class="control-label "> Enter Updated Date</label><br>

												<input  type="date" data-date-format='yyyy-mm-dd' id="updated_date" value="" name="updated_date"  min="<?php echo date('Y-m-d'); ?>">

											</div>
											<input type="button" id="btn" class="btn btn-default" value="Update Date ">

										</div>
									</div>
								</div>
							</div>
							<div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
							</div>
<!--							<label style =" padding  : 15px ;    font-size: 17px;"> Location </label>-->

<!--							<div class="row margin-top">-->

<!--								<div class="col-md-6" >-->
<!--									<div class="form-group">-->
<!--										<div class="col-md-9">-->
<!--											<label class="control-label">Location Latitude</label>-->
<!---->
<!--											<input type="text" style="text-align: center"  name="location_lat" class="form-control" value="--><?php //echo $rec->location_latitude ?><!--">-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--								<div class="col-md-6">-->
<!--									<div class="form-group">-->
<!--										<div class="col-md-9">-->
<!--											<label class="control-label ">Location Longitude</label>-->
<!--											<input type="text" style="text-align: center"  name="location_lon" class="form-control" value="--><?php //echo $rec->location_longitude ?><!--" > </div>-->
<!--									</div>-->
<!--								</div>-->
<!--                                -->
<!--                                <div class="col-md-6">-->
<!--                                    -->
<!--                                    <div class="form-group">-->
<!--                                        <label class="control-label col-md-3">Location</label>-->
<!--                                        <div class="col-md-9">-->
<!--                                            <input type="text"  name="location" class="form-control" value="--><?php //echo $rec->location?><!--"> </div>-->
<!--                                    </div>-->
<!--                                </div>-->

<!--							</div>-->
							<div class="row margin-top">

								<div class="col-md-6" >
									<div class="form-group">
										<div class="col-md-9">
											<label class="control-label ">Location Zone</label>

											<select name="location_zone" class="form-control">
												<option value =""></option>
												<?php foreach ($location as $loc) {?>
													<option value="<?php echo $loc->id ?>"><?php echo $loc->name; ?></option>
												<?php }?>
											</select>
											<script type="text/javascript">
                                                document.frm.location_zone.value='<?php echo $rec->location_zone ?>';
											</script>

										</div>
									</div>
								</div>
							</div>
							<div class="row margin-top" >
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Location Zone</label>
										<div class="col-md-9">
											<div style="margin-top: 0px;">
												<input type="radio" name="available_location" value="National" required <?php echo ($rec->available_location == "National")? "checked" : ""; ?>>National
												<input style="margin-left: 55px" type="radio" name="available_location" value="International" required <?php echo ($rec->available_location == "International")? "checked" : ""; ?>> International
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row margin-top">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Date of active</label>
										<div class="col-md-9">
											<input required type="date" data-date-format='yyyy-mm-dd'  name="date_active" value="<?php echo $rec->date_active; ?>" id="datepicker2"   min="<?php echo date('Y-m-d'); ?>"/>
										</div>
									</div>
								</div>

							</div>
							<div class="row margin-top">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">date of Expiry</label>
										<div class="col-md-9">
											<input required type="date" data-date-format='yyyy-mm-dd'  name="date_expire" value="<?php echo $rec->date_expire; ?>" id="datepicker3"   min="<?php echo date('Y-m-d'); ?>"/>
										</div>
									</div>
								</div>

							</div>
							<div class="row" style="padding-top: 20px">
								<div class="col-md-9">
									<div class="form-group">
										<label class="control-label col-md-3">number of available in stock</label>
										<div class="col-md-9">
											<input type="number" required name="num_stock" class="form-control" placeholder="1" value="<?php echo $rec->num_stock; ?>">
										</div>
									</div>
								</div>
							</div>

							<div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
							</div>
							<div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
							</div>
							<input required style="margin: 15px" type="checkbox" name="vehicle1" value="Bike">By clicking "Update" you agree to our Terms of use and Posting Rules <br>
                            <div style="padding-left: 600px;margin-top: 30px">
                                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
                <?php $this->load->view("common/common_footer")?>
            </div>
        </div>
        <?php $this->load->view("common/common_script")?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/file-upload/dist/image-uploader.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/file-upload/dist/karim-image-uploader.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var preloaded= [];
                <?php
				foreach ($part_photos as $us) {
					?>
				preloaded.push({
					id: <?php echo $us['id']; ?>,
					src: "<?php echo base_url('upload/') . $us['photo_name']; ?>"
				})
					<?php
				}
				?>
				console.log(JSON.stringify(preloaded))
                $('.input-images').imageUploader({
                    preloaded: preloaded,
                    imagesInputName: 'image',
                    preloadedInputName: 'old'
                });
                $("#btn").click(function () {
                    $("#Create").show();
                    $("#btn").hide();

                });
                $(".js-example-tokenizer").select2({
                    tags: true,
                    placeholder: "Please select option",
                    tokenSeparators: [',', ' ']
                });
                $(".js-example-tokenizer2").select2({
                    placeholder: "Please select option",
                    tokenSeparators: [',', ' ']
                });
                get_subcategories($("#cat").val());
                $(".js-example-tokenizer3").select2({
                    placeholder: "Please select option",
                    tokenSeparators: [',', ' ']
                });
                var chassis= [];
				<?php foreach ($chassis as $c) {?>
                chassis.push({
                    id: <?php echo $c->id; ?>,
                    chassis_num: "<?php echo $c->chassis_num; ?>",
                    model_id: "<?php echo $c->model_id; ?>"
                })
				<?php }?>
                $('#classes_select').change( function () {
                    var value = $(this).val() + ''
                    console.log(value)
                    var valueArr= value.split(',');
                    var availableChassis= []
                    if(!$(this).val()){
                        availableChassis= chassis.slice()
                    }else{
                        availableChassis= chassis.filter(function (ch) {
                            return valueArr.indexOf(ch.model_id) != -1
                        })
                    }
                    var prevValue= $('#chassis_select').val();
                    $('#chassis_select').empty();
                    $('#chassis_select').append('<option value="">Select Option</option>');
                    availableChassis.forEach( function(ch){
                        console.log(ch.id)
                        $('#chassis_select').append('<option value="'+ch.id+'">'+ch.chassis_num+'</option>');
                    })
                    $('#chassis_select').val(prevValue || '')
                });
            });
            //  $("#datepicker").datepicker().datepicker();

            function get_subcategories(id){
                $.ajax({
                    type: 'post',
                    url:'<?php echo base_url("provider/parts/sub_cat") ?>',
                    data: {'id':id},
                    success: function (mydata) {
                        console.log(mydata);
                        $('#scat').html(mydata);
                        $("#scat").val("<?php echo $rec->part_sub_category ?>");
                    }
                });
            }
        </script>
		<script type="text/javascript">
            function update(uid,status,part_id){

                $("#id").val(uid);
                $("#status").val(status);
                $("#part_id").val(part_id);
            }

		</script>

	</body>
</html>

