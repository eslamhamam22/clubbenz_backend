<?php $this->load->view('common/common_header');?>
<style>
    input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #d1d3d1;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid ;
    }

    input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #000000;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid ;
    }
</style>
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
                            <h4 class="page-title">ADD Part Shop</h4>
                        </div>

                    </div>
                    <?php $this->load->view('message');?>
                    <form  name="frm" method="post" action="<?php echo base_url('partshop/add_part_shop')?>" enctype="multipart/form-data" >
                        <div class="form-body"style="background: white;padding-bottom:30px">
                            <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>
                            <div align="center">
                            <div align="center" style="padding: 20px;width: 80% ; height: 170px  ; border:1px solid black" >

                                <!--                        <img style="width:200px;" src="--><?php //echo base_url('upload/').$rec->service_bg_image;?><!--" >-->

                                <label for="background_image" style="margin-top: 45px; margin-left: 0px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                                    <i class="fa fa-cloud-upload"></i> Upload Background
                                </label>
                                <input style="display: none" type="file" id="background_image" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"/>
                                <br><span style="color: red; font-size: 12px;">Image size should be 1000X660</span>

                            </div>
                            </div>
                            <div align="center">

                                <!--                            <img style="margin-top: 50px;border-radius: 50% ; height: 150px;width:150px;" src="--><?php //echo base_url('upload/').$rec->service_logo_image ;?><!--" >-->


                                <label for="logo_image" style=" margin-top: 60px;margin-left: 0px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                                    <i class="fa fa-cloud-upload"></i> Upload Round Logo
                                </label>
                                <!--                                        <img  for="logo_image" style="width: 120px; height: 120px; margin-top: 50px" src="--><?php //echo base_url('upload/round_image_upload.png');?><!--">-->
                                <input style="display: none" type="file" class= "form-control btn btn-default" name="image[]" multiple="multiple" id="logo_image" size="20"  />
                                <br><span style="color: red; font-size: 12px;">Image size should be 700X500</span>
                            </div>

                            <div style="margin-left: 60px ;margin-top: 80px">


                                <div class="row margin-top">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Company En Name</label>
                                                <input type="text" style="text-align: center" name="ws_name" class="form-control" placeholder="Company En Name" value="<?php echo $this->input->post("ws_name")?>"> </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Company AR Name</label>

                                                <input type="text" style="text-align: center"  name="arabic_name" class="form-control" placeholder="Company AR Name" value="<?php echo $this->input->post("arabic_name")?>"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin-top">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label">City</label>

                                                <input type="text" style="text-align: center"  name="city" class="form-control" placeholder="City" value="<?php echo $this->input->post("city")?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label">Country</label>

                                                <input type="text" style="text-align: center"  name="country" class="form-control"  placeholder="Country"value="<?php echo $this->input->post("country")?>"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin-top">

                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label">Location Latitude</label>

                                                <input type="text" style="text-align: center"  name="location_lat" class="form-control" placeholder="Location Latitude" value="<?php echo $this->input->post("location_lat")?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Location Longitude</label>
                                                <input type="text" style="text-align: center"  name="location_lon" class="form-control" placeholder="Location Longitude" value="<?php echo $this->input->post("location_lon")?>" > </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin-top">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Address</label>


                                                <input  style="text-align: center; height: 125px"  type="text" name="address" class="form-control" placeholder="Address" value="<?php echo $this->input->post("address")?>"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="height:155px">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label" style="width:100%">Day Off</label>
                                                <select name="day_off[]" class="form-control js-example-tokenizer" multiple="multiple">
                                                      <option value="Monday">Monday </option>
                                                      <option value="Tuesday">Tuesday </option>
                                                      <option value="Wednesday">Wednesday </option>
                                                      <option value="Thursday">Thursday </option>
                                                      <option value="Friday">Friday </option>
                                                      <option value="Saturday">Saturday </option>
                                                      <option value="Sunday">Sunday </option>
                                                </select> </div>

                                                <div class="col-md-9" style="margin-top : 20px">
                                                <label class="control-label">Phone</label>

                                                <input type="text" style="text-align: center"  name="phone" class="form-control" placeholder="Phone No" value="<?php echo $this->input->post("phone")?>"> 
                                        </div>
                                   
                                        </div>
                                    </div>


                                </div>
                                <div class="row margin-top">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Opening Hours</label>

                                                <input type="text" style="text-align: center"  name="opening_hour" id="opening_hour" class="form-control" placeholder="Opening Hour" readonly value="<?php echo $this->input->post("opening_hour")?>"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Closed Hours</label>
                                                <input type="text" style="text-align: center"  name="closing_hour" id="closing_hour" class="form-control" placeholder="Closeing hour" readonly value="<?php echo $this->input->post("closing_hour")?>"> </div>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="row margin-top">
                                </div>

                                <div align="center">
                                    <div align="center" style="; margin: 25px; height: 2px; background-color: grey">
                                    </div>
                                </div>

                            </div>
                            <div style="margin-left: 60px">

                                <div id="parts_services" class="row margin-top">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Search keywords En</label>

                                                <input type="text" name="serch_tag[]" class="form-control tokenfield" placeholder="Search keywords" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label">Search keywords Ar</label>
                                                <input type="text" name="serch_tag_arabic[]" class="form-control tokenfield" placeholder="Search keywords" value=""> </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row margin-top">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label " style="width:100%">Service Tags</label>

                                                <select name="service_tag[]"  class="form-control js-example-tokenizer" multiple="multiple" >
                                                    <?php foreach($service_tag as $sr){?>
                                                        <option value="<?php echo $sr->id;?>" ><?php echo $sr->name?></option>
                                                    <?php } ?>
                                                </select> <span class="help-block"> </span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="width: 500px">
                                        <div class="col-sm-9" >
                                            <label  for="inputEmail3" class=" control-label">Photo Selection  Arround rating </label>

                                            <label for="image" style="  margin-top: 20px; margin-left: 30px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                                                <i class="fa fa-cloud-upload"></i> Upload Background
                                            </label>
                                            <input style="display:none;"  type="file" class= "form-control btn btn-default" name="image[]" id="image" multiple="multiple" size="20"/>
                                        </div>
                                        <!--                                <img style="width:200px;" src="--><?php //echo base_url('upload/').$rec->rating_image;?><!--" >-->

                                    </div>




                                </div>
                                <div class="row margin-top">
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Select Brand</label>
                                                <select name="part_brand[]" class="form-control js-example-tokenizer " multiple="multiple" >
                                                    <?php foreach($brand as $ar){?>
                                                        <option value="<?php echo $ar->id?>"><?php echo$ar->name ;?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="col-md-9">
                                            <label class="control-label " >Parts Status</label>

                                            <div style="margin-top: 20px;">
                                                <input type="radio" name="part_type[]" value="New"> New
                                                <input style="margin-left: 55px" type="radio" name="part_type[]" value="Used"  > Used
                                                <input style="margin-left: 55px" type="radio" name="part_type[]" value="New & Used" > New & Used
                                            </div>

                                        </div>
                                    </div>


                                </div>

                            </div>
                            <div align="center">
                                <div align="center" style="; margin: 25px; height: 2px; background-color: grey">
                                </div>
                            </div>
                            <div style="margin-left: 60px">
                                <div class="row margin-top">
                                    <h5 style="margin-left: 30px"><b>Social Media</b></h5>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Facebook Page</label>

                                                <input style="text-align: center"  type="text" name="fb_link" class="form-control" placeholder="Facebook Link" value="<?php echo $this->input->post("fb_link")?>"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Web Site</label>

                                                <input style="text-align: center"  type="text" name="web" class="form-control" placeholder="Web Site" value="<?php echo $this->input->post("web")?>"> </div>
                                        </div>
                                    </div>



                                </div>

                                <div class="row margin-top">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Email</label>
                                                <input style="text-align: center"  type="email"  name="email" class="form-control" placeholder="Email" value="<?php echo $this->input->post("email")?>"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="control-label ">Twitter</label>
                                                <input style="text-align: center"  type="text" name="twitter" class="form-control" placeholder="Twitter" value="<?php echo $this->input->post("twitter")?>"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div align="center" style="margin-top: 30px">
                                <input style="width: 200px; height: 50px;font-size: 20px     ; background-color: forestgreen "  type="submit" name="submit" class="btn btn-primary" value="Submit">
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

            <!-- serch token -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>





       <!--  <script type="text/javascript">
                var index=0
                function add_parts(){
                    index = index +1;
                    $.post("<?php echo base_url()?>carmodel/add_parts_services",{index: index}, function( data ) {
                        $("#parts_services").append(data);
                    });
                }
        </script> -->
         <script type="text/javascript">
            $(document).ready(function() {
                $(".js-example-tokenizer").select2({
                    tags: true,
                    placeholder: "Please select option",
                    tokenSeparators: [',', ' ']
                });
                
                $('#opening_hour').clockpicker({
                    placement: 'bottom',
                    align: 'left',
                    autoclose: true,
                    //twelvehour: true,
                    'default': 'now'
                });
                $('#closing_hour').clockpicker({
                    placement: 'bottom',
                    align: 'right',
                    autoclose: true,
                    //twelvehour: true,
                    'default': 'now'
                });

            });
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

        