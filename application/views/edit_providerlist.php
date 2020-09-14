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
                            <h4 class="page-title">Edit Provider List</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">



                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="col-md-4 col-lg-3" >
                        <div >

                        </div>
                    </div>
                        <div class="col-md-6">
                            <div class="white-box">
                                 <?php $this->load->view('message');?>
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>providerlist/update_providerlist">
                                    <?php
foreach ($rec as $us) {?>
                                        <input type="hidden" name="id" value="<?php echo $us->id; ?>">
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Provider Image</label>
                                        <div class="col-sm-9">
                                            <img style="width:200px;" src="<?php echo base_url('upload/') . $us->logo; ?>" >
                                       </div>
                                    </div>
                                   <!--  <div class="form-group" style="padding-left: 200px">
                                            <img style="width:200px;" src="<?php echo base_url('upload/') . $us->logo; ?>" >
                                            </div> -->

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Username</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="user_name" class="form-control" id="user_name"value="<?php echo $us->user_name; ?>" readonly> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="user_email" class="form-control" id="user_email"value="<?php echo $us->user_email; ?>"readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Phone Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="user_mobile" class="form-control" value="<?php echo $us->user_mobile ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Store Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="store_name" class="form-control" value="<?php echo $us->store_name ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Contact Person</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="contact_person" class="form-control" value="<?php echo $us->contact_person ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">address</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="address" class="form-control" value="<?php echo $us->address ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">country</label>
                                        <div class="col-sm-9">
                                            <?php foreach ($countries as $country) {?>
                                            <?php if ($us->country == $country['id']) {?>
                                                <input type="text" name="country" class="form-control" value="<?php echo $country['name'] ?>" readonly>
                                            <?php }}?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">governorate</label>
                                        <div class="col-sm-9">
                                            <?php foreach ($states as $stat) {?>
                                            <?php if ($us->governorate == $stat['id']) {?>
                                            <input type="text" name="governorate" class="form-control" value="<?php echo $stat['name'] ?>" readonly>
                                            <?php }}?>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">city</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="city" class="form-control" value="<?php echo $us->city ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">zip code</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="zip_code" class="form-control" value="<?php echo $us->zip_code ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Business or personal website</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="business_website" class="form-control" value="<?php echo $us->business_website ?>"readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-9">
                                            <select id="status"  name="status" class="form-control">
                                                <?php if (!empty($us->status)) {?>
                                                <option value="expired" <?php echo $us->status == 'expired' ? 'selected' : ''; ?>>expired</option>
                                                <option value="active" <?php echo $us->status == 'active' ? 'selected' : ''; ?>>active</option>
                                                <option value="pending" <?php echo $us->status == 'pending' ? 'selected' : ''; ?>>pending</option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" id="btn" class="btn btn-info waves-effect waves-light m-t-10">Update</button>
                                        </div>
                                    </div>
                                    <?php }?>
                                </form>
                            </div>
                        </div>
                    <?php $this->load->view("common/common_footer")?>
                </div>
            </div>
         </div>
        <?php $this->load->view("common/common_script")?>

</body>



</html>



