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
                            <h4 class="page-title">Edit Membership request</h4>
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
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>membership/memberships_users_update">
                                    <?php
foreach ($rec as $us) {
	$user = $this->membership->get_user_name($us->user_id);
	$memberships = $this->membership->get_membership_features($us->membership_id);
	?>
                                    <input type="hidden"  name="id" value="<?php echo $us->id; ?>">

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Name: </label>
                                        <div class="col-sm-9">
                                            <h4><?php echo $user->username; ?></h4>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Membership: </label>
                                        <div class="col-sm-9">
                                            <h4><?php echo $memberships->name; ?></h4>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="address" class="form-control" value="<?php echo $us->address ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">NID</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="nid" class="form-control" value="<?php echo $us->nid ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Upload NID Front Image</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="nid_front" id="nid_front" size="20" />

                                       </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px">
                                        <img style="width:200px;" src="<?php echo base_url('upload/') . $us->nid_front; ?>" >
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Upload NID Rear Image</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="nid_rear" id="nid_rear" size="20" />

                                       </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px">
                                        <img style="width:200px;" src="<?php echo base_url('upload/') . $us->nid_rear; ?>" >
                                    </div>

                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Upload Licence Front Image</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="licence_front" id="licence_front" size="20" />

                                       </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px">
                                        <img style="width:200px;" src="<?php echo base_url('upload/') . $us->licence_front; ?>" >
                                    </div>

                                     <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Upload Licence Rear Image</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="licence_rear" id="licence_rear" size="20" />

                                       </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px">
                                        <img style="width:200px;" src="<?php echo base_url('upload/') . $us->licence_rear; ?>" >
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-9">
                                            <select id="status"  name="status" class="form-control">
                                                <?php if (!empty($us->status)) {?>
                                                <option value="pending" <?php echo $us->status == 'pending' ? 'selected' : ''; ?>>pending</option>
                                                <option value="approve" <?php echo $us->status == 'approve' ? 'selected' : ''; ?>>Delivery</option>
                                                <option value="reject" <?php echo $us->status == 'reject' ? 'selected' : ''; ?>>Requested</option>
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



