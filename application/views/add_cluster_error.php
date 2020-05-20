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
                    <form  name="frm" method="post" action="<?php echo base_url('car_guide/add_cluster_error') ?>" enctype="multipart/form-data" >
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

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <label class="control-label ">Select Chassis</label>
                                            <select  required type="text" name="chassis[]" id="chassis_select" class="form-control js-example-tokenizer" multiple>
                                                <option value="<?php foreach ($chassis as $c) {echo $c->id . ',';}?>">All</option>
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


                            <div  class="row" style="margin-top: 40px; margin-left: 20px;padding-top: 20px">
                                <div align="center" class="col-md-6" style=";width: 250px" >
                                    <label  for="inputEmail3" class="control-label"> Image-1</label>
                                    <div align="center" class="margin-top" >
                                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                        <span style="color: red; font-size: 12px;">Image Size should be 960X720</span>
                                    </div>
                                </div>
                                <div align="center" class="col-md-6" style=";width: 250px" >
                                    <label  for="inputEmail3" class="control-label"> Image-2</label>
                                    <div align="center" class="margin-top" >
                                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" id="logo_image" multiple="multiple"  />
                                        <span style="color: red; font-size: 12px;">Image Size should be 960X720</span>
                                    </div>
                                </div>
                                <div align="center" class="col-md-6" style=";width: 250px" >
                                    <label  for="inputEmail3" class="control-label"> Image-3</label>
                                    <div align="center" class="margin-top" >
                                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                        <span style="color: red; font-size: 12px;">Image Size should be 960X720</span>
                                    </div>
                                </div>
                                <div align="center" class="col-md-6" style="width: 250px" >
                                    <label  for="inputEmail3" class="control-label"> Image-4</label>
                                    <div align="center" class="margin-top" >
                                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" id="logo_image" multiple="multiple"  />
                                        <span style="color: red; font-size: 12px;">Image Size should be 960X720</span>
                                    </div>
                                </div>


                            </div>
                            <div style="margin-top: 50px;margin-left: 10px" class="row margin-top">

                                <div class="col-md-6" style="width: 350px; ">
                                    <div class="form-group" style="padding: 15px">

                                        <label class="control-label ">Error Text</label>

                                        <input type="text" name="title" class="form-control" style="width: 270px" value="<?php echo $this->input->post("title") ?>"/>
                                    </div>
                                </div>
                                <div class="col-md-6"  style="width: 350px">
                                    <div class="form-group" style="padding: 15px">

                                        <label class="control-label">Enter Error Description En</label>

                                        <textarea style="width: 300px" class="form-control" rows="4" name="description" <?php if (!empty($this->input->post('description'))) {echo $this->input->post('description');}?>></textarea>

                                    </div>
                                </div>
                                <div class="col-md-6" style="width: 350px">
                                    <div class="form-group" style="padding: 15px; width: 350px">

                                        <label class="control-label">Enter Error Description Ar</label>
                                        <textarea style="width: 300px"  class="form-control" rows="4" name="description_arabic" <?php if (!empty($this->input->post('description_arabic'))) {echo $this->input->post('description_arabic');}?>></textarea>

                                    </div>
                                </div>
                            </div>
                            <!---->
                            <!--                             <div class="row margin-top">-->
                            <!--                                <div class="col-md-6">-->
                            <!--                                    <div class="form-group">-->
                            <!--                                        <label class="control-label col-md-3">Title Arabic</label>-->
                            <!--                                        <div class="col-md-9">-->
                            <!--                                            <input type="text" name="title_arabic" class="form-control" value="--><?php //echo $rec->title_arabic?><!--"/> </div>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!---->
                            <!--                                -->
                            <!--                            </div>-->

                            <div style="margin-left: 40px" class="row margin-top">

                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <label class="control-label">Select Shop List</label>

                                            <select class="form-control" id="shop_type" name="shop_type" onchange="get_shop(this.value)">
                                                <option value="">select Option</option>
                                                <option value="workshop">workshop</option>
                                                <option value="serviceshop">serviceshop</option>
                                                <option value="partshop">partshop</option>
                                            </select>
                                            <script type="text/javascript">
                                                document.frm.shop_type.value='<?php echo $rec->shop_type ?>';
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group">
                                        <div class="col-md-9">
                                            <label class="control-label ">Select Shop</label>

                                            <select class="form-control" id="shop" name="shop">
                                                <option value="">select Option</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div align="center" >
                                <div align="center" style="margin-top: 80px;width: 80%; ; height: 1px; background-color: grey">

                                </div>
                            </div>



                                <div class="row margin-top" id="multiple" style="margin-left: 30px;margin-bottom: 20px;width: 1091px ">
                                    <p>
                                    <h4><b>Solutions 1</b></h4>
                                    <div class="col-md-6" style="margin-top: 40px">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label">Enter Description Text En</label>
                                                <textarea style="height: 60px" class="form-control" rows="4" name="descriptions[]" ><?php if (!empty($this->input->post('description'))) {echo $this->input->post('description');}?></textarea>
                                                <label class="control-label">Enter Description Text Ar</label>
                                                <textarea style="height: 60px" class="form-control" rows="4" name="description_arabics[]"><?php if (!empty($this->input->post('description_arabic'))) {echo $this->input->post('description_arabic');}?></textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top">
                                        <div align="center" class="col-sm-9">
                                            <div>
                                                <label  for="inputEmail3" class="control-label">Upload Solution Image</label>
                                            </div>
                                            <input type="file" class= "form-control btn btn-default" name="pic[]" size="20" multiple="multiple" />
                                            <span style="color: red; font-size: 12px;">Image Size should be 960X720</span>
                                        </div>
                                    </div>
                                    </p>

                                </div>

                                <div class="row margin-top"  style="margin-bottom: 20px;width: 1091px ">
                                    <div align="center" >
                                        <div align="center" style="margin-top: 40px;width: 80%; ; height: 1px; background-color: grey">
                                        </div>
                                    </div>
                                </div>
                                <div id="addsol"></div>




                            <div align="center" style="margin-top:12px; ">
                                <input style="background-color: #0c0c0c;font-size: 40px;height: 80px; width: 80px ; border-radius: 50%"  type="button" onclick="add_data();" name="btn" class="btn-primary"  value="+">
                                <div >
                                    <h6><b>Add other Solution</b> </h6>

                                </div>
                            </div>


                            <div align="center" class="margin-top" >
                                <input style="width: 200px; height: 50px;font-size: 20px; margin-top: 30px ; background-color: forestgreen " type="submit" name="submit" class="btn btn-primary" value="submit">
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

         <script type="text/javascript">
             var index=0
                function add_data(){
                    index = index +1;
                    $.post("<?php echo base_url() ?>car_guide/add_ajax_description",{index: index}, function( data ) {
                        $("#addsol").append(data);
                    });
                }
         </script>
         <script type="text/javascript">
            $(document).ready(function(){
                     $('#shop_type').change(function () {
                        var shop_type = $(this).val();

                         if(shop_type ===""){
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
                            },
                        });
                    });

            })
        </script>
        <script >
           $('.tokenfield').tokenfield({
              autocomplete: {
                source: [],
                delay: 100
              },
              showAutocompleteOnFocus: true
            })
        </script>
    </body>

</html>

