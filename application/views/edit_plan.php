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
                            <h4 class="page-title">Edit Service Type</h4>
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
                                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>plan/plan_update">
                                    <?php
foreach ($rec as $us) {?>
                                        <input type="hidden"  name="id" value="<?php echo $us->id; ?>">
                                    <div class="form-group">
                                        <label  class="col-sm-3 control-label"> Upload Photo</label>
                                        <div class="col-sm-9">
                                          <input type="file" class= "form-control btn btn-default" name="photo" id="photo" size="20" />

                                       </div>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px">
                                            <img style="width:200px;" src="<?php echo base_url('upload/') . $us->photo; ?>" >
                                            </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Title</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="title" class="form-control" id="title"value="<?php echo $us->title; ?>" required> </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Parts</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="num_parts" class="form-control" id="num_parts"value="<?php echo $us->num_parts; ?>" required>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Featured</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="num_featured" class="form-control" value="<?php echo $us->num_featured ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Price</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="price" class="form-control" value="<?php echo $us->price ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Frequency</label>
                                        <div class="col-sm-9">
                                            <select id="frequency"  name="frequency" class="form-control" required >
                                                <?php if (!empty($us->frequency)) {?>
                                                <option value="0month" <?php echo $us->frequency == '0month' ? 'selected' : ''; ?>>3month</option>
                                                <option value="3month" <?php echo $us->frequency == '3month' ? 'selected' : ''; ?>>3month</option>
                                                <option value="6month" <?php echo $us->frequency == '6month' ? 'selected' : ''; ?>>6month</option>
                                                <option value="9month" <?php echo $us->frequency == '9month' ? 'selected' : ''; ?>>9month</option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Extra Days</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="extra_days" class="form-control" value="<?php echo $us->extra_days ?>" required>
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



