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
                            <h4 class="page-title">ADD Car Guide</h4>
                        </div>

                    </div>
                    <?php $this->load->view('message');?>
                    <form  name="frm" method="post" action="<?php echo base_url('car_guide/add_car_guide') ?>" enctype="multipart/form-data" >
                        <div class="form-body"style="background: white;padding-bottom:30px">

                            <div class="form-body"style="background: white;padding-bottom:30px">
                                <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>
                                <div class="row" style="padding-top: 20px">
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Select Class </label>
                                                <select id="classes_select" type="text" name="model_id[]" class="form-control js-example-tokenizer3" multiple >
                                                    <option value="">Select Option</option>
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
                                                <label class="control-label">Select Chassis</label>

                                                <select  required type="text" name="chassis[]" id="chassis_select" class="form-control js-example-tokenizer" multiple>
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

                                <div class="row margin-top">
                                    <div class="">

                                        <h4 style="padding: 50px"><b>1 . Listing Photo ! Chassis</b></h4>
                                        <div align="center" class="" style=""></div>
                                        <div align="center" style="padding: 30px">
											<input required type="radio" name="full_chassis_info" value="image">

											<label  for="inputEmail3" class="control-label"> Upload Image</label>
                                            <input style="width: 400px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                        </div>


                                        <div align="center" >
                                            <div align="center" style="width: 500px; margin: 25px; height: 1px; background-color: grey">
                                                <i style="  "><b>"OR"</b> </i>
                                            </div>
                                        </div>


                                        <div align="center">
											<input type="radio" name="full_chassis_info" value="link">
											<label class="control-label ">Enter Link </label>
                                            <input type="text" style="width: 400px" name="link2" class=" form-control"  placeholder=" Link-1" value="<?php echo $this->input->post("link2") ?>" /> </div>

                                    </div>
                                    <div class="">
                                        <div align="center">
                                            <div align="center" style="width: 85%; margin: 25px; height: 2px; background-color: grey">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                    </div>


                                </div>

                                <div class="row margin-top">
                                    <div class="">
                                        <h4 style="padding: 50px"><b>2 . Full Chassis Info ! Chassis</b></h4>

                                        <div align="center" class="" style="">
                                         <div align="center" style="padding: 30px">
                                             <input required type="radio" name="listing_photo" value="file_pdf">

                                             <label  for="inputEmail3" class="control-label"> Upload file PDF</label>

                                            <input style="width: 400px" type="file" class= "form-control btn btn-default" name="file_pdf" size="20"  />
                                        </div>


                                        <div align="center" >
                                            <div align="center" style="width: 500px; margin: 25px; height: 1px; background-color: grey">
                                                <i style="  "><b>"OR"</b> </i>
                                            </div>
                                        </div>


                                        <div align="center">
                                            <input  type="radio" name="listing_photo" value="link">
                                            <label class="control-label ">Enter Link </label>
                                            <input type="text" style="width: 400px" name="link1" class=" form-control"  placeholder=" Link-2" value="<?php echo $this->input->post("link1") ?>"/> </div>

                                    </div>
                                    <div class="">
                                        <div align="center">
                                            <div align="center" style="width: 85%; margin: 25px; height: 2px; background-color: grey">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                    </div>


                                </div>
                                <div class="row margin-top">
                                    <div class="">
                                        <h4 style="padding: 50px"><b>3 . Fues & Rely Location ! Chassis</b></h4>
                                        <div align="center" class="" style="">
                                        </div>
                                        <div align="center" style="padding: 30px">
											<input required type="radio" name="fues_rely_location" value="image">
											<label  for="inputEmail3" class="control-label"> Upload Image</label>
                                            <input style="width: 400px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                        </div>


                                        <div align="center" >
                                            <div align="center" style="width: 500px; margin: 25px; height: 1px; background-color: grey">
                                                <i style="  "><b>"OR"</b> </i>
                                            </div>
                                        </div>


                                        <div align="center">
											<input type="radio" name="fues_rely_location" value="link">

											<label class="control-label ">Enter Link </label>
                                            <input type="text" style="width: 400px" name="link3" class=" form-control"  placeholder=" Link-3" value="<?php echo $this->input->post("link3") ?>" /> </div>

                                    </div>
                                    <div class="">
                                        <div align="center">
                                            <div align="center" style="width: 85%; margin: 25px; height: 2px; background-color: grey">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                    </div>


                                </div>
                                <div class="row margin-top">
                                    <div class="">
                                        <h4 style="padding: 50px"><b>4 . Tire Pressure & Configuration ! Chassis</b></h4>
                                        <div align="center" class="" style=""></div>
                                        <div align="center" style="padding: 30px">
											<input required type="radio" name="tire_pressure" value="image">
											<label  for="inputEmail3" class="control-label"> Upload Image</label>
                                            <input style="width: 400px" type="file" class= "form-control btn btn-default" name="image[]"  id="logo_image" size="20" multiple="multiple"  />
                                        </div>


                                        <div align="center" >
                                            <div align="center" style="width: 500px; margin: 25px; height: 1px; background-color: grey">
                                                <i style="  "><b>"OR"</b> </i>
                                            </div>
                                        </div>


                                        <div align="center">
											<input type="radio" name="tire_pressure" value="link">

											<label class="control-label ">Enter Link </label>
                                            <input type="text" style="width: 400px" name="link4" class=" form-control"  placeholder=" Link-4" value="<?php echo $this->input->post("link4") ?>"/> </div>

                                    </div>



                                </div>



                                <div class="row margin-top">

                                    <div align="center" class="margin-top" style="">
                                        <input style="width: 200px; height: 50px;font-size: 20px     ; background-color: forestgreen " type="submit" name="submit" class="btn btn-primary" value="submit">
                                    </div>
                                </div>
                    </form>


                        </div>
                    </form>

                </div>
               <?php $this->load->view('common/common_footer')?>
            </div>
        </div>
         <?php $this->load->view('common/common_script')?>
         <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
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
                    if(!$(this).val()){
                        availableChassis= chassis.slice()
                    }else{
                        availableChassis= chassis.filter(function (ch) {
                            return valueArr.indexOf(ch.model_id) != -1
                        })
                    }
                    var prevValue= $('#chassis_select').val();
                    $('#chassis_select').empty();
                    // $('#chassis_select').append('<option value="">Select Option</option>');
                    availableChassis.forEach( function(ch){
                        console.log(ch.id)
                        $('#chassis_select').append('<option value="'+ch.id+'">'+ch.chassis_num+'</option>');
                    })
                    $('#chassis_select').val(prevValue || '')
                });

            });
        </script>
    </body>

</html>

