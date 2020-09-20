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
   .deletImageBar{
        position: absolute;
        background: #2a2c2d;
        margin-left: 37%;
        width: 20px;
        color: white;
        height: 20px;
        top: 45px;
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
                  <h4 class="page-title">Update Service Shop</h4>
               </div>
            </div>
            <?php $this->load->view('message');?>
            <form  name="frm" method="post" action="<?php echo base_url('serviceshop/edit_service_shop/' . $rec->id) ?>" enctype="multipart/form-data" >
               <div class="form-body"style="background: white;padding-bottom:30px">
                  <h3 class="box-title" style="padding-top:30px;text-align:center;"></h3>
                  <div align="center">
                  <div align="center" style="padding: 20px;width: 80% ; height: 190px ; border:1px solid black" >
                     <img style="height: 130px" src="<?php echo base_url('upload/') . $rec->service_bg_image; ?>" ><br>
                     <!--                        <img style="width:200px;" src="--><!--" >-->
                     <label for="background_image" style=" margin-left: 0px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                     <i class="fa fa-cloud-upload"></i> Upload Background
                     </label>
                     <input style="display: none" type="file" id="background_image" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"/>
                     <br><span style="color: red; font-size: 12px;">Image Size should be 1000X660</span>
                  </div>
                  </div>

                  <div align="center">
                     <img style="margin-top: 20px;border-radius: 50% ; height: 150px;width:150px;" src="<?php echo base_url('upload/') . $rec->service_logo_image; ?>" ><br>
                     <!--                            <img style="margin-top: 50px;border-radius: 50% ; height: 150px;width:150px;" src="--><?php //echo base_url?><!--" >-->
                     <label for="logo_image" style=" margin-top: 60px;margin-left: 0px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                     <i class="fa fa-cloud-upload"></i> Upload Round Logo
                     </label>
                     <!--                                        <img  for="logo_image" style="width: 120px; height: 120px; margin-top: 50px" src="--><?php //echo base_url('upload/round_image_upload.png');?><!--">-->
                     <input style="display: none" type="file" class= "form-control btn btn-default" name="image[]" multiple="multiple" id="logo_image" size="20"  />
                     <br><span style="color: red; font-size: 12px;">Image Size should be 700X500</span>
                  </div>
                  <div style="margin-left: 60px ;margin-top: 80px">
                     <div class="row margin-top">
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label ">Company En Name</label>
                                 <input type="text" style="text-align: center" name="ws_name" class="form-control" value="<?php echo $rec->name ?>">
                              </div>
                           </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label ">Company AR Name</label>
                                 <input type="text" style="text-align: center"  name="arabic_name" class="form-control" value="<?php echo $rec->arabic_name ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row margin-top">
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label">City</label>
                                 <input type="text" style="text-align: center"  name="city" class="form-control" value="<?php echo $rec->city ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6" >
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label">Country</label>
                                 <input type="text" style="text-align: center"  name="country" class="form-control" value="<?php echo $rec->country ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row margin-top">
                        <div class="col-md-6" >
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label">Location Latitude</label>
                                 <input type="text" style="text-align: center"  name="location_lat" class="form-control" value="<?php echo $rec->location_latitude ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label ">Location Longitude</label>
                                 <input type="text" style="text-align: center"  name="location_lon" class="form-control" value="<?php echo $rec->location_longitude ?>" >
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row margin-top">
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label ">Address</label>
                                 <input style="text-align: center ; height: 125px"  type="text" name="address" class="form-control" value="<?php echo $rec->address ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6" style="height:155px">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label" style="width:100%">Day Off</label>
                                 <?php $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");?>

                                    <?php $day_off_arr = explode(',', $rec->off_day);?>

                                <select name="day_off[]" class="form-control js-example-tokenizer" multiple="multiple" >
                                    <?php foreach ($days as $day) {?>
                                        <option <?php if (in_array($day, $day_off_arr)) {?> selected="selected" <?php }?> value="<?php echo $day; ?>" ><?php echo $day ?></option>
                                    <?php }
;?>


                                </select><span class="help-block"> </span>
                              </div>
                              <div class="col-md-9"  style="margin-top : 20px">
                                 <label class="control-label">Phone</label>
                                 <input type="text" style="text-align: center"  name="phone" class="form-control"value="<?php echo $rec->phone ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row margin-top">
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label ">Opening Hours</label>
                                 <input type="text" style="text-align: center"  name="opening_hour" id="opening_hour" class="form-control" readonly value="<?php echo $rec->opening_hours ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label ">Closed Hours</label>
                                 <input type="text" style="text-align: center"  name="closing_hour" id="closing_hour" class="form-control" readonly value="<?php echo $rec->closing_hours ?>">
                              </div>
                           </div>
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
                                 <input type="text" name="serch_tag[]" class="form-control tokenfield" value="<?php echo $rec->serch_tag ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label">Search keywords Ar</label>
                                 <input type="text" name="serch_tag_arabic[]" class="form-control tokenfield" value="<?php echo $rec->serch_tag_arabic ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row margin-top">
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                              <label class="control-label " style="width:100%">Service Tags group</label>
                              <select name="service_type_id[]"  class="form-control js-example-tokenizer3" id="classes_select" multiple >
                                 <?php foreach ($service_type_id as $service_type) {?>
                                 <option  selected="selected"  value="<?php echo $service_type->id; ?>" ><?php echo $service_type->name ?></option>
                                 <?php }?>
                              </select>

                              </div>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                              <label class="control-label " style="width:100%">Service Tags</label>
                              <?php $service_tag_arr = explode(',', $rec->service_tag);?>
                              <select id="chassis_select" name="service_tag[]"  class="form-control js-example-tokenizer" multiple="multiple">
                                 <?php foreach ($service_tag as $sr) {?>
                                 <option <?php if (in_array($sr->id, $service_tag_arr)) {?> selected="selected" <?php }?> value="<?php echo $sr->id; ?>" ><?php echo $sr->name ?></option>
                                 <?php }?>
                              </select>
                              <script type="text/javascript">
                                 document.frm.service_tag.value='<?php echo explode(",", $rec->service_tag) ?>'
                              </script>

                              </div>
                           </div>
                        </div>



                     </div>
                     <div class="row margin-top">
                        <div class="col-md-6" >
                          <div class="col-sm-9" >
                             <label class="control-label ">Select service type</label>
                              <?php $service_type_arr = explode(',', $rec->service_type);?>
                              <select name="service_english[]" id="groups" multiple="multiple" class="form-control js-example-tokenizer">
                                 <?php foreach ($service as $sr) {?>
                                 <option <?php if (in_array($sr->id, $service_type_arr)) {?> selected="selected" <?php }?> value="<?php echo $sr->id; ?>" ><?php echo $sr->name ?></option>
                                 <?php }?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6" style="width: 500px">
                              <div class="col-md-9">

                              <label  for="inputEmail3" class=" control-label">Photo Selection  Arround rating </label>
                              <div class="deletImageBar">
                                        <p onClick="deleteImage('image_id_1' , 'image_input')">X</p>
                                    </div>
                                    <img style="margin-top: 20px;width:150px; height: 100px;" id='image_id_1' src="<?php echo base_url('upload/') . $rec->rating_image; ?>" >
                                    <input type="hidden"  name='image_input' id='image_input' value="<?php echo $rec->rating_image; ?>" />
                              <label for="image" style="  margin-top: 20px; margin-left: 30px;border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;">
                              <i class="fa fa-cloud-upload"></i> Upload Rating Inage
                              </label>
                              <input style="display:none;"  type="file" class= "form-control btn btn-default" name="image[]" id="image" multiple="multiple" size="20"/>

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
                                 <input style="text-align: center"  type="text" name="fb_link" class="form-control" value="<?php echo $rec->facebok_link ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label ">Web Site</label>
                                 <input style="text-align: center"  type="text" name="web" class="form-control" value="<?php echo $rec->web_link ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row margin-top">
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label ">Email</label>
                                 <input style="text-align: center"  type="email"  name="email" class="form-control" value="<?php echo $rec->email ?>">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <div class="col-md-9">
                                 <label class="control-label ">Twitter</label>
                                 <input style="text-align: center"  type="text" name="twitter" class="form-control" value="<?php echo $rec->tweeter ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div align="center" style="margin-top: 30px">
                     <input style="width: 200px; height: 50px;font-size: 20px     ; background-color: forestgreen "  type="submit" name="submit" class="btn btn-primary" value="Update">
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
           var service_tag= [];
          <?php foreach ($service_tag as $sr) {?>
          service_tag.push({
              id: <?php echo $sr->id; ?>,
              name: "<?php echo $sr->name; ?>",
              service_type_id: "<?php echo $sr->service_type_id; ?>"
          })
          <?php }?>
          $('#classes_select').change( function () {
              var value = $(this).val() + ''
              console.log(value)
              var valueArr= value.split(',');
              var availableChassis= []
              if(!$(this).val()){
                  availableChassis= service_tag.slice()
              }else{
                  availableChassis= service_tag.filter(function (ch) {
                      return valueArr.indexOf(ch.service_type_id) != -1
                  })
              }
              var prevValue= $('#chassis_select').val();
              $('#chassis_select').empty();
              // $('#chassis_select').append('<option value="">Select Option</option>');
              // $('#chassis_select').append('<option value="all">All</option>');
              availableChassis.forEach( function(ch){
                  console.log(ch.id)
                  $('#chassis_select').append('<option value="'+ch.id+'">'+ch.name+'</option>');
              })
              $('#chassis_select').val(prevValue || '')
          });
      });
  </script>
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