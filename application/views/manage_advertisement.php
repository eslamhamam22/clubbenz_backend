<?php $this->load->view('common/common_header');?>
<body class="fix-header">
   <div class="preloader">
      <svg class="circular" viewBox="25 25 50 50">
         <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
      </svg>
   </div>
   <div id="wrapper" >
      <?php $this->load->view('common/top_nav');?>
      <?php $this->load->view('common/left_nav');?>
      <div id="page-wrapper"style="background: white">
         <div class="container-fluid">
            <div class="row bg-title">
               <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                  <h4 class="page-title">Manage Advertisement</h4>
               </div>
               <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <!--   <a style="background: #2CABE3" href="<?php // echo base_url('advertisement/add_advertisement') ?>"  class="btn btn-primary pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Advertisement</a>
                  </div> -->
            </div>
            <div  >
               <div>
                  <h2>Home Screen Images Selection</h2>
               </div>
            </div>
            <?php $this->load->view('message');?>
            <div  class="row" style="padding-top: 20px">
            <!-- first block-->
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>advertisement/add_home_advertisement">
               <div align="center" class="col-md-2 imageDiv1" >
                  <div align="center" class="maarginTopBottom" >
                     <div class="deletImage">
                        <p onClick="deleteImage('image_id_0' , 'image_input_id_0')">X</p>
                     </div>
                     <img  class="image_style" id='image_id_0' src="<?php echo base_url('upload/') . $home[0]->image; ?>" >
                     <input type="hidden"  name='image_input_id_0' id='image_input_id_0' value="<?php echo $home[0]->image; ?>" />
                     <input type="hidden"  name='id_0' id='image_input_id_0' value="<?php echo $home[0]->id; ?>" />
                     <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                     <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_0" value="<?php echo $home[0]->link; ?>"/>
                     <span style="color: red; font-size: 12px;">Image Size should be 400*250</span>
                  </div>
                  <input type="checkbox" name="home_0" id="home_0"  onchange="homeCheckBox('home_0')" value="active" <?php if ($home[0]->status == 'active') {
	echo "checked";
}
?> > Active Image
               </div>
               <div align="center" class="col-md-3 imageDiv1" >
                  <div align="center" class="maarginTopBottom" >
                     <div class="deletImage">
                        <p onClick="deleteImage('image_id_1' , 'image_input_id_1')">X</p>
                     </div>
                     <img class="image_style" id='image_id_1' name='image_id_1'  src="<?php echo base_url('upload/') . $home[1]->image; ?>" >
                     <input type="hidden"  name='image_input_id_1' id='image_input_id_1' value="<?php echo $home[1]->image; ?>" />
                     <input type="hidden"  name='id_1' id='image_input_id_0' value="<?php echo $home[1]->id; ?>" />
                     <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" id="logo_image" multiple="multiple"  />
                     <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_1" value="<?php echo $home[1]->link; ?>"/>
                     <span style="color: red; font-size: 12px;">Image Size should be 400*250</span>
                  </div>
                  <input type="checkbox" name="home_1" id="home_1" onchange="homeCheckBox('home_1')" value="active" <?php if ($home[1]->status == 'active') {
	echo "checked";
}
?>> Active Image
               </div>
               <div align="center" class="col-md-3 imageDiv1" >
                  <div align="center" class="maarginTopBottom" >
                     <div class="deletImage">
                        <p onClick="deleteImage('image_id_2', 'image_input_id_2')">X</p>
                     </div>
                     <img class="image_style" id='image_id_2' name='image_id_2' src="<?php echo base_url('upload/') . $home[2]->image; ?>" >
                     <input type="hidden"  name='image_input_id_2' id='image_input_id_2' value="<?php echo $home[2]->image; ?>" />
                     <input type="hidden"  name='id_2' id='image_input_id_0' value="<?php echo $home[2]->id; ?>" />
                     <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                     <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_2" value="<?php echo $home[2]->link; ?>"/>
                     <span style="color: red; font-size: 12px;">Image Size should be 400*250</span>
                  </div>
                  <input type="checkbox" name="home_2" id="home_2" onchange="homeCheckBox('home_2')" value="active" <?php if ($home[2]->status == 'active') {
	echo "checked";
}
?>> Active Image
               </div>
               <div align="center" class="col-md-3 imageDiv1" >
                  <div align="center" class="maarginTopBottom" >
                     <div class="deletImage">
                        <p onClick="deleteImage('image_id_3', 'image_input_id_3')">X</p>
                     </div>
                     <img class="image_style" id='image_id_3'  name='image_id_3' src="<?php echo base_url('upload/') . $home[3]->image; ?>" >
                     <input type="hidden"  name='image_input_id_3'  id='image_input_id_3' value="<?php echo $home[3]->image; ?>" />
                     <input type="hidden"  name='id_3' id='image_input_id_0' value="<?php echo $home[3]->id; ?>" />
                     <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" id="logo_image" multiple="multiple"  />
                     <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_3" value="<?php echo $home[3]->link; ?>"/>
                     <span style="color: red; font-size: 12px;">Image Size should be 400*250</span>
                  </div>
                  <input type="checkbox" name="home_3" id="home_3"  onchange="homeCheckBox('home_3')" value="active" <?php if ($home[3]->status == 'active') {
	echo "checked";
}
?>> Active Image
               </div>
               <div align="center" class="col-md-3 imageDiv1">
                  <div align="center" class="maarginTopBottom" >
                     <div class="deletImage">
                        <p onClick="deleteImage('image_id_4', 'image_input_id_4')">X</p>
                     </div>
                     <img class="image_style" id='image_id_4'  name='image_id_5' src="<?php echo base_url('upload/') . $home[4]->image; ?>" >
                     <input type="hidden"  name='image_input_id_4'  id='image_input_id_4' value="<?php echo $home[4]->image; ?>" />
                     <input type="hidden"  name='id_4' id='image_input_id_0' value="<?php echo $home[4]->id; ?>" />
                     <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" id="logo_image" multiple="multiple"  />
                     <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_4" value="<?php echo $home[4]->link; ?>"/>
                     <span style="color: red; font-size: 12px;">Image Size should be 400*250</span>
                  </div>
                  <input type="checkbox" name="home_4" id="home_4" onchange="homeCheckBox('home_4')" value="active" <?php if ($home[4]->status == 'active') {
	echo "checked";
}
?>> Active Image
               </div>
               <div align="center" class="col-md-3 imageDiv1" >
                  <div align="center" class="maarginTopBottom" >
                     <div class="deletImage">
                        <p onClick="deleteImage('image_id_5', 'image_input_id_5')">X</p>
                     </div>
                     <img class="image_style" id='image_id_5'  name='image_id_5' src="<?php echo base_url('upload/') . $home[5]->image; ?>" >
                     <input type="hidden"  name='image_input_id_5'  id='image_input_id_5' value="<?php echo $home[5]->image; ?>" />
                     <input type="hidden"  name='id_5' id='image_input_id_0' value="<?php echo $home[5]->id; ?>" />
                     <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" id="logo_image" multiple="multiple"  />
                     <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_5" value="<?php echo $home[5]->link; ?>"/>
                     <span style="color: red; font-size: 12px;">Image Size should be 400*250</span>
                  </div>
                  <input type="checkbox" name="home_5" id="home_5" onchange="homeCheckBox('home_5')" value="active" <?php if ($home[5]->status == 'active') {
	echo "checked";
}
?>> Active Image
               </div>
               <div align="center" class="col-md-3 imageDiv1" >
                  <div align="center" class="maarginTopBottom" >
                     <div class="deletImage">
                        <p onClick="deleteImage('image_id_6', 'image_input_id_6')">X</p>
                     </div>
                     <img class="image_style" id='image_id_6'  name='image_id_6' src="<?php echo base_url('upload/') . $home[6]->image; ?>" >
                     <input type="hidden"  name='image_input_id_6'  id='image_input_id_6' value="<?php echo $home[6]->image; ?>" />
                     <input type="hidden"  name='id_6' id='image_input_id_0' value="<?php echo $home[6]->id; ?>" />
                     <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" id="logo_image" multiple="multiple"  />
                     <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_6" value="<?php echo $home[6]->link; ?>" />
                     <span style="color: red; font-size: 12px;">Image Size should be 400*250</span>
                  </div>
                  <input type="checkbox" name="home_6"  id="home_6" onchange="homeCheckBox('home_6')" value="active" <?php if ($home[6]->status == 'active') {
	echo "checked";
}
?>> Active Image
               </div>
               <div align="center" class="col-md-3 imageDiv1" >
                  <div align="center" class="maarginTopBottom" >
                     <div class="deletImage">
                        <p onClick="deleteImage('image_id_7', 'image_input_id_7')">X</p>
                     </div>
                     <img class="image_style" id='image_id_7'  name='image_id_7' src="<?php echo base_url('upload/') . $home[7]->image; ?>" >
                     <input type="hidden"  name='image_input_id_7'  id='image_input_id_7' value="<?php echo $home[7]->image; ?>" />
                     <input type="hidden"  name='id_7' id='image_input_id_0' value="<?php echo $home[7]->id; ?>" />
                     <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" id="logo_image" multiple="multiple"  />
                     <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url' type="text" class= "form-control btn btn-default" name="link_7" value="<?php echo $home[7]->link; ?>"/>
                     <span style="color: red; font-size: 12px;">Image Size should be 400*250</span>
                  </div>
                  <input type="checkbox" name="home_7" id="home_7" onchange="homeCheckBox('home_7')" value="active" <?php if ($home[7]->status == 'active') {
	echo "checked";
}
?>> Active Image
               </div>


                   <div align="center" class="col-md-3 imageDiv1" >
                  <div align="center" class="maarginTopBottom" >
                     <div class="deletImage">
                        <p onClick="deleteImage('image_id_8', 'image_input_id_8')">X</p>
                     </div>
                     <img class="image_style" id='image_id_8'  name='image_id_8' src="<?php echo base_url('upload/') . $home[8]->image; ?>" >
                     <input type="hidden"  name='image_input_id_8'  id='image_input_id_8' value="<?php echo $home[8]->image; ?>" />
                     <input type="hidden"  name='id_8' id='image_input_id_0' value="<?php echo $home[8]->id; ?>" />
                     <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" id="logo_image" multiple="multiple"  />
                     <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url' type="text" class= "form-control btn btn-default" name="link_8" value="<?php echo $home[8]->link; ?>"/>
                     <span style="color: red; font-size: 12px;">Image Size should be 400*250</span>
                  </div>
                  <input type="checkbox" name="home_8" id="home_8" onchange="homeCheckBox('home_8')" value="active" <?php if ($home[8]->status == 'active') {
	echo "checked";
}
?>> Active Image
               </div>


                <div align="center" class="col-md-3 imageDiv1" >
                  <div align="center" class="maarginTopBottom" >
                     <div class="deletImage">
                        <p onClick="deleteImage('image_id_9', 'image_input_id_9')">X</p>
                     </div>
                     <img class="image_style" id='image_id_9'  name='image_id_9' src="<?php echo base_url('upload/') . $home[9]->image; ?>" >
                     <input type="hidden"  name='image_input_id_9'  id='image_input_id_9' value="<?php echo $home[9]->image; ?>" />
                     <input type="hidden"  name='id_9' id='image_input_id_0' value="<?php echo $home[9]->id; ?>" />
                     <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" id="logo_image" multiple="multiple"  />
                     <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url' type="text" class= "form-control btn btn-default" name="link_9" value="<?php echo $home[9]->link; ?>"/>
                     <span style="color: red; font-size: 12px;">Image Size should be 400*250</span>
                  </div>
                  <input type="checkbox" name="home_9"   id="home_9" onchange="homeCheckBox('home_9')" value="active" <?php if ($home[9]->status == 'active') {
	echo "checked";
}
?>> Active Image
               </div>

               <div class="form-group m-b-0">
               <div class="button_dive">
                        <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                    </div>
                </div>
               </form>
               <!-- First block End -->
            </div>
         </div>
            <div class='row'>
               <h2>Time Out Display Add</h2>
               <div  class="row" style="padding-top: 20px">
               <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>advertisement/add_timeOut_advertisement">
                  <div align="center" class="col-md-6 imageDiv" >
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageTime">
                           <p onClick="deleteImage('time_image_id_0' , 'time_image_input_id_0')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='time_image_id_0' src="<?php echo base_url('upload/') . $timeDisplay[0]->image; ?>" >
                        <input type="hidden"  name='time_image_input_id_0' id='time_image_input_id_0' value="<?php echo $timeDisplay[0]->image; ?>" />
                        <input type="hidden"  name='time_id_0'  value="<?php echo $timeDisplay[0]->id; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                         <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url' type="text" class= "form-control btn btn-default" name="link_0" value="<?php echo $timeDisplay[0]->link; ?>" />
                         <span style="color: red;     display: block; font-size: 12px;">Image Size should be 412*376</span>
                     </div>
                     <input type="checkbox" name="time_status_0" id="time_status_0" onchange="timeDisplayCheckBox('time_status_0')" value="active" <?php if ($timeDisplay[0]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                      <div align="center" class="maarginTopBottom" >
                        <div class="deletImageTime">
                           <p onClick="deleteImage('time_image_id_1' , 'time_image_input_id_1')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='time_image_id_1' src="<?php echo base_url('upload/') . $timeDisplay[1]->image; ?>" >
                        <input type="hidden"  name='time_image_input_id_1' id='time_image_input_id_1' value="<?php echo $timeDisplay[1]->image; ?>" />
                        <input type="hidden"  name='time_id_1'  value="<?php echo $timeDisplay[1]->id; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url' type="text" class= "form-control btn btn-default" name="link_1"  value="<?php echo $timeDisplay[1]->link; ?>" />
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 412*376</span>
                     </div>
                     <input type="checkbox" name="time_status_1" id="time_status_1"  onchange="timeDisplayCheckBox('time_status_1')" value="active" <?php if ($timeDisplay[1]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageTime">
                           <p onClick="deleteImage('time_image_id_2' , 'time_image_input_id_2')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='time_image_id_2' src="<?php echo base_url('upload/') . $timeDisplay[2]->image; ?>" >
                        <input type="hidden"  name='time_image_input_id_2' id='time_image_input_id_2' value="<?php echo $timeDisplay[2]->image; ?>" />
                        <input type="hidden"  name='time_id_2'  value="<?php echo $timeDisplay[2]->id; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url' type="text" class= "form-control btn btn-default" name="link_2" value="<?php echo $timeDisplay[2]->link; ?>" />
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 412*376</span>
                     </div>
                     <input type="checkbox" name="time_status_2" id="time_status_2"  onchange="timeDisplayCheckBox('time_status_2')" value="active" <?php if ($timeDisplay[2]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv"  style='height:242px'>
                     <!-- <input type="text" style="text-align: center"  name="opening_hour" id="opening_hour" class="form-control" readonly value=""> -->
                    <h4>Selecte Date Time For add</h4>
                    <input type="text" id="datepicker" name='timedate' value="<?php

// date_default_timezone_set('UTC');
// $the_date = strtotime($timeDisplay[0]->time_out);
//  date_default_timezone_get();

date_default_timezone_set('UTC');
$the_date = strtotime($timeDisplay[0]->time_out);
date_default_timezone_get();
date_default_timezone_set("Africa/Cairo");
$datatime = date("Y-m-d H:i:s", $the_date);

echo $datatime;?>" readonly style="width: 200px;text-align: center;">
                     <script>
                        $( function() {
                            $("#datepicker").datetimepicker({
                                    dateFormat: 'yy-mm-dd',
                                    showTimePicker: false,
                                    showSecond:false,
                                    showMillisec:false,
                                    showMicrosec:false,
                                    showTimezone:false,
                                    use24hours: true,
                                    });
                        });
                     </script>
                  </div>

               </div>
               <div class="form-group m-b-0">
               <div class="button_dive">
                        <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                    </div>
                </div>
               </form>
            </div>
            <div class='row'>
               <h2>HomePage Adds</h2>
               <div  class="row" style="padding-top: 20px">
               <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>advertisement/add_banner_advertisement">
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Home Screen Down Bar</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('banner_image_id_0' , 'banner_image_input_id_0')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='banner_image_id_0' src="<?php echo base_url('upload/') . $banner[0]->image ?>" >
                        <input type="hidden"  name='banner_image_input_id_0' id='banner_image_input_id_0' value="<?php echo $banner[0]->image; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_0" value="<?php echo $banner[0]->link; ?>"/>
                        <input type="hidden"  name='id_0'  value="<?php echo $banner[0]->id; ?>" />
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 380*100</span>
                     </div>
                     <input type="checkbox" name="status_0" value="active" <?php if ($banner[0]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Provider Listing Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('banner_image_id_1' , 'banner_image_input_id_1')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='banner_image_id_1' src="<?php echo base_url('upload/') . $banner[1]->image; ?>" >
                        <input type="hidden"  name='banner_image_input_id_1' id='banner_image_input_id_1' value="<?php echo $banner[1]->image; ?>"/>
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_1" value="<?php echo $banner[1]->link; ?>"/>
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_1' value="<?php echo $banner[1]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_1" value="active" <?php if ($banner[1]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Company Profile Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('banner_image_id_2' , 'banner_image_input_id_2')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='banner_image_id_2' src="<?php echo base_url('upload/') . $banner[2]->image; ?>" >
                        <input type="hidden"  name='banner_image_input_id_2' id='banner_image_input_id_2' value="<?php echo $banner[2]->image; ?>"/>
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_2" value="<?php echo $banner[2]->link; ?>"/>
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_2'  value="<?php echo $banner[2]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_2" value="active" <?php if ($banner[2]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Review Comment Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('banner_image_id_3' , 'banner_image_input_id_3')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='banner_image_id_3' src="<?php echo base_url('upload/') . $banner[3]->image; ?>" >
                        <input type="hidden"  name='banner_image_input_id_3' id='banner_image_input_id_3' value="<?php echo $banner[3]->image; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_3" value="<?php echo $banner[3]->link; ?>"/>
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_3' value="<?php echo $banner[3]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_3" value="active" <?php if ($banner[3]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
               </div>
               <div class="form-group m-b-0">
                    <div class="button_dive">
                        <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                    </div>
                </div>
               </form>
            </div>

            <div class='row'>
               <h2>Workshops Adds</h2>
               <div  class="row" style="padding-top: 20px">
               <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>advertisement/add_workshop_advertisement">
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Home Screen Down Bar</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('workshop_image_id_0' , 'workshop_image_input_id_0')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='workshop_image_id_0' src="<?php echo base_url('upload/') . $workshop[0]->image ?>" >
                        <input type="hidden"  name='workshop_image_input_id_0' id='workshop_image_input_id_0' value="<?php echo $workshop[0]->image; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_0" value="<?php echo $workshop[0]->link; ?>"/>
                        <input type="hidden"  name='id_0'  value="<?php echo $workshop[0]->id; ?>" />
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 380*100</span>
                     </div>
                     <input type="checkbox" name="status_0" value="active" <?php if ($workshop[0]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Provider Listing Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('workshop_image_id_1' , 'workshop_image_input_id_1')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='workshop_image_id_1' src="<?php echo base_url('upload/') . $workshop[1]->image; ?>" >
                        <input type="hidden"  name='workshop_image_input_id_1' id='workshop_image_input_id_1' value="<?php echo $workshop[1]->image; ?>"/>
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_1" value="<?php echo $workshop[1]->link; ?>"/>
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_1' value="<?php echo $workshop[1]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_1" value="active" <?php if ($workshop[1]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Company Profile Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('workshop_image_id_2' , 'workshop_image_input_id_2')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='workshop_image_id_2' src="<?php echo base_url('upload/') . $workshop[2]->image; ?>" >
                        <input type="hidden"  name='workshop_image_input_id_2' id='workshop_image_input_id_2' value="<?php echo $workshop[2]->image; ?>"/>
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_2" value="<?php echo $workshop[2]->link; ?>"/>
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_2'  value="<?php echo $workshop[2]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_2" value="active" <?php if ($workshop[2]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Review Comment Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('workshop_image_id_3' , 'workshop_image_input_id_3')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='workshop_image_id_3' src="<?php echo base_url('upload/') . $workshop[3]->image; ?>" >
                        <input type="hidden"  name='workshop_image_input_id_3' id='workshop_image_input_id_3' value="<?php echo $workshop[3]->image; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_3" value="<?php echo $workshop[3]->link; ?>"/>
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_3' value="<?php echo $workshop[3]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_3" value="active" <?php if ($workshop[3]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
               </div>
               <div class="form-group m-b-0">
                    <div class="button_dive">
                        <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                    </div>
                </div>
               </form>
            </div>

            <div class='row'>
               <h2>Part Shops Ads</h2>
               <div  class="row" style="padding-top: 20px">
               <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>advertisement/add_partshops_advertisement">
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Home Screen Down Bar</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('partshops_image_id_0' , 'partshops_image_input_id_0')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='partshops_image_id_0' src="<?php echo base_url('upload/') . $partshops[0]->image ?>" >
                        <input type="hidden"  name='partshops_image_input_id_0' id='partshops_image_input_id_0' value="<?php echo $partshops[0]->image; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_0" value="<?php echo $partshops[0]->link; ?>"/>
                        <input type="hidden"  name='id_0'  value="<?php echo $partshops[0]->id; ?>" />
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 380*100</span>
                     </div>
                     <input type="checkbox" name="status_0" value="active" <?php if ($partshops[0]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Provider Listing Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('partshops_image_id_1' , 'partshops_image_input_id_1')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='partshops_image_id_1' src="<?php echo base_url('upload/') . $partshops[1]->image; ?>" >
                        <input type="hidden"  name='partshops_image_input_id_1' id='partshops_image_input_id_1' value="<?php echo $partshops[1]->image; ?>"/>
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_1" value="<?php echo $partshops[1]->link; ?>"/>
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_1' value="<?php echo $partshops[1]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_1" value="active" <?php if ($partshops[1]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Company Profile Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('partshops_image_id_2' , 'partshops_image_input_id_2')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='partshops_image_id_2' src="<?php echo base_url('upload/') . $partshops[2]->image; ?>" >
                        <input type="hidden"  name='partshops_image_input_id_2' id='partshops_image_input_id_2' value="<?php echo $partshops[2]->image; ?>"/>
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_2" value="<?php echo $partshops[2]->link; ?>"/>
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_2'  value="<?php echo $partshops[2]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_2" value="active" <?php if ($partshops[2]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Review Comment Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('partshops_image_id_3' , 'partshops_image_input_id_3')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='partshops_image_id_3' src="<?php echo base_url('upload/') . $partshops[3]->image; ?>" >
                        <input type="hidden"  name='partshops_image_input_id_3' id='partshops_image_input_id_3' value="<?php echo $partshops[3]->image; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_3" value="<?php echo $partshops[3]->link; ?>"/>
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_3' value="<?php echo $partshops[3]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_3" value="active" <?php if ($partshops[3]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
               </div>
               <div class="form-group m-b-0">
                    <div class="button_dive">
                        <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                    </div>
                </div>
               </form>
            </div>

            <div class='row'>
               <h2>Services Ads</h2>
               <div  class="row" style="padding-top: 20px">
               <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>advertisement/add_services_advertisement">
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Home Screen Down Bar</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('services_image_id_0' , 'services_image_input_id_0')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='services_image_id_0' src="<?php echo base_url('upload/') . $services[0]->image ?>" >
                        <input type="hidden"  name='services_image_input_id_0' id='services_image_input_id_0' value="<?php echo $services[0]->image; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_0" value="<?php echo $services[0]->link; ?>"/>
                        <input type="hidden"  name='id_0'  value="<?php echo $services[0]->id; ?>" />
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 380*100</span>
                     </div>
                     <input type="checkbox" name="status_0" value="active" <?php if ($services[0]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Provider Listing Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('services_image_id_1' , 'services_image_input_id_1')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='services_image_id_1' src="<?php echo base_url('upload/') . $services[1]->image; ?>" >
                        <input type="hidden"  name='services_image_input_id_1' id='services_image_input_id_1' value="<?php echo $services[1]->image; ?>"/>
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_1" value="<?php echo $services[1]->link; ?>"/>
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_1' value="<?php echo $services[1]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_1" value="active" <?php if ($services[1]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Company Profile Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('services_image_id_2' , 'services_image_input_id_2')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='services_image_id_2' src="<?php echo base_url('upload/') . $services[2]->image; ?>" >
                        <input type="hidden"  name='services_image_input_id_2' id='services_image_input_id_2' value="<?php echo $services[2]->image; ?>"/>
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_2" value="<?php echo $services[2]->link; ?>"/>
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_2'  value="<?php echo $services[2]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_2" value="active" <?php if ($services[2]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Review Comment Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('services_image_id_3' , 'services_image_input_id_3')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='services_image_id_3' src="<?php echo base_url('upload/') . $services[3]->image; ?>" >
                        <input type="hidden"  name='services_image_input_id_3' id='services_image_input_id_3' value="<?php echo $services[3]->image; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_3" value="<?php echo $services[3]->link; ?>"/>
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_3' value="<?php echo $services[3]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_3" value="active" <?php if ($services[3]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
               </div>
               <div class="form-group m-b-0">
                    <div class="button_dive">
                        <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                    </div>
                </div>
               </form>
            </div>

            <div class='row'>
               <h2>Part Catlog Ads</h2>
               <div  class="row" style="padding-top: 20px">
               <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>advertisement/add_partcatlog_advertisement">
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Home Screen Down Bar</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('partcatlog_image_id_0' , 'partcatlog_image_input_id_0')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='partcatlog_image_id_0' src="<?php echo base_url('upload/') . $partcatlog[0]->image ?>" >
                        <input type="hidden"  name='partcatlog_image_input_id_0' id='partcatlog_image_input_id_0' value="<?php echo $partcatlog[0]->image; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_0" value="<?php echo $partcatlog[0]->link; ?>"/>
                        <input type="hidden"  name='id_0'  value="<?php echo $partcatlog[0]->id; ?>" />
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 380*100</span>
                     </div>
                     <input type="checkbox" name="status_0" value="active" <?php if ($partcatlog[0]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Provider Listing Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('partcatlog_image_id_1' , 'partcatlog_image_input_id_1')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='partcatlog_image_id_1' src="<?php echo base_url('upload/') . $partcatlog[1]->image; ?>" >
                        <input type="hidden"  name='partcatlog_image_input_id_1' id='partcatlog_image_input_id_1' value="<?php echo $partcatlog[1]->image; ?>"/>
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_1" value="<?php echo $partcatlog[1]->link; ?>"/>
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_1' value="<?php echo $partcatlog[1]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_1" value="active" <?php if ($partcatlog[1]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Company Profile Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('partcatlog_image_id_2' , 'partcatlog_image_input_id_2')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='partcatlog_image_id_2' src="<?php echo base_url('upload/') . $partcatlog[2]->image; ?>" >
                        <input type="hidden"  name='partcatlog_image_input_id_2' id='partcatlog_image_input_id_2' value="<?php echo $partcatlog[2]->image; ?>"/>
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_2" value="<?php echo $partcatlog[2]->link; ?>"/>
                        <span style="color: red;    display: block; font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_2'  value="<?php echo $partcatlog[2]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_2" value="active" <?php if ($partcatlog[2]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
                  <div align="center" class="col-md-6 imageDiv" >
                     <label  for="inputEmail3" class="control-label">Review Comment Add</label>
                     <div align="center" class="maarginTopBottom" >
                        <div class="deletImageBar">
                           <p onClick="deleteImage('partcatlog_image_id_3' , 'partcatlog_image_input_id_3')">X</p>
                        </div>
                        <img style="height:130px;width:130px;margin-bottom: 8px;" id='partcatlog_image_id_3' src="<?php echo base_url('upload/') . $partcatlog[3]->image; ?>" >
                        <input type="hidden"  name='partcatlog_image_input_id_3' id='partcatlog_image_input_id_3' value="<?php echo $partcatlog[3]->image; ?>" />
                        <input style="width: 210px" type="file" class= "form-control btn btn-default" name="image[]"size="20" multiple="multiple"  />
                        <input style="width: 210px;margin-top: 5px;" placeholder='Enter Url'  type="text" class= "form-control btn btn-default" name="link_3" value="<?php echo $partcatlog[3]->link; ?>"/>
                        <span style="color: red;     display: block;font-size: 12px;">Image Size should be 400*100</span>
                     <input type="hidden"  name='id_3' value="<?php echo $partcatlog[3]->id; ?>" />
                     </div>
                     <input type="checkbox" name="status_3" value="active" <?php if ($partcatlog[3]->status == 'active') {
	echo "checked";
}
?>> Active Image
                  </div>
               </div>
               <div class="form-group m-b-0">
                    <div class="button_dive">
                        <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Submit</button>
                    </div>
                </div>
               </form>
            </div>

            <?php $this->load->view('common/common_footer');?>
         </div>
      </div>
   </div>
   <?php $this->load->view('common/common_script');?>
   <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );
   </script>
</body>
<style>
.button_dive{
    margin: auto;
    max-width: 80%;
    text-align: center;
}
   .image_style{
   height:130px;
   width:130px;
   margin-bottom: 8px;
   }
   .deletImage {
   /* position: absolute;
   background: #2a2c2d;
   margin-left: 154px;
   width: 20px;
   color: white;
   height: 20px;
   top: 21px; */
   position: absolute;
   background: #2a2c2d;
   margin-left: 63%;
   width: 20px;
   color: white;
   height: 20px;
   top: 1px;
   }
   .deletImageBar{
   position: absolute;
   background: #2a2c2d;
   margin-left: 61%;
   width: 20px;
   color: white;
   height: 20px;
   top: 40px;
   }
   .deletImageTime{
   position: absolute;
   background: #2a2c2d;
   margin-left: 61%;
   width: 20px;
   color: white;
   height: 20px;
   top: 0px;
   }
   .soldeletImage {
   position: absolute;
   background: #2a2c2d;
   margin-left: 130px;
   width: 20px;
   color: white;
   height: 20px;
   top: 0px;
   }
   .imageDiv{
   width: 24%;
   background: #f1f2f7;
   margin: 3px;
   }
   .maarginTopBottom{
   margin-bottom: 7px;
   }
   label.control-label {
   margin-top: 14px;
   }
   .imageDiv1 {
    width: 19%;
    margin-bottom: 20px;
    background-color: #f1f2f7;
    margin: 2px;
}
   @media only screen and (max-width: 990px) {
   .imageDiv{
   width: 90%;
   background: #f1f2f7;
   margin: 3px;
   }
   .imageDiv1 {
    width: 90%;
   background: #f1f2f7;
   margin: 3px;
}
   }
</style>
<link type='text/css' rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.css' />

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<script>
  function deleteImage(id , image_input_input_id){


$("#"+id).attr("src","");

$("#"+image_input_input_id).val("");

}
function homeCheckBox (id){
    var count = 0;
    for(var i =0 ; i<=9 ; i++){
       if(document.getElementById('home_'+i).checked){
       if(count>2){
        document.getElementById(id).checked = false;
         alert("You can not select more then three at a time");
         return;
       }
       count++;

       }
    }
}

function timeDisplayCheckBox (id){
    var count = 0;
    for(var i =0 ; i<=2 ; i++){
       if(document.getElementById('time_status_'+i).checked){
       if(count>=1){
        document.getElementById(id).checked = false;
         alert("You can not select more then One at a time");
         return;
       }
       count++;

       }
    }
}

</script>
</html>