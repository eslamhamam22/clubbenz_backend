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
                            <h4 class="page-title">ADD Workshop</h4>
                        </div>
                    </div>
                    <?php $this->load->view('message');?>
                    <form method="post" action="<?php echo base_url('workshop/add_workshop')?>" enctype="multipart/form-data" >
                        <div class="form-body"style="background: white;padding-bottom:30px">
                            <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>

                        <div class="form-body"style="background: white;padding-bottom:30px">
                            <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>
                            <div align="center">
                            <div align="center" style="padding: 20px;width: 80% ; height: 170px ; margin-left: 0px ; border:1px solid black" >

                                <label for="img1" style="margin-top: 35px; margin-left: 0px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                                    <i class="fa fa-cloud-upload"></i> Upload Background
                                </label>
                                <input style="display: none" type="file" id="img1" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"/><br>
                                <span style="color: red; font-size: 12px;">Image size should be 1000X660</span>

                            </div>
                            </div>
                            <div align="center">



                                <label for="img2" style=" margin-top: 60px;margin-left: 0px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                                    <i class="fa fa-cloud-upload"></i> Upload Round Logo
                                </label>
                                <!--                                        <img  for="logo_image" style="width: 120px; height: 120px; margin-top: 50px" src="--><?php //echo base_url('upload/round_image_upload.png');?><!--">-->
                                <input style="display: none" type="file" class= "form-control btn btn-default" name="image[]" multiple="multiple" id="img2" size="20"  /><br>
                                <span style="color: red; font-size: 12px;">Image size should be 700X500</span>
                            </div>

                            <!--                    <div class="row" style="padding-top: 20px">-->
                            <!--                        <div class="col-md-6">-->
                            <!---->
                            <!--                            <label  for="inputEmail3" class="col-sm-3 control-label">Workshop Background Photo</label>-->
                            <!--                            <div class="col-sm-9">-->
                            <!--                                <input  type="file" id="img1" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />-->
                            <!--                            </div>-->
                            <!--                        </div>-->
                            <!--                        <div class="col-md-6">-->
                            <!---->
                            <!--                            <label  for="inputEmail3" class="col-sm-3 control-label">Workshop Logo</label>-->
                            <!--                            <div class="col-sm-9">-->
                            <!--                                <input type="file" id="img2" class= "form-control btn btn-default" name="image[]" multiple="multiple" id="logo_image" size="20"  />-->
                            <!--                            </div>-->
                            <!--                        </div>-->
                            <!---->
                            <!---->
                            <!--                    </div>-->
                            <!--                    <div class="row margin-top">-->
                            <!--                        <div class="col-md-6" style="padding-left: 200px">-->
                            <!--                            <img style="width:200px;" src="--><?php //echo base_url('upload/').;?><!--" >-->
                            <!--                        </div>-->
                            <!--                        <div class="col-md-6" style="padding-left: 200px">-->
                            <!--                            <img style="width:200px;" src="--><?php //echo base_url('upload/').$rec->;?><!--" >-->
                            <!--                        </div>-->
                            <!---->
                            <!--                    </div>-->

                            <div style="margin-left: 50px">

                                <div class="row margin-top">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Work Shop En Name</label>
                                                <input type="text" name="ws_name"  style="text-align: center" class="form-control" placeholder="Workeshop Name" value="<?php echo $this->input->post("ws_name")?>"> </div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Work Shop AR Name</label>
                                                <input type="text" name="arabic_name"  style="text-align: center" class="form-control" placeholder="Workshop Name" value="<?php echo $this->input->post("arabic_name")?>"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin-top">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">City</label>

                                                <input type="text" name="city" style="text-align: center" class="form-control" placeholder="City" value="<?php echo $this->input->post("city")?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Country</label>
                                                <input type="text" name="country" style="text-align: center" class="form-control" placeholder="Country" value="<?php echo $this->input->post("country")?>"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin-top">

                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Location Latitude</label>
                                                <input type="text" name="location_lat"  style="text-align: center" class="form-control" placeholder="location Latitude" value="<?php echo $this->input->post("location_lat")?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Location Longitude</label>
                                                <input type="text"  style="text-align: center" name="location_lon" class="form-control" placeholder="Location Longitude" value="<?php echo $this->input->post("location_lon")?>"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin-top">

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Address</label>
                                                <input type="text" name="address" style=" text-align: start;height:125px" multiple="multiple"  class="form-control placeholder="Address" value="<?php echo $this->input->post("address")?>"> </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6" style="height:155px" >
                                    <div class="form-group">
                                    <div class="col-md-9">
                                                <label class="" style="width :100%">Day Off</label>
                                               
                                                <select name="day_off[]" class="form-control js-example-tokenizer" multiple="multiple">
                                                      <option value="Monday">Monday </option>
                                                      <option value="Tuesday">Tuesday </option>
                                                      <option value="Wednesday">Wednesday </option>
                                                      <option value="Thursday">Thursday </option>
                                                      <option value="Friday">Friday </option>
                                                      <option value="Saturday">Saturday </option>
                                                      <option value="Sunday">Sunday </option>
                                                </select>


                                                <!-- <input type="text" name="day_off"  style="text-align: center" class="form-control" placeholder="Day Off" value="<?php echo $this->input->post("day_off")?>"> -->
                                             </div>
                                            <div class="col-md-9" style="margin-top : 20px">
                                                <label class="">Phone</label>

                                                <input type="text"  style="text-align: center" name="phone" class="form-control"  placeholder="Phone No"value="<?php echo $this->input->post("phone")?>"> 
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <div class="row margin-top">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Opening Hours</label>
                                                <input type="text" name="opening_hour" id="opening_hour" style="text-align: center" class="form-control"  placeholder="Opening Hour" readonly value="<?php echo $this->input->post("opening_hour")?>"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Closed Hours</label>
                                                <input type="text" name="closing_hour" id="closing_hour" style="text-align: center" class="form-control" placeholder="Closing hour" readonly value="<?php echo $this->input->post("closing_hour")?>"> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="margin-top: 12px">
                                        <div class="form-group">
                                          
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div align="center">
                                <div align="center" style="; margin: 25px; height: 2px; background-color: grey">
                                </div>
                            </div>

                            <div style="margin-left: 50px">

                                <div class="row margin-top">
                                    <div class="col-md-6">
    <div class="col-md-9">
                                       <label class="">Search keywords En</label>

<input type="text" name="serch_tag[]" multiple="multiple" class="form-control tokenfield" placeholder="Search keywords">
                                           


                                        </div>

                                 
                                        

                                    </div>
                                    <div class="col-md-6">

                                      <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Search keywords AR</label>
                                                <input type="text" name="serch_tag_arabic[]" multiple="multiple" class="form-control tokenfield" placeholder="Search keywords AR">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row margin-top">
                                    <div class="col-md-6">
     <div class="col-md-9">
                                            <label class="" style="width:100%">Service Tags </label>

<select name="service[]" class="form-control js-example-tokenizer" multiple="multiple">
    <option value="0">Select Services </option>
    <?php foreach($service as $ar){?>
        <option value="<?php echo $ar->id?>"><?php echo $ar->name?></option>
    <?php } ?>
</select> <span class="help-block"> </span>
                                            </div>
                                        
                                    </div>
                                    <div class="col-md-6">

                                      <div class="col-sm-9">
                                            <label  for="inputEmail3" class="">Photo Selection  Arround rating </label>
                                            <input type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div align="center">
                                <div align="center" style="; margin: 25px; height: 2px; background-color: grey">
                                </div>
                            </div>


                            <div style="margin-left: 50px">

                                <h3 style="margin-left: 20px"><b>Social Media</b></h3>
                                <div class="row margin-top">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Facebook Page</label>
                                                <input type="text" name="fb_link" class="form-control"  placeholder="Facebook Link" value="<?php echo $this->input->post("fb_link")?>"> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Twitter</label>

                                                <input type="text" name="twitter" class="form-control" placeholder="Twitter" value="<?php echo $this->input->post("twitter")?>"> </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    <!--                        <div class="col-md-6">-->
                                    <!--                            <div class="form-group">-->
                                    <!--                                <label class="control-label col-md-3">Web Site</label>-->
                                    <!--                                <div class="col-md-9">-->
                                    <!--                                    <input type="text" name="web" class="form-control" value="--><?php // echo$rec->web?><!--">-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!--                        </div>-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <label class="">Email</label>

                                                <input type="email"  name="email" class="form-control" placeholder="Email" value="<?php echo $this->input->post("email")?>">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>



                            <div align="center" class="margin-top">
                                <input type="submit" style="width: 150px" name="submit" class="btn btn-primary" value="submit">
                            </div>
                        </div>

                    </form>  
                
                </div>
               <?php $this->load->view('common/common_footer')?>
            </div>
        </div>
        
        <!-- Bootstrap Core JavaScript -->
        <?php $this->load->view('common/common_script')?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        
        <!-- serch token -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
        <link href="../plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>


        <script type="text/javascript">
            
            $(document).ready(function() {
                $(".js-example-tokenizer").select2({
                    tags: true,
                    tokenSeparators: [',', ' ']
                });
                /*$('#opening_hour').datetimepicker();
                $('#closing_hour').timepicker();*/
                $('#opening_hour').clockpicker({
                    placement: 'bottom',
                    align: 'left',
                    autoclose: true,
                    //twelvehour: true,
                    'default': 'now'
                });
                $('#closing_hour').clockpicker({
                    placement: 'bottom',
                    align: 'left',
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