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
               <h4 class="page-title">Edit Error Solution</h4>
            </div>
         </div>
         <div class="row">
            <div col-md-12 col-lg-12>
               <div class="white-box">
                  <h3 class="box-title">Error Title : </h3>
                  <h2><?php if ($cluster_error != "") {
	echo $cluster_error->title;
}
?></h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div col-md-12 col-lg-12>
               <div class="white-box">
                  <h3 class="box-title">Error Images : </h3>
                  <?php if (count(array($cluster_error)) > 0) {?>
                  <div class="row row-in">
                     <div class="col-lg-3 col-sm-6 row-in-br">
                        <?php if ($cluster_error->pic1) {?> <img style="width:200px;" src="<?php echo base_url('upload/') . $cluster_error->pic1; ?>"> <?php }?>
                     </div>
                     <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                        <?php if ($cluster_error->pic2) {?><img style="width:200px;" src="<?php echo base_url('upload/') . $cluster_error->pic2; ?>"><?php }?>
                     </div>
                     <div class="col-lg-3 col-sm-6 row-in-br">
                        <?php if ($cluster_error->pic3) {?><img style="width:200px;" src="<?php echo base_url('upload/') . $cluster_error->pic3; ?>"><?php }?>
                     </div>
                     <div class="col-lg-3 col-sm-6  b-0">
                        <?php if ($cluster_error->pic4) {?><img style="width:200px;" src="<?php echo base_url('upload/') . $cluster_error->pic4; ?>"><?php }?>
                     </div>
                  </div>
                  <?php }?>
               </div>
            </div>
         </div>
         <div class="white-box" >
         <h3 class="box-title">User Information : </h3>
            <input type="hidden" name="user_id" class="form-control" value="3">

            <div class="row" style="border-radius: 7%;width: 220px;margin: auto;background: #edf1f5;text-align: center;margin-bottom: 15px;">
            <?php if (!empty($this->data['user']->profile_picture)) {

	if (strpos($this->data['user']->profile_picture, 'fbsbx') !== false) {
		$profile_picture = $this->data['user']->profile_picture;
	} else {
		$profile_picture = base_url('upload/profile_picture/') . $this->data['user']->profile_picture;
	}
} else {
	$profile_picture = '';
}
?>
               <img class="profile_image" src="<?php echo $profile_picture; ?>">

            </div>

            <div class="row">

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="inputEmail3" class="col-md-3 control-label">First Name</label>
                     <div class="col-md-9">
                        <input type="text" name="first_name" class="form-control" required="" value="<?php echo $this->data['user']->first_name; ?>" readonly>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="inputEmail3" class="col-md-3 control-label">Last Name</label>
                     <div class="col-md-9">
                        <input type="text" name="last_name" class="form-control" required="" value="<?php echo $this->data['user']->last_name; ?>" readonly>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="inputEmail3" class="col-md-3 control-label">Email</label>
                     <div class="col-md-9">
                        <input type="text" name="email" class="form-control" id="email" required="" value="<?php echo $this->data['user']->email; ?>" readonly>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="inputEmail3" class="col-md-3 control-label">Phone</label>
                     <div class="col-md-9">
                        <input type="text" name="phone" class="form-control" id="phone" required="" value="<?php echo $this->data['user']->phone; ?>" readonly>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-lg-3" >
               <div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="white-box" style="margin-top: 51px">
                  <form name="frm" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url("car_guide/edit_error_solution/" . $us->id); ?>">
                     <input type="hidden" name="id" value="<?php echo $id; ?>">
                     <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"> Upload Image</label>
                        <div class="col-sm-9">
                           <input type="file" class= "form-control btn btn-default" name="image" size="20"/>
                        </div>
                     </div>
                     <div class="form-group" style="padding-left: 200px">
                        <img style="width:200px;" src="<?php echo base_url('upload/') . $us->picture; ?>" >
                     </div>
                     <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label" > Description</label>
                        <div class="col-sm-9">
                           <textarea name="description" rows="4" class="form-control" required><?php echo $us->description ?></textarea>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"> Description Arabic</label>
                        <div class="col-sm-9">
                           <textarea name="description_arabic" rows="4" class="form-control" required><?php echo $us->description_arabic ?></textarea>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-9">
                           <select type="text" name="status" id="chassis" class="form-control">
                              <option value="approve">approve</option>
                              <option value="pending">pending</option>
                              <option value="rejected">rejected</option>
                           </select>
                           <script type="text/javascript">
                              document.frm.chassis.value='<?php echo $us->status ?>';
                           </script>
                        </div>
                     </div>
                     <div class="form-group m-b-0">
                        <div class="col-sm-offset-3 col-sm-9">
                           <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Update</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <?php $this->load->view('common/common_footer');?>
         </div>
      </div>
   </div>
   <?php $this->load->view('common/common_script');?>
</body>
<style>
.col-md-6 {
    margin-bottom: 11px;
}
.profile_image{
    width: 100px;
    border-radius: 50%;
    height: 100px;
    margin: 12px;
}
</style>
</html>