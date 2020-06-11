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
								<?php print_r($part_photos)?>
								<form name="" method="post"type="" scope="" action="<?php echo base_url('/part/update_part_photos') ?>" enctype="multipart/form-data">
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


					<form  name="frm" method="post" action="<?php echo base_url('/part/edit_part/' . $rec->id) ?>" enctype="multipart/form-data" >
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

<div class="row" style="padding-top: 20px">
								<div class="col-md-6">
									<label class="control-label col-md-3">Provider Name</label>
									<div class="col-md-9">
										<select  name="provider_id" class="form-control" id="provider_id">
											<!-- <option value="">Select services</option> -->
											<?php foreach ($providers as $provider) {?>

            								<option value="<?php echo $provider['id']; ?>"<?php if ($provider['id'] == $rec->provider_id) {echo 'selected="selected"';}?>><?php echo $provider['user_name']; ?></option>

											<?php }?>
										</select>
										<script type="text/javascript">
                                            document.frm.part_category.value='<?php echo $rec->part_category ?>';
										</script>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Status</label>
										<div class="col-md-9">
											<select id="status"  name="status" class="form-control">
                                                <?php if (!empty($rec->status)) {?>
                                                <option value="<?php echo $rec->status ?>" selected="selected"><?php echo $rec->status ?></option>

                                                <?php if ($rec->status == 'pending') {?>
                                                    <option value="approve">approve</option>
                                                    <option value="reject">reject</option>
                                                <?php }?>
                                                <?php if ($rec->status == 'approve') {?>
                                                    <option value="pending">pending</option>
                                                    <option value="reject">reject</option>
                                                <?php }?>
                                                <?php if ($rec->status == 'reject') {?>
                                                    <option value="pending">pending</option>
                                                    <option value="approve">approve</option>
                                                <?php }}?>
                                            </select>
										</div>
									</div>
								</div>
                            </div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
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


							<?php $chassis_numb = $this->part->get_chassis_by_id($rec->chassis_id);?>
							<div style="padding :15px"  class="row margin-top" >

								<div class="col-md-6" >
									<div class="form-group">
										<div class="col-md-9">
											<label class="control-label ">Select Class </label>
											<?php $model_arr = explode(",", $rec->model_id);?>
											<select id="classes_select" type="text" name="model_id[]" class="form-control js-example-tokenizer3" multiple >
												<option value="0">All</option>

												<?php foreach ($model_name as $model) {
	?>

												<?php
if (in_array($model->id, $model_arr)) {
		echo '<option value="' . $model->id . '" selected>' . $model->name . '</option>';
	} else {
		echo '<option value="' . $model->id . '">' . $model->name . '</option>';
	}

	?>
                                                <?php }?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<div class="col-md-9">
											<label for="chassis" class="control-label">Select Chassis</label>
											<?php $chassis_arr = explode(",", $rec->chassis_id);?>
											<select  required type="text" name="chassis[]" id="chassis_select" class="form-control js-example-tokenizer" multiple>

												<option value="<?php foreach ($chassis as $c) {echo $c->id . ',';}?>">All</option>
                                                <?php foreach ($chassis_number as $cn) {
	?>

                                                    <?php
if (in_array($cn->id, $chassis_arr)) {
//if ($chassis_numb->chassis_num == $cn->chassis_num) {
		echo '<option value="' . $cn->id . '" selected>' . $cn->chassis_num . '</option>';
	} else {
		echo '<option value="' . $cn->id . '">' . $cn->chassis_num . '</option>';
	}

	?>
                                                <?php }?>

											</select>
										</div>
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
		<script type="text/javascript" src="<?php echo base_url() ?>assets/file-upload/dist/image-uploader.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/file-upload/dist/karim-image-uploader.js"></script>
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
                    if(!$(this).val() || $(this).val() == 0 || valueArr.indexOf("0") != -1){
                        availableChassis= chassis.slice()
                    }else{
                        availableChassis= chassis.filter(function (ch) {
                            return valueArr.indexOf(ch.model_id) != -1
                        })
                    }
                    var prevValue= $('#chassis_select').val();
                    $('#chassis_select').empty();
                    // $('#chassis_select').append('<option value="">Select Option</option>');
                    $('#chassis_select').append('<option value="all">All</option>');
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
                    url:'<?php echo base_url("part/sub_cat") ?>',
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

