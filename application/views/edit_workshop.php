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
                    <h4 class="page-title">Update Workshop</h4>
                </div>

            </div>
            <?php $this->load->view("message");?>

            <form name="frm" method="post" action="<?php echo base_url('workshop/update_workshop') ?>" enctype="multipart/form-data" >

                <div class="form-body"style="background: white;padding-bottom:30px">
                    <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>
                    <div align= "center">
                    <div align="center" style="padding: 20px;width: 80% ; height: 190px ; margin-left: px ; border:1px solid black" >
                        <img style="height: 100px;width: 100px;margin-bottom: 6px; display: block;" src="<?php echo base_url('upload/') . $rec->workshop_bg_img; ?>" >
                        <label for="img1" style="margin-left: 0px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                            <i class="fa fa-cloud-upload"></i> Upload Background
                        </label>
                        <input style="width: 400px; display: none" type="file" id="img1" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"/>
                        <span style="color: red; font-size: 12px; display: block;">Image Size should be 1000X660</span>
                    </div>

                    </div>
                    <div align="center">

                        <img style="margin-top: 20px;border-radius: 50% ; height: 150px;width:150px; display: block;" src="<?php echo base_url('upload/') . $rec->workshop_logo; ?>" >
                        <label for="img2" style=" margin-top: 20px;margin-left: 0px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                                    <i class="fa fa-cloud-upload"></i> Upload Round Logo
                        </label>
                        <input style="width: 300px; display: none " type="file" class= "form-control btn btn-default" name="image[]" multiple="multiple" id="img2" size="20"  />
                        <span style="color: red; font-size: 12px; display: block;">Image Size should be 700X500</span>
                    </div>


                    <div style="margin-left: 50px">

                        <input type="hidden" name="id" value="<?php echo $rec->id ?>" >

                    <div class="row margin-top">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Company En Name</label>
                                    <input type="text" name="ws_name"  style="text-align: center" class="form-control" value="<?php echo $rec->name ?>"> </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Company AR Name</label>
                                    <input type="text" name="arabic_name"  style="text-align: center" class="form-control" value="<?php echo $rec->arabic_name ?>"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-top">

                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">City</label>

                                    <input type="text" name="city" style="text-align: center" class="form-control" value="<?php echo $rec->city ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Country</label>
                                    <input type="text" name="country" style="text-align: center" class="form-control" value="<?php echo $rec->country ?>"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-top">

                        <div class="col-md-6" >
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Location Latitude</label>
                                    <input type="text" name="location_lat"  style="text-align: center" class="form-control" value="<?php echo $rec->location_lat ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Location Longitude</label>
                                    <input type="text"  style="text-align: center" name="location_lon" class="form-control" value="<?php echo $rec->location_lon ?>"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-top">

                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Address</label>
                                    <input type="text" name="address" style=" text-align: start ; height:125px" multiple="multiple"  class="form-control "value="<?php echo $rec->address ?>"> </div>
                            </div>

                        </div>


                        <div class="col-md-6" style="height:155px" >

                            <div class="form-group">

                                <div class="col-md-9">
                                <label class="" style="width :100%">Day Off</label>
                                    <?php $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");?>

                                    <?php $day_off_arr = explode(',', $rec->day_off);?>

                                <select name="day_off[]" class="form-control js-example-tokenizer" multiple="multiple" >
                                    <?php foreach ($days as $day) {?>
                                        <option <?php if (in_array($day, $day_off_arr)) {?> selected="selected" <?php }?> value="<?php echo $day; ?>" ><?php echo $day ?></option>
                                    <?php }
;?>


                                </select><span class="help-block"> </span>
                                                                   </div>
                                <div class="col-md-9" style="margin-top : 10px">
                                    <label class="">Phone</label>

                                    <input type="text"  style="text-align: center" name="phone" class="form-control"  value="<?php echo $rec->phone ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row margin-top">
                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Opening Hours</label>
                                    <input type="text" name="opening_hour" id="opening_hour"  style="text-align: center" class="form-control" readonly value="<?php echo $rec->opening_hour ?>"> </div>
                               </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-9">

                                    <label class="">Closed Hours</label>
                                    <input type="text" name="closing_hour" id="closing_hour" style="text-align: center" class="form-control" readonly value="<?php echo $rec->closing_hour ?>"> </div>

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

                                    <input type="text" name="serch_tag[]" multiple="multiple" class="form-control tokenfield" value="<?php echo $rec->serch_tag ?>">
                                </div>


                        </div>
                        <div class="col-md-6">

                                    <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Search keywords AR</label>
                                    <input type="text" name="serch_tag_arabic[]" multiple="multiple" class="form-control tokenfield" value="<?php echo $rec->serch_tag_arabic ?>">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row margin-top">
                        <div class="col-md-6">
                      <div class="col-md-9">
                                <label class="" style = "width :100%">Service Tags </label>

                                <?php $service_tag_arr = explode(',', $rec->service_tag);?>
                                <select name="service[]" id="groups" class="form-control js-example-tokenizer" multiple="multiple" >

                                    <?php foreach ($service as $sr) {?>
                                        <option<?php if (in_array($sr->id, $service_tag_arr)) {?> selected="selected" <?php }?> value="<?php echo $sr->id; ?>" ><?php echo $sr->name ?></option>
                                    <?php }
;?>
                                </select>

                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="col-sm-9">
                                <label  for="inputEmail3" class="">Photo Selection Arround rating </label>

                                <input type="file" class= "form-control btn btn-default" name="image[]" id="image" multiple="multiple" size="20"  />
                            </div>
                            <div class="col-md-6" style="padding-left: 200px">

                            <div class="deletImageBar">
                                <p onClick="deleteImage('image_id_1' , 'image_input')">X</p>
                                </div>

                                    <img style="width:200px; height: 100px; margin-top:20px;" id='image_id_1' src="<?php echo base_url('upload/') . $rec->photo_selection_arround_rating; ?>" >
                                    <input type="hidden"  name='image_input' id='image_input' value="<?php echo $rec->photo_selection_arround_rating; ?>" />
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
                                    <input type="text" name="fb_link" class="form-control" value="<?php echo $rec->facebook_page_link ?>"> </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Twitter</label>

                                    <input type="text" name="twitter" class="form-control" value="<?php echo $rec->twitter ?>"> </div>
                            </div>
                        </div>
                    </div>

                    <div class="row margin-top">
                       <div class="col-md-6">
                           <div class="form-group">
                               <div class="col-md-9">
                                <label class="">Web Site</label>
                                   <input type="text" name="web" class="form-control" value="<?php echo $rec->web ?>">
                               </div>
                           </div>
                       </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label class="">Email</label>

                                    <input type="email"  name="email" class="form-control"value="<?php echo $rec->email ?>">
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>



                    <div class="row margin-top">


                    </div>

                    <div align="center" class="margin-top">
                        <input type="submit" style="width: 150px" name="submit" class="btn btn-primary" value="Update">
                    </div>
                </div>

            </form>


        </div>
        <?php $this->load->view('common/common_footer')?>
    </div>
</div>

<style type="text/css">
.deletImageBar{
   position: absolute;
   background: #2a2c2d;
   margin-left: 61%;
   width: 20px;
   color: white;
   height: 20px;
   top: 20px;
}
</style>



<!-- Bootstrap Core JavaScript -->
<?php $this->load->view('common/common_script')?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- serch token -->
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

<script>
function deleteImage(id , image_input_input_id){

    $("#"+id).attr("src","");

    $("#"+image_input_input_id).val("");

}
</script>



</body>

</html>

