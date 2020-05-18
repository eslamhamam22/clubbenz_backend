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
                                        <label class="control-label col-md-3">Images</label>
                                        <div class="col-md-9">
                                            <div style="cursor: pointer" class="input-images"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="row" style="padding-top: 20px">-->
<!--                                <div class="col-md-10 col-md-offset-1">-->
<!--                                    <div style="cursor: pointer" class="input-images"></div>-->
<!--                                    <fieldset class="form-group">-->
<!--                                        <a href="javascript:void(0)" onclick="$('#pro-image').click()">Upload Image</a>-->
<!--                                        <input type="file" id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple>-->
<!--                                    </fieldset>-->
<!--                                    <div class="preview-images-zone">-->
<!--                                        <div class="preview-image preview-show-1">-->
<!--                                            <div class="image-cancel" data-no="1">x</div>-->
<!--                                            <div class="image-zone"><img id="pro-img-1" src="https://img.purch.com/w/660/aHR0cDovL3d3dy5saXZlc2NpZW5jZS5jb20vaW1hZ2VzL2kvMDAwLzA5Ny85NTkvb3JpZ2luYWwvc2h1dHRlcnN0b2NrXzYzOTcxNjY1LmpwZw=="></div>-->
<!--                                            <div class="tools-edit-image"><a href="javascript:void(0)" data-no="1" class="btn btn-light btn-edit-image">edit</a></div>-->
<!--                                        </div>-->
<!--                                        <div class="preview-image preview-show-2">-->
<!--                                            <div class="image-cancel" data-no="2">x</div>-->
<!--                                            <div class="image-zone"><img id="pro-img-2" src="https://www.codeproject.com/KB/GDI-plus/ImageProcessing2/flip.jpg"></div>-->
<!--                                            <div class="tools-edit-image"><a href="javascript:void(0)" data-no="2" class="btn btn-light btn-edit-image">edit</a></div>-->
<!--                                        </div>-->
<!--                                        <div class="preview-image preview-show-3">-->
<!--                                            <div class="image-cancel" data-no="3">x</div>-->
<!--                                            <div class="image-zone"><img id="pro-img-3" src="http://i.stack.imgur.com/WCveg.jpg"></div>-->
<!--                                            <div class="tools-edit-image"><a href="javascript:void(0)" data-no="3" class="btn btn-light btn-edit-image">edit</a></div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="row" style="padding-top: 20px">-->
<!--                                <div class="col-md-12">-->
<!--                                    <div class="form-group">-->
<!--                                        <label class="control-label col-md-3">Product arrangement in order (1 shown first, then 2, 3, ....)</label>-->
<!--                                        <div class="col-md-9">-->
<!--                                            <input type="number" required name="sort_order" class="form-control" placeholder="1"value="--><?php //echo $this->input->post("sort_order") ?><!--">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

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
                                                    <option value="pending">pending</option>
                                                    <option value="approve">approve</option>
                                                    <option value="reject">reject</option>
                                                </select>
                                                <span class="help-block"> </span>
                                            </div>

                                        </div>

                                </div>
                            </div>
                            <div align="center">

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
                                            <label for="chassis" class="control-label">Select Chassis</label>

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
                                            <input required type="date" data-date-format='yyyy-mm-dd'  name="add_date" value="<?php echo $this->input->post("add_date") ?>" id="datepicker" class="form-control"  min="<?php echo date('Y-m-d'); ?>"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div align="center" class=" margin-top" style= "width : 100% ; height :1px ; background : darkgray ">
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
                                                <input type="radio" name="available_location" value="National" required>National
                                                <input style="margin-left: 55px" type="radio" name="available_location" value="International" required> International
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
                                            <input required type="date" data-date-format='yyyy-mm-dd'  name="date_active" value="<?php echo $this->input->post("date_active") ?>" id="datepicker2" class="form-control"  min="<?php echo date('Y-m-d'); ?>"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row margin-top">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">date of Expiry</label>
                                        <div class="col-md-9">
                                            <input required type="date" data-date-format='yyyy-mm-dd'  name="date_expire" value="<?php echo $this->input->post("date_expire") ?>" id="datepicker3" class="form-control"  min="<?php echo date('Y-m-d'); ?>"/>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="padding-top: 20px">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">number of available in stock</label>
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

