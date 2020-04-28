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
                            <h4 class="page-title">ADD Part</h4>
                        </div>

                    </div>
                    <?php $this->load->view('message');?>

                    <form  name="frm" method="post" action="<?php echo base_url('part/add_part') ?>" enctype="multipart/form-data">
                        <div class="form-body"style="background: white;padding-bottom:30px">
                            <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>

                            <div class="row" style="padding-top: 20px">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Title</label>
                                        <div class="col-md-9">
                                            <input type="text" name="title" class="form-control" placeholder="Title"value="<?php echo $this->input->post("title") ?>" maxlength="90"> </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Title Arabic</label>
                                        <div class="col-md-9">
                                            <input type="text" name="title_arabic" class="form-control" placeholder="Title Arabic"value="<?php echo $this->input->post("title") ?>" maxlength="90"> </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row margin-top">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Parts Category</label>
                                        <div class="col-md-9">
                                            <select required name="part_category" id="cat" class="form-control" >
                                                <option value="">Parts Category</option>
                                                <?php foreach ($parts_category as $sr) {?>
                                                <option value="<?php echo $sr->id; ?>" ><?php echo $sr->name ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label col-md-3">Parts Sub Category</label>
                                            <div class="col-md-9">
                                                <select name="part_sub_category" class="form-control" id="scat" required>
                                                    <option>Select Part Category First</option>
                                                </select> <span class="help-block"> </span>
                                            </div>

                                        </div>

                                </div>
                            </div>

                            <div class="row margin-top">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Provider Name</label>
                                        <div class="col-md-9">
                                            <select name="provider_id" id="provider_id" class="form-control" >
                                                <option value="">Provider Name</option>
                                                <?php foreach ($providers as $provider) {?>
                                                <option value="<?php echo $provider['id']; ?>" ><?php echo $provider['user_name'] ?></option>
                                                <?php }?>
                                            </select>


                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="control-label col-md-3">Status</label>
                                            <div class="col-md-9">
                                                <select id="status"  name="status" class="form-control">
                                                    <option>Status</option>
                                                    <option value="pending">pending</option>
                                                    <option value="approve">approve</option>
                                                    <option value="reject">reject</option>
                                                </select>
                                                <span class="help-block"> </span>
                                            </div>

                                        </div>

                                </div>
                            </div>

                            <label style =" padding  : 15px ; font-size: 17px;" for="inputEmail3" class="control-label"> Part Photo's</label><br>
							<label style =" color: red ; padding-left  : 80px ; font-size: 14px;" for="inputEmail3" class="control-label">  Main Photo </label>
                            <div align="center">

                                      <input style =" padding  : 12px ; width : 180px ; display : initial ; margin : 15px"   type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple" required />
                                      <input style =" padding  : 12px ; width : 180px ; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple" />
                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                      <input style =" padding  : 12px ; width : 180px; display : initial; margin : 15px"  type="file" class= " btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                                </div>
                            <div class ="row margin-top" >



                        </div>



                            <div class="row margin-top" >

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Part Number</label>
                                        <div class="col-md-9">
                                            <input type="text" name="part_number" class="form-control" placeholder="Part Number" value="<?php echo $this->input->post("part_number") ?>" maxlength="20"> </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Description</label>
                                        <div class="col-md-9">
                                            <textarea name="description" class="form-control" rows="4" placeholder="Description"><?php echo $this->input->post("description") ?> </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>
                            <div class="row margin-top" >
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Part Status</label>
                                        <div class="col-md-9">
											<div style="margin-top: 0px;">
												<input type="radio" name="part_case" value="New" required> New
												<input style="margin-left: 55px" type="radio" name="part_case" value="Used" required> Used
                                        </div>
                                    </div>
                                </div>
                            </div>
							</div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>
                            <label style =" padding  : 15px ;    font-size: 17px;"> Part Fitting </label>

                            <div style="padding :15px"  class="row margin-top" >

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <label class="control-label ">Select Class </label>
                                            <select type="text" name="model_id[]" class="form-control js-example-tokenizer" multiple >
                                                <option value="">Select Option</option>
                                                <?php foreach ($model_name as $model) {?>
                                                    <?php echo '<option value="' . $model->id . '">' . $model->name . '</option>'; ?>

                                                <?php }?>
                                            </select>
                                            <script type="text/javascript">
                                                document.frm.chassis.value='<?php echo $rec->model_id ?>';
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <label for="chassis" class="control-label">Select Chassis</label>

                                            <select  required type="text" name="chassis" class="form-control">
                                                <option value="">Select Chassis</option>
                                                <option value="24" >All</option>
                                                <?php foreach ($chassis as $c) {?>
                                                    <?php echo '<option value="' . $c->id . '">' . $c->chassis_num . '</option>'; ?>
                                                <?php }?>
                                            </select>
                                            <script type="text/javascript">
                                                document.frm.chassis.value='<?php echo $rec->chassis ?>';
                                            </script>
                                        </div>
                                        </div>
                                </div>

                            </div>

                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>

                            <label style =" padding : 15px ;    font-size: 17px;"> Part Price </label>

                            <div class="row margin-top">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Price</label>
                                        <div class="col-md-9">
                                            <input type="text" name="price" class="form-control" placeholder="Price" value="<?php echo $this->input->post("price") ?>" required maxlength="6">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Discount %</label>
                                        <div class="col-md-9">
                                            <input type="number" max="99" min="0"  name="discount" class="form-control" placeholder="Discount%" value="<?php echo $this->input->post("discount") ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>
                            <div class="row margin-top">

                                <div class="col-md-6" >
                                <label style =" padding : 15px ;font-size: 17px;"> Part Brand </label>
                                    <div class="form-group">
                                            <label class="control-label col-md-3"> Select Brand</label>
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
                                        <label class="control-label col-md-3">Set Date of Listing</label>
                                        <div class="col-md-9">
<!--											<input type="text" id="datepicker" data-date-format='yyyy-mm-dd' name="add_date" class="form-control form_datetime" placeholder="Set Date Of Add" autocomplete="off"value="--><?php //echo $this->input->post("add_date")?><!--">-->
											<input required type="date" data-date-format='yyyy-mm-dd'  name="add_date" value="<?php echo $this->input->post("add_date") ?>" id="datepicker"   min="<?php echo date('Y-m-d'); ?>"/>

                                            <!-- <input name="add_dates" value="" id="datepickers"  /> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>
                            <label style =" padding : 15px ;    font-size: 17px;"> Location</label>

                            <div class="row margin-top">

								<div class="col-md-6" >
									<div class="form-group">
										<div class="col-md-9">
											<label class="control-label">Location Latitude</label>

											<input type="text" style="text-align: center"  name="location_lat" class="form-control" placeholder="Location Latitude" value="<?php echo $this->input->post("location_lat") ?>">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<div class="col-md-9">
											<label class="control-label ">Location Longitude</label>
											<input type="text" style="text-align: center"  name="location_lon" class="form-control" placeholder="Location Longitude" value="<?php echo $this->input->post("location_lon") ?>" > </div>
									</div>
								</div>
<!--                                <div class="col-md-6">-->
<!--                                    <div class="form-group">-->
<!--                                        <label class="control-label col-md-3">Location</label>-->
<!--                                        <div class="col-md-9">-->
<!--                                            <input type="text"  name="location" class="form-control" placeholder="Location"value="--><?php //echo $this->input->post("location")?><!--"> -->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                            </div>
							<div class="row margin-top">

								<div class="col-md-6" >
									<div class="form-group">
										<div class="col-md-9">
											<label class="control-label ">Location Zone</label>

											<select name="location_zone" class="form-control">
												<option value>Select Location Zone</option>
												<?php foreach ($location as $loc) {?>
													<option value="<?php echo $loc->id ?>"><?php echo $loc->name; ?></option>
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
                                        <label class="control-label col-md-3">Username</label>
                                        <div class="col-md-9">
											<?php foreach ($user as $us) {?>
                                            <input type="text" name="username" value="<?php echo $us->username ?>" class="form-control" placeholder="Username" readonly >
											<?php }?>
										</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Email</label>
                                        <div class="col-md-9">
											<?php foreach ($user as $us) {?>
                                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $us->email ?>" readonly> </div>
											<?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-top">
                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <label class="control-label col-md-3"> Phone</label>
                                        <div class="col-md-9">
											<?php foreach ($user as $us) {?>
                                            <input type="text" name="phone" class="form-control" placeholder="Phone No" value="<?php echo $us->phone ?>">
											<?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
                            </div>
							<input required  style="margin: 15px" type="checkbox" name="vehicle1" value="Bike">By clicking "Submit" you agree to our Terms of use and Posting Rules <br>

                            <div style="padding-left: 600px;margin-top: 30px">
                                <input type="submit" name="submit" class="btn btn-primary" value="submit">
                            </div>
                        </div>
                    </form>

                </div>
                <?php $this->load->view('common/common_footer')?>
            </div>
        </div>



        <?php $this->load->view('common/common_script')?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

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

                // $('#datepickers').datepicker({
                //     format : 'yyyy-mm-dd',
                //     minDate: 0,
                // });

                $('#cat').change(function () {
                    var id = $(this).val();
                    $.ajax({
                        type: 'post',
                        url:'<?php echo base_url("part/sub_cat") ?>',
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

