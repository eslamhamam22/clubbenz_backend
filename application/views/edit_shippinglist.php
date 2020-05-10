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
                            <h4 class="page-title">Edit Shipping List</h4>
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
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>shippinglist/update_shippinglist">
                                    <?php foreach ($rec as $us) {?>
                                    <input type="hidden" name="id" value="<?php echo $us->id; ?>">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Provider Name</label>
                                        <div class="col-sm-9">
                                            <?php foreach ($providers as $provider) {?>
                                            <?php if ($us->provider_id == $provider['id']) {?>
                                                <h4><?php echo $provider['user_name']; ?></h4>
                                            <?php }}?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"> Part Name</label>
                                        <div class="col-sm-9">
                                            <h4><?php echo $us->part_id; ?></h4>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Dimensions</label>
                                        <div class="col-sm-9">
                                            <h4>
                                                <span> Length :  <?php echo $us->length; ?> - </span>
                                                <span> Width  :  <?php echo $us->width; ?> - </span>
                                                <span> Height :  <?php echo $us->height; ?> (cm) </span>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Wieght</label>
                                        <div class="col-sm-9">
                                            <h4><?php echo $us->weight; ?> (gm)</h4>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Request Date</label>
                                        <div class="col-sm-9">
                                            <h4><?php echo $us->created_at; ?></h4>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">City</label>
                                        <div class="col-sm-9">
                                            <h4><?php echo $us->city; ?></h4>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
                                        <div class="col-sm-9">
                                            <h4><?php echo $us->address; ?></h4>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Cost</label>
                                        <div class="col-sm-9">
                                            <?php if (!empty($us->price)) {?>
                                            <input type="text" name="price" class="form-control" value="<?php echo $us->price ?>">
                                            <?php } else {?>
                                            <input type="text" name="price" class="form-control" required>
                                            <?php }?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Message</label>
                                        <div class="col-sm-9">
                                            <?php if (!empty($us->message)) {?>
                                            <textarea name="message" class="form-control" rows="4" placeholder="message">
                                                <?php echo $us->message ?>
                                            </textarea>
                                            <?php } else {?>
                                            <textarea name="message" class="form-control" rows="4" placeholder="message"></textarea>
                                            <?php }?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Status</label>
                                        <div class="col-sm-9">
                                            <select id="status"  name="status" class="form-control">
                                                <?php if (!empty($us->status)) {?>
                                                <option value="pending" <?php echo $us->status == 'pending' ? 'selected' : ''; ?>>pending</option>
                                                <option value="approve" <?php echo $us->status == 'approve' ? 'selected' : ''; ?>>approve</option>
                                                <option value="reject" <?php echo $us->status == 'reject' ? 'selected' : ''; ?>>reject</option>
                                                <?php } else {?>
                                                <option>...</option>
                                                <option value="pending">pending</option>
                                                <option value="approve">approve</option>
                                                <option value="reject">reject</option>
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



