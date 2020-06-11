<?php $this->load->view('provider/common/common_header');?>
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
                            <h4 class="page-title"><?php echo lang("ADD_Part"); ?></h4>
                        </div>

                    </div>
                    <?php $this->load->view('message');?>

                    <form  name="frm" method="post" action="<?php echo base_url('provider/parts/add_part') ?>" enctype="multipart/form-data">
                        <div class="form-body"style="background: white;padding-bottom:30px">
                            <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>
							<div class="row" style="padding-top: 20px">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo lang("Images"); ?></label>
										<div class="col-md-9">
											<div style="cursor: pointer" class="input-images"></div>
										</div>
									</div>
								</div>
							</div>
<!--							<div class="row" style="padding-top: 20px">-->
<!--								<div class="col-md-10 col-md-offset-1">-->
<!--									<div style="cursor: pointer" class="input-images"></div>-->
<!--									<fieldset class="form-group">-->
<!--										<a href="javascript:void(0)" onclick="$('#pro-image').click()">Upload Image</a>-->
<!--										<input type="file" id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple>-->
<!--									</fieldset>-->
<!--									<div class="preview-images-zone">-->
<!--										<div class="preview-image preview-show-1">-->
<!--											<div class="image-cancel" data-no="1">x</div>-->
<!--											<div class="image-zone"><img id="pro-img-1" src="https://img.purch.com/w/660/aHR0cDovL3d3dy5saXZlc2NpZW5jZS5jb20vaW1hZ2VzL2kvMDAwLzA5Ny85NTkvb3JpZ2luYWwvc2h1dHRlcnN0b2NrXzYzOTcxNjY1LmpwZw=="></div>-->
<!--											<div class="tools-edit-image"><a href="javascript:void(0)" data-no="1" class="btn btn-light btn-edit-image">edit</a></div>-->
<!--										</div>-->
<!--										<div class="preview-image preview-show-2">-->
<!--											<div class="image-cancel" data-no="2">x</div>-->
<!--											<div class="image-zone"><img id="pro-img-2" src="https://www.codeproject.com/KB/GDI-plus/ImageProcessing2/flip.jpg"></div>-->
<!--											<div class="tools-edit-image"><a href="javascript:void(0)" data-no="2" class="btn btn-light btn-edit-image">edit</a></div>-->
<!--										</div>-->
<!--										<div class="preview-image preview-show-3">-->
<!--											<div class="image-cancel" data-no="3">x</div>-->
<!--											<div class="image-zone"><img id="pro-img-3" src="http://i.stack.imgur.com/WCveg.jpg"></div>-->
<!--											<div class="tools-edit-image"><a href="javascript:void(0)" data-no="3" class="btn btn-light btn-edit-image">edit</a></div>-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--							<div class="row" style="padding-top: 20px">-->
<!--								<div class="col-md-12">-->
<!--									<div class="form-group">-->
<!--										<label class="control-label col-md-3">Product arrangement in order (1 shown first, then 2, 3, ....)</label>-->
<!--										<div class="col-md-9">-->
<!--											<input type="number" required name="sort_order" class="form-control" placeholder="1"value="--><?php //echo $this->input->post("sort_order") ?><!--">-->
<!--										</div>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->

                            <div class="row" style="padding-top: 20px">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo lang("Title"); ?></label>
                                        <div class="col-md-9">
                                            <input type="text" name="title" class="form-control" placeholder="<?php echo lang("Title"); ?>"value="<?php echo $this->input->post("title") ?>" maxlength="90"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo lang("Title_Arabic"); ?></label>
                                        <div class="col-md-9">
                                            <input type="text" name="title_arabic" class="form-control" placeholder="<?php echo lang("Title_Arabic"); ?>"value="<?php echo $this->input->post("title") ?>" maxlength="90"> </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row margin-top">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo lang("Parts_Category"); ?></label>
                                        <div class="col-md-9">
                                            <select required name="part_category" id="cat" class="form-control" >
                                                <option value=""><?php echo lang("Parts_Category"); ?></option>
                                                <?php foreach ($parts_category as $sr) {?>
                                                <option value="<?php echo $sr->id; ?>" ><?php echo $sr->name ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label col-md-3"><?php echo lang("Parts_Sub_Category"); ?></label>
                                            <div class="col-md-9">
                                                <select name="part_sub_category" class="form-control" id="scat" required>
                                                    <option><?php echo lang("Parts_Sub_Category_First"); ?></option>
                                                </select> <span class="help-block"> </span>
                                            </div>

                                        </div>

                                </div>
                            </div>
<!--                            <label style =" padding  : 15px ; font-size: 17px;" for="inputEmail3" class="control-label"> Part Photo's</label><br>-->
<!--							<label style =" color: red ; padding-left  : 80px ; font-size: 14px;" for="inputEmail3" class="control-label">  Main Photo </label>-->
                            <div align="center">
<!--								<div class="input-images"></div>-->

<!--                                      <input style =" padding  : 12px ; width : 180px ; display : initial ; margin : 15px"   type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple" required />-->
<!--                                      <input style =" padding  : 12px ; width : 180px ; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple" />-->
<!--                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />-->
<!--                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />-->
<!--                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />-->
<!--                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />-->
<!--                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />-->
<!--                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />-->
<!--                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />-->
<!--                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />-->
                                                </div>
                            <div class ="row margin-top" >



                        </div>



                            <div class="row margin-top" >

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo lang("Part_Number"); ?></label>
                                        <div class="col-md-9">
                                            <input type="text" name="part_number" class="form-control" placeholder="<?php echo lang("Part_Number"); ?>" value="<?php echo $this->input->post("part_number") ?>" maxlength="20"> </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo lang("Description"); ?></label>
                                        <div class="col-md-9">
                                            <textarea name="description" class="form-control" rows="4" placeholder="<?php echo lang("Description"); ?>"><?php echo $this->input->post("description") ?> </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>
                            <div class="row margin-top" >
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo lang("Part_Status"); ?></label>
                                        <div class="col-md-9">
											<div style="margin-top: 0px;">
												<input type="radio" name="part_case" value="New" required> <?php echo lang("New"); ?>
												<input style="margin-left: 55px" type="radio" name="part_case" value="Used" required><?php echo lang("Used"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
							</div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>
                            <label style =" padding  : 15px ;    font-size: 17px;"> <?php echo lang("Part_Fitting"); ?> </label>

							<div style="padding :15px"  class="row margin-top" >

								<div class="col-md-6" >
									<div class="form-group">
										<div class="col-md-9">
											<label class="control-label "><?php echo lang("Select_Class"); ?> </label>
											<select id="classes_select" type="text" name="model_id[]" class="form-control js-example-tokenizer3" multiple >
												<option value="0">All</option>
												<?php foreach ($model_name as $model) {?>
													<?php echo '<option value="' . $model->id . '">' . $model->name . '</option>'; ?>

												<?php }?>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<div class="col-md-9">
											<label for="chassis" class="control-label"><?php echo lang("Select_Chassis"); ?></label>

											<select  required type="text" name="chassis[]" id="chassis_select" class="form-control js-example-tokenizer" multiple>
												<option value=""><?php echo lang("Select_Chassis"); ?></option>
												<option value="<?php foreach ($chassis as $c) {echo $c->id . ',';}?>"><?php echo lang("All"); ?></option>
												<?php foreach ($chassis as $c) {?>
													<?php echo '<option value="' . $c->id . '">' . $c->chassis_num . '</option>'; ?>
												<?php }?>
											</select>
										</div>
									</div>
								</div>

							</div>

                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>

                            <label style =" padding : 15px ;    font-size: 17px;"><?php echo lang("Part_Price"); ?>  </label>

                            <div class="row margin-top">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo lang("Price"); ?></label>
                                        <div class="col-md-9">
                                            <input type="text" name="price" class="form-control" placeholder="<?php echo lang("Price"); ?>" value="<?php echo $this->input->post("price") ?>" required maxlength="6">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo lang("Discount_%"); ?></label>
                                        <div class="col-md-9">
                                            <input type="number" max="99" min="0"  name="discount" class="form-control" placeholder="<?php echo lang("Discount_%"); ?>" value="<?php echo $this->input->post("discount") ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>
                            <div class="row margin-top">

                                <div class="col-md-6" >
                                <label style =" padding : 15px ;font-size: 17px;"><?php echo lang("Part_Brand"); ?>  </label>
                                    <div class="form-group">
                                            <label class="control-label col-md-3"><?php echo lang("Select_Brand"); ?> </label>
                                            <div class="col-md-9">

                                                <select name="part_brand[]"  class="form-control js-example-tokenizer">
                                                    <?php foreach ($brand as $ar) {?>
                                                    <option value="<?php echo $ar->id ?>"><?php echo $ar->name; ?></option>
                                                    <?php }?>
                                                </select>
                                                <!--  <script type="text/javascript">
                                                document.frm.service_arabic.value='<?php echo $sr->id ?>';
                                            </script>  -->

                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>

                            <div class="row margin-top">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"><?php echo lang("Set_Date_of_Listing"); ?></label>
                                        <div class="col-md-9">
											<input required type="date" data-date-format='yyyy-mm-dd'  name="add_date" value="<?php echo date("Y-m-d") ?>" id="datepicker"   min="<?php echo date('Y-m-d'); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>

							<div class="row margin-top" >
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo lang("Location_Zone"); ?></label>
										<div class="col-md-9">
											<div style="margin-top: 0px;">
												<input type="radio" name="available_location" value="National" required><?php echo lang("National"); ?>
												<input style="margin-left: 55px" type="radio" name="available_location" value="International" required> <?php echo lang("International"); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row margin-top">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo lang("date_of_Expiry"); ?></label>
										<div class="col-md-9">
											<input type="date" data-date-format='yyyy-mm-dd'  name="date_expire" value="<?php echo $this->input->post("date_expire") ?>" id="datepicker3"   min="<?php echo date('Y-m-d'); ?>"/ class="form-control">
										</div>
									</div>
								</div>

							</div>

							<div class="row" style="padding-top: 20px">
								<div class="col-md-9">
									<div class="form-group">
										<label class="control-label col-md-3"><?php echo lang("number_of_available_in_stock"); ?></label>
										<div class="col-md-9">
											<input type="number" required name="num_stock" class="form-control" placeholder="1" value="<?php echo $this->input->post("num_stock") ?>">
										</div>
									</div>
								</div>
							</div>

							<div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>

                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>
							<input required  style="margin: 15px" type="checkbox" name="vehicle1" value="Bike"> <?php echo lang("By_clicking_Submit_you_agree_to_our_Terms_of_use_and_Posting_Rules"); ?><br>

                            <div style="padding-left: 600px;margin-top: 30px">
                                <input type="submit" name="submit" class="btn btn-primary" value="<?php echo lang("submit"); ?>">
                            </div>
                        </div>
                    </form>

                </div>
                <?php $this->load->view('provider/common/common_footer')?>
            </div>
        </div>



        <?php $this->load->view('provider/common/common_script')?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/file-upload/dist/image-uploader.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/file-upload/dist/karim-image-uploader.js"></script>


        <script type="text/javascript">
            $(document).ready(function() {
                $(".js-example-tokenizer").select2({
                    tags: true,
                    placeholder: "Please select option",
                    tokenSeparators: [',', ' ']
                });
                 $(".js-example-tokenizer2").select2({
                    placeholder: "Please select option",
                    tokenSeparators: [',', ' ']
                });
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
        </script>
        <!-- <script type="text/javascript">

            $(document).ready(function() {

            });
            //  $(".form_datetime").datepicker({format: 'yyyy-mm-dd'});

        </script>  -->
<!--        <script type="text/javascript">-->
<!--            $("#datepicker").datepicker().datepicker("setDate", new Date());-->
<!--        </script>-->



        <script type="text/javascript">
            $(document).ready(function(){
                $('.input-images').imageUploader({
                    // preloaded: preloaded,
                    imagesInputName: 'image',
                    preloadedInputName: 'old'
                });

                // $('#datepicker2').datepicker({
                //     format : 'yyyy-mm-dd',
                //     minDate: 0,
                // });
                // $('#datepicker3').datepicker({
                //     format : 'yyyy-mm-dd',
                // });

                $('#cat').change(function () {
                    var id = $(this).val();
                    $.ajax({
                        type: 'post',
                        url:'<?php echo base_url("provider/parts/sub_cat") ?>',
                        data: {'id':id},
                        success: function (mydata) {
                                console.log(mydata);
                                $('#scat').html(mydata);
                        }
                    });
                });


            });
        </script>



    </body>

</html>

